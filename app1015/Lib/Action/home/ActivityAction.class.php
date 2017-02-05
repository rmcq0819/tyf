<?php
class ActivityAction extends frontendAction {
	
	public function activity(){
		$this->error('活动已结束，感谢您对团洋范的关注！');
		exit;
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
}