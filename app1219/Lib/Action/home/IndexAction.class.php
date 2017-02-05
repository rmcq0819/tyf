<?php
class IndexAction extends frontendAction {

    /************************
     *   首页信息展示
     *   index()方法
     *   @author  May
     *   date    2016-07-19      
     ************************/
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
                          ->field("a.title,a.id,a.cover,a.price,b.name,b.flag,a.activity,a.aprice")
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
		$item_likeMd = M('item_like');
        $where['uid'] = $this->visitor->info['id'];
        $item_likeArr = $item_likeMd->where($where)->order('add_time DESC')->field('item_id')->select();
		foreach($item_likeArr as $key=>$val){
			$likeIds[] = $val['item_id'];
		}
		
		$this->assign('likeIds',$likeIds);
		/*
		//中奖信息
		$lottery = array(array('msg'=>'恭喜李*霞获得iphone7颜色随机1部','st'=>1475287261,'et'=>1475337599),
						 array('msg'=>'恭喜徐*获得iphone7颜色随机1部','st'=>1475377321,'et'=>1475423999),
						 array('msg'=>'恭喜赵*娥获得iphone7颜色随机1部','st'=>1475449321,'et'=>1475510399),
						 array('msg'=>'恭喜王*利获得iphone7颜色随机1部','st'=>1475553721,'et'=>1475596799),
						 array('msg'=>'恭喜陈*华获得iphone7颜色随机1部','st'=>1475654521,'et'=>1475683199),
						 array('msg'=>'恭喜李*获得iphone7颜色随机1部','st'=>1475737321,'et'=>1475769599),
						 array('msg'=>'恭喜陈*获得iphone7颜色随机1部','st'=>1475823955,'et'=>1475855999)
						);
		$now = time();
		foreach($lottery as $key=>$val){
			if($now>$val['st']&&$now<$val['et']){
				$this->assign('msg',$val['msg']);
				break;
			}
		}
		*/
		
		//新注册的店长第一次打开首页弹窗提示
		$remwhere['uid'] = array('neq',4);
		$remwhere['remind'] = array('eq',0);
		$remwhere['id'] = array('gt',50000);
		$remwhere['id'] = $this->visitor->info['id'];
		$is_remind = M('user')->where($remwhere)->select();
		if(count($is_remind) > 0){
			M('user')->where($remwhere)->setField('remind',1);
			$this->assign('remind',1);
			$this->assign('remuid',$this->visitor->info['id']);
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
										 ->select();
			}else{
				$coupon_templet = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,2'),'kind'=>1,'end_time'=>array('gt',time())))
										 ->limit('4')
										 ->order('is_recom asc')
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
		
        $this->_config_seo();
        $this->display();
    }
	
	public function public_ben(){
		$this->display();
	}

	//清除红包领取状态
	public function clear_status(){
		$where['is_give'] = 1;
		$data['is_give'] = 0;
		$is_succ = M('messagelist')->where($where)->save($data);
		if($is_succ){
			echo "红包领取状态已初始化！";
		}else{
			echo "没有符合条件的条目！";
		}
	}
	
	public function redbag_give(){
		parent::activity_end();
		$uid = $this->visitor->info['id'];
		$iwhere['recom'] = $uid;
		$iwhere['is_give'] = 1;
		$insr  = M('messagelist')->where($iwhere)->find();
		//活动是否开始
		$is_start = M('user')->where(array('id'=>23629))->field('is_start')->find();
		if($insr){
			$is_give = 1;
		}
		$this->assign('is_give',$is_give);
		$this->assign('is_start',$is_start['is_start']);
		$this->display();
	}
	
	public function redbag_givedo(){
		if(IS_POST){
			$uid = $this->visitor->info['id'];
			$points = $this->_post('points','trim'); //随机的范票张数
			$data['user_id'] = $_SESSION['shopid'];
			$data['recom'] = $uid; //用户id
			$data['type'] = 8; //红包奖励积分
			$data['order_id'] =0; //订单id
			$data['time'] = time();
			$data['status'] = 0; // 默认未读状态
			$data['points'] = $points;
			$data['is_give'] = 1; //是否已经获取了赠送的红包
			//判断重复写入
			$iwhere['recom'] = $uid;
			$iwhere['is_give'] = 1;
			$insr = M('messagelist')->where($iwhere)->find();
			if(!$insr){
				if(M('messagelist')->add($data)){
					M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$points);
				}
			}
		}
   }

    public function getItem($where = array(),$limit)
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
		
		//
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
    }
}