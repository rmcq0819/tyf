<?php
class informationAction extends frontendAction {

    public function index() {
		
        $id = $this->_get('id', 'intval');
		//echo $id;
        !$id && $this->redirect('index/index');
        $info = M('article_cate')->find($id);
		//print_r($info);
        $this->assign('info', $info);
        $this->assign('id', $id);
		
		/*单页列表*/
		$cid = $info['pid'];
		$cate_id = $info['id'];
		
		
		$cid_li= M('article_cate');
		$where['pid']=$cid;
    	$serve_li= $cid_li->field('id,name')->where($where)->order('ordid asc')->select();
		//echo $cid_li->getLastSql();
		//print_r($cid_li);
		
		$this->assign('cid_li',$serve_li);
		
		  //分类数据
       $cate_info = M('article_cate')->where(array("id"=>$cid))->find();
              
		$item=M('article');
		$where['cate_id']=$cate_id;
		$where['status']=array('eq',1);
		$items=  $item->field('id,title,add_time,intro')->order('ordid asc,id desc')->where($where)->select();
		
		//echo $item->getLastSql();
		
		$count=count($items);//总数
		$page_size =12; //每页显示个数
		$pager = $this->_pager($count, $page_size);
		
		$items =  $item->field('id,title,add_time,intro')->where($where)->order('ordid asc,id desc')->limit($pager->firstRow . ',' . $page_size)->select();
		
		
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
		
        $this->_config_seo();
        $this->display();
		
    }
	
		public function show() {
	
       $id = $this->_get('id', 'intval');
	   //echo $id;
       !$id && $this->_404();
	   $info = M('article')->find($id);
		$this->assign('info', $info);
		$this->assign('id', $id);
		$this->_config_seo();
		//栏目ID
		$cid = $info['cate_id'];
		$here = M('article_cate')->find($cid);
		$this->assign('here', $here);
	   
	   /*相关文章,上下篇*/
		$where['cate_id']=$info['cate_id'];
		$where["id"] = array("gt",$id);
		//print_r($where);
		$infonext = M('article')->where($where)->limit(1)->select();
		//print_r($infonext);
		$this->assign('infonext', $infonext);
		
		$where['cate_id']=$info['cate_id'];
		$where["id"] = array("lt",$id);
		//print_r($where);
		$infoprev = M('article')->where($where)->order("id desc")->limit(1)->select();
		//print_r($infoprev);
		$this->assign('infoprev', $infoprev);
		
		$this->display();

	}

    public function flink() {
        $this->_config_seo();
    	$this->display();
    }
}