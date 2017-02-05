<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
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




		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
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
				title: "活动期间最高满500减200 - 团洋范", // 分享标题
				link: "<?php echo ($jsapi['url']); ?>", // 分享链接
				imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/activity/s-header.png", // 分享图标
			});
			wx.onMenuShareAppMessage({
				title: "活动期间最高满500减200 - 团洋范", // 分享标题
				desc: "大牌齐祝贺，团洋范1周年", // 分享描述
				link: "<?php echo ($jsapi['url']); ?>", // 分享链接
				imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/activity/s-header.png", // 分享图标
				type: 'link', 
				dataUrl: '',
			});
		  });
		</script>
		<style>
			*{
				font-family: "微软雅黑";
			}
			/*头部*/
			.topnav{
				width: 100%;height: 49px;line-height: 49px;color: white;font-size: 18px;text-align: center;background-color: rgb(240,93,0);
			}
			/*头部E*/
			#main{
				background-color: rgb(1,74,143); padding: 6px 6px 6px 6px;
			}
			#main ul li{
				position: relative; left: 0px;
			}
			#main .fir .cap{
				width: 20px; height: 28px;position: absolute;left: -5px; top: -11px;
			}
			#main .sec .cap{
				width: 25px; height: 33px;position: absolute;left: -5px; top: -11px;
			}
			#main .thi .cap{
				width: 20px; height: 28px;position: absolute;left: -5px; top: -11px;
			}
			
			#footer{
				margin-top: 10px; margin-bottom: -5px;
			}
		</style>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	</head>

	<body style="background-color: rgb(1,74,143);">
		
		<!--头部-->
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" style="position: absolute; top: 12px; left: 5px;"/>
			</a>
			团洋范一周年庆典
		</div>
		
		<div id="header">
			<img src="../Style/index-images/activity/s-header.png" alt="头部" class="am-img-responsive"/>
			<img src="../Style/index-images/activity/sjie.png" alt="结" class="am-img-responsive" style="margin-top: -3px;"/>
		</div>
		
		<div id="main">
			<ul class="am-avg-sm-3 am-thumbnails fir">
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>1));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-1.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>10));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-2.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>2));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-3.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			</ul>
			
			
			
			<ul class="am-avg-sm-2 am-thumbnails sec" style="margin-top: 15px;">
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>9));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-4.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>8));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-5.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>7));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-6.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>4));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-7.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			</ul>
			
			
			<ul class="am-avg-sm-3 am-thumbnails thi" style="margin-top: 15px;">
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>5));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-8.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>3));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-9.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			  <li onclick="location.href='<?php echo U('Activity/brand_list',array('brandId'=>6));?>'">
			  	<img class="am-thumbnail" src="../Style/index-images/activity/yi-10.png" />
			  	<img src="../Style/index-images/activity/s-cap.png" alt="帽子" class="am-img-responsive cap"/>
			  </li>
			</ul>
		</div>
		
		<div id="footer">
			<img src="../Style/index-images/activity/s-footer.png" alt="尾部" class="am-img-responsive"/>
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
		<!--雪花-->
		<script src="../Style/js/snowfall.jquery.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function(){
				$(document).snowfall({
					round : true, 
					flakeCount : 50,
					flakeColor : 'white',
					minSize: 3, 
					maxSize:6,
					collection:false,
					intTime:60,
				}); 
			});
		</script>
	</body>

</html>