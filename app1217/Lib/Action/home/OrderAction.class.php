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
        //dump($this->visitor->info['id']);die;   and a.userId = ".$this->visitor->info['id']."
        //dump($item_orders);die;
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
			//更新detail表中的状态为已完成
			M('order_detail')->where(array('orderId'=>$orderId))->save(array('status'=>4));
            //获取订单信息和商品信息
            $order_detail = M('order_detail')
                ->where("orderId = '".$orderId."'")
                ->select();
            //dump($order_detail);die;
            foreach ($order_detail as $k => $val) {
                $profitPrice += $val['profit']; //获取订单利润
                $orderPrice += $val['price']; //获取订单单价
                // 减掉对应商品的库存数量
                $item->where('id='.$val['itemId'])->setInc('buy_num',$val['quantity']);
                $shares['id']= $item_orders['shares'];
            }
            //dump($profitPrice);die;
            $shop_shares = $this->getShareTree($item_orders['shopid']);//获取获得提成的用户ID
            //dump($shop_shares);die;
            foreach($shop_shares['uid'] as $sk=>$sv){
                $lvId .=$sv;
            }
            $roy = M('user_fengchenglv')->where(array('id'=>$lvId))->field('royalty')->find();//获取各级别的分成率

            $royArr = explode('|',$roy['royalty']);
            //dump($royArr);die;
            $time = date("Y-m-d H:i:s");
            $fclist = M("user_fengchengllist");
            foreach($royArr as $rk=>$rv){
                //店铺分成
                $fcdata['price']= round($orderPrice,2); //订单总金额
                $fcdata['user_id'] = $this->visitor->info['id'];
                $fcdata['add_time']= time();
                $fcdata['state'] 	 = 1;
                $fcdata['orderId'] = $item_orders['orderId'];
                $fcdata['royalty'] = $rv;
                $fcdata['fencheng']= round($profitPrice*$rv,2);
                $fcdata['uid'] = $shop_shares['shareId'][$rk];
                $res = $fclist->add($fcdata);
				//确认收货后修改allfclist表中的订单状态为2（已收货）
                $edt = M('user_allfcllist')->where(array('orderId'=>$item_orders['orderId']))->setField('is_find',2);
                $wxsend->SR($shop_shares['wechatid'][$rk],round($profitPrice*$rv,2),$time);//提示代理商获得返利
                //$wxsend->SR('oOejpwvMFZF5-J1VkOpyU-AbIS1E',round($profit*$rv,2).' '.$shop_shares['wechatid'][$rk],$time); //测试样例
            }
            //dump($fcdata);die;
			$this->success('确认收货成功!',U('User/index'));
	    }else 
	    {
	     	$this->error('确定收货失败');
	    }
	}

    public function getShareTree($shopid){
        //售出商品的店铺
        //$shopid = $this->_get('shopid','trim');
        $user_mod = M('user');
        $user =  $user_mod->where(array('id'=>$shopid))->field('uid,username,wechatid,shares_tree')->find();
        $uid = $user['uid'];

        $arr = array();
        $arr['shareId'][] = $shopid;
        $arr['uid'][] = $uid;
        $arr['username'][] = $user['username'];
        $arr['wechatid'][] = $user['wechatid'];
        //由低等级往上,找出5,3,2等级的店铺各一家
        while($uid>2){
            $sharesArr = explode('|',$user['shares_tree']);
            $num = count($sharesArr);
            if($num<3){
                return $arr;
                //echo json_encode($arr);exit;
            }
            $user = $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            while($user['uid']>=$uid){ //需要跳过相同等级的店铺
                $sharesArr = explode('|',$user['shares_tree']);
                $num = count($sharesArr);
                if($num<3){
                    return $arr;
                    //echo json_encode($arr);exit;
                }
                $user = $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            }
            $arr['shareId'][] = $sharesArr[$num-2];
            $arr['uid'][] = $user['uid'];
            $arr['username'][] = $user['username'];
            $arr['wechatid'][] = $user['wechatid'];
            $uid = $user['uid'];
        }
        //再找出两家等级为2的店铺
        for($i=0;$i<2;$i++){
            $sharesArr = explode('|',$user['shares_tree']);
            $num = count($sharesArr);
            if($num<3){
                return $arr;
                //echo json_encode($arr);exit;
            }
            $user =  $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            while($user['uid']!=2){
                $sharesArr = explode('|',$user['shares_tree']);
                $num = count($sharesArr);
                if($num<3){
                    return $arr;
                    //echo json_encode($arr);exit;
                }
                $user = $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            }
            $arr['shareId'][] = $sharesArr[$num-2];
            $arr['uid'][] = $user['uid'];
            $arr['username'][] = $user['username'];
            $arr['wechatid'][] = $user['wechatid'];
        }
        return $arr;
        //echo json_encode($arr);
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

		$message = M('messagelist');
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
		$message->add();
		$wxsend->SR($suser['wechatid'],round($fcdata['fencheng'],2),date("Y-m-d H:i:s"));//提示代理商将获得返利
		//$wxsend->SR('oOejpwvMFZF5-J1VkOpyU-AbIS1E',round($fcdata['fencheng'],2),date("Y-m-d H:i:s")); //测试样例
		
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
		
		if(empty($_POST['info'])){
			 $this->error('评价内容还未填写');
		} 
		$picurl1 = "";
		$picurl2 = "";
		$picurl3 = "";
		$picFile = $_FILES["picurl1"];
		if($picFile["error"] === 4) {
			$picurl1 = "";
		} else {
			$picurl1 = "data/upload/bbs/".time().$uid."_img.jpg";
			$exist = file_exists($picurl1);
			if($exist) {
				unlink($picurl1);
			}
			 move_uploaded_file($picFile["tmp_name"],$picurl1);
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
	
		$uname = $this->visitor->info['username'];
		
		$itemId = $_POST["itemId"];
		$status = 1;
		$add_time = time();
		$item_commentMd = M("item_comment");
		$data['picurl1']=$picurl1;
		$data['picurl2']=$picurl2;
		$data['picurl3']=$picurl3;
		$data["uid"] = $uid;
		$data["info"] = $info;
		$data["orderId"] = $orderId;
		$data["uname"] = $uname;
		$data["status"] = $status;
		$data['size'] = $_POST['size'];
		$data["add_time"] = $add_time;
		$data["item_id"] = $itemId;
		$item_commentMd->add($data);
		
		$order_detailMd = M("order_detail");
		$item_orderMd = M("item_order");
		//评论都是5积分
		$order_info = $item_orderMd->where(array('orderId'=>$orderId))->find();
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
		$order_detailMd->where(array("orderId"=>$orderId,'itemId'=>$itemId))->save(array('c_status'=>1));
		if($order_detailMd->where(array("orderId"=>$orderId,"c_status"=>0))->count()==0){
			$item_orderMd->where(array("orderId"=>$orderId))->save(array('c_status'=>1));
		}

		$this->redirect('User/comment_success');
		$this->display();
	}
	
		//申请退款
	public function orderTK() {
		if (IS_POST) {
				$uid = $this->visitor->info['id'];
				$usersMd = M('user');
				$userstixian = $usersMd->where(array('id' => $uid))->find();
				$uname = $this->visitor->info['username'];
				$orderId = $_POST["orderId"];
				$yuanyin = $_POST["yuanyin"];
				$express = $_POST["express"];
				$waybill = $_POST["waybill"];
				$refund = $_POST["refund"];
				$detail_id = $_POST['detail_id'];
			
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
				if(!empty($detail_id)){
					$item_orderTK = M("order_detail");
					$res=$item_orderTK->where(array("id"=>$detail_id))->save(array("status"=>6));
				}else{
					$item_orderTK = M("item_order");
					$res=$item_orderTK->where(array("orderId"=>$orderId))->save(array("status"=>6,'tuihuo_time'=>time()));
				}
				
				$this->assign("item_orderTK",$item_orderTK);
				if ($res) {
					$this->success('申请成功!请耐心等待审核',U('User/index'));
				}
		}else{
			$detail_id = $_GET['detail_id'];
			$orderId = $_GET['orderId'];
			if(!empty($detail_id)){
				$where['id']= $detail_id;
				$res=M('order_detail')->where($where)->find();
			}else{
				$where['orderId']= $orderId;
				$res=M('item_order')->where($where)->find();
			}
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
	  $tk=$_GET['tk'];
	  if ($tk==1) {
	  		$order_tk = M('item_ordertk')->where(array('orderId'=>$orderId))->find();
	  		$user = M('item_order')->where(array('orderId'=>$orderId))->field('mobile')->find();
	  }
	  $this->assign('mobile',$user['mobile']);
	  $this->assign('order_tk',$order_tk);
	  $this->assign('tk',$tk);
	  $usersMd = M('user');
	  $userstixian = $usersMd->where(array('id' => $userId))->find();
	  $this->assign("userstixian",$userstixian);
	  $order=$item_order->where("orderId='$orderId'")->find();
	  
	  if(!is_array($order))
	  {
	  	$this->error('该订单不存在');
	  }else 
	  {
	  	
	  	$order_detail=M('order_detail');
	 
	  	$order_details= $order_detail->where("orderId='".$order['orderId']."'")->select();
	  	$item_detail=array();
	  	foreach ($order_details as $key=>$val)
	  	{	
	  		$items_attr=$val['item_attr'];//商品属性
			$attr_arr=array_filter(explode(";",$items_attr));
			$attr_list=array();
			foreach($attr_arr as $ke=>$va){
				$attr_arr2=array_filter(explode("|",$va));
				$attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
			}
			$items[$key]['attr']=$attr_list;//赋值items
			
	  		$items[$key]= array('id'=>$val['id'],'title'=>$val['title'],'itemId'=>$val['itemId'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'color'=>$val['color'],'size'=>$val['size'],'zuzhuang'=>$val['zuzhuang'],'attr'=>$attr_list);
			$items[$key]['totalprice'] += $val['quantity']*$val['price'];
	  		//$order[$key]['items'][]=$items;
	  		$item_detail[$key]=$items[$key];
	  		
	  	}
		
		$delivery=M('delivery');
		$deliverys=$delivery->where("name='".$order['userfree']."'")->find();
		
		$typeCom = $deliverys['userfreeDM'];//快递公司
		$typeNu = $order['freecode'];  //快递单号
		$callbackurl = 'http://a1876988.sn12279.gzonet.com/index.php?m=User&a=index';//返回网址
		
		$URL = 'http://m.kuaidi100.com/index_all.html?type='.$typeCom.'&postid='.$typeNu.'&callbackurl='.$callbackurl.'#result';
		$this->assign('URL',$URL);

	  }
	  
	  //预计订单送达时间
	  /*
	  $order_type = strstr($order['orderId'],'-02');
	  $weekarray=array("日","一","二","三","四","五","六");
	  if($order_type){
		  if($weekarray[date("w",$order['add_time'])] == '六'){
			   $dh_time = $order['add_time']+3*24*3600;
		  }elseif($weekarray[date("w",$order['add_time'])] == '日'){
			  $dh_time = $order['add_time']+2*24*3600;
		  }else{
			  $dh_time = $order['add_time']+2*24*3600;
		  }
		  $this->assign('dh_time',$dh_time);
	  }else{
		  if($weekarray[date("w",$order['add_time'])] == '六'){
			   $dh_time = $order['add_time']+8*24*3600;
		  }elseif($weekarray[date("w",$order['add_time'])] == '日'){
			  $dh_time = $order['add_time']+7*24*3600;
		  }else{
			  $dh_time = $order['add_time']+7*24*3600;
		  }
		  $this->assign('dh_time',$dh_time);
	  }
	  */
	  //$start_dhtime = $order['add_time']+100; //开始预计送达时间
	  $start_time = $order['add_time']+220; //开始处理订单时间
	  $dist_time = $order['add_time']+454; //开始配货时间
	  $this->assign('start_time',$start_time);
	  $this->assign('dist_time',$dist_time);
	  //$this->assign('start_dhtime',$start_dhtime);
	  $this->assign('act_time',time());//获取当前时间
	  
	  //会员分组,里面有会员折扣价
	  $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$this->visitor->info['uid']))->find();
	  $this->assign('user_category', $user_category);
	  
	  //查询优惠券使用状况
	  
	   $youhuiquan =M('item_jifen')->field('title')->where(array('orderId'=> $orderId))->find();
	   $this->assign('youhuiquan', $youhuiquan);
	   $itemcomment = M('item_comment')->where(array('orderId' =>$orderId))->find();
	   $itemordertk = M('item_ordertk')->where(array('orderId' =>$orderId))->find();
	   $this->assign('uid',$this->visitor->info['id']);
	   $this->assign('itemcomment',$itemcomment);
	   $this->assign('itemordertk',$itemordertk);
	   //dump($item_detail);exit;
	   $this->assign('item_detail',$item_detail);
	   $this->assign('order',$order);
	   $this->assign("orderId",$orderId);
	   $this->assign("totalprice",$val['sigsumprice']);
		
		$this->_config_seo();
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
			//将$_SESSION["cart"]中的内容替换成用户以选中内容
			$i=0;
			$arr = array();
			foreach ($_SESSION['ncart'] as $key => $value) {
				if(in_array($key, $idArr)){
					$arr[]=$value['mainid'];
				}
			}
			if(count($arr) > 0){
				$wh['mainid'] = array('in',$arr);
				$cartItem = M('cart')->where($wh)->select();
				$_SESSION["cart"] = '';
				$_SESSION['cart'] = $cartItem;
			}
		}else if(isset($_GET['cartId'])){
			$cartId = $_GET['cartId'];
			$arr = M('cart')->where('mainid ='.$cartId)->select();
			$_SESSION['cart'] = $arr;
		}
		
		//dump($_SESSION['cart']);

		if(count($_SESSION['cart'])>0)
		{

			$user_address_mod = M('user_address');
			$addr_id=$_GET['addr_id'];
			if ($addr_id) {
				$address_list = $user_address_mod->where(array('id'=>$addr_id))->select();
			}
			else{
				//$address_list = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->select();
				$address_list = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->select();//2016-04-12 by shuguang 根据默认地址排序

			}
			//获取全部的收货地址
			//$address_list2 = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->select();
			$address_list2 = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->select();//2016-04-12 by shuguang 根据默认地址排序

			$this->assign('address_list', $address_list);
			$this->assign('addr_id',$addr_id);
			$this->assign('address_list2', $address_list2);
			
			//获取用户代金卷
			$daijinjuan['djuser']=$this->visitor->info['id'];
			$daijinjuan['djend']=array('gt',time());
			$daijinjuan['djstatus']=0;
			$daijin=M('daijin')->where($daijinjuan)->select();
			$this->assign('daijin',$daijin);
			$items=M('item');
			$item=$_SESSION['cart'];
			$sunnum=0;
			$sunprice=0;
			//print_r($item);
			//=============结算时计算总价和数量================
			for ($i=0; $i < count($item); $i++) { 
					$nums=$item[$i];
	                $sunprice+=$nums['price']*$nums['num'];
					$sunnum+=$nums['num'];
			}
			$_SESSION['sumprice']=$sunprice;
	        $this->assign('sunprice',round($sunprice,2)); 
	        $this->assign('sunnum',$sunnum);  
			
			$u1=array();
			

			//dump(session('shopid'));exit;
			$merchant = M("user")->where('id='.session('shopid'))->find();
			foreach($item as $k=>&$e){
			$name=&$e['shopid'];
			if(!isset($u1[$name])){
				$u1[$name]=$e;
				unset($u1[$name]['id'],$u1[$name]['name'],$u1[$name]['price'],$u1[$name]['num'],$u1[$name]['img'],$u1[$name]['attr'],$u1[$name]['size'],$u1[$name]['discount'],$u1[$name]['zuzhuang'],$u1[$name]['cost'],$u1[$name]['itemtype']);
			}
				
			$u1[$name]['goods'][]=array('id'=>$e['id'],'name'=>$e['name'],'price'=>$e['price'],'num'=>$e['num'],'img'=>$e['img'],'attr'=>$e['attr'],'size'=>$e['size'],'discount'=>$e['discount'],'zuzhuang'=>$e['zuzhuang'],'cost'=>$e['cost'],'itemtype'=>$e['itemtype'],'asdasdas'=>$e['itemtype']);
	   }
	   $item = array_values($u1); unset($u1);
	   array_push($item[0],$merchant['merchant']);
	   //作用=>购买范票的id
	   $arrid = $_SESSION['cart'];
	   $is_fictitious = M('item')->where(array('id'=>$arrid[0]['id']))->find();
	   //是否为线下实体店
	   $store = M('user')->where(array('id'=>$_SESSION['shopid']))->find();
	   $this->assign('item',$item);
		$cards = M('idcard')->where('uid = '.$this->visitor->info['id'])->select();
		$this->assign('cards',$cards);
		$cid=$_GET['card_info'];

		if($cid){
			$this->assign('cardid',$cid);

			$ret=M('idcard')->where('Id = '.$cid)->find();
			
			$this->assign('c_ard',$ret);
			$this->assign('flag',true);
		}
		
		
		
		//获取商品类型
		$itemtype = array();
		foreach($_SESSION['cart'] AS $v) {
			
			$itemtype[] = $v['itemtype'];
			
		}
		
		if(in_array(0, $itemtype)){
			$this->assign('itemtype',0);
		}else{
			$this->assign('itemtype',1);
		}
		
		$pingyou=0;
		$kuaidi=0;
		$ems=0;
		$freesum=0;
		foreach ($_SESSION['cart'] as $item)
		{
			$free= $items->field('free,pingyou,kuaidi,ems')->where('free=2')->find($item['id']);
			if(is_array($free))
			{
				$pingyou+=$free['pingyou'];
				$kuaidi+=$free['kuaidi'];
				$ems+=$free['ems'];
				$freesum+=$free['pingyou']+$free['kuaidi']+$free['ems'];
			}
/*=======================by lyye 2014-04-08=======================*/
			//判断是否限购
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
			
/*=======================by lyye 2014-04-08=======================*/
		}
		
		// $dingdanhao = date("Y-m-dH-i-s");
		// $dingdanhao = str_replace("-","",$dingdanhao);
		// $dingdanhao .= rand(1000,2000);
		import('Think.ORG.Cart');// 导入分页类
    	$cart=new Cart();
    	$sumPrice= $cart->getPrice();
		 
		 //sail
		 if(isset($_GET["spr"])) {
		 	$spr = intval($_GET["spr"]);
			 if($spr == 1){
			 	$sumPrice = $sumPrice - 5;
			 } else if($spr == 2) {
			 	$sumPrice = $sumPrice - 10;
			 } else if($spr == 3) {
			 	$sumPrice = $sumPrice - 20;
			 } else if($spr == 4) {
			 	$sumPrice = $sumPrice - 50;
			 }
		 }
    	 
    	 $freearr=array();
    	 if($pingyou>0)
    	 {
    	 	$freearr[]=array('value'=>1,'price'=>$pingyou);
    	 }
    	  if($kuaidi>0)
    	 {
    	 	$freearr[]=array('value'=>2,'price'=>$kuaidi);
    	 }
    	  if($ems>0)
    	 {
    	 	$freearr[]=array('value'=>3,'price'=>$ems);
    	 }
		 
		

			
			// var_dump($freearr);
			 $this->assign('freearr',$freearr);
			 $this->assign('is_fictitious',$is_fictitious);
			 $this->assign('store',$store);
			 $this->assign('freesum',$freesum);
			 $this->assign('sumPrice',$sumPrice);
			//$this->assign('pingyou',$pingyou);
			//$this->assign('kuaidi',$kuaidi);
			//$this->assign('ems',$ems);
			
			 //运费设置，不满99元需要运费
			 $yunfei = M('setting')->where("name='site_yunfei'")->find();
			 
			 if($cart->getPrice()<99){
				$this->assign('yunfei',round($yunfei['data'],2));
			 }
			
			$this->_config_seo();
			
			

			
			
			
			
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
	public function pay()//出订单
	{

		if(IS_POST&&count($_SESSION['cart'])>0)//1.订单未生成情况下  生成订单号、分单   
		{  

		   import('Think.ORG.Cart');// 导入分页类
           $cart=new Cart();	
		   $user_address=M('user_address');
		   $item_order=M('item_order');
		   $order_detail=M('order_detail');
		   $item_goods=M('item');
		   $this->visitor->info['id'];//用户ID
		   $this->visitor->info['username'];//用户账号
		   $this->visitor->info['wechatid'];//用户账号
		   
		   //完税、保税商品的分离组合
		   $u1=array();
		   foreach($_SESSION['cart'] as $k=>&$e){
		   	$name=&$e['itemtype'];
		   	if(!isset($u1[$name])){
		   		$u1[$name]=$e;
		   		unset($u1[$name]['id'],$u1[$name]['name'],$u1[$name]['price'],$u1[$name]['num'],$u1[$name]['img'],$u1[$name]['attr'],$u1[$name]['size'],$u1[$name]['discount'],$u1[$name]['zuzhuang'],$u1[$name]['cost'],$u1[$name]['baseid'],$u1[$name]['is_fictitious']);
		   	}
		   		
		   	$u1[$name]['goods'][]=array('id'=>$e['id'],'name'=>$e['name'],'price'=>$e['price'],'num'=>$e['num'],'img'=>$e['img'],'attr'=>$e['attr'],'size'=>$e['size'],'discount'=>$e['discount'],'zuzhuang'=>$e['zuzhuang'],'cost'=>$e['cost'],'baseid'=>$e['baseid'],'is_fictitious'=>$e['is_fictitious']);
		   }
		   $itemlist = array_values($u1); unset($u1);
		  
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
		   //dump($itemlist);exit;
		   //echo "<pre>";
		   //var_dump($itemlist);exit;
		   
		   //身份证正、反图上传
		   $date_dir = date('ym/d/'); //上传目录
		   $result = $this->_upload($_FILES['idczimg'], 'idcard/'.$date_dir, array(
		   		'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'),
		   		'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
		   		'suffix' => '_b,_m,_s',
		   ));
		   if ($result['error']) {
		   	//$this->error($result['info']);
		   	$orders['idcfimg']="";
		   } else {
		   	$orders['idczimg'] = $date_dir . $result['info'][0]['savename'];
		   }
		   	
		   $result2 = $this->_upload($_FILES['idcfimg'], 'idcard/'.$date_dir, array(
		   		'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'),
		   		'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
		   		'suffix' => '_b,_m,_s',
		   ));
		   if ($result2['error']) {
		   	//$this->error($result2['info']);
		   	$orders['idcfimg']="";
		   } else {
		   	$orders['idcfimg'] = $date_dir . $result2['info'][0]['savename'];
		   } 
		   
		   
		   //生成订单号
		   $dingdanhao = date("Y-m-dH-i-s");
		   $dingdanhao = str_replace("-","",$dingdanhao);
		   $dingdanhao .= rand(1000,2000);
		   
		    $time=time();//订单添加时间
		    
			$address_options= $this->_post('address_options','intval');//地址  0：刚填的地址 大于0历史的地址
			$shipping_id=$this->_post('shipping_id','intval');//配送方式
			
			
		    
		    if(empty($shipping_id))//卖家包邮
		    {
		    	$data['freetype']=0;
				
				$sumPrice = $cart->getPrice();
				if(isset($_GET["spr"])) {
					 $spr = intval($_GET["spr"]);
					 if($spr == 1){
					 	$sumPrice = $sumPrice - 5;
					 } else if($spr == 2) {
					 	$sumPrice = $sumPrice - 10;
					 } else if($spr == 3) {
					 	$sumPrice = $sumPrice - 20;
					 } else if($spr == 4) {
					 	$sumPrice = $sumPrice - 50;
					 }
				}
		    	$data['order_sumPrice']=$sumPrice;
		    }else 
		    {
		    	$data['freetype']=$shipping_id;
		    	$data['freeprice']= $this->getFree($shipping_id);//取到运费
		    	
		    	//sail
		    	$sumPrice = $cart->getPrice()+$this->getFree($shipping_id);
				if(isset($_GET["spr"])) {
					 $spr = intval($_GET["spr"]);
					 if($spr == 1){
					 	$sumPrice = $sumPrice - 5;
					 } else if($spr == 2) {
					 	$sumPrice = $sumPrice - 10;
					 } else if($spr == 3) {
					 	$sumPrice = $sumPrice - 20;
					 } else if($spr == 4) {
					 	$sumPrice = $sumPrice - 50;
					 }
				}
		    	$data['order_sumPrice']=$sumPrice;
		    	
		    	//echo $cart->getPrice()+$this->getFree($shipping_id);exit;
		    }
		   //$data['orderId']=$dingdanhao;//订单号
		   $data['add_time']=$time;//添加时间
		   
		   $sumPrice = $cart->getPrice();
		   $daijin=$this->_post('daijin','intval');//代金券 
		   if ($daijin!=1) {
		   		$dj=M('daijin')->where(array('id'=>$daijin))->field('djmoney')->find();
		   		$data['order_sumPrice']=$data['order_sumPrice']-$dj['djmoney'];
		   }
		   if(isset($_GET["spr"])) {
			 $spr = intval($_GET["spr"]);
			 if($spr == 1){
			 	$sumPrice = $sumPrice - 5;
			 } else if($spr == 2) {
			 	$sumPrice = $sumPrice - 10;
			 } else if($spr == 3) {
			 	$sumPrice = $sumPrice - 20;
			 } else if($spr == 4) {
			 	$sumPrice = $sumPrice - 50;
			 }
		   }
		   $data['chexing']=$this->_post('chexing','trim');
		   $data['goods_sumPrice']=$sumPrice;//商品总额
		   $data['userId']=$this->visitor->info['id'];//用户ID
		   if($this->visitor->info['username']){
		   		$data['userName']=$this->visitor->info['username'];//用户名
			}else{
				$data['userName']=$this->visitor->info['wechatid'];//用微信id做用户名
			}
			
			if($address_options==0)
			{
			$consignee=$this->_post('consignee2','trim');//真实姓名
			$sheng=$this->_post('sheng2','trim');//省
			$shi=$this->_post('shi2','trim');//市
			$qu=$this->_post('qu2','trim');//区
			$address=$this->_post('address2','trim');//详细地址
			$phone_mob=$this->_post('phone_mob','trim');//电话号码
			$save_address=$this->_post('save_address','trim');//是否保存地址
			//判断是否为顾客,是则匹配地区代理商
			if ($this->visitor->info['uid']==4) {
				$where['shi']=$shi;
				$where['qu']=$qu;
				$where['uid']=3;
				$res=M('user')->where($where)->field('id')->find();
				if (!$res['id']) {
					$where1['shi']=$shi;
					$where1['qu']='市辖区';
					$where1['uid']=3;
					$res=M('user')->where($where1)->field('id')->find();
				}
				$res['id']=$res['id']?$res['id']:0;
				$data['uid']=$res['id'];
			}
			$data['shopid'] = session('shopid'); //分享过来的商家 ID
			$data['address_name']=$consignee;//收货人姓名
			$data['mobile']=$phone_mob;//电话号码
			$data['address']=$sheng.$shi.$qu.$address;//地址
			
			   if($save_address)//保存地址
			   {
			   	$add_address['uid']=$this->visitor->info['id'];
			   	$add_address['consignee']=$consignee;
			   	$add_address['address']=$address;
			   	$add_address['mobile']=$phone_mob;
			   	$add_address['sheng']=$sheng;
			   	$add_address['shi']=$shi;
			   	$add_address['qu']=$qu;
			   	
                 $user_address->data($add_address)->add();
		       }
		
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
				$data['goods_sumPrice'] = $data['goods_sumPrice'];	//不含运费的
				$isfic = M('item')->where(array('id'=>$this->_post('pointitem','trim')))->find();
				$store = M('user')->where(array('id'=>$_SESSION['shopid']))->find();
				if($isfic['is_fictitious'] == 1 || $store['is_store']==1){
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
					
					//$data['orderId']=$dingdanhao.'-'.$i;	//订单号
					$data['orderId']=$dingdanhao.'-01'; //保税
					$orderid = $item_order->data($data)->add();
					
				}else{
					//$data['orderId']=$dingdanhao.'-'.$i;	//订单号
					if($val['goods'][0]['is_fictitious'] == 1){
						$data['orderId']=$dingdanhao.'-03'; //虚拟商品
					}else{
						$data['orderId']=$dingdanhao.'-02'; //完税
					}
					$orderid = $item_order->data($data)->add();
									
				}

			}
			
			//$orderid=$item_order->data($data)->add();
			if($orderid)//添加订单成功
			{	
				$data2['id']=$daijin;
				$data2['djstatus']=1;
				$data2['order']=$data['orderId'];
				M('daijin')->save($data2);
				//$orders['orderId']=$dingdanhao;
				
				foreach ($itemlist as $key=>$item)
				{
					$orders['sigsumprice'] = "";
					foreach($item['goods'] AS $key3=>$item3){
							
						$orders['sigsumprice']+=$item3['price'];
							
					}
					//判断属于那种商品 0:保税 1：完税
					$key = $key+1;
					$i = $key<=10?'0'.$key:$key;
					if($item['itemtype']==0){

						//$orders['orderId']=$dingdanhao.'-'.$i;	//订单号
						$orders['orderId']=$dingdanhao.'-01';	//订单号
						foreach($item['goods'] AS $key1=>$item1){
							//得到分成
					
							$orders['fencheng'] = M('item')->where(array('id'=>$item1['id']))->getField('fencheng');
							//得到利润
							$orders['profit'] = round(($item1['price']-$item1['cost'])*$item1['num'],2);
							//减掉对应商品的库存数量
							$goods_stock = $item_goods->where(array('id'=>$item1['id']))->field('size,goods_stock,stock,is_stockjointly')->find();
							//获取该商品的库存、规格
							$stock=explode('|',$goods_stock['goods_stock']);
							$stk=explode('|',$goods_stock['stock']);
							$size=explode('|',$goods_stock['size']);
						
							foreach($size as $key2=>$item2){
								if($item2 == $item1['size']){
									$this_stock = $stock[$key2]-$item1['num']*$stk[$key2];
									if($goods_stock['is_stockjointly'] == 1){//共库存商品
										foreach($stock as $ky=>$vl){
											$stock[$ky] = $this_stock;
										}
									}else{
										$stock[$key2] = $this_stock;
									}
								}
								
								$data5['goods_stock']=implode('|',$stock);
								$item_goods->where(array('id'=>$item1['id']))->save($data5);
								$orders['itemId']=$item1['id'];//商品ID
								$orders['title']=$item1['name'];//商品名称
								$orders['img']=$item1['img'];//商品图片
								$orders['price']=$item1['price'];//商品价格
								$orders['quantity']=$item1['num'];//购买数量
								$orders['color']=$item1['color'];//购买颜色
								$orders['size']=$item1['size'];//购买尺寸
								$orders['zuzhuang']=$item1['zuzhuang'];//购买组装
								$orders['item_attr']=$item1['attr'];//商品属性
								$orders['itemtype']=$item['itemtype'];//商品类型
								$orders['idcname'] = $this->_post('idcname','trim');//身份证姓名
								$orders['idcnum'] = $this->_post('idcnum','trim');//身份证号码
								$orders['zimg'] = $this->_post('zimg');
								$orders['fimg'] = $this->_post('fimg');
								$orders['shopid'] = session('shopid'); //分享过来的商家 ID
								$orders['baseid'] = $item1['baseid'];//免税仓id
								
								$datas1['baseid']=$item1['baseid'];
								M('item_order')->where(array('orderId'=>$dingdanhao.'-01'))->save($datas1);
							}
							
							$orders['sigsumprice'] = $item[0]; //分单商品总价格
							//分单入库
							$orders['add_time'] = time();
							$order_detail->data($orders)->add();
							
						}
						
					}else{
						//如果商品为虚拟商品则使用-03进行分离
						if($item['goods'][0]['is_fictitious'] == 1){
							$orders['orderId']=$dingdanhao.'-03';	//虚拟商品订单号
						}else{
							$orders['orderId']=$dingdanhao.'-02';	//完税商品订单号
						}
						//$orders['orderId']=$dingdanhao.'-'.$i;	//订单号
						foreach($item['goods'] AS $key1=>$item1){
							
							//得到分成
					
							$orders['fencheng'] = M('item')->where(array('id'=>$item1['id']))->getField('fencheng');
							//得到利润
							$orders['profit'] = round(($item1['price']-$item1['cost'])*$item1['num'],2);
			
							//减掉对应商品的库存数量
							$goods_stock = $item_goods->where(array('id'=>$item1['id']))->field('size,goods_stock,stock,is_stockjointly')->find();
							//获取该商品的库存、规格
							$stock=explode('|',$goods_stock['goods_stock']);
							$stk=explode('|',$goods_stock['stock']);
							$size=explode('|',$goods_stock['size']);
							
							foreach($size as $key2=>$item2){
								if($item2 == $item1['size']){
									$this_stock = $stock[$key2]-$item1['num']*$stk[$key2];
									
									if($goods_stock['is_stockjointly'] == 1){//共库存商品
										foreach($stock as $ky=>$vl){
											$stock[$ky] = $this_stock;
										}
									}else{
										$stock[$key2] = $this_stock;
									}
								}
								$data5['goods_stock']=implode('|',$stock);
								$item_goods->where(array('id'=>$item1['id']))->save($data5);
								$orders['itemId']=$item1['id'];//商品ID
								$orders['title']=$item1['name'];//商品名称
								$orders['img']=$item1['img'];//商品图片
								$orders['price']=$item1['price'];//商品价格
								$orders['quantity']=$item1['num'];//购买数量
								$orders['color']=$item1['color'];//购买颜色
								$orders['size']=$item1['size'];//购买尺寸
								$orders['zuzhuang']=$item1['zuzhuang'];//购买组装
								$orders['item_attr']=$item1['attr'];//商品属性
								$orders['itemtype']=$item['itemtype'];//商品类型
								$orders['idcname'] = $this->_post('idcname','trim');//身份证姓名
								$orders['idcnum'] = $this->_post('idcnum','trim');//身份证号码
								$orders['zimg'] = $this->_post('zimg');
								$orders['fimg'] = $this->_post('fimg');
								$orders['shopid'] = session('shopid'); //分享过来的商家 ID
								$orders['baseid'] = $item1['baseid'];//免税仓id
								
								$datas2['baseid']=$item1['baseid'];
								M('item_order')->where(array('orderId'=>$dingdanhao.'-02'))->save($datas2);
						
							}
							
							$orders['sigsumprice'] = $item[0]; //分单商品总价格
							//分单入库
							$orders['add_time'] = time();
							$order_detail->data($orders)->add(); 
								
						}
										
					}


				} 
				
				//sail 代金券插入订单号 --begin
				$title = "";
				$uid = $this->visitor->info['id'];
				if(isset($_GET["spr"])) {
					$spr = intval($_GET["spr"]);
					if($spr == 1){
						$title = "5元代金券";
					} else if($spr == 2) {
						$title = "10元代金券";
					} else if($spr == 3) {
						$title = "20元代金券";
					} else if($spr == 4) {
						$title = "50元代金券";
					}else if($spr == 5) {
						$title = "100元代金券";
					}
			    }
				M("item_jifen")->where(" title='".$title."' and uid='".$uid."' and (orderId='' or orderId is null) ")->save(array("orderId"=>$dingdanhao));
				//sail 代金券插入订单号 --end
				$cart->clear();//清空购物车
				//查询当前用户积分
				$user_point = M('user')->where(array('id'=>$this->visitor->info['id']))->find();
				for($i=100;$i<=$user_point['points'];$i+=100){
					if($data['order_sumPrice'] <= 1000){
						if($i<=$data['order_sumPrice']*100-100){
							$point_arr[] = $i;
						}
					}else{
						if($i<=$data['order_sumPrice']*100-1000){
							$point_arr[] = $i;
						}
					}
				}
				$this->assign('point_yuer',$point_arr);
				$this->assign('userfreeze',$user_point); //冻结范票账户
				$this->assign('point',$user_point['points']); //范票总数量
				
				$this->assign('orderid',$orderid);//订单ID
				$this->assign('dingdanhao',$dingdanhao);//订单号
				$this->assign('order_sumPrice',$data['order_sumPrice']);
				$orders=$item_order->where("userId='$uid' and orderId LIKE '$dingdanhao%'")->find();
				$this->assign('orders',$orders);
				$orders_detail = M('order_detail')->where("orderId LIKE '$dingdanhao%'")->find();
				$this->assign('orders_detail',$orders_detail);
				//选择收货地址
				$user_address_mod = M('user_address');
				$address_list2 = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->select();
				$this->assign('address_list2', $address_list2);
				//print_r($data['order_sumPrice']);
				//print_r($item_order);
				//echo "-----------------------------------";
				//print_r($data);
			}else 
			{
				$this->error('生成订单失败!');
			}
		}else if(isset($_GET['orderId']))
		{
			$item_order=M('item_order');
			$orderId=$_GET['orderId'];//订单号
			$orderId = substr($orderId,0,18);
			
			$userId=$this->visitor->info['id'];
			$orders=$item_order->where("userId='$userId' and orderId LIKE '$orderId%'")->find();
			$orders_detail = M('order_detail')->where("orderId LIKE '$orderId%'")->find();
			$this->assign('orders',$orders);
			$this->assign('orders_detail',$orders_detail);
			if(!is_array($orders))
			$this->_404();
			
			if(empty($orders['supportmetho']) || $orders['supportmetho']==4)//是否已有支付方式
			{
				//选择收货地址
				$user_address_mod = M('user_address');
				$address_list2 = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->order("is_default desc")->select();
				$this->assign('address_list2', $address_list2);
				//选择身份证
				$cards = M('idcard')->where('uid = '.$this->visitor->info['id'])->select();
				$this->assign('cards',$cards);
				//查询当前用户积分
				$user_point = M('user')->where(array('id'=>$this->visitor->info['id']))->find();
				for($i=100;$i<=$user_point['points'];$i+=100){
					if($orders['order_sumPrice'] <= 1000){
						if($i<=$orders['order_sumPrice']*100-100){
							$point_arr[] = $i;
						}
					}else{
						if($i<=$orders['order_sumPrice']*100-1000){
							$point_arr[] = $i;
						}
					}
				}
				$this->assign('point_yuer',$point_arr);
				$this->assign('userfreeze',$user_point); //冻结范票账户
				$this->assign('point',$user_point['points']); //范票总数量
				
				$this->assign('orderid',$orders['id']);//订单ID
				$this->assign('dingdanhao',/* $orders['orderId'] */$orderId);//订单号
				$this->assign('order_sumPrice',$orders['order_sumPrice']);
				
				$dingdanhao = /* $orders['orderId'] */$orderId;
			}elseif($orders['supportmetho']==1)//选择支付宝
			{
			$pay=M('pay')->where(array('pay_type'=>'alipay'))->find();
			$alipay=unserialize($pay['config']);
			//$this->assign('alipayview',$pay['status']);
			echo "<script>location.href='api/wapalipay/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$orderId."&WIDsubject=".$orderId."&WIDtotal_fee=".$orders['order_sumPrice']."'</script>";
			}elseif($orders['supportmetho']==3)//选择微信支付
			{		
			//$pay=M('pay')->where(array('pay_type'=>'wxpay'))->find();
			//dump($orders);exit;
			//$wxpay=unserialize($pay['config']);
			$wxconfig=$this->wxconfig();
			$ip = get_client_ip();//获取ip
			//var_dump($wxconfig);exit;
			//echo $ip;exit;
			echo "<script>location.href='api/wxpay/js_api_call.php?ip=".$ip."&partner=".$wxconfig['partnerid']."&out_trade_no=".$orderId."&body=".$orderId."&total_fee=".$orders['order_sumPrice']."&notify_url=".$wxconfig['notify_url']."&showwxpaytitle=1'</script>";
			exit;
			}elseif($orders['supportmetho']==4)
			{ //支付宝个人收款主页收款
				$modpayset = M('setting');
				$alipayhome = $modpayset->where("name='alipayhome'")->getField('data');		
				echo "<script>location.href='$alipayhome'</script>";exit;	   
			}			
		}
		else 
		{
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
		 ->join('a left join weixin_item_order b on a.orderId=b.orderId left join weixin_item c on c.id=a.itemId')
		 ->field('b.userId,a.*,c.is_fictitious')
		 ->where("a.orderId LIKE '$dingdanhao%' and b.userId=".$this->visitor->info['id']."")
		 ->find();
		 
		$orderinfo = M('item_order')
		->field('a.*,b.itemId,b.title,b.img,b.price,b.quantity,b.size,b.itemtype,b.sigsumprice,b.shopid,c.activity,c.sale_quantity,c.is_combo,c.cate_id')
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
				unset($u1[$name]['cate_id'],$u1[$name]['activity'],$u1[$name]['sale_quantity'],$u1[$name]['is_combo'],$u1[$name]['itemId'],$u1[$name]['title'],$u1[$name]['img'],$u1[$name]['price'],$u1[$name]['quantity'],$u1[$name]['size'],$u1[$name]['itemtype'],$u1[$name]['sigsumprice']);
			}
			 
			$u1[$name]['goods'][]=array('cate_id'=>$e['cate_id'],'activity'=>$e['activity'],'sale_quantity'=>$e['sale_quantity'],is_combo=>$e['is_combo'],'itemId'=>$e['itemId'],'title'=>$e['title'],'img'=>$e['img'],'price'=>$e['price'],'quantity'=>$e['quantity'],'size'=>$e['size'],'sigsumprice'=>$e['sigsumprice'],'itemtype'=>$e['itemtype']);
		}
		$orderinfo = array_values($u1); unset($u1);
		array_push($orderinfo[0], $merusername['merchant']);
		//dump($orderinfo);exit;
		
		
		/*用户可用优惠券,未使用且满足使用条件*/
		//判断订单中是否有活动产品,有活动产品则不能使用优惠券
		$flag = true;
		$cates = '';
		
		foreach($orderinfo[0]['goods'] as $key => $val){
			if(($val['activity']==1||$val['is_combo']==1)&&$val['sale_quantity']>=$val['quantity']){
				$flag = false;
			}
			$pid = M('item_cate')->where(array('id'=>$val['cate_id']))->getField('pid');
			$cates .= "and b.cate_ids like '%".$pid."%' ";  
		}
		
		//dump($flag);exit;
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
			//现金券
			$coupon3 = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
							  ->where('a.status=0 and b.condition <= '.$orderinfo[0]['goods_sumPrice'].'  and b.kind =1 and b.is_recom in (0,2,3) and userId='.$this->visitor->info['id'].' and a.end_time >= '.time())
							  ->field('b.*,a.id as ucId,a.end_time as etime')
							  ->select();
	    }
							  
		
		$this->assign('coupon',$coupon);
		$this->assign('coupon3',$coupon3);
		$this->assign('count',count($coupon)+count($coupon3));
		$this->assign('time',(time()+3*24*3600));

		$this->assign('orderaddr',$orderaddr);
		$this->assign('orderinfo',$orderinfo);
		$this->assign('pointitem',$pointitem);
		
		$this->display();
	}
	
	//订单支付完成
	public function paysuccess(){
		$orderid = $this->_get('orderid','trim');
		$where="orderId LIKE '{$orderid}%'";
		$order_info = M('item_order')->where($where)->find();
		$shop_name = M('user')->where(array('id'=>$order_info['shopid']))->find();
		$itemsbuy = M('item')->where('status=1')->order('buy_num desc')->limit(30)->select();
		
		$this->assign('itemsbuy',$itemsbuy);
		$this->assign('shop_name',$shop_name);
		$this->assign('order_info',$order_info);
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
		$order_info = M('item_order')->where($where)->find();
		$shop_name = M('user')->where(array('id'=>$order_info['shopid']))->find();
		
		$itemsbuy = M('item')->where('status=1')->order('rand()')->limit(30)->select();
		$this->assign('itemsbuy', $itemsbuy);
		$this->assign('shop_name',$shop_name);
		$this->assign('order_info',$order_info);
		$this->display();
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
			$postscript=$this->_post('postscript','trim');//卖家留言
			
			if(!empty($postscript))//卖家留言
			{
				$data['note']=$postscript;
			}
			
			//用户如果选择兑换积分
			$order = M('item_order')->where('orderId = '.$dingdanhao)->find();
			$point = $this->_post('point','trim');
			if($point != 0 && $point >= 100){
				$order_data['order_sumPrice'] = $order['order_sumPrice'] - $point/100;
				$order_data['cash_price'] = $point;
				$order_data['buck_time'] = time(); //抵扣时间
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
			/*=======================by lyye 2014-03-29=======================*/
			}else if($payment_id==4)//余额支付
			{
				if($_SESSION['user_info']["username"] == "__匿名购物__") {
					//session_destroy();
				}
				$this->redirect('Order/payYuer',array('orderId'=>$dingdanhao));	
/*=======================by lyye 2014-03-29=======================*/
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
/*=======================by lyye 2014-03-29=======================*/
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
	
	
	public function save_address(){
		if(IS_POST){
			$id = $this->_post('id','trim'); //地址ID
			$orderId = $this->_post('orderId','trim'); //订单号
			$address_info = M('user_address')->where(array('id'=>$id))->find();
			//保存地址信息
			$data['address_name'] = $address_info['consignee'];
			$data['mobile'] = $address_info['mobile'];
			$data['address_id'] = $id;
			$data['address'] = $address_info['sheng'].$address_info['shi'].$address_info['qu'].$address_info['address'];
			$save_order = M('item_order')->where(array('orderId'=>$orderId))->save($data);
			if($save_order){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0));
			}
		}
	}
	
	public function save_carid(){
		$id = $this->_post('id','trim'); //身份证ID
		$orderId = $this->_post('orderId','trim'); //订单号
		$carid_info = M('idcard')->where(array('Id'=>$id))->find();
		//保存身份证信息
		$data['idcname'] = $carid_info['c_name'];
		$data['idcnum'] = $carid_info['c_id'];
		$save_carid = M('order_detail')->where(array('orderId'=>$orderId))->save($data);
		if($save_carid){
			echo json_encode(array('status'=>1));
		}else{
			echo json_encode(array('status'=>0));
		}
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
		import("@.Public.Express"); 	//物流查询类 
		$detail_id 	 =$_GET['detail_id'];
		$order = M('order_detail')
        ->join("a left join weixin_item_order as b on a.orderId = b.orderId")
		->field('a.*,b.address_name,b.mobile,b.address,b.order_sumPrice,b.yunfei')
		->where(array('a.id'=>$detail_id))
        ->find();
		$itemorder = M ('item_order')->where(array('orderId'=>$order['orderId']))->find();
		$express = new Express();
		//如果是国际物流，则采用 http://www.qexpress.co.nz/ 接口获取物流信息
		if($order['userfree'] == '国际物流'){
			$result  = $express -> getorder($order['freecode'],1);
		}elseif($order['userfree'] == '程光快递'){
			$result =array('data'=>$express->get_free($order['freecode']));
		}else{
			$result  = $express -> getorder($order['freecode'],2);
		}
		$freelist = M('freeinfo')->where(array('detail_id'=>$_GET['detail_id']))->order('add_time desc')->select();
		$this->assign('freelist',$freelist);
		$this->assign('result',$result);
		$this->assign('order',$order);
		$this->assign('itemorder',$itemorder);
	    $this->display();
		
	}
	
	
}