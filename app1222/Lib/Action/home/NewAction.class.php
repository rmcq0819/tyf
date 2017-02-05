<?php
class NewAction extends frontendAction {
	public function new_product(){
		//新品推荐
		$nwh['zhuangui'] = 1;
		$nwh['status'] = 1;
		$nitems = M('item')->where($nwh)->field('id,pic,price,title')->select();
		$this->assign('nitems',$nitems);
		
		//专题推荐
		$swh['zhuanti'] = 1;
		$swh['status'] = 1;
		$sitems = M('item')->where($swh)->field('id,pic,price,title,reason,buy_num')->select();
		$this->assign('sitems',$sitems);
		
		/*****推荐广告***/
    	$ad= M('ad');
    	$ads= $ad->field('url,content,desc')->where('board_id=9 and status=1')->order('ordid asc')->select();//推荐banner
		$this->assign('ads',$ads);
		$this->display();
	}
}