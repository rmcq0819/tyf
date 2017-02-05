<?php
class serveAction extends frontendAction {

    public function index() {
	
		/*****首页广告***/
    	$serve= M('ad');
    	$adserve= $serve->field('url,content,desc')->where('board_id=5 and status=1')->order('ordid asc')->select();
        $this->assign('serve',$adserve);
		
        $id = $this->_get('id', 'intval');
        !$id && $this->redirect('index/index');
        $info = M('article_page')->find($id);
        $this->assign('info', $info);
        $this->assign('id', $id);
		
		/*单页列表*/
		$cid = $info['cate_id'];
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
	
	public function saveserve() {
		$wordsM = M("serve");
		$data = array();
		$data["user_name"] = $_POST["user_name"];
		$data["sex"] = $_POST["sex"];
		$data["tel"] = $_POST["tel"];
		$data["adress"] = $_POST["adress"];
		$data["s_date"] = $_POST["s_date"];
		$data["s_datetime"] = $_POST["s_datetime"];
		$data["goods"] = $_POST["goods"];
		$data["add_time"] = date('Y-m-d H:i:s',time());
		$result = $wordsM->add($data);
		if($result){
			//设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			$this->success('新增成功', 'index.php?m=serve&a=index&id=27');
		 } else {
			//错误页面的默认跳转页面是返回前一页，通常不需要设置
			$this->error('新增失败');
		 }
	}

    public function flink() {
        $this->_config_seo();
    	$this->display();
    }
}