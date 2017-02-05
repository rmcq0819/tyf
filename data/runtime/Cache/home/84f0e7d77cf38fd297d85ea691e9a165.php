<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<style>
			*{
				font-family: "微软雅黑";
			}
			/*头部*/
			.topnav{
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;background-color: rgb(240,93,0);
			}
			.topnav .delet{          /*清空*/
				font-size: 15px;          position: absolute; right: 5px; top: 0px; 
			}
			/*头部E*/
			
			/*浏览过的商品S*/
			.record{
				width: 100%; height: 90px; padding: 10px; margin-top: 7px;background-color: white; 
			}
			.record .title{
				color: rgb(85,85,85); font-size: 14px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;
			}
			.free-price{              /*免税价*/
				font-size: 13px;margin-top: 5px;
			}
			.price{                         /*价格*/
				color: rgb(240,93,0); font-size: 14px; 
			}
			.time{                          /* 时间*/
				font-size: 13px; color: rgb(170,170,170); margin-top: 8px;-webkit-transform: scale(0.90);
			}
			/*浏览过的商品E*/
			
			/*未浏览过商品的时候S*/
			.member_no_records{
				text-align:center; margin-top: 60px;
			}
			.member_no_records img{
				width: 120px;height: 120px;
			}
			.member_no_records p{
				margin-top: 10px; font-size: 14px;
			}
			#btn{
				width: 100px; height: 25px; background-color: rgb(240,93,0); color: white; border: none; border-radius: 5px;
			}
			/*未浏览过商品的时候E*/
		</style>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	</head>

	<body>
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




		<!--头部-->
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" style="position: absolute; top: 12px; left: 5px;"/>
			</a>
			我的足迹&nbsp(<?php echo ($poss_count); ?>)
			<!--<span class="delet" id="clear_history"> <?php if(!empty($itemArr)): ?>清空<?php else: endif; ?></span>-->
		</div>

		<?php if(!empty($posslist)): if(is_array($posslist)): $i = 0; $__LIST__ = $posslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="record">
				<div class="am-g">
				<div class="am-u-sm-3">
					<img src="<?php echo attach(get_thumb($item['img'], '_m'), 'item');?>" alt="产品" onClick="location.href='<?php echo U("Item/index",array("id"=>$item["itemid"],"shares"=>$info['id']));?>'" class="am-img-responsive" style="height: 70px;" />
				</div>
				<div class="am-u-sm-6" style="padding-left:5px;">
					<p class="title" onClick="location.href='<?php echo U("Item/index",array("id"=>$item["itemid"],"shares"=>$info['id']));?>'"><?php echo ($item["title"]); ?></p>
					<p class="free-price"><span style="color:#555;">优品价：</span><span class="price">￥<?php echo ($item["price"]); ?></span></p>
				</div>
				<div class="am-u-sm-3" style="height:70px;text-align: right;">
					<p><img src="../Style/index-images/shopcar_07.jpg" alt="删除" onclick="clear_history(<?php echo ($item["id"]); ?>)" class="am-img-resonsive"  style="width: 20px; height: 20px;" /></p>
					<p class="time"><?php echo (date('Y-m-d H:i',$item["addtime"])); ?></p>
				</div>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
	        <div class="order_form member_no_records">
	        	<img src="../Style/index-images/liulanjilu.png" alt="未浏览" />
	            <p>您还没有浏览过商品</p>
	            <br />
	            <br />
	            <button id="btn" onclick="window.location.href='<?php echo U('Index/index');?>'">
	            	去逛逛~
	            </button>
	        </div><?php endif; ?>
		
		
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
		<script>	
			function clear_history(id){
					layer.open({
						title: '提示',
						content: '您确定要删除该记录吗？',
						btn: ['确认', '取消'],
						yes: function(index){
							window.location.href="index.php?m=User&a=clear_history&id="+id; 
							layer.open({content: '记录删除成功', time: 1});
							layer.close(index);
						}
					});
			}
		</script>
	</body>
</html>