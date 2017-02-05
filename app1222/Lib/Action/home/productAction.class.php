<?php

/**
 * 逛宝贝页面
 */
class productAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();
        $this->assign('nav_curr', 'product');
    }

    /**
     * 逛宝贝首页
     */
    public function index() {

		
		$article_cates = M('article_cate')->where(array('pid'=>14))->order('ordid asc')->select();
		foreach($article_cates as $key=>$val){
			$article_cates[$key]['sub_cates']=M('article_cate')->where(array('pid'=>$val['id']))->order('ordid asc')->select();
			//$article_cates['sub_cates']=$sub_cates;
		}
		$this->assign('article_cates', $article_cates);
        $this->display();
    }

    public function cate() {
       $cid = $this->_get('cid', 'intval');
       !$cid && $this->_404();
	   
	   	/*****广告***/
    	$ad= M('ad');
		$where['extval']=array($cid);
		$where['board_id']=4;
		$where['status'] = 1;
    	$ads= $ad->field('url,content,desc')->where($where)->order('ordid asc')->select();
		//echo $ad->getLastSql();
		//print_r($ads);
        $this->assign('ad',$ads);
	   
	   //分类数据
       $cate_info = M('article_cate')->where(array("id"=>$cid))->find();
              
		$item=M('article');
		$where['cate_id']=array('eq',$cid);
		$where['status']=array('eq',1);
		$items=  $item->field('id,title,img,intro')->order('ordid asc,id desc')->where($where)->select();
		
		$count=count($items);//总数
		$page_size =8; //每页显示个数
		$pager = $this->_pager($count, $page_size);
		
		$items =  $item->field('id,title,img,intro')->where($where)->order('ordid asc,id desc')->limit($pager->firstRow . ',' . $page_size)->select();
		
		$this->assign('item_list',$item_list); 
		 //当前页码
        $p = $this->_get('p', 'intval', 1);
        $this->assign('p', $p);
        //当前页面总数大于单次加载数才会执行动态加载
        if (($count - ($p-1) * $page_size) > $spage_size) {
            $this->assign('show_load', 1);
        }
        //总数大于单页数才显示分页
        $count > $page_size && $this->assign('page_bar', $pager->fshow());
        //最后一页分页处理
        if ((count($item_list) + $page_size * ($p-1)) == $count) {
            $this->assign('show_page', 1);
        }

        $this->assign('cate_name',$cate_info['name']);
		$this->assign('item_list',$items);
       //SEO
        $this->_config_seo(C('pin_seo_config.cate'), array(
            'cate_name' => $cate_info['name'],
            'seo_title' => $cate_info['seo_title'],
            'seo_keywords' => $cate_info['seo_keys'],
            'seo_description' => $cate_info['seo_desc'],
        ));
        $this->display();
    }

	public function show() {
	
       $id = $this->_get('id', 'intval');
       !$id && $this->_404();
	   $info = M('article')->find($id);
		$this->assign('info', $info);
		$this->assign('id', $id);
		$this->_config_seo();
		
		//栏目ID
		$cid = $info['cate_id'];
		$here = M('article_cate')->find($cid);
		$this->assign('here', $here);
		
		$this->display();
		
		/*****位置***/
    	//$article_cate= M('article_cate');
		//$where['id']=$cid;
    	//$here= $article_cate->field('name')->where($where)->select();
		//echo $article_cate->getLastSql();
		//print_r($name);
       // $this->assign('article_cate',$here);
		

	}

}