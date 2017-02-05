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




		<style>
			* {
				font-family: "微软雅黑";
			}
			.topnav {
				width: 100%;height: 49px;line-height: 49px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;z-index: 999;background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; left:5px; top: 14px;
			}			
			/*头部*/
			#picture{
				width: 100%;position: absolute; left: 0px; top: 34%; padding: 0px;
			}
			#picture img{
				border-radius: 3px;height: 64px;
			}
			#footer{
				width: 100%;position: absolute; left: 0%; top: 43%; padding: 5px;
			}
			#footer .yu{
				margin-bottom: 46px; position: relative; left: 0px; font-weight: bold;
			}
			#footer .yu .name{
				position: absolute; left: 15%; top: 10%; color: rgb(240,93,0); font-size: 13px;
			}
			#footer .yu .content{
				width: 80%;position: absolute; left: 14%; top: 24%; color: rgb(240,93,0); font-size: 13px; 
			}
			#footer .yu .zeng{
				position: absolute; right: 8%; top: 63%; color: rgb(240,93,0); font-size: 12px;
			}
			#footer .yu .time{
				position: absolute; right: 10%; top: 73%; color: rgb(240,93,0); font-size: 12px;
			}
		</style>

	</head>

	<body style="background:#f3f3f3;">
		<div class="topnav">
			<a href="<?php echo U('User/index');?>" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			新年大吉
		</div>
		
		<div id="main" style="position: relative; left: 0px;">
			<img src="../Style/index-images/activity/zhu-bg.jpg" alt="背景图" class="am-img-responsive" style="margin-top: 49px;"/>
			<p style="position: absolute; left: 0px; top: 20%;">
				<img src="<?php echo ($send_user['cover']); ?>" alt="" class="am-circle" style="width: 50px;height:50px;margin-left: 3px;"/>
				<p style="position: absolute; left: 20%; top: 20.7%; color: rgb(240,93,0); font-size: 14px;"><?php echo ($send_user['username']); ?>(新年快乐，哈哈，想到是我了吗)</p>
			</p>
			<p style="position: absolute; left: 16%; top: 29%; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
				下面是为你制作的祝福图片<span style="font-size:12px;">(点击查看大图)</span>
			</p>
			<div id="picture">
				<?php if(($blessing['pic_1'] != '') OR ($blessing['pic_2'] != '') OR ($blessing['pic_3'] != '')): ?><ul data-am-widget="gallery" class="am-gallery am-avg-sm-3 am-avg-md-3 am-avg-lg-4 am-gallery-default" data-am-gallery="{ pureview: true }" >
			     	<li>
				        <div class="am-gallery-item">
				            <a href="<?php if($blessing["pic_1"] != ''): echo ($blessing['pic_1']); else: ?>../Style/index-images/activity/no-p1.png<?php endif; ?>" class="">
				              <img src="<?php if($blessing["pic_1"] != ''): echo ($blessing['pic_1']); else: ?>../Style/index-images/activity/no-p1.png<?php endif; ?>"  alt="图片"/>
				            </a>
				        </div>
			      	</li>
			      <li>
			        <div class="am-gallery-item">
			            <a href="<?php if($blessing["pic_2"] != ''): echo ($blessing['pic_2']); else: ?>../Style/index-images/activity/no-p1.png<?php endif; ?>" class="">
			              <img src="<?php if($blessing["pic_2"] != ''): echo ($blessing['pic_2']); else: ?>../Style/index-images/activity/no-p1.png<?php endif; ?>"  alt="图片"/>
			            </a>
			        </div>
			      </li>
			      <li>
			        <div class="am-gallery-item">
			            <a href="<?php if($blessing["pic_3"] != ''): echo ($blessing['pic_3']); else: ?>../Style/index-images/activity/no-p1.png<?php endif; ?>" class="">
			              <img src="<?php if($blessing["pic_3"] != ''): echo ($blessing['pic_3']); else: ?>../Style/index-images/activity/no-p1.png<?php endif; ?>"  alt="图片"/>
			            </a>
			        </div>
			      </li>
  				</ul>
				<?php else: ?>
  				<!--没有照片的时候-->
  				<p style="text-align: center; margin-top: 5px;">
  					<img src="../Style/index-images/activity/no-p1.png" alt="无照片" style="width: 60px;height: 60px; border: none;"/>
  					<span style="color: rgb(169,183,183); margin-left: 5px;">无照片</span>
  				</p><?php endif; ?>
			</div>
			
			<div style="width: 100%; height: 200px;background-color: rgb(253,235,197);"></div>
			
			<div id="footer">
				<p style="font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; position: absolute; left: 16%; top: 10%;">
					也任性为你制作的祝福小视频
				</p>
				<?php if($blessing['video_1'] != ''): ?><video src="https://api.yooopay.com/<?php echo ($blessing['video_1']); ?>"  width="100%" height="250" controls="controls" style="margin-top: 80px;">
  					当前浏览器不支持 video直接播放，点击这里下载视频： <a href="https://api.yooopay.com/<?php echo ($blessing['video_1']); ?>">下载视频</a>
  				</video>
				<?php else: ?>
  				<!--没有视频的时候-->
  				<p style="margin-top: 80px; text-align: center;">
					<img src="../Style/index-images/activity/no-v.png" alt="无视频" style="width: 79px; margin-left: -5px;"/>
					<span style="text-align: center;color: rgb(169,183,183); margin-left: -3px;">无视频</span>
				</p><?php endif; ?>
  				<div class="yu">
  					<img src="../Style/index-images/activity/zhu-footer.jpg" alt="背景图" class="am-img-responsive"/>
  					<p class="name"><?php echo ($blessing['name']); ?>
					<?php if($blessing['gender'] == 1): ?>先生<?php endif; ?>
					<?php if($blessing['gender'] == 2): ?>女士<?php endif; ?>
					<?php if($blessing['gender'] == 3): ?>先生/女士<?php endif; ?>：</p>
  					<p class="content">
  						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($blessing['blessing']); ?>
  					</p>
  					<p class="zeng"><?php echo ($send_user['username']); ?>（赠）</p>
  					<p class="time"><?php echo (date("Y.m.d",$blessing["add_time"])); ?></p>
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
	</body>

</html>