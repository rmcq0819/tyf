<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
<title>在售商品</title>
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
	/*分页*/
	#footer{
		width:100%;height:50px;line-height:50px;background-color:rgb(255,255,255);position:fixed;bottom:0;left:0;border-top:solid 1px #ccc;
	}
	#footer ul{
		width:230px;height:50px;line-height:50px;margin:0 auto;font-size:15px;
	}
	#footer ul li{
		height:50px;padding-left:15px;display:inline;color:rgb(162,162,162);
	}
	#footer #change_page{
		background-color:rgb(166,166,166); color:white;
	}
	/*分类筛选S */
	.bottomnav{width:100%;height:76px;border-bottom:1px solid #ccc;top:0px;background:#fff;position:fixed;top:0px;left:0px;}
	.bottomnav .left_sort{width:100%; height:45px; border-bottom:solid 1px #ccc;}
	#doc-select-1{width: 90%;height: 30px; margin:5px 5px 0px 5px; border: none; font-size: 12px; white-space: nowrap; background-color: white;}
	.bottomnav .left_sort .left_sele{border:none; outline:none; float:left; width:20%; height:30px; margin-top:5px; padding:0px; }
	.bottomnav .left_sort .right_sele{border:none; outline:none; float:right; width:20%; height:30px;  margin-top:5px;}
	.bottomnav .left_sort .arrow_img{float:left; margin-top:-29px;margin-left:1px;}
	#top_input{width:65%;height:42px;float:left;margin:0 auto;}
	.bottomnav .input{background:url(../Style/images/search_bg.jpg) no-repeat left center #e5e5e5;width:100%;height:30px;border:0px;outline:none;text-align:center;margin-top:5px;border-radius:0px;}
	.bottomnav .btn_sea{background:url(../Style/images/btn_bg.jpg) no-repeat left center;padding-top:5px;border:0px;width:100%; height:30px;display:block;margin-top:5px;margin-right:15px;color:#555;font-size:14px;line-height:20px;padding-right:10px;}
	.bottomnav a{width:50%;height:30px;line-height:30px;display:block;float:left;text-align:center;font-size:14px;color:#333;}
	/* 在商品列表外层加一个盒子，解决ios在overflow:scroll之后带来的卡顿问题，但这会耗费更多内存 */
	#scroll_box{position:fixed;top:38px;bottom:38px;width:100%;overflow:scroll;-webkit-overflow-scrolling: touch;}
	.page_list li {float:left;margin-right:10px;}
	.page_num{margin-top:15px;width:30px;background:#a6a6a6;height:20px;line-height:20px;font-size:13px;text-align:center;color:#555;border:1px solid #dcdcdc;float:left;color:#fff;}
</style>
</head>
<body>
<div id='rtt'></div>
<input type="hidden" name="cate_id" value="<?php echo ($cate_id); ?>" />
<input type="hidden" name="type" value="<?php echo ($type); ?>" />
<!--<input type="hidden" name="itemtype" value="<?php echo ($itemtype); ?>" />-->
<!-- top banner 
<div class="probanner">
<img src="data/upload/advert/<?php echo ($ad["content"]); ?>" <?php if($ad["url"] != ''): ?>onClick="location.href='<?php echo ($ad["url"]); ?>'"<?php endif; ?> />
</div>
-->

<!-- itemlist -->
<div class="load">
<img src="../Style/images/loading.gif" />
<span>玩命加载中..</span>
</div>

<div id="scroll_box">
<div class="index_product_list am-list-news-bd  onpromain" style="margin-top:40px; margin-bottom:40px;">
<ul class="am-list">
<?php if(is_array($itemlist)): $i = 0; $__LIST__ = $itemlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="pdt_ser_li am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
<a href="<?php echo U('Item/index',array('id'=>$vo['id'],'shares'=>$info['id']));?>">
<div class="am-u-sm-4 am-list-thumb onproimg">
<img src="data/upload/item/<?php echo ($vo["img"]); ?>" >
</div>
<div class=" am-u-sm-8 am-list-main onprozi">
<h3 class="am-list-item-hd" style="padding-left:65px;"><?php echo ($vo["title"]); ?></h3>
<div class="am-list-item-text"><p style="padding-left:65px;">价格：<span style="color:#333;font-weight:bold;">¥<?php echo ($vo["price"]); ?></span></p>
<p style="padding-top:15px;padding-left:65px;">零售奖金：<span style="color:#ff0000;font-weight:bold;">¥<?php echo ($vo[0]); ?></span></p></div>
</div>
</a>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div>
</div>

<script>
	$(document).ready(function(){ 
		$('#doc-select-1').change(function(){ 
			var ProdClass=$(this).children('option:selected').val();
			if(ProdClass == '分类'){
				window.location.href= "<?php echo U('Item/onitemlist');?>";
			}else{
				window.location.href= "<?php echo U('Item/onitemlist',array('cate_id'=>'"+ProdClass+"'));?>";
			}
		}) 
	}) 
</script> 
<div class="bottomnav">
	<div class="left_sort">
		<div style="width:15%;float:left;">
			<select id="doc-select-1" name="cate_id" style="height:35px;line-height:40px;-webkit-appearance:none;appearance:none;border:none;font-size:15px;padding:0px 10px;display:block;width:100%;-webkit-box-sizing:border-box;box-sizing:border-box;background:#fff;color:#333333;border-radius:4px;">
					<option value="分类">分类</option>
					<?php if(is_array($itemcatelist)): $i = 0; $__LIST__ = $itemcatelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" style="border-top:solid 1px red;"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>		           
			</select>
			<span class="arrow_img"><img src="../Style/images/arrow_sans_lowerright_32-11.png"></span>
		</div>
		
		<div id="top_input">
			<?php if($_GET['keyword'] != ''): ?><input class="input" type="text" id="keyword" name="keyword" placeholder="<?php echo ($_GET['keyword']); ?>"/>
				<?php else: ?><input class="input" type="text" id="keyword" name="keyword" placeholder="搜点什么吧 ~"/><?php endif; ?>
		</div>
		<div style="width:20%; float:right;">
			<a class="btn_sea" id="search_btn">搜索</a>
		</div>
		
		<script>
				$('#search_btn').click(function(){
					var keyword=$('input[name=keyword]');
					if(keyword.val() == ''){
						alert('您还是输点什么再点我吧 ~');
						return false;
					}else{
						window.location.href= "<?php echo U('Item/onitemlist',array('keyword'=>'"+keyword.val()+"'));?>";
					}
				});

		</script>
		
		
		

	</div>
	
	<input type="hidden" id="seq" name="status" value="<?php echo ($status); ?>" />
	<a style="border-right:1px solid #ccc;" id="priscreen">
		<i class="am-icon-long-arrow-up" id="pri_h"></i>
		<i class="am-icon-long-arrow-down" id="pri_l"></i>
		销售价格
	</a>
	<script>
			$('#priscreen').click(function(){
				var seq_val = $("#seq").val();//获取隐藏的input的值
				if(seq_val==1){
			        window.location.href= "index.php?m=Item&a=onitemlist&act=pri&p=<?php echo ($now); ?>&status=0&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>";
			    }else{
			    	window.location.href= "index.php?m=Item&a=onitemlist&act=pri&p=<?php echo ($now); ?>&status=1&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>";
			    }
			    //alert(seq_val);
				
	
			});

	</script>
	<a  id="jjscreen">
		<i class="am-icon-long-arrow-up" id="jj_h"></i>
		<i class="am-icon-long-arrow-down" id="jj_l"></i>
		零售奖金
	</a>
	<script>
			$('#jjscreen').click(function(){
				var seq_val = $("#seq").val();//获取隐藏的input的值
				if(seq_val==1){
			        window.location.href= "index.php?m=Item&a=onitemlist&act=jj&p=<?php echo ($now); ?>&status=0&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>";
			    }else{
			    	window.location.href= "index.php?m=Item&a=onitemlist&act=jj&p=<?php echo ($now); ?>&status=1&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>";
			    }
	
			});
	</script>
</div>
<!-- 分类筛选E -->

<!-- 分页 -->

</div>



<div id="footer">
		<ul class="page_list">
			<li> <a href="index.php?m=Item&a=onitemlist&p=<?php echo ($first); ?>&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>"><img src="../Style/images/fast_bg.jpg" style="width:18px;height:18px;" /></a></li>
			<li> <a href="index.php?m=Item&a=onitemlist&p=<?php echo ($now-1<1?$first:$now-1); ?>&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>"><img src="../Style/images/prev_bg.jpg" style="width:18px;height:18px;" /></li>
			<li><div class="page_num" style="color:#fff;"><?php echo ($now); ?></div></li>
			<li> <a href="index.php?m=Item&a=onitemlist&p=<?php echo ($now+1>$last?$last:$now+1); ?>&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>"><img src="../Style/images/next_bg.jpg" style="width:18px;height:18px;" /></a></li>
			<li> <a href="index.php?m=Item&a=onitemlist&p=<?php echo ($last); ?>&cate_id=<?php echo ($cid); ?>&keyword=<?php echo ($kw); ?>"><img src="../Style/images/forward_bg.jpg" style="width:18px;height:18px;" /></a></li>
		</ul> 
</div>


</body>
<script src="../Style/js/jquery-ias.min.js" type="text/javascript"></script>    
<script type="text/javascript">
    $(function () {
        var ias = $.ias({
            container: ".index_product_list",
            item: ".pdt_ser_li",
            pagination: "#pagination",
            next: ".next a"
        });
        ias.extension(new IASSpinnerExtension());
        ias.extension(new IASTriggerExtension({ offset: 3 }));
        ias.extension(new IASNoneLeftExtension({ text: '已加载全部' }));
    })
</script>
<!---分离ios和android系统，解决position：fixed和android系统滚动不顺畅问题--->
<script type="text/javascript">
  $(function(){
	var ua = navigator.userAgent.toLowerCase();	
	if (/iphone|ipad|ipod/.test(ua))  //ios系统
	{
		//alert('iphone');
		$("#scroll_box").css({'position':'fixed','top':'38px','bottom':'24px','width':'100%','overflow-y':'auto','-webkit-overflow-scrolling':'touch'});
		//alert("设置完成1");
	} 
	else if(/android/.test(ua))    //android系统
	{
	    //alert('android');
		$("#scroll_box").css({'overflow-y':'auto'});
		$(".index_product_list").css({'margin-top':'80px'});
		$(".bottomnav").css({'margin-top':'10px'});
		//alert("设置完成2");
	}
  });
</script>
</html>