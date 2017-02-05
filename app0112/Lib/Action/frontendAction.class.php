<?php
/**
 * 前台控制器基类
 *
 * @author andery
 */
class frontendAction extends baseAction {

    protected $visitor = null;
    
    public function _initialize() {
        parent::_initialize();
		//判断是否pc访问
        /*
        if($this->check_wap()){

			header('Location: http://yooopay.com/index.html');
			exit;
		}
        */
		
        //判断是否微信浏览器访问 
       /*  if(!$this->is_weixin()){
            header('Location: http://2urhope.com/');
            //header('Location: ./index1.html');
            exit;
        } */

        $fx_ad=M('ad')->where(array('board_id'=>12))->find();
        $this->assign('fx_ad',$fx_ad);
        if(!strpos($_SERVER['QUERY_STRING'], 'a=getauth')){
            $_SESSION['url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }
        //获取用户信息
        $this->getuserinfo();
        //网站状态
        if (!C('pin_site_status')) {
            header('Content-Type:text/html; charset=utf-8');
            exit(C('pin_closed_reason'));
        }
		
       
        //初始化访问者
        $this->_init_visitor();
		/* if(!in_array(MODULE_NAME,array('Recom','Weixin'))){
			if(empty($_SESSION['shares'])){
				$shares = isset($_GET['shares']) ? $_GET['shares'] : 0;
				if($shares == 0){
					if($this->visitor->info['uid'] == 4){
						$this->error("您当前没有权限!");
						exit;
					}
					$_SESSION['shares'] = $this->visitor->info['id'];
				}else{
					$_SESSION['shares'] = $shares;
				}
			}
		} */
		//获取该商家的信息
		$shopid = $_GET['shares'];
		if($shopid){
			$info = M('user')->where('id='.$shopid)->find();
			$this->assign('info',$info);
			session('shopid',$shopid);
			$this->assign('shopid',session('shopid'));
		}
		if($shopid == $this->visitor->info['id']){
			$this->hot_shop($this->visitor->info['id']);
		}
		//如果是卖家中心点击进来,必须填写登录密码,才能进入商家中心
		if(!session('isshop')){
			session('isshop',0);
		}
		//获取分者的头像
		if(session("shopid")){
			$fx_info = M('user')->where('id='.session("shopid"))->find();	
			$info = M('user')->where('id='.session("shopid"))->find();
			$this->assign('info',$info);
		}else{
			if($this->visitor->info['uid'] <=5 && $this->visitor->info['uid']!=4){
				$fx_info = M('user')->where('id='.$this->visitor->info['id'])->find();
				session("shopid",$fx_info['id']);
			}
		}
		$this->assign('fx_info',$fx_info);
		if($fx_info['hyimg']==""){
			$this->assign('fximg',$fx_info['cover']);
		}else{
			$this->assign('fximg','http://yooopay.com'.$fx_info['hyimg']);
		}
		
		if(!empty($_SESSION['shopid']) && $_SESSION['liulan'] != $this->visitor->info['id']){
			$ll = M('user')->where(array('id'=>$_SESSION['shopid']))->field('liulan,ll_update')->find();
			if($ll['ll_update'] != strtotime(date('Y-m-d'))){
				$data['ll_update']	= strtotime(date('Y-m-d'));
				$data['liulan']		= 1;
			}else{
				$data['liulan']= $ll['liulan']+1;
			}
			M('user')->where(array('id'=>$_SESSION['shopid']))->save($data);
			$_SESSION['liulan']	= $this->visitor->info['id'];
		}
		
		//记录店铺访问历史，用于公众号访问店铺入口
		$shop_id = $this->_get('shares','trim');
		$user_id = $this->visitor->info['id'];
		$user_shop = M('seller')->where(array('userid'=>$user_id,'shopid'=>$shop_id))->find();
		if(!is_array($user_shop) && !empty($shopid)){
			$data['userid'] = $user_id;
			$data['shopid'] = $shop_id;
			$data['addtime'] = time();
			M('seller')->add($data);
		}else{
			//如用户访问过该店铺，则更新访问时间
			M('seller')->where(array('id'=>$user_shop['id']))->save(array('addtime'=>time()));
		}
		
		//访问统计
		$iflow = M('flow_history');
		$flow_where['userid'] = $user_id;
		$flow_where['view_shopid'] = $_SESSION['shopid'];
		$flow = $iflow->where($flow_where)->find();
		if(empty($_SESSION['flow']) && $_SESSION['shopid'] != $user_id && !empty($_SESSION['shopid'])){
			if(!is_array($flow)){
				$fdata['userid'] = $user_id;
				$fdata['view_time'] = time();
				$fdata['view_shopid'] = $_SESSION['shopid'];
				$iflow->add($fdata);
				$_SESSION['flow'] =	$user_id;
			}else{
				$iflow->where(array('id'=>$flow['id']))->save(array('view_time'=>time()));
			}
		}else{
			$iflow->where(array('id'=>$flow['id']))->save(array('view_time'=>time()));
			unset($_SESSION['flow']);
		}
		
		//清空访问数据清空
		$flow_list = $iflow->where(array('view_shopid'=>$user_id))->order('view_time desc')->select();
		foreach($flow_list as $key => $val){
			if(date('Y-m-d',$val['view_time']) != date('Y-m-d')){
				$iflow->where(array('id'=>$val['id']))->delete();
			}
		}
		
        //第三方登录模块
        $this->_assign_oauth();
        $this->assign('follownum',$this->visitor->info['follownum']);
        //获取jsapi的参数
        $res=$this->get_jsapi();
        $this->assign('jsapi',$res);
        //网站导航选中
        $this->assign('nav_curr', '');
        $this->_index_cate();
		//检测卖咖是否需要续费
        /* if ($this->visitor->info['uid'] == 3) {
            $this->check_ren();
        } */
		$server_u = M('user')->where(array('id'=>$this->visitor->info['id']))->find();
		$this->assign('server_u',$server_u);
    }
	
	
	
	public function hot_shop($shopid){
		//连续登录天数统计
			$last_visit_time = M('user')->where(array('id'=>$shopid))->getField('last_visit_time');
			$last_time = date("Y-m-d",$last_visit_time); 
			$ltime = strtotime($last_time); 
			
			$t = time();
			$now_time = date("Y-m-d",$t); 
			$ntime = strtotime($now_time); 
			
			$days = floor(($ntime-$ltime)/(24*3600));
			if($days>1){
				M('user')->where(array('id'=>$shopid))->save(array('login_days'=>0));
			}else if($days == 1){
				M('user')->where(array('id'=>$shopid))->setInc('login_days',1);
			}
			M('user')->where(array('id'=>$shopid))->save(array('last_visit_time' => time(),'last_visit_ip' => get_client_ip()));
			
			$login_days = M('user')->where(array('id'=>$shopid))->getField('login_days');
			//连续登录天数达七天 统计七天的销售额
			if($login_days>=7){
				$pre_time = $t-6*24*3600;
				$p_time = date("Y-m-d",$pre_time); 
				$ptime = strtotime($p_time);
				
				$arr = array(2,3,4);
				$id = M('user')->where(array('id'=>$shopid))->getField('id');
				$items = M('order_detail')->join('a left join weixin_item_order b on a.orderId=b.orderId')
										  ->where(array('b.shopid'=>$id,'b.add_time'=>array('gt',$ptime),'b.status'=>array('in',$arr)))->field('price,quantity')->select();

				$totalPrice = 0;
				foreach($items as $key=>$val){
					$totalPrice += $val['price']*$val['quantity'];
				}
				if($totalPrice >= 1028.00){
					$v = M('user')->where(array('id'=>$shopid))->getField('v1');
					if($v == 0){                  //第一次点亮人气店铺 奖励范票188
						$message = M('messagelist');
						$message->user_id = $id; 
						$message->recom = $id; 
						$message->type = 19;      //人气店铺奖励
						$message->time = time();
						$message->status = 0;     // 默认未读状态
						$message->points = 188;
						$message->add();
						M('user')->where(array('id'=>$shopid))->setInc('points',188);
						M('user')->where(array('id'=>$shopid))->setInc('v1');
					}
					$this->assign('grade','V1');
					$this->assign('totalPrice',$totalPrice);
				}
			}
	}
	
    
	public function activity_end(){
		$shares = $this->_get('shares','trim');
		$this->redirect('User/activity_end',array('shares' =>$shares));
		exit;
	}
	
    /**
     * 获取用户基本信息
     */
	 
	
    public function getuserinfo(){
    	$openid = cookie('openid');

        $openid = 'oOejpwrfSdXyOwCb1IcPhZZMR_bc';//测试数据 
        //$openid = 'oOejpwma99dIho7h1vtIlU9jC9BM';//测试数据 
		$_SESSION['u_openid'] = $openid;
    	if(!$openid){
    		$this->getuser();
    	}else{
			$_SESSION['user_info'] = M('user')->where(array('wechatid'=>$openid))->find();
			if(!$_SESSION['user_info'] /* || empty($_SESSION['user_info']['username']) */){
				$this->getuser();
			}
		}
    }
    public function getuser(){
		//弹出授权页面
		$appid = D('setting')->where(array('name'=>'appid'))->find();
		$appid = trim($appid['data']);
		$redirect_uri = "http://yooopay.com/index.php?m=Weixin&a=getauth";
		$redirect_uri = urlencode($redirect_uri);
		$scope = "snsapi_userinfo";
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=123#wechat_redirect";
		echo "<script>window.location.href='".$url."'</script>";exit; 
	}
    private  function _index_cate()
    {
    	 //分类
        if (false === $index_cate_list = F('index_cate_list')) {
            $item_cate_mod = M('item_cate');
            //分类关系
            if (false === $cate_relate = F('cate_relate')) {
                $cate_relate = D('item_cate')->relate_cache();
            }
            //分类缓存
            if (false === $cate_data = F('cate_data')) {
                $cate_data = D('item_cate')->cate_data_cache();
            }
            //推荐到首页的大类
            $index_cate_list = $item_cate_mod->field('id,name,img')->where(array('pid'=>'0' ,'is_index'=>'1', 'status'=>'1'))->order('ordid')->select();
            foreach ($index_cate_list as $key=>$val) {
                //推荐到首页的子类
                $where = array('status'=>'1', 'is_index'=>'1', 'spid'=>array('like', $val['id'] . '|%'));
                $index_cate_list[$key]['index_sub'] = $item_cate_mod->field('id,name,img')->where($where)->order('ordid desc')->select();
                //普通子类
                $index_cate_list[$key]['sub'] = array();
                foreach ($cate_relate[$val['id']]['sids'] as $sid) {
                    if ($cate_data[$sid]['type'] == '0' && $cate_data[$sid]['pid'] != $val['id']) {
                        $index_cate_list[$key]['sub'][] = $cate_data[$sid];
                    }
                    if (count($index_cate_list[$key]['sub']) >= 6) {
                        break;
                    }
                }
            }
            F('index_cate_list', $index_cate_list);

        }
        $this->assign('index_cate_list', $index_cate_list);
    }
    
    /**
    * 初始化访问者
    */
    private function _init_visitor() {
        $this->visitor = new user_visitor();
        $this->assign('visitor', $this->visitor->info);
    }
    /**
     * 第三方登陆模块
     */
    private function _assign_oauth() {
        if (false === $oauth_list = F('oauth_list')) {
            $oauth_list = D('oauth')->oauth_cache();
        }
        $this->assign('oauth_list', $oauth_list);
    }

    /**
     * SEO设置
     */
    protected function _config_seo($seo_info = array(), $data = array()) {
        $page_seo = array(
            'title' => C('pin_site_title'),
            'keywords' => C('pin_site_keyword'),
            'description' => C('pin_site_description')
        );
        $page_seo = array_merge($page_seo, $seo_info);
        //开始替换
        $searchs = array('{site_name}', '{site_title}', '{site_keywords}', '{site_description}');
        $replaces = array(C('pin_site_name'), C('pin_site_title'), C('pin_site_keyword'), C('pin_site_description'));
        preg_match_all("/\{([a-z0-9_-]+?)\}/", implode(' ', array_values($page_seo)), $pageparams);
        if ($pageparams) {
            foreach ($pageparams[1] as $var) {
                $searchs[] = '{' . $var . '}';
                $replaces[] = $data[$var] ? strip_tags($data[$var]) : '';
            }
            //符号
            $searchspace = array('((\s*\-\s*)+)', '((\s*\,\s*)+)', '((\s*\|\s*)+)', '((\s*\t\s*)+)', '((\s*_\s*)+)');
            $replacespace = array('-', ',', '|', ' ', '_');
            foreach ($page_seo as $key => $val) {
                $page_seo[$key] = trim(preg_replace($searchspace, $replacespace, str_replace($searchs, $replaces, $val)), ' ,-|_');
            }
        }
        $this->assign('page_seo', $page_seo);
    }
	public function get_jsapi(){
		//判断是否对jsapi进行全局缓存
		if(F('jsapi'!='')){
			$jsapi=F('jsapi');
		}else{ 
			//获取appid
			$setting = D('setting');
			$appid = $setting->where(array('name'=>'appid'))->find();
			$appid = $appid['data'];
			//获取appsecret
			$appsecret = $setting->where(array('name'=>'appsecret'))->find();
			$appsecret = $appsecret['data'];
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
			$data = json_decode($this->get_http($url),true);
			$access_token = $data['access_token'];
			//获取jsapi
			$url="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
			
			$jsapi = json_decode($this->get_http($url),true);
			F('jsapi',$jsapi['ticket']);
		}
		$time = time();
        $noncestr= $time;
        $jsapi_ticket= $jsapi['ticket'];
        $timestamp=$time;
        $url='http://yooopay.com'.$_SERVER['REQUEST_URI'];  
        $and = "jsapi_ticket=".$jsapi_ticket."&noncestr=".$noncestr."&timestamp=".$timestamp."&url=".$url;
        $signature = sha1($and);
		$data=array('id'=>$this->visitor->info['id'],'timestamp'=>$timestamp,'jsapi_ticket'=>$jsapi_ticket,'signature'=>$signature,'url'=>$url."&shares=".session('shopid'));
		return $data;
	}
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
    /*
     *   检测卖咖是否需要续费
     */
    public function check_ren(){
        $ren_time = $this->visitor->info['ren_time'];
        if ($ren_time < strtotime("- 1year")) {
            //续费标识,在分销分成体系需要用到
            $data['status'] = 2;
            M('user')->where(array('id'=>$this->visitor->info['id']))->save($data);
        }
    }
    /**
    * 连接用户中心
    */
    protected function _user_server() {
        $passport = new passport(C('pin_integrate_code'));
        return $passport;
    }

    /**
     * 前台分页统一
     */
    protected function _pager($count, $pagesize) {
        $pager = new Page($count, $pagesize);
        $pager->rollPage = 5;
        $pager->setConfig('prev', '<');
        $pager->setConfig('theme', '%upPage% %first% %linkPage% %end% %downPage%');
        return $pager;
    }

    /**
     * 瀑布显示
     */
    public function waterfall($where = array(), $order = 'id DESC', $field = '', $page_max = '', $target = '') {
        $spage_size = C('pin_wall_spage_size'); //每次加载个数
        $spage_max = C('pin_wall_spage_max'); //每页加载次数
        $page_size = $spage_size * $spage_max; //每页显示个数
        
        $item_mod = M('item');
        $where_init = array('status'=>'1');
        $where = $where ? array_merge($where_init, $where) : $where_init;
        $count = $item_mod->where($where)->count('id');
        //控制最多显示多少页
        if ($page_max && $count > $page_max * $page_size) {
            $count = $page_max * $page_size;
        }
        //查询字段
        $field == '' && $field = 'id,uid,uname,title,intro,img,price,likes,comments,comments_cache';
        //分页
        $pager = $this->_pager($count, $page_size);
        $target && $pager->path = $target;
        $item_list = $item_mod->field($field)->where($where)->order($order)->limit($pager->firstRow.','.$spage_size)->select();
        foreach ($item_list as $key=>$val) {
            isset($val['comments_cache']) && $item_list[$key]['comment_list'] = unserialize($val['comments_cache']);
        }
        $this->assign('item_list', $item_list);
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
    }
	function check_wap() { 
		if (isset($_SERVER['HTTP_VIA'])) return true; 
		if (isset($_SERVER['HTTP_X_NOKIA_CONNECTION_MODE'])) return true; 
		if (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID'])) return true; 
		if (strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0) { 
		// Check whether the browser/gateway says it accepts WML. 
		$br = "WML"; 
		} else { 
			$browser = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) : ''; 
			if(empty($browser)) return true;
			$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ'); 

			$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod'); 

			$found_mobile=$this->checkSubstrs($mobile_os_list,$browser) || 
			$this->checkSubstrs($mobile_token_list,$browser);
			if($found_mobile)
				$br ="WML";
			else $br = "WWW";
		} 
		if($br == "WWW") { 
			return true; 
		} else { 
			return false; 
		} 
	}

	function checkSubstrs($list,$str){
		$flag = false;
		for($i=0;$i<count($list);$i++){
		  if(strpos($str,$list[$i]) > 0){
		   $flag = true;
		   break;
		  }
		}
		return $flag;
	}
    /**
     * 瀑布加载
     */
    public function wall_ajax($where = array(), $order = 'id DESC', $field = '') {
        $spage_size = C('pin_wall_spage_size'); //每次加载个数
        $spage_max = C('pin_wall_spage_max'); //加载次数
        $p = $this->_get('p', 'intval', 1); //页码
        $sp = $this->_get('sp', 'intval', 1); //子页

        //条件
        $where_init = array('status'=>'1');
        $where = array_merge($where_init, $where);
        //计算开始
        $start = $spage_size * ($spage_max * ($p - 1) + $sp);
        $item_mod = M('item');
        $count = $item_mod->where($where)->count('id');
        $field == '' && $field = 'id,uid,uname,title,intro,img,price,likes,comments,comments_cache';
        $item_list = $item_mod->field($field)->where($where)->order($order)->limit($start.','.$spage_size)->select();
        foreach ($item_list as $key=>$val) {
            //解析评论
            isset($val['comments_cache']) && $item_list[$key]['comment_list'] = unserialize($val['comments_cache']);
        }
        $this->assign('item_list', $item_list);
        $resp = $this->fetch('public:waterfall');
        $data = array(
            'isfull' => 1,
            'html' => $resp
        );
        $count <= $start + $spage_size && $data['isfull'] = 0;
        $this->ajaxReturn(1, '', $data);
    }
    /**
    *判断微信浏览器 
    */
    public function is_weixin(){ 
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ){
            return true;
        }else{
            return false;
        }
    }


}