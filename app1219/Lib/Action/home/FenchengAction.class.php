<?php
class fenchengAction extends frontendAction
{
	/*推荐分成*/
	 public function index() {
	 	
		$fengchenglv = M('user_fengchenglv')->order('id asc')->select();
		$this->assign('fengchenglv', $fengchenglv);
        $this->_config_seo();
        $this->display();
    }
	
}
?>