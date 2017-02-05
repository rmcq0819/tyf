<?php

/**
 * 逛宝贝页面
 */
class bookAction extends frontendAction {

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
	   
	   $this->assign('nav_curr', 'book');
    }


    /**
     * 按分类查看
     */
    public function cate() {
        $cid = $this->_get('cid', 'intval');
        !$cid && $this->_404();
		
		/*****广告***/
    	$ad= M('ad');
		$where['extval']=array($cid);
		$where['board_id']=3;
		$where['status'] = 1;
    	$ads= $ad->field('url,content,desc')->where($where)->order('ordid asc')->select();
		//echo $ad->getLastSql();
		//print_r($ads);
        $this->assign('ad',$ads);
        //分类数据
        if (false === $cate_data = F('cate_data')) {
            $cate_data = D('item_cate')->cate_data_cache();
        }
        //当前分类信息
        if (isset($cate_data[$cid])) {
            $cate_info = $cate_data[$cid];
        } else {
            $this->_404();
        }
        //分类列表
        if (false === $cate_list = F('cate_list')) {
            $cate_list = D('item_cate')->cate_cache();
        }
        //分类关系
        if (false === $cate_relate = F('cate_relate')) {
            $cate_relate = D('item_cate')->relate_cache();
        }
        //获取当前分类的顶级分类
        $tid = $cate_relate[$cid]['tid']; 
      
        //商品
        $sort = $this->_get('sort', 'trim', 'pop');
        $min_price = $this->_get('min_price', 'intval');
        $max_price = $this->_get('max_price', 'intval');
        //条件
        $where = array();
        //排序：潮流(pop)，最热(hot)，最新(new)
        switch ($sort) {
            case 'pop':
                $order = 'likes DESC';
                break;
            case 'hot':
                $order = 'hits DESC';
                break;
            case 'new':
                $order = 'id DESC';
                break;
        }
        //分类
        if ($cate_info['type'] == 0) {
            $min_price && $where['price'][] = array('egt', $min_price);
            $max_price && $where['price'][] = array('elt', $max_price); //价格
            //实物分类
            $cate_relate[$cid]['sids'][] = $cid;
            $where['cate_id'] = array('in', $cate_relate[$cid]['sids']);
         // var_dump($cate_relate[$cid]['sids']);exit;
           // $this->waterfall($where, $order);
        } else {
            //标签组
            $min_price && $where['i.price'][] = array('egt', $min_price);
            $max_price && $where['i.price'][] = array('elt', $max_price); //价格

            $db_pre = C('DB_PREFIX');
            $item_tag_table = $db_pre . 'item_tag';
            $tag_ids = M('item_cate_tag')->where(array('cate_id' => $cid))->getField('tag_id', true);
            if ($tag_ids) {
                $where[$item_tag_table . '.tag_id'] = array('IN', $tag_ids);

                $pentity_id = D('item_cate')->get_pentity_id($cid); //向上找实体分类
                $cate_relate[$pentity_id]['sids'][] = $pentity_id;
                $where['i.cate_id'] = array('IN', $cate_relate[$pentity_id]['sids']); //分类条件

               // $this->tcate_waterfall($where, 'i.' . $order);
            }
        }
        
      //商品信息
          $cid = $this->_get('cid', 'intval');
          $item=M('item');
          $where['cate_id']=array('eq',$cid);
          $where['status']=array('eq',1);
          $where['cate_id'] = array('in', $cate_relate[$cid]['sids']);
         $items=  $item->field('id,title,img,price')->order('ordid asc,id desc')->where($where)->select();
		 
		 $count=count($items);//商品总数
         $page_size =6; //每页显示个数
		// $pager = new Page($count, $pagesize);
        $pager = $this->_pager($count, $page_size);
		//echo $pager;exit;
		$item_list =  $item->field('id,title,img,price')->where($where)->order('ordid asc,id desc')->limit($pager->firstRow . ',' . $page_size)->select();
		
		$this->assign('item_list',$item_list); 
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
        if ((count($item_list) + $page_size * ($p-1)) == $count) {
            $this->assign('show_page', 1);
        }
		//echo M()->getLastSql();exit;
		//dump($item_list);exit;
		 //var_dump($items);exit;
		$cateimg = D('item_cate')->field('img')->where(array('id'=>$cid))->find();
        $cate_info['img'] =$cateimg['img'];//分类图片
        $this->assign('cate_list', $cate_list); //分类
        $this->assign('tid', $tid); //顶级分类ID
        $this->assign('cate_info', $cate_info); //当前分类信息
        $this->assign('sort', $sort); //排序
        $this->assign('min_price', $min_price); //最低价格
        $this->assign('max_price', $max_price); //最高价格
        $this->assign('nav_curr', 'cate'); //导航设置
        //SEO
        $this->_config_seo(C('pin_seo_config.cate'), array(
            'cate_name' => $cate_info['name'],
            'seo_title' => $cate_info['seo_title'],
            'seo_keywords' => $cate_info['seo_keys'],
            'seo_description' => $cate_info['seo_desc'],
        ));
        $this->display();
    }
	
	   public function cateshop() { 
		
		$item=M('item');
        $where['tuijian']=array('eq',1);
        $items=  $item->field('id,title,img,price')->order('ordid asc,id desc')->where($where)->select();
	
		 $count=count($items);//商品总数
         $page_size =6; //每页显示个数
		// $pager = new Page($count, $pagesize);
        $pager = $this->_pager($count, $page_size);
		//echo "----";
		//print_r($pager);exit;
		$item_list =  $item->field('id,title,img,price')->where($where)->order('ordid asc,id desc')->limit($pager->firstRow . ',' . $page_size)->select();
		
		//echo $item->getLastSql();exit;
		
		$this->assign('item_list',$item_list); 
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
        if ((count($item_list) + $page_size * ($p-1)) == $count) {
            $this->assign('show_page', 1);
        }
		
		
        $this->display();
	   
    }

		public function catenews() { 
		
		$item=M('item');
        $where['news']=array('eq',1);
        $items=  $item->field('id,title,img,price')->order('ordid asc,id desc')->where($where)->select();
	
		 $count=count($items);//商品总数
         $page_size =6; //每页显示个数
		// $pager = new Page($count, $pagesize);
        $pager = $this->_pager($count, $page_size);
		//echo "----";
		//print_r($pager);exit;
		$item_list =  $item->field('id,title,img,price')->where($where)->order('ordid asc,id desc')->limit($pager->firstRow . ',' . $page_size)->select();
		
		//echo $item->getLastSql();exit;
		
		$this->assign('item_list',$item_list); 
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
        if ((count($item_list) + $page_size * ($p-1)) == $count) {
            $this->assign('show_page', 1);
        }
		
		
        $this->display();
	   
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
	
    /**
     * 标签分类瀑布
     */
    public function tcate_waterfall($where, $order = 'i.id DESC', $field = '') {
        $db_pre = C('DB_PREFIX');
        $item_tag_table = $db_pre . 'item_tag';
        $item_tag_mod = M('item_tag');
        $where_init = array('i.status' => '1');
        $where = array_merge($where_init, $where);
        $count = $item_tag_mod->where($where)->join($db_pre . 'item i ON i.id = ' . $item_tag_table . '.item_id')->count();
        $spage_size = C('pin_wall_spage_size'); //每次加载个数
        $spage_max = C('pin_wall_spage_max'); //每页加载次数
        $page_size = $spage_size * $spage_max; //每页显示个数
        $pager = $this->_pager($count, $page_size);
        !$field && $field = 'i.id,i.uid,i.uname,i.title,i.intro,i.img,i.price,i.likes,i.comments,i.comments_cache';
        $item_list = $item_tag_mod->field($field)->where($where)->join($db_pre . 'item i ON i.id = ' . $item_tag_table . '.item_id')->order($order)->limit($pager->firstRow . ',' . $spage_size)->select();
        foreach ($item_list as $key => $val) {
            isset($val['comments_cache']) && $item_list[$key]['comment_list'] = unserialize($val['comments_cache']);
        }
        $this->assign('item_list', $item_list);
        //当前页码
        $p = $this->_get('p', 'intval', 1);
        $this->assign('p', $p);
        //当前页面总数大于单次加载数才会执行动态加载
        if (($count - ($p - 1) * $page_size) > $spage_size) {
            $this->assign('show_load', 1);
        }
        //总数大于单页数才显示分页
        $count > $page_size && $this->assign('page_bar', $pager->fshow());
        //最后一页分页处理
        if ((count($item_list) + $page_size * ($p - 1)) == $count) {
            $this->assign('show_page', 1);
        }
    }

    public function cate_ajax() {
        $cid = $this->_get('cid', 'intval');
        //$sort = $this->_get('sort', 'trim', 'pop');
       // $min_price = $this->_get('min_price', 'intval');
        //$max_price = $this->_get('max_price', 'intval');

        //分类数据
        if (false === $cate_data = F('cate_data')) {
            $cate_data = D('item_cate')->cate_data_cache();
        }
        //分类关系
        if (false === $cate_relate = F('cate_relate')) {
            $cate_relate = D('item_cate')->relate_cache();
        }

        //条件
        $where = array();
        //排序：潮流(pop)，最热(hot)，最新(new)
      /*  switch ($sort) {
            case 'pop':
                $order = 'likes DESC';
                break;
            case 'hot':
                $order = 'hits DESC';
                break;
            case 'new':
                $order = 'id DESC';
                break;
        }*/
        if ($cate_data[$cid]['type'] == 0) {
            //实物分类
          //  $min_price && $where['price'][] = array('egt', $min_price);
          //  $max_price && $where['price'][] = array('elt', $max_price); //价格

            array_push($cate_relate[$cid]['sids'], $cid);
            $where['cate_id'] = array('in', $cate_relate[$cid]['sids']); //分类

            $this->wall_ajax($where, $order);
        } else {
            //标签组
         //   $min_price && $where['i.price'][] = array('egt', $min_price);
          //  $max_price && $where['i.price'][] = array('elt', $max_price); //价格

            $db_pre = C('DB_PREFIX');
            $item_tag_table = $db_pre . 'item_tag';
            $tag_ids = M('item_cate_tag')->where(array('cate_id' => $cid))->getField('tag_id', true);
            if ($tag_ids) {
                $where[$item_tag_table . '.tag_id'] = array('IN', $tag_ids);
                $pentity_id = D('item_cate')->get_pentity_id($cid); //向上找实体分类
                array_push($cate_relate[$pentity_id]['sids'], $pentity_id);
                $where['i.cate_id'] = array('IN', $cate_relate[$pentity_id]['sids']); //分类条件
                $this->tcate_wall_ajax($where, 'i.' . $order);
            }
        }
    }

    public function tcate_wall_ajax($where, $order = 'i.id DESC', $field = '') {
        $db_pre = C('DB_PREFIX');
        $item_tag_table = $db_pre . 'item_tag';
        $item_tag_mod = M('item_tag');

        $spage_size = C('pin_wall_spage_size'); //每次加载个数
        $spage_max = C('pin_wall_spage_max'); //加载次数
        $p = $this->_get('p', 'intval', 1); //页码
        $sp = $this->_get('sp', 'intval', 1); //子页
        //条件
        $where_init = array('i.status' => '1');
        $where = array_merge($where_init, $where);
        //计算开始
        $start = $spage_size * ($spage_max * ($p - 1) + $sp);
        $item_mod = M('item');
        $count = $item_tag_mod->where($where)->join($db_pre . 'item i ON i.id = ' . $item_tag_table . '.item_id')->count();
        !$field && $field = 'i.id,i.uid,i.uname,i.title,i.intro,i.img,i.price,i.likes,i.comments,i.comments_cache';
        $item_list = $item_tag_mod->field($field)->where($where)->join($db_pre . 'item i ON i.id = ' . $item_tag_table . '.item_id')->order($order)->limit($start . ',' . $spage_size)->select();
        foreach ($item_list as $key => $val) {
            isset($val['comments_cache']) && $item_list[$key]['comment_list'] = unserialize($val['comments_cache']);
        }
        $this->assign('item_list', $item_list);
        $resp = $this->fetch('public:waterfall');
        $data = array(
            'isfull' => 1,
            'html' => $resp
        );
        $count <= $start + $spage_size && $data['isfull'] = 0;
        $this->ajaxReturn(1, '', $data);
    }
	
		public function searchAjax() {
		$item=M('item');
		$from = intval($_GET["from"]);
		$whereitem = array();
		if (IS_POST){
			$key = $this->_post('Keyword');
			$this->redirect(U('book/search'),array('keyword'=>$key));
		}
		if (isset($_GET['keyword'])){
			$whereitem['title'] = array('like',"%".$_GET['keyword']."%");
			$this->assign('isSearch',1);
		}
	   if(!empty($_GET['id'])){
			$whereitem['cate_id']=$_GET['id'];
				   $num = $_GET['num'];
				   if($num == 1){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 2){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 3){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 4){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else{
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }
	   }else {
			$pid = $_GET['pid'];
			$wheresid['spid'] =array('like',array('%'.$pid.'%'));
			//print_r($wheresid);
			$itemsid = M('item_cate');
			$item_cate_sid = $itemsid->field('id')->where($wheresid)->select();
			$whereitem = "cate_id in (";
			$isFirst = true;
			for ($i= 0;$i< count($item_cate_sid); $i++){
				$str= $item_cate_sid[$i];
				$strsid = $str["id"];
				if(empty($strsid)) continue;
				if(!$isFirst) {
					$whereitem .= ",";
				} else {
					$isFirst = false;
				}
				$whereitem .= $strsid;
			}
			$whereitem .= ")";
			$num = $_GET['num'];
		    if($num == 1){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 2){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 3){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 4){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else{
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }
			//echo $item->getLastSql();
		}
		$arr = array();
		$user_category = null;
		if($this->visitor->info){
            $id=$this->visitor->info['uid'];
            $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
        }
		for($i=0; $i<count($items); $i++) {
			$item = $items[$i];
			$entry["id"] = $item["id"];
			$entry["title"] = $item["title"];
			$entry["img"] = $item["img"];
			$entry["price"] = $item["price"];
			$price = $entry["price"];
			if($_SESSION['user_info']['uid'] == 0 || $_SESSION['user_info']['uid'] == '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =($item['price'])*($item['priceyuan']);
					} else {
						$price = $price;
					}
				} else {
					$price = $price;
				}
			} else {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100)*($item['priceyuan']);
					} else {
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100);
					}
				} else {
					$price =$item['price'];  
					$discount = $user_category['discount'];
					$price = $price*($discount/100);
				}
			}
			$entry["price"] = $price;
			$entry["priceyuan"] = $item["priceyuan"];
			$entry["zuzhuang"] = $item["zuzhuang"];
			$entry["zhekou"] = "";
			if($_SESSION['user_info']['uid'] != 0 && $_SESSION['user_info']['uid'] != '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$discount = $user_category['discount'];
						$discount = ($discount/10)*($item['priceyuan']);
					} else {
						$discount = $user_category['discount'];
						$discount = $discount/10;
					}
				} else {
					$discount = $user_category['discount'];
					$discount = $discount/10;
				}
			}
			$entry["zhekou"] = $discount;
			$entry["buy_num"] = $item["buy_num"];
			$entry["a__href"] = U('Item/index',array('id'=>$item['id']));
			$entry["img__src"] = attach(get_thumb($item['img'], '_b'), 'item');
			array_push($arr,$entry);
		}
		$this->ajaxReturn($arr);
	}
	
		public function search() {
	   //会员分组
		if($this->visitor->info){
            $id=$this->visitor->info['id'];
			$users =M('user')->where(array('id' =>$id))->find();
			$pid = $users['uid'];
            $user_category =M('user_category')->field('discount,id,name,score')->where(array('id' =>$pid))->find();
			$this->assign('users', $users);
			$this->assign('user_category', $user_category);
			//echo $user_category['discount'];
			//echo $users['uid'];
        }
	  /****搜索商品/夏季商品*****/
        $item=M('item');
       	$from = 0;
		if(isset($_GET["from"])) $from = intval($_GET["from"]);
			if (IS_POST){
				$key = $this->_post('Keyword');
				$this->redirect(U('book/search'),array('keyword'=>$key));
			}
			if (isset($_GET['keyword'])){
				$whereitem['title'] = array('like',"%".$_GET['keyword']."%");
				$this->assign('isSearch',1);
			}
		   $num = $_GET['num'];
		   if($num == 1){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else if($num == 2){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else if($num == 3){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else if($num == 4){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else{
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }
	   
	   $this->assign('items',$items); 
		$this->_config_seo();
        $this->display();
    }

	
	public function qiujiAjax() {
		$item=M('item');
		$from = intval($_GET["from"]);
		$where = array();
		$where['qiuji']=array('eq',1);
		$items = $item->field('id,title,img,price,priceyuan,zuzhuang')->order('ordid asc,id desc')->where($where)->limit($from.",6")->select();
		$arr = array();
		$user_category = null;
		if($this->visitor->info){
            $id=$this->visitor->info['uid'];
            $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
        }
		for($i=0; $i<count($items); $i++) {
			$item = $items[$i];
			$entry["id"] = $item["id"];
			$entry["title"] = $item["title"];
			$entry["img"] = $item["img"];
			$entry["price"] = $item["price"];
			$price = $entry["price"];
			if($_SESSION['user_info']['uid'] == 0 || $_SESSION['user_info']['uid'] == '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					//echo $huodong."-----------";
					//echo $item['add_time']."/00000000000";
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					//echo $zuzhuang;
					if($huodong<$zuzhuang){
						$price =($item['price'])*($item['priceyuan']);
					} else {
						$price = $price;
					}
				} else {
					$price = $price;
				}
			} else {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100)*($item['priceyuan']);
					} else {
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100);
					}
				} else {
					$price =$item['price'];  
					$discount = $user_category['discount'];
					$price = $price*($discount/100);
				}
			}
			$entry["price"] = $price;
			$entry["priceyuan"] = $item["priceyuan"];
			$entry["zuzhuang"] = $item["zuzhuang"];
			$entry["zhekou"] = "";
			if($_SESSION['user_info']['uid'] != 0 && $_SESSION['user_info']['uid'] != '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$discount = $user_category['discount'];
						$discount = ($discount/10)*($item['priceyuan']);
					} else {
						$discount = $user_category['discount'];
						$discount = $discount/10;
					}
				} else {
					$discount = $user_category['discount'];
					$discount = $discount/10;
				}
			}
			$entry["zhekou"] = $discount;
			$entry["a__href"] = U('Item/index',array('id'=>$item['id']));
			$entry["img__src"] = attach(get_thumb($item['img'], '_b'), 'item');
			array_push($arr,$entry);
		}
		$this->ajaxReturn($arr);
	}
	
		public function qiuji() {

	  /****搜索商品/夏季商品*****/
        $item=M('item');
		$where['qiuji']=array('eq',1);
        $items = $item->field('id,title,img,price')->order('ordid asc,id desc')->where($where)->limit("0,6")->select();
		//print_r($items);
		$this->assign('items',$items); 
		$this->_config_seo();
        $this->display();
    }
	
	public function tejiaAjax() {
		$item=M('item');
		$from = intval($_GET["from"]);
		$where = array();
		$where['tejia']=array('eq',1);
		$items = $item->field('id,title,img,price,priceyuan,zuzhuang')->order('ordid asc,id desc')->where($where)->limit($from.",6")->select();
		$arr = array();
		$user_category = null;
		if($this->visitor->info){
            $id=$this->visitor->info['uid'];
            $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
        }
		for($i=0; $i<count($items); $i++) {
			$item = $items[$i];
			$entry["id"] = $item["id"];
			$entry["title"] = $item["title"];
			$entry["img"] = $item["img"];
			$entry["price"] = $item["price"];
			$price = $entry["price"];
			if($_SESSION['user_info']['uid'] == 0 || $_SESSION['user_info']['uid'] == '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					//echo $huodong."-----------";
					//echo $item['add_time']."/00000000000";
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					//echo $zuzhuang;
					if($huodong<$zuzhuang){
						$price =($item['price'])*($item['priceyuan']);
					} else {
						$price = $price;
					}
				} else {
					$price = $price;
				}
			} else {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100)*($item['priceyuan']);
					} else {
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100);
					}
				} else {
					$price =$item['price'];  
					$discount = $user_category['discount'];
					$price = $price*($discount/100);
				}
			}
			$entry["price"] = $price;
			$entry["priceyuan"] = $item["priceyuan"];
			$entry["zuzhuang"] = $item["zuzhuang"];
			$entry["zhekou"] = "";
			if($_SESSION['user_info']['uid'] != 0 && $_SESSION['user_info']['uid'] != '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$discount = $user_category['discount'];
						$discount = ($discount/10)*($item['priceyuan']);
					} else {
						$discount = $user_category['discount'];
						$discount = $discount/10;
					}
				} else {
					$discount = $user_category['discount'];
					$discount = $discount/10;
				}
			}
			$entry["zhekou"] = $discount;
			$entry["a__href"] = U('Item/index',array('id'=>$item['id']));
			$entry["img__src"] = attach(get_thumb($item['img'], '_b'), 'item');
			array_push($arr,$entry);
		}
		$this->ajaxReturn($arr);
	}
	
		public function tejia() {

	  /****搜索商品/夏季商品*****/
        $item=M('item');
		$where['tejia']=array('eq',1);
        $items = $item->field('id,title,img,price')->order('ordid asc,id desc')->where($where)->limit("0,6")->select();
		//print_r($items);
		$this->assign('items',$items); 
		$this->_config_seo();
        $this->display();
    }
	
		public function zhuanguiAjax() {
		$item=M('item');
		$from = intval($_GET["from"]);
		$whereitem = array();
		$whereitem['zhuangui']=array('eq',1);
	   if(!empty($_GET['id'])){
			$whereitem['cate_id']=$_GET['id'];
				   $num = $_GET['num'];
				   if($num == 1){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 2){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 3){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 4){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else{
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }
	   }else {
			$pid = $_GET['pid'];
			$wheresid['spid'] =array('like',array('%'.$pid.'%'));
			//print_r($wheresid);
			$itemsid = M('item_cate');
			$item_cate_sid = $itemsid->field('id')->where($wheresid)->select();
			$whereitem = "cate_id in (";
			$isFirst = true;
			for ($i= 0;$i< count($item_cate_sid); $i++){
				$str= $item_cate_sid[$i];
				$strsid = $str["id"];
				if(empty($strsid)) continue;
				if(!$isFirst) {
					$whereitem .= ",";
				} else {
					$isFirst = false;
				}
				$whereitem .= $strsid;
			}
			$whereitem .= ")";
			$num = $_GET['num'];
		    if($num == 1){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 2){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 3){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 4){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else{
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }
			//echo $item->getLastSql();
		}
		$arr = array();
		$user_category = null;
		if($this->visitor->info){
            $id=$this->visitor->info['uid'];
            $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
        }
		for($i=0; $i<count($items); $i++) {
			$item = $items[$i];
			$entry["id"] = $item["id"];
			$entry["title"] = $item["title"];
			$entry["img"] = $item["img"];
			$entry["price"] = $item["price"];
			$price = $entry["price"];
			if($_SESSION['user_info']['uid'] == 0 || $_SESSION['user_info']['uid'] == '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =($item['price'])*($item['priceyuan']);
					} else {
						$price = $price;
					}
				} else {
					$price = $price;
				}
			} else {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100)*($item['priceyuan']);
					} else {
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100);
					}
				} else {
					$price =$item['price'];  
					$discount = $user_category['discount'];
					$price = $price*($discount/100);
				}
			}
			$entry["price"] = $price;
			$entry["priceyuan"] = $item["priceyuan"];
			$entry["zuzhuang"] = $item["zuzhuang"];
			$entry["zhekou"] = "";
			if($_SESSION['user_info']['uid'] != 0 && $_SESSION['user_info']['uid'] != '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$discount = $user_category['discount'];
						$discount = ($discount/10)*($item['priceyuan']);
					} else {
						$discount = $user_category['discount'];
						$discount = $discount/10;
					}
				} else {
					$discount = $user_category['discount'];
					$discount = $discount/10;
				}
			}
			$entry["zhekou"] = $discount;
			$entry["buy_num"] = $item["buy_num"];
			$entry["a__href"] = U('Item/index',array('id'=>$item['id']));
			$entry["img__src"] = attach(get_thumb($item['img'], '_b'), 'item');
			array_push($arr,$entry);
		}
		$this->ajaxReturn($arr);
	}
	
		public function zhuangui() {
	   //会员分组
		if($this->visitor->info){
            $id=$this->visitor->info['id'];
			$users =M('user')->where(array('id' =>$id))->find();
			$pid = $users['uid'];
            $user_category =M('user_category')->field('discount,id,name,score')->where(array('id' =>$pid))->find();
			$this->assign('users', $users);
			$this->assign('user_category', $user_category);
			//echo $user_category['discount'];
			//echo $users['uid'];
        }
	  /****搜索商品/夏季商品*****/
        $item=M('item');
       	$from = 0;
		if(isset($_GET["from"])) $from = intval($_GET["from"]);
		   $whereitem['zhuangui']=array('eq',1);
		   $num = $_GET['num'];
		   if($num == 1){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else if($num == 2){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else if($num == 3){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else if($num == 4){
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }else{
		   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		   }
	   
	   $this->assign('items',$items); 
		$this->_config_seo();
        $this->display();
    }
	
	    /**
     * 逛宝贝首页
     */
	 
	 public function indexAjax() {
		$item=M('item');
		$from = intval($_GET["from"]);
		       $item=M('item');
	   if(!empty($_GET['id'])){
			$whereitem['cate_id']=$_GET['id'];
				   $num = $_GET['num'];
				   if($num == 1){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 2){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 3){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 4){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else{
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }
	   }else {
			$pid = $_GET['pid'];
			$wheresid['spid'] =array('like',array('%'.$pid.'%'));
			//print_r($wheresid);
			$itemsid = M('item_cate');
			$item_cate_sid = $itemsid->field('id')->where($wheresid)->select();
			$whereitem = "cate_id in (";
			$isFirst = true;
			for ($i= 0;$i< count($item_cate_sid); $i++){
				$str= $item_cate_sid[$i];
				$strsid = $str["id"];
				if(empty($strsid)) continue;
				if(!$isFirst) {
					$whereitem .= ",";
				} else {
					$isFirst = false;
				}
				$whereitem .= $strsid;
			}
			$whereitem .= ")";
			$num = $_GET['num'];
		    if($num == 1){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 2){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 3){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 4){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else{
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }
			//echo $item->getLastSql();
		}
		$arr = array();
		$user_category = null;
		if($this->visitor->info){
            $id=$this->visitor->info['uid'];
            $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
        }
		for($i=0; $i<count($items); $i++) {
			$item = $items[$i];
			$entry["id"] = $item["id"];
			$entry["title"] = $item["title"];
			$entry["img"] = $item["img"];
			$entry["price"] = $item["price"];
			$price = $entry["price"];
			if($_SESSION['user_info']['uid'] == 0 || $_SESSION['user_info']['uid'] == '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =($item['price'])*($item['priceyuan']);
					} else {
						$price = $price;
					}
				} else {
					$price = $price;
				}
			} else {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100)*($item['priceyuan']);
					} else {
						$price =$item['price'];  
						$discount = $user_category['discount'];
						$price = $price*($discount/100);
					}
				} else {
					$price =$item['price'];  
					$discount = $user_category['discount'];
					$price = $price*($discount/100);
				}
			}
			$entry["price"] = $price;
			$entry["priceyuan"] = $item["priceyuan"];
			$entry["zuzhuang"] = $item["zuzhuang"];
			$entry["zhekou"] = "";
			if($_SESSION['user_info']['uid'] != 0 && $_SESSION['user_info']['uid'] != '') {
				if(!empty($item['zuzhuang'])){
					$huodong = time()-$item['add_time'];
					$zuzhuang = 24*60*60*$item['zuzhuang'];
					if($huodong<$zuzhuang){
						$discount = $user_category['discount'];
						$discount = ($discount/10)*($item['priceyuan']);
					} else {
						$discount = $user_category['discount'];
						$discount = $discount/10;
					}
				} else {
					$discount = $user_category['discount'];
					$discount = $discount/10;
				}
			}
			$entry["zhekou"] = $discount;
			$entry["buy_num"] = $item["buy_num"];
			$entry["a__href"] = U('Item/index',array('id'=>$item['id']));
			$entry["img__src"] = attach(get_thumb($item['img'], '_b'), 'item');
			array_push($arr,$entry);
		}
		$this->ajaxReturn($arr);
	}
	
		public function index() {
		
			   //会员分组
		if($this->visitor->info){
            $id=$this->visitor->info['id'];
			$users =M('user')->where(array('id' =>$id))->find();
			$pid = $users['uid'];
            $user_category =M('user_category')->field('discount,id,name,score')->where(array('id' =>$pid))->find();
			$this->assign('users', $users);
			$this->assign('user_category', $user_category);
			//echo $user_category['discount'];
			//echo $users['uid'];
        }

	  /****搜索商品/夏季商品*****/
	   $where['id']=$_GET['id'];
	   $item_ad = M('item_cate')->find($where);
       $this->assign('item_ad', $item_ad);
	   $from = 0;
	   if(isset($_GET["from"])) $from = intval($_GET["from"]);
	   
       $item=M('item');
	   if(!empty($_GET['id'])){
			$whereitem['cate_id']=$_GET['id'];
				   $num = $_GET['num'];
				   if($num == 1){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 2){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 3){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else if($num == 4){
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }else{
				   $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
				   }
	   }else {
			$pid = $_GET['pid'];
			$wheresid['spid'] =array('like',array('%'.$pid.'%'));
			$wheresid['pid'] =$pid;
			//print_r($wheresid);
			$itemsid = M('item_cate');
			$item_cate_sid = $itemsid->field('id')->where($wheresid)->select();
			if(isset($item_cate_sid)){
			$whereitem = "cate_id in (";
			$isFirst = true;
			for ($i= 0;$i< count($item_cate_sid); $i++){
				$str= $item_cate_sid[$i];
				$strsid = $str["id"];
				if(empty($strsid)) continue;
				if(!$isFirst) {
					$whereitem .= ",";
				} else {
					$isFirst = false;
				}
				$whereitem .= $strsid;
			}
			$whereitem .= ")";
			}else {
			$whereitem['cate_id'] =$pid;
			}
			$num = $_GET['num'];
		    if($num == 1){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('buy_num desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 2){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 3){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('price asc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else if($num == 4){
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }else{
		    $items = $item->field('id,title,img,price,priceyuan,zuzhuang,add_time,buy_num')->order('ordid asc,id desc')->where($whereitem)->limit($from.",".($from+6))->select();
		    }
			//echo $item->getLastSql();
		}
		
	   
	   $this->assign('items',$items); 
		
		/*搭配推荐*/
	   $dapei=M('item');
	   $wheredapei['cate_id'] != $_GET['id'];
       $dapeis = $dapei->field('id,title,img,price,priceyuan,buy_num')->order('ordid asc,id desc')->where($wheredapei)->limit("0,4")->select();
	   //print_r($dapeis);
	   $this->assign('dapeis',$dapeis); 
		$this->_config_seo();
		//var_dump($items);
        $this->display();
    }
	 /*搭配推荐*/
	 	 public function dapeiAjax() {
		$item=M('item');
		$from = intval($_GET["from"]);
		$where['cate_id'] != intval($_GET["cate_id"]);
		$items = $item->field('id,title,img,price')->order('ordid asc,id desc')->where($where)->limit($from.",4")->select();
		$arr = array();
		for($i=0; $i<count($items); $i++) {
			$item = $items[$i];
			$entry["id"] = $item["id"];
			$entry["title"] = $item["title"];
			$entry["img"] = $item["img"];
			$entry["price"] = $item["price"];
			$entry["a__href"] = U('Item/index',array('id'=>$item['id']));
			$entry["img__src"] = attach(get_thumb($item['img'], '_b'), 'item');
			array_push($arr,$entry);
		}
		$this->ajaxReturn($arr);
	}
	 
	 /*全部商品*/
	 
	 	 public function goodsAjax() {
		$item=M('item');
		$from = intval($_GET["from"]);
		$items = $item->field('id,title,img,price,priceyuan,zuzhuang')->order('ordid asc,id desc')->limit($from.",6")->select();
		$arr = array();
		for($i=0; $i<count($items); $i++) {
			$item = $items[$i];
			$entry["id"] = $item["id"];
			$entry["title"] = $item["title"];
			$entry["img"] = $item["img"];
			$entry["price"] = $item["price"];
			$entry["priceyuan"] = $item["priceyuan"];
			$entry["zuzhuang"] = $item["zuzhuang"];
			$entry["a__href"] = U('Item/index',array('id'=>$item['id']));
			$entry["img__src"] = attach(get_thumb($item['img'], '_b'), 'item');
			array_push($arr,$entry);
		}
		$this->ajaxReturn($arr);
	}
	
		public function goods() {

	  /****搜索商品/夏季商品*****/
        $item=M('item');
        $items = $item->field('id,title,img,price')->order('ordid asc,id desc')->limit("0,6")->select();
		//print_r($items);
		$this->assign('items',$items); 
		$this->_config_seo();
        $this->display();
    }
	
	public function good() {
		$keyword=$_GET['keyword'];
		$keyword=$keyword ? $keyword:$_POST['keyword'];
		if($keyword){
			$data['title']=array('like','%'.$keyword.'%');
			$items = M('item')->where($data)->select();
			$this->assign('search','1');
		}else{
			if($_GET['search']==1){
				$this->assign('search','1');
			}
			//获取所有产品
			$items = M('item')->where(array('status'=>1))->select();
		}
		$item=array();
		foreach($items as $value){
			$res=explode('|',$value['yhprice']);
			$value['yhprice']=$res[0];
			array_push($item,$value);
		}
		$this->assign('keyword',$keyword);
		$this->assign('items',$item);
		$this->_config_seo();
        $this->display();
    }
	
	public function goodclass() {
		$item_cate=M('item_cate');
		$itemArrRv = array();
		$item_cateEnyArr = $item_cate->field('id,pid,name')->where(array("pid"=>0))->order('ordid asc,id asc')->select();
		//echo count($item_cateEnyArr);
		for($i=0; $i<count($item_cateEnyArr); $i++) {
			$item_cateEny = $item_cateEnyArr[$i];
			//Iprint_r($item_cateEny);
			$itemArrRv2 = array();
			$item_cateEnyArr2 = $item_cate->field('id,pid,name')->where(array("pid"=>$item_cateEny["id"]))->order('ordid asc,id asc')->select();
			for($j=0; $j<count($item_cateEnyArr2); $j++) {
				$item_cateEny2 = $item_cateEnyArr2[$j];
				$item_cateEnyArr3 = $item_cate->field('id,pid,name')->where(array("pid"=>$item_cateEny2["id"]))->order('ordid asc,id asc')->select();
				array_push($itemArrRv2,array($item_cateEny2,$item_cateEnyArr3));
			}
			//print_r($itemArrRv2);
			array_push($itemArrRv,array($item_cateEny,$itemArrRv2));
			
		}
		//print_r($itemArrRv);
		
		//$item_cate = $item_cate->field('id,pid,name')->order('ordid asc,id asc')->select();
		//print_r($item_cate);
		$this->assign('itemArrRv',$itemArrRv); 
		$this->_config_seo();
		$this->display();
	}
	
}