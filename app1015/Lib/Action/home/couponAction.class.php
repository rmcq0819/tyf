<?php
class couponAction extends frontendAction {
	
	public function coupon(){
		$userid = $this->visitor->info['id'];
		//已使用
		$coupon_userd = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where(array('a.status'=>1,'userId'=>$userid))
								  ->field('b.kind,b.title,b.condition,b.disPrice,b.exchangeCond,b.desc,a.add_time as stime,a.end_time as etime')
								  ->order('add_time desc')
								  ->select();
		//未使用已过期
		$coupon_overdue = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where(array('a.status'=>0,'userId'=>$userid,'a.end_time'=>array('lt',time())))
								  ->field('b.kind,b.title,b.condition,b.disPrice,b.exchangeCond,b.desc,a.add_time as stime,a.end_time as etime')
								  ->order('add_time desc')
								  ->select();
		//未使用
		$coupon = M('user_coupon')->join('a left join weixin_coupon_templet b on a.couponId=b.id')
								  ->where(array('a.status'=>0,'userId'=>$userid,'a.end_time'=>array('gt',time())))
								  ->field('b.kind,b.title,b.condition,b.disPrice,b.exchangeCond,b.desc,a.add_time as stime,a.end_time as etime')
								  ->order('add_time desc')
								  ->select();	
					 
		$this->assign('coupon_userd',$coupon_userd);	
		$this->assign('coupon_overdue',$coupon_overdue);	
		$this->assign('coupon',$coupon);	
		$this->assign('time',(time()+3*24*3600));
		
		$jsonArr = array();
		$jsonArr['coupon_userd'] = $coupon_userd;
		$jsonArr['coupon_overdue'] = $coupon_overdue;
		$jsonArr['coupon'] = $coupon;
		$jsonArr['time'] = time()+3*24*3600;
		$jsonArr['status'] = 1;
		//echo json_encode($jsonArr);
		$this->display();
	}
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
										  ->field('kind,title,disPrice,condition,desc,id,exchangeCond,num,count,end_time')
										  ->select();
			}else{
				$coupon_templet1 = $coupon->where(array('is_delete'=>0,'status'=>1,'is_recom'=>array('in','1,2'),'kind'=>1,'end_time'=>array('gt',time())))
										   ->field('kind,title,disPrice,condition,desc,id,exchangeCond,num,count,end_time')
										   ->select();
			}
		}
		$coupon_templet2 = $coupon->where(array('is_delete'=>0,'status'=>1,'kind'=>array('neq',1),'end_time'=>array('gt',time())))
								  ->field('kind,title,disPrice,condition,desc,id,exchangeCond,num,count,end_time')
								  ->select();//全部未过期其他类券
		
		if(count($coupon_templet2)>0&&count($coupon_templet1)>0){
			$coupon_templet=array_merge($coupon_templet1,$coupon_templet2);
		}else if(count($coupon_templet2)>0){
			$coupon_templet=$coupon_templet2;
		}else if(count($coupon_templet1)>0){
			$coupon_templet=$coupon_templet1;
		}	
	
		
		$this->assign('arr',$arr);
		$this->assign('coupon_templet',$coupon_templet);
		
		$jsonArr['arr'] = $arr;
		$jsonArr['coupon_templet'] = $coupon_templet;
		$jsonArr['status'] = 1;
		//echo json_encode($jsonArr);
		
		
		$this->display();
	}
	public function get_coupon(){
		$id = $this->_get('id','intval');
  		$t = time();
		$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
		 
		 $ret = M('user_coupon')->where('add_time between '.$start.' and '.$end.' and userId = '.$this->visitor->info['id'].' and couponId = '.$id)->find();
		if($ret){
			$jsonArr['msg'] = '今天已经领取过啦！';
			$jsonArr['status'] = 0;
		}else{  
		
			 $data['status'] = 0;
			$data['userId'] = $this->visitor->info['id'];
			$data['couponId'] = $id; 
		 	$data['add_time'] = time();
			$days = M('coupon_templet')->where('id = '.$id)->getField('days');
			$data['end_time'] = time()+$days*24*3600; 
			
			if(M('user_coupon')->add($data)){
				$jsonArr['msg'] = '领取成功！';
				$jsonArr['status'] = 1;
			 }else{
				$jsonArr['msg'] = '领取失败！';
				$jsonArr['status'] = 0;
			}  
			M('coupon_templet')->where(array('id'=>$id))->setInc('count',1);
		}   
		echo json_encode($jsonArr);
	}
	
	public function get_exchange(){
		$id = $_POST['id'];
		$t = time();
		$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
		
		$ret = M('user_coupon')->where('add_time between '.$start.' and '.$end.' and userId = '.$this->visitor->info['id'].' and couponId = '.$id)->find();
		if($ret){
			echo '您今日已兑换！';
		}
		$exchangeCond = M('coupon_templet')->where('id = '.$id)->getField('exchangeCond');
		$points = M('user')->where('id = '.$this->visitor->info['id'])->getField('points');
		
		$jsonArr = array();
		if($points>$exchangeCond){
			$udata['points'] =$points - $exchangeCond;
			M('user')->where('id = '.$this->visitor->info['id'])->save($udata);
			$data['status'] = 0;
			$data['userId'] = $this->visitor->info['id'];
			$data['couponId'] = $id;
			$data['add_time'] = time();
			$days = M('coupon_templet')->where('id = '.$id)->getField('days');
			$data['end_time'] = time()+$days*24*3600;
			if(M('user_coupon')->add($data)!=false){
				M('coupon_templet')->where(array('id'=>$id))->setInc('count',1);
				//echo '兑换成功！';
				$jsonArr['msg'] = '兑换成功！';
				$jsonArr['status'] = 1;
				echo json_encode($jsonArr);
			}else{
				//echo '兑换失败！';
				$jsonArr['msg'] = '兑换失败！';
				$jsonArr['status'] = 0;
				echo json_encode($jsonArr);
			}
		}else{
			//echo '您的范票不够哦，多赚取一些再来吧!';
			$jsonArr['msg'] = '您的范票不够哦，多赚取一些再来吧!';
			$jsonArr['status'] = 0;
			echo json_encode($jsonArr);
		}
		
	}
}