<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">

	<head>
		<title>祝福语录</title>
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




		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style type="text/css">
			*{
				font-family: "微软雅黑"; outline: none;
			}
			input,textarea{
				border:0;
				-webkit-appearance:none;
			}
			label *{
    			pointer-events: none;
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
			#header{
				margin-top: 49px; background-color: white;
			}
			#header #header-n{
				line-height: 60px; margin-top: 20px; color: rgb(85,85,85);
			}
			#header label{
				margin-top: 23px;
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
	        #waiting{
	        	width: 160px;position: fixed; left: 50%; top: 40%; margin-left: -25px;
	        }
	        #waiting p{
	        	width: 132px;height: 19px;line-height: 19px;color: rgb(221,128,0); margin-top: 15px; font-size: 13px; margin-left: -40px; font-weight: bold; border-radius: 3px;
	        }
			.am-radio .am-icon-checked:before, .am-radio-inline .am-icon-checked:before{
			    content: "\f058";
			    color: rgb(240,93,0);
			}
		</style>
		<link rel="stylesheet" href="../Style/css/animate.min.css" />
	</head>

	<body style="background-color: rgb(243,243,243);">
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			祝福语录
		</div>
		
		<div id="comm">
		<form action="<?php echo U('Blessing/write_blessing');?>" name="blessing_form" id="blessing_form" method="post" enctype="multipart/form-data">
			<ul>
				<li>
					<div id="header" style="height: 60px;border-bottom: solid 1px rgb(214,214,214);">
						<div class="am-g">
  							<div class="am-u-sm-5">
  								<p id="header-n">
  									<p>&nbsp;称谓：<input name="name" type="text" style="width: 60%;border: solid 1px rgb(178,178,178); border-radius: 5px; padding-left: 5px;"/></p>
  								</p>
  							</div>
							<input type="hidden" name="phone" value="<?php echo ($phone); ?>">
							<input type="hidden" name="orderId" value="<?php echo ($orderId); ?>">
  							<div class="am-u-sm-7" style="text-align: center;">
  								<label class="am-radio-inline">
      								<input type="radio" name="gender" value="1" data-am-ucheck  checked>
      								先生
   		 						</label>
    							<label class="am-radio-inline">
      								<input type="radio" name="gender" value="2" data-am-ucheck>
      								女士
    							</label>
    							<label class="am-radio-inline">
      								<input type="radio" name="gender" value="3" data-am-ucheck>
      								团体
    							</label>
  							</div>
						</div>
					</div>
					<div id="comment">
						<textarea onkeyup="checkLength(this);" name="blessing" rows="5" cols="" placeholder="将想要对收件人的祝福填写在这儿吧"></textarea>
						<p><i class="am-icon-edit am-icon-sm"></i>&nbsp;您还可以输入<span id="sy" style="color:rgb(240,93,0);">120</span>个字</p>
					</div>
		
					<div id="upload-img">
						<p class="title">添加图片:</p>
						<div class="am-g" style="margin-top: 10px;">
			  				<div class="am-u-sm-4">
			  					<img src="../Style/index-images/p-img.png" id="img_1"  class="am-img-responsive"/>
			  					<input type="file" name="pic_1" onchange="dochance(this,'1')"/>
			  				</div>
			  				<div class="am-u-sm-4">
			  					<img src="../Style/index-images/p-img2.png" id="img_2" class="am-img-responsive"/>
			  					<input type="file" name="pic_2" onchange="dochance(this,'2')"/>
			  				</div>
			  				<div class="am-u-sm-4">
			  					<img src="../Style/index-images/p-img2.png" id="img_3" class="am-img-responsive"/>
			  					<input type="file" name="pic_3" onchange="dochance(this,'3')"/>
			  				</div>
			  				<p style="color: rgb(150,150,150); text-align: center; margin-top: 70px;">（点击上传）</p>
						</div>
					</div>
					<!------视频上传------>
					<img src="../Style/index-images/p-line.png" alt="" class="am-img-responsive" style="width: 100%; height: 3px;"/>
					<div id="upload-img">
						<p class="title">添加视频:</p>
						<div class="am-g" style="margin-top: 10px; text-align: center; position: relative; left: 0px;">
							<!--<div class="am-progress am-progress-xs">
    							<div class="am-progress-bar" style="width: 80%"></div>
							</div>-->
			  				<img src="../Style/index-images/activity/ship.png" alt="" style="width: 200px;"/>
			  				<input type="file" name="video_1" style="width: 200px;height: 149px;position: absolute; left: 50%; top: 0px; margin-left: -100px; "/>
			  				
			  			<!-- 	<p style="color: rgb(150,150,150); margin-top: 7px;">（点击上传）</p> -->
							<p style="text-align:center; margin-top:5px; color:rgb(150,150,150); font-size:12px;">( 建议WiFi环境上传，视频不超过100M )</p>
						</div>
					</div>
					<img src="../Style/index-images/p-line.png" alt="" class="am-img-responsive" style="width: 100%; height: 3px;"/>
				</li>
			</ul>
			</form>
			<div id="submit">
				保存预览
			</div>
		</div>
		
		<!----------------上传文件中------------->
		<div id="waiting" style="display:none">
			<img src="../Style/index-images/activity/move.gif" alt="上传中"/>
      		<p>正在上传文件...请稍后</p>
		</div>
		
		
		<button type="button" id="saved" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 260, height: 225}" style="display:none">
  			点击预览
		</button>
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
		  <div class="am-modal-dialog" style="background: none;">
		    <div class="am-modal-bd" style="position: relative;left: 0px; border: solid 1px white; background-color: white;height: 300px; border-radius: 5px; margin-top: -30px;">
	      		<img src="../Style/index-images/activity/close-white.png" alt="关闭" data-am-modal-close style="width: 33px; position: absolute; right: 0px; top: -40px;"/>
	      		<div class="am-g">
					<!--<div class="am-u-sm-3">
						<img src="../Style/index-images/user.png" alt="" style="width: 60px;"/>
					</div>-->
					
					<p style="position: absolute; left: 50%; top: 10px; margin-left: -115px;"><img src="../Style/index-images/activity/qrcodes.png" alt="" class="am-img-responsive" style="width: 230px;"/></p>
				</div>
		      	<button style="width: 120px; height: 28px;background-color: rgb(241,93,53); color: rgb(240,197,62); border: solid 1px rgb(240,197,62);border-bottom: solid 2px rgb(240,197,62); border-radius: 10px; position: absolute; left: 50%; top: 249px; margin-left: -60px;" onclick="location.href='<?php echo U('Blessing/blessing',array('phone'=>$phone));?>'">点击查看</button>
		    </div>
		  </div>
		</div>
		
		<div class="showinfo animated shake"></div>
		<script>
			$(function(){
				saved = <?php echo ($saved); ?>;
				if(saved==1){
					$("#saved").click();//弹出预览
				}
			});
			
			
		</script>
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
					var name = $("input[name='name']").val();
					var com = $("textarea[name='blessing']").val();
					if(name==''){
						var content = $('.showinfo').html('请输入称谓');
						var w = content.width()/2;
						$(".showinfo").css("margin-left",-w);
						$(".showinfo").show().delay(3000).fadeOut();
						return false;  
					 }
					if(com==''){
						var content = $('.showinfo').html('写下您对亲朋好友的祝福~');
						var w = content.width()/2;
						$(".showinfo").css("margin-left",-w);
						$(".showinfo").show().delay(3000).fadeOut();
						return false;  
					 }
					$("#waiting").css('display','');
					$("#blessing_form").submit(); 
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