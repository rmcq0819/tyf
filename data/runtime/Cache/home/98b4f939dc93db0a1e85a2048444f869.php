<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

	<head>
		<title>商品搜索</title>
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




		<script src="../Style/js/addclear.js"></script>
		<script type="text/javascript" charset="utf-8">
	  		$(function(){
	    		$("input").addClear();
	  		});
		</script>
		<style>
			* {
				border: none;outline: none;font-family: "微软雅黑";
			}
			/*头部*/
			.topnav {
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;background-color: rgb(240, 93, 0);
			}
			#search{
				width: 95%;text-align: center; margin: 0 auto; margin-top: 60px;
			}
			#search input{
				width: 67%;height: 30px;color: rgb(85,85,85);font-size: 13px;border-bottom-left-radius: 8px;border-top-left-radius: 8px;border-bottom-left-radius: 8px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;background-color: rgb(236,234,234);padding-left:95px;padding-right:25px; padding-top: 4px;border: solid 1px rgb(240,93,0);
			}
			#search button{
				width: 28%;height: 30px;color: white;margin-left: -4px;background-color: rgb(240,93,0); font-size: 13px;
			}
			/*三角形*/
			#triangle{
				float:left; border-style:solid; border-width:10px; border-color:#ECEAEA #ECEAEA white #ECEAEA;margin-left: 20%; margin-top: -10px;
			}
			/*搜索历史*/
			#history{
				margin-top: 10px;
			}
			#history i{
				color: rgb(180,180,180);
			}
			#history ul li{
				padding: 10px;
			}
			#history img{
				width: 20px;
				height: 20px;
			}
			#history ul li:first-child{
				border-top: none;
			}
			#history .clear-history{
				width: 65px;height:24px;float: right;line-height: 24px;border: solid 1px rgb(240,93,0);color:rgb(240,93,0);font-size:13px;border-radius:5px;text-align:center;
			}
			/*热门搜索*/
			#hot-search{
				width: 100%; background-color: white; margin-top: 20px;padding: 10px;
			}
			#hot-search p{
				font-size: 16px;
			}
			#hot-search li{
				float: left;margin-left: 7px;margin-top: 13px;
			}
			#hot-search li span{
				padding: 5px 13px 5px 13px;background: rgb(240,240,240);
			}
			
		</style>
		<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	</head>
	<body>
		<input type="hidden" name="shares_id" id="shares_id" value="<?php echo ($info["id"]); ?>" />
		<!--头部-->
		<div class="topnav">
			<a href="javascript:;" onClick="window.history.back(-1);" class="back">
				<img src="../Style/images/fanhui1.png" width="25" style="position: absolute; left:5px; top: 14px;" />
			</a>
			商品搜索
		</div>
		<!--商品搜搜-->
		<div id="search" style="position: relative; left: 0px;">
			<input type="text" name="keyword" value="<?php echo ($keyword); ?>" placeholder="关键词搜索"/>
			<img class="search-img" src="../Style/index-images/search_ico.png" alt="搜索" style="width: 22px; position: absolute; left: 80px; top: 5px;"/>
			<button class="button"  id="search_btn">搜&nbsp;&nbsp;索</button>	
		</div>
		<script>
			$(function(){
				$("input[name='keyword']").focus(function(){
					$(".search-img").animate({"left":"16px"},550);
					$("input[name='keyword']").animate({"padding-left":"34px"},550);
					$("input[name='keyword']").attr("placeholder","请输入商品关键词搜索");
				});
			})
			$('#search_btn').click(function(){
				var keyword=$('input[name=keyword]');
				var shares_id = $('input[name=shares_id]');
				if(keyword.val() == ''){
					 layer.open({
						title: '提示',
						content: '你还是输点什么再点我吧~',
						btn: ['我知道了'],
						yes: function(index){
							//location.reload();
							layer.close(index);
						}
					}); 
				}else{
					window.location.href= "<?php echo U('Item/itemlist',array('keyword'=>'"+keyword.val()+"','shares'=>'"+shares_id.val()+"'));?>";
				}
			});
		
		</script>
		<!--三角形-->
		<div id="triangle"></div>
		
		<!--搜索历史-->

		<div id="history" data-am-widget="list_news" class="am-list-news am-list-news-default">
		  	<div class="am-list-news-bd">
		  		<ul class="am-list">
		      		<li class="am-g am-list-item-dated">
		          		<div class="am-g">
						<?php if(!empty($search_history)): ?><div class="am-u-sm-4"><span style="font-size: 16px;">搜索历史</span></div>
  							
							<div class="am-u-sm-8"><span class="clear-history" id="clear_history">清空记录</span></div>
							<?php else: ?>
							<div class="am-u-sm-4" style="width: 100%;"><p style="font-size: 13px;color:#555;">目前还没有搜索记录</p></div><?php endif; ?>
						</div>
		      		</li>
					<script>
							$("#clear_history").click(function(){
								layer.open({
									title: '提示',
									content: '您确定要清空搜索记录吗？',
									btn: ['确认', '取消'],
									yes: function(index){
										window.location.href= "<?php echo U('User/clear_searchHistory',array('shares'=>$shares_id));?>";
										layer.open({content: '搜索记录已被清空', time: 1});
										layer.close(index);
									}
								});
							});
					</script>
		      		<?php if(is_array($search_history)): $i = 0; $__LIST__ = $search_history;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="am-g am-list-item-dated">
		         		<div class="am-g">
		         			<a href= "<?php echo U('Item/itemlist',array('keyword'=> $vo,'shares'=>$info['id']));?>" style="color:#000000;">
  							<div class="am-u-sm-1"><img src="../Style/index-images/clock.jpg" class="am-img-responsive"/></div>
  							<div class="am-u-sm-10"><?php echo ($vo); ?></div>
  							<div class="am-u-sm-1"><i class="am-icon-chevron-right"></i></div>
  						    </a>
						</div>
		      		</li><?php endforeach; endif; else: echo "" ;endif; ?>
		  		</ul>
		  	</div>
    	</div>
    	
    	<!--热门搜索-->
    	<div id="hot-search">
    		<p>搜索发现</p>
    			<div id="first-find" class="am-g">
    				<ul style="text-align: center; margin: 0 auto; width: 96%;">
					<?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li>
    						<a href= "<?php echo U('Item/itemlist',array('keyword'=> $vol['keyword'],'shares'=>$info['id']));?>">
    							<span><?php echo ($vol['keyword']); ?></span>
    						</a>
    					</li><?php endforeach; endif; else: echo "" ;endif; ?>
    				</ul>
  					
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