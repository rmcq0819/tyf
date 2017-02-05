<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<title>公益红包</title>
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
			
			#header{
				margin-top: 49px;
			}
			#main{
				background-color: rgb(252,74,74); position: relative; left: 0px;
			}
			#main .line{
				width: 95%;height: 5px;background-color: black; margin: 0 auto; border-radius: 10px; opacity: 0.6;
			}
			#main .content{
				width: 90%;background-color: rgb(255,217,144); margin: 0 auto; overflow-y: scroll; min-height: 110px; max-height: 400px;
			}
			#main .content .am-g{
				background-color: white;
			}
			#main .content ul{
				padding: 8px;
			}
			#main .content li{
				margin-top: 8px;
			}
			#main .content li:first-child{
				margin-top: 0px;
			}
			/*按钮*/
			.btn1,.btn2{
				margin: 0 auto; text-align: center;
			}
			.btn1 button{
				width: 200px;  height: 40px;background-color: rgb(255,217,144); color: rgb(85,85,85); border: none; border-radius: 3px; font-size: 15px; margin-top: 25px;
			}
			.btn2 button{
				width: 200px; height: 40px;background-color: rgb(255,217,144); color: rgb(85,85,85); border: none; border-radius: 3px;font-size: 15px; margin-top: 15px; margin-bottom: 20px;
			}
		</style>
	</head>

	<body>
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back"> 
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			公益红包
		</div>
		<div id="header">
			<img src="../Style/index-images/activity/huanwei-header.png" alt="头部" class="am-img-responsive" />	
			<img src="../Style/index-images/activity/huanwei-header2.png" alt="头部" class="am-img-responsive" />
		</div>
		<div id="main">
			<p class="line"></p>
			<div class="content">
				<ul>
					<li>
						<div class="am-g">
  							<div class="am-u-sm-4">
  								<img src="../Style/index-images/activity/fan-main.png" alt="" class="am-img-responsive" style="width: 100px; height: 92px;"/>
  							</div>
  							<div class="am-u-sm-8">
  								<p style="text-align: center; margin-top: 10px;">团洋范购物平台专用范票</p>
  								<p style="text-align: center; margin-top: 10px;"><img src="../Style/index-images/activity/fanpiao-fan.png" alt="" style="width: 35px;"/>&nbsp;&nbsp;<span style="color: rgb(240,93,0); font-size: 15px;">x<?php echo ($points); ?></span></p>
  							</div>
						</div>
					</li>
					<?php if(is_array($coupon)): $i = 0; $__LIST__ = $coupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li>
						<div class="am-g">
  							<div class="am-u-sm-4" style="position: relative; left: 0px; color: white;">
  								<img src="../Style/index-images/lan.png" alt="" class="am-img-responsive" style="width: 100px; height: 92px;"/>
  								<p style="position: absolute; left: 5px; top: 5px;">优惠券</p>
  								<p style="position: absolute; left: 17px; top: 40px; font-size: 17px; border-bottom: solid 1px white; padding:0px 5px 5px 5px">￥<span style="font-size: 26px;"><?php echo ($vol["disPrice"]); ?></span></p>
  							</div>
							
  							<div class="am-u-sm-8">
  								<p style="text-align: center;">活动奖励优惠券</p>
  								<p style="text-align: center;"><img src="../Style/index-images/line-1.png" alt="" style="width: 100px;"/></p>
  								<p style="text-align: center;">满<?php echo ($vol["condition"]); ?>元可用</p>
  								<p style="text-align: right; margin-right: 5px; border-top: dashed 1px rgb(155,155,155);"><?php echo (date("Y.m.d",$vol["stime"])); ?>~<?php echo (date("Y.m.d",$vol["etime"])); ?></p>
  							</div>
							
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				
			</div>
			<img src="../Style/index-images/activity/a-line.png" alt="线" class="am-img-responsive" style="width: 90%; margin: 0 auto;"/>
			<p style="width:90%;color: white; text-align: center; font-size: 15px; margin-top: 10px; margin-left: 5%;">恭喜获得团洋范分享的“爱心传递”红包，已存入“我的-会员中心”中</p>
			<p class="btn1"><button onclick="location.href='<?php echo U('Index/index',array('shares'=>$shares));?>'">去商场购物</button></p>
			<p class="btn2"><button onclick="location.href='<?php echo U('vote/index',array('voteId'=>$info['id'],'shares'=>$info['id']));?>'">去分享拉票</button></p>
		</div>

		<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
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
  <img id="tixing" src="../Style/index-images/activity/99tixing.png" alt="满99" style="width:110px; position:fixed; right:18%; bottom:49px; z-index:800; display: none;"/>
</div>
<script type="text/javascript">
	$(function(){
		$("#tixing").show();
		$("#tixing").addClass("slideExpandUp");
		$("#tixing").delay(4500).fadeOut();
	})
</script>
  
	</body>

</html>