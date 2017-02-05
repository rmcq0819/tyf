<?php
header('content-type:text/html;charset=utf-8');

class SubinfoAction extends Action{
	
	public function index(){
		$this->display();
	}

	public function add(){
		$Form = D('subinfo');
		if($Form -> create()) {
			$result = $Form->add();
				if($result) {
					$this->success('您好，您的信息已成功提交，感谢您对团洋范的支持！');
				}else{
					$this->error('抱歉，您的信息提交失败！');
				}
		}else{
			$this->error($Form->getError());
		}
	}

}
?>