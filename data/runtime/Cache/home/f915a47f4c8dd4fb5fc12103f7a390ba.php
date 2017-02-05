<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<title>评价晒单</title>
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
			
			#comm ul li{
				margin-top: 15px;
			}
			#comm ul li:first-child{
				margin-top: 49px;
			}
			#order{
				margin-top: 49px; background-color: white;
			}
			#order:first-child{
				margin-top: 0px;
			}
			#order .num{
				border-bottom: solid 1px rgb(237,237,237); padding: 7px; color: rgb(85,85,85);
			}
			
			#order .pro-name{
				margin-top: 5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding-left: 10px; color: rgb(85,85,85);
			}
			#order .pro-pri{
				margin-top: 10px;color: rgb(138,138,138);padding-left: 10px; 
			}
			
			#comment{
				border-top: solid 1px rgb(236,236,236); position: relative; left: 0px;
			}
			#comment textarea{
				width: 100%; border: none; background-color: rgb(243,243,243); padding-left: 10px; padding-top: 10px; padding-bottom: 5px; outline: none; color: rgb(85,85,85);
			}
			#comment p{
				position: absolute; right: 10px; bottom: 3px; color: rgb(171,171,171);
			}
			
			#upload-img{
				background-color: white; padding: 7px; padding-bottom: 16px;
			}
			#upload-img .title{
				color: rgb(85,85,85); font-size: 13px;
			}
			#upload-img .am-u-sm-4{
				position: relative; left: 0px;
			}
			#upload-img .am-u-sm-4 img{
				width: 68px; height:67px; margin: 0 auto;
			}
			#upload-img .am-u-sm-4 input{
				width: 100%; height: 100%;border: solid 1px red; position: absolute; left: 0px; top: 0px; opacity: 0;
			}
			#submit{
				width: 97%; height: 40px; line-height: 40px;background-color: rgb(240,93,0); color: white; text-align: center; font-size: 17px; margin: 0 auto; border-radius: 4px; margin-top: 25px; margin-bottom: 30px;
			}
			 /*验证消息弹出框*/
			.showinfo {
	        	position: fixed;left: 50%;bottom: 180px;z-index: 99999;border-radius: 5px;background: #000;opacity: 0.9;filter: alpha(opacity=90);
	        	padding: 0 5px;height: 38px;box-shadow: 0px 0px 10px #000;color: #FFFFFF;text-align: center;line-height: 38px;font-size: 14px;display: none;
	        }
		</style>
		<link rel="stylesheet" href="../Style/css/animate.min.css" />
	</head>

	<body style="background-color: rgb(243,243,243);">
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			评价晒单
		</div>
		
		<div id="comm">
		<form action="index.php?m=Order&a=orderBBS" method="post" name="comment_form" id="comment_form" enctype="multipart/form-data">
			<ul>
				<li>
					<div id="order">
						<p class="num">订单号：<?php echo ($orderId); ?> </p>
						<div class="am-g" style="padding: 7px;">
  							<div class="am-u-sm-3">
  								<img src="data/upload/item/<?php echo ($item['img']); ?>" alt="商品" class="am-img-responsive" style="width:80px;"/>
  							</div>
  							<div class="am-u-sm-9">
  								<p class="pro-name"><?php echo ($item['title']); ?></p>
  								<p class="pro-pri">优品价：<span style="color: rgb(240,93,0); ">￥<?php echo ($item['price']); ?></span></p>
  							</div>
						</div>
					</div>
					<input type="hidden" name="orderId" value="<?php echo ($orderId); ?>">
					<input type="hidden" name="itemId" value="<?php echo ($itemId); ?>">
					<input type="hidden" name="size" value="<?php echo ($item['size']); ?>">
					<div id="comment">
						<textarea onkeyup="checkLength(this);" name="info" rows="5" cols="" placeholder="写点评价吧，其他饭团会很希望看到它..."></textarea>
						<p><i class="am-icon-edit am-icon-sm"></i>&nbsp;您还可以输入<span id="sy" style="color:rgb(240,93,0);">120</span>个字</p>
					</div>
		
					<div id="upload-img">
						<p class="title">评价晒图</p>
						<div class="am-g" style="margin-top: 10px;">
			  				<div class="am-u-sm-4">
			  					<img src="../Style/index-images/p-img.png" id="img_1"  class="am-img-responsive"/>
			  					<input type="file" name="picurl1" onchange="dochance(this,'1')"/>
			  				</div>
			  				<div class="am-u-sm-4">
			  					<img src="../Style/index-images/p-img2.png" id="img_2" class="am-img-responsive"/>
			  					<input type="file" name="picurl2" onchange="dochance(this,'2')"/>
			  				</div>
			  				<div class="am-u-sm-4">
			  					<img src="../Style/index-images/p-img2.png" id="img_3" class="am-img-responsive"/>
			  					<input type="file" name="picurl3" onchange="dochance(this,'3')"/>
			  				</div>
						</div>
					</div>
					<img src="../Style/index-images/p-line.png" alt="" class="am-img-responsive" style="width: 100%; height: 3px;"/>
				</li>
			</ul>
			<div id="submit">
				提交评价&nbsp;<i class="am-icon-send"></i>
			</div>
		</div>
		
		
		<div class="showinfo animated shake"></div>
		<script>	
			function dochance(input,j){
				var objUrl = getObjectURL(input.files[0]) ;
				console.log("objUrl = "+objUrl) ;
				if (objUrl) {
					$("#img_"+j).attr("src", objUrl) ;
				}
			}

			//建立一個可存取到該file的url
			function getObjectURL(file) {
				var url = null ; 
				if (window.createObjectURL!=undefined) { // basic
					url = window.createObjectURL(file) ;
				} else if (window.URL!=undefined) { // mozilla(firefox)
					url = window.URL.createObjectURL(file) ;
				} else if (window.webkitURL!=undefined) { // webkit or chrome
					url = window.webkitURL.createObjectURL(file) ;
				}
				return url ;
			}
		</script>
		<script type="text/javascript">
			function checkLength(which) {
				var maxChars = 120; //
				if(which.value.length > maxChars){
					var content = $('.showinfo').html('您输入的字数超过限制啦~');
					var w = content.width()/2;
					$(".showinfo").css("margin-left",-w);
					$(".showinfo").show().delay(3000).fadeOut();
					// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
					which.value = which.value.substring(0,maxChars);
					return false;
				}else{
					var curr = maxChars - which.value.length; 
					document.getElementById("sy").innerHTML = curr.toString();
					return true;
				}
			}
			
		</script>
		<script type="text/javascript">
			$(function(){
				$("#submit").on("click",function(){
					var com = $("textarea[name='comment']").val();
					if(com==''){
						var content = $('.showinfo').html('写点评论语呗~');
						var w = content.width()/2;
						$(".showinfo").css("margin-left",-w);
						$(".showinfo").show().delay(3000).fadeOut();
						return false;  
					 }
					$("#comment_form").submit(); 
				});
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