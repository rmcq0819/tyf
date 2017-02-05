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
			wx.ready(function() {
				wx.onMenuShareTimeline({
					title: "<?php echo ($fx_info['username']); ?>邀请您加入团洋范！", // 分享标题
					link: "<?php echo ($jsapi['url']); ?>", // 分享链接
					imgUrl: "<?php echo ($fximg); ?>", // 分享图标
				});
				wx.onMenuShareAppMessage({
					title: "<?php echo ($fx_info['username']); ?>邀请您加入团洋范！", // 分享标题
					desc: "<?php echo ($fx_info['m_desc']); ?>", // 分享描述
					link: "<?php echo ($jsapi['url']); ?>", // 分享链接
					imgUrl: "<?php echo ($fximg); ?>", // 分享图标
					type: 'link',
					dataUrl: '',
				});
			});
		</script>
		<style>
			/*头部*/
			* {
				font-family: "微软雅黑";
			}
			.topnav {
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;z-index: 999;background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; left:5px; top: 14px;
			}			
			
			/*头部*/
			#header{
				margin-top: 49px; position: relative; left: 0px;
			}
			#shouyi{
				margin-top: 15px; padding: 0px 20px 0px 20px;
			}
			#shouyi .f-title{
				font-size: 23px; color: rgb(240,93,0); font-weight: bold; margin-top: 25px;
			}
			#shouyi .s-title{
				color: rgb(84,84,84); font-size: 15px; margin-top: 25px;
			}
			#shouyi .s-title img{
				width: 24px; height: 26px;
			}
			
			#daogou,#dianzhang{
				width: 100%; height: 40px; background-color: rgb(240,93,0); color: white; font-size: 22px; text-align: center; line-height: 40px;
			}
			
			#ewai{
				margin-top: 40px; padding: 0px 20px 0px 20px;
			}
			#ewai .e-title{
				font-size: 20px; color: rgb(240,93,0); font-weight: bold;
			}
			#ewai .ss-title{
				color: rgb(84,84,84); font-size: 15px; margin-top: 10px;
			}
			
			#ru{
				margin-top: 40px; padding: 0px 20px 0px 20px;
			}
			#ru .r-title{
				font-size: 24px; color: rgb(240,93,0); font-weight: bold; 
			}
			
			#zhuang{
				margin-top: 40px; padding: 0px 20px 0px 20px;
			}
			#zhuang .z-title{
				font-size: 24px; color: rgb(240,93,0); font-weight: bold; line-height: 30px;
			}
			
			#open-btn,#share{
				width: 180px; margin: 0 auto; margin-top: 15px; 
			}
			
			#right-fixed{
				position: fixed; right: 0px; top: 50%; background-color: rgb(240,93,0); padding: 5px; opacity: 0.55; border-bottom-left-radius: 5px; border-top-left-radius: 5px;
			}
			#right-fixed .dao{
				border-bottom: solid 1px white; padding-bottom: 6px;
			}
			#right-fixed .dian{
				margin-top: 5px;
			}
		</style>
		<link rel="stylesheet" href="../Style/css/animations.css" />
	</head>
	<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	<body style="background:rgb(240,240,240);">
		<div class="topnav">
			<a onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			我要开店
		</div>
		
		<!--头部-->
		<div id="header">
			<img src="../Style/index-images/activity/kai-bg2.png" alt="头部" class="am-img-responsive" />
		</div>
		
		<!--财务手册-->
		<img id="header-img" src="../Style/index-images/activity/caifu.jpg" alt="" class="am-img-responsive" style="margin-top: 15px;"/>
		
		<div id="a" style="height: 51px; opacity: 0;">我要做经纪人</div>
		<!--我要做经纪人-->
		<div id="daogou">
			我要做经纪人
		</div>
		<!--店长收益构成-->
		<div id="shouyi">
			<p class="f-title">成为经纪人的收益构成</p>
			<p class="s-title"><img src="../Style/index-images/activity/jiangjin.png" alt="销售奖金"/>&nbsp;&nbsp;获得自营店铺商品销售奖金</p>
			<img src="../Style/index-images/activity/kai-line2.png" alt="线" class="am-img-responsive" style="margin-top: 10px;"/>
		</div>

		<!--入店标准说明-->
		<div id="ru">
			<p class="r-title">入驻开店的标准说明</p>
			<img src="../Style/index-images/activity/99jingjiren.png" alt="99元开店" class="am-img-responsive" style="margin-top: 30px;"/>
			<div class="am-g" style="margin-top: 20px;">
  				<div class="am-u-sm-2">
  					<img src="../Style/index-images/activity/lingshou.png" alt="零售收益" class="am-img-responsive" style="max-width: 45px;"/>
  				</div>
  				<div class="am-u-sm-10">
  					<p style="color: rgb(240,93,0); font-size: 15px; font-weight: bold; padding-left: 6px;">零售收益</p>
  					<p style="color: rgb(84,84,84); font-size: 13px; padding-left: 6px;">售出的每一件产品都有产品利润20%提成</p>
  				</div>
			</div>
			<img src="../Style/index-images/activity/kai-line2.png" alt="线" class="am-img-responsive" style="margin-top: 20px;"/>
		</div>
		
		<!--专业客服及售后-->
		<div id="zhuang">
			<p class="z-title">专业化的客服/售后及物流服务</p>
			<div class="am-g" style="margin-top: 20px;">
  				<div class="am-u-sm-2">
  					<img src="../Style/index-images/activity/kefu.png" alt="客服" class="am-img-responsive" style="max-width: 45px;"/>
  				</div>
  				<div class="am-u-sm-10">
  					<p style="color: rgb(84,84,84); font-size: 12px; padding-left: 6px;">专业客服团队，一对一的销售及咨询服务</p>
  					<p style="color: rgb(84,84,84); font-size: 12px; padding-left: 6px;">30天无理由退货售后保证</p>
  				</div>
			</div>
			<div class="am-g" style="margin-top: 30px;">
  				<div class="am-u-sm-2">
  					<img src="../Style/index-images/activity/wuliu.png" alt="零售收益" class="am-img-responsive" style="max-width: 45px;"/>
  				</div>
  				<div class="am-u-sm-10">
  					<p style="color: rgb(84,84,84); font-size: 13px; padding-left: 6px;">全国四大保税仓+海外直邮</p>
  					<p style="color: rgb(84,84,84); font-size: 13px;padding-left: 6px;">满99元免费全国快递配送</p>
  				</div>
			</div>
			<img src="../Style/index-images/activity/fenzhi.png" alt="" class="am-img-responsive" style="margin-top: 10px;"/>	
		</div>
		
		<!--我要做经纪人按钮-->
		
		<div style="width: 180px;position: relative; left: 0px; margin: 0 auto;">
			<img id="shares" src="../Style/index-images/activity/jingjiren.png" alt="我要成为经纪人" class="am-img-responsive"/>
			<img src="../Style/index-images/activity/shou.png" alt="手" style="width: 50px;position: absolute; right: -27px; top: 14px;" />
		</div>
		
		<div id="b" style="height: 51px; opacity: 0;">我要成为店长</div>
		<!--我要做店长-->
		<div id="dianzhang">
			我要做店长
		</div>
		<!--店长收益构成-->
		<div id="shouyi">
			<p class="f-title">成为店长的收益构成</p>
			<p class="s-title"><img src="../Style/index-images/activity/jiangjin.png" alt="销售奖金"/>&nbsp;&nbsp;获得自营店铺商品销售奖金</p>
			<p class="s-title"><img src="../Style/index-images/activity/xunzhang.png" alt="销售奖金"/>&nbsp;&nbsp;获得推广加盟的培训奖金</p>
			<p class="s-title"><img src="../Style/index-images/activity/lipin.png" alt="销售奖金"/>&nbsp;&nbsp;获得新加入店长创业礼品</p>
			<img src="../Style/index-images/activity/kai-line.png" alt="线" class="am-img-responsive" style="margin-top: 15px;"/>
		</div>
		
		<!--额外奖励-->
		<!--
		<div id="ewai">
			<p class="e-title">额外奖励</p>
			<p class="ss-title">所有新加入的店长，一周内可获得以下奖励：</p>
			<p class="ss-title">直接开分店3家，奖励现金300元；</p>
			<p class="ss-title">直接开分店6家，奖励现金588元；</p>
			<p class="ss-title">直接开分店10家，奖励现金888元！</p>
			<p style="color: red; font-size: 15px; margin-top: 7px;">备注：从加入的即刻起计时，系统直接统计</p>
			<img src="../Style/index-images/activity/kai-line2.png" alt="线" class="am-img-responsive" style="margin-top: 30px;"/>
		</div>
		-->
		<!--入店标准说明-->
		<div id="ru">
			<p class="r-title">入驻开店的标准说明</p>
			<img src="../Style/index-images/activity/588.png" alt="588元开店" class="am-img-responsive" style="margin-top: 30px;"/>
			<div class="am-g" style="margin-top: 20px;">
  				<div class="am-u-sm-2">
  					<img src="../Style/index-images/activity/lingshou.png" alt="零售收益" class="am-img-responsive" style="max-width: 45px;"/>
  				</div>
  				<div class="am-u-sm-10">
  					<p style="color: rgb(240,93,0); font-size: 15px; font-weight: bold; padding-left: 6px;">零售收益</p>
  					<p style="color: rgb(84,84,84); font-size: 13px; padding-left: 6px;">售出的每一件产品都有产品利润60%提成</p>
  				</div>
			</div>
			<div class="am-g" style="margin-top: 25px;">
  				<div class="am-u-sm-2">
  					<img src="../Style/index-images/activity/tuiguang.png" alt="推广加盟" class="am-img-responsive" style="max-width: 45px;"/>
  				</div>
  				<div class="am-u-sm-10">
  					<p style="color: rgb(240,93,0); font-size: 15px;font-weight: bold; padding-left: 6px;">推广加盟</p>
  					<p style="color: rgb(84,84,84); font-size: 13px; padding-left: 6px;">推荐一位新的店长加入，都有200元/人的培训管理提成</p>
  				</div>
			</div>
			<p style="text-align: center;color: rgb(84,84,84); font-size: 13px; margin-top: 20px;">直推经纪人零售利润40%提成</p>
			<img src="../Style/index-images/activity/kai-line2.png" alt="线" class="am-img-responsive" style="margin-top: 30px;"/>
		</div>
		
		<!--专业客服及售后-->
		<div id="zhuang">
			<p class="z-title">专业化的客服/售后及物流服务</p>
			<div class="am-g" style="margin-top: 20px;">
  				<div class="am-u-sm-2">
  					<img src="../Style/index-images/activity/kefu.png" alt="客服" class="am-img-responsive" style="max-width: 45px;"/>
  				</div>
  				<div class="am-u-sm-10">
  					<p style="color: rgb(84,84,84); font-size: 12px; padding-left: 6px;">专业客服团队，一对一的销售及咨询服务</p>
  					<p style="color: rgb(84,84,84); font-size: 12px; padding-left: 6px;">30天无理由退货售后保证</p>
  				</div>
			</div>
			<div class="am-g" style="margin-top: 30px;">
  				<div class="am-u-sm-2">
  					<img src="../Style/index-images/activity/wuliu.png" alt="零售收益" class="am-img-responsive" style="max-width: 45px;"/>
  				</div>
  				<div class="am-u-sm-10">
  					<p style="color: rgb(84,84,84); font-size: 13px; padding-left: 6px;">全国四大保税仓+海外直邮</p>
  					<p style="color: rgb(84,84,84); font-size: 13px;padding-left: 6px;">满99元免费全国快递配送</p>
  				</div>
			</div>
			<img src="../Style/index-images/activity/fenzhi.png" alt="" class="am-img-responsive" style="margin-top: 10px;"/>
			
		</div>
		
		<!--我要做店长按钮-->
		<div style="width: 180px;position: relative; left: 0px; margin: 0 auto; margin-bottom: 40px;">
			<img id="sharess" src="../Style/index-images/activity/dianzhang.png" alt="我要做店长" class="am-img-responsive"/>
			<img src="../Style/index-images/activity/shou.png" alt="手" style="width: 50px;position: absolute; right: -27px; top: 14px;" />
		</div>
		
		<!--右侧固定栏目-->
		<i class="am-icon-send-o am-icon-sm floating" style="position: fixed; right: 21px; top: 46.2%; color: rgb(240,159,108);"></i>
		<div id="right-fixed">
			<p class="dao"><a href="#a" style="color: white;">成为经纪人&nbsp;<i class="am-icon-angle-right"></i></a></p>
			<p class="dian"><a href="#b" style="color: white; margin-left: 7px;">成为店长&nbsp;<i class="am-icon-angle-right"></i></a></p>
		</div>
		<!--分享遮罩页面-->
		<div id="mcover" onclick="document.getElementById('mcover').style.display='';" style="display:none;">
			<img src="../Style/images/guide.png" />
		</div>
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
		<script type="text/javascript">


			$(function(){
				var width = $("#img-phone").width();
				var w = width/2;
				$("#img-phone").css("margin-left",-w);

				//经纪人
				$("#shares").on("click",function(){
					send('shares');
				});


				//店长
				$("#sharess").on("click",function(){
					send('sharess');
				});


			});
			var url = "<?php echo U('User/open_shop');?>";
			function send($part){
				$.post(url,{'application':$part},function(data){
					console.log(data);
					if(data.code==0){
						layer.open({
							title: data.title,
							content: data.content,
							btn: [data.btn],
							yes: function(index){
								layer.close(index);
							}
						});
						if(data.share==1){
							$("#mcover").show();
						}
					}else{
						window.location.href = data.url;
					}
				},'json');
			}
		</script>
		<!--页面锚点平滑滚动的效果-->
		<script type="text/JavaScript">
			$(document).ready(function() {
			    $('a[href*=#]').click(function() {
			        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			            var $target = $(this.hash);
			            $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
			            if ($target.length) {
			                var targetOffset = $target.offset().top;
			                $('html,body').animate({
			                    scrollTop: targetOffset
			                },
			                300);
			                return false;
			            }
			        }
			    });
			});
		</script>
	</body>
</html>