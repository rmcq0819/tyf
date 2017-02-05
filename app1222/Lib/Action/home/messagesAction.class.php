<?php
class messagesAction extends frontendAction {
	
	public function index(){
		
		$id = $this->_get('id','intval');	
		$info = M('messages')->where('id='.$id)->find();
		$this->assign('info',$info);
		$this->display();
		
	}
	


}