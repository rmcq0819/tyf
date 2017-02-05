<?php

class TextAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();
        //访问者控制
        if (!$this->visitor->is_login && in_array(ACTION_NAME, array('share_item', 'fetch_item', 'publish_item', 'like', 'unlike', 'delete', 'comment'))) {
            IS_AJAX && $this->ajaxReturn(0, L('login_please'));
            $this->redirect('user/login');
        }
    }

    /**
     * 商品详细页
     */
    public function index() {				
        $this->display();
    }
	
	public function da_an() {
		$str = $_GET["str"];
		$atpArr = M('article_page')->where("title like '%".$str."'")->select();
		if(count($atpArr) == 0) {
			echo json_encode(array("error"=>1));
			exit;
		}
		$atp = $atpArr[0];
		$arr = explode("|",$atp["tags"]);
		$rvArr = array();
		for ($i= 0;$i< count($arr); $i++){
			$id = $arr[$i];
			$itemEny = M("item")->where(array("id"=>$id))->find();
			if(!is_array($itemEny)) continue;
			array_push($rvArr,$itemEny);
		}
		echo json_encode(array("error"=>0,"data"=>$rvArr));
		exit;
	}

}