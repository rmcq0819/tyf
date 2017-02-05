<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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




		<style>
			* {
				border: none;outline: none;font-family: "微软雅黑";
			}
			/*头部*/
			.topnav {
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;z-index: 999;background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; left:5px; top: 14px;
			}
			/*#rtt {
				width:30px; height:30px; background:url(./Tpl/home/default/Style/images/rrt.png); background-size:cover; position:fixed; right:8px; bottom:70px; border-radius: 5px; z-index:999; display:none;
			}*/
			
			/*搜索框*/
			#search{
				width: 100%; height: 40px; margin-top: 49px ;background-color: white; text-align: center; line-height: 45px; border-bottom: solid 1px rgb(224,224,224);
			}
			#search input{
				width: 60%; height: 25px ; background: url(../Style/index-images/maihz_04.png); background-repeat: no-repeat ;font-size: 14px;border: solid 1px rgb(201,201,200);color: #555; font-size: 13px; border-bottom-left-radius: 5px; border-top-left-radius: 5px;border-top-right-radius: 0px;border-bottom-right-radius: 0px; position: relative; background-color: rgb(243,243,243); outline: none; padding-left: 25px; margin-top: -7px;
			}
			#search button{
				width: 80px; height: 25px; background-color: rgb(243,243,243); color: rgb(240,93,0); font-size: 14px; border: solid 1px rgb(201,201,200); border-bottom-right-radius: 5px; border-top-right-radius: 5px; margin-left: -5px; margin-top: -7px;
			}
			#rank{
				width: 100%; height: 40px; background-color: white; border-bottom: solid 1px rgb(243,243,243);
			}
			#rank p{
				line-height: 40px;text-align: center;font-size: 13px;color: black;
			}
			
			/*筛选S*/
			a:hover{
				color: rgb(240,93,0);
			}
			.am-menu-nav a:first-child{
				font-size: 13px;
			}
			.am-menu-sub a{
				font-size: 12px;
			}
			.current{
				color: rgb(240,93,0); background: url(../Style/index-images/choose.png) no-repeat 90% 50%;
			}
			.am-menu-sub input{
				display: none;
			}
			.am-menu-default .am-menu-nav > .am-parent > a:before{
				color: rgb(200,200,200);
			}
			.am-menu-nav a{
				transition: none;
			}
			/*筛选E*/
			
			/*产品列表*/
			#item-list{
				margin-top:5px;
			}
			#item-list li{
				background-color: white;
			}
			.am-thumbnails > li{
				padding: 0px;
			}
			#item-list .title{
				line-height: 18px; color: #555;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;padding: 2px 3px 2px 6px;
			}
			#item-list .pro-price{
				padding: 2px 2px 2px 6px;
			}
			#item-list .price{
				color: rgb(240,93,0); font-size: 14px;
			}
			.am-menu-sub li{
				text-align: left;
			}
			.am-menu-default .am-menu-sub > li > a{
				text-align: left;
				padding-left: 20px;
			}
			.am-menu-default .am-menu-nav a:first-child{
				margin-left:10px;
			}
			#guess-like {
				height: 50px;line-height: 50px;font-size: 13px;text-align: center;position: relative;color: #555;clear:both;
			}
			#guess-like .span-1,#guess-like .span-2 {
				border-top: 1px dashed rgb(190,190,190);width: 35%;position: absolute;top: 25px;
			}
			#guess-like .span-1{
				left: 0px;
			}
			#guess-like .span-2{
				right: 0px;
			}
			.item_over{
				width:60px;height:20px;line-height:20px;background:rgb(240, 93, 0);color:#fff;text-align:center;position:absolute;top:0px;font-size:12px;
			}
			
			#open-dialog{
				height: 18px;float: right; margin-top: 2px; margin-right: 1px; background-color: rgb(240,93,0); color: white; border-radius: 3px; text-align: center;
			}
			/*商品信息*/
			 .product{
				border: solid 1px rgb(238,164,119); border-radius: 7px; margin-top: -22px;
			}
			.name{
				overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: rgb(85,85,85);
			}
			.close-img{
				position: absolute; top: 0px; right: 0px; width: 18px; height: 18px;
			}
			/*规格选择*/
			.standard{
				max-height: 250px; overflow: scroll;
			}
			.standard .am-u-sm-2{
				text-align: right; padding-top: 5px; font-size: 13px; color: rgb(85,85,85);
			}
			/*数量选择*/
			.num{
				height: 45px; line-height: 45px;
			}
			.num .am-u-sm-2{
				text-align: right; font-size: 13px; color: rgb(85,85,85);
			}
			/*按钮*/
			.btn .left,.btn .right{
				width: 50%; height: 45px;line-height: 45px; color: white; font-size: 14px;
			}
			.btn .left{
				background-color: rgb(255,180,0);float: left;
			}
			.btn .right{
				background-color: rgb(240,93,0);float: right;
			}
			
			.am-modal-actions-group .am-list > li{
				overflow: visible;
			}
			.spinner{
				margin-top: 10px;float: right;margin-right: 70px;
			}
			
			/* 规格选择 */
			.choosebox li{
				float:left;margin-right:10px;display:inline;margin-bottom: 8px;margin-top: 5px;
			}
			.choosebox li a{
				float:left;background:#fff;font-size:14px;border:1px solid #ccc;height:22px;line-height:14px;padding:4px 12px; display:block;
			}
			.choosebox li a.current{
				background:url(../Style/index-images/right-icon.gif) no-repeat 100% 100%;border:1px solid #A10000; color:rgb(169,8,8);
			}
			.choosebox li input{
				display:none;
			}
			.floatprice{
				margin-top:10px;
				color:rgb(85,85,85);
			}
			#gotop{
				width: 35px; height: 35px; position: fixed; right: 8px; bottom: 70px;z-index: 888; display: none; background-color: rgb(240,93,0); color: white; border-radius: 50%; text-align: center;
			}
		</style>
	</head>
	<body style="padding-bottom:10px;">
		<input type="hidden" id="cart_price" value="<?php echo ($cart_price); ?>">
		<input type="hidden" id="cart_count" value="<?php echo ($cart_count); ?>">
		<div class="cartmsg"></div>
		<input type="hidden" name="shares_id" id="shares_id" value="<?php echo ($info["id"]); ?>" />
		<!--头部-->
		<div class="topnav">
			<a href="<?php echo U('Item/itemcate',array('pid' => $pid));?>" class="back">
				<img src="../Style/images/fanhui1.png" width="25"/>
			</a>
			<?php echo ($detail_title); ?>
		</div>
		
		<!--商品搜搜-->
		<div id="search">
	        <input type="text" name="keyword" placeholder="在千万海外商品中搜索..." />		            	
        	<button id="search_btn">搜&nbsp;索</button>
		</div>

		<!--排序-->
    	<div id="rank" data-am-sticky="{top:49}" style="line-height: 52px;">
    		<nav data-am-widget="menu" class="am-menu  am-menu-default"> 
			    <a href="javascript: void(0)" class="am-menu-toggle">
			          <i class="am-menu-toggle-icon am-icon-bars"></i>
			    </a>
		      	<ul class="am-menu-nav am-avg-sm-4" >
		          	<li class="am-parent">
		            	<a href="">商品类型</a>
		              	<ul class="am-menu-sub am-collapse  am-avg-sm-1" style="background-color: white; border: solid 1px rgb(241,241,241);box-shadow: 1px 1px 1px rgb(200,200,200);">
		                  	<li>
								<p style="text-align:left;" onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'itemtype_1','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
									<a class="size_radioToggle <?php if($item_status == 6): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										完税商品
									</a>
								</p>
		                 	</li>
		                  	<li>
								<p onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'itemtype_0','shares'=>$info['id']));?>'">
		                    		<input type="radio" name="name"/>
									<a class="size_radioToggle <?php if($item_status == 5): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span>保税商品</span>
									</a>
								</p>
		                  	</li>
		                 
		             	</ul>
		          	</li>
		          	<li class="am-parent">
		            	<a href="" >综合</a>
		              	<ul class="am-menu-sub am-collapse  am-avg-sm-1" style="background-color: white; border: solid 1px rgb(241,241,241);box-shadow: 1px 1px 1px rgb(200,200,200);">
		                  	<li>
						   		<p onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'new','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
		                    		<a class="size_radioToggle <?php if($item_status == 7): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;"  >
										<span>新品优先</span>
									</a>
								</p>
		                  	</li>
		                  	<li>
						  		<p onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'sales_desc','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
		                    		<a class="size_radioToggle <?php if($item_status == 1): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span >销量优先</span>
									</a>
								</p>
		                  	</li>
		                  	<li>
						  		<p onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'price_desc','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
	                    			<a class="size_radioToggle <?php if($item_status == 3): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span>价格由高到低</span>
									</a>
								</p>
		                  	</li>
		                  	<li>
						  		<p  onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'price_asc','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
		                    		<a class="size_radioToggle <?php if($item_status == 4): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span>价格由低到高</span>
									</a>
								</p>
		                  	</li>
		              	</ul>
		          	</li>
		           	<li class="am-parent">
		            	<a href="">销量</a>
	              		<ul class="am-menu-sub am-collapse  am-avg-sm-1" style="background-color: white; border: solid 1px rgb(241,241,241);box-shadow: 1px 1px 1px rgb(200,200,200);">
	                  		<li>
					  			<p  onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'sales_desc','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
		                    		<a class="size_radioToggle <?php if($item_status == 1): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span>销量由高到低</span>
									</a>
								</p>
	                  		</li>
	                  		<li>
					  			<p onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'sales_asc','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
				                    <a class="size_radioToggle <?php if($item_status == 2): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span>销量由低到高</span>
									</a>
								</p>
	                  		</li>
	                 
	              		</ul>
		          	</li>
		          	<li class="am-parent">
		            	<a href="">价格</a>
		              	<ul class="am-menu-sub am-collapse  am-avg-sm-1" style="background-color: white; border: solid 1px rgb(241,241,241);box-shadow: 1px 1px 1px rgb(200,200,200);">
		                  	<li>
						  		<p onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'price_desc','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
				                    <a class="size_radioToggle <?php if($item_status == 3): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span>价格由高到低</span>
									</a>
								</p>
		                 	</li>
		                  	<li>
						  		<p onClick="location.href='<?php echo U('Item/itemlist',array('cate_id'=>$cate_id,'keyword'=>$keyword,'countryId'=>$countryId,'condition'=>'price_asc','shares'=>$info['id']));?>'">
									<input type="radio" name="name"/>
		                    		<a class="size_radioToggle <?php if($item_status == 4): ?>current<?php endif; ?>" style="text-align:left; padding-left:30px;" >
										<span>价格由低到高</span>
									</a>
								</p>
		                  	</li>
		              	</ul>
		          	</li>
		      	</ul>
		   	</nav>
    	</div>
		
		
    	<!--产品列表-->
		<?php if(!empty($items)): ?><div id="item-list">
    		<ul class="am-avg-sm-2 am-thumbnails" id="volsit">
			  	<?php if(is_array($items)): $i = 0; $__LIST__ = $items;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li class="pdt_ser_li" style="position:relative;">
			  		<img onClick="location.href='<?php echo U('Item/index', array('id'=>$vol['id'],'shares'=>$info['id']));?>'" class="am-thumbnail" real_src="data/upload/item/<?php echo get_thumb($vol['img'], '_b');?>" style="height:180px;"/>
			  		<p class="title"><?php echo ($vol["title"]); ?></p>
			   		<p class="pro-price">
			   			<span>优品价：</span>
			   			<span class="price">￥<?php echo ($vol["price"]); ?></span>
			   			<button class="ab" id="open-dialog" onclick="itemfloat(<?php echo ($vol["id"]); ?>)" data-am-modal="{target: '#my-actions'}"><i class="am-icon-cart-plus"></i></button>
			   		</p>
					<?php if($vol["price"] > 99): ?><div class="item_over">
							商品包邮
						</div><?php endif; ?>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
    	</div>
		<!-- 我是有底线的 -->
		<?php if($itemcount > 15): ?><p id="guess-like">
				<span class="span-1" style="border-top: solid 1px rgb(210,210,210);"></span>
					我是有底线的
				<span class="span-2" style="border-top: solid 1px rgb(210,210,210);"></span>
			</p><?php endif; ?>

		<br/>
		<br/>
		
		<ul id="pagination">
			<li class="next"><?php echo ($page); ?></li>
		</ul>
		<?php else: ?>
		<div style="text-align: center; color: #555; font-size: 13px;">
			<img src="../Style/index-images/no-search.png" alt="没有搜索到" style="width: 90px; height: 90px; margin-top: 60px;"/>
			<br />
			<br />
			<p>有点尴尬诶-_-#</p>
			<p>我们可能没有搜索到您需要的信息</p>
		</div><?php endif; ?>
		
		
		<!--弹出框-->
		<div class="am-modal-actions" id="my-actions">
			<div class="am-modal-actions-group">
				<ul class="am-list">	
					<li class="am-modal-actions-header">
						<div class="am-g" style="position: relative; left: 0px;">
							<div class="am-u-sm-4" >
								<img src="" id="iimg" alt="商品" class="am-img-responsive product"/>
							</div>
							<div class="am-u-sm-8" style="text-align: left; padding-left: 5px;">
								<p class="floatprice"><span>优品价：</span><span style="color: rgb(240,93,0);">￥<span class="ypprice" id="iprice"></span></span></p>
								<p class="name" id="ititle"></p>
							</div>
							<img class="close-img" src="../Style/index-images/d-close.png" data-am-modal-close alt="关闭"/>
						</div>
					</li>
					<!--规格-->
					<li class="standard" style="max-height: 250px; overflow-y: scroll;" id="">
						<div class="am-g">
							<div class="am-u-sm-2">
								规格：
							</div>
							<div class="am-u-sm-10" style="padding-left: 10px;">
								<div class="choosebox">
									<ul class="clearfix" id="isize">
									</ul>
								</div>
								<div style="clear: both;"></div>
							</div>
						</div>
					</li>
					<!--数量-->
					<li class="num">
						<div class="am-g">
							<div class="am-u-sm-2">
								数量：
							</div>
							<div class="am-u-sm-10">
								<input type="text" id="quantity"  value="1" orig="1" changed="1" class="spinnerExample"onafterpaste="this.value=this.value.replace(/\D/g,'')" onKeyUp="this.value=this.value.replace(/\D/g,'')"  />
							</div>
						</div>
					</li>
					<input type="hidden" id="iid" value="">
					<input type="hidden" id="size" value="">
					<!--按钮-->
					<li class="btn">
						<div class="left" onclick="addcart(1);">
							加入购物车
						</div>
						<div class="right" onclick="addcart(2);">
							立即购买
						</div>
						<div style="clear: both;"></div>
					</li>
				</ul>
			</div>
		</div>
		
		<!--购物车-->
		<div style="width: 40px; height: 40px; position: fixed; right: 10px; top: 70%; z-index: 999; opacity: 0.6;">
			<a href="<?php echo U('Shopcart/index');?>"><img src="../Style/index-images/shop_cart.png" alt="购物车" style="width: 40px; height: 40px;"/></a>
		</div>
		<a id="gotop"><i class="am-icon-chevron-up am-icon-sm" style="line-height: 30px; margin-top: 1px;"></i></a>
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
    	<script type="text/javascript">
			

			$(function(){
				$('#search_btn').click(function(){
					var keyword = $('input[name=keyword]');
					var shares_id = $('input[name=shares_id]');
					if(keyword.val() == '') {
						layer.open({
							title: '提示',
							content: '您还是输点什么再点我吧',
							btn: ['我知道了'],
							yes: function(index){
								layer.close(index);
							}
						});
						
						return false;
					} else {
						window.location.href = "<?php echo U('Item/itemlist',array('keyword'=>'" + keyword.val() + "','shares'=>'"+shares_id.val()+"'));?>";
					}
				});		
			});	
		</script>
		
		<script type="text/javascript">
			$('.spinnerExample').spinner({});
		</script>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
		<script type="text/javascript" src="../Style/js/lightbox-plus-jquery.min.js"></script>
		<script src="../Style/js/jquery-ias.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				var ias = $.ias({
					container: ".index_product_list",
					item: ".pdt_ser_li",
					pagination: "#pagination",
					next: ".next a"
				});
				ias.extension(new IASSpinnerExtension());
				ias.extension(new IASTriggerExtension({
					offset: 3
				}));
				ias.extension(new IASNoneLeftExtension({
					 text: ''
				}));
			})
		</script>
		<script src="../Style/js/Y_lazyload.js" type="text/javascript"></script>
		
		<!--图片懒加载-->
		<script type="text/javascript">
		
			$(function() {
				/**
				 *   option 的默认属性说明，进入 Y_lazyload.js 中查看注释
				 *
				 *   event           //加载img的触发事件
				 *   img             //随后加载 img 的dom
				 *   real_src        //要加载真实 src 使用到的自定义属性(attr)
				 *   animate         //动画效果
				 *   animate_delay   //动画等待时间，等待图片下载完成
				 *   animate_time    //动画执行时间
				 *   time_out        //设置延迟加载，有时IE下如果太快会有个别图片无反应的情况，设置此延时就可以解决
				 **/
				$(window).Y_lazyload({
					time_out : 10,
					animate:"fadeIn",
				});
			});
		</script>
		
		
		<script>
			function itemfloat(id){
				var url="<?php echo U('Item/itemparams');?>";
				$.getJSON(url,{'id':id},function(data){
					status = data.status;
					sz = data.sz;
					item = data.item;
					
					id = item.id;
					img = item.img;
					title = item.title;
					price = item.price;
					
					size = item.size;
					size_imgs = item.size_imgs;
					size_price = item.size_price;
					
					var sizes = new Array();
					var imgs = new Array();
					var prices = new Array();
				
					for (var property in size) { 
						sizes[property] = size[property];
					}
					for (var property in size_imgs) { 
						imgs[property] = size_imgs[property];
					}
					for (var property in size_price) { 
						prices[property] = size_price[property];
					}
				
					
					$("#iimg").attr("src","data/upload/item/"+img);
					$("#iprice").html(price);
					$("#ititle").html(title);
					$("#iid").val(id);
					$("#size").val('');
					
					
					var isize=document.getElementById('isize');
					$('#isize li').each(function(){
						$(this).remove();
					}); 
					
					if(sz==0){
						var li=document.createElement("li");
						li.innerHTML="无";
						isize.appendChild(li);
					}else{
						for(var i=0;i<sizes.length;i++) { 
							var li=document.createElement("li");
							li.innerHTML='<a onclick="select_size(this);" class="size_radioToggle">'+sizes[i]+'<input type="radio"  name="isize" value="'+sizes[i]+'-'+prices[i]+'-'+imgs[i]+'"/></a>';
							isize.appendChild(li);
						}
					}
				});
			}
			
			function select_size(obj){
				var val=obj.childNodes[1].value;
				
				var arr = val.split('-');
				$("#iimg").attr("src","data/upload/item_size/"+arr[2]);
				$("#iprice").html(arr[1]);
				$("#size").val(arr[0]);
				var thisToggle = $(obj).is('.size_radioToggle') ? $(obj) : $(obj).prev();
				var checkBox = thisToggle.prev();
				checkBox.trigger('click');
				$('.size_radioToggle').removeClass('current');
				thisToggle.addClass('current');
				
			}
			
			function addcart(tobuy){
				var id=$("#iid").val();
				var size=$("#size").val();
				var num=$("#quantity").val();
				
				var shopid=$("#shares_id").val();
				var url  = "<?php echo U('Shopcart/addcart');?>";
				var jsurl = "<?php echo U('Order/jiesuan');?>";
				if(tobuy==1){
					$.getJSON(url,{'goodId':id,'size':size,'shopid':shopid,'quantity':num},function(data){
						if(data.status==1){
							htm='<span>'+data.msg+'！购物车共有'+data.cart_count+'件商品,共计：'+data.cart_price+'元.</span>';
							$('.cartmsg').html(htm);
							$('.cartmsg').slideDown(600);
							$('.cartmsg').fadeOut(5000);
							setTimeout(slideUp_fn, 6000);
						}else{
							htm='<span>'+data.msg+'.</span>';
							$('.cartmsg').html(htm);
							$('.cartmsg').slideDown(600);
							$('.cartmsg').fadeOut(5000);
							setTimeout(slideUp_fn, 6000);
						}						
					});
				}else{
				
					$.getJSON(url,{'goodId':id,'size':size,'shopid':shopid,'quantity':num},function(data){
						if(data.status==1){
							location.href = jsurl+"&cartId="+data.cartId;	
						}else{
							htm='<span>'+data.msg+'.</span>';
							$('.cartmsg').html(htm);
							$('.cartmsg').slideDown(600);
							$('.cartmsg').fadeOut(5000);
							setTimeout(slideUp_fn, 6000);
						}
					});
				}
			}
		</script>
		
		<script>
			$(function(){
    			$(".ab").on("click",function(){
    				$("#my-actions").show(1000);
    			});
    		})
		</script>
		<!--返回顶部-->
		<script>
	        $(function(){
	            $('#gotop').click(function(){
	                $("html,body").animate({scrollTop:0},1000);
	                return false;
	            });
	            $(window).scroll(function(){
	                var obj=$('#gotop');
	                if(obj.offset().top>1000){
	                    obj.slideDown();
	                }else{
	                    obj.hide("slow");
	                }
	            });
	        });
    	</script>
	</body>
	
</html>