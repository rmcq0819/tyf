<?php
class user_cangkuAction extends backendAction{
	
	
	public function _before_show() {
		$big_menu = array(
				//'title' => L('add_user'),
				'title' => '添加会员组',
				'iframe' => U('user_category/add'),
				'id' => 'add',
				'width' => '500',
				'height' => '330'
		);
		$this->assign('big_menu', $big_menu);
	}
	
	protected function _search() {
		$map = array();
		if( $keyword = $this->_request('keyword', 'trim') ){
			$map['_string'] = "name like '%".$keyword."%'";
		}
		$this->assign('search', array(
				'keyword' => $keyword,
		));
		return $map;
	}
	
	public function show(){
		$uid = isset($_GET['id']) ? $_GET['id'] : 0;
		$this->assign('uid',$uid);
		if(empty($uid)) $this->error('未选中查看的用户！');
		
		$userdata = D('user')->find($uid);
		$this->assign('userdata',$userdata);
		
		$cangku = D('user_cangku');
		$data = $cangku->where(array('userid'=>$uid))->select();
		$this->assign('data',$data);
		
		$item = D('item');
		$itemsinfo = $item->field('id,title,size')->select();
		foreach ($itemsinfo as $k=>$v){
			$items[$v['id']] = $v;
			$size[$v['id']]=explode('|',$v['size']);
		}
		$this->assign('size',$size);
		$this->assign('items',$items);
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			if($_POST['ac'] != 'addok'){
				$this->error('操作错误！');
			}
			//var_dump($_POST);exit;
			if(!$_POST['size']){
				$this->error('选择商品规格!');
			}
			$cangku = D('user_cangku');
			$oInfo = $cangku->where(array('userid'=>$_POST['userid'],'goodsid'=>$_POST['goodsid'],'size'=>$_POST['size']))->find();
			if($oInfo){
				$this->error('你所添加的商品库存记录已存在！');
			}
			//获取数据
			if($cangku->create()){
				if($cangku->add()){
					$this->success('更新成功！',U('user_cangku/show',array('id'=>$_POST['userid'])));exit;
				}else{
					$this->error('添加失败！');
				}
			}else{
				$this->error($cangku->getError());
			}
		}
		
		$id = isset($_GET['id']) ? ($_GET['id'] + 0) : -1;
		if($id == -1){
			$this->error('未选中添加用户！');
		}
		//获取用户信息
		$userinfo = D('user')->find($id);
		//获取所有商品信息
		$items = D('item')->field('id,title,size')->select();
		$size=explode('|',$items[0]['size']);
		$this->assign('userinfo',$userinfo);
		$this->assign('items',$items);
		$this->assign('size',$size);
		$this->display();
	}
	
	public function edit(){
		if(IS_POST){
			$id = isset($_POST['id']) ? $_POST['id'] : 0;
			if(empty($id)){
				$this->error('非法修改！');
			}
			//var_dump($_POST);exit;
			$cangku = D('user_cangku');
			if($cangku->create()){
				if($cangku->save()){
					$this->success('更新成功！',U('user_cangku/show',array('id'=>$_POST['userid'])));exit;
				}else{
					$this->error('更新失败！');
				}
			}else{
				$this->error($cangku->getError());
			}
		}
		
		$id = isset($_GET['id']) ? ($_GET['id'] + 0) : -1;
		if($id == -1){
			$this->error('未选中添加用户！');
		}
		$kucuninfo = D('user_cangku')->find($id);
		$userinfo = D('user')->find($kucuninfo['userid']);
		$iteminfo = D('item')->find($kucuninfo['goodsid']);
		$size=explode('|',$iteminfo['size']);
		$this->assign('size',$size);
		$this->assign('userid',$id);
		$this->assign('kucuninfo',$kucuninfo);
		$this->assign('userinfo',$userinfo);
		$this->assign('iteminfo',$iteminfo);
		$this->display();
	}
	
	public function delete(){
		$id = isset($_GET['id']) ? ($_GET['id'] + 0) : -1;
		$cangku = D('user_cangku');
		$user_id=$cangku->where(array('id'=>$id))->find();
		if($cangku->delete($id)){
			$this->success('更新成功！',U('user_cangku/show',array('id'=>$user_id['userid'])));exit;
		}else{
			$this->error($cangku->getError(),U('user_cangku/show',array('id'=>$id)));
		}
	}
}