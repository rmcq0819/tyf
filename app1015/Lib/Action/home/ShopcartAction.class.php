<?php
class ShopcartAction extends frontendAction {
	
/***********************************************************app接口-start****************************************************************/	
	/***** 购物车"猜你喜欢"商品 *****/
	public function likeitems(){
		$itemsbuy = M('posslike')->join("a left join weixin_item as b on a.itemid = b.id")
								 ->field("b.id,b.img,b.title,b.price")
								 ->where(array('a.userid'=>$this->visitor->info['id']))
								 ->order('rand()')
								 ->limit(8)
								 ->select();
		if(count($itemsbuy) < 8){
			$itemsbuy = M('item')->where('status=1')->order('paynum desc')->limit(8)->field('img,title,price,id')->select();
		}
		if(count($itemsbuy)>0){
			foreach($itemsbuy as $key=>$val){
				$itemsbuy[$key]['img'] = "http://yooopay.com/data/upload/item/".$val['img'];
			}
			$jsonArr['items'] = $itemsbuy;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	
    public function remove_cart_items()//删除购物车所有商品
    {	
		//从数据库购物车表中删除该用户所有商品内容
		if(M('cart')->where(array('uid'=>$this->visitor->info['id']))->delete()){
			$jsonArr=array('status'=>1,'msg'=>'购物车已清空');
		}else{
			$jsonArr=array('status'=>0,'msg'=>'购物车清空失败');
		}
		echo json_encode($jsonArr);
    }	 

  
    public function addcart()//添加进购物车
    {
    	//获取数据
		$goodId = $this->_get('goodId', 'intval');//商品ID
		$size=$this->_get('size', 'trim');//规格
		$quantity = $this->_get('quantity', 'intval');//购买数量
		$data['num']=$quantity;
		$shopid = $this->_get('shopid');//店铺ID
		$data['shopid']= $shopid;//店铺ID
		$data['id']= $goodId;
		$item=M('item')->field('goods_stock,cost,title,itemtype,baseid,img,yhprice,size,price')->where('id='.$goodId)->find();
		
		
		if($item){
			if($item['size']&&empty($size)){
				$jsonArr=array('status'=>0,'msg'=>'请选择规格');
			}else{
				if(!empty($size)){
				
					$prices=explode('|',$item['yhprice']);
					$goods_stocks=explode('|',$item['goods_stock']);
					$sizes=explode('|',$item['size']);
					$costs=explode('|',$item['cost']);
				
					foreach($sizes as $key=>$val){
						if($val == $size){
							$cost = $costs[$key];//相应规格的成本价
							$price= $prices[$key];//商品价格
							$stock= $goods_stocks[$key];//商品价格
							break;
						}
					}
					$data['size']=$size;
					$where['size']=$size;
				}else{
					$cost = $item['cost'];//相应规格的成本价
					$price= $item['price'];//商品价格
					$stock= $item['goods_stock'];//商品价格
				}
				
				$data['cost'] = $cost;//相应规格的成本价
				$data['price']= $price;//商品价格
				
				$data['name']= $item['title'];//商品标题
				$data['img']= $item['img'];//商品图片
				$data['itemtype']= $item['itemtype'];//商品类型
				$data['baseid']= $item['baseid'];//免税仓id
				
				$data['uid']= $this->visitor->info['id'];//用户ID
				
				if($stock<$quantity){
					$jsonArr=array('status'=>0,'msg'=>'库存不足');
				}else{
					
					$where['id'] = $goodId;
					$where['shopid'] = $shopid;
					$where['uid']= $this->visitor->info['id'];
					$cart = M('cart')->where($where)->field('mainid,num')->find();
					if($cart){
						M('cart')->where(array('mainid'=>$cart['mainid']))->setInc('num',$quantity);
						$cartId = $cart['mainid'];
					}else{
						$cartId = M('cart')->add($data);
					}
					
					
					$count=M('cart')->where(array('uid' => $this->visitor->info['id'],'shopid' => $shopid))->count();
					
					if($cartId){
						$jsonArr=array('status'=>1,'cartId'=>$cartId.'','cart_count'=>$count,'msg'=>'商品已成功添加到购物车');
					}else{
						$jsonArr=array('status'=>0,'msg'=>'添加购物车失败');
					}
				}
			}
    	}else{
    		$jsonArr=array('status'=>0,'msg'=>'不存在该商品');
		} 
		
    	echo json_encode($jsonArr);
    }
    
    public function remove_cart_item()//删除购物车商品
    {
    	$mainId=$_GET['id'];//商品ID
		//从数据库购物车表中删除该商品内容
		if(M('cart')->where(array('mainid'=>$mainId))->delete()){
			$jsonArr=array('status'=>1,'msg'=>'商品已成功被删除');
		}else{
			$jsonArr=array('status'=>0,'msg'=>'商品删除失败');
		}
    	echo json_encode($jsonArr);
    }
    
    public function change_quantity()
    {
    	$mainid= $this->_post('itemId', 'intval');
		$id=M('cart')->where(array('mainid'=>$mainid))->getField('id');//商品ID
    	$quantity = $this->_post('quantity', 'intval');//购买数量
		$data['num']=$quantity;
    	$item=M('item')->field('goods_stock')->where(array('id'=>$id))->find();
    	if($item['goods_stock']<$quantity){
			$jsonArr=array('status'=>0,'msg'=>'库存不足');
    	}else {
			if(M('cart')->where(array('mainid'=>$mainid))->save($data)){
				$cartItem = M('cart')->where(array('mainid'=>$mainid))->field('num,price')->find();
				$jsonArr=array('status'=>1,'item'=>$cartItem,'msg'=>'修改数量成功');
			}else{
				$jsonArr=array('status'=>0,'msg'=>'修改数量失败');
			} 
    	}
    	echo json_encode($jsonArr);
    }
	
	public function cart_items(){//购物车内容
		$shopid = $this->_get('shopid','intval');
		//判断商品是否已经下架，如果是则从购物车中删除。
		$icart = M('cart')->join("a left join weixin_item as b on a.id = b.id")
						  ->where(array('a.uid'=>$this->visitor->info['id']))
						  ->select();
		
		foreach($icart as $vol){
			if($vol['status'] == 0){
				$where['id'] = array('in',$vol['id']); //商品id
				$where['uid'] = $this->visitor->info['id']; //会员id
				M('cart')->where($where)->delete();
			}
		}
		
		//将id相同的产品进行累加(num)   
		$where['uid'] = $this->visitor->info['id'];

		//购物车中所有没有商品规格的记录  需进行合并,根据uid进行
		$ret1 = M('cart')->where("shopid = ".$shopid." and uid = ".$this->visitor->info['id']." and size = '' and is_show=0")->field('id')->select();
		$arr1 = array();
		foreach($ret1 as $key => $val){     //剔除uid重复项
			$arr1[$val['id']] = $val['id'];
		} 
		
		//进行合并
		$item = array();   
		foreach($arr1 as $key => $val){
			$result = M('cart')->where(array('id' => $val,'shopid' => $shopid,'uid' => $this->visitor->info['id'],'is_show'=>0))
							   ->field('num,img,name,size,itemtype,id,price,mainid,baseid')
							   ->select();
			$cart_count = 0;
			foreach($result as $k => $v){
				$cart_count += $v['num'];
			}
			$result[0]['num'] = $cart_count;
			$item[] = $result[0];
		}
		
		//购物车中所有有商品规格的记录  根据规格再进行合并,根据uid和size
		$ret2 = M('cart')->where("shopid = ".$shopid." and uid = ".$this->visitor->info['id']." and size != '' and is_show = 0")
						 ->field('id')
						 ->select();
		$arr2 = array();
		foreach($ret2 as $key => $val){  //剔除uid重复项
			$arr2[$val['id']] = $val['id'];
		} 
		
		foreach($arr2 as $key => $val){
			$result = M('cart')->where(array('id' => $val,'shopid' => $shopid,'uid' => $this->visitor->info['id'],'is_show'=>0))
							   ->select();//不同规格的同一产品
			
			$arr3 = array();
			foreach($result as $k => $v){  //购物车中已添加的规格,剔除重复项
				$arr3[$v['size']] = $v['size'];
			}
			
			foreach($arr3 as $k => $v){
				$ret = M('cart')->where(array('id' => $val,'shopid' => $shopid,'uid' => $this->visitor->info['id'],'size' => $v,'is_show'=>0))
								->field('num,img,name,size,itemtype,id,price,mainid,baseid')
								->select();//不同规格的同一产品
				$cart_count = 0;
				foreach($ret as $kk => $vv){  //合并不同规格的同一产品
					$cart_count += $vv['num'];
				}
				$ret[0]['num'] = $cart_count;
				$item[] = $ret[0];
			}	
		}
		
		$arr4 = array();   			//改写合并后购物车记录中的num字段
		foreach($item as $key => $val){
			$arr4[] = $val['mainid'];
			$data['num'] = $val['num'];
			M('cart')->where('mainid ='.$val['mainid'])->save($data);
		}
	
		if(count($arr4)>0){
			$wh['mainid'] = array('not in',$arr4);  //合并购物车记录后删除多余记录
			$wh['uid'] = $this->visitor->info['id'];
			$wh['shopid'] = $shopid;
			M('cart')->where($wh)->delete();
		}
		
		
		if(count($item)>0){
			foreach($item as $key=>$val){
				$item[$key]['img'] =  "http://yooopay.com/data/upload/item/".$val['img'];
			}
			$jsonArr['item'] = $item;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
    	echo json_encode($jsonArr);
	}
	
	
	//购物车记录条数
	public  function cart_count(){
		$shopid = $this->_get('shopid','intval');
		$count=M('cart')->where(array('uid' => $this->visitor->info['id'],'shopid' => $shopid))->count();
		$jsonArr['status'] = 1;
		$jsonArr['cart_count'] = $count;
		echo json_encode($jsonArr);
		
	}
/***********************************************************app接口-end****************************************************************/	
   	  public function _initialize() {
        parent::_initialize();
		
		$this->_mod = D('user');
		$this->checkUser();
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
		
        import('Think.ORG.Cart');// 导入分页类
    	$cart=new Cart();
    	  
    }
	
	public function shouhuodizhi() {
		$user = M("user")->where(array("username"=>"__匿名购物__"))->find();
		$_SESSION['user_info'] = $user;
	}
	//sail 判断是否需要匿名购物
	public function isNiming() {
		if(!$this->visitor->is_login){
			echo json_encode(array(true));
			return;
		}
		echo json_encode(array(false));
		return;
	}

    public function index(){
		import('Think.ORG.Cart');// 导入分页类
    	$cart=new Cart();
		
		//判断商品是否已经下架，如果是则从购物车中删除。
		$icart = M('cart')
		->join("a left join weixin_item as b on a.id = b.id")
		->where(array('a.uid'=>$this->visitor->info['id']))
		->select();
		
		foreach($icart as $vol){
			if($vol['status'] == 0){
				$where['id'] = array('in',$vol['id']); //商品id
				$where['uid'] = $this->visitor->info['id']; //会员id
				M('cart')->where($where)->delete();
			}
		}
		
		/**************************************************************************************/
		//将id相同的产品进行累加(num)   
		$where['uid'] = $this->visitor->info['id'];
		
		$item_id = isset($_GET['item_id'])?$this->_get('item_id','intval'):0;
		$this->assign('item_id',$item_id);

		//购物车中所有没有商品规格的记录  需进行合并,根据uid进行
		$ret1 = M('cart')->where("shopid = ".session('shopid')." and uid = ".$this->visitor->info['id']." and size = ''")->select();
		$arr1 = array();
		foreach($ret1 as $key => $val){     //剔除uid重复项
			$arr1[$val['id']] = $val['id'];
		} 
		
		//进行合并
		$item = array();   
		foreach($arr1 as $key => $val){
			$result = M('cart')->where(array('id' => $val,'shopid' => session('shopid'),'uid' => $this->visitor->info['id']))
							   ->field('num,img,name,size,itemtype,id,price,mainid,baseid')
							   ->select();
			$cart_count = 0;
			foreach($result as $k => $v){
				$cart_count += $v['num'];
			}
			$result[0]['num'] = $cart_count;
			$item[] = $result[0];
		}
		
		//购物车中所有有商品规格的记录  根据规格在进行合并,根据uid和size
		$ret2 = M('cart')->where("shopid = ".session('shopid')." and uid = ".$this->visitor->info['id']." and size != ''")
						 ->select();
		$arr2 = array();
		foreach($ret2 as $key => $val){  //剔除uid重复项
			$arr2[$val['id']] = $val['id'];
		} 
		
		foreach($arr2 as $key => $val){
			$result = M('cart')->where(array('id' => $val,'shopid' => session('shopid'),'uid' => $this->visitor->info['id']))
							   ->select();//不同规格的同一产品
			
			$arr3 = array();
			foreach($result as $k => $v){  //购物车中已添加的规格,剔除重复项
				$arr3[$v['size']] = $v['size'];
			}
			
			foreach($arr3 as $k => $v){
				$ret = M('cart')->where(array('id' => $val,'shopid' => session('shopid'),'uid' => $this->visitor->info['id'],'size' => $v))
								->field('num,img,name,size,itemtype,id,price,mainid,baseid')
								->select();//不同规格的同一产品
				$cart_count = 0;
				foreach($ret as $kk => $vv){  //合并不同规格的同一产品
					$cart_count += $vv['num'];
				}
				$ret[0]['num'] = $cart_count;
				$item[] = $ret[0];
			}	
		}
		
		$arr4 = array();   			//改写合并后购物车记录中的num字段
		foreach($item as $key => $val){
			$arr4[] = $val['mainid'];
			$data['num'] = $val['num'];
			M('cart')->where('mainid ='.$val['mainid'])->save($data);
		}
	
		if(count($arr4)>0){
			$wh['mainid'] = array('not in',$arr4);  //合并购物车记录后删除多余记录
			$wh['uid'] = $this->visitor->info['id'];
			$wh['shopid'] = session('shopid');
			$abc=M('cart')->where($wh)->delete();
		}
		
		
		/**************************************************************************************/
		
	
		$mainIds = array();
	    foreach($item as $k=>$v){
			$mainIds[$k]['mainid'] = $v['mainid'];
	        $item[$k]['seid']=$k;
	    }
	    $_SESSION['cart']=$mainIds;//s刷新session
		
		//按照用户的浏览记录进行随机显示
		$itemsbuy = M('posslike')
		->join("a left join weixin_item as b on a.itemid = b.id")
		->field("b.id,b.img,b.title,b.price")
		->where(array('a.userid'=>$this->visitor->info['id']))
		->order('rand()')
		->limit(8)
		->select();
		if(count($itemsbuy) < 8){
			$itemsbuy = M('item')->where('status=1')->order('paynum desc')->limit(8)->field('img,title,price,id')->select();
		}
		$this->assign('itemsbuy', $itemsbuy);
		
		

		$this->assign('item',$item);
		$cart_count = count($_SESSION['cart']);
		$this->assign('cart_count',$cart_count);
		$this->assign('sumPrice',$cart->getPrice());


		$this->_config_seo();

		//运费设置，不满99元需要运费
		$yunfei = M('setting')->where("name='site_yunfei'")->find(); 
		if($cart->getPrice()<99){
			$this->assign('yunfei',$yunfei['data']);
		}


		$this->assign('item_id',$_GET['item_id']);
		$this->assign('uid',$this->visitor->info['id']);
		
		$this->display();
    }
	
   public function add_cart()//添加进购物车
    {
    	 import('Think.ORG.Cart');// 导入分页类
    	 $cart=new Cart();
		 //unset($_SESSION);
		 
    	$goodId= $this->_post('goodId', 'intval');//商品ID
    	$quantity=$this->_post('quantity', 'intval');//购买数量
		$size=$this->_post('size', 'trim');//颜色
		$yhprice=$this->_post('yhprice','trim');
		$discount=$this->_post('discount', 'trim');//折扣
		$cost = $this->_post('cost', 'trim');//相应规格的成本价
		$attr= $this->_post('attr');//商品属性
		$title= $this->_post('title');//商品标题
		$img= $this->_post('img');//商品图片
		$price= $this->_post('price');//商品价格
		$shopid= $this->_post('shopid');//会员shopid
		$itemtype= $this->_post('itemtype');//商品类型
		$baseid= $this->_post('baseid');//免税仓id
		$is_bargain= $this->_post('is_bargain');//是否为参与活动商品
		
		//向数据库添加购物车内容
		$Form   =   D('cart');
		$Form->id=$goodId;
		$Form->name=$title;
		$Form->img=$img;
		$Form->price=$price;
		$Form->num=$quantity;
		$Form->cost=$cost;
		$Form->uid=$this->visitor->info['id'];
		$Form->shopid=$shopid;
		$Form->itemtype=$itemtype;
		$Form->baseid=$baseid;
		if(isset($is_bargain)){
			$Form->is_bargain=$is_bargain;
		}
		if(!empty($size)){
			$Form->size=$size;
		}
		$cartId=$Form->add();

    	$item=M('item')->field('id,title,img,yhprice,size,color,goods_stock,zuzhuang,priceyuan,add_time,itemtype,cost')->find($goodId);
		//sail 根据净含量$color重新获得价格
		$colorArr = explode("|",$item["color"]);
		$index = -1;
		for($i=0;$i<count($colorArr);$i++) {
			if(trim($colorArr[$i]) == $color) {
				$index = $i;
				break;
			}
		}
		$price = $yhprice;
		/*$sizeArr = explode("|",$item["size"]);
		if($index != -1 && count($sizeArr) > $index) {
			$price = intval($sizeArr[$index]);
		}
		if(!empty($item['zuzhuang'])){
			$huodong = time()-$item['add_time'];
			$zuzhuang = 24*60*60*$item['zuzhuang'];
			//echo($item['add_time']);echo("--");echo($zuzhuang);exit;
			if($huodong<$zuzhuang){
				$price = $price ;
			}
		}*/
		//sail
    	if(!is_array($item))
    	{
    		$data=array('status'=>0,'msg'=>'不存在该商品','count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice());
    	}elseif($item['goods_stock']<$quantity){
    		//$data=array('status'=>0,'msg'=>'没有足够的库存','count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice());
			$data=array('cartId'=>$cartId,'result'=>$result,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$price,'msg'=>'商品已成功添加到购物车');
    	}else {
			$shopid = session('shopid');
    		$result= $cart->addItem($item['id'],$item['title'],$price,$quantity,$size,$discount,$zuzhuang,$item['img'],$item['itemtype'],$cost,$attr,$shopid);
    		if($result==1)//购物车存在该商品
    		{
    			$data=array('cartId'=>$cartId,'result'=>$result,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice(),'msg'=>'该商品已经存在购物车');
    		}else{
    			$price = $cart->getPrice() - 0;
    			if(count($_SESSION['cart']) == 1){
    				$price = round($price,2);
    			}else{
    				$price = round($price,2);
    			}
    			$data=array('cartId'=>$cartId,'result'=>$result,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$price,'msg'=>'商品已成功添加到购物车');
    		}
    	}
    	
    	//$data=array('status'=>2);
    	echo json_encode($data);
    }

   public function checkUser(){
    	if(!empty($this->visitor->info['uid'])){
    		
    	}else{
    		$this->error('请先登陆');
    	}
    }
}