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




		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<style type="text/css">
			* {
				font-family: "微软雅黑";
			}
			
			.topnav {
				z-index: 999;
				position: fixed;
				width: 100%;
				height: 49px;
				background: rgb(240, 93, 0);
				text-align: center;
				color: #fff;
				font-size: 16px;
				line-height: 49px;
				top: 0;
			}
			#note{
				width: 300px;
				border: none; 
				outline: none; 
				border-bottom: solid 1px rgb(165,165,165);
			}
			/*模态框*/
			.modal {position: fixed;left: 0;right: 0;top: 0;bottom: 0;background: rgba(0, 0, 0, 0.46);;z-index: 9999;}
			.modal-dialog {width:74%;margin:140px auto 0 auto;}
			.modal-content {background:#fff;}
			.modal-content p{height:40px;background:#e15f11;color: #fff;font-size:16px;text-align:center;line-height: 40px;}
			#success{height:182px;padding-top:24px;background:#fff;}	
			#item-money{width:60%;float:left;height:72px;font-size: 13px;}
			#item-money p span{color:#e15f11;font-size: 13px;}
			#col-img{text-align: center;width:40%;float:left;}
			#col-content{text-align: center; font-size: 13px; margin:0 10px;text-align:left;color:#555;}
			#buttons{width:100%;}
			#buttons a{text-align:center;width:50%;float:left;font-size:14px;border: none;height:44px;line-height:44px;border-top:1px solid #eee;}
			
			/*美化下拉框*/
			#select{line-height: 15px;-webkit-appearance:none;appearance:none;border:none; border-bottom:solid 1px rgb(240,93,0);background:#fff;color:#333333;border-radius:4px; outline: none;}	
			/*优惠券*/
			.zhang{
				color: rgb(240,93,0);font-size: 15px;
			}
			#my-popup{                     /*选择优惠券弹出框*/
				width: 90%;height: 350px;text-align: center;position: fixed; left: 50%; margin-left:-45%; top: 60px;
			}
			.am-popup-bd{
				padding: 5px;
			}
			.am-checkbox, .am-radio, .am-checkbox-inline, .am-radio-inline{
				font-size: 12px;
			}
			dt{
				font-weight: 400;
			}
			#all{
				border: dashed 1px rgb(170,170,170); background-color: white; position: relative; left: 0;
			}
			#wei-left{
				float: left;width: 30%;height: 99px;color: white;padding: 5px 0px 0px 10px;text-align:left;
			}
			#wei-right .info,#wei-right .time{
				color: rgb(85,85,85);
			}
			#wei-left .you{
			}
			#wei-left .num{
				width: 65%; margin: 0 auto ;text-align: center;padding: 5px 0px 2px 0px;  border-bottom: solid 1px white;
			}
			#wei-left .wei{
				text-align: center; padding: 3px 0px 3px 0px;font-size: 12px;
			}
			#wei-right .un-line{
				width: 100px; height: 4px; margin-top: -10px;
			}
			#wei-right{
				width:68%;height: 80px;float: left;text-align: center;position: relative;left: 0;
			}
			#wei-right .you1{
				text-align: center; padding: 10px 0px 0px 0px; font-size: 14px;
			}
			#wei-right .con{
				margin-top: -5px; text-align: center; font-size: 14px;
			}
			#wei-right .doted{
				margin-top: 10px;
			}
			#detail1 .time{
				float: right; margin-right: 1px;
			}
			/*折叠面板样式调整*/
			.am-accordion-gapped .am-accordion-title:after{
				top: 65%;
			}
			.am-accordion-gapped .am-accordion-title:after{
				position: static;font-size: 16px;margin-left: 0px;margin-top: 0px;
			}	
			.am-accordion-gapped .am-accordion-title:after{
				margin-left: 2px;
			}
			/*优惠券的关闭按钮 */
			.am-close{
				opacity: 0.8;
				font-size: 24px;
			}
			/*单选按钮的调整*/
			.am-popup-bd .am-ucheck-icons{
				margin-top: 45px;
			}
			
			/*其他优惠券和通用优惠券的分界线*/
			#guess-like {
			 	height: 50px;line-height: 50px;font-size: 15px;text-align: center;position: relative;color: #555;
        	}
       		 #guess-like .span-1,#guess-like .span-2 {
            border-top: 1px solid rgb(190,190,190);width: 35%;position: absolute;top: 25px;
        	}
        	#guess-like .span-1{
           		left: 0px;
        	}
        	#guess-like .span-2{
            	right: 0px;
        	}
        	
        	/*选择地址和身份证*/
        	#choose-ad,#choose-id{
        		width: 100%; background-color: white; color: black; margin-top: 5px; border: none;
        	}
        	#choose-ad p,#choose-id p{
        		font-size: 13px; color: rgb(85,85,85); text-align: left;
        	}
        	.ch-title{
        		height: 40px;background-color: white;line-height: 40px; font-size: 15px;border-bottom: solid 1px rgb(222,222,222); color: #555;
        	}
        	.am-modal-actions-header{
					height: 50px;padding: 5px;font-size: 12px;
			}
			#my-actions .am-radio .am-icon-checked:before, .am-radio-inline .am-icon-checked:before{
				    content: "\f046";
			}
			#my-actionss .am-radio .am-icon-checked:before, .am-radio-inline .am-icon-checked:before{
				    content: "\f046";
			}
		</style>
	</head>

	<body>
		<div class="topnav">
			支付中心
		</div>

		<form action="<?php echo U('Order/end');?>" method="POST" id="goto_pay">
			<input type="hidden" name="orderid" value="<?php echo ($orderid); ?>" /><!-- id -->
			<input type="hidden" name="dingdanhao" value="<?php echo ($dingdanhao); ?>" /><!-- 订单号 -->
			<div class="diangdangpagezhuangtai" style="margin-top: 50px; border-top: none; font-size: 13px;"><i class="am-icon-file-text-o"></i>&nbsp;订单号：<?php echo ($dingdanhao); ?></div>

			<div class="dingdangbj" <?php if($_GET['orderId'] != ''): ?>data-am-modal="{target: '#my-actions'}"<?php endif; ?> onclick="return true">
				<div class="am-g am-g dingdang">
					<div class="am-u-sm-1 dingdandizhileft"><img src="../Style/images/pic16.png"></div>
					<div class="am-u-sm-11 dingdandizhimiddle">
						<P><span><?php echo substr_replace($orderaddr['mobile'],'****',3,4); ?></span>收货人：<?php echo ($orderaddr["address_name"]); ?></P>
						<p style="color:#666;">收货地址：<?php echo ($orderaddr["address"]); ?></p>
					</div>
				</div>
			</div>

			<div class="dingdangdian" style="margin-top: 10px;">
				<ul>
					<?php if(is_array($orderinfo)): $i = 0; $__LIST__ = $orderinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="am-g am-g-fixed">
								<div class="am-u-sm-12 dianming">
									<a href="#"><img src="../Style/images/pic15.png">商家：<?php echo ($vo["0"]); ?></a>
								</div>
								<div class="am-u-sm-12">
									<div class="am-list-news-bd">
										<ul class="am-list">

											<?php if(is_array($vo["goods"])): $i = 0; $__LIST__ = $vo["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left" style="width:99%;padding:0;">
													<a href="javascript:;">
														<div class="am-u-sm-3 am-list-thumb dianproimg"><img src="<?php echo attach(get_thumb($vo2['img'], '_m'), 'item');?>"></div>

														<div class=" am-u-sm-9 am-list-main" style="width:70%;">
															<table class="am-table am-table-bordered am-table-striped am-table-compact dianprotablezi">
																<tbody>
																	<tr>
																		<td><?php echo ($vo2["title"]); ?></td>
																		<td><span style="color:#e26000; font-family:'微软雅黑'; font-size:14px;">¥<?php echo ($vo2["price"]); ?></span></td>
																	</tr>
																	<tr>
																		<td colspan="2">
																			商品类型：
																			<?php if($vo2["itemtype"] == 1): ?>完税商品
																				<?php else: ?>保税商品<?php endif; ?><br/>
																			<?php if($vo2["size"] != ''): ?>商品规格：<span style="color:#e26000; font-family:'微软雅黑'; font-size:12px;"><?php echo ($vo2["size"]); ?></span><br/><?php endif; ?>
																			购买数量：x<?php echo ($vo2["quantity"]); ?></td>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</a>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>

										</ul>
									</div>
								</div>
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>

			<div class="am-g diangdangpageliuyan">
				<div class="am-u-sm-2">留言：<input type="text" id="note" name="postscript" placeholder="您的留言...">

				</div>
				<div class="am-u-sm-10"><?php echo ($orderaddr["note"]); ?></div>
			</div>

			<div class="am-g am-g-fixed dingdangpagezhifu">
				<div class="am-u-sm-12">
					<div class="am-g dingdangpagezhifuzi">
						<div class="am-u-sm-4 " style="font-size: 13px;">&nbsp;<i class="am-icon-cny"></i>&nbsp;&nbsp;支付方式</div>
						<div class="am-u-sm-8 dingdangpagezhifuzi2" style="line-height:25px;">
							<?php if($wxpaystatus == 1): ?><input id="payment_wxpay" name="payment_id" value="3" checked type="hidden" style="position: absolute;right: 34%;top: 16%;">
								<img src="../Style/index-images/weixin.png" width="20" height="20"><span>微信支付</span><?php endif; ?>
							</dl>
						</div>

					</div>
				</div>
				<div class="am-u-sm-12 dingdangpeisong">
					<P style="font-size: 13px;"><i class="am-icon-truck"></i>&nbsp;配送方式</P>
					<?php if($pointitem["is_fictitious"] == 1): ?><input type="radio" name="freetype" value="0" data-am-ucheck checked id="select_def">
						<input type="hidden" name="is_yunfei" value="0" />
						您购买的商品(<?php echo ($pointitem["title"]); ?>)，为虚拟商品，无需快递费用，购买成功后，后台将自动充值到“我的范票”，请注意查看 :)
						<?php else: ?>
						<input type="hidden" name="is_yunfei" value="1" />
						<label class="am-radio">
	      				<input type="radio" name="freetype" value="0" data-am-ucheck checked id="select_def">
	      					<span style="font-size: 12px;">由商家选择合作快递为您配送<span>
						</label>
						<!--
						<label class="am-radio">
							<input type="radio" name="freetype" value="10" data-am-ucheck id="sf">
								<span style="font-size: 12px;">顺丰速运 (10元)<span>
						</label>
						--><?php endif; ?>
					
					<?php if(date('H') > 16): ?><p>
							<span style="color:#ff0000;font-weight:bold;">亲爱的饭团：</span>下午16：00点前的订单当天发货，下午16：00点之后的订单第二天发货哦，祝您购物愉快！
						</p><?php endif; ?>
				</div>
				
				<?php switch($orders["is_fping"]): case "0": ?><div class="am-u-sm-12 dingdangpeisong" style="border-top:1px solid #dcdcdc;">
					<P style="font-size: 13px;"><i class="am-icon-money"></i>&nbsp;使用范票/抵用</P>
					<?php if($point < 100): ?>账户共有<?php echo ($point); ?>张范票，不符合范票<a href="<?php echo U('User/rule');?>" style="color:#222;font-weight:bold;">使用规则</a>，无法使用
						<?php else: ?>
						<?php if($userfreeze["is_freeze"] == 1): ?><p style="font-weight:bold;">
									<span style="color:#ff0000;">警告：</span>您的账户存在风险行为，范票账户目前已被冻结，无法使用范票抵扣，如有疑问请联系客服！
								</p>
							<?php else: ?>
								<p>账户共有<?php echo ($point); ?>张范票，本次使用
									<select id="select" name="point">
										<option value="0">0张</option>
											<?php if(is_array($point_yuer)): $i = 0; $__LIST__ = $point_yuer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$point_yuer): $mod = ($i % 2 );++$i;?><option value="<?php echo ($point_yuer); ?>"><?php echo ($point_yuer); ?>张</option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
									<i class="am-icon-caret-down"></i>
									&nbsp;抵扣:<span style="color:rgb(240,93,0);"><b>￥<span id="equ">0</span>元</b></span>
								</p><?php endif; endif; ?>
				</div>
				<!--优惠券-->
				<div class="am-u-sm-12 dingdangpeisong" style="border-top:1px solid #dcdcdc;">
					<P style="font-size: 13px;"><i class="am-icon-credit-card"></i>&nbsp;使用优惠券/抵用</P>
						您可使用的优惠券&nbsp;<span class="zhang"><?php echo ($count); ?></span>&nbsp;张 
					<button type="button" class="am-btn am-btn-danger" data-am-modal="{target: '#my-popup'}" style="padding: 0px 8px 0px 8px;font-size: 12px;<?php if($count <= 0): ?>display:none<?php endif; ?>"> 您选择了<span id="youhuijuan">0</span>元 , 点击选择</button>
					</br>
					<span>提示：使用兑换券时不能范票抵扣，优惠活动与通用现金券以外的券不能叠加！</span>
					<div class="am-popup" id="my-popup">
						<div class="am-popup-inner">
						    <div class="am-popup-hd" style="z-index: 1000;">
						      	<h4 class="am-popup-title">选择优惠券</h4>
						      	<span data-am-modal-close class="am-close">&times;</span>
						    </div>
						    <div class="am-popup-bd">
								<dl>
									<p style="color: #555; text-align:left;">提示：若您有通用现金券，可与其他券叠加使用（限一张）！</p>
									
																	
									<p id="guess-like">
        								<span class="span-1"></span>
        									现金券&nbsp;<i class="am-icon-hand-o-down"></i>
       		 							<span class="span-2"></span>
    								</p>

									<label class="am-radio am-warning" style="height: 99px; line-height: 99px; margin-top: -5px;">
											<input type="radio" name="cpup" value="0" data-am-ucheck checked>
											<div style="background-color: white; height: 100%; border: dashed 1px rgb(170,170,170); font-size: 14px;">暂不使用</div>
									</label>
									<?php if(is_array($coupon3)): $i = 0; $__LIST__ = $coupon3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dt>
											<label class="am-radio am-warning">
												<input type="radio" name="cpup" value="<?php echo ($vol["disPrice"]); ?>-<?php echo ($vol["ucId"]); ?>-<?php echo ($vol["kind"]); ?>" data-am-ucheck>
												<div id="all">
													<?php if($vol["etime"] < $time): ?><img src="../Style/index-images/kuaidaoqi.png" alt="快到期" style="width:45px;height:45px;position:absolute;right:0;top:0;"/><?php endif; ?>
													<div id="wei-left" style="background: url(../Style/index-images/lan.png);background-size: cover;">
					  									<p class="you">现金券</p>
					  									<p class="num"><span style="font-size: 14px;">￥</span><span style="font-size: 30px;"><?php echo ($vol["disPrice"]); ?></span></p>
					  									<?php if($vol["kind"] == 3): ?><p class="wei"><?php echo ($vol["exchangeCond"]); ?>范票兑换</p><?php endif; ?>
													</div>
													<div id="wei-right">
														<p class="you1"><?php echo ($vol["title"]); ?></p>
														<p><img src="../Style/index-images/line-1.png" alt="线" class="un-line"/></p>
														<p class="con">全场通用</p>
														<img src="../Style/index-images/dain.jpg" alt="点" class="am-img-responsive doted"/>
													</div>
													<div style="clear: both;"></div> 
													<div id="detail1" style="margin-top: -30px;" >
														<section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{  }' style="width: 100%; margin: 0 auto;">
														      <dl class="am-accordion-item am-active" style="width: 100%;text-align: left; margin-bottom: 0px; border-bottom: none; border-top: dashed 2px rgba(240,93,0,0);">
														        <dt class="am-accordion-title" style="background-color: rgba(255,255,255,0); padding: 0px 0px 0px 30%;">
														         	<span style="color: rgb(85,85,85);">详细信息</span>
														         	<span class="time" style="color: rgb(85,85,85);">到期日期:<?php echo (date("Y-m-d",$vol["etime"])); ?></span>
														        </dt>
														        <dd class="am-accordion-bd am-collapse">
														           	<p style="padding: 5px; color: rgb(85,85,85);">
														           		<?php echo ($vol["desc"]); ?>
														           	</p>
														        </dd>
														      </dl>
														</section>
													</div> 								
												</div>
											</label>
										</dt><?php endforeach; endif; else: echo "" ;endif; ?>
									
									<p id="guess-like">
        								<span class="span-1"></span>
        									其他券&nbsp;<i class="am-icon-hand-o-down"></i>
       		 							<span class="span-2"></span>
    								</p>
									<label class="am-radio am-secondary" style="height: 99px; line-height: 99px; margin-top: -5px;">
										<input type="radio" name="radio3" value="0" data-am-ucheck checked>
										<div style="background-color: white; height: 100%; border: dashed 1px rgb(170,170,170); font-size: 14px;">暂不使用</div>
									</label>
									<?php if(is_array($coupon)): $i = 0; $__LIST__ = $coupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dt>
											<label class="am-radio am-secondary">
												<input type="radio" name="radio3" value="<?php echo ($vol["disPrice"]); ?>-<?php echo ($vol["ucId"]); ?>-<?php echo ($vol["kind"]); ?>" data-am-ucheck>
												<div id="all">
													<?php if($vol["etime"] < $time): ?><img src="../Style/index-images/kuaidaoqi.png" alt="快到期" style="width:45px;height:45px;position:absolute;right:0;top:0;"/><?php endif; ?>
													<div id="wei-left" style="background: url(../Style/index-images/<?php if($vol["kind"] == 4): ?>pink<?php endif; if($vol["kind"] == 1): ?>lan<?php endif; if($vol["kind"] == 2): ?>green<?php endif; if($vol["kind"] == 3): ?>yellow<?php endif; ?>.png);background-size: cover;">
																	   <?php if($vol["kind"] == 2): ?>品类券<?php endif; ?>
																	   <?php if($vol["kind"] == 1): ?>通用券<?php endif; ?>
																	   <?php if($vol["kind"] == 3): ?>兑换券<?php endif; ?>
																	   <?php if($vol["kind"] == 4): ?>新人券<?php endif; ?>
														</p>
					  									<p class="num"><span style="font-size: 14px;">￥</span><span style="font-size: 30px;"><?php echo ($vol["disPrice"]); ?></span></p>
					  									<?php if($vol["kind"] == 3): ?><p class="wei"><?php echo ($vol["exchangeCond"]); ?>范票兑换</p><?php endif; ?>
													</div>
													<div id="wei-right">
														<p class="you1"><?php echo ($vol["title"]); ?></p>
														<p><img src="../Style/index-images/line-1.png" alt="线" class="un-line"/></p>
														<p class="con">满<?php echo ($vol["condition"]); ?>元可用</p>
														<img src="../Style/index-images/dain.jpg" alt="点" class="am-img-responsive doted"/>
													</div>
													<div style="clear: both;"></div> 
													<div id="detail1" style="margin-top: -30px;" >
														<section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{  }' style="width: 100%; margin: 0 auto;">
														      <dl class="am-accordion-item am-active" style="width: 100%;text-align: left; margin-bottom: 0px; border-bottom: none; border-top: dashed 2px rgba(240,93,0,0);">
														        <dt class="am-accordion-title" style="background-color: rgba(255,255,255,0); padding: 0px 0px 0px 30%;">
														         	<span style="color: rgb(85,85,85);">详细信息</span>
														         	<span class="time" style="color: rgb(85,85,85);">截止日期:<?php echo (date("Y-m-d",$vol["etime"])); ?></span>
														        </dt>
														        <dd class="am-accordion-bd am-collapse">
														           	<p style="padding: 5px; color: rgb(85,85,85);">
														           		<?php echo ($vol["desc"]); ?>
														           	</p>
														        </dd>
														      </dl>
														</section>
													</div> 								
												</div>
											</label>
										</dt><?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</dl>
						    </div>
						</div>
					</div><?php break; endswitch;?>
				</div>
			</div>
				<input type="hidden" name="ucId" value="" >
				<input type="hidden" name="coup" value="" >
			<!--身份证选择-->
			
			<button id="choose-id" style="display:none;" type="button" class="am-btn am-btn-secondary" data-am-modal="{target: '#my-actionss'}">
				<p>选择身份证<i class="am-icon-angle-right" style="float: right; color: rgb(196,196,196);"></i></p>
			</button>
			

			<!--地址选择弹框-->
			<div class="am-modal-actions" id="my-actions">
				<div class="am-modal-actions-group" style="border: solid 1px white;">
					<p class="ch-title">选择收货地址&nbsp;<i class="am-icon-map-marker"></i></p>
			    	<ul class="am-list" style="min-height: 50px ;max-height: 142px; overflow-y: scroll;">
						<?php if(is_array($address_list2)): $i = 0; $__LIST__ = $address_list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li class="am-modal-actions-header">
			      			<div class="am-g">
  								<div class="am-u-sm-12">
  									<label class="am-radio" style="position: relative; left: 0px;">
										<?php switch($vo2["id"]): case $orders["address_id"]: ?><input type="radio" name="radio1" onclick="save_address(<?php echo ($vo2["id"]); ?>,'<?php echo ($_GET['orderId']); ?>')" data-am-ucheck checked="checked" /><?php break;?>
											<?php default: ?>
											<input type="radio" name="radio1" onclick="save_address(<?php echo ($vo2["id"]); ?>,'<?php echo ($_GET['orderId']); ?>')" data-am-ucheck  /><?php endswitch;?>
      									<p style="text-align: left; position: absolute; left: 30px; top: -9px; color: rgb(125,125,125);"><?php echo ($vo2["sheng"]); echo ($vo2["shi"]); echo ($vo2["qu"]); echo ($vo2["towns"]); ?></p>
      									<p style="text-align: left; white-space: normal; position: absolute; left: 30px; top: 10px; color: rgb(125,125,125);"><?php echo ($vo2["address"]); ?></p>
    								</label>
  								</div>
							</div>
			      		</li><?php endforeach; endif; else: echo "" ;endif; ?>
			    	</ul>
			    	<p onclick="window.location.href='<?php echo U('User/addaddress');?>'" style="height: 30px;line-height: 30px;background-color: white; border-top: solid 1px rgb(222,222,222); text-align: right; padding-right: 20px; color: #555;">添加新的地址&nbsp;<i class="am-icon-plus-square"></i></p>
				</div>
			    <div class="am-modal-actions-group">
			    	<button class="am-btn am-btn-secondary am-btn-block" data-am-modal-close style="background-color: rgb(240,93,0); border: none;">取&nbsp;消</button>
			  	</div>
			</div>
			<!--身份证选择弹框-->
			<div class="am-modal-actions" id="my-actionss">
				<div class="am-modal-actions-group" style="border: solid 1px white;">
					<p class="ch-title">选择身份证&nbsp;<i class="am-icon-cc-paypal"></i></p>
			    	<ul class="am-list" style="min-height: 50px ;max-height: 142px; overflow-y: scroll; ">
					<?php if(is_array($cards)): $i = 0; $__LIST__ = $cards;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$card): $mod = ($i % 2 );++$i;?><li class="am-modal-actions-header">
			      			<div class="am-g">
  								<div class="am-u-sm-12">
  									<label class="am-radio" style="position: relative; left: 0px;">
      									<input type="radio" name="radio1" onclick="save_carid(<?php echo ($card["Id"]); ?>,'<?php echo ($_GET['orderId']); ?>')" data-am-ucheck>
      									<p style="text-align: left; position: absolute; left: 40px; top: -9px; color: rgb(125,125,125);"><?php echo ($card["c_name"]); ?></p>
      									<p style="text-align: left; white-space: normal; position: absolute; left: 40px; top: 10px; color: rgb(125,125,125);"><?php echo strlen($card['c_id'])==15?substr_replace($card['c_id'],"****",8,4):(strlen($card['c_id'])==18?substr_replace($card['c_id'],"****",10,4):"身份证位数不正常！"); ?></p>
    								</label>
  								</div>
							</div>
			      		</li><?php endforeach; endif; else: echo "" ;endif; ?>
			    	</ul>
			    	<p onclick="window.location.href='<?php echo U('User/addid');?>'" style="height: 30px;line-height: 30px;background-color: white; border-top: solid 1px rgb(222,222,222); text-align: right; padding-right: 20px; color: #555;">添加新的身份证&nbsp;<i class="am-icon-plus-square"></i></p>
				</div>
			    <div class="am-modal-actions-group">
			    	<button class="am-btn am-btn-secondary am-btn-block" data-am-modal-close style="background-color: rgb(240,93,0); border: none;">取&nbsp;消</button>
			  	</div>
			</div>
			
			<!-- 确认支付 -->
			<div class="am-g am-g-fixed dingdanjiashu" style="padding:0;">
				<div class="am-u-sm-9 dingdangyinfukuan"><span>应付款：￥<span class="price" id="price"><?php echo ($order_sumPrice); ?></span>
				<span><?php if($orderinfo[0][yunfei] > 0): ?>(含运费：￥<?php echo ($orderinfo[0][yunfei]); ?>)<?php else: endif; ?></span></span></div>
				<div class="am-u-sm-3 dingdangyinfukuanon" style="background-color:#e15f11;color:#fff;">
					<?php if($orders_detail["itemtype"] == 0 AND $orders_detail["idcname"] == '' AND $orders_detail["idcnum"] == ''): ?><a href="javascript:;" onclick="carid_out()" style="color:white;">确认支付</a>
						<?php else: ?>
						<a href="javascript:$('#goto_pay').submit();" style="color:white;">确认支付</a><?php endif; ?>
				</div>
			</div>
		</form>
		
		<script>
			$('#layer_close').click(function(){
					$('.modal').fadeOut(500);
			});
		</script>
	<script type="text/javascript">
			var x=0;
			var y=0;
			var z=0;
			var q=0;
			function js(){
				var price=parseFloat($('#price').text()); 
				var add1=parseInt($('input[name=freetype]:checked').val());    //获取运费的值
				var minu=parseInt($('#select option:selected').val())*0.01;    //获取下拉框积分的值
				var youhui=$("input:radio[name='radio3']:checked").val();   //获取优惠券的值
				var youhui2=$("input:radio[name='cpup']:checked").val();   //获取优惠券的值
				
				var arr = youhui.split('-');
				var discount=parseInt(arr[0]);
				
				var arr2 = youhui2.split('-');
				var discount2=parseInt(arr2[0]);
				
				var len=$("#select option").length;
				if(len<=1)
				{
					$('#price').text((price+add1-discount-discount2-x+y+z+q).toFixed(2));            //改变价格
					$("#youhuijuan").text(discount+discount2);
					x=add1;
					z=discount;
					q=discount2;
					price=price+add1-discount-discount2-x+y+z+q;
				}
				if(len>=2)
				{
					if(arr[2]==3){
						alert('您在选择兑换券的同时不能使用范票抵扣');
						$("#equ").text(0); 
						$('#select option:eq(0)').attr('selected','selected');
						$('#price').text((price+add1-discount-discount2-x+y+z+q).toFixed(2));            //改变价格
						$("#youhuijuan").text(discount+discount2);
						x=add1;
						y=0;
						z=discount;
						q=discount2;
					}else{
						$("#equ").text(minu);  
						$('#price').text((price+add1-minu-discount-discount2-x+y+z+q).toFixed(2));            //改变价格
						$("#youhuijuan").text(discount+discount2);
						x=add1;                                                     
						y=minu;
						z=discount;
						q=discount2;
					}
					
				}
				$('input[name=ucId]').val(arr[1]);
				$('input[name=coup]').val(arr2[1]);
				
			}			
			$('input[name=freetype]').on('change',js);                        //触发运费
			$('#select').on('change',js);									  //触发下拉框
			$('input[name=radio3]').on('change',js);                 	  //优惠券
			$('input[name=cpup]').on('change',js);                 	  //优惠券
			
			//保存地址信息
			function save_address(id,orderId){
				$.post('<?php echo U('Order/save_address');?>',{'id':id,'orderId':orderId},function(res){
						var data = eval("("+res+")");
						if(data.status == 1){
							layer.open({
								content: '地址已成功保存'
								,skin: 'msg'
								,time: 3 //2秒后自动关闭
							});
							window.location.reload()
						}else{
							layer.open({
								content: '您已保存过该地址，请更换其他地址'
								,skin: 'msg'
								,time: 3 //2秒后自动关闭
							});
							window.location.reload()
						}
				});
			}
			
			//保存身份证信息
			function save_carid(id,orderId){
				$.post('<?php echo U('Order/save_carid');?>',{'id':id,'orderId':orderId},function(res){
						var data = eval("("+res+")");
						if(data.status == 1){
							layer.open({
								content: '身份证信息已成功保存'
								,skin: 'msg'
								,time: 3 //2秒后自动关闭
							});
							window.location.reload()
						}else{
							layer.open({
								content: '您已保存过该身份证'
								,skin: 'msg'
								,time: 3 //2秒后自动关闭
							});
							window.location.reload()
						}
				});
			}
			//弹出身份证
			function carid_out(){
				$('#choose-id').click();
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