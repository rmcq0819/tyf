<?php
class ActivityAction extends frontendAction{
	

	
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
		$this->assign('shares',$this->visitor->info['id']);
		$userId =  isset($_GET['shares'])?$_GET['shares']:$this->visitor->info['id'];
		//用户信息
		$user = $userMd->where(array('id'=>$userId))->field('cover,username')->find();
		$this->assign('user',$user);
		//首次购物的时间
		$first_time = $item_orderMd->where(array('status'=>array('in','2,3,4,7,9,10'),'userId'=>$userId))->order('add_time asc')->getField('add_time');
		if($first_time){
			$this->assign('first_time',$first_time);
		}
		
		
		
		//2016消费总额
		$orders = $item_orderMd->where(array('status'=>array('in','2,3,4,7,9,10'),'userId'=>$userId,'orderId'=>array('like','2016%')))->field('orderId,goods_sumPrice')->select();
		foreach($orders as $key=>$val){
			$idx = substr($val['orderId'],0,18);
			$orderArr[$idx] = $val['goods_sumPrice'];
		}
		$amount = 0;
		foreach($orderArr as $key=>$val){
			$amount += $val;
		}
		
		
		
		if($amount > 5000){
			$this->assign('grade','钻石买手');
		}else if($amount > 2000){
			$this->assign('grade','白金买手');
		}else if($amount > 1000){
			$this->assign('grade','黄金买手');
		}else if($amount > 500){
			$this->assign('grade','白银买手');
		}else if($amount > 200){
			$this->assign('grade','青铜买手');
		}else{
			$this->assign('grade','黑铁买手');
		}
		$this->assign('amount',$amount);
		
		//2016购买了多少件商品类型统计
		$items = $item_orderMd->join('a left join weixin_order_detail b on a.orderId=b.orderId')->where(array('a.status'=>array('in','2,3,4,7,9,10'),'a.userId'=>$userId,'a.orderId'=>array('like','2016%')))->field('b.quantity,b.itemId,b.profit,a.add_time')->select();
		
	
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
		
		$max = $cats[0];
		foreach($cates as $k=>$v){
			if($v['count']>$max){
				$max = $v;
			}
			$cnt += $v['count'];
		}
		
		$cateInfo = '';
		foreach($cates as $k=>$v){
			$cateInfo .= "['".$v['name']."',".round($v['count']/$cnt,1)."],";
		}
		
		
		//2016购买商品品类信息
		$this->assign('cateInfo',rtrim($cateInfo));
		//2016购买商品最多的品类
		$this->assign('max',$max);
		$this->assign('cnt',$cnt);
		
		
		$this->display();
	}
	public function review_2016(){
		$time_start=date("Y-m-d",time()-24*60*60*1);
        $time_end = date('Y-m-d');
        $data['add_time']=array('between',array(strtotime($time_start),strtotime($time_end)));
		$data['status'] = array('in','2,3,4,7,9,10');
		$orders = M('item_order')->where($data)->field('orderId,status,goods_sumPrice,order_sumPrice')->select();
		
		dump('区分-01 -02 -03      '.count($orders));
		foreach($orders as $key=>$val){
			//$amount +=$val['goods_sumPrice'];
			$amount +=$val['order_sumPrice'];
			$idx = substr($val['orderId'],0,18);
			$orderArr[$idx] = $val;
		}
		dump('区分-01 -02 -03后订单金额存在重复统计    '.$amount);
		dump('不区分-01 -02 -03    '.count($orderArr));
		foreach($orderArr as $key=>$val){
			$amount_order += $val['order_sumPrice'];
			$amount_goods += $val['goods_sumPrice'];
		}
		dump('用户实际支付金额   '.$amount_order);
		dump('订单内商品的总金额    '.$amount_goods);exit;
	}

	
	public function getDowns(&$fenxiaos,$userid){
		$user=M('user');
        $where = array('a.shares_tree' => array('like','%|'.$userid.'|-%'),'a.uid'=>array('neq','4'));
        $users=$user->join('a left join weixin_user_apply b on a.id=b.userid')->where($where)->field('a.id,a.username,a.cover,b.add_time')->order('b.add_time')->select();
        
        foreach ($users as $key => $value) {
            $fenxiaos[]=$value;
            $this->getDowns($fenxiaos,$value['id']);
        }
    }	
	
	
}