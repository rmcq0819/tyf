<?php
class IndexAction extends frontendAction {
/***********************************************************app接口-start****************************************************************/
	/*****首页广告***/
    public function ads(){
		
    	$ad= M('ad');
    	$ads= $ad->field('content')->where('board_id=1 and status=1')->order('ordid asc')->select();
		
		
		if(count($ads)>0){
			foreach($ads as $key=>$val){
				$content[] = "http://yooopay.com/data/upload/advert/".$val['content'];
			}
			$jsonArr['ads'] = $content;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		
		echo json_encode($jsonArr);
	}
	 
	/*****首页优惠券***/
    public function coupons(){
		$t = time();
		$start = mktime(10,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$end = mktime(18,0,0,date("m",$t),date("d",$t),date("Y",$t));
		if(time()>$start&&time()<$end){
			$coupon = M('coupon_templet');
			if(date('w')==0||date('w')==6){	//周末券面金额
				$coupon_templet = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,3'),'kind'=>1,'end_time'=>array('gt',time())))
										 ->limit('4')
										 ->order('is_recom asc')
										 ->field('id,disPrice,condition')
										 ->select();
			}else{
				$coupon_templet = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,2'),'kind'=>1,'end_time'=>array('gt',time())))
										 ->limit('4')
										 ->order('is_recom asc')
										 ->field('id,disPrice,condition')
										 ->select();
			}
				
			$t = time();
			$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
			$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
			//判断用户当天是否已领券
			$couIds = M('user_coupon')->where('add_time between '.$start.' and '.$end.' and userId = '.$this->visitor->info['id'])->field('couponId')->select();
			
			foreach($couIds as $key=>$val){
				$arr[] = $val['couponId'];
			}
			$jsonArr['couIds'] = $arr;
			$jsonArr['couTemplets'] = $coupon_templet;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	/***** 商品列表 ****/
	public function items(){
		$item = M('item');
		
		$pageRows=10; //每页条数
    	import('Think.ORG.Page');
		$where['home'] = 1;
		$where['a.status'] = 1;
		
		$join = "a left join __FLAG__ as b on a.countryId = b.id";
		$count = $item->join($join)->where($where)->count();
    	$Page  = new Page($count,$pageRows);
    	$limit = $Page->firstRow.','.$Page->listRows;
		$jsonArr['nowpage'] = isset($_GET['p'])?$_GET['p']:1;
		$jsonArr['totalpage'] =  ceil($count/$pageRows);
		$home_item = $item->join($join)
						  ->where($where)
						  ->field("a.title,a.id,a.cover,a.price,b.name,b.flag")
						  ->order('a.ordid asc')
						  ->limit($limit)
						  ->select();
		if(count($home_item)>0){
			foreach($home_item as $key=>$val){
				$home_item[$key]['cover'] = "http://yooopay.com/data/upload/item/".$val['cover'];
				$home_item[$key]['flag'] = "http://yooopay.com/data/upload/flag/".$val['flag'];
			}
			//$home_item[0]['cover'] = "http://yooopay.com/data/upload/item/1609/19/57dfabd891ee0.jpg";
			$jsonArr['items'] = $home_item;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		
		echo json_encode($jsonArr);
	}
	
	/***** 虚拟商品 ****/
	public function vitems(){
		$item = M('item');
		$home_vitem = $item->where('virtual_good = 1 and status = 1')
						  ->field("id,cover")
						  ->order('ordid asc')
						  ->select();
		if(count($home_vitem)>0){
			foreach($home_vitem as $key=>$val){
				$home_vitem[$key]['cover'] = "http://yooopay.com/data/upload/item/".$val['cover'];
			}
			$jsonArr['vItems'] = $home_vitem;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}

	/***** 获取分享相关信息 ****/
	public function shareInfo(){
		$userid = $_GET['shares'];//分享者ID
		$user = M('user')->where(array('id'=>$userid))->field('m_desc,merchant,cover,hyimg')->find();
		//判断是否对jsapi进行全局缓存
		
		if(F('jsapi')!==''){
			$jsapi['ticket']=F('jsapi');
		}else{ 
			//获取appid
			$setting = D('setting');
			$appid = $setting->where(array('name'=>'appid'))->find();
			$appid = $appid['data'];
			//获取appsecret
			$appsecret = $setting->where(array('name'=>'appsecret'))->find();
			$appsecret = $appsecret['data'];
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
			$data = json_decode($this->get_http($url),true);
			$access_token = $data['access_token'];
			//获取jsapi
			$url="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
			
			$jsapi = json_decode($this->get_http($url),true);
			F('jsapi',$jsapi['ticket']);
		}
		$time = time();
        $noncestr= $time;
        $jsapi_ticket= $jsapi['ticket'];
        $timestamp=$time;
		$url='http://yooopay.com/index.php?m=Index&a=index&shares='.$userid;  
        $and = "jsapi_ticket=".$jsapi_ticket."&noncestr=".$noncestr."&timestamp=".$timestamp."&url=".$url;
        $signature = sha1($and);
		
		
		//$jsonArr['timestamp'] = $timestamp;
		//$jsonArr['jsapi_ticket'] = $jsapi_ticket;
		//$jsonArr['signature'] = $signature;
		$jsonArr['url'] = $url;
		if($user['hyimg']==''){
			$jsonArr['imgUrl'] =  $user['cover'];
		}else{
			$jsonArr['imgUrl'] =  'http://yooopay.com'.$user['hyimg'];
		}
		$jsonArr['title'] = $user['merchant']."- 团洋范";
		$jsonArr['desc'] = $user['m_desc']."- 团洋范";
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
		
	}
/***********************************************************app接口-end****************************************************************/
	
	
    public function index() {
		
	    /****主页头部菜单*****/
    	//$wechatid = $_SESSION['wechatid'];
		$wechatid='oOejpwmlc8v7HpUMHxeDVSQHSUwU';

		
		//获取该商家的信息
		$shares = $_GET['shares'];
		if($shares){
			$info = M('user')->where('id='.$shares)->find();
			$this->assign('info',$info);    
			session('shopid',$shares);
		}
		
    	/*****首页广告***/
    	$ad= M('ad');
    	$ads= $ad->field('url,content,desc')->where('board_id=1 and status=1')->order('ordid asc')->select();//首页banner


    	/***** 商品列表 ****/
        $item = M('item');
        $home_item = $item->join("a left join __FLAG__ as b on a.countryId = b.id")
                          ->where('home = 1 and a.status = 1')
                          ->field("a.title,a.id,a.cover,a.price,b.name,b.flag")
						  ->order('a.ordid asc')
                          ->select();
        $this->assign('ad',$ads);
        $this->assign('home_item',$home_item);
		
		$u_openid = $_SESSION['u_openid'];
		$ret = M('user')->where("wechatid='".$u_openid."'")->getField('follownum');
		if($ret==1){
			$this->assign('ret',true);
			$ret = true;
		}else{
			$this->assign('ret',false);
			$ret = false;
		}
		
		
		
		//首页显示优惠券
		$t = time();
		$start = mktime(10,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$end = mktime(18,0,0,date("m",$t),date("d",$t),date("Y",$t));
		if(time()>$start&&time()<$end){
			$coupon = M('coupon_templet');
			if(date('w')==0||date('w')==6){	//周末券面金额
				$coupon_templet = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,3'),'kind'=>1,'end_time'=>array('gt',time())))
										 ->limit('4')
										 ->order('is_recom asc')
										 ->field('id,disPrice,condition')
										 ->select();
			}else{
				$coupon_templet = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,2'),'kind'=>1,'end_time'=>array('gt',time())))
										 ->limit('4')
										 ->order('is_recom asc')
										 ->field('id,disPrice,condition')
										 ->select();
			}
				
			$t = time();
			$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
			$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
			//判断用户当天是否已领券
			$couponIds = M('user_coupon')->where('add_time between '.$start.' and '.$end.' and userId = '.$this->visitor->info['id'])->field('couponId')->select();
			$couIds = array();
			foreach($couponIds as $key=>$val){
				$couIds[] = $val['couponId'];
			}
			$this->assign('couIds',$couIds);
			$this->assign('couTemplet',$coupon_templet);
			
		}
		
		
		$jsonArr = array();
		$jsonArr['ad'] = $ads;
		$jsonArr['couIds'] = $couIds;
		$jsonArr['couTemplet'] = $coupon_templet;
		$jsonArr['home_item'] = $home_item;
		$jsonArr['status'] = 1;
		//echo json_encode($jsonArr);
		$this->display();
    }

	

   /*  public function getItem($where = array(),$limit)
    {
    	$where_init = array('status'=>'1');
        $where =array_merge($where_init, $where);
    	if(empty($limit))
    	{
    		return $item=M('item')->where($where)->select();
    	}else{
    		return $item=M('item')->where($where)->limit($limit)->select();
    	}
    }
    
    //通过id获得父亲id
	public function about_navAjax() {
		$id = $_GET["id"];
		$pid = 0;
		
		$article_cate = M("article_cate");
		$where = array();
		$where["id"] = $id;
		$list = $article_cate->where($where)->select();
		$pid = $list[0]["pid"];
		echo $pid;
		exit;
	}
   
    public function ajaxLogin()
    {
    	
        $user_name=$_POST['user_name'];
       $password=$_POST['password'];
       
       $user=M('user');
       $users= $user->where("username='".$user_name."' and password='".md5($password)."'")->find(); 
	   $data = array('status'=>0);
       if(is_array($users))
       {
    	$data = array('status'=>1);
    	$_SESSION['user_info']=$users;
			//sail 登录成功之后,判断是否是从微信过来的,如果是从微信过来的,绑定微信号
			if(isset($_POST["wechatid"])) {
				$wechatid = $_POST["wechatid"];
				$UserM = M("User");
				$UserM->where(array("id"=>$users["id"]))->save(array("wechatid"=>$wechatid));
				//echo $UserM->getLastSql();exit;
			}
       }else {
       	$data = array('status'=>0);
       }
    	
    	echo json_encode($data);
    	exit;
    }
    public function ajaxRegister()
    {
    	$username=$_POST['user_name'];
    	$user=M('user');
    	$count=$user->where("username='".$username."'")->find();
    	if(is_array($count))
    	{
        echo 'false';
       // echo json_encode(array('user_nameData'=>true));
    	}else 
    	{
    		echo 'true';
        //echo json_encode(array('user_nameData'=>true));
    	}
    	
    
    }
    
    public function sharecheck(){
    	$share_name = addslashes(trim($_POST['share_name']));
    	$shareuser = D('user')->where(array('username'=>$share_name))->find();
    	if($shareuser){
    		echo 1;
    	}else{
    		echo 0;
    	}
    } */
}