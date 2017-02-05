<?php
class ActivityAction extends frontendAction {
	
	
	public function signup(){
		$pvMd = M('signup_pv');
		
		$pv_time = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('pv_time');
	   
		//一天只算一次访问量
		if($pv_time != strtotime(date('Y-m-d'))){
			$pv_time	= strtotime(date('Y-m-d'));
			$pvMd->where(array('id'=>1))->setInc('pv');
			M('user')->where(array('id'=>$this->visitor->info['id']))->setField('pv_time',$pv_time);
		}
		 //读取访问量，
		$pv = $pvMd->where(array('id'=>1))->getField('pv');
		$this->assign('pv',$pv);
			
		
		
		$teamMd = M('team');
		$teams = $teamMd->select();
		$people_nums = $teamMd->where(array('is_public'=>0))->sum('people_num');
		$vote_nums = $teamMd->where(array('is_public'=>0))->sum('vote_num');
		$signupMd = M('signup');
		if($signupMd->where(array('userId'=>$this->visitor->info['id'],'is_public'=>0))->find()){
			$signup = 0;
		}else{
			$signup = 1;
		}
		$this->assign('signup',$signup);
		
		$this->assign('tm',$teams);
		$this->assign('vote_nums',$vote_nums);
		$this->assign('people_nums',$people_nums);
		$this->assign('uname',$this->visitor->info['username']);
		$this->display();
	}
	

	public function do_signup(){
		$teamId = $this->_get('teamId','intval');
		$uname = $this->_get('uname','trim');
		$phone = $this->_get('phone','trim');
		$date = $this->_get('date','trim');
		
		
		$signupMd = M('signup');
		
		if($signupMd->where(array('userId'=>$this->visitor->info['id'],'is_public'=>0))->find()){
			echo json_encode(array('status'=>0,'msg'=>'您已报过名了，无需重复报名！'));
			exit;
		}else{
			$data['userId'] = $this->visitor->info['id'];
			$data['uname'] = $uname;
			$data['phone'] = $phone;
			$data['teamId'] = $teamId;
			$data['date'] = $date;
			if($signupMd->add($data)){
				M('team')->where(array('id'=>$teamId))->setInc('people_num');//相应团队人数+1
				echo json_encode(array('status'=>1));
				exit;
			}else{
				echo json_encode(array('status'=>0,'msg'=>'报名失败！'));
				exit;
			}
		}
	}
	
	public function redbag(){
		$is_prize = M('signup')->where(array('userId'=>$this->visitor->info['id']))->getField('is_prize');
		if($is_prize == 0){
			$ct_mod = M('coupon_templet');
			$uc_mod = M('user_coupon');
			$user_mod = M('user');
			//发放范票奖励
			$points = 88;
			$msg_data['recom'] = $this->visitor->info['id']; //用户id
			$msg_data['type'] = 8; //红包奖励类型
			$msg_data['time'] = time();
			$msg_data['points'] = $points;
			M('messagelist')->add($msg_data);
			M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$points);
			//发放优惠券奖励（全品类）
			$templs = $ct_mod->where(array('id'=>array('in','11,12,13,14')))->field('id')->select();
			$uc_data['status'] = 0;         //默认为分享状态
			$uc_data['userId'] = $this->visitor->info['id'];
			$uc_data['add_time'] = time();
			$uc_data['is_prize'] = 2;
			$uc_data['end_time'] = time()+30*24*3600;
			foreach($templs as $ck=>$cv){
				$uc_data['couponId'] = $cv['id'];
				for($i=0;$i<2;$i++){
					$ucId = $uc_mod->add($uc_data);
					$arr[] = $ucId;
					$ct_mod->where(array('id'=>$cv['id']))->setInc('count',1);
				}
			}
			$coupon = $uc_mod->join('a left join weixin_coupon_templet b on a.couponId=b.id')
							 ->field('b.disPrice,b.condition,a.couponId,a.add_time as stime,a.end_time as etime')
							 ->where(array('a.Id'=>array('in',$arr)))
							 ->select();
			M('signup')->where(array('userId'=>$this->visitor->info['id']))->save(array('is_prize'=>1));
			$this->assign('coupon',$coupon);
			$this->assign('points',$points);
			$this->display();
		}else{
			$this->redirect('User/index');
		}
	}
	
	public function public_signup(){
		$this->assign('uid',$this->visitor->info['id']);
		$this->display();
	}
	public function public_do_signup(){
		$date = $this->_get('date','trim');
		$wechat_num = $this->_get('wechat_num','trim');
		$uname = $this->_get('uname','trim');
		$phone = $this->_get('phone','trim');
		
		$signupMd = M('signup');
		
		if($signupMd->where(array('userId'=>$this->visitor->info['id']))->find()){
			echo json_encode(array('status'=>0,'msg'=>'您已报过名了，无需重复报名！'));
			exit;
		}else{
			$data['userId'] = $this->visitor->info['id'];
			$data['uname'] = $uname;
			$data['phone'] = $phone;
			$data['wechat_num'] = $wechat_num;
			$data['date'] = $date;
			$data['is_public'] = 1;
			if($signupMd->add($data)){
				$this->do_redbag();
				echo json_encode(array('status'=>1));
				exit;
			}else{
				echo json_encode(array('status'=>0,'msg'=>'报名失败！'));
				exit;
			}
		}
	}
	
	public function do_redbag(){
		$is_prize = M('signup')->where(array('userId'=>$this->visitor->info['id']))->getField('is_prize');
		if($is_prize == 0){
			$ct_mod = M('coupon_templet');
			$uc_mod = M('user_coupon');
			$user_mod = M('user');
			//发放范票奖励
			$points = 88;
			$msg_data['recom'] = $this->visitor->info['id']; //用户id
			$msg_data['type'] = 8; //红包奖励类型
			$msg_data['time'] = time();
			$msg_data['points'] = $points;
			M('messagelist')->add($msg_data);
			M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$points);
			//发放优惠券奖励（全品类）
			$templs = $ct_mod->where(array('id'=>array('in','11,12,13,14')))->field('id')->select();
			$uc_data['status'] = 0;        
			$uc_data['userId'] = $this->visitor->info['id'];
			$uc_data['add_time'] = time();
			$uc_data['end_time'] = time()+30*24*3600;
			foreach($templs as $ck=>$cv){
				$uc_data['couponId'] = $cv['id'];
				for($i=0;$i<2;$i++){
					$ucId = $uc_mod->add($uc_data);
					$arr[] = $ucId;
					$ct_mod->where(array('id'=>$cv['id']))->setInc('count',1);
				}
			}
			$coupon = $uc_mod->join('a left join weixin_coupon_templet b on a.couponId=b.id')
							 ->field('b.disPrice,b.condition,a.couponId,a.add_time as stime,a.end_time as etime')
							 ->where(array('a.Id'=>array('in',$arr)))
							 ->select();
			M('signup')->where(array('userId'=>$this->visitor->info['id']))->save(array('is_prize'=>1));
		}else{
			$this->redirect('User/index');
		}
	}
	public function shangshi(){
		parent::activity_end();
		//上市抢购活动
		$where['status'] = 1;
		$where['activity'] = 1;
		$items = M('item')->where($where)->field('id,img,price,size,title,aprice,sale_quantity,saled_quantity')->select();
		foreach($items as $key=>$val){
			if($val['size']){
				$aprice=explode('|',$val['aprice']);
				$items[$key]['aprice']=$aprice[0];
			}
			$items[$key]['salelv'] = round(($val['saled_quantity']/($val['sale_quantity']+$val['saled_quantity']))*100,2);
		}

		$this->assign('items',$items);
		$this->display();
	}
	
	public function activity(){
		parent::activity_end();
		//活动单品
		$where['status'] = 1;
		$where['activity'] = 1;
		$items = M('item')->where($where)->field('id,img,price,size,title,aprice')->select();
		foreach($items as $key=>$val){
			if($val['size']){
				$aprice=explode('|',$val['aprice']);
				$items[$key]['aprice']=$aprice[0];
			}
		}
		$this->assign('items',$items);
		//活动套餐
		$wh['board_id'] = 8;
		$combos = M('ad')->where($wh)->field('url,content')->select();
		$this->assign('combos',$combos);
		$this->display();
	}
	
	public function meishi(){
		parent::activity_end();
		$mwhere['pid']=array('in','29,30');
		$cates = M('item_cate')->where($mwhere)->field('id')->select();
		$arr = array();
		foreach($cates as $key=>$val){
			$arr[] = $val['id'];
		}
		
		$where['status'] = 1;
		$where['activity'] = 1;
		if(count($arr)>0){
			$where['cate_id'] = array('in',$arr);
		}
		
		$items = M('item')->where($where)->field('id,img,price,size,title,aprice')->limit('30')->select();
		foreach($items as $key=>$val){
			if($val['size']){
				$aprice=explode('|',$val['aprice']);
				$items[$key]['aprice']=$aprice[0];
			}
		}
		
		//活动时间段
		$t5 = strtotime('2016-10-05 00:00:00');
		$t6 = strtotime('2016-10-07 23:59:59');
		$t6 = strtotime('2016-10-07 23:59:59');		
		/*$t5 = strtotime('2016-9-29 19:00:00');//测试
		$t6 = strtotime('2016-9-29 23:59:59');*/
		
		$time = time();
		//$time = 1475254861;  //测试
		if($time>$t5&&$time<$t6){
			$this->assign('flag',3);
			$this->assign('buy',1);
		}
		$this->assign('items',$items);
		$this->display();
	}
	public function meizhuang(){
		parent::activity_end();
		$cwhere['pid']=array('in','53,28,78,79,80,81,82,31');
		$cates = M('item_cate')->where($cwhere)->field('id')->select();
		$arr = array();
		foreach($cates as $key=>$val){
			$arr[] = $val['id'];
		}
		$where['status'] = 1;
		$where['activity'] = 1;
		if(count($arr)>0){
			$where['cate_id'] = array('in',$arr);
		}
		$items = M('item')->where($where)->field('id,img,price,size,title,aprice')->limit('30')->select();
		foreach($items as $key=>$val){
			if($val['size']){
				$aprice=explode('|',$val['aprice']);
				$items[$key]['aprice']=$aprice[0];
			}
		}
		
		//活动时间段
		$t1 = strtotime('2016-10-01 00:00:00');
		$t2 = strtotime('2016-10-02 23:59:59');
		
		$t3 = strtotime('2016-10-03 00:00:00');
		$t4 = strtotime('2016-10-04 23:59:59');
		
		$t5 = strtotime('2016-10-05 00:00:00');
		$t6 = strtotime('2016-10-07 23:59:59'); 
		
		/*$t1 = strtotime('2016-9-29 00:00:00');//测试
		$t2 = strtotime('2016-9-29 17:59:59');
		
		
		$t3 = strtotime('2016-9-29 18:00:00');
		$t4 = strtotime('2016-9-29 18:59:59');
		
		$t5 = strtotime('2016-9-29 19:00:00');
		$t6 = strtotime('2016-9-29 23:59:59');*/
		
		$time = time();
		//$time = 1475254861;
		if($time>$t1&&$time<$t2){
			$this->assign('flag',1);
		}
		if($time>$t3&&$time<$t4){
			$this->assign('flag',2);
		}
		if($time>$t5&&$time<$t6){
			$this->assign('flag',3);
		}
		if($time>$t3&&$time<$t6){
			$this->assign('buy',1);
		}
		$this->assign('items',$items);
		$this->display();
	}
	public function muying(){
		parent::activity_end();
		$ywhere['pid']=array('in','23');
		$cates = M('item_cate')->where($ywhere)->field('id')->select();
		$arr = array();
		foreach($cates as $key=>$val){
			$arr[] = $val['id'];
		}
		$where['status'] = 1;
		$where['activity'] = 1;
		if(count($arr)>0){
			$where['cate_id'] = array('in',$arr);
		}
		$items = M('item')->where($where)->field('id,img,price,size,title,aprice')->limit('30')->select();
		foreach($items as $key=>$val){
			if($val['size']){
				$aprice=explode('|',$val['aprice']);
				$items[$key]['aprice']=$aprice[0];
			}
		}
		
		//活动时间段
		$t1 = strtotime('2016-10-01 00:00:00');
		$t2 = strtotime('2016-10-02 23:59:59'); 
		$t6 = strtotime('2016-10-07 23:59:59');
		/* $t1 = strtotime('2016-9-29 00:00:00');//测试
		$t2 = strtotime('2016-9-29 17:59:59'); */
		
		$time = time();
		//$time = 1475254861;
		if($time>$t1&&$time<$t2){
			$this->assign('flag',1);
		}
		if($time>$t1&&$time<$t6){
			$this->assign('buy',1);
		}
		$this->assign('items',$items);
		$this->display();
	}
	
	public function kaiye(){
		$rpId = $this->_get('rpId','intval');
		$rd_mod = M('red_packets');
		$user_mod = M('user');
		$uc_mod = M('user_coupon');
		$redPacket = $rd_mod->where(array('Id'=>$rpId))->find();
		$arr = explode('|',ltrim($redPacket['couponIds'],'|'));
		$lq_arr = explode('|',ltrim($redPacket['lq_couponIds'],'|'));
		$userIds = explode('|',ltrim($redPacket['usersId'],'|'));
		$times = explode('|',ltrim($redPacket['lq_time'],'|'));
		$chance = 0;
		$points = 0;
		$flag = 0;
		$coupon = '';
		if(!in_array($this->visitor->info['id'],$userIds)){
			//找出未被抢走的优惠券
			$arr = array_diff($arr,$lq_arr);
			
			//当前次用户抢走的优惠券、范票和抽奖机会
			$idx = array_rand($arr);
			$chance = rand(0,$redPacket['chance']-$redPacket['lq_chance']);
			$points = rand(0,$redPacket['allpoint']-$redPacket['lq_point']);
			
			if($arr[$idx]){
				$coupon = $uc_mod->join('a left join weixin_coupon_templet b on a.couponId=b.id')
										   ->field('b.disPrice,b.condition,a.couponId,a.add_time as stime,a.end_time as etime')
										   ->where(array('a.Id'=>$arr[$idx]))
										   ->find();
				$data['status'] = 0;
				$data['userId'] = $this->visitor->info['id'];
				$data['couponId'] = $coupon['couponId'];
				$data['sharesId'] = $redPacket['userId'];
				$data['add_time'] = time();
				$data['end_time'] = $coupon['end_time'];
				
				if($uc_mod->add($data)!=false){
					//记录领取状态
					M('user_coupon')->where(array('Id'=>$arr[$idx]))->save(array('get_time'=>time(),'get_userId'=>$this->visitor->info['id']));
				}
				$rd['lq_couponIds'] = $redPacket['lq_couponIds'].'|'.$arr[$idx];
			}
			
			//用户抽中的奖品直接加到账户中
			$user_mod->where(array('id'=>$this->visitor->info['id']))->setInc('points',$points);
			$user_mod->where(array('id'=>$this->visitor->info['id']))->setInc('chance',$chance);
		
			
			$rd['lq_point'] = $redPacket['lq_point']+$points;
			$rd['lq_chance'] = $redPacket['lq_chance']+$chance;
			//是否有抢到
			if($chance>0||$points>0||$coupon!=''){
				$rd['usersId'] = $redPacket['usersId'].'|'.$this->visitor->info['id'];
				$rd['lq_time'] = $redPacket['lq_time'].'|'.time();
				$this->assign('flag',1);
			}
			//剩余可抢量更新
			$rd_mod->where(array('Id'=>$rpId))->save($rd);
		}
		
		$users = $user_mod->where(array('id'=>array('in',$userIds)))->field('username,cover')->select();
		foreach($users as $key=>$val){
			$users[$key]['time'] = $times[$key];
		}
		$this->assign('shares',$redPacket['userId']);
		$this->assign('users',$users);
		$this->assign('sharesName',M('user')->where(array('id'=>$redPacket['userId']))->getField('username'));
		$this->assign('chance',$chance);
		$this->assign('points',$points);
		$this->assign('coupon',$coupon);
		$this->display();
	}
	
}