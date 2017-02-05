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




		<style>
			* {
				font-family: "微软雅黑";
			}
			/*头部S*/
			.topnav {
				z-index: 999;position: fixed;width: 100%;height: 49px;background: rgb(240, 93, 0);text-align: center;color: #fff;font-size: 16px;line-height: 49px;top: 0;
			}
			.topnav .back {
				position: absolute;left: 8px;top: 6px;margin-top: -8px;
			}
			
			.topnav img {
				position: absolute;top: 14px;left: 5px;
			}
			/*头部E*/
			.topnav .clear-all {
				position: absolute;top: 0;right: 6px;font-size: 15px;line-height: 49px;
			}
			/*购物车没有产品的时候*/
			
			#col-img {
				text-align: center;
			}
			
			#col-content {
				text-align: center;font-size: 15px;margin: 0 10px;text-align: left;color: #555;
			}
			
			/*按钮*/
			#btn {
				text-align: center;margin-bottom: 10px;
			}
			
			#btn a {
				font-size: 14px;padding: 3px 9px;border-radius: 4px;
			}
			#btn a:first-child {                  /*支付按钮*/
				border: 1px solid black;color: black;margin-right: 52px;
			}
			#btn a:last-child {                    /*返回首页按钮*/
				color: #e15f11;border: 1px solid #e15f11;
			}
			
			#success {
				padding-top: 48px;background: #fff;padding-bottom: 10px;
			}
			#col-content p{
				font-size:13px;color:rgb(85,85,85);
			}
			#col-content span{
				color: rgb(240,93,0);
			}
			#col-img img{
				width:70px; height: 70px;margin-top: 22px;animation: shake 2s;animation-delay: 2px;
			}
			@keyframes shake{ 
				10%{
					transform: translate(0px,-3px);
				}
				30%{
					transform: translate(0px,7px);
				}
				50%{
					transform: translate(0px,-3px);
				}
				70%{
					transform: translate(0px,7px);
				}
				90%{
					transform: translate(0px,-3px);
				}
			}
			/*猜你喜欢*/
			
			#guess-like {
				height: 50px;line-height: 50px;font-size: 15px;text-align: center;position: relative;color: #555;
			}
			#guess-like img{
				width:15px;height:15px;transform: rotate(180deg);
			}
			
			#guess-like .span-1 {
				border-top: 1px solid;width: 36%;display: inline-block;position: absolute;left: 0;top: 25px;border-top-color: rgb(190,190,190);
			}
			
			#guess-like .span-2 {
				border-top: 1px solid;width: 36%;display: inline-block;position: absolute;right: 0;top: 25px;border-top-color: rgb(190,190,190);
			}
			
			.am-avg-sm-2 > li{
				margin: 7px 1px 0px 4px;
			}
			#like-1 ul li{
				background-color:white;padding:5px;
			}
			#you-like {
				width: 100%;height: 50px;
			}
			/*产品标题*/
			
			#like-1 .title {
				font-size: 14px;color: black;line-height: 17px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;
			}
			/*产品价格*/
			
			#like-1 .price {
				line-height: 30px;
			}
			
			#item-money {
				width: 50%;float: left;height: 102px;
			}
			
			#item-money p span {
				color: #e15f11;font-size: 15px;
			}
			
		</style>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	</head>
	<body>
	
		<div class="topnav">
			<a href="<?php echo U('User/index',array('shares'=>$info['id']));?>"  class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			订单支付成功
		</div>
		
		<div id="success">
			<div style="overflow:hidden;margin-top:15px;">
				<div id="col-img" style="width:50%;float:left;">
					<img src="../Style/index-images/succ.png" alt="支付成功"/>
				</div>
				<div id="item-money">
					<div style="height:46px;margin-top:22px;font-size:14px;">
						<p style="margin-bottom:5px; margin-left: -15px;">卖家店铺：<span style="font-size: 14px;"><?php echo ($shop_name["merchant"]); echo ($uid); ?></span></p>
						<p style="font-size: 14px;margin-left: -15px;">订单金额：<span>￥<?php echo ($order_info["order_sumPrice"]); ?></span></p>
					</div>
				</div>
			</div>
			<br />
			<div id="btn">
				<a href="<?php echo U('Order/checkOrder',array('orderId'=>$order_info['orderId']));?>">查看订单</a>
				<a href="<?php echo U('Index/index',array('shares'=>$info['id']));?>">返回首页</a>
			</div>
			</br>
			
			<?php if(($order_info["order_sumPrice"] >= 99) and ($uid == 4)): ?><div id="col-content">
				<p><span>温馨提示：</span>恭喜您已购满99元，可以申请成为商城经纪人，拥有一家自己的线上商城。<span style="color: rgb(240,93,0); text-decoration: underline;" onclick="location.href='<?php echo ($url); ?>'">去成为经纪人吧>></span></p>
			</div>
			<?php else: ?>
			<div id="col-content">
				<p><span>温馨提示：</span>团洋范海外购物平台不会以订单异常、系统升级为由要求你点击任何网址链接进行退款操作。</p>
			</div><?php endif; ?>
			<?php if($lb == 1): ?><div style="padding: 10px;">
				<p style="color: rgb(240,93,0); text-align: left;">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;亲爱的范团，凡是购买新年礼包的，可以添加自己想对家人或者亲人朋友说祝福语，
					还可以上传图片和视频来表达您的祝福，我们会将祝福和礼包一起送到~<span style="color: rgb(85,85,85);">（点击“添加祝福”图标进入祝福通道）</span>
				</p>
				<p style="text-align: center;"><img src="../Style/index-images/activity/up.png" alt="添加祝福"  onclick="location.href='<?php echo U('Blessing/write_blessing',array('phone'=>$order_info['mobile'],'orderId'=>$order_info['orderId']));?>'" style="width: 68px; margin-top: 0px;"/></p>
			</div><?php endif; ?>
		</div>
		
		<!--猜你喜欢-->
		<div id="you-like">
			<p id="guess-like">
				<span class="span-1"></span>&nbsp;
				<img src="../Style/index-images/top.png"/>&nbsp;为您推荐&nbsp;
				<span class="span-2"></span>
			</p>
		</div>
		<!-- 为你推荐 -->
		<div id="like-1" style="margin-top: -10px;">
			<ul class="am-avg-sm-2 am-thumbnails" >
				<?php if(is_array($itemsbuy)): $i = 0; $__LIST__ = $itemsbuy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<a href="<?php echo U('Item/index',array('id'=>$vo['id'],'shares'=>$info['id']));?>">
							<img class="am-thumbnail" src="data/upload/item/<?php echo ($vo["img"]); ?>" />
							<p class="title"><?php echo ($vo["title"]); ?></p>
							<p class="price"><span style="color: black;">优品价：</span><span style="color: rgb(240,93,0); font-size: 15px;">￥<?php echo ($vo["price"]); ?></span></p>
							<p class="price"><b><?php echo ($vo["buy_num"]); ?></b>人已购买</p>
						</a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
		<div id="mcover" onclick="document.getElementById('mcover').style.display='';" style="display:none;">
			<img src="../Style/images/guide.png" />
		</div>
		
		<button type="button" id="give_redbag" class="am-btn am-btn-primary" style="display:none" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 400, height: 225}">
  			弹框
		</button>
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
		  	<div class="am-modal-dialog" style="background: none;">
			    <div class="am-modal-hd">
			    </div>
			    <div class="am-modal-bd" style="position: relative; left: 0px;">
			      	<img src="../Style/index-images/activity/libao-d.png" alt="弹框背景" class="am-img-responsive"/>
			      	<img src="../Style/index-images/activity/activity-close.png" alt="关闭按钮" data-am-modal-close style="width: 27px;position: absolute; right: 60px; top: -40px;"/>
			      	<p style="width: 220px;color: rgb(227,255,1); position: absolute; left: 51%; top: 17px; margin-left: -110px; font-size: 16px; text-align: center;">恭喜您获得公益红包</p>
		      		<p style="width: 230px;position: absolute; left: 50%; top: 52px; margin-left: -110px; font-size: 14px; text-align: center;">
		      			感谢您为公益做出的一份贡献。团洋范送给你一个“公益红包”，可到“我的-用户中心”查看！
		      		</p>
		      		
			    </div>
		  	</div>
		</div>
		<script type="text/javascript">
			$(function(){
				give_redbag = <?php echo ($give_redbag); ?>;
				if(give_redbag==1){
				
					$("#give_redbag").click();//弹出红包
				}
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