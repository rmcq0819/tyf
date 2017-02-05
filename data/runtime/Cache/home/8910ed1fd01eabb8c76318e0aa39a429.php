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
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;z-index: 999;background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; left:5px; top: 14px;
			}			
			/*头部*/
			
			/*-------------选项卡----------*/
			.tab1{
				width:100%;
			}
			.menu{
				width: 100%;height:35px; background: rgba(72,72,72,0.91);*zoom: 1; position: static;
			}
			.menu li{
				float:left;width:50%;text-align:center;line-height:36px;height:34px;cursor:pointer;color:rgb(171,171,171);font-size:14px;overflow:hidden; position: relative;
			}
			.menu li.off{
				color:rgb(240,93,0);
			}
			.menu li.off span{	
				padding: 0px 17px 7px 17px;
			}
			/*-----------轮播图-------------*/
			.swiper-container {
        		width: 100%;height: 100%;
    		}
		    .swiper-slide {
		        text-align: center;font-size: 18px;background: #fff;width: 100%; padding: 5px;
		        /* Center slide text vertically */
		        display: -webkit-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-pack: center;-ms-flex-pack: center;-webkit-justify-content: center;justify-content: center;-webkit-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;
		    }
		    .swiper-slide img{
		    	height: 165px;width: 100%;
		    }
			/*-------------暖冬推荐---------*/
			#con_one_1 dl{
				border-bottom: solid 1px rgb(223,223,223); 
			}
			#con_one_1 dl:last-child{
				margin-bottom: 40px;
			}
			#con_one_1 .p-title{
				overflow: hidden; text-overflow: ellipsis; white-space: nowrap; padding-left:8px; font-size: 13px; margin-top: 5px; color: rgb(85,85,85);
			}
			#con_one_1 .p-liyou{
				padding-left: 8px; color: red; font-size: 13px; margin-top: 4px;
			}
			#con_one_1 .p-jiage{
				padding-left: 8px; margin-top: 4px; font-size: 13px; color: rgb(85,85,85);
			}
			#con_one_1 .t-content{
				width: 69%;height: 44px;float: left; overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;
			}

		    /*-------------商城上新------------*/
			#con_one_2 dl:last-child{
				margin-bottom: 40px;
			}
			#con_one_2 #left{
				width: 46%; float: left; margin: 2% 2% 0% 2%; background-color: white;position: relative; left: 0px;
			}
			#con_one_2 #right{
				width: 46%; float: left; margin: 2% 2% 0% 2%; background-color: white; position: relative; left: 0px;
			}
			#con_one_2 .p-title{
				overflow: hidden; text-overflow: ellipsis; white-space: nowrap;font-size: 13px; margin-top: 5px; color: rgb(85,85,85);padding:0px 5px 0px 5px;
			}
			#con_one_2 .btn{
				width: 96%;height: 26px; margin-left: 2%; background-color: rgb(253,185,50); color: white; border: none; border-bottom: solid 2px rgb(235,94,2); border-radius: 4px; position: relative; left: 0px; margin-bottom: 6px; margin-top: 4px; box-shadow: 1px 0px 2px rgb(200,200,200);
			}
			#con_one_2 .price{
				width: 70px; height: 18px;position: absolute; left: 2px; top: 4px; font-size: 14px; text-shadow: 2px 2px 2px rgb(236,90,7); line-height: 18px;
			}
			#con_one_2 .gou{
				width: 55px; height: 17px; line-height: 17px;background-color: rgb(255,241,0); color: rgb(240,93,0); border-radius: 5px; border-bottom: solid 1px rgb(240,93,0); position: absolute; right: 7px; top: 5px; font-size: 12px; padding-left: 2px; padding-right: 2px;
			}
			.angle{
				 width:0px; height:0px;line-height:0;border:9px solid transparent; border-left-color:white;border-top:0;transform: rotate(45deg);-webkit-transform: rotate(45deg);outline: none;position: absolute; left: 50%; bottom: -10px; margin-left: -5px;
			}


		</style>
		<link rel="stylesheet" type="text/css" href="../Style/css/swiper.min.css"/>
		<link rel="stylesheet" type="text/css" href="../Style/css/animsition.min.css"/>

	</head>

	<body style="background:#f3f3f3;" class="animsition-overlay">
		<div class="topnav">
			<a href="<?php echo U('User/index');?>" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			<span class="title">暖冬推荐</span>
		</div>
		
		<!--轮播图-->
		<div class="swiper-container" style="margin-top: 50px;">
	        <div class="swiper-wrapper">
			
			<?php if(is_array($ads)): $i = 0; $__LIST__ = $ads;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide" <?php if($vo["url"] != ''): ?>onClick="location.href='<?php echo ($vo["url"]); ?>&shares=<?php echo ($info['id']); ?>'"<?php endif; ?>><img src="data/upload/advert/<?php echo ($vo["content"]); ?>" alt="" class="am-img-responsive"/></div><?php endforeach; endif; else: echo "" ;endif; ?>
		   </div>
	        <!-- Add Pagination -->
	        <div class="swiper-pagination"></div>
		</div>
		
		<!--选项卡-->
		<div class="tab1" id="tab1">
			<div class="menu" style="position:fixed;bottom:0px; left:0px; z-index: 1000;">
				<ul>
					<li id="one1" onclick="setTab('one',1)"><span><img src="../Style/index-images/activity/tuijian-c.png" alt="" style="width: 20px;"/>&nbsp;&nbsp;暖冬推荐</span></li>
					<li id="one2" onclick="setTab('one',2)"><span><img src="../Style/index-images/activity/xinpin-h.png" alt="" style="width: 20px;"/>&nbsp;&nbsp;商城上新</span></li>
				</ul>
			</div>

			<div class="menudiv">
				<!--暖冬推荐-->
				<div id="con_one_1">
					<img src="../Style/index-images/activity/nuandong.png" alt="" class="am-img-responsive" style="margin-top: 10px;"/>
					<?php if(is_array($sitems)): $i = 0; $__LIST__ = $sitems;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><dl style="background-color: white; padding: 7px;" onclick="location='<?php echo U('Item/index',array('id'=>$vol['id'],'shares'=>$info['id']));?>'">
						<div class="am-g">
  							<div class="am-u-sm-4">
  								<img src="data/upload/item/<?php echo get_thumb($vol['pic'], '_b');?>" alt="" class="am-img-responsive" style="width: 107px;"/>
  							</div>
  							<div class="am-u-sm-8">
  								<p class="p-title"><?php echo ($vol["title"]); ?></p>
  								<div style="width: 95%; margin-left: 8px; color: red;">
  									<div style="width: 31%;float: left; height: 44px;">推荐理由：</div>
  									<div class="t-content"><?php echo ($vol["reason"]); ?></div>
  									<div style="clear: both;"></div>
  								</div>
  								<div style="clear: both;"></div>							
  								<p class="p-jiage">优品价:
  									<span style="color: rgb(240,93,0); font-size: 13px;">￥<?php echo ($vol["price"]); ?></span>
  									<span style="float: right;padding-left: 8px; text-align: right; margin-top: 0px; color: rgb(171,171,171); font-size:12px;-webkit-transform: scale(0.80);"><?php echo ($vol["buy_num"]); ?>人已购买</span>
  								</p>
  							</div>
						</div>
					</dl><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

				<!--商城上新-->
				<div id="con_one_2" style="display:none;">
					<img src="../Style/index-images/activity/shangxin.png" alt="" class="am-img-responsive" style="margin-top: 10px;"/>
					<?php if(is_array($nitems)): $i = 0; $__LIST__ = $nitems;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i; if(($mod) == "0"): ?><dl style="width: 100%;">
						<div id="left" onclick="location='<?php echo U('Item/index',array('id'=>$nitems[$i-1]['id'],'shares'=>$info['id']));?>'">
							<img src="data/upload/item/<?php echo ($nitems[$i-1]['pic']); ?>" alt="" class="am-img-responsive"/>
							<p class="p-title"><?php echo ($nitems[$i-1]['title']); ?></p>
							<button class="btn">
								<span class="price">￥<?php echo ($nitems[$i-1]['price']); ?></span>
								<span class="gou">点击购买</span>
								<div class="angle"></div>
							</button>
						</div>
						<div id="right" onclick="location='<?php echo U('Item/index',array('id'=>$nitems[$i]['id'],'shares'=>$info['id']));?>'">
							<img src="data/upload/item/<?php echo ($nitems[$i]['pic']); ?>" alt="" class="am-img-responsive"/>
							<p class="p-title"><?php echo ($nitems[$i]['title']); ?></p>
							<button class="btn">
								<span class="price">￥<?php echo ($nitems[$i]['price']); ?></span>
								<span class="gou">点击购买</span>
								<div class="angle"></div>
							</button>
						</div>
						<div style="clear: both;"></div>
						
						
						
					</dl><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>

		<script src="../Style/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="../Style/js/animsition.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function() {
  
		  $(".animsition-overlay").animsition({
		  
		    inClass               :   'overlay-slide-in-top',
		    outClass              :   'overlay-slide-out-top',
		    inDuration            :    2000,
		    outDuration           :    800,
		    linkElement           :   '.animsition-link',
		    // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
		    loading               :    true,
		    loadingParentElement  :   'body', //animsition wrapper element
		    loadingClass          :   'animsition-loading',
		    unSupportCss          : [ 'animation-duration',
		                              '-webkit-animation-duration',
		                              '-o-animation-duration'
		                            ],
		    //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
		    //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
		    
		    overlay               :   true,
		    
		    overlayClass          :   'animsition-overlay-slide',
		    overlayParentElement  :   'body'
		  });
		});
		</script>
		<script>
		    var swiper = new Swiper('.swiper-container', {
		        pagination: '.swiper-pagination',
		        slidesPerView: 'auto',
		        paginationClickable: true,
		        spaceBetween: 30,
		        autoplay:4000
		    });
    	</script>
		<!--选项卡JS-->
		<script type="text/javascript">
			function setTab(name,cursel){
				cursel_0=cursel;
				for(var i=1; i<=links_len; i++){
					var menu = document.getElementById(name+i);
					var menudiv = document.getElementById("con_"+name+"_"+i);
					if(i==cursel){
						menu.className="off";
						menudiv.style.display="block";
					}
					else{
						menu.className="";
						menudiv.style.display="none";
					}
				}
			}
			function Next(){                                                        
				cursel_0++;
				if (cursel_0>links_len)cursel_0=1
				setTab(name_0,cursel_0);
			} 
			var name_0='one';
			var cursel_0=1;
			
			var links_len,iIntervalId;
			onload=function(){
				var links = document.getElementById("tab1").getElementsByTagName('li')
				links_len=links.length;
				for(var i=0; i<links_len; i++){
					links[i].onmouseover=function(){
						clearInterval(iIntervalId);
						this.onmouseout=function(){
							iIntervalId = setInterval(Next,ScrollTime);;
						}
					}
				}
				document.getElementById("con_"+name_0+"_"+links_len).parentNode.onmouseover=function(){
					clearInterval(iIntervalId);
					this.onmouseout=function(){
						iIntervalId = setInterval(Next,ScrollTime);;
					}
				}
				setTab(name_0,cursel_0);
				iIntervalId = setInterval(Next,ScrollTime);
			}
		</script>
		<script type="text/javascript">
			$(function(){
				$("#one2").on("click",function(){
					$("#one2").find("img").attr("src","../Style/index-images/activity/xinpin-c.png");
					$("#one1").find("img").attr("src","../Style/index-images/activity/tuijian-h.png");
					$(".topnav .title").html("商城上新");
				});
				$("#one1").on("click",function(){
					$("#one2").find("img").attr("src","../Style/index-images/activity/xinpin-h.png");
					$("#one1").find("img").attr("src","../Style/index-images/activity/tuijian-c.png");
					$(".topnav .title").html("暖冬推荐");
				});
			})
		</script>
		<!-- <script type="text/javascript">
			var  time = null;
			$(document).on('scroll',function(){
				clearInterval(time);
				$('.menu').fadeOut("fast");
				time=setInterval(function(){
					$('.menu').fadeIn("fast");
				},1200)
			});
		</script> -->
		
	</body>

</html>