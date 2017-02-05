<?php
class item_orderAction extends backendAction {
    public function _initialize() {
        parent::_initialize();
		parent::CheckLogin();
        $this->_mod = D('item_order');
        $order_status=array(1=>'待付款',2=>'待发货',3=>'待收货',4=>'完成',6=>'申请退款中',7=>'申请退款失败',8=>'申请退款成功',9=>'待收货 (清关中)',10=>'异常订单');
        $this->assign('order_status',$order_status);
    }
	
	//修改订单状态
	public function status_edit(){
        $stu = $_POST['price'];
        $orderid = $_POST['orderid'];
        if($stu!=0){
            $data = M('item_order')->where(array('orderId'=>$orderid))->setField('status',$stu);
        }
        if ($data){
            echo '更新成功';
        }else{
            echo '更新失败';
        }
    }
	
	//2016-04-21 by shuguang 修改列表显示 start

    /**
     * 列表处理
     *
     * @param obj $model  实例化后的模型
     * @param array $map  条件数据
     * @param string $sort_by  排序字段
     * @param string $order_by  排序方法
     * @param string $field_list 显示字段
     * @param intval $pagesize 每页数据行数
     */
    public function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=15)
    {	
        //排序
        $mod_pk = 'weixin_item_order.id';
      
        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else if (!empty($sort_by)) {
            $sort = $sort_by;
        } else if ($this->sort) {
            $sort = $this->sort;
        } else {
            $sort = $mod_pk;
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else if (!empty($order_by)) {
            $order = $order_by;
        } else if ($this->order) {
            $order = $this->order;
        } else {
            $order = 'DESC';
        }
        //如果需要分页
        if ($pagesize) {
            $count = $model->where($map)->join('left join weixin_user on weixin_item_order.shopid=weixin_user.id')->count($mod_pk);
            $pager = new Page($count, $pagesize);
        }
        $select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
      
        $this->list_relation && $select->relation(true);
        if ($pagesize) {
            $select->limit($pager->firstRow.','.$pager->listRows);
            $page = $pager->show();
            $this->assign("page", $page);
        }
		
        $list = $select->join('left join weixin_user on weixin_item_order.shopid=weixin_user.id')->field('weixin_item_order.*,weixin_user.merchant')->select();
        //print_r($list);
        //查询显示订单金额 和分享店铺 
        foreach ($list as $key => $value) {
            $shopid = M('OrderDetail')->where("orderId ='".$value['orderId']."' ")->getField("shopid");//商家id
            $sum_price = M('OrderDetail')->where("orderId ='".$value['orderId']."' ")->getField("sigsumprice");//订单总价格 
            $list[$key]['sigsumprice'] = $sum_price;
            $merchant = M('user')->where('id='.$shopid)->getField("merchant");//商家店铺名称
            $list[$key]['merchant'] = $merchant;
        }

        $this->assign('list', $list);
        $this->assign('list_table', true);
    }
//2016-04-21 by shuguang 修改列表显示 end
	
	public function is_pay(){
		 $wxsend = new Wxsend();
		 $id = $this->_get('id','trim');
		 $itemm = M('item_order');
		 $items = $itemm->where(array('id'=>$id))->find();
		 $userf = M('user')->where(array('id'=>$items['userId']))->find();
		 $data['is_pay'] = 1;
		 $save = $itemm->where(array('id'=>$id))->save($data);
		 $wxsend->no_pay($userf['wechatid'],date('Y-m-d H:i:s',$items['add_time']),$items['orderId'],$userf['username']);
		 $this->redirect('item_order/index',array('status'=>1));
	 }
	 
	public function add_freeinfo(){
		if(IS_POST){
			$free_time = $this->_post('free_time','trim');
			$free_context = $this->_post('free_context','trim');
			$detail_id = $this->_post('detail_id','trim');
			if(empty($free_time)){
				$this->error('请填写物流时间');
			}elseif(empty($free_context)){
				$this->error('请输入物流信息');
			}else{
				$data['free_time'] = $free_time;
				$data['free_context'] = $free_context;
				$data['add_time'] = time();
				$data['detail_id'] = $detail_id;
				if(M('freeinfo')->add($data)){
					$this->success('物流信息添加成功',U('item_order/add_freeinfo',array('order_id'=>$detail_id)));
				}else{
					$this->error('添加失败，请重新尝试',U('item_order/add_freeinfo',array('order_id'=>$detail_id)));
				}
			}
			
		}else{
			$freelist = M('freeinfo')->where(array('detail_id'=>$_GET['order_id']))->order('add_time desc')->select();
			$this->assign('freelist',$freelist);
			$this->display();
		}
	}

    public function _before_index() {
    }
    
    public function status()
    {
      $orderId= $this->_get('orderId', 'trim');
      !$orderId && $this->_404();
      $status= $this->_get('status', 'intval');
      !$status && $this->_404();
      if($status==4)
      {
      	$data['status']=$status;
		  if($this->_mod->where(array('orderId'=>$orderId))->save($data) !== false)
			{	 
				 $item_order=M('item_order');
				 $item=M('item');
				 $item_orders= $item_order->where(array('orderId'=>$orderId))->find();
				 if(!is_array($item_orders))
				 {
					$this->error('该订单不存在!');
					exit;
				 }
				 $data['status']=4;//收到货
				 if($item_order->where("orderId='$orderId'")->save($data) !== false)
				 {
					$order_detail=M('order_detail');
					$order_details = $order_detail->where("orderId='$orderId'")->select();
					foreach ($order_details as $val)
					{
						$item->where('id='.$val['itemId'])->setInc('buy_num',$val['quantity']);
					}
					//sail 增加积分
					$item_orderEny = M("item_order")->where(array("orderId"=>$_GET["orderId"]))->find();
					
					$uid = $this->visitor->info['id'];
					
					$item_jifenMd = M("item_jifen");
					$item_jifenData = array();
					$item_jifenData["orderId"] = $item_orderEny["orderId"];
					$item_jifenData["uid"] = $uid;
					$item_jifenData["jifen"] = $item_orderEny["order_sumPrice"];
					$item_jifenData["add_time"] = time();
					$item_jifenData["price"] = $item_orderEny["order_sumPrice"];
					$item_jifenData["state"] = 1;
					$item_jifenMd->add($item_jifenData);
					
	     	//sail --end
			$this->success('修改成功!');
	     }else 
	     {
	     	$this->error('确定收货失败');
	     }
				$order_detail=M('order_detail');
				$item=M('item');
				$order_details = $order_detail->where(array('orderId'=>$orderId))->select();
				foreach ($order_details as $val)
				{
				$item->where('id='.$val['itemId'])->setInc('buy_num',$val['quantity']);
				}
				$this->success('修改成功!');
			}else{
				$this->error('修改失败!');
			}
		  
      }else{
      	$data['status']=$status;
      	if($this->_mod->where(array('orderId'=>$orderId))->save($data))
      	{	
      		$this->add_log('修改订单状态');
      		$this->success('修改成功!');
      	}else
      	{
      		$this->error('修改失败!');
      	}
      }
	  
	  //sail
	  if($status == 8) {
		//sail 减积分
		$item_orderMd = M("item_order");
		$orderId=$_GET['orderId'];
		$item_order = $item_orderMd->where(array("orderId"=>$_GET["orderId"]))->find();
		
		$item_jifenMd = M("item_jifen");
		$item_jifenData = array();
		$item_jifenData["title"] = $item_order["orderId"];
		$item_jifenData["orderId"] = $item_order["orderId"];
		$item_jifenData["uid"] = $item_order["userId"];
		$jifen= $this->_get('jifen', 'trim');
		!$jifen && $this->_404();
		$item_jifenData["jifen"] = $jifen;
		$item_jifenData["add_time"] = time();
		$item_jifenData["price"] = $jifen;
		$item_jifenData["state"] = 0;
		$item_jifenMd->add($item_jifenData);
		//退钱
		$uid =  $item_order["userId"];
		$user = M("user")->where(array("id"=>$uid))->find();
		$user_account = $user["user_account"]+$jifen;
		M("user")->where(array("id"=>$uid))->save(array("user_account"=>$user_account));
		//sail 订单提成,1级A, 2级B, 3级C,4级D,5级E 提成
		$fclvArr = M("user_fengchenglv")->order('id asc')->select();
		$uid =  $item_order["userId"];
		$userEny = M("user")->where(array("id"=>$uid))->find();
		$res=M('user_fengchengllist')->where(array('orderId'=>$orderId,'user_id'=>$uid))->delete();
		
	 }
      
      
    }
    

    protected function _search() {
		
		$item_base = M('itembase')->order('id asc')->select();
		$this->assign('item_base',$item_base);
		
        $map = array();
        ($time_start = $this->_request('time_start', 'trim')) && $map['weixin_item_order.add_time'][] = array('egt', strtotime($time_start));
        ($time_end = $this->_request('time_end', 'trim')) && $map['weixin_item_order.add_time'][] = array('elt', strtotime($time_end)+(24*60*60-1));
        ($time_start_support = $this->_request('start_support_time', 'trim')) && $map['weixin_item_order.support_time'][] = array('egt', strtotime($time_start_support));
        ($time_end_support = $this->_request('end_support_time', 'trim')) && $map['weixin_item_order.support_time'][] = array('elt', strtotime($time_end_support)+(24*60*60-1));
        
        ($price_min = $this->_request('price_min', 'trim')) && $map['weixin_item_order.order_sumPrice'][] = array('egt', $price_min);
        ($price_max = $this->_request('price_max', 'trim')) && $map['weixin_item_order.order_sumPrice'][] = array('elt', $price_max);
        ($userName = $this->_request('userName', 'trim')) && $map['weixin_item_order.userName'] = array('like', '%'.$userName.'%');
        ($status = $this->_request('status', 'intval')) && $map['weixin_item_order.status'] = array('eq', $status);
		($is_urgent = $this->_request('is_urgent', 'intval')) && $map['weixin_item_order.is_urgent'] = array('eq', $is_urgent);
        ($orderId = $this->_request('orderId', 'trim')) && $map['weixin_item_order.orderId'] = array('like', '%'.$orderId.'%');
		($freetype = $this->_request('freetype', 'intval')) && $map['weixin_item_order.freetype'] = array('eq', $freetype);
		($baseid = $this->_request('itembase', 'intval')) && $map['weixin_item_order.baseid'] = array('eq', $baseid);
		($is_finish = $this->_request('is_finish', 'intval')) && $map['weixin_item_order.is_finish'] = array('eq', $is_finish);
        ($goods_person = $this->_request('goods_person', 'trim')) && $map['weixin_item_order.address_name'] = array('like', '%'.$goods_person.'%');
        ($merchant = $this->_request('merchant', 'trim')) && $map['weixin_user.merchant'] = array('like', '%'.$merchant.'%');
        $this->assign('search', array(
            'time_start' => $time_start,
            'time_end' => $time_end,
            'price_min' => $price_min,
           'price_max' => $price_max,
            'start_support_time' => $time_start_support,
           'end_support_time' => $time_end_support,
            'userName' => $userName,
            'status' =>$status,
			'is_urgent' => $is_urgent,
            'selected_ids' => $spid,
            'orderId' => $orderId,
			'freetype' => $freetype,
			'baseid' => $baseid,
            'goods_person' => $goods_person,
			'is_finish' => $is_finish,
			'merchant' => $merchant,
        ));
		session('map',$map);
        return $map;
    }

    public function add() {
    	
        if (IS_POST) {
            //获取数据
            if (false === $data = $this->_mod->create()) {
                $this->error($this->_mod->getError());
            }
            if( !$data['cate_id']||!trim($data['cate_id']) ){
                $this->error('请选择商品分类');
            }
           
            if($_POST['brand']==''){
            	
                $this->error('请选择品牌');
            }
         
            
            //必须上传图片
            if (empty($_FILES['img']['name'])) {
                $this->error('请上传商品图片');
            }
           if(isset($_POST['news']))
            {
            	$data['news']=1;
            }else {
            	$data['news']=0;
            }
             if(isset($_POST['tuijian']))
            {
            	$data['tuijian']=1;
            }else {
            	$data['tuijian']=0;
            }

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
            
          

            //上传图片
            $date_dir = date('ym/d/'); //上传目录
            $item_imgs = array(); //相册
            $result = $this->_upload($_FILES['img'], 'item/'.$date_dir, array(
                'width'=>C('pin_item_bimg.width').','.C('pin_item_img.width').','.C('pin_item_simg.width'), 
                'height'=>C('pin_item_bimg.height').','.C('pin_item_img.height').','.C('pin_item_simg.height'),
                'suffix' => '_b,_m,_s',
                //'remove_origin'=>true 
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
            $data['imgs'] = $item_imgs;
            $item_id = $this->_mod->publish($data);
            !$item_id && $this->error(L('operation_failure'));
            $this->success(L('operation_success'));
        } else {
       
            $this->display();
        }
    }

    public function edit() {
		 $id = $this->_get('id','intval');
		 
		/*********************Expr/Update 2015-5-23***************************/
		//import("@.Public.Express");  
		import("@.Public.kuaidi"); 	
    	//根据当前的订单ID，查询订单编号，参数：$item['orderId']
    	$item = M('item_order')->where(array('id'=>$id))->find();
		//echo $item['status'];exit;
		
		//获取状态
		$status = M('item_order')->field('status')->where(array('id'=>$id))->find();
		
		
		
    	$freecode1 = $item['freecode'];
    	$freecode = explode(',',$freecode1);//快递单数组

    	$arr = array();
    	//$express = new Express();//实例化快递查询类 
    	$express = new Kuaidi();//实例化快递查询类 
        if($freecode){
            
        	foreach ($freecode as $key => $value) {
        		$exp_result[] =  $express -> getorder($value);
        		if($exp_result){
        			$wl .= $exp_result[$key]['express_name'];
        			
        			foreach ($exp_result as $k => $v) {
    					
    					foreach ($exp_result[$k]['trace'] as $kk => $vv) {
    						$arr[$k][] = $vv;
    						
    					}
    				}
        		}
        	}
        	krsort($arr);
        	$counts = count($arr);
        }

		$this->assign('counts',$counts);//物流名称 
		$this->assign('wl',$wl);//物流名称 
		$this->assign('list',$arr);
		$this->assign('freecode',$freecode1); 

        if (IS_POST) {
           

          
        }else{
           $item = M('item_order')->field('a.*,b.itemtype,b.idcname,b.idcnum,idczimg,idcfimg,zimg,fimg')->join('a left join weixin_order_detail b ON a.orderId=b.orderId')->where(array('a.id'=>$id))->find();
		   $iorder = M('item_order')->where(array('id'=>$id))->find();
		  //统计订单详情对应的order_detail表中有多少待发货商品
		   $contwhere['status'] = 0;
		   $contwhere['orderId'] = $item['orderId'];
		   $itemcont = M('order_detail')->where($contwhere)->count();
		   $this->assign('itemcont',$itemcont);
			//echo $item['orderId'];exit;
             $order_detail=M('order_detail')->
			join('a left join weixin_itembase b ON a.baseid=b.id')
			->where(array('orderId'=>$item['orderId']))
			->field('b.*,a.*')
			->select();
			//dump($order_detail);
            foreach ($order_detail as $k=>$val)
            {
                $items_attr=$val['item_attr'];//商品属性
                $attr_arr=array_filter(explode(";",$items_attr));
                $attr_list=array();
                    foreach($attr_arr as $ke=>$va){
                        $attr_arr2=array_filter(explode("|",$va));
                        $attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
                    }
                $order_detail[$k]['attr']=$attr_list;//赋值attr;
            }
	  $itemtk = M('item_ordertk')->where(array('orderId'=>$item['orderId']))->find();
	  $bank   = M('bank')->where(array('id'=>$itemtk['kaihuhang']))->find();
	  $itemtk['bank'] = $bank['bank']; 
	  $itemcomment = M('item_comment')->where(array('item_id'=> $order_detail[0]['itemId'],'uid'=>$item['userId']))->find();
	  //var_dump($itemcomment);exit;
			
            $fahuoaddress=M('address')->find($item['fahuoaddress']);
            $this->assign('fahuoaddress',$fahuoaddress);//发货地址
            $this->assign('order_detail',$order_detail);//订单商品信息
			$this->assign('itemtk',$itemtk);//申请退货信息
			$this->assign('itemcomment',$itemcomment);//评论信息
            $this->assign('info', $item); // 订单详细信息												
			//print_r($item);
           
        }
		$this->assign('status',$item['status']);
		//$addr = M('user_addredss')->where('c_id='.$item['idcnum'].' and uid='.$item['userId'])->find();
		//$this->assign('addr',$addr);
		//物流映射
		/*
		if($result['companytype'] == 'zhongtong'){		
			$result['companytype'] = "中通快递";			
		}elseif($result['companytype'] == 'ems'){		
			$result['companytype'] = "EMS";
		}elseif($result['companytype'] == 'sto_express'){		
			$result['companytype'] = "申通快递";
		}elseif($result['companytype'] == 'sf'){		
			$result['companytype'] = "顺丰快递";
		}elseif($result['companytype'] == 'yunda'){		
			$result['companytype'] = "韵达";
		}else{
			$result['companytype'] = "系统繁忙，正在查询...";
		}
		$this->assign('wl',$result['companytype']);	
		*/
		

		/*
		if($result['com'] == 'zhongtong'){		
			$result['com'] = "中通快递";			
		}elseif($result['com'] == 'ems'){		
			$result['com'] = "EMS";
		}elseif($result['com'] == 'shentong'){		
			$result['com'] = "申通快递";
		}elseif($result['com'] == 'shunfeng'){		
			$result['com'] = "顺丰快递";
		}elseif($result['com'] == 'yunda'){		
			$result['com'] = "韵达";
		}else{
			$result['com'] = "系统繁忙，正在查询...";
		}
*/
		//$this->assign('wl',$result['com']);	
		

		//分单处理
		$orderList = M('item_order')
		->field('a.*,b.itemId,b.title,b.img,b.price,b.quantity,b.size,b.itemtype,b.idcname,b.idcnum,b.idczimg,b.idcfimg')
		->join('a left join weixin_order_detail b ON a.orderId=b.orderId')
		->where('a.orderId='.$item['orderId'])
		->select();
		
		$u1=array();
		foreach($orderList as $k=>&$e){
			$name=&$e['itemtype'];
			if(!isset($u1[$name])){
				$u1[$name]=$e;
				unset($u1[$name]['itemId'],$u1[$name]['title'],$u1[$name]['img'],$u1[$name]['price'],$u1[$name]['quantity'],$u1[$name]['size']);
			}
			
			$u1[$name]['goodsifno'][]=array('itemId'=>$e['itemId'],'title'=>$e['title'],'img'=>$e['img'],'price'=>$e['price'],'quantity'=>$e['quantity'],'size'=>$e['size']);
		}
		$item2=array_values($u1); unset($u1);
		
		foreach($item2 AS $key=>$val){
			
			foreach($val['goodsifno'] AS $key1=>$val1){
				if($val['itemtype']==1){
					$sum+=$val1['price'];
				}
				if($val['itemtype']==0){
					$sum1+=$val1['price'];
				}
				
				
			}
			//统计不同分单的类型的价格
			if($val['itemtype']==1){
				array_push($item2[$key],$sum);
			}
			if($val['itemtype']==0){
				array_push($item2[$key],$sum1);
			}
			
			
		}
		
		//echo "<pre>";
		//var_dump($item2);exit;
		
		$this->assign('orderList',$item2);

		$item_base = M('itembase')->order('id asc')->select();
		$this->assign('item_base',$item_base);		
		
		$this->display();
    }
	public function edit_base(){
		$id = $this->_post('id','intval');
		$basename = $this->_post('basename','trim');
	
		if(M('order_detail')->where(array('id'=>$id))->save(array('item_base'=>$basename))){
			echo 1;
		}
	}
	
	
	//AJAX 修改配送快递 2016/05/09 by liaoxiaolin
	
	public function change_userfree(){
    	if(IS_AJAX){
    		$orderid = $_POST['orderid'];//订单id 
    		$userfree = $_POST['userfree'];//快递单号
    		$data['userfree'] =  $userfree;
    		if($orderid>0 && $userfree){
    			$res = M('item_order')->where('id='.$orderid)->save($data);
    		}
    		if($res){
    			$msg = 1;
    		}else{
    			$msg = 0;
    		}
    		echo json_encode($msg);
    	}
    }
	
	
    //AJAX 修改快递单  2016-03-30 by shuguang
	
    public function change_express(){
    	if(IS_AJAX){
    		$orderid = $_POST['orderid'];//订单id 
    		$freecode = $_POST['freecode'];//快递单号
    		$data['freecode'] =  $freecode;
    		if($orderid>0 && $freecode){
    			$res = M('item_order')->where('id='.$orderid)->save($data);
    		}
    		if($res){
    			$msg = 1;
    		}else{
    			$msg = 0;
    		}
    		echo json_encode($msg);
    	}
    }
    //AJAX 修改包裹详情  2016-04-06 by shuguang
    public function change_kuaidi_desc(){
        if(IS_AJAX){
            $orderid = $_POST['orderid'];//订单id 
            $kuaidi_desc = $_POST['kuaidi_desc'];//包裹详情
            $data['kuaidi_desc'] =  $kuaidi_desc;
            if($orderid>0 && $kuaidi_desc){
                $res = M('item_order')->where('id='.$orderid)->save($data);
            }
            if($res){
                $msg = 1;
            }else{
                $msg = 0;
            }
            echo json_encode($msg);
        }
    }

    public function updateRemark(){
        $txtSellerRemark= $_POST['txtSellerRemark'];//用客服备注
        $id=$_POST['id'];//订单ID
        $data['sellerRemark']=$txtSellerRemark;
        if(M('item_order')->where('id='.$id)->save($data)!==false)
        {
            $this->success('修改成功！');
        }else 
        {
            $this->error('修改失败！');
        }
    }
	
	/*
	 *  订单自动确认收货
	 *	@author vany
	 *	date  2016-1-7
	 */
	 
	public function update_order(){
		$item_order =M('item_order');
	    $item 		=M('item');
        $fclist = M("user_fengchengllist");
		$set = M('set')->where(array('id'=>1))->find();
		$where1['a.add_time'] =array('lt',time()-24*3600*$set['tx_djq']);
		$where1['a.status']	= 3;
	  	$orders= $item_order
 			   ->join('a left join __USER__ as b on a.shopid = b.id')
 			   ->field("a.*,b.id,b.uid,b.shares,b.recom,b.wechatid")
 			   ->where($where1)
               ->limit(1)
 			   ->select();
 			   
 			   	//如果是直邮延长时间为25天
 			   foreach ($orders as $k1 => $v1){
            $order_detail = M('order_detail')->where("orderId = '".$v1['orderId']."'")->field('itemId')->select();
            $add_time = 24*3600*25;
            foreach($order_detail as $v2){
                $direct = $item->where(array('id'=>$v2['itemId']))->field('is_direct,add_time')->find();
                $del_time = time()-$direct['add_time'];
                if($direct['is_direct']==1 && $del_time>$add_time){
                    unset($orders[$k1]);
                    $orders=array_values($orders);
                }
            }
        }
 		$count = count($orders);
       //dump($orders);die;
     	
     	foreach($orders as $key1=>$ov){
            $orderId 	 = $ov['orderId'];
            $status 	 = $ov['status'];

            $data ['status']   = 4;//收到货
            $where['orderId']  = $orderId;
            $where['status']   = 3;
            // 实例化模版信息类
            $wxsend   = new Wxsend();
            if($item_order->where($where)->save($data) !== false) //$data['status']	= 4
            {
                //获取订单信息和商品信息
                $order_detail = M('order_detail')
                    ->where("orderId = '".$orderId."'")
                    ->select();
                foreach ($order_detail as $k => $val) {
                    $profitPrice += $val['profit']; //获取订单利润
                    $orderPrice += $val['price']; //获取订单单价
                    // 减掉对应商品的库存数量
                    $item->where('id='.$val['itemId'])->setInc('buy_num',$val['quantity']);
                    $shares['id']= $ov['shares'];
                }
                $shop_shares = $this->getShareTree($ov['shopid']);//获取获得提成的用户ID

                foreach($shop_shares['uid'] as $sk=>$sv){
                    $lvId .=$sv;
                }
                $roy = M('user_fengchenglv')->where(array('id'=>$lvId))->field('royalty')->find();//获取各级别的分成率

                $royArr = explode('|',$roy['royalty']);

                $time = date("Y-m-d H:i:s");

                foreach($royArr as $rk=>$rv){
                    //店铺分成
                    $fcdata['price']= round($orderPrice,2); //订单总金额
                    $fcdata['user_id'] = $ov['userId'];
                    $fcdata['add_time']= time();
                    $fcdata['state'] 	 = 1;
                    $fcdata['orderId'] = $ov['orderId'];
                    $fcdata['royalty'] = $rv;
                    $fcdata['fencheng']= round($profitPrice*$rv,2);
                    $fcdata['uid'] = $shop_shares['shareId'][$rk];
                    $res = $fclist->add($fcdata);
                    //确认收货后修改allfclist表中的订单状态为2（已收货）
                    $edt = M('user_allfcllist')->where(array('orderId'=>$ov['orderId']))->setField('is_find',2);
                    $wxsend->SR($shop_shares['wechatid'][$rk],round($profitPrice*$rv,2),$time);//提示代理商获得返利
                    //$wxsend->SR('oOejpwkHntWxdXEDlk41EZega2Fs',round($profitPrice*$rv,2).' '.$shop_shares['wechatid'][$rk],$time); //测试样例
                }
            }
        }
     	$this->ajaxReturn(1,'更新成功，本次更新了'.$count.'个订单。');
	}
	
	public function getShareTree($shopid){
        //售出商品的店铺
        //$shopid = $this->_get('shopid','trim');
        $user_mod = M('user');
        $user =  $user_mod->where(array('id'=>$shopid))->field('uid,username,wechatid,shares_tree')->find();
        $uid = $user['uid'];

        $arr = array();
        $arr['shareId'][] = $shopid;
        $arr['uid'][] = $uid;
        $arr['username'][] = $user['username'];
        $arr['wechatid'][] = $user['wechatid'];
        //由低等级往上,找出5,3,2等级的店铺各一家
        while($uid>2){
            $sharesArr = explode('|',$user['shares_tree']);
            $num = count($sharesArr);
            if($num<3){
                return $arr;
                //echo json_encode($arr);exit;
            }
            $user = $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            while($user['uid']>=$uid){ //需要跳过相同等级的店铺
                $sharesArr = explode('|',$user['shares_tree']);
                $num = count($sharesArr);
                if($num<3){
                    return $arr;
                    //echo json_encode($arr);exit;
                }
                $user = $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            }
            $arr['shareId'][] = $sharesArr[$num-2];
            $arr['uid'][] = $user['uid'];
            $arr['username'][] = $user['username'];
            $arr['wechatid'][] = $user['wechatid'];
            $uid = $user['uid'];
        }
        //再找出两家等级为2的店铺
        for($i=0;$i<2;$i++){
            $sharesArr = explode('|',$user['shares_tree']);
            $num = count($sharesArr);
            if($num<3){
                return $arr;
                //echo json_encode($arr);exit;
            }
            $user =  $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            while($user['uid']!=2){
                $sharesArr = explode('|',$user['shares_tree']);
                $num = count($sharesArr);
                if($num<3){
                    return $arr;
                    //echo json_encode($arr);exit;
                }
                $user = $user_mod->where(array('id'=>$sharesArr[$num-2]))->field('uid,username,wechatid,shares_tree')->find();
            }
            $arr['shareId'][] = $sharesArr[$num-2];
            $arr['uid'][] = $user['uid'];
            $arr['username'][] = $user['username'];
            $arr['wechatid'][] = $user['wechatid'];
        }
        return $arr;
        //echo json_encode($arr);
    }
	

	public function updateOverrule(){
        $txtoverrule= $_POST['txtoverrule'];//用客服备注
        $id=$_POST['id'];//订单ID
        $data['overrule']=$txtoverrule;
        if(M('item_order')->where('id='.$id)->save($data)!==false)
        {
            $this->success('修改成功！');
        }else 
        {
            $this->error('修改失败！');
        }
    }
	public function updateVouchers(){
        $txtvouchers= $_POST['txtvouchers'];//用客服备注
        $id=$_POST['id'];//订单ID
        $data['vouchers']=$txtvouchers;
        if(M('item_order')->where('id='.$id)->save($data)!==false)
        {
            $this->success('修改成功！');
        }else 
        {
            $this->error('修改失败！');
        }
        
    
    }
	
		//分成明细上传图片
	public function fencheng_img() {
		$filesError = array(
		"文件上传成功"
		,"上传的文件超过了 php.ini中upload_max_filesize(默认情况为2M) 选项限制的值"
		,"上传文件的大小超过了 HTML表单中MAX_FILE_SIZE选项指定的值"
		,"文件只有部分被上传"
		,"没有文件被上传"
		,"传文件大小为0");
		if($_FILES["img"]["error"] > 0) {
			$this->error($filesError[$_FILES["img"]["error"]]);
			return;
		}
		$id = "";
		if(isset($_POST["id"])) $id = $_POST["id"];
		if(empty($id)) $this->error("id号不能为空!");
		/*
		$_FILES["file"]["name"] - 被上传文件的名称
		$_FILES["file"]["type"] - 被上传文件的类型
		$_FILES["file"]["size"] - 被上传文件的大小，以字节计
		$_FILES["file"]["tmp_name"] - 存储在服务器的文件的临时副本的名称
		$_FILES["file"]["error"] - 由文件上传导致的错误代码
		*/
		$fileName = $_FILES["img"]["name"];
		$fileNameExt = "";
		$fileNameArr = explode(".",$fileName);
		$fileNameNum = count($fileNameArr);
		if($fileNameNum > 1) $fileNameExt = $fileNameArr[$fileNameNum-1];
		$imgArr = array("jpg","png","gif");
		if(!in_array($fileNameExt,$imgArr)) {
			$this->error("上传文件格式错误! ".$fileNameExt);
			return;
		}
		$uuid = md5(uniqid(mt_rand(), true));
		$pingzheng = "data/upload/item/".$uuid.".jpg";
		move_uploaded_file($_FILES["img"]["tmp_name"],$pingzheng);
		M("item_order")->where(array("id"=>$id))->save(array("pingzheng"=>$uuid.".jpg"));
		//echo M("item_order")->getLastSql(); exit;
		$this->success(L("上传成功!"));
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

    function delete_attr() {
        $attr_mod = M('item_attr');
        $attr_id = $this->_get('attr_id','intval');
        $attr_mod->delete($attr_id);
        echo '1';
        exit;
    }

	public function free_info(){
		import("@.Public.Express"); 	//物流查询类 
		$id = $this->_get('id','trim');
		$where['id'] = $id;
		$order = M('order_detail')->where($where)->find();
		$express = new Express();
		//如果是国际物流，则采用http://www.qexpress.co.nz/接口获取物流信息
		if($order['userfree'] == '国际物流'){
			$result  = $express -> getorder($order['freecode'],1);
		}elseif($order['userfree'] == '程光快递'){
			$result =array('data'=>$express->get_free($order['freecode']));
		}else{
			$result  = $express -> getorder($order['freecode'],2);
		}
		$this->assign('result',$result);
		$this->assign('order',$order);
		$this->display();
	}
	
	public function itemedit(){
		$item_base = M('itembase')->order('id asc')->select();
		$this->assign('item_base',$item_base);
		$id = $this->_get('id','trim');
		$where['id'] = $id;
		$order = M('order_detail')->where($where)->find();
		$deliveryList= M('delivery')->where('status=1')->select();//快递方式
		if(IS_POST){
			$delivery = $this->_post('delivery','trim');
			$status = $this->_post('status','trim');
			$freecode = $this->_post('freecode','trim');
			$item_base = $this->_post('item_base','trim');
			$id = $this->_post('id','trim');
			$data['userfree'] = $delivery;
			$data['status'] = $status;
			$data['freecode'] = $freecode;
			$data['item_base'] = $item_base;
			$where['id'] = $id;
			$save = M('order_detail')->where($where)->save($data);
			if($save){
				if($status == 9||$status == 10){
					$orderId = M('order_detail')->where($where)->getField('orderId');
					M('item_order')->where(array('orderId'=>$orderId))->save(array('status'=>$status,'qg_time'=>time()));//若有商品在清关中，则相应订单状态应改为清关中
				}
				$this->success('订单信息修改成功',U('item_order/itemedit',array('id'=>$id)));
				exit;
			}else{
				$this->error('修改失败，请选择要修改的内容',U('item_order/itemedit',array('id'=>$id)));
			}
		}
		
        $this->assign('deliveryList',$deliveryList);
		$this->assign('order',$order);
		$this->display();
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
    public function fahuo()
    {
    	 $mod = D($this->_name);
        if (IS_POST&&$this->_post('orderId','trim')) {
            $orderId= $this->_post('orderId','trim');//订单号ID
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
			$date['userfree']=$_POST['delivery'];
			$date['freecode']=$_POST['deliverycode'];
			$date['fahuoaddress']=$data['address'];
			//将快递信息写进order_detail表
			$datas['status']= 3;
			$datas['userfree']= $_POST['delivery'];
			$datas['freecode']= $_POST['deliverycode'];
			$datas['send_time']= time();
			$save_free = M('order_detail')->where(array('id'=>$_POST['itemlist']))->save($datas);
			
			$where['id'] = $this->_post('itemlist','trim');
			$order = M('order_detail')->where($where)->find();
			$idata['status'] = 3; //待收货
            $idata['is_finish'] = 0; //货已全发
            $finish = M('order_detail')->where(array('orderId'=>$order['orderId']))->field('status')->select();
            foreach($finish as $key => $val){
                if($val['status']==0){
                    $idata['is_finish'] = 1;
                }
            }
            M('item_order')->where(array('orderId'=>$order['orderId']))->save($idata);
            
            $date['fahuo_time']=time();
            $date['status']=3;
			//全部发货
			if($_POST['itemlist'] == 0){
				$idata['status'] = 3; //待收货 
				$idata['userfree'] = $_POST['delivery'];
				$idata['freecode'] = $_POST['deliverycode'];
				$idata['send_time'] = time(); //发货时间
				M('order_detail')->where(array('orderId'=>$orderId,'userfree'=>0,'freecode'=>0,'status'=>0))->save($idata);
				$save_orderfree = $mod->where(array('orderId'=>$orderId))->data($date)->save();
			}
            if($save_free || $save_orderfree){
				$orderlist = M('item_order')
				 ->join('a left join __USER__ as b on a.userId = b.id')
				 ->where(array('a.orderId'=>$orderId))
				 ->field('a.*,b.wechatid,b.username')
				 ->find();
				 
				//实例化模版信息类	
				$wxsend = new Wxsend();
				//发送短信
				$username = "clytyf6688";
				$pwd = "7heqfz5k";
				$password = md5($username."".md5($pwd));
				$mobile = $orderlist['mobile'];
				if($_POST['itemlist'] == 0){
					$content = "亲爱的饭团{$orderlist['username']}您好！您购买的宝贝已经乘坐{$orderlist["userfree"]}({$orderlist["freecode"]})迫不及待的奔向您啦，请注意签收。祝您生活愉快！";
				}else{
					$content = "亲爱的饭团{$orderlist['username']}您好！您购买的宝贝：{$order['title']}，数量：{$order["quantity"]}件，已经乘坐{$order["userfree"]}({$order["freecode"]})迫不及待的奔向您啦，请注意签收 :) \n\n提示：不同商品可能涉及到不同的仓库，因发货仓库不同，货物配送到您手中的时效会稍有区别，请以实际为准。祝您生活愉快！";
				}
				$_SESSION['message_rand']=$message_rand;
				$url = "http://sms-cly.cn/smsSend.do?";
				$param = http_build_query(
					array(
						'username'=>$username,
						'password'=>$password,
						'mobile'=>$mobile,
						'content'=>$content
					)
				);
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_HEADER,0);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch,CURLOPT_POST,1);
				curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
				$result = curl_exec($ch);
				curl_close($ch);
				//发送微信消息
				if($_POST['itemlist'] == 0){
					$data = '亲爱的饭团：'.$orderlist["username"].'，您购买的订单号为：'.$orderlist["orderId"].'的宝贝已发货：\n快递：'.$orderlist["userfree"].'\n快递单号：'.$orderlist["freecode"].'\n发货时间：'.date("Y-m-d H:i:s",$orderlist["fahuo_time"]);
				}else{
					$data = '亲爱的饭团：'.$orderlist["username"].'，您购买的订单号为：'.$orderlist["orderId"].'的宝贝已发货：\n宝贝名称：'.$order['title'].'\n数量：'.$order['quantity'].'件\n快递：'.$order["userfree"].'\n快递单号：'.$order["freecode"].'\n发货时间：'.date("Y-m-d H:i:s",$order["send_time"].'\n提示：不同商品可能涉及到不同的仓库，因发货仓库不同，货物配送到您手中的时效会稍有区别，请以实际为准。祝您生活愉快！');
				}
				$res = $wxsend->KF_M($orderlist['wechatid'],$data);
                //2016-04-06 by shuguang 添加多包裹详情 
                $order_goods = M('OrderDetail')->where(array('orderId'=>$orderId))->field('title,quantity')->select();//该订单的所有商品 
                $kuaidi_desc_title = $order_goods[0]['title'];
                $kuaidi_num = 0;
                foreach ($order_goods as $key => $value) {
                   $kuaidi_num += intval($value['quantity']);
                }
                //更新发货信息 
                $kuaidi_desc = $kuaidi_desc_title.'#'.$kuaidi_num;
                $ups_data['kuaidi_desc'] = $kuaidi_desc;
                $mod->where(array('orderId'=>$orderId))->save($ups_data);
                //2016-04-06 by shuguang 添加多包裹详情 end

				IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                $this->success(L('operation_success'));
            }else{
              IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
              $this->error(L('operation_failure'));
			}
        }else{
            $this->assign('open_validator', true);
            if (IS_AJAX) {
            if(count(M('address')->where('status=1')->find())==0)
            	{
            	$this->ajaxReturn(1, '', '请先添加默认收货地址！');
            	}
             $id= $this->_get('id','trim');//订单号ID
             $info= $this->_mod->find($id);
			 //发货时输出所有待发货的商品列表
			 $where['orderId'] = $info['orderId'];
			 $where['status'] =	 0;
			 $itemlist = M('order_detail')->where($where)->select();
			 $this->assign('itemlist',$itemlist);
             $this->assign('info',$info);
             $deliveryList= M('delivery')->where('status=1')->order('ordid asc,id asc')->select();//快递方式
             $this->assign('deliveryList',$deliveryList);
             $addressList=M('address')->where('status=1')->order('ordid asc,id asc')->select();//快递方式
             $this->assign('addressList',$addressList);
             $response = $this->fetch();
             $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }
	
	//范票充值
	public function send_point(){
		$order_id = $this->_get('order_id','trim');
		$item_order = M('item_order')->where(array('id'=>$order_id))->find();
		$uinfo = M('user')->where(array('id'=>$item_order['userId']))->getField('username');
		if(IS_POST){
			$userid = $this->_post('userid','trim');
			$point = $this->_post('point','trim');
			$orderid = $this->_post('orderid','trim');
			$id = $this->_post('id','trim');
			if(empty($point)){
				$this->error('范票数量未填写！');
			}else{
				$message = M('messagelist');
				$message->user_id =$userid;
				$message->recom =$userid;
				$message->type = 12; //范票充值
				$message->order_id = 0; //订单id
				$message->time = time();
				$message->status = 0; // 默认未读状态
				$message->points = $point;
				$message->add();
				M('user')->where(array('id'=>$userid))->setInc('points',$point);
				M('item_order')->where(array('orderId'=>$orderid))->save(array('status'=>4));
				M('order_detail')->where(array('orderId'=>$orderid))->save(array('status'=>4));
				$this->success('范票充值成功！',U('item_order/edit',array('id'=>$id)));
				exit;
			}
		}
		$this->assign('order_info',$item_order);
		$this->assign('uinfo',$uinfo);
		$this->display();
	}
	//发送短信
	public function send_info(){
		$order_id = $this->_get('order_id','trim');
		$item_order = M('item_order')->where(array('id'=>$order_id))->find();
		$this->assign('order_info',$item_order);
		$this->display();
	}
	
	public function	send_infocontent(){
		$content = $this->_post('info_content','trim');
		if(empty($content)){
			$this->error('短信内容还未填写');
		}else{
			$username = "clytyf6688";
			$pwd = "7heqfz5k";
			$password = md5($username."".md5($pwd));
			$mobile = $this->_post('mobile','trim');
			$_SESSION['message_rand']=$message_rand;
			$url = "http://sms-cly.cn/smsSend.do?";
			$param = http_build_query(
				array(
					'username'=>$username,
					'password'=>$password,
					'mobile'=>$mobile,
					'content'=>$content
				)
			);
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_HEADER,0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$param);
			$result = curl_exec($ch);
			curl_close($ch);
			$this->success('短信已发送成功');
		}
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
                $this->add_log('删除订单');
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
    
    /**
     * Wechat::buildSign()
     * 生成sign值
     * @param array $array
     * @param array $config
     * @return string
     */
    public function buildSign($array, $config) {
        foreach ($array as $k => $v){
             $bizParameters[strtolower($k)] = $v;
         }
        $bizParameters["appkey"] =  $config['signkey'];
        ksort($bizParameters);
        //var_dump($bizParameters);
        $buff = "";
        foreach ($bizParameters as $k => $v){
                $buff .= strtolower($k) . "=" . $v . "&";
        }
        $reqPar;
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        $bizString = $reqPar;
        //var_dump($bizString);
        return sha1($bizString);

    }

    /**
     * wechat::getAccessToken()
     * 获取access_token
     * @return string
     */
    public function getAccessToken($config)
    {
    $ch = curl_init(); 
     curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$config['appid']."&secret=".$config['appsecret']); 
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
     curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
     $tmpInfo = curl_exec($ch); 
     if (curl_errno($ch)) {  
        echo 'Errno'.curl_error($ch);
     }
     curl_close($ch); 
     $arr= json_decode($tmpInfo,true);
     return $arr['access_token'];
    }


    /**
     * Wechat::delivernotify()
     * 发货通知
     * @param array $config
     * @param array $parameter
     * @return array
     */
    public function delivernotify($config, $parameter) {
        $url = 'https://api.weixin.qq.com/pay/delivernotify?access_token=' . $this->getAccessToken($config);
        $parameter += array(
            'app_signature' => $this->buildSign($parameter, $config),
            'sign_method' => 'sha1'
        );
        //$this->log_result($parameter);
        $result = $this->doPost($url, json_encode($parameter));
        return json_decode($result, true);
    }
    /**
     * Wechat::doPost()
     * post请求
     * @param string $url
     * @param array $data
     * @return
     */
    public function doPost($url, $data) {
        $context = array('http' => array('method' => "POST", 'header' => "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) \r\n Accept: */*", 'content' => $data));
        $stream_context = stream_context_create($context);
        $request = @file_get_contents($url, FALSE, $stream_context);
        return $request;
    }
     /**
     * Wechat::log()
     * log日志
     * @param $word 日志信息
     * 
     */
    public function log_result($word) {
        $fp = fopen("log.txt","a");
        //flock($fp, LOCK_EX) ;
        fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n\n");
        //flock($fp, LOCK_UN);
        fclose($fp);
    }
	
	public function excelout(){
		$map = session('map');
          $data=$this->_mod
			   ->where($map)
			   ->join("left join __USER__ on weixin_item_order.shopid = weixin_user.id left join weixin_itembase ON weixin_item_order.baseid=weixin_itembase.id")
			   ->field('weixin_item_order.id,weixin_item_order.orderId,weixin_item_order.order_sumPrice,weixin_item_order.address,weixin_user.merchant,weixin_item_order.address_name,weixin_item_order.mobile,weixin_item_order.add_time,weixin_item_order.freetype,weixin_item_order.cash_price,weixin_item_order.coupon_price,weixin_item_order.status,weixin_itembase.basename')
			   ->select();   
		foreach($data as $key=>$value){
			$order_detail = '';
			$res = M('order_detail')->where(array('orderId'=>$value['orderId']))->select();
			foreach($res as $k=>$val){
				$item = M('item')->where(array('id'=>$val['itemId']))->find();
				$order_detail .= $val['title']."(".$val['size'].")x".$val['quantity']."（编号：".$item['adress']."）\r\n";
				$data[$key]['gprice'] += $val['price']*$val['quantity'];
			}
			$data[$key]['idcname'] = $res[0]['idcname'];
			$data[$key]['idcnum']  = $res[0]['idcnum'];			
			$data[$key]['order_detail'] = $order_detail;
		}
		
		 //生成输出的数据 2016-04-28  by shuguang 添加 
        $print_data = array();
        foreach ($data as $k => $v) {
            $print_data[$k]['id'] = $v['id'];// id
            $print_data[$k]['orderId'] = $v['orderId'];//订单编号
            $print_data[$k]['send_address'] = '';//财务需要留空 发货地点
            $print_data[$k]['express_name'] = '';//财务需要留空 快递公司
            $print_data[$k]['express_no'] = '';//财务需要留空 快递单号 
            $print_data[$k]['express_time'] = '';//财务需要留空 发货时间 
            $print_data[$k]['address'] = $v['address'];//收货地址 
            $print_data[$k]['address_name'] = $v['address_name'];//收货人 
            $print_data[$k]['mobile'] = $v['mobile'];//联系方式
            $print_data[$k]['add_time'] = $v['add_time'];//下单时间 
            $print_data[$k]['idcname'] = $v['idcname'];//身份证姓名 
            $print_data[$k]['idcnum'] = $v['idcnum'];//身份证号码 
            $print_data[$k]['order_detail'] = $v['order_detail'];//订单详情 
            $print_data[$k]['price'] = '';//财务需要留空 单价 
            $print_data[$k]['num'] = '';//财务需要留空 数量 
            $print_data[$k]['free'] = '';//财务需要留空 快递费 
            $print_data[$k]['totals'] = '';//财务需要留空 应付总金额  
            $print_data[$k]['order_sumPrice'] = $v['gprice'];
            $print_data[$k]['merchant'] = $v['merchant'];//所属分享店铺
			if($v['freetype'] == 10){
				$print_data[$k]['freetype'] = '卖家要求发顺丰速运';//快递备注
			}else{
				$print_data[$k]['freetype'] = '商家指定';//快递备注
			}
			$print_data[$k]['basename'] = $v['basename'];//免税仓
			/*
			if(!$v['cash_price']==0){
				$print_data[$k]['cash_price'] = '使用'.$v['cash_price'].'张范票抵扣了'.$v['cash_price']/100 .'元现金';
			}else{
				$print_data[$k]['cash_price'] ='无';
			}
			if(!$v['coupon_price']==0){
				$print_data[$k]['coupon_price'] = '使用优惠卷兑换了'.$v['coupon_price'].'元现金';
			}else{
				$print_data[$k]['coupon_price'] ='无';
			}
			*/
			switch($v['status']){
				case 1:
				$print_data[$k]['status'] = '待付款';
				break;
				
				case 2:
				$print_data[$k]['status'] = '待发货';
				break;
				
				case 3:
				$print_data[$k]['status'] = '待收货';
				break;
				
				case 4:
				$print_data[$k]['status'] = '已完成';
				break;
				
				case 6:
				$print_data[$k]['status'] = '申请退款中';
				break;
				
				case 7:
				$print_data[$k]['status'] = '申请退款失败';
				break;
				
				case 8:
				$print_data[$k]['status'] = '申请退款成功';
				break;
				
				case 9:
				$print_data[$k]['status'] = '待收货 (清关中)';
				break;
				
				case 10:
				$print_data[$k]['status'] = '异常订单';
				break;
			}
        }
		
		//print_r($data);exit;	 
        $filename="订单详情";
		$headArr=array("ID","订单编号","发货地点","快递公司","快递单号","发货时间","收货地址","收货人","联系方式","下单时间","身份证姓名","身份证号码","订单详情","单价","数量","快递费","应付总金额","订单金额","所属分享店铺","快递备注","免税仓","订单状态");
        //$headArr=array("ID","订单编号","订单金额","收货地址","店铺名","收货人","联系方式","下单时间","身份证姓名","身份证号码","订单详情");
        //如果第五个标题为时间戳字段,则在参数最后一位设置为5,没有则为0
        $this->getExcel($filename,$headArr,$print_data,12,10);
    }
	
	 /** 
     *   后台数据到出excel
     *   @author  vany
     *   date    2015 04 21 
     *       
     */   
    public function getExcel($fileName,$headArr,$data,$key1,$keys){
            //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
            import("Think.ORG.PHPExcel");
            import("Think.ORG.PHPExcel.Writer.Excel5");
            import("Think.ORG.PHPExcel.IOFactory.php");
            //对数据进行检验
            if(empty($data) || !is_array($data)){
                die("data must be a array");
            }
            //检查文件名
            if(empty($fileName)){
                exit;
            }

            //$date = date("Y_m_d",time());
            $fileName .= ".xls";

            //创建PHPExcel对象，注意，不能少了\
            $objPHPExcel = new PHPExcel();
            $objProps = $objPHPExcel->getProperties();
            
            //设置表头
            $key = ord("A");
            foreach($headArr as $v){
                $colum = chr($key);
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
                $key += 1;
            }
            
            $column = 2;
            $objActSheet = $objPHPExcel->getActiveSheet();
            foreach($data as $key => $rows){ //行写入
                $span = ord("A");
                $i=1;
                foreach($rows as $keyName=>$value){// 列写入
                    $j = chr($span);
                    //判断第E个为时间戳时间
                    if ($keys==$i) {
                        $objActSheet->setCellValue($j.$column,date('Y-m-d',$value));
                    }else if($key1 == $i){
                        $objActSheet->setCellValue($j.$column,'"'.$value.'"');
                    }else{
						$objActSheet->setCellValue($j.$column,$value);
					}
                    $span++;
                    $i++;
                }
                $column++;
            }

            $fileName = iconv("utf-8", "gb2312", $fileName);
            //重命名表
            // $objPHPExcel->getActiveSheet()->setTitle('test');
            //设置活动单指数到第一个表,所以Excel打开这是第一个表
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=\"$fileName\"");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output'); //文件通过浏览器下载
            exit;
    }
	
    /**
     * 物流跟踪
     * 参数：订单ID
     * Add Time 2015-5-18
     * $Author Wenhao $
     */
    /*public function expr(){
    	
    	header('Content-Type:text/html; charset=utf-8');
		import("@.Public.Express");
    	//获取当前的订单ID
    	$order_id = $this->_get('id','intval');
    	
    	//根据当前的订单ID，查询订单编号，参数：$item['orderId']
    	$item = M('item_order')->where(array('id'=>$order_id))->find();	 
    	$freecode = $item['freecode'];
    	$express = new Express();
    	$result  = $express -> getorder($freecode);
		
		$arr = array();
		foreach($result['data'] AS $k=>$val){
			
			$arr[] = $val; 
		}
		
		$info = array();
		foreach($result AS $k=>$val){
			
			$info[] = $val; 
		}
		
		//物流映射
		if($info[2] == 'zhongtong'){		
			$info[2] = "中通快递";			
		}elseif($info[2] == 'ems'){		
			$info[2] = "EMS";
		}elseif($info[2] == 'sto_express'){		
			$info[2] = "申通快递";
		}elseif($info[2] == 'sf'){		
			$info[2] = "顺丰快递";
		}elseif($info[2] == 'yunda'){		
			$info[2] = "韵达";
		}else{
			$info[2] = "系统繁忙，正在查询...";
		}
		
		$this->assign('info',$info[2]);
		$this->assign('list',$arr);
		$this->assign('freecode',$freecode);
		$this->display();
    	 	
    }*/
	
    /**
     * 打印订单
     * 参数：订单ID，以及打印标志[print = 1]
     * Add Time 2015-5-23
     * $Author Wenhao $
     */
    public function print_order(){
		
    	//防止订单内容出现乱码处理
    	header("Content-type:text/html;charset=utf-8");
		
		$addr = M('address');
    	
    	//获取当前的订单ID
    	$order_id = $this->_get('order_id','intval');
    	
    	//根据当前的订单ID，查询订单编号，参数：$item['orderId']
    	$item = M('item_order')->where(array('id'=>$order_id))->find();
    	$order_detail = M('order_detail')->where(array('orderId'=>$item['orderId']))->select();
    	
    	//获取属性列表
    	foreach ($order_detail as $k=>$val)
    	{
    		$items_attr=$val['item_attr'];//商品属性
    		$attr_arr=array_filter(explode(";",$items_attr));
    		$attr_list=array();
    		foreach($attr_arr as $ke=>$va){
    			$attr_arr2=array_filter(explode("|",$va));
    			$attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
    		}
    		$order_detail[$k]['attr']=$attr_list;//赋值attr;
    	}
		
		$userinfo = $addr->where('status=1')->find();

    	//输出商品基本信息
    	$this->assign("order_detail",$order_detail);
    	//订单详细信息
    	$this->assign('item_info', $item); 	
		$this->assign('userinfo', $userinfo); 	
    	$this->display();
    	
    }
    
    public function print_curr(){
    	header("Content-type:text/html;charset=utf-8");
    	$order_id = $this->_get('order_id','intval');
    	$item = M('item_order')->where(array('id'=>$order_id))->find();
    	$orderList = M('item_order')
    	->field('a.*,b.itemId,b.title,b.img,b.price,b.quantity,b.size,b.itemtype,b.idcname,b.idcnum,b.idczimg,b.idcfimg')
    	->join('a left join weixin_order_detail b ON a.orderId=b.orderId')
    	->where('a.orderId='.$item['orderId'])
    	->select();
    	
    	$u1=array();
    	foreach($orderList as $k=>&$e){
    		$name=&$e['itemtype'];
    		if(!isset($u1[$name])){
    			$u1[$name]=$e;
    			unset($u1[$name]['itemId'],$u1[$name]['title'],$u1[$name]['img'],$u1[$name]['price'],$u1[$name]['quantity'],$u1[$name]['size']);
    		}
    			
    		$u1[$name]['goodsifno'][]=array('itemId'=>$e['itemId'],'title'=>$e['title'],'img'=>$e['img'],'price'=>$e['price'],'quantity'=>$e['quantity'],'size'=>$e['size']);
    	}
    	$item2=array_values($u1); unset($u1);
    	
    	foreach($item2 AS $key=>$val){
    			
    		foreach($val['goodsifno'] AS $key1=>$val1){
    			if($val['itemtype']==1){
    				$sum+=$val1['price'];
    			}
    			if($val['itemtype']==0){
    				$sum1+=$val1['price'];
    			}
    	
    	
    		}
    		//统计不同分单的类型的价格
    		if($val['itemtype']==1){
    			array_push($item2[$key],$sum);
    		}
    		if($val['itemtype']==0){
    			array_push($item2[$key],$sum1);
    		}
    			
    			
    	}
    	
    	//echo "<pre>";
    	//var_dump($item2);exit;
    	
    	$this->assign('orderList',$item2);
    	$this->display();
    	
    	
    }
	
	 /**
     * 打印快递单
     * 参数：订单ID，以及打印标志[print = 1]
     * Add Time 2015-5-18
     * $Author Wenhao $
     */
    public function print_kdd(){
    	
		//实例化对象
		$dey = M('delivery');
		$item = M('item_order');
		$ftemp = M('ftemp');
		$addr = M('address');
		
		//获取ID
		$id = $this->_get('order_id', 'trim');
		
		//获取物流列表
		$kd = $dey->field("id,name")->select();
		//收货人信息
		$com_info = $item->field('id,orderId,address_name,address,mobile')->where(array('id'=>$id))->find();
		//发货人信息
		$fh = $addr->where('status=1')->select();
		//var_dump($fh);exit;
		
		$this->assign('kd',$kd);
		$this->assign('fh',$fh);
		$this->assign('com_info',$com_info);
        $kdtemp = M('kdtemp');
        $res =  $kdtemp->where('rid='.$id)->find();
        if ($res)
        {
        	$this->assign('temp',$res);
        }
        
    	$this->display();
    	
    }
	
	/**
	* 保存快递单信息
	*
	**/
	public function print_kdd_update(){
		
		$kdtemp = M('kdtemp');
      
		if($_POST){
										
			$data['kstr'] = trim($_POST['addr1']);
            $data['rid'] = $_POST['rid'];
            
            $data['time'] = time();
            $data['kid'] = $_POST['kd'];
           $res =  $kdtemp->where('rid='.$data['rid'])->find();
            if(!$res){
                
                 if($kdtemp->add($data)){
                 
                     $this->success('保存成功');
                     
                 }else{
                 
                     $this->error('保存失败');
                 
                 }
            }else{
            
                 if($kdtemp->where(array('rid'=>$data['rid']))->save($data)!==false){
                    
                     $this->success('更新成功');
                 
                 }else{
                 
                     $this->error('更新失败');
                     
                 }
            
            }
			
			
		}
		
	}
	
    public function print_kdd_print(){
    	
		//获取ID
		$id = $this->_get('order_id', 'trim');
        $kdtemp = M('kdtemp');
        $res =  $kdtemp->where('rid='.$id)->find();
        if ($res)
        {
        	$this->assign('temp',$res);
        }
        
    	$this->display();
    	
    }
	
	 /**
     * 批量打印订单
     */
    public function batchprint() {
    	
    	$idarr = $_POST['id'];
    	
    	//判断是否选择打印的订单
    	if(count($idarr)==0){
    		
    		$this->error('请选择需要打印的订单');
    		
    	}
    	
    	$ids = implode(',', $idarr);
    	$map['a.id'] = array('in',$ids);

    	$orderList = M('item_order')
    	->field('a.*,b.itemId,b.title,b.img,b.price,b.quantity,b.size,b.itemtype,b.idcname,b.idcnum,b.idczimg,b.idcfimg,b.sigsumprice')
    	->join('a left join weixin_order_detail b ON a.orderId=b.orderId')
    	->where($map)
    	->select();
    	
    	$u1=array();
    	foreach($orderList as $k=>&$e){
    		$name=&$e['orderId'];
    		if(!isset($u1[$name])){
    			$u1[$name]=$e;
    			unset($u1[$name]['itemId'],$u1[$name]['title'],$u1[$name]['img'],$u1[$name]['price'],$u1[$name]['quantity'],$u1[$name]['size'],$u1[$name]['sigsumprice']);
    		}
    			
    		$u1[$name]['goodsifno'][]=array('itemId'=>$e['itemId'],'title'=>$e['title'],'img'=>$e['img'],'price'=>$e['price'],'quantity'=>$e['quantity'],'size'=>$e['size'],'sigsumprice'=>$e['sigsumprice']);
    	}
    	$orderList = array_values($u1); unset($u1);
    	
    	//echo "<pre>";
    	//var_dump($orderList);exit;
    	$this->assign('orderList',$orderList);
    	$this->display();
    	
    }
    
}