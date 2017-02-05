<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<title>App下载 - 团洋范</title>
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
			  
			  wx.ready(function () {
				 wx.onMenuShareTimeline({
					title: "App下载 - 团洋范", // 分享标题
					link: "<?php echo ($jsapi['url']); ?>", // 分享链接
					imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/appshare_bg.png", // 分享图标
				});
				wx.onMenuShareAppMessage({
					title: "App下载 - 团洋范", // 分享标题
					desc: "随时随地，畅游海外商场 - 团洋范", // 分享描述
					link: "<?php echo ($jsapi['url']); ?>", // 分享链接
					imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/appshare_bg.png", // 分享图标
					type: 'link', 
					dataUrl: '',
				});
			  });
		</script>
		<style type="text/css">
			body{
				background-color: rgb(253,96,50);
			}
			#btn-down{
				background-color: rgb(253,96,50); text-align: center;
			}
			#btn-down .android{
				width: 195px; height: 40px;background-color: rgb(253,96,50); color: white; border: solid 1px white; outline: none; border-radius: 8px; margin-top: 30px; font-size: 13px;
			}
			#btn-down .ios{
				width: 195px; height: 40px;background-color: white; color: rgb(253,96,50); border: solid 1px white; outline: none; border-radius: 8px; margin-top: 20px; font-size: 13px;
			}
			#fix-img{
				margin-top: 30px; position: fixed; left: 0px; top:66.5%;
			}
			#rotate-img{
				width: 90%; margin: 0 auto; animation: myfirst 20s linear infinite; -webkit-animation: myfirst 20s linear infinite; -moz-animation: myfirst 20s linear infinite; -o-animation: myfirst 20s linear infinite;
			}
			/*旋转动画*/
			@-webkit-keyframes myfirst{
				0%{
					transform: rotate(0deg);
					-webkit-transform: rotate(0deg);
					-moz-transform: rotate(0deg);
					-o-transform: rotate(0deg);
				}
				100%{
					transform: rotate(360deg);
					-webkit-transform: rotate(360deg);
					-moz-transform: rotate(360deg);
					-o-transform: rotate(360deg);
				}
			}
		</style>
	</head>
	<body>
		<!--分享遮罩页面-->
			<div id="mcover" onclick="document.getElementById('mcover').style.display='';" style="display:none;">
				<img src="../Style/images/gui.png" />
			</div>
		<img src="../Style/index-images/app-header.png" alt="头部" class="am-img-responsive" />
		<div id="btn-down">
			<?php  if(!strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ){ ?>
				<button class="android" onclick="window.location.href='http://api.yooopay.com/version/app-release.apk'"><i class="am-icon-android am-icon-md"></i>&nbsp;&nbsp;Android版下载</button>
			<?php
 }else{ ?>
				<button class="android" id="share"><i class="am-icon-android am-icon-md"></i>&nbsp;&nbsp;Android版下载</button>
			<?php
 } ?>
			<br />
			<button class="ios" onclick="window.location.href='https://itunes.apple.com/cn/app/tuan-yang-fan/id1173198472?mt=8'"><i class="am-icon-apple am-icon-md"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iOS版下载</button>
		</div>
		<div id="fix-img">
			<img src="../Style/index-images/app-down.png" alt="旋转图片" class="am-img-responsive" id="rotate-img" />
		</div>
		<!--点击分享按钮弹出分享遮罩-->
		<script type="text/javascript">
			$(function(){
				$("#share").on("click",function(){
					$("#mcover").show();
					return false;
				});
			});
		</script>
	</body>

</html>