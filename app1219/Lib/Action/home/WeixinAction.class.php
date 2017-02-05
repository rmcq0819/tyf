<?php
// 本类由系统自动生成，仅供测试用途
header("content-type:text/html;charset=utf-8");

//sail 经纬度计算距离
/**
*  @desc 根据两点间的经纬度计算距离
*  @param float $lat 纬度值
*  @param float $lng 经度值
*/
 function GetDistance($lat1, $lng1, $lat2, $lng2)
 {
     $earthRadius = 6367000; //approximate radius of earth in meters
 
     /*
       Convert these degrees to radians
       to work with the formula
     */
 
     $lat1 = ($lat1 * pi() ) / 180;
     $lng1 = ($lng1 * pi() ) / 180;
 
     $lat2 = ($lat2 * pi() ) / 180;
     $lng2 = ($lng2 * pi() ) / 180;
 
     /*
       Using the
       Haversine formula
 
       http://en.wikipedia.org/wiki/Haversine_formula
 
       calculate the distance
     */
 
     $calcLongitude = $lng2 - $lng1;
     $calcLatitude = $lat2 - $lat1;
     $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
     $calculatedDistance = $earthRadius * $stepTwo;
 
     return round($calculatedDistance);
 }

class WeixinAction extends Action {
	
	public $wxurl ; 
	
	function __construct()   
    {   
		$this->wxurl = $_SERVER['SERVER_NAME'].__ROOT__ ;
	}

	public function wenben($fromUsername, $toUsername, $time, $contentStr)
	{
		//////文本链接的处理/ ///
		$str=$contentStr;
	    $reg = '/\shref=[\'\"]([^\'"]*)[\'"]/i';
		preg_match_all($reg , $str , $out_ary);//正则：得到href的地址
		$src_ary = $out_ary[1];
       if(!empty($src_ary))//存在
      {
      	$comment=$src_ary[0];
      	if(stristr($comment,$_SERVER['SERVER_NAME']))
      	{
      		if(stristr($comment,"?"))
      		{
      			$links=$comment."&key=".$fromUsername;
      			$contentStr= str_replace($comment,$links,$str);
      		}else
      		{
      			$links=$comment."?key=".$fromUsername;
      			$contentStr= str_replace($comment,$links,$str);
      		}
      	}
      }
		
  	//////文本链接的处理 END////
  
    $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
		$msgType = "text";
	//$contentStr =$contentStr;
	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	echo $resultStr;
	}
	public function tuwen($textTpl,$fromUsername, $toUsername, $time,$count)
	{
              		$msgType = "news";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$count);
					echo $resultStr;
	}
	/*
	 * @edit  vany
	 *
	 * date   2015 03 - 2015 12 	
	 */
	 
	 
	 
	  
	
	 
	 
	public function index(){
		import('Think.ORG.Weixin');// 导入微信类
		//traceHttp();
		$wechat = new Weixin();
		$wechat->valid();
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//获取推送事件内容
		if (!empty($postStr)){
			$key_word=M('keyword');
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = trim($postObj->FromUserName);//发送方帐号（一个OpenID）
			$toUsername = $postObj->ToUserName;//开发者微信号 
			$keyword = trim($postObj->Content);//用户发来的信息
			$MediaId=trim($postObj->MediaId);//获取内容语音类型
			$picurl=trim($postObj->PicUrl);//获取内容图文类型
			$RX_TYPE = trim($postObj->MsgType);//类型
			$EventKey=trim($postObj->EventKey);//事件KEY值
			$Event=$postObj->Event;//事件类型
			$time = time();
			//保存wechatid到session
			if(!$_SESSION['wechatid']){
				$_SESSION['wechatid'] = $fromUsername;
			}
			if($RX_TYPE=='event')
			{
			
				//**自定义点击事件**//
				if($Event=='CLICK')
				{

					if($EventKey!='')
					{	
						if ($EventKey == '邀请链接') {
							$res =M('user')->where(array('wechatid'=>$fromUsername))->field('id,uid,username')->find();
							// 判断当前用户是否具备推广链接权限
							if (!is_array($res) || $res['uid'] == 4 || $res['uid'] == 5) {
								$this->wenben($fromUsername, $toUsername, $time,"您没有权限!");
								exit;
							}else{
								$appid = D('setting')->where(array('name'=>'appid'))->find();
	    						$appid = trim($appid['data']);
								$redirect_uri = "http://".$_SERVER['SERVER_NAME']."/index.php?m=Weixin&a=getauth";
								$redirect_uri = urlencode($redirect_uri);
					    		$scope = "snsapi_userinfo";
					    		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=id-".$res['id']."#wechat_redirect";
								$this->assign('urls',$url);
								//推送链接信息
								$text='{
										"touser": "'.$fromUsername.'", 
										"msgtype": "text", 
										"text": {
											"content": "以下是您的授权链接，长按链接复制转发给您的代理: \n\n'.$url.' \n\n您也可以点击以下链接直接生成二维码发给您的代理(推荐):\n\nhttp://www.yooopay.com/index.php?m=Weixin&data='.urlencode($url).'&a=qrcodes&userid='.$res['id'].'  \n\n感谢您对团洋范的支持 :)
											",
										}
									}';
								$this->Notice($text);
								
							}
						}else{
							$where=array('keyword'=>$EventKey);
							$custom_key= M('custom_menu')->where($where)->find();
							$key_list= $key_word->where("kyword='".$custom_key['keyword']."'")->find();
							if(is_array($key_list))
							{
								if($key_list['type']==1)//文本
								{	
									$this->wenben($fromUsername, $toUsername, $time,$key_list['kecontent']);
								}else //图文
								{
									$titles                   = unserialize($key_list['titles']);
									$imageinfo                = unserialize($key_list['imageinfo']);
									$linkinfo                 = unserialize($key_list['linkinfo']);

									$textTpl = "<xml>
												<ToUserName><![CDATA[%s]]></ToUserName>
												<FromUserName><![CDATA[%s]]></FromUserName>
												<CreateTime>%s</CreateTime>
												<MsgType><![CDATA[%s]]></MsgType>
												 <ArticleCount>%s</ArticleCount> 
					                            <Articles>";
									for($i=0;$i<count($titles);$i++)
									{
										if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME']))
										{
											if(stristr($linkinfo[$i],"?"))
											{
												$links=$linkinfo[$i]."&key=".$fromUsername;
											}else
											{
												$links=$linkinfo[$i]."?key=".$fromUsername;
											}
										}else{
											$links=$linkinfo[$i];
										}
										
										if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME']))
										{
										$images=$imageinfo[$i];
										}else
										{
										$images="http://".$_SERVER['SERVER_NAME'].__ROOT__.'/'.$imageinfo[$i];
										}
										
										$textTpl.= "<item>
							                           <Title><![CDATA[".$titles[$i]."]]></Title> 
							                           <Description><![CDATA[".$titles[$i]."]]></Description>
							                           <PicUrl><![CDATA[".$images."]]></PicUrl>
							                           <Url><![CDATA[".$links."]]></Url>
						                            </item>";
									}
									$textTpl.= "</Articles>
		                           <FuncFlag>0</FuncFlag>
		                           </xml> 
									";
									$this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
								}
							}
						}	

					}
				}
					
				if($Event=='subscribe' || $Event=='SCAN' ||$Event=='unsubscribe')
				{	
					//关注事件
					switch ($Event) {
						case 'subscribe':
							$this->requestdata('follownum');
							break;
						case 'unsubscribe':
							$this->requestdata('unfollownum');
							break;
						case 'SCAN':
							$uid = $EventKey;
							break;
					}
					//获取关注自动回复数据
					$key_list= $key_word->where("isfollow=1")->find();
					//判断数据库是否存在用户
					$user = D('user');
					$res = $user->where(array('wechatid'=>$fromUsername))->find();
					if($Event=='unsubscribe'){
						$data['follownum']=0;
						$user->where(array('wechatid'=>$fromUsername))->save($data);
					}

					if($Event=='subscribe'){
						/**
						 * 保存openid到数据库，创建会员
						*/
						if(!is_array($res)){
							//调用微信接口获取用户详细信息
							$res1=$this->getuserinfo($fromUsername);
							//$this->log($res1['nickname']);
							//创建一个会员
							$data = array(
									'wechatid'=>$fromUsername,
									'nickname'=>$res1['nickname'],
									'username'=>$res1['nickname'],
									'unionid'=>$res1['unionid'],
									'gender'=>$res1['sex'],
									'byear'=>1,
									'bmonth'=>1,
									'bday'=>1,
									'province'=>$res1['province'],
									'city'=>$res1['city'],
									'cover'=>$res1['headimgurl'],
									'reg_time'=>time(),
									'status'=>'1',
									'follownum'=>'1',
							);
							//判断场景值是否为空,不为空则获取场景值
							if(!empty($EventKey)){
								$shares=explode('_',$EventKey);
								$data['shares']=$shares[1];
							}
							$user->add($data);
						}else{
							//添加关注标示
							$data['follownum']=1;
							$user->where(array('wechatid'=>$fromUsername))->save($data);
						}

						//推送关注送劵消息
						$res1=M('user')->where(array('wechatid'=>$fromUsername))->find();
						$daijin=M('djtemp')->where(array('type'=>1,'start'=>array('lt',$time),'end'=>array('gt',$time)))->find();
						$dj=M('daijin')->where(array('djuser'=>$res1['id'],'temp'=>$daijin['id']))->find();
						if(!$dj&&$daijin['id']!=''){
							$data['djuser']=$res1['id'];
							$data['djusername']=$res1['username'];
							$data['djname']=$daijin['djname'];
							$data['djmoney']=$daijin['djprice'];
							$data['djcondition']=$daijin['djcondition'];
							$data['djstart']=$daijin['start'];
							$data['djend']=$daijin['end'];
							$data['temp']=$daijin['id'];
							$data['t_name']=$daijin['temp'];
							$data['djstatus']=0;
							$list=M('daijin')->add($data);
							$text='{
										"touser": "'.$fromUsername.'", 
										"msgtype": "text", 
										"text": {
											"content": "尊敬的'.$res1['username'].',感谢的您的关注,我们已发送一张面额为'.$daijin['djprice'].'元的代金劵至你的卡包,请在商城的用户中心查看"
										}
									}';
							$this->Notice($text);		
						}
						
						if(is_array($key_list))//关注时回复
						{	   
							if($key_list['type']==1 && empty($uid))//文本
							{
								$this->wenben($fromUsername, $toUsername, $time,$key_list['kecontent']);
							}else {
								//图文
								$titles                   = unserialize($key_list['titles']);
								$imageinfo                = unserialize($key_list['imageinfo']);
								$linkinfo                 = unserialize($key_list['linkinfo']);

								$textTpl = "<xml>
											<ToUserName><![CDATA[%s]]></ToUserName>
											<FromUserName><![CDATA[%s]]></FromUserName>
											<CreateTime>%s</CreateTime>
											<MsgType><![CDATA[%s]]></MsgType>
											 <ArticleCount>%s</ArticleCount> 
					                        <Articles>";
								for($i=0;$i<count($titles);$i++)
								{
									if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME'])){
										if(stristr($linkinfo[$i],"?")){
											$links=$linkinfo[$i]."&key=".$fromUsername;
										}else{
											$links=$linkinfo[$i]."?key=".$fromUsername;
										}
									}else{
										$links=$linkinfo[$i];
									}

			                        if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME'])){
										$images=$imageinfo[$i];
									}else{
										$images="http://".$_SERVER['SERVER_NAME'].__ROOT__.'/'.$imageinfo[$i];
									}
									$textTpl.= "<item>
						                           <Title><![CDATA[".$titles[$i]."]]></Title> 
						                           <Description><![CDATA[".$titles[$i]."]]></Description>
						                           <PicUrl><![CDATA[".$images."]]></PicUrl>
						                           <Url><![CDATA[".$links."&shares=".$uid."]]></Url>
					                           	</item>";
								}
								$textTpl.= "		</Articles>
		                       					<FuncFlag>0</FuncFlag>
		                       				</xml> 
								";
								$this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
							}
						}	
					}

				}
				
			}
			if(!empty($keyword)||!empty($picurl)||!empty($MediaId))
			{	
				if (!empty($keyword)) {
					$this->requestdata('textnum');
				}elseif(!empty($picurl)){
					$this->requestdata('imgnum');
				}elseif (!empty($MediaId)) {
					$this->requestdata('videonum');
				}
				$key_list= $key_word->where("kyword='".$keyword."'")->find();
				if(is_array($key_list))
				{
					if($key_list['type']==1)//文本
					{
						$this->wenben($fromUsername, $toUsername, $time,$key_list['kecontent']);
					}else //图文
					{
							$titles                   = unserialize($key_list['titles']);
							$imageinfo                = unserialize($key_list['imageinfo']);
							$linkinfo                 = unserialize($key_list['linkinfo']);
						
                    $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							 <ArticleCount>%s</ArticleCount> 
                            <Articles>";
                    for($i=0;$i<count($titles);$i++)
                    {
                    	if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME']))
                    	{
                    		if(stristr($linkinfo[$i],"?"))
                    		{
                    			$links=$linkinfo[$i]."&key=".$fromUsername;
                    		}else
                    		{
                    			$links=$linkinfo[$i]."?key=".$fromUsername;
                    		}
                    	}else{
                    		$links=$linkinfo[$i];
                    	}
                    	   if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME']))
								{
								$images=$imageinfo[$i];
								}else
								{
								$images="http://".$_SERVER['SERVER_NAME'].__ROOT__.'/'.$imageinfo[$i];
								}
								
								
							$textTpl.= "<item>
			                           <Title><![CDATA[".$titles[$i]."]]></Title> 
			                           <Description><![CDATA[".$titles[$i]."]]></Description>
			                           <PicUrl><![CDATA[".$images."]]></PicUrl>
			                           <Url><![CDATA[".$links."]]></Url>
			                           </item>";
                    }
                          $textTpl.= "</Articles>
                           <FuncFlag>0</FuncFlag>
                           </xml> 
							";
                    $this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
					}

				}else //自动回复
				{
					$key_list= $key_word->where("ismess=1")->find();
					if(is_array($key_list))//是否存在
					{
						if($key_list['type']==1)//文本
						{
							//这里将消息自动回复去掉了。
							//$this->wenben($fromUsername, $toUsername, $time, $key_list['kecontent']);
						}else //图文
						{
							$titles                   = unserialize($key_list['titles']);
							$imageinfo                = unserialize($key_list['imageinfo']);
							$linkinfo                 = unserialize($key_list['linkinfo']);

							$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							 <ArticleCount>%s</ArticleCount> 
                            <Articles>";
                    for($i=0;$i<count($titles);$i++)
                    {
                    	if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME']))
                    	{
                    		if(stristr($linkinfo[$i],"?"))
                    		{
                    			$links=$linkinfo[$i]."&key=".$fromUsername;
                    		}else
                    		{
                    			$links=$linkinfo[$i]."?key=".$fromUsername;
                    		}
                    	}else{
                    		$links=$linkinfo[$i];
                    	}
                    	
                    	   if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME']))
								{
								$images=$imageinfo[$i];
								}else
								{
								$images="http://".$_SERVER['SERVER_NAME'].__ROOT__.'/'.$imageinfo[$i];
								}
								
								
							$textTpl .="<item>
			                           <Title><![CDATA[".$titles[$i]."]]></Title> 
			                           <Description><![CDATA[".$titles[$i]."]]></Description>
			                           <PicUrl><![CDATA[".$images."]]></PicUrl>
			                           <Url><![CDATA[".$links."]]></Url>
			                           </item>";
                    }
                          $textTpl.= "</Articles>
                           <FuncFlag>0</FuncFlag>
                           </xml> 
							";
                    $this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
						}
					}else
					{

					}
				}


			}else{
				echo "Input something...";
			}

		}else {
			echo "";
			exit;
		}
	
	}
	
	 public function qrcodes(){
		 //接收邀请链接
		$url=$_GET['data'];
		//代理商用户名
		$user_name= M('user')->where(array('id'=>$_GET['userid']))->find();
		$this->assign('user_name',$user_name['username']);
		//$this->assign('url',$url);
        //$uid=$this->visitor->info['id'];
        vendor("phpqrcode.phpqrcode");//引入工具包
        $errorCorrectionLevel = 'L';//容错级别  
        $matrixPointSize = 20;//生成图片大小  
        //生成二维码图片  
        QRcode::png($url,'./data/upload/qrcode/qrcodes.png', $errorCorrectionLevel, $matrixPointSize, 2);  
       // $logo = './data/upload/qrcode/logo.png';//准备好的logo图片  
        $QR = './data/upload/qrcode/qrcodes.png';//已经生成的原始二维码图  

    /*     if ($logo !== FALSE) {  
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
        }   */
        //输出图片  
        imagepng($QR,'./data/upload/qrcode/qrcodes.png'); 
		$img='./data/upload/qrcode/qrcodes.png';
        /* echo '<img src="./data/upload/qrcode/qrcodes.png" width="100%",height="auto">';   */
		$this->assign('imgurls',$img);
		$this->display();
    }
	 
	/*
	 * @author  vany
	 *
	 * date   2015 03 - 2015 12 	
	 */
	public function Notice($text){
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
		
		//通过微信客服接口推送消息
		$url0='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;	
		$result=$this->https_post($url0,$text);
	}
	/*
	 * @author  vany
	 *
	 * date   2015 03 - 2015 12 	
	 */
	public function getuserinfo($openid){
    	//获取appid
		$setting = D('setting');
		$appid = $setting->where(array('name'=>'appid'))->find();
		$appid = $appid['data'];
		//获取appsecret
		$appsecret = $setting->where(array('name'=>'appsecret'))->find();
		$appsecret = $appsecret['data'];
		//获取缓存access_token,并判断是否失效

		$access_token = S('access_token');
		if(!$access_token){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
			$result=$this->get_http($url);
			$data = json_decode($result,true);
			$access_token = $data['access_token'];
			S('access_token',$access_token,7200);
		}
		$url1="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid;
		$result1=$this->get_http($url1);
		$data1 = json_decode($result1,true);
		return $data1;
    }

	function log($word){
		$log_name='./log.log';
		$fp=fopen($log_name,"a");
		flock($fp,LOCK_EX);
		fwrite($fp,"日期".strftime("%Y-%m-%d-%H:%M:%S",time()).".\n".$word."\n\n");
		flock($fp,LOCK_UN);
		$fclose($fp);
	}
	
	/*
	 * 后台数据魔方记录数据
	 *
	 * @author  vany
	 *
	 * date   2015 05 19	
	 */
	public function requestdata($field)
    {
        $data['year']  = date('Y');
        $data['month'] = date('m');
        $data['day']   = date('d');
        $mysql         = M('requestdata');
        $check         = $mysql->field('id')->where($data)->find();
        if ($check == false) {
            $data['time'] = time();
            $data[$field] = 1;
            $mysql->add($data);
        } else {
            $mysql->where($data)->setInc($field);
        }
    }
	/*
	 * @edit  vany
	 *
	 * date   2015 03 - 2015 12 	
	 */
	public function getauth(){
		//接受code
		$code = $this->_get('code','trim');
		$state = $this->_get('state','trim');
		$user =M('user');
		//获取appid
		$setting = D('setting');
		$appid = $setting->where(array('name'=>'appid'))->find();
		$appid = $appid['data'];
		//获取appsecret
		$appsecret = $setting->where(array('name'=>'appsecret'))->find();
		$appsecret = $appsecret['data'];
		$access_token = S('access_token');
		//$openid = cookie('openid');

		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?code=".$code."&grant_type=authorization_code&appid=".$appid."&secret=".$appsecret;
		//获取access_token
		$result = $this->get_http($url);
		$data = json_decode($result,true);
		$access_token = $data['access_token'];
		$openid = $data['openid'];
		S('access_token',$access_token,7200);
		cookie('openid',$openid,3600*24*7);
		$url2 = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
		//获取用户信息
		$result2 =  $this->get_http($url2);
		$data2 = json_decode($result2,true);
		//获取用户基本信息
		$userinfo['username'] = $data2['nickname'];
		$userinfo['nickname'] = $data2['nickname'];
		$userinfo['unionid'] = $data2['unionid'];
		if($data2['sex'] == 2){
			$userinfo['gender'] = 0;
		}else{
			$userinfo['gender'] = $data2['sex'];
		}
		$userinfo['province'] = $data2['province'];
		$userinfo['city'] = $data2['city'];
		$userinfo['cover'] = $data2['headimgurl'];
		$userinfo['last_time'] = time();
		$userinfo['last_id'] = $_SERVER['REMOTE_ADDR'];
		$userinfo['status'] = "1";
		$cuser = $user->where(array('wechatid'=>$openid))->field('id')->find();
		if($cuser['id']){
			$id = $user->where(array('wechatid'=>$openid))->data($userinfo)->save();
			$data3['djusername']=$userinfo['username'];
			M('daijin')->where(array('djuser'=>$cuser['id']))->save($data3);
			if ($state == '123') {
				$this->redirect($_SESSION['url']);
			}else{
				$this->redirect('Recom/index',array('state'=>$state));
			}
		}else{
			$userinfo['wechatid'] = $openid;
			//$userinfo['shares'] = $_SESSION['shares'];
			$userinfo['reg_ip'] = $_SERVER['REMOTE_ADDR'];
			$userinfo['reg_time']=time();
			$id = $user->data($userinfo)->add();
			if($id){
				$userdata = $user->find($id);
				//登陆
				$_SESSION['user_info'] = $userdata;
				$_SESSION['wechatid'] = $openid;
				if ($state == '123') {
					$this->redirect($_SESSION['url']);
				}else{
					$this->redirect('Recom/index',array('state'=>$state));
				}
			}else{
				echo "创建用户失败";exit;
			}
		}
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

	function https_post($url,$data) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($curl);   
			curl_close($curl);
			return $result; 
	} 
	/**
	**zfck
	**/	
	public function sendmsg($fromUsername, $toUsername, $time, $para){
					
			$data['ftid'] =	"";	 
			$data['from_id']="";//用户名
			$data['from_name'] = $fromUsername;	 
			$data['to_id']= "";//用户名
			$data['to_name']=  (string)$toUsername;
			$data['add_time']= $time;
			$data['info']= $para;
			$data['status']= 1;
			$message = M('message')->add($data);
			if($message){			
				 return "亲，您的留言已经收到，我们会尽快处理！";
			}else{
				
				 return "留言没有发送成功！";
			}
			
		}
	 
	public function data($keyword){
		
			$cmd = array("天气"=>"tq","翻译"=>"fy","找书"=>"cs","电影"=>"movies","txl"=>"txl","bd"=>"bd","淘宝"=>"taobao","留言"=>"msg","音乐"=>"music","股票"=>"gp","快递"=>"kd","归属"=>"ckmobei","身份证"=>"ckpopid","通讯录"=>"concate");
			 
			$keyword = strtolower(trim($keyword));
	   
				if($keyword == "help"){

					$keywordArr = array();
					$keywordArr['cmd'] = "help";
					$keywordArr['para'] = $keyword;
					return $keywordArr;
					exit();	
				}
				
				$str2= stristr($keyword,":");

				$str= false;

				if(!$str2){
					$str1 = stristr($keyword,"：");
					if($str1){
					$keyword = str_replace("：","#",$keyword);
					$str = ture;
					}

				}else{
					$keyword = str_replace(":","#",$keyword);
					$str = ture;

				}
				 

				if($str){

					$keyfn = explode("#",$keyword);

					if(array_key_exists($keyfn[0],$cmd)){

						$keywordArr = array();	
						$keywordArr['cmd']  = $cmd[$keyfn[0]];
						$keywordArr['para'] = $keyfn[1];

						return $keywordArr;	

					}

				}else{
				 
					   return $keyword;	
				}

		}
		
		
		
		
	public function getkuaidi($keyword){
		
		import('Think.ORG.Kuaidicompany');// 导入快递公司
		
		$kd = new Kuaidicompany();

		$keyword = $this->get_utf8_string($keyword);

		$typeNu = $this->findNum($keyword);

		$str = $typeNu;

		$type = substr($keyword,0,strlen($keyword)-strlen($typeNu));

		$typeCom = $kd->ckkdcm($type);

	   if(isset($typeCom) && isset($typeNu)){

		 $url ="http://wap.kuaidi100.com/wap_result.jsp?rand=20130517&id=$typeCom&fromWeb=null&&postid=$typeNu";

		 $curl = curl_init();
		 curl_setopt ($curl, CURLOPT_URL, $url);
		 curl_setopt($curl,CURLOPT_HEADER,0);     
		 curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt ($curl, CURLOPT_TIMEOUT,5);
		
		 $content = curl_exec($curl);

		 $output = explode('<div style="margin:8px 0;padding:5px;background-color:#FFFAE2">',$content);

		 $content = explode('</div>',$output[1]);
		 $content = str_replace("</p>", "\n", $content[1]);
		 $content = str_replace("&middot;", "", $content);
		 $str = preg_replace( "@<(.*?)>@is", "", $content);

		if(empty($str)){ $str='查询失败，请重试';}  

		}else{

			$str='查询失败，请重新核对快递信息！';
		}
	 
		$contentStr = $this->get_utf8_string(trim($str)); 

		return  $contentStr;

	}


		 //  将一些字符转化成utf8格式      
	public function get_utf8_string($content)
	{    
		
		 $encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));  
		   return  mb_convert_encoding($content, 'utf-8', $encoding);
	}

	//提取字符串中数字

	public function findNum($str='')
	{
		$str=trim($str);
		if(empty($str)){return '';}
		$temp=array('1','2','3','4','5','6','7','8','9','0');
		$result='';
		for($i=0;$i<strlen($str);$i++){
			if(in_array($str[$i],$temp)){
				$result.=$str[$i];
			}
		}
		return $result;
	}
		
    
}