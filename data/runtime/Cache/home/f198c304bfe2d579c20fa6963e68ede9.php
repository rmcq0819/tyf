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




		<!--<link rel="stylesheet" type="text/css" href="../Style/jquery.css">-->
		<!--<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>-->
		<!--<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js"></script>-->
		<!--<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js"></script>-->
		<!--<script charset="utf-8" type="text/javascript" src="__STATIC__/weixin/js/zh-CN.js"></script>-->
		<style>
			*{
				border: none;outline: none;font-family: "微软雅黑";
			}
			/*头部*/
			.topnav{
				height: 49px;color: white;font-size: 16px;text-align: center;line-height:49px;background-color: rgb(240,93,0);
			}
			.topnav img{
				position: absolute;left:5px;top: 14px;
			}
			/*订单*/
			
			#order ul li{
				padding: 5px;
			}
			.product-img .img{             /*产品图片大小*/
				width: 80px;height: 80px;
			}
			#free-name,#pro-num{            /*免税价和数量的颜色*/
				color:rgb(137,137,137);
			}
			#free-price,#total-price{
				font-size: 14px;
			}
			#free-price,#qing-price,#fare-price,#total-price{                 /*免税价、清关费、运费、总价颜色*/
				color: rgb(219,101,14); 
			}
			/*结算总价*/
			#account{
				float: right;margin-right: 5px;
			}
	
			/*支付按钮*/
			#btn-prices{
				float: right;margin-right:5px;margin-top: 6px;height: 25px;color: rgb(16,96,147);border: solid 1px rgb(16,96,147);background-color: white; border-radius: 3px;
			}
			#btn-prices2{
				float: right;margin-right:7px;margin-top: 6px;height: 25px;color: rgb(240,93,0);border: solid 1px rgb(240,93,0);background-color: white; border-radius: 3px;
			}
		</style>
	</head>

	<body>
		<title>订单状态列表</title>
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back"><img src="../Style/images/fanhui1.png" width="25" /></a>
			<?php if($status == 1): ?>待付款(<?php echo ($count); ?>)<?php endif; ?>
			<?php if($status == 3): ?>待收货(<?php echo ($count); ?>)<?php endif; ?>
			<?php if($status == 2): ?>待发货(<?php echo ($count2); ?>)<?php endif; ?>
		</div>
		
		<!--订单列表-->	
		<?php if(!empty($item_orders)): ?><div data-am-widget="list_news" class="am-list-news am-list-news-default" id="order">
			
			<div class="am-list-news-bd">
				<?php if(is_array($item_orders)): $i = 0; $__LIST__ = $item_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="am-list">
					
					<!--订单号-->
					<li class="am-g am-list-item-dated" class="order-number">
						<span style="font-size:13px;">订单号：<span><span><?php echo ($vo["orderId"]); ?></span>
					</li>
					<!--订单商品-->
					<?php if(is_array($vo["item"])): $i = 0; $__LIST__ = $vo["item"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li class="am-g am-list-item-dated">	
						<div class="am-g">
							<volist name="vo.item" id="vo1">
  							<div class="am-u-sm-2" class="product-img">
  								<img src="data/upload/item/<?php echo ($vo1["img"]); ?>" alt="商品" class="am-img-responsive"/>
  							</div>
  							<div class="am-u-sm-9" class="product-detail">
  								<p style="font-size:13px;"><?php echo ($vo1["title"]); ?></p>
  								<span id="free-name">优品价：</span><span id="free-price">￥<?php echo ($vo1["price"]); ?></span>&nbsp;&nbsp;<span id="pro-num">x<?php echo ($vo1["quantity"]); ?> </span>
								<?php if($vo["status"] != 1): if($vo["fahuo_time"] > $order_time or $vo1["send_time"] > $order_time): ?><span style="float:right;color:#555;margin-right:15px;">
											状态：
											<?php switch($vo1["status"]): case "1": ?>待付款<?php break;?>
												<?php case "2": ?>待发货<?php break;?>
												<?php case "3": ?>待收货<?php break; endswitch;?>
										</span><?php endif; endif; ?>
  							</div>

  							<div class="am-u-sm-1" style="line-height: 62px;">
  									<?php if($vo["status"] == 3): ?><a href="<?php echo U('Order/logistics',array('detail_id'=>$vo1['detail_id'],'status'=>$vo['status']));?>">
											<i class="am-icon-chevron-right" style="color: rgb(125,125,125);"></i></a>
											<?php else: ?>
											<a href="<?php echo U('Order/checkOrder',array('orderId'=>$vo['orderId'],'status'=>$vo['status']));?>">
											<i class="am-icon-chevron-right" style="color: rgb(125,125,125);"></i>
										</a><?php endif; ?>
  							</div>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<!--订单费用-->
					<li class="am-g am-list-item-dated">
						<p>
							<!-- <span>运费:</span><span id="fare-price" >￥<?php if($vo["totalprice"] > 99): ?>0<?php else: ?>10<?php endif; ?></span> -->
							<span id="account">
								<span>共<span class="total-num"><?php echo ($vo["count"]); ?></span>件商品</span>&nbsp;&nbsp;
								<span>合计:</span><span id="total-price">￥<?php echo ($vo["totalprice"]); ?></span>
							</span>
							<div style="clear: both;"></div>	
						</p>
						<!--支付按钮-->
						<?php if($status == 1): ?><button id="btn-prices"><span  onclick="window.location.href='<?php echo U('Order/pay',array('orderId' => $vo['orderId'],'sharesid'=>$vo['userId']));?>'">支&nbsp;&nbsp;&nbsp;&nbsp;付</span></button>
							<button id="btn-prices2"><span onclick="del('<?php echo ($vo["orderId"]); ?>');">删&nbsp;&nbsp;&nbsp;&nbsp;除</span></button><?php endif; ?>
						
						<?php if($status == 2): ?><button id="btn-prices"><span  onclick="window.location.href='<?php echo U('Order/orderTK',array('orderId'=>$vo['orderId'],'status'=>$vo['status']));?>'">申请退款</span></button>
							<button id="btn-prices2"><span onclick="do_urgent('<?php echo ($vo["orderId"]); ?>');">提醒发货</span></button><?php endif; ?>
						<?php if($status == 3): ?><button id="btn-prices" onclick="window.location.href='<?php echo U('Order/confirmOrder',array('orderId'=>$vo['orderId'],'status'=>$status));?>'">确认收货</button>
							<button id="btn-prices2"><span onclick="window.location.href='<?php echo U('Order/orderTK',array('orderId'=>$vo['orderId'],'status'=>$vo['status']));?>'">申请退款</span></button><?php endif; ?>
						<?php if($status == 6): ?><button id="btn-prices2"><span onclick="window.location.href='<?php echo U('Index/index',array('shares'=>$info['id']));?>'">去逛逛</span></button><?php endif; ?>
						<?php if($status == 4): if($vo["c_status"] == 0): ?><button id="btn-price">评&nbsp;&nbsp;&nbsp;&nbsp;价</button><?php else: ?><button id="btn-prices">已&nbsp;完&nbsp;成</button><?php endif; endif; ?>
					</li>
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<?php else: ?>
		<div style="text-align: center; margin-top: 100px;">
				<img src="../Style/index-images/tuihua.png" alt="无退还货" style="width: 120px; height: 120px;" />
				<br />
				<br />
				<p style="font-size: 14px;">暂无该类订单</p>
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
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<script>
		//删除订单
		function del(id){
			layer.open({
					title: '提示',
					content: '您确定要删除该订单吗？与之相关的保税或完税订单都会被删除',
					btn: ['确认', '取消'],
					yes: function(index){
						window.location.href= "<?php echo U('Order/delOrder');?>&orderId="+id;
						layer.open({content: '删除成功', time: 1});
						layer.close(index);
					}
			});
		}
		
		//支付订单
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