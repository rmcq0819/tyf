<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<title>用户中心</title>
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




		
		<style type="text/css">
			* {
				margin: 0;padding: 0;font-family: "微软雅黑";list-style-type: none;
			}
			.topnav {
				z-index: 999;position: fixed;width: 100%;height: 49px;background: rgb(240,93,0);text-align: center;color: #fff;font-size: 18px;line-height: 49px;top: 0;
			}
			.topnav .back {
				position: absolute;left: 8px;top: 6px;margin-top: -8px;
			}
			/*订单详情*/
			#state{
				width: 100%;height: 30px;padding: 5px;color: black;font: 13px "微软雅黑";
			}
			#state .state-type{                    /*订单状态*/
				color: rgb(240,93,0);
			}
			/*订单号*/
			#code{
				min-height: 30px;padding: 5px;font: 13px "微软雅黑";background-color: white;color:#555;line-height:30px;
			}
			#code .code-time{           /* 订单时间*/
				float: right;
				margin-right: 2px;
			}
			
			
			/****物流状态S****/	
			.demo{width:100%; margin: 0 auto; margin-top: 20px; }
			.history{background:url(../Style/index-images/line04.gif) repeat-y 107px 0;overflow:hidden;position:relative;}
			.history-date{overflow:hidden;position:relative;}
			.history-date ul li{background:url(../Style/index-images/icon07.png) no-repeat 100px 0;padding-bottom:30px;zoom:1;}
			.history-date ul li:last-child{background:url(../Style/index-images/icon07.png) no-repeat 100px 0;padding-bottom:5px;zoom:1;}
			.history-date ul li.last{padding-bottom:0;}
			.history-date ul li:after{content:" ";display:block;height:0;clear:both;visibility:hidden;}
			.history-date ul li h3{float:left;width:110px;text-align:right;padding-right:19px;color:rgb(130,130,130);font:normal 13px/16px Arial;}
			.history-date ul li h3 span{display:block;color:rgb(130,130,130);font-size:12px; text-align: center;}
			.history-date ul li dl{float:left;padding-left:30px;margin-top:-5px;font-family:微软雅黑; padding-left:20px ; width: 210px; margin-top: 0px;}
			.history-date ul li dl dt{font:16px/16px 微软雅黑;color:#737373;}
			.history-date ul li dl dt span{display:block;color:rgb(130,130,130);font-size:13px;}
			.history-date ul li:first-child dl dt span{display:block;color:rgb(240,93,0);font-size:13px;}
			.history-date ul li:first-child h3{color:#1db702;}      /*改变第一个时间颜色*/
			.history-date ul li:first-child h3 span{color:#1db702; text-align: center;}    /*改变第一个时间颜色*/
			.history-date ul li.green dl{margin-top:-2px;}
			.history-date ul li.green dl dt{font-size:16px;}
			/***物流状态E****/	
			
			
			/*产品*/
			#product{
				height: 75px; margin-top: 10px;padding: 5px;background-color: white; 
			}
			/*产品图片*/
			#product img{
				width: 60px;height: 60px;
			}
			/*结算总价*/
			#settle-price{
				background-color: white; padding: 5px; border-top: solid 1px rgb(210,210,210);
			}
			/*收货地址*/
			#addr{
				background-color: white; margin-top: 5px; min-height: 50px; font-size: 13px; color:rgb(85,85,85);
			}
		</style>
	</head>

	<body>
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			订单详情
		</div>
		<div id="state" style="margin-top: 50px;background-color: white; border-bottom: solid 1px rgb(210,210,210);"> 
			<span>状态：</span><span class="state-type">
					
					<?php if($itemorder['status'] != 4): switch($order["status"]): case "0": if($order['add_time'] > $refund_time): ?>未发货<?php else: ?>已完成<?php endif; break;?>
						<?php case "1": ?>待付款<?php break;?>
						<?php case "2": ?>待发货<?php break;?>
						<?php case "3": ?>待收货<?php break;?>
						<?php case "4": ?>已完成<?php break;?>
						<?php case "6": ?>退货中<?php break;?>
						<?php case "7": ?>退款失败<?php break;?>
						<?php case "8": ?>退款成功<?php break;?>
						<?php case "9": ?>清关中<?php break;?>
						<?php case "10": ?>异常<?php break;?>
						<?php case "11": ?>退款中<?php break; endswitch;?>
					<?php else: ?>
					已完成<?php endif; ?>
			</span>
		</div>
		<div id="code">
			<p><span class="code-num">订单号：</span><span><?php echo ($order["orderId"]); ?></span></p>
			<?php if($order["status"] > 2): ?><p>发货时间：
					<?php echo (date('Y年n月j日 H:i:s',$order["send_time"])); ?>
				</p>
				<p>物流单号：<?php echo ($order["freecode"]); ?> (<?php echo ($order["userfree"]); ?>)</p><?php endif; ?>
			<!--<p>宝贝名称：<?php echo ($order["title"]); ?></p>
			<p>宝贝规格：<?php if($order["size"] != ''): ?><span style="color:rgb(240,93,0);"><?php echo ($order["size"]); ?></span><?php else: ?>默认<?php endif; ?></p>
			<p>宝贝价格：¥<?php echo ($order["price"]); ?></p>-->
		</div>
		<!--预计到货时间-->
		<div style="background-color: white; margin-top: 5px; color: rgb(85,85,85); border-bottom: solid 1px rgb(210,210,210);">
			<p style="line-height:25px;font-size:12px;padding:5px;">
				<b >亲爱的范团：</b><br/>小范建议您：在您迫不及待签收货物时，可以和配送员当面对照发货单，核对商品是否与您购买的一致，如在检查的过程中发现问题，请您不要签收商品，并及时联系团洋范客服中心，我们会第一时间进行处理。
			</p>
		</div>
		
		<!--详情咨询-->
		<div id="ask" style="height: 32px;background-color: white; line-height: 32px; color: rgb(85,85,85);">
			<p style="padding-left: 10px;">如有疑问，您可以咨询在线客服 <a href='https://static.meiqia.com/dist/standalone.html?eid=23554&clientid=<?php echo ($server_u["id"]); ?>&metadata={"name":"<?php echo $server_u['username']; ?>","tel":"<?php echo $server_u['phone_mob']; ?>","email":"<?php echo $server_u['email']; ?>"}'>
				<button style="width: 80px;height: 20px;float: right; margin-right: 10px; margin-top: 6px; background-color: rgb(240,93,0); color: white; border: none; border-radius: 3px;"><i class="am-icon-github"></i>&nbsp;在线咨询</button></a></p>
		</div>
		<!--物流状态-->
		<div id="logistics">
			<div class="demo">
				<div class="history">
					<div class="history-date">
						<ul>
							<?php if(is_array($result["data"])): $kk = 0; $__LIST__ = $result["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?><li>
									<h3></span><?php echo ($vv["time"]); ?></span></h3>
									<dl>
										<dt><span><?php echo ($vv["context"]); ?></span></dt>
									</dl>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php if(!empty($freelist)): if(is_array($freelist)): $i = 0; $__LIST__ = $freelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
										<h3></span><?php echo ($val["free_time"]); ?></span></h3>
										<dl>
											<dt><span><?php echo ($val["free_context"]); ?></span></dt>
										</dl>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php else: ?>
								<?php if($order["status"] == 1): ?><li>
									<h3></span><?php echo (date('Y-n-j H:i:s',$order["add_time"])); ?></span></h3>
									<dl>
										<dt><span>您提交了订单，但并未付款</span></dt>
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
								
								<?php if($order["status"] == 6): ?><li>
									<h3></span><?php echo (date('Y-n-j H:i:s',$tuihuo_time)); ?></span></h3>
									<dl>
										<dt><span>您提交了退款申请，请等待处理</span></dt>
									</dl>
								</li><?php endif; ?>
								<?php if($order["status"] == 7): ?><li>
									<h3></span><?php echo (date('Y-n-j H:i:s',$tuihuo_time)); ?></span></h3>
									<dl>
										<dt><span>您的订单申请退款失败</span></dt>
									</dl>
								</li><?php endif; ?>
								<?php if($order["status"] == 8): ?><li>
									<h3></span><?php echo (date('Y-n-j H:i:s',$tuihuo_time)); ?></span></h3>
									<dl>
										<dt><span>您的订单申请退款成功</span></dt>
									</dl>
								</li><?php endif; ?>
								<?php if($order["status"] == 9): ?><li>
									<h3></span><?php echo (date('Y-n-j H:i:s',$order["qg_time"])); ?></span></h3>
									<dl>
										<dt><span>您的订单有商品正在请关，请耐心等待</span></dt>
									</dl>
								</li><?php endif; ?>
								<?php if($order["status"] == 10): ?><li>
									<h3></span><?php echo (date('Y-n-j H:i:s',$order["add_time"])); ?></span></h3>
									<dl>
										<dt><span>您的订单处于异常状态，请等待处理</span></dt>
									</dl>
								</li><?php endif; ?>
								<?php if($order["status"] == 11): ?><li>
									<h3></span><?php echo (date('Y-n-j H:i:s',$tuihuo_time)); ?></span></h3>
									<dl>
										<dt><span>您的订单退货成功，请等待退款</span></dt>
									</dl>
								</li><?php endif; endif; ?>
						</ul>
					</div>		
				</div>
			</div>	
		</div>

		<!--产品-->
		<div id="product">
			<div class="am-g">
  				<div class="am-u-sm-2" style="padding: 5px;">
  					<img src="data/upload/item/<?php echo ($order["img"]); ?>" alt="产品" class="am-img-responsive"/>
  				</div>
  				<div class="am-u-sm-8">
  					<p><?php echo ($order["title"]); ?></p>
  					<span style="color: rgb(137,137,137);">免税价：</span><span class="free-price" style="color: rgb(240,93,0); font-size: 14px;">￥<?php echo ($order["price"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="number" style="color: rgb(137,137,137);">x<?php echo ($order["quantity"]); ?></span>
  				</div>
  				<div class="am-u-sm-2" style="text-align: center ;line-height: 75px;">
  					<a href="<?php echo U('Item/index',array('id'=>$order['itemId'],'shares'=>$info['id']));?>"><i class="am-icon-chevron-right"></i></a>
  				</div>
			</div>
		</div>
		
		<!--结算总价-->
		<div id="settle-price"> 
  			<span style="font-size: 13px">&nbsp;&nbsp;运费:</span><span style="color: rgb(240,93,0); font-size: 13px;">￥<?php if(empty($order["yunfei"])): ?>0.00<?php else: echo ($order["yunfei"]); endif; ?></span>
  			<span style="float:right; color: black; font-size: 13px;">合计:<span style="color: rgb(240,93,0); font-size: 14px;">￥<?php echo ($order["order_sumPrice"]); ?></span></span>
  		</div>

  		<!--收货地址-->
  		<div id="addr">
  			<div class="am-g">
  				<div class="am-u-sm-10" style="width:100%;">
  					<p>&nbsp;&nbsp;&nbsp;&nbsp;<span class="user-name"><?php echo ($order["address_name"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="phone"><?php echo substr_replace($order['mobile'],'****',3,4); ?></span></p>
  					<p>&nbsp;&nbsp;&nbsp;&nbsp;<span class="address"><?php echo ($order["address"]); ?></span></p>
  				</div>
			</div>
  		</div>
  		<div style="width: 100%;">
  			<img src="../Style/index-images/addr-img.jpg" alt="图片" class="am-img-responsive"/>
  		</div>
		
		<?php $arr = array(0,2,3,4,9,10);?>
		<?php if($order['add_time'] > $refund_time): if(in_array($order['status'],$arr)): ?><div class="am-g am-g-fixed dingdanjiashu">
					<div class="am-u-sm-12 dingdangyinfukuanon">
						<a href="index.php?m=Order&a=orderTK&detail_id=<?php echo ($_GET['detail_id']); ?>&status=<?php echo ($_GET['status']); ?>"  style="color:#e15f11;text-align:center;font-size:14px;display: block;font-weight:bold;">申请退款</a>
					</div>
				</div><?php endif; endif; ?>
		<br/>
		<br/>
		
		<?php if($shop != 0): ?><div data-am-widget="navbar" class="am-navbar am-cf am-navbar" id="" style="background-color:white; box-shadow:20px 20px 40px black;">
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
	</body>
	
</html>