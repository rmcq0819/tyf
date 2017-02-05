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
				title: "我的2016「团洋范」年度报告", // 分享标题
				link: "<?php echo ($jsapi['url']); ?>", // 分享链接
				imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/activity/2016_sharebg.jpg", // 分享图标
			});
			wx.onMenuShareAppMessage({
				title: "我的2016「团洋范」年度报告", // 分享标题
				desc: "时光虽然匆匆，而你始终独一无二，2016年，团洋范感谢有你。", // 分享描述
				link: "<?php echo ($jsapi['url']); ?>", // 分享链接
				imgUrl: "http://yooopay.com/Tpl/home/default/Style/index-images/activity/2016_sharebg.jpg", // 分享图标
				type: 'link', 
				dataUrl: '',
			});
		  });
		</script>
		<style type="text/css">
		
			/*旋转音乐*/
	    	.open{
	            -webkit-animation: moveRo linear 3.5s infinite;
	        }
	        @-webkit-keyframes moveRo {
	            from{
	                -webkit-transform: rotate(-360deg);
	            }
	            to{
	                -webkit-transform: rotate(360deg);
	            }
	        }
	        .rotate-img1{
				width: 90%; margin: 0 auto; animation: myfirst1 8s linear infinite; -webkit-animation: myfirst1 8s linear infinite; -moz-animation: myfirst1 8s linear infinite; -o-animation: myfirst1 8s linear infinite;
			}
			/*旋转动画*/
			@-webkit-keyframes myfirst1{
				0%{
					transform: rotate(0deg);-webkit-transform: rotate(0deg);-moz-transform: rotate(0deg);-o-transform: rotate(0deg);
				}
				100%{
					transform: rotate(360deg);-webkit-transform: rotate(360deg);-moz-transform: rotate(360deg);-o-transform: rotate(360deg);
				}
			}
			.rotate-img2{
				width: 90%; margin: 0 auto; animation: myfirst2 6s linear infinite; -webkit-animation: myfirst2 6s linear infinite; -moz-animation: myfirst2 6s linear infinite; -o-animation: myfirst2 6s linear infinite;
			}
			/*旋转动画*/
			@-webkit-keyframes myfirst2{
				0%{
					transform: rotate(-0deg);-webkit-transform: rotate(-0deg);-moz-transform: rotate(-0deg);-o-transform: rotate(-0deg);
				}
				100%{
					transform: rotate(-360deg);-webkit-transform: rotate(-360deg);-moz-transform: rotate(-360deg);-o-transform: rotate(-360deg);
				}
			}
			.rotate-img3{
				width: 90%; margin: 0 auto; animation: myfirst3 3s linear infinite; -webkit-animation: myfirst3 3s linear infinite; -moz-animation: myfirst3 3s linear infinite; -o-animation: myfirst3 3s linear infinite;
			}
			/*旋转动画*/
			@-webkit-keyframes myfirst3{
				0%{
					transform: rotate(-0deg);-webkit-transform: rotate(-0deg);-moz-transform: rotate(-0deg);-o-transform: rotate(-0deg);
				}
				100%{
					transform: rotate(-360deg);-webkit-transform: rotate(-360deg);-moz-transform: rotate(-360deg);-o-transform: rotate(-360deg);
				}
			}
			.rotate-img3{
				width: 90%; margin: 0 auto; animation: myfirst3 3s linear infinite; -webkit-animation: myfirst3 3s linear infinite; -moz-animation: myfirst3 3s linear infinite; -o-animation: myfirst3 3s linear infinite;
			}
			/*旋转动画*/
    </style>
	</head>

	<body>
		
		<!--------------加载前动画------------------>
		<!--<div class="fakeloader"></div>-->
		<div class="swiper-container" id="swiper-container-v">

			<section class="poster_wrap load" id="load">
				<div class="p_loading">
					<div class="p_loading_logo"></div>
					<p class="p_loading_tip"></p>
				</div>
			</section>
    
		    <div class="swiper-wrapper">
		    <!-------------slide1----------------->
		        <section class="swiper-slide swiper-slide1 swiper-slide-v" style="background-image: url(../Style/index-images/activity/bg-11.jpg); background-size: cover;">
					<div>
						<p style="margin-top: 25%;">
							<img src="../Style/index-images/activity/shouye.png" alt="头部" class="ani am-img-responsive" swiper-animate-effect="zoomIn" swiper-animate-duration="0.6s" swiper-animate-delay="0.3s" style="width: 80%; margin: 0 auto;"/>
							<img src="../Style/index-images/activity/wo-de.png" alt="头部" class="ani am-img-responsive" swiper-animate-effect="zoomIn" swiper-animate-duration="0.6s" swiper-animate-delay="0.6s" style="width: 60%; margin: 0 auto; margin-top: -44%;"/>
						</p>
					</div>
					
					<div>
						<img src="../Style/index-images/activity/s1-1.png" alt="头部" class="ani am-img-responsive" swiper-animate-effect="myFlip" swiper-animate-duration="0.8s" swiper-animate-delay="0.4s" style="width: 12%; position: fixed; right: 13%; bottom: 18%;"/>
						<img src="../Style/index-images/activity/s1-3.png" alt="头部" class="ani am-img-responsive" swiper-animate-effect="myFlip" swiper-animate-duration="1.0s" swiper-animate-delay="0.6s" style="width: 12%; position: fixed; right: 25%; bottom: 35%;"/>
						<img src="../Style/index-images/activity/s1-2.png" alt="头部" class="ani am-img-responsive" swiper-animate-effect="myFlip" swiper-animate-duration="1.3s" swiper-animate-delay="1.0s" style="width: 12%; position: fixed; left: 18%; bottom: 18%;"/>
					</div>		
		        </section>
		        
		    <!---------------slide2-------------->   
		        <section class="swiper-slide swiper-slide2 swiper-slide-v" style="height: 100%;">
		        	<div style="width: 100%; height: 33%; background: url(../Style/index-images/activity/bg-22.jpg); background-size: cover;">
		        		<p style="padding-top: 20%;"><img src="../Style/index-images/activity/sss2-1.png" alt="2016与你相遇好幸运" class="am-img-responsive" style="width: 75%; margin: 0 auto;"/></p>
		  				
		        	</div>
		        	<div style="width: 100%;height: 55%;background-color: rgb(255,241,0);">
		        		<div style="position: relative; left: 0px;">
		  					<img src="../Style/index-images/activity/s2-2.png" alt="" class="am-img-responsive" style="width: 120px; margin: 0 auto; padding-top: 10px;"/>		  							  					
	  						
	  						<p id="nian" class="ani" style="width: 90px;position: absolute; left: 50%; top: 54px; margin-left: -45px;color: white; text-align: center; font-size: 22px; font-weight: bold;" swiper-animate-effect="flipInY" swiper-animate-duration="0.9s" swiper-animate-delay="0.3s" ><?php echo (date("Y年",$reg_time)); ?></p>
	  						<p id="yue" class="ani" style="width: 100px;position: absolute; left: 50%; top: 83px;margin-left: -50px; color: white; text-align: center; font-size: 19px; font-weight: bold;" swiper-animate-effect="flipInY" swiper-animate-duration="0.9s" swiper-animate-delay="0.6s" ><?php echo (date("m月d日",$reg_time)); ?></p>
		  				</div>
		  				
		  				<img src="../Style/index-images/activity/s2-4.png" alt="" class="am-img-responsive ani" style="width: 70%; margin: 0 auto; margin-top: 10%;" swiper-animate-effect="flipInY" swiper-animate-duration="0.9s" swiper-animate-delay="0.6s"/>
		  				<p class="ani" style="color: rgb(240,94,0); font-size: 17px; margin-top: 8%; text-align: center; font-weight: bold;" swiper-animate-effect="flipInY" swiper-animate-duration="0.9s" swiper-animate-delay="0.6s">到现在已经&nbsp;<?php echo ($d); ?>&nbsp;天&nbsp;<?php echo ($h); ?>&nbsp;小时&nbsp;<?php echo ($m); ?>&nbsp;分钟了</p>
		  				
						
		        	</div>
		        	
		        	<div style="width: 100%; height: 12%;background-color: rgb(153,108,51);">
		        		<div class="am-g">
							<div class="am-u-sm-4">
								<img src="../Style/index-images/activity/s2-3.png" alt="屋" class="am-img-responsive ani" style="width: 90px;float: right; margin-top: -25px;" swiper-animate-effect="slideInLeft" swiper-animate-duration="1.6s" swiper-animate-delay="0.3s"/>
							</div>
  							<div class="am-u-sm-8">
  								<p class="ani" style="color: white; font-size: 17px; margin-top: 12px;text-align: center;" swiper-animate-effect="swing" swiper-animate-duration="1.1s" swiper-animate-delay="1s">海外进口  百分百原装正品</p>
  							</div>
						</div>
		        		
		        	</div>
					
		        </section>
		        
		        
		    <!-------------slide3----------------->
		        <section class="swiper-slide swiper-slide3 swiper-slide-v" style="height: 100%;">
		        	<div style="width: 100%; height: 33%; background: url(../Style/index-images/activity/bg-22.jpg); background-size: cover;">
		        		<p style="padding-top: 20%;"><img src="../Style/index-images/activity/sss3-1.png" alt="终于等到你" class="am-img-responsive" style="width: 80%; margin: 0 auto; padding-top: 10px;"/></p>
		  				
		        	</div>
		        	<div style="width: 100%;height: 55%;background-color: rgb(255,241,0);">
		        		<img src="<?php echo ($user['cover']); ?>" alt="用户" class="am-img-responsive am-circle ani" style="width: 19%; margin: 0 auto;" swiper-animate-effect="myFlip" swiper-animate-duration="1s" swiper-animate-delay="0.2s" />
		        		<p class="ani" style="width: 80%; text-align: center; margin: 0 auto; color: rgb(240,93,0); font-size: 14px; margin-top: 2px;" swiper-animate-effect="myFlip" swiper-animate-duration="1s" swiper-animate-delay="0.2s" ><?php echo ($user['username']); ?></p>
		        		<p class="ani" style="width: 80%;text-align: center; color: rgb(240,93,0); font-size: 17px; margin: 0 auto;margin-top: 7%; " swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.9s" >您是第&nbsp;<span id="wei" style="font-weight: bold; font-size: 21px;"><?php echo ($user['id']*3); ?></span>&nbsp;位加入团洋范的饭团</p>
		        		<p class="ani" style="text-align: center;color: rgb(240,93,0); font-size: 17px; margin-top: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="1.3s" >等待您的时间有些久了</p>
		        	</div>
		        	
		        	<div style="width: 100%; height: 12%;background-color: rgb(153,108,51);">
		        		<div class="am-g">
							<div class="am-u-sm-4">
								<img src="../Style/index-images/activity/s2-3.png" alt="屋" class="am-img-responsive ani" style="width: 100px;float: right; margin-top: -40px;" swiper-animate-effect="tada" swiper-animate-duration="1.2s" swiper-animate-delay="2s"/>
							</div>
  							<div class="am-u-sm-8">
  								<p class="ani" style="color: white; font-size: 17px; margin-top: 12px;text-align: center;" swiper-animate-effect="bounce" swiper-animate-duration="0.9s" swiper-animate-delay="2s">海外进口 百分百原装正品</p>
  							</div>
						</div>
		        		
		        	</div>
					
		        </section>
		    
		    <!-------------slide4----------------->
		        <section class="swiper-slide swiper-slide4 swiper-slide-v" style="height: 100%;">
		        	<div style="width: 100%; height: 33%; background: url(../Style/index-images/activity/bg-22.jpg); background-size: cover;">
		        		<p style="padding-top: 20%;"><img src="../Style/index-images/activity/sss4-1.png" alt="第一次购物" class="am-img-responsive" style="width: 80%; margin: 0 auto; padding-top: 0px;"/></p>
		        	</div>
		        	<div style="width: 100%;height: 55%;background-color: rgb(255,241,0);">
		        		<div>
		  					<img src="../Style/index-images/activity/ss6-2.png" alt="" class="am-img-responsive ani" style="width: 110px; margin: 0 auto; margin-top: -10px; padding-top:0px;" swiper-animate-effect="slideInRight" swiper-animate-duration="0.9s" swiper-animate-delay="0s"/>		  							  					
		  				</div>
						<?php if($first_time > 0): ?><p class="ani" style="width: 70%; color: rgb(240,93,0); font-size: 18px; margin-top: 5%;" swiper-animate-effect="slideInRight" swiper-animate-duration="0.8s" swiper-animate-delay="0.5s">【<?php echo (date("Y年m月d日",$first_time)); ?>】</p>
							<p class="ani" style="width: 80%; color: rgb(240,93,0); font-size: 17px; text-align: center; margin: 0 auto; margin-top: 5%;" swiper-animate-effect="slideInRight" swiper-animate-duration="0.7s" swiper-animate-delay="0.8s">这一天您在团洋范消费了</p>
							<p class="ani" style="width: 80%; color: rgb(240,93,0); font-size: 17px; font-weight: bold; text-align: center; margin: 0 auto; margin-top: 2%;" swiper-animate-effect="slideInRight" swiper-animate-duration="0.6s" swiper-animate-delay="1.1s">第一笔订单</p>
							<p class="ani" style="width: 80%; color: rgb(240,93,0); font-size: 17px; text-align: center; margin: 0 auto; margin-top: 2%;" swiper-animate-effect="slideInRight" swiper-animate-duration="0.5s" swiper-animate-delay="1.5s">听说收到产品的您给了快递员一个么么哒~</p>
						<?php else: ?>
							<p class="ani" style="color: rgb(240,93,0); font-size: 18px; text-align: center; padding-top: 20%;" swiper-animate-effect="rubberBand" swiper-animate-duration="0.9s" swiper-animate-delay="0.5s">你还没购物记录~~</p><?php endif; ?>
		        		
		        	</div>
		        	
		        	<div style="width: 100%; height: 12%;background-color: rgb(153,108,51);">
		        		<div class="am-g">
							<div class="am-u-sm-4">
								<img src="../Style/index-images/activity/s3-3.png" alt="屋" class="am-img-responsive ani" style="width: 110px;float: right; margin-top: -45px;" swiper-animate-effect="shake" swiper-animate-duration="1.0s" swiper-animate-delay="0s"/>
							</div>
  							<div class="am-u-sm-8">
  								<img src="../Style/index-images/activity/s3-4.png" alt="屋" class="am-img-responsive ani" style="width: 40px;float: left; margin-top: 0px;" swiper-animate-effect="slideInRight" swiper-animate-duration="1.4s" swiper-animate-delay="0s"/>
  								<img src="../Style/index-images/activity/s3-5.png" alt="屋" class="am-img-responsive ani" style="width: 60px;float: right; margin-top: -15px; margin-right: 20%;" swiper-animate-effect="slideInLeft" swiper-animate-duration="1.7s" swiper-animate-delay="1.0s"/>
  							</div>
						</div>
		        		
		        	</div>
					
		        </section>
		        
			<!-------------slide5----------------->       
		  		<section class="swiper-slide swiper-slide5 swiper-slide-v" style="height: 100%;">
		        	<div style="width: 100%; height: 33%; background: url(../Style/index-images/activity/bg-22.jpg); background-size: cover;">
		        		<p style="padding-top: 20%;"><img src="../Style/index-images/activity/sss5-1.png" alt="2016年收货了干货" class="am-img-responsive" style="width: 80%; margin: 0 auto; padding-top: 17px;"/></p>
		  				
		        	</div>
		        	<div style="width: 100%;height: 55%;background-color: rgb(255,241,0);">
		        		<p class="ani" style="width: 80%;color: rgb(240,93,0);text-align: center; margin: 0 auto; font-size: 16px; padding-top: 6%;" swiper-animate-effect="bounceIn" swiper-animate-duration="0.8s" swiper-animate-delay="0.3s">您通过购物、评论、红包收获了</p>
		        		<p class="ani" style="width: 80%;height: 50px; line-height: 46px ;color: rgb(240,93,0); text-align: center; border: solid 2px rgb(240,93,0); border-radius: 3px; font-size: 25px; margin: 0 auto; margin-top: 6%; font-weight: bold;" swiper-animate-effect="bounceIn" swiper-animate-duration="0.8s" swiper-animate-delay="0.8s"><?php echo ($points); ?>&nbsp;<span style="font-size: 20px;">张范票</span></p>
		        		<p class="ani" style="width: 82%;color: rgb(240,93,0);text-align: center; margin: 0 auto; font-size: 14px; margin-top: 5%;" swiper-animate-effect="bounceIn" swiper-animate-duration="0.8s" swiper-animate-delay="1.2s">（要知道，范团是干粮，范票也是钱啊）</p>
		        		<p class="ani" style="width: 80%;color: rgb(240,93,0);text-align: center; margin: 0 auto; font-size: 14px; margin-top: 5%; line-height: 26px;" swiper-animate-effect="bounceIn" swiper-animate-duration="0.8s" swiper-animate-delay="1.7s">范票还可以发红包，与好友分享快乐，小范票，大乐趣</p>
		        	</div>
		        	
		        	<div style="width: 100%; height: 12%;background-color: rgb(153,108,51);">
		        		<div class="am-g">
							<div class="am-u-sm-4">
								<img src="../Style/index-images/activity/s3-3.png" alt="屋" class="am-img-responsive ani" style="width: 110px;float: right; margin-top: -45px;" swiper-animate-effect="shake" swiper-animate-duration="1.0s" swiper-animate-delay="0s"/>
							</div>
  							<div class="am-u-sm-8">
  								<img src="../Style/index-images/activity/s3-4.png" alt="屋" class="am-img-responsive ani" style="width: 40px;float: left; margin-top: 0px;" swiper-animate-effect="slideInRight" swiper-animate-duration="1.4s" swiper-animate-delay="0s"/>
  								<img src="../Style/index-images/activity/s3-5.png" alt="屋" class="am-img-responsive ani" style="width: 60px;float: right; margin-top: -15px; margin-right: 20%;" swiper-animate-effect="slideInLeft" swiper-animate-duration="1.7s" swiper-animate-delay="1.0s"/>
  							</div>
						</div>
		        		
		        	</div>
					
		        </section>
		
			<!-------------slide6----------------->       
		  		<section class="swiper-slide swiper-slide6 swiper-slide-v" style="height: 100%;">
		        	<div style="width: 100%; height: 33%; background: url(../Style/index-images/activity/bg-22.jpg); background-size: cover;">
		        		<p style="padding-top: 20%;"><img src="../Style/index-images/activity/sss6-1.png" alt="2016年购买的品类" class="am-img-responsive" style="width: 80%; margin: 0 auto; padding-top: 25px;"/></p>
		  				
		        	</div>
		        	<div style="width: 100%;height: 55%;background-color: rgb(255,241,0);">
		        		<?php if($cnt != 0): ?><div id="container" style="width:100%;height:100%; background-color: none;"></div>
						<?php else: ?>
							<p class="ani" style="color: rgb(240,93,0); font-size: 18px; text-align: center; padding-top: 20%;" swiper-animate-effect="rubberBand" swiper-animate-duration="0.9s" swiper-animate-delay="0.5s">你还没购物记录~~</p><?php endif; ?>
		        	</div>
		        	
		        	<div style="width: 100%; height: 12%;background-color: rgb(153,108,51);">
		        		<div class="am-g">
							<div class="am-u-sm-4">
								<img src="../Style/index-images/activity/ss4-2.png" alt="屋" class="am-img-responsive ani" style="width: 100px;float: right; margin-top: -40px;" swiper-animate-effect="tada" swiper-animate-duration="1.2s" swiper-animate-delay="2s"/>
							</div>
  							<div class="am-u-sm-8">
  								<p class="ani" style="color: white; font-size: 17px; margin-top: 12px;text-align: center;" swiper-animate-effect="bounce" swiper-animate-duration="0.9s" swiper-animate-delay="2s">全球爆品，一手掌握</p>
  							</div>
						</div>
		        		
		        	</div>
					
		        </section>
		        
		        
	        <!-------------slide7----------------->       
		  		<section class="swiper-slide swiper-slide7 swiper-slide-v" style="height: 100%;">
		        	<div style="width: 100%; height: 33%; background: url(../Style/index-images/activity/bg-22.jpg); background-size: cover;">
		        		<p style="padding-top: 30%;"><img src="../Style/index-images/activity/sss7-1.png" alt="成为经纪人" class="am-img-responsive" style="width: 70%; margin: 0 auto;"/></p>
		        	</div>
		        	<div style="width: 100%;height: 55%;background-color: rgb(255,241,0); text-align: center; font-size: 15px;">
		        		<div>
		  					<img src="../Style/index-images/activity/s7-2.png" alt="" class="am-img-responsive ani" style="width: 110px; margin: 0 auto; padding-top:0px;" swiper-animate-effect="slideInRight" swiper-animate-duration="0.9s" swiper-animate-delay="0s"/>		  							  					
		  				</div>
		  				<p class="ani" style="width: 80%; color: rgb(240,93,0);font-size: 19px; margin: 0 auto; text-align: center; margin-top: 5%;" swiper-animate-effect="rotateInUpLeft" swiper-animate-duration="1.0s" swiper-animate-delay="0.5s">每天都有人在团洋范赚得盆满钵满</p>
		  				<p class="ani" style="width: 80%; color: rgb(240,93,0);font-size: 19px; margin: 0 auto; text-align: center; margin-top: 5%;" swiper-animate-effect="rotateInUpLeft" swiper-animate-duration="1.0s" swiper-animate-delay="0.9s">如果你也想边花边赚的话</p>
		  				<p class="ani" style="width: 80%; color: rgb(240,93,0);font-size: 19px; margin: 0 auto; text-align: center; margin-top: 5%;" swiper-animate-effect="rotateInUpLeft" swiper-animate-duration="1.0s" swiper-animate-delay="1.5s">注册成为我们店长吧</p>
		        	</div>
		        	<div style="width: 100%; height: 12%;background-color: rgb(153,108,51);">
		        		<div class="am-g">
							<div class="am-u-sm-4">
								<img src="../Style/index-images/activity/s2-3.png" alt="屋" class="am-img-responsive ani" style="width: 100px;float: right; margin-top: -40px;" swiper-animate-effect="tada" swiper-animate-duration="1.2s" swiper-animate-delay="2s"/>
							</div>
  							<div class="am-u-sm-8">
  								<p class="ani" style="color: white; font-size: 17px; margin-top: 12px;text-align: center;" swiper-animate-effect="bounce" swiper-animate-duration="0.9s" swiper-animate-delay="2s">一边购物，一边赚钱</p>
  							</div>
						</div>
		        		
		        	</div>
					
		        </section>
		      
		    <!----------------slide8-------------->
		        <section class="swiper-slide swiper-slide8 swiper-slide-v" style="height: 100%; background: url(../Style/index-images/activity/s8-1.jpg); background-size: cover;">
		        	<div style="margin-top: 65%; text-align: center; color: rgb(235,94,0); font-size: 18px; font-weight: bold;">
		        		<p class="ani css836f340f917d61" swiper-animate-effect="slideInUp" swiper-animate-duration="1s" swiper-animate-delay="0s">最长情的告白是陪伴</p>
		        		<p style="margin-top: 10px;" class="ani" swiper-animate-effect="slideInUp" swiper-animate-duration="2.5s" swiper-animate-delay="0s">2017年，我想要和你发生</p>
		        		<p style="margin-top: 10px;" class="ani" swiper-animate-effect="slideInUp" swiper-animate-duration="3s" swiper-animate-delay="0s">更多的故事，好吗？</p>
		        		<button onclick="location.href='<?php echo U('User/open_shop');?>'" style="width: 190px; height: 30px; color: rgb(240,93,0); font-size: 14px; background-color: white; border: none; border-radius: 16px;margin-top:25px;" class="ani" swiper-animate-effect="slideInUp" swiper-animate-duration="3.5s" swiper-animate-delay="0s">一起来做有范的自己</button>
		        		<button onclick="location.href='<?php echo U('Activity/review_2016_consumer');?>'" style="width: 190px; height: 30px; color: white; font-size: 14px; background-color: rgb(232,104,32); border: none; border-radius: 16px; margin-top: 20px;" class="ani" swiper-animate-effect="slideInUp" swiper-animate-duration="4.5s" swiper-animate-delay="0s">查看团洋范我的2016</button>
		        	</div>
		        </section>
		        
	    	</div>
	    	
	    	<!-------------箭头-------------->
			<div class="arrow-box" style="height: 100px; background-color: none;">
	   			<img src="../Style/index-images/activity/up-a.png" id="array" style="width: 30px; height: 30px;"> 
	   		</div>   
	   		
   			<!-------------分页-------------->
  			<div class="swiper-pagination"></div>
  			
  			<!-------------音乐-------------->
	   		<div class="music" style="width: 50px; height: 50px; z-index: 1000; position: fixed; right: 0px; top: 55px;">
	       		<img src="../Style/index-images/activity/icon-muisc.png" class="open" num="1" style="width: 30px; height: 30px; margin-top: 10px; margin-left: 10px;"/>
	        	<audio id="aud" src="../Style/music/Hit Tunes - Unconditionally (Originally Performed by Katy Perry) - Instrumental.mp3" loop="loop" autoplay></audio>
	    	</div>
	    	
	    	<!----------------关闭------------->
	    	<div style="width: 20px; height: 20px;position: fixed; left: 10px; top: 10px; z-index: 999;" onClick="window.history.back(-1);">
	    		<img src="../Style/index-images/activity/h5-close.png" alt="关闭" class="am-img-responsive"/>
	    	</div>
	    	
	    	<!----------------分享------------->
	    	<div class="new-share" style="width: 20px; height: 20px;position: fixed; right: 10px; top: 10px; z-index: 999;">
	    		<img src="../Style/index-images/activity/h5-chare.png" alt="关闭" class="am-img-responsive"/>
	    	</div>
	    	
			<div id="mcover" onclick="document.getElementById('mcover').style.display='';" style="display:none;">
				<img src="../Style/images/guide.png" />
			</div>
		</div>
		
	<link rel="stylesheet" href="../Style/css/swiper.min.css">
	<link rel="stylesheet" href="../Style/css/animate.min.css">
	<link rel="stylesheet" href="../Style/css/style4.css">
	<script src="../Style/js/swiper.min.js"></script>
	<script src="../Style/js/swiper.animate.min.js"></script>
	<script src="../Style/js/code.min.js"></script>
	<!--控制音乐-->
	<script>
        $(function(){
            $(".music").on("click",function(){
                if($(".music img").attr("num")=="1"){
                    $(".music img").addClass("open");
                    $(".music img").attr("num",2);
                   document.getElementById("aud").play();
                }
                else{
                    $(".music img").removeClass("open");
                    $(".music img").attr("num",1);
                    document.getElementById("aud").pause();
                }
            });
        });
   	</script>
   	<!--分享遮罩-->
	<script type="text/javascript">
		$(function(){
			$(".new-share").on("click",function(){
				$("#mcover").show();
				return false;
			});
		});
	</script>
	<!--数据图形-->
	<script src="http://img.hcharts.cn/highcharts/highcharts.js" type="text/javascript" charset="utf-8"></script>
	<script src="http://img.hcharts.cn/highcharts/modules/exporting.js" type="text/javascript" charset="utf-8"></script>
   	<script type="text/javascript">
   		$(function () {
		    $('#container').highcharts({
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false
		        },
		        title: {
		            text: ''
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: true,
		                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                    style: {
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'rgb(240,93,0)'
		                    }
		                }
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: 'Browser share',
		            data: [
		                <?php echo ($cateInfo); ?>
		            ]
		        }]
		    });
		});

   	</script>

	</body>

</html>