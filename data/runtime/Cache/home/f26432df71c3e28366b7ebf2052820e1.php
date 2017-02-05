<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>店铺销售额</title>
	<style>
		* {
			font-family: "微软雅黑"; text-decoration: none;
		}
		.topnav {
				width: 100%; height: 49px; line-height: 49px; color: white; font-size: 18px; text-align: center; position: fixed; top: 0; z-index: 1001; background-color: rgb(181, 43, 66);
		}
		.topnav img{
			position: absolute; left:5px; top: 14px;
		}
		/*查找订单状态S*/
		#search_order{
			height: 50px;
		}
		#search_order .left {
			width: 90px; height: 50px; line-height: 56px; padding-left: 2%;
		}
		#search_order .right {
			height: 50px; line-height: 50px; width: 70%; margin-right: 0; text-align: right;
		}
		#search_order .right .text {
			height: 28px; padding-left: 28px; padding-right: 20px; outline: none;
		}
		#search_order .right img {
			position: absolute; top: 18px; left: 29px; height: 20px;
		}
		/*查找订单状态E*/
		
		
		#header{
			margin-top: 49px; background-color: rgb(251,208,157); height: 135px;
		}
		#header img{
			height: 75px; width: 65px; margin: 0 auto; margin-top: 30px;
		}
		#header .xiaoshou,#header .lirun{
			font-size: 14px; color: rgb(85,85,85); margin-top: 50px;
		}
		#header .xiaoshou-price,#header .lirun-price{
			font-size: 16px; color: rgb(240,93,0);
		}
		
		#prod ul li{
			margin-top: 10px; background-color: white; padding: 0px 10px 0px 10px;
		}
		#prod .fir{
			border-bottom: solid 1px rgb(244,244,244); padding-top:5px; padding-bottom: 5px; color: rgb(85,85,85);
		}
		#prod .sec{
			padding-top:5px; padding-bottom: 5px;border-bottom: solid 1px rgb(244,244,244);
		}
		#prod .thi{
			margin-top: 5px; padding-bottom: 5px;
		}
		#prod .fir .lirun{
			color: rgb(240,93,0); font-size: 13px;
		}
		#prod .sec .title{
			padding: 10px 5px 0px 5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 13px; color: rgb(85,85,85); 
		}
		#prod .sec .price{
			padding: 5px 5px 0px 5px; color: rgb(174,174,174);
		}
		#prod .sec .price-num{
			color: rgb(240,93,0); font-size: 13px;
		}
		#prod .thi .weixin-user{
			color: rgb(85,85,85); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
		}
		#prod .thi .time{
			text-align: right; color: rgb(174,174,174);
		}
		/*为空的时候*/
		#null{
			text-align: center; margin-top: 80px;
		}
		#null img{
			width: 90px; height: 90px;
		}
		#null p{
			color: #555; margin-top: 5px;
		}
	</style>
</head>
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




<meta name="viewport" content="width=device-width;minimum-scale=1.0; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<script src="../Style/js/shop.js" type="text/javascript"></script>
<link href="../Style/css2/css.css" rel="stylesheet" type="text/css" />
<!-- <link href="../Style/css.css" rel="stylesheet" type="text/css" /> -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<link href="./Tpl/home/default/public/style.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
<!-- <link href="../Style/style.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript">
wx.config({
    debug: false,
    appId: 'wx6a9244fbd61b964f',
    timestamp: '<?php echo ($jsapi['timestamp']); ?>',
    nonceStr: '<?php echo ($jsapi['timestamp']); ?>',
    signature: '<?php echo ($jsapi['signature']); ?>',
    jsApiList: [
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
    ]
  });
  
  wx.ready(function () {
     wx.onMenuShareTimeline({
        title: "<?php echo ($fx_ad['url']); ?>", // 分享标题
        link: '<?php echo ($jsapi['url']); ?>', // 分享链接
        imgUrl: "http://"+window.location.host+"/data/upload/advert/<?php echo ($fx_ad['content']); ?>", // 分享图标
    });
    wx.onMenuShareAppMessage({
        title: "<?php echo ($fx_ad['url']); ?>", // 分享标题
        desc: "<?php echo ($jsapi['url']); ?>", // 分享描述
        link: '<?php echo ($jsapi['url']); ?>', // 分享链接
		imgUrl: "http://"+window.location.host+"/data/upload/advert/<?php echo ($fx_ad['content']); ?>", // 分享图标
        type: 'link', 
        dataUrl: '',
    });
  });
</script>
<!-- <style type="text/css">
	.topnav{ position:fixed;width:100%;height:49px;z-index:9999; background:#C54056; text-align:center; color:#fff; font-size:16px; line-height:49px; top:0;}
	.topnav .back{ position:absolute; left:8px;top:6px;}
</style> -->

<body>
	<!-- 头部 -->
	<div class="topnav">
		<a href="" onClick="window.history.back(-1);" class="back">
			<img src="../Style/images/fanhui1.png" width="25" />  
		</a>
		店铺销售额
	</div>
	
	<?php if(!empty($order_list)): ?><div id="header">
		<div class="am-g" style="text-align: center;">
  			<div class="am-u-sm-4">
  				<p class="xiaoshou">销售总额</p>
  				<p class="xiaoshou-price">￥<?php echo ($order_sumPrice); ?>元</p>
  			</div>
  			<div class="am-u-sm-4">
  				<img src="../Style/index-images/xiaoshou.jpg" alt="销售额" class="am-img-responsive"/>
  			</div>
  			<div class="am-u-sm-4">
  				<p class="lirun">利润总额</p>
  				<p class="lirun-price">￥<?php echo ($profit_sum); ?>元</p>
  			</div>
		</div>
	</div>
	
	
	<!--列表-->
	<div id="prod">
		<ul>
			<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li onclick="window.location.href='<?php echo U('User/fcorder_check',array('orderid'=>$val['orderId'],'self'=>1,'profit'=>$val['profit'],'oid'=>$val['id']));?>'">
					<div class="am-g fir">
						<div class="am-u-sm-8">
							订单号：<?php echo ($val["orderId"]); ?>
						</div>
						<div class="am-u-sm-4" >
							<p style="text-align: right;">利润：<span class="lirun">￥<?php echo ($val["profit"]); ?>元</span></p>
						</div>
					</div>
					<div class="am-g sec">
						<div class="am-u-sm-3">
							<img src="http://yooopay.com/data/upload/item/<?php echo get_thumb($val['img'], '_b');?>" alt="商品" />
						</div>
						<div class="am-u-sm-8">
							<p class="title"><?php echo ($val["title"]); ?></p>
							<p class="price">优品价：<span class="price-num">￥<?php echo ($val["price"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;x<?php echo ($val["quantity"]); ?></p>
						</div>
						<div class="am-u-sm-1" style="text-align: right;">
							<img src="./Tpl/home/default/Style/index-images/jt03.png" style="width: 20px;margin-top: 37px;">
						</div>
					</div>
					<div class="am-g thi">
						<div class="am-u-sm-7">
							<p class="weixin-user">下单用户：<?php echo ($val["uname"]); ?></p>
						</div>
						<div class="am-u-sm-5" style="color: rgb(174,174,174);">
							<p class="time"><?php echo (date('Y年n月j日 H:i:s',$val["add_time"])); ?></p>
						</div>
					</div>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
		<?php else: ?>
			<div id="null">
				<img src="../Style/index-images/none-xiao.png" alt="没有相关的订单"/>
				<p>您还没有相关的订单，请继续努努力 :)</p>
			</div><?php endif; ?>
	
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
	<!--引入layer-->
	<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	<script>
		$('#search_btn').click(function() {
			var keyword = $('input[name=keyword]');
			var shopid = $('input[name=shopid]');
			if(keyword.val() == '') {
				layer.open({
						title: '提示',   
						content: '你还是输点什么再点我吧~',
						btn: ['我知道了'],
						yes: function(index){
							//location.reload();
							layer.close(index);
						}
					});
			} 
			else {
				window.location.href = "index.php?m=User&a=order_list&keyword=" + keyword.val() + "&shopid=" + shopid.val();
			}
		});
	</script>
</body>

</html>