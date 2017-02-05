<?php
class indexAction extends backendAction {

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('menu');
        $this->item_order=M('item_order');
        
    }

    public function index() {
        $top_menus = $this->_mod->admin_menu(0);
        $ad=M('ad');
        $ad1=$ad->where(array('board_id'=>13))->find();
        $this->assign('info',$ad1);
        $this->assign('top_menus', $top_menus);
        $my_admin = array('username'=>$_SESSION['admin']['username'], 'rolename'=>$_SESSION['admin']['role_id']);
        $this->assign('my_admin', $my_admin);
        
		$this->display();
		
	}
	
	public function serve() {
        
        $serve= M('serve');
		$serves= $serve->field('id,tel,user_name,s_datetime,s_date,sex,adress,add_time,goods')->order('id asc')->select();
		//print_r($serves);
		$this->assign('serve',$serves);

		$this->display();
    }
	
	public function words() {
        
		$message= M('words');
		$messages= $message->field('id,tel,user_name,email,add_time,words_txt')->order('id asc')->select();
		
        $count =count($messages);
        $pager = new Page($count,20);
        $list=array_slice($messages, $pager->firstRow,$pager->listRows);
        $page = $pager->show();
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->assign('list_table', true);
		$this->display();
		
    }
	
    public function tixian() {
        
		$tixian = M('user_fengchengllist');
		import('ORG.Page');// 导入分页类
		$count = $tixian->where("state='2'")->count();
		$Page = new Page($count,20);// 实例化分页类 传入总记录数,每页显示的记录数
		$pageShow = $Page->show();// 分页显示输出
		$tixianlist = $tixian->where("state='2'")->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('tixianlist',$tixianlist);
		$this->assign('pageShow',$pageShow);

		$this->display();
		
    }
	
	public function fencheng() {
		if(IS_POST){
			$fengchenglv=M('user_fengchenglv');
			if($_POST['fencheng']){
				$fencheng=$_POST['fencheng'];
				$data['royalty']=implode('|',$fencheng);
				$res=$fengchenglv->where(array('id'=>3))->save($data);
				if($res){
					$this->success('更新成功',U('index/fencheng'));
				}else{
					$this->error('更新失败!');
				}
			}else{
				$data['status']=$_POST['status'];
				$res=$fengchenglv->where(array('id'=>3))->save($data);
				if($res){
					$this->success('更新成功!',U('index/fencheng'));
				}else{
					$this->error('更新失败!');
				}
			}	
		}else{
			$user_fengchenglv= M('user_fengchenglv');
			$fengchenglv= $user_fengchenglv->find();
			if($fengchenglv['royalty']){
				$lv=explode('|',$fengchenglv['royalty']);
			}
			$count=count($lv);
			$this->assign('status',$fengchenglv['status']);
			$this->assign('count',$count);
			$this->assign('lv',$lv);
			$this->display();
		}
    }
	
	

    public function panel() {
        $message = array();
        if (is_dir('./install')) {
            $message[] = array(
                'type' => 'error',
                'content' => "您还没有删除 install 文件夹，出于安全的考虑，我们建议您删除 install 文件夹。",
            );
        }
        if (APP_DEBUG == true) {
            $message[] = array(
                'type' => 'error',
                'content' => "您网站的 DEBUG 没有关闭，出于安全考虑，我们建议您关闭程序 DEBUG。",
            );
        }
        if (!function_exists("curl_getinfo")) {
            $message[] = array(
                'type' => 'error',
                'content' => "系统不支持 CURL ,将无法采集商品数据。",
            );
        }
        $this->assign('message', $message);
        $system_info = array(
            'pinphp_version' => PIN_VERSION . ' RELEASE '. PIN_RELEASE .' [<a href="http://www.pinphp.com/" class="blue" target="_blank">查看最新版本</a>]',
            'server_domain' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
            'server_os' => PHP_OS,
            'web_server' => $_SERVER["SERVER_SOFTWARE"],
            'php_version' => PHP_VERSION,
            'mysql_version' => mysql_get_server_info(),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'max_execution_time' => ini_get('max_execution_time') . '秒',
            'safe_mode' => (boolean) ini_get('safe_mode') ?  L('yes') : L('no'),
            'zlib' => function_exists('gzclose') ?  L('yes') : L('no'),
            'curl' => function_exists("curl_getinfo") ? L('yes') : L('no'),
            'timezone' => function_exists("date_default_timezone_get") ? date_default_timezone_get() : L('no')
        );
        $this->assign('system_info', $system_info);
        
        
        
        $buycount= M('item')->where('status=1')->count();
        $nobuycount= M('item')->where('status=0')->count();
		$time = date("Y-m-d h:i:s",time()-24*60*60*3);
		$words= M('words')->where('add_time>\''.$time.'\'')->count();
		$tixians= M('user_fengchengllist')->where('state=2')->count();
        
        $fukuan= $this->item_order->where('status=1')->count();
        $fahuo= $this->item_order->where('status=2')->count();
        $yfahuo= $this->item_order->where('status=3')->count();
		$tuihuo= $this->item_order->where('status=6')->count();
        $data['goods_stock']=array('lt','10');
        $time_start=date("Y-m-d",time()-24*60*60*1);
        $time_end = date('Y-m-d');
        $data['add_time']=array('between',array(strtotime($time_start),strtotime($time_end)));
        $Yesterday= $this->item_order->where($data)->count();
        $sumprice= $this->item_order->where($data)->sum('order_sumPrice');
        $time= strtotime(date("Y-m-d",time()-24*60*60*7));
        $option = array(
        "legend"=>array("下单数","成交数","退单数"),
        "xaxis"=>array("type"=>"category","boundaryGap"=>"true","data"=>array(
        date("m-d",time()-24*60*60*7),
        date("m-d",time()-24*60*60*6),
        date("m-d",time()-24*60*60*5),
        date("m-d",time()-24*60*60*4),
        date("m-d",time()-24*60*60*3),
        date("m-d",time()-24*60*60*2),
        date("m-d",time()-24*60*60*1))), 
        
        "series"=>array(
        array("name"=>"下单数","type"=>"line","smooth"=>"true","stack"=>"数量","data"=>array($this->order_num(strtotime(date("Y-m-d",time()-24*60*60*7)),0),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*6)),0),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*5)),0),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*4)),0),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*3)),0),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*2)),0),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*1)),0))),                  
        array("name"=>"成交数","type"=>"line","smooth"=>"true","stack"=>"数量","data"=>array($this->order_num(strtotime(date("Y-m-d",time()-24*60*60*7)),4),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*6)),4),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*5)),4),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*4)),4),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*3)),4),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*2)),4),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*1)),4))),             
        array("name"=>"退单数","type"=>"line","smooth"=>"true","stack"=>"数量","data"=>array($this->order_num(strtotime(date("Y-m-d",time()-24*60*60*7)),6),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*6)),6),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*5)),6),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*4)),6),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*3)),6),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*2)),6),
        $this->order_num(strtotime(date("Y-m-d",time()-24*60*60*1)),6)))          
        ),
        );
        
        $option1 = array(
        "legend"=>array("成交金额"),
        "grid"=>array("width"=>340,"height"=> 100, "y"=> 20,"x"=> 45),
        "xaxis"=>array("type"=>"category","boundaryGap"=>"true","data"=>array(
        date("m-d",time()-24*60*60*7),
        date("m-d",time()-24*60*60*6),
        date("m-d",time()-24*60*60*5),
        date("m-d",time()-24*60*60*4),
        date("m-d",time()-24*60*60*3),
        date("m-d",time()-24*60*60*2),
        date("m-d",time()-24*60*60*1))), 
        
        "series"=>array(
        array("name"=>"成交金额","type"=>"bar","smooth"=>true,"stack"=>"数量","data"=>array($this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*7)),strtotime(date("Y-m-d",time()-24*60*60*6)),4),
        $this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*6)),strtotime(date("Y-m-d",time()-24*60*60*5)),4),
        $this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*5)),strtotime(date("Y-m-d",time()-24*60*60*4)),4),
        $this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*4)),strtotime(date("Y-m-d",time()-24*60*60*3)),4),
        $this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*3)),strtotime(date("Y-m-d",time()-24*60*60*2)),4),
        $this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*2)),strtotime(date("Y-m-d",time()-24*60*60*1)),4),
        $this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*1)),strtotime(date("Y-m-d",time())),4)))
  
        )
        );
       
        $ec = new Echarts();//显示图表
        $echarts= $ec->show('visit_charts', $option,$option1,1);  // 显示在指定的dom节点上
        
        
        
        $day7order_count=$this->order_count(strtotime(date("Y-m-d",time()-24*60*60*7)),strtotime(date("Y-m-d",time()-24*60*60*1)));//7天下单数
        $day7order_4=$this->order_count(strtotime(date("Y-m-d",time()-24*60*60*7)),strtotime(date("Y-m-d",time()-24*60*60*1)),4);//7天成交数
        $day7order_6=$this->order_count(strtotime(date("Y-m-d",time()-24*60*60*7)),strtotime(date("Y-m-d",time()-24*60*60*1)),6);//7天退单数
        $day7order_sumPrice=$this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*7)),strtotime(date("Y-m-d",time()-24*60*60*1)));//7天总金额
        $day7order_Price6=$this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*7)),strtotime(date("Y-m-d",time()-24*60*60*1)),6);//7天退款金额
        $day7order_Price4=$this->order_sum_price(strtotime(date("Y-m-d",time()-24*60*60*7)),strtotime(date("Y-m-d",time()-24*60*60*1)),4);//7天成交金额
        $day7datetime=date("Y-m-d",time()-24*60*60*7)."至".date("Y-m-d",time()-24*60*60*1);
        $goods_stock=M('item')->where($data)->count();
        $this->assign('count',
        array('fukuan'=>$fukuan,
        'fahuo'=>$fahuo,
        'yfahuo'=>$yfahuo,
		'tuihuo'=>$tuihuo,
        'buycount'=>$buycount,
        'nobuycount'=>$nobuycount,
		'words'=>$words,
		'tixians'=>$tixians,
        'goods_stock'=>$goods_stock,
        'time_start'=>$time_start,
        'time_end'=>$time_end,
        'Yesterday'=>$Yesterday,
        'sumprice'=>$sumprice,
        'echarts'=>$echarts,
        'day7order_count'=>$day7order_count,
        'day7datetime'=>$day7datetime,
        'day7order_4'=>$day7order_4,
        'day7order_6'=>$day7order_6,
        'day7order_sumPrice'=>$day7order_sumPrice,
        'day7order_Price6'=>$day7order_Price6,
        'day7order_Price4'=>$day7order_Price4
        )
        );
		
        $this->display();
    }
    public function order_count($date1,$date2,$status){
        if($status==0){
            $data['add_time']=array('between',array($date1,$date2));
            $res=M('item_order')->where($data)->count();
        }else{
            $data['status']=$status;
            $data['add_time']=array('between',array($date1,$date2));
            $res=M('item_order')->where($data)->count();
        }
        return $res;
    }
    public function order_sum_price($date1,$date2,$status){
        if ($date2==null)
        {
        	$date2=$date1+24*60*60;
        }
        if($status==0){
            $data['add_time']=array('between',array($date1,$date2));
            $res=M('item_order')->where($data)->sum('order_sumPrice');
        }else{
            $data['status']=$status;
            $data['add_time']=array('between',array($date1,$date2));
            $res=M('item_order')->where($data)->sum('order_sumPrice');
        }
        if($res){
            return $res;
        }else{
            return 0;
        }
    }
    public function order_num($date,$status){
        if($status==0){
            $data['add_time']=array('between',array($date,$date+24*60*60));
            $res=M('item_order')->where($data)->count();
        }else{
            $data['status']=$status;
            $data['add_time']=array('between',array($date,$date+24*60*60));
            $res=M('item_order')->where($data)->count();
        }
        return $res;
    }

    public function login() {
        if (IS_POST) {
            $username = $this->_post('username', 'trim');
            $password = $this->_post('password', 'trim');
            $verify_code = $this->_post('verify_code', 'trim');
            if(session('verify') != md5($verify_code)){
                $this->error(L('verify_code_error'));
            }
            $admin = M('admin')->where(array('username'=>$username, 'status'=>1))->find();
            if (!$admin) {
                $this->error(L('admin_not_exist'));
            }
            if ($admin['password'] != md5($password)) {
                $this->error(L('password_error'));
            }
            session('admin', array(
                'id' => $admin['id'],
                'role_id' => $admin['role_id'],
                'username' => $admin['username'],
            ));
            M('admin')->where(array('id'=>$admin['id']))->save(array('last_time'=>time(), 'last_ip'=>get_client_ip()));
            $this->add_log('登录成功');
            $this->success(L('login_success'), U('index/index'));
        } else {
            $this->display();
        }
    }

    public function logout() {
        $this->add_log('注销成功');
        session('admin', null);
        $this->success(L('logout_success'), U('index/login'));
        exit;
    }

    public function verify_code() {
        Image::buildImageVerify(4,1,'gif','60','28');
    }

    public function left() {
        $menuid = $this->_request('menuid', 'intval');
        if ($menuid) {
            $left_menu = $this->_mod->admin_menu($menuid);
            foreach ($left_menu as $key=>$val) {
                $left_menu[$key]['sub'] = $this->_mod->admin_menu($val['id']);
            }
        } else {
            $left_menu[0] = array('id'=>0,'name'=>'商品管理');
            $left_menu[0]['sub'] = array();
            if ($r = $this->_mod->where(array('often'=>1))->select()) {
                $left_menu[0]['sub'] = $r;
            }
            array_unshift($left_menu[0]['sub'], array('id'=>0,'name'=>'后台首页','module_name'=>'index','action_name'=>'often_menu'));
        }
        $this->assign('left_menu', $left_menu);
        $this->display();
    }
	public function icon()
	{
		$this->display();
	}
    public function often() {
        if (isset($_POST['do'])) {
            $id_arr = isset($_POST['id']) && is_array($_POST['id']) ? $_POST['id'] : '';
            $this->_mod->where(array('ofen'=>1))->save(array('often'=>0));
            $id_str = implode(',', $id_arr);
            $this->_mod->where('id IN('.$id_str.')')->save(array('often'=>1));
            $this->success(L('operation_success'));
        } else {
            $r = $this->_mod->admin_menu(0);
            $list = array();
            foreach ($r as $v) {
                $v['sub'] = $this->_mod->admin_menu($v['id']);
                foreach ($v['sub'] as $key=>$sv) {
                    $v['sub'][$key]['sub'] = $this->_mod->admin_menu($sv['id']);
                }
                $list[] = $v;
            }
            $this->assign('list', $list);
            $this->display();
        }
    }

    public function map() {
        $r = $this->_mod->admin_menu(0);
        $list = array();
        foreach ($r as $v) {
            $v['sub'] = $this->_mod->admin_menu($v['id']);
            foreach ($v['sub'] as $key=>$sv) {
                $v['sub'][$key]['sub'] = $this->_mod->admin_menu($sv['id']);
            }
            $list[] = $v;
        }
        $this->assign('list', $list);
        $this->display();
    }
    
    

    public function dosql(){
        
    }
    
    
    
    
}