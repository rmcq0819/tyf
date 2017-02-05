<?php
class ArticleAction extends frontendAction {
	
	public function index(){
		$data['status'] = 1;
		$list = M('article')->where($data)->select();
		$this->assign('list',$list);
		$this->display();
	}
    public function cate() {
       $cid = $this->_get('cid', 'intval');
       !$cid && $this->_404();
	   
	   //分类数据
       $cate_info = M('article_cate')->where(array("id"=>$cid))->find();
              
		$item=M('article');
		$where['cate_id']=array('eq',$cid);
		$where['status']=array('eq',1);
		$items=  $item->field('id,title,img,intro,add_time')->order('id desc')->where($where)->select();

        $this->assign('cate_name',$cate_info['name']);
		$this->assign('item_list',$items);
        $this->display();
    }
	public function show() {
       $id = $this->_get('id', 'intval');
       !$id && $this->_404();
       
	   $info = M('article')->find($id);
		$this->assign('info', $info);
		$this->assign('id', $id);
		$this->_config_seo();
		$this->display();
	}
	public function listcate() {
		//获取分类
		$where['pid'] = 1;
		$where['status']=array('eq',1);
	    $cate_info = M('article_cate')->order('id desc')->where($where)->select();
		
		$this->assign('art_list', $cate_info);
		$this->_config_seo();
		$this->display();
	}

}