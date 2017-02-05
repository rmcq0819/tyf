<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<title>登录代理商后台</title>
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




		<!--<style type="text/css">
			.logintitle {
				width: 100%;
				height: 40px;
				color: #797979;
				background: #f0f0f0;
				line-height: 40px;
				font-size: 16px;
				font-family: 微软雅黑;
				text-align: center;
				display: block;
				border-bottom: 1px solid #ddd;
			}
			
			.a1 {
				color: #3399FF;
				margin-right: 25px;
				font-size: 14px;
			}
			
			.pass {
				border: 1px solid #ddd;
				width: 100%;
				line-height: 40px;
				font-size: 14px;
			}
			
			.login {
				color: #009900;
				display: none;
			}
			
			.img {
				border-radius: 15px;
				width: 15px;
				height: 15px;
			}
			
			.showinfo {
				border-radius: 5px;
				background: #000;
				opacity: 0.6;
				-moz-opacity: 0.6;
				filter: alpha(opacity=60);
				width: 120px;
				height: 38px;
				box-shadow: 0px 0px 10px #000;
				margin: -60px auto;
				color: #FFFFFF;
				text-align: center;
				line-height: 38px;
				font-size: 14px;
				display: none;
			}
		</style>-->
		<style type="text/css">
			*{
				font-family: "微软雅黑";
				border: none;
				outline: none;
			}
			body{
				/*background: url(../Style/index-images/mer-bg.jpg) no-repeat; */
				background-size: cover;
			}
			/*返回S*/
			#login-back{
				margin-top: 20px; 
				margin-left: 20px;
			}
			#login-back img{
				width: 40px;
				height: 40px;
			}
			/*返回E*/
			
			/*团洋范logo S*/
			#logo{
				text-align: center; 
				margin-top: 30px;
			}
			/*团洋范logo E*/
			
			/*输入框组 S*/
			#input-form{
				text-align: center; 
				margin-top: 20px;
			}
			#input-form li{
				padding: 10px;
			}
			#input-form li:first-child input{                /*输入框图标*/
				font-size: 15px;                 
				padding-left: 50px;
				background: url(../Style/index-images/user-logo.png) no-repeat 5% center;
				background-size: 20px 20px;
			}
			#input-form li:nth-child(2) input{               /* 输入框图标*/
				font-size: 15px;                            
				padding-left: 50px;
				background: url(../Style/index-images/password.png) no-repeat 5% center;
				background-size: 20px 20px;
			}
			#input-form li:first-child input,#input-form li:nth-child(2) input{
				width: 280px;
				height: 45px;
				color: white;
				border-radius: 20px;
				background-color: black;
				opacity: 0.4;
			}
			/*登陆按钮S*/
			#input-form li:last-child button{
				width: 280px;
				height: 45px;
				border-radius: 20px;
				color: white;
				font-size: 16px;
				background-color: rgb(223,93,16);
			}
			/*登陆按钮E*/
			
			/*输入框组 E*/
			
			/*其他登陆方式S*/
			#other-login{
				width:310px; 
				height: 100px; 
				margin: 0 auto; 
				margin-top: 120px;
			}
			#other-login ul li img{
				width:100px; 
				height:120px;
			}
			#other-login ul li{
				float:left;
				text-align: center;
			}
			/*其他登陆方式E*/
			
			.bg{
				border:solid 2px white;
			}
			/*
			.tips{
				font-size:14px;
				color:#dcdcdc;
			}*/
			.showinfo{border-radius:5px;background:#000;opacity:0.6;-moz-opacity:0.6;filter:alpha(opacity=60);width:120px;height:38px;box-shadow:0px 0px 10px #000;margin:-60px auto;color:#FFFFFF; text-align:center; line-height:38px;font-size:14px;display:none;}
		</style>
		<!--文本框获得焦点和失去焦点的事件-->
		<script type="text/javascript">
			$(document).ready(function(){
  				$("#user-name").focus(function(){
   					 $("#user-name").addClass("bg");
  				});
  				$("#user-name").blur(function(){
    				$("#user-name").removeClass("bg");
  				});
  				$("#passw").focus(function(){
   					 $("#passw").addClass("bg");
  				});
  				$("#passw").blur(function(){
    				$("#passw").removeClass("bg");
  				});
  				
			});
		</script>
		<script>
			$(function() {

				$("#btnok").click(function() {
					var pass = $("input[name='password']");
					if(pass.val() == "") {
						pass.css("border", "1px solid #CC3300");
						$('.showinfo').html('还没有输入密码').show().delay(3000).fadeOut();
						return;
					}

					url = "<?php echo U('User/mercheck');?>";
					$.ajax({
						type: "get",
						url: url,
						data: "pass=" + $.trim(pass.val()),
						beforeSend: function() {
							$('#btnok').hide();
							$('.login').show();
						},
						success: function(msg) {
							if(msg == 1) {
								//登陆成功
								$('.showinfo').html('登录成功').show().delay(3000).fadeOut();
								location.href = "./index.php?m=User&a=index&isshop=1";
							}
							if(msg == 2) {
								//密码不正确
								$('.showinfo').html('密码不正确').show().delay(3000).fadeOut();
								return;
							}
							if(msg == 0) {
								//用户还没初始化密码
								$('.showinfo').html('密码不正确').show().delay(3000).fadeOut();
								return;
							}
						},
						complete: function() {
							$('#btnok').show();
							$('.login').hide();
						}
					});

				});

				$("#forgetpw").click(function() {
					alert("请联系商城管理员");
					return;
				});

				$("#editpw").click(function() {
					$("#loginpage").hide();
					$("#editpage").show()
				});
			});
		</script>
	</head>
	<body>
	<body style="background:url(data/upload/advert/<?php echo $bg['content'];?>) no-repeat;background-size: cover;">
		<!-- edit -->
		<!--<div class="am-g" id="editpage" style="display:none;border:1px solid #ccc; padding:10px;width:82%; margin:90px auto;box-shadow:0px 0px 10px #000;">
			<div class="am-u-md-8 am-u-sm-centered">
				<fieldset class="am-form-set">
					<span class="logintitle">修改您的密码</span>
					<input type="password" placeholder="输入原密码" name="password1" class="pass">
					<input type="password" placeholder="输入新密码" name="password2" class="pass">
					<input type="password" placeholder="再次确认新密码" name="password3" class="pass">
					<div style="text-align:center;line-height:32px;margin-top:5px;">
					</div>
				</fieldset>
				<button type="submit" class="am-btn am-btn-primary am-btn-block">修	改</button>
				
			</div>
		</div>-->

		
		<!--<div class="am-g" id="loginpage" style="display:block;border:1px solid #ccc; padding:10px;width:82%; margin:90px auto;box-shadow:0px 0px 10px #000;">
			<div class="am-u-md-8 am-u-sm-centered">
				<fieldset class="am-form-set">
					<span class="logintitle">请输入您的密码</span>
					<input type="password" placeholder="输入密码" name="password" class="pass">
					<div style="text-align:center;line-height:32px;margin-top:5px;">
						<a href="javascript:;" class="a1" id="forgetpw">忘记密码啦?</a>
					
					</div>
				</fieldset>
				<button type="submit" class="am-btn am-btn-primary am-btn-block" id="btnok">确	定</button>
				<span class="login"><img src="../Style/images/loading.gif" class="img" />&nbsp;&nbsp;正在登录...</span>
			</div>
		</div>

		<div class="showinfo"></div>-->
		<div id="login-back">
			<img src="../Style/index-images/back.png" alt="返回" onClick="window.history.back(-1);"/>
		</div>
		<!--logo-->
		<div id="logo">
			<img src="../Style/index-images/logotyf.png" alt="logo" width="90px" height="90px"/>
		</div>
		
		<!--输入框-->
		<div id="input-form">
			<ul>
				<li><input type="text" id="user-name" value="<?php echo ($merlogin_info["username"]); ?>"/></li>
				<li><input type="password" id="passw" name="password" placeholder="请输入登录密码"/></li>
				<li><button id="btnok">登录&nbsp;LOGIN</button></li>
			</ul>
			<!--<div class="tips">提示 : 忘记密码请联系在线客服 :) </div>-->
		</div>
		<div class="showinfo"></div>
	</body>

</html>