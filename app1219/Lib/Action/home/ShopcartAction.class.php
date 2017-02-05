<?php
class ShopcartAction extends frontendAction {
	
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
	
	
	public function addcart()//添加进购物车
    {
    	//获取数据
		$goodId = $this->_get('goodId', 'intval');//商品ID
		$size=$this->_get('size', 'trim');//规格
    	$quantity = $this->_get('quantity', 'intval');//购买数量
		$data['num']=$quantity;
		$shopid = $this->_get('shopid');//店铺ID
		$data['shopid'] =  $shopid;
		$data['id']= $goodId;
		$item=M('item')->field('goods_stock,cost,title,itemtype,baseid,img,yhprice,size,price,activity,sale_quantity')->where('id='.$goodId)->find();
		
		
		if($item){
			
			if($item['activity']==1&&$item['sale_quantity']>0&&$quantity>$item['sale_quantity']){
				$jsonArr=array('status'=>0,'msg'=>'您选择的数量大于抢购剩余名额');
				echo json_encode($jsonArr);
				exit;
			}
			
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
				
					$cartId = M('cart')->add($data);
					
					
					if($cartId){
						$ret=M('cart')->where(array('uid' => $this->visitor->info['id'],'shopid' => $shopid))->field('num,price')->select();
						$cart_count = 0;
						$cart_price = 0;
						foreach($ret as $key => $val){
							$cart_count += $val['num'];
							$cart_price += $val['num']*$val['price'];
						}
						$jsonArr=array('status'=>1,'cartId'=>$cartId.'','cart_count'=>$cart_count,'cart_price'=>$cart_price,'msg'=>'商品已成功添加到购物车');
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
		
		//更新购物车价格
		$m_cart = M('cart');
		$icarts = $m_cart->where(array('uid'=>$this->visitor->info['id']))->select();
		foreach ($icarts as $v){
			 $shop = M('item')->where(array('id'=>$v['id']))->find();
			//判断是否存在规格
			if(!empty($v['size'])){
				$price = explode('|',$shop['yhprice']);
				$size = explode('|',$shop['size']);
				foreach($size as $key => $val){
					if($v['size'] == $val){
						if($v['price'] != $price[$key]){
							$m_cart->where(array('mainid'=>$v['mainid']))->setField('price',"$price[$key]");
						}
					}
				}
			}else{
				if($shop['price']!=$v['price']){
					$cedit_data['price'] = $shop['price'];
					$m_cart->where(array('id'=>$v['id'],'uid'=>$this->visitor->info['id']))->save($cedit_data);
				}
			}
		}
		
		//判断商品是否已经下架，如果是则从购物车中删除。
		$icart = M('cart')
		->join("a left join weixin_item as b on a.id = b.id")
		->where(array('a.uid'=>$this->visitor->info['id']))
		->select();
		
		foreach($icart as $vol){
			//如果购物车存在虚拟商品则将符合条件的商品删除
			if($vol['status'] == 0 || $vol['is_fictitious'] == 1){
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
			$result = M('cart')->where(array('id' => $val,'shopid' => session('shopid'),'uid' => $this->visitor->info['id']))->select();
			$cart_count = 0;
			foreach($result as $k => $v){
				$cart_count += $v['num'];
			}
			$result[0]['num'] = $cart_count;
			$item[] = $result[0];
		}
		
		//购物车中所有有商品规格的记录  根据规格在进行合并,根据uid和size
		$ret2 = M('cart')->where("shopid = ".session('shopid')." and uid = ".$this->visitor->info['id']." and size != ''")->select();
		$arr2 = array();
		foreach($ret2 as $key => $val){  //剔除uid重复项
			$arr2[$val['id']] = $val['id'];
		} 
		
		foreach($arr2 as $key => $val){
			$result = M('cart')->where(array('id' => $val,'shopid' => session('shopid'),'uid' => $this->visitor->info['id']))->select();//不同规格的同一产品
			
			$arr3 = array();
			foreach($result as $k => $v){  //购物车中已添加的规格,剔除重复项
				$arr3[$v['size']] = $v['size'];
			}
			
			foreach($arr3 as $k => $v){
				$ret = M('cart')->where(array('id' => $val,'shopid' => session('shopid'),'uid' => $this->visitor->info['id'],'size' => $v))->select();//不同规格的同一产品
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
		
		/*
		foreach($item as $key => $val){			//获取购物车商品的类型 完税/保税
			$item[$key]['itemtype'] = M('item')->where('id ='.$val['id'])->getField('itemtype');
		}*/
		
		/**************************************************************************************/
		
		//合并购物商品属于哪个商家
		$merchant = M('User')->where('id='.session('shopid'))->find();
		$this->assign('merchant',$merchant['merchant']);
		/*$u=array();
			foreach($item as $k=>&$e){
				$name=&$e['shopid'];
				if(!isset($u[$name])){
					$u[$name]=$e;
					unset($u[$name]['id'],$u[$name]['name'],$u[$name]['price'],$u[$name]['img'],$u[$name]['attr'],$u[$name]['size'],$u[$name]['discount'],$u[$name]['zuzhuang'],$u[$name]['itemtype'],$u[$name]['num'],$u[$name]['cost']);
				}
				$u[$name]['goodsifno'][]=array('id'=>$e['id'],'name'=>$e['name'],'price'=>$e['price'],'img'=>$e['img'],'attr'=>$e['attr'],'size'=>$e['size'],'discount'=>$e['discount'],'zuzhuang'=>$e['zuzhuang'],'itemtype'=>$e['itemtype'],'num'=>$e['num'],'cost'=>$e['cost']);
			}
		$item=array_values($u); unset($u);
		array_push($item[0],$merchant['merchant']);	//组合输出*/

	    foreach($item as $k=>$v){
	        //会员价格
	        if($this->visitor->info){
	            $cate_id=$this->visitor->info['uid'];
				$cate =M('item')->where(array('id'=>$v['id']))->find();
				//判断购物车的库存
				if(!empty($v['size'])){
                    $specification = explode('|', $cate['size']);
                    $kucun = explode('|', $cate['goods_stock']);
                    foreach ($specification as $key => $val) {
                        if ($v['size'] == $val) {
                                $item[$k]['kucun'] = $kucun[$key];
                        }
                    }
                }else{
                    $item[$k]['kucun'] = $cate['goods_stock'];
                }
	            $user_cate = M('user_category')->field('discount')->where(array('id'=>$cate_id))->find();
	            $zhekou = $user_cate['discount']/100;
	            $priceyuan = M('item')->field('priceyuan')->where(array('id'=>$v['id']))->find();
	            $priceyuan = $priceyuan['priceyuan']/10;
	           /*  $item[$k]['price'] = $cate['yhprice']; */
	        }else{
	            $cate =M('item')->where(array('id'=>$v['id']))->find();
	            $zhekou = $cate['priceyuan']/10;
	            /* $item[$k]['price'] = $cate['yhprice']; */
			}
	    }
	 
	    $_SESSION['ncart']=$item;//s刷新session

	    foreach($item as $k=>$v){
	        //属性
	        $attr_arr=array_filter(explode(";",$v['attr']));
	        $attr_list=array();
	        foreach($attr_arr as $key=>$val){
	            $attr_arr2=array_filter(explode("|",$val));
	            $attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
	        }
	        $item[$k]['attr']=$attr_list;
	        $item[$k]['seid']=$k;
	    }
		
			//按照用户的浏览记录进行随机显示
		    $itemsbuy = M('posslike')
			->join("a left join weixin_item as b on a.itemid = b.id")
			->field("a.*,b.*")
			->where(array('a.userid'=>$this->visitor->info['id'],'b.status'=>1))
			->order('rand()')
			->limit(30)
			->select();
			
			if(count($itemsbuy) < 30){
				$itemsbuy = M('item')->where('status=1')->order('paynum desc')->limit(8)->select();
			}
			$this->assign('itemsbuy', $itemsbuy);
			/*dump($itemsbuy);exit;*/
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
		//dump($item);exit;
		$this->assign('item',$item);
		$this->assign('cart_count',count($_SESSION['ncart']));
		$this->assign('sumPrice',$cart->getPrice());

		  //sail 代金券
		  $uid = $this->visitor->info['id'];
		  $jifenItemArr = array();
		  if($uid) {
		  	$jifenItemArr = M("item_jifen")->query("select * from __TABLE__ where state=0 and orderId is null and uid=".$uid." group by title order by title desc");
		  }
		  $this->assign('jifenItemArr',$jifenItemArr);
		  
		  $this->_config_seo();
		  
		  //运费设置，不满99元需要运费
		  $yunfei = M('setting')->where("name='site_yunfei'")->find(); 
		  if($cart->getPrice()<99){
		  	$this->assign('yunfei',$yunfei['data']);
		  }
		  
		  $store = M('user')->where(array('id'=>$_SESSION['shopid']))->find();
		  $this->assign('item_id',$_GET['item_id']);
		  $this->assign('store',$store);
		  //dump($_SESSION['cart']);exit;
		  $this->assign('uid',$uid);
		  $this->display();
    }

    public function remove_cart_items()//删除购物车所有商品
    {	
    	import('Think.ORG.Cart');// 导入购物车类
    	$cart=new Cart();
 
    	$userid=$_GET['userid'];//商品ID
		
		//从数据库购物车表中删除该商品内容
		$sql_id="delete from weixin_cart where uid=".$userid;
		mysql_query($sql_id);
		
        $id=$item;
        $cart->delItem($id);
    	$data=array('status'=>1);
    	$this->redirect('Shopcart/index');
    }	 
	/*
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

		$where['shopid']=$shopid;
    	$where['uid'] = session('shopid');
		$where['id'] = $goodId;

		$Form   =   D('cart');
		$Form->id=$goodId;
		$Form->name=$title;
		$Form->img=$img;
		$Form->price=$price;
		$Form->num=$quantity;
		$Form->uid=session('shopid');
		$Form->shopid=$shopid;




		$ret = M('cart')->where($where)->select();
		if(count($ret)>1){
		 	$data=array('result'=>1,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice(),'msg'=>'该商品已经存在购物车,为您数量加1');
		 	$data_num['num'] = $ret['num']+1;
		 	M('cart')->where($where)->save($data_num);
		}else{
			$Form->add();
		}
    	
*/
  
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
		$is_fictitious= $this->_post('is_fictitious','trim');
		
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
		$Form->is_fictitious=$is_fictitious;
		if(isset($is_bargain)){
			$Form->is_bargain=$is_bargain;
		}
		if(!empty($size)){
			$Form->size=$size;
		}
		
		$item=M('item')->field('id,title,img,yhprice,size,color,goods_stock,zuzhuang,priceyuan,add_time,itemtype,cost,activity,sale_quantity')->find($goodId);
		if($item['activity']==1&&$item['sale_quantity']>0&&$quantity>$item['sale_quantity']){
			$jsonArr=array('status'=>0,'msg'=>'您选择的数量大于抢购剩余名额');
			echo json_encode($jsonArr);
			exit;
		}

		$cartId=$Form->add();
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
    			if(count($_SESSION['ncart']) == 1){
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
    
    public function remove_cart_item()//删除购物车商品
    {
		$this->assign('item_id',$_GET['item_id']);
    	import('Think.ORG.Cart');// 导入购物车类
    	$cart=new Cart();
 
    	$mainId=$_GET['id'];//商品ID
		
		//从数据库购物车表中删除该商品内容
		$sql_id="delete from weixin_cart where mainid=".$mainId;
		mysql_query($sql_id);
		
        $id=$item;
        $cart->delItem($id);
    	$data=array('status'=>1);
    	echo json_encode($data);
    }
    
    public function change_quantity()
    {
    	import('Think.ORG.Cart');// 导入购物车类
        $cart=new Cart();
    	$itemId= $this->_post('itemId', 'intval');//商品ID  mainid
		$id=M('cart')->where('mainid ='.$itemId)->getField('id');
    	$quantity= $this->_post('quantity', 'intval');//购买数量
    	$seid= $this->_post('seid','intval');//sessionID
		
		
        //dump($seid);exit;
    	$size=$this->_post('size','trim');//规格
    	$item=M('item')->field('goods_stock,size,activity,sale_quantity')->where(array('id'=>$id))->find();
		if($item['activity']==1&&$quantity>$item['sale_quantity']){
			$jsonArr=array('status'=>0,'msg'=>'您选择的数量大于抢购剩余名额');
			echo json_encode($jsonArr);
			exit;
		}
	
		if($item['size']&&!empty($size)){
			$goods_stocks=explode('|',$item['goods_stock']);
			$sizes=explode('|',$item['size']);
		
			foreach($sizes as $key=>$val){
				if($val == $size){
					$stock= $goods_stocks[$key];//商品价格
					break;
				}
			}
		}else{
			$stock= $item['goods_stock'];
		}
 
    	if($stock<$quantity)
    	{
    	$data=array('status'=>0,'msg'=>'该商品的库存不足');
    	}else {	
		//暂时采用原生混写,更新购物车表中的商品数量 -> num
		$sql_up="update weixin_cart set num='".$quantity."' where mainid=".$itemId;
		$data_up=mysql_query($sql_up);
		$cart->modNum($seid,$quantity);
		$data=array('status'=>1,'item'=>$cart->getItem($seid),'sumPrice'=>$cart->getPrice(),'discount'=>$cart->getdiscount()); 
    	}
    	
    	echo json_encode($data);
    }
    
    public function checkUser(){
    	if(!empty($this->visitor->info['uid'])){
    		
    	}else{
    		$this->error('请先登陆');
    	}
    }
}