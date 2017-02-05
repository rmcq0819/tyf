<?php
    class VoteAction extends frontendAction {
        public function index(){
			$pvMd = M('signup_pv');
		    
		    $pv_time = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('pv_time');
           
            //一天只算一次访问量
            if($pv_time != strtotime(date('Y-m-d'))){
                $pv_time	= strtotime(date('Y-m-d'));
                $pvMd->where(array('id'=>1))->setInc('pv');
                M('user')->where(array('id'=>$this->visitor->info['id']))->setField('pv_time',$pv_time);
            }
			//读取访问量，
            $pv = $pvMd->where(array('id'=>1))->getField('pv');
			$this->assign('pv',$pv);
			
            $voteId     = $this->_get('voteId','intval');//发起投票的用户ID
			$this->assign('voteId',$voteId);
			$shares = $this->_get('shares','intval');
			
			//分享投票链接者ID
			$this->assign('userId',$this->visitor->info['id']);
			if($this->visitor->info['uid']==4){
				$this->assign('userId',$shares);
			}else{
				$this->assign('userId',$this->visitor->info['id']);
			}
			
			
			
            $ct_mod = M('coupon_templet');
            $uc_mod = M('user_coupon');
            //报名表通过id链表查出所需信息
            $sinfo   = M('signup')
                        ->join('a left join weixin_user b on a.userId = b.id left join weixin_team c on a.teamId = c.id')
                        ->field('b.vote_time,b.cover,b.username,c.vote_num,c.people_num,c.id,c.team')
                        ->where("a.userId=$voteId and a.is_public=0")
                        ->find();
			$this->assign('cover',$sinfo['cover']);
            $this->assign('vote_nums',$sinfo['vote_num']);
            $this->assign('username',$sinfo['username']);
            $this->assign('team',$sinfo['team']);
			$this->assign('people_nums',$sinfo['people_num']);
            $this->assign('vote_num',$sinfo['vote_num']);
            //点击投票
			if(IS_POST){
				$votetime = M('user')->where(array('id'=>$this->visitor->info['id']))->getField('vote_time');
				//如果时间戳天数不同，则可以投票
				if($votetime != strtotime(date('Y-m-d'))){
					$vote_time	= strtotime(date('Y-m-d'));
					M('user')->where(array('id'=>$this->visitor->info['id']))->setField('vote_time',$vote_time);
					$vote_num = $sinfo['vote_num'] + 1;
					M('team')->where(array('id'=>$sinfo['id']))->setField('vote_num',$vote_num);
					//优惠券奖励（全品类）
					$templs = $ct_mod->where(array('id'=>array('in','11,12,13,14')))->field('id')->select();
					$uc_data['status'] = 0;         
					$uc_data['userId'] = $this->visitor->info['id'];
					$uc_data['add_time'] = time();
					$uc_data['is_prize'] = 3;
					$uc_data['end_time'] = time()+30*24*3600;
					foreach($templs as $ck=>$cv){
						$uc_data['couponId'] = $cv['id'];
							$ucId = $uc_mod->add($uc_data);
							$arr[] = $ucId;
							$ct_mod->where(array('id'=>$cv['id']))->setInc('count',1);
					}
					//范票奖励
					$points = 66;
					$msg_data['recom'] = $this->visitor->info['id']; 
					$msg_data['user_id'] = $this->visitor->info['id']; //用户id
					$msg_data['type'] = 8; //红包奖励类型
					$msg_data['time'] = time();
					$msg_data['points'] = $points;
					M('messagelist')->add($msg_data);
					M('user')->where(array('id'=>$this->visitor->info['id']))->setInc('points',$points);

					$ret = array('title'=>'恭喜,投票成功','content'=>'您可到‘我的-用户中心’查看投票奖励','btn'=>'我知道了','code'=>1);
				}else{
					$ret = array('title'=>'投票失败','content'=>'您今天已经投过票啦','btn'=>'我知道了','code'=>0);
				}
				echo json_encode($ret);
				exit();
			}
           $this->display();
        }
    }