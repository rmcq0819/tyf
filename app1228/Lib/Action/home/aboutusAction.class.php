<?php
class aboutusAction extends frontendAction {

    public function index() {
		$data['id']=$_GET['id'];
        $info = M('messages')->where($data)->find();
        $this->assign('list',$info);
        $this->assign('id',$id);
        $this->_config_seo();
        $this->display();
    }
	public function gonggao(){
        import('Think.ORG.Page');
    	$count = M('article')->where(array('status'=>'1'))->count();    
        $Page  = new Page($count,10);  
        $Page->setConfig('prev',"上一页");   
        $Page->setConfig('next','下一页');   
        $Page->setConfig('first','首页');   
        $Page->setConfig('last','尾页'); 
        $Page->setConfig('theme', " %downPage% ");//(对thinkphp自带分页的格式进行自定义)
        $limit = $Page->firstRow.','.$Page->listRows;
        $info=M('article')->where(array('status'=>'1'))->order('last_time desc')->limit($limit)->select();
        $show  = $Page->show();
        $this->assign('info', $info);
        $this->assign('page',$show);// 赋值分页输出
    	$this->assign('id', $id);
        $this->_config_seo();
    	$this->display();
    }
    public function newinfo(){
        
      $info=array();
      if ($id = $this->_get('newid', 'intval')) {
          $info=M('article')->where(array('id'=>$id))->find();
       }
       $this->assign('info', $info);
       $this->assign('id', $id);
       $this->_config_seo();
       $this->display();
    }
}