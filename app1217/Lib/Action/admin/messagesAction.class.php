<?php
/** 
 *   单页新闻
 *   @author  vany
 *   date    2015 05 19 
 *       
 */
class messagesAction extends backendAction{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('messages');
    }
    //1，公司介绍；2，联系我们；3动态公告；4帮助中心
	//公司介绍
    public function index(){
		if(IS_POST){
			//id为1:关于我们,2:联系我们,2动态公告,4帮助中心
			$data['id']=$_GET['id'];
			$data['add_time']=time();
			$data['title']=$_POST['title'];
			$data['info']=$_POST['info'];
			$res=$this->_mod->data($data)->save();
			if($res!==false){
				$this->success('更新成功!');
			}else{
				$this->error('更新失败!');
			}
			
		}else{
			$data['id']=$_GET['id'];
			$res=$this->_mod->where($data)->find();
			$this->assign('list',$res);
			$this->assign('id',$data['id']);
			$this->display();	
		}
    }
}