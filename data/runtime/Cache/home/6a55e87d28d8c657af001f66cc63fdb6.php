<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<title>报名一周年活动</title>
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
			.topnav .back{
				position: absolute;left: 8px;top: 6px;margin-top: -8px;
			}
			.topnav img{
				position: absolute;top: 14px;left: 5px;
			}
			
			/*报名*/
			#sign{
				border: solid 2px rgb(240,93,0); position: relative; left: 0px; margin: 10px; margin-top: 25px; border-radius: 4px; background-color: rgb(255,217,144);
			}
			#sign .s-title{
				text-align: center; font-size: 15px; color: rgb(240,93,0); font-weight: bold; margin-top: 8px;
			}
			#sign .s-input{
				width: 70%; height: 25px;border: solid 1px rgb(163,151,130); border-radius: 3px; background-color: rgb(237,224,205); color: rgb(85,85,85); margin-left: -35%; padding-left: 10px;
			}
			#sign .s-c-title{
				padding-left: 5%; margin-top: -7px; color: rgb(85,85,85); font-size: 13px;
			}
			#sign .s-btn{
				text-align: center; margin-top: -25px; margin-bottom: 15px;
			}
			#sign .s-btn button{
				width: 125px; height: 30px;background-color: rgb(240,93,0); color: rgb(237,224,205); border: solid 2px rgb(254,216,100); border-bottom: solid 4px rgb(254,216,100); border-radius: 7px; font-size: 13px;
			}
			.am-radio .am-icon-checked:before, .am-radio-inline .am-icon-checked:before{
			    content: "\f004"; color: red;
			}
			
			/*活动规则*/
			#tips{
				width: 94%; padding: 10px; background-color: rgb(255,217,144); border: solid 1px rgb(195,183,164); border-radius: 3px; margin: 0 auto; color: rgb(85,85,85); margin-top: 15px;margin-bottom: 20px;
			}
			#tips .title{
				text-align: center; font-size: 14px; color: rgb(240,93,0); margin-top: 5px;
			}
			.am-divider-default{
			    border-top: 1px solid rgb(85,85,85);
			}
			/*验证消息弹出框*/
			.showinfo-t{
	        	position: fixed;left: 50%;bottom: 180px;z-index: 99999;border-radius: 5px;background: #000;opacity: 0.9;filter: alpha(opacity=90);
	        	padding: 0 5px;height: 38px;box-shadow: 0px 0px 10px #000;color: #FFFFFF;text-align: center;line-height: 38px;font-size: 14px;display: none;
	        }
		</style> 
		<link rel="stylesheet" type="text/css" href="../Style/css/swiper.min.css"/>
		<link rel="stylesheet" type="text/css" href="../Style/css/animate.min.css"/>
		<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
		<script src="../Style/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="../Style/js/swiper.animate.min.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body style="background-color: rgb(255,245,179);">
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">  
				<img src="../Style/images/fanhui1.png" width="25" />  
			</a>
			报名一周年活动
		</div>
		<div style="margin-top: 70px;">
			<img src="../Style/index-images/activity/oneyear-title.png" alt="标题" class="am-img-responsive"/>
		</div>
		
		<div class="swiper-container" style="margin-top: 49px;">
			<div class="swiper-wrapper p1">
				<section class="swiper-slide">
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="1.7s"><img src="../Style/index-images/activity/xin-1.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="2.6s"><img src="../Style/index-images/activity/xin-2.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="3.0s"><img src="../Style/index-images/activity/xin-3.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="3.5s"><img src="../Style/index-images/activity/xin-4.png" class="am-img-responsive"/></div>
					<div class="ani" swiper-animate-effect="zoomInLeft" swiper-animate-duration="3.9s"><img src="../Style/index-images/activity/xin-5.png" class="am-img-responsive"/></div>
				</section>   
			</div>
		</div>
		
		<!------------报名2------------->
		<div id="sign">
			<p class="s-title">【我要报名】</p>
			<input class="s-input" name="uname" type="text" placeholder="姓名" style="position: absolute; left: 50%; top: 50px; margin-left: -35%; padding-left: 10px;"/>
			<br />
			<input class="s-input" name="phone" type="text" placeholder="电话" style="position: absolute; left: 50%; top: 90px;"/>
			<br />
			<input class="s-input" name="wechat_num" type="text" placeholder="微信号" style="position: absolute; left: 50%; top: 130px;"/>
			<hr data-am-widget="divider" style="width: 90%; margin-top: 100px;" class="am-divider am-divider-default"/>
			<p style="text-align: center; font-size: 14px; color: rgb(85,85,85); margin-bottom: 10px;">
				<span>
					参加时间：2016年12月
					&nbsp;
					<select id="sel" name="join_date" style="-webkit-appearance: none; background-color: rgb(255,217,144); border: none; margin-top: -2px; outline: none;">
						<option value="0">--</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
					</select>
					&nbsp;<i class="am-icon-angle-down"></i>&nbsp;
					日中午
				</span>
			</p>
			<p style="text-align: center; margin-bottom: 15px; margin-top: 25px;">
				<button id="submit" style="width: 110px; height: 30px; border: solid 2px rgb(230,186,38); background-color: rgb(241,93,53); color: rgb(254,235,151); border-radius: 5px;">确认报名</button>
			</p>
		</div>
		
		<!---------活动规则---------->
		<div id="tips">
			<p class="title">活动规则</p>
			<p>1、活动时间：2016年12月10日—16日中午</p>
			<p>2、活动地点：广州天河区天河CBD商圈</p>
			<p>3、报名完成后，“活动通知”客服会在微信公众号公布，敬请留意</p>
			<p>4、报名成功可获得公益红包，前往团洋范商城个人中心查收</p>
			<p>5、团洋范对本次活动保留最终解释权</p>
		</div>
		<div class="showinfo-t animated shake"></div>
		
		<button type="button" id="btn_success" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 300, height: 225}" style="display:none;">
  			报名成功
		</button>
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
		  <div class="am-modal-dialog" style="background: none;">
		    <div class="am-modal-bd" style="position: relative;left: 0px;">
		      	<div style="height: 220px;background-color: rgb(229,229,229); border: solid 2px rgb(240,93,0); border-radius: 5px;">
		      		<img src="../Style/index-images/activity/activity-close.png" alt="关闭按钮" data-am-modal-close style="width: 30px; position: absolute; right: 0px; top: -30px;"/>
		      		<p style="width: 170px;font-size: 25px; position: absolute; left: 50%; top: 45px; margin-left: -85px;">恭喜,报名成功</p>
		      		<p style="width: 260px;font-size: 14px; position: absolute; left: 50%; top: 95px; margin-left: -130px;">您已加入团洋范“爱心传递”行列，并且获得团洋范的“爱心传递”奖励，可到商城“我的-个人中心”查看</p>
		      		<button style="width: 100px; height: 28px;background-color: rgb(241,93,53); color: rgb(240,197,62); border: solid 1px rgb(240,197,62);border-bottom: solid 2px rgb(240,197,62); border-radius: 10px; position: absolute; left: 50%; top: 175px; margin-left: -50px;">去查看奖励</button>
		      	</div>
		    </div>
		  </div>
		</div>

		<!--验证报名表单-->
		
		<script type="text/javascript">
			$(function(){
				$("#submit").on("click",function(){
					var name = $("input[name='uname']").val();
					var phone = $("input[name='phone']").val();
					var wechat_num = $("input[name='wechat_num']").val();
					var join_date = $("#sel option:selected").val();
					if(name==""){
						var content = $('.showinfo-t').html('请填写报名人姓名');
						var w = content.width()/2;
						$(".showinfo-t").css("margin-left",-w);
						$(".showinfo-t").show().delay(3000).fadeOut();
						return false; 
					}
					if(phone==""){
						var content = $('.showinfo-t').html('请填写手机号码');
						var w = content.width()/2;
						$(".showinfo-t").css("margin-left",-w);
						$(".showinfo-t").show().delay(3000).fadeOut();
						return false; 
					}
					if(wechat_num==""){
						var content = $('.showinfo-t').html('请填写微信号');
						var w = content.width()/2;
						$(".showinfo-t").css("margin-left",-w);
						$(".showinfo-t").show().delay(3000).fadeOut();
						return false; 
					}
					if(join_date==0){
						var content = $('.showinfo-t').html('请选择参加时间');
						var w = content.width()/2;
						$(".showinfo-t").css("margin-left",-w);
						$(".showinfo-t").show().delay(3000).fadeOut();
						return false; 
					}
					
					var url="<?php echo U('Activity/do_signup_public');?>";
					$.getJSON(url,{join_date:join_date,uname:uname,phone:phone,wechat_num:wechat_num},function(data){
						if(data.status==1){
							$("#btn_success").click();
						}else{
							layer.open({
								title: '提示',
								content: data.msg,
								btn: ['确认', '取消'],
								yes: function(index){
									layer.close(index);
								}
							});
						}
					});
				})
			});
		</script>
		
		<!--初始化图片动画-->
		<script>        
		  	var mySwiper = new Swiper ('.swiper-container', {
			  	onInit: function(swiper){ //Swiper2.x的初始化是onFirstInit
			    swiperAnimateCache(swiper); //隐藏动画元素 
			    swiperAnimate(swiper); //初始化完成开始动画
		  	}, 
			  onSlideChangeEnd: function(swiper){ 
			    swiperAnimate(swiper); //每个slide切换结束时也运行当前slide动画
			  } 
  		})        
  	</script>
		<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
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
  <img id="tixing" src="../Style/index-images/activity/99tixing.png" alt="满99" style="width:110px; position:fixed; right:18%; bottom:49px; z-index:800; display: none;"/>
</div>
<script type="text/javascript">
	$(function(){
		$("#tixing").show();
		$("#tixing").addClass("slideExpandUp");
		$("#tixing").delay(4500).fadeOut();
	})
</script>

	</body>

</html>