<?php
class couponAction extends frontendAction {
	
	public function coupon_center(){
		$userid = $this->visitor->info['id'];
		
		//已使用
		$coupon_userd = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where(array('a.status'=>1,'userId'=>$userid))
								  ->field('b.*,a.add_time as stime,a.end_time as etime')
								  ->order('add_time desc')
								  ->select();
		//未使用已过期
		$coupon_overdue = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where(array('a.status'=>0,'userId'=>$userid,'a.end_time'=>array('lt',time())))
								  ->field('b.*,a.add_time as stime,a.end_time as etime')
								  ->order('add_time desc')
								  ->select();
		//未使用
		$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id left join weixin_user c on a.sharesId=c.id')
								  ->where(array('a.status'=>0,'userId'=>$userid,'a.end_time'=>array('gt',time())))
								  ->field('b.*,a.is_prize,a.add_time as stime,a.end_time as etime,a.Id as ucId,c.username')
								  ->order('add_time desc')
								  ->select();	
					 
		$this->assign('coupon_userd',$coupon_userd);	
		$this->assign('coupon_overdue',$coupon_overdue);	
		$this->assign('coupon',$coupon);	
		$this->assign('time',(time()+3*24*3600));
		$this->display();
	}
	
	public function coupon_to_share(){
		$ids = $this->_get('ids',trim);
		$idArr = explode(',',$ids);
		if(count($idArr)>0){
			//选择分享的优惠券
			$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
									  ->where(array('a.Id'=>array('in',$idArr)))
									  ->field('b.*,a.add_time as stime,a.end_time as etime,a.Id as ucId')
									  ->order('add_time desc')
									  ->select();	
		}
						 
		$username = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('username');
		$this->assign('username',$username);
		$this->assign('coupon',$coupon);	
		$this->assign('ids',$ids);	
		$this->assign('time',(time()+3*24*3600));
		
		$this->display();
	}
	public function coupon_share(){
		$ids = $this->_get('ids',trim);
		$shares = $this->_get('shares',trim);
		$idArr = explode(',',$ids);
		if(count($idArr)>0){
			//选择分享的优惠券
			$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
									  ->where(array('a.Id'=>array('in',$idArr),'get_time'=>'0'))
									  ->field('b.*,a.end_time as etime,a.Id as ucId')
									  ->order('add_time desc')
									  ->select();	
		}
		$username = M('user')->where(array('id'=>$shares))->getField('username');				 
		$this->assign('coupon_share',$coupon);
		$this->assign('username',$username);	
		$this->display();
	}
	public function share_done(){
		$ids = $this->_get('ids',trim);
		$idArr = explode(',',$ids);
		
		M('user_coupon')->where(array('Id'=>array('in',$idArr)))->save(array('status'=>2));
		$this->redirect("coupon/coupon_center");
	}

	public function get_coupon(){
		$id = $_POST['id'];
		$sharesId = $_POST['sharesId'];
		$cou = M('user_coupon')->where(array('Id'=>$id))->find();
		if($cou['get_time']!='0'){
			echo '已经被领走啦';
			exit;
		}
		$data['status'] = 0;
		$data['userId'] = $this->visitor->info['id'];
		$data['couponId'] = $cou['couponId'];
		$data['sharesId'] = $sharesId;
		$data['add_time'] = time();
		$data['end_time'] = $cou['end_time'];
		
		if(M('user_coupon')->add($data)!=false){
			//记录领取状态
			M('user_coupon')->where(array('Id'=>$id))->save(array('get_time'=>time(),'get_userId'=>$this->visitor->info['id']));
			echo '领取成功！';
		}else{
			echo '领取失败！';
		}
	}
}