<?php
/**
 * 后台控制器基类
 *
 * @author andery
 */
class backendAction extends baseAction
{
    protected $_name = '';
    protected $menuid = 0;
    public function _initialize() {
        parent::_initialize();
        $this->_name = $this->getActionName();
		$priv_array=array("index","add","delete","addkeyword","addmess","addfollow","words","lists","jieshao","lianxi","gonggao","bangzhu","log");
		if (in_array(ACTION_NAME, $priv_array)) {
        	$this->check_priv();
		}
        $this->menuid = $this->_request('menuid', 'trim', 0);
        if ($this->menuid) {
            $sub_menu = D('menu')->sub_menu($this->menuid, $this->big_menu);
            $selected = '';
            foreach ($sub_menu as $key=>$val) {
                $sub_menu[$key]['class'] = '';
                if (MODULE_NAME == $val['module_name'] && ACTION_NAME == $val['action_name'] && strpos(__SELF__, $val['data'])) {
                    $sub_menu[$key]['class'] = $selected = 'on';
                }
            }
            if (empty($selected)) {
                foreach ($sub_menu as $key=>$val) {
                    if (MODULE_NAME == $val['module_name'] && ACTION_NAME == $val['action_name']) {
                        $sub_menu[$key]['class'] = 'on';
                        break;
                    }
                }
            }
            $this->assign('sub_menu', $sub_menu);
        }
        $this->assign('menuid', $this->menuid);
    }

    /**
     * 列表页面
     */
    public function index() {
        $map = $this->_search();
        
        $mod = D($this->_name);
       
        !empty($mod) && $this->_list($mod, $map);
        
        $this->display();
    }

    /**
     * 添加
     */
    public function add() {
        $mod = D($this->_name);
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
            if( $mod->add($data) ){
                if( method_exists($this, '_after_insert')){
                    $id = $mod->getLastInsID();
                    $this->_after_insert($id);
                }
                if ($_SESSION['content']) {
                     $this->add_log($_SESSION['content']);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }

    /**
     * 修改
     */
    public function edit()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }
            if (false !== $mod->save($data)) {
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id);
                }
                if ($_SESSION['content']) {
                     $this->add_log($_SESSION['content']);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $id = $this->_get($pk, 'intval');
            $info = $mod->find($id);
            $this->assign('info', $info);
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }

    /**
     * ajax修改单个字段值
     */
    public function ajax_edit()
    {
        //AJAX修改数据
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $id = $this->_get($pk, 'intval');
        $field = $this->_get('field', 'trim');
        $val = $this->_get('val', 'trim');
        //允许异步修改的字段列表  放模型里面去 TODO
        $mod->where(array($pk=>$id))->setField($field, $val);
        $this->ajaxReturn(1);
    }

    /**
     * 删除
     */
    public function delete()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        if ($ids) {
            if (false !== $mod->delete($ids)) {
                if ($_SESSION['content']) {
                     $this->add_log($_SESSION['content']);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
            $this->error(L('illegal_parameters'));
        }
    }

    /**
     * 获取请求参数生成条件数组
     */
    protected function _search() {
        //生成查询条件
        $mod = D($this->_name);
        $map = array();
        foreach ($mod->getDbFields() as $key => $val) {
            if (substr($key, 0, 1) == '_') {
                continue;
            }
            if ($this->_request($val)) {
                $map[$val] = $this->_request($val);
            }
        }
        return $map;
    }

    /**
     * 列表处理
     *
     * @param obj $model  实例化后的模型
     * @param array $map  条件数据
     * @param string $sort_by  排序字段
     * @param string $order_by  排序方法
     * @param string $field_list 显示字段
     * @param intval $pagesize 每页数据行数
     */
    protected function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=20)
    {
        //排序
        $mod_pk = $model->getPk();
      
        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else if (!empty($sort_by)) {
            $sort = $sort_by;
        } else if ($this->sort) {
            $sort = $this->sort;
        } else {
            $sort = $mod_pk;
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else if (!empty($order_by)) {
            $order = $order_by;
        } else if ($this->order) {
            $order = $this->order;
        } else {
            $order = 'DESC';
        }
        //如果需要分页
        if ($pagesize) {
            $count = $model->where($map)->count($mod_pk);
            $pager = new Page($count, $pagesize);
        }
		
		if($model==D('item_order')){
        		
        	$select = M("order_detail")
        	->field('weixin_order_detail.sigsumprice,weixin_item_order.*,weixin_user.merchant')
        	->join('weixin_item_order ON weixin_order_detail.orderId = weixin_item_order.orderId')
        	->join('weixin_user ON weixin_order_detail.shopid = weixin_user.id')
        	->where($map)->order($sort . ' ' . $order);
        		
        }else{
			$select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
		}
        $this->list_relation && $select->relation(true);
        if ($pagesize) {
            $select->limit($pager->firstRow.','.$pager->listRows);
            $page = $pager->show();
            $this->assign("page", $page);
        }
		
		if($model==D('item_order')){
        	$list = $select->select();
        	$u1=array();
        	foreach($list as $k=>&$e){
        		$name=&$e['orderId'];
        		if(!isset($u1[$name])){
        			$u1[$name]=$e;
        			unset($u1[$name]['chexing']);
        		}
        		$u1[$name]['goodsifno'][]=array('chexing'=>$e['chexing']);
        	}
        	$list=array_values($u1); unset($u1);
        	
        }else{
			$list = $select->select();
		}

        $this->assign('list', $list);
        $this->assign('list_table', true);
    }

    public function check_priv() {
        if (MODULE_NAME == 'attachment') {
            return true;
        }
        if ( (!isset($_SESSION['admin']) || !$_SESSION['admin']) && !in_array(ACTION_NAME, array('login','verify_code')) ) {
            $this->redirect('index/login');
        }
        if($_SESSION['admin']['role_id'] == 1) {
            return true;
        }
        if (in_array(MODULE_NAME, explode(',', 'index'))) {
            return true;
        }
        $menu_mod = M('menu');
        $menu_id = $menu_mod->where(array('module_name'=>MODULE_NAME, 'action_name'=>ACTION_NAME))->getField('id');
        $priv_mod = D('admin_auth');
        $r = $priv_mod->where(array('menu_id'=>$menu_id, 'role_id'=>$_SESSION['admin']['role_id']))->count();
        if (!$r) {
            $this->error(L('_VALID_ACCESS_'),U('index/panel'));
        }
    }
    
    protected function update_config($new_config, $config_file = '') {
        !is_file($config_file) && $config_file = CONF_PATH . 'home/config.php';
        if (is_writable($config_file)) {
            $config = require $config_file;
            $config = array_merge($config, $new_config);
            file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
            @unlink(RUNTIME_FILE);
            return true;
        } else {
            return false;
        }
    }

    /** 
     *   后台数据到出excel
     *   @author  vany
     *   date    2015 04 21 
     *       
     */   
    public function getExcel($fileName,$headArr,$data,$keys){
            //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
            import("Think.ORG.PHPExcel");
            import("Think.ORG.PHPExcel.Writer.Excel5");
            import("Think.ORG.PHPExcel.IOFactory.php");
            //对数据进行检验
            if(empty($data) || !is_array($data)){
                die("data must be a array");
            }
            //检查文件名
            if(empty($fileName)){
                exit;
            }

            //$date = date("Y_m_d",time());
            $fileName .= ".xls";

            //创建PHPExcel对象，注意，不能少了\
            $objPHPExcel = new PHPExcel();
            $objProps = $objPHPExcel->getProperties();
            
            //设置表头
            $key = ord("A");
            foreach($headArr as $v){
                $colum = chr($key);
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
                $key += 1;
            }
            
            $column = 2;
            $objActSheet = $objPHPExcel->getActiveSheet();
            foreach($data as $key => $rows){ //行写入
                $span = ord("A");
                $i=1;
                foreach($rows as $keyName=>$value){// 列写入
                    $j = chr($span);
                    //判断第E个为时间戳时间
                    if ($keys==$i) {
                        $objActSheet->setCellValue($j.$column,date('Y-m-d',$value));
                    }else{
                        $objActSheet->setCellValue($j.$column,$value);
                    }
                    $span++;
                    $i++;
                }
                $column++;
            }

            $fileName = iconv("utf-8", "gb2312", $fileName);
            //重命名表
            // $objPHPExcel->getActiveSheet()->setTitle('test');
            //设置活动单指数到第一个表,所以Excel打开这是第一个表
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=\"$fileName\"");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output'); //文件通过浏览器下载
            exit;
    }
    /** 
     *   后台操作记录
     *   @author  vany
     *   date    2015 05 19 
     *       
     */
    public function add_log($content){
        $data['content']=$content;
        $data['username']=$_SESSION['admin']['username'];
        $data['ip']=get_client_ip();
        $data['add_time']=time();
        M('log')->add($data);
    }
}