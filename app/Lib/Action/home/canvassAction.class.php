<?php
class canvassAction extends frontendAction {

    public function index() {
	
		/*****首页广告***/
    	$serve= M('ad');
    	$adserve= $serve->field('url,content,desc')->where('board_id=6 and status=1')->order('ordid asc')->select();
        $this->assign('serve',$adserve);
		
        $id = $this->_get('id', 'intval');
		//echo $id;
        !$id && $this->redirect('index/index');
        $info = M('article_page')->find($id);
		//print_r($info);
        $this->assign('info', $info);
        $this->assign('id', $id);
		
		/*单页列表*/
		$cid = $info['cate_id'];
		//echo $cid;
		$li = M('article_cate')->find($cid);
		$this->assign('li', $li);
		
		$cid_id = $li['pid'];
		
		$cid_li= M('article_cate');
		$where['pid']=$cid_id;
		$where['type']=1;
    	$serve_li= $cid_li->field('id,name')->where($where)->order('ordid asc')->select();
		//echo $cid_li->getLastSql();
		//print_r($cid_li);
		
		$this->assign('cid_li',$serve_li);
		
        $this->_config_seo();
        $this->display();
		
    }

    public function flink() {
        $this->_config_seo();
    	$this->display();
    }
}