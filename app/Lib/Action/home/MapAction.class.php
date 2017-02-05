<?php
class MapAction extends frontendAction {
    
    public function index() {
		$jingdu = $_GET["jingdu"];
		$weidu = $_GET["weidu"];
		$this->assign("jingdu",$jingdu);
		$this->assign("weidu",$weidu);
        $this->display();
    }
    
}