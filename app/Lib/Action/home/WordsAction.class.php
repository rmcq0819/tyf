<?php
class wordsAction extends frontendAction {

    public function index() {
	
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
	//生成验证码
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	public function saveWords() {
		$wordsM = M("words");
		if($_SESSION['verify'] != md5($_POST['yzm'])) {
		   $this->error('验证码错误！');
		}
		$data = array();
		$data["tel"] = $_POST["tel"];
		$data["words_txt"] = $_POST["words_txt"];
		$data["user_name"] = $_POST["user_name"];
		$data["email"] = $_POST["email"];
		$data["add_time"] = date('Y-m-d H:i:s',time());
		$result = $wordsM->add($data);
		if($result){
			//设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			$this->success('新增成功', 'index.php?m=words&a=show');
		 } else {
			//错误页面的默认跳转页面是返回前一页，通常不需要设置
			$this->error('新增失败');
		 }
	}
	
	    public function show() {
				
				$message= M('words');
				$messages= $message->field('add_time,words_txt')->order('id asc')->select();
					  
				$count=count($messages);//总数
				$page_size =5; //每页显示个数
				$pager = $this->_pager($count, $page_size);
				
				$messages =  $message->field('words_txt,add_time')->order('id desc')->limit($pager->firstRow . ',' . $page_size)->select();
				//print_r($messages);
				
				$this->assign('message',$messages);
				 //当前页码
				$p = $this->_get('p', 'intval', 1);
				$this->assign('p', $p);
				//当前页面总数大于单次加载数才会执行动态加载
				if (($count - ($p-1) * $page_size) > $spage_size) {
					$this->assign('show_load', 1);
				}
				//总数大于单页数才显示分页
				$count > $page_size && $this->assign('page_bar', $pager->fshow());
				//最后一页分页处理
				if ((count($message) + $page_size * ($p-1)) == $count) {
					$this->assign('show_page', 1);
				}

				//$this->assign('cate_name',$cate_info['name']);
				$this->assign('message',$messages);
	
				$this->display();
				
    }

}