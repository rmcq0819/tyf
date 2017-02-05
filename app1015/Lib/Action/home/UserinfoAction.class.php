<?php

class UserinfoAction extends userbaseAction {
/***********************************************************app接口-start****************************************************************/
	
	/***** 用户基本信息 *****/
	public function user_index(){
		$user = M('user')->where(array('id'=>$this->visitor->info['id']))->field('username,cover,reg_time,hyimg')->find();
		if($user['hyimg']!=''){
			$jsonArr['cover'] = $user['hyimg'];
		}else{
			$jsonArr['cover'] = $user['cover'];
		}
		$jsonArr['username'] = $user['username'];
		$jsonArr['regtime'] = $user['reg_time'];
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
	}
	
	/***** 不同条件订单数量 *****/
	public  function order_count(){
		$item_order = M('item_order');
		//待付款总数
		$wfpCount = $item_order->where('status=1 and is_delete=0 and userId='.$this->visitor->info['id'])->count();
		//待发货总数
		$tbsCount = $item_order->where('status=2 and is_delete=0 and userId='.$this->visitor->info['id'])->count();
		//待收货总数
		$rogCount = $item_order->where('status=3 and is_delete=0 and userId='.$this->visitor->info['id'])->count();
		//全部订单总数
		$allCount = $item_order->where('is_delete=0 and userId='.$this->visitor->info['id'])->count();
		$jsonArr['wfpCount'] = $wfpCount;
		$jsonArr['tbsCount'] = $tbsCount;
		$jsonArr['rogCount'] = $rogCount;
		$jsonArr['allCount'] = $allCount;
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
	}
	
	
	/***** 未读信息条数 *****/
	public  function msg_count(){
		$msglist = M('messagelist');
		//未读信息条数
		$msgCount = $msglist->where('status=0 and user_id='.$this->visitor->info['id'])->count();
		
		$jsonArr['msgCount'] = $msgCount;
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
	}
	
	
	/***** 基本信息页面 *****/
	public function base_info(){
		$info = M('user')->where(array('id'=>$this->visitor->info['id']))->field('id,hyimg,cover,username,phone_mob,email,zhanghao,huming,kaihuhang')->find();
        $banks = M('bank')->order('id asc')->field('id,bank')->select();
		$jsonArr['id'] = $info['id'];
		$jsonArr['username'] = $info['username'];
		$jsonArr['phone_mob'] = $info['phone_mob'];
		$jsonArr['email'] = $info['email'];
		$jsonArr['zhanghao'] = $info['zhanghao'];
		$jsonArr['huming'] = $info['huming'];
		$jsonArr['kaihuhang'] = $info['kaihuhang'];
		if($info['hyimg']==''){
			$jsonArr['cover'] = $info['cover'];
		}else{
			$jsonArr['cover'] = $info['hyimg'];
		}
		$jsonArr['banks'] = $banks;
		$jsonArr['status'] = 1;
		echo json_encode($jsonArr);
	}
	
	/***** 修改基本信息 *****/
	public function edit_info(){
		$data['nickname'] = $this->_post('username','trim');
		$data['phone_mob']   = $this->_post('phone_mob','trim');
		$data['email']   = $this->_post('email','trim');
		$data['zhanghao']   = $this->_post('zhanghao','trim');
		$data['huming']   = $this->_post('huming','trim');
		$data['kaihuhang']   = $this->_post('kaihuhang','trim');
		$data['hyimg'] = $this->uploadPic('avatar','avatar');//上传的头像所在的文件名称
		$result = M('user')->where(array('id' =>$this->visitor->info['id']))->save($data);
		if($result){
			echo json_encode(array('status'=>1,'msg'=>'修改成功'));
		}else{
			echo json_encode(array('status'=>0,'msg'=>'修改失败'));
		}
	}
	
	/***** 收藏 *****/
	public function collections(){
		$item_likeMd = M('item_like');
        $uid = $this->visitor->info['id'];
        $where['uid'] = $uid;
        $item_likeArr = $item_likeMd->join('a left join weixin_item b on a.item_id= b.id')->where($where)->order('a.add_time DESC')->field('b.id,img,title,price')->select();
        if(count($item_likeArr)>0){
			foreach($item_likeArr as $key=>$val){
				$item_likeArr[$key]['img'] = "http://yooopay.com/data/upload/item/".$val['img'];
			}
			$jsonArr['kileItems'] = $item_likeArr;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	/***** 地址列表 *****/
	public function addr_list(){
		$user_address_mod = M('user_address');
        $uid = $this->visitor->info['id'];
        $where['uid'] = $uid;
        $addrArr = $user_address_mod->where($where)->order('is_default desc')->field('id,consignee,towns,address,mobile,is_default')->select();
        if(count($addrArr)>0){
			$jsonArr['addrList'] = $addrArr;
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	/***** 设置默认地址 *****/
	public function edit_addr()
    {
		$user_address_mod = M('user_address');
		$id = $this->_get('id', 'intval');
		$data['is_default'] = 0;
		if($user_address_mod->where(array('is_default' => 1))->save($data)){
			$data['is_default'] = 1;
			$result = $user_address_mod->where(array('id' =>$id))->save($data);
			if($result){
				$jsonArr['status'] = 1;
			}else{
				$jsonArr['status'] = 0;
			}
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	/***** 删除地址 *****/
	public function del_addr()
    {
		$user_address_mod = M('user_address');
		$id = $this->_get('id', 'intval');
		
		$result = $user_address_mod->where(array('id' =>$id))->delete();
		if($result){
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	/***** 添加地址 *****/
	public function add_addr()
    {
		$user_address_mod = M('user_address');
		$data['uid'] = $this->visitor->info['id'];
		$data['consignee'] = $this->_post('consignee','trim');
		$data['address'] = $this->_post('address','trim');
		$data['mobile'] = $this->_post('phone_mob','trim');
		$data['sheng'] = $this->_post('sheng','trim');
		$data['shi'] = $this->_post('shi','trim');
		$data['qu'] = $this->_post('qu','trim');
		$data['towns'] = $this->_post('towns','trim');
		
		$result = $user_address_mod->add($data);
		if($result){
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	/***** 身份证信息列表 *****/
	public function card_list(){
		$cards = M('idcard')->where('uid = '.$this->visitor->info['id'])->field('id,c_id,c_name')->select();
		if(count($cards)>0){
			$jsonArr['status'] = 1;
			$jsonArr['cards'] = $cards;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	
	/***** 删除身份证信息 *****/
	public function del_card(){
		$idcard_mod = M('idcard');
		$id = $this->_get('id', 'intval');
		
		$result = $idcard_mod->where(array('Id'=>$id))->delete();
		if($result){
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	/***** 添加身份证信息 *****/
	public function add_card()
    {
		$name= $this->_post('name', 'trim');
        $cardId= $this->_post('cardId', 'trim');

        $card=M('idcard');
        $data['c_name'] = $name;
        $data['c_id'] = $cardId;
        $data['uid'] = $this->visitor->info['id'];
		$result = $card->add($data);
		if($result){
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	/***** 范票-赚了多少 *****/
	public function point_gain(){
        $imsg = M('messagelist');
		$where['type'] = array('in','5,6,8,9,11,20');
		$where['recom'] = $this->visitor->info['id'];
        $point_list = $imsg->where($where)->order('id desc')->field('type,time,points')->select();
        if($point_list){
			foreach($point_list as $key=>$val){
				switch ($val['type'])
				{
					case 5:
						$point_list[$key]['desc'] = '购物奖励范票';
						break;  
					case 6:
						$point_list[$key]['desc'] = '评论奖励范票';
						break;
					case 8:
						$point_list[$key]['desc'] = '红包奖励范票';
						break;
					case 9:
						$point_list[$key]['desc'] = '系统奖励范票';
						break;
					case 11:
						$point_list[$key]['desc'] = '红包退还范票';
						break;
					case 20:
						$point_list[$key]['desc'] = '转盘抽奖范票';
						break;
					default:
						$point_list[$key]['desc'] = '赚的范票';
				}
				unset($point_list[$key]['type']);
			}
			$points = $imsg->where($where)->sum('points');
			$jsonArr['status'] = 1;
			$jsonArr['pointList'] = $point_list;
			$jsonArr['points'] = $points;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	
	/***** 范票-花了多少 *****/
	public function point_spend(){
        $imsg = M('messagelist');
       
		$where['type'] = array('in','7,10,21');
		$where['recom'] = $this->visitor->info['id'];
        $point_list = $imsg->where($where)->order('id desc')->field('type,time,points')->select();
        if($point_list){
			foreach($point_list as $key=>$val){
				switch ($val['type'])
				{
					case 7:
						$point_list[$key]['desc'] = '购物抵扣范票';
						break;  
					case 10:
						$point_list[$key]['desc'] = '范票红包分享';
						break;
					case 21:
						$point_list[$key]['desc'] = '范票抽奖机会';
						break;
					default:
						$point_list[$key]['desc'] = '花的范票';
				}
				unset($point_list[$key]['type']);
			}
			$points = $imsg->where($where)->sum('points');
			$jsonArr['status'] = 1;
			$jsonArr['pointList'] = $point_list;
			$jsonArr['points'] = $points;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	/***** 分享范票 *****/
	 public function redbag_sharedo(){
		//用户的范票总额
		$point_yuer = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('points');
        $points = $this->_post('points','trim'); //范票数
        $message = $this->_post('message','trim'); //红包附言
		if($points > $point_yuer){
			$jsonArr['status'] = 0;
			$jsonArr['msg'] = '您输入的范票数高于您的账户范票总额！';
			echo json_encode($jsonArr);
			exit;
		}
        //将用户输入的范票数写进我的红包
        $redPackets = M('red_packets');
        $data['userId'] = $this->visitor->info['id'];
        $data['content_cate'] = 0;
        $data['content'] = $points;
		$data['allpoint'] = $points;
		if($message == ''){
			 $data['message'] = '真诚奉献，分享快乐信念';
		}else{
			$data['message'] = $message;
		}
        $data['status'] = 0;
        $data['source'] = 2; //范票放进红包
        $data['start_time'] = time();
        $data['orderId'] = 0;
        if($redPackets->add($data)){
			//记录范票抵扣
            $message = M('messagelist');
            $message->user_id = $this->visitor->info['id']; //用户id
            $message->recom = $this->visitor->info['id']; //用户id
            $message->type = 10; //范票分享
            $message->order_id =0; //订单id
            $message->time = time();
            $message->status = 0; // 默认未读状态
            $message->points = $points;
            $message->add();
            $del_point =  M('user')->where(array('id'=>$this->visitor->info['id']))->setDec('points',$points);
            if($del_point){
                $jsonArr['status'] = 1;
            }else{
				$jsonArr['status'] = 0;
			}
        }else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	
	/***** 优惠券 *****/
	public function coupons(){
		$userid = $this->visitor->info['id'];
		$cou_type = $this->_get('cou_type','intval');
		
		if($cou_type == 1){
			//未使用
			$where = array('a.status'=>0,'userId'=>$userid,'a.end_time'=>array('gt',time()));
		}else if($cou_type == 2){
			//已过期
			$where = array('a.status'=>0,'userId'=>$userid,'a.end_time'=>array('lt',time()));
		}else{
			//已使用
			$where = array('a.status'=>1,'userId'=>$userid);
		}
		
		$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where($where)
								  ->field('b.kind,b.title,b.condition,b.disPrice,b.exchangeCond,b.desc,a.add_time as stime,a.end_time as etime')
								  ->order('add_time desc')
								  ->select();	
		if(count($coupon)>0){
			foreach($coupon as $key=>$val){
				switch ($val['kind'])
				{
					case 1:
						if($val['condition']==0){
							$coupon[$key]['type'] = '现金券';
						}else{
							$coupon[$key]['type'] = '通用券';
						}
						break;  
					case 2:
						$coupon[$key]['type'] = '品类券';
						break;
					case 3:
						$coupon[$key]['type'] = '兑换券';
						break;
					case 4:
						$coupon[$key]['type'] = '新人券';
						break;
					default:
						$coupon[$key]['type'] = '优惠券';
				}
			}
			$jsonArr['status'] = 1;
			$jsonArr['coupon'] = $coupon;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);						  
	}
	
	/***** 领券中心 *****/
	public function coupon_templet(){
		$coupon = M('coupon_templet');
		$user_coupon = M('user_coupon');
		
		$t = time();
		$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t)); 
		
		//判断用户当天是否已领券
		$couponIds = $user_coupon->where('add_time between '.$start.' and '.$end.' and userId = '.$this->visitor->info['id'])->field('couponId')->select();
		$arr = array();
		foreach($couponIds as $key=>$val){
			$arr[] = $val['couponId'];
		}
		
		
		$starttime = mktime(10,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$endtime = mktime(18,0,0,date("m",$t),date("d",$t),date("Y",$t));
		if(time()>$starttime&&time()<$endtime){
			if(date('w')==0||date('w')==6){	//周末现金券面金额
				$coupon_templet1 = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,3'),'kind'=>1,'end_time'=>array('gt',time())))
										  ->field('id,kind,title,disPrice,condition,desc,exchangeCond,num,count,end_time')
										  ->select();
			}else{
				$coupon_templet1 = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,2'),'kind'=>1,'end_time'=>array('gt',time())))
										   ->field('id,kind,title,disPrice,condition,desc,exchangeCond,num,count,end_time')
										   ->select();
			}
		}
		$coupon_templet2 = $coupon->where(array('is_delete'=>0,'status'=>1,'kind'=>array('neq',1),'end_time'=>array('gt',time())))
								  ->field('id,kind,title,disPrice,condition,desc,exchangeCond,num,count,end_time')
								  ->select();//全部未过期其他类券
		
		if(count($coupon_templet2)>0&&count($coupon_templet1)>0){
			$coupon_templet=array_merge($coupon_templet1,$coupon_templet2);
		}else if(count($coupon_templet2)>0){
			$coupon_templet=$coupon_templet2;
		}else if(count($coupon_templet1)>0){
			$coupon_templet=$coupon_templet1;
		}	
		
		if(count($coupon_templet)>0){
			foreach($coupon_templet as $key=>$val){
				switch ($val['kind'])
				{
					case 1:
						if($val['condition']==0){
							$coupon_templet[$key]['type'] = '现金券';
						}else{
							$coupon_templet[$key]['type'] = '通用券';
						}
						break;  
					case 2:
						$coupon_templet[$key]['type'] = '品类券';
						break;
					case 3:
						$coupon_templet[$key]['type'] = '兑换券';
						break;
					case 4:
						$coupon_templet[$key]['type'] = '新人券';
						break;
					default:
						$coupon_templet[$key]['type'] = '优惠券';
				}
			}
			$jsonArr['status'] = 1;
			$jsonArr['coupon_tpl'] = $coupon_templet;
			$jsonArr['couIds'] = $arr;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
	}
	
	/***** 我的红包 *****/
	/*public function red_packets(){
		$uid = $this->visitor->info['id'];
        $ibag = M('red_packets');
        $bag_list = $ibag->where(array('userId'=>$uid,'status'=>0))->order('id desc')->select(); //未拆开
		$bag_list1 = M('red_packets')
        ->join("a left join weixin_messagelist as b on a.Id = b.pid")
		->where(array('b.recom'=>$this->visitor->info['id']))
		->order('a.Id desc')
        ->select();
		
        $bag_list2 = M('red_packets')
        ->join("a left join weixin_user as b on a.shares_uid = b.id")
        ->field("a.*,b.username")
        ->where(array('a.userId'=>$uid,'a.shares_status'=>2))
        ->order('id desc')
        ->select();
	}
	 */
	
	/***** 消息中心-消息分类 *****/
	public function info_count(){
        $count1 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>1))->count();
        $count2 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>2))->count();
        $count3 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>3))->count();
        $count4 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>4))->count();
		
		$jsonArr['status'] = 1;
		$jsonArr['count1'] = $count1;
		$jsonArr['count2'] = $count2;
		$jsonArr['count3'] = $count3;
		$jsonArr['count4'] = $count4;
		echo json_encode($jsonArr);
    }
	
	/***** 消息中心-消息列表*****/
	public function info_list(){
        $where['recom'] = $this->visitor->info['id'];
        $where['type'] = $this->_get('type');
        $msglist = M('messagelist')->where($where)->order('id desc')->field('id,content,time')->select();
        if(count($msglist)>0){
			$jsonArr['status'] = 1;
			$jsonArr['msgs'] = $msglist;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	
	/***** 消息中心-删除消息*****/
	public function del_info(){
        $id = $_GET['id'];
        $where['id'] = $id;
        $ret = M('messagelist')->where($where)->delete();
        if($ret){
			$jsonArr['status'] = 1;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	
	/***** 消息中心-消息详情*****/
	public function info_content(){
        $id = $_GET['id'];
        $where['id'] = $id;
        $status = M('messagelist')->where($where)->getField('status');
        if($status == 0){
            $data['status'] = 1;
            M('messagelist')->where($where)->save($data);
        }
        $msg = M('messagelist')->where('id='.$id)->field('id,content')->find();
        if($msg){
			$jsonArr['status'] = 1;
			$jsonArr['msg'] = $msg;
		}else{
			$jsonArr['status'] = 0;
		}
		echo json_encode($jsonArr);
    }
	
	
/***********************************************************app接口-end****************************************************************/
}