<?php 
		
class coupon_templetAction extends backendAction {
	
	public function _initialize() {
		parent::_initialize();
		$this->_mod = D('coupon_templet');
	}										
	
	/**
	* 显示优惠券列表管理
	*/
	public function index(){
		
		$coupon = M('coupon_templet');
		$user_coupon = M('user_coupon');
		
		$sort ='id';
		$order = 'desc';
		if($_GET['sort']&&$_GET['order']){
			$sort = $this->_get("sort", 'trim');
			$order = $this->_get("order", 'trim');
		}
		
		
		if($_GET['keyword']){
			$where['title|desc|disPrice|condition']=array('like','%'.$_GET['keyword'].'%');
			$where['is_delete'] = 0; //未被删除
			$list=$coupon->order($sort.' '.$order)->where($where)->select();
			$this->assign('search',$_GET['keyword']);
		}else{
			$list = $coupon->order($sort.' '.$order)->where(array('is_delete'=>0))->select();
		}
		$count =count($list);
		$pager = new Page($count,20);
		$lists=array_slice($list, $pager->firstRow,$pager->listRows);
		$page = $pager->show();
		$this->assign("page", $page);
		$this->assign('list_table', true);
		$this->assign('lists',$lists);
		
		$this->display();
	}
	
	/**
	 * 添加优惠券
	 */
	public function add(){
		if($_POST){
			if($_POST['kind']==2){
				if($_POST['cate_id']==''){
					$this->error('当前选择为品类券，请选择可用品类');
				}
			}
			$coupon=M('coupon_templet');
			$cateIds = $_POST['cate_id'];
			$data['cate_ids'] = implode('|',$cateIds);
			$data['title'] = trim($_POST['title']);
			$data['desc'] = trim($_POST['desc']);
			$data['num'] = trim($_POST['num']);
			$data['kind'] = trim($_POST['kind']);
			$data['disPrice'] = trim($_POST['disPrice']);
			$data['exchangeCond'] = trim($_POST['exchangeCond']);
			$data['is_recom'] = trim($_POST['is_recom']);
			$data['condition'] = trim($_POST['condition']);
			$data['start_time'] = strtotime(trim($_POST['start_time']));
			$data['end_time'] = strtotime(trim($_POST['end_time']));
			$data['days'] = trim($_POST['days']);
			//插入数据
			if($coupon->data($data)->add() !== false){
				$this->success('优惠券生成成功',U('coupon_templet/index'));
			}else{
				$this->error('优惠券生成失败');
			}
		}else{
			$item_cate = M('item_cate');
			$cates = $item_cate->where(array('pid' => 0))->field('id,name')->select();
			$this->assign('cates',$cates);
			$this->display();
		}
	}
	
	/**
	 * 删除优惠码
	 */
	public function del(){
	
		// 实例化对象
		$coupon = M('coupon_templet');
	
		//获取ID
		$id = $this->_get('id', 'trim');
		$data['is_delete'] = 1; //已被删除
		if($coupon->where('id='.$id)->save($data) !== false){
			$this->success('删除成功', U('coupon_templet/index'));
		}else{
			$this->error('删除失败');
		}
	
	}
		
	/**
	 * 批量删除优惠码
	 */
	public function dels(){
	
		// 实例化对象
		$coupon = M('coupon_templet');
		//接收ID，Array
		$id = $_POST['id'];
		//预处理，防止无参数数删除数据
		$count = count($id);
		if($count<=0){
			$this->error('非法操作，请选择删除的记录');
		}
		//批量删除
		$ids = implode(',', $id);
		$data['is_delete'] = 1;
		if($coupon->where(array('id'=>array('in',$ids)))->save($data)!== false){
			$this->success('删除成功', U('coupon_templet/index'));
		}else{
			$this->error('删除失败');
		}
	}
	
	
	/**
	 * 编辑优惠券
	 */
	public function edit(){
		$coupon=M('coupon_templet');
		if($_POST){
			if($_POST['kind']==2){
				if($_POST['cate_id']==''){
					$this->error('当前选择为品类券，请选择可用品类');
				}
			}
			$where['id'] = trim($_POST['id']);
			$cateIds = $_POST['cate_id'];
			$data['cate_ids'] = implode('|',$cateIds);
			$data['title'] = trim($_POST['title']);
			$data['desc'] = trim($_POST['desc']);
			$data['kind'] = trim($_POST['kind']);
			$data['exchangeCond'] = trim($_POST['exchangeCond']);
			$data['is_recom'] = trim($_POST['is_recom']);
			$data['num'] = trim($_POST['num']);
			$data['disPrice'] = trim($_POST['disPrice']);
			$data['condition'] = trim($_POST['condition']);
			$data['start_time'] = strtotime(trim($_POST['start_time']));
			$data['end_time'] = strtotime(trim($_POST['end_time']));
			$data['days'] = trim($_POST['days']);
			//插入数据
			if($coupon->where($where)->save($data) !== false){
				$this->success('优惠券更新成功',U('coupon_templet/index'));
			}else{
				$this->error('优惠券更新失败');
			}
		}else{
			//获取当前对象ID
			$id = $this->_get('id', 'trim');
			$res = $coupon->where('id='.$id)->find();
			$cate_ids = explode('|',$res['cate_ids']);
			$item_cate = M('item_cate');
			$cates = $item_cate->where(array('pid' => 0))->field('id,name')->select();
			$this->assign('cates',$cates);
			$this->assign('res',$res);
			$this->assign('cate_ids',$cate_ids);
			$this->display();
		}
	}
	
	/**
	 * 查看持券用户
	 */
	public function user(){
		$id = trim($_GET['id']);
		
		$coupon = M('coupon_templet');
		$couponDetail = $coupon->where(array('id'=> $id))->field('title')->find();
		$this->assign('couponDetail',$couponDetail);
		if($_GET['keyword']){
			$where['c.id|c.username|b.orderId']=array('like','%'.$_GET['keyword'].'%');
			$where['a.id'] = $id;
			$this->assign('search',$_GET['keyword']);
		}else{
			$where['a.id'] = $id;
		}
		
		$user = M('coupon_templet')->join('a left join weixin_user_coupon b on b.couponId=a.id left join weixin_user c on c.id=b.userId')
								   ->where($where)
								   ->field('c.id,c.username,b.status,b.orderId,a.end_time')
								   ->select();
		$this->assign('time',time());
		$count =count($user);
		$pager = new Page($count,20);
		$lists=array_slice($user, $pager->firstRow,$pager->listRows);
		$page = $pager->show();
		$this->assign("page", $page);
		$this->assign('list_table', true);
		$this->assign('user',$lists);
		$this->display();
	}
	
	
	/**
	 * 发放优惠券
	 */
	public function send_coupon(){
		if($_POST){
			$userId = $_POST['userId'];		
			$id = $_POST['coupon_templetId'];
			$userCoupon = M('user_coupon');
			$user = M('user');
			
			$data['couponId'] = $id;
			
			if($_POST['class']==1){//向个别用户发放优惠券
				if($userId==''){
					$this->error('请填写用户');
				}
				$userIds = explode(',',$userId);
				$data['status'] = 0;
				foreach($userIds as $key => $val){
					$user_id=$user->where(array('id'=>$val))->getField('id');
					if($user_id){//用户真实存在
						$ct = M('coupon_templet')->where(array('id'=>$id))->field('num,count')->find();
						if($ct['num']>$ct['count']){//优惠券有余量
							$data['userId'] = $val['id'];
							$list=$userCoupon->where($data)->count();
							if($list==0){//用户不持有该券
								if($userCoupon->add($data)==false){
									$this->error('发放优惠券失败',U('coupon_templet/index'));
								}
								M('coupon_templet')->where(array('id'=>$id))->setInc('count',1);
							}
						}else{
							$this->error('该优惠券已经发放完啦',U('coupon_templet/index'));
						}
					}
				}
			}else if($_POST['class']==2){//向个全部用户发放优惠券，时间消耗大
				$users=$user->field('id')->select();
				if($users){
					$data['status'] = 0;
					foreach($users as $key=>$val){
						$ct = M('coupon_templet')->where(array('id'=>$id))->field('num,count')->find();
						if($ct['num']>$ct['count']){
							$data['userId'] = $val['id'];
							$list=$userCoupon->where($data)->count();
							if($list==0){//用户不持有该券
								if($userCoupon->add($data)==false){
									$this->error('发放优惠券失败',U('coupon_templet/index'));
								}
								M('coupon_templet')->where(array('id'=>$id))->setInc('count',1);
							}
						}else{
							$this->error('该优惠券已经发放完啦',U('coupon_te/index'));
						}
					}
				}
				
			}else if($_POST['class']==3){//向个某个时间段注册的用户发放优惠券，时间消耗大
				$where['reg_time']=array('between',array(strtotime($_POST['start']),strtotime($_POST['end'])));
				$users=$user->where($where)->field('id,username')->select();
				if($users){
					$data['status'] = 0;
					foreach($users as $key=>$val){
						$ct = M('coupon_templet')->where(array('id'=>$id))->field('num,count')->find();
						if($ct['num']>$ct['count']){
							$data['userId'] = $val['id'];
							$list=$userCoupon->where($data)->count();
							if($list==0){//用户不持有该券
								if($userCoupon->add($data)==false){
									$this->error('发放优惠券失败',U('coupon_templet/index'));
								}
								M('coupon_templet')->where(array('id'=>$id))->setInc('count',1);
							}
						}else{
							$this->error('该优惠券已经发放完啦',U('coupon_templet/index'));
						}
					}
				}else{
					$this->error('该时间段没有新用户注册');
				}
			}
			$this->success('发放优惠券成功',U('coupon_templet/index'));
		}else{
			$coupon = M('coupon_templet');
			$list = $coupon->order('id desc')->where(array('status'=>0))->field('id,title')->select();
			$this->assign('list',$list);
			$this->display();
		}
	}
}

			
