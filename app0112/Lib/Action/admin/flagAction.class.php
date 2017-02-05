<?php
class flagAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
		parent::CheckLogin();
        $this->_mod = M('flag');
    }

    public function index() {

        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else {
            $sort = 'Id';
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else {
            $order = 'DESC';
        }
		
		if(isset($_GET['keyword'])){
			$keyword = $this->_request('keyword','trim','');
			$where['name'] = array('like','%'.$keyword.'%');
		}
		$search = array();
        $search['keyword'] = $keyword;
        $this->assign('search',$search);
		 $count = $this->_mod->count();
		$pager = new Page($count,15);
		$list = $this->_mod->where($where)->order($sort . ' ' . $order)->limit($pager->firstRow.','.$pager->listRows)->select();
		$this->assign('page',$pager->show());
		$this->assign('list',$list);
		$this->assign('list_table', true);
		
 
        $this->display();
    }
	 /**
     * ajax修改单个字段值
     */
    public function ajax_edit()
    {
        //AJAX修改数据
        $mod = D($this->_name);
        $Id = $this->_get('id', 'intval');
        $field = $this->_get('field', 'trim');
        $val = $this->_get('val', 'trim');
        //允许异步修改的字段列表  放模型里面去 TODO
        $mod->where(array('Id'=>$Id))->setField($field, $val);
        $this->ajaxReturn(1);
    }
	public function add() {
        if (IS_POST) {
			$date_dir = date('ym/d/'); //上传目录
			//必须填写国家名称
            if ($_POST['name'] == '') {
                $this->error('请填写产国名称');
            }

            //必须上传国旗图片
            if (empty($_FILES['flag']['name'])) {
                $this->error('请上传产国国旗图片');
            }
			if(isset($_POST['status']))
            {
				//status为1时必须上传分类图片
				if (empty($_FILES['bg_img']['name'])) {
					$this->error('请上传分类图片');
				}
				
            }
			if (!empty($_FILES['bg_img']['name'])) {
				if(!isset($_POST['status']))
				{
					$this->error('您上传了分类图片，请选择是作为分类显示');
				}
				$data['status'] = 1;
				
				$result = $this->_upload($_FILES['bg_img'], 'bg_img/'.$date_dir, array(
                    'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
                    'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
                    'suffix' => '_b,_m,_s',
                ));
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    $data['bg_img'] = $date_dir . $result['info'][0]['savename'];
                }
				
			}
			$result = $this->_upload($_FILES['flag'], 'flag/'.$date_dir, array(
				'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
				'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
				'suffix' => '_b,_m,_s',
			));
			if ($result['error']) {
				$this->error($result['info']);
			} else {
				$data['flag'] = $date_dir . $result['info'][0]['savename'];
			}
			
			$data['name'] = $this->_post('name','trim');
			$data['ordid'] = $this->_post('ordid','intval');
			$this->_mod->add($data);
			$this->add_log('添加产国信息');
            $this->success(L('operation_success'));	
		}else{
			$this->display();
		}					
	}
	
	
	
	public function edit() {
       if (IS_POST) {
			$date_dir = date('ym/d/'); //上传目录
			$data['status'] = 0;
			//必须填写国家名称
            if ($_POST['name'] == '') {
                $this->error('产国名称不能为空');
            }

			if(isset($_POST['status']))
            {
				$data['status'] = 1;
				if (empty($_FILES['bg_img']['name'])&&$_POST['bgimg'] == '') {
					$this->error('请上传分类图片');
				}
            }
			if(!empty($_FILES['flag']['name'])){
				$result = $this->_upload($_FILES['flag'], 'flag/'.$date_dir, array(
					'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
					'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
					'suffix' => '_b,_m,_s',
				));
				if ($result['error']) {
					$this->error($result['info']);
				} else {
					$data['flag'] = $date_dir . $result['info'][0]['savename'];
				}	
			}
			if (!empty($_FILES['bg_img']['name'])) {
				if(!isset($_POST['status']))
				{
					$this->error('您上传了分类图片，请选择是作为分类显示');
				}
				$data['status'] = 1;
				
				$result = $this->_upload($_FILES['bg_img'], 'bg_img/'.$date_dir, array(
                    'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
                    'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
                    'suffix' => '_b,_m,_s',
                ));
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    $data['bg_img'] = $date_dir . $result['info'][0]['savename'];
                }
				
			}
			$where['Id'] = $this->_post('Id','intval');
			$data['name'] = $this->_post('name','trim');
			$data['ordid'] = $this->_post('ordid','intval');
			$this->_mod->where($where)->save($data);
			$this->add_log('添加产国信息');
            $this->success(L('operation_success'));	
		}else{
			$Id = $this->_get('Id','trim');
			$where['Id'] = $Id;
			$country = $this->_mod->where($where)->find();
			$this->assign('country',$country);
			$this->display();
		}					
    }
}