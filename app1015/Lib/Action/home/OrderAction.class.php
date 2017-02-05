<?php

class OrderAction extends userbaseAction {

	public function zhifu()
	{
		$this->_config_seo();
		$this->display();
	}
	
	/**
	 * 添加新地址
	 */
	public function addaddress() {
		
		$data['consignee'] = $_GET['consignee'];
		$data['mobile'] = $_GET['phone_mob'];
		$data['sheng'] = $_GET['s1'];
		$data['shi'] = $_GET['s2'];
		$data['qu'] = $_GET['s3'];
		$data['address'] = $_GET['address'];
		$data['uid'] = $this->visitor->info['id'];
		
		$user_address = M('user_address');
		
		if($user_address->add($data)) {
			$res = M('user')->where(array('id'=>$this->visitor->info['id']))->field('phone_mob')->find();
			if(empty($res['phone_mob'])){
				M('user')->where(array('id'=>$this->visitor->info['id']))->save(array('phone_mob'=>$data['mobile']));
			}
			echo '1';
		}else {
			echo '0';
		}
	}
	
	/**
	 * 获取相应的收货地址信息
	 */
	public function addressinfo() {
		
		$id = $_GET['id'];
		$uid = $_GET['uid'];
		$info = M('user_address')->where('id='.$id.' AND uid='.$uid)->find();
		if($info){
			
			echo json_encode($info);
			
		}
		
	}
	
	public function do_urgent(){
		$where['orderId'] = $_GET['orderId'];
		$od = M('item_order');
		$ret=$od->where($where)->getField('is_urgent');
		
		$is_rem = M('item_order')->where(array('orderId'=>$this->_get('orderId'),'is_urgent'=>1))->select();
		if($is_rem){
			echo "yes";
		}
		if($ret == 1){
			echo '成功';
		}else{
			$data['is_urgent'] = 1;
			$ret=$od->where($where)->save($data);
			if($ret){
				echo '成功';
			}else{
				echo '失败';
			}	
		}
		
	}
	/**
	 * 保存收货地址
	 */
	public function editaddress() {
		
		$data['id'] = $_GET['id'];
		$data['uid'] = $_GET['uid'];
		$data['consignee'] = $_GET['consignee'];
		$data['mobile'] = $_GET['phone_mob'];
		$data['sheng'] = $_GET['s1'];
		$data['shi'] = $_GET['s2'];
		$data['qu'] = $_GET['s3'];
		$data['address'] = $_GET['address'];
		//2014-04-11 by shuguang 
		$data['is_default'] = $_GET['is_default'];//默认地址标志 0=不默认 1=默认
		//将之前设置的默认收货地址设置为非默认  
		if($data['is_default']==1){
			M('user_address')->query("UPDATE weixin_user_address SET is_default = 0 WHERE uid = ".$data['uid']." AND id NOT IN(".$data['id'].")");
		}

		if(M('user_address')->save($data)!==false){
			
			echo 1;
			
		}else{
			
			echo 0;
			
		}
		
		
	}
	
	public function del_order() {
		$orderId = $_GET['orderId'];
		if(M('item_order')->where(array('orderId'=>$orderId))->delete()){	
			M('order_detail')->where(array('orderId'=>$orderId))->delete();
			$this->redirect('User/orderlist',array('status'=>1));	
		}
	}
	
	/**
	 * 删除收货地址
	 */
	public function deladdress() {
		
		$id = $_GET['id'];
		if(M('user_address')->where('id='.$id)->delete()){
			
			echo 1;
			
		}else{
			
			echo 0;
			
		}
		
	}
	
	public  function cancelOrder()//取消订单
	{
	  $orderId=$_GET['orderId'];
	  !$orderId && $this->_404();
	 
	  $this->assign('orderId',$orderId);
	  $this->_config_seo();
	  $this->display();
	}
	/*
	 * 确认收货修改订单状态，并生成对应商品分成记录
	 * @author vany
	 * date 2015-12-07
	 */
	public function confirmOrder()//确认收货
	{
		 $orderId 	 =$_GET['orderId'];
		 $status 	 =$_GET['status'];
	     !$orderId && $this->_404();
	     $item_order =M('item_order');
	     $item 		 =M('item');
	     $item_orders= $item_order
					   ->field("a.*,b.id,b.uid,b.shares,b.recom,b.username,b.wechatid")
	     			   ->join('a left join __USER__ as b on a.shopid = b.id')
	     			   ->where("a.orderId = '".$orderId."' and a.userId = ".$this->visitor->info['id']." and a.status = 3")
	     			   ->find();
	     if(!is_array($item_orders))
	     {
	     	$this->error('该订单不存在!');
	     }
	     $data['status']	= 4;//收到货
	     $where['orderId']  = $orderId;
	     $where['status']	= 3;
	     // 实例化模版信息类            
         $wxsend   = new Wxsend();    
	     if($item_order->where($where)->save($data) !== false)
	     {	
	     	//获取订单信息和商品信息                
            $order_detail = M('order_detail')
                            ->where("orderId = '".$orderId."'")
                            ->select();	
							 
			

	     	// 获取分成率				 
	     	$lv = M("user_fengchenglv")->where(array('id'=>3))->field('royalty,status')->find();	
	     	$fclvArr 		= explode('|',$lv['royalty']);	
			
			foreach ($order_detail as $k => $val) {
                $price += $val['profit'] * $val['fencheng']; 
				$oprice+=$val['price'];
				// 减掉对应商品的库存数量
				$item->where('id='.$val['itemId'])->setInc('buy_num',$val['quantity']);
				$shares['id']= $item_orders['shares'];
            }
		
			//卖咖店铺分成
			$fcdata['price']= round($oprice,2); //订单总金额
			$fcdata['user_id'] = $this->visitor->info['id'];
			$fcdata['add_time']= time();
			$fcdata['state'] 	 = 1;
			$fcdata['orderId'] = $order_detail[0]['orderId'];
			$fcdata['royalty'] = $order_detail[0]['fencheng'];
			$fcdata['fencheng']= round($price,2);
			//$fcdata['uid']   	 = $order_detail[0]['shopid'];
			$fcdata['uid']   	 = $item_orders['shopid'];
			
			$res = M("user_fengchengllist")->add($fcdata);
			
			
			
			//测试样例
			
			//将发送的消息写进后台
			$message = D('messagelist');
			$message->user_id =$item_orders['userId'];
			$message->recom = $item_orders['shopid'];
			$message->type = 4;
			$message->order_id = $item_orders['orderId'];
			$message->time = time();
			$message->status = 0;
			$message->content = "
				尊敬的{$item_orders['username']}您好！您有一笔新的收入提醒:<br/>
				收入类型：店铺零售奖金<br/>
				收入金额：".round($fcdata['fencheng'],2)."<br/>
				到账时间:".date("Y-m-d H:i:s")."<br/>
				如有疑问请在公众号内咨询在线客服！
			";
			$message->startTrans();
			if($message->add()){
				$message->commit();
				$wxsend->SR($item_orders['wechatid'],round($fcdata['fencheng'],2),date("Y-m-d H:i:s"));
				//$wxsend->SR('oOejpwvMFZF5-J1VkOpyU-AbIS1E',round($fcdata['fencheng'],2),date("Y-m-d H:i:s")); //测试样例
			}else{
				$message->rollback();
			}
			
			
			$stree = M('user')->where(array('id'=>$item_orders['shopid']))->getField('shares_tree');
			$tree = explode('|',$stree);//店家的shares_tree
			$num=count($tree);
			if($num>=3){
			
				$suser_uid = M('user')->where(array('id'=>$tree[$num-2]))->getField('uid');
				$shop_uid = M('user')->where(array('id'=>$item_orders['shopid']))->getField('uid');
				
				
				if($shop_uid==2&&$suser_uid==2){
					$this->get_fc($fcdata['price'],$tree[$num-2],$fcdata['fencheng'],$lv['royalty'],2,$item_orders['orderId'],$item_orders['userId']);
				}else if($shop_uid==3&&$suser_uid==2){
					$this->get_fc($fcdata['price'],$tree[$num-2],$fcdata['fencheng'],$lv['royalty'],3,$item_orders['orderId'],$item_orders['userId']);
				}else if($shop_uid==3&&$suser_uid==3){
					$this->get_fc($fcdata['price'],$tree[$num-2],$fcdata['fencheng'],$lv['royalty'],4,$item_orders['orderId'],$item_orders['userId']);
				}
			}
			$this->success('确认收货成功!',U('User/index'));
	    }else 
	    {
	     	$this->error('确定收货失败');
	    }
	}
	public function get_fc($oprice,$id,$price,$fencheng,$m,$order_id,$user_id){
		$m--;
		if($m<0){
			return 0;
		}
		//实例化模版信息类		
		$wxsend = new Wxsend();
		$fc = explode('|',$fencheng);
	
		$suser = M('user')->where(array('id'=>$id))->field('uid,wechatid,shares_tree,id,username')->find();
		
		$price = $price;
		$fcdata['price']= $oprice;
		$fcdata['user_id'] = $this->visitor->info['id'];
		$fcdata['add_time']= time();
		$fcdata['state'] 	 = 1;
		$fcdata['orderId'] = $order_id;
		$fcdata['royalty'] = $fc[$m];
		$fcdata['fencheng']= round($price * $fc[$m],2);
		$fcdata['uid']   = $id;
		
		$res = M("user_fengchengllist")->add($fcdata);
		
	
		//将发送的消息写进后台
		$message = D('messagelist');
		$message->user_id =$user_id;
		$message->recom = $suser['id'];
		$message->type = 4;
		$message->order_id = $order_id;
		$message->time = time();
		$message->status = 0;
		$message->content = "
			尊敬的{$suser['username']}您好！您有一笔新的收入提醒：<br/>
			收入类型：店铺零售奖金<br/>
			收入金额：".round($fcdata['fencheng'],2)."<br/>
			到账时间:".date("Y-m-d H:i:s")."<br/>
			如有疑问请在公众号内咨询在线客服！
		";
		$message->startTrans();
		if($message->add()){
			$message->commit();
			$wxsend->SR($suser['wechatid'],round($fcdata['fencheng'],2),date("Y-m-d H:i:s"));//提示代理商将获得返利
			//$wxsend->SR('oOejpwvMFZF5-J1VkOpyU-AbIS1E',round($fcdata['fencheng'],2),date("Y-m-d H:i:s")); //测试样例
		}else{
			$message->rollback();
		}
		
		
		$tree = explode('|',$suser['shares_tree']);
		$num=count($tree);
		if($num<3){
			return 0;
		}
		$suser = M('user')->where(array('id'=>$tree[$num-2]))->field('uid,shares_tree')->find();
		while($suser['uid']==3){    //如果再往上的直接上级等级为3则需要在往上一级
            $tree = explode('|',$suser['shares_tree']);//直接上级的shares_tree
            $num=count($tree);
            if($num<3){
                return 0;
            }
            $suser = M('user')->where(array('id'=>$tree[$num-2]))->field('uid,shares_tree')->find();
        }
		
		$this->get_fc($oprice,$tree[$num-2],$price,$fencheng,$m,$order_id,$user_id);
	}
	public function closeOrder()//关闭订单
	{
		 
	  $orderId=$_POST['orderId'];
	 $cancel_reason=$_POST['cancel_reason'];
	  !$orderId && $this->_404();
	  $item_order=M('item_order');
	  $item=M('item');
	  $order_detail=M('order_detail');
	  $userId=$this->visitor->info['id'];
	  $order=$item_order->where("orderId='$orderId' and userId='$userId'")->find();
	  if(!is_array($order))
	  {
	  	$this->error('该订单不存在');
	  }else 
	  {
	  	
	   	if($item_order->where("orderId='$orderId'")->delete())//为关闭
	   	{	//如果选择货到付款
			if($order['supportmetho']==2){
				$order_details=$order_detail->where("orderId='$orderId'")->select();
				foreach ($order_details as $val)
				{
					$item->where('id='.$val['itemId'])->setInc('goods_stock',$val['quantity']);
				}
			}
	   		$this->redirect('User/index');
	   	}else{
	   		  $this->error('关闭订单失败!');
	   	}
	  }
		
	}
	
	//提交评论
	public function orderBBS() {
		$uid = $this->visitor->info['id'];
		$title =  $_POST["title"];
		if(empty($_POST['info'])){
			 $this->error('评价内容还未填写');
		} 
		$img = "";
		$picurl2 = "";
		$picurl3 = "";
		$picFile = $_FILES["avatar"];
		if($picFile["error"] === 4) {
			$picurl1 = "";
		} else {
			$img = "data/upload/bbs/".time().$uid."_img.jpg";
			$exist = file_exists($picurl1);
			if($exist) {
				unlink($img);
			}
			 move_uploaded_file($picFile["tmp_name"],$img);
		}
		$picFile = $_FILES["picurl2"];
		if($picFile["error"] === 4) {
			$picurl2 = "";
		} else {
			$picurl2 = "data/upload/bbs/".time().$uid."_picurl2.jpg";
			$exist = file_exists($picurl2);
			if($exist) {
				unlink($picurl2);
			}
			 move_uploaded_file($picFile["tmp_name"],$picurl2);
		}
		$picFile = $_FILES["picurl3"];
		if($picFile["error"] === 4) {
			$picurl3 = "";
		} else {
			$picurl3 = "data/upload/bbs/".time().$uid."_picurl3.jpg";
			$exist = file_exists($picurl3);
			if($exist) {
				unlink($picurl3);
			}
			 move_uploaded_file($picFile["tmp_name"],$picurl3);
		}
		$orderId = $_POST["orderId"];
		$info = $_POST["info"];
		if ($_POST['nm']==1) {
			$uname='匿名';
		}else{
			$uname = $this->visitor->info['username'];
		}
		$color = $_POST["color"];
		$item_id = $_POST["item_id"];
		$status = 1;
		$add_time = time();
		$item_commentMd = M("item_comment");
		//$data = array("uid"=>$uid,"picurl1"=>$picurl1,"picurl2"=>$picurl2,"picurl3"=>$picurl3);
		$data['picurl1']=$img;
		$data["uid"] = $uid;
		$data["info"] = $info;
		$data["orderId"] = $orderId;
		$data["uname"] = $uname;
		$data["color"] = $color;
		$data["status"] = $status;
		$data['size']=$_POST['size'];
		$data["add_time"] = $add_time;
		for ($i=1; $i <count($item_id)+1 ; $i++) { 
			$data["item_id"] = $item_id[$i];
			$item_commentMd->add($data);
		}
		$this->assign("orderId",$_POST["orderId"]);
		
		//评论都是5积分
		$order_info = M('item_order')->where(array('orderId'=>$orderId))->find();
		$points = 5;
		if($order_info['userId'] == $order_info['shopid']){
			$message = D('messagelist'); 
			$message->user_id =$uid; //用户id
			$message->recom = $uid; //用户id
			$message->type = 6; //评论积分
			$message->order_id = $orderId; //订单id
			$message->time = time(); 
			$message->status = 0; // 默认未读状态
			$message->points = $points;
			if($message->add()){
				M('user')->where(array('id'=>$uid))->setInc('points',$points);
			}
		}else{
			//消费者积分
			$message = D('messagelist'); 
			$message->user_id =$uid; //用户id
			$message->recom = $uid; //用户id
			$message->type = 6; //评论积分
			$message->order_id = $orderId; //订单id
			$message->time = time(); 
			$message->status = 0; // 默认未读状态
			$message->points = $points;
			if($message->add()){
				M('user')->where(array('id'=>$uid))->setInc('points',$points);
			}
			$comment_msg = D('messagelist'); 
			$comment_msg->user_id =$uid; //商家id
			$comment_msg->recom = $order_info['shopid']; //商家id
			$comment_msg->type = 6; //评论积分
			$comment_msg->order_id = $orderId; //订单id
			$comment_msg->time = time(); 
			$comment_msg->status = 0; // 默认未读状态
			$comment_msg->points = $points;
			if($comment_msg->add()){
				M('user')->where(array('id'=>$order_info['shopid']))->setInc('points',$points);
			}
		}
		
		//评论之后的状态
		$item_orderMd = M("item_order");
		$item_orderMd->where(array("orderId"=>$orderId))->save(array("status"=>4,'c_status'=>1));
		$this->redirect('User/comment_success');
		$this->display();
	}
	
		//申请退款
	public function orderTK() {
		
		if (IS_POST) {
			if ($_POST['tk']==2) {
				 $where['orderId'] = $_POST["orderId"];
				 $express = $_POST["express"];
				 $waybill = $_POST["waybill"];
				 $data["express"] = $express;
				 $data["waybill"] = $waybill;
				 $res=M('item_ordertk')->where($where)->save($data);
				 if ($res!==false){
				 		$this->success('修改退货信息成功!',U('User/index'));
				 }
			}else{
				$uid = $this->visitor->info['id'];
				$usersMd = M('user');
				$userstixian = $usersMd->where(array('id' => $uid))->find();
				$uname = $this->visitor->info['username'];
				$orderId = $_POST["orderId"];
				$yuanyin = $_POST["yuanyin"];
				$express = $_POST["express"];
				$waybill = $_POST["waybill"];
				$refund = $_POST["refund"];
			
				$status = 1;
				$zhanghao = $userstixian['zhanghao'];
				$huming = $userstixian['huming'];
				$kaihuhang = $userstixian['kaihuhang'];
				$add_time = time();
				$item_orderTK = M("item_ordertk");
				$data["uid"] = $uid;
				$data["uname"] = $uname;
				$data["yuanyin"] = $yuanyin;
				$data["orderId"] = $orderId;
				$data["express"] = $express;
				$data["waybill"] = $waybill;
				$data["refund"] = $refund;
				$data["status"] = $status;
				$data["zhanghao"] = $zhanghao;
				$data["huming"] = $huming;
				$data["kaihuhang"] = $kaihuhang;
				$data["add_time"] = $add_time;
				$item_orderTK->add($data);
				
				if(empty($yuanyin)){
					$this->error('退款原因还未填写');
				}
				
				//申请退款之后的状态
				$item_orderTK = M("item_order");
				$res=$item_orderTK->where(array("orderId"=>$orderId))->save(array("status"=>6));
				$this->assign("item_orderTK",$item_orderTK);
				if ($res) {
					$this->success('申请成功!请耐心等待审核',U('User/index'));
				}
			}
		}else{
			
			$data['orderId']=$_GET['orderId'];
			$res=M('item_order')->where($data)->field('orderId,order_sumPrice')->find();
			$user=M('user')->where(array('id'=>$this->visitor->info['id']))->find();
			$this->assign('user',$user);
			$this->assign('order',$res);
			$this->display();
		}
		
		
		
	}
	public function status(){
		$data['orderId']=$_GET['orderId'];
		if ($_GET['status']==7) {
			$data1['status']=7;
			$res=M('item_order')->where($data)->save($data1);
			
		}else{
			$data1['status']=8;
			$res=M('item_order')->where($data)->save($data1);

		}
		if ($res!==false) {
			$this->success('操作成功');
		}else{
			$this->error('操作失败');
		}

	}
	
	/*退款说明*/
	public function orderTKsm() {
        //$id = $this->_get('id', 'intval');
        //!$id && $this->redirect('index/index');
        $info = M('article_page')->find(43);
        $this->assign('info', $info);
        $this->assign('id', $id);
        $this->_config_seo();
        $this->display();
    }
	
	public  function checkOrder()//查看订单
	{
		$orderId=$_GET['orderId'];
		!$orderId && $this->_404();
		$status=$_GET['status'];
		$item_order=M('item_order');
		if ($_GET['userId']) {
			$userId=$_GET['userId'];
		}else{
			$userId=$this->visitor->info['id'];
		}

		$order=$item_order->where("orderId='$orderId'")->field('orderId,mobile,address,address_name')->find();

		if(!is_array($order))
		{
			$this->error('该订单不存在');
		}else{

			$order_detail=M('order_detail');

			$order_details= $order_detail->where("orderId='".$order['orderId']."'")->select();
			dump($order_details);
			$item_detail=array();
			foreach ($order_details as $key=>$val)
			{	
				$items[$key]= array('id'=>$val['id'],'title'=>$val['title'],'itemId'=>$val['itemId'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'size'=>$val['size']);
				$items[$key]['totalprice'] += $val['quantity']*$val['price'];
				$item_detail[$key]=$items[$key];
				
			}
			dump($item_detail);exit;
		}
		$this->assign('item_detail',$item_detail);
		$this->assign('order',$order);
		$this->assign("totalprice",$val['sigsumprice']);
		$jsonArr['item_detail'] = $item_detail;
		$jsonArr['totalprice'] = $val['sigsumprice'];
		$jsonArr['order'] = $order;
		
		$this->_config_seo();
		
		
		$jsonArr['status'] = 1;
		//echo json_encode($jsonArr);
		$this->display();
	}
	
	public function delOrder(){
		$id = $_GET['orderId'];
		$id = substr($id,0,18);
	
		$item_order=M('item_order');
		$data['is_delete'] = 1;
		$item_order->where("orderId like '$id%'")->save($data);
		
		$this->redirect(U("User/order_list"));
	}

	
	public function jiesuan(){//结算
		if(isset($_GET['ids'])){
			$ids = $_GET['ids'];
			$idArr =  explode(',',$ids);
			
			$arr = array();
			
			foreach ($_SESSION['cart'] as $key => $value) {
				if(in_array($key, $idArr)){
					$arr[]=$value['mainid'];
					
				}
			}
			
			$wh['mainid'] = array('in',$arr);
			$cartItem = M('cart')->where($wh)->select();
			
			$_SESSION["cart"] = '';
			$_SESSION['cart'] = $cartItem;
		}else if(isset($_GET['cartId'])){
			$cartId = $_GET['cartId'];
			$arr = M('cart')->where('mainid ='.$cartId)->select();
			$_SESSION['cart'] = $arr;
		}
		

		if(count($_SESSION['cart'])>0)
		{

			$user_address_mod = M('user_address');
			$addr_id=$_GET['addr_id'];
			if ($addr_id) {
				$address = $user_address_mod->where(array('id'=>$addr_id))->select();
			}
			else{
				$address = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->limit('1')->select();//2016-04-12 by shuguang 根据默认地址排序

			}
			//获取全部的收货地址
			$address_list2 = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->select();//2016-04-12 by shuguang 根据默认地址排序

		
			$items=M('item');
			$item=$_SESSION['cart'];
		
			$sunprice=0;
			//=============结算时计算总价和数量================
			for ($i=0; $i < count($item); $i++) { 
					$nums=$item[$i];
	                $sunprice+=$nums['price']*$nums['num'];
					
			}
			$_SESSION['sumprice']=$sunprice;
			$u1=array();
			

			$merchant = M("user")->where('id='.session('shopid'))->find();
			foreach($item as $k=>&$e){
				$name=&$e['shopid'];
				if(!isset($u1[$name])){
					$u1[$name]=$e;
					unset($u1[$name]['id'],$u1[$name]['name'],$u1[$name]['price'],$u1[$name]['num'],$u1[$name]['img'],$u1[$name]['attr'],$u1[$name]['size'],$u1[$name]['discount'],$u1[$name]['zuzhuang'],$u1[$name]['cost'],$u1[name]['itemtype']);
				}
					
				$u1[$name]['goods'][]=array('id'=>$e['id'],'name'=>$e['name'],'price'=>$e['price'],'num'=>$e['num'],'img'=>$e['img'],'attr'=>$e['attr'],'size'=>$e['size'],'discount'=>$e['discount'],'zuzhuang'=>$e['zuzhuang'],'cost'=>$e['cost'],'itemtype'=>$e['itemtype']);
			}
			$item = array_values($u1); unset($u1);
			array_push($item[0],$merchant['merchant']);
			$this->assign('item',$item);
		    $jsonArr['item'] = $item;
			
			
			$cards = M('idcard')->where('uid = '.$this->visitor->info['id'])->select();
			$cid=$_GET['card_info'];
			
			
			if($cid){
				$this->assign('cardid',$cid);
				$ret=M('idcard')->where('Id = '.$cid)->find();
				$this->assign('c_ard',$ret);
				$this->assign('flag',true);
				
				$jsonArr['cardid'] = $cid;
				$jsonArr['c_ard'] = $ret;
				$jsonArr['flag'] = true;
			}
			
		
		
			//获取商品类型
			$itemtype = array();
			foreach($_SESSION['cart'] AS $v) {
				
				$itemtype[] = $v['itemtype'];
				
			}
			
			if(in_array(0, $itemtype)){
				$this->assign('itemtype',0);
				$jsonArr['itemtype'] = 0;
			}else{
				$this->assign('itemtype',1);
				$jsonArr['itemtype'] = 1;
			}
			
		
			foreach ($_SESSION['cart'] as $item)
			{
				/*=======================by lyye 2014-04-08=======================*/
				//首先判断购物车数量是否超过限购数量
				$isxiangou = $items->field('is_xiangou,xiangou_num')->where('is_xiangou=1')->find($item['id']);
				if(is_array($isxiangou))
				{
					if($isxiangou['is_xiangou'] == 1)
					{
						if($item['num'] > $isxiangou['xiangou_num'])
						{
							$this->error('对不起，购物车含有限购物品，请核对限购数量');
						}
						//再次判断用户是否购买过此商品
						$order_detail = M('order_detail');
						$order = M('item_order');
						$item_orderlist = $order_detail->field('orderId')->where("itemId=$item[id]")->select();
						if($item_orderlist)
						{
							foreach ($item_orderlist as $orderid)
							{
								$map['userId'] 	= $this->visitor->info['id'];
								$map['orderId']	= $orderid['orderId'];
								$map['status']	= array('neq',5);//取消订单判断
								$you_num = $order->where($map)->count("id");
								if($you_num > 0)
								{
									$this->error('对不起，购物车含有限购物品，并且您已经购买过该商品!!');
								}
							}
						}
					}
				}
			}
			
			import('Think.ORG.Cart');// 导入购物车类
			$cart=new Cart();
		
			//运费设置，不满99元需要运费
			$yunfei = M('setting')->where("name='site_yunfei'")->find();
			 
			if($cart->getPrice()<99){
				$this->assign('yunfei',round($yunfei['data'],2));
				$jsonArr['yunfei'] = round($yunfei['data'],2);
			}

			$this->assign('cards',$cards);
			
	        $this->assign('sunprice',round($sunprice,2)); 
			$this->assign('address', $address);
			$this->assign('addr_id',$addr_id);
			$this->assign('address_list2', $address_list2);
			
			
			$jsonArr['cards'] = $cards;
			$jsonArr['sumprice'] = round($sunprice,2);
			$jsonArr['address'] = $address;
			$jsonArr['addr_id'] = $addr_id;
			$jsonArr['address_list2'] = $address_list2;
			
			$this->_config_seo();
			
			$jsonArr['status'] = 1;
			//echo json_encode($jsonArr);
			
			$this->display();
		}else 
		{
			$this->redirect('Shopcart/index');
		}
	}
	
	public function checkdj(){
		$data1['id']=$this->_post('id','intval');
		import('Think.ORG.Cart');// 导入分页类
    	$cart=new Cart();
		$sumPrice=$cart->getPrice();
		if ($data1['id']==1) {
    	 	$data=array('status'=>0,'id'=>$data1['id'],'sumPrice'=>(int)$sumPrice);
		}else{
			$res=M('daijin')->where($data1)->find();
			if ((int)$res['djcondition']<(int)$sumPrice) {
					$price=$sumPrice-$res['djmoney'];
					$data=array('status'=>0,'id'=>$data1['id'],'sumPrice'=>$price);
			}else{
				$data=array('status'=>1);
			}
		}	
		echo json_encode($data);
	}
	public function fahuo(){
		if (IS_POST) {
				$data['userfree']=$_POST['userfree'];
				$data['freecode']=$_POST['freecode'];
				$data['fahuoaddress']=$_POST['fahuoaddress'];
				$data['fahuo_time']=time();
				$orderId=$_POST['orderId'];
				$data['status']=3;
				$res=M('item_order')->where(array('orderId'=>$orderId))->save($data);
				if ($res!==false) {
					//如果更新成功,则减掉相应的库存
					
					$item=M("order_detail")->where(array('orderId'=>$orderId))->select();
					$items=M('item')->where(array('id'=>$item[0]['itemId']))->field('size')->find();
					$size=explode('|',$items['size']);
					foreach($size as $key =>$val){
						if($item[0]['size']==$val){
							$i=$key;
						}
					}
					foreach ($item as $key => $value) {
						$ck=M('user_cangku')->where(array('userid'=>$this->visitor->info['id'],'goodsid'=>$value['itemId'],'size'=>$i))->select();
						
						if ($ck[0]['xxkucun']<$value['quantity']) {
							$ck[0]['xskucun']=($ck[0]['xxkucun']+$ck[0]['xskucun'])-$value['quantity'];
							$ck[0]['xxkucun']=0;
						}else{
							$ck[0]['xxkucun']=$ck[0]['xxkucun']-$value['quantity'];
						}
						M('user_cangku')->where(array('userid'=>$this->visitor->info['id'],'goodsid'=>$value['itemId'],'size'=>$i))->save($ck[0]);
					}
					$this->success('发货成功',U('User/index'));
				}else{
					$this->error('发货失败!');
				}
	   }else{
			//查看代理商的库存是否充足
			$orderId=$_GET['orderId'];
			$item_num=M('order_detail')->where(array('orderId'=>$orderId))->select();
			$items=M('item')->where(array('id'=>$item_num[0]['itemId']))->find();
			$size=explode('|',$items['size']);
			foreach($size as $key =>$val){
				if($item_num[0]['size']==$val){
					$i=$key;
				}
			}
			foreach ($item_num as $key => $value) {
				$ck[0]=M('user_cangku')->where(array('userid'=>$this->visitor->info['id'],'goodsid'=>$value['itemId'],'size'=>$i))->sum('xskucun');
				$ck[1]=M('user_cangku')->where(array('userid'=>$this->visitor->info['id'],'goodsid'=>$value['itemId'],'size'=>$i))->sum('xxkucun');
				if ($value['quantity'] > $ck[0]+$ck[1]) {
					$this->error('商品:<br>'.msubstr($value['title'],0,9).'&nbsp;&nbsp;<br>('.$value['size'].')库存不足!');
				}
			}
			$res=M('delivery')->select();
			$this->assign('delivery',$res);
			$this->assign('orderId',$orderId);
			$this->display();
		}
	}
	public function pay(){//出订单
		//查询当前用户积分
		$user_point = M('user')->where(array('id'=>$this->visitor->info['id']))->find();
		$userfreeze = M('user')->where(array('id'=>$this->visitor->info['id']))->find();
		$this->assign('point',$user_point['points']);
		$this->assign('userfreeze',$userfreeze);
		$this->assign('point_buck',round($user_point['points']/100,1));
		
		$owhere['orderId'] = $this->_get('orderId','trim');
		$owhere['is_addprice'] = 0;
		$ordetail = M('item_order')->where($owhere)->find();
		//如果用户选择抵扣范票却没有支付，在这里重新对抵扣的金额进行累加
		if($ordetail['is_exchange']!=0){
			$dprice = $ordetail['is_exchange']/100;
			M('item_order')->where($owhere)->setInc('order_sumPrice',$dprice);
			$data['is_addprice'] = 1; //是否已经对商品总额进行了增加
			M('item_order')->where($owhere)->save($data);
		}
		
		if(IS_POST&&count($_SESSION['cart'])>0){//1.订单未生成情况下  生成订单号、分单   
			
			import('Think.ORG.Cart');// 导入购物车类
			$cart=new Cart();
			
			$user_address=M('user_address');
			$item_order=M('item_order');
			$order_detail=M('order_detail');
			$item_goods=M('item');
			
			
		   
			//完税、保税商品的分离组合
			$u1=array();
			foreach($_SESSION['cart'] as $k=>&$e){
				$name=&$e['itemtype'];
				if(!isset($u1[$name])){
					$u1[$name]=$e;
					unset($u1[$name]['id'],$u1[$name]['name'],$u1[$name]['price'],$u1[$name]['num'],$u1[$name]['img'],$u1[$name]['attr'],$u1[$name]['size'],$u1[$name]['discount'],$u1[$name]['zuzhuang'],$u1[$name]['cost'],$u1[$name]['baseid']);
				}
				$u1[$name]['goods'][]=array('id'=>$e['id'],'name'=>$e['name'],'price'=>$e['price'],'num'=>$e['num'],'img'=>$e['img'],'attr'=>$e['attr'],'size'=>$e['size'],'discount'=>$e['discount'],'zuzhuang'=>$e['zuzhuang'],'cost'=>$e['cost'],'baseid'=>$e['baseid']);
			}
			$itemlist = array_values($u1);
			unset($u1);
		  
			foreach($itemlist AS $key=>$val){
				foreach($val['goods'] AS $key1=>$val1){
					if($val['itemtype']==1){
						$sum+=$val1['price']*$val1['num'];
					}
					if($val['itemtype']==0){
						$sum1+=$val1['price']*$val1['num'];
					}
				}
				//统计不同分单的类型的价格
				if($val['itemtype']==1){
					array_push($itemlist[$key],$sum);
				}
				if($val['itemtype']==0){
					array_push($itemlist[$key],$sum1);
				}
			}
		  
			//生成订单号
			$dingdanhao = date("Y-m-dH-i-s");
			$dingdanhao = str_replace("-","",$dingdanhao);
			$dingdanhao .= rand(1000,2000);
		   
			$time=time();//订单添加时间
			
			$sumPrice = $cart->getPrice();
			
			$data['freetype']=0;
			$data['order_sumPrice']=$sumPrice;
			$data['add_time']=$time;//添加时间
			$data['goods_sumPrice']=$sumPrice;//商品总额
			$data['userId']=$this->visitor->info['id'];//用户ID
			if($this->visitor->info['username']){
				$data['userName']=$this->visitor->info['username'];//用户名
			}else{
				$data['userName']=$this->visitor->info['wechatid'];//用微信id做用户名
			}
			
			$address_options= $this->_post('address_options','intval');//地址  0：刚填的地址 大于0历史的地址
			if($address_options==0){
				$consignee=$this->_post('consignee2','trim');//真实姓名
				$sheng=$this->_post('sheng2','trim');//省
				$shi=$this->_post('shi2','trim');//市
				$qu=$this->_post('qu2','trim');//区
				$address=$this->_post('address2','trim');//详细地址
				$phone_mob=$this->_post('phone_mob','trim');//电话号码
				$data['shopid'] = session('shopid'); //分享过来的商家 ID
				$data['address_name']=$consignee;//收货人姓名
				$data['mobile']=$phone_mob;//电话号码
				$data['address']=$sheng.$shi.$qu.$address;//地址
			}else{
				$userId=$this->visitor->info['id'];
				$address= $user_address->where("uid='$userId'")->find($address_options);//取到地址
				$data['address_name']=$address['consignee'];//收货人姓名
				$data['mobile']=$address['mobile'];//电话号码
				$data['address']=$address['sheng'].$address['shi'].$address['qu'].$address['address'];//地址
			}
				
			//入库判断是否订单金额小于99元
			if($data['goods_sumPrice']<99){
				//加运费
				$yunfei = M('setting')->where("name='site_yunfei'")->find();
				if($_POST['pointitem'] == 4731){
					$data['order_sumPrice'] = $data['order_sumPrice'];	//应付款的
				}else{
					$data['order_sumPrice'] = $data['order_sumPrice']+$yunfei['data'];	//应付款的
					$data['yunfei'] = $yunfei['data'];
				}
			}
				
			//分单入库
			foreach($itemlist AS $key=>$val){
				//判断属于那种商品 0:保税 1：完税
				$key = $key+1;
				$i = $key<=10?'0'.$key:$key;
				if($val['itemtype']==0){
					$data['orderId']=$dingdanhao.'-01'; //保税
					$orderid = $item_order->data($data)->add();
				}else{
					$data['orderId']=$dingdanhao.'-02'; //完税
					$orderid = $item_order->data($data)->add();
				}
			}
				
			if($orderid){//添加订单成功
				foreach ($itemlist as $key=>$item){
					$orders['sigsumprice'] = "";
					foreach($item['goods'] AS $key3=>$item3){
						$orders['sigsumprice']+=$item3['price'];
					}
					//判断属于那种商品 0:保税 1：完税
					$key = $key+1;
					$i = $key<=10?'0'.$key:$key;
					if($item['itemtype']==0){
						$orders['orderId']=$dingdanhao.'-01';	//订单号
						foreach($item['goods'] AS $key1=>$item1){
							//得到分成
							$orders['fencheng'] = M('item')->where(array('id'=>$item1['id']))->getField('fencheng');
							//得到利润
							$orders['profit'] = round(($item1['price']-$item1['cost'])*$item1['num'],2);
							//减掉对应商品的库存数量
							$goods_stock = $item_goods->where(array('id'=>$item1['id']))->field('size,goods_stock')->find();
							//获取该商品的库存、规格
							$stock=explode('|',$goods_stock['goods_stock']);
							$size=explode('|',$goods_stock['size']);
							foreach($size as $key2=>$item2){
								if($item2 == $item1['size']){
									$i=$key2;
									$stock[$i]=$stock[$i]-$item1['num'];
								}
								$data5['goods_stock']=implode('|',$stock);
								$item_goods->where(array('id'=>$item1['id']))->save($data5);
								$orders['itemId']=$item1['id'];//商品ID
								$orders['title']=$item1['name'];//商品名称
								$orders['img']=$item1['img'];//商品图片
								$orders['price']=$item1['price'];//商品价格
								$orders['quantity']=$item1['num'];//购买数量
								$orders['size']=$item1['size'];//购买尺寸
								$orders['itemtype']=$item['itemtype'];//商品类型
								$orders['shopid'] = session('shopid'); //分享过来的商家 ID
								$orders['baseid'] = $item1['baseid'];//免税仓id
								$orders['idcname'] = $this->_post('idcname','trim');//身份证姓名
								$orders['idcnum'] = $this->_post('idcnum','trim');//身份证号码
								$orders['zimg'] = $this->_post('zimg');
								$orders['fimg'] = $this->_post('fimg');
								$datas1['baseid']=$item1['baseid'];
								M('item_order')->where(array('orderId'=>$dingdanhao.'-01'))->save($datas1);
							}
							$orders['sigsumprice'] = $item[0]; //分单商品总价格
							//分单入库
							$order_detail->data($orders)->add();
						}
					}else{
						$orders['orderId']=$dingdanhao.'-02';	//订单号
						foreach($item['goods'] AS $key1=>$item1){
							//得到分成
							$orders['fencheng'] = M('item')->where(array('id'=>$item1['id']))->getField('fencheng');
							//得到利润
							$orders['profit'] = round(($item1['price']-$item1['cost'])*$item1['num'],2);
							//减掉对应商品的库存数量
							$goods_stock = $item_goods->where(array('id'=>$item1['id']))->field('size,goods_stock')->find();
							//获取该商品的库存、规格
							$stock=explode('|',$goods_stock['goods_stock']);
							$size=explode('|',$goods_stock['size']);
							foreach($size as $key2=>$item2){
								if($item2 == $item1['size']){
									$i=$key2;
									$stock[$i]=$stock[$i]-$item1['num'];
								}
								$data5['goods_stock']=implode('|',$stock);
								$item_goods->where(array('id'=>$item1['id']))->save($data5);
								$orders['itemId']=$item1['id'];//商品ID
								$orders['title']=$item1['name'];//商品名称
								$orders['img']=$item1['img'];//商品图片
								$orders['price']=$item1['price'];//商品价格
								$orders['quantity']=$item1['num'];//购买数量
								$orders['size']=$item1['size'];//购买尺寸
								$orders['itemtype']=$item['itemtype'];//商品类型
								$orders['shopid'] = session('shopid'); //分享过来的商家 ID
								$orders['baseid'] = $item1['baseid'];//免税仓id
								$orders['idcname'] = $this->_post('idcname','trim');//身份证姓名
								$orders['idcnum'] = $this->_post('idcnum','trim');//身份证号码
								$orders['zimg'] = $this->_post('zimg');
								$orders['fimg'] = $this->_post('fimg');
								$datas2['baseid']=$item1['baseid'];
								M('item_order')->where(array('orderId'=>$dingdanhao.'-02'))->save($datas2);
							}
							$orders['sigsumprice'] = $item[0]; //分单商品总价格
							//分单入库
							$order_detail->data($orders)->add(); 
						}
					}
				} 
				
				$this->assign('orderid',$orderid);//订单ID
				$this->assign('dingdanhao',$dingdanhao);//订单号
				$this->assign('order_sumPrice',$data['order_sumPrice']);
				
				$cart->clear();//清空购物车
			}else{
				$this->error('生成订单失败!');
			}
		}else if(isset($_GET['orderId'])){	
			$item_order=M('item_order');
			$oId=$_GET['orderId'];//订单号
			$orderId = substr($oId,0,18);
			
			$userId=$this->visitor->info['id'];
			$orders=$item_order->where("userId='$userId' and orderId LIKE '$orderId%'")->find();
			
			if(!is_array($orders)){
				$this->_404();
			}
			
			if(empty($orders['supportmetho']) || $orders['supportmetho']==4){//是否已有支付方式
				$this->assign('orderid',$orders['id']);//订单ID
				$this->assign('dingdanhao',$orderId);//订单号
				$this->assign('order_sumPrice',$orders['order_sumPrice']);
				$dingdanhao = $orderId;
			}else if($orders['supportmetho']==1){//选择支付宝
				$pay=M('pay')->where(array('pay_type'=>'alipay'))->find();
				$alipay=unserialize($pay['config']);
				echo "<script>location.href='api/wapalipay/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$orderId."&WIDsubject=".$orderId."&WIDtotal_fee=".$orders['order_sumPrice']."'</script>";
				exit;
			}else if($orders['supportmetho']==3){//选择微信支付
				$wxconfig=$this->wxconfig();
				$ip = get_client_ip();//获取ip
				echo "<script>location.href='api/wxpay/js_api_call.php?ip=".$ip."&partner=".$wxconfig['partnerid']."&out_trade_no=".$orderId."&body=".$orderId."&total_fee=".$orders['order_sumPrice']."&notify_url=".$wxconfig['notify_url']."&showwxpaytitle=1&point=".$point."'</script>"; 
				exit;
			}else if($orders['supportmetho']==4){ //支付宝个人收款主页收款
				dump(5);exit;
				$modpayset = M('setting');
				$alipayhome = $modpayset->where("name='alipayhome'")->getField('data');		
				echo "<script>location.href='$alipayhome'</script>";exit;	   
			} 		
		}else{
			$this->redirect('User/index');
		}
		$alipay=M('pay')->where(array('pay_type'=>'alipay'))->find();
		$this->assign('alipaystatus',$alipay['status']);
		$wxpay=M('pay')->where(array('pay_type'=>'wxpay'))->find();
		$this->assign('wxpaystatus',$wxpay['status']); 
		
		//获取订单信息
		$orderaddr = M('item_order')->where("userId=".$this->visitor->info['id']." and orderId LIKE '$dingdanhao%'")->find();
		
		//获取满足条件的商品
		$pointitem = M('order_detail')
					->join('a left join weixin_item_order b on a.orderId=b.orderId')
					->field('b.userId,a.*')
					->where("a.orderId LIKE '$dingdanhao%' and b.userId=".$this->visitor->info['id']."")
					->find(); 
		  

		$orderinfo = M('item_order')
					->field('a.*,b.itemId,b.title,b.img,b.price,b.quantity,b.size,b.itemtype,b.sigsumprice,b.shopid,c.activity,c.is_combo,c.cate_id')
					->join('a left join weixin_order_detail b on a.orderId=b.orderId left join weixin_item c on b.itemId=c.id')
					->where("b.orderId LIKE '$dingdanhao%'")->select();
					
		$merusername = M('order_detail')
						->field('a.*,b.merchant')
						->join('a left join weixin_user b on a.shopid=b.id')
						->where("a.orderId LIKE '$dingdanhao%'")->find();
		
		$u1=array();
		foreach($orderinfo as $k=>&$e){
			$name=&$e['shopid'];
			if(!isset($u1[$name])){
				$u1[$name]=$e;
				unset($u1[$name]['cate_id'],$u1[$name]['activity'],$u1[$name]['is_combo'],$u1[$name]['itemId'],$u1[$name]['title'],$u1[$name]['img'],$u1[$name]['price'],$u1[$name]['quantity'],$u1[$name]['size'],$u1[$name]['itemtype'],$u1[$name]['sigsumprice']);
			}
			$u1[$name]['goods'][]=array('cate_id'=>$e['cate_id'],'activity'=>$e['activity'],is_combo=>$e['is_combo'],'itemId'=>$e['itemId'],'title'=>$e['title'],'img'=>$e['img'],'price'=>$e['price'],'quantity'=>$e['quantity'],'size'=>$e['size'],'sigsumprice'=>$e['sigsumprice'],'itemtype'=>$e['itemtype']);
		}
		$orderinfo = array_values($u1); unset($u1);
		array_push($orderinfo[0], $merusername['merchant']);
			
		/*用户可用优惠券,未使用且满足使用条件*/
		//判断订单中是否有活动产品
		$flag = true;
		$cates = '';
		
		foreach($orderinfo[0]['goods'] as $key => $val){
			if($val['activity']==1||$val['is_combo']==1){
				$flag = false;
			}
			$pid = M('item_cate')->where(array('id'=>$val['cate_id']))->getField('pid');
			$cates .= "and b.cate_ids like '%".$pid."%' ";  
		}
						  
		if($flag){//订单中包含特价产品或活动产品，则只能使用现金券
			//品类券
			$coupon1 = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where('a.status=0 and b.condition <= '.$orderinfo[0]['goods_sumPrice'].' and b.kind =2 and userId='.$this->visitor->info['id'].' and a.end_time >= '.time().' '.$cates)
								  ->field('b.*,a.id as ucId,a.end_time as etime')
								  ->select();
			//其他券					  
			$coupon2 = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where('a.status=0 and b.condition <= '.$orderinfo[0]['goods_sumPrice'].' and (b.kind >2 or (b.is_recom =1 and b.kind =1)) and userId='.$this->visitor->info['id'].' and a.end_time >= '.time())
								  ->field('b.*,a.id as ucId,a.end_time as etime')
								  ->select();
			if(count($coupon2)>0&&count($coupon1)>0){
				$coupon=array_merge($coupon1,$coupon2);
			}else if(count($coupon2)>0){
				$coupon=$coupon2;
			}else if(count($coupon1)>0){
				$coupon=$coupon1;
			}
		}
							  
		//现金券
		$coupon3 = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
							  ->where('a.status=0 and b.condition <= '.$orderinfo[0]['goods_sumPrice'].'  and b.kind =1 and b.is_recom in (0,2,3) and userId='.$this->visitor->info['id'].' and a.end_time >= '.time())
							  ->field('b.*,a.id as ucId,a.end_time as etime')
							  ->select();
		
		$this->assign('coupon',$coupon);
		$this->assign('coupon3',$coupon3);
		$this->assign('count',count($coupon)+count($coupon3));
		$this->assign('time',(time()+3*24*3600));

		$this->assign('orderaddr',$orderaddr);
		$this->assign('orderinfo',$orderinfo);
		$this->assign('pointitem',$pointitem);
		
		$this->display();
	}

/***********************************************************app接口-start****************************************************************/
	public function payconfig(){
		$wx['appid'] = 'wx8c3ea1363cd06011';
		$wx['mch_id'] = '1392525002';
		$wx['notify_url'] = 'http://2urhope.com/';
		$wx['key'] = 'GSONGAO459BIW294MGJK0goangnga66b';
		$wx['trade_type'] = 'APP';
		return $wx;
	}
	
	
	//统一支付
	public function dopay($orderId,$total_fee){
		//$orderId = $this->_get('orderId','trim');
		$orderId = substr($orderId,0,18);
		$out_trade_no = $orderId;
		$body = $orderId;
		//$total_fee = $this->_get('order_sumPrice','intval');
		$wx = $this->payconfig();
		$wechatAppPay = new wechatAppPay($wx['appid'],$wx['mch_id'],$wx['notify_url'],$wx['key']);
		$params['body'] = $body;                               //商品描述
		$params['out_trade_no'] = $out_trade_no;               //自定义的订单号
		$params['total_fee'] = $total_fee*100;                     //订单金额 只能为整数 单位为分
		$params['trade_type'] = $wx['trade_type'];             //交易类型 JSAPI | NATIVE | APP | WAP 
		$result = $wechatAppPay->unifiedOrder( $params );
		//print_r($result);
	    //result中就是返回的各种信息信息，成功的情况下也包含很重要的prepay_id
		//创建APP端预支付参数
		$data = @$wechatAppPay->getAppPayParams( $result['prepay_id'] );
		// 根据上行取得的支付参数请求支付即可
		echo json_encode($data);
	}
	
	
	//结算界面-获取用户所有收货地址
	public function all_adddress(){
		//获取全部的收货地址
		$addrList = M('user_address')->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->field('id,consignee,is_default,address,mobile')->select();
		if(count($addrList)>0){
			$jsonArr['addrs'] = $addrList;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	//结算界面-用户某一地址信息的详细内容
	public function addr_info(){
		$id = $this->_get('addrId','intval');
		$addr = M('user_address')->where(array('id'=>$id))->field('id,consignee,address,mobile,is_default,sheng,shi,qu')->find();
		if($addr){
			$jsonArr['addr'] = $addr;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	//结算界面-默认显示地址
	public function def_addr(){
		//获取全部的收货地址
		$addr = M('user_address')->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->field('id,consignee,is_default,address,mobile')->find();
		if($addr){
			$jsonArr['addr'] = $addr;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	//结算界面-删除地址
	public function del_addr(){
		$id = $this->_get('addrId','intval');
		if(M('user_address')->where('id='.$id)->delete()){
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;	
		}
		echo json_encode($jsonArr);
	}
	
	//结算界面-保存地址修改
	public function edit_addr(){
		$id = $this->_post('addrId','intval');
		$data['consignee'] = $this->_post('consignee','trim');
		$data['mobile'] = $this->_post('mobile','trim');
		$data['sheng'] = $this->_post('sheng','trim');
		$data['shi'] = $this->_post('shi','trim');
		$data['qu'] = $this->_post('qu','trim');
		$data['address'] = $this->_post('address','trim');
		$data['is_default'] = $this->_post('is_default','trim');//默认地址标志 0=不默认 1=默认

		if(M('user_address')->where(array('id'=>$id))->save($data)!==false){
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;	
		}
		echo json_encode($jsonArr);
	}
	
	
	//结算界面-所有身份证信息
	public function IDcards(){
		$cards = M('idcard')->where('uid = '.$this->visitor->info['id'])->field('Id,c_id,c_name')->select();
		if(count($cards)>0){
			$jsonArr['cards'] = $cards;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	//结算界面-用户选择的购物车记录
	public function itemtobuy(){
		if(isset($_GET['mainIds'])){
			$mainIds = $_GET['mainIds'];
			$idArr =  explode(',',$mainIds);
		}else if(isset($_GET['goodId'])&&isset($_GET['quantity'])&&isset($_GET['shopid'])){
		
			$goodId = $this->_get('goodId', 'intval');//商品ID
			$size=$this->_get('size', 'trim');//规格
			$quantity = $this->_get('quantity', 'intval');//购买数量
			$data['num']=$quantity;
			$data['shopid']= $this->_get('shopid');//店铺ID
			$data['id']= $goodId;
			$item=M('item')->field('goods_stock,cost,title,itemtype,baseid,img,yhprice,size,price')->where('id='.$goodId)->find();
			
			if($item){
				if($item['size']&&empty($size)){
					$jsonArr=array('status'=>0,'msg'=>'请选择规格');
					echo json_encode($jsonArr);
					exit;
				}else if(!empty($size)){
					
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
				$data['show']= 1;
				
				if($stock<$quantity){
					$jsonArr['status']=0;
					$jsonArr['msg'] = '没有足够的库存';
					echo json_encode($jsonArr);
					exit;
				}else{
					$cartId = M('cart')->add($data);
					$idArr =  explode(',',$cartId);
				}
			}else{
				$jsonArr['status']=0;
				$jsonArr['msg'] = '该商品不存在';
				echo json_encode($jsonArr);
				exit;
			}
		}else{
			$jsonArr['status']=0;
			echo json_encode($jsonArr);
			exit;
		}
		if(count($idArr)>0){
			$where['mainid'] = array('in',$idArr);
			$cartItem = M('cart')->where($where)->field('mainid,id,shopid,name,price,itemtype,size,img,num')->select();
			if(count($cartItem)>0){
				foreach($cartItem as $key=>$val){
					$cartItem[$key]['img'] = "http://yooopay.com/data/upload/item/".$val['img'];
				}
				$jsonArr['buyitems'] = $cartItem;
				$jsonArr['status'] = 1;
			}else{
				$jsonArr['status'] = 0;
			}
		}
		
		echo json_encode($jsonArr);
	}
	
	
/* 	//确认支付页面-获取用户范票
	public function integral(){
		$user_point = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('points');
		if($user_point){
			$jsonArr['integral'] = $user_point;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	//确认支付-获取店铺名称
	public function shop_name(){
		$shopid = $this->_get('shopid','intval');
		$merchant = M('user')->where(array('id'=>$shopid))->getField('merchant');
		if($merchant){
			$jsonArr['merchant'] = $merchant;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	} */
	
	//确认支付
	public function do_order(){
		$user_address=M('user_address');
		$item_order=M('item_order');
		$order_detail=M('order_detail');
		$item_goods=M('item');
		$cart=M('cart');
		$idcard=M('idcard');
		$user=M('user');
		
		//结算页面进入
		$cardid = $this->_get('cardid','intval');
		$addrid = $this->_get('addrid','intval');
		$shopid = $this->_get('shopid','intval');
		$mainIds = $this->_get('mainIds','trim');
		$idArr =  explode(',',$mainIds);
		
		//订单页面进入
		$oId = $this->_get('orderid','trim');
		if($oId!=''){
			$dingdanhao = substr($oId,0,18);
			
			$userId=$this->visitor->info['id'];
			$orderInfo=$item_order->where(array('orderId'=>array('like',$oId)))->field('order_sumPrice,goods_sumPrice,address_name,supportmetho,mobile,address')->find();
			
			if(!is_array($orderInfo)){
				$this->_404();
			}
			
			if($orderInfo['supportmetho']==3){//微信支付
				$this->dopay($dingdanhao,$orderInfo['order_sumPrice']);
				exit;
			}else{
				$sumPrice = $orderInfo['goods_sumPrice'];
				
				$a_ddr['name']=$orderInfo['address_name'];
				$a_ddr['mobile']=$orderInfo['mobile'];
				$a_ddr['address']=$orderInfo['address'];
				
				$cItems = $order_detail->where(array('orderId'=>array('like',$dingdanhao.'%')))
										   ->field('img,title,itemId,price,quantity,size,itemtype')
										   ->select();
				foreach($cItems as $k=>&$e){
					$cItems[$k]['img'] = "http://yooopay.com/data/upload/item/".$e['img'];
					$arr[] = $e['itemId'];
				}
			} 		
		}else{
			if(count($idArr)>0){
				$where['mainid'] = array('in',$idArr);
				$cartItem = $cart->where($where)->field('mainId,id,uid,num,price,size,baseid,name,img,itemtype,cost,shopid')->select();
			}
			if(count($cartItem)>0){
				//完税、保税商品的分离组合
				$u1=array();
				$sumPrice = 0;
				foreach($cartItem as $k=>&$e){
					$cItems[$k]['img'] = "http://yooopay.com/data/upload/item/".$e['img'];
					$cItems[$k]['title'] = $e['name'];
					$cItems[$k]['price'] = $e['price'];
					$cItems[$k]['num'] = $e['num'];
					$cItems[$k]['itemtype'] = $e['itemtype'];
					$cItems[$k]['size'] = $e['size'];
					$cItems[$k]['itemId'] = $e['id'];
					$name=&$e['itemtype'];
					if(!isset($u1[$name])){
						$u1[$name]=$e;
						unset($u1[$name]['id'],$u1[$name]['name'],$u1[$name]['price'],$u1[$name]['num'],$u1[$name]['img'],$u1[$name]['size'],$u1[$name]['cost'],$u1[$name]['baseid']);
					}
					$u1[$name]['goods'][]=array('id'=>$e['id'],'name'=>$e['name'],'price'=>$e['price'],'num'=>$e['num'],'img'=>$e['img'],'size'=>$e['size'],'cost'=>$e['cost'],'baseid'=>$e['baseid']);
					$sumPrice += round($e['price']*$e['num'],2);
					$arr[] = $e['id'];
				}
				$itemlist = array_values($u1);
				unset($u1);
			  
				foreach($itemlist AS $key=>$val){
					foreach($val['goods'] AS $key1=>$val1){
						if($val['itemtype']==1){
							$sum+=$val1['price']*$val1['num'];
						}
						if($val['itemtype']==0){
							$sum1+=$val1['price']*$val1['num'];
						}
					}
					//统计不同分单的类型的价格
					if($val['itemtype']==1){
						array_push($itemlist[$key],$sum);
					}
					if($val['itemtype']==0){
						array_push($itemlist[$key],$sum1);
					}
				}
			  
				//生成订单号
				$dingdanhao = date("Y-m-dH-i-s");
				$dingdanhao = str_replace("-","",$dingdanhao);
				$dingdanhao .= rand(1000,2000);
			   
				$time=time();//订单添加时间
				
				
				
				$data['freetype']=0;
				$data['order_sumPrice']=$sumPrice;
				$data['add_time']=$time;//添加时间
				$data['goods_sumPrice']=$sumPrice;//商品总额
				$data['userId']=$this->visitor->info['id'];//用户ID
				$data['shopid']=$shopid;//店铺ID
				
				$uInfo = $user->where(array('id'=>$this->visitor->info['id']))->field('username,wechatid')->find();
				if($uInfo['username']){
					$data['userName']=$uInfo['username'];//用户名
				}else{
					$data['userName']=$uInfo['wechatid'];//用微信id做用户名
				}
				
				
				$address= $user_address->where(array('id'=>$addrid))->field('consignee,mobile,sheng,shi,qu,address')->find();//取到地址
				$data['address_name']=$address['consignee'];//收货人姓名
				$data['mobile']=$address['mobile'];//电话号码
				$addr = $address['sheng'].$address['shi'].$address['qu'].$address['address'];//地址
				$data['address']=$addr;//地址
				
				$a_ddr['name']=$address['consignee'];
				$a_ddr['mobile']=$address['mobile'];
				$a_ddr['address']=$addr;
				
				//入库判断是否订单金额小于99元
				if($sumPrice<99){
					//加运费
					$yunfei = M('setting')->where("name='site_yunfei'")->find();
					$data['order_sumPrice'] = $data['order_sumPrice']+$yunfei['data'];	//应付款的
					$data['yunfei'] = $yunfei['data'];
				}
					
				//分单入库
				foreach($itemlist AS $key=>$val){
					//判断属于那种商品 0:保税 1：完税
					$key = $key+1;
					$i = $key<=10?'0'.$key:$key;
					if($val['itemtype']==0){
						$data['orderId']=$dingdanhao.'-01'; //保税
						$orderid = $item_order->data($data)->add();
					}else{
						$data['orderId']=$dingdanhao.'-02'; //完税
						$orderid = $item_order->data($data)->add();
					}
				}
					
				if($orderid){//添加订单成功
					$cds = $idcard->where(array('Id'=>$cardid))->field('c_id,c_name')->find();
					foreach ($itemlist as $key=>$item){
						$orders['sigsumprice'] = "";
						foreach($item['goods'] AS $key3=>$item3){
							$orders['sigsumprice']+=$item3['price'];
						}
						//判断属于那种商品 0:保税 1：完税
						$key = $key+1;
						$i = $key<=10?'0'.$key:$key;
						if($item['itemtype']==0){
							$orders['orderId']=$dingdanhao.'-01';	//订单号
							foreach($item['goods'] AS $key1=>$item1){
								//得到分成
								$orders['fencheng'] = M('item')->where(array('id'=>$item1['id']))->getField('fencheng');
								//得到利润
								$orders['profit'] = round(($item1['price']-$item1['cost'])*$item1['num'],2);
								//减掉对应商品的库存数量
								$goods_stock = $item_goods->where(array('id'=>$item1['id']))->field('size,goods_stock')->find();
								//获取该商品的库存、规格
								$stock=explode('|',$goods_stock['goods_stock']);
								$size=explode('|',$goods_stock['size']);
								foreach($size as $key2=>$item2){
									if($item2 == $item1['size']){
										$i=$key2;
										$stock[$i]=$stock[$i]-$item1['num'];
									}
									$data5['goods_stock']=implode('|',$stock);
									$item_goods->where(array('id'=>$item1['id']))->save($data5);
									$orders['itemId']=$item1['id'];//商品ID
									$orders['title']=$item1['name'];//商品名称
									$orders['img']=$item1['img'];//商品图片
									$orders['price']=$item1['price'];//商品价格
									$orders['quantity']=$item1['num'];//购买数量
									$orders['size']=$item1['size'];//购买尺寸
									$orders['itemtype']=$item['itemtype'];//商品类型
									$orders['shopid'] = $shopid; //分享过来的商家 ID
									$orders['baseid'] = $item1['baseid'];//免税仓id
									$orders['idcname'] = $cds['c_name'];//身份证姓名
									$orders['idcnum'] = $cds['c_id'];//身份证号码
									$datas1['baseid']=$item1['baseid'];
									M('item_order')->where(array('orderId'=>$dingdanhao.'-01'))->save($datas1);
								}
								$orders['sigsumprice'] = $item[0]; //分单商品总价格
								//分单入库
								$order_detail->data($orders)->add();
							}
						}else{
							$orders['orderId']=$dingdanhao.'-02';	//订单号
							foreach($item['goods'] AS $key1=>$item1){
								//得到分成
								$orders['fencheng'] = M('item')->where(array('id'=>$item1['id']))->getField('fencheng');
								//得到利润
								$orders['profit'] = round(($item1['price']-$item1['cost'])*$item1['num'],2);
								//减掉对应商品的库存数量
								$goods_stock = $item_goods->where(array('id'=>$item1['id']))->field('size,goods_stock')->find();
								//获取该商品的库存、规格
								$stock=explode('|',$goods_stock['goods_stock']);
								$size=explode('|',$goods_stock['size']);
								foreach($size as $key2=>$item2){
									if($item2 == $item1['size']){
										$i=$key2;
										$stock[$i]=$stock[$i]-$item1['num'];
									}
									$data5['goods_stock']=implode('|',$stock);
									$item_goods->where(array('id'=>$item1['id']))->save($data5);
									$orders['itemId']=$item1['id'];//商品ID
									$orders['title']=$item1['name'];//商品名称
									$orders['img']=$item1['img'];//商品图片
									$orders['price']=$item1['price'];//商品价格
									$orders['quantity']=$item1['num'];//购买数量
									$orders['size']=$item1['size'];//购买尺寸
									$orders['itemtype']=$item['itemtype'];//商品类型
									$orders['shopid'] = $shopid; //分享过来的商家 ID
									$orders['baseid'] = $item1['baseid'];//免税仓id
									$orders['idcname'] = $cds['c_name'];//身份证姓名
									$orders['idcnum'] = $cds['c_id'];//身份证号码
									$datas2['baseid']=$item1['baseid'];
									M('item_order')->where(array('orderId'=>$dingdanhao.'-02'))->save($datas2);
								}
								$orders['sigsumprice'] = $item[0]; //分单商品总价格
								//分单入库
								$order_detail->data($orders)->add(); 
							}
						}
					} 
				}else{
					$jsonArr['status'] = 0;//添加订单失败
					echo json_encode($jsonArr);
					exit;
					
				}
			}	
		}

		/*用户可用优惠券,未使用且满足使用条件*/
		//判断订单中是否有活动产品
		$flag = true;
		$cates = '';
		$items = $item_goods->where(array('id'=>array('in',$arr)))->field('cate_id,activity,is_combo')->select();
		
		foreach($items as $key => $val){
			if($val['activity']==1||$val['is_combo']==1){
				$flag = false;
			}
			$pid = M('item_cate')->where(array('id'=>$val['cate_id']))->getField('pid');
			$cates .= "and b.cate_ids like '%".$pid."%' ";  
		}
		
		$coupon	= '';
		$coupon3	= '';
		if($flag){//订单中包含特价产品或活动产品，则只能使用现金券
			//品类券
			$coupon1 = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where('a.status=0 and b.condition <= '.$sumPrice.' and b.kind =2 and userId='.$this->visitor->info['id'].' and a.end_time >= '.time().' '.$cates)
								  ->field('b.exchangeCond,b.desc,b.kind,b.title,b.condition,b.disPrice,a.id as ucId,a.end_time as etime')
								  ->select();
			//其他券					  
			$coupon2 = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where('a.status=0 and b.condition <= '.$sumPrice.' and (b.kind >2 or (b.is_recom =1 and b.kind =1)) and userId='.$this->visitor->info['id'].' and a.end_time >= '.time())
								  ->field('b.exchangeCond,b.desc,b.kind,b.title,b.condition,b.disPrice,a.id as ucId,a.end_time as etime')
								  ->select();
			if(count($coupon2)>0&&count($coupon1)>0){
				$coupon=array_merge($coupon1,$coupon2);
			}else if(count($coupon2)>0){
				$coupon=$coupon2;
			}else if(count($coupon1)>0){
				$coupon=$coupon1;
			}
		}
							  
		//现金券
		$coupon3 = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
							  ->where('a.status=0 and b.condition <= '.$sumPrice.'  and b.kind =1 and b.is_recom in (0,2,3) and userId='.$this->visitor->info['id'].' and a.end_time >= '.time())
							  ->field('b.exchangeCond,b.desc,b.kind,b.title,b.condition,b.disPrice,a.id as ucId,a.end_time as etime')
							  ->select();
		
		
		$jsonArr['couCash'] = $coupon3;
		$jsonArr['couOther'] = $coupon;
		
		$jsonArr['orderId'] = $dingdanhao;
		$jsonArr['sumPrice'] = $sumPrice;
		
		$jsonArr['addr'] = $a_ddr;
		$jsonArr['buyitems'] = $cItems;
		
		$jsonArr['merchant'] = M('user')->where(array('id'=>$shopid))->getField('merchant');
		$jsonArr['points'] = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('points');
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
	}
	
	
	//订单确认
	public function confirm(){
		$points = $this->_post('points','intval');
		$dingdanhao = $this->_post('orderId','trim');
	
		$freetype=$this->_post('freetype','intval');
		$couId1 = $this->_post('couId1','intval');
		$couId2 = $this->_post('couId2','intval');
		$note = $this->_post('note','trim');
		
		
		$dingdanhao = substr($dingdanhao,0,18);
		if(!empty($note))//卖家留言
		{
			$data['note']=$note;
		}
		$data['status']=2;
		$data['supportmetho']=3;
		$data['support_time']=time();
		M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($data);	
			
		if($freetype == 10){ //买家选择顺丰速递  不管商品金额为多少都需要支付运费10元
			$order = M('item_order')->where("orderId LIKE '$dingdanhao%'")->find();
			if($order['goods_sumPrice']<99){
				$order_data['yunfei'] = 20;
			}else{
				$order_data['yunfei'] = 10;
			}
			$order_data['order_sumPrice'] = $order['goods_sumPrice']+10;
			$order_data['freetype'] = $freetype;
			M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
		}
			
		//用户如果选择兑换积分
		$order = M('item_order')->where("orderId LIKE '$dingdanhao%'")->find();
		if($points >= 100){
			$order_data['order_sumPrice'] = $order['order_sumPrice'] - $points/100;
			$order_data['cash_price'] = $points;
			$point_save = M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
			if($point_save){
				$del_point = M('user')->where(array('id'=>$order['userId']))->setDec('points',$points);
				if($del_point){
					$message = D('messagelist');
					$message->user_id =$order['userId']; //用户id
					$message->recom = $order['userId']; //用户id
					$message->type = 7; //积分抵扣
					$message->order_id = $order['orderId']; //订单id
					$message->time = time();
					$message->status = 0; // 默认未读状态
					$message->points = $points;
					//截止最后一次兑换积分，账户中的范票余额
					$message->lastpoint = M('user')->where(array('id'=>$order['userId']))->getField('points');
					$message->add();
				}
			}
		}
			
		$disPrice = 0;
		//现金券以外的优惠券抵扣
		if($couId1>0){
			$order = M('item_order')->where('orderId = '.$dingdanhao)->find();
			$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
									 ->where(array('a.id'=>$couId1))
									 ->field('disPrice')
									 ->find();
			$order_data['order_sumPrice'] = $order['order_sumPrice']+$order['coupon_price'] - $coupon['disPrice'];
			$order_data['coupon_price'] = $coupon['disPrice'];//将优惠券抵扣金额写入数据库
			
			
			
			$uc_data['orderId'] = $order['orderId'];
			$uc_data['status'] = 1;
			$uc_data['user_time'] = time();
			M('user_coupon')->where('id='.$couId1)->save($uc_data);
			
			$coupon_save = M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
			$disPrice = $coupon['disPrice'];
			
		}
		//叠加通用现金券抵扣
		
		if($couId2>0){
			$order = M('item_order')->where('orderId = '.$dingdanhao)->find();
			$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
									 ->where(array('a.id'=>$couId2))
									 ->field('disPrice')
									 ->find();
			$order_data['order_sumPrice'] = $order['order_sumPrice']+$order['coupon_price']-$disPrice - $coupon['disPrice'];
			$order_data['coupon_price'] += $coupon['disPrice'];//将优惠券抵扣金额写入数据库
			
			
			
			$uc_data['orderId'] = $order['orderId'];
			$uc_data['status'] = 1;
			$uc_data['user_time'] = time();
			M('user_coupon')->where('id='.$couId2)->save($uc_data);
			$coupon_save = M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
		}
			
		$item_order = M('item_order')->where("orderId LIKE '$dingdanhao%'")->find();
			
		!$item_order && $this->_404();
		if($item_order['supportmetho']==3)//货到付款
		{
			$this->dopay($dingdanhao,$item_order['order_sumPrice']);
			exit;
		}else{
			echo json_encode(array('status'=>0,'msg'=>'未选择支付方式'));
		}
	}
	
/***********************************************************app接口-end****************************************************************/	
	
	//订单支付完成
	public function paysuccess(){
		$orderid = $this->_post('orderid','trim');
		$where="orderId LIKE '{$orderid}%'";
		
		$order_info = M('item_order')->where($where)->find();
		$shop_name = M('user')->where(array('id'=>$order_info['shopid']))->field('merchant')->find();
		$itemsbuy = M('item')->where('status=1')->order('paynum desc')->limit(4)->field('img,title,id,price')->select();
		
		$this->assign('itemsbuy', $itemsbuy);
		$this->assign('shop_name',$shop_name);
		$this->assign('order_info',$order_info);
		
		$jsonArr['itemsbuy'] = $itemsbuy;     
		$jsonArr['shop_name'] = $shop_name;     
		$jsonArr['order_info'] = $order_info;     
		$jsonArr['status'] = 1;     
		
		//echo json_encode($jsonArr);
		$this->display();
	}
	
	//订单支付失败
	public function paybad(){
		$orderid = $this->_get('orderId','trim');
		$point = $this->_get('point','trim');
		//如果用户选择范票抵扣且未支付，则将范票抵扣记录写进数据库
		if($point !=0 && $point >= 100){
			$data['is_exchange'] = $point;
			M('item_order')->where("orderId LIKE '$orderid%'")->save($data);
		}
		$where="orderId LIKE '{$orderid}%'";
		$order_info = M('item_order')->where($where)->field('orderId,shopid,order_sumPrice')->find();
		$shop_name = M('user')->where(array('id'=>$order_info['shopid']))->field('merchant')->find();
		
		$itemsbuy = M('item')->where('status=1')->order('rand()')->limit(4)->field('img,title,id,price')->select();
		$this->assign('itemsbuy', $itemsbuy);
		$this->assign('shop_name',$shop_name);
		$this->assign('order_info',$order_info);
		
		$jsonArr['itemsbuy'] = $itemsbuy;     
		$jsonArr['shop_name'] = $shop_name;     
		$jsonArr['order_info'] = $order_info;   
		$jsonArr['status'] = 1; 		
		echo json_encode($jsonArr);
		//$this->display();
	}
	
	public function pay_warn() {
		print_r($_POST);
		print_r($_GET);
		exit;
	}
	
	public  function end()
	{
		if(IS_POST)
		{
			$payment_id=$_POST['payment_id'];
			$orderid=$_POST['orderid'];
			$dingdanhao = $_POST['dingdanhao'];
			//dump($dingdanhao);exit;
			$postscript=$this->_post('postscript','trim');//卖家留言
			
			if(!empty($postscript))//卖家留言
			{
				$data['note']=$postscript;
			}
			
			$freetype=$this->_post('freetype','trim');
			$is_yunfei=$this->_post('is_yunfei','trim');
			if($freetype == 10){ //买家选择顺丰速递  不管商品金额为多少都需要支付运费10元
				$order = M('item_order')->where('orderId = '.$dingdanhao)->find();
				if($is_yunfei!=0){
					if($order['order_sumPrice'] < 99){
					$order_data['yunfei'] = 20;
					}else{
						$order_data['yunfei'] = 10;
					}
					$order_data['order_sumPrice'] = $order['order_sumPrice']+10;
					$order_data['freetype'] = $freetype;
					M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
				}
			}
			
			//用户如果选择兑换积分
			$order = M('item_order')->where('orderId = '.$dingdanhao)->find();
			$point = $this->_post('point','trim');
			if($point != 0 && $point >= 100){
				$order_data['order_sumPrice'] = $order['order_sumPrice'] - $point/100;
				$order_data['cash_price'] = $point;
				$point_save = M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
				if($point_save){
					$del_point = M('user')->where(array('id'=>$order['userId']))->setDec('points',$point);
					if($del_point){
						$message = D('messagelist');
						$message->user_id =$order['userId']; //用户id
						$message->recom = $order['userId']; //用户id
						$message->type = 7; //积分抵扣
						$message->order_id = $order['orderId']; //订单id
						$message->time = time();
						$message->status = 0; // 默认未读状态
						$message->points = $point;
						//截止最后一次兑换积分，账户中的范票余额
						$message->lastpoint = M('user')->where(array('id'=>$order['userId']))->getField('points');
						$message->add();
					}
				}
			}
			
			$disPrice = 0;
			//如果用户选择了优惠券抵扣
			$ucId = $_POST['ucId'];
			if($ucId>0){
				$order = M('item_order')->where('orderId = '.$dingdanhao)->find();
				$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
										 ->where(array('a.id'=>$ucId))
										 ->field('disPrice')
										 ->find();
				$order_data['order_sumPrice'] = $order['order_sumPrice']+$order['coupon_price'] - $coupon['disPrice'];
				$order_data['coupon_price'] = $coupon['disPrice'];//将优惠券抵扣金额写入数据库
				
				
				
				$uc_data['orderId'] = $order['orderId'];
				$uc_data['status'] = 1;
				$uc_data['user_time'] = time();
				M('user_coupon')->where('id='.$ucId)->save($uc_data);
				
				$coupon_save = M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
				$disPrice = $coupon['disPrice'];
				
			}
			//叠加通用现金券抵扣
			$coup = $_POST['coup'];
			if($coup>0){
				$order = M('item_order')->where('orderId = '.$dingdanhao)->find();
				$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
										 ->where(array('a.id'=>$coup))
										 ->field('disPrice')
										 ->find();
				$order_data['order_sumPrice'] = $order['order_sumPrice']+$order['coupon_price']-$disPrice - $coupon['disPrice'];
				$order_data['coupon_price'] += $coupon['disPrice'];//将优惠券抵扣金额写入数据库
				
				
				
				$uc_data['orderId'] = $order['orderId'];
				$uc_data['status'] = 1;
				$uc_data['user_time'] = time();
				M('user_coupon')->where('id='.$coup)->save($uc_data);
				
				$coupon_save = M('item_order')->where("orderId LIKE '$dingdanhao%'")->save($order_data);
				
				
			}
			
			//echo $dingdanhao;exit;
			$userId=$this->visitor->info['id']; 
			//$item_order=M('item_order')->where("userId='$userId' and orderId='$dingdanhao'")->find();
			//获取该订单下的所有订单
			$item_order = M('item_order')->where("userId='$userId' and orderId LIKE '$dingdanhao%'")->select();
			
			!$item_order && $this->_404();
			if($payment_id==2)//货到付款
			{
				$data['status']=2;
				$data['supportmetho']=2;
				$data['support_time']=time();
				$userId=$this->visitor->info['id'];
				//更新状态
				foreach($item_order AS $k=>$v){
					$dingdanhao = $v['orderId'];
					M('item_order')->where("userId='$userId' and orderId='$dingdanhao'")->data($data)->save();
					echo "<meta http-equiv='Content-Type' content='text/html;charset=utf-8' /><script>alert('交易成功！您使用的线下交易方式[货到付款]，等待商家发货！');window.location.href='./index.php?m=User&a=index';</script>";
				}
			}elseif ($payment_id==3) {
				//微信支付
				$data['supportmetho']=3;
				$userId=$this->visitor->info['id'];
				if($userId)
				{			
					foreach($item_order AS $k=>$v){
						$dingdanhao1 = $v['orderId'];
						M('item_order')->where("userId='$userId' and orderId='$dingdanhao1'")->data($data)->save();
					}
					$wxconfig=$this->wxconfig();
					$ip = get_client_ip();//获取ip
					echo "<script>location.href='api/wxpay/js_api_call.php?ip=".$ip."&partner=".$wxconfig['partnerid']."&out_trade_no=".$dingdanhao."&body=".$dingdanhao."&total_fee=".$item_order[0]['order_sumPrice']."&notify_url=".$wxconfig['notify_url']."&showwxpaytitle=1'</script>";
				}else 
				{  
					$this->error('微信支付失败!');
				}
			}else {
					$this->error('操作失败!');
			 }
		}elseif ($payment_id==1) //支付宝
		{
				$data['supportmetho']=1;
				$userId=$this->visitor->info['id'];
				if(M('item_order')->where("userId='$userId' and orderId='$dingdanhao'")->data($data)->save())
				{
					$pay=M('pay')->where(array('pay_type'=>'alipay'))->find();
					$alipay=unserialize($pay['config']);
					
				echo "<script>location.href='api/wapalipay/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$dingdanhao."&WIDsubject=".$dingdanhao."&WIDtotal_fee=".$item_order['order_sumPrice']."'</script>";
				
				
				}else 
				{
					$this->error('支付宝操作失败!');
				}
				
			}elseif ($payment_id==3) //微信支付
			{
				$data['supportmetho']=3;
				$userId=$this->visitor->info['id'];
				if($userId)
				{			
					foreach($item_order AS $k=>$v){
						$dingdanhao = $v['orderId'];
						M('item_order')->where("userId='$userId' and orderId='$dingdanhao'")->data($data)->save();
					}
					$dingdanhao1 = explode('-',$dingdanhao); 
					$wxconfig=$this->wxconfig();
					$ip = get_client_ip();//获取ip
					echo "<script>location.href='api/wxpay/js_api_call.php?ip=".$ip."&partner=".$wxconfig['partnerid']."&out_trade_no=".$dingdanhao1[0]."&body=".$dingdanhao1[0]."&total_fee=".$item_order['order_sumPrice']."&notify_url=".$wxconfig['notify_url']."&showwxpaytitle=1'</script>";
				}else 
				{  
					$this->error('微信支付失败!');
				}
			}else if($payment_id==4)//余额支付
			{
				if($_SESSION['user_info']["username"] == "__匿名购物__") {
					//session_destroy();
				}
				$this->redirect('Order/payYuer',array('orderId'=>$dingdanhao));	
			}elseif ($payment_id==5) //支付宝个人收款主页收款
			{
				$data['supportmetho']=5;
			     if(M('item_order')->where('userId="'.$this->visitor->info['id'].'" and orderId="'.$dingdanhao.'"')->data($data)->save())
				{
						$modpayset = M('setting');
					  $alipayhome = $modpayset->where("name='alipayhome'")->getField('data');		
				      if($_SESSION['user_info']["username"] == "__匿名购物__") {
							//session_destroy();
						}
					  echo "<script>location.href='$alipayhome'</script>";exit;
				}else {
					$this->error('支付类型存储失败!');
				}			 
			}else 
			{
				$this->error('操作失败!');
			}
	}
	public function payYuer()
	{
		$item_order=M('item_order');
		$orderId=$_GET['orderId'];//订单号
		$userId=$this->visitor->info['id'];
		$orders=$item_order->where("userId='$userId' and orderId='$orderId'")->find();
		if(!is_array($orders))
		$this->_404();
		$this->assign('orderid',$orders['id']);//订单ID
		$this->assign('dingdanhao',$orders['orderId']);//订单号
		$this->assign('order_sumPrice',$orders['order_sumPrice']);//订单金额
		//读取会员帐户余额
		$user = M('user');
		$userinfo = $user->where("id='$userId'")->find();
		$this->assign('user_yuer',$userinfo['user_account']);
		if($orders['order_sumPrice'] > $userinfo['user_account'])//如果订单金额大于帐户余额
		{
			$tsmsg = "提示：您的帐户余额已不足。<a href='javascript:void(0)'>请点击充值</a>";
			$this->assign('tsmsg',$tsmsg);
		}
		$this->display();
	}
	
	public function payYuerSubmit()
	{
		$user_info = M('user');
		$user_acclog  = M('user_acclog');
		$item_order=M('item_order');
		
		$orderid=$_POST['orderid'];
		$dingdanhao=$_POST['dingdanhao'];
		$userId=$this->visitor->info['id'];
		$order_info = $item_order->where("userId='$userId' and orderId='$dingdanhao'")->find();
		!$order_info && $this->_404();
		//读取会员帐户余额
		$user = M('user');
		$userinfo = $user->where("id='$userId'")->find();
		if($order_info['order_sumPrice'] > $userinfo['user_account'])
		{
			$this->error('对不起，您的余额不足，请充值');
		}else{
			//更新用户帐户
			$user_data['user_account'] = $userinfo['user_account']-$order_info['order_sumPrice'];
			$user_info->where("id=$userId")->save($user_data);
			//添加帐户记录
			$log_data['userid']		= $userId;
			$log_data['username']	= $userinfo['username'];
			$log_data['fl']			= 1;
			$log_data['jiner']		= $order_info['order_sumPrice'];
			$log_data['addtime']	= time();
			$log_data['info']		= '支付成功！订单号：'.$dingdanhao;
			$log_data['orderid']	= $userId.date("YmdHis",time()).rand(1, 99);
			$log_data['status']		= '成功';
			$user_acclog->add($log_data);
			//更新订单状态 支付时间
			$order_data['status']		= 2;
			$order_data['support_time']	= time();
			$item_order->where("orderId='$dingdanhao'")->save($order_data);
			//清空购物车内容
			foreach($_SESSION['cart'] as $k =>$v){
				$arr[$key] = $v['mainid'];
				M('cart')->where('mainid = '.$v['mainid'])->delete();
			}
			$this->success('订单支付成功，请等待发货!!!', U('User/index'));
		}
		
	}
/*=======================by lyye 2014-03-29=======================*/
	
	public function  getFree($type)
	{
		import('Think.ORG.Cart');
       $cart=new Cart();	
		$money=0;
		$items=M('item');
		
		$method=array(1=>'pingyou',2=>'kuaidi',3=>'ems');
		//echo $method[$type];exit;
		foreach ($_SESSION['cart'] as $item)
		{
			$free= $items->field('free,pingyou,kuaidi,ems')->where('free=2')->find($item['id']);
			if(is_array($free))
			{
				$money+=$free[$method[$type]];
				
			}
		}
		return $money;
	}
	
	/**
	*@wxpay config
	* 微信基本配置
	*/
	public function wxconfig(){
		$wxpay=M('pay')->where(array('pay_type'=>'wxpay'))->find();
		$wxpayconfig=unserialize($wxpay['config']);
		//var_dump($wxpayconfig);exit;
		$wxpobj['appId'] = $wxpayconfig['appid'];
		$wxpobj['appsecret'] = $wxpayconfig['appsecret'];
		$wxpobj['signkey'] = $wxpayconfig['signkey'];
		$wxpobj['partnerid'] = $wxpayconfig['partnerid'];
		$wxpobj['partnerkey'] = $wxpayconfig['partnerkey'];
		$wxpobj['notify_url']="http://".$_SERVER['SERVER_NAME'].__ROOT__."/api/wxpay/notifyurl.php";
		$wxpobj['signType'] = 'SHA1';
		$wxpobj['bank_type'] = 'WX';
		$wxpobj['fee_type'] = '1';
		$wxpobj['spbill_create_ip']=get_client_ip();
		$wxpobj['input_charset']='UTF-8';
		return $wxpobj;
	}
	
	
	
	/*======================= 2015-01-05=======================*/
	public function checkUser(){
		if(!empty($this->visitor->info['uid'])){
			
		}else{
			$this->error('请先登陆');
		}
	}

/*======================= 2016-04-06 by shuguang=======================*/
//物流查询 
	public function logistics(){
		import("@.Public.kuaidi"); 	//物流查询类 
		$orderId 	 =$_GET['orderId'];
	    !$orderId && $this->_404();
	    $item_order =M('item_order');
	    $map['orderId'] = $orderId;
	    $kuaidi_info = $item_order->where($map)->field('fahuo_time,freecode,kuaidi_desc,mobile,address,address_name,yunfei,order_sumPrice')->find();
	    $fahuo_date = date('Y-m-d H:i:s',$kuaidi_info['fahuo_time']);//发货时间
		
		//获取订单商品信息
	    $ord_detail = M("order_detail")->where("orderId='".$orderId."' ")->field("itemId,img,title,price,quantity")->order("id asc")->select();
	    
	    $kuaidi_desc = $kuaidi_info['kuaidi_desc'];
	    $kuaidi = explode('|', $kuaidi_desc);
		foreach ($kuaidi as $key => $value) {
			$info = explode('#', $value);
			$exp[$key]['title'] = $info[0];
			$exp[$key]['number'] = $info[1];
		}	    

		$freecode1 = $kuaidi_info['freecode'];
    	$freecode = explode(',',$freecode1);//快递单数组
    	
    	$express = new Kuaidi();//实例化快递查询类
    	//$a = $express -> getorder('471814561855');
    	
    	if($freecode){
            
        	foreach ($freecode as $key => $value) {
        		$exp_result[] = $express -> getorder($value);
        		
        		if($exp_result){
        			$exp[$key]['wl_name'] = $exp_result[$key]['express_name'];
        			$exp[$key]['fahuo_date'] = $fahuo_date;
        			$exp[$key]['wl_tel'] = $exp_result[$key]['tel'];
        			$exp[$key]['wl_no'] = $value;
        			$exp[$key]['order_sn'] = $orderId;


        			foreach ($exp_result as $k => $v) {
    					
    					foreach ($exp_result[$k]['trace'] as $kk => $vv) {
    						//$arr[$k][] = $vv;
    						$ct = count($exp_result[$k]['trace']);//长度 
    						$exp[$key]['fahuo_time'] = $exp_result[$k]['trace'][$ct-1]['time'];
    						$exp[$key]['wl_info'][] = $vv;
    					}
    				}
        		}
        	}
        	
        }
        //获取发货时间 
        

        $this->assign('goods',$ord_detail);
		$this->assign('exp',$exp);//包裹信息 
		$this->assign('kd_info',$kuaidi_info); 
		$jsonArr['goods'] = $ord_detail;     
		$jsonArr['exp'] = $exp;     
		$jsonArr['kd_info'] = $kuaidi_info;   
		$jsonArr['status'] = 1; 		
		//echo json_encode($jsonArr);
		$this->display();
	}
	
	
}