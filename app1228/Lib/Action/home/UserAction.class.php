<?php

class UserAction extends userbaseAction {

    public function _initialize(){
        parent::_initialize();
        $this->_mod = D('user');
    }

       public function ajaxlogin()
    {

       $user_name=$_POST['user_name'];
       $password=$_POST['password'];

       $user=M('user');
       $users= $user->field('id,username')->where("username='".$user_name."' and password='".md5($password)."'")->find();
       if (is_array($users)) {
           $_SESSION['user_info'] = $user;
       }
       $data = array('status'=>$users['status']);
       echo json_encode($data);
       exit;
    }
	
	public function activity_end(){
		$this->display();
	}
	
	//访问统计
	public function flow_history(){
		$uid = $this->visitor->info['id'];
		$iuser = M('user');
		$iflow = M('flow_history');
		$flow_list = $iflow->where(array('view_shopid'=>$uid))->order('view_time desc')->select();
		foreach($flow_list as $key => $val){
			$uinfo = $iuser->where(array('id'=>$val['userid']))->find();
			$flow_list[$key]['username'] = $uinfo['username'];
			$flow_list[$key]['cover'] = $uinfo['cover'];
			$flow_list[$key]['uid'] = $uinfo['uid'];
		}
		$this->assign('flow_list',$flow_list);
		$this->assign('flow_count',count($flow_list));
		$this->display();
	}
	
	//我的二维码
	public function store_qrcode(){
		$uid = $this->visitor->info['id'];
        $uinfo = M('User')->where('id='.$uid)->find();
		$this->assign('uinfo',$uinfo);
		$this->display();
	}
	
	public function open_shop(){
        //消费者升级为店长
        $res =M('user')->where(array('id'=>session('shopid')))->field('id,uid,username')->find();
        $appid = D('setting')->where(array('name'=>'appid'))->find();
        $appid = trim($appid['data']);
        $redirect_uri = "http://".$_SERVER['SERVER_NAME']."/index.php?m=Weixin&a=getauth";
        $redirect_uri = urlencode($redirect_uri);
        $scope = "snsapi_userinfo";
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=id-".$res['id']."#wechat_redirect";
        //是否满足申请经纪人条件
        $where['userId'] = $this->visitor->info['id'];
        $where['status'] = array('in',array('2','3','4'));
        $where['goods_sumPrice'] = array('egt',99);
        $where['add_time'] = array('gt',1480262400);
        $satisfy = M('item_order')->where($where)->select();
        $apply_uid = $this->visitor->info['uid'];
        if(IS_AJAX){
            $application = $this->_post('application');

            if($application == 'shares'){  //经纪人     code中0代表不符合条件
                 if(in_array($apply_uid,array(2,3,5))){
                     $ret = array('title'=>'开店提示','content'=>'您已经成为「团洋范」代理商，您可以将此页面转发给好友或分享至朋友圈！','btn'=>'我知道了','code'=>0,'share'=>1);
                 }else{
                     if(count($satisfy)>0){
                         $ret = array('url'=>$url,'code'=>1);
                     }else{
                         $ret = array('title'=>'开店提示','content'=>'您不符合成为「经纪人」的条件，在商城消费满99元即可申请成为经纪人哦','btn'=>'我知道了','code'=>0);
                     }
                 }
                echo json_encode($ret);
                exit;
            }else{   //店长
                if(in_array($apply_uid,array(2,3))){
                    $ret = array('title'=>'开店提示','content'=>'您已经成为「团洋范」代理商，您可以将此页面转发给好友或分享至朋友圈！','btn'=>'我知道了','code'=>0,'share'=>1);
                }else{
                    $ret = array('url'=>$url,'code'=>1);
                }
                echo json_encode($ret);
                exit;
            }

        }
        $this->display();
    }

    /**
    * 授权证书
    */
    public function shouquan(){
        $id = $this->visitor->info['id'];
        $info = M('User')->where('id='.$id)->find();
        if($info['uid']==2){
            $this->assign('dengji','掌柜');
        }elseif($info['uid']==3){
            $this->assign('dengji','店长');
        }elseif($info['uid']==5){
            $this->assign('dengji','经纪人');
        }
        $this->assign('info',$info);
        $this->display();
    }
	
	public function dec_rule(){
		
		//根据跳转来源显示
		$desc = $this->_get('desc','trim');
		switch($desc){
			
			case 'renqi':
			$desc = '人气店铺';
			break;
			
			case 'huangguan':
			$desc = '皇冠商家';
			break;
			
			case 'jinpai':
			$desc = '金牌服务';
			break;
			
			case 'wangpai':
			$desc = '王牌掌柜';
			break;
		}
		
		$this->assign('desc',$desc);
		$this->display();
	}
	

	
	//清空消息记录
	public function clear_msg(){
		//4=确认收货 3=待结算 2=新进代理 1=发货通知
		$id = $this->_get('id','trim');
		$where['type'] = $id;
		$where['recom'] = $this->visitor->info['id'];
		M('messagelist')->where($where)->delete();
		$this->redirect('User/information_class',array('id'=>$id));
	}
	
	//店铺销售额
	public function sales_list(){
		$uid = $this->visitor->info['uid']; //获取会员组
		$isales = M('item_order');
		$idetail = M('order_detail');
		$iuser = M('user');
		$where['a.status'] = array('in','2,3,4');
		$where['a.shopid'] = $this->visitor->info['id'];
		
		$sales_list = M('item_order')
        ->join("a left join weixin_order_detail as b on a.orderId = b.orderId")
        ->field("a.*,b.price,b.quantity,b.id as odId")
        ->where($where)
        ->select();
		
		foreach($sales_list as $key => $val){
			$order_sumPrice += $val['price']*$val['quantity'];
			$order_detail  = $idetail
			->where(array('id'=>$val['odId']))
			->field('profit,img,title,price,quantity,orderId,fencheng,id')
			->find();
			$profit_count = M('order_detail')->where(array('id'=>$order_detail['id']))->sum('profit');
			if($val['add_time']>1480298400){
				$margin = M('user_fengchenglv')->where(array('id'=>$uid))->getField('royalty');
			}else{
				$margin = 0.4;
			}
            $profit = $profit_count * $margin;
			$userinfo  = $iuser->where(array('id'=>$val['userId']))->getField('username');
			$profit_sum += $profit;
			$order_arr[] = $order_detail;
			$order_arr[$key]['add_time'] = $val['add_time']; 
			$order_arr[$key]['profit'] = round($profit,2);
			$order_arr[$key]['uname'] = $userinfo;
		}
		
		$this->assign('order_list',$order_arr);
		$this->assign('profit_sum',round($profit_sum,2));
		$this->assign('order_sumPrice',$order_sumPrice);
		$this->display();
	}
	
	public function redbag_weixin(){
		$where['recom'] = $this->visitor->info['id'];
		$where['is_share'] = 1;
		$is_share = M('messagelist')->where($where)->find();
		if($is_share){
			echo "<script>alert('您已经领取过该红包！');location.href='index.php?m=Index&a=index&shares={$_SESSION['shopid']}'</script>";
			exit;
		}
		$this->display();
	}
	
	public function redbag_weixindo(){
		$points = $this->_post('points','trim'); //随机红包数额
		$message = M('messagelist');
		$message->user_id = $_SESSION['shopid'];
		$message->recom = $this->visitor->info['id']; //用户id
		$message->type = 8; //红包奖励积分
		$message->order_id =0; //订单id
		$message->time = time();
		$message->status = 0; // 默认未读状态
		$message->points = $points;
		$message->is_share = 1; //是否已经获取了赠送的红包
		if($message->add()){
			M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$points);
		}
	}
    
    public function comment_success(){
        $comm_list = M('item_order')
        ->join("a left join weixin_order_detail as b on a.orderId = b.orderId")
        ->field("a.*,b.*")
        ->where(array('a.userId'=>$this->visitor->info['id'],'a.c_status'=>0,'b.c_status'=>0,'a.status'=>4))
        ->select();
        $this->assign('comm_list',$comm_list);
        $this->display();
    }
	
	
    
    public function submit_success(){
        $this->display();
    }
    
    public function redbag_over(){
        $this->display();
    }
    
    public function redbag_share(){
        //范票余额
		$uid = $this->visitor->info['id'];
        $point_yuer = M('user')->where(array('id'=>$uid))->getField('points');
		
		$uinfo = M('user')->where(array('id'=>$uid))->field('username,is_freeze')->find();
        $this->assign('point_yuer',$point_yuer);
        $this->assign('uinfo',$uinfo);
        $this->display();
    }
	
	//单个红包
	public function redbag_one(){
		$uid = $this->visitor->info['id'];
        $point_yuer = M('user')->where(array('id'=>$uid))->getField('points');
		
		$uinfo = M('user')->where(array('id'=>$uid))->field('username,is_freeze')->find();
        $this->assign('point_yuer',$point_yuer);
        $this->assign('uinfo',$uinfo);
        $this->display();
	}
	
	public function redbag_onedo(){
		$point_yuer = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('points');
        $points = $this->_post('points','trim'); //范票数
        $message = $this->_post('message','trim'); //红包附言
		
		if($points > 1000){
			$this->error('范票张数不可超过1000张！');
			exit;
		}
		
		if($points > $point_yuer){
			$this->error('您输入的范票数高于您的账户范票总额！');
		}
		
        $redPackets = M('red_packets');
		$data['bag_type'] = 1;
        $data['userId'] = $this->visitor->info['id'];
        $data['content_cate'] = 0;
        $data['content'] = $points;
		$data['allpoint'] = $points;
		if($message == ''){
			 $data['message'] = '真诚奉献，分享快乐信念';
		}else{
			$data['message'] = $message;
		}
        $data['status'] = 0;
        $data['source'] = 2; //范票放进红包
        $data['start_time'] = time();
        $data['orderId'] = 0;
		if($redPackets->add($data)){
            $message = M('messagelist');
            $message->user_id = $this->visitor->info['id']; //用户id
            $message->recom = $this->visitor->info['id']; //用户id
            $message->type = 10; //范票分享
            $message->order_id =0; //订单id
            $message->time = time();
            $message->status = 0; // 默认未读状态
            $message->points = $points;
			$message->lastpoint = $point_yuer;
            $message->add();
            $del_point =  M('user')->where(array('id'=>$this->visitor->info['id']))->setDec('points',$points);
            if($del_point){
                $this->redirect('User/redbag_center');
            }
        }
		
	}
	
	public function redbag_luck(){
		 $id = $this->_get('id','trim');
		 
		  $u_source = M('red_packets')
          ->join("a left join weixin_user as b on a.userId = b.id")
		  ->where(array('a.Id'=>$id))
          ->find();
		  
		  $red_where['recom'] = $this->visitor->info['id'];
		  $red_where['pid'] =$id;
		  $red_extis = M('messagelist')->where($red_where)->select();
		  /*
			  if($u_source['content']!=0 && count($red_extis)<=0){
				  echo "<script>location.href='index.php?m=User&a=redbag_detail&sharesid={$u_source['userId']}&id={$id}'</script>";
			  }
		  */
		  
		 $luck_list = M('red_packets')
        ->join("a left join weixin_messagelist as b on a.Id = b.pid left join weixin_user c ON b.recom=c.id ")
		->field('a.Id,c.username,b.points,c.hyimg,c.cover,b.recom,b.time,a.content')
		->where(array('b.pid'=>$id))
		->order('b.time desc')
        ->select();

		$this->assign('u_source',$u_source);
		$this->assign('luck_list',$luck_list);
		$this->assign('self_id',$this->visitor->info['id']);
		$this->display();
	}
	
    
    public function redbag_sharedo(){
		//用户的范票总额
		$point_yuer = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('points');
        $points = $this->_post('points','trim'); //范票数
        $message = $this->_post('message','trim'); //红包附言
		$bag_num = $this->_post('bag_num','trim'); //红包个数

		if($bag_num <= 0){
			$this->error('红包个数不能小于0');
		}
		
		if($points > 1000){
			$this->error('范票张数不可超过1000张！');
			exit;
		}
		if($points > $point_yuer){
			$this->error('您输入的范票数高于您的账户范票总额！');
		}
        //将用户输入的范票数写进我的红包
        $redPackets = M('red_packets');
		$data['bag_type'] = 2;
        $data['userId'] = $this->visitor->info['id'];
        $data['content_cate'] = 0;
        $data['content'] = $points;
		$data['allpoint'] = $points;
		$data['bag_num'] = $bag_num;
		$data['bag_nums'] = $bag_num;
		if($message == ''){
			 $data['message'] = '真诚奉献，分享快乐信念';
		}else{
			$data['message'] = $message;
		}
        $data['status'] = 0;
        $data['source'] = 2; //范票放进红包
        $data['start_time'] = time();
        $data['orderId'] = 0;
        if($redPackets->add($data)){
			$last_id = $redPackets->getLastInsID();
            $message = M('messagelist');
            $message->user_id = $this->visitor->info['id']; //用户id
            $message->recom = $this->visitor->info['id']; //用户id
            $message->type = 10; //范票分享
            $message->order_id =0; //订单id
            $message->time = time();
            $message->status = 0; // 默认未读状态
            $message->points = $points;
			$message->lastpoint = $point_yuer;
            $message->add();
            $del_point =  M('user')->where(array('id'=>$this->visitor->info['id']))->setDec('points',$points);
            if($del_point){
				$where['Id'] = $last_id;
				$redbag_detail = M('red_packets')->where($where)->find();
				$total= $redbag_detail['content'];
				$num= $redbag_detail['bag_nums']; 
				$min=1; //每个人最少能收到1张范票
				for($i=1;$i<=$num;$i++){ 
				  $safe_total=($total-($num-$i)*$min)/($num-$i);//随机数 
				  $money=round(mt_rand($min*100,$safe_total*100)/100,0); 
				  $total=$total-$money; 
				  $arr['res'][$i] = array('i' => $i,'money' => $money,'total' => $total);
				}
				$arr['res'][$num] = array('money'=>$total,'total'=>0);
				$rand_point = $arr['res'][1]['money'];
				foreach($arr['res'] as $key => $val){
					$arrs[] = $val['money'];
				}
				$rdata['rand_point'] = implode("|",$arrs);
				$is_save = M('red_packets')->where(array('Id'=>$last_id))->save($rdata);
				if($is_save){
					$this->redirect('User/redbag_center');
				}
            }
        }
    }
    public function information_content(){
        $id = $_GET['id'];
        $where['id'] = $id;
        $status = M('messagelist')->where($where)->getField('status');
        if($status == 0){
            $data['status'] = 1;
            M('messagelist')->where($where)->save($data);
        }
        $msg = M('messagelist')->where('id='.$id)->find();
        //dump($msg);
        $this->assign('msg',$msg);
        $this->display();
    }


    public function shops_history(){
        $user_level = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('uid');
        $shops_list = M('user')
        ->join("a left join weixin_seller as b on a.id = b.shopid")
        ->field("a.*,b.*")
		->order('b.addtime desc')
		->limit(6)
        ->where(array('b.userid'=>$this->visitor->info['id']))
        ->select();
        $this->assign('shops_list',$shops_list);
        $this->assign('shops_count',count($shops_list));
        $this->assign('user_level',$user_level);
        $this->display();
    }

    public function del_shop(){
        $id = $this->_get('id');
        $where['id'] = $id;
        M('seller')->where($where)->delete();
        $this->redirect('User/shops_history');
    }

    /**
      *我的代金卷
    */
    public function daijin(){
        $dj=M('daijin');
        $data['djuser']=$this->visitor->info['id'];
        $res=$dj->where($data)->order('id desc')->select();
        $time=time();
        $this->assign('time',$time);
        $this->assign('daijin',$res);
        $this->display();
    }
    public function change_password(){
        $this->display();
    }
    public function help(){
        $this->display();
    }
    public function search(){
        $keyword = $_GET['keyword'];

        $search_history = array();
        foreach (cookie('search_history') as $key => $value) {
            $search_history[$key] = urldecode($value);
        }


        $this->assign('keyword',$keyword);
        $search_hot = M('search')->order('num desc')->select();
        $this->assign('shares',$_SESSION['shares']);
        $this->assign('hot',$search_hot);
        $this->assign('search_history',$search_history);
        //dump($search_history);
        $this->display();
    }

    public function clear_searchHistory() {
        cookie('search_history', NULL);
        setcookie ("content_keyword", "", time() - 3600);
        $this->redirect('User/search');
    }
/*    public function edit_message(){
        $id = $_GET['id'];
        $where['id'] = $id;
        $status = M('messagelist')->where($where)->getField('status');
        if($status == 0){
            $data['status'] = 1;
            M('messagelist')->where($where)->save($data);
        }
        $this->redirect('User/information_center');
    }*/
    public function del_message(){
        $id = $_GET['id'];
        $where['id'] = $id;
        M('messagelist')->where($where)->delete();

        $this->redirect('User/information_center');
    }
    
    
    //我的红包
    public function redbag_center(){
        $uid = $this->visitor->info['id'];
        $ibag = M('red_packets');
        $bag_list = $ibag->where(array('userId'=>$uid,'status'=>0))->order('id desc')->select(); //未拆开
		$bag_list1 = M('red_packets')
        ->join("a left join weixin_messagelist as b on a.Id = b.pid")
		->where(array('b.recom'=>$this->visitor->info['id']))
		->order('a.Id desc')
        ->select();
		
        $bag_list2 = M('red_packets')
        ->join("a left join weixin_user as b on a.userId = b.id")
        ->field("a.*,b.username")
        ->where(array('a.userId'=>$uid,'a.shares_status'=>2))
        ->order('id desc')
        ->select();
		
        $this->assign('bag_list',$bag_list);
        $this->assign('bag_list1',$bag_list1);
        $this->assign('bag_list2',$bag_list2);
        $this->assign('present_time',time()); //现在时间
        $this->display();
    }
	
	public function redbag_detaildo(){
		$point_yuer = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('points');
        $bagid = $this->_post('bagid','trim');
		$shares = $this->_post('sharesid','trim');
		$redbag_detail = M('red_packets')->where(array('Id'=>$bagid))->find();
		$split = explode('|',$redbag_detail['rand_point']);
		$rand_point = $split[$redbag_detail['bag_num']-1] ;
		
		if($shares == $this->visitor->info['id']){
			$data['status'] = 1;
			$data['robtime'] = time();
		}else{
			$data['shares_status'] = 2;
			$data['source'] = 1;
			$data['status'] = 1;
			$data['robtime'] = time();
		}
		
		if($redbag_detail['bag_type'] == 2){
			if($rand_point > $redbag_detail['content'] || $redbag_detail['bag_num'] <=0 || $rand_point<=0){
				echo 'rand_out';
			}else{
				$msg_data['user_id'] =$shares; //分享者id
				$msg_data['recom'] = $this->visitor->info['id']; //用户id
				$msg_data['pid'] = $bagid;
				$msg_data['type'] = 8; //红包奖励类型
				$msg_data['time'] = time();
				$msg_data['status'] = 0; // 默认未读状态
				$msg_data['points'] = $rand_point;
				$msg_data['lastpoint'] = $point_yuer;
				//判断是否重复写入
				$insr  = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'pid'=>$bagid))->find();
				if(!$insr){
					if(M('messagelist')->add($msg_data)){
						M('red_packets')->where(array('Id'=>$bagid))->save($data);
						M('red_packets')->where(array('Id'=>$bagid))->setDec('content',$rand_point);
						M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$rand_point);
						M('red_packets')->where(array('Id'=>$bagid))->setDec('bag_num');
						echo $rand_point;
					}
				}
			}
		}else{
			$rand_point = $this->_post('rand_point','trim');
			if($rand_point > $redbag_detail['content']){
				echo 1; //随机金额高于红包金额
			}else{
				$msg_data['user_id'] =$shares; //分享者id
				$msg_data['recom'] = $this->visitor->info['id']; //用户id
				$msg_data['pid'] = $bagid;
				$msg_data['type'] = 8; //红包奖励类型
				$msg_data['time'] = time();
				$msg_data['status'] = 0; // 默认未读状态
				$msg_data['points'] = $rand_point;
				$msg_data['lastpoint'] = $point_yuer;
				//判断是否重复写入
				$insr  = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'pid'=>$bagid))->find();
				if(!$insr){
					if(M('messagelist')->add($msg_data)){
						M('red_packets')->where(array('Id'=>$bagid))->save($data);
						M('red_packets')->where(array('Id'=>$bagid))->setDec('content',$rand_point);
						M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$rand_point);
					}
				}
			}
		}
	}
    
    public function redbag_detail(){
		
		$userfreeze = M('user')->where(array('id'=>$this->visitor->info['id']))->find();
		if($userfreeze['is_freeze'] == 1){
			$this->error('您的账户存在风险行为，目前已被系统冻结，无法使用红包功能！');
			exit;
		}
		
        $sharesid = $this->_get('sharesid','trim'); //分享id
        $id = $this->_get('id','trim'); //红包id
        $where['Id'] = $id;
        $uinfo = M('user')->where(array('id'=>$sharesid))->find();
        $redbag_detail = M('red_packets')->where($where)->find();
		$red_where['recom'] = $this->visitor->info['id'];
		$red_where['pid'] =$id;
		$red_extis = M('messagelist')->where($red_where)->find();
		
		if($red_extis){
			echo "<script>location.href='index.php?m=User&a=redbag_luck&shares={$_SESSION['shopid']}&id={$id}'</script>";
		}
		
		if($redbag_detail['content']<=0){
			$data['status'] = 1;
			M('red_packets')->where(array('Id'=>$id))->save($data);
			//redirect会有问题
			echo "<script>location.href='index.php?m=User&a=redbag_luck&shares={$_SESSION['shopid']}&id={$id}'</script>";
		}
		
        $this->assign('redbag_detail',$redbag_detail);
        $this->assign('bag_num',$redbag_detail['content']);
        $this->assign('uinfo',$uinfo);
        $this->assign('userid',$this->visitor->info['id']);
        $this->display();
    }
    
    
    
   public function information_center(){
        $list1 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>1))->select();
        $list2 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>2))->select();
        $list3 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>3))->select();
        $list4 = M('messagelist')->where(array('recom'=>$this->visitor->info['id'],'type'=>4))->select();
        $this->assign('list1',count($list1));
        $this->assign('list2',count($list2));
        $this->assign('list3',count($list3));
        $this->assign('list4',count($list4));
        $this->display();
    }

    public function information_class(){
        $where['recom'] = $this->visitor->info['id'];
        $where['type'] = $this->_get('id');
        $messagelist = M('messagelist')->where($where)->order('id desc')->select();
        $this->assign('messagelist',$messagelist);
        $this->assign('count',count($messagelist));
        $this->display();
    }
    public function update_shops(){
        $this->display();
    }
    /**
     * 卖家中心修改头像
     */
    public function merimg() {
        $id = $this->visitor->info['id'];
        $user_mod= M('user');

        if(IS_POST){
            if (!empty($_FILES['avatar']['name'])) {
                //会员头像规格
                $avatar_size = explode(',', C('pin_avatar_size'));
                //回去会员头像保存文件夹
                $uid = abs(intval($this->visitor->info['id']));
                $suid = sprintf("%09d", $uid);
                $dir1 = substr($suid, 0, 3);
                $dir2 = substr($suid, 3, 2);
                $dir3 = substr($suid, 5, 2);
                $avatar_dir = $dir1.'/'.$dir2.'/'.$dir3.'/';
                //上传头像
                $suffix = '';
                foreach ($avatar_size as $size) {
                    $suffix .= '_'.$size.',';
                }
                $result = $this->_upload($_FILES['avatar'], 'avatar/'.$avatar_dir, array(
                        'width'=>C('pin_avatar_size'),
                        'height'=>C('pin_avatar_size'),
                        'remove_origin'=>true,
                        'suffix'=>trim($suffix, ','),
                        'ext' => 'jpg',
                ), md5($uid));
                if ($result['error']) {
                    $this->error($result['info']);
                    return;
                } else {
                    $data = __ROOT__.'/data/upload/avatar/'.$avatar_dir.md5($uid).'_'.$size.'.jpg?'.time();
                }

                $conn = mysql_connect("localhost","root","gqjsj123654");
                mysql_select_db("tyf",$conn);
                $res=mysql_query("update weixin_user set hyimg='".$data."' where id=".$id,$conn);
                if($res){
                     $this->success('修改成功', U('User/merusername'));
                }else{
                    $this->success('系统繁忙，无法更新', U('User/merusername'));
                }

            }

            ///$this->redirect('User/merusername');

        }
    }

    /**
     * 用户登陆
     */
    public function login() {
        $this->visitor->is_login && $this->redirect('User/index');
        if (IS_POST) {
            $username = $this->_post('user_name', 'trim');
            $password = $this->_post('password', 'trim');
            $remember = $this->_post('remember');
            if (empty($username)) {
                IS_AJAX && $this->ajaxReturn(0, L('please_input').L('password'));
                $this->error(L('please_input').L('username'));
            }
            if (empty($username)) {
                IS_AJAX && $this->ajaxReturn(0, L('please_input').L('password'));
                $this->error(L('please_input').L('password'));
            }
            //连接用户中心
            $passport = $this->_user_server();
            $uid = $passport->auth($username, $password);
            if (!$uid) {
                IS_AJAX && $this->ajaxReturn(0, $passport->get_error());
                $this->error($passport->get_error());
            }
            //登陆
            $this->visitor->login($uid, $remember);
            //登陆完成钩子
            $tag_arg = array('uid'=>$uid, 'uname'=>$username, 'action'=>'login');
            tag('login_end', $tag_arg);
            //同步登陆
            $synlogin = $passport->synlogin($uid);
            if (IS_AJAX) {
                $this->ajaxReturn(1, L('login_successe').$synlogin);
            } else {
                //跳转到登陆前页面（执行同步操作）
                $ret_url = $this->_post('ret_url', 'trim');
                $this->success(L('login_successe').$synlogin, U('User/index'));
            }
        } else {
            /* 同步退出外部系统 */
            if (!empty($_GET['synlogout'])) {
                $passport = $this->_user_server();
                $synlogout = $passport->synlogout();
            }
            if (IS_AJAX) {
                $resp = $this->fetch('dialog:login');
                $this->ajaxReturn(1, '', $resp);
            } else {
                //获取用户角色
                $userCate = D('user_category')->field('id,name')->where(array('status'=>1,))->select();
                $this->assign('userCate',$userCate);

                //来路
                $ret_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : __APP__;
                $this->assign('ret_url', $ret_url);
                $this->assign('synlogout', $synlogout);
                $this->_config_seo();
                $this->display();
            }
        }

    }

    public function comment() {
		$orderId = $_GET['orderId'];
		!$orderId && $this->_404();
		
		$item_order=M('item_order');
		$userId = $this->visitor->info['id'];
		$usersMd = M('user');
		$order=$item_order->where("orderId='$orderId' and userId='$userId'")->find();

		if(!is_array($order))
		{
		$this->error('该订单不存在');
		}else{

			$order_detail=M('order_detail');

			$order_details= $order_detail->where(array('orderId'=>$order['orderId'],'c_status'=>0))->select();
			$item_detail=array();
			foreach ($order_details as $key=>$val)
			{
				$items_attr=$val['item_attr'];//商品属性
				$attr_arr=array_filter(explode(";",$items_attr));
				$attr_list=array();
				foreach($attr_arr as $ke=>$va){
					$attr_arr2=array_filter(explode("|",$va));
					$attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
				}
				$items[$key]['attr']=$attr_list;//赋值items

				$items[$key]= array('id'=>$val['id'],'title'=>$val['title'],'itemId'=>$val['itemId'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'color'=>$val['color'],'size'=>$val['size'],'zuzhuang'=>$val['zuzhuang'],'attr'=>$attr_list);

				$item_detail[$key]=$items[$key];
			}
		}
		$this->assign('orderId',$orderId);
		$this->assign('item_detail',$item_detail);
        $this->display();
    }
	
	public function do_comment(){
		$orderId = $this->_get('orderId','trim');
		$itemId = $this->_get('itemId','trim');
		$item = M('order_detail')->where(array('orderId'=>$orderId,'itemId'=>$itemId))->field('img,price,title,size')->find();
		$this->assign('item',$item);
		$this->assign('orderId',$orderId);
		$this->assign('itemId',$itemId);
		$this->display();
	}
    //sail
    public function jifeng() {
        $prt = intval($_GET["prt"]);
        $item_jifen = M("item_jifen");
        $uid = $this->visitor->info['id'];

        $wherenum['uid'] = $uid;
        $wherenum['state'] = 1;
        $item_jifennum = $item_jifen->where($wherenum)->sum('jifen');
        //负的积分
        $wherenum1['uid'] = $uid;
        $wherenum1['state'] = 0;
        $item_jifennum1 = $item_jifen->where($wherenum1)->sum('jifen');

        $prtAft = $item_jifennum - $item_jifennum1 - $prt*100;
        if($prtAft < 0) {
            echo json_encode(array("error"=>1,"msg"=>$prt."元代金券"."兑换失败! 积分余额不足!"));
            return;
        }

        $data = array();
        $data["jifen"] = $prt*100;
        $data["title"] = $prt."元代金券";
        $data["state"] = 0;
        $data["uid"] = $uid;
        $data["add_time"] = time();
        $item_jifen->add($data);
        echo json_encode(array("success"=>1,"msg"=>$prt."元代金券"."兑换成功!","prtAft"=>$prtAft));
    }

         /**
     * 我的大转盘
     */
    public function dazhuanpan() {

        $zp = M('zhuanpan_list');
        $useracc = M('zhuanpan_log');
        $uid = $this->visitor->info['id'];
        //echo $uid;
        if( $keyword = $this->_request('keyword', 'trim') ){
            $map['_string'] = "username like '%".$keyword."%' ";
        }
        $map['listid']  = array('lt',7);
        $map['userid']  = $uid;

        $count      = $useracc->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count);// 实例化分页类 传入总记录数
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $useracc->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list  as $key=>$val)
        {
            $listid = $val['listid'];
            $listinfo = $zp->where("id=$listid")->find();
            $list[$key]['jp_leibei']    = $listinfo['praisename'];
            $list[$key]['jp_name']      = $listinfo['praisecontent'];
        }
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();

    }
 /*
    public function addaddress()
    {
        if(IS_POST)
        {
        $user_address=M('user_address');

        $consignee= $this->_post('consignee', 'trim');
        $sheng= $this->_post('sheng', 'trim');
        $shi= $this->_post('shi', 'trim');
        $qu= $this->_post('qu', 'trim');
        $address= $this->_post('address', 'trim');
        $phone_mob= $this->_post('phone_mob', 'trim');

        $data['uid']=$this->visitor->info['id'];
        $data['consignee']=$consignee;
        $data['sheng']=$sheng;
        $data['shi']=$shi;
        $data['qu']=$qu;
        $data['address']=$address;
        $data['mobile']=$phone_mob;

        //echo $this->visitor->info['id'];

        if($user_address->data($data)->add()!==false)
        {
            if($_POST['from'] == 'fahuo')
            {
                $this->redirect('User/fahuo2');
            }elseif($_POST['from'] == 'gouhuo')
            {
                $this->redirect('User/gouhuo2');
            }else{
                $this->redirect('User/address');
            }
        }

        }
        if(isset($_GET['f'])){
            if($_GET['f'] == 1){
                $from = 'fahuo';
            }elseif($_GET['f'] == 2){
                 $from = 'gouhuo';
            }else{
                $from = '';
            }
        }

        $this->assign('from',$from);
        $this->display();
    }
*/
    /**
     * 用户退出
     */
    public function logout() {
        $this->visitor->logout();
        //同步退出
        $passport = $this->_user_server();
        $synlogout = $passport->synlogout();
        //跳转到退出前页面（执行同步操作）
        $this->success(L('logout_successe').$synlogout, U('book/good'));
    }

    /**
     * 用户绑定
     */
    public function binding() {
        $user_bind_info = object_to_array(cookie('user_bind_info'));
        $this->assign('user_bind_info', $user_bind_info);
        $this->_config_seo();
        $this->display();
    }

    /**
    * 用户注册，通过表单注册
    */
    public function register() {
        $this->visitor->is_login && $this->redirect('User/index');
        if (IS_POST) {
            $username = $this->_post('user_name', 'trim');
            $email = $this->_post('email','trim');
            $address = $this->_post('address','trim');
            $phone_mob = $this->_post('phone_mob','trim');
            $bmonth = $this->_post('bmonth','trim');
            $bday = $this->_post('bday','trim');
            $password = $this->_post('password', 'trim');
            $repassword = $this->_post('password_confirm', 'trim');
            $sharename = $this->_post('share_name', 'trim');
            $role = $this->_post('role', 'trim');

            //echo $sharename."<hr>";
            //检验用户share用户是否存在
            $shareuser = D('user')->where(array('username'=>$sharename))->find();
            if($shareuser){
                $shares = $shareuser['id'];
            }else{
                $this->error('推荐人用户名不存在！');
            }
            //var_dump($shares);exit;
            if ($password != $repassword) {
                $this->error(L('inconsistent_password')); //确认密码
            }
            $gender = $this->_post('gender','intval', '0');

            //用户禁止
            $ipban_mod = D('ipban');
            $ipban_mod->clear(); //清除过期数据
            $is_ban = $ipban_mod->where("(type='name' AND name='".$username."') OR (type='email' AND name='".$email."')")->count();

            $is_ban && $this->error(L('register_ban'));

            //连接用户中心
            $passport = $this->_user_server();
            //var_dump($passport);exit;
            //注册
            $uid = $passport->register($username, $password, $email, $address, $phone_mob, '1988' ,$bmonth, $bday, $gender, $shares);
            !$uid && $this->error($passport->get_error());

            D('user')->save(array('id'=>$uid,'shares'=>$shares,'uid'=>$role));

            $this->success('申请已提交！我们会尽快处理！',U('book/good'));exit;
            //第三方帐号绑定
         /*   if (cookie('user_bind_info')) {
                $user_bind_info = object_to_array(cookie('user_bind_info'));
                $oauth = new oauth($user_bind_info['type']);
                $bind_info = array(
                    'pin_uid' => $uid,
                    'keyid' => $user_bind_info['keyid'],
                    'bind_info' => $user_bind_info['bind_info'],
                );
                $oauth->bindByData($bind_info);
                //临时头像转换
                $this->_save_avatar($uid, $user_bind_info['temp_avatar']);
                //清理绑定COOKIE
                cookie('user_bind_info', NULL);
            }*/
            //注册完成钩子
            $tag_arg = array('uid'=>$uid, 'uname'=>$username, 'action'=>'register');
            tag('register_end', $tag_arg);
            //登陆
            $this->visitor->login($uid);
            //登陆完成钩子
            $tag_arg = array('uid'=>$uid, 'uname'=>$username, 'action'=>'login');
            tag('login_end', $tag_arg);
            //同步登陆
            $synlogin = $passport->synlogin($uid);
            $this->redirect('User/index');
            exit;
        } else {
            //关闭注册
            if (!C('pin_reg_status')) {
                $this->error(C('pin_reg_closed_reason'));
            }
            $role = isset($_GET['role']) ? intval(trim($_GET['role'])) : 1;


            $this->assign('role',$role);
            $this->_config_seo();
            $this->display();
        }
    }

    /**
     * 第三方头像保存
     */
    private function _save_avatar($uid, $img) {
        //获取后台头像规格设置
        $avatar_size = explode(',', C('pin_avatar_size'));
        //会员头像保存文件夹
        $avatar_dir = C('pin_attach_path') . 'avatar/' . avatar_dir($uid);
        !is_dir($avatar_dir) && mkdir($avatar_dir,0777,true);
        //生成缩略图
        $img = C('pin_attach_path') . 'avatar/temp/' . $img;
        foreach ($avatar_size as $size) {
            Image::thumb($img, $avatar_dir.md5($uid).'_'.$size.'.jpg', '', $size, $size, true);
        }
        @unlink($img);
    }

    /**
     * 用户消息提示
     */
    public function msgtip() {
        $result = D('user_msgtip')->get_list($this->visitor->info['id']);
        $this->ajaxReturn(1, '', $result);
    }

    /*
       * 浏览记录
    */
	
    public function history(){
		$uid = $this->visitor->info['id'];
        $posslist = M('posslike')->where(array('userid'=>$uid))->order('addtime desc')->select();
		foreach($posslist as $key => $val){
			$item = M('item')->where(array('id'=>$val['itemid']))->find();
			$posslist[$key]['title'] = $item['title'];
			$posslist[$key]['img'] = $item['img'];
			$posslist[$key]['price'] = $item['price'];
		}
        $this->assign('posslist',$posslist);
        $this->assign('poss_count',count($posslist));
        $this->display();
    }
	
    public function clear_history(){
	   $id = $this->_get('id','trim');
       $where['id'] = $id;
       M('posslike')->where($where)->delete();
       $this->redirect('User/history');
    }
	
    /**
    * 卖家中心登录
    */
    public function merlogin() {
        set_time_limit(0);//设置超时时间 2016-04-25 by shuguang 添加
        $bg = M('ad')->field('url,content,desc')->where('board_id=7 and status=1')->find();
        $merlogin_info = M('user')->field('username')->where('id='.$this->visitor->info['id'])->find();
        $this->assign('bg',$bg);
        $this->assign('merlogin_info',$merlogin_info);
        $this->display();
    }
    public function mercheck() {
        set_time_limit(0);//设置超时时间 2016-04-25 by shuguang 添加
        //输入的密码
        $pass = MD5($_GET['pass']);
        //当前用户端ID
        $id = $this->visitor->info['id'];
        $info = M('user')->where('id='.$id)->find();
        //检测该用户的密码是否设置了,提交到的登录密码是否一致
        if($info['password']){
            if($pass==$info['password']){
                if ($info['ll_update'] != strtotime(date('Y-m-d'))) {
                    $data['ll_update']  = strtotime(date('Y-m-d'));
                    $data['liulan']     = 0;
                    M('user')->where(array('id'=>$id))->save($data);
                }
                echo 1;
                //更新登录状态
                session('isshop',1);

            }else{
                //密码错误
                echo 2;

            }

        }else{

            echo 0;exit;

        }
        //echo md5($pass);

    }
     /************************
     *   添加地址信息
     *   addaddress()方法
     *   @author  May
     *   date    2016-07-21
     ************************/
    public function uploadPic($fname,$fdir){
        if (!empty($_FILES[$fname]['name'])) {
            //省份证正面图片规格
            $avatar_size = explode(',', C('pin_avatar_size'));
            //省份证图片保存文件夹
            $uid = abs(intval($this->visitor->info['id']));
            $suid = sprintf("%09d", $uid);
            $dir1 = substr($suid, 0, 3);
            $dir2 = substr($suid, 3, 2);
            $dir3 = substr($suid, 5, 2);
            $avatar_dir = $dir1.'/'.$dir2.'/'.$dir3.'/';
            //图片
            $suffix = '';
            foreach ($avatar_size as $size) {
                $suffix .= '_'.$size.',';
            }
            $result = $this->_upload($_FILES[$fname], $fdir.'/'.$avatar_dir, array(
                'width'=>C('pin_avatar_size'),
                'height'=>C('pin_avatar_size'),
                'remove_origin'=>true,
                'suffix'=>trim($suffix, ','),
                'ext' => 'jpg',
            ), md5($uid));
            if ($result['error']) {
                $this->error($result['info']);
                return;
            } else {
                //2016-04-24 by shuguang 添加 start
                import('ORG.ThumbHandle');
                //2016-04-24 by shuguang 添加图片居中截取
                $path = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
                $path = str_replace('\\','/',$path);
                $imgparth = $path.'/data/upload/'.$fdir.'/'.$avatar_dir.md5($uid).'_'.$size.'.jpg';
                $imgparth_100 = $path.'/data/upload/'.$fdir.'/'.$avatar_dir.md5($uid).'_100'.'.jpg';

                $img = new ThumbHandle();

                $img->param($imgparth)->thumb($imgparth, 200,200,1);//将生成的图片强制居中截取成200*200的图片

                $img->param($imgparth)->thumb($imgparth_100, 100,100,1);//将原来生成的100高的图片，利用200的图片强制居中截取成100*100的图片
                //2016-04-24 by shuguang 添加 end

                $data = __ROOT__.'/data/upload/'.$fdir.'/'.$avatar_dir.md5($uid).'_'.$size.'.jpg?'.time();
            }
        }
        return $data;
    }



 public function addaddress()
    {
        if(IS_POST)
        {
        $user_address=M('user_address');

        $consignee= $this->_post('consignee', 'trim');
        $sheng= $this->_post('sheng', 'trim');
        $shi= $this->_post('shi', 'trim');
        $qu= $this->_post('qu', 'trim');
        $towns= $this->_post('towns', 'trim');
        $address= $this->_post('address', 'trim');
        $phone_mob= $this->_post('phone_mob', 'trim');
        //$cardId= $this->_post('cardId', 'trim');


        $data['uid']=$this->visitor->info['id'];
        $data['consignee']=$consignee;
        $data['sheng']=$sheng;
        $data['shi']=$shi;
        $data['towns']=$towns;
        $data['qu']=$qu;
        $data['address']=$address;
        $data['mobile']=$phone_mob;
        //$data['cardId']=$cardId;
        $data['frontage']=$this->uploadPic('frontage','card');//上传的身份证照片所在的文件名称
        $data['opposite']=$this->uploadPic('opposite','card');

        if($user_address->add($data))
        {
            if($_POST['from'] == 'fahuo')
            {
                $this->redirect('User/fahuo2');
            }elseif($_POST['from'] == 'gouhuo')
            {
                $this->redirect('User/gouhuo2');
            }else{
                //判断是否从结算页面过来
                $ids = $this->_post('ids');
                if($ids !=""){
                    //查找写进数据库的最后一个id
                    $this->redirect('Order/jiesuan',array('ids'=>$ids,'addr_id'=>$user_address->getLastInsID()));
                }else{
                     $this->redirect('User/address');
                }
            }
        }

        }
        if(isset($_GET['f'])){
            if($_GET['f'] == 1){
                $from = 'fahuo';
            }elseif($_GET['f'] == 2){
                 $from = 'gouhuo';
            }else{
                $from = '';
            }
        }

        $this->assign('from',$from);
        $this->display();
    }
    public function merusername() {

        $info = M('user')->where('id='.$this->visitor->info['id'])->find();
        //微信头像
        $weiheader = M('User')->field('cover')->where("id=".$this->visitor->info['id'])->find();
        $this->assign('weiheader',$weiheader);
        $this->assign('info',$info);
        $this->display();
    }

    //范票中心
    public function integral(){
        $point_yuer = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('points');
        $imsg = M('messagelist');
        $where['recom'] = $this->visitor->info['id'];
        $where['type'] = array('in','5,6,8,9,11,12,19,20,22');
        $msglist = $imsg->where($where)->order('id desc')->limit(10)->select();
        $decwhere['type'] = array('in','7,10,21,25,26');
        $decwhere['recom'] = $this->visitor->info['id'];
        $declist = $imsg->where($decwhere)->order('id desc')->limit(10)->select();
        $this->assign('msglist',$msglist);
        $this->assign('declist',$declist);
        $this->assign('point_yuer',$point_yuer);
        $this->display();
    }

    public function point_detail(){
        $info_type = $this->_get('type');
        $imsg = M('messagelist');
        if($info_type == 1){
            $where['type'] = array('in','5,6,8,9,11,19,20,22');
            $where['recom'] = $this->visitor->info['id'];
        }else{
            $where['type'] = array('in','7,10,21,25,26');
            $where['recom'] = $this->visitor->info['id'];
        }
        $point_list = $imsg->where($where)->order('id desc')->select();
		$point_count = $imsg->where($where)->sum('points');
        $this->assign('point_list',$point_list);
		$this->assign('point_count',$point_count);
        $this->display();
    }

    public function rule(){
        $this->display();
    }
	
	public function activity_del(){
			$sel = M('cart')
					->join('a left join weixin_item as b on a.id=b.id')
					->where('b.activity = 1')
					->field('a.mainid')
					->select();
			if(!empty($sel)){
					$ids = array();
					foreach ($sel as $v){
						$ids[] = $v[mainid];
					}
					$del = M('cart')->where(array('mainid'=>array('in',$ids)))->delete();
					if($del){
						$del>0 && print('删除成功,共删除了'.$del.'条');
					}else{
						echo '删除失败';
					}
				}else{
				   echo '已无符合条件数据，共删除0条';
				}
	}

    public function addid(){
        $this->display();
    }
    public function do_addid(){
        $consignee= $this->_post('consignee', 'trim');
        $cardId= $this->_post('cardId', 'trim');

        $card=M('idcard');
        $data['c_name'] = $consignee;
        $data['c_id'] = $cardId;
        $data['uid'] = $this->visitor->info['id'];
        if($card->data($data)->add()!==false)
        {
             //判断是否从结算页面过来
            $ids = $this->_post('ids','trim');
            $addr_id = $this->_post('addr_id','trim');
            if($ids !="" || $addr_id!=""){
                //查找写进数据库的最后一个id
                $this->redirect('Order/jiesuan',array('ids'=>$ids,'card_info'=>$card->getLastInsID(),'addr_id'=>$addr_id));
            }else{
                 $this->redirect('User/id_manage');
            }
        }
    }

    public function id_manage(){
        $cards = M('idcard')->where('uid = '.$this->visitor->info['id'])->select();
        $this->assign('cards',$cards);
        //dump($cards);exit;
        $this->display();
    }
    public function del_id(){
        $id = $_GET['id'];
        $where['Id'] = $id;
        M('idcard')->where($where)->delete();
        $this->redirect('User/id_manage');
    }



    public function meredit() {

        $id = $this->visitor->info['id'];
        $act = $_GET['act'];

        if($act==1){

            $data['merchant'] = $_GET['txt'];
            if(M('user')->where('id='.$id)->save($data)!==false){

                echo 1;

            }else{

                echo 0;

            }

        }elseif($act==2){

            $data['m_desc'] = $_GET['txt'];
            if(M('user')->where('id='.$id)->save($data)!==false){

                echo 1;

            }else{

                echo 0;

            }

        }elseif($act==3){

            $p1 = MD5($_GET['p1']);
            $info = M('user')->where('id='.$id)->find();
            if($info['password']==$p1){

                $data['password'] = MD5($_GET['p2']);
                if(M('user')->where('id='.$id)->save($data)!==false){

                    echo 1;

                }else{

                    echo 2; //失败

                }

            }else{

                echo 0; //原密码错误

            }

        }

    }

    // 2016-07-09 Modify by Liuyumei
    public function lv_up(){  //下级向上级申请升级
        $num      = $this->_post('num','intval');
        $num1     = $this->_post('zt','intval');

        $list = M('user_lvup')->where(array('userid'=>$this->visitor->info['id']))->field('useruid,userid')->find();

        if($list){
            if($list['useruid'] == $this->visitor->info['uid']){    //目前申请等级为已申请过的，不能再申请
                $this->ajaxReturn(2,"提交申请失败,您已提交申请!");
            }else{
                $this->lv_up_do($num,$num1);
            }
        }else{
            $this->lv_up_do($num,$num1);
        }
    }

    public function lv_up_do($num,$num1){
            $lv['num']      = $num;
            $lv['num1']     = $num1;

            $lv['add_time'] = time();
            $lv['userid']   = $this->visitor->info['id'];
            $lv['useruid']  = $this->visitor->info['uid'];

            $user = M('user')->where(array('id'=>$this->visitor->info['id']))->field('shares_tree')->find();
            $tree = explode('|',$user['shares_tree']);//直接上级的shares_tree
            $lv['up_user']  = $tree[count($tree)-2];

            $lv['username'] = $this->visitor->info['username'];
            $lv['phone_mob']= $this->visitor->info['phone_mob'];

            $res = M("user_category")->where(array('id'=>$lv['useruid']-1))->find();
            $lv['upgrade']  = $res['upgrade'];
            $lv['upgrade1'] = $res['upgrade1'];
            //添加升级记录
            $res = M('user_lvup')->add($lv);      //向申请表中写入数据
            if ($res !== false) {
               $this->ajaxReturn(1,"提交申请成功,审核结果我们将以公众号信息通知您!");
            }else{
               $this->ajaxReturn(2,"提交申请失败,请稍后重试!");
            }
    }
    /**
     * 基本信息修改
     */
     public function index(){
		$buckwhere['userId'] = $this->visitor->info['id'];
		$buckwhere['status'] = 1;
		$buckwhere['buck_time'] = array('neq',0);
		$end_buck = M('item_order')->where($buckwhere)->find();
		if(time() > $end_buck['buck_time']+100 && $end_buck['buck_time']!=0){
			$message = M('messagelist');
			$message->user_id = $end_buck['shopid']; 
			$message->recom = $this->visitor->info['id']; 
			$message->type = 22; 
			$message->order_id = $end_buck['orderId']; //订单id
			$message->time = time();
			$message->status = 0; // 默认未读状态
			$message->points = $end_buck['cash_price'];
			if($message->add()){
				M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$end_buck['cash_price']);
				$rprice = $end_buck['cash_price']/100;
				$data['order_sumPrice'] = $end_buck['order_sumPrice'] + $rprice;
				$data['buck_time'] = 0;
				$data['cash_price'] = 0;
				M('item_order')->where(array('id'=>$end_buck['id']))->save($data);
			}
		}
        $id = $this->visitor->info['id'];
        $uid= $this->visitor->info['uid'];
        $sid=$id;
		//是否满足成为经纪人的条件
		if($uid == 4){
			$satis_where['userId'] = $id;
			$satis_where['status'] = array('in',array('2','3','4'));
			$satis_where['goods_sumPrice'] = array('egt',99);
			$satis_where['add_time'] = array('gt',1480262400);
			$satisfy = M('item_order')->where($satis_where)->select();
			$this->assign('satisfy',count($satisfy));
		}else{
			$this->assign('satisfy',0);
		}
        $userinfo =M('user')->where(array('id'=>$id))->field('id,uid,username,is_read,reg_time,login_days,v1')->find();
		$uaddtime = time() - $userinfo['reg_time'];
		$utime=ceil($uaddtime/3600/24);
		$this->assign('utime',$utime);
		$this->assign('unumber',$userinfo['id'] * 3);
        //5小时后未付款提醒用户,如果有多条条件同时满足，则提醒最新的订单。
        $wxsend   = new Wxsend();
        $itemm = M('item_order');
        $items = $itemm->where(array('userId'=>$this->visitor->info['id'],'status'=>1,'is_delete'=>0))->order('id desc')->find();
        $userf = M('user')->where(array('id'=>$items['userId']))->find();
        if(time() > $items['add_time']+3600*5 && $items['is_pay']!=1){
            $data['is_pay'] = 1;
            $save = $itemm->where(array('id'=>$items['id']))->save($data);
            if($save){
               $wxsend->no_pay($userf['wechatid'],date('Y-m-d H:i:s',$items['add_time']),$items['orderId'],$userf['username']);
            }
        }
		
        //24小时后删除用户的未付款订单
        $pay_list = M('item_order')
        ->join("a left join weixin_order_detail as b on a.orderId = b.orderId")
        ->field("a.*,b.*")
        ->where(array('a.userId'=>$this->visitor->info['id'],'a.status'=>1))
        ->select();
		
        foreach($pay_list as $key=>$val){
            if(time() > $val['add_time']+3600*24){
                M('item_order')->where(array('orderId'=>$val['orderId'],'status'=>1))->delete();
                M('order_detail')->where(array('orderId'=>$val['orderId']))->delete();
            }
        }
		
		$romwhere['userId'] = $this->visitor->info['id'];
		$romwhere['is_reminded'] = 0;
		$romwhere['robtime'] = array('neq',0);
		$romwhere['content'] = array('neq',0);
		$romwhere['is_stretch'] = array('neq',1);
		$robredbag = M('red_packets')->where($romwhere)->find();
		if(time() > $robredbag['robtime']+3600*1 && count($robredbag) > 0){
			$message = M('messagelist');
            $message->user_id = $this->visitor->info['id']; //用户id
            $message->recom = $this->visitor->info['id']; //用户id
            $message->pid = $robredbag['Id'];
            $message->type = 11; //系统退还
            $message->order_id =0; //订单id
            $message->time = time();
            $message->status = 0; // 默认未读状态
            $message->points = $robredbag['content'];
            $message->add();
			M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$robredbag['content']);
			$data['content'] = 0; //更新红包余额为0
			$data['is_reminded'] = 1;
			M('red_packets')->where(array('Id'=>$robredbag['Id']))->save($data);
		}
        
        //消费者升级为店长
        $res =M('user')->where(array('id'=>session('shopid')))->field('id,uid,username')->find();
        $appid = D('setting')->where(array('name'=>'appid'))->find();
        $appid = trim($appid['data']);
        $redirect_uri = "http://".$_SERVER['SERVER_NAME']."/index.php?m=Weixin&a=getauth";
        $redirect_uri = urlencode($redirect_uri);
        $scope = "snsapi_userinfo";
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=id-".$res['id']."#wechat_redirect";
        $this->assign('urls',$url);
        $this->assign('user',$res['username']);
        $this->assign('update_user',$uid);

        //检测用户当前是否符合升级条件
        if ($uid != 4) {
            $lvup = M('user_lvup')->where(array('userid'=>$id,'useruid'=>$uid))->count();//userid=307  useruid=3

            if ($lvup == 0) {
                $res1 = $this->_mod->check_lv($id,$uid);
                //dump($res1);
                if ($res1['status'] == 1) {
                   $this->assign("lv_up",1);
                   $this->assign("num",$res1['num']);
                   $this->assign("zt",$res1['zt']);
                }
            }

            //检测当前代理是否存在升级申请和降级信息
            if($uid < 4){
                $up_sq  = M('user_lvup')->where(array('up_user'=>$id,'up_status'=>0))->count();
                $down_mg= M('user_lvdown')->where(array('userid'=>$id,'status'=>0))->count();
                $this->assign('up_sq',$up_sq);
                $this->assign('down_mg',$down_mg);
            }
        }

        //判断入口是否从微信公众号进入的
        $this->assign("shopid",$_SESSION['shares']);

        $this->visitor->info = $_SESSION['user_info'];
        $item_order=M('item_order');
        $order_detail=M('order_detail');
        if(!isset($_GET['status']))
        {
            $status=2;
        }
        else
        {
            $status=$_GET['status'];
        }
        //判断是否是从支付成功后的跳转
        if ($_GET['status'] == 2 && !empty($_GET['orderid'])) {
            //获取订单和店铺代理信息
            $order        = M('item_order')
                            ->join("a left join __USER__ as b on a.shopid = b.id")
                            ->where(array('a.orderId'=>array('like',$_GET['orderid'].'%')))
                            ->field("a.*,b.shares,b.recom,b.wechatid,b.username")
                            ->find();
							
            //获取订单信息和商品信息
           $order_detail = M('order_detail')
							->join('a left join weixin_item b on a.itemId=b.id')
                            ->where(array('a.orderId'=>array('like',$_GET['orderid'].'%')))
							->field('a.*,b.activity')
                            ->select();
							
        //订单支付后删除购物车相应商品
        foreach($order_detail as $orderk=>$orderv){
            $where_d['id'] = array('in',$orderv['itemId']); //商品id
            $where_d['uid'] = $id; //会员id
            M('cart')->where($where_d)->delete();
        }
		
		//记录实际售出数量
		foreach ($order_detail as $k => $v){
			M('item')->where(array('id'=>$v['itemId']))->setInc('paynum',1);
		}
          $fc_lv = M('user_fengchenglv')->where(array('id'=>3))->find();
          $shares= $order['shares'];
			//购物之后给商家和消费者+10积分
			if($order){
				$points = 10;
				if($order['userId'] == $order['shopid']){
					$message = M('messagelist');
					$message->user_id =$order['userId']; //用户id
					$message->recom = $order['shopid']; //商家id
					$message->type = 5; //购物积分
					$message->order_id = $order['orderId']; //订单id
					$message->time = time();
					$message->status = 0; // 默认未读状态
					$message->points = $points;
					if($message->add()){
						M('user')->where(array('id'=>$order['shopid']))->setInc('points',$points);
					}
				}else{
					//商家积分
					$message = M('messagelist');
					$message->user_id =$order['userId']; //用户id
					$message->recom = $order['shopid']; //商家id
					$message->type = 5; //购物积分
					$message->order_id = $order['orderId']; //订单id
					$message->time = time();
					$message->status = 0; // 默认未读状态
					$message->points = $points;
					if($message->add()){
						M('user')->where(array('id'=>$order['shopid']))->setInc('points',$points);
					}
					//消费者积分
					$item_msg = M('messagelist');
					$item_msg->user_id =$order['userId']; //用户id
					$item_msg->recom = $order['userId']; //用户id
					$item_msg->type = 5; //购物积分
					$item_msg->order_id = $order['orderId']; //订单id
					$item_msg->time = time();
					$item_msg->status = 0; // 默认未读状态
					$item_msg->points = $points;
					if($item_msg->add()){
						M('user')->where(array('id'=>$order['userId']))->setInc('points',$points);
					}
				}

			}
			
            $shop_shares = $this->getShareTree($order['shopid']);//获取获得提成的用户ID
            foreach($shop_shares['uid'] as $sk=>$sv){
                $lvId .=$sv;
            }
			
            $roy = M('user_fengchenglv')->where(array('id'=>$lvId))->field('royalty')->find();//获取各级别的分成率
            $royArr = explode('|',$roy['royalty']);
			
            foreach ($order_detail as $ok => $ov) {//获取订单利润
                $profitPrice += $ov['profit'];
				$orderPrice += $ov['price']; //获取订单单价
            }
			
            $time = date("Y-m-d H:i:s");
            foreach($royArr as $rk=>$rv){
				 //还未确认收货先写入allfclist表中
				if($order['is_sendprice'] == 0){
					$all_fclist = M('user_allfcllist');
					$fcdata['price']= round($orderPrice,2); //订单总金额
					$fcdata['user_id'] = $order['userId'];
					$fcdata['add_time']= time();
					$fcdata['state'] 	 = 1;
					$fcdata['orderId'] = $order['orderId'];
					$fcdata['royalty'] = $rv;
					$fcdata['fencheng']= round($profitPrice*$rv,2);
					$fcdata['uid'] = $shop_shares['shareId'][$rk];
					$res = $all_fclist->add($fcdata);
					M('item_order')->where(array('orderId'=>$order['orderId']))->setField('is_sendprice',1);
					$wxsend->SR($shop_shares['wechatid'][$rk],round($profitPrice*$rv,2)."(待结算)",$time);//提示代理商将获得返利
				}
                //$wxsend->SR('oOejpwvMFZF5-J1VkOpyU-AbIS1E',round($profitPrice*$rv,2)."(待结算)".' '.$shop_shares['wechatid'][$rk],$time); //测试样例
            }
            $this->redirect('Order/paysuccess',array('orderid' =>$_GET['orderid']));
        }

        /*查看加盟商是否已审核*/
        $ischeck = M('User')->field('uid,status,shares')->find($this->visitor->info['id']);
        $shares = M('user')->where(array('id'=>$ischeck['shares']))->field('username')->find();
        if (!is_array($shares)) {
            $shares['username'] = $this->visitor->info['username'];
        }
        $this->assign('shares',$shares['username']);
        $ids = $this->visitor->info['id'];
        $res=M('item_order')->where(array('userId'=>$this->visitor->info['id']))->count();
        $this->assign('order_count',$res);
        //微信头像
        $weiheader = M('User')->field('cover')->where("id=$ids")->find();
        $this->assign('weiheader',$weiheader);
        //获取用户的已提现金额和可提现金额
        $keti_jine = 0;
        $yiti_jine = 0;
        //可以提现的金额
        $set=M('set')->find();
        $data['add_time']=array('lt',strtotime(date('Y-m-d H:i:s',time()))-24*60*60*$set['tx_djq']);
        $data['uid']=$this->visitor->info['id'];
        $data['status']=1;
        $keti_jine = M('user_fengchengllist')->where($data)->sum('fencheng');

        $keti_jine = $keti_jine ? $keti_jine : 0;
        //已经提现的金额
        $yiti_jine = M('user_fengchengllist')->where(array('uid'=>$this->visitor->info['id'],'state'=>0))->sum('fencheng');
        $yiti_jine = $yiti_jine ? $yiti_jine : 0;
        $zhengti_jine = M('user_fengchengllist')->where(array('uid'=>$this->visitor->info['id'],'state'=>2))->sum('fencheng');
        $zhengti_jine = $zhengti_jine ? $zhengti_jine : 0;
        $keti_jine = $keti_jine - $yiti_jine-$zhengti_jine;
        $this->assign('keti',$keti_jine);
        $this->assign('yiti',$yiti_jine);

        $this->assign('reg_time',date("Y-m-d",$this->visitor->info['reg_time']));

        $uida = $this->visitor->info['uid'];
        $this->assign('uida',$uida);
        if(!isset($_GET['isshop'])){
         if($this->visitor->info['uid'] == 4||$this->visitor->info['uid'] == 3||$this->visitor->info['uid'] == 2||$this->visitor->info['uid'] == 1||$this->visitor->info['uid'] == 5){
            // 加盟商系统
            if($ischeck['status'] == 0){
                unset($_SESSION['user_info']);
                unset($this->visitor->info);
                $this->error('代理商账号未通过审核，请耐心等候',U('book/good'));
            }
            //会员分组
            if($this->visitor->info){
                $id=$this->visitor->info['uid'];
                $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
                $this->assign('user_category', $user_category);
            }
              $item_orders1= $item_order->order('id desc')->where('status=1 and is_delete=0 and userId='.$this->visitor->info['id'])->select();
              $count1=count($item_orders1);//待付款总数
              $item_orders2= $item_order->order('id desc')->where('status=2 and userId='.$this->visitor->info['id'])->select();
              $count2=count($item_orders2);//待发货总数
              $item_orders3= $item_order->order('id desc')->where('status=3 and is_delete=0 and userId='.$this->visitor->info['id'])->select();
              $count3=count($item_orders3);//待收货总数
              $item_orders4= $item_order->order('id desc')->where('status=4 and is_delete=0 and userId='.$this->visitor->info['id'])->select();
              $count4=count($item_orders4);//已完成待评价总数
             /* $item_orders5= $item_order->order('id desc')->where('status=5 and userId='.$this->visitor->info['id'])->select();
              $count5=count($item_orders5);//历史记录总数*/
              $item_orders6= $item_order->order('id desc')->where('status=6 and is_delete=0 and userId='.$this->visitor->info['id'])->select();
              $count6=count($item_orders6);//换货中总数


              $item_orders= $item_order->order('id desc')->where('is_delete=0 and userId='.$this->visitor->info['id'])->select();
              $count=count($item_orders);//换货中总数
              if($this->visitor->info['uid'] == 3 ){
                $this->assign('role','(代理商)');
              }else{
                $this->assign('role','');
              }
            /* 获取用户连接   */
            $res = M('user_apply')->where(array('userid'=>$this->visitor->info['id'],'hq_status'=>0))->find();
            if($res){
                if($res['support_time'] == 0){
                    $pay = M('user_category')->where(array('id'=>3))->find();
                    $wxconfig=$this->wxconfig();
                    $ip = get_client_ip();//获取ip
                    $url = "api/wxpay/js_api_call.php?ip=".$ip."&partner=".$wxconfig['partnerid']."&out_trade_no=".$res['orderid']."&body=".$res['orderid']."&total_fee=".$pay['upgrade']."&notify_url=".$wxconfig['notify_url']."&showwxpaytitle=1";
                    $_SESSION['pay_url'] = $url;
                    $this->assign('url',$url);
                }
            }


           /* dump($status);
            dump($count1);
            dump($count3);
            dump($count6);
            dump($count4);*/
            $this->assign('status',$status);
            $this->assign('count1',$count1);
            $this->assign('count2',$count2);
            $this->assign('count3',$count3);
            $this->assign('count6',$count6);
            $this->assign('count4',$count4);
            $this->assign('count',$count);
            $this->assign('userinfo',$userinfo);
            $this->_config_seo();
            $this->display();
            }
        }else{
            if($this->visitor->info['uid'] == 4){
                $this->error("您没有权限",U('User/index'));
                exit;
            }
            //判断商家是否登陆了
            if($_SESSION['isshop']==0){
                //进入登录界面
                echo "<meta http-equiv='Content-Type' content='text/html;charset=utf-8' /><script>window.location.href='./index.php?m=User&a=merlogin';</script>";
            }

            if($ischeck['status'] == 0){
                unset($_SESSION['user_info']);
                unset($this->visitor->info);
                $this->error('代理商账号未通过审核，请耐心等候',U('book/good'));
            }


            //会员分组
            if($this->visitor->info){
                $id=$this->visitor->info['uid'];
                $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
                $this->assign('user_category', $user_category);
            }
            // 判断会员组          2016-07-07 Modify by Liuyumei
            if($this->visitor->info['uid'] == 3 ){
                $this->assign('role','店长');
            }elseif($this->visitor->info['uid'] == 2 ){
                $u =M('user')->where('id='.$sid)->field('shares_tree')->find();//当前用户信息
                if(empty($u['shares_tree'])){
                     $this->assign('role','掌柜');
                }else{
                     $this->assign('role','育成掌柜');
                }
            }else{
               $this->assign('role','');
            }
            //end


            $time = strtotime(date("Y-m-d",strtotime("-6 day")));
            for ($i=0; $i < 7; $i++) {
                $timeArr[$i] = date('m.d',$time+$i*24*3600);
            }
            //获取总佣金
            $data0['uid']=$this->visitor->info['id'];
            $data0['state']= 1;
            $yongjin = M('user_fengchengllist')->where($data0)->sum('fencheng');

            $yongjin = $yongjin ? $yongjin : 0;
            $yongjin = round($yongjin,2);
            //获取代理本周营收金额
            $yinshou = $this->Weeken_price($time);
            $option = array(
                            "title" =>array("text"=>"总收入:".$yongjin,"x"=>"right","y"=>"-1.5","textStyle"=>array("fontSize"=>12,"fontWeight"=>"normal")),
                            "legend"=>array("近七日营收"),
                            "xaxis"=>array("type"=>"category","boundaryGap"=>"true","data"=>$timeArr,"axisLabel"=>array("show"=>"true","interval"=>"0")),
                            "grid"=>array("width"=>"90%","height"=> 140, "y"=> 30,"x"=> '10%'),
                            "series"=>array(
                                            array("name"=>"近七日营收","type"=>"line","stack"=>"总量","itemStyle"=>"{ normal: { label : { show: true, textStyle : {fontSize : '10',fontFamily : '微软雅黑',}}}}","data"=>$yinshou),
                                            ),
                            );
            $ec = new Echarts();//显示图表
            $echarts= $ec->show('visit_charts',$option,$option,0);  // 显示在指定的dom节点上
            $this->assign('echarts',$echarts);

            $this->assign("yongjin",$yongjin);


            //2016-07-07 Modify By Liuyumei 统计店长、直推掌柜、直推店长总数
            static $fenxiaos = array();

            $this->getDown($fenxiaos,$sid);
            //dump($fenxiaos);
            $mk_zong=0;
            $dk=0;
            $mk_xz=0;
			$mk_jr=0;
            /*dump(count($fenxiaos));   //测试用
            $i=0; */
            foreach($fenxiaos as $key=>$value){
                $uinfo =M('user')->where('id='.$value)->find();//当前用户信息
                /*dump($i++);
                dump($uinfo['uid']); */

                if($uinfo['uid']==3){
                    $mk_zong+=1;
                }
                $tree = explode('|',$uinfo['shares_tree']);//直接上级的shares_tree
                $nu=count($tree);
            /*  if($uinfo['uid']==2){   //测试用
                    dump($i++);
                    dump($uinfo['uid']);
                    dump($tree);
                } */
                if($uinfo['uid']==2&&$tree[$nu-2]==$sid){//["shares_tree"] => string(6) "-|49|-"
                    $dk+=1;
                }
                if($uinfo['uid']==3&&$tree[$nu-2]==$sid){
                    $mk_xz+=1;
                }
				if($uinfo['uid']==5){
                    $mk_jr+=1;
                }
            }
            //exit;

            $this->assign("mk_zong",$mk_zong);
            $this->assign("mk_xz",$mk_xz);
            $this->assign("dk",$dk);
			$this->assign("mk_jr",$mk_jr);
            // 查看店铺浏览数
            $liulan = $this->visitor->info['liulan'];
            $this->assign('liulan',$liulan);
            $this->assign('uid',$this->visitor->info['id']);
            $this->assign('dengji',$this->visitor->info['uid']);    //获取等级
            //代理商系统
            $stree = M('user')->where('id ='.$this->visitor->info['id'])->getField('shares_tree');
            $st = explode('|',$stree);
            if(count($st)>2){
                $stName = M('user')->where('id ='.$st[count($st)-2])->getField('username');
                $this->assign('stName',$stName);
            } 
            //dump($stName);exit;
            $this->display('index_daili');
        }
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




    public function getDown(&$fenxiaos,$userid){
        $user=M('user');
        $where = array(
                'shares_tree' => array('like','%|'.$userid.'|-%'),
                'status' => 1,
                'uid'=>array('in',array('2','3','5'))
            );
/*         $users=$user->where($where)->select();

        foreach ($users as $key => $value) {
            $fenxiaos[]=$value['id'];
            $this->getDown($fenxiaos,$value['id']);
        } */
        $users=$user->where($where)->field('id')->select();
        foreach ($users as $key=>$value){
            $fenxiaos[] = $value['id'];
            $this->getDown($fenxiaos,$value['id']);
        }
    }
    /*
     *  获取代理本月营收金额
     *  @author vany
     *  date 2015-12-9
     */
    public function Weeken_price($day,$k = 1){
        static $result = array();
        $id  =  $this->visitor->info['id'];
        $mod =  M('user_fengchengllist');
        $data['uid']  = $id;
        $data['add_time'] = array('between',array($day,$day+24*3600));
        $data['state']  = 1;
        $result[$k-1] = $mod->where($data)->sum("fencheng");
        $result[$k-1] = !empty($result[$k-1]) ? $result[$k-1] : '';
        $result[$k-1]=round($result[$k-1],2); //保留两位小数
        if ($k < 7) {
            $this->Weeken_price($day+24*3600,++$k);
        }

        return $result;
    }

    /*
     *  查看代理商的所有待结算订单
     *  @author vany
     *  date 2016-1-6
     */
    public function dl_order(){

        $id = $this->visitor->info['id'];
        $uid = $this->visitor->info['uid'];


        $res=$this->allfenxiao();
		if(count($res) > 0){
			foreach ($res as $key => $value) {
				if($value['level']<4){
					$xe[$key] = $value['id'];
				}
			}
			$orders = M('item_order')
						->join("a left join __USER__ as b on a.shopid = b.id")
						->where(array('a.shopid'=>array('in',$xe),'a.status'=>array('in','2,3')))
						->field("a.orderId,b.merchant,a.order_sumPrice,a.add_time,b.uid,b.cover")
						->order("add_time desc")
						->select();
			foreach ($orders as $key => $value) {
				if($value['uid']==3){
					$xe_order[] = $value;
				}else{
					$zg_order[]=$value;
				}
			}
			
			foreach ($orders as $key => $value) {
				if($value['uid']==3){
						$xe_order[] = $value;
					}elseif($value['uid']==2){
						$zg_order[]=$value;
					}elseif ($value['uid']==5){
						$jr_order[]=$value;
					}
			}
		}
        /* dump($xe_order);
        dump($zg_order); */

     /*   if($uid == 2){
            // 获取所属小二
            $xe_user = M('user')->where(array('shares'=>$id,'uid'=>3))->field('id')->select();
            //dump($xe_user);
            foreach ($xe_user as $key => $value) {
                $xe[$key] = $value['id'];
            }
            dump($xe);
            if($xe){
                //获取所有掌柜待结算订单
                $xe_order = M('item_order')->where(array('shopid'=>array('in',$xe),'status'=>array('in','2,3')))->field("orderId,shopid,order_sumPrice,add_time")->order("add_time desc")->select();
            }
            dump($xe_order);
        }else if($uid == 3){
            // 获取所属小二
            $xe_user = M('user')->where(array('recom'=>$id,'uid'=>3))->field('id')->select();
            foreach ($xe_user as $key => $value) {
                $xe[$key] = $value['id'];
            }
            if($xe){
                //获取所有掌柜待结算订单
                $xe_order = M('item_order')->where(array('shopid'=>array('in',$xe),'status'=>array('in','2,3')))->field("orderId,shopid,order_sumPrice,add_time")->order("add_time desc")->select();
            }
        }
        if (is_array($zg_order)) {
            foreach ($zg_order as $key => $value) {
                $user = M('user')->where(array('id'=>$value['shopid']))->field('merchant,cover')->find();
                $zg_order[$key]['merchant'] = $user['merchant'];
                $zg_order[$key]['cover'] = $user['cover'];
            }
        }
        if (is_array($xe_order)) {
            foreach ($xe_order as $key => $value) {
                $user = M('user')->where(array('id'=>$value['shopid']))->field('merchant,cover')->find();
                $xe_order[$key]['merchant'] = $user['merchant'];
                $xe_order[$key]['cover'] = $user['cover'];
            }
        }*/
		$this->assign('jr_order',$jr_order);
        $this->assign('zg_order',$zg_order);
        $this->assign('xe_order',$xe_order);
        $this->display();
    }
    /*
     *  查看代理商的待结算订单详情
     *  @author vany
     *  date 2016-1-7
     */
    public function fcorder_check(){
        $id     = $this->visitor->info['id'];
        $orderid = $this->_get('orderid','trim');
        $order   = M('item_order')
                    ->join("a left join __USER__ as b on a.shopid = b.id")
                    ->where(array('orderId'=>$orderid))
                    ->field('a.*,b.merchant')
                    ->find();
        !$order && $this->error("订单不存在！");
        $order_detail = M('order_detail')
                        ->where(array('orderId'=>$orderid))
                        ->select();

        foreach($order_detail as $key => $val){
            $shop_shares = $this->getShareTree($val['shopid']);//获取获得提成的用户ID
            foreach($shop_shares['uid'] as $sk=>$sv){
                $lvId .=$sv;
            }
            $roy = M('user_fengchenglv')->where(array('id'=>$lvId))->field('royalty')->find();//获取各级别的分成率
            $royArr = explode('|',$roy['royalty']);
			$lvId = '';
        }
        foreach ($shop_shares['shareId'] as $fk => $fv){
                if($fv==$id){
                    $margin = $royArr[$fk];
                }
        }

        foreach ($order_detail as $key => $value) {
            $fencheng += $value['profit']*$margin;
        }

        $otitle = M('order_detail')->where(array('id'=>$_GET['oid']))->getField('title');
        $this->assign("order",$order);
        $this->assign("order_detail",$order_detail);
        $this->assign("fencheng",$fencheng);
        $this->assign("otitle",$otitle);
        $this->display();
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
    /******************************************佣金*******************************************************/
    public function yongjin(){
            $uid=$this->visitor->info['id'];
            $fenchenglist=M('user_fengchengllist');
            $keti_jine =$fenchenglist->where(array('uid'=>$this->visitor->info['id'],'state'=>1))->sum('fencheng');
            $keti_jine = $keti_jine ? $keti_jine : 0;
            $keti_jine=round($keti_jine,2);
            //已经提现的金额
            $yiti_jine = $fenchenglist->where(array('uid'=>$this->visitor->info['id'],'state'=>0))->sum('fencheng');
            $yiti_jine = $yiti_jine ? $yiti_jine : 0;
            //正在申请的提现的金额
            $wherenum2['uid'] = $uid;
            $wherenum2['state'] = 2;//正在申请提现状态
            $zhengtx_jine =$fenchenglist->where($wherenum2)->sum('fencheng');//正在申请提现的总金额
            $zhengtx_jine = $zhengtx_jine ? $zhengtx_jine : 0;
            //昨日佣金
            $data['uid']=$uid;
            $data['state']=1;
            $data['add_time']=array('between',array(strtotime(date('Y-m-d 0:0:0',time()))-24*60*60,strtotime(date('Y-m-d 0:0:0',time()))));
            $ztyj_jine=$fenchenglist->where($data)->sum('fencheng');
            $ztyj_jine = $ztyj_jine ? $ztyj_jine : 0;
            //获取冻结金额
            $set=M('set')->find();//获取后台配置冻结期天数
            $data['add_time']=array('between',array(strtotime(date('Y-m-d 0:0:0',time())-24*60*60*$set['tx_djq']),strtotime(date('Y-m-d H:i:s',time()))));
            $djyj_jine=$fenchenglist->where($data)->sum('fencheng');
            $djyj_jine = $djyj_jine ? $djyj_jine : 0;
            //获取近一周佣金金额
            $data['add_time']=array('between',array(strtotime(date('Y-m-d 0:0:0',time())-24*60*60*7),strtotime(date('Y-m-d H:i:s',time()))));
            $week_jine=$fenchenglist->where($data)->sum('fencheng');
            $week_jine = $week_jine ? $week_jine : 0;
            //获取近一个月的佣金金额
            $data['add_time']=array('between',array(strtotime(date('Y-m-t 0:0:0',time())-24*60*60*31),strtotime(date('Y-m-d H:i:s',time()))));
            $month_jine=$fenchenglist->where($data)->sum('fencheng');
            $month_jine = $month_jine ? $month_jine : 0;
            //获取可提现金额
            $keti_jine = $keti_jine - $yiti_jine-$zhengtx_jine;
            $keti_jine=round($keti_jine,2);
            $this->assign('month_jine',$month_jine);
            $this->assign('week_jine',$week_jine);
            $this->assign('djyj_jine',$djyj_jine);
            $this->assign('ztyj_jine',$ztyj_jine);
            $this->assign('keti',$keti_jine);
            $this->assign('yiti',$yiti_jine);
            $this->assign('zhengtx',$zhengtx_jine);
            $this->display();
    }
    /****************************************用户的评论信息******************************************/
    public function comment_list(){

        $id = $this->visitor->info['id'];
        //获取该用户所有未评论的订单信息
        $ordermsg0 = M('item_order')->field('a.id,a.status,a.orderid')->join('a left join weixin_item_comment b on a.orderId=b.orderId')->order('orderId DESC')->where(array('a.userId'=>$id,'a.c_status'=>0,'a.status'=>4))->select();
        //获取该用户所有已评论的订单信息
        $ordermsg1 = M('item_order')->field('a.id,a.status,a.orderid')->join('a left join weixin_item_comment b on a.orderId=b.orderId')->order('orderId DESC')->where(array('a.userId'=>$id,'a.c_status'=>1))->select();

        $this->assign('ordermsg0',$ordermsg0);
        $this->assign('ordermsg1',$ordermsg1);

        $this->display();
    }
    /**
     * 订单列表
     */
      public function orderlist(){
		 $order_time = strtotime('2016-09-23 15:00:00');
         $_SESSION['red_bag']="";
        //获取订单状态
        $status = isset($_GET['status']) ? intval($_GET['status']) : 1;//待付款
        //当前用户的信息
        $userid = $this->visitor->info['id'];
        $uid = $this->visitor->info['uid'];
        //获取对应的订单
        $item_order=M('item_order');
        $order_detail=M('order_detail');
        $where=array('status' => $status,'userId' => $userid,'is_delete' => 0);

        $item_orders= $item_order->order('id desc')->where($where)->select();
        $count=count($item_orders);

        $item_orders2= $item_order->where(array('status'=>2,'userId'=>$userid))->select();
        $count2=count($item_orders2);

        /*  $item_orders_all= $item_order->order('id desc')->where($where)->select();
        $count_all=count($item_orders_all);
        */
        //获取商品属性
        foreach ($item_orders as  $key=>$val)
        {
            $order_details= $order_detail->where("orderId='".$val['orderId']."'")->select();
            foreach ($order_details as $k=>$val)
            {
                $items_attr=$val['item_attr'];//商品属性
                $attr_arr=array_filter(explode(";",$items_attr));
                $attr_list=array();
                foreach($attr_arr as $ke=>$va){
                    $attr_arr2=array_filter(explode("|",$va));
                    $attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
                }
                $items['attr']=$attr_list;//赋值items
                $items= array('title'=>$val['title'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'color'=>$val['color'],'size'=>$val['size'],'itemId'=>$val['itemId'],'attr'=>$items['attr'],'detail_id'=>$val['id'],'status'=>$val['status'],'send_time'=>$val['send_time']);
                $item_orders[$key]['item'][]=$items;
                $item_orders[$key]['count'] += $val['quantity'];
                $item_orders[$key]['totalprice'] += $val['quantity']*$val['price'];
            }
        }
		$this->assign('order_time',$order_time);
        $this->assign('status',$status);
        //dump($item_orders);
        $this->assign('item_orders',$item_orders);
        $this->assign('count',$count);
        $this->assign('count2',$count2);
        /*  $this->assign('item_orders_all',$item_orders_all);
        $this->assign('count_all',$count_all);*/
        $this->display();
    }

      public function order_list(){
		//检查有无清关中的订单清关天数大于3天的，有则刷新为待收货订单
		$itms = M('item_order')->where(array('status'=>9,'qg_time'=>array('lt',time()-3*24*3600)))->field('id,orderId')->select();
		foreach($itms as $key=>$val){
			M('item_order')->where(array('id'=>$val['id']))->save(array('status'=>3));
			M('order_detail')->where(array('orderId'=>$val['orderId'],'status'=>9))->save(array('status'=>3));
		}
		//异常订单被处理后转为正常状态
		$itmords = M('item_order')->where(array('status'=>10))->field('id,orderId')->select();
		foreach($itmords as $key=>$val){
			if(M('order_detail')->where(array('orderId'=>$val['orderId'],'status'=>10))->count()==0){
				M('item_order')->where(array('id'=>$val['id']))->save(array('status'=>3));
			}
		}
		//请关订单被处理后转为正常状态
		$itmords = M('item_order')->where(array('status'=>9))->field('id,orderId')->select();
		foreach($itmords as $key=>$val){
			if(M('order_detail')->where(array('orderId'=>$val['orderId'],'status'=>9))->count()==0){
				M('item_order')->where(array('id'=>$val['id']))->save(array('status'=>3));
			}
		}
		$order_time = strtotime('2016-09-23 15:00:00');
        $_SESSION['red_bag']="";
        $user_level = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('uid');
        if($_GET['shopid']){
            $this->assign('shopid',1);
            $data['shopid'] = $this->visitor->info['id'];
            if($this->visitor->info['uid']==4){
                unset($data['shopid']);//普通用户没有该条件
                $data['userId']=$this->visitor->info['id'];
            }
        }else{
             $data['userId']=$this->visitor->info['id'];
        }
        $data['is_delete'] = 0;
        $this->assign('order_status',0);
		if(isset($_GET['keyword'])){
            $keyword=$this->_get('keyword','trim');
            if ($keyword=='one') {   //最近一个月
                $data['add_time']=array('gt',strtotime(date('Y-m-01',time())));
                $this->assign('order_status',1);
            }else if($keyword=='two') {    //最近三个月
                $data['add_time']=array('gt',strtotime(date('Y-m-01 h:i:s',strtotime('-3 month'))));
                $this->assign('order_status',2);
            }else if($keyword=='three'){   //三个月之前
                $data['add_time']=array('lt',strtotime(date('Y-m-01 h:i:s',strtotime('-3 month'))));
                $this->assign('order_status',3);
            }else if ($keyword=='itemtype1') {   //完税
                $data['orderId']=array('like','%-02%');
                $this->assign('order_status',4);
            }else if($keyword=='itemtype2') {    //保税
                $data['orderId']=array('like','%-01%');
                $this->assign('order_status',5);
            }else if($keyword=='status1'){   //待付款
                 $data['status']=1;
                 $this->assign('order_status',6);
            }else if($keyword=='status2'){   //待发货
                 $data['status']=2;
                 $this->assign('order_status',7);
            }else if($keyword=='status3'){   //清关中
                 $data['status']=9;
                 $this->assign('order_status',8);
            }else if($keyword=='status4'){   //待收货
                 $data['status']=3;
                 $this->assign('order_status',9);
            }else if($keyword=='status5'){   //已完成
                 $data['status']=4;
                 $this->assign('order_status',10);
            }else if($keyword=='status6'){   //退货中
                 $data['status']=6;
                 $this->assign('order_status',11);
            }else if($keyword=='status7'){   //退款中
                 $data['status']=11;
                 $this->assign('order_status',12);
            }else if($keyword=='status8'){   //退款成功
                 $data['status']=8;
                 $this->assign('order_status',13);
            }else if($keyword=='status9'){   //异常订单（缺货或清关抽查）
                 $data['status']=10;
                 $this->assign('order_status',14);
            }else if($keyword=='status10'){   //异常订单（缺货或清关抽查）
                 $data['status']=7;
                 $this->assign('order_status',15);
            }else{
                 $data['orderId'] = array('like','%'.$keyword.'%');
                 $data['userId'] = $this->visitor->info['id'];
                 if(isset($data['shopid'])){
                     $data['shopid'] = $data['shopid'];
                     unset($data['shopid']);
                 }
            }
        }
        $res=M('item_order')->where($data)->order('add_time desc')->select();
        //获取商品属性
        foreach ($res as  $key=>$val)
        {
            $order_details=M('order_detail')->where("orderId='".$val['orderId']."'")->select();
            foreach ($order_details as $k=>$val)
            {
                $items_attr=$val['item_attr'];//商品属性
                $attr_arr=array_filter(explode(";",$items_attr));
                $attr_list=array();
                foreach($attr_arr as $ke=>$va){
                    $attr_arr2=array_filter(explode("|",$va));
                    $attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
                }
				if($val['add_time']>1480298400){
					$margin = M('user_fengchenglv')->where(array('id'=>$user_level))->getField('royalty');
				}else{
					$margin = 0.4;
				}
                $res[$key]['profit'] += round($val['profit']*$margin,2);
                $items['attr']=$attr_list;//赋值items
                //$res[$key]['profit'] += round($val['profit']*$val['fencheng'],2);
                $items= array('title'=>$val['title'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'color'=>$val['color'],'size'=>$val['size'],'itemId'=>$val['itemId'],'attr'=>$items['attr'],'detail_id'=>$val['id'],'status'=>$val['status'],'send_time'=>$val['send_time']);
                $res[$key]['item'][]=$items;
                $res[$key]['count'] += $val['quantity'];
                $res[$key]['totalprice'] += $val['quantity']*$val['price'];
            }
        }
		$this->assign('order_time',$order_time);
        $this->assign('userid',$this->visitor->info['id']);
        $this->assign('time',$time);
        $this->assign('user_level',$user_level);
        $this->assign('order',$res);
        $this->display();
    }
    /**
     * 退货记录
     */
    public function tuihuojilu(){
        //获取订单状态
        $status = '(6,7,8)';
        //当前用户的信息
        $userid = $this->visitor->info['id'];
        $cateid = $this->visitor->info['uid'];

        //获取对应的订单
        $item_order=M('item_order');
        $order_detail=M('order_detail');
        if($cateid == 3 || $cateid == 4){
            //加盟商
            $item_orders= $item_order->order('id desc')->where('status in '.$status.' and userId='.$userid)->select();

        }else{
            //代理商
            $item_orders = M('user_ordermsg')->field('b.*')->join("a left join weixin_item_order b on a.orderid=b.orderId")->where('a.dl_id='.$userid.' and a.status in '.$status)->select();

        }

        //获取商品属性
        foreach ($item_orders as  $key=>$val)
        {
            $order_details= $order_detail->where("orderId='".$val['orderId']."'")->select();
            foreach ($order_details as $k=>$val)
            {
                $items_attr=$val['item_attr'];//商品属性
                $attr_arr=array_filter(explode(";",$items_attr));
                $attr_list=array();
                foreach($attr_arr as $ke=>$va){
                    $attr_arr2=array_filter(explode("|",$va));
                    $attr_list[]=array('name'=>$attr_arr2[0],'value'=>$attr_arr2[1]);
                }
                $items['attr']=$attr_list;//赋值items
                $items= array('title'=>$val['title'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'color'=>$val['color'],'size'=>$val['size'],'itemId'=>$val['itemId'],'attr'=>$items['attr']);
                $item_orders[$key]['item'][]=$items;
            }
        }
        header('content-type:text/html;charset=utf-8');
        //用户收款信息
        $this->assign('huming',$this->visitor->info['huming']);
        $this->assign('kaihuhang',$this->visitor->info['kaihuhang']);
        $this->assign('zhanghao',$this->visitor->info['zhanghao']);
        $this->assign('phone_mob',$this->visitor->info['phone_mob']);

        $state = array(
                6 => '申请退款中',
                7 => '退款失败',
                8 => '退款成功',
        );
        $this->assign('state',$state);
        $this->assign('status',$status);
        $this->assign('item_orders',$item_orders);
        $this->display();
    }



        //收藏商品
     public function shoucang() {
        $item_likeMd = M('item_like');
        $uid = $this->visitor->info['id'];
        $where['uid'] = $uid;
        $item_likeArr = $item_likeMd->where($where)->order('add_time DESC')->select();
        $itemshoucang = M('item');
        $itemArr = array();
        foreach($item_likeArr as $n=> $val){
                $item = $itemshoucang->where('id='.$val['item_id'].'')->select();
                $item = $item[0];
                array_push($itemArr,$item);
            }
        //相同名字的,肯定不可能设置多次给模版的,会互相覆盖的

        //会员分组
        if($this->visitor->info){
            $id=$this->visitor->info['uid'];
            $user_category =M('user_category')->field('discount,id,name')->where(array('id' =>$id))->find();
            $this->assign('user_category', $user_category);
        }
        $this->assign('itemArr',$itemArr);
        $this->assign('shares_id',$val['uid']);
        $this->assign('count',count($itemArr));
        $this->display();
    }


    //我的仓库
    public function cangku(){
        $uid = $_SESSION['user_info']['id'];
        //获取当前用户的仓库信息
        $cangku = D('user_cangku');
        $cangkuinfo = $cangku->where(array('userid'=>$uid))->select();
        $items = D('item')->field('id,title,img,size')->select();
        $iteminfo = array();
        foreach ($items as $v){
            $iteminfo[$v['id']] = $v;
            $size[$v['id']]=explode('|',$v['size']);
        }
        $this->assign('size',$size);
        //var_dump($iteminfo);exit;
        $this->assign('cangkuinfo',$cangkuinfo);
        $this->assign('iteminfo',$iteminfo);
        $this->display();
    }


    public function juti(){
        $uid = $this->visitor->info['id'];
        $user_fengchengllist = M('user_fengchengllist');
        $user = D('user');
        $userArray = array();

        if($_GET['type'] == 1){
            //查看所有将要提现的金额
            $item_jifennum = 0;
            $item_jifennum1 = 0;
            $wherenum['uid'] = $uid;
            $wherenum['state'] = 1;

            $username = addslashes(trim($_GET['u']));

            //获取所有下线的将提金额
            $fclArr = $user_fengchengllist->where($wherenum)->select();
            foreach ($fclArr as $k=>$v){
                //获取用户信息
                if(!array_key_exists( $v['user_id'], $userArray)){
                    $userinfo = $user->find($v['user_id']);
                    $userArray[$v['user_id']] = $userinfo;
                }


                $item_jifennum += $v['fencheng'];
                $fclArr[$k]['is_ti'] = 1;
            }

            $now = date('n');

            if($now == 1){
                $last1 = 12;
                $last2 = 11;
                $last3 = 10;
            }elseif($now == 2){
                $last1 = 1;
                $last2 = 12;
                $last3 = 11;
            }elseif($now == 3){
                $last1 = 2;
                $last2 = 1;
                $last3 = 12;
            }else{
                $last1 = $now - 1;
                $last2 = $now - 2;
                $last3 = $now - 3;
            }

            if($now < 10){
                $now = '0' . $now;
            }
            if($last1 < 10){
                $last1 = '0' . $last1;
            }
            if($last2 < 10){
                $last2 = '0' . $last2;
            }
            if($last3 < 10){
                $last3 = '0' . $last3;
            }
            $this->assign('now',$now);
            $this->assign('last1',$last1);
            $this->assign('last2',$last2);
            $this->assign('last3',$last3);
            $this->assign('item_jifennum',$item_jifennum);
            $this->assign('item_jifennum1',$item_jifennum1);
            $this->assign('userArray',$userArray);
            $this->assign('fclArr',$fclArr);

            $this->display();
        }
    }

    //分成   2016-07-11 Modify by Liuyumei
    public function fencheng() {
        $res=$this->allfenxiao();
        $lv1=array();//掌柜
        $lv2=array();//店长
        $lv3=array();//经纪人
        $n=$_GET['n'];
        foreach ($res as $key => $value) {
            if ($value['uid']==2) {
                    array_push($lv1, $value);
            }elseif($value['uid']==3){
                    array_push($lv2, $value);
            }else{
                array_push($lv3, $value);
            }
        }

        $this->assign('n',$n);
        $this->assign('uid',$this->visitor->info['uid']);
        $this->assign('count1',count($lv1));
        $this->assign('count2',count($lv2));
        $this->assign('count3',count($lv3));

        $this->assign('lv1',$lv1);
        $this->assign('lv2',$lv2);
        $this->assign('lv3',$lv3);
        $this->display();
    }
    //分成记录
    public function fenchenglist() {
        $time=$_GET['time'];

        $user_fengchengllist = M('user_fengchengllist');
        $uid = $this->visitor->info['id'];
        $data['uid'] = $uid;
        //获取当前用户的所有下线提成数组
        $data['userId']=$this->visitor->info['id'];
        if ($time=='one') {
            $data['add_time']=array('gt',strtotime(date('Y-m-01',time())));
           $item_jifenArr = $user_fengchengllist->where($data)->order('id DESC')->select();

        }elseif($time=='two') {
            $data['add_time']=array('gt',strtotime(date('Y-m-01 h:i:s',strtotime('-3 month'))));
          $item_jifenArr = $user_fengchengllist->where($data)->order('id DESC')->select();
        }else{
             $data['add_time']=array('lt',strtotime(date('Y-m-01 h:i:s',strtotime('-3 month'))));
            $item_jifenArr = $user_fengchengllist->where($data)->order('id DESC')->select();
        }

        $users = M('user');
        $usersArr = array();
        foreach($item_jifenArr as $n=> $val){
            //遍历，获取每个下线的名字
            $user = $users->field('username')->where(array("id"=>$val['user_id']))->select();
            $user = $user[0];
            array_push($usersArr,$user);
        }

        //冻结提成与非冻结提成
        $item_jifennum = 0;//非冻结
        $item_jifennum1 = 0;//冻结
        $wherenum['uid'] = $uid;
        $wherenum['state'] = 1;
        //获取所有下线的可提现的金额
        $fclArr = $user_fengchengllist->where($wherenum)->select();
        //判断该笔提成是否可提取——消费额
        $setting=M('set')->find();
        //判断是冻结还是可提现
        $nowTime = time();
        for($i=0; $i<count($fclArr); $i++) {
            $fcl = $fclArr[$i];
            $add_time = $fcl["add_time"];
            if($nowTime - $add_time > $setting['tx_djq']*24*3600) {
                $item_jifennum += $fcl["fencheng"];//非冻结金额
            } else {
                //冻结
                $item_jifennum1 += $fcl["fencheng"];
            }
        }

        //正在申请提现的金额
        $wherenum3['uid'] = $uid;
        $wherenum3['state'] = 2;
        $item_jifennum3 = $user_fengchengllist->where($wherenum3)->sum('fencheng');

        //已经提现的金额
        $wherenum2['uid'] = $uid;
        $wherenum2['state'] = 0;
        $item_jifennum2 = $user_fengchengllist->where($wherenum2)->sum('fencheng');

        //退款应该减掉的提现的金额
        $wherenum4['uid'] = $uid;
        $wherenum4['state'] = 3;
        $item_jifennum4 = $user_fengchengllist->where($wherenum4)->sum('fencheng');
        $this->assign('item_jifennum',$item_jifennum);
        $this->assign('item_jifennum1',$item_jifennum1);
        $this->assign('item_jifennum2',$item_jifennum2);
        $this->assign('item_jifennum3',$item_jifennum3);
        $this->assign('item_jifennum4',$item_jifennum4);
        $this->assign('item_jifenArr',$item_jifenArr);
        $this->assign('usersArr',$usersArr);
        $this->assign('time',$time);
        $this->display();
    }

    //提现页面
    public function tixian() {
        $user_fengchengllist = M('user_fengchengllist');
        $usersMd = M('user');
        $uid = $this->visitor->info['id'];
            //$uid = 126;
      //冻结提成与非冻结提成
      $item_jifennum = 0;
      $item_jifennum1 = 0;
      $wherenum['uid'] = $uid;
      $wherenum['state'] = 1;//可提现金额状态
      $fclArr = $user_fengchengllist->where($wherenum)->select();
      $nowTime = time();
      $res=M('set')->find();
      for($i=0; $i<count($fclArr); $i++) {
          $fcl = $fclArr[$i];
          $add_time = $fcl["add_time"];//冻结时间
          if($nowTime - $add_time > 0) {
              $item_jifennum += $fcl["fencheng"];//计算可提现非冻结总金额
          } else {
              $item_jifennum1 += $fcl["fencheng"];
          }
      }
        //已经提现的金额
        $wherenum2['uid'] = $uid;
        $wherenum2['state'] = 0;//已经提现成功
        $item_jifennum2 = $user_fengchengllist->where($wherenum2)->sum('fencheng');//已经提现成功的总金额
        $item_jifennum2=$item_jifennum2 ? $item_jifennum2 : 0;
        //正在申请的提现的金额
        $wherenum2['uid'] = $uid;
        $wherenum2['state'] = 2;//正在申请提现状态
        $item_jifennum3 = $user_fengchengllist->where($wherenum2)->sum('fencheng');//正在申请提现的总金额
        $item_jifennum3=$item_jifennum3 ? $item_jifennum3 : 0;
        //获取可提现金额
        $keti=$item_jifennum-$item_jifennum2-$item_jifennum3;
        $keti=$keti ? $keti : 0;
        $userstixian = $usersMd->where(array('id' => $uid))->find();
        $bank=M('bank')->where(array('id'=>$userstixian['kaihuhang']))->find();
        $this->assign('userstixian',$userstixian);
        $this->assign('bank',$bank);
        $this->assign('keti',$keti);
        if (IS_POST){
            $where['uid'] = $uid;
            $item_jifenArr = $user_fengchengllist->where($where)->order('id DESC')->select();
            $users = M('user');
            $usersArr = array();
            foreach($item_jifenArr as $n=> $val){
                $user = $users->field('username')->where(array("id"=>$val['user_id']))->select();
                $user = $user[0];
                array_push($usersArr,$user);
            }
            if ($_POST['fencheng'] == 0) {
                echo json_encode(array("error"=>"申请失败,金额不能为0"));
                return;
            }
            if ($_POST['zhanghao'] == '' || $_POST['zhanghao']=='' ||  $_POST['kaihuhang']=='') {
                echo json_encode(array("error"=>"提交申请失败,请在用户中心完善银行卡信息!","status"=>0));
                return;
            }
            if($item_jifennum-$item_jifennum2-$item_jifennum3-intval($_POST['fencheng'])> $res['tx_money']){
                $tixian = M('user_fengchengllist');
                $uid = $this->visitor->info['id'];
                $data = array();
                $data["fencheng"] = $_POST['fencheng'];
                $data["zhanghao"] = $_POST['zhanghao'];
                $data["huming"] = $_POST['huming'];
                $data["kaihuhang"] = $_POST['kaihuhang'];
                $data["state"] = 2;
                $data["uid"] = $uid;
                $data["add_time"] = time();
                $tixian->add($data);
                echo json_encode(array("success"=>"申请提交成功,我们会尽快处理您的申请!"));
                return;
            }else{
                echo json_encode(array("error"=>"申请提交失败! 您的可提现提成金额不足!"));
                return;
            }
        }
        $this->display();
    }
    public function bank(){
        if (IS_POST) {
            $data['id']=$this->visitor->info['id'];
            $data['huming']=$_POST['huming'];
            $data['zhanghao']=$_POST['zhanghao'];
            $data['kaihuhang']=$_POST['kaihuhang'];
            $res=M('user')->save($data);
            if ($res!==false) {
                $this->success('保存成功!',U('User/tixian'));
            }else{
                $this->error('更新失败!');
            }
        }else{
            $bank=M('bank')->select();
            $user=M('user')->where(array('id'=>$this->visitor->info['id']))->find();
            $this->assign('user',$user);
            $this->assign('bank',$bank);
            $this->display();
        }
    }

    public function xiaofei(){
            $uid = $this->visitor->info['id'];
            $user_fengchengllist = M('user_fengchengllist');
            $user = D('user');
            $userArray = array();

            //查看所有将要提现的金额
            $item_jifennum = 0;
            $item_jifennum1 = 0;
            $wherenum['uid'] = $uid;
            $wherenum['state'] = 1;

            $username = addslashes(trim($_GET['u']));

            //获取所有下线的将提金额
            $fclArr = $user_fengchengllist->where($wherenum)->select();
            foreach ($fclArr as $k=>$v){
                //获取用户信息
                if(!array_key_exists( $v['user_id'], $userArray)){
                    $userinfo = $user->find($v['user_id']);
                    $userArray[$v['user_id']] = $userinfo;
                }
                $fclArr[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
                $item_jifennum += $v['fencheng'];
                $fclArr[$k]['is_ti'] = 1;
            }
            //获取所有分销商的消费额
            $xiaofeie = array();
            //var_dump($userArray);
            foreach ($userArray as $k=>$v){
                $x1 = $this->getXiaoFei($k);
                $x2 = $this->getXiaoFei($k,2);
                $x3 = $this->getXiaoFei($k,3);
                $xiaofeie[$k]['l1'] = empty($x1) ? 0 :$x1;
                $xiaofeie[$k]['l2'] = empty($x2) ? 0 :$x2;
                $xiaofeie[$k]['l3'] = empty($x3) ? 0 :$x3;
            }

            $this->assign('xiaofeie',$xiaofeie);
            //当前用户消费额
            $curuser = array();
            $cx1 = $this->getXiaoFei($uid);
            $cx2 = $this->getXiaoFei($uid,2);
            $cx3 = $this->getXiaoFei($uid,3);
            $curuser['l1'] = empty($cx1) ? 0 :$cx1;
            $curuser['l2'] = empty($cx2) ? 0 :$cx2;
            $curuser['l3'] = empty($cx3) ? 0 :$cx3;
            $curuser['username'] = $this->visitor->info['username'];
            $this->assign('curuser',$curuser);

            $now = date('n');
            if($now == 1){
                $last1 = 12;
                $last2 = 11;
                $last3 = 10;
            }elseif($now == 2){
                $last1 = 1;
                $last2 = 12;
                $last3 = 11;
            }elseif($now == 3){
                $last1 = 2;
                $last2 = 1;
                $last3 = 12;
            }else{
                $last1 = $now - 1;
                $last2 = $now - 2;
                $last3 = $now - 3;
            }

            $this->assign('last1',$last1);
            $this->assign('last2',$last2);
            $this->assign('last3',$last3);
            $this->assign('item_jifennum',$item_jifennum);
            $this->assign('item_jifennum1',$item_jifennum1);
            $this->assign('userArray',$userArray);
            $this->assign('fclArr',$fclArr);

            $this->display();

    }

    //获取用户消费额
    public function getXiaoFei($uid, $when = 1){
        $role = M('user')->field('uid')->find($uid);
        $role = $role['uid'];
        $y = date('Y');
        $m = date('m');

        if($m == 1){
            if($when >= 1){
            $y = $y - 1;
                $m = 13-$when;
            }else{
                $m = $m-$when;
            }
        }elseif($m == 2){
            if($when >= 2){
                $y = $y - 1;
                $m = 14-$when;
            }else{
                $m = $m-$when;
            }
        }elseif($m == 3){
            if($when >= 3){
                $y = $y - 1;
                $m = 15-$when;
            }else{
                $m = $m-$when;
            }
        }else{
            $m = $m-$when;
        }

        if($m<10){
            $m = "0".$m;
        }
        $ym = $y.$m;

        $sum = 0;

        //获取当前用户的消费额
        $order = D('item_order');
        if($role == 3){
            $res = M('user_lvup')->field('up_time')->where(array('userid'=>$uid))->find();
            $y0 = date("Y",$res['up_time']);
            $m0 = date("m",$res['up_time']);

            $y = date('Y');
            $m = date('m');

            if($y == $y0){
                $cha = $m - $m0;
            }else{
                $cha = 12 + $m - $m0;
            }

            if($cha >= 0 && $cha < $when){
                $orders = M('user_ordermsg')->field('b.*')->join('a left join weixin_item_order b on a.orderid=b.orderId')->where('a.dl_id='.$uid.' and b.status in (2,3,4,5)')->select();
            }else{
                $orders = $order->where ('userId='.$uid.' and status in (2,3,4,5)')->select();
            }
            //var_dump($orders);exit;
        }else{
            $orders = M('user_ordermsg')->field('b.*')->join('a left join weixin_item_order b on a.orderid=b.orderId')->where('a.dl_id='.$uid.' and b.status in (2,3,4,5)')->select();
        }

        foreach ($orders as $k => $v){
            if(date("Ym",$v['add_time']) == $ym){
                //echo "<hr>".$v['goods_sumPrice']."<hr>";
                $sum += $v['goods_sumPrice'];
            }
        }
        //echo $sum."-----".$uid."<br>";
        return $sum;
    }

    //判断当前数组能否提现
    public function is_ti($array){
        //判断当前订单相隔几个月
        $num = $this->getCha($array['add_time']);

        if($num == 1){
            $curuser = $this->getXiaoFei($array['uid']);
            $taruser = $this->getXiaoFei($array['user_id']);

            if($curuser >= $taruser){

                if($this->roleJudge($array['uid'],$array['user_id'])){
                    return true;
                }else{

                    if($this->lvupJudge($array)){

                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }elseif($num == 2){
            $curuser1 = $this->getXiaoFei($array['uid']);
            $taruser1 = $this->getXiaoFei($array['user_id']);
            if($curuser1 > $taruser1){
                $curuser2 = $this->getXiaoFei($array['uid'],2);
                $taruser2 = $this->getXiaoFei($array['user_id'],2);
                if(($curuser1+$curuser2) >= ($taruser1+$taruser2)){
                    if($this->roleJudge($array['uid'],$array['user_id'])){
                        return true;
                    }else{
                        if($this->lvupJudge($array)){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }elseif($num == 3){
            $curuser1 = $this->getXiaoFei($array['uid']);
            $taruser1 = $this->getXiaoFei($array['user_id']);
            if($curuser1 > $taruser1){
                $curuser2 = $this->getXiaoFei($array['uid'],2);
                $taruser2 = $this->getXiaoFei($array['user_id'],2);
                if(($curuser1+$curuser2) >= ($taruser1+$taruser2)){
                    $curuser3 = $this->getXiaoFei($array['uid'],3);
                    $taruser3 = $this->getXiaoFei($array['user_id'],3);
                    if(($curuser1+$curuser2+$curuser3) > ($taruser1+$taruser2+$taruser3)){
                        if($this->roleJudge($array['uid'],$array['user_id'])){
                            return true;
                        }else{
                            if($this->lvupJudge($array)){
                                return true;
                            }else{
                                return false;
                            }
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    //获取相隔几个月
    public function getCha($otime){
        $oy = date("n",$otime);//下订单时间
        $y = date('n',time());//当前时间，n表示月份
        if($y < $oy){
            $cha = (12 + $y) - $oy;
            return $cha;
        }
        return $y - $oy;
    }

    /**
     * 判断代理加盟商
     */
    public function roleJudge($uid,$user_id){
        $u1 = M('user')->find($uid);
        $role1 = $u1['uid'];
        $u2 = M('user')->find($user_id);
        $role2 = $u2['uid'];

        //要么都是加盟商，要么都是代理商，才可以拿提成
        if($role1 == $role2){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断角色关系
     */
    public function lvupJudge($array){
        $res = M('user_lvup')->field('up_time')->where(array('userid'=>$array['user_id']))->find();
        if(!$res){
            return true;
        }
        $ym0 = date("Ym",$res['up_time']);
        $ym1 = date("Ym",$array['add_time']);
        if($res['up_time'] < $array['add_time']){
            if($ym0 == ym1){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    //根据当前用户获得分成系统的一级A
    public function fc_A1_mlt() {
        $id = $this->visitor->info['id'];
        $uid = $this->visitor->info['uid'];
        $usrMd = M("user");
        $curMonth = date('n',time());
        if($uid == 3){
            //加盟商中心
            if($_GET['type'] == 1){
                //我的加盟商
                $usrArrDb = $usrMd->where(array("uid"=>3,"shares"=>$id,'status'=>1))->select();
            }elseif($_GET['type'] == 2){
                //我的代理商
                $usrArrDb = $usrMd->where(array("uid"=>4,"shares"=>$id,'status'=>1))->select();
            }
        }elseif($uid == 4){
            //代理商中心
            $usrArrDb = $usrMd->where(array("shares"=>$id,'status'=>1))->select();
        }
        $usrArr = array();
        for($i=0; $i<count($usrArrDb); $i++) {
            $usrDb = $usrArrDb[$i];
            //获取用户消费额
            $xiaofei = $this->getXiaoFei($usrDb["id"]);

            $usr = array("id"=>$usrDb["id"],'uid'=>$usrDb['uid'],"username"=>$usrDb["username"],'xiaofei'=>$xiaofei);
            array_push($usrArr,$usr);
        }
        echo json_encode($usrArr);
        return;
    }
    public function fc_B2C3D4E5_mlt() {
        $id = $_GET["id"];
        $uid = $this->visitor->info['uid'];
        $usrMd = M("user");
        if($uid == 3){
            //加盟商中心
            if($_GET['type'] == 1){
                //我的加盟商
                $usrArrDb = $usrMd->where(array("shares"=>$id,'status'=>1))->select();
            }else{
                //我的代理商
                $usrArrDb = $usrMd->where(array("shares"=>$id,'status'=>1))->select();
            }
        }else{
            //代理商中心
            $usrArrDb = $usrMd->where(array("shares"=>$id,'status'=>1))->select();
        }
        $usrArr = array();
        for($i=0; $i<count($usrArrDb); $i++) {
            $usrDb = $usrArrDb[$i];
            //获取用户消费额
            $xiaofei = $this->getXiaoFei($usrDb["id"]);

            //获取用户头像
            $faceurl = $usrMd->find($usrDb);
            $faceurl = $faceurl['cover'];
            $usr = array("id"=>$usrDb["id"],"uid"=>$usrDb['uid'],"username"=>$usrDb["username"],'xiaofei'=>$xiaofei,'faceurl'=>$faceurl);
            array_push($usrArr,$usr);
        }
        echo json_encode($usrArr);
        return;
    }

    /**
     * 查看所有分销商
     */
    public function allfenxiao(){
        $userid = $this->visitor->info['id'];
        $result=M('user')->where('id='.$userid)->field('username')->find();
        $user = D('user');
        $data = $user->getfenxiao($userid,$result['username']);

        $this->assign('data',$data);
        return $data;
        $this->apply();
    }

    /**
    * 删除收藏
    */
    public function shoucangFndel() {
        $id = $this->_get('id', 'intval');
        //先检查这个id号对应的item是否存在
        $itemMd = M('item');
        $item = $itemMd->where(array('id' => $id, 'status' => '1'))->find();
        if(!$item) {
            echo json_encode(array("error"=>"商品不存在!"));
            return;
        }
        $uid = $this->visitor->info['id'];
        $like_mod = M('item_like');
        if ($like_mod->where(array('uid' => $uid, 'item_id' => $id))->delete()) {
            //喜欢数不减少~
           echo json_encode(array("success"=>"删除成功!"));
        } else {
           echo json_encode(array("error"=>"删除失败!"));
           return;
        }
    }

    /**
     * 修改头像
     */
    public function upload_avatar() {

        if (!empty($_FILES['avatar']['name'])) {
            //会员头像规格
            $avatar_size = explode(',', C('pin_avatar_size'));
            //回去会员头像保存文件夹
            $uid = abs(intval($this->visitor->info['id']));
            $suid = sprintf("%09d", $uid);
            $dir1 = substr($suid, 0, 3);
            $dir2 = substr($suid, 3, 2);
            $dir3 = substr($suid, 5, 2);
            $avatar_dir = $dir1.'/'.$dir2.'/'.$dir3.'/';
            //上传头像
            $suffix = '';
            foreach ($avatar_size as $size) {
                $suffix .= '_'.$size.',';
            }
            $result = $this->_upload($_FILES['avatar'], 'avatar/'.$avatar_dir, array(
                'width'=>C('pin_avatar_size'),
                'height'=>C('pin_avatar_size'),
                'remove_origin'=>true,
                'suffix'=>trim($suffix, ','),
                'ext' => 'jpg',
            ), md5($uid));
            if ($result['error']) {
                $this->ajaxReturn(0, $result['info']);
            } else {
                $data = __ROOT__.'/data/upload/avatar/'.$avatar_dir.md5($uid).'_'.$size.'.jpg?'.time();
                $this->ajaxReturn(1, L('upload_success'), $data);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }

    /**
     * 修改密码
     */
    public function password() {
        if( IS_POST ){
            $oldpassword = $this->_post('oldpassword','trim');
            $password   = $this->_post('password','trim');
            $repassword = $this->_post('repassword','trim');
            !$password && $this->error(L('no_new_password'));
            $password != $repassword && $this->error(L('inconsistent_password'));
            $passlen = strlen($password);
            if ($passlen < 6 || $passlen > 20) {
                $this->error('password_length_error');
            }
            //连接用户中心
            $passport = $this->_user_server();
            $result = $passport->edit($this->visitor->info['id'], $oldpassword, array('password'=>$password));
            if ($result) {
                $msg = array('status'=>1, 'info'=>L('edit_password_success'));
            } else {
                $msg = array('status'=>0, 'info'=>$passport->get_error());
            }
            $this->assign('msg', $msg);
        }
        $this->_config_seo();
        $this->display();
    }

    /**
     * 帐号绑定
     */
    public function bind() {
        //获取已经绑定列表
        $bind_list = M('user_bind')->field('type')->where(array('uid'=>$this->visitor->info['id']))->select();
        $binds = array();
        if ($bind_list) {
            foreach ($bind_list as $val) {
                $binds[] = $val['type'];
            }
        }

        //获取网站支持列表
        $oauth_list = $this->oauth_list;
        foreach ($oauth_list as $type => $_oauth) {
            $oauth_list[$type]['isbind'] = '0';
            if (in_array($type, $binds)) {
                $oauth_list[$type]['isbind'] = '1';
            }
        }
        $this->assign('oauth_list', $oauth_list);
        $this->_config_seo();
        $this->display();
    }

    /**
     * 个人空间banner背景设置
     */
    public function custom() {
        $cover = $this->visitor->get('cover');
        $this->assign('cover', $cover);
        $this->_config_seo();
        $this->display();
    }

         /**
     * 我的积分
     */
    public function jifenlist() {


        $item_jifen = M('item_jifen');
        $uid = $this->visitor->info['id'];
        $where['uid'] = $uid;
        $item_jifenArr = $item_jifen->where($where)->order('add_time DESC')->select();

        $where2['uid'] = $uid;
        $where2['title'] = '注册赠送';
        $item_jifenArrtitle = $item_jifen->where($where2)->order('add_time DESC')->select();
        if(isset($item_jifenArrtitle)){
        }else {

            $data = array();
            $data["jifen"] = 100;
            $data["title"] = "注册赠送";
            $data["state"] = 1;
            $data["uid"] = $uid;
            $data["add_time"] = time();
            $item_jifen->add($data);
        }

        $usersMds = M('user');
        $uid = $this->visitor->info['id'];
        $usercover = $usersMds->where(array('id' => $uid))->find();
        if($usercover['cover'] == 1){
            $where3['uid'] = $uid;
            $where3['title'] = '完善资料';
            $item_jifenArrtitle = $item_jifen->where($where3)->order('add_time DESC')->select();
            if(isset($item_jifenArrtitle)){
            }else {

                $data = array();
                $data["jifen"] = 100;
                $data["title"] = "完善资料";
                $data["state"] = 1;
                $data["uid"] = $uid;
                $data["add_time"] = time();
                $item_jifen->add($data);
            }
        }else {
        }

        $wherenum['uid'] = $uid;
        $wherenum['state'] = 1;
        $item_jifennum = $item_jifen->where($wherenum)->sum('jifen');

        $wherenum1['uid'] = $uid;
        $wherenum1['state'] = 0;
        $item_jifennum1 = $item_jifen->where($wherenum1)->sum('jifen');

        $this->assign('item_jifennum',$item_jifennum);
        $this->assign('item_jifennum1',$item_jifennum1);
        $this->assign('item_jifenArr',$item_jifenArr);
        $this->display();

    }

     /**
     * 我的积分兑换
     */
    public function jifenduihuan() {

        $item_jifen = M('item_jifen');
        $uid = $this->visitor->info['id'];
        $where['uid'] = $uid;
        $item_jifenArr = $item_jifen->where($where)->order('add_time DESC')->select();

        $wherenum['uid'] = $uid;
        $wherenum['state'] = 1;
        $item_jifennum = $item_jifen->where($wherenum)->sum('jifen');

        $wherenum1['uid'] = $uid;
        $wherenum1['state'] = 0;
        $item_jifennum1 = $item_jifen->where($wherenum1)->sum('jifen');

        $this->assign('item_jifennum',$item_jifennum);
        $this->assign('item_jifennum1',$item_jifennum1);
        $this->assign('item_jifenArr',$item_jifenArr);
        $this->display();

    }

             /**
     * 我的积分兑换券
     */
    public function myduihuan() {

        $item_jifen = M('item_jifen');
        $uid = $this->visitor->info['id'];
        //未使用的优惠券
        $item_jifenArr = $item_jifen->query("select *, count(*) as ttl from __TABLE__ where state=0 and jifen!=0 and orderId is null and uid=".$uid." group by title order by title desc");

        $item_jifenArr2 = $item_jifen->query("select *, count(*) as ttl from __TABLE__ where state=0 and jifen=0 and orderId is null and uid=".$uid." group by title order by title desc");

        $wherenum['uid'] = $uid;
        $wherenum['state'] = 1;
        $item_jifennum = $item_jifen->where($wherenum)->sum('jifen');

        $wherenum1['uid'] = $uid;
        $wherenum1['state'] = 0;
        $item_jifennum1 = $item_jifen->where($wherenum1)->sum('jifen');

        //已经使用的优惠券
        $item_jifenArr3 = $item_jifen->where("uid='".$uid."' and state='0' and jifen!='0' and orderId is not null")->order('add_time DESC')->select();

        $this->assign('item_jifennum',$item_jifennum);
        $this->assign('item_jifennum1',$item_jifennum1);
        $this->assign('item_jifenArr',$item_jifenArr);
        $this->assign('item_jifenArr2',$item_jifenArr2);
        $this->assign('item_jifenArr3',$item_jifenArr3);
        $this->display();

    }
    /*怎样得到更多积分?*/
    public function jifenmore() {
        //$id = $this->_get('id', 'intval');
        //!$id && $this->redirect('index/index');
        $info = M('article_page')->find(44);
        $this->assign('info', $info);
        $this->assign('id', $id);
        $this->_config_seo();
        $this->display();
    }

    /**
     * 取消封面
     */
    public function cancle_cover() {
        $result = M('user')->where(array('id'=>$this->visitor->info['id']))->setField('cover', '');
        !$result && $this->ajaxReturn(0, L('illegal_parameters'));
        $this->ajaxReturn(1, L('edit_success'));
    }

    /**
     * 上传封面图片
     */
    public function upload_cover() {
        if (!empty($_FILES['cover']['name'])) {
            $data_dir = date('ym/d');
            $file_name = md5($this->visitor->info['id']);
            $result = $this->_upload($_FILES['cover'], 'cover/'.$data_dir, array('width'=>'900', 'height'=>'330', 'remove_origin'=>true), $file_name);
            if ($result['error']) {
                $this->ajaxReturn(0, $result['info']);
            } else {
                $ext = array_pop(explode('.', $result['info'][0]['savename']));
                $cover = $data_dir.'/'.$file_name.'_thumb.'.$ext;
                $data = '<img src="./data/upload/cover/'.$data_dir.'/'.$file_name.'_thumb.'.$ext.'?'.time().'">';
                //更新数据
                M('user')->where(array('id'=>$this->visitor->info['id']))->setField('cover', $cover);
                $this->ajaxReturn(1, L('upload_success'), $data);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }


    /************************
     *   修改默认地址
     *   edit_address()方法
     *   @author  May
     *   date    2016-07-19
     ************************/

    public function edit_address()
    {
       $user_address_mod = M('user_address');

       $id = $this->_get('id', 'intval');
       $data['is_default'] = 0;
       $user_address_mod->where(array('is_default' => 1))->save($data);
       $data['is_default'] = 1;
       /*$info = $user_address_mod->find($id);
       $this->assign('info', $info);
       $this->display();*/
       $result = $user_address_mod->where(array('id' =>$id))->save($data);
       $this->redirect(U('User/address'));
    }

    /*会员特权*/

     public function member() {
        //$id = $this->_get('id', 'intval');
        //!$id && $this->redirect('index/index');
        $info = M('article_page')->find(41);
        $this->assign('info', $info);
        $this->assign('id', $id);
        $this->_config_seo();
        $this->display();
    }


    /**
     * 收货地址
     */
    public function address() {
        $user_address_mod = M('user_address');
        $id = $this->_get('id', 'intval');
        $type = $this->_get('type', 'trim', 'edit');
        if ($id) {
            if ($type == 'del') {
                $user_address_mod->where(array('id'=>$id, 'uid'=>$this->visitor->info['id']))->delete();
                $msg = array('status'=>1, 'info'=>L('delete_success'));
                $this->assign('msg', $msg);
            }else{
                $info = $user_address_mod->find($id);
                $this->assign('info', $info);
                $_SESSION['addr_id']=$id;
            }
        }
        if(!$id || $type == 'del'){
            $this->assign('id',$_SESSION['addr_id']);
        }else{
            $this->assign('id',$id);
        }

        if (IS_POST) {
             $consignee = $this->_post('consignee', 'trim');
             $address = $this->_post('address', 'trim');
             //   $zip = $this->_post('zip', 'trim');
             $mobile = $this->_post('phone_mob', 'trim');
             $sheng = $this->_post('sheng', 'trim');
             $shi = $this->_post('shi', 'trim');
             $qu = $this->_post('qu', 'trim');
             $id = $this->_post('id', 'intval');
            if ($id) {
                $result = $user_address_mod->where(array('id'=>$id, 'uid'=>$this->visitor->info['id']))->save(array(
                'consignee' => $consignee,
                'address' => $address,
               // 'zip' => $zip,
                'mobile' => $mobile,
               'sheng' => $sheng,
               'shi' => $shi,
               'qu' => $qu,
                ));
                if ($result) {
                    $msg = array('status'=>1, 'info'=>L('edit_success'));
                } else {
                    $msg = array('status'=>0, 'info'=>L('edit_failed'));
                }
            } else {
                $result = $user_address_mod->add(array(
                    'uid' => $this->visitor->info['id'],
                    'consignee' => $consignee,
                    'address' => $address,
                    'zip' => $zip,
                    'mobile' => $mobile,
                ));
                if ($result) {
                    if($_GET['from'] == 'fahuo'){

                    }
                    $msg = array('status'=>1, 'info'=>L('add_address_success'));
                } else {
                    $msg = array('status'=>0, 'info'=>L('add_address_failed'));
                }
            }
            $this->assign('msg', $msg);
        }
        $address_list = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->select();

        $this->assign('address_list', $address_list);
        $this->_config_seo();
        $this->display();
    }

    /**
     * 修改用户
     */
    public function username() {
        $id = $this->visitor->info['id'];
        $user_mod= D('user');

        if( IS_POST ){
            $info = $user_mod->find($id);
            $editid = $this->_post('editid','trim');
            $date['nickname'] = $this->_post('nickname','trim');
            $date['address'] = $this->_post('address','trim');
            $date['phone_mob']   = $this->_post('phone_mob','trim');
            $date['email']   = $this->_post('email','trim');
            $date['bmonth']   = $this->_post('bmonth','trim');
            $date['bday']   = $this->_post('bday','trim');
            $date['zhanghao']   = $this->_post('zhanghao','trim');
            $date['huming']   = $this->_post('huming','trim');
            $date['kaihuhang']   = $this->_post('kaihuhang','trim');
            $date['gender']   = $this->_post('gender','trim');
            if (!empty($_FILES['avatar']['name'])) {
                    //会员头像规格
                    $avatar_size = explode(',', C('pin_avatar_size'));
                    //回去会员头像保存文件夹
                    $uid = abs(intval($this->visitor->info['id']));
                    $suid = sprintf("%09d", $uid);
                    $dir1 = substr($suid, 0, 3);
                    $dir2 = substr($suid, 3, 2);
                    $dir3 = substr($suid, 5, 2);
                    $avatar_dir = $dir1.'/'.$dir2.'/'.$dir3.'/';
                    //上传头像
                    $suffix = '';
                    foreach ($avatar_size as $size) {
                        $suffix .= '_'.$size.',';
                    }
                    $result = $this->_upload($_FILES['avatar'], 'avatar/'.$avatar_dir, array(
                        'width'=>C('pin_avatar_size'),
                        'height'=>C('pin_avatar_size'),
                        'remove_origin'=>true,
                        'suffix'=>trim($suffix, ','),
                        'ext' => 'jpg',
                    ), md5($uid));
                    if ($result['error']) {
                        $this->error($result['info']);
                        return;
                    } else {
                        //2016-04-24 by shuguang 添加 start
                        import('ORG.ThumbHandle');
                        //2016-04-24 by shuguang 添加图片居中截取
                        $path = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
                        $path = str_replace('\\','/',$path);
                        $imgparth = $path.'/data/upload/avatar/'.$avatar_dir.md5($uid).'_'.$size.'.jpg';
                        $imgparth_100 = $path.'/data/upload/avatar/'.$avatar_dir.md5($uid).'_100'.'.jpg';

                        $img = new ThumbHandle();

                        $img->param($imgparth)->thumb($imgparth, 200,200,1);//将生成的图片强制居中截取成200*200的图片

                        $img->param($imgparth)->thumb($imgparth_100, 100,100,1);//将原来生成的100高的图片，利用200的图片强制居中截取成100*100的图片
                        //2016-04-24 by shuguang 添加 end

                        $data = __ROOT__.'/data/upload/avatar/'.$avatar_dir.md5($uid).'_'.$size.'.jpg?'.time();
                    }
                }

                $date['hyimg'] = $data;

                $result = $user_mod->where(array('id' =>$id))->save($date);
                $this->success('修改成功', U('User/index'));
        }else{
            $info = $user_mod->find($id);
            $bank= $bank=M('bank')->order('id asc')->select();
            $this->assign('info', $info);
            $this->assign('bank',$bank);
            $this->_config_seo();
            $this->display();
        }
    }
    /************************
     *   修改用户资料
     *   user_info()方法
     *   @author  May
     *   date    2016-07-19
     ************************/
    public function user_info() {
        $id = $this->visitor->info['id'];
        $user_mod= D('user');

        if( IS_POST ){
            $info = $user_mod->find($id);
            $editid = $this->_post('id','trim');
            $date['nickname'] = $this->_post('username','trim');
            $date['phone_mob']   = $this->_post('phone_mob','trim');
            $date['email']   = $this->_post('email','trim');
            //$date['bmonth']   = $this->_post('bmonth','trim');
            //$date['address'] = $this->_post('address','trim');
           //$date['bday']   = $this->_post('bday','trim');
            $date['zhanghao']   = $this->_post('zhanghao','trim');
            $date['huming']   = $this->_post('huming','trim');
            $date['kaihuhang']   = $this->_post('kaihuhang','trim');
            //$date['gender']   = $this->_post('gender','trim');
             $date['hyimg'] = $this->uploadPic('avatar','avatar');//上传的头像所在的文件名称
            $result = $user_mod->where(array('id' =>$id))->save($date);
            $this->success('修改成功', U('User/index'));
        }else{
            $info = $user_mod->find($id);
            $bank= $bank=M('bank')->order('id asc')->select();
            $this->assign('info', $info);
            $this->assign('bank',$bank);
            $this->_config_seo();
            $this->display();
        }
    }

     /**
     * 检测会员是否存在
     */
    public function check_name($name) {
        $id = $this->_get('id', 'intval');
        if ($this->_mod->name_exists($name,  $id)) {
            $this->ajaxReturn(0, '该会员已经存在');
        } else {
            $this->ajaxReturn();
        }
    }
    /**
     * 检测用户
     */
    public function ajax_check() {
        $type = $this->_get('type', 'trim', 'email');
        $user_mod = D('user');
        switch ($type) {
            case 'email':
                $email = $this->_get('J_email', 'trim');
                $user_mod->email_exists($email) ? $this->ajaxReturn(0) : $this->ajaxReturn(1);
                break;

            case 'username':
                $username = $this->_get('J_username', 'trim');
                $user_mod->name_exists($username) ? $this->ajaxReturn(0) : $this->ajaxReturn(1);
                break;
        }
    }

    /**
     * 关注
     */
    public function follow() {
        $uid = $this->_get('uid', 'intval');
        !$uid && $this->ajaxReturn(0, L('follow_invalid_user'));
        $uid == $this->visitor->info['id'] && $this->ajaxReturn(0, L('follow_self_not_allow'));
        $user_mod = M('user');
        if (!$user_mod->where(array('id'=>$uid))->count('id')) {
            $this->ajaxReturn(0, L('follow_invalid_user'));
        }
        $user_follow_mod = M('user_follow');
        //已经关注？
        $is_follow = $user_follow_mod->where(array('uid'=>$this->visitor->info['id'], 'follow_uid'=>$uid))->count();
        $is_follow && $this->ajaxReturn(0, L('user_is_followed'));
        //关注动作
        $return = 1;
        //他是否已经关注我
        $map = array('uid'=>$uid, 'follow_uid'=>$this->visitor->info['id']);
        $isfollow_me = $user_follow_mod->where($map)->count();
        $data = array('uid'=>$this->visitor->info['id'], 'follow_uid'=>$uid, 'add_time'=>time());
        if ($isfollow_me) {
            $data['mutually'] = 1; //互相关注
            $user_follow_mod->where($map)->setField('mutually', 1); //更新他关注我的记录为互相关注
            $return = 2;
        }
        $result = $user_follow_mod->add($data);
        !$result && $this->ajaxReturn(0, L('follow_user_failed'));
        //增加我的关注人数
        $user_mod->where(array('id'=>$this->visitor->info['id']))->setInc('follows');
        //增加Ta的粉丝人数
        $user_mod->where(array('id'=>$uid))->setInc('fans');
        //提醒被关注的人
        D('user_msgtip')->add_tip($uid, 1);
        //把他的微薄推送给我
        //TODO...是否有必要？
        $this->ajaxReturn(1, L('follow_user_success'), $return);
    }

    /**
     * 取消关注
     */
    public function unfollow() {
        $uid = $this->_get('uid', 'intval');
        !$uid && $this->ajaxReturn(0, L('unfollow_invalid_user'));
        $user_follow_mod = M('user_follow');
        if ($user_follow_mod->where(array('uid'=>$this->visitor->info['id'], 'follow_uid'=>$uid))->delete()) {
            $user_mod = M('user');
            //他是否已经关注我
            $map = array('uid'=>$uid, 'follow_uid'=>$this->visitor->info['id']);
            $isfollow_me = $user_follow_mod->where($map)->count();
            if ($isfollow_me) {
                $user_follow_mod->where($map)->setField('mutually', 0); //更新他关注我的记录为互相关注
            }
            //减少我的关注人数
            $user_mod->where(array('id'=>$this->visitor->info['id']))->setDec('follows');
            //减少Ta的粉丝人数
            $user_mod->where(array('id'=>$uid))->setDec('fans');
            //删除我微薄中Ta的内容
            M('topic_index')->where(array('author_id'=>$uid, 'uid'=>$this->visitor->info['id']))->delete();
            $this->ajaxReturn(1, L('unfollow_user_success'));
        } else {
            $this->ajaxReturn(0, L('unfollow_user_failed'));
        }
    }

    /**
     * 移除粉丝
     */
    public function delfans() {
        $uid = $this->_get('uid', 'intval');
        !$uid && $this->ajaxReturn(0, L('delete_invalid_fans'));
        $user_follow_mod = M('user_follow');
        if ($user_follow_mod->where(array('follow_uid'=>$this->visitor->info['id'], 'uid'=>$uid))->delete()) {
            $user_mod = M('user');
            //减少我的粉丝人数
            $user_mod->where(array('id'=>$this->visitor->info['id']))->setDec('fans');
            //减少Ta的关注人数
            M('user')->where(array('id'=>$uid))->setDec('follows');
            //删除Ta微薄中我的内容
            M('topic_index')->where(array('author_id'=>$this->visitor->info['id'], 'uid'=>$uid))->delete();
            $this->ajaxReturn(1, L('delete_fans_success'));
        } else {
            $this->ajaxReturn(0, L('delete_fans_failed'));
        }
    }

/*=======================by lyye 2014-03-30=======================*/
    /*
     * 帐户中心
     */
    public function account()
    {
        $userid = $this->visitor->info['id'];
        $user = M('user');
        $user_info = $user->where("id='$userid'")->find();
        !$user_info && $this->_404();
        $this->assign('userinfo',$user_info);
        $this->display();
    }
    public function chongzhi()
    {
        $this->display();
    }
    public function chongzhi_do()
    {
        $jiner = $this->_post('jiner', 'trim');
        if(empty($jiner) || !is_numeric($jiner))
        {
            $this->error('请输入充值金额');
        }
        $pay=M('pay')->where(array('pay_type'=>'alipay'))->find();
        $alipay=unserialize($pay['config']);
        //添加充值记录
        $user_acclog  = M('user_acclog');
        $userid = $this->visitor->info['id'];
        $user = M('user');
        $userinfo = $user->where("id='$userid'")->find();
        $orderId = $userid.date("YmdHis",time()).rand(1, 99);
        $log_data['userid']     = $userid;
        $log_data['username']   = $userinfo['username'];
        $log_data['fl']         = 2;
        $log_data['jiner']      = sprintf("%01.2f",$jiner);
        $log_data['addtime']    = time();
        $log_data['info']       = '支付宝充值';
        $log_data['orderid']    = $orderId;
        $log_data['status']     = '处理中';
        $user_acclog->add($log_data);
        echo "<script>location.href='api/chongzhipay/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$orderId."&WIDsubject=".$orderId."&WIDtotal_fee=".$jiner."'</script>";
    }
/*=======================by lyye 2014-03-30=======================*/



    /*************************************************************************
     *                              2015.01.04
     *************************************************************************/
    public function fahuo1(){
        $this->checkJM();
        $uid = $_SESSION['user_info']['id'];
        //获取当前用户的仓库信息
        $cangku = D('user_cangku');
        $cangkus = $cangku->where(array('userid'=>$uid))->select();

        $cangkuinfo = array();
        foreach ($cangkus as $v){
            $cangkuinfo[$v['goodsid']] = $v;
        }

        if(IS_POST){
            //var_dump($_POST['items']);exit;
            foreach ($_POST['items'] as $k=>$v){
                if(($cangkuinfo[$k]['xskucun'] + $cangkuinfo[$k]['xxkucun']) < $v['num']){
                    $this->error('你的存货不够哦！');
                }
            }

            $_SESSION['fahuo']['items'] = $_POST['items'];
            $this->redirect(U('User/fahuo2'));
        }

        //获取所有的商品信息
        $iteminfo = D('Item')->field('id,title,img')->select();

        $this->assign('cangkuinfo',$cangkuinfo);
        $this->assign('iteminfo',$iteminfo);

        $this->display();
    }

    public function fahuo2(){
        $this->checkJM();
        //获取所有地址信息
        $addresses = D('user_address')->where(array('uid'=>$this->visitor->info['id']))->order('id desc')->select();
        $this->assign('addresses',$addresses);
        $this->display();
    }

    public function fahuo3(){
        $this->checkJM();

        if(isset($_POST['act']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['token']){

            $omid = intval($_POST['id']);
            $ordermsg = M('user_ordermsg')->find($omid);
            if($ordermsg['status'] == 1){
                echo -2;exit;
            }
            //取出地址信息
            $dizhiinfo = D('user_address')->find($ordermsg['addr_id']);
            //获取发货商品的信息
            $items = unserialize($ordermsg['iteminfo']);


            $item = D('item');
            $goodsinfo = array();
            foreach ($items as $k=>$v){
                if($v != 0){
                    $goodsinfo[$k] = $item->find($k);
                    $goodsinfo[$k]['num'] = $v;
                }
            }


        }else{

            $dizhi = isset($_POST['dizhi']) ? $_POST['dizhi'] : 0;
            if(empty($dizhi)){
                $this->error('请填写收货人信息');
            }
            //取出地址信息
            $dizhiinfo = D('user_address')->find($dizhi);

            //获取发货商品的信息
            $items = $_SESSION['fahuo']['items'];

            $item = D('item');
            $goodsinfo = array();
            foreach ($items as $k=>$v){
                if($v['num'] != 0){
                    $goodsinfo[$k] = $item->find($k);
                    $goodsinfo[$k]['num'] = $v['num'];
                }
            }

        }

        //获取加盟商和代理商的折扣率
        $user_category1 = D('user_category')->find(3);
        $discount = $user_category1['discount'];
//      $user_category2 = D('user_category')->find(4);
//      $discount2 = $user_category2['discount'];

        //商品总价，订单总价
        $sumPrice = 0;
        //$sumPrice2 = 0;
        foreach ($goodsinfo as $v){
            $sumPrice += $v['price']*($v['priceyuan']/10)*($discount/100)*$v['num'];
            //$sumPrice2 += $v['price']*($v['priceyuan']/10)*($discount2/100)*$v['num'];
        }

        //取出用户的所有库存信息
        $cangku = D('user_cangku')->where(array('userid'=>$this->visitor->info['id']))->select();
        $cangkuInfo = array();
        if(!empty($cangku)){
            foreach ($cangku as $v){
                if(isset($goodsinfo[$v['goodsid']])){
                    if($goodsinfo[$v['goodsid']]['num'] > ($v['xskucun'] + $v['xxkucun'])){
                        if(isset($_POST['act']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['token']){
                            echo -1;exit;
                        }
                        $this->error('你的库存不足哦');
                    }
                }
                $cangkuInfo[$v['goodsid']] = $v;
            }
        }else{
            if(isset($_POST['act']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['token']){
                echo -1;exit;
            }
            $this->error('你的库存不足哦');
        }

        //生成订单
        $item_order=M('item_order');
        $order_detail=M('order_detail');

        //生成订单号
        $dingdanhao = date("Y-m-dH-i-s");
        $dingdanhao = str_replace("-","",$dingdanhao);
        $dingdanhao .= rand(1000,2000);

        $time=time();//订单添加时间
        $data['freetype']=0;
        $data['goods_sumPrice']=$sumPrice;
        $data['order_sumPrice']=$sumPrice;

        $data['orderId']=$dingdanhao;//订单号
        $data['add_time']=$time;//添加时间

        $data['userId']=$this->visitor->info['id'];//用户id
        $data['userName']=$this->visitor->info['username'];//用户名

        $data['address_name']=$dizhiinfo['consignee'];//收货人姓名
        $data['mobile']=$dizhiinfo['mobile'];//电话号码
        $data['address']=$dizhiinfo['sheng'].$dizhiinfo['shi'].$dizhiinfo['qu'].$dizhiinfo['address'];//地址
        //待发货的状态
        $data['status'] = 2;

        if($item_order->data($data)->add()){
            //订单号
            $orders['orderId']=$dingdanhao;
            foreach ($goodsinfo as $v){
                $orders['itemId'] = $v['id'];
                $orders['title'] = $v['title'];
                $orders['img'] = $v['img'];
                $orders['quantity'] = $v['num'];
                $orders['price'] = $v['price']*($v['priceyuan']/10)*($discount2/100) ;
                //添加到订单详情表
                $order_detail->data($orders)->add();

                //减少用户库存
                if($cangkuInfo[$v['id']]['xxkucun'] < $v['num']){
                    $cangkuInfo[$v['id']]['xxkucun'] = 0;
                    $cangkuInfo[$v['id']]['xskucun'] = ($cangkuInfo[$v['id']]['xxkucun']+$cangkuInfo[$v['id']]['xskucun'])-$v['num'];
                }else{
                    $cangkuInfo[$v['id']]['xxkucun'] = $cangkuInfo[$v['id']]['xxkucun'] - $v['num'];
                }
                D('user_cangku')->save($cangkuInfo[$v['id']]);

            }

            /************发货给三级加盟商提成20150126************/
            //获取各级别的分成率
            $fclvArr = M("user_fengchenglv")->order('id asc')->select();
            $uid = $this->visitor->info['id'];
            //当前用户信息
            $userEny = M("user")->where(array("id"=>$uid))->find();
            //A1上 一级加盟商
            $usrA1Eny = M("user")->where(array("id"=>$userEny["shares"]))->find();

            if(!empty($usrA1Eny)) {
                $fencheng = $sumPrice * $fclvArr[0]["royalty"];
                M("user_fengchengllist")->add(array("royalty"=>$fclvArr[0]["royalty"],"orderId"=>$dingdanhao,"fencheng"=>$fencheng,"price"=>$sumPrice,"uid"=>$usrA1Eny["id"],"user_id"=>$uid,"state"=>"1","add_time"=>time()));
                //B2上 二级加盟商
                $usrB2Eny = M("user")->where(array("id"=>$usrA1Eny["shares"]))->find();
                if(!empty($usrB2Eny)) {
                    $fencheng = $sumPrice * $fclvArr[1]["royalty"];
                    M("user_fengchengllist")->add(array("royalty"=>$fclvArr[1]["royalty"],"orderId"=>$dingdanhao,"fencheng"=>$fencheng,"price"=>$sumPrice,"uid"=>$usrB2Eny["id"],"user_id"=>$uid,"state"=>"1","add_time"=>time()));
                    //C3上 三级加盟商
                    $usrC3Eny = M("user")->where(array("id"=>$usrB2Eny["shares"]))->find();
                    if(!empty($usrC3Eny)) {
                        $fencheng = $sumPrice * $fclvArr[2]["royalty"];
                        M("user_fengchengllist")->add(array("royalty"=>$fclvArr[2]["royalty"],"orderId"=>$dingdanhao,"fencheng"=>$fencheng,"price"=>$sumPrice,"uid"=>$usrC3Eny["id"],"user_id"=>$uid,"state"=>"1","add_time"=>time()));
                    }
                }
            }
            /************   //20150126  ************/

            /**代理提成入库**/
            if(isset($_POST['act']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['token']){
                $uid = $ordermsg['dl_id'];
                //当前用户信息
                $userEny = M("user")->where(array("id"=>$uid))->find();

                //A1上 一级加盟商
                $usrA1Eny = M("user")->where(array("id"=>$userEny["shares"]))->find();

                if(!empty($usrA1Eny)) {
                    if($usrA1Eny['uid'] == 4){
                        $fencheng = $sumPrice * $fclvArr[0]["royalty"];
                        M("user_fengchengllist")->add(array("royalty"=>$fclvArr[0]["royalty"],"orderId"=>$dingdanhao,"fencheng"=>$fencheng,"price"=>$sumPrice,"uid"=>$usrA1Eny["id"],"user_id"=>$uid,"state"=>"1","add_time"=>time()));
                        //B2上 二级加盟商
                        $usrB2Eny = M("user")->where(array("id"=>$usrA1Eny["shares"]))->find();
                        if(!empty($usrB2Eny)) {
                            if($usrB2Eny['uid'] == 4){
                                $fencheng = $sumPrice * $fclvArr[1]["royalty"];
                                M("user_fengchengllist")->add(array("royalty"=>$fclvArr[1]["royalty"],"orderId"=>$dingdanhao,"fencheng"=>$fencheng,"price"=>$sumPrice,"uid"=>$usrB2Eny["id"],"user_id"=>$uid,"state"=>"1","add_time"=>time()));
                                //C3上 三级加盟商
                                $usrC3Eny = M("user")->where(array("id"=>$usrB2Eny["shares"]))->find();
                                if(!empty($usrC3Eny)) {
                                    if($usrC3Eny['uid'] == 4){
                                        $fencheng = $sumPrice * $fclvArr[2]["royalty"];
                                        M("user_fengchengllist")->add(array("royalty"=>$fclvArr[2]["royalty"],"orderId"=>$dingdanhao,"fencheng"=>$fencheng,"price"=>$sumPrice,"uid"=>$usrC3Eny["id"],"user_id"=>$uid,"state"=>"1","add_time"=>time()));
                                    }
                                }
                            }
                        }
                    }
                }

                //改变ordermsg状态
                M('user_ordermsg')->save(array('id'=>$omid,'orderid'=>$dingdanhao,'status'=>1));
                echo 1;exit;
            }


            $this->success('发货请求提交成功！',U('User/index',array('status'=>2)));exit;

        }else{
            $this->error('发货请求提交失败，请稍后重试');
        }
    }

    /*************************************************************************
     *                              2015.01.26
     *                              代理购货环节
    *************************************************************************/

    public function gouhuo1(){
        $this->checkDL();

        if(IS_POST){
            $itemInfo = array();
            $items = isset($_POST['items']) ? $_POST['items'] : '';
            if($items != ''){
                foreach ($items as $k=>$v){
                    if(intval(trim($v['num'])) > 0){
                        $itemInfo[$k] = intval(trim($v['num']));
                    }
                }
                if(!empty($itemInfo)){
                    $_SESSION['gouhuo'] = $itemInfo;

                    //购货第二步
                    $this->redirect(U('User/gouhuo2'));
                }else{
                    $this->error('请正确填写购货信息！');
                }
            }else{
                $this->error('请正确填写购货信息！');
            }
        }

        //获取所有商品西你想
        $itemInfo = D('item')->select();
        $this->assign('itemInfo',$itemInfo);
        $this->display();
    }



    public  function gouhuo2(){
        $this->checkDL();
        if(IS_POST){
            if(isset($_POST['dizhi'])){
                $dizhi = intval(trim($_POST['dizhi']));
                $uid = $this->visitor->info['id'];
                $res = D('user_address')->where(array('id'=>$dizhi,'uid'=>$uid))->find();
                if($res){
                    $_SESSION['dizhi'] = $dizhi;
                    //购货第三步
                    $this->redirect(U('User/gouhuo3'));
                }else{
                    $this->error('地址信息有误！');
                }
            }else{
                $this->error('请选择收货地址！');
            }
        }
        //获取所有地址信息
        $addresses = D('user_address')->where(array('uid'=>$this->visitor->info['id']))->order('id desc')->select();
        $this->assign('addresses',$addresses);
        $this->display();
    }


    public function gouhuo3(){
        $this->checkDL();
        $dl_id = $this->visitor->info['id'];
        //入库
        $data = array();
        $data['dl_id'] = $dl_id;
        $data['addr_id'] = $_SESSION['dizhi'];
        $data['iteminfo'] = serialize($_SESSION['gouhuo']);
        $data['orderid'] = '';
        $data['status'] = 0;
        $data['add_time'] = time();
        $data['jm_id'] = $this->getJM($dl_id);

        if(M('user_ordermsg')->add($data)){
            $this->success('购货请求已发送！',U('User/index'));exit;
        }else{
            $this->error('购货失败，请稍后重试！');
        }
    }


    public function getJM($dl_id){
        static $jm_id = 0;
        $userinfo = D('user')->field('id,uid,shares')->find($dl_id);
        if($userinfo['uid'] == 3){
            $jm_id = $userinfo['id'];
        }else{
            $this->getJM($userinfo['shares']);
        }
        return $jm_id;
    }


    /**************************************************************************************/



    /*************************************************************************
     *                              2015.01.26
     *                              加盟商个人中心
    *************************************************************************/
    public function ordermsg(){
    $data['uid'] = $this->visitor->info['id'];
        if ($_GET['tk']) {
      //获取所有未处理的退款信息
        $ordermsg0 =M('item_order')->where(array('uid'=>$data['uid'],'status'=>4))->select();
        //获取所有已处理的退款信息
        $data['status']=array('gt','6');
        $ordermsg1 = M('item_order')->where($data)->select();
        $status = array(
          2=>'待发货',
          3=>'待收货',
          4=>'已收货',
          5=>'已评论',
          6=>'退款中',
          7=>'退款失败',
          8=>'退款成功',
        );
    }else{

            //获取所有未处理的购买信息
            $ordermsg0 =M('item_order')->where(array('uid'=>$data['uid'],'status'=>2))->select();
            //获取所有已处理的购买信息
        $data['status']=array('gt','2');
            $ordermsg1 = M('item_order')->where($data)->select();
            $status = array(
                2=>'待发货',
                3=>'待收货',
                4=>'已收货',
                5=>'已评论',
                6=>'退款中',
                7=>'退款失败',
                8=>'退款成功',
            );
        }
        $this->assign('status',$status);
        $this->assign('ordermsg0',$ordermsg0);
        $this->assign('ordermsg1',$ordermsg1);
        $this->display();
    }


    public function checkJM(){
        $uid = $this->visitor->info['uid'];
        if($uid != 4){
            $this->error('你没有权限');
        }
    }

    public function checkDL(){
        $uid = $this->visitor->info['uid'];
        if($uid != 4){
            $this->error('你没有权限');
        }
    }


    public function ordermsg_dtl(){

        //获取购货信息
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $ordermsg = M('user_ordermsg')->field('a.*,b.status as ostatus')->join('a left join weixin_item_order b on a.orderid=b.orderId')->where('a.id='.$id)->find();
        if($ordermsg['jm_id'] != $this->visitor->info['id'] && $ordermsg['dl_id'] != $this->visitor->info['id']){
            $this->error('此购货信息不属于你的！',U('User/ordermsg'));
        }
        if(!empty($ordermsg['ostatus'])){
            switch ($ordermsg['ostatus']){

                case 2:
                    $info = "待发货";
                    break;
                case 3:
                    $info = "待收货";
                    break;
                case 4:
                    $info = "已收货";
                    break;
                case 5:
                    $info = "已评论";
                    break;
                case 6:
                    $info = "退款中";
                    break;
                case 7:
                    $info = "退款失败";
                    break;
                case 8:
                    $info = "退款成功";
                    break;
                default:
                    $info = "暂时获取不到订单信息";
                    break;
            }
            $this->assign('info',$info);
        }

        //获取代理商信息
        $dl_id = $ordermsg['dl_id'];
        $dlinfo = M('user')->find($dl_id);
        //获取代理的折扣
        $dl_discount = M('user_category')->field('discount')->find(4);
        $dl_discount = $dl_discount['discount'] / 100;
        //获取购货商品信息
        $iteminfo = unserialize($ordermsg['iteminfo']);
        $itemdtl = array();
        //获取具体信息
        foreach ($iteminfo as $k=>$v){
            $itemdtl[] = M('item')->field('id,title,img,price,priceyuan')->find($k);
        }

        //获取地址信息
        $addr = M('user_address')->find($ordermsg['addr_id']);

        //生成token
        $token = md5(date("YmdHis"));
        $_SESSION['token'] = $token;

        $this->assign('uid',$this->visitor->info['uid']);
        $this->assign('ordermsg',$ordermsg);
        $this->assign('dlinfo',$dlinfo);
        $this->assign('dl_discount',$dl_discount);
        $this->assign('iteminfo',$iteminfo);
        $this->assign('itemdtl',$itemdtl);
        $this->assign('addr',$addr);
        $this->assign('token',$token);

        $this->display();
    }


    public function gouhuoinfo(){
        //获取所有已处理的购买信息
        $ordermsg1 = M('user_ordermsg')
                    ->field('a.id,a.dl_id,a.add_time,a.orderid,b.username as dlname')
                    ->join('a left join weixin_user b on a.dl_id=b.id')
                    ->where(array('a.jm_id'=>$id,'a.status'=>1))->select();
    }

    public function jminfo(){
        $this->checkDL();
        //获取最近加盟商的信息
        $jm_id = $this->getJM($this->visitor->info['id']);
        $jminfo = $this->_mod->find($jm_id);

        $this->assign('jminfo',$jminfo);
        $this->display();
    }


    /**
     * AJAX获取购货信息数
     */
    public function getnum(){
        $uid = $this->visitor->info['uid'];
        if($uid != 3){
            echo 0;exit;
        }
        $id = $this->visitor->info['id'];
        $num=array();
        $num[0] = M('item_order')->where(array('uid'=>$id,'status'=>2))->count();
        $num[1] = M('item_order')->where(array('uid'=>$id,'status'=>6))->count();
        $num[0] = $num[0] ? $num[0] : 0;
        $num[1] = $num[1] ? $num[1] : 0;
        $data=array('gouhuo'=>$num[0],'tuihuo'=>$num[1]);
        echo json_encode($data);
  }

    /*************************************************************************
     *                              2015.01.28
     *                              代理商个人中心
    *************************************************************************/
    public function ordermsgdl(){
        $this->checkDL();
        $uid = $this->visitor->info['id'];

        $id = $this->visitor->info['id'];
        //获取所有未处理的购买信息
        $ordermsg0 = M('user_ordermsg')->field('a.id,a.dl_id,a.add_time,b.username as dlname')->join('a left join weixin_user b on a.dl_id=b.id')->where(array('a.dl_id'=>$id,'a.status'=>0))->select();
        //获取所有已处理的购买信息
        $ordermsg1 = M('user_ordermsg')->field('a.id,a.dl_id,a.add_time,a.orderid,b.username as dlname,c.status as ostatus')->join('a left join weixin_user b on a.dl_id=b.id left join weixin_item_order c on a.orderid=c.orderId')->where(array('a.dl_id'=>$id,'a.status'=>1))->select();

        $status = array(
            2=>'待发货',
            3=>'待收货',
            4=>'已收货',
            5=>'已评论',
            6=>'退款中',
            7=>'退款失败',
            8=>'退款成功',
          );

        $this->assign('status',$status);
        $this->assign('ordermsg0',$ordermsg0);
        $this->assign('ordermsg1',$ordermsg1);

        $this->display();
    }
    /**
   *   获取会员升级申请列表
   *   2016-07-09 Modify by Liuyumei
   *
   */
    public function lvup(){   //上级审核下级 是否允许升级
      $this->check();  // 检测用户权限
      $id    = $this->visitor->info['id'];   //228
      $up    = $this->_get('up','intval');
      if($up == 1){
          $res = M('user_lvup')    //获取申请升级的下级的信息
                  ->join("a left join __USER__ as b on a.userid = b.id")
                  ->where("a.up_user = ".$id)
                  ->field("b.cover,b.username,b.merchant,b.m_desc,a.id,a.up_status")
                  ->select();
          $this->assign('up',$up);
      }else{
          static $fenxiaos = array();
          $this->getDown($fenxiaos,$id);
          foreach($fenxiaos as $key => $value){
              $dl[]=$value;
          }
          if(count($dl)>0){
              $res = M('user_apply')
			  ->join("a left join __USER__ as b on a.userid = b.id")
			  ->where(array('a.userid'=>array('in',$dl)))
			  ->field("b.cover,b.username,b.merchant,b.m_desc,a.id,a.up_status,b.uid")
			  ->select();
          }
      }
      $this->assign('count',count($res));
      $this->assign('list',$res);
      $this->display();
  }



  /**
   *   查看申请会员的详细信息
   *   @author  vany
   *   date    2015-12-2
   *
   */

  public function dl_info(){

      $this->check();// 检测用户权限
      $ulvup= M("user_lvup");
      $up = $this->_get('up','intval');
      $id = $this->_get('id','intval');
      if($up == 1){
        $res = $ulvup
              ->join("a left join __USER__ as b on a.userid = b.id")
              ->field("a.*,b.cover,b.merchant,b.m_desc,b.address,b.email")
              ->where(array('a.id'=>$id))
              ->find();
        $this->assign('up',$up);
      } else{
        $res =  M("user_apply")
              ->join("a left join __USER__ as b on a.userid = b.id")
              ->field("a.*,b.cover")
              ->where(array('a.id'=>$id))
              ->find();
      }


      $this->assign('uid',$this->visitor->info['uid']);

      $this->assign('list',$res);
      $this->display();
  }

    /**
      *   AJAX升级审核请求
      *   @author  vany
      *   date    2015-12-2
      *
      */
    public function send_lvup(){
      $data['id'] = $this->_post('id','intva');
      $act['up_status'] = $this->_post('up_status','intval');
      $up = $this->_post('up','intval');
      $ulvup= M("user_lvup");
      if($act['up_status']==3){//由上级审核
          $suser['uid']=$this->visitor->info['uid'];
          while($suser['uid']==3){//不具备审核条件，应当交由上级审核
              $suser=M('user')->where(array('id'=>$this->visitor->info['id']))->field('uid,shares_tree')->find();

              $tree = explode('|',$suser['shares_tree']);//直接上级的shares_tree
              $num=count($tree);
              if($num<3){
                  return 0;
              }
              $suser = M('user')->where(array('id'=>$tree[$num-2]))->field('uid,shares_tree')->find();
          }
          $this_lv=$ulvup->where(array('id'=>$data['id']))->field('id,userid,username')->find();
          $where['userid']=$this_lv['userid'];
          $where['up_user']=$this->visitor->info['id'];
          $da_ta['up_user']=$tree[$num-2];

          $ulvup->where(array('id'=>$this_lv['id']))->save($da_ta);
          $this->ajaxReturn(1,'您已经联系了您的上级掌柜，'.$this_lv["username"].'的申请将由您的上级审核!');
      }
      if($up == 1){
          $act['up_time'] = time();
          $mod = M('user_lvup');
      }  else{
          $act['up_do_time'] = time();
          $mod = M('user_apply');
      }
      $list = $mod->where($data)->find();
      if (is_array($list)) {
          if ($list['up_status'] == 1) {
              $this->ajaxReturn(2,'您已经审核通过'.$list["username"].'的申请,请等待总部审核!');
          }else if($list['up_status'] == 2) {
              $this->ajaxReturn(2,'您已经拒绝'.$list["username"].'的申请,请勿重复操作!');
          }else{

              $r = $mod->where($data)->save($act);
              if ($r !== flase) {
                $this->ajaxReturn(1,'审核操作成功!');
              }else{
                $this->ajaxReturn(2,'审核操作失败,请刷新页面重试');
              }
          }
      }else{
        $this->ajaxReturn(2,'代理不存在!请刷新代理商页面后,再尝试!');
      }

    }
    /**
      *   统计客户总数
      *   @author  vany
      *   date    2015-12-11
      *
      */
    public function khzs(){
        $res = M('item_order')
               ->join("a left join __USER__ as b on a.userId = b.id ")
               ->where("a.shopid = ".$this->visitor->info['id'])
               ->field('a.userId,a.orderId,b.phone_mob,b.username,b.cover')
               ->group('a.userId')
               ->select();
        foreach($res as $key => $value){
            $data['userId'] = $value['userId'];
            $data['shopid'] = $this->visitor->info['id'];
            $result = M('item_order')->where($data)->count();
            $sum = M('item_order')->where($data)->sum('order_sumPrice');
            $res[$key]['order_num'] = $result;
            $res[$key]['order_sum'] = $sum;
        }
        $this->assign('list',$res);
        $this->display();
    }
    public function check(){
    if ($this->visitor->info['uid'] == 4) {
      $this->error('您没有权限!');
      exit;
    }
  }

    /******************************************
     *              生成二维码
   *        @author vany
     *****************************************/

    public function qrcode(){
        $uid=$this->visitor->info['id'];
        vendor("phpqrcode.phpqrcode");//引入工具包
        $value = 'http://'.$_SERVER["SERVER_NAME"].'/index.php?m=Index&a=index&shares='.$uid; //二维码内容
        $errorCorrectionLevel = 'L';//容错级别
        $matrixPointSize = 20;//生成图片大小
        //生成二维码图片
        QRcode::png($value, './data/upload/qrcode/qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
        $logo = './data/upload/qrcode/logo.png';//准备好的logo图片
        $QR = './data/upload/qrcode/qrcode.png';//已经生成的原始二维码图

        if ($logo !== FALSE) {
            $QR = imagecreatefromstring(file_get_contents($QR));
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
            $logo_qr_height, $logo_width, $logo_height);
        }
        //输出图片
        imagepng($QR,'./data/upload/qrcode/qrcode.png');
        $img='./data/upload/qrcode/qrcode.png';
        /* echo '<img src="./data/upload/qrcode/qrcode.png" width="100%",height="auto">';   */
        $this->assign('imgurl',$img);
        $this->display();
    }
    /******************************************
     *              生成二维码
   *        @author vany
     *****************************************/

     public function qrcode1(){

         $uid = $this->visitor->info['id'];  //获取用户ID;

         $setting = D('setting');
         $appid = $setting->where(array('name'=>'appid'))->find();
         $appid = $appid['data'];
         //获取appsecret
         $appsecret = $setting->where(array('name'=>'appsecret'))->find();
         $appsecret = $appsecret['data'];

         //获取access_token
         $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
         $get_token = $this->http_post($token_url);

         $json_token = json_decode($get_token,true);
         $access_token = $json_token['access_token'];
         //echo $access_token;
         //临时二维码
         //$qrcode_type = "{\"expire_seconds\": 1800, \"action_name\": \"QR_SCENE\", \"action_info\": {\"scene\": {\"scene_id\": $uid}}}";

         //永久二维码
         $qrcode_type = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$uid.'}}}';

         $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
         $get_ticket = $this->http_post($url,$qrcode_type);

         $json_ticket = json_decode($get_ticket,true);
         $ticket = $json_ticket['ticket'];
         //echo $get_ticket;
         //生成二维码地址
         $qrcode_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
         $this->assign('qrcode_url',$qrcode_url);
         $this->assign('uid',$uid);
         $this->display();

     }
    public function http_post($url,$data=null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close();
        return $output;
    }
}
