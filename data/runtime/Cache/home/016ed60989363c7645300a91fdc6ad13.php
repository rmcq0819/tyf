<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>会员中心 - 订单详情</title>
		<link href="../Style/shop.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../Style/js/jquery.js" charset="utf-8"></script>
		<script type="text/javascript" src="../Style/js/ecmall.js" charset="utf-8"></script>
		<script type="text/javascript" src="../Style/js/touchslider.dev.js" charset="utf-8"></script>
		<!--引入layer-->
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<!--查看物流样式调用-->
		<link rel="stylesheet" href="../Style/css/wuliu_style.css" />
		<script type="text/javascript">
			//<!CDATA[
			var SITE_URL = "__ROOT__";
			var PRICE_FORMAT = '¥%s';

			$(function() {
				var span = $("#child_nav");
				span.hover(function() {
					$("#float_layer:not(:animated)").show();
				}, function() {
					$("#float_layer").hide();
				});
			});

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
		<style>
			*{
				font-family: "微软雅黑";
			}
			#time{
				width: 100%; background-color: white; color: rgb(180,180,180); margin-top: 5px;padding-left: 10px;
			}
			
			#ask{
				height: 30px;background-color: white; margin-top: 5px; line-height: 30px;
			}
			#ask button{
				width: 78px;height: 20px; float: right ; margin-right: 20px; margin-top: 5px;background-color: rgb(240,93,0); color: white; border: none; border-radius:3px ;
			}
			
			/****物流状态S****/	
			.demo{width:100%; margin: 0 auto; margin-top: 20px; }
			.history{background:url(../Style/index-images/line042.gif) repeat-y 107px 0;overflow:hidden;position:relative;}
			.history-date{overflow:hidden;position:relative;}
			.history-date ul li{background:url(../Style/index-images/icon082.png) no-repeat 100px 0;padding-bottom:24px;zoom:1;}
			.history-date ul li:last-child{background:url(../Style/index-images/icon082.png) no-repeat 100px 0;padding-bottom:5px;zoom:1;}
			.history-date ul li:first-child{background:url(../Style/index-images/icon071.png) no-repeat 100px 0;}
			.history-date ul li.last{padding-bottom:0;}
			.history-date ul li:after{content:" ";display:block;height:0;clear:both;visibility:hidden;}
			.history-date ul li h3{float:left;width:110px;text-align:right;padding-right:19px;color:rgb(130,130,130);font:normal 13px/16px Arial;}
			.history-date ul li h3 span{display:block;color:rgb(130,130,130);font-size:12px; text-align: center;}
			.history-date ul li dl{float:left;padding-left:30px;margin-top:-5px;font-family:微软雅黑; padding-left:20px ; width: 210px; margin-top: 0px;}
			.history-date ul li dl dt{font:16px/16px 微软雅黑;color:#737373;}
			.history-date ul li dl dt span{display:block;color:rgb(130,130,130);font-size:13px;}
			.history-date ul li:first-child dl dt span{display:block;color:rgb(240,93,0);font-size:13px;}
			.history-date ul li:first-child h3{color:rgb(240,93,0);}      /*改变第一个时间颜色*/
			.history-date ul li:first-child h3 span{color:#1db702; text-align: center;}    /*改变第一个时间颜色*/
			.history-date ul li.green dl{margin-top:-2px;}
			.history-date ul li.green dl dt{font-size:16px;}
			/***物流状态E****/	
		</style>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
</head>
<body>
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


	<!-- 头部 -->
	<header data-am-widget="header" class="am-header am-header-default">
		<div class="am-header-left am-header-nav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
					<img class="am-header-icon-custom" src="data:image/svg+xml;charset=utf-8,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 12 20&quot;&gt;&lt;path d=&quot;M10,0l2,2l-8,8l8,8l-2,2L0,10L10,0z&quot; fill=&quot;%23fff&quot;/&gt;&lt;/svg&gt;" alt=""/>
			</a>
		</div>
		<h1 class="am-header-title">订单详情</h1>
	</header>
	
	<div class="carfukuan" style="color:#e15f11;font-size: 16px;margin-right: 2%;background:none;height:65px; line-height: 65px; padding: 0px;">
		<div style="float: left;">
			<!-- <span style="color:#e15f11;">已完成</span> -->
			<p style="padding-left: 10px;">状态:&nbsp;&nbsp;
				<?php switch($order["status"]): case "1": ?><span style="color:#e15f11;">待付款</span><?php break;?>
				 <?php case "2": ?><span style="color:#e15f11;">正在出库</span><?php break;?>
				 <?php case "3": ?><span style="color:#e15f11;">待收货</span><?php break;?>
				 <?php case "4": if(($order["c_status"]) == "0"): ?><span style="color:#e15f11;">待评论</span><?php else: ?><span style="color:#e15f11;">已完成</span><?php endif; break;?>
				 <?php case "6": ?><span style="color:#e15f11;">退货中</span><?php break;?>
				 <?php case "7": ?><span style="color:#e15f11;">退款失败</span><?php break;?>
				 <?php case "11": ?><span style="color:#e15f11;">退款中</span><?php break;?>
				 <?php case "9": ?><span style="color:#e15f11;">清关中</span><?php break;?>
				 <?php case "10": ?><span style="color:#e15f11;">异常订单</span><?php break;?>
				 <?php case "8": ?><span style="color:#e15f11;">退款成功</span><?php break;?>
				<?php default: ?><span style="color:#e15f11;">完成</span><?php endswitch;?>	
			</p>
		</div>
		
		<?php if($order["status"] != 1): ?><div>
					<img src="../Style/index-images/chuku.gif" alt="出库" class="am-img-responsive" style="width: 125px;height: 65px;float: right;" />
				</div><?php endif; ?>
		<div style="clear: both;"></div>
	</div>
	
	<!-- 订单号 -->
	<div style="width: 100%;height: 34px;background-color: #fff;line-height: 34px;padding-left: 3%;">
		<b>订单号：<?php echo ($order["orderId"]); ?></b>
		<!--<p style="float:right;color:#898989;margin-right: 10px;"><?php if($order["fahuo_time"] != ''): echo (date('Y-m-d',$order["fahuo_time"])); endif; ?></p>-->
	</div>
	
	<!--预计到货时间-->
	<div id="time">
		<p style="line-height:25px;font-size:13px;padding:5px;">
			<b >亲爱的范团：</b><br/>小范建议您：在您迫不及待签收货物时，可以和配送员当面对照发货单，核对商品是否与您购买的一致，如在检查的过程中发现问题，请您不要签收商品，并及时联系团洋范客服中心，我们会第一时间进行处理。
		</p>
	</div>
	
	<!--详情咨询-->
	<div id="ask">
		<p style="padding-left: 10px;">如有疑问，您可以咨询在线客服 <a href='https://static.meiqia.com/dist/standalone.html?eid=23554&clientid=<?php echo ($server_u["id"]); ?>&metadata={"name":"<?php echo $server_u['username']; ?>","tel":"<?php echo $server_u['phone_mob']; ?>","email":"<?php echo $server_u['email']; ?>"}'><button><i class="am-icon-github"></i>&nbsp;在线咨询</button></a></p>
	</div>
	
	<!--物流状态-->
	<div id="logistics">
		<div class="demo">
			<div class="history">
				<div class="history-date">
					<ul>
						<?php if($order["tuihuo_time"] != ''): ?><li>
								<h3></span><?php echo (date('Y-n-j H:i:s',$order["tuihuo_time"])); ?></span></h3>
								<dl>
									<dt><span>您提交了退款申请，请等待系统确认</span></dt>
								</dl>
							</li><?php endif; ?>
						
						<?php if($act_time > $dist_time And $order["status"] == 2): ?><li>
								<h3></span><?php echo (date('Y-n-j H:i:s',$dist_time)); ?></span></h3>
									<dl>
										<dt><span>您的订单待配货</span></dt>
									</dl>
							</li><?php endif; ?>
						
						<?php if($act_time > $start_time And $order["status"] == 2): ?><li>
								<h3></span><?php echo (date('Y-n-j H:i:s',$start_time)); ?></span></h3>
									<dl>
										<dt><span>您的订单开始处理</span></dt>
									</dl>
							</li><?php endif; ?>
						
						<li>
							<h3></span><?php echo (date('Y-n-j H:i:s',$order["add_time"])); ?></span></h3>
							<dl>
								<dt><span>
								<?php if($order["status"] == 1): ?>您提交了订单，但并未付款
									<?php else: ?>
									您提交了订单，请等待系统确认<?php endif; ?>
								</span></dt>
							</dl>
						</li>
					</ul>
				</div>		
			</div>
		</div>	
	</div>

	<form method="POST"  action="<?php echo U('Order/pay');?>&spr=<?php echo $_GET['spr']; ?>" id="order_form" name="order_form" enctype="multipart/form-data" style="padding:0;">
	<!-- 订单页面产品列表 -->
	<div class="dingdangdian" style="margin-top:0;">
		<ul>
		<?php if(is_array($item_detail)): $i = 0; $__LIST__ = $item_detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
				<div class="am-g am-g-fixed">
					<div class="am-u-sm-12">
						<div class="am-list-news-bd">
							<ul class="am-list" style="margin-bottom:0;">
					
								<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left">
									<a href="javascript:;">
										<div class="am-u-sm-3 am-list-thumb dianproimg" style="margin-bottom:16px;">
											<img src="<?php echo attach(get_thumb($item['img'], '_b'), 'item');?>"/>
										</div>
	
										<div class=" am-u-sm-7 am-list-main" style="float:left;margin-left:7%;">
											<table class="am-table am-table-bordered am-table-striped am-table-compact dianprotablezi">
											  <tbody>
												<tr>
													<td style="font-size: 14px;"><?php echo ($item["title"]); ?><!-- <?php echo ($vo2["name"]); ?> --></td>
													<!-- <td><span style="color:#e26000; font-family:'微软雅黑'; font-size:14px;">¥<?php echo ($vo2["price"]); ?></span></td> -->
												</tr>
												<tr>
													<td colspan="2" style="color:#ababab;">
													优品价：<span style="color:#e26000; font-family:'微软雅黑'; font-size:14px;">¥<?php echo ($item["price"]); ?><span style="color:#ababab;margin-left:10%;">x<?php echo ($item["quantity"]); ?> </span>
													<!-- <?php echo ($vo2["num"]); ?> --><!-- <?php echo ($vo2["price"]); ?> --></span>
													<!-- <?php if($vo2["itemtype"] == 1): ?>完税商品<?php else: ?>保税商品<?php endif; ?> --><br/>
													<!-- <?php if($vo2["size"] != ''): ?>商品规格：<span style="color:#e26000; font-family:'微软雅黑'; font-size:12px;"><?php echo ($vo2["size"]); ?></span><br/><?php endif; ?>   -->
													</td>
												</tr>
												</tbody>
											</table>
										</div>
										<div class="am-u-sm-2 dingdandizhiright" style="width:10%; float:left;line-height: 72px;">
											<a href="<?php echo U('Item/index',array('id'=>$item['itemId'],'shares'=>$info['id']));?>">
												<img src="../Style/index-images/jt03.png">
											</a>
										</div>
									</a>
								</li>
								
							</ul>			
						</div>			
					 
					</div>
				</div>
			</li><?php endforeach; endif; else: echo "" ;endif; ?> 
		
		
			
		</ul>
		
	</div>


	<div class="dingdanghongzi" style="display:none;">跨境专区订单付款不能取消，上传的身份证请务必与收货人姓名保持一致，且不能无理由退换货！</div>


	<!--<div class="am-g am-g-fixed dingdanjiashu"  style="margin-top:2px;">
		<div class="am-u-sm-12 dingdanjiashu1" style="text-align:right;">合计:<span>￥<?php echo ($totalprice); ?></span></div>
	</div>-->
	
	<!-- 收件人信息--订单详情页 -->
	<div class="dingdangbj" style="width:100%;margin: 2px 0 2px 0;padding:0;">
		<div class="am-g am-g dingdang" style="padding: 10px 0 20px 3%;">
			<div class="am-u-sm-1">
				<img src="../Style/index-images/adds.jpg" alt="地址" style="width: 20px; height: 25px; margin-top: 25px;" />
			</div>
			<div class="am-u-sm-11 dingdandizhimiddle">
				<dl>
					<dd style="padding-left: 8px;">
						<h5><?php echo ($order["address_name"]); ?>&nbsp;&nbsp;&nbsp;<?php echo substr_replace($order['mobile'],'****',3,4); ?></h5>
						<p style="color:#ababab;font-size:14px;"><?php echo ($order["address"]); ?></p>
					</dd>
				</dl>
			</div>
		</div>
	</div>
	</form>
	
	<div class="am-g am-g-fixed dingdanjiashu">
		<div class="am-u-sm-12 dingdangyinfukuanon">
	
	
		<?php switch($order["status"]): case "1": ?><a onclick="topay('<?php echo ($order["orderId"]); ?>',<?php echo ($order["userId"]); ?>);" id="check" style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;">去支付</a><?php break;?>
				 <?php case "2": ?><a onclick="do_urgent('<?php echo ($order["orderId"]); ?>');" id="check" style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;">提醒发货</a><?php break;?>
				 <?php case "3": break;?>
				 <?php case "4": if(($order["c_status"]) == "0"): ?><a href="index.php?m=User&a=comment&orderId=<?php echo ($order["orderId"]); ?>&status=<?php echo ($order["status"]); ?>&comment=1" id="check" style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;">去评论</a>
			 		<?php else: ?>
			 		<a onclick="delorder('<?php echo ($order["id"]); ?>')" style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;">删除订单
			 		</a><?php endif; break;?>
				 <?php case "6": ?><a style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;" onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</a><?php break;?>
				 <?php case "7": ?><a style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;" onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</a><?php break;?>
				 <?php case "11": ?><a style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;" onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</a><?php break;?>
				 <?php case "9": ?><a style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;" onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</a><?php break;?>
				 <?php case "10": ?><a style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;" href='https://static.meiqia.com/dist/standalone.html?eid=23554&clientid=<?php echo ($server_u["id"]); ?>&metadata={"name":"<?php echo $server_u['username']; ?>","tel":"<?php echo $server_u['phone_mob']; ?>","email":"<?php echo $server_u['email']; ?>"}'>联系客服</a><?php break;?>
				<?php default: ?>
				case value="8"><a style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;" onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</a></case><?php endswitch;?>
		</div>
	</div>
	<script>
		//删除订单
		function del(id){
			layer.open({
					title: '提示',
					content: '您确定要删除该订单吗？相关的保税或完税订单都会被删除哦！',
					btn: ['确认', '取消'],
					yes: function(index){
						window.location.href= "<?php echo U('Order/delOrder');?>&orderId="+id;
						layer.open({content: '订单删除成功', time: 1});
						layer.close(index);
					}
			});
			
		}
	//支付订单
	function topay(id,sharesid){
		layer.open({
				title: '提示',
				content: '与该订单相关的保税或完税订单需要一起支付哦！',
				btn: ['确认', '取消'],
				yes: function(index){
					window.location.href="<?php echo U('Order/pay');?>&orderId="+id+"&sharesid="+sharesid+"";
					//layer.open({content: '提交支付成功', time: 1});
					//layer.close(index);
				}
		});
	}
	</script>
	<!--快递时间轴的动画-->
		<script type="text/javascript">
		$(function(){
			systole();
		});
		function systole(){
			if(!$(".history").length){
				return;
			}
			var $warpEle = $(".history-date"),
				$targetA = $warpEle.find("h2 a,ul li dl dt a"),
				parentH,
				eleTop = [];
			
			parentH = $warpEle.parent().height();
			$warpEle.parent().css({"height":59});
			
			setTimeout(function(){
				
				$warpEle.find("ul").children(":not('h2:first')").each(function(idx){
					eleTop.push($(this).position().top);
					$(this).css({"margin-top":-eleTop[idx]}).children().hide();
				}).animate({"margin-top":0}, 1600).children().fadeIn();
		
				$warpEle.parent().animate({"height":parentH}, 1500);
		
				$warpEle.find("ul").children(":not('h2:first')").addClass("bounceInDown").css({"-webkit-animation-duration":"2s","-webkit-animation-delay":"0","-webkit-animation-timing-function":"ease","-webkit-animation-fill-mode":"both"}).end().children("h2").css({"position":"relative"});
				
			}, 600);
		
			$targetA.click(function(){
				$(this).parent().css({"position":"relative"});
				$(this).parent().siblings().slideToggle();
				$warpEle.parent().removeAttr("style");
				return false;
			});
		};
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