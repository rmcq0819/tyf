<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php if($user_level["uid"] == 4): ?>我的订单
			<?php else: ?>店铺订单<?php endif; ?>
	</title>
	<style>
		* {
			font-family: "微软雅黑";text-decoration: none;
		}
		/*头部订单状态S*/
		.size_radioToggle {
			background-color: rgb(229, 229, 229);border-radius: 5px;color: black;
		}
		.first{
			padding: 5px 23.5% 5px 23.5%;
		}
		.second{
			padding: 5px 18% 5px 18%;
		}
		.third{
			padding: 5px 29.5% 5px 29.5%;
		}
		.four{
			padding: 5px 23.5% 5px 23.5%;
		}
		#menu a {
			text-decoration: none;
		}
		#menu .toggle{
			font-size: 17px; color: white; text-decoration: none;width: 50%; text-align: center; margin: 0 auto;
		}
		.current {
			color: rgb(240, 93, 0);border: solid 1px rgb(240, 93, 0);background-color: white;border-radius: 7px;
			/*transition: all 0.7s;*/
		}
		/*头部订单状态E*/
		
		/*查找订单状态S*/
		#search_order{
			height: 50px;margin-top:46px;
		}
		#search_order .left {
			width: 90px;height: 50px;line-height: 50px;padding-left: 2%;
		}
		
		#search_order .right {
			height: 50px;line-height: 50px;width: 70%;margin-right: 0;text-align: right;
		}
		
		#search_order .right .text {
			height: 28px;padding-left: 28px;padding-right: 20px;outline: none;
		}
		
		#search_order .right img {
			position: absolute;top: 18px;left: 30px;height: 20px;
		}
		/*查找订单状态E*/
		
		.dingdangti dd {
			font-size: 12px;color: #e14f11;line-height: 24px;padding-right: 3%;
		}
		.dingdangprojia b {
			text-align: left;width: 29%;display: inline-block;padding-left: 2%;
		}
		
		.dingdandizhiright img {
			margin-top: 15px;
		}
		.dingdangprojia span {
			font-size: 14px;
		}
		
		.left span {
			font-size: 14px;color: #555;
		}
		
		.dingdangwuimg img {
			width: 120px;height: 120px;
		}
		/*按钮*/
		#btn{
			border-top: solid 1px rgb(223,223,223); text-align: right; padding: 6px;
		}
		#btn span{
			padding: 3px 7px 3px 7px; margin-top: 3px; border-radius: 3px;
		}
		#btn span:first-child{           /*评价按钮*/
			border: solid 1px rgb(240,93,0); color: rgb(240,93,0); margin-right:5px;
		}
		#btn span:last-child{
			border: solid 1px rgb(16,96,147); color: rgb(16,96,147);
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
	<header data-am-widget="header" class="am-header am-header-default" style="height:49px;position:fixed;top:0;z-index:999;">
		<div class="am-header-left am-header-nav"  onClick="window.location.href='<?php echo U('User/index',array('shares'=>$info['id']));?>'">
			<a>
				<img style="width: 8px; position:absolute; left:5px; top:14px; z-index:999;" class="am-header-icon-custom" src="data:image/svg+xml;charset=utf-8,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 12 20&quot;&gt;&lt;path d=&quot;M10,0l2,2l-8,8l8,8l-2,2L0,10L10,0z&quot; fill=&quot;%23fff&quot;/&gt;&lt;/svg&gt;" alt="" />
			</a>
		</div>
		<nav data-am-widget="menu" class="am-menu  am-menu-default">
			<a href="javascript: void(0)" class="am-menu-toggle">
				<i class="am-menu-toggle-icon am-icon-bars"></i>
			</a>
			<ul id="menu" class="am-menu-nav am-avg-sm-1">
				<li class="am-parent">
					<a class="toggle" style="margin-top:5px;">
					<?php switch($order_status): case "1": ?>最近一个月订单<?php break;?>
						 <?php case "2": ?>最近三个月订单<?php break;?>
						 <?php case "3": ?>三个月以前订单<?php break;?>
						 <?php case "4": ?>完税订单<?php break;?>
						 <?php case "5": ?>保税订单<?php break;?>
						 <?php case "6": ?>待付款订单<?php break;?>
						 <?php case "7": ?>待发货订单<?php break;?>
						 <?php case "8": ?>清关中订单<?php break;?>
						 <?php case "9": ?>待收货订单<?php break;?>
						 <?php case "10": ?>已完成订单<?php break;?>
						 <?php case "11": ?>退货中订单<?php break;?>
						 <?php case "12": ?>退款中订单<?php break;?>
						 <?php case "13": ?>退款成功订单<?php break;?>
						 <?php case "14": ?>异常订单<?php break;?>
						 <?php case "15": ?>退款失败<?php break;?>
						<?php default: if($user_level == 4): ?>我的订单
								   <?php else: ?>店铺订单<?php endif; endswitch;?>
					</a>
					<ul class="am-menu-sub am-collapse  am-avg-sm-3 " style="background-color: white; box-shadow: 0px 0px 3px rgb(120,120,120); color: rgb(85,85,85);">
						<li>
							<a><span class="size_radioToggle first <?php if($order_status == 0): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list');?>'">全部订单</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle first <?php if($order_status == 4): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => itemtype1));?>'">完税订单</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle first <?php if($order_status == 5): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => itemtype2));?>'">保税订单</span></a>
						</li>
						<div class="am-g">
							<div class="am-u-sm-3" style="text-align: center; color: rgb(85,85,85);"><span>订单时间</span></div>
							<div class="am-u-sm-9"><hr data-am-widget="divider" style="margin-top: 24px; margin-left: 5px; margin-right: 12px;" class="am-divider am-divider-default" /></div>
						</div>
						<li>
							<a><span class="size_radioToggle second <?php if($order_status == 1): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => one));?>'">最近一个月</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle second <?php if($order_status == 2): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => two));?>'">最近三个月</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle second <?php if($order_status == 3): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => three));?>'">三个月之前</span></a>
						</li>
						<div class="am-g">
							<div class="am-u-sm-3" style="text-align: center; color: rgb(85,85,85);">&nbsp;订单状态</div>
							<div class="am-u-sm-9"><hr data-am-widget="divider" style="margin-top: 24px; margin-left: 5px; margin-right: 12px;" class="am-divider am-divider-default" /></div>
						</div>
						<li>
							<a><span class="size_radioToggle third <?php if($order_status == 6): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status1));?>'">待付款</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle third <?php if($order_status == 7): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status2));?>'">待发货</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle third <?php if($order_status == 8): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status3));?>'">清关中</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle third <?php if($order_status == 9): ?>current<?php endif; ?>"  onClick="location.href='<?php echo U('User/order_list',array('keyword' => status4));?>'">待收货</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle third <?php if($order_status == 10): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status5));?>'">已完成</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle third <?php if($order_status == 11): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status6));?>'">退货中</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle third <?php if($order_status == 12): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status7));?>'">退款中</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle four <?php if($order_status == 13): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status8));?>'">退款成功</span></a>
						</li>
						
						<li>
							<a><span class="size_radioToggle four <?php if($order_status == 15): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status10));?>'">退款失败</span></a>
						</li>
						<li>
							<a><span class="size_radioToggle four <?php if($order_status == 14): ?>current<?php endif; ?>" onClick="location.href='<?php echo U('User/order_list',array('keyword' => status9));?>'">异常订单</span></a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>

	</header>

	<div id="search_order">

		<div class="left">
			<span>查找订单<i style="margin-left:12%;" class="am-icon-angle-double-right"></i></span>
		</div>
		<div class="search right" >
			<input id="txtSearch" type="text" class="text" name="keyword"  placeholder="请输入关键字" />
			<img src="./Tpl/home/default/Style/index-images/xg06.png"/>
			<input class="button" name="" id="search_btn" type="button" value="搜索" style="height: 28px;color:#9f9f9f;margin-right: 2%; border-left:solid 1px rgb(236,234,234); outline: none;" />
		</div>
	</div>
	
	</div>
	<input type="hidden" name="shopid" value="<?php echo ($shopid); ?>" />
	<?php if(!empty($order)): if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="dingdangbj" style="width: 96%;margin: 0 2% 2% 2%;padding:0;position: relative; left: 0; top: 0;">
				<?php if($order["status"] == 4): ?><img src="../Style/index-images/do.png" alt="已完成" style="position: absolute; left:67%; top: -10px; z-index: 1; width: 70px; height: 70px;"/><?php endif; ?> <!--已完成图片-->
				<div class="dingdangti">
					<dl>
						<dt style="font-weight:normal;width:71%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><span style="color:#666;font-size:13px;padding-left:1%;">订单号：<?php echo ($order["orderId"]); ?></span></dt>
						<dd style="width:29%; line-height: 25px;padding-right: 1px;">
							<?php switch($order["status"]): case "1": ?>待付款<?php break;?>
								<?php case "2": ?>待发货<?php break;?>
								<?php case "3": ?>待收货<?php break;?>
								<?php case "4": ?><img onclick="del('<?php echo ($order["orderId"]); ?>');" src="../Style/index-images/shopcar_07.png" alt="删除" style="width: 23px; height: 23px;" /><?php break;?>
								<?php case "6": ?>退货中<?php break;?>
								<?php case "7": ?>退款失败<?php break;?>
								<?php case "11": ?>退款中<?php break;?>
								<?php case "9": ?>清关中<?php break;?>
								<?php case "10": ?>异常<?php break;?>
								<?php case "8": ?>退款成功<?php break; endswitch;?>
						</dd>
					</dl>
				</div>
				<!-- 订单页面产品列表 -->
				<div class="dingdangdian" style="margin-top:0;">
					<ul>
						<?php if(is_array($order["item"])): $i = 0; $__LIST__ = $order["item"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<div class="am-g am-g-fixed">
									<div class="am-u-sm-12">
										<div class="am-list-news-bd">
											<ul class="am-list" style="margin-bottom:0">
												<!-- <volist name="vo.goods" id="vo2"> -->
												<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left">
															<div class="am-u-sm-3 am-list-thumb dianproimg" onclick="window.location.href='<?php echo U('Order/logistics',array('detail_id'=>$vo['detail_id'],'status'=>$order['status']));?>'">
																<img src="<?php echo attach(get_thumb($vo['img'], '_b'), 'item');?>" />
															</div>
													<div class=" am-u-sm-7 am-list-main" style="margin-left:7%;">
														<table class="am-table am-table-bordered am-table-striped am-table-compact dianprotablezi">
															<tbody>
																		<tr onclick="window.location.href='<?php echo U('Order/logistics',array('detail_id'=>$vo['detail_id'],'status'=>$order['status']));?>'">
																			<td style="font-size: 13px;"><?php echo ($vo["title"]); ?>
																			</td>
																		</tr>
																<tr>
																	<td colspan="2" style="color:#ababab;">
																		优品价：<span style="color:#e26000; font-family:'微软雅黑'; font-size:14px;">¥<?php echo ($vo["price"]); ?><span style="color:#ababab;margin-left:10%;">x<?php echo ($vo["quantity"]); ?> </span><br/></span>
																		<?php if($order["status"] != 1): if($order["add_time"] > $order_time or $vo["add_time"] > $order_time): if($order["status"] != 4): ?><span style="color:#ababab;margin-right:15px;">
																							商品状态：
																							<?php switch($vo["status"]): case "1": ?>待付款<?php break;?>
																								<?php case "2": ?>待发货<?php break;?>
																								<?php case "3": ?>待收货<?php break;?>
																								<?php case "4": ?>已完成<?php break;?>
																								<?php case "6": ?>退货中<?php break;?>
																								<?php case "7": ?>退款失败<?php break;?>
																								<?php case "11": ?>退款中<?php break;?>
																								<?php case "9": ?>清关中<?php break;?>
																								<?php case "10": ?>异常(缺货或清关抽查)<?php break;?>
																								<?php case "8": ?>退款成功<?php break;?>
																								<?php default: ?>待发货<?php endswitch;?>
																						</span><?php endif; endif; endif; ?>
																		
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="am-u-sm-2 dingdandizhiright" style="width:10%;line-height:84px;">
														
															<a href="<?php echo U('Order/logistics',array('detail_id'=>$vo['detail_id'],'status'=>$order['status']));?>">
																<img src="../Style/index-images/jt03.png">
															</a>
															
													</div>
													<!-- </a> -->
												</li>
											</ul>
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						</div>
						</li>
					</ul>
				</div>
				
				<div class="dingdangprojia" style="border-bottom:none;line-height:20px;height:50px;">
					<div style="width:30%;float:left;text-align: left;margin-left:2%;margin-top:2px;">
					<!-- 	<span>运费：</span><span style="color:#e15f11;font-size:14px;">¥
					<?php if($order["totalprice"] > 99): ?>0<?php else: ?>10<?php endif; ?></span> -->
					</div>

					<div style="display:inline-block;text-align:right;width:65%;float:right;color:#555;height:50px;line-height:25px;">
						<?php if(($user_level["uid"]) == "2"): ?><span>订单利润：</span><span style="color:#ff0000;font-size:14px;margin-right:5%;">¥<?php echo ($order["profit"]); ?></span><?php endif; ?>
						<?php if(($user_level["uid"]) == "3"): ?><span>订单利润：</span><span style="color:#ff0000;font-size:14px;margin-right:5%;">¥<?php echo ($order["profit"]); ?></span><?php endif; ?>
						<?php if(($user_level["uid"]) == "5"): ?><span>订单利润：</span><span style="color:#ff0000;font-size:14px;margin-right:5%;">¥<?php echo ($order["profit"]); ?></span><?php endif; ?><br/>
						<?php $sumnum = ''; ?>
						<p>共<span style="color:#e15f11;margin:0 3px;"><?php echo ($order["count"]); ?></span>件商品<span style="margin-right: 5%;margin-left:3%;">
						<?php if($order["cash_price"] != 0): ?>抵扣合计：<span style="color:#e15f11;font-size:14px;">¥<?php echo ($order["order_sumPrice"]); ?></span>
								<?php else: ?>
								合计：<span style="color:#e15f11;font-size:14px;">¥<?php echo ($order["totalprice"]); ?></span><?php endif; ?>
						</span>
							<p>

					</div>
				</div>
				
				
				
				<!--按钮-->
				<div id="btn">				
					<?php switch($order["status"]): case "1": ?><span onclick="del('<?php echo ($order["orderId"]); ?>');">删除</span>
							<span onclick="window.location.href='<?php echo U('Order/pay',array('orderId' => $order['orderId'],'sharesid'=>$order['userId']));?>'">去付款</span><?php break;?>
						<?php case "2": ?><span onclick="window.location.href='<?php echo U('Order/orderTK',array('orderId'=>$order['orderId'],'status'=>$order['status']));?>'">申请退款</span>
							<span onclick="do_urgent('<?php echo ($order["orderId"]); ?>');">提醒发货</span><?php break;?>
						<?php case "3": ?><span onclick="window.location.href='<?php echo U('Order/orderTK',array('orderId'=>$order['orderId'],'status'=>$order['status']));?>'">申请退款</span>
							<span onclick="window.location.href='<?php echo U('Order/confirmOrder',array('orderId'=>$order['orderId'],'status'=>$order['status']));?>'">确认收货</span><?php break;?>
						<?php case "4": if(($order["c_status"]) == "0"): if(time() < $order['add_time']+24*3600*30){ ?>
									<span onclick="window.location.href='<?php echo U('Order/orderTK',array('orderId'=>$order['orderId'],'status'=>$order['status']));?>'">申请退款</span>
								<?php
 } ?>
								<span  onclick="window.location.href='<?php echo U('User/comment',array('orderId'=>$order['orderId'],'status'=>$order['status'],'comment'=>1));?>'">评价晒单</span>
								<?php else: ?>
								<span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</span><?php endif; break;?>
						<?php case "6": ?><span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</span><?php break;?>
						<?php case "7": ?><span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</span><?php break;?>
						<?php case "11": ?><span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</span><?php break;?>
						<?php case "9": ?><span onclick="window.location.href='<?php echo U('Order/orderTK',array('orderId'=>$order['orderId'],'status'=>$order['status']));?>'">申请退款</span>
						<span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</span><?php break;?>
						<?php case "10": ?><div style="float:left;">如有疑问请联系客服</div>
						<span onclick="window.location.href='<?php echo U('Order/orderTK',array('orderId'=>$order['orderId'],'status'=>$order['status']));?>'" style="padding:3px 7px 3px 7px; border:solid 1px rgb(240,93,0);color:rgb(240,93,0);margin-right:5px;">申请退款</span>
						<span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">
						<a style="color:rgb(16,96,147);" href='https://static.meiqia.com/dist/standalone.html?eid=23554&clientid=<?php echo ($server_u["id"]); ?>&metadata={"name":"<?php echo $server_u['username']; ?>","tel":"<?php echo $server_u['phone_mob']; ?>","email":"<?php echo $server_u['email']; ?>"}'>联系客服</a>
						</span><?php break;?>
						<?php case "8": ?><span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</span><?php break; endswitch;?>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
		
		
		
		<div class="dingdangwu" style="padding: 76px 0 0 0;">
			<div class="dingdangwuimgs" style="text-align:center;">
				<img src="../Style/index-images/details.png" style="width:120px;height:120px;" /></div>
			<div class="dingdangzi"><span style="color:#333; font-size:14px; font-family:'微软雅黑';">您还没有相关的订单</span>
				<?php if(($shopid) > "0"): ?><br /> 可以去看看有哪些想买的哦
			</div>
			<div class="dingdangon">
				<a href="<?php echo U('Index/index',array('shares'=>$info['id']));?>">我要购物</a>
			</div>
		</div><?php endif; endif; ?>
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
			} else {
				window.location.href = "index.php?m=User&a=order_list&keyword=" + keyword.val() + "&shopid=" + shopid.val();
			}
		});
	</script>

	<script src="../Style/js/addclear.js" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8">
		$(function() {
			$("input").addClear();
		});
	</script>
	<script type="text/javascript">
		$(function() {
			$('#menu li a span').click(function() {
				var thisToggle = $(this).is('.size_radioToggle') ? $(this) : $(this).prev();
				var checkBox = thisToggle.prev();
				checkBox.trigger('click');
				$('.size_radioToggle').removeClass('current');
				thisToggle.addClass('current');
				return false;
			});
		});
		//删除订单
		function del(id){
			layer.open({
					title: '提示',
					content: '您确定要删除该订单吗？与之相关的保税或完税订单都会被删除',
					btn: ['确认', '取消'],
					yes: function(index){
						window.location.href= "<?php echo U('Order/delOrder');?>&orderId="+id;
						layer.open({content: '订单删除成功', time: 1});
						layer.close(index);
					}
			});
			
		}//支付订单
	function topay(id){
		layer.open({
				title: '提示',
				content: '与该订单相关的保税或完税订单会被一起支付',
				btn: ['确认', '取消'],
				yes: function(index){
					window.location.href="<?php echo U('Order/pay');?>&orderId="+id;
					//layer.open({content: '提交支付成功', time: 1});
					//layer.close(index);
				}
		});
	}
	
	 function do_urgent(orderId){
	           $.get('<?php echo U('Order/do_urgent');?>',{'orderId':orderId},function(data){
	           if(data=='成功'){ 
	              layer.open({
						title: '提醒发货',
						content: '您已经成功提醒发货，感谢您对团洋范的支持',
						btn: ['我知道了'],
						yes: function(index){
							//location.reload();
							layer.close(index);
						}
					});              
	            }else if(data=="yes成功"){
					layer.open({content: '您已经提醒过了哦，我们会尽快发货呢', time: 2});
				}           
	         });
	     }     
	</script>
</body>
</html>