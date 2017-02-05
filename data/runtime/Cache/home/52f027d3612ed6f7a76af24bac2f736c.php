<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>申请退款</title>
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




		<style>
			*{
				outline: none;font-family: "微软雅黑";
			}
			/*头部*/
			.topnav{
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;background-color: rgb(240,93,0);
			}
			.topnav img{
				position:absolute; left:5px; top:14px;
			}
			/*头部E*/
			
			/*表单S*/
			.form {
				width: 100%;background-color: white;margin-top: 10px;padding: 6px;color:#555;
			}
			.form i{
				color: rgb(240,93,0); position: absolute; left: 91%; top: 29px;
			}
			.form p {
				font-size: 14px;
			}
			.form span {
				color: red;
			}
			.form input {
				width: 100%;color: #555;border: none;outline: none;padding-left: 20px;padding-right: 25px;border-bottom: 1px solid #eee; <!-- text-align: center; -->
			}
			.form textarea {
				width: 100%;color: #555;border: none;border-bottom: solid 1px #eee; max-height: 40px;
			}
			/*表单E*/
			
			/*提交按钮*/
			#btn {
				width: 100%;height: 45px;background-color: white;margin-top: 10px;text-align: center;line-height: 45px;font-size: 15px;color: rgb(240, 93, 0);
			}
			 /*验证消息弹出框*/
			.showinfo {
	        	position: fixed;left: 50%;bottom: 180px;z-index: 99999;border-radius: 5px;background: #000;opacity: 0.9;filter: alpha(opacity=90);
	        	padding: 0 5px;height: 38px;box-shadow: 0px 0px 10px #000;color: #FFFFFF;text-align: center;line-height: 38px;font-size: 14px;display: none;
	        }
		</style>
		<link rel="stylesheet" type="text/css" href="../Style/css/animate.min.css"/>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	</head>

	<body>
		<!--头部-->
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25"/>
			</a>
			申请退款
		</div>
		<!--表单-->
		<form action="./index.php?m=Order&a=orderTK" name="tk" id="refund_form" method="post" enctype="multipart/form-data" >
		<input type="hidden" name="orderId" value="<?php echo ($order["orderId"]); ?>"/>
		<input type="hidden" name="zhanghao" value="<?php echo ($user["zhanghao"]); ?>"/>
		<input type="hidden" name="huming" value="<?php echo ($user["huming"]); ?>"/>
		<input type="hidden" name="kaihuhang" value="<?php echo ($user["kaihuhang"]); ?>"/>
		<input type="hidden" name="detail_id" value="<?php echo ($_GET['detail_id']); ?>"/>
		
		<div class="form" style="position: relative; left: 0px;">
			<p>退款金额：<span>*</span></p>
			<i class="am-icon-cny" style="position: absolute; left: 12px; top: 29px; color:#555; <!-- rgb(180,180,180); -->"></i>
			<?php if($order["price"] != ''): ?><input type="text" name="refund" value="<?php echo ($order["price"]); ?>"/>
				<?php else: ?>
				<input type="text" name="refund" value="<?php echo ($order["order_sumPrice"]); ?>"/><?php endif; ?>
		</div>
		<div class="form">
			<p>退款原因：<span>*</span></p>
			<textarea name="yuanyin"></textarea>
		</div>
		<?php if($order["title"] != ''): ?><div class="form">
				<p>宝贝名称：<span>*</span></p>
				<input type="text" value="<?php echo ($order["title"]); ?>" name="detail_title"/>
			</div><?php endif; ?>
		<div class="form" style="position: relative; top: 0; left: 0;">
			<p>退款类型：
				<label class="am-checkbox" style="margin: 2px 5px 0px 2%; color: rgb(85,85,85); font-size: 12px; float: right;">
      				<input id="ck" type="checkbox" name="ck" value="1" data-am-ucheck>
      				是否需要退货
    			</label>
			</p>
			<div style="clear: both;"></div>
		</div>
		
		
		
		<div id="wuliu" style="display: none;">
			<div class="form">
				<p>物流公司：<span>*</span></p>
				<input type="text" name="express" value=""/>
			</div>
			<div class="form">
				<p>退货运单号：<span>*</span></p>
				<input type="text" name="waybill" value=""/>
			</div>
		</div>
		
		<!--提交按钮-->
		<div id="btn" onClick="javascript:return checkvalue();">
			<p>提交申请&nbsp;&nbsp;<i class="am-icon-send-o"></i></p>
		</div>
		<div class="showinfo animated shake"></div>

		<script type="text/javascript">
			$(function(){
				$("#ck").on("click",function(){
					if($(this).is(":checked")){
						$("#wuliu").slideDown();
					}
					else{
						$("#wuliu").slideUp();
					}
				});
			});
		</script>
		<script type="text/javascript">
			$(function(){
				$("#btn").click(function(){
					var refund = $("input[name='refund']").val();
					var yuanyin = $("textarea[name='yuanyin']").val();
					var express = $("input[name='express']").val();
					var waybill = $("input[name='waybill']").val();
				
					if(refund==''){
						var content = $('.showinfo').html('请填写退款金额');
						var w = content.width()/2;
						$(".showinfo").css("margin-left",-w);
						$(".showinfo").show().delay(3000).fadeOut();
						return false;  
					 }
					if(isNaN(refund)){
						var content = $('.showinfo').html('请填写数字金额');
						var w = content.width()/2;
						$(".showinfo").css("margin-left",-w);
						$(".showinfo").show().delay(3000).fadeOut();
						return false;  
					 }

					if(yuanyin==''){
						var content = $('.showinfo').html('请填写退款原因');
						var w = content.width()/2;
						$(".showinfo").css("margin-left",-w);
						$(".showinfo").show().delay(3000).fadeOut();
						return false;  
					}
					if($("#ck").is(":checked")){
						if(express==''){
							var content = $('.showinfo').html('请填写物流公司');
							var w = content.width()/2;
							$(".showinfo").css("margin-left",-w);
							$(".showinfo").show().delay(3000).fadeOut();
							return false;  
						 }
						 if(waybill==''){
							var content = $('.showinfo').html('请填写退货运单号');
							var w = content.width()/2;
							$(".showinfo").css("margin-left",-w);
							$(".showinfo").show().delay(3000).fadeOut();
							return false;  
						 }
					}
					$("#refund_form").submit(); 
				});
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