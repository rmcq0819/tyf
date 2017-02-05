<?php
class itemAction extends backendAction {
	
    public function _initialize() {
        parent::_initialize();
		parent::CheckLogin();
        $this->_mod = D('item');
        $this->_cate_mod = D('item_cate');
        $brandlist= $this->_brand=M('brandlist')->where('status=1')->order('ordid asc,id asc')->select();
        $this->assign('brandlist',$brandlist);
    }
	
    public function _before_index() {
		
		$item_base = M('itembase')->order('id asc')->select();
		$this->assign('item_base',$item_base);
		//所有品牌
		$brand = M('brand')->order('oid asc')->select();
		$this->assign('brand',$brand);
        //显示模式
        $sm = $this->_get('sm', 'trim');
        $this->assign('sm', $sm);

        //分类信息
        $res = $this->_cate_mod->field('id,name')->select();
        $cate_list = array();
        foreach ($res as $val) {
            $cate_list[$val['id']] = $val['name'];
        }
        $this->assign('cate_list', $cate_list);

        //默认排序
        $this->sort = 'ordid ASC,';
        $this->order ='add_time DESC';
    }

	public function is_delete(){
		  $id = $this->_get('id');
		  $where['id'] = $id;
		  $data['is_delete'] = 1;
		  $data['status'] = 0;
		  $item_save = M('item')->where($where)->save($data);
		  if($item_save){
			  //$this->success('商品已加入回收站', U('item/index'));
			  echo "商品已加入回收站";
		  }
	}
  
	  public function is_resume(){
		  $id = $this->_get('id');
		  $where['id'] = $id;
		  $data['is_delete'] = 0;
		  $item_save = M('item')->where($where)->save($data);
		  if($item_save){
			  //$this->success('商品已从回收站移出', U('item/index'));
			  echo "商品已从回收站移出";
		  }
	  }
	 /**
     * 一键回收
     */
    public function recycle()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
		$data['is_delete'] = 1;
		$ret=$mod->where(array('id'=>array('in',$ids)))->save($data);
		if($ret){
			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
			$this->success(L('operation_success'));
		}else{
			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			$this->error(L('operation_failure'));
		} 
    }
	 /**
     * 一键上架
     */
	public function onShelves()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = explode(',',$this->_request($pk));
		$data['status'] = 1;
		$ret=$mod->where(array('id'=>array('in',$ids)))->save($data);
		if($ret){
			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
			$this->success(L('operation_success'));
		}else{
			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			$this->error(L('operation_failure'));
		}
    }
	 /**
     * 一键恢复
     */
    public function resume()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
		$data['is_delete'] = 0;
		$ret=$mod->where(array('id'=>array('in',$ids)))->save($data);
		if($ret){
			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
			$this->success(L('operation_success'));
		}else{
			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			$this->error(L('operation_failure'));
		} 
    }
	 /**
     * 一键下架
     */
	public function downShelves()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = explode(',',$this->_request($pk));
		$data['status'] = 0;
		$ret=$mod->where(array('id'=>array('in',$ids)))->save($data);
		if($ret){
			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
			$this->success(L('operation_success'));
		}else{
			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			$this->error(L('operation_failure'));
		}
    }
   protected function _search() {
	  
        $map = array();
        //'status'=>1
        ($time_start = $this->_request('time_start', 'trim')) && $map['add_time'][] = array('egt', strtotime($time_start));
        ($time_end = $this->_request('time_end', 'trim')) && $map['add_time'][] = array('elt', strtotime($time_end)+(24*60*60-1));
        ($price_min = $this->_request('price_min', 'trim')) && $map['price'][] = array('egt', $price_min);
        ($price_max = $this->_request('price_max', 'trim')) && $map['price'][] = array('elt', $price_max);
        ($uname = $this->_request('uname', 'trim')) && $map['uname'] = array('like', '%'.$uname.'%');
        $cate_id = $this->_request('cate_id', 'intval');

        if ($cate_id) {
            $id_arr = $this->_cate_mod->get_child_ids($cate_id, true);

            $map['cate_id'] = array('IN', $id_arr);
            $spid = $this->_cate_mod->where(array('id'=>$cate_id))->getField('spid');

            if( $spid==0 ){
                $spid = $cate_id;
            }else{
                $spid .= $cate_id;
            }

        }
        if( $_GET['status']==null ){
            $status = -1;
        }else{
            $status = intval($_GET['status']);
        }
        $status>=0 && $map['status'] = array('eq',$status);
        
        if( $_GET['itemtype']==null ){
            $itemtype = -1;
        }else{
            $itemtype = intval($_GET['itemtype']);
        }

        if( $_GET['home']==null ){
            $home = -1;
        }else{
            $home = intval($_GET['home']);
        }
		if( $_GET['is_combo']==null ){
            $is_combo = -1;
        }else{
            $is_combo = intval($_GET['is_combo']);
        }
		if( $_GET['activity']==null ){
            $activity = -1;
        }else{
            $activity = intval($_GET['activity']);
        }
		if( $_GET['zhuangui']==null ){
            $zhuangui = -1;
        }else{
            $zhuangui = intval($_GET['zhuangui']);
        }
		if( $_GET['zhuanti']==null ){
            $zhuanti = -1;
        }else{
            $zhuanti = intval($_GET['zhuanti']);
        }
		if( $_GET['is_delete']==null ){
            $is_delete = 0;
        }else{
            $is_delete = intval($_GET['is_delete']);
        }
		
		if( $_GET['itembase']==null ){
            $item_base =-1;
        }else{
            $item_base = intval($_GET['itembase']);
        }
		
		if( $_GET['is_bargain']==null ){
            $is_bargain =-1;
        }else{
            $is_bargain = intval($_GET['is_bargain']);
        }
		
        if ($_GET['goods_stock'])
        {
            $map['goods_stock']=array('lt',$_GET['goods_stock']);
        }
		if( $_GET['brandId']==null ){
            $brandId =-1;
        }else{
            $brandId = intval($_GET['brandId']);
        }
		
        $itemtype>=0 && $map['itemtype'] = array('eq',$itemtype);
        $home>=0 && $map['home'] = array('eq',$home);
        $is_combo>=0 && $map['is_combo'] = array('eq',$is_combo);
        $activity>=0 && $map['activity'] = array('eq',$activity);
        $zhuangui>=0 && $map['zhuangui'] = array('eq',$zhuangui);
        $zhuanti>=0 && $map['zhuanti'] = array('eq',$zhuanti);
		$is_delete>=0 && $map['is_delete'] = array('eq',$is_delete);
		$item_base>=0 && $map['baseid'] = array('eq',$item_base);
		$brandId>=0 && $map['brandId'] = array('eq',$brandId);
		$is_bargain>=0 && $map['is_bargain'] = array('eq',$is_bargain);
        ($keyword = $this->_request('keyword', 'trim')) && $map['title'] = array('like', '%'.$keyword.'%');
		//添加sku编码关键字搜索
        ($sku_nember = $this->_request('sku_nember', 'trim')) && $map['adress'] = array('like', '%'.$sku_nember.'%');
        $this->assign('search', array(
            'time_start' => $time_start,
            'time_end' => $time_end,
            'price_min' => $price_min,
            'price_max' => $price_max,
           // 'rates_min' => $rates_min,
           //  'rates_max' => $rates_max,
            'uname' => $uname,
            'status' =>$status,
        	'is_xiangou'=>$is_xiangou,
            'selected_ids' => $spid,
            'spid' => $spid,
            'cate_id' => $cate_id,
            'keyword' => $keyword,
			'itemtype'=> $itemtype,
			'is_delete'=> $is_delete,
			'home' => $home,
            'is_combo'=> $is_combo,
            'activity'=> $activity,
            'zhuangui'=> $zhuangui,
            'zhuanti'=> $zhuanti,
			'sku_nember'=> $sku_nember,
			'is_bargain'=> $is_bargain,
			'brandId' => $brandId,
        ));
		session('map',$map);
        return $map;
    }
	
		public function doscale($id){
		$items = M('item')->where(array('id'=>$id))->field('cs,info,id')->select();
		foreach($items as $key=>$val){
			preg_match_all("|src=(.*) |U",$val['cs'],$match1);
			preg_match_all("|src=(.*) |U",$val['info'],$match2);
			$sizearr1 = '';
		
			foreach($match1[1] as $key1=>$val1){
				$tmp1 = trim($val1,'"');
				
				if(strpos($tmp1,"http")!==0){
					$tmp1 = "http://yooopay.com".ltrim($tmp1,'.'); 	
				}
				
				$size1 = $this->myGetImageSize($tmp1); 
				
				if($size1){
					$sizearr1[] = round($size1['width']/$size1['height'],1);
				}else{
					$size1 = getimagesize($tmp1);
					
					$sizearr1[] = round($size1[0]/$size1[1],1);
				}
			
				$csscale = implode('|',$sizearr1);
			}
			$sizearr2 = '';
			foreach($match2[1] as $key=>$val2){
				$tmp2 = trim($val2,'"');
				
				if(strpos($tmp2,"http")!==0){
					$tmp2 = "http://yooopay.com".ltrim($tmp2,'.'); 	
				}
				 
				$size2 = $this->myGetImageSize($tmp2); 
				
				if($size2){
					$sizearr2[] = round($size2['width']/$size2['height'],1);
				}else{
					$size2 = getimagesize($tmp2);
					$sizearr2[] = round($size2[0]/$size2[1],1);
					
				}
				
				
				$infoscale = implode('|',$sizearr2);
				
			}
			
			$data['csscale'] = $csscale;
			$data['infoscale'] = $infoscale;
		
		
		
			M('item')->where(array('id'=>$val['id']))->save($data);
		}
	}
	
	
	    function myGetImageSize($url, $type = 'curl', $isGetFilesize = true){   
      
        // 若需要获取图片体积大小则默认使用 fread 方式  
        $type = $isGetFilesize ? 'fread' : $type;  
       
         if ($type == 'fread') {  
            // 或者使用 socket 二进制方式读取, 需要获取图片体积大小最好使用此方法  
            $handle = fopen($url, 'rb');  
       
            if (! $handle) return false;  
       
            // 只取头部固定长度168字节数据  
            $dataBlock = fread($handle, 2000);  
        }  
        else {  
		
            // 据说 CURL 能缓存DNS 效率比 socket 高  
            $ch = curl_init($url);  
            // 超时设置  
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
            // 取前面 168 个字符 通过四张测试图读取宽高结果都没有问题,若获取不到数据可适当加大数值  
            curl_setopt($ch, CURLOPT_RANGE, '0-1999');  
            // 跟踪301跳转  
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
            // 返回结果  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
       
            $dataBlock = curl_exec($ch);  
            curl_close($ch);  
       
            if (! $dataBlock) return false;  
        } 
         $size = getimagesize('data://image/jpg;base64,'. base64_encode($dataBlock));  
        if (empty($size)) {  
            return false;  
        }  
       
        $result['width'] = $size[0];  
        $result['height'] = $size[1];  
       
        // 是否获取图片体积大小  
        if ($isGetFilesize) {  
            // 获取文件数据流信息  
            $meta = stream_get_meta_data($handle);  
            // nginx 的信息保存在 headers 里，apache 则直接在 wrapper_data   
            $dataInfo = isset($meta['wrapper_data']['headers']) ? $meta['wrapper_data']['headers'] : $meta['wrapper_data'];  
       
            foreach ($dataInfo as $va) {  
                if ( preg_match('/length/iU', $va)) {  
                    $ts = explode(':', $va);  
                    $result['size'] = trim(array_pop($ts));  
                    break;  
                }  
            }  
        }  
       
        if ($type == 'fread') fclose($handle);  
       
        return $result;  
    }  
	
	public function add_buynum(){
		$map = session('map');
		$itemMod =M('item');
		$items =$itemMod->where($map)->field('id')->select();
		foreach($items as $key=>$val){
			$itemMod->where(array('id'=>$val['id']))->setInc('buy_num',rand(3,20));
		}
		$this->success('调整成功!');
	}
	
public function add() {
		//获取国家
		$country_name = M('flag')->order('id asc')->select();
		$this->assign('country_name',$country_name);
		
		$item_base = M('itembase')->order('id asc')->select();
		$this->assign('item_base',$item_base);
		
		$brand = M('brand')->order('oid asc')->select();
		$this->assign('brand',$brand);
        if (IS_POST) {
            //获取数据
            if (false === $data = $this->_mod->create()) {
                $this->error($this->_mod->getError());
            }
            if( !$data['cate_id']||!trim($data['cate_id']) ){
                $this->error('请选择商品分类');
            }
			
			if(isset($_POST['activity'])&&isset($_POST['is_combo'])){
				$this->error('该商品或参加单品活动，或参加套餐活动，请注意区分！');
			}

			
			
			$goods_stock = $this->_post('goods_stock','trim');
			$stock = $this->_post('stock','trim');
			$adress = $this->_post('adress','trim');
			$price_jinhuo = $this->_post('price_jinhuo','trim');
			$yhprice = $this->_post('yhprice','trim');
			$aprice = $this->_post('aprice','trim');
			$size = $this->_post('size','trim');
			$cost = $this->_post('cost','trim');

			//库存
			foreach($goods_stock as $key=>$val){
				if($val<=0){
					$this->error('库存不能低于1！');
				}
				if($adress[$key] == ''){
					$this->error('请填写SKU码！');
				}
				if($cost[$key] == ''){
					$this->error('请填写成本价！');
				}
				if($yhprice[$key] == ''){
					$this->error('请填写优惠价！');
				}
				if($price_jinhuo[$key] == ''){
					$this->error('请填写进货价！');
				}
				if(count($goods_stock)>1){
					if($size[$key] == ''){
						$this->error('请填写规格！');
					}
				}
				if($_POST['activity']==1){
					if($aprice[$key] == ''){
						$this->error('请填写活动价！');
					}
				}
			}
			
			
			foreach($goods_stock as $key=>$val){
				if($cost[$key]>$yhprice[$key]){
					$this->error('成本价不能高于销售价！');
				}
				if($_POST['activity']==1){
					if($cost[$key]>$aprice[$key]){
						$this->error('成本价不能高于活动价！');
					}
				}
				$tp_goods_stock .= '|'.$val;
				$tp_stock .= '|'.$stock[$key];
				$tp_size .= '|'.$size[$key];
				$tp_adress .= '|'.$adress[$key];
				$tp_cost .= '|'.$cost[$key];
				$tp_yhprice .= '|'.$yhprice[$key];
				$tp_aprice .= '|'.$aprice[$key];
				$tp_price_jinhuo .= '|'.$price_jinhuo[$key];
			}
			if(substr($tp_aprice,1)){
				$data['aprice'] = substr($tp_aprice,1);
			}
			if(substr($tp_size,1)){
				$data['size'] = substr($tp_size,1);
			}
			$data['goods_stock'] = substr($tp_goods_stock,1);
			$data['stock'] = substr($tp_stock,1);
			$data['adress'] = substr($tp_adress,1);
			$data['cost'] = substr($tp_cost,1);
			$data['price_jinhuo'] = substr($tp_price_jinhuo,1);
			$data['yhprice'] = substr($tp_yhprice,1);	
          //dump($data);exit;

            //必须上传图片
            if (empty($_FILES['img']['name'])) {
                $this->error('请上传商品图片');
            }
			//所属国家
			if($this->_post('country')==0){
				 $this->error('请选择商品所属国家');
			}
			if(!empty($_POST['home'])){
				if (empty($_FILES['cover']['name'])) {
					$this->error('请选择封面图片！');
				}
			}
           if(isset($_POST['search']))
            {
            	$data['search']=1;
            }else {
            	$data['search']=0;
            }
             if(isset($_POST['qiuji']))
            {
            	$data['qiuji']=1;
            }else {
            	$data['qiuji']=0;
            }
			  if(isset($_POST['tejia']))
            {
            	$data['tejia']=1;
            }else {
            	$data['tejia']=0;
            }
             if(isset($_POST['zhuangui']))
            {
				if (empty($_FILES['pic']['name'])) {
					$this->error('请选择商品推荐图片！');
				}
            	$data['zhuangui']=1;
            }else {
            	$data['zhuangui']=0;
            }
			if(isset($_POST['zhuanti']))
            {
				if (empty($_FILES['pic']['name'])) {
					$this->error('请选择商品推荐图片！');
				}
            	$data['zhuanti']=1;
            }else {
            	$data['zhuanti']=0;
            }
            if(isset($_POST['home']))
            {
                $data['home']=1;
            }else {
                $data['home']=0;
            }
			if(isset($_POST['is_combo']))
            {
                $data['is_combo']=1;
            }else {
                $data['is_combo']=0;
            }
			if(isset($_POST['activity']))
            {
                $data['activity']=1;
				if ($_POST['brandId']==0) {
					$this->error('请选择商品所属品牌！');
				}
            }else {
                $data['activity']=0;
            }
			
			if(isset($_POST['is_bargain']))
            {
                $data['is_bargain']=1;
            }else {
                $data['is_bargain']=0;
            }
			
/*=======================by lyye 2014-04-08=======================*/
        	if(isset($_POST['is_xiangou']))
            {
            	$data['is_xiangou']=1;
            }else {
            	$data['is_xiangou']=0;
            }
            $data['xiangou_num']	= trim($_POST['xiangou_num'])?trim($_POST['xiangou_num']):1;
/*=======================by lyye 2014-04-08=======================*/
            if($_POST['free']==1)
            {
            	$data['free']=1;
            }else if($_POST['free']==2)
            {
            $data['free']=2;
            $data['pingyou']=$this->_post('pingyou');
            $data['kuaidi']=$this->_post('kuaidi');
            $data['ems']=$this->_post('ems');

            }
            $data['fencheng'] = $this->_post('fencheng','trim');

			//$data['is_direct']   = $this->_post('itemtype_direct');
			if(isset($_POST['is_direct']))
            {
            	$data['is_direct']=1;
            }else {
            	$data['is_direct']=0;
            }
            $data['itemtype'] = $this->_post('itemtype');
			$data['priceyuan'] = $this->_post('priceyuan');
			//国家id
			$data['countryId'] = $this->_post('country');
			//免税仓
			$data['baseid'] = $this->_post('item_base');
			//最低砍价价格
			$data['bargain_price'] = $this->_post('bargain_price');
			$data['reason'] = $this->_post('reason');

            //上传商品图片
            $date_dir = date('ym/d/'); //上传目录
            $item_imgs = array(); //相册
            $result = $this->_upload($_FILES['img'], 'item/'.$date_dir, array(
                'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
                'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
                'suffix' => '_b,_m,_s',
            ));
            if ($result['error']) {
                $this->error($result['info']);
            } else {
                $data['img'] = $date_dir . $result['info'][0]['savename'];
                //保存一份到相册
                $item_imgs[] = array(
                    'url'     => $data['img'],
                );
            }
			
			
	
			//上传封面图片
			if (!empty($_FILES['cover']['name'])) {
				if(empty($_POST['home'])){
					 $this->error('商品封面图片只在商品显示到首页时需要，请选择！');
				 }
                 $result = $this->_upload($_FILES['cover'], 'item/'.$date_dir, array(
                    'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
                    'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
                    'suffix' => '_b,_m,_s',
                ));
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    $data['cover'] = $date_dir . $result['info'][0]['savename'];
                }
            }
			//上传商品推荐图片
			if (!empty($_FILES['pic']['name'])) {
                 $result = $this->_upload($_FILES['pic'], 'item/'.$date_dir, array(
                    'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
                    'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
                    'suffix' => '_b,_m,_s',
                ));
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    $data['pic'] = $date_dir . $result['info'][0]['savename'];
                }
            }
			
            //上传相册
            $file_imgs = array();
            foreach( $_FILES['imgs']['name'] as $key=>$val ){
                if( $val ){
                    $file_imgs['name'][] = $val;
                    $file_imgs['type'][] = $_FILES['imgs']['type'][$key];
                    $file_imgs['tmp_name'][] = $_FILES['imgs']['tmp_name'][$key];
                    $file_imgs['error'][] = $_FILES['imgs']['error'][$key];
                    $file_imgs['size'][] = $_FILES['imgs']['size'][$key];
                }
            }
            if( $file_imgs ){
                $result = $this->_upload($file_imgs, 'item/'.$date_dir, array(
                    'width'=>C('pin_item_bimg.width').','.C('pin_item_simg.width'),
                    'height'=>C('pin_item_bimg.height').','.C('pin_item_simg.height'),
                    'suffix' => '_b,_s',
                ));
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    foreach( $result['info'] as $key=>$val ){
                        $item_imgs[] = array(
                            'url'    => $date_dir . $val['savename'],
                            'order'  => $key + 1,
                        );
                    }
                }
            }
			
			//上传规格图片
			$img_arr = array();
			foreach($_FILES['size_imgs']['name'] as $key=>$val ){
				$img_arr[$key]['name'] = $val;
				$img_arr[$key]['type'] = $_FILES['size_imgs']['type'][$key];
				$img_arr[$key]['tmp_name'] = $_FILES['size_imgs']['tmp_name'][$key];
				$img_arr[$key]['error'] = $_FILES['size_imgs']['error'][$key];
				$img_arr[$key]['size'] = $_FILES['size_imgs']['size'][$key];
			}
			foreach($img_arr as $key=>$val){
				if(strlen($val['name'])>0){
					$result = $this->_upload($val, 'item_size/'.$date_dir, array(
						'width'=>C('pin_item_bimg.width').','.C('pin_item_simg.width'),
						'height'=>C('pin_item_bimg.height').','.C('pin_item_simg.height'),
						'suffix' => '_b,_m,_s',
					));
					if ($result['error']) {
						$this->error($result['info']);
					} else {
						$data['size_imgs'] .= '|'.$date_dir . $result['info'][0]['savename'];
					}
				}else{
					$data['size_imgs'] .= '|'.'';
				}
			}
			$data['size_imgs'] = substr($data['size_imgs'],1);;

			$data['imgs'] = $item_imgs;
			//dump($data);exit;
            $item_id = $this->_mod->publish($data);
			$this->doscale($item_id);
            !$item_id && $this->error(L('operation_failure'));
            //会员价格
			$user_price=$this->_post('user_price', ',');
			if($user_price){
				foreach( $user_price['cate_id'] as $key=>$val ){
                    if( $val&&$user_price['price'][$key] !='-1' &&$user_price['price'][$key]!='null'){
                        $atr['item_id'] = $item_id;
                        $atr['cate_id'] = $val;
                        $atr['user_price'] = $user_price['price'][$key];
                        M('item_userprice')->add($atr);
                    }
                }
			} 
            //附加属性
            $attr = $this->_post('attr', ',');
            if( $attr ){
                foreach( $attr['name'] as $key=>$val ){
                    if( $val&&$attr['value'][$key] ){
                        $atr['item_id'] = $item_id;
                        $atr['attr_name'] = $val;
                        $atr['attr_value'] = $attr['value'][$key];
                        M('item_attr')->add($atr);
                    }
                }
            }
            $this->add_log('添加商品信息');
            $this->success(L('operation_success'));
        } else {
            //会员组信息
            $cate=M('user_category')->field('id,name')->where(array('status' =>1))->select();
            $this->assign('cate', $cate);
            $this->display();
        }
}
function delimg(){
	$id = $this->_post('id',intval);
	$img = $this->_post('img',trim);
	
	$size_imgs = $this->_mod->where(array('id'=>$id))->getField('size_imgs');
	
	$arr = explode('|',$size_imgs);
	foreach( $arr as $k=>$v) {
		if($img == $v) unset($arr[$k]);
		
	}
	
	$data['size_imgs'] = '';
	foreach($arr as $key=>$val ){
		$data['size_imgs'] = $data['size_imgs'].'|'.$val;
	}
	
	$data['size_imgs'] = trim($data['size_imgs'], '|');
	$this->_mod->where(array('id'=>$id))->save($data);
	echo '删除规格图片成功！'; 
}

 public function edit() {
	//获取国家
	$country_name = M('flag')->order('id asc')->select();
	$country_id=M('item')->where(array('id' =>$this->_get('id')))->find();
	$this->assign('countryId',$country_id['countryId']);
	$this->assign('country_name',$country_name);
	
	$item_base = M('itembase')->order('id asc')->select();
	$this->assign('item_base',$item_base);
	$baseid=M('item')->where(array('id' =>$this->_get('id')))->find();
	$this->assign('baseid',$baseid['baseid']);
	$brand = M('brand')->order('oid asc')->select();
	$this->assign('brand',$brand);
	if (IS_POST) {
		//获取数据
		if (false === $data = $this->_mod->create()) {
			$this->error($this->_mod->getError());
		}
		if( !$data['cate_id']||!trim($data['cate_id']) ){
			$this->error('请选择商品分类');
		}
		
		if(isset($_POST['activity'])&isset($_POST['is_combo'])){
			$this->error('该商品或参加单品活动，或参加套餐活动，请注意区分！');
		}
		
		$goods_stock = $this->_post('goods_stock','trim');
		$stock = $this->_post('stock','trim');
		$adress = $this->_post('adress','trim');
		$price_jinhuo = $this->_post('price_jinhuo','trim');
		$yhprice = $this->_post('yhprice','trim');
		$aprice = $this->_post('aprice','trim');
		$size = $this->_post('size','trim');
		$cost = $this->_post('cost','trim');
		//库存
		foreach($goods_stock as $key=>$val){
			/*
			if($val<=0){
				$this->error('库存不能低于1！');
			}
			*/
			if($adress[$key] == ''){
				$this->error('请填写SKU码！');
			}
			if($cost[$key] == ''){
				$this->error('请填写成本价！');
			}
			if($yhprice[$key] == ''){
				$this->error('请填写优惠价！');
			}
			if($price_jinhuo[$key] == ''){
				$this->error('请填写进货价！');
			}
			if(count($goods_stock)>1){
				if($size[$key] == ''){
					$this->error('请填写规格！');
				}
			}
			if($_POST['activity']==1){
				if($aprice[$key] == ''){
					$this->error('请填写活动价！');
				}
				
			}
		}

		foreach($goods_stock as $key=>$val){
			if($cost[$key]>$yhprice[$key]){
				$this->error('成本价不能高于销售价！');
			}
			if($_POST['activity']==1){
				if($cost[$key]>$aprice[$key]){
					$this->error('成本价不能高于活动价！');
				}
			}
			$tp_goods_stock .= '|'.$val;
			$tp_stock .= '|'.$stock[$key];
			$tp_size .= '|'.$size[$key];
			$tp_adress .= '|'.$adress[$key];
			$tp_cost .= '|'.$cost[$key];
			$tp_yhprice .= '|'.$yhprice[$key];
			$tp_aprice .= '|'.$aprice[$key];
			$tp_price_jinhuo .= '|'.$price_jinhuo[$key];
		}
		if(substr($tp_size,1)){
			$data['size'] = substr($tp_size,1);
		}else{
			$data['size'] = '';
		}
		if(substr($tp_aprice,1)){
			$data['aprice'] = substr($tp_aprice,1);
		}else{
			$data['aprice'] = '';
		}
		$data['goods_stock'] = substr($tp_goods_stock,1);
		$data['stock'] = substr($tp_stock,1);
		$data['adress'] = substr($tp_adress,1);
		$data['cost'] = substr($tp_cost,1);
		$data['price_jinhuo'] = substr($tp_price_jinhuo,1);
		$data['yhprice'] = substr($tp_yhprice,1);	
			
		
		
	
		if($_POST['free']==1)//卖家承担运费
		{
			$data['free']=1;
			$data['pingyou']=0;
			$data['kuaidi']=0;
			$data['ems']=0;
		}else if($_POST['free']==2)//买家承担运费
		{
			$data['free']=2;
			$data['pingyou']=$this->_post('pingyou');
			$data['kuaidi']=$this->_post('kuaidi');
			$data['ems']=$this->_post('ems');
		} 
		
		$data['priceyuan'] = $this->_post('priceyuan');
		$data['fencheng'] = $this->_post('fencheng','trim');
        
        $direct = $this->_post('itemtype_direct');
        $data['is_direct'] = isset($direct) ? $direct : 0;

		$data['countryId'] = $this->_post('country');
		$data['baseid'] = $this->_post('item_base');
		$data['bargain_price'] = $this->_post('bargain_price');
		$data['reason'] = $this->_post('reason');
		$item_id = $this->_post('id');
		
		$date_dir = date('ym/d/'); //上传目录
		$item_imgs = array(); //相册
		//修改图片
		if (!empty($_FILES['img']['name'])) {
			$result = $this->_upload($_FILES['img'], 'item/'.$date_dir, array(
				'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
				'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
				'suffix' => '_b,_m,_s',
			));
			if ($result['error']) {
				$this->error($result['info']);
			} else {
				$data['img'] = $date_dir . $result['info'][0]['savename'];
				//保存一份到相册
				$item_imgs[] = array(
					'item_id' => $item_id,
					'url'     => $data['img'],
				);
			}
		}
		
	
		
		//修改封面图片
		if (!empty($_FILES['cover']['name'])) {
			$result = $this->_upload($_FILES['cover'], 'item/'.$date_dir, array(
				'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
				'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
				'suffix' => '_b,_m,_s',
			));
			if ($result['error']) {
				$this->error($result['info']);
			} else {
				$data['cover'] = $date_dir . $result['info'][0]['savename'];
			   
			}
		}
		//修改商品推荐图片
		if (!empty($_FILES['pic']['name'])) {
			$result = $this->_upload($_FILES['pic'], 'item/'.$date_dir, array(
				'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
				'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
				'suffix' => '_b,_m,_s',
			));
			if ($result['error']) {
				$this->error($result['info']);
			} else {
				$data['pic'] = $date_dir . $result['info'][0]['savename'];
			}
		}
		
		if(isset($_POST['search']))
		{
			$data['search']=1;
		}else {
			$data['search']=0;
		}
		 if(isset($_POST['qiuji']))
		{
			$data['qiuji']=1;
		}else {
			$data['qiuji']=0;
		}
		  if(isset($_POST['tejia']))
		{
			$data['tejia']=1;
		}else {
			$data['tejia']=0;
		}
		 if(isset($_POST['zhuangui']))
		{
			$data['zhuangui']=1;
		}else {
			$data['zhuangui']=0;
		}
		if(isset($_POST['zhuanti']))
		{
			$data['zhuanti']=1;
		}else {
			$data['zhuanti']=0;
		}
		
		if(isset($_POST['is_stock']))
		{
			$data['is_stock']=1;
		}else {
			$data['is_stock']=0;
		}
		
		
		if(isset($_POST['home']))
		{
			$data['home']=1;
		}else {
			$data['home']=0;
		}
		if(isset($_POST['is_combo']))
		{
			$data['is_combo']=1;
		}else {
			$data['is_combo']=0;
		}
		if(isset($_POST['activity']))
		{
			$data['activity']=1;
			if ($_POST['brandId']==0) {
				$this->error('请选择商品所属品牌！');
			}
		}else {
			$data['activity']=0;
		}
		
		if(isset($_POST['is_bargain']))
		{
			$data['is_bargain']=1;
		}else {
			$data['is_bargain']=0;
		}
		
		if(isset($_POST['is_fictitious']))
		{
			$data['is_fictitious']=1;
		}else {
			$data['is_fictitious']=0;
		}
		
		if(isset($_POST['is_fping']))
		{
			$data['is_fping']=1;
		}else {
			$data['is_fping']=0;
		}
		
/*=======================by lyye 2014-04-08=======================*/
		if(isset($_POST['is_xiangou']))
		{
			$data['is_xiangou']=1;
		}else {
			$data['is_xiangou']=0;
		}
		$data['xiangou_num']	= trim($_POST['xiangou_num'])?trim($_POST['xiangou_num']):1;
/*=======================by lyye 2014-04-08=======================*/
		

		//更新单张规格图片
		$sizeimgs = $this->_mod->where(array('id'=>$item_id))->getField('size_imgs');
		$sizeArr = explode('|',$sizeimgs);
		
		$img_arr = array();
		foreach($_FILES['size_imgs']['name'] as $key=>$val ){
			$img_arr[$key]['name'] = $val;
			$img_arr[$key]['type'] = $_FILES['size_imgs']['type'][$key];
			$img_arr[$key]['tmp_name'] = $_FILES['size_imgs']['tmp_name'][$key];
			$img_arr[$key]['error'] = $_FILES['size_imgs']['error'][$key];
			$img_arr[$key]['size'] = $_FILES['size_imgs']['size'][$key];
		}
		
		foreach($img_arr as $key=>$val){
			if(strlen($val['name'])>0){
				$result = $this->_upload($val, 'item_size/'.$date_dir, array(
					'width'=>C('pin_item_bimg.width').','.C('pin_item_simg.width'),
					'height'=>C('pin_item_bimg.height').','.C('pin_item_simg.height'),
					'suffix' => '_b,_m,_s',
				));
				if ($result['error']) {
					$this->error($result['info']);
				} else {
					$sizeArr[$key] = $date_dir . $result['info'][0]['savename'];
				}
			}
		}
		foreach($img_arr as $key=>$val){
			$data['size_imgs'] .= '|'.$sizeArr[$key];
		}
		$data['size_imgs'] = substr($data['size_imgs'],1);
		//上传相册
		$file_imgs = array();
		foreach( $_FILES['imgs']['name'] as $key=>$val ){
			if( $val ){
				$file_imgs['name'][] = $val;
				$file_imgs['type'][] = $_FILES['imgs']['type'][$key];
				$file_imgs['tmp_name'][] = $_FILES['imgs']['tmp_name'][$key];
				$file_imgs['error'][] = $_FILES['imgs']['error'][$key];
				$file_imgs['size'][] = $_FILES['imgs']['size'][$key];
			}
		}
		if( $file_imgs ){
			$result = $this->_upload($file_imgs, 'item/'.$date_dir, array(
				'width'=>C('pin_item_bimg.width').','.C('pin_item_simg.width'),
				'height'=>C('pin_item_bimg.height').','.C('pin_item_simg.height'),
				'suffix' => '_b,_s',
			));
			if ($result['error']) {
				$this->error($result['info']);
			} else {
				foreach( $result['info'] as $key=>$val ){
					$item_imgs[] = array(
						'item_id' => $item_id,
						'url'    => $date_dir . $val['savename'],
						'order'   => $key + 1,
					);
				}
			}
		}
		
		
		//标签
		$tags = $this->_post('tags', 'trim');
		if (!isset($tags) || empty($tags)) {
			$tag_list = D('tag')->get_tags_by_title($data['intro']);
		} else {
			$tag_list = explode(' ', $tags);
		}
		if ($tag_list) {
			$item_tag_arr = $tag_cache = array();
			$tag_mod = M('tag');
			foreach ($tag_list as $_tag_name) {
				$tag_id = $tag_mod->where(array('name'=>$_tag_name))->getField('id');
				!$tag_id && $tag_id = $tag_mod->add(array('name' => $_tag_name)); //标签入库
				$item_tag_arr[] = array('item_id'=>$item_id, 'tag_id'=>$tag_id);
				$tag_cache[$tag_id] = $_tag_name;
			}
			if ($item_tag_arr) {
				$item_tag = M('item_tag');
				//清除关系
				$item_tag->where(array('item_id'=>$item_id))->delete();
				//商品标签关联
				$item_tag->addAll($item_tag_arr);
				$data['tag_cache'] = serialize($tag_cache);
			}
		}
		
		$data['edit_time'] = time();

		//更新商品
		$this->_mod->where(array('id'=>$item_id))->save($data);
		$this->doscale($item_id);
		//更新图片和相册
		$item_imgs && M('item_img')->addAll($item_imgs);
		//会员价格
		$user_price=$this->_post('user_price', ',');
		
		if($user_price){
			foreach( $user_price['cate_id'] as $key=>$val ){
				if( $val&&$user_price['price'][$key] !='-1' ){
					$atr['user_price'] = $user_price['price'][$key];
					$result=count(M('item_userprice')->where(array('item_id'=>$item_id,'cate_id'=>$val))->find());
					if($result == 0){
					$atr['item_id'] = $item_id;
					$atr['cate_id'] = $val;
					
					 M('item_userprice')->add($atr);
					}else{
					
					 M('item_userprice')->where(array('item_id'=>$item_id,'cate_id'=>$val))->save($atr);
					}
				}
			}
		}
		
		//附加属性
		$attr = $this->_post('attr', ',');
		if( $attr ){
			foreach( $attr['name'] as $key=>$val ){
				if( $val&&$attr['value'][$key] ){
					$atr['item_id'] = $item_id;
					$atr['attr_name'] = $val;
					$atr['attr_value'] = $attr['value'][$key];
					M('item_attr')->add($atr);
				}
			}
		}
		$this->add_log('修改商品信息');
		$this->success(L('operation_success'));
	} else {
		$id = $this->_get('id','intval');
		$item = $this->_mod->where(array('id'=>$id))->find();
		//分类
		$spid = $this->_cate_mod->where(array('id'=>$item['cate_id']))->getField('spid');
		if( $spid==0 ){
			$spid = $item['cate_id'];
		}else{
			$spid .= $item['cate_id'];
		}
		

		
		$this->assign('selected_ids',$spid); //分类选中
		$tag_cache = unserialize($item['tag_cache']);
		$item['tags'] = implode(' ', $tag_cache);
		
		$item['cost'] = explode('|',$item['cost']);
		$item['adress'] = explode('|',$item['adress']);
		$item['yhprice'] = explode('|',$item['yhprice']);
		$item['aprice'] = explode('|',$item['aprice']);
		$item['price_jinhuo'] = explode('|',$item['price_jinhuo']);
		$item['goods_stock'] = explode('|',$item['goods_stock']);
		$item['stock'] = explode('|',$item['stock']);
		$item['size'] = explode('|',$item['size']);
		$item['size_imgs'] = explode('|',$item['size_imgs']);
		
		/* dump(count($item['size']));
		dump($item);exit;  */
			
		
		
		$this->assign('scount',count($item['size']));
		
		$this->assign('info', $item);
	   
		//相册
		$img_list = M('item_img')->where(array('item_id'=>$id))->select();
		$this->assign('img_list', $img_list);
		//属性
		$attr_list = M('item_attr')->where(array('item_id'=>$id))->select();
		$this->assign('attr_list', $attr_list);
		//会员组
		$cate=M('user_category')->field('id,name')->where(array('status' =>1))->select();
		foreach ($cate as $key => $value) {
		//会员价格
		$userprice=M('item_userprice')->where(array('item_id'=>$id,'cate_id'=>$value['id']))->find();            
				if ($userprice) {//判断赋值
					$price=$userprice['user_price'];
				}else{
					$price='-1';
				}
				$cate[$key]['user_price']=$price;
		}
		$this->assign('cate', $cate);
		$this->display();
	}
}

    function delete_album() {
        $album_mod = M('item_img');
        $album_id = $this->_get('album_id','intval');
        $album_img = $album_mod->where('id='.$album_id)->getField('url');
        if( $album_img ){
            $ext = array_pop(explode('.', $album_img));
            $album_min_img = C('pin_attach_path') . 'item/' . str_replace('.' . $ext, '_s.' . $ext, $album_img);
            is_file($album_min_img) && @unlink($album_min_img);
            $album_img = C('pin_attach_path') . 'item/' . $album_img;
            is_file($album_img) && @unlink($album_img);
            $album_mod->delete($album_id);
        }
        echo '1';
        exit;
    }
     public function _before_delete() {
        $_SESSION['content']='删除商品信息';
    }
    function delete_attr() {
        $attr_mod = M('item_attr');
        $attr_id = $this->_get('attr_id','intval');
        $attr_mod->delete($attr_id);
        echo '1';
        exit;
    }

    /**
     * 商品审核
     */
    public function check() {
        //分类信息
        $res = $this->_cate_mod->field('id,name')->select();
        $cate_list = array();
        foreach ($res as $val) {
            $cate_list[$val['id']] = $val['name'];
        }
        $this->assign('cate_list', $cate_list);
        //商品信息
        //$map = $this->_search();
        $map=array();
        $map['status']=0;
        ($time_start = $this->_request('time_start', 'trim')) && $map['add_time'][] = array('egt', strtotime($time_start));
        ($time_end = $this->_request('time_end', 'trim')) && $map['add_time'][] = array('elt', strtotime($time_end)+(24*60*60-1));
        $cate_id = $this->_request('cate_id', 'intval');
        if ($cate_id) {
            $id_arr = $this->_cate_mod->get_child_ids($cate_id, true);
            $map['cate_id'] = array('IN', $id_arr);
            $spid = $this->_cate_mod->where(array('id'=>$cate_id))->getField('spid');
            if( $spid==0 ){
                $spid = $cate_id;
            }else{
                $spid .= $cate_id;
            }
        }
        ($keyword = $this->_request('keyword', 'trim')) && $map['title'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'time_start' => $time_start,
            'time_end' => $time_end,
            'selected_ids' => $spid,
            'cate_id' => $cate_id,
			
            'keyword' => $keyword,
        ));
        //分页
        $count = $this->_mod->where($map)->count('id');
        $pager = new Page($count, 20);
        $select = $this->_mod->field('id,title,img,tag_cache,cate_id,uid,uname')->where($map)->order('id DESC');
        $select->limit($pager->firstRow.','.$pager->listRows);
        $page = $pager->show();
        $this->assign("page", $page);
        $list = $select->select();
        foreach ($list as $key=>$val) {
            $tag_list = unserialize($val['tag_cache']);
            $val['tags'] = implode(' ', $tag_list);
            $list[$key] = $val;
        }
        $this->assign('list', $list);
        $this->assign('list_table', true);
        $this->display();
    }

    /**
     * 审核操作
     */
    public function do_check() {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        $datas['id']=array('in',$ids);
        $datas['status']=1;
        if ($datas) {
            if (false !== $mod->save($datas)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }

    }

    /**
     * ajax获取标签
     */
    public function ajax_gettags() {
        $title = $this->_get('title', 'trim');
        $tag_list = D('tag')->get_tags_by_title($title);
        $tags = implode(' ', $tag_list);
        $this->ajaxReturn(1, L('operation_success'), $tags);
    }

    public function delete_search() {
        $items_mod = D('item');
        $items_cate_mod = D('item_cate');
        $items_likes_mod = D('item_like');
        $items_pics_mod = D('item_img');
        $items_tags_mod = D('item_tag');
        $items_comments_mod = D('item_comment');

        if (isset($_REQUEST['dosubmit'])) {
            if ($_REQUEST['isok'] == "1") {
                //搜索
                $where = '1=1';
                $keyword = trim($_POST['keyword']);
                $cate_id = trim($_POST['cate_id']);
                $cate_id = trim($_POST['cate_id']);
                $time_start = trim($_POST['time_start']);
                $time_end = trim($_POST['time_end']);
                $status = trim($_POST['status']);
                $min_price = trim($_POST['min_price']);
                $max_price = trim($_POST['max_price']);
                $min_rates = trim($_POST['min_rates']);
                $max_rates = trim($_POST['max_rates']);

                if ($keyword != '') {
                    $where .= " AND title LIKE '%" . $keyword . "%'";
                }
                if ($cate_id != ''&&$cate_id!=0) {
                    $where .= " AND cate_id=" . $cate_id;
                }
                if ($time_start != '') {
                    $time_start_int = strtotime($time_start);
                    $where .= " AND add_time>='" . $time_start_int . "'";
                }
                if ($time_end != '') {
                    $time_end_int = strtotime($time_end);
                    $where .= " AND add_time<='" . $time_end_int . "'";
                }
                if ($status != '') {
                    $where .= " AND status=" . $status;
                }
                if ($min_price != '') {
                    $where .= " AND price>=" . $min_price;
                }
                if ($max_price != '') {
                    $where .= " AND price<=" . $max_price;
                }
                if ($min_rates != '') {
                    $where .= " AND rates>=" . $min_rates;
                }
                if ($max_rates != '') {
                    $where .= " AND rates<=" . $max_rates;
                }
                $ids_list = $items_mod->where($where)->select();
                $ids = "";
                foreach ($ids_list as $val) {
                    $ids .= $val['id'] . ",";
                }
                if ($ids != "") {
                    $ids = substr($ids, 0, -1);
                    $items_likes_mod->where("item_id in(" . $ids . ")")->delete();
                    $items_pics_mod->where("item_id in(" . $ids . ")")->delete();
                    $items_tags_mod->where("item_id in(" . $ids . ")")->delete();
                    $items_comments_mod->where("item_id in(" . $ids . ")")->delete();
                    M('album_item')->where("item_id in(" . $ids . ")")->delete();
                    M('item_attr')->where("item_id in(" . $ids . ")")->delete();

                }
                $items_mod->where($where)->delete();

                //更新商品分类的数量
                $items_nums = $items_mod->field('cate_id,count(id) as items')->group('cate_id')->select();
                foreach ($items_nums as $val) {
                    $items_cate_mod->save(array('id' => $val['cate_id'], 'items' => $val['items']));
                    M('album')->save(array('cate_id' => $val['cate_id'], 'items' => $val['items']));
                }
                $this->add_log('删除商品');
                $this->success('删除成功', U('item/delete_search'));
            } else {
                $this->success('确认是否要删除？', U('item/delete_search'));
            }
        } else {
            $res = $this->_cate_mod->field('id,name')->select();

            $cate_list = array();
            foreach ($res as $val) {
                $cate_list[$val['id']] = $val['name'];
            }
            //$this->assign('cate_list', $cate_list);
            $this->display();
        }
    }
	

	/*
		修改日期 :2016/05/09
		修改人：廖晓麟
		excelout()描述:导出产品信息到exce表
	*/
	
	
   public function excelout(){
		$map = session('map');
		if(!empty($map['status'])){
			$map['a.status'] = $map['status'];
			unset($map['status']);
			$data=$this->_mod
			  ->join('a left join weixin_item_cate b ON a.cate_id=b.id left join weixin_itembase c ON a.baseid=c.id')
			  ->field('a.id,a.title,a.intro,a.cost,a.price,a.yhprice,a.add_time,a.status,a.goods_stock,a.buy_num,a.adress,a.itemtype,a.price_jinhuo,b.name,c.basename')
			  ->where($map)
			  ->select();
		}else{
			  $data=$this->_mod
			  ->join('a left join weixin_item_cate b ON a.cate_id=b.id left join weixin_itembase c ON a.baseid=c.id')
			  ->field('a.id,a.title,a.intro,a.cost,a.price,a.yhprice,a.add_time,a.status,a.goods_stock,a.buy_num,a.adress,a.itemtype,a.price_jinhuo,b.name,c.basename')
			  ->where($map)
			  ->select();
		}
		$filename="商品信息";
        $headArr=array("ID","商品名称","商品介绍","成本价","销售价","优惠价","添加时间","是否上架(0为下架,1为上架)","库存数量","销售数量","SKU编码","商品类型","进货价","商品大类","免税仓");
		//dump($data);exit;
        //如果第七个标题为时间戳字段,则在参数最后一位设置为7,没有则为0
        $this->getExcel($filename,$headArr,$data,7);	
    }
	
	public function readExcel(){
		//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能import导入
		import("Think.ORG.PHPExcel");
		import("Think.ORG.PHPExcel.Writer.Excel5");
		import("Think.ORG.PHPExcel.IOFactory.php");
		
		//创建PHPExcel对象，注意，不能少了
		$objPHPExcel = new PHPExcel();
		$objProps = $objPHPExcel->getProperties();
		
		$objReader = PHPExcel_IOFactory::createReader('Excel5'); //use Excel5 
		
	
		$excelpath = $_FILES['exin']['tmp_name'];
		if(!$excelpath){
			$this->error('请选择正确的文件！');
		}
		$objPHPExcel = $objReader->load($excelpath); 
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow();           //取得总行数 
		$highestColumn = $sheet->getHighestColumn(); //取得总列数
		for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据
		{ 
			$str="";
			for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
			{ 
				$str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
			} 
			$str=mb_convert_encoding($str,'utf-8','auto');//根据自己编码修改
			$strs = explode("|*|",$str);
			
			if(count($strs)!=16){
				$this->error('文件格式有误！');
			}
			/*
			array(16){
			  [0] => string(4) "5224"
			  [1] => string(62) "英国Mars玛氏 什锦婚庆节日礼盒（8种口味） 750g"
			  [2] => string(62) "英国Mars玛氏 什锦婚庆节日礼盒（8种口味） 750g"
			  [3] => string(2) "88"
			  [4] => string(3) "108"
			  [5] => string(10) "108"
			  [6] => string(10) "1481608226"
			  [7] => string(1) "1"
			  [8] => string(3) "100"
			  [9] => string(3) "155"
			  [10] => string(8) "DESZC009"
			  [11] => string(1) "1"
			  [12] => string(2) "85"
			  [13] => string(15) "糖果巧克力"
			  [14] => string(14) "D仓-胡东林"
			  [15] => string(0) ""
			}
			"ID","商品名称","商品介绍","成本价","销售价","优惠价","添加时间","是否上架(0为下架,1为上架)","库存数量","销售数量","SKU编码","商品类型","进货价","商品大类","免税仓"
			a.id,a.title,a.intro,a.cost,a.price,a.yhprice,a.add_time,a.status,a.goods_stock,a.buy_num,a.adress,a.itemtype,a.price_jinhuo,b.name,c.basename
			
			*/

			$where['id'] = $strs[0];            
			$data['title'] =  $strs[1];         
			$data['intro'] =  $strs[2];
			$data['cost'] =  $strs[3];
			$data['price'] =  $strs[4];
			$data['hyprice'] =  $strs[5];
			$data['status'] =  $strs[7];
			$data['goods_stock'] =  $strs[8];
			$data['buy_num'] =  $strs[9];
			$data['adress'] =  $strs[10];
			$data['itemtype'] =  $strs[11];
			$data['price_jinhuo'] =  $strs[12];
			$this->_mod->where($where)->save($data);
		}
		$this->success('导入完成！');
    }

	
	
	
	
	
	
	
	
	//更改销售量
    public function buy_num() {
    	
    	$itemid = $_GET['itemid'];
    	$data['buy_num'] = $_GET['buy_num'];
    	
    	//进行更新
    	if(M('item')->where('id='.$itemid)->save($data)!==false){
    		
    		echo 1;
    		
    	}else {
    		
    		echo 0;
    		
    	}
    	
    }
	
	
}