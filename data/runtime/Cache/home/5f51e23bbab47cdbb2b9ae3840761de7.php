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
			wx.ready(function() {
				wx.onMenuShareTimeline({
					title: "<?php echo ($fx_info['merchant']); ?>", // 分享标题
					link: "<?php echo ($jsapi['url']); ?>", // 分享链接
					imgUrl: "<?php echo ($fximg); ?>", // 分享图标
				});
				wx.onMenuShareAppMessage({
					title: "<?php echo ($fx_info['merchant']); ?>", // 分享标题
					desc: "<?php echo ($fx_info['m_desc']); ?>", // 分享描述
					link: "<?php echo ($jsapi['url']); ?>", // 分享链接
					imgUrl: "<?php echo ($fximg); ?>", // 分享图标
					type: 'link',
					dataUrl: '',
				});
			});
		</script>
		<!--<link rel="stylesheet" type="text/css" href="../Style/css/animate.min.css"/>-->
		<style>
			*{
				border: none;outline: none;font-family: "微软雅黑";
			}
			/*立即关注S*/
			#top{
				width: 100%;height: 40px;background-color: white;
			}
			#top img{
				width: 35px;height: 35px;padding: 3px;
			}
			#top span{
				width: 49%;height: 40px;color: rgb(239,93,0);line-height: 40px;font-size: 13px;
			}
			#top button{
				width: 17%;height: 25px;color: white;float: right;margin-top: 8px;border-radius: 5px;background-color: rgb(239,93,0);
			}
			/*立即关注E*/
			/*用户头像	·签名·勋章*/
			#user-content p:first-child{
				text-align: left; color: white; margin-top: 5px;font-size:13px;text-overflow: ellipsis; overflow: hidden; white-space: nowrap; padding-right: 5px;
			}
			#user-content p:last-child{
				text-align: left; color: white;font-size:12px;text-overflow: ellipsis; overflow: hidden; white-space: nowrap; padding-right: 5px;
			}
			#img-xun img{
				width: 22px; height: 36px; float: right; margin-right: 4px; margin-top: 8px;
			}
			
			/*搜索S*/
			#search{
				width: 100%;height: 45px;text-align: center;background-color: #EF5D00;
			}
			#search p{
				color: white;text-align: center;line-height: 45px;font-size: 14px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
			}
			#search #search-input{
				width: 58%;height: 25px;background-color: white; margin-top: 10px; border-bottom-left-radius: 9px; border-top-left-radius: 9px; float: left; margin-left: 8px; position: relative; left: 0px;
			}
			#search button{
				width: 55px;height: 25px;color: #EF5D00;font-size: 12px;margin-left: -2px;margin-top: 10px;border-left:solid 1px rgb(240,93,0);background-color: white;border-bottom-right-radius: 4px;border-top-right-radius: 4px;				
			}
			/*搜索E*/
			
			/*分类S*/
			#sort-top,#sort-bottom{
				height: 65px;
			}
			#sort-top img,#sort-bottom img{
				width: 65px; margin-top: 15px;margin-left: 11px;
			}
			/*分类E*/
			
			/*产品展示S*/
			#product-list{
				border-bottom: solid 1px rgb(220,220,220); margin-top: 5px;
			}
			#product-name,#free-price,.price1,#market-price,.price2{
				float: left;
			}
			#product-name{               /*产品名称*/
				width:100%;color: #555;text-align:left;font-size: 14px;line-height: 30px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding-left: 10px;
			}
			#free-price{                      /*免税价*/
				color: #555; line-height: 25px; font-size: 13px;padding-left:1px;
			}
			.price1{
				line-height: 25px; color: rgb(240,93,0); font-size: 16px;
			}
			#market-price{
				color: black; line-height: 25px; font-size: 12px;
			}
			.price2{                            /*市场价*/
				line-height: 25px;color: rgb(120,120,120);font-size: 12px;
			}
			.nation{							 /*国籍*/                          
				line-height: 7px; font-size: 11px;margin-top:13px; color: #555;
			}
			/*加入购物车*/
			.am-icon-cart-plus{
				float: right;margin-right: 5px;color: rgb(240,93,0);padding: 0px 6px 0px 4px;border-radius: 5px; margin-top: 3px;
			}
			.am-icon-heart-o,.am-icon-heart{
				float: right; margin-right: 20px;padding: 0px 4px 0px 4px; border-radius: 5px; margin-top: 3px;
			}
			/*未收藏的*/
			.am-icon-heart-o{
				color: #555;
			}
			/*已收藏的*/
			.am-icon-heart{
				color: rgb(240,93,0);
			}
			/*产品展示E*/

			/*优惠券*/
			.am-avg-sm-2 > li{
				margin: 0 0 1% 2%;
			}
			#youhui{
				background-color: white; padding-top: 5px; margin-bottom: 0px;
			}
			#youhui .you{
				width: 100%;height: 90px; color: white; position: relative; left: 0;
			}
			#youhui .type{
				position: absolute; left: 5px; top: 2px; font-size: 13px;
			}
			#youhui .con{
				position: absolute; right: 10px; top:0;border: solid 1px white; border-bottom-left-radius: 4px;border-bottom-right-radius: 4px; padding: 0 5px 0px 5px;
			}
			#youhui .con1{
				position: absolute; right: 10px; top:0;color: rgb(228,228,228);border: solid 1px rgb(228,228,228); border-bottom-left-radius: 4px;border-bottom-right-radius: 4px; padding: 0 5px 0px 5px;
			}
			#youhui .num{
				text-align: center; font-size: 30px;  padding-top: 30px;
			}
			#youhui .num .num-line{
				border-bottom: solid 1px white; padding: 2px 13px 0px 13px;
			}
			#youhui .content{
				text-align: center; font-size: 13px; padding-top: 5px; 
			}
			
			#guess-like {
				height: 50px;line-height: 50px;font-size: 13px;text-align: center;position: relative;color: #555;clear:both;
			}
			#guess-like .span-1,#guess-like .span-2 {
				border-top: 1px dashed rgb(190,190,190);width: 35%;position: absolute;top: 25px;
			}
			#guess-like .span-1{
				left: 0px;
			}
			#guess-like .span-2{
				right: 0px;
			}
			.item_over{
				width:60px;height:20px;line-height:20px;background:rgb(240, 93, 0);color:#fff;text-align:center;position:absolute;top:0px;font-size:12px;
			}
			
			#open-dialog{
				height: 18px;float: right; margin-top: 2px; margin-right: 1px; background-color: rgb(240,93,0); color: white; border-radius: 3px; text-align: center;
			}
			/*商品信息*/
			 .product{
				border: solid 1px rgb(238,164,119); border-radius: 7px; margin-top: -20px;
			}
			.name{
				overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: rgb(85,85,85);
			}
			.close-img{
				position: absolute; top: 0px; right: 0px; width: 18px; height: 18px;
			}
			/*规格选择*/
			.standard{
				max-height: 250px; overflow: scroll;
			}
			.standard .am-u-sm-2{
				text-align: right; padding-top: 5px; font-size: 13px; color: rgb(85,85,85);
			}
			/*数量选择*/
			#my-actions .num{
				height: 45px; line-height: 45px;
			}
			.num .am-u-sm-2{
				text-align: right; font-size: 13px; color: rgb(85,85,85);
			}
			/*按钮*/
			.btn .left,.btn .right{
				width: 50%; height: 45px;line-height: 45px; color: white; font-size: 14px;
			}
			.btn .left{
				background-color: rgb(255,180,0);float: left;
			}
			.btn .right{
				background-color: rgb(240,93,0);float: right;
			}
			
			.am-modal-actions-group .am-list > li{
				overflow: visible;
			}
			.spinner{
				margin-top: 10px;float: right;margin-right: 70px;
			}
			
			/* 规格选择 */
			.choosebox li{
				float:left;margin-right:10px;display:inline;margin-bottom: 8px;margin-top: 5px;
			}
			.choosebox li a{
				float:left;background:#fff;font-size:14px;border:1px solid #ccc;height:22px;line-height:14px;padding:4px 12px; display:block;
			}
			.choosebox li a.current{
				background:url(../Style/index-images/right-icon.gif) no-repeat 100% 100%;border:1px solid #A10000; color:rgb(169,8,8);
			}
			.choosebox li input{
				display:none;
			}
			.floatprice{
				margin-top:10px;
				color:rgb(85,85,85);
			}
			.am-dimmer{
				background-color: rgba(0, 0, 0, 0.7);
			}
			
			/*新店长弹框*/
			.am-modal-bd{
				border: solid 1px rgba(70,70,70,0); padding: 0px;
			}
			.am-modal-bd .new-close{
				width: 28px;position: absolute; right: 15px; top: 5px;
			}
			.am-modal-bd .new-num{
				width: 162px; font-size: 19px; color: rgb(240,93,0); position: absolute; left: 71px; top: 163px; font-weight: 590; text-align: center;
			}
			.am-modal-bd .new-content{
				width: 200px; color: black; font-weight: bold; position: absolute; left: 49px; top: 203px; line-height: 19px;
			}
			.am-modal-bd button{
				position: absolute;left: 50%; top: 275px; margin-left: -46px;width: 93px; height: 25px;border: solid 2px rgb(255,216,100); border-bottom: solid 3px rgb(255,216,100); border-radius: 10px; color: rgb(255,216,100); background-color: rgb(240,93,0);
			}
			#gotop{
				width: 35px; height: 35px; position: fixed; right: 8px; bottom: 70px;z-index: 888; display: none; background-color: rgb(240,93,0); color: white; border-radius: 50%; text-align: center;
			}
			
			#nh-header,#nh-main{
				background: url(../Style/index-images/activity/nh-beijing.png); background-size: cover;
			}
						
			/*倒计时*/
			/*#clock{
				text-align: center; font-size: 20px; color: rgb(240,93,0);
			}
			.clock{
				padding: 0px 4px 0px 4px; border-radius: 20%;
			}
			.day,.hour,.min,.sec{
				font-size: 13px; color: #555;
			}*/
		</style>
		<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
		<!--返回顶部-->
		<script>
	        $(function(){
	            $('#gotop').click(function(){
	                $("html,body").animate({scrollTop:0},1000);
	                return false;
	            });
	            $(window).scroll(function(){
	                var obj=$('#gotop');
	                if(obj.offset().top>1000){
	                    obj.show();
	                }else{
	                    obj.hide();
	                }
	            });
	        });
    	</script>
		<!--判断用户拥有多少个勋章，用来个性签名容纳长度-->
		<script type="text/javascript">
			$(function(){
				var size = $("#img-xun img").size();
				if(size == 2){
					$("#img-xun").attr("class","am-u-sm-2");
					$("#user-content").attr("class","am-u-sm-8");
				}
				if(size == 1){
					$("#img-xun").attr("class","am-u-sm-1");
					$("#user-content").attr("class","am-u-sm-9");
				}
				if(size ==0){
					$("#img-xun").attr("class","am-u-sm-0");
					$("#user-content").attr("class","am-u-sm-10");
				}

			});
		</script>
	</head>
	
	<body style="margin-top:-22px;">
	
		<?php if($remind == 1): ?><button id="new-dian" type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 310, height: 300}"></button>
				<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
					<div class="am-modal-dialog" style="background: none; position: relative; left: 0px; margin-top: -50px;">
						<div class="am-modal-bd">
							<img class="new-close" src="../Style/index-images/activity/close-white.png" alt="关闭" class="am-img-responsive" data-am-modal-close/>
							<img src="../Style/index-images/activity/first.png" alt="新店长" class="am-img-responsive" style="margin-top: -55px;"/>
							<p class="new-num pulse">第<span style="font-size: 24px; font-weight: bold;"><?php echo ($remuid); ?></span>号店长</p>
							<p class="new-content fadeIn">欢迎加入团洋范大家庭，快把这个好消息分享给好友或朋友圈，为店铺积攒更多人气！</p>
							<button class="new-share"><i class="am-icon-share"></i>&nbsp;立即分享</button>
						</div>
					</div>
				</div><?php endif; ?>
		
		<!--分享遮罩-->
		<div id="mcover" onclick="document.getElementById('mcover').style.display='';" style="display:none;">
			<img src="../Style/images/guide.png" />
		</div>
		
		<div class="cartmsg"></div>
		<!--关注-->
		<div id="top" <?php if($ret == 'true'): ?>style="display:none;"<?php endif; ?>>
			<i class="am-icon-close am-icon-sm" id="no_display" style="color:#EF5D00;padding-left:5px;"></i>
			<img src="../Style/images/logotyf.png" alt="logo"/>
			<span>关注团洋范更多优惠活动等你来</span>
			<button data-am-modal="{target: '#my-alert'}" style="margin-right:5px;">关注</button>		
		</div> 
		
		<!--弹出二维码窗口-->
		<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
		  	<div class="am-modal-dialog">
				<div class="am-modal-hd" style="color:white; background-color:rgb(240,93,0);line-height:30px; font-family: '微软雅黑';">
					<h3>长按二维码关注团洋范公众号</h3>
				</div>
				<div class="am-modal-bd">
			  		<img src="../Style/index-images/erweima.jpg" alt="二维码" class="am-img-responsive" style="width:200px; height:200px;margin:0 auto; margin-top:10px"/>
				</div>
				<div class="am-modal-footer">
			  		<span class="am-modal-btn">关&nbsp;&nbsp闭</span>
				</div>
		  	</div>
		</div>
		
		<!--用户头像和个性签名-->
		<div id="xuanchuang" style="width: 100%; height: 55px; background-color: rgb(240,93,0);">
			<div class="am-g">
  				<div class="am-u-sm-2" style="position: relative; left: 0px; text-align: center;">
					<?php if($info["hyimg"] != ''): ?><img src="<?php echo ($info["hyimg"]); ?>" class="am-circle hatch" width="60" height="60" style="width: 45px; height: 45px; margin-top: 5px;" />
						<?php else: ?>
						<img src="<?php echo ($info["cover"]); ?>" class="am-circle hatch" width="60" height="60" style="width: 45px; height: 45px; margin-top: 5px;" /><?php endif; ?>
  				</div>
  				<div id="user-content" class="am-u-sm-7">
  					<p><?php echo ($info["merchant"]); ?><span style="color:yellow;"><?php echo ($grade); ?></p>
  					<p><?php echo ($info["m_desc"]); ?></p>
  				</div>
  				<!--勋章-->
				<?php if($info["login_days"] >= 7 AND $info["v1"] == 1): ?><div id="img-xun" class="am-u-sm-3">
					<!--
						<img src="../Style/index-images/zhangkui.png" alt="掌柜"  class="am-img-responsive"/>
						<img src="../Style/index-images/jinpai.png" alt="金牌"  class="am-img-responsive"/>
					-->
  					<img src="../Style/index-images/renqi.png" alt="人气"  class="am-img-responsive"/>
  				</div><?php endif; ?>
			</div>
		</div>

		<!--------------- index banner滚动图 -------------->
		<!--<div class="am-slider am-slider-default bannermain" data-am-flexslider id="demo-slider-0">
			<ul class="am-slides">s
				<?php if(is_array($ad)): $i = 0; $__LIST__ = $ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($vo["url"] != ''): ?>onClick="location.href='<?php echo ($vo["url"]); ?>&shares=<?php echo ($info['id']); ?>'"<?php endif; ?>><img src="data/upload/advert/<?php echo ($vo["content"]); ?>" height="200" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>-->
		
		<!---------------- 搜索 ------------------->
		<div id="search" class="am-g" style="margin-top: 1px;">
  			<div class="am-u-sm-6">
  				<p>更多洋货&nbsp;<img src="../Style/index-images/earth.gif" alt="全球" width="30" height="30"/>&nbsp;等你来搜>></p>
  			</div>
  			<div class="am-u-sm-6">
  				<div id="search-input" onclick="window.location.href='<?php echo U('User/search');?>'">
  					<img src="../Style/index-images/search_ico.png" alt="搜索" style="width: 20px; position: absolute; left: 3px; top: 3px;"/>
  				</div>
  				<button type="button" id="search_btn" style="float: left; margin-left: 0px;">搜&nbsp;索</button>
  			</div>
  			<script>
				$('#search_btn').click(function(){
					var keyword=$('input[name=keyword]');
					window.location.href= "<?php echo U('User/search',array('keyword'=>'"+keyword.val()+"'));?>";
				});
				$('#no_display').on("click",function(){
					$("#top").fadeOut("slow");
				});
			</script>
		</div>
		
		<!----------------年货---------------->
		<div id="nh-header">
			<img src="../Style/index-images/activity/nh-libao.png" alt="年货礼包" class="am-img-responsive"/>
			<div>
				<img src="../Style/index-images/activity/nh-qianggou.png" alt="年货抢购" class="am-img-responsive"/>
				<div style="background: url(../Style/index-images/activity/nh-beijing.png); background-size: cover;">
					<ul class="am-avg-sm-3 am-thumbnails">
	  					<li onclick="window.location.href='http://yooopay.com/index.php?m=Item&a=index&id=5313&shares=<?php echo ($info["id"]); ?>'"><img class="am-thumbnail" src="../Style/index-images/activity/nh-libao4.png" /></li>
	  					<li onclick="window.location.href='http://yooopay.com/index.php?m=Item&a=index&id=5314&shares=<?php echo ($info["id"]); ?>'"><img class="am-thumbnail" src="../Style/index-images/activity/nh-libao5.png" /></li>
	  					<li onclick="window.location.href='http://yooopay.com/index.php?m=Item&a=index&id=5315&shares=<?php echo ($info["id"]); ?>'"><img class="am-thumbnail" src="../Style/index-images/activity/nh-libao6.png" /></li>
					</ul>
				</div>
			</div>
		</div>
		<!--------------- 分类  --------------->
		<!--<div id="sort-top" class="am-g">
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 53,'shares'=>$info['id']));?>"><img src="../Style/index-images/meizhuang.png" class="am-img-responsive" alt="美妆"/></a>
			</div>
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 28,'shares'=>$info['id']));?>"><img src="../Style/index-images/gehu.png" class="am-img-responsive" alt="个护"/></a>
			</div>
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 23,'shares'=>$info['id']));?>"><img src="../Style/index-images/muying.png" class="am-img-responsive" alt="母婴"/></a>
			</div>
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 29,'shares'=>$info['id']));?>"><img src="../Style/index-images/shipin.png" class="am-img-responsive" alt="食品"/></a>
			</div>
		</div>
		<div id="sort-bottom" class="am-g">
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 30,'shares'=>$info['id']));?>"><img src="../Style/index-images/baojian.png" class="am-img-responsive" alt="保健"/></a>
			</div>
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 64,'shares'=>$info['id']));?>"><img src="../Style/index-images/xiangb.png" class="am-img-responsive" alt="箱包"/></a>
			</div>
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 51,'shares'=>$info['id']));?>"><img src="../Style/index-images/jiaju.png" class="am-img-responsive" alt="家居"/></a>
			</div>
			<div class="am-u-sm-3">
				<a href="<?php echo U('Item/itemcate', array('pid' => 66,'shares'=>$info['id']));?>"><img src="../Style/index-images/jiupin.png" class="am-img-responsive" alt="酒品"/></a>
			</div>
		</div>-->
		<div id="nh-main">
			<div id="sort-top" class="am-g">
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 53,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/meizhuang2.png" class="am-img-responsive" alt="美妆"/></a>
				</div>
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 28,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/gehu2.png" class="am-img-responsive" alt="个护"/></a>
				</div>
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 23,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/muying2.png" class="am-img-responsive" alt="母婴"/></a>
				</div>
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 29,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/shipin2.png" class="am-img-responsive" alt="食品"/></a>
				</div>
			</div>
			<div id="sort-bottom" class="am-g">
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 30,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/baojian2.png" class="am-img-responsive" alt="保健"/></a>
				</div>
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 64,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/xiangb2.png" class="am-img-responsive" alt="箱包"/></a>
				</div>
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 51,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/jiaju2.png" class="am-img-responsive" alt="家居"/></a>
				</div>
				<div class="am-u-sm-3 bigEntrance">
					<a href="<?php echo U('Item/itemcate', array('pid' => 66,'shares'=>$info['id']));?>"><img src="../Style/index-images/activity/jiupin2.png" class="am-img-responsive" alt="酒品"/></a>
				</div>
			</div>
		</div>
		
		<!--范票商城和我要开店-->
		<!--<div id="fanpiao-store" style="background-color: rgb(192,4,18); padding-bottom: 5px;">
			<div style="width: 50%;float: left; padding: 5px 3px 5px 3px;" onclick="window.location.href='<?php echo U('fpingshop/index',array('shares'=>$info['id']));?>'">
				<img class="am-img-responsive" src="../Style/index-images/activity/nh-fanpiao.png" alt="范票商城"/>
			</div>
			<div style="width:50%;float: right; padding: 5px 3px 5px 3px;" onclick="window.location.href='<?php echo U('User/open_shop');?>'">
				<img class="am-img-responsive" src="../Style/index-images/activity/nh-kaidian.png" alt="我要开店"/>
			</div>
			<div style="clear: both;"></div>
		</div>-->
		<div id="fanpiao-store" style="background: url(../Style/index-images/activity/nh-beijing.png); background-size: cover; padding-bottom: 5px;">
			<div style="width: 50%;float: left; padding: 5px 3px 5px 3px;" onclick="window.location.href='<?php echo U('fpingshop/index',array('shares'=>$info['id']));?>'">
				<img class="am-img-responsive" src="../Style/index-images/activity/nh-fanpiao.png" alt="范票商城"/>
			</div>
			<div style="width:50%;float: right; padding: 5px 3px 5px 3px;" onclick="window.location.href='<?php echo U('User/open_shop');?>'">
				<img class="am-img-responsive" src="../Style/index-images/activity/nh-kaidian.png" alt="我要开店"/>
			</div>
			<div style="clear: both;"></div>
		</div>
		<!--一周年抽奖活动-->
		<!--<div id="fanpiao-store" style="background-color: white; padding-top: 10px;">
			<img src="../Style/index-images/activity/yi-ru.png" alt="一周年庆" class="am-img-responsive"/>
			<div style="width: 50%;float: left; padding: 5px 3px 5px 3px;" onclick="window.location.href='<?php echo U('Zhuangpan/index',array('shares'=>$info['id']));?>'">
				<img class="am-img-responsive" src="../Style/index-images/activity/yi-chou.png" alt="抽奖入口"/>
			</div>
			<div style="width:50%;float: right; padding: 5px 3px 5px 3px;" onclick="window.location.href='<?php echo U('Activity/brand',array('shares'=>$info['id']));?>'">
				<img class="am-img-responsive" src="../Style/index-images/activity/yi-huo.png" alt="一周年活动入口"/>
			</div>
			<div style="clear: both;"></div>
		</div>-->
		
		<!--公益礼包-->
		<!--<div style="background-color: white;" onclick="window.location.href='<?php echo U('Index/public_ben',array('shares'=>$info['id']));?>'">
			<img src="http://yooopay.com/data/upload/advert/1612/12/584e01961a1bc.jpg" alt="公益礼包" class="am-img-responsive" style="padding: 0px 3px 3px 3px;"/>
		</div>-->

		<!--商品列表-->
		<div class="am-tabs xuankamain" data-am-tabs="{noSwipe: 1}" id="doc-tab-demo-1">
			<div class="am-tabs-bd">
				<div class="am-tab-panel am-active" style="padding: 0px 10px 10px 10px;">
					<?php if(is_array($home_item)): $i = 0; $__LIST__ = $home_item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div id="product-list index_product_list">
						<a class="pdt_ser_li">
							<img real_src="data/upload/item/<?php echo ($vo["cover"]); ?>" onclick="location.href='<?php echo U('Item/index',array('id'=>$vo['id'],'shares'=>$info['id']));?>'" width="100%" height="200"/>
								
							<!--修改-->
							<div class="am-g" style="background-color: white;  height: 40px;">
								<div class="am-u-sm-2">
									<img real_src="data/upload/flag/<?php echo ($vo["flag"]); ?>" alt="国籍" class="am-img-responsive" id="product-nation-img" style="width: 30px; height: 20px; border: solid 1px rgb(160,160,160); padding: 0px; margin:0 auto; margin-top:7px;"/>
									<p class="nation"><?php echo ($vo["name"]); ?></p>
								</div>
								
								<div class="am-u-sm-10">
									<p id="product-name"><?php echo ($vo["title"]); ?></p>
									<p style="padding-left: 10px;">
										<span id="free-price">优品价：</span>
  										<font class="price1">￥
											<?php echo ($vo["price"]); ?>
										</font>
										<!--加入购物车-->
										<i class="am-icon-cart-plus am-icon-sm ab" onclick="itemfloat(<?php echo ($vo["id"]); ?>)" data-am-modal="{target: '#my-actions'}"></i>
										<?php if(in_array($vo['id'],$likeIds)): ?><!--未收藏的-->
										<i class="am-icon-sm am-icon-heart" id="heart_<?php echo ($vo["id"]); ?>" onclick="shoucang('<?php echo ($vo["id"]); ?>');"></i>
										<?php else: ?>
										<!--已收藏的-->
										<i class="am-icon-heart-o am-icon-sm" id="heart_<?php echo ($vo["id"]); ?>" onclick="shoucang('<?php echo ($vo["id"]); ?>');"></i><?php endif; ?>
									</p>
								</div>
							</div>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>

				</div>
			</div>
		</div>

		<!-- search -->
		<div class="sreach">
			<header data-am-widget="header" class="am-header am-header-default">
				<div class="am-g">
					<div class="am-u-sm-1">
						<a href="javascript:;" id="back" class="am-icon-chevron-left" style="margin-top:18px;"></a>
					</div>
					<div class="am-u-sm-11">
						<div class="am-input-group" style="width:80%;">
							<input type="text" class="am-form-field serachimg" id="keyword" placeholder="请输入关键字">
						</div>
						<a href="javascript:void(0)" id="sousou" style="width: 50px;height: 22px;background: #ff6666;padding: 5px;margin-left: 10px;border-radius: 5px;color: #fff;">搜索</a>
					</div>
					<!--<div class="am-u-sm-1"><a href="javascript:;" class="am-icon-search"></a></div>-->
				</div>
			</header>
			<!-- list -->
			<ul class="am-avg-sm-2 am-thumbnails indexpromain" id="itemlist" style="padding-bottom:150px;height:600px;overflow:auto">
			</ul>
		</div>
		
		<!--弹出框-->
		<div class="am-modal-actions" id="my-actions">
			<div class="am-modal-actions-group">
				<ul class="am-list">	
					<li class="am-modal-actions-header">
						<div class="am-g" style="position: relative; left: 0px;">
							<div class="am-u-sm-4" >
								<img src="" id="iimg" alt="商品" class="am-img-responsive product"/>
							</div>
							<div class="am-u-sm-8" style="text-align: left; padding-left: 5px;">
								<p class="floatprice"><span>优品价：</span><span style="color: rgb(240,93,0);">￥<span class="ypprice" id="iprice"></span></span></p>
								<p class="name" id="ititle"></p>
							</div>
							<img class="close-img" src="../Style/index-images/d-close.png" data-am-modal-close alt="关闭"/>
						</div>
					</li>
					<!--规格-->
					<li class="standard" style="max-height: 250px; overflow-y: scroll;" id="">
						<div class="am-g">
							<div class="am-u-sm-2">
								规格：
							</div>
							<div class="am-u-sm-10" style="padding-left: 10px;">
								<div class="choosebox">
									<ul class="clearfix" id="isize">
									</ul>
								</div>
								<div style="clear: both;"></div>
							</div>
						</div>
					</li>
					<!--数量-->
					<li class="num">
						<div class="am-g">
							<div class="am-u-sm-2">
								数量：
							</div>
							<div class="am-u-sm-10">
								<input type="text" id="quantity"  value="1" orig="1" changed="1" class="spinnerExample"onafterpaste="this.value=this.value.replace(/\D/g,'')" onKeyUp="this.value=this.value.replace(/\D/g,'')"  />
							</div>
						</div>
					</li>
					<input type="hidden" id="iid" value="">
					<input type="hidden" id="size" value="">
					<input type="hidden" name="shares_id" id="shares_id" value="<?php echo ($info["id"]); ?>" />
					<!--按钮-->
					<li class="btn">
						<div class="left" onclick="addcart(1);">
							加入购物车
						</div>
						<div class="right" onclick="addcart(2);">
							立即购买
						</div>
						<div style="clear: both;"></div>
					</li>
				</ul>
			</div>
		</div>
		
		<!--底线-->
		<p id="guess-like">
			<span class="span-1" style="border-top: solid 1px rgb(210,210,210);"></span>
				我是有底线的
			<span class="span-2" style="border-top: solid 1px rgb(210,210,210);"></span>
		</p>
		<a id="gotop"><i class="am-icon-chevron-up am-icon-sm" style="line-height: 30px; margin-top: 7px;"></i></a>
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
		<script type="text/javascript">
			$('.spinnerExample').spinner({});
		</script>
		<script type="text/javascript" src="../Style/js/lightbox-plus-jquery.min.js"></script>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<script src="../Style/js/jquery-ias.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				var ias = $.ias({
					container: ".index_product_list",
					item: ".pdt_ser_li",
					pagination: "#pagination",
					next: ".next a"
				});
				ias.extension(new IASSpinnerExtension());
				ias.extension(new IASTriggerExtension({
					offset: 3
				}));
				ias.extension(new IASNoneLeftExtension({
					text: ''
				}));
			})
		</script>
		<script src="../Style/js/Y_lazyload.js" type="text/javascript"></script>
		<!--图片懒加载-->
		<script type="text/javascript">
		
			$(function() {
				/**
				 *   option 的默认属性说明，进入 Y_lazyload.js 中查看注释
				 *
				 *   event           //加载img的触发事件
				 *   img             //随后加载 img 的dom
				 *   real_src        //要加载真实 src 使用到的自定义属性(attr)
				 *   animate         //动画效果
				 *   animate_delay   //动画等待时间，等待图片下载完成
				 *   animate_time    //动画执行时间
				 *   time_out        //设置延迟加载，有时IE下如果太快会有个别图片无反应的情况，设置此延时就可以解决
				 **/
				$(window).Y_lazyload({
					time_out : 10,
					animate:"fadeIn",
				});
			});
		
			//领取优惠券
			function get_coupon(id) {
				var url="<?php echo U('coupon/get_coupon');?>";
				$.post(url,{id:id},function(data){
					layer.open({
						title: '提示',
						content: data,
						btn: ['我知道了'],
						yes: function(index){
							location.reload();
							//layer.close(index);
						}
					});
				});
			}	
			//收藏商品
			function shoucang(id) {
				var url="<?php echo U('Item/shou_cang');?>";
				$.getJSON(url,{'id':id},function(data){
					if(data.status==1){
						$("#heart_"+id).removeClass("am-icon-heart-o");
						$("#heart_"+id).addClass("am-icon-heart");
					}else{
						$("#heart_"+id).removeClass("am-icon-heart");
						$("#heart_"+id).addClass("am-icon-heart-o");
					}
				});
			}	
		</script>
		
		<script>
			function itemfloat(id){
				var url="<?php echo U('Item/itemparams');?>";
				
				$.getJSON(url,{'id':id},function(data){
					
					status = data.status;
					sz = data.sz;
					item = data.item;
					
					id = item.id;
					img = item.img;
					title = item.title;
					price = item.price;
					
					size = item.size;
					size_imgs = item.size_imgs;
					size_price = item.size_price;
					
					var sizes = new Array();
					var imgs = new Array();
					var prices = new Array();
				
					for (var property in size) { 
						sizes[property] = size[property];
					}
					for (var property in size_imgs) { 
						imgs[property] = size_imgs[property];
					}
					for (var property in size_price) { 
						prices[property] = size_price[property];
					}
				
					
					$("#iimg").attr("src","data/upload/item/"+img);
					$("#iprice").html(price);
					$("#ititle").html(title);
					$("#iid").val(id);
					$("#size").val('');
					
					
					var isize=document.getElementById('isize');
					$('#isize li').each(function(){
						$(this).remove();
					}); 
					
					if(sz==0){
						var li=document.createElement("li");
						li.innerHTML="无";
						isize.appendChild(li);
					}else{
						for(var i=0;i<sizes.length;i++) { 
							var li=document.createElement("li");
							li.innerHTML='<a onclick="select_size(this);" class="size_radioToggle">'+sizes[i]+'<input type="radio"  name="isize" value="'+sizes[i]+'-'+prices[i]+'-'+imgs[i]+'"/></a>';
							isize.appendChild(li);
						}
					}
				});
			}
			
			function select_size(obj){
				var val=obj.childNodes[1].value;
				
				var arr = val.split('-');
				$("#iimg").attr("src","data/upload/item_size/"+arr[2]);
				$("#iprice").html(arr[1]);
				$("#size").val(arr[0]);
				var thisToggle = $(obj).is('.size_radioToggle') ? $(obj) : $(obj).prev();
				var checkBox = thisToggle.prev();
				checkBox.trigger('click');
				$('.size_radioToggle').removeClass('current');
				thisToggle.addClass('current');
				
			}
			
			function addcart(tobuy){
				var id=$("#iid").val();
				var size=$("#size").val();
				var num=$("#quantity").val();
				
				var shopid=$("#shares_id").val();
				var url  = "<?php echo U('Shopcart/addcart');?>";
				var jsurl = "<?php echo U('Order/jiesuan');?>";
				if(tobuy==1){
					$.getJSON(url,{'goodId':id,'size':size,'shopid':shopid,'quantity':num},function(data){
						if(data.status==1){
							htm='<span>'+data.msg+'！购物车共有'+data.cart_count+'件商品,共计：'+data.cart_price+'元.</span>';
							$('.cartmsg').html(htm);
							$('.cartmsg').slideDown(600);
							$('.cartmsg').fadeOut(5000);
							setTimeout(slideUp_fn, 6000);
						}else{
							htm='<span>'+data.msg+'.</span>';
							$('.cartmsg').html(htm);
							$('.cartmsg').slideDown(600);
							$('.cartmsg').fadeOut(5000);
							setTimeout(slideUp_fn, 6000);
						}						
					});
				}else{
				
					$.getJSON(url,{'goodId':id,'size':size,'shopid':shopid,'quantity':num},function(data){
						if(data.status==1){
							location.href = jsurl+"&cartId="+data.cartId;	
						}else{
							htm='<span>'+data.msg+'.</span>';
							$('.cartmsg').html(htm);
							$('.cartmsg').slideDown(600);
							$('.cartmsg').fadeOut(5000);
							setTimeout(slideUp_fn, 6000);
						}
					});
				}
			}
		</script>
		
		<script>
			$(function(){
    			$(".ab").on("click",function(){
    				$("#my-actions").show(1000);
    			});
    		})
		</script>
		<!--新店长点击分享弹出遮罩-->
		<script type="text/javascript">
			$(function(){
				$(".new-share").on("click",function(){
					$("#mcover").show();
					return false;
				});
			});
		</script>
	</body>
</html>