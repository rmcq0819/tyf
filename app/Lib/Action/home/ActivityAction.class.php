<?php
class ActivityAction extends frontendAction {
	

	public function review_2016_consumer(){
		$uid = $this->visitor->info['uid'];
		if(!isset($_GET['shares'])&&$uid <4){
			$this->redirect('Activity/review_2016');
		}
		$userMd = M('user');
		$itemMd = M('item');
		$cateMd = M('item_cate');
		$item_orderMd = M('item_order');
		$order_detailMd = M('order_detail');
		$msgMd = M('messagelist');
		$this->assign('shares',$this->visitor->info['id']);
		$userId =  isset($_GET['shares'])?$_GET['shares']:$this->visitor->info['id'];
		//用户信息
		$reg_time = $this->visitor->info[reg_time];
		$t = time();
		$pt = $t-$reg_time;
		$d = intval($pt/(24*3600));
		$h = intval(($pt-$d*24*3600)/3600);
		$m = intval(($pt-$d*24*3600-$h*3600)/60);
		$this->assign('reg_time',$reg_time);
		$this->assign('d',$d);
		$this->assign('h',$h);
		$this->assign('m',$m);
		
		$user = $userMd->where(array('id'=>$userId))->field('id,cover,username')->find();
		$this->assign('user',$user);
		
		
		//首次购物的时间
		$first_time = $item_orderMd->where(array('status'=>array('in','2,3,4,7,9,10'),'userId'=>$userId))
								   ->order('add_time asc')
								   ->getField('add_time');
		if($first_time){
			$this->assign('first_time',$first_time);
		}
		
		
		//2016经常购买的品类产品
		$items = $item_orderMd->join('a left join weixin_order_detail b on a.orderId=b.orderId')
							  ->where(array('a.status'=>array('in','2,3,4,7,9,10'),'a.userId'=>$userId,'a.orderId'=>array('like','2016%')))
							  ->field('b.quantity,b.itemId,b.profit,a.add_time')
							  ->select();
		
	
		foreach($items as $key=>$val){
			if($itemMd->where(array('id'=>$val['itemId']))->find()){
				$pids[] = $itemMd->join('a left join weixin_item_cate b on a.cate_id=b.id')->where(array('a.id'=>$val['itemId']))->field('pid')->find();
			}
		}
		$cates = $cateMd->where(array('pid'=>'0','sub_name'=>array('neq','')))->field('id,name')->select();
		foreach($cates as $k=>$v){
			$cates[$k]['count'] = 0;
		}
		foreach($pids as $key=>$val){
			foreach($cates as $k=>$v){
				if($val['pid'] == $v['id']){
					$cates[$k]['count'] += 1;
					break;
				}
			}
		}
		foreach($cates as $k=>$v){
			$cnt += $v['count'];
		}
		$cateInfo = '';
		foreach($cates as $k=>$v){
			$cateInfo .= "['".$v['name']."',".round($v['count']/$cnt,1)."],";
		}
		//2016购买商品品类信息
		$this->assign('cateInfo',rtrim($cateInfo,','));
		$this->assign('cnt',$cnt);
		
		
		$points = $msgMd->where(array('type'=>array('in','5,6,8,9,11,19,20,22'),'recom'=>$this->visitor->info['id']))->sum('points');
		if(!$points){
			$points = 0;
		}
		$this->assign('points',$points);	
		$this->display();
	}
	public function review_2016(){
		$uid = $this->visitor->info['uid'];
		if(!isset($_GET['shares'])&&$uid >3){
			$this->redirect('Activity/review_2016_consumer');
		}
		$userMd = M('user');
		$itemMd = M('item');
		$cateMd = M('item_cate');
		$item_orderMd = M('item_order');
		$order_detailMd = M('order_detail');
		$fcMd = M('user_fengchengllist');
		$msgMd = M('messagelist');
		$this->assign('shares',$this->visitor->info['id']);
		$userId =  isset($_GET['shares'])?$_GET['shares']:$this->visitor->info['id'];
		//用户信息
		$reg_time = $this->visitor->info[reg_time];
		$t = time();
		$pt = $t-$reg_time;
		$d = intval($pt/(24*3600));
		$h = intval(($pt-$d*24*3600)/3600);
		$m = intval(($pt-$d*24*3600-$h*3600)/60);
		$this->assign('reg_time',$reg_time);
		$this->assign('d',$d);
		$this->assign('h',$h);
		$this->assign('m',$m);
		
		$user = $userMd->where(array('id'=>$userId))->field('id,cover,username')->find();
		$this->assign('user',$user);
		
		
		
		//首次购物的时间
		$first_time = $item_orderMd->where(array('status'=>array('in','2,3,4,7,9,10'),'userId'=>$userId))
								   ->order('add_time asc')
								   ->getField('add_time');
		if($first_time){
			$this->assign('first_time',$first_time);
		}
		
		
		//2016经常购买的品类产品
		$items = $item_orderMd->join('a left join weixin_order_detail b on a.orderId=b.orderId')
							  ->where(array('a.status'=>array('in','2,3,4,7,9,10'),'a.userId'=>$userId,'a.orderId'=>array('like','2016%')))
							  ->field('b.quantity,b.itemId,b.profit,a.add_time')
							  ->select();
		
	
		foreach($items as $key=>$val){
			if($itemMd->where(array('id'=>$val['itemId']))->find()){
				$pids[] = $itemMd->join('a left join weixin_item_cate b on a.cate_id=b.id')->where(array('a.id'=>$val['itemId']))->field('pid')->find();
			}
		}
		$cates = $cateMd->where(array('pid'=>'0','sub_name'=>array('neq','')))->field('id,name')->select();
		foreach($cates as $k=>$v){
			$cates[$k]['count'] = 0;
		}
		foreach($pids as $key=>$val){
			foreach($cates as $k=>$v){
				if($val['pid'] == $v['id']){
					$cates[$k]['count'] += 1;
					break;
				}
			}
		}
		foreach($cates as $k=>$v){
			$cnt += $v['count'];
		}
		$cateInfo = '';
		foreach($cates as $k=>$v){
			$cateInfo .= "['".$v['name']."',".round($v['count']/$cnt,1)."],";
		}
		//2016购买商品品类信息
		$this->assign('cateInfo',rtrim($cateInfo,','));
		$this->assign('cnt',$cnt);
		
		
		$points = $msgMd->where(array('type'=>array('in','5,6,8,9,11,19,20,22'),'recom'=>$this->visitor->info['id']))->sum('points');
		if(!$points){
			$points = 0;
		}
		$this->assign('points',$points);	
		
		//第一个在店铺买东西的顾客
		
		$fu = $item_orderMd->where(array('status'=>array('in','2,3,4,7,9,10'),'shopid'=>$userId))
								   ->order('add_time asc')
								   ->field('userId,add_time')
								   ->find();
								 
		if($fu){
			$fuser = $userMd->where(array('id'=>$fu['userId']))->field('cover,username')->find();
			$this->assign('fuser',$fuser);
			$this->assign('fu_time',$fu['add_time']);
		}
		
				//第一个在店铺买东西的顾客
		
		$muserId = $item_orderMd->where(array('status'=>array('in','2,3,4,7,9,10'),'shopid'=>$userId))
								   ->order('sum(goods_sumPrice) desc')
								   ->group('userId')
								   ->getField('userId');
								   
								
		if($muserId){
			$muser = $userMd->where(array('id'=>$muserId))->field('cover,username')->find();
			$this->assign('muser',$muser);
			$this->assign('muserId',$muserId);
		}
		$this->display();
	}



}