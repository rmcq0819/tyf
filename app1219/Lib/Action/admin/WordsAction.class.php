<?php

class WordsAction extends backendAction{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('words');
    }
    
    public function index(){
		$res = $this->_mod->order('id desc')->select();
		$count =count($res);
        $pager = new Page($count,20);
        $list=array_slice($res, $pager->firstRow,$pager->listRows);
        $page = $pager->show();
        $this->assign("page", $page);
        $this->assign('list', $list);
		$this->display();
    }
}