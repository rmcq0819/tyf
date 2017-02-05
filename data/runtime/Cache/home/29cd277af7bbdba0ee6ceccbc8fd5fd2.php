<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
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




<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>会员中心 - 我的收藏</title>
<link rel="stylesheet" type="text/css" href="../Style/shop.css" />
<!-- <link rel="stylesheet" type="text/css" href="../Style/css/css.css" /> -->
<link rel="stylesheet" type="text/css" href="../Style/css/amazeui.css" />
<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
<script charset="utf-8" src="../Style/js/touchslider.dev.js"></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js" ></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js" ></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/mlselection.js" ></script>
<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
<style>

*{font-family: "微软雅黑";}
.product-presentation{background-color:#fff;padding-left: 5%;}
.leilogo a img{width: 100%;height: 100%;vertical-align: middle;background: #FFF;}
#col-img{
				text-align: center;
			}
			#col-content{
				text-align: center; 
				font-size: 15px; 
				color:black;
			}
			#btn a{
				color: white;
				font-size:14px;
				border-radius: 6px;
				background-color:rgb(240,93,0);
				padding: 5px 13px;
			}
			/*头部*/
			.topnav {
				width: 100%;
				height: 50px;
				line-height: 50px;
				color: white;
				font-size: 18px;
				text-align: center;
				position: fixed;
				top: 0;
				background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; 
				left:5px; 
				top: 14px;
			}
</style>
</head>
<body>
<meta name="viewport" content="width=device-width;minimum-scale=1.0; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<script src="../Style/js/shop.js" type="text/javascript"></script>
<link href="../Style/css2/css.css" rel="stylesheet" type="text/css" />
<!-- <link href="../Style/css.css" rel="stylesheet" type="text/css" /> -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<link href="./Tpl/home/default/public/style.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
<!-- <link href="../Style/style.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript">
wx.config({
    debug: false,
    appId: 'wx6a9244fbd61b964f',
    timestamp: '<?php echo ($jsapi['timestamp']); ?>',
    nonceStr: '<?php echo ($jsapi['timestamp']); ?>',
    signature: '<?php echo ($jsapi['signature']); ?>',
    jsApiList: [
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
    ]
  });
  
  wx.ready(function () {
     wx.onMenuShareTimeline({
        title: "<?php echo ($fx_ad['url']); ?>", // 分享标题
        link: '<?php echo ($jsapi['url']); ?>', // 分享链接
        imgUrl: "http://"+window.location.host+"/data/upload/advert/<?php echo ($fx_ad['content']); ?>", // 分享图标
    });
    wx.onMenuShareAppMessage({
        title: "<?php echo ($fx_ad['url']); ?>", // 分享标题
        desc: "<?php echo ($jsapi['url']); ?>", // 分享描述
        link: '<?php echo ($jsapi['url']); ?>', // 分享链接
		imgUrl: "http://"+window.location.host+"/data/upload/advert/<?php echo ($fx_ad['content']); ?>", // 分享图标
        type: 'link', 
        dataUrl: '',
    });
  });
</script>
<!-- <style type="text/css">
	.topnav{ position:fixed;width:100%;height:49px;z-index:9999; background:#C54056; text-align:center; color:#fff; font-size:16px; line-height:49px; top:0;}
	.topnav .back{ position:absolute; left:8px;top:6px;}
</style> -->

<!-- <header data-am-widget="header" class="am-header am-header-default" style="background-color: #e15f11;position:fixed;top:0;z-index:999;height:50px;line-height: 50px;">
  <div class="am-header-left am-header-nav">
	  <a href="javascript:;" onClick="window.history.back(-1);" class="am-icon-chevron-left"></a>
  </div>
	
  <h1 class="am-header-title" style="font-size:18px;line-height: 50px;">
	  我的收藏(<?php echo ($count); ?>)
  </h1>
</header> -->
<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			我的收藏(<?php echo ($count); ?>)
</div>
<div id="content" style="margin-top:45px;height:100%;overflow:hidden;">
  <div class="about_me" style="width:100%;padding: 5% 3%;">
  				<script>
				function shoucangFndel(t) {
					//商品的id号
					var id = t;
					//发出请求
					$.getJSON("./index.php",{m:"User",a:"shoucangFndel",id:id},function(data){
						//请求完毕后返回的数据
						if(data.error){
							alert(data.error);
							if(data.error === "请先登录后删除收藏!") {
								location.href = "./index.php?m=User&a=login";
							}
							return;
						}
						if(data.success) {
							alert(data.success);
							window.location.href='<?php echo U('User/shoucang');?>';
						}
					});
				}
				</script>
        	 <?php if(!empty($itemArr)): if(is_array($itemArr)): $i = 0; $__LIST__ = $itemArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="shouchangbj" style="border-top:none;">
					<div class="shouchang">
					<dl style="border:none;">
					<dt><img src="<?php echo attach(get_thumb($item['img'], '_m'), 'item');?>" /></dt>
					<dd><table width="100%"border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <td colspan="2" align="left" valign="top" style="padding:0 0 10px 0;"><a href="<?php echo U('Item/index',array('id'=>$item['id'],'shares'=>$shares_id));?>" style="font-size:14px;"><?php echo ($item["title"]); ?></a></td>
					    </tr>
					  <tr>
					    <td align="left" valign="bottom">优品价：<span style="font-size:14px; font-family: Arial, Helvetica, sans-serif; color:#ff5400;">¥<?php echo ($item["price"]); ?></span></td>
					    <td align="right" valign="bottom"><a href="javascript:void(0)" onClick="shoucangFndel(<?php echo ($item['id']); ?>);" style=""><span class="icon-star"  style="font-size:14px;color:#ff5400;"></span>取消收藏</a></td>
					  </tr>
					</table>
					</dd>
					<div class="clear"></div>
					</dl>
					<div class="clear"></div>
					</div>
				 
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
           <!-- 购物车没有产品的情况下 -->
		<br/><br/>
					<div id="col-img">
						<img src="../Style/index-images/shoucang.png" alt="无收藏" style="width: 120px; height: 120px;" />
					</div>
					<br />
					<div id="col-content">
						<p>您还没有任何收藏哦~</p>
					</div>
					<br />
					<br />
					<div id="btn" style="text-align: center;">
						<a href="<?php echo U('Index/index',array('shares'=>session('shopid')));?>">去逛逛~</a>
					</div><?php endif; ?>
    </div>  
</div>
<div class="clear" style="height:33px;"></div>
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
<script>
function shoucangFndel(t) {
	layer.open({
			title: '提示',
			content: '您确定要删除该条收藏记录吗？',
			btn: ['确认', '取消'],
			yes: function(index){
			//商品的id号
				var id = t;
				//发出请求
				$.getJSON("./index.php",{m:"User",a:"shoucangFndel",id:id},function(data){
					//请求完毕后返回的数据
					if(data.error){
						alert(data.error);
						if(data.error === "请先登录后删除收藏!") {
							location.href = "./index.php?m=User&a=login";
						}
						return;
					}
					if(data.success) {
						//alert(data.success);
						window.location.href='<?php echo U('User/shoucang');?>';
					}
				});  
				layer.open({content: '收藏记录删除成功', time: 1});
				layer.close(index);
			}
	});  

}
</script>