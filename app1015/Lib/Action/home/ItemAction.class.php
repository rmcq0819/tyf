<?php

class ItemAction extends frontendAction {
/***********************************************************app接口-start****************************************************************/
	/***** 商品详情页商品相册 ****/
	public function imgs(){
		$id = $this->_get('id', 'intval');
        $img_list = M('item_img')->field('url')->where(array('item_id' => $id))->limit(0,5)->order('ordid')->select();
		if(count($img_list)>0){
			foreach($img_list as $key=>$val){
				$arr[] =  "http://yooopay.com/data/upload/item/".$val['url'];
			}
			$jsonArr['imgs'] = $arr;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	
	/***** 商品详情页推荐商品（类别销量）*****/
	public function recitems(){
		$id = $this->_get('id', 'intval');
		$item=M('item');
		$cate_id = $item->where(array('id'=>$id))->getField('cate_id');
        $itemsbuy = $item->where('cate_id='.$cate_id.' AND status=1 AND id!='.$id)->order('buy_num desc')
							->limit(8)
							->field('id,title,img,price,itemtype')
							->select();
		if(count($itemsbuy)>0){
			foreach($itemsbuy as $key=>$val){
				$itemsbuy[$key]['img'] =  "http://yooopay.com/data/upload/item/".$val['img'];
			}
			$jsonArr['items'] = $itemsbuy;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
		
	/***** 商品详情页商品参数*****/
	public function itemparams(){
		$id = $this->_get('id', 'intval');
		$item_mod=M('item');
		$item = $item_mod->field('id,title,adress,itemtype,yhprice,price,goods_stock,buy_num,size,size_imgs,countryId,virtual_good')
						 ->where(array('id' => $id, 'status' => 1))
						 ->find();
						 
		if($item){
			$arr['id'] = $item['id'];
			$arr['title'] = $item['title'];
			$arr['buy_num'] = $item['buy_num'];
			$arr['itemtype'] = $item['itemtype'];
			$arr['price'] = $item['price'];
			$arr['virtual_good'] = $item['virtual_good'];
			if($item['countryId']>0){
				$arr['address'] = M('flag')->where(array('Id'=>$item['countryId']))->getField('name');
			}
			$jsonArr['status'] = 1;
			if($item['size']){
				$price=explode('|',$item['yhprice']);
				$goods_stock=explode('|',$item['goods_stock']);
				$size=explode('|',$item['size']);
				$size_imgs = explode('|',$item['size_imgs']);
			
				foreach($size_imgs as $key=>$val){
					$size_imgs[$key] = "http://yooopay.com/data/upload/item_size/".$val;
				}
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
	/** 
     * 获取远程图片的宽高和体积大小 
     * 
     * @param string $url 远程图片的链接 
     * @param string $type 获取远程图片资源的方式, 默认为 curl 可选 fread 
     * @param boolean $isGetFilesize 是否获取远程图片的体积大小, 默认false不获取, 设置为 true 时 $type 将强制为 fread  
     * @return false|array 
     */  
    function myGetImageSize($url, $type = 'curl', $isGetFilesize = true)   
    {  
        // 若需要获取图片体积大小则默认使用 fread 方式  
        $type = $isGetFilesize ? 'fread' : $type;  
       
         if ($type == 'fread') {  
            // 或者使用 socket 二进制方式读取, 需要获取图片体积大小最好使用此方法  
            $handle = fopen($url, 'rb');  
       
            if (! $handle) return false;  
       
            // 只取头部固定长度168字节数据  
            $dataBlock = fread($handle, 2000);  
        }  
        else {  
		
            // 据说 CURL 能缓存DNS 效率比 socket 高  
            $ch = curl_init($url);  
            // 超时设置  
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
            // 取前面 168 个字符 通过四张测试图读取宽高结果都没有问题,若获取不到数据可适当加大数值  
            curl_setopt($ch, CURLOPT_RANGE, '0-1999');  
            // 跟踪301跳转  
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
            // 返回结果  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
       
            $dataBlock = curl_exec($ch);  
            curl_close($ch);  
       
            if (! $dataBlock) return false;  
        }  
       
        // 将读取的图片信息转化为图片路径并获取图片信息,经测试,这里的转化设置 jpeg 对获取png,gif的信息没有影响,无须分别设置  
        // 有些图片虽然可以在浏览器查看但实际已被损坏可能无法解析信息   
		
        $size = getimagesize('data://image/jpg;base64,'. base64_encode($dataBlock));  
        if (empty($size)) {  
            return false;  
        }  
       
        $result['width'] = $size[0];  
        $result['height'] = $size[1];  
       
        // 是否获取图片体积大小  
        if ($isGetFilesize) {  
            // 获取文件数据流信息  
            $meta = stream_get_meta_data($handle);  
            // nginx 的信息保存在 headers 里，apache 则直接在 wrapper_data   
            $dataInfo = isset($meta['wrapper_data']['headers']) ? $meta['wrapper_data']['headers'] : $meta['wrapper_data'];  
       
            foreach ($dataInfo as $va) {  
                if ( preg_match('/length/iU', $va)) {  
                    $ts = explode(':', $va);  
                    $result['size'] = trim(array_pop($ts));  
                    break;  
                }  
            }  
        }  
       
        if ($type == 'fread') fclose($handle);  
       
        return $result;  
    }  
	/***** 商品详情页商品详情图片*****/
	public function iteminfo(){
		$id = $this->_get('id', 'intval');
		$item_mod=M('item');
		$info = $item_mod->where(array('id' => $id, 'status' => 1))->field('info,infoscale')->find();
		if($info['info']){
			preg_match_all("|src=(.*) |U",$info['info'],$match);
			foreach($match[1] as $key=>$val){
				$tmp = trim($val,'"');
				
				if(strpos($tmp,"http")!==0){
					$tmp = "http://yooopay.com".ltrim($tmp,'.'); 	
				}
				$arr[] = $tmp; 
				if($info['infoscale']==''){
					$size = $this->myGetImageSize($tmp); 
					if($size){
						$sizearr[] = round($size['width']/$size['height'],1);
					}else{
						$size = getimagesize($tmp);
						$sizearr[] = round($size[0]/$size[1],1);
					}
				}
			}
			if($info['infoscale']!=''){
				$sizearr = explode('|',$info['infoscale']);
			}
			$jsonArr['status'] = 1;
			$jsonArr['info'] = $arr;
			$jsonArr['scale'] = $sizearr;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	} 
	
	/***** 商品详情页商品详情图片*****/
	public function itemcs(){
		$id = $this->_get('id', 'intval');
		$item_mod=M('item');
		$cs = $item_mod->where(array('id' => $id, 'status' => 1))->field('cs,csscale')->find();
		if($cs['cs']){
			preg_match_all("|src=(.*) |U",$cs['cs'],$match);
			foreach($match[1] as $key=>$val){
				$tmp = trim($val,'"');
				
				if(strpos($tmp,"http")!==0){
					$tmp = "http://yooopay.com".ltrim($tmp,'.'); 	
				}
				$arr[] = $tmp; 
				if($cs['csscale']==''){
					$size = $this->myGetImageSize($tmp); 
					if($size){
						$sizearr[] = round($size['width']/$size['height'],1);
					}else{
						$size = getimagesize($tmp);
						$sizearr[] = round($size[0]/$size[1],1);
					}
				}
			}
			if($cs['csscale']!=''){
				$sizearr = explode('|',$cs['csscale']);
			}
			$jsonArr['status'] = 1;
			$jsonArr['cs'] = $arr;
			$jsonArr['scale'] = $sizearr;
		}else{
			$jsonArr['status'] = 0;
		}	
		echo json_encode($jsonArr);
	} 
	
	/* function getimageinfo($img) { //$img为图象文件绝对路径 
		$img_info = getimagesize($img); 
		switch ($img_info[2]) { 
			case 1: 
			$imgtype = "gif"; 
			break; 
			case 2: 
			$imgtype = "jpg"; 
			break; 
			case 3: 
			$imgtype = "png"; 
			break; 
		} 
		$img_type = $imgtype."图像"; 
		$img_size = ceil(filesize($img)/1000)."k"; //获取文件大小 
		$new_img_info = array ( 
			"width"=>$img_info[0], 
			"height"=>$img_info[1], 
			"type"=>$img_type 
			"size"=>$img_size 
		} 
		return $new_img_info; 
	}  */
	
	
   	/***** 商品详情页商品详情图片*****/
	public function itemcss(){
		$id = $this->_get('id', 'intval');
		$item_mod=M('item');
		$cs = $item_mod->where(array('id' => $id, 'status' => 1))->field('info,infoscale')->find();
		if($cs['info']){
			preg_match_all("|src=(.*) |U",$cscs['info'],$match);
			foreach($match[1] as $key=>$val){
				$tmp = trim($val,'"');
				
				if(strpos($tmp,"http")!==0){
					$tmp = "http://yooopay.com".ltrim($tmp,'.'); 	
				}
				$arr[] = $tmp; 
				if($cs['infoscale']==''){
					$size = $this->myGetImageSize($tmp); 
					if($size){
						$sizearr[] = round($size['width']/$size['height'],1);
					}else{
						$size = getimagesize($tmp);
						$sizearr[] = round($size[0]/$size[1],1);
					}
				}else{
					$sizearr = explode('|',$cs['infoscale']);
				}
			}
			$jsonArr['status'] = 1;
			$jsonArr['cs'] = $arr;
			$jsonArr['scale'] = $sizearr;
		}else{
			$jsonArr['status'] = 0;
		}	
		echo json_encode($jsonArr);
	} 
	
	
	/***** 商品详情页商品评论*****/
	public function itemcoments(){
		$id = $this->_get('id', 'intval');
		$item_comment_mod = M('item_comment');
		$cmt_list = $item_comment_mod->field('a.*,b.cover')->join('a left join weixin_user b ON a.uid=b.id')
														   ->where('a.item_id='.$id.' and a.status = 1')
														   ->order(array('a.add_time'=>'DESC'))
														   ->field('add_time,uname,info,picurl1,cover')
														   ->select();
		
		if(count($cmt_list)>0){
			foreach($cmt_list as $key=>$val){
				if($val['picurl1']!==''){
					$cmt_list[$key]['picurl1'] =  "http://yooopay.com/".$val['picurl1'];
				}
			}
			$jsonArr['status'] = 1;
			$jsonArr['coment'] = $cmt_list;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	/***** 商品详情收藏商品*****/
	public function shoucang() {
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
	
	public function countrys(){
		$fwhere['status'] = 1;
		$countrys = M('flag')->field('Id,bg_img,name')->where($fwhere)->order('ordid asc')->select();
		if(count($countrys)>0){
			foreach($countrys as $key=>$val){
				$countrys[$key]['bg_img'] = "http://yooopay.com/data/upload/bg_img/".$val['bg_img'];
			}
			$jsonArr['status'] = 1;
			$jsonArr['countrys'] = $countrys;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	//获取分享相关信息
	public function shareInfo(){
		$id = $_GET['id'];//需分享的商品ID
		$userid = $_GET['shares'];//分享者ID
		$item = M('item')->where(array('id'=>$id))->field('img,title')->find();
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
		$url='http://yooopay.com/index.php?m=Item&a=index&id='.$id.'&shares='.$userid;  
        $and = "jsapi_ticket=".$jsapi_ticket."&noncestr=".$noncestr."&timestamp=".$timestamp."&url=".$url;
        $signature = sha1($and);
		
		
		//$jsonArr['timestamp'] = $timestamp;
		//$jsonArr['jsapi_ticket'] = $jsapi_ticket;
		//$jsonArr['signature'] = $signature;
		$jsonArr['url'] = $url;
		$jsonArr['imgUrl'] =  "http://yooopay.com/data/upload/item/".$item['img'];
		$jsonArr['title'] = $item['title']."- 团洋范";
		$jsonArr['desc'] = $item['title']."- 团洋范";
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
	}
	
	//分类页面-子类信息
	public function cates(){
		$pid = $this->_get('pid','intval');
		$subcates = M('item_cate')->where(array('status' => 1,'pid' => $pid))->field('id,name,img')->order(array('ordid'=>'asc'))->select();
		if(count($subcates)>0){
			foreach($subcates as $key=>$val){
				$subcates[$key]['img'] = "http://yooopay.com/data/upload/item_cate/".$val['img'];
			}
			$jsonArr['subcates'] = $subcates;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	//分类页面-大类banner图片
	public function banner(){
		$pid = $this->_get('pid','intval');
		$banner = M('item_cate')->where(array('status' => 1,'id' =>$pid))->getField('img');
		if($banner){
			$jsonArr['banner'] = "http://yooopay.com/data/upload/item_cate/".$banner;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
   
   

	public function recoms(){
		$pid = $this->_get('pid','intval');
		$subcates = M('item_cate')->where(array('status' => 1,'pid' => $pid))->field('id')->order(array('ordid'=>'asc'))->select();
		foreach($subcates as $key=>$val){
			$arr[] = $val['id'];
		}
		
		if(count($arr)>0){
			$where['cate_id'] = array('in',$arr);
			$where['status'] = 1;
			$recoms = M('item')->where($where)->field('id,img,price,buy_num,itemtype')->order('ordid asc')->limit('6')->select();
			if(count($recoms)>0){
				foreach($recoms as $key=>$val){
					$recoms[$key]['img'] = "http://yooopay.com/data/upload/item/".$val['img'];
				}
				$jsonArr['recoms'] = $recoms;
				$jsonArr['status'] = 1;
			}else{
				$jsonArr['status'] = 0;
			}
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	//分类子页面商品信息
	public function itemfcate(){
    	$cate_id = $this->_get('cate_id','intval');	     //分类ID
		$countryId = $this->_get('countryId','intval'); //国家ID
		$country = $this->_get('country','trim'); //其他国家
		$keyword = $this->_get('keyword','trim');     //关键词
		$condition = isset($_GET['condition'])?$this->_get('condition','trim'):'all_round';

		$where['status'] = 1;
		if($cate_id){
			$where['cate_id'] = $cate_id;
			$detail_title = M('item_cate')->where('id = '.$cate_id)->getField('name');  //获取分类名称
		}
		if($keyword){
			$where['title'] = array('like','%'.$keyword.'%');
			$detail_title = $keyword;
		}
		if($countryId){
			$where['countryId'] = $countryId;
			$detail_title = M('flag')->where('Id = '.$countryId)->getField('name');  //获取国家名称
		}
		if($country == 'more'){
			$flags = M('flag')->where('status = 1')->field('id')->select();
			$arr = array();
			foreach($flags as $key => $val){
				$arr[] = $val['id'];
			}
			$where['countryId'] = array('not in',$arr);
			$detail_title = '其他';
		}
		$order = 'ordid asc';
		if($condition == 'sales_desc'){
			$order = 'buy_num desc';
		}
		if($condition == 'sales_asc'){
			$order = 'buy_num asc';
		}
		if($condition == 'price_desc'){
			$order = 'price desc';
		}
		if($condition == 'price_asc'){
			$order = 'price asc';
		}
		if($condition == 'itemtype_0'){
			$where['itemtype'] = 0;
		}
		if($condition == 'itemtype_1'){
			$where['itemtype'] = 1;
		}
		if($condition == 'new'){
			$order = 'add_time desc';
		}
		
		
		
		$items=M('item')->where($where)->order($order)->field('id,img,title,price,buy_num,goods_stock')->select();
		if(count($items)>0){
			foreach($items as $key=>$val){
				$items[$key]['goods_stock'] = explode('|',$val['goods_stock'])[0];
				$items[$key]['img'] = "http://yooopay.com/data/upload/item/".$val['img'];
			}
			$jsonArr['items'] = $items;
			$jsonArr['page_title'] = $detail_title;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	//国家分类 more图片
	public function othercty(){
		$jsonArr['bg_img'] = "http://yooopay.com/data/upload/bg_img/more.jpg";
		$jsonArr['name'] = "其他";
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
	}
/***********************************************************app接口-end****************************************************************/
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

     public function itemcate() {
    	$icate = M('item_cate');
        $item = M('item');

    	//父级分类
    	$itemcate = $icate->field('id,name')->where(array('status' => 1,'pid' => 0))->order(array('ordid'=>'asc'))->find();	
		
		
		//子级分类
		if(!isset($_SESSION['page'])){
			$_SESSION['page'] = 'first';
		}
		if(isset($_GET['pid'])){
			$pid = $_GET['pid'];
			$_SESSION['page'] = 'first';
		}else{
			$pid = $itemcate['id'];
		}
        
        $sub_itemcate = $icate->where(array('status' => 1,'pid' => $pid))->field('id,name,img')->order(array('ordid'=>'asc'))->select();
		$arr = array();
		foreach($sub_itemcate as $key => $val){
			$arr[] = $val['id'];
		}
       
		$itembanner = $icate->where(array('status' => 1,'id' =>$pid))->find();
        $this->assign('itembanner',$itembanner['img']);
     

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
        $this->assign('sub_itemcate',$sub_itemcate);//小分类
        $this->assign('pid',$pid);  //大分类
		
    	$this->display();
    }
	/**
     * 卖家中心入口  在售商品   2016-07-13 Modify By Liuyumei
     */
    public function onitemlist() {

        
        $status=isset($_GET['status'])?$_GET['status']:1;//默认是排序设置
        $act=isset($_GET['act'])?$_GET['act']:'jj';

    	
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
    		$fcprice = round(($val['price']-$cost[0])*$val['fencheng'],2);
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

    	$cate_id = $this->_get('cate_id','intval');	     //分类ID
		$countryId = $this->_get('countryId','intval'); //国家ID
		$keyword = $this->_get('keyword','trim');     //关键词
		$keyword1 = $this->_get('keyword1','trim');     //关键词
		$country = $this->_get('country','trim'); //其他国家
		
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
		
		if($country == 'more'){
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
		$items=M('item')->where($where)->order($order)->select();
		
		$this->assign('cart_count',$cart_count);
		$this->assign('cart_price',$cart_price);
		$this->assign('item_status',$item_status);
		$this->assign('detail_title',$detail_title);
		$this->assign('items',$items);
		$this->assign('pid',$_GET['pid']);
		$this->assign('keyword',$keyword);
		$this->assign('countryId',$countryId);
		$this->assign('cate_id',$cate_id);
		
		
    	
		
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
    

	
	
	
	
	
	public function doscale(){
		$items = M('item')->where(array('csscale'=>''))->field('cs,info,id')->select();
		foreach($items as $key=>$val){
			dump($val['id']);
			preg_match_all("|src=(.*) |U",$val['cs'],$match1);
			preg_match_all("|src=(.*) |U",$val['info'],$match2);
			$sizearr1 = '';
			foreach($match1[1] as $key1=>$val1){
				$tmp1 = trim($val1,'"');
				
				if(strpos($tmp1,"http")!==0){
					$tmp1 = "http://yooopay.com".ltrim($tmp1,'.'); 	
				}
				
				$size1 = $this->myGetImageSize($tmp1); 
				if($size1){
					$sizearr1[] = round($size1['width']/$size1['height'],1);
				}else{
					$size1 = getimagesize($tmp1);
					$sizearr1[] = round($size1[0]/$size1[1],1);
				}
				$csscale = implode('|',$sizearr1);
			}
			$sizearr2 = '';
			foreach($match2[1] as $key=>$val2){
				$tmp2 = trim($val2,'"');
				
				if(strpos($tmp2,"http")!==0){
					$tmp2 = "http://yooopay.com".ltrim($tmp2,'.'); 	
				}
				 
				$size2 = $this->myGetImageSize($tmp2); 
				if($size2){
					$sizearr2[] = round($size2['width']/$size2['height'],1);
				}else{
					$size2 = getimagesize($tmp2);
					$sizearr2[] = round($size2[0]/$size2[1],1);
				}
				$infoscale = implode('|',$sizearr2);
				
			}
			
			$data['csscale'] = $csscale;
			$data['infoscale'] = $infoscale;
			M('item')->where(array('id'=>$val['id']))->save($data);
			dump($data);
		}
	}
    /**
     * 商品详细页
     */
    public function index() {
		$this->doscale();
		if($this->_get('page') == 'page'){
			$_SESSION['page'] = 'first';
			$this->assign('page','first');
		}
		
        $id = $this->_get('id', 'intval');
		//判断分享链接是否带有商家参数
		$shares = $this->_get('shares', 'intval');
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
		
		
        !$id && $this->_404();
		$item_mod = M('item');
		$item = $item_mod->field('id,cate_id,title,adress,img,itemtype,intro,yhprice,price,activity,is_combo,aprice,priceyuan,info,comments,zuzhuang,add_time,goods_stock,buy_num,brand,size,size_imgs,color,cs,cost,countryId,itemtype,baseid,is_stock')->where(array('id' => $id, 'status' => 1))->find();
		$this->assign('activityPrice',$item['aprice']);
		
		$jsonArr = array();
		$jsonArr['activityPrice'] = $item['aprice'];
		
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
			
			
			$jsonArr['size_imgs'] = $size_imgs;
			$jsonArr['price'] = $price;
			$jsonArr['aprice'] = $aprice;
			$jsonArr['activityPrice'] = $aprice[0];
			$jsonArr['goods_stock'] = $goods_stock;
			$jsonArr['size'] = $size;
		}else{
			$cost = $item['cost'];
			
		}
		
	
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
       
		
	
        //第一页评论不使用AJAX利于SEO
        $item_comment_mod = M('item_comment');
		$id = $this->_get('id', 'intval');
        $map = array('item_id' => $id,'status'=>1);
        $count = $item_comment_mod->where($map)->count('id');
        
       
		$cmt_list = $item_comment_mod->field('a.*,b.cover')->join('a left join weixin_user b ON a.uid=b.id')->where('a.item_id='.$id.' and a.status = 1')->order(array('a.add_time'=>'DESC'))->select();
		foreach($cmt_list as $key=>$val){
			if($val['picurl1']!==''){
				$cmt_list[$key]['picurl1'] = "http://yooopay.com/".$val['picurl1']; 
			}
		}
		//dump($cmt_list);exit;
	    $item_flag = M('flag')->where(array('Id'=>$item['countryId']))->field('name')->find();
		//按照销售量来显示"大家还买了"
	    $itembuy=M('item');
        $itemsbuy = $itembuy->where('cate_id='.$item['cate_id'].' AND status=1 AND id!='.$item['id'])->order('buy_num desc')
							->limit(8)
							->field('id,title,img,price')
							->select();
       
	
        $this->_config_seo(C('pin_seo_config.item'), array(
            'item_title' => $item['title'],
            'item_intro' => $item['intro'],
            'item_tag' => implode(' ', $item['tag_list']),
            'user_name' => $item['uname'],
            'seo_title' => $item['seo_title'],
            'seo_keywords' => $item['seo_keys'],
            'seo_description' => $item['seo_desc'],
        ));

		$ret=M('cart')->where(array('uid' => $this->visitor->info['id'],'shopid' => session('shopid')))->select();
		$cart_count = 0;
		$cart_price = 0;
		foreach($ret as $key => $val){
			$cart_count += $val['num'];
			$cart_price += $val['num']*$val['price'];
		}
		
		$this->assign('cart_count',$cart_count);
		$this->assign('cart_price',$cart_price);
	    $this->assign('itemsbuy', $itemsbuy);
        $this->assign('img_list', $img_list);
        $this->assign('cmt_list', $cmt_list);
        $this->assign('count',$count);	//统计该商品的评论数量
	    $this->assign('countryname',$item_flag);
        $this->assign('item', $item);
		$this->assign('huiyuanid',$this->visitor->info['id']);
		$this->assign('cost',$cost);
		
		$jsonArr['cart_count'] = $cart_count;
		$jsonArr['cart_price'] = $cart_price;
		$jsonArr['itemsbuy'] = $itemsbuy;
		$jsonArr['img_list'] = $img_list;
		$jsonArr['cmt_liet'] = $cmt_list;
		$jsonArr['count'] = $count;
		$jsonArr['countryname'] = $item_flag;
		$jsonArr['item'] = $item;
		$jsonArr['huiyuanid'] = $this->visitor->info['id'];
		$jsonArr['cost'] = $cost;
		/**
		 * 浏览商品记录
		 * 只保存7天的记录
		 */
		$content_id = array();                //1.创建一个数组

		$_SESSION['shares_id'] = $_GET['shares'];
		$content_id[] = $_GET['id'];          //2.对接受到的ID插入到数组中去
		if(isset($_COOKIE['content_id']))     //3.判定cookie是否存在,第一次不存在(如果存在的话)
		{
			$now_content = str_replace("\\", "", $_COOKIE['content_id']);//4.您可以查看下cookie,此时如果unserialize的话出问题的,我把里面的斜杠去掉了
			$now = unserialize($now_content);                            //5.把cookie 中的serialize生成的字符串反实例化成数组
			foreach($now as $n=>$w) {                                    //6.里面很多元素,所以我要foreach 出值
				if(!in_array($w,$content_id))                            //7.判定这个值是否存在,如果存在的化我就不插入到数组里面去;
				{
					$content_id[] = $w;       //8.插入到数组
				}
			}
			$content= serialize($content_id); //9.把数组实例化成字符串
			setcookie("content_id",$content, time()+3600*7);            //10.插入到cookie
		}else {
			$content= serialize($content_id);                           //4.把数组实例化成字符串
			setcookie("content_id",$content, time()+3600*7);            //5.生成cookie
		}
		$getcontent = unserialize(str_replace("\\", "", $_COOKIE['content_id']));
		if(count($getcontent)<7){
			cookie('history',$getcontent,3600*7);                       //11.指定cookie保存时间
		}
		
		//记录用户访问商品记录，用于商品推荐
		$posslike = M('posslike')->where(array('itemid'=>$id,'userid'=>$this->visitor->info['id']))->find();
		if(!$posslike && $id!=""){
			$data = M('posslike');
			$data->userid = $this->visitor->info['id'];
			$data->itemid = $id;
			$data->addtime = time();
			$data->add();
		}
		$jsonArr['status'] = 1;
		//echo json_encode($jsonArr);
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
        $data['uname'] = $this->visitor->info['username'];

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