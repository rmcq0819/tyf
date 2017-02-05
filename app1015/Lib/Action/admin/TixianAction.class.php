<?php

class TixianAction extends backendAction {
	
	public function index(){

		if (IS_POST) {
			$tx=$_POST['tx'];
			if ($tx){
				$data['tx_money']=$tx['money'];
				$data['tx_djq']=$tx['djq'];
				$data['tx_set']=$tx['set'];
				$res=M('set')->where(array('id'=>1))->save($data);
				if ($res!==false) {
					$this->success('更新成功!',U('Tixian/index'));
				}else{
					$this->error('更新失败!');
				}		
			}
		}else{
			$res=M('set')->where(array('id'=>1))->find();
			$this->assign('tx',$res);
			$this->display();
		}
		

	}


}