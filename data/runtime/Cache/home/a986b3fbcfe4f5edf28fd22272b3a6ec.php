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
			.showinfo{ position:absolute;top:60%;left:35%;border-radius:5px;background:#000;opacity:0.8;-moz-opacity:0.8;filter:alpha(opacity=80);width:auto;height:38px;box-shadow:0px 0px 10px #000;margin:-60px auto;color:#FFFFFF; text-align:center; line-height:38px;font-size:14px;display:none;z-index:999;}
			.topnav {
				z-index: 999;
				position: fixed;
				width: 100%;
				height: 49px;
				background: rgb(240,93,0);
				text-align: center;
				color: #fff;
				font-size: 18px;
				line-height: 49px;
				top: 0;
			}
			
			.topnav .back {
				position: absolute;
				left: 8px;
				top: 6px;
				margin-top: -8px;
			}
			
			/*个人信息S*/
			#user-info{
				margin-top: 55px;
			}
			#user-info li{
				height: 40px; 
				line-height: 20px; 
			}
			#user-info li:first-child img{     /*头像*/
				float: right; 
				width: 70px; 
				height: 70px;
			}
			#user-info li,#user-info li:first-child,#user-info li:last-child{
				padding: 10px;
			}
			#user-info li:first-child{
				height: 90px;
				line-height: 70px;
			}
			#user-info li:last-child{
				height: 60px; 
				line-height: 40px; 
			}
			#user-info  ul li span:first-child{
				color: #555;
				font-size: 13px;
			}
			#user-info  ul li span:last-child{
				color: rgb(102,102,102);
				font-size: 14px;
			}
			#user-info .upload-bg{
				width:120px; 
				height: 40px; 
				margin-top: -5px; 
				margin-left: 5px;
			}
			/*个人信息E*/
			
			/*保存信息*/
			#save-info{
				width: 94%; 
				height: 50px; 		
				font-size: 15px; 
				text-align: center; 
				line-height: 50px; 
				margin: 0 auto;
				margin-top: -10px;
				color: rgb(240,93,0); 
				background-color: white; 
			}
	        #upload-pic{
  			  position: relative;
  			  width: 12%;  
  			  top: -41px;
    		  left: 73px;
	        }
	        #upload-pic input
	        {
	            opacity:0;
	            filter:alpha(opacity=0);
	            height: 100%;
	            width: 100%;
	            position: absolute;
	            top: 0;
	            left: 5px;
	            z-index: 9;
	        }
		</style>
		
		<script>
		$(function(){
			$("#check").click(function(){
				var username = $("input[name='username']").val();
				var phone_mob = $("input[name='phone_mob']").val();
				var email = $("input[name='email']").val();
				var zhanghao = $("input[name='zhanghao']").val();
				var huming = $("input[name='huming']").val();
				if(username==""){
					var str = "昵称还未填写"
					$(".showinfo").html(str).show().delay (3000).fadeOut();return;
				}
				
				if(phone_mob==""){
					var str = "手机号码还未填写"
					$(".showinfo").html(str).show().delay (3000).fadeOut();return;
				}
				
				if(email==""){
					var str = "邮箱地址还未填写"
					$(".showinfo").html(str).show().delay (3000).fadeOut();return;
				}
				
				if(zhanghao==""){
					var str = "收款帐号还未填写"
					$(".showinfo").html(str).show().delay (3000).fadeOut();return;
				}
				
				if(huming==""){
					var str = "收款人姓名还未填写"
					$(".showinfo").html(str).show().delay (3000).fadeOut();return;
				}
				$("form").submit();
				
			});
		});
		</script>
	</head>

	<body>
		<!--头部-->
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			个人信息
		</div>
		<div class="showinfo"></div>
		<!--个人信息-->
		<form method="post" action="<?php echo U('User/user_info');?>" name="myForm" enctype="multipart/form-data">
		<div id="user-info">
			<div data-am-widget="list_news" class="am-list-news am-list-news-default" >
				<div class="am-list-news-bd">
					<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
					<ul class="am-list">
						
						<li class="am-g am-list-item-dated">
							<span>头像</span>
							<!-- <img src="<?php echo ($info["cover"]); ?>" alt="用户头像" class="am-img-thumbnail am-circle"/> -->
							<?php if($info["hyimg"] != ''): ?><img src="<?php echo ($info["hyimg"]); ?>"alt="用户头像" class="am-img-thumbnail am-circle"/>
							<?php else: ?><img src="<?php echo ($info["cover"]); ?>" alt="用户头像" class="am-img-thumbnail am-circle"/><?php endif; ?>
						</li>
						
						<li class="am-g am-list-item-dated">
							<span>昵称：</span>
							<span><input type="text" name="username" value="<?php echo ($info["username"]); ?>" style="line-height:15px;background-color: transparent;border:none;"/></span>
						</li>
						
						<li class="am-g am-list-item-dated">
							<span>手机号码：</span>
							<span><input type="text" name="phone_mob" value="<?php echo ($info["phone_mob"]); ?>" placeholder="输入手机号码" style="line-height:15px;background-color: transparent;border:none;"/></span>
						</li>
						
						<li class="am-g am-list-item-dated">
							<span>邮箱地址：</span>
							<span><input type="text" name="email" value="<?php echo ($info["email"]); ?>" placeholder="输入邮箱地址" style="line-height:15px;background-color: transparent;border:none;"/></span>
						</li>
						
						<li class="am-g am-list-item-dated">
							<span>收款账号：</span>
							<span><input type="text" name="zhanghao" value="<?php echo ($info["zhanghao"]); ?>" placeholder="银行卡卡号/支付宝账号" style="width:70%;line-height:15px;background-color: transparent;border:none;"/></span>
						</li>
						
						<li class="am-g am-list-item-dated">
							<span>收款人姓名：</span>
							<span><input type="text" name="huming" value="<?php echo ($info["huming"]); ?>" placeholder="与银行卡姓名相同"  style="width:60%;line-height:15px;background-color: transparent;border:none;"/></span>
						</li>
						
						<li class="am-g am-list-item-dated">
							<span>开户银行/支付平台：</span>
							<span><select id="doc-select-1" name="kaihuhang" style="border:1px solid #dcdcdc;">
							<?php if(is_array($bank)): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($info["kaihuhang"]) == $vo["id"]): ?>selected<?php endif; ?> ><?php echo ($vo["bank"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select></span>
						</li>
					
						<li class="am-g am-list-item-dated">
							<span style="height: 60px;">更换头像：</span>
							<div id="upload-pic">
							<input type="file" name="avatar" id="up-pic">
							<span ><img class="upload-bg" src="../Style/index-images/upload.jpg" alt="上传" style="width:125px"/></span></div>
						</li>	
					</ul>
				</div>
		
			</div>
		</div>
		<!--保存信息-->
		<div id="save-info">
			<input type="button"  value="保存信息" class="submit_btn" style="background-color: transparent; height: 100%; width: 100%;" id="check"/>
		</div>
		</form>
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
<script type="text/javascript">
function subm(){
    document.myForm.submit();
}
</script>