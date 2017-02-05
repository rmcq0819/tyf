<?php
class bargainAction extends frontendAction {
	
	public function get_http($url){
		$ch1 = curl_init();
		curl_setopt($ch1, CURLOPT_URL, $url);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch1, CURLOPT_HEADER, 0);
		$result = curl_exec($ch1);
		curl_close($ch1);
		return $result;
	}
	
	//获取access_token（手动）
    public function get_access_token()
    {
		//获取appid
		$setting = M('setting');
		$appid = $setting->where(array('name'=>'appid'))->find();
		//获取appsecret
		$appsecret = $setting->where(array('name'=>'appsecret'))->find();
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid['data']."&secret=".$appsecret['data'];
		$access_token_Arr = json_decode($this->get_http($url),true);
		dump($access_token_Arr['access_token']);
		exit;          
    }
	
	
	public function get_unionid($openid){
		$access_token = 'W5ga3-P9DNyfZAASwE3U2JLzv7K2fR94c5p05lixDGTbrLQd9R1P3Vr8LQJh9wQjKUVqg15hMejUygQbHArqvJlCzJ-LyjH0mbYFNCpWT8MEfqVm7QKn9UsgHELk4INLEWGlCHAMEO';
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
		$data = json_decode($this->get_http($url),true);
		if($data['unionid']!=null){
			M('myuser')->where(array('wechatid'=>$openid,'unionid'=>''))->save(array('unionid'=>$data['unionid']));
		}
	}
	
	//由openid获取unionid
	public function get_unionids(){
		$users = M('myuser')->field('wechatid')->where("unionid ='' OR unionid IS NULL")->select();
		
		foreach($users as $key=>$val){
			$this->get_unionid($val['wechatid']);
		}
		echo json_encode(array('status'=>1,'msg'=>'SUCCESS'));
	}
	
	
	public function index(){
		parent::activity_end();
		//商品id
		$id = $this->_get('id','trim');
		//用户id
		$uid = $this->visitor->info['id'];
		$sharesid = $this->_get('sharesid','trim');
		//商品表
		$item = M('item');
		$iwhere['id'] = $id;
		//根据get的id查询商品
		$itemdetail = $item->where($iwhere)->find();
		if($itemdetail['is_bargain'] == 0){
			$this->error('该商品暂未参加砍价活动！');
		}
		
		$ishelp = M('bargain')->where(array('id'=>$id,'uid'=>$sharesid))->find();
		//查询砍价商品
		$bwhere['id'] = $id;
		$bwhere['uid'] = $sharesid;
		$bwhere['is_bargain'] = 1;
		$binfo = M('bargain')->where($bwhere)->find();
		//查询用户信息
		if(!$binfo){
			$uwhere['id'] = $uid;
		}else{
			$uwhere['id'] = $binfo['uid'];
		}
		
		if($ishelp['price'] <= $ishelp['bargain_price']){
			$this->assign('is_end',2);
		}
		
		$uinfo = M('user')->where($uwhere)->find();
		//砍价商品结束时间
		$end_time = $binfo['bargain_time']+3600*12;
		$is_blist = M('bargainlist')->where(array('bid'=>$id,'uid'=>$uid,'shares'=>$sharesid))->find();
		if($is_blist){
			$this->assign('is_help',1);
		}
		if($binfo){
			$this->assign('is_binfo',1);
		}
		if(time() >= $end_time){
			$this->assign('is_end',1);
		}
		$bargainlist = M('user')
        ->join("a left join weixin_bargainlist as b on a.id = b.uid")
		->where(array('b.shares'=>$sharesid,'b.bid'=>$id))
		->limit(10)
		->order('b.id desc')
        ->select();
		
		
		//累计当前商品砍了多少金额
		$contwhere['bid'] = $id;
		$contwhere['shares'] = $sharesid;
		$price_count = M('bargainlist')->where($contwhere)->sum('price');
		$price_count = round($price_count,2);
		$this->assign('itemdetail',$itemdetail);
		$this->assign('uinfo',$uinfo);
		$this->assign('binfo',$binfo);
		$this->assign('end_time',$end_time); //结束时间
		$this->assign('bargainlist',$bargainlist);
		$this->assign('active_uid',$this->visitor->info['id']);
		$this->assign('price_count',$price_count);
		$this->assign('ishelp',$ishelp);
		$this->display();
	}
	
	//砍价记录更多
	public function userlist(){
		$id = $this->_get('id','trim');
		$sharesid = $this->_get('sharesid','trim');
		$bargainlist = M('user')
        ->join("a left join weixin_bargainlist as b on a.id = b.uid")
		->where(array('b.bid'=>$id,'b.shares'=>$sharesid))
		->order('b.id desc')
        ->select();
		$this->assign('bargainlist',$bargainlist);
		$this->display();
	}
	
	//发起砍价
	public function add_bargain(){
		$ibargain = M('bargain');
		$itemid = $this->_post('itemid','trim'); //商品id
		$uid = $this->_post('uid','trim'); //砍价发起者id
		$name = $this->_post('name','trim'); //商品名称
		$price = $this->_post('price','trim'); //商品价格
		$num = $this->_post('num','trim'); //商品数量
		$img = $this->_post('img','trim'); //图片名称
		$itemtype = $this->_post('itemtype','trim'); //商品类型，保税，完税
		$cost = $this->_post('cost','trim'); //成本价
		$shopid = $this->_post('shopid','trim'); //商家id
		$baseid = $this->_post('baseid','trim'); //免税仓id
		$bargain_price = $this->_post('bargain_price','trim'); //砍价最低价格
		
		$barwh['id'] = $itemid;
		$barwh['uid'] = $uid;
		$barwh['is_bargain'] = 1;
		$is_start = $ibargain->where($barwh)->find();
		if(!$is_start){
			$data['id'] = $itemid;
			$data['uid'] = $uid;
			$data['name'] = $name;
			$data['price'] = $price;
			$data['source_price'] = $price;
			$data['num'] = $num;
			$data['img'] = $img;
			$data['itemtype'] = $itemtype;
			$data['cost'] = $cost;
			$data['shopid'] = $shopid;
			$data['baseid'] = $baseid;
			$data['is_bargain'] = 1; 
			$data['bargain_time'] = time(); //砍价发起时间
			$data['bargain_price'] = $bargain_price;
			$ibargain->add($data);
		}

	}
	
	//帮助砍价
	public function help_bargain(){
		$ihelp = M('bargainlist');
		$bid = $this->_post('bid','trim');
		$uid = $this->visitor->info['id'];
		$sharesid = $this->_post('sharesid','trim');
		$rand_price = $this->_post('rand_price','trim');
		if(IS_POST){
			$data['bid'] = $bid;
			$data['uid'] = $uid;
			$data['shares'] = $sharesid;
			$data['time'] = time();
			$data['price'] = round($rand_price,2);
			$is_help = M('bargain')->where(array('bid'=>$bid,'uid'=>$sharesid))->find();
			if($is_help['price'] <= $is_help['bargain_price']){
				echo 1;
				exit;
			}else{
				$isexts = M('bargainlist')->where(array('bid'=>$bid,'uid'=>$uid))->find();
				if(!$isexts){
					if($ihelp->add($data)){
						$where['id'] = $bid;
						$where['uid'] = $sharesid;
						M('bargain')->where($where)->setDec('price',$rand_price);
					}
				}
				
			}
			
			
		}
	}
}