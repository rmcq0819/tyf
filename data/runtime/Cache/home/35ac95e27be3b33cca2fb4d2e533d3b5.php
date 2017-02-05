<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
			.topnav {
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;z-index: 999;background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; left:5px; top: 14px;
			}			
			/*头部*/
			
			/*选项卡*/
			.tab1{
				width:100%;margin:50px auto 0 auto;
			}
			.menu{
				width: 100%;height:28px;border-right:#cccccc solid 1px;
			}
			.menu li{
				float:left;width:33.3%;text-align:center;line-height:35px;height:35px;cursor:pointer;border-left:#cccccc solid 1px;color:#666;font-size:14px;overflow:hidden;background-color: white;
			}
			.menu li.off{
				background:#FFFFFF;color:rgb(240,93,0);
			}
			.menu li.off span{	
				padding: 0px 17px 7px 17px; border-bottom: solid 1px rgb(240,93,0);
			}
			dt{
				font-weight: 400;
			}
			#all{
				/*border: dashed 1px rgb(170,170,170); */
				background-color: white; position: relative; left: 0;
			}
			#all>img{           /*快到期*/
				width: 47px;height: 47px;position: absolute; top: 0; right: 0;
			}
			
			#wei-left{
				float: left;width: 32%;height: 110px;color: white;
			}
			#yiguo-left,#yiyong-left{
				float: left;width: 32%;height: 110px;color: white;background: url(../Style/index-images/hui.png);background-size: cover;
			}
			
			#wei-right .info,#wei-right .time,#yiyong-right .info,#yiyong-right .time{
				color: rgb(85,85,85);
			}
			#wei-left .you,#yiguo-left .you,#yiyong-left .you{
				padding: 5px 0px 0px 10px;
			}
			#wei-left .num,#yiguo-left .num,#yiyong-left .num{
				width: 65%; margin: 0 auto ;text-align: center;padding: 10px 0px 5px 0px;  border-bottom: solid 1px white;
			}
			#wei-left .wei,#yiguo-left .yiguo,#yiyong-left .yiyong{
				text-align: center; padding: 3px 0px 3px 0px;font-size: 14px;
			}
			
			#wei-right .un-line,#yiguo-right .un-line,#yiyong-right .un-line{
				width: 100px; height: 4px; margin-top: -10px;
			}
			#wei-right,#yiguo-right,#yiyong-right{
				width:68%;height: 80px;float: left;text-align: center;position: relative;left: 0;
			}
			#wei-right .you1,#yiguo-right .you1,#yiyong-right .you1{
				text-align: center; padding: 10px 0px 0px 0px; font-size: 14px;
			}
			#wei-right .con,#yiguo-right .con,#yiyong-right .con{
				margin-top: -5px; text-align: center; font-size: 14px;
			}
			#wei-right .doted,#yiguo-right .doted,#yiyong-right .doted{
				margin-top: 10px;
			}
			#detail1 .time,#detail2 .time,#detail3 .time{
				float: right; margin-right: 1px;
			}
			
			/*没有优惠券的时候*/
			.no-discount{
				text-align: center; margin-top: 160px;
			}
			.no-discount img{
				width: 120px; height: 120px;
			}
			.no-discount p{
				margin-top: 10px; font-size: 12px;
			}
			
			/*折叠面板样式调整*/
			.am-accordion-gapped .am-accordion-title:after{
				top: 65%;
			}
			.am-accordion-gapped .am-accordion-title:after{
				position: static;font-size: 16px;margin-left: 4px;margin-top: 0px;
			}
			.go,.go-2{
				height: 23px;font-size: 12px; background-color: rgb(240,93,0);color: white; border: none;
			}
			.go{
				width: 140px;float: right; margin: 5px 0px 0px 0px; border-bottom-left-radius: 4px; border-top-left-radius: 10px;
			}
			.go-2{
				width:90px;border-radius:4px; margin-top:20px;	
			}
			
			/*使用规则*/
			
			.am-modal-bd{
				height: 310px; overflow: auto; background-color: rgb(239,243,247);padding: 0px;padding-bottom: 5px;
			}
			.am-modal-bd .intro,.am-modal-bd .rule,.am-modal-bd .get{
				background-color: white; padding: 5px; text-align: left; border-bottom: solid 1px rgb(219,214,219); margin-top: 10px;
			}
			.am-modal-bd .intro .title,.am-modal-bd .rule .title,.am-modal-bd .get .title{
				font-size: 15px; color: black; border-bottom: solid 1px rgb(219,214,219); padding-top: 5px; padding-bottom: 5px;
			}
			.am-modal-bd .intro .content,.am-modal-bd .rule .content,.am-modal-bd .get .content{
				padding-top: 3px; padding-bottom: 3px; font-size: 13px;
			}
			/*弹出框关闭按钮*/
			.am-close{
				font-size: 24px;
				opacity: 0.6;
			}
			
			.from{
				text-align: right; padding-right: 0px; color:rgb(155,155,155);padding-top: 10px; line-height: 13px;
			}
			.share{
				height: 25px;background-color: rgb(240,93,0); border: none; color: white;position: fixed; top: 65%; right: 0px; padding: 2px 8px 2px 8px; border-bottom-left-radius: 5px;border-top-left-radius: 5px;
			}
			/*改变复选框的样式*/
			.am-checkbox .am-icon-checked:before, .am-checkbox-inline .am-icon-checked:before{
				content: "\f14a";
			}
		</style>
		<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
	</head>

	<body style="background:#f3f3f3;">
		<div class="topnav">
			<a href="<?php echo U('User/index');?>" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			优惠券
			<button style="position: absolute; top: 11px; right: 0; background-color: rgb(240,93,0); border: none; font-size: 13px;" type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 305, height: 350}">
  				使用规则
			</button>

		</div>
		<!--使用规则-->
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
  			<div class="am-modal-dialog">
    			<div class="am-modal-hd" style="padding: 10px; background-color: white;">
    				<span>使用规则</span>
      				<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    			</div>
    			<div class="am-modal-bd">
      				<div class="intro" style="padding: 12px;">
      					<p class="title">优惠券介绍</p>
      					<p class="content">
      						优惠券包括：通用现金券、通用满减券。设有消费限额，下单时满足使用条件可以抵扣。另外可以将优惠券分享给自己的好友或分享到朋友圈，供朋友使用。
      					</p>
      				</div>
      				<div class="rule" style="padding: 12px;">
      					<p class="title">使用规则</p>
      					<p class="content">
      						1.一张订单只能使用一张优惠券；<br/>
							2.使用优惠券券时，范票可正常抵扣；<br/>
							3.活动产品与优惠券不能叠加；<br/>
      					</p>
      				</div>
      				<div class="get" style="padding: 12px;">
      					<p class="title">获取途径</p>
      					<p class="content">
							1.新人完成店长注册，赠送一定数量优惠券；<br/>
							2.下单完成支付，赠送一定数量优惠券；<br/>
							3.通过好友的分享链接领取优惠券。<br/>
      					</p>
      				</div>
    			</div>
    			<div style="width: 100%; height: 10px; background-color: white; position: fixed; bottom: 0px; left: 0px; z-index: 10;"></div>
  			</div>
		</div>
		<div class="tab1" id="tab1" style="margin-top: 90px;margin-bottom:20px;">
			<div class="menu" style="position:fixed;top:50px; left:0px; z-index: 1000;">
				<ul>
					<li id="one1" onclick="setTab('one',1)"><span>未使用</span></li>
					<li id="one2" onclick="setTab('one',2)"><span>已过期</span></li>
					<li id="one3" onclick="setTab('one',3)"><span>已使用</span></li>
				</ul>
			</div>

			<div class="menudiv">
				
				<!--未使用的-->
				<div id="con_one_1">
					<p style="padding: 0px 8px 5px 8px; border-bottom: solid 1px rgb(220,220,220); margin-top: 94px; color: #555; line-height: 18px;height:42px;">温馨提示：未使用的优惠券可以分享啦！快来选择好券给好友吧！</p> 
					<label class="am-checkbox am-secondary" style="margin: 0px; position: absolute;right: 10px; top: 20px;color: rgb(85,85,85);">
						<input type="checkbox" id="CheckAll" data-am-ucheck>全选
					</label>
					<?php if(!empty($coupon)): if(is_array($coupon)): $i = 0; $__LIST__ = $coupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dl>
						<?php if($vol["username"] != ''): ?><p class="from">来自<span><?php echo ($vol["username"]); ?></span>的分享</p>
						<?php else: ?>
							<?php if($vol["is_prize"] == 1): ?><p class="from">来自系统赠送（注册成为店长）</p><?php endif; ?>
							<?php if($vol["is_prize"] == 2): ?><p class="from">来自公益报名奖励</p><?php endif; ?>
							<?php if($vol["is_prize"] == 3): ?><p class="from">来自公益投票奖励</p><?php endif; endif; ?>
						<dt style="padding: 5px;">
							<div id="all" style="box-shadow: 0px 1px 2px rgb(115,115,115);">
								<?php if($vol["etime"] < $time): ?><img src="../Style/index-images/kuaidaoqi.png" alt="快到期"/><?php endif; ?>
				
								<div id="wei-left" style="background: url(../Style/index-images/lan.png);background-size: cover;">
  									<p class="you"><?php if($vol["kind"] == 1): if($vol["condition"] == 0): ?>现金券<?php else: ?>通用券<?php endif; endif; ?>
									</p>
  									<p class="num"><span style="font-size: 14px;">￥</span><span style="font-size: 38px;"><?php echo ($vol["disPrice"]); ?></span></p>
								</div>
								<div id="wei-right">
									
									<p class="you1"><?php echo ($vol["title"]); ?></p>		
									<p><img src="../Style/index-images/line-1.png" alt="线" class="un-line"/></p>
									<p class="con">全场通用</p>
									<img src="../Style/index-images/dain.jpg" alt="点" class="am-img-responsive doted"/>
  									<label class="am-checkbox am-secondary" style="width: 35px;height: 43px;position: absolute; left: 84%;top: 25px;">
  										<input type="checkbox" name="share_coupon" value="<?php echo ($vol["ucId"]); ?>" data-am-ucheck>
  									</label>
								</div>
								
								<div style="clear: both;"></div>    <!--清除浮动-->
								<!--折叠面板-->
								<div id="detail1" style="margin-top: -30px;" >
									<section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{  }' style="width: 100%; margin: 0 auto;">
									      <dl class="am-accordion-item am-active" style="width: 100%;text-align: left; margin-bottom: 0px; border-bottom: none; border-top: dashed 2px rgba(240,93,0,0);">
									        <dt class="am-accordion-title" style="background-color: rgba(255,255,255,0); padding: 0px 0px 0px 34%; border: none;">
									         	<span style="color: rgb(85,85,85);">详细信息</span>
									         	<span class="time" style="color: rgb(85,85,85);"><?php echo (date("Y.m.d",$vol["stime"])); ?>~<?php echo (date("Y.m.d",$vol["etime"])); ?></span>
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
						</dt>
						<button class="share">分享给好友&nbsp;<i class="am-icon-paper-plane-o floating"></i></button>
					</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					<div class="no-discount">
						<img src="../Style/index-images/no-discount.png" alt="没有优惠券"/>
						<p style="color:#555;">您暂时还没有该类优惠券</p>
						
					</div><?php endif; ?>
				</div>
				
				
				<!--已过期的-->
				<div id="con_one_2" style="display:none;">
					<?php if(!empty($coupon_overdue)): if(is_array($coupon_overdue)): $i = 0; $__LIST__ = $coupon_overdue;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dl>
						<dt style="padding: 5px;">
							<div id="all">
								<div id="yiguo-left">
  									<p class="you"><?php if($vol["kind"] == 1): if($vol["condition"] == 0): ?>现金券<?php else: ?>通用券<?php endif; endif; ?>
									</p>
  									<p class="num"><span style="font-size: 14px;">￥</span><span style="font-size: 38px;"><?php echo ($vol["disPrice"]); ?></span></p>
  									<p class="yiguo">已过期</p>
								</div>
								<div id="yiguo-right" style="color: rgb(171,171,171);">
									<p class="you1"><?php echo ($vol["title"]); ?></p>
									<p><img src="../Style/index-images/line-2.png" alt="线" class="un-line"/></p>
									<p class="con">全场通用</p>
									<img src="../Style/index-images/dain.jpg" alt="点" class="am-img-responsive doted"/>
									<img src="../Style/index-images/guoqii.png" alt="已过期" class="am-img-responsive" style="width: 60px;height:50px;position: absolute; left: 71%; top: 27px;"/>
								</div>
								<!--折叠面板-->
								<div style="clear: both;"></div>    <!--清除浮动-->
								<div id="detail2" style="margin-top: -30px;" >
									<section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{  }' style="width: 100%; margin: 0 auto;">
									      <dl class="am-accordion-item am-active" style="width: 100%;text-align: left; margin-bottom: 0px; border-bottom: none; border-top: dashed 2px rgba(240,93,0,0);">
									        <dt class="am-accordion-title" style="background-color: rgba(255,255,255,0); padding: 0px 0px 0px 34%; color: rgb(171,171,171); border: none;">
									         	<span class="info">详细信息</span>
									         	<span class="time"><?php echo (date("Y.m.d",$vol["stime"])); ?>~<?php echo (date("Y.m.d",$vol["etime"])); ?></span>
									        </dt>
									        <dd class="am-accordion-bd am-collapse">
									           	<p style="padding: 5px; color: rgb(171,171,171);">
									           		<?php echo ($vol["desc"]); ?>
									           	</p>
									        </dd>
									      </dl>
									</section>
								</div> 								
							</div>
						</dt>	
					</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					<div class="no-discount">
						<img src="../Style/index-images/no-discount.png" alt="没有优惠券"/>
						<p>您暂时还没有该类优惠券</p>
					</div><?php endif; ?>
				</div>


				<!--已使用的-->
				<div id="con_one_3" style="display:none;">
					<?php if(!empty($coupon_userd)): if(is_array($coupon_userd)): $i = 0; $__LIST__ = $coupon_userd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dl>
						<dt style="padding: 5px;">
							<div id="all">
								<div id="yiyong-left">
  									<p class="you"><?php if($vol["kind"] == 1): if($vol["condition"] == 0): ?>现金券<?php else: ?>通用券<?php endif; endif; ?>
									</p>
  									<p class="num"><span style="font-size: 14px;">￥</span><span style="font-size: 38px;"><?php echo ($vol["disPrice"]); ?></span></p>
  									<p class="yiyong">已使用</p>
								</div>
								<div id="yiyong-right">
									<p class="you1"><?php echo ($vol["title"]); ?></p>
									<p><img src="../Style/index-images/line-1.png" alt="线" class="un-line"/></p>
									<p class="con">全场通用</p>
									<img src="../Style/index-images/dain.jpg" alt="点" class="am-img-responsive doted"/>
								</div>
								<!--折叠面板-->
								<div style="clear: both;"></div>    <!--清除浮动-->
								<div id="detail3" style="margin-top: -30px;" >
									<section data-am-widget="accordion" class="am-accordion am-accordion-gapped" data-am-accordion='{  }' style="width: 100%; margin: 0 auto;">
									      <dl class="am-accordion-item am-active" style="width: 100%;text-align: left; margin-bottom: 0px; border-bottom: none; border-top: dashed 2px rgba(240,93,0,0);">
									        <dt class="am-accordion-title" style="background-color: rgba(255,255,255,0); padding: 0px 0px 0px 34%; border: none;">
									         	<span style="color: rgb(85,85,85);">详细信息</span>
									         	<span class="time" style="color: rgb(85,85,85);"><?php echo (date("Y.m.d",$vol["stime"])); ?>~<?php echo (date("Y.m.d",$vol["etime"])); ?></span>
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
						</dt>	
					</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					<div class="no-discount">
						<img src="../Style/index-images/no-discount.png" alt="没有优惠券"/>
						<p>您暂时还没有该类优惠券</p>
					</div><?php endif; ?>
				</div>
			</div>
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
			
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<script type="text/javascript">
			$(function(){
				$(".share").on("click",function(){
					$("#mcover").show();
					ids = $("input:checkbox[name='share_coupon']:checked").map(function(index,elem) {
						return $(elem).val();
					}).get().join(',');
					if(ids == ''){
						layer.open({content: '您未选择优惠券！', time: 3});
						return false;
					}
					window.location.href="<?php echo U('coupon/coupon_to_share');?>&ids="+ids;
					return false;
				});
			});
		</script>

		<!--选项卡JS-->
		<script type="text/javascript">
			function setTab(name,cursel){
				cursel_0=cursel;
				for(var i=1; i<=links_len; i++){
					var menu = document.getElementById(name+i);
					var menudiv = document.getElementById("con_"+name+"_"+i);
					if(i==cursel){
						menu.className="off";
						menudiv.style.display="block";
					}
					else{
						menu.className="";
						menudiv.style.display="none";
					}
				}
			}
			function Next(){                                                        
				cursel_0++;
				if (cursel_0>links_len)cursel_0=1
				setTab(name_0,cursel_0);
			} 
			var name_0='one';
			var cursel_0=1;
			
			var links_len,iIntervalId;
			onload=function(){
				var links = document.getElementById("tab1").getElementsByTagName('li')
				links_len=links.length;
				for(var i=0; i<links_len; i++){
					links[i].onmouseover=function(){
						clearInterval(iIntervalId);
						this.onmouseout=function(){
							iIntervalId = setInterval(Next,ScrollTime);;
						}
					}
				}
				document.getElementById("con_"+name_0+"_"+links_len).parentNode.onmouseover=function(){
					clearInterval(iIntervalId);
					this.onmouseout=function(){
						iIntervalId = setInterval(Next,ScrollTime);;
					}
				}
				setTab(name_0,cursel_0);
				iIntervalId = setInterval(Next,ScrollTime);
			}
		</script>
		
		<script type="text/javascript">
			$(function(){
				$("#btn-open").on("click",function(){
					if($("#doc-modal-1").css("display")!="none")     //禁止页面滚动
					{
						
						window.ontouchmove=function(e){
	        			e.preventDefault && e.preventDefault();
	        			e.returnValue=false;
	        			e.stopPropagation && e.stopPropagation();
	        			return false;
						}
					}
				});
				
			});
			$(function(){
				$(".am-close").on("click",function(){        //当关闭按钮的时候   页面可以滚动
					window.ontouchmove=null;
				});
			});
		</script>
		<script type="text/javascript">
			 $(function() {
		        $("#CheckAll").click(function() {
		            $('input[name="share_coupon"]').attr("checked",this.checked);
		        });
				var $subBox = $("input[name='share_coupon']");
		        $subBox.click(function(){
		            $("#CheckAll").attr("checked",$subBox.length == $("input[name='share_coupon']:checked").length ? true : false);
		        });
			});
		</script>
	</body>

</html>