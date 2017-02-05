<?php
/** 
 *   会员申请开店
 *   @author  vany
 *   date    2015-12-2 
 *       
 */
class RecomAction extends frontendAction {
	
	public function _initialize(){
		parent::_initialize();
		$this->_user = M('user');
		$this->_mod = M('user_apply');
	}

	public function index(){
		
		//显示上级邀请人 
		$recom_id=explode('-',$this->_get('state'));
		$share_auth = M('user')->where(array('id'=>$recom_id[1]))->find();
		$this->assign('share_data',$share_auth);

		if (IS_AJAX) {
			$userinfo = urldecode($this->_post('userinfo','trim'));
			$info = explode('&',$userinfo);
			foreach ($info as $key => $value) {
				$list = explode('=', $value);
				$data[$list[0]] =$list[1];
			}
			//避免重复提交申请
			if(is_array($this->_mod->where(array('userid'=>$this->visitor->info['id']))->find())){
				$ret = array('title'=>'提交申请失败!','msg'=>'您已经提交过申请,进入会员中心可根据页面提示进行支付！','code'=>2);
			}else{
				// 判断分享者等级
				$recom = $this->_user->where(array('id'=>$_SESSION['shares']))->field('uid,shares,username,wechatid')->find();
				if ($recom['uid'] == 3) {
					$data['shares'] = $recom['shares'];
					$data['recom']  = $_SESSION['shares'];
					$recom = $this->_user->where(array('id'=>$recom['shares']))->field('username,wechatid')->find();
					if(!is_array($recom)){
						$ret = array('title'=>'提交申请失败!','msg'=>'无法获取分享者上级信息','code'=>2);
						echo json_encode($ret);
						exit;
					}
				}else{
					$data['shares'] = $_SESSION['shares'];
				}
				$dingdanhao 		 = date("m-dH-i-s");
		   		$dingdanhao 		 = str_replace("-","",$dingdanhao);
		   		$dingdanhao 		.= rand(1000,2000);
		   		$data['orderid'] 	 = $dingdanhao;
				$data['merchant']	 = $this->visitor->info['username']."的免税仓";
				$data['m_desc']		 = "团洋范,百分百原装正品";
				$data['add_time'] 	 = time();
				$data['userid']		 = $this->visitor->info['id'];
				$data['shares_name'] = $recom['username'];
				$data['shares_tree'] = $this->get_tree($_SESSION['shares']);
				$res = $this->_mod->add($data);
				if ($res !== false) {
					// 实例化微信信息通知类
					$wxsend = new Wxsend();
					$data = '尊敬的'.$recom["username"].',您收到了一个新代理申请,详情请点击菜单-卖家-【查看代理商】.';
					$wxsend->KF_M($recom['wechatid'],$data);
					// 生成会员费用订单号和支付链接
					$pay = M('user_category')->where(array('id'=>3))->find();
					$wxconfig=$this->wxconfig();
					$ip = get_client_ip();//获取ip
					$url = "api/wxpay/js_api_call.php?ip=".$ip."&partner=".$wxconfig['partnerid']."&out_trade_no=".$dingdanhao."&body=".$dingdanhao."&total_fee=".$pay['upgrade']."&notify_url=".$wxconfig['notify_url']."&showwxpaytitle=1";
					$_SESSION['pay_url'] = $url;
					$ret = array('title'=>'提交申请成功!','msg'=>'审核信息我们将会通过微信公众号告知您!','code'=>1,'url'=>$url);
				}else{
					$ret = array('title'=>'提交申请失败!','msg'=>'请重新提交申请','code'=>2);
				}
			}
			echo json_encode($ret);
		}else{
			if ($this->visitor->info['shares'] != 0) {
			  	$this->error('您已经存在上级!',U('User/index'));
			  	exit;
			}
			$uid = $this->_get('state','trim');
			$list = explode("-",$uid);
			if (!$list[1]) {
				$info="您没有权限";
			}else{
				if ($this->visitor->info['id'] == $list[1]) {
					$this->redirect('User/index');
					exit;
				} 
				$up = $this->_user->where(array('id'=>$list[1]))->field('uid')->find();
				if ($up['uid'] == 4) {
					$this->error('参数无效,请重新向上级获取!');
					exit;
				}
				$_SESSION['shares'] = $list[1];
			}
			$ad = M('ad')->where(array('board_id'=>6))->find();
			$this->assign('ad',$ad);
			$this->display();
		}
	}
	//递归获取结构树
	public function get_tree($shares){
		static $tree = "";
		$user = $this->_user->where(array("id"=>$shares))->field("id,uid,shares")->find();
		if($user["uid"] > 1){
			if (empty($tree)) {
				$tree = "|".$user["id"]."|-";
			}else{
				$tree = "|".$user["id"].$tree;
			}
			$this->get_tree($user["shares"]);
		}else{
			if (empty($tree)) {
				$tree = "-|".$user["id"]."|-";
			}else{
				$tree = "-|".$user["id"].$tree;
			}
		}
		return $tree;
	}

	/**
	*@wxpay config
	* 微信基本配置
	*/
	public function wxconfig(){
		$wxpay=M('pay')->where(array('pay_type'=>'wxpay'))->find();
		$wxpayconfig=unserialize($wxpay['config']);
		//var_dump($wxpayconfig);exit;
		$wxpobj['appId'] = $wxpayconfig['appid'];
		$wxpobj['appsecret'] = $wxpayconfig['appsecret'];
		$wxpobj['signkey'] = $wxpayconfig['signkey'];
		$wxpobj['partnerid'] = $wxpayconfig['partnerid'];
		$wxpobj['partnerkey'] = $wxpayconfig['partnerkey'];
		$wxpobj['notify_url']="http://".$_SERVER['SERVER_NAME'].__ROOT__."/api/wxpay/notifyurl.php";
		$wxpobj['signType'] = 'SHA1';
		$wxpobj['bank_type'] = 'WX';
		$wxpobj['fee_type'] = '1';
		$wxpobj['spbill_create_ip']=get_client_ip();
		$wxpobj['input_charset']='UTF-8';
		return $wxpobj;
	}
}
?>