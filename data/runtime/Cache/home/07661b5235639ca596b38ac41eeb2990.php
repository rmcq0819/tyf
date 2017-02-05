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
		  
		  wx.ready(function () {
			 wx.onMenuShareTimeline({
				title: "有范票 才任性 - 范票商城", // 分享标题
				link: "<?php echo ($jsapi['url']); ?>", // 分享链接
				imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/activity/fan-header.png", // 分享图标
			});
			wx.onMenuShareAppMessage({
				title: "超值好礼 超值兑换 - 范票商城", // 分享标题
				desc: "有范票 才任性", // 分享描述
				link: "<?php echo ($jsapi['url']); ?>", // 分享链接
				imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/activity/fan-header.png", // 分享图标
				type: 'link', 
				dataUrl: '',
			});
		  });
		</script>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
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
			/*选项卡*/
			#tab{
				text-align: center; background-color: white;
			}
			#tab .left,#tab .left2{
				width: 30%; float: left; text-align: right;
			}
			#tab .right,#tab .right2{
				width: 70%; float: right; text-align: center;
			}
			#tab .right p:first-child,#tab .right2 p:first-child{
				color: rgb(85,85,85); padding-top: 5px;
			}
			#tab .right p:last-child,#tab .right2 p:last-child{
				color: rgb(240,93,0); font-size: 13px;
			}
			/*商品主体*/
			#main{
				margin-top: 15px; background-color: white; padding-bottom: 20px;
			}
			#main fieldset{
				border: dashed 1px rgb(117,117,117); margin: 0px;
			}
			#main legend{
				border-bottom: none; text-align: center; font-size: 13px; padding-bottom: 0px; margin-bottom: 0px;
			}
			#main .name{
				color: rgb(90,90,90); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 13px; margin-top: 5px;
			}
			#main .price{
				text-align: center; font-size: 13px;
			}
			#main .price span{
				color: rgb(240,93,0);
			}
			#main .only{
				text-align: center; color: rgb(240,93,0); margin-top: 3px;
			}
			#main .btn{
				width: 100%; height: 28px;font-size:13px;background-color: rgb(240,93,0); color: white; border: none; margin: 0 auto; border-radius: 3px; margin-top: 3px;
			}
			#main #tips{
				width:95%; background-color: rgb(252,237,196); margin: 0 auto; padding: 10px; color: rgb(85,85,85); padding-bottom: 20px; border: solid 1px rgb(171,171,173); border-radius: 5px;line-height:28px;font-size:13px;
			}
			#main #tips p:first-child{
				text-align: center; color: rgb(240,93,0); font-size: 15px; font-weight: bold;
			}
			
			/*折叠面板*/
			#toggle{
				width: 100%;margin-top: 49px; position: fixed; top: 0px; background-color: rgb(244,238,204); padding: 10px 10px 0px 10px; font-size: 13px; z-index: 2; box-shadow: 0px 2px 5px rgb(165,165,165);
			}
			#toggle .toggle-btn{
				text-align: center; color: rgb(240,93,0); padding: 5px 0px 5px 0px; font-size: 13px;
			}
			#toggle .toggle-btn span{
				border: solid 1px rgb(240,93,0); padding: 3px 20px 3px 20px; border-radius: 5px;
			}
			#toggle-open{
				width: 154px; position: fixed; top: 49px; left: 50%; margin-left: -80px; z-index: 1;
			}
			.am-icon-angle-down{
				animation: start 1.3s infinite ease-in-out;
           	 	-webkit-animation: start 1.3s infinite ease-in-out;
            	-o-animation: start 1.3s infinite ease-in-out;
			}
			@keyframes start {
            	0%,30% {opacity: 0;transform: translate(0,-4px);}
            	60% {opacity: 1;transform: translate(0,1px);}
            	100% {opacity: 0;transform: translate(0,1px);}
        	}
	        @-webkit-keyframes start {
	            0%,30% {opacity: 0;transform: translate(0,-4px);}
	            60% {opacity: 1;transform: translate(0,1px);}
	            100% {opacity: 0;transform: translate(0,1px);}
	        }
	        @-o-keyframes start {
	            0%,30% {opacity: 0;transform: translate(0,-4px);}
	            60% {opacity: 1;transform: translate(0,1px);}
	            100% {opacity: 0;transform: translate(0,1px);}
	        }
		</style>
		<script type="text/javascript">
			$(function(){
				$("#toggle").hide();
				$("#toggle-open").on("click",function(){
					$("#toggle-open").slideDown("fast");
					$("#toggle").slideDown();
				});
				$(".toggle-btn").on("click",function(){
					$("#toggle-open").hide();
					$("#toggle").slideUp();
					$("#toggle-open").delay("fast").slideDown("slow");
				});
			});
		</script>
	</head>

	<body style="background-color: rgb(243,243,243);">
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			范票商城
		</div>
		
		<div id="toggle">
			<div onclick="window.location.href='<?php echo U('Item/index',array('id'=>4731,'shares'=>$info['id']));?>'" style="width: 30%;float: left; padding: 10px;">
				<img src="../Style/index-images/activity/fan-main.png" alt="范票" class="am-img-responsive"/>
			</div>
			<div onclick="window.location.href='<?php echo U('Item/index',array('id'=>4731,'shares'=>$info['id']));?>'" style="width:60%;float: left; color: rgb(240,93,0); padding-top: 14px;">
				<p style="color: rgb(85,85,85);"><?php echo ($fp_detail["title"]); ?></p>
				<p style="color: rgb(240,93,0); font-size: 14px;">￥<?php echo ($fp_detail["price"]); ?></p>
				<p style="color: rgb(170,171,175);">已售<?php echo ($fp_detail["buy_num"]); ?>笔</p>
			</div>
			<div style="width: 10%;float: left;">
				<i class="am-icon-chevron-right" style="color: rgb(170,171,175); line-height: 85px; margin-top: 48px;"></i>
			</div>
			<div style="clear: both;"></div>
			<div class="toggle-btn"><span><i class="am-icon-angle-up am-icon-sm"></i>&nbsp;点我收起</span></div>
		</div>
		
		<div id="toggle-open">
			<img src="../Style/index-images/activity/toggle.png" alt="" style="width: 160px; height: 35px;"/>
			<p style="position: absolute; left: 33px; top: 2px;"><i class="am-icon-angle-down am-icon-sm"></i>&nbsp;&nbsp;&nbsp;<img src="../Style/index-images/activity/fanpiao-fan.png" alt="范票" style="width:25px; margin-top: -4px;"/>&nbsp;<span style="color: rgb(240,93,0);">点我购买</span></p>
		</div>
		
		<!--头部-->
		<div id="header">
			<img src="../Style/index-images/activity/fan-header.png" alt="头部" class="am-img-responsive" style="margin-top:-22px;"/>
		</div>
		
		<div id="tab" class="am-g">
			<div class="am-u-sm-5">
				<div class="left">
					<img src="../Style/index-images/activity/keyong-fan.png" alt="可用范票" style="width: 28px; margin-top: 12px; margin-left: 0px;"/>
				</div>
				<div class="right">
					<p>可用范票</p>
					<p><?php echo ($point_yuer); ?>&nbsp;张</p>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div class="am-u-sm-2">
				<img src="../Style/index-images/activity/line-fan.png" alt="分割线" class="am-img-responsive" style="width: 1px;height:40px; margin: 0 auto; margin-top: 5px;"/>
			</div>
			<div class="am-u-sm-5">
				<div class="left2">
					<img src="../Style/index-images/activity/duihuan-fan.png" alt="可用范票" style="width: 28px; margin-top: 12px; margin-left: 0px;"/>
				</div>
				<?php if($fping_count == 0): ?><div class="right2">
						<p>兑换记录</p>
						<p><?php echo ($fping_count); ?></p>
					</div>
					<?php else: ?>
					<div class="right2" onclick="window.location.href='<?php echo U('fpingshop/fping_history');?>'">
						<p>兑换记录</p>
						<p><?php echo ($fping_count); ?></p>
					</div><?php endif; ?>
				<div style="clear: both;"></div>
			</div>
		</div>
		
		<div id="title" style="margin-top: 20px;">
			<img src="../Style/index-images/activity/title-fan.png" alt="精选礼品超值兑换" class="am-img-responsive" style="width: 219px; margin: 0 auto;"/>
		</div>
		
		<div id="main">
			<ul class="am-avg-sm-2 am-thumbnails">
				<?php if(is_array($bargain_list)): $i = 0; $__LIST__ = $bargain_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
						<fieldset>
							<legend>特惠必购</legend>
							<img src="http://yooopay.com/data/upload/item/<?php echo ($val["img"]); ?>" alt="商品图片" class="am-img-responsive"/>
						</fieldset>
						<p class="name"><?php echo ($val["title"]); ?></p>
						<p style="text-align: center; font-size: 13px; color: rgb(90,90,90); ">商城售价：￥<del><?php echo ($val["price"]); ?></del></p>
						<p class="price"><span>￥<?php echo ($val["fping_price"]); ?></span> + <img src="../Style/index-images/activity/fanpiao-fan.png" alt="范票" style="width: 25px; margin-top: -4px;"/><span>&nbsp;<?php echo ($val["fping_num"]); ?>张</span></p>
						<button class="btn" onclick="fping_pay(<?php echo ($val["id"]); ?>,<?php echo ($val["fping_num"]); ?>,<?php echo ($val["fping_price"]); ?>)"><span style="border-right: dashed 1px white; margin-left: -5px; font-size: 12px; padding: 5px 3px 5px 0px;">仅剩<?php echo ($val["goods_stock"]); ?>件</span><span style="padding-left: 6px;">立即兑换</span><i class="am-icon-bell"></i></button>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<br />
			<div id="tips">
				<p>兑换说明</p>
				<p style="margin-top: 6px;">1、范票商城仅对销售业绩突出的「人气店铺」开放；</p>
				<p>2、范票商城采用支付金额+范票形式进行兑换，支付时范票及优惠券不可使用；</p>
				<p>3、商品一经兑换，除产品质量外，范票/产品不可退还；</p>
				<p>4、参加活动、购物、评论、领取红包可获得相应范票奖励；</p>
				<p>5、团洋范保留最终解释权，如有疑问请联系客服；</p>
			</div>
		</div>
		<script>
			function fping_pay(id,fping_num,fping_price){
				layer.open({
					title: '兑换提示',
					content: '您确定要花费'+fping_num+'张范票兑换该商品吗？',
					btn: ['确认兑换', '再看看'],
					yes: function(index){
						$.post('<?php echo U('fpingshop/fping_pay');?>',{'id':id,'fping_num':fping_num,'fping_price':fping_price},function(res){
							var data = eval("("+res+")");
							//如果用户范票不足
							if(data.status == 0){
								layer.open({
									title: '兑换提示',
									content: '您账户中的范票数不足，兑换失败啦，快去多赚一些范票囤起来吧',
									btn: ['我知道了'],
									yes: function(index){
										layer.close(index);
									}
								});
							}else if(data.status == 1){
								layer.open({
										title: '兑换提示',
										content: '恭喜您，已经成功兑换了一件商品',
										btn: ['去支付', '取消'],
										yes: function(index){
											window.location.href= "<?php echo U('Order/pay',array('orderId'=>'"+data.orderId+"'));?>";
											layer.close(index);
										}
								});
							}else if(data.status == 3){
								layer.open({
									title: '兑换提示',
									content: '当前店铺不是人气店铺，无法进行兑换',
									btn: ['我知道了'],
									yes: function(index){
										layer.close(index);
									}
								});
							}
						});
						layer.close(index);
					}
				});
			}
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