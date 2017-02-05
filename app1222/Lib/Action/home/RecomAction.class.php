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
	
	public function posid(){
		$posid = $this->_post('posid','trim');
		$url = "http://api.map.baidu.com/geocoder/v2/?ak=Aclg79s6C7oXzoH4zjdKtwvS4IXG7HmH&callback=renderOption&output=json&location={$posid}";
		$data = file_get_contents($url);
		$domain = strstr($data, '{');
		$datas = rtrim($domain,')');
		$res = json_decode($datas);
		$array = json_decode(json_encode($res), true);
		echo json_encode(array('address'=>$array['result']['formatted_address']));
	}

	public function index(){
		//显示上级邀请人 
		$recom_id=explode('-',$this->_get('state'));
		$share_auth = M('user')->where(array('id'=>$recom_id[1]))->find();
		$this->assign('share_data',$share_auth);
       	$this->assign('defuname',$this->visitor->info['username']);
        //找出全部的满99的商家
        $where['userId'] = $this->visitor->info['id'];
        $where['status'] = array('in',array('2','3','4'));
        $where['goods_sumPrice'] = array('egt',99);
        $where['add_time'] = array('gt',1480262400);
        $satisfy = M('item_order')->where($where)->distinct(true)->field('shopid')->select();
        $higher  = array();
        foreach($satisfy as $key => $val){
            $higher[] = M('user')->where(array('id'=>$val['shopid']))->field('id,username,shares_tree')->find();
        }
        $higher  = array();
        foreach($satisfy as $key => $val){
            $higher[] = M('user')->where(array('id'=>$val['shopid']))->field('id,username,shares_tree')->find();
        }
        //dump($satisfy);die;
        $this->assign('higher',$higher);
		$apply = $this->_mod->where(array('userid'=>$this->visitor->info['id']))->find();
		if (IS_AJAX) {
			$userinfo = urldecode($this->_post('userinfo','trim'));
			$username = $this->_post('username','trim');
			$phone_mob = $this->_post('phone_mob','trim');
			$address = $this->_post('address','trim');
			$wxname = $this->_post('wxname','trim');
			$info = explode('&',$userinfo);
			foreach ($info as $key => $value) {
				$list = explode('=', $value);
				$data[$list[0]] =$list[1];
			}
			//避免重复提交申请
			if($apply['part']==1 && !empty($apply)){
				$ret = array('title'=>'提交申请失败!','msg'=>'您已经提交过申请,进入会员中心可根据页面提示进行支付！','code'=>1,'url'=>'index.php?m=User&a=index');
				echo json_encode($ret);
				exit;
			}else{
				// 判断分享者等级
                if($data['juese']==2){  //经纪人
                    if(!is_array($satisfy)){
                        $ret = array('title'=>'提交申请失败!','msg'=>'条件不足','code'=>2);
                        echo json_encode($ret);
                        exit;
                    }
                    $recom = $this->_user->where(array('id'=>$data['shangji']))->field('uid,shares,username,wechatid,recom')->find();
                    //如果在经纪人店铺成为经纪人，则上级为店铺的上级店长	
                     if($recom['uid']==5){
                        if($recom['recom']!=0){
                            session('shares',$recom['recom']);
                            $recom = $this->_user->where(array('id'=>$recom['recom']))->field('uid,shares,username,wechatid')->find();
                        }else{
                            session('shares',$recom['shares']);
                            $recom = $this->_user->where(array('id'=>$recom['shares']))->field('uid,shares,username,wechatid')->find();
                        }
                    }else{
                        session('shares',$data['shangji']);
                    }

                    $part = 3;//3是经纪人
                    $data['hq_status']   = 1; //总部默认通过
                }else{

					session('shares',$data['shangji']);
                    $recom = $this->_user->where(array('id'=>$_SESSION['shares']))->field('uid,shares,username,wechatid,recom')->find();
                    //如果在经纪人店铺成为店长，则上级为店铺的上级	
                     if($recom['uid']==5){
                        if($recom['recom']!=0){
                            session('shares',$recom['recom']);
                            $recom = $this->_user->where(array('id'=>$recom['recom']))->field('uid,shares,username,wechatid')->find();
                        }else{
                            session('shares',$recom['shares']);
                            $recom = $this->_user->where(array('id'=>$recom['shares']))->field('uid,shares,username,wechatid')->find();
                        }
                    }

                    $part  = 1;//1是店长
                }

                $sta = 0;
                $team_id = $_SESSION['shares'];
                for($i=0;$i<20;$i++){
                    $team = $this->_user->where(array('id'=>$team_id))->field('uid,id,username,shares,shares_tree')->find();
                    $ids = explode('|',$team['shares_tree']);
                    $num = count($ids);
                    if($team['uid']==2){
                        $sta+=1;
                        if($sta==3 || $team['shares']==0){
                            break;
                        }else{
                            $team_id = $ids[$num-2];
                        }
                    }else{
                        $team_id = $ids[$num-2];
                    }
                }

                //echo json_encode($team);die;

				if($recom['uid'] == 3){
					$data['shares'] = $team['id'];
					$data['recom']  = $_SESSION['shares'];
				    if($part==1){
						$recoms = $this->_user->where(array('id'=>$recom['shares']))->field('username,wechatid')->find();
						if(!is_array($recoms)){
							$ret = array('title'=>'提交申请失败!','msg'=>'无法获取分享者上级信息','code'=>2);
							echo json_encode($ret);
							exit;
						}
				   }
				}else{
					$data['shares'] = $team['id'];
                    $data['recom']  = $_SESSION['shares'];
				}

				$dingdanhao 		 = date("m-dH-i-s");
		   		$dingdanhao 		 = str_replace("-","",$dingdanhao);
		   		$dingdanhao 		.= rand(1000,2000);
		   		$data['orderid'] 	 = $dingdanhao;
				$data['merchant']	 = $this->visitor->info['username']."的进口优选商城";
				$data['m_desc']		 = "团洋范,百分百原装正品";
				$data['add_time'] 	 = time();
				$data['userid']		 = $this->visitor->info['id'];
				$data['shares_name'] = $team['username'];
				$data['shares_tree'] = '-'.$this->get_tree($_SESSION['shares']);
                $data['part']        = $part;
				//判断数据库中是否存在该用户申请经纪人的记录
				$is_exts = $this->_mod->where(array('userid'=>$this->visitor->info['id'],'part'=>3))->find();
				if(!$is_exts){
					$res = $this->_mod->add($data);
				}
				 if ($res !== false) {
					// 实例化微信信息通知类
					$wxsend = new Wxsend();
					// 生成会员费用订单号和支付链接
                     if($part==1){
							$wxdata = array(
									"text"=>'亲爱的饭团'.$recom['username']."您好，您有新店长提交了申请",
									"username"=>$username,
									"wxname"=>$wxname,
									"phone_mob"=>$phone_mob
							);
                            $pay = M('user_category')->where(array('id'=>3))->find();
                            $wxconfig=$this->wxconfig();
                            $ip = get_client_ip();//获取ip
                            $url = "api/wxpay/js_api_call.php?ip=".$ip."&partner=".$wxconfig['partnerid']."&out_trade_no=".$dingdanhao."&body=".$dingdanhao."&total_fee=".$pay['upgrade']."&notify_url=".$wxconfig['notify_url']."&showwxpaytitle=1";
                            $_SESSION['pay_url'] = $url;
                            $ret = array('title'=>'提交申请成功!','msg'=>'审核信息我们将会通过微信公众号告知您！','code'=>1,'url'=>$url);
                       }else{
						   $wxdata = array(
									"text"=>'亲爱的饭团'.$recom['username']."您好，您有新经纪人提交了申请",
									"username"=>$username,
									"wxname"=>$wxname,
									"phone_mob"=>$phone_mob
							);
							//申请经纪人后，更新user表中的信息
                            $udata['shares'] = $_SESSION['shares'];
                            $udata['shares_tree'] = $data['shares_tree'];
                            $udata['password'] = md5(123456);
							$udata['uid'] = 5;
							$udata['merchant'] = $this->visitor->info['username']."的进口优选商城";
							$udata['m_desc'] = "团洋范,百分百原装正品";
							$udata['phone_mob'] = $phone_mob;
                            $ure = $this->_user->where(array('id'=>$this->visitor->info['id']))->save($udata);
                            if($ure !== false){
                                $ret = array('title'=>'提交申请成功!','msg'=>'您已成为经纪人，代理后台默认登录密码为123456，为了您的账号安全,请登录后修改！','code'=>1,'url'=>'index.php?m=User&a=index');
                            }
                        }
				}else{
					$ret = array('title'=>'提交申请失败!','msg'=>'请重新提交申请','code'=>2);
				}
			}
			$wxsend->dlsq($recom['wechatid'],$wxdata);
			echo json_encode($ret);
		}else{
			if ($this->visitor->info['shares'] != 0 && $apply['part'] != 1 && $_GET['user']!=1) {
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
			if($_GET['user']==1){
                $home = $this->_mod->where(array('userid'=>$this->visitor->info['id']))->field('phone_mob,address,wxname,shares_name,recom,shares')->find();
                $this->assign('phone_mob',$home['phone_mob']);
                $this->assign('address',$home['address']);
                $this->assign('wxname',$home['wxname']);
                if($home['recom']!=0){
                    $this->assign('shares',$home['recom']);
                }else{
                    $this->assign('shares',$home['shares']);
                }

                $this->assign('shares_name',$home['shares_name']);
            }
			$this->display();
		}
	}
	
	//递归获取结构树
	public function get_tree($shares){
		static $tree = "";
		$user = $this->_user->where(array("id"=>$shares))->field("id,uid,shares_tree")->find();
		$sharesArr = explode('|',$user['shares_tree']);
		$num = count($sharesArr);
		if($user['uid']<4){
			if(empty($tree)) {
				$tree = "|".$user["id"]."|-";
			}else{
				$tree = "|".$user["id"].$tree;
			}
			if($num >= 3){
				$this->get_tree($sharesArr[$num-2]);
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