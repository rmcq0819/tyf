<?php
class fpingshopAction extends frontendAction {
	
	public function index(){
		$uid = $this->visitor->info['id'];
		$level = $this->visitor->info['uid']; 
		$point_yuer = $this->visitor->info['points']; 
		$oitem = M('item');
		//获取范票商品信息
		$fp_detail = $oitem->where(array('id'=>4731))->field('price,buy_num,title')->find();
		$where['is_fping'] = 1;
		$where['status'] = 1;
		$bargain_list = $oitem->where($where)->order('ordid asc')->select();
		$fping_count = M('fpingshop')->where(array('user_id'=>$uid))->count();
		
		$this->assign('fp_detail',$fp_detail);
		$this->assign('bargain_list',$bargain_list);
		$this->assign('point_yuer',$point_yuer);
		$this->assign('fping_count',$fping_count);
		$this->display();
	}
	
	public function fping_pay(){
		if(IS_POST){
			$hotshop = M('user')->where(array('id'=>$_SESSION['shopid']))->field('v1')->find();
			$item_order=M('item_order');
		    $order_detail=M('order_detail');
			$items = M('item');
			$uid = $this->visitor->info['id'];
			$point_yuer = $this->visitor->info['points'];
			$id = $this->_post('id','trim');
			$fping_num = $this->_post('fping_num','trim');
			$fping_price = $this->_post('fping_price','trim');
			$uname = $this->visitor->info['username'];
			//获取商品信息
			$item_detail = $items->where(array('id'=>$id))->find();
			if($point_yuer < $fping_num){
				echo json_encode(array('status'=>0));
			}else{
				if($hotshop['v1'] == 1){
					$del_point =  M('user')->where(array('id'=>$uid))->setDec('points',$fping_num);
					if($del_point){
						$data['user_id'] = $uid;
						$data['item_id'] = $id;
						$data['fping_num'] = $fping_num;
						$data['fping_price'] = $fping_price;
						$data['add_time'] = time();
						$save = M('fpingshop')->add($data);
						if($save){
							   $yunfei = 10; // 运费
							   $dingdanhao = date("Y-m-dH-i-s");
							   $dingdanhao = str_replace("-","",$dingdanhao);
							   $dingdanhao .= rand(1000,2000);
							   $times = time();//订单添加时间
							   //获取地址信息
							   $address_info = M('user_address')->where(array('uid'=>$uid))->find();
							   if($item_detail['price'] < 99){
								   $order_data['yunfei'] = $yunfei;
								   $order_data['order_sumPrice'] = $fping_price+$yunfei; //订单总额+运费
							   }else{
								   $order_data['order_sumPrice'] = $fping_price; // 订单总额
							   }
							   $order_data['goods_sumPrice'] = $fping_price; //商品总额
							   $order_data['freetype']= 0; 
							   $order_data['freeprice']= 0;
							   $order_data['userId'] = $uid; //用户ID
							   $order_data['userName'] = $uname; //用户名
							   $order_data['shopid'] = session('shopid'); //店铺ID
							   $order_data['orderId']= $dingdanhao.'-04'; //兑换商品订单号
							   $order_data['add_time']= $times; //订单时间
							   $order_data['status'] = 1; //订单状态
							   $order_data['baseid'] = $item_detail['baseid']; //免税仓ID
							   $order_data['is_fping'] = 1; //是否为兑换商品
							   $order_data['address_name'] = $address_info['consignee']; //收货人姓名
							   $order_data['mobile'] = $address_info['mobile']; //收货人手机号码
							   $order_data['address'] = $address_info['sheng'].$address_info['shi'].$address_info['qu'].$address_info['address']; //收货地址
							   $order_data['address_id'] = $address_info['id'];
							   $order_save = $item_order->data($order_data)->add();
						   if($order_save){
							   $detail_data['orderId'] = $dingdanhao.'-04'; //兑换商品订单号
							   $detail_data['itemId'] = $item_detail['id']; //商品id
							   $detail_data['title'] = $item_detail['title']; //商品名称
							   $detail_data['img'] = $item_detail['img']; //商品图片
							   $detail_data['price'] = $fping_price; //商品价格
							   $detail_data['sigsumprice'] = $fping_price; //商品同类型价格
							   $detail_data['quantity'] = 1; //商品兑换数量
							   $detail_data['itemtype'] = $item_detail['itemtype']; //商品类型，完税/保税
							   $detail_data['profit'] = $fping_price; //商品利润 => 范票商城以购买价格作为商品利润
							   $detail_data['shopid'] = session('shopid'); //店铺ID
							   $detail_data['status'] = 0; //订单状态
							   $detail_data['baseid'] = $item_detail['baseid']; //免税仓ID
							   $detail_data['add_time'] = $times; //订单添加时间
							   $detail_data['fencheng'] = 0.40; //分成率
							   $detail_save = $order_detail->data($detail_data)->add();
							   if($detail_save){
									$orderId = $order_detail->where(array('id'=>$order_detail->getLastInsID()))->getField('orderId');
									echo json_encode(array('status'=>1,'orderId'=>$orderId));
								   $this->msg_add($uid,$uid,26,0,time(),0,$fping_num);
							   }
						   }
						   
						}
					}
				}else{
					echo json_encode(array('status'=>3));
				}
				
			}
		}
	}
	
	public function msg_add($user_id,$recom,$type,$order_id,$time,$status,$points){
		$data['user_id'] = $user_id; 
		$data['recom'] = $recom; 
		$data['type'] = $type; 
		$data['order_id'] = $order_id;
		$data['time'] = $time;
		$data['status'] = $status;
		$data['points'] = $points;
		M('messagelist')->add($data);
	}
	
	public function fping_history(){
		$uid = $this->visitor->info['id'];
		$fping_history = M('fpingshop')
					  ->join("a left join weixin_item as b on a.item_id = b.id")
					  ->where(array('a.user_id'=>$uid))
					  ->field('a.*,b.img,b.title')
					  ->order('a.id desc')
					  ->select();
		$this->assign('fping_history',$fping_history);
		$this->display();
	}
}