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




		<script src="../Style/assets/countUp.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="../Style/css/animate.min.css" />
		<style>
			* {
				font-family: "微软雅黑";
			}
			/*头部*/
			.topnav {
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;z-index: 999;background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; left:5px; top: 14px;
			}			
			#content p {
				text-align: center;font-size: 15px;color: #555;
			}
			/*积分中心*/
			#score{
				widows: 100%;height: 100px;margin-top: 49px;position: relative;left: 0px;
			}
			#score .rule{
				position: absolute; top: 168px; right: 20px; color: rgb(85,85,85); font-size: 13px;
			}
			#score .share,#score .choose{
				width: 63px; height: 63px; position: absolute; right: 15px; top: 0;
			}
			#score .choose{
				opacity: 0;
			}
			
			#score .all{
				width: 100%; color: white; position: absolute;top:120px;text-align: center; margin-left: -40px; font-size: 12px;
			}
			#score .total{
				width:100%;color: white; position: absolute; top: 145px; font-size: 25px; text-align: center;
			}
			
			/*选项卡*/
			.space{
				position: absolute; z-index: 999; height: 40px;
			}
			.tab1{
				width:100%;margin:50px auto 0 auto; margin-top: 100px;
			}
			.menu{
				height:28px;
			}
			.menu li{             /*选项卡切换*/
				float:left;text-align:center;font-size:14px;width: 50%; height: 40px; background-color: rgb(240, 93, 0);
			}
			.menu li img{
				width: 25px; height: 25px; line-height: 40px;
			}
			.menu li.off{
				background-color: rgb(240,93,0);
			}

			.menudiv{
				border-left:#cccccc solid 1px;border-right:#cccccc solid 1px;border-top:0;background:#fefefe;
			}
			.menudiv div{
				padding:5px 5px 0px 5px;line-height:28px;
			}

			#con_one_1 .title,#con_one_2 .title{
				padding: 10px;width: 100%;border-bottom: 1px solid #eee; height: 40px; line-height: 20px;
			}
			#con_one_1 .title span:first-child,#con_one_2 .title span:first-child{             /*范票明细*/
				border-left: solid 2px rgb(240,93,0); color: #555; font-size: 15px;
			}
			#con_one_1 .title span:last-child,#con_one_2 .title span:last-child{              /* 更多*/
				float: right; font-size: 13px; color: rgb(171,171,171);
			}
			
			#con_one_1 ul li,#con_one_2 ul li{
				border-bottom: 1px solid #eee; height: 55px;padding:10px;
			}
			#con_one_1 ul li p:first-child,#con_one_2 ul li p:first-child{
				line-height: 18px;
			} 
			#con_one_1 ul li .type,#con_one_2 ul li .type{                         /* 类型*/
				color: rgb(85,85,85); font-size: 14px;
			}
			#con_one_1 ul li .num,#con_one_2 ul li .num{                          /* 积分*/
				float: right; line-height: 40px; color: black;
			}
			#con_one_1 ul li .time,#con_one_2 ul li .time{                         /*时间*/
				color: rgb(170,170,170); font-size: 13px;
			}
			
			/*没有积分的时候*/
			.no-score{
				margin-top: 50px;text-align: center; margin-top: 30px;
			}
			.no-score img{
				width: 90px; height: 90px;
			}
			.no-font1{
				text-align: center; color: #555; margin-top: 5px;font-size:13px;
			}
			.no-font2{
				text-align: center; color: #555; margin-bottom: 50px;font-size:13px;
			}
			/*动画*/
			.dowebok{
				animation-delay: 1s;
				animation-iteration-count:15;
			} 
			
			/*弹出选择框*/
			.am-modal-hd{
				padding: 11px 10px 10px 10px;
			}
			.am-close{
				font-size: 28px;opacity: 0.9; color: white;
			}
			#doc-modal-1 .am-modal-hd{
				background-color: rgb(240,93,0); color: white;
			}
			#doc-modal-1 .am-modal-bd .left{
				width: 50%; float: left;
			}
			#doc-modal-1 .am-modal-bd .right{
				width: 50%; float: right;
			}
			#doc-modal-1 .am-modal-bd .left img,#doc-modal-1 .am-modal-bd .right img{
				width: 95px; height: 95px;margin: 0 auto; margin-top: 20px;
			}
			#doc-modal-1 .am-modal-bd button{
				width: 130px; height: 28px; background-color: rgb(249,93,0); color: white; border: none; margin-top: 25px; border-radius: 4px; font-size: 13px;
			}
		</style>

	</head>

	<body style="background:#f3f3f3;">
		
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			我的范票
		</div>
		<!--积分中心-->
		<div id="score">
			<img src="../Style/index-images/jifen-bg.png" class="am-img-responsive" alt="背景图" style="width: 100%; height: 200px; " />
			<!--<img class="animated swing dowebok share" src="../Style/index-images/fenxiang2.png" onclick="window.location.href='<?php echo U('User/redbag_share',array('shares'=>$info['id']));?>'" alt="分享范票" />-->
			<img class="animated swing dowebok share" src="../Style/index-images/fenxiang2.png" alt="分享范票" />
			<button type="button" class="am-btn am-btn-primary choose" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 295, height: 225}"></button>
			<p class="rule" onclick="window.location.href='<?php echo U('User/rule');?>'"><img src="../Style/index-images/rule.png" alt="范票规则" style="width: 20px; height: 20px; line-height: 23px;" />&nbsp;范票规则</p>
			<p class="total" id="myTargetElement3"></p>
		</div>
		
		<!--弹出选择红包类型-->
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
		  	<div class="am-modal-dialog">
		    	<div class="am-modal-hd">
		    		选择分享红包类型
		     		<a href="javascript: void(0)" class="am-close am-close-spin btn-close" data-am-modal-close>&times;</a>
		    	</div>
		    	<div class="am-modal-bd">
				
		      		<div class="left" onclick="window.location.href='<?php echo U('User/redbag_one',array('shares'=>$info['id']));?>'" >
		      			<img src="../Style/index-images/single.png" alt="单个发私包" class="am-img-responsive" />
		      		</div>
					
		      		<div class="right" onclick="window.location.href='<?php echo U('User/redbag_share',array('shares'=>$info['id']));?>'">
						<img src="../Style/index-images/duoge.png" alt="多个拼手气" class="am-img-responsive" />
		      		</div>
		      		<button class="btn-close" data-am-modal-close>取&nbsp;&nbsp;消</button>
		      		<div style="clear: both;"></div>
		    	</div>
		  	</div>
		</div>
		
		<script>
			var options = {
				useEasing : true, 
				useGrouping : true, 
				separator : ',', 
				decimal : '.', 
				prefix : '', 
				suffix : '张'
			};
			var countpoint = new CountUp("myTargetElement3", 0, <?php echo $point_yuer; ?>, 0, 2.5, options);
			countpoint.start();
		</script>
		
		
		<div class="tab1" id="tab1">
			<div class="menu">
				<ul>
					<li id="one1" onclick="setTab('one',1)">
						<p style="line-height: 40px; color: white;"><img src="../Style/index-images/zhuan.png" alt="赚"/>&nbsp;赚了多少</p>
					</li>
					<img class="space" src="../Style/index-images/space.png" alt="分割线"/>
					<li id="one2" onclick="setTab('one',2)">
						<p style="line-height: 40px; color: white; "><img src="../Style/index-images/hua.png" alt="花"/>&nbsp;花了多少</p>
					</li>
				</ul>
			</div>
			
			
			<div class="menudiv" style="margin-top: 20px;">
				
				<!--我要赚-->
				<div id="con_one_1">
					<p class="title"><span>&nbsp;范票明细</span><span onclick="window.location.href='<?php echo U('User/point_detail',array('type'=>1));?>'">更多明细>></span></p>
					<?php if(!empty($msglist)): ?><ul>
							<?php if(is_array($msglist)): $i = 0; $__LIST__ = $msglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
										<p><span class="type">
										<?php switch($val["type"]): case "5": ?>购物奖励范票<?php break;?>
												<?php case "6": ?>评论奖励范票<?php break;?>
												<?php case "8": ?>红包奖励范票<?php break;?>
												<?php case "9": ?>系统奖励范票<?php break;?>
												<?php case "11": ?>红包退还范票<?php break;?>
												<?php case "12": ?>范票充值成功<?php break;?>
												<?php case "20": ?>转盘抽奖范票<?php break;?>
												<?php case "22": ?>系统返还范票<?php break;?>
												<?php case "19": ?>人气店铺奖励<?php break; endswitch;?>
										<span><span class="num">+<?php echo ($val["points"]); ?></span>
										</p>
										<p class="time"><?php echo (date('Y-m-d H:i:s',$val["time"])); ?></p>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<?php else: ?>
						<p class="no-score"><img src="../Style/index-images/no-jifen.png" alt="没积分"/></p>
						<p class="no-font1">您还没有范票哦</p>
						<p class="no-font2">赶紧看看<a href="<?php echo U('User/rule');?>" style="color:rgb(240,93,0);">范票规则</a>赚范票吧~</p><?php endif; ?>
				</div>
				
				<!--我要花-->
				<div id="con_one_2" style="display:none;">
					<p class="title"><span>&nbsp;范票明细</span><span onclick="window.location.href='<?php echo U('User/point_detail',array('type'=>2));?>'">更多明细>></span></p>
					<?php if(!empty($declist)): ?><ul> 
								<?php if(is_array($declist)): $i = 0; $__LIST__ = $declist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
										<p><span class="type">
										<?php switch($val["type"]): case "7": ?>购物抵扣范票<?php break;?>
												<?php case "10": ?>范票红包分享<?php break;?>
												<?php case "21": ?>抽奖机会抵扣<?php break;?>
												<?php case "25": ?>系统回收范票<?php break;?>
												<?php case "26": ?>范票商城兑换<?php break; endswitch;?>
										<span><span class="num">-<?php echo ($val["points"]); ?></span></p>
										<p class="time"><?php echo (date('Y-m-d H:i:s',$val["time"])); ?></p>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
							<?php else: ?>
							<p class="no-score"><img src="../Style/index-images/no-jifen.png" alt="没积分"/></p>
							<p class="no-font1">您还没有范票使用记录哦~</p>
							<p class="no-font2">现在就去<a href="<?php echo U('Index/index');?>" style="color:rgb(240,93,0);">使用</a>范票</p><?php endif; ?>
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
		<!--<script src="../Style/assets/js/amazeui.min.js"></script>-->
		
		<!--选项卡js-->
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
							iIntervalId = setInterval(Next,ScrollTime);
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
		<script>
			$(function(){
				$(".choose").on("click",function(){
					if($("doc-modal-1").css("display")!="none")     //禁止页面滚动
					{
						window.ontouchmove=function(e){
	        			e.preventDefault && e.preventDefault();
	        			e.returnValue=false;
	        			e.stopPropagation && e.stopPropagation();
	        			return false;
						}
					}
				});
				
			});
			$(function(){
				$(".btn-close").on("click",function(){        //当关闭选择红包页面的时候   页面可以滚动
					window.ontouchmove=null; 
				});
			});
		</script>
	</body>

</html>