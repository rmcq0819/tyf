<?php

class ItemAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();
		   $this->_mod = D('user');
			//访问者控制
			/*if(!session('?oauth2cache')){
			$wxpay=M('pay')->where(array('pay_type'=>'wxpay'))->find();
				   if($wxpay){
					   redirect(U('wxoauth/index',array('mod'=>'wechat')));                           
				   }
			}*/
			$user = D('user')->where(array('id' => $this->visitor->info['id']))->find();
		  //echo M()->getLastSql();exit;
		   $this->assign('visitor',$user);
    }
    
 
    /************************
     *   商品分类列表
     *   itemcate()方法
     *   @author  May
     *   date    2016-07-19      
     ************************/
	 
	
	 public function bargain(){
		 $this->error('活动已结束！');
		 exit;
		 $where['status'] = 1;
		 $where['is_bargain'] =	1;
		 $itemlist = M('item')->where($where)->select();
		 
		 $this->assign('itemlist',$itemlist);
		 //当前用户id
		 $this->assign('active_uid',$this->visitor->info['id']);
		 $this->display();
	 }
		
	/***** 商品详情收藏商品*****/
	public function shou_cang() {
		$id = $this->_get('id', 'intval');
		//先检查这个id号对应的item是否存在
		$itemMd = M('item');
		$item = $itemMd->where(array('id' => $id))->find();
		if(!$item) {
			echo json_encode(array("status"=>0,"msg"=>"商品不存在"));
			exit;
		}
 		
		$uid = $this->visitor->info['id'];
		$item_likeMd = M('item_like');
		$is_liked = $item_likeMd->where(array('item_id' => $item['id'], 'uid' => $uid))->count();
		if($is_liked!= 0) {
			$item_likeMd->where(array('item_id' => $item['id'], 'uid' => $uid))->delete();
			echo json_encode(array("status"=>0,"msg"=>"取消收藏成功"));
			exit;
		}else{
			$item_likeMd->add(array('item_id'=>$item['id'], 'uid'=>$uid, 'add_time'=>time()));
			echo json_encode(array("status"=>1,"msg"=>"添加收藏成功"));
		}
	} 
	 
	/***** 商品详情页商品参数*****/
	public function itemparams(){
		$id = $this->_get('id', 'intval');
		$item_mod=M('item');
		$item = $item_mod->field('id,title,adress,itemtype,yhprice,price,goods_stock,buy_num,img,size,size_imgs,countryId')
						 ->where(array('id' => $id, 'status' => 1))
						 ->find();
						 
		if($item){
			$arr['id'] = $item['id'];
			$arr['title'] = $item['title'];
			$arr['buy_num'] = $item['buy_num'];
			$arr['itemtype'] = $item['itemtype'];
			$arr['price'] = $item['price'];
			$arr['img'] = $item['img'];
			if($item['countryId']>0){
				$arr['address'] = M('flag')->where(array('Id'=>$item['countryId']))->getField('name');
			}
			$jsonArr['status'] = 1;
			if($item['size']){
				$price=explode('|',$item['yhprice']);
				$goods_stock=explode('|',$item['goods_stock']);
				$size=explode('|',$item['size']);
				$size_imgs = explode('|',$item['size_imgs']);
			
			/* 	foreach($size_imgs as $key=>$val){
					$size_imgs[$key] = "http://yooopay.com/data/upload/item_size/".$val;
				} */
				$arr['stock'] = $goods_stock[0];
				$arr['size_imgs'] = $size_imgs;
				$arr['size_price'] = $price;
				$arr['goods_stock'] = $goods_stock;
				$arr['size'] = $size;
				
				$jsonArr['sz'] = 1;
			}else{
				$arr['stock'] = $item['goods_stock'];
				$arr['size_imgs'] = '';
				$arr['size_price'] = '';
				$arr['goods_stock'] = '';
				$arr['size'] = '';
				$jsonArr['sz'] = 0;
			}
			$jsonArr['item'] = $arr;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}  

     public function itemcate() {
    	$icate = M('item_cate');
        $item = M('item');

    	//父级分类
    	$itemcate = $icate->field('id,name')->where(array('status' => 1,'pid' => 0))->order(array('ordid'=>'asc'))->select();	
		
		
		//子级分类
		if(!isset($_SESSION['page'])){
			$_SESSION['page'] = 'first';
		}
		if(isset($_GET['pid'])){
			$pid = $_GET['pid'];
			$_SESSION['page'] = 'first';
		}else{
			$pid = $itemcate[1]['id'];
		}
        
        $sub_itemcate = $icate->where(array('status' => 1,'pid' => $pid))->field('id,name,img')->order(array('ordid'=>'asc'))->select();
		$arr = array();
		foreach($sub_itemcate as $key => $val){
			$arr[] = $val['id'];
		}
		
		$sub_name = $icate->where(array('status' => 1,'id'=>$pid))->find();
		$this->assign('sub_name',$sub_name);
       
		$itembanner = $icate->where(array('status' => 1,'id' =>$pid))->find();
        $this->assign('itembanner',$itembanner['img']);
        $sub_pid = isset($_GET['sub_pid'])?$_GET['sub_pid']:$sub_itemcate[0]['id'];

        $keyword = $this->_get('keyword','trim');
         if(is_null($keyword)){
             //子级分类商品
            $where = array('status' => 1,'cate_id' => $sub_pid);    
        }else{
			
			$search_where = array('keyword' => array('like','%'.$keyword.'%')); 
			$search_ret = M('search')->where($search_where)->select();
			foreach($search_ret as $key => $val){
				$data['num'] = $val['num']+1;
				M('search')->where('id = '.$val['Id'])->save($data);
			}
			
            //模糊查询商品
            $where = array('status' => 1,'title' => array('like','%'.$keyword.'%')/*,'cate_id' => $sub_pid*/);
            $pid = 66;
            $sub_pid = 66;

        }
		if(!isset($_SESSION['page'])){
			$_SESSION['page'] = 'first';
		}
		
		//热门推荐
		if(count($arr)>0){
			$iwhere['cate_id'] = array('in',$arr);
		}
		$iwhere['status'] = 1;
		$recoms = M('item')->where($iwhere)->field('id,img,price,buy_num,ordid')->order('ordid asc')->limit('6')->select();
		$this->assign('recoms',$recoms);
		$fwhere['status'] = 1;
		$countrys = M('flag')->field('Id,bg_img,name')->where($fwhere)->order('ordid asc')->select();
		$this->assign('countrys',$countrys);
		
		$this->assign('keyword',$keyword);
        $this->assign('sub_itemcate',$sub_itemcate);
        $this->assign('pid',$pid);
        $this->assign('sub_pid',$sub_pid);
		$this->assign('itemcate',$itemcate);
    	$this->display();
    }
	/**
     * 卖家中心入口  在售商品   2016-07-13 Modify By Liuyumei
     */
    public function onitemlist() {

        $status=isset($_GET['status'])?$_GET['status']:1;//默认是排序设置
        $act=isset($_GET['act'])?$_GET['act']:'jj';
		$uid = $this->visitor->info['uid'];
		if($uid == 2){
			$fc = 0.80;
		}elseif($uid == 3){
			$fc = 0.60;
		}else{
			$fc = 0.20;
		}

    	
    	$ads = M('ad')->field('url,content,desc')->where('board_id=4 and status=1')->order('ordid asc')->find();//顶部banner

        $pageRows=6; //每页条数
    	import('Think.ORG.Page');

        $keyword=$_GET['keyword'];
        $cate_id=$_GET['cate_id'];

        $where=array('status'=>1);   //查询条件控制
        if($keyword!=NULL){
            $where=array('status'=>1,'title'=>array('like','%'.$keyword.'%'));
        }
        if($cate_id!=NULL){
            $where=array('status'=>1,'cate_id'=>$cate_id);
        }

    	$count = M('item')->where($where)->count();
    	$Page  = new Page($count,$pageRows);
    	$Page->setConfig('theme', " %downPage% ");
    	$limit = $Page->firstRow.','.$Page->listRows;
       

        $itemcate = M('item_cate')->where('status=1')->order(array('ordid,add_time'=>'desc'))->select();
        $this->assign('itemcatelist',$itemcate);
        //$itemlist = M('item')->where($where)->order(array('ordid','add_time'=>'desc'))->limit($limit)->select();
        $itemlist = M('item')->where($where)->order(array('(price-cost)*fencheng'=>'desc'))->limit($limit)->select();
    	//计算每个商品的“零售奖金”
    	foreach($itemlist AS $key=>$val) {
    		
    		$cost = explode('|', $val['cost']);
    		$fcprice = round(($val['price']-$cost[0])*$fc,2);
    		array_push($itemlist[$key],$fcprice);	
    	}
    	/*dump($itemlist);
        exit;*/
        if($act=='pri'&&$status==0) {

            $flag=array();
            foreach($itemlist as $arr2){
                $flag[]=$arr2['price'];
            }
            array_multisort($flag, SORT_ASC, $itemlist);
            $list = $itemlist;
    
        }elseif($act=='pri'&&$status==1) {
            
            $flag=array();
            foreach($itemlist as $arr2){
                $flag[]=$arr2['price'];
            }
            array_multisort($flag, SORT_DESC, $itemlist);
            $list = $itemlist;
            
        }elseif($act=='jj'&&$status==0) {
            
            $flag=array();
            foreach($itemlist as $arr2){
                $flag[]=$arr2[0];
            }
            array_multisort($flag, SORT_ASC, $itemlist);
            $list = $itemlist;
            
        }elseif($act=='jj'&&$status==1) {
            
            $flag=array();
            foreach($itemlist as $arr2){
                $flag[]=$arr2[0];
            }
            array_multisort($flag, SORT_DESC, $itemlist);
            $list = $itemlist;
            
        }
        
    	
        $nowpage=isset($_GET['p'])?$_GET['p']:1;
        $this->assign('first',1);
        $this->assign('now',$nowpage);
        $this->assign('last', ceil($count/$pageRows));
        $this->assign('kw',$keyword);
        $this->assign('cid',$cate_id);
    	$this->assign('ad',$ads);
    	$this->assign('itemlist',$list);

    	$this->assign('status',$status);
    	$this->display();
    	
    }
	
	/**
     * 在售商品排序
     */
    public function ongoodsList() {
    	
    	$status = $this->_get('status');
    	$act = $this->_get('act');
    	
    	//组合零售奖金数组
    	$itemlist = M('item')->where(array('status'=>1))->select();
    	 
    	//计算每个商品的“零售奖金”
    	foreach($itemlist AS $key=>$val) {
    	
    		$cost = explode('|', $val['cost']);
    		$fcprice = ($val['price']-$cost[0])*$val['fencheng'];
    		array_push($itemlist[$key],$fcprice);
    	
    	}
    	
    	if($act=='pri'&&$status==0) {

    		$flag=array();
    		foreach($itemlist as $arr2){
    			$flag[]=$arr2['price'];
    		}
    		array_multisort($flag, SORT_ASC, $itemlist);
    		$list = $itemlist;
  	
    	}elseif($act=='pri'&&$status==1) {
    		
    		$flag=array();
    		foreach($itemlist as $arr2){
    			$flag[]=$arr2['price'];
    		}
    		array_multisort($flag, SORT_DESC, $itemlist);
    		$list = $itemlist;
    		
    	}elseif($act=='jj'&&$status==0) {
    		
    		$flag=array();
    		foreach($itemlist as $arr2){
    			$flag[]=$arr2[0];
    		}
    		array_multisort($flag, SORT_ASC, $itemlist);
    		$list = $itemlist;
    		
    	}elseif($act=='jj'&&$status==1) {
    		
    		$flag=array();
    		foreach($itemlist as $arr2){
    			$flag[]=$arr2[0];
    		}
    		array_multisort($flag, SORT_DESC, $itemlist);
    		$list = $itemlist;
    		
    	}
    	
    	if($list) {
    		 
    		echo json_encode($list);
    		 
    	}else {
    		 
    		echo "0";
    		 
    	}
    	
    }
    
    /**
     * 商品列表
     */
    public function itemlist() {

    	$cate_id = $this->_get('cate_id','intval');	        //分类ID
		$countryId = $this->_get('countryId','intval'); //国家ID
		$keyword = $this->_get('keyword','trim');     //关键词
		$keyword1 = $this->_get('keyword1','trim');     //关键词
		
		$this->assign('keyword',$keyword);
		$this->assign('countryId',$countryId);
		$this->assign('cate_id',$cate_id);
		$_SESSION['page'] = 'first';
		
		$where['status'] = 1;
		if($cate_id){
			$where['cate_id'] = $cate_id;
			$detail_title = M('item_cate')->where('id = '.$cate_id)->getField('name');  //获取分类名称
		}
		if($keyword){
			$where['title'] = array('like','%'.$keyword.'%');
			$detail_title = $keyword;
			$content_keyword = array();//1.创建一个数组
            
            $_SESSION['shares_id'] = $_GET['shares'];

            $content_keyword[] = urlencode($keyword); //2.对接受到的ID插入到数组中去


            if(isset($_COOKIE['content_keyword'])) //3.判定cookie是否存在,第一次不存在(如果存在的话)
            {
                $now_content = str_replace("\\", "", $_COOKIE['content_keyword']);//(4).您可以查看下cookie,此时如果unserialize的话出问题的,我把里面的斜杠去掉了
                $now = unserialize($now_content); //(5).把cookie 中的serialize生成的字符串反实例化成数组
                foreach($now as $n=>$w) { //(6).里面很多元素,所以我要foreach 出值
                    if(!in_array($w,$content_keyword)) //(7).判定这个值是否存在,如果存在的化我就不插入到数组里面去;
                    {
                        $content_keyword[] = $w; //(8).插入到数组
                    }
                }
                $content= serialize($content_keyword); //(9).把数组实例化成字符串
                setcookie("content_keyword",$content, time()+3600*7); //(10).插入到cookie
            }else {
                $content= serialize($content_keyword);//4.把数组实例化成字符串
                setcookie("content_keyword",$content, time()+3600*7); //5.生成cookie
            }
            $getcontent = unserialize(str_replace("\\", "", $_COOKIE['content_keyword']));
            if(count($getcontent)<7){
                cookie('search_history',$getcontent,3600*7); // 指定cookie保存时间
            }
		}
		if($keyword1){
			$where['title'] = array('like','%'.$keyword1.'%');
			$detail_title = $keyword1;
			$_SESSION['page'] = 'second';
			$content_keyword = array();//1.创建一个数组
            
            $_SESSION['shares_id'] = $_GET['shares'];

            $content_keyword[] = urlencode($keyword1); //2.对接受到的ID插入到数组中去


            if(isset($_COOKIE['content_keyword'])) //3.判定cookie是否存在,第一次不存在(如果存在的话)
            {
                $now_content = str_replace("\\", "", $_COOKIE['content_keyword']);//(4).您可以查看下cookie,此时如果unserialize的话出问题的,我把里面的斜杠去掉了
                $now = unserialize($now_content); //(5).把cookie 中的serialize生成的字符串反实例化成数组
                foreach($now as $n=>$w) { //(6).里面很多元素,所以我要foreach 出值
                    if(!in_array($w,$content_keyword)) //(7).判定这个值是否存在,如果存在的化我就不插入到数组里面去;
                    {
                        $content_keyword[] = $w; //(8).插入到数组
                    }
                }
                $content= serialize($content_keyword); //(9).把数组实例化成字符串
                setcookie("content_keyword",$content, time()+3600*7); //(10).插入到cookie
            }else {
                $content= serialize($content_keyword);//4.把数组实例化成字符串
                setcookie("content_keyword",$content, time()+3600*7); //5.生成cookie
            }
            $getcontent = unserialize(str_replace("\\", "", $_COOKIE['content_keyword']));
            if(count($getcontent)<7){
                cookie('search_history',$getcontent,3600*7); // 指定cookie保存时间
            }
		}
		if($countryId){
			$where['countryId'] = $countryId;
			$detail_title = M('flag')->where('Id = '.$countryId)->getField('name');  //获取国家名称
			$_SESSION['page'] = 'second';
		}
		
		
		$condition = isset($_GET['condition'])?$this->_get('condition','trim'):'all_round';
		
		$order = 'ordid asc';
		if($condition == 'sales_desc'){
			$order = 'buy_num desc';
			$item_status = 1;
		}
		if($condition == 'sales_asc'){
			$order = 'buy_num asc';
			$item_status = 2;
		}
		if($condition == 'price_desc'){
			$order = 'price desc';
			$item_status = 3;
		}
		if($condition == 'price_asc'){
			$order = 'price asc';
			$item_status = 4;
		}
		if($condition == 'itemtype_0'){
			$where['itemtype'] = 0;
			$item_status = 5;
		}
		if($condition == 'itemtype_1'){
			$where['itemtype'] = 1;
			$item_status = 6;
		}
		if($condition == 'new'){
			$order = 'add_time desc';
			$item_status = 7;
		}
		
		if($condition == 'more'){
			$_SESSION['page'] = 'second';
			$flags = M('flag')->where('status = 1')->field('id')->select();
			$arr = array();
			foreach($flags as $key => $val){
				$arr[] = $val['id'];
			}
			$where['countryId'] = array('not in',$arr);
			$detail_title = '其他';
		}
		
		
		//购物车价格及数量
		$ret=M('cart')->where(array('uid' => $this->visitor->info['id'],'shopid' => session('shopid')))->select();
		$cart_count = 0;
		$cart_price = 0;
		foreach($ret as $key => $val){
			$cart_count += $val['num'];
			$cart_price += $val['num']*$val['price'];
		}
		
		$this->assign('cart_count',$cart_count);
		$this->assign('cart_price',$cart_price);
		
		$this->assign('item_status',$item_status);
		$this->assign('detail_title',$detail_title);
		$items=M('item')->where($where)->order($order)->select();
        $this->assign('itemcount',count($items));
		$this->assign('items',$items);
		
		$this->assign('pid',$_GET['pid']);
    	$this->display();
    }
    
    /**
     * 获取相应状态值的商品列表
	 *@param cate_id 商品分类ID
	 *@param sta 商品状态值
     */
    public function goodsList() {
    	
    	$cate_id = $this->_get('cate_id','intval');
    	$sta = $this->_get('sta');
    	//请求类型：0属于分类请求，1属于全部请求
    	$type = $this->_get('type','intval');
    	//请求类型：0属于保税商品请求，1属于完税商品请求
    	//$itemtype = $this->_get('itemtype','intval');
    	
    	if($sta=='m') {	//按人气
    		
    		if($type==0) {
    			$list = M('item')->where('status=1 AND cate_id='.$cate_id)->order('moods desc')->select();
    		}elseif($type==1) {
    			$list = M('item')->where('status=1')->order('moods desc')->select();
    		}elseif($type==2) {	
    			$list = M('item')->where('status=1 AND itemtype=0')->order('moods desc')->select();	
    		}elseif($type==3) {
    			$list = M('item')->where('status=1 AND itemtype=1')->order('moods desc')->select();	
    		}
    		 		
    	}elseif($sta=='t') { //按时间
    		
    		if($type==0) {
    			$list = M('item')->where('status=1 AND cate_id='.$cate_id)->order('add_time desc')->select();
    		}elseif($type==1) {
    			$list = M('item')->where('status=1')->order('add_time desc')->select();
    		}elseif($type==2) {	
    			$list = M('item')->where('status=1 AND itemtype=0')->order('add_time desc')->select();	
    		}elseif($type==3) {
    			$list = M('item')->where('status=1 AND itemtype=1')->order('add_time desc')->select();		
    		}  		
    		
    	}elseif($sta=='pasc') { //按价格ASC
    		
    		if($type==0) {
    			$list = M('item')->where('status=1 AND cate_id='.$cate_id)->order('price asc')->select();
    		}elseif($type==1) {
    			$list = M('item')->where('status=1')->order('price asc')->select();
    		}elseif($type==2) {	
    			$list = M('item')->where('status=1 AND itemtype=0')->order('price asc')->select();	
    		}elseif($type==3) {
    			$list = M('item')->where('status=1 AND itemtype=1')->order('price asc')->select();	
    		}

    		
    	}elseif($sta=='pdesc') { //按价格DESC
    		
    		if($type==0) {
    			$list = M('item')->where('status=1 AND cate_id='.$cate_id)->order('price desc')->select();
    		}elseif($type==1) {
    			$list = M('item')->where('status=1')->order('price desc')->select();
    		}elseif($type==2) {	
    			$list = M('item')->where('status=1 AND itemtype=0')->order('price desc')->select();	
    		}elseif($type==3) {
    			$list = M('item')->where('status=1 AND itemtype=1')->order('price desc')->select();	
    		}		
    		
    	}elseif($sta=='s') { //按销量
    		
    		if($type==0) {
    			$list = M('item')->where('status=1 AND cate_id='.$cate_id)->order('buy_num desc')->select();
    		}elseif($type==1) {
    			$list = M('item')->where('status=1')->order('buy_num desc')->select();
    		}elseif($type==2) {	
    			$list = M('item')->where('status=1 AND itemtype=0')->order('buy_num desc')->select();	
    		}elseif($type==3) {
    			$list = M('item')->where('status=1 AND itemtype=1')->order('buy_num desc')->select();	
    		} 		
    		
    	}
    	
       	if($list) {
    		 
    		echo json_encode($list);
    		 
    	}else {
    		 
    		echo "0";
    		 
    	}
    	
    }
	
    /**
     * 商品+分类搜索
     */
    public function itemsearch() {
    	
    	$keyword = $this->_get('keyword');
    	$where['title'] = array('like','%'.$keyword.'%');
    	$where['status'] = 1;
    	$itemlist = M("item")->where($where)->limit(10)->select();
    	if($itemlist){
    			
    		echo json_encode($itemlist);
    			
    	}else{
    			
    		echo 0;
    			
    	}
    	
    }
    public function catesearch() {
    	
    	$keyword = $this->_get('keyword');
    	$where['name'] = array('like','%'.$keyword.'%');
    	$where['status'] = 1;
    	$catelist = M("item_cate")->where($where)->select();
    	if($catelist){
    		 
    		echo json_encode($catelist);
    		 
    	}else{
    		 
    		echo 0;
    		 
    	}
    	
    }
       
    /**
     * 商品详细页
     */
    public function index() {
		
		if($this->_get('page') == 'page'){
			$_SESSION['page'] = 'first';
			$this->assign('page','first');
		}
		
        $id = $this->_get('id', 'intval');
		//判断分享链接是否带有商家参数
		$shares = $this->_get('shares', 'intval');
		$login_days = M('user')->where(array('id'=>$shares))->find();
		$this->assign('login_days',$login_days);
		if(empty($shares)){
			$this->error('系统无法获取该链接的商家信息，无法继续操作，您可以重新向链接分享者获取链接！');
		}else{
			$info = M('user')->where('id='.$shares)->find();
			if(!$info){
				$this->error('没有找到该商家的相关信息！');
			}elseif($info['uid'] ==4){
				$this->error('该链接分享者等级为消费者，无法继续操作！');
			}
		}
		
		$ret=M('cart')->where('uid = '.$this->visitor->info['id'])->select();
		$this->assign('cart_count',count($ret));
		
        !$id && $this->_404();
		$item_mod = M('item');
		$item = $item_mod->field('id,cate_id,title,adress,img,itemtype,intro,yhprice,price,activity,is_combo,aprice,priceyuan,info,comments,zuzhuang,add_time,goods_stock,buy_num,brand,size,size_imgs,color,cs,cost,countryId,itemtype,baseid,is_stock,is_bargain,is_fictitious,sale_quantity')->where(array('id' => $id, 'status' => 1))->find();
		$this->assign('activityPrice',$item['aprice']);
		!$item && $this->_404();
		if($item['size']){
			$price=explode('|',$item['yhprice']);
			$aprice=explode('|',$item['aprice']);
			$goods_stock=explode('|',$item['goods_stock']);
			$size=explode('|',$item['size']);
			$cost=explode('|',$item['cost']);
			$size_imgs = explode('|',$item['size_imgs']);
			$this->assign('size_imgs',$size_imgs);
			$this->assign('price',$price);
			$this->assign('aprice',$aprice);
			$this->assign('activityPrice',$aprice[0]);
			$this->assign('goods_stock',$goods_stock);
			$this->assign('size',$size);
		}else{
			$cost = $item['cost'];
		}
		$this->assign('cost',$cost);
		
		$this->assign('huiyuanid',$this->visitor->info['id']);
		
		//未到活动时间
		$satime = strtotime('2016-12-26 00:00:00');
		$eatime = strtotime('2016-12-29 00:00:00');
		if(time()<$satime||time()>$eatime){
			$item['activity'] = 0;
		}
		
		//会员分组
		if($this->visitor->info){
            $cuid=$this->visitor->info['id'];
			$users =M('user')->where(array('id' =>$cuid))->find();
			$pid = $users['uid'];
            if ($pid==3) {
                $lv=$users['uid_lv'];
                $user_category =M('user_category')->field('discount,id,name,score')->where(array('id' =>$pid))->find();
                $discount=explode("|",$user_category['discount']);
                $zc=$discount[$lv-1];
                $item['yhprice']=$item['yhprice']*($zc/100);
            }
			$this->assign('users', $users);
			$this->assign('user_category', $user_category);
			//echo $user_category['discount'];
			//echo $users['uid'];
        }
          /**
         * ***品牌 
         */
        $brand=M('brandlist')->field('name')->find($item['brand']);
		$item['brand']=$brand['name'];
		
		$img_img=M('item')->field('img')->find($item['id']);
		$item['img']=$img_img['img'];
        //会员价格
        if($this->visitor->info){
            $cate_id=$this->visitor->info['uid'];
            $cate =M('item_userprice')->field('user_price')->where(array('cate_id' =>$cate_id,'item_id'=>$item['id']))->find();
            if($cate){
            $item['price']=$cate['user_price'];
            }
        }

        //商品相册
        $img_list = M('item_img')->field('url')->where(array('item_id' => $id))->limit(0,5)->order('ordid')->select();

        //标签
        $item['tag_list'] = unserialize($item['tag_cache']);
        //可能还喜欢
        $item_tag_mod = M('item_tag');
        $db_pre = C('DB_PREFIX');
        $item_tag_table = $db_pre . 'item_tag';
        $maylike_list = array_slice($item['tag_list'], 0, 3, true);
        foreach ($maylike_list as $key => $val) {
            $maylike_list[$key] = array('name' => $val);
            $maylike_list[$key]['list'] = $item_tag_mod->field('i.id,i.img,i.intro,' . $item_tag_table . '.tag_id')->where(array($item_tag_table . '.tag_id' => $key, 'i.id' => array('neq', $id)))->join($db_pre . 'item i ON i.id = ' . $item_tag_table . '.item_id')->order('i.id DESC')->limit(9)->select();
        }
		$ads1= M('ad')->field('url,content,name')->where('board_id=10 and status=1')->order('add_time desc')->find();
        $this->assign('ad1',$ads1);
	
        //第一页评论不使用AJAX利于SEO
        $item_comment_mod = M('item_comment');
		$id = $this->_get('id', 'intval');
        //$pagesize = 6;
        $map = array('item_id' => $id,'status'=>1);
        $count = $item_comment_mod->where($map)->count('id');
        
        //$pager = $this->_pager($count, $pagesize);
        //$pager->path = 'index';
        //$pager_bar = $pager->fshow();
        //$cmt_list = $item_comment_mod->where($map)->order('id DESC')->limit($pager->firstRow . ',' . $pager->listRows)->select();
		//print_r($cmt_list);
		$cmt_list = $item_comment_mod->field('a.*,b.cover,b.hyimg,b.is_ficuser')->join('a left join weixin_user b ON a.uid=b.id')->where('a.item_id='.$id.' and a.status = 1')->order(array('a.add_time'=>'DESC'))->select();
        $this->assign('count',$count);	//统计该商品的评论数量
    
       //$item_mod->where(array('id' => $id))->setInc('hits'); //点击量 
	   $item_flag = M('flag')->field('name')->where(array('Id'=>$item['countryId']))->find();
	   $this->assign('countryname',$item_flag);
       $this->assign('item', $item);


		
		//按照销售量来显示"大家还买了"
	   $itembuy=M('item');
       $itemsbuy = $itembuy->where('cate_id='.$item['cate_id'].' AND status=1 AND id!='.$item['id'])->order('buy_num desc')->limit(8)->select();
       
	    $this->assign('itemsbuy', $itemsbuy);
        $this->assign('maylike_list', $maylike_list);

        $this->assign('img_list', $img_list);

        /*dump($itemsbuy);
        dump($maylike_list);
        dump($item);
        dump($cmt_list);exit;*/
        $this->assign('cmt_list', $cmt_list);
        $this->assign('page_bar', $pager_bar);
		$this->assign('count', $count);
        $this->_config_seo(C('pin_seo_config.item'), array(
            'item_title' => $item['title'],
            'item_intro' => $item['intro'],
            'item_tag' => implode(' ', $item['tag_list']),
            'user_name' => $item['uname'],
            'seo_title' => $item['seo_title'],
            'seo_keywords' => $item['seo_keys'],
            'seo_description' => $item['seo_desc'],
        ));

         //属性
	$attr_list = M('item_attr')->where(array('item_id'=>$id))->field('attr_value')->select();
	//print_r($attr_list);
	foreach($attr_list as $k=>$v){
		$attr_list=explode("|",$v['attr_value']);
	}
	$ret=M('cart')->where(array('uid' => $this->visitor->info['id'],'shopid' => session('shopid')))->select();
	$cart_count = 0;
	$cart_price = 0;
	foreach($ret as $key => $val){
		$cart_count += $val['num'];
		$cart_price += $val['num']*$val['price'];
	}
	
	$this->assign('cart_count',$cart_count);
	//dump($cart_price);exit;
	$this->assign('cart_price',$cart_price);
    $this->assign('attr_list', $attr_list);
	$this->assign('attr_list_count', count($attr_list));
    
	/**
	 * 浏览商品记录
	 * 只保存7天的记录
	 */
	$content_id = array();//1.创建一个数组


/*****************************************************************************************/
	$_SESSION['shares_id'] = $_GET['shares'];
	$content_id[] = $_GET['id']; //2.对接受到的ID插入到数组中去
	if(isset($_COOKIE['content_id'])) //3.判定cookie是否存在,第一次不存在(如果存在的话)
	{
		$now_content = str_replace("\\", "", $_COOKIE['content_id']);//(4).您可以查看下cookie,此时如果unserialize的话出问题的,我把里面的斜杠去掉了
		$now = unserialize($now_content); //(5).把cookie 中的serialize生成的字符串反实例化成数组
		foreach($now as $n=>$w) { //(6).里面很多元素,所以我要foreach 出值
			if(!in_array($w,$content_id)) //(7).判定这个值是否存在,如果存在的化我就不插入到数组里面去;
			{
				$content_id[] = $w; //(8).插入到数组
			}
		}
		$content= serialize($content_id); //(9).把数组实例化成字符串
		setcookie("content_id",$content, time()+3600*7); //(10).插入到cookie
	}else {
		$content= serialize($content_id);//4.把数组实例化成字符串
		setcookie("content_id",$content, time()+3600*7); //5.生成cookie
	}
	$getcontent = unserialize(str_replace("\\", "", $_COOKIE['content_id']));
	if(count($getcontent)<7){
		cookie('history',$getcontent,3600*7); // 指定cookie保存时间
	}
	
	//记录用户访问商品记录，用于商品推荐
	$posslike = M('posslike')->where(array('itemid'=>$id,'userid'=>$this->visitor->info['id']))->find();
	if(is_array($posslike)){
		M('posslike')->where(array('id'=>$posslike['id']))->save(array('addtime'=>time()));
	}else{
		$data['userid'] = $this->visitor->info['id'];
		$data['itemid'] = $id;
		$data['addtime'] = time();
		M('posslike')->add($data);
	}
		$this->display();
	}
   
    public function goodshistory( $id ){
                   
               $goods = M('item');
               // 【通过传递过来的商品唯一的id号， 查找该商品信息】
               $goodsResult = $goods->where(" id = '{$id}' ")->find();    
               // 【当前已浏览过的商品  二维数组】
               $current = unserialize(cookie('history',$goodsResult));  
               //  【计算里面记录的浏览过的商品的个数】
               $temp_num=count($current);     
             
               if(  $temp_num > 5  ){                        // 【这里只记录最多6个足迹】
               
                    $current=array_reverse($current);
                    array_pop($current);                   // 【反转数组后弹出最后一个元素（也就是第一个元素）】
                    $current=array_reverse($current);    //【再反转回正确的排序】
                    $temp_num=5;
                   
               }
             
             
                    if( $_COOKIE['history']=="" ){      //【如果一个商品也没看过则存入】
                   
                       $current[0]['id']=$goodsResult['id'];  //id
                       $current[0]['goodsname']=$goodsResult['title'];    //商品名称 goodsname为商品名称在数据库字段，下同
                       $current[0]['thumbindex']=$goodsResult['img'];   //商品缩略图
                   
                       //cookie('history',serialize($current),array('expire'=>3600,'path'=>'/'));      // 【thinkphp特有的写cookie的函数方法】
                     
                    }else{     //【如果cookie有商品浏览历史记录】
                   
                        $temp_s=0;  //【临时变量,否则判断当前商品ID和数组中存的ID是否有一样,一样则$temp_s=1】
                            
                             foreach( $current as $key => $value ){
                               foreach( $current[$key] as $key2 => $value2 ){
                               
                                    if( $value2 == $goodsResult['id'] ){     //有本产品的记录则不操作
                                     $temp_s=1;
                                    }
                               }
                             }
                            
                             if(  $temp_s==0  )    //【如果没一样的则记录下来】
                             {
                              
                              $current[$temp_num]['id']=$goodsResult['id'];//id
                              $current[$temp_num]['goodsname']=$goodsResult['title'];//pname
                              $current[$temp_num]['thumbindex']=$goodsResult['img'];//pic
                              
                              //cookie('history',serialize($current),array('expire'=>3600,'path'=>'/'));
                         }
                }
    }

    /**
     * 点击去购买
     */
    public function tgo() {
        $url = $this->_get('to', 'base64_decode');
        redirect($url);
    }
	
	//商品购买提醒
	public function remind(){
		$itemid = $this->_post('id','trim');
		$day = $this->_post('day','trim'); 
		$uid = $this->visitor->info['id'];
		$iremind = M('remind');
		$data['user_id'] = $uid;
		$data['item_id'] = $itemid;
		$data['remind_time'] = $day;
		$data['add_time'] = time();
		$data['shopid'] = $_SESSION['shopid'];
		$ext = $iremind->where(array('user_id'=>$uid,'item_id'=>$itemid))->select();
		if(count($ext) <= 0){
			$remind = $iremind->add($data);
			echo json_encode(array('status'=>1));
		}else{
			echo json_encode(array('status'=>0));
		}
	}

    /**
     * AJAX获取评论列表
     */
    public function comment_list() {
        $id = $this->_get('id', 'intval');
        !$id && $this->ajaxReturn(0, L('invalid_item'));
        $item_mod = M('item');
        $item = $item_mod->where(array('id' => $id, 'status' => '1'))->count('id');
        !$item && $this->ajaxReturn(0, L('invalid_item'));
        $item_comment_mod = M('item_comment');
        $pagesize = 8;
        $map = array('item_id' => $id);
        $count = $item_comment_mod->where($map)->count('id');
        $pager = $this->_pager($count, $pagesize);
        $pager->path = 'comment_list';
        $cmt_list = $item_comment_mod->where($map)->order('id DESC')->limit($pager->firstRow . ',' . $pager->listRows)->select();
        $this->assign('cmt_list', $cmt_list);
        $data = array();
        $data['list'] = $this->fetch('comment_list');
        $data['page'] = $pager->fshow();
        $this->ajaxReturn(1, '', $data);
    }

    /**
     * 评论一个商品
     */
    public function comment() {
        foreach ($_POST as $key=>$val) {
            $_POST[$key] = Input::deleteHtmlTags($val);
        }
        $data = array();
        $data['item_id'] = $this->_post('id', 'intval');
        !$data['item_id'] && $this->ajaxReturn(0, L('invalid_item'));
        $data['info'] = $this->_post('content', 'trim');
        !$data['info'] && $this->ajaxReturn(0, L('please_input') . L('comment_content'));
        //敏感词处理
        $check_result = D('badword')->check($data['info']);
        switch ($check_result['code']) {
            case 1: //禁用。直接返回
                $this->ajaxReturn(0, L('has_badword'));
                break;
            case 3: //需要审核
                $data['status'] = 0;
                break;
        }
        $data['info'] = $check_result['content'];
        //$data['uid'] = $this->visitor->info['id'];
        $data['uname'] = $this->visitor->info['username'];

        //验证商品
      //  $item_mod = M('item');
//        $item = $item_mod->field('id,uid,uname')->where(array('id' => $data['item_id'], 'status' => '1'))->find();
//        !$item && $this->ajaxReturn(0, L('invalid_item'));
        //写入评论
        $item_comment_mod = M('item_comment');
		 
       if (false === $item_comment_mod->create($data)) {
            $this->ajaxReturn(0, $item_comment_mod->getError());
        }
        $comment_id = $item_comment_mod->add($datacom);
        if ($comment_id) {
            $this->assign('cmt_list', array(
                array(
                    'uid' => $data['uid'],
                    'uname' => $data['uname'],
                    'info' => $data['info'],
                    'add_time' => time(),
                )
            ));
            $resp = $this->fetch('comment_list');
            $this->ajaxReturn(1, L('comment_success'), $resp);
        } else {
            $this->ajaxReturn(0, L('comment_failed'));
        }
    }

    //分享商品弹窗
    public function share_item() {
        //支持的网站
        if (false === $site_list = F('item_site_list')) {
            $site_list = D('item_site')->site_cache();
        }
        $this->assign('site_list', $site_list);
        $resp = $this->fetch('dialog:share_item');
        $this->ajaxReturn(1, '', $resp);
    }

    //获取商品信息
    public function fetch_item() {
        $url = $this->_get('url', 'trim');
        $url == '' && $this->ajaxReturn(0, L('please_input') . L('correct_itemurl'));
        $aid = $this->_get('aid', 'intval');
        //获取商品信息
        $itemcollect = new itemcollect();
        !$itemcollect->url_parse($url) && $this->ajaxReturn(0, L('please_input') . L('correct_itemurl'));
        if (!$info = $itemcollect->fetch()) {
            $this->ajaxReturn(0, L('fetch_item_failed'));
        }
        $this->assign('item', $info['item']);
        $data = array();
        if ($aid) {
            $this->assign('aid', $aid);
        } else {
            //用户的专辑
            $album_list = M('album')->field('id,title')->where(array('uid' => $this->visitor->info['id']))->select();
            //专辑分类
            if (false === $album_cate_list = F('album_cate_list')) {
                $album_cate_list = D('album_cate')->cate_cache();
            }
            $this->assign('album_cate_list', $album_cate_list);
            $this->assign('album_list', $album_list);
        }
        //专辑分类
        $data['html'] = $this->fetch('dialog:fetch_item');
        $data['item'] = serialize($info['item']);
        $this->ajaxReturn(1, L('fetch_item_success'), $data);
    }

    //发布商品
    public function publish_item() {
        $item = unserialize($this->_post('item', 'trim'));
        !$item['key_id'] && $this->ajaxReturn(0, L('publish_item_failed'));
        $album_id = $this->_post('album_id', 'intval', 0);
        $ac_id = $this->_post('ac_id', 'intval', 0);
        $item['intro'] = $this->_post('intro', 'trim');
        $item['info'] = Input::deleteHtmlTags($item['info']);
        $item['uid'] = $this->visitor->info['id'];
        $item['uname'] = $this->visitor->info['username'];
        $item['status'] = C('pin_item_check') ? 0 : 1;
        //添加商品
        $item_mod = D('item');
        $result = $item_mod->publish($item, $album_id, $ac_id);
        if ($result) {
            //发布商品钩子
            $tag_arg = array('uid' => $item['uid'], 'uname' => $item['uname'], 'action' => 'pubitem');
            tag('pubitem_end', $tag_arg);
            $this->ajaxReturn(1, L('publish_item_success'));
        } else {
            $this->ajaxReturn(0, $item_mod->getError());
        }
    }
	
	//2014-09-10 收藏商品
	public function shoucang() {
		$id = $this->_get('id', 'intval');
		//先检查这个id号对应的item是否存在
		$itemMd = M('item');
		$item = $itemMd->where(array('id' => $id, 'status' => '1'))->find();
		if(!$item) {
			echo json_encode(array("error"=>"商品不存在!"));
			return;
		}
		
		if(!isset($this->visitor) || !isset($this->visitor->info)) {
			echo json_encode(array("error"=>"请先登录后收藏!"));
			return;
		}
		$uid = $this->visitor->info['id'];
		$item_likeMd = M('item_like');
		$is_liked = $item_likeMd->where(array('item_id' => $item['id'], 'uid' => $uid))->count();
		if($is_liked != 0) {
			echo json_encode(array("error"=>"你已经收藏过此商品!"));
			return;
		}
		$item_likeMd->add(array('item_id'=>$item['id'], 'uid'=>$uid, 'add_time'=>time()));
		echo json_encode(array("success"=>"收藏成功!"));
	}

    /**
     * 喜欢一个商品
     * 返回status(todo)
     */
    public function like() {
        $id = $this->_get('id', 'intval');
        $aid = $this->_get('aid', 'intval');
        !$id && $this->ajaxReturn(0, L('invalid_item'));
        $item_mod = M('item');
        $item = $item_mod->field('id,uid,uname')->where(array('id' => $id, 'status' => '1'))->find();
        !$item && $this->ajaxReturn(0, L('invalid_item'));
        $uid = $this->visitor->info['id'];
        $uname = $this->visitor->info['username'];
        $item['uid'] == $uid && $this->ajaxReturn(0, L('like_own')); //自己的商品
        $like_mod = M('item_like');
        //是否已经喜欢过
        $is_liked = $like_mod->where(array('item_id' => $item['id'], 'uid' => $uid))->count();
        $is_liked && $this->ajaxReturn(0, L('you_was_liked'));
        if ($like_mod->add(array('item_id' => $item['id'], 'uid' => $uid, 'add_time' => time()))) {
            //增加商品喜欢数
            $item_mod->where(array('id' => $id))->setInc('likes');
            //增加用户被喜欢数
            M('user')->where(array('id' => $item['uid']))->setInc('likes');
            //增加专辑喜欢
            $aid && M('album')->where(array('id' => $aid))->setInc('likes');
            //添加喜欢钩子
            $tag_arg = array('uid' => $uid, 'uname' => $uname, 'action' => 'likeitem');
            tag('likeitem_end', $tag_arg);
            $this->ajaxReturn(1, L('like_success'));
        } else {
            $this->ajaxReturn(0, L('like_failed'));
        }
    }

    /**
     * 删除喜欢
     */
    public function unlike() {
        $id = $this->_get('id', 'intval');
        !$id && $this->ajaxReturn(0, L('invalid_item'));
        $uid = $this->visitor->info['id'];
        $like_mod = M('item_like');
        if ($like_mod->where(array('uid' => $uid, 'item_id' => $id))->delete()) {
            //喜欢数不减少~
            $this->ajaxReturn(1, L('unlike_success'));
        } else {
            $this->ajaxReturn(1, L('unlike_failed'));
        }
    }

    /**
     * 删除商品
     */
    public function delete() {
        $id = $this->_get('id', 'intval');
        $album_id = $this->_get('album_id', 'intval');
        !$id && $this->ajaxReturn(0, L('invalid_item'));
        $uid = $this->visitor->info['id'];
        $uname = $this->visitor->info['username'];
        if ($album_id) {
            //删除专辑里面的商品
            $result = M('album')->where(array('id' => $album_id, 'uid' => $uid))->count();
            if ($result) {
                M('album_item')->where(array('album_id' => $album_id, 'item_id' => $id))->delete();
                //减少专辑商品数量
                M('album')->where(array('id' => $album_id))->setDec('items');
                //刷新专辑封面
                D('album')->update_cover($album_id);
                $this->ajaxReturn(1, L('del_item_success'));
            } else {
                $this->ajaxReturn(0, L('del_item_failed'));
            }
        } else {
            $result = D('item')->where(array('id' => $id, 'uid' => $uid))->delete();
            //减少用户分享数量
            M('user')->where(array('id' => $uid))->setDec('shares');
            if ($result) {
                //添加删除钩子
                $tag_arg = array('uid' => $uid, 'uname' => $uname, 'action' => 'delitem');
                tag('delitem_end', $tag_arg);
                $this->ajaxReturn(1, L('del_item_success'));
            } else {
                $this->ajaxReturn(0, L('del_item_failed'));
            }
        }
    }

}