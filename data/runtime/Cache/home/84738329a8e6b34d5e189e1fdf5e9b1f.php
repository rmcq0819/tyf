<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo ($info["merchant"]); ?></title>
<link href="../Style/css/amazeui.css" rel="stylesheet" type="text/css" />
<link href="../Style/css/css.css" rel="stylesheet" type="text/css" />
<link href="../Style/css/jquery.spinner.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../Style/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../Style/js/TouchSlide.1.1.js"></script>
<script type="text/javascript" src="../Style/js/amazeui.min.js"></script>
<script type="text/javascript" src="../Style/js/jquery.spinner.js"></script>
<script type="text/javascript" src="../Style/js/scrollTop.js"></script>
<script type="text/javascript" src="../Style/js/indexshop.js"></script>
<script type="text/javascript" src="../Style/js/jquery.fly.min.js"></script>
<script src="../Style/js/fastclick.js" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript">
	$(function() { 
		FastClick.attach(document.body);
	}); 
</script>
<style type="text/css">
#rtt {width:30px; height:30px; background:url(../Style/images/rrt.png); background-size:cover; position:fixed; right:8px; bottom:70px; border-radius: 5px; z-index:999; display:none;}
.proneirong img{width:100%;}
.overlay{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}
.overlay .box{position:fixed;z-index:9999;color:#333;width:320px;height:100px;text-align:center;overflow:hidden;top:0;right:0;bottom:0;left:0;margin:auto;border-radius:5px;background:#FFF;display:block;z-index:9999;}
.overlay .box_title{font-size:14px;font-family:微软雅黑;margin-top:22px;padding:5px;border-bottom:1px solid #ccc;}
.overlay .box_btn{margin-top:15px;}
.overlay .box_btn a{margin:0px 40px;color:#0E90D2;font-size:14px;}
.jj a{border:1px solid #ccc; width:25px; height:25px; padding:2px;}

.noshop{width:100%;margin-top:40%; text-align:center;}
.noshop a{padding:5px 35px; background:#C54056;color:#fff;}

.sreach{position:fixed; left:0; top:0;width:100%;height:100%;z-index:9999;background:#DDD;display:none;}
.am-icon-chevron-left{color:#fff;font-size:16px;}
.am-icon-search{color:#fff;font-size:20px;margin-left:8px;}
#itemlist{float:left;width:99%;height:100%; padding:8px;}
#itemlist li{ padding:5px; background:#FFF;margin-bottom:8px;}
.prorenqi a.onselect{color:#FF3300;}
.load{position:fixed;z-index:999;color:#fff;width:320px;height:150px;text-align:center;overflow:hidden;top:0;right:0;bottom:0;left:0;margin:auto;display:none;}
.load img{border-radius:32px;}
.load span{color:#999999;display:block;}
.nolist{width:90%;height:50px;margin:30px auto;font-size:14px;border:1px solid #ddd; text-align:center;line-height:50px;}
.top-title { background:#C54056;height:49px;line-height:49px;color:#FFF;font-size:14px;text-align:center;position: fixed;left:0;top:0;width:100%;transition: top .5s;z-index:9999;}
.top-title2 { background:#C54055;color:#FFF;line-height:32px;padding:5px;text-align:center;position: fixed;left:0;top:0;width:100%;transition: top .5s;z-index:9999;display:none;}
.hiddened{top: -90px;}
.showed{top:0;z-index: 9999;}
.onetop,.twotop,.threetop{width:30px;height:30px;display:block;border-radius:30px;padding:5px;line-height:18px;border:1px solid #333;}
.onetop img,.twotop img,.threetop img{width:20px;heihgt:20px;}
.twotop,.threetop{float:right;}
.onetop1,.twotop1,.threetop1{width:30px;height:30px;display:block;border-radius:30px;padding:5px;line-height:18px;border:1px solid #FFF;}
.onetop1 img,.twotop1 img,.threetop1 img{width:20px;heihgt:20px;}
.twotop1,.threetop1{float:right;}
.cartmsg{width:100%;height:auto; padding:10px 7px;;background:#000;opacity:0.7;-moz-opacity:0.7;filter:alpha(opacity=70);display:none;margin-top:4px;color:#FFFFFF; position:fixed;z-index:9999;font-size:16px;}
#mcover {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: none;
    z-index: 20000;
}
#mcover img {
    position: fixed;
    right: 18px;
    top: 5px;
    width: 260px!important;
    height: 180px!important;
    z-index: 20001;
}

.overlay2{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}
.overlay3{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}
.overlay4{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}

.overlay5{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}

.addr_index{background:#FFF;width:100%;height:auto;padding-bottom:12px;}
.addr_indexti{ border-bottom:1px solid #DCDCDC; font-size:14px; text-align:center; line-height:32px;}
#addr_index_close{ float:right; margin-right:8px;}
.addr_index ul li{ padding:5px; border-bottom:1px solid #ccc;}
.showinfo{position:fixed; left:35%;bottom:180px;z-index:99999;border-radius:5px;background:#000;opacity:0.9;-moz-opacity:0.9;filter:alpha(opacity=90); padding:0 5px;width:auto;height:38px;box-shadow:0px 0px 10px #000;margin:-60px auto;color:#FFFFFF; text-align:center; line-height:38px;font-size:14px;display:none;}
.login{ color:#009900; text-align:center; display:none;}
.login2{ color:#009900; text-align:center; display:none;}
label *{
    pointer-events: none;
}
</style>




		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script language="JavaScript">
		wx.config({
			debug: false,
			appId: 'wxc3f8ad3fc6c24903',
			timestamp: "<?php echo ($jsapi['timestamp']); ?>",
			nonceStr: "<?php echo ($jsapi['timestamp']); ?>",
			signature: "<?php echo ($jsapi['signature']); ?>",
			jsApiList: [
			  'onMenuShareTimeline',
			  'onMenuShareAppMessage',
			]
		  });
		  
		  wx.ready(function () {
			 wx.onMenuShareTimeline({
				title: "我要和美容师“嘿嘿嘿”，快来投我一票，为爱助力！", // 分享标题
				link: "http://yooopay.com/index.php?m=vote&a=index&voteId=<?php echo ($voteId); ?>&shares=<?php echo ($userId); ?>", // 分享链接
				imgUrl: "http://yooopay.com/tpl/home/default/Style/index-images/activity/xin-5.png", // 分享图标
			});
			wx.onMenuShareAppMessage({
				title: "我要和美容师“嘿嘿嘿”，快来投我一票，为爱助力！", // 分享标题
				desc: "我在团洋范传递爱心，给我投一票吧", // 分享描述
				link: "http://yooopay.com/index.php?m=vote&a=index&voteId=<?php echo ($voteId); ?>&shares=<?php echo ($userId); ?>", // 分享链接
				imgUrl: "http://yooopay.com/tpl/home/default/Style/index-images/activity/xin-5.png", // 分享图标
				type: 'link', 
				dataUrl: '',
			});
		  });
		</script>
		<style type="text/css">
			*{
				font-family: "微软雅黑";
			}
			.topnav {
				z-index: 999;position: fixed;width: 100%;height: 49px;background: rgb(240,93,0);text-align: center;color: #fff;font-size: 18px;line-height: 49px;top: 0;
			}
			.topnav .back{
				position: absolute;left: 8px;top: 6px;margin-top: -8px;
			}
			.topnav img{
				position: absolute;top: 14px;left: 5px;
			}
			/*倒计时*/
			#guess-like {
            	height: 50px; line-height: 50px; font-size: 15px; text-align: center; position: relative; color: #555;
        	}
        	#guess-like .span-1,#guess-like .span-2 {
            	border-top: 1px solid rgb(190,190,190); width:23%; position: absolute; top: 25px;
        	}
        	#guess-like .span-1{
            	left: 0px;
        	}
        	#guess-like .span-2{
            	right: 0px;
        	}
			#clock{
				text-align: center; font-size: 20px; color: rgb(240,93,0);
			}
			.clock{
				border: solid 1px rgb(240,93,0); padding: 0px 4px 0px 4px; border-radius: 20%;
			}
			.day,.hour,.min,.sec{
				font-size: 13px; color: #555;  
			}
			/*报名*/
			#sign{
				border: solid 2px rgb(240,93,0); position: relative; left: 0px; margin: 10px; margin-top: 25px; border-radius: 4px; background-color: rgb(255,217,144);
			}
			#sign .s-title{
				text-align: center; font-size: 15px; color: rgb(240,93,0); font-weight: bold; margin-top: 8px;
			}
			#sign .s-input{
				width: 70%; height: 25px;border: solid 1px rgb(163,151,130); border-radius: 3px; background-color: rgb(237,224,205); color: rgb(85,85,85); margin-left: -35%; padding-left: 10px;
			}
			#sign .s-c-title{
				padding-left: 5%; margin-top: -7px; color: rgb(85,85,85); font-size: 13px;
			}
			#sign .s-btn{
				text-align: center; margin-top: -25px; margin-bottom: 15px;
			}
			#sign .s-btn button{
				width: 125px; height: 30px;background-color: rgb(240,93,0); color: rgb(237,224,205); border: solid 2px rgb(254,216,100); border-bottom: solid 4px rgb(254,216,100); border-radius: 7px; font-size: 13px;
			}
			.am-radio .am-icon-checked:before, .am-radio-inline .am-icon-checked:before{
			    content: "\f004"; color: red;
			}
			
			/*投票*/
			#vote{
				margin-top: 15px; padding: 10px;
			}
			#vote .dui{
				width: 50px;position: absolute; left: 50%; top: 26px; color: black;margin-left: -25px; color: white; font-size: 20px;
			}
			#vote .add-one{
				color: red; font-size: 22px; position: absolute; left: 68%; top:5px; display: none;
			}
			#vote .aixin-num{
				text-align: center; margin-top: 10px; color: red; font-size: 14px;
			}
			#vote button{
				width: 100px; height: 25px; background-color: rgb(241,93,53); border-radius: 4px; color: rgb(254,234,151); border: solid 1px rgb(223,178,24); margin-top: 22px;
			}
			/*活动规则*/
			#tips{
				width: 94%; padding: 5px; background-color: rgb(255,217,144); border: solid 1px rgb(195,183,164); border-radius: 3px; margin: 0 auto; color: rgb(85,85,85); margin-top: 25px;margin-bottom: 20px;
			}
			#tips .title{
				text-align: center; font-size: 14px; color: rgb(240,93,0); margin-top: 5px;
			}
			.am-divider-default{
			    border-top: 1px solid rgb(85,85,85);
			}
			/*验证消息弹出框*/
			.showinfo-t{
	        	position: fixed;left: 50%;bottom: 180px;z-index: 99999;border-radius: 5px;background: #000;opacity: 0.9;filter: alpha(opacity=90);
	        	padding: 0 5px;height: 38px;box-shadow: 0px 0px 10px #000;color: #FFFFFF;text-align: center;line-height: 38px;font-size: 14px;display: none;
	        }
		</style> 
		<link rel="stylesheet" type="text/css" href="../Style/css/swiper.min.css"/>
		<link rel="stylesheet" type="text/css" href="../Style/css/animate.min.css"/>
		<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
		<script src="../Style/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="../Style/js/swiper.animate.min.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body style="background-color: rgb(255,245,179);">
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">  
				<img src="../Style/images/fanhui1.png" width="25" />  
			</a>
			公益报名
		</div>
		<div style="margin-top: 70px;">
			<img src="../Style/index-images/activity/oneyear-title.png" alt="标题" class="am-img-responsive"/>
		</div>
		
		<div class="swiper-container" style="margin-top: 49px;">
			<div class="swiper-wrapper p1">
				<section class="swiper-slide">
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="1.7s"><img src="../Style/index-images/activity/xin-1.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="2.6s"><img src="../Style/index-images/activity/xin-2.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="3.0s"><img src="../Style/index-images/activity/xin-3.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="3.5s"><img src="../Style/index-images/activity/xin-4.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="3.9s"><img src="../Style/index-images/activity/xin-5.png" class="am-img-responsive"/></div>
				</section>   
			</div>
		</div>
		<!--活动倒计时时间-->
		<div>
			<p id="guess-like">
        		<span class="span-1"></span>
        			距离活动结束时间还剩
        		<span class="span-2"></span>
    		</p>
			<!--倒计时-->
			<p id="clock"></p>
		</div>
		
		<div class="am-g" style="text-align: center; margin-top: 30px; color: rgb(240,93,0); font-size: 14px;">
  			<div class="am-u-sm-4" style="border-right: solid 1px rgb(240,93,0);">
  				<p>已报名</p>
  				<p style="margin-top: 5px;"><?php echo ($people_nums); ?></p>
  			</div>
  			<div class="am-u-sm-4" style="border-right: solid 1px rgb(240,93,0);">
  				<p>投票数</p>
  				<p style="margin-top: 5px;"><?php echo ($vote_nums); ?></p>
  			</div>
  			<div class="am-u-sm-4">
  				<p>浏览量</p>
  				<p style="margin-top: 5px;"><?php echo ($pv); ?></p>
  			</div>
		</div>


		<!------------投票------------->
		<div id="vote">
			<div class="am-g" style="color: rgb(85,85,85);">
			  	<div class="am-u-sm-3">
			  		<p><img src="<?php echo ($cover); ?>" alt="" class="am-img-responsive am-circle" style="width: 60px;height:60px; margin: 0 auto;"/></p>
			  		<p style="text-align: center; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo ($username); ?></p>
			  	</div>
			  	<div class="am-u-sm-9">
			  		<p style="padding-left:10px;">我参加了团洋范举办的“和环卫工人一起过平安夜”公益活动，我在<?php echo ($team); ?>，快为我们队伍投个爱心吧！</p>
			  	</div>
			</div>
			<div class="aixin" style="margin-top: 20px;">
				<p style="text-align: center; position: relative; left: 0px; ">
					<img src="../Style/index-images/activity/aixin.png" alt="爱心" style="width: 95px;" class="pulse"/>
					<span class="dui"><?php echo ($team); ?></span>
					<span class="add-one">+1</span>
				</p>
				<p class="aixin-num">（已有&nbsp;<span id="ai-num" style="font-size: 16px;"><?php echo ($vote_num); ?></span>&nbsp;颗爱心）</p>
			</div>
			<div style="text-align: center;">
				<button class="toupiao" onclick="cl()">投TA一票</button></span>
				<button style="margin-left: 20px;" onclick="location.href='<?php echo U('Activity/signup');?>'">我也参加</button>
			</div>
		</div>
		
		<!---------活动规则---------->
		<div id="tips">
			<p class="title">活动说明</p >
			<p>1、<b>将本页面转发给好友或分享至朋友圈，可邀请朋友帮忙投票及报名参加活动。</b></p >
			<p>2、活动时间：2016年12月16日—12月24日</p >
			<p>3、活动地点：广州天河区天河CBD商圈</p >
			<p>4、团洋范经纪人、店长可免费参与1周年活动，新用户成为经纪人可获得参与资格</p >
			<p>5、活动奖励分发到个人，团队或个人报名，都需要参与人按照报名所需资料填写完整</p >
			<p>6、每人每天可以投出一票</p >
			<p>7、团洋范对本次活动保留最终解释权</p >
		</div>
		<div class="showinfo-t animated shake"></div>

	
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<script type="text/javascript">

			var url = "<?php echo U('vote/index',array('voteId'=>$voteId));?>";
			function cl(){
				$.post(url,function(data){
					layer.open({
						title: data.title,
						content: data.content,
						btn: [data.btn],
						yes: function(index){
							layer.close(index);
							if(data.code==1){
								$(".toupiao").one("click",function(){
									var num = parseInt($("#ai-num").html())+1;
									$(".add-one").addClass("bounce");
									$(".add-one").show().delay(650).fadeOut();
									$("#ai-num").text(num);
								});
							}
							location.reload();
						}
					});


				},'json');
			}


		
		</script>

		
		<!----单选按钮----->
		<script type="text/javascript">
			$(function(){
				$(".am-radio input").on("change",function(){
					$(this).parents("label").css({"color":"red"});
					$(this).parents("label").siblings().css({"color":"rgb(85,85,85)"});
				})
			})
		</script>
		<!--初始化图片动画-->
		<script>        
		  	var mySwiper = new Swiper ('.swiper-container', {
			  	onInit: function(swiper){ //Swiper2.x的初始化是onFirstInit
			    swiperAnimateCache(swiper); //隐藏动画元素 
			    swiperAnimate(swiper); //初始化完成开始动画
		  	}, 
			  onSlideChangeEnd: function(swiper){ 
			    swiperAnimate(swiper); //每个slide切换结束时也运行当前slide动画
			  } 
  		})        
  		</script>
		<!--倒计时-->
		<script type="text/javascript" src="../Style/js/jquery.countdown.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#clock').countdown('2016/12/24', function(event) {
				  $(this).html(event.strftime(
				  	'<span class="clock">%D</span><span class="day">&nbsp;&nbsp;天&nbsp;&nbsp;</span><span class="clock">%H</span> <span class="hour">&nbsp;&nbsp;时&nbsp;&nbsp;</span><span class="clock">%M</span><span class="min">&nbsp;&nbsp;分&nbsp;&nbsp;</span><span class="clock">%S</span> <span class="sec">&nbsp;&nbsp;秒</span>'));
				});
			});
		</script>
		<div data-am-widget="navbar" class="am-navbar am-cf am-navbar" id="" style="background-color:white; box-shadow:20px 20px 40px black;">
<ul class="am-navbar-nav am-cf am-avg-sm-5">
	  <li >
		<a href="<?php echo U('Index/index',array('shares'=>$info['id']));?>" class="">
			<img src="../Style/index-images/home.gif">
			<span class="am-navbar-label" style="color:rgb(137,137,137);">首页</span>
		</a>
	  </li>
	  <li>
		<a href="<?php echo U('Item/itemcate',array('shares'=>$info['id']));?>" class="">
			<img src="../Style/index-images/sort.gif" > 
			<span class="am-navbar-label" style="color:rgb(137,137,137);">分类</span>
		</a>
	  </li>
	  <li class="bottomhome">
		<a href='https://static.meiqia.com/dist/standalone.html?eid=23554&clientid=<?php echo ($server_u["id"]); ?>&metadata={"name":"<?php echo $server_u['username']; ?>","tel":"<?php echo $server_u['phone_mob']; ?>","email":"<?php echo $server_u['email']; ?>"}'>
			<img src="../Style/index-images/erweima.png">
			<span class="am-navbar-label" style="color:rgb(137,137,137);">客服</span>
		</a>
	  </li>
	  <li>
		<a href="<?php echo U('Shopcart/index',array('shares'=>$info['id']));?>">
		 <img src="../Style/index-images/shop-car.gif" > 
			<span class="am-navbar-label" style="color:rgb(137,137,137);">购物车</span>
		</a>
	  </li>
	  <li >
		<a href="<?php echo U('User/index',array('shares'=>$info['id']));?>" class="">
		 <img src="../Style/index-images/mine.gif" > 
			<span class="am-navbar-label" style="color:rgb(137,137,137);">我的</span>
		</a>
	  </li>
  </ul>
</div>
	</body>

</html>