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
</style>




		<style type="text/css">
			*{
				font-family: "微软雅黑";
			}
			.topnav {
				z-index: 999;position: fixed;width: 100%;height: 49px;background: rgb(240,93,0);text-align: center;color: #fff;font-size: 18px;line-height: 49px;top: 0;
			}
			
			.topnav .back {
				position: absolute;left: 8px;top: 6px;margin-top: -8px;
			}
			/*个人信息S*/
			#user-info{
				width: 100%;height: 130px;background: url(../Style/index-images/bg.jpg) no-repeat;background-size:cover;
			}
			#user{
				line-height: 130px;
			}
			#user img{
				width: 75px;height: 75px;line-height: 130px;
			}
			.user-name{
				width: 131px;float:left;color: white; line-height: 130px;font-size: 15px;text-overflow: ellipsis;overflow: hidden;white-space:nowrap;

			}
			#user-info-next span{
				float:right; line-height: 130px;color: white; margin-right: 5px; font-size: 14px;
			}
			/*个人信息E*/
			
			/*勋章*/
			#xunzhang{
				width: 100%; height: 30px;background-color: rgb(187,96,39);
			}
			#xunzhang .am-u-sm-3{
				text-align: center; line-height: 30px;
			}
			#xunzhang .am-u-sm-3 img{
				width: 19px; display: inline; margin-top: -3px;
			}
			#xunzhang .am-u-sm-3 .liang{   /*点亮颜色*/
				color: rgb(255,232,3);
			}
			#xunzhang .am-u-sm-3 .hui{     /*未点亮颜色*/
				color: rgb(222,222,222);
			}
			/*内容列表S*/
			#content {
			<?php  if($update_user == 4){ echo 'height:401px;'; }else{ echo 'height:352px;'; } ?>
			}
			#content li{
				font-size: 14px;
			}
			#content li:nth-child(2n+1){
				background-color: white;
			}
			#content img{
				width:32px;height: 32px;
			}
			/*内容列表E*/
		</style>
		<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
	</head>

	<body>
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
			</a>
			会员中心
		</div>
		<div id="user-info" style="margin-top: 49px;">
			<div class="am-g">
				<a href="<?php echo U('User/user_info');?>">
  				<div id="user" class="am-u-sm-3" style="text-align:center;position: relative; left: 0px;">
  					<?php if($visitor["hyimg"] != ''): ?><img src="<?php echo ($visitor["hyimg"]); ?>"class="am-img-thumbnail am-circle"  alt="头像"/>
						<?php else: ?><img src="<?php echo ($weiheader["cover"]); ?>" class="am-img-thumbnail am-circle"  alt="头像"/><?php endif; ?>
					
  				</div>
  				<div class="am-u-sm-8" style="height:56px;padding-top:34px;font-size:16px;color: #fff;padding-left:16px;">
  					<?php echo ($visitor["username"]); ?>
					<?php if($userinfo["uid"] != 4): ?><span style="display:block;font-size:13px;margin-top:8px;">您是第<?php echo ($unumber); ?>号饭团</span>
							<span style="display:block;font-size:13px;margin-top:8px;">今天是您开始创业的第<?php echo ($utime); ?>天</span>
						<?php else: ?>
							<span style="display:block;font-size:13px;margin-top:8px;">您是第<?php echo ($unumber); ?>号饭团</span>
							<span style="display:block;font-size:13px;margin-top:8px;">注册时间：<?php echo (date('Y年m月d日',$visitor["reg_time"])); ?></span><?php endif; ?>
  				</div>
  				<div id="user-info-next" class="am-u-sm-1">
  					<i class="am-icon-angle-right" style="font-size: 32px;line-height: 130px;color: #fff;"></i>
  				</div>
  			</a>
			</div>
		</div>
		
		
		<?php if($satisfy > 0): ?><div class="am-alert am-alert-warning" data-am-alert style="margin:0px;">
				<p>亲爱的<?php echo ($visitor["username"]); ?>，您已满足申请经纪人的条件，赶紧加入团洋范抢战市场吧！
					<span onclick="window.location.href='<?php echo ($urls); ?>'" style="background:red;color:#fff;border-radius:3px;height:80%;vertical-align:center;padding:3px;">去申请</span>
				</p>
			</div><?php endif; ?>
		
		<?php if(!empty($url)): ?><div class="am-alert am-alert-warning" data-am-alert style="margin:0px;">
				<p>亲爱的<?php echo ($visitor["username"]); ?>，您还没有支付代理商费用，点击支付加入团洋范抢战市场吧！
					<span style="background:red;color:#fff;border-radius:3px;height:80%;vertical-align:center;padding:3px;" id="pay">去支付</span>
				</p>
			</div><?php endif; ?>
		
		<!--
		<?php if(!empty($read_msg)): ?><div class="am-alert am-alert-warning" data-am-alert style="margin:0px">
				<p>亲爱的<?php echo ($visitor["username"]); ?>，您有<?php echo ($msg_cont); ?>条未读消息
					<span style="background:red;color:#fff;border-radius:3px;height:80%;vertical-align:center;padding:3px;" id="read">浏览</span>
				</p>
		</div><?php endif; ?>
		-->
		
		<!--勋章-->
		
		<?php if($userinfo["login_days"] >= 7 AND $userinfo["uid"] != 4 AND $userinfo["v1"] == 1): ?><div id="xunzhang">
				<div class="am-g">
						<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'renqi'));?>'">
							<?php if($userinfo["login_days"] >= 7): ?><img src="../Style/index-images/renqishangjia.png" alt="人气店铺" class="am-img-responsive"/>&nbsp;<span class="liang">人气店铺</span>
								<?php else: ?>
								<img src="../Style/index-images/renqishangjia-hui.png" alt="人气店铺" class="am-img-responsive"/>&nbsp;<span class="hui">人气店铺</span><?php endif; ?>
						</div>
					<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'huangguan'));?>'">
						<!--<img src="../Style/index-images/huangguanshangjia.png" alt="皇冠商家" class="am-img-responsive"/>&nbsp;<span class="liang">皇冠商家</span>-->
						<img src="../Style/index-images/huangguanshangjia-hui.png" alt="皇冠商家" class="am-img-responsive"/>&nbsp;<span class="hui">皇冠商家</span>
					</div>
					<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'jinpai'));?>'">
						<!--<img src="../Style/index-images/jinpaifuwu.png" alt="金牌服务" class="am-img-responsive"/>&nbsp;<span class="liang">金牌服务</span>-->
						<img src="../Style/index-images/jinpaifuwu-hui.png" alt="金牌服务" class="am-img-responsive"/>&nbsp;<span class="hui">金牌服务</span>
					</div>
					<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'wangpai'));?>'">
						<!--<img src="../Style/index-images/wangpaizhanggui.png" alt="王牌掌柜" class="am-img-responsive"/>&nbsp;<span class="liang">王牌掌柜</span>-->
						<img src="../Style/index-images/wangpaizhanggui-hui.png" alt="王牌掌柜" class="am-img-responsive"/>&nbsp;<span class="hui">王牌掌柜</span>
					</div>
				</div>
			</div>
			<?php elseif($userinfo["uid"] != 4): ?>
			<div id="xunzhang">
				<div class="am-g">
				
					<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'renqi'));?>'">
							<img src="../Style/index-images/renqishangjia-hui.png" alt="人气店铺" class="am-img-responsive"/>&nbsp;<span class="hui">人气店铺</span>
					</div>
					
					<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'huangguan'));?>'">
						<img src="../Style/index-images/huangguanshangjia-hui.png" alt="皇冠商家" class="am-img-responsive"/>&nbsp;<span class="hui">皇冠商家</span>
					</div>
					
					<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'jinpai'));?>'">
						<img src="../Style/index-images/jinpaifuwu-hui.png" alt="金牌服务" class="am-img-responsive"/>&nbsp;<span class="hui">金牌服务</span>
					</div>
					
					<div class="am-u-sm-3" onclick="window.location.href='<?php echo U('User/dec_rule',array('desc'=>'wangpai'));?>'">
						<img src="../Style/index-images/wangpaizhanggui-hui.png" alt="王牌掌柜" class="am-img-responsive"/>&nbsp;<span class="hui">王牌掌柜</span>
					</div>
				</div>
			</div><?php endif; ?>
		
		<ul class="am-avg-sm-4 am-thumbnails dingdanimg">
			<li>
				<a href="<?php echo U('User/orderlist',array('status'=>1));?>">
					<?php if($count1 != '0'): ?><span class="am-badge am-round dingdangcarshu bounce"><?php echo ($count1); ?></span><?php endif; ?>
					<img src="../Style/images/img24.png"><span>待付款</span>
				</a>
			</li>
			
			<li>
				<a href="<?php echo U('User/orderlist',array('status'=>2));?>">
					<?php if($count2 != '0'): ?><span class="am-badge am-round dingdangcarshu bounce"><?php echo ($count2); ?></span><?php endif; ?>
					<img src="../Style/index-images/shipped.png"><span>待发货</span>
				</a>
			</li>
			
			<li>
				<a href="<?php echo U('User/orderlist',array('status'=>3));?>">
					<?php if($count3 != '0'): ?><span class="am-badge am-round dingdangcarshu bounce"><?php echo ($count3); ?></span><?php endif; ?>
					<img src="../Style/images/img26.png"><span>待收货</span>
				</a>
			</li>

			<li>
				<a href="<?php echo U('User/order_list');?>">
					<span class="am-badge am-round dingdangcarshu bounce"><?php echo ($count); ?></span>
					<img src="../Style/index-images/all-order.png"><span>全部订单	<i class="am-icon-angle-right" style=""></i></span>
				</a>
			</li>

		</ul>

		<ul id="content" class="am-avg-sm-1 am-thumbnails remberli" style="margin-top: 6px; height:auto;">
			<li>
				<div class="am-g">
					<a href="<?php echo U('User/shoucang');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/collect.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						我的收藏
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
				</a>
			</li>
			<li>
				<div class="am-g">
					<a href="<?php echo U('User/address');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/adder.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						地址管理
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
					</a>
				</div>
			</li>
			<li>
				<div class="am-g"><a href="<?php echo U('User/id_manage');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/ID.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						身份证管理
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
					</a>
				</div>
			</li>
			<!--
			<li>
				<div class="am-g"><a href="<?php echo U('User/store_qrcode');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/store_qrcode.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						我的二维码
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
				</a>
			</li>
			-->
			<li>
				<div class="am-g">
					<a href="<?php echo U('User/history');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/search.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						我的足迹
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</a>
				</div>
			</li>
			
			<li>
				<div class="am-g"><a href="<?php echo U('User/integral');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/jifen.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						我的范票
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
				</a>
			</li>
			<li>
				<div class="am-g"><a href="<?php echo U('coupon/coupon_center');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/youhuijuan.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						优惠券
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
				</a>
			</li>
			
			<!--
			<li>
				<div class="am-g"><a href="<?php echo U('User/bargainlist');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/kanjia.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						我的砍价
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
				</a>
			</li>
			-->
			
			<li>
				<div class="am-g"><a href="<?php echo U('User/redbag_center');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/red-bag-center.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						我的红包
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
				</a>
			</li>
			
			<!--
			<li>
				<div class="am-g"><a href="<?php echo U('User/information_center');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/info.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						消息中心
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
				</a>
			</li>
			-->
			
			<li>
				<div class="am-g"><a href="<?php echo U('User/help');?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/help.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						帮助中心
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
				</div>
			</a>
			</li>
			
			<!--只有经纪人可见-->
			<?php if($update_user == 5): ?><li>
				<div class="am-g"><a href="<?php echo U('Recom/index',array('user'=>1));?>">
					<div class="am-u-sm-2 remberlileft"><img src="../Style/index-images/update-home.png"></div>
					<div class="am-u-sm-9 remberlimidlezi">
						一键升级为店长
					</div>
					<div class="am-u-sm-1 remberlirightzi">
						<i class="am-icon-angle-right"></i>
					</div>
					</span>
				</div>
				</li>
				</a><?php endif; ?>
		</ul>
		<!--退出账户-->
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
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<script>
			$(document).ready(function() {
				$("#pay").on("click",function() {
					window.location.href = "<?php echo ($url); ?>";
				})
			})
			
			$(document).ready(function() {
				$("#read").on("click",function() {
					window.location.href = "<?php echo U('User/information_center');?>";
				})
			})
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