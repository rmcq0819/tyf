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




<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script language="JavaScript">
wx.config({
    debug: false,
    appId: 'wxc3f8ad3fc6c24903',
    timestamp: "<?php echo ($jsapi['timestamp']); ?>",
    nonceStr: "<?php echo ($jsapi['timestamp']); ?>",
    signature: "<?php echo ($jsapi['signature']); ?>",
    jsApiList: [
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
    ]
  });
  
  wx.ready(function () {
     wx.onMenuShareTimeline({
        title: "<?php echo ($item['title']); ?>-团洋范", // 分享标题
        link: "<?php echo ($jsapi['url']); ?>", // 分享链接
        imgUrl: "http://yooopay.com/data/upload/item/<?php echo ($item['img']); ?>", // 分享图标
    });
    wx.onMenuShareAppMessage({
        title: "<?php echo ($item['title']); ?>-团洋范", // 分享标题
        desc: "<?php echo ($item['title']); ?>-团洋范", // 分享描述
        link: "<?php echo ($jsapi['url']); ?>", // 分享链接
		imgUrl: "http://yooopay.com/data/upload/item/<?php echo ($item['img']); ?>", // 分享图标
        type: 'link', 
        dataUrl: '',
    });
  });
</script>
<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
<link href="../Style/css/lightbox.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.proneirong img{width:100%}
.proneimain img{width:100%}
</style>
<!-- 购物流程S -->
<script type="text/javascript">	
	//点击调用次方法
	function shoucangFn() {
		//商品的id号
		var id = <?php echo ($item["id"]); ?>;
		var url = "./index.php";
		//发出请求
		$.getJSON(url,{m:"Item",a:"shoucang",id:id},function(data){
			//请求完毕后返回的数据
			if(data.error){
				/*alert(data.error);
				if(data.error === "请先登录后收藏!") {
					location.href = "./index.php?m=User&a=login";
				}*/
				$(".am-icon-star-o").css('color','#FABE01');
				$('.cartmsg').html(data.error);
				$('.cartmsg').slideDown(500);
				setTimeout(slideUp_fn, 6000);
				return;
			}
			if(data.success) {
				//alert(data.success);
				$(".am-icon-star-o").css('color','#FABE01');
				$('.cartmsg').html(data.success);
				$('.cartmsg').slideDown(500);
				setTimeout(slideUp_fn, 6000);	
			}
		});
	}	
	
	
    function buys(an,cb)
    {
		var size = $("input[name=size]").val();
		var issize = $("input[name=issize]").val();	//判断是否存在分类，若无为单品下单，获取单品价格
		var title = $("#title").val();
    	var img = $("#img").val();
    	var price = $("#price").val();
    	var aprice = $("#aprice").val();
		var itemtype = $("#itemtype").val();
    	var quantity = $("#quantity").val();
    	var shopid = $("#shopid").val();
    	var baseid = $("#baseid").val();
    	var is_fictitious = $("#is_fictitious").val();
		
		
		var activity = $("#activity").val();
		if(parseFloat(activity)==1&&parseFloat(price)>parseFloat(aprice)){
			price=aprice;
		}
		
		
		
		if (size == '')
		{
			//alert('请选择分类');
			$('.proshudamai').css('border','1px solid red');
			$('.cartmsg').html('请选择商品分类.');
			$('.cartmsg').slideDown(500);
			setTimeout(slideUp_fn, 6000);				
			return;
		}
        var goodId = $("#goodId").val();
		//无分类下单
		if(issize == ''){
			var yhprice = $("input[name=price]").val();
			var cost = $("input[name=cost1]").val();   //判断是否存在分类，若无为单品下单，获取单品成本价格
		}else{
			var yhprice = $("input[name=yhprice]").val();
			var cost = $("input[name=cost]").val();
		}
        var quantity = $("#quantity").val();
		var discount = $("#discount").val();
      
        if (quantity == '')
        {
            alert('请输入购买数量');
            return;
        }
        if (parseInt(quantity) < 1)
        {
            alert("购买数量不能小于1");
            return;
        }
        if(isNaN(quantity))
        {
          alert("请输入数字!");
           return;
        }
		
		//立即购买
		if(an==1){
			 add_to_cart(goodId,itemtype,quantity,title,img,price,shopid,baseid,is_fictitious,yhprice,size,discount,cost,cb);return;
		}
        add_cart(goodId,itemtype,quantity,title,img,price,shopid,baseid,is_fictitious,yhprice,size,discount,cost,cb);
	
    }
	
	//立即购买
	function add_to_cart(goodId,itemtype,quantity,title,img,price,shopid,baseid,is_fictitious,yhprice,size,discount,cost,cb)	//商品ID，购买数量，相应分类的价格，分类名称
	{
		var url  = "<?php echo U('Shopcart/add_cart');?>";
		var jsurl = "<?php echo U('Order/jiesuan');?>&spr=0";
		
		var cart_count = parseInt($("#cart_count").html())+parseInt(quantity);
		var cart_price = parseFloat($("#cart_price").val())+parseFloat(price)*parseInt(quantity);
		$("#cart_price").val(cart_price);
		$("#cart_count").html(cart_count);
     	$.post(url,{goodId:goodId,itemtype:itemtype,quantity:quantity,title:title,img:img,price:price,shopid:shopid,baseid:baseid,is_fictitious:is_fictitious,yhprice:yhprice,size:size,discount:discount,cost:cost},function(data){
     		if(cb !== undefined) {
				cb(data);
				return;
			}
     	   if(data.status==1)
     		{	
				/*htm='<span>'+data.msg+'！购物车共有'+data.count+'件商品,共计：'+data.sumPrice+'元.</span>';
				$('.cartmsg').html(htm);
				$('.cartmsg').slideDown(500);
				$('#cart_count').html(data.count);
				$('.am-icon-cart-plus').fadeOut(600);
				setTimeout(slideUp_fn, 6000);*/
				//alert(data.cartId);
				location.href = jsurl+"&cartId="+data.cartId;			 
				
     		}else
     		{
     			htm='<span>'+data.msg+'！购物车共有'+cart_count+'件商品,共计：'+cart_price+'元.</span>';
				$('.cartmsg').html(htm);
				$('.cartmsg').slideDown(1200);
				$('#cart_count').html(cart_count);
     			$('.am-icon-cart-plus').fadeOut(600);
     			setTimeout(slideUp_fn, 6000);
     		}
     	},'json');
		
	}
    
	//加入购物车
    function add_cart(goodId,itemtype,quantity,title,img,price,shopid,baseid,is_fictitious,yhprice,size,discount,cost,cb)	//商品ID，购买数量，相应分类的价格，分类名称
    {
    	//jquery获取隐藏域的值
    	var title = $("#title").val();
    	var img = $("#img").val();
    	var shopid = $("#shopid").val();
    
		var cart_count = parseInt($("#cart_count").html())+parseInt(quantity);
		var cart_price = parseFloat($("#cart_price").val())+parseFloat(price)*parseInt(quantity);
		$("#cart_price").val(cart_price);
		$("#cart_count").html(cart_count);
     	var url  = "<?php echo U('Shopcart/add_cart');?>";
     	$.post(url,{goodId:goodId,itemtype:itemtype,quantity:quantity,title:title,img:img,price:price,shopid:shopid,baseid:baseid,is_fictitious:is_fictitious,yhprice:yhprice,size:size,discount:discount,cost:cost},function(data){
     		if(cb !== undefined) {
				cb(data);
				return;
			}
     	   if(data.status==1)
     		{	
				htm='<span>'+data.msg+'！购物车共有'+cart_count+'件商品,共计：'+cart_price+'元.</span>';
				$('.cartmsg').html(htm);
				$('.cartmsg').slideDown(500);
				$('#cart_count').html(cart_count);
				$('.am-icon-cart-plus').fadeOut(600);
				setTimeout(slideUp_fn, 6000);				 
				
     		}else
     		{
     			htm='<span>'+data.msg+'！购物车共有'+cart_count+'件商品,共计：'+cart_price+'元.</span>';
				$('.cartmsg').html(htm);
				$('.cartmsg').slideDown(1200);
				$('#cart_count').html(cart_count);
     			$('.am-icon-cart-plus').fadeOut(600);
     			setTimeout(slideUp_fn, 6000);
     		}
     	},'json');	
    }
	
	function slideUp_fn(){
		$('.cartmsg').slideUp(1200);
	} 
	
	function share() {
		$("#mcover").show();
	}
</script>
<style>
#pro-sp{
	width: 100%; 
	background-color: white; 
	margin-bottom: 5px; 
	font-size: 12px;
	padding: 2px;
}
#pro-sp .am-u-sm-3{
	text-align: center;
}
#pro-sp img{
	width: 21px;
	height: 21px;
	vertical-align: middle;
}
#pro-sp span{
	vertical-align:middle;
}
#goods_stock_msg{
	color:#ff0000;
	margin-right:10px;
	font-weight:bold;
}
#guess-like {
	height: 50px;
	line-height: 50px;
	font-size: 13px;
	text-align: center;
	position: relative;
	color: #555;
	clear:both;
	}
	#guess-like .span-1,#guess-like .span-2 {
	border-top: 1px dashed rgb(190,190,190);
	width: 35%;
	position: absolute;
	top: 25px;
	}
	#guess-like .span-1{
	left: 0px;
	}
	#guess-like .span-2{
	right: 0px;
}
	/*勋章*/
	#xunzhang{
		height: 26px;background-color: white; margin-top: -4px;
	}
	#xunzhang .am-u-sm-3{
		line-height: 26px; text-align: center; margin: 0 auto;
	}
	#xunzhang .am-u-sm-3 img{
		width: 18px; display: inline; position: relative; left: 0px;top: -1px; z-index: 100; 
	}
	#xunzhang .am-u-sm-3 .liang{
		height: 30px; background-color: rgb(239,149,26);text-align: center; color: white; margin-left: -6px;; padding: 2px 3px 2px 9px; box-shadow: inset 1px 1px 5px rgb(200,126,25);border-top-right-radius: 5px;border-bottom-right-radius: 5px; 
	}
	#xunzhang .am-u-sm-3 .hui{
		height: 30px; background-color: rgb(212,212,212);text-align: center; color: white; margin-left: -6px; ;padding: 2px 3px 2px 9px; box-shadow: inset 1px 1px 5px rgb(180,180,180);border-top-right-radius: 5px;border-bottom-right-radius: 5px;
	}
	
	/*购物提醒*/
	.tixing-title{
		width: 150px; height: 24px; position: absolute; left: 79px; top: 31px; font-size: 17px; color: white; letter-spacing: 4px;
	}
	.tixing-wen{
		width: 250px;position: absolute; left: 28px; top: 151px; text-align: left; color: rgb(55,55,55); font-size: 12px;
	}
	.tixing-close{
		width: 90px; height: 27px;border:none; background-color: rgb(240,93,0); color: white; position: absolute; left: 40px; top: 205px; border-radius: 5px; font-size: 13px;
	}
	.tixing-true{
		width: 90px; height: 27px;border:none; background-color: rgb(240,93,0); color: white; position: absolute; left: 170px; top: 205px; border-radius: 5px; font-size: 13px;
	}
	.tixing-choose{
		width: 243px;position: absolute; left: 37px; top: 54px; color: rgb(85,85,85); font-size: 13px;
	}
	.tixing-choose select{
		width: 75%;height: 40px;margin-top: 43px;line-height: 46px;margin-left: 10px;-webkit-appearance:none;appearance:none;outline: none; border: none ;border-bottom: solid 1px rgb(155,155,155); padding-left: 57px; font-size: 13px; letter-spacing: 2px; background-color: white;
	}
	.tixing-choose i{
		float: right; margin-top: 54px; margin-right: 20px; color: rgb(155,155,155);
	}
	.am-radio .am-icon-checked:before, .am-radio-inline .am-icon-checked:before{
		content: "\f058";
	}
	/*验证消息弹出框*/
	.showinfo{
    	position: fixed;left: 50%;bottom: 180px;z-index: 99999;border-radius: 5px;background: #000;opacity: 0.9;filter: alpha(opacity=90);
    	padding: 0 5px;height: 38px;box-shadow: 0px 0px 10px #000;color: #FFFFFF;text-align: center;line-height: 38px;font-size: 14px;display: none;
    }
</style>
<link rel="stylesheet" type="text/css" href="../Style/css/animations.css"/>
<script type="text/javascript" src="../Style/js/indexanimate.js"></script>
<!-- 购物流程E -->
</head>
<body>
<!-- topnav -->
<div class="top-title" id="end">
<div class="am-g">
<!-- 判断是否通过分享过来的商品 -->
<?php
if(session('shopid')!=$huiyuanid){ echo '<div class="am-u-sm-1" style="background:#f05d00;"><a href="./index.php?m=Index&a=index&shopid='.session('shopid').'" class="am-icon-chevron-left" style="color:#fff;font-size:14px;"></a></div>'; }else if($page == 'first'){ echo '<div class="am-u-sm-1" style="background:#f05d00;"><a href="./index.php?m=Item&a=itemcate" class="am-icon-chevron-left" style="color:#fff;font-size:14px;"></a></div>'; }else{ echo '<div class="am-u-sm-1" style="background:#f05d00;"><a href="javascript:;" onClick="window.history.back(-1);" class="am-icon-chevron-left" style="color:#fff;font-size:14px;"></a></div>'; } ?>
<!-- 判断是否通过分享过来的商品 -->	
<div class="am-u-sm-11" style="font-size:14px; padding-right:10px; background-color: rgb(240,93,0);">
	<h2>产品详情</h2>
</div>
	<!--<div class="am-u-sm-1"><a href="javascript:;" class="am-icon-home am-icon-md" style="color:#FFFFFF;font-size:12px;margin-right:10px;"></a></div>-->
</div>
</div>
<!--<div class="top-title2">
<div class="am-g">
	<div class="am-u-sm-1"><a href="javascript:;" onClick="window.history.back(-1);" class="onetop1"><img src="../Style/images/fanhui1.png" /></a></div>
	<div class="am-u-sm-9"><a href="<?php echo U('Shopcart/index');?>" class="twotop1"><img src="../Style/images/carts1.png" /></a></div>
    <div class="am-u-sm-2"><a href="javascript:;" class="threetop1"><img src="../Style/images/xiaoxi1.png" /></a></div>
</div>
</div>-->

<div class="cartmsg"></div>
<!--// topnav -->

<!--分享S-->
<div id="mcover" onclick="document.getElementById('mcover').style.display='';" style="display:none;">
<img src="../Style/images/guide.png" />
</div>
<!--分享E-->

<div id='rtt'></div>
<!-- itemgroupimg -->
<div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0" style="margin-top:45px;">
  <ul class="am-slides" id="ab">
  <?php if(is_array($img_list)): $i = 0; $__LIST__ = $img_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="data/upload/item/<?php echo ($vo["url"]); ?>" ></li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
</div>


<script>
  $(function() {
    var $slider = $('#demo-slider-0');
    var counter = 0;
    var getSlide = function() {
      counter++;
      return '<li><img src="http://s.amazeui.org/media/i/demos/bing-' +
        (Math.floor(Math.random() * 4) + 1) + '.jpg" />' +
        '<div class="am-slider-desc">动态插入的 slide ' + counter + '</div></li>';
    };

    $('.js-demo-slider-btn').on('click', function() {
      var action = this.getAttribute('data-action');
      if (action === 'add') {
        $slider.flexslider('addSlide', getSlide());
      } else {
        var count = $slider.flexslider('count');
        count > 1 && $slider.flexslider('removeSlide', $slider.flexslider('count') - 1);
      }
    });

  });
</script>
<!--隐藏域传输购物车所需内容-->
<input type="hidden" value="<?php echo ($item["id"]); ?>" id="goodId" >
<input type="hidden" value="<?php echo ($size); ?>" name="issize" />
<input type="hidden" value="<?php echo ($item["title"]); ?>" name="title" id="title" />
<input type="hidden" value="<?php echo ($item["img"]); ?>" name="img" id="img" />
<input type="hidden" value="<?php echo session('shopid'); ?>" name="shopid" id="shopid" />
<input type="hidden" value="<?php echo ($item["itemtype"]); ?>" name="itemtype" id="itemtype" />
<input type="hidden" value="<?php echo ($item["baseid"]); ?>" name="baseid" id="baseid" />
<input type="hidden" value="<?php echo ($item["is_fictitious"]); ?>" name="is_fictitious" id="is_fictitious" />
<?php $lbIds = array(5313,5314,5315); ?>
<div class="am-g projiabj">
    <div class="am-u-sm-3 pro-huangbj"><?php if(in_array($item['id'],$lbIds) AND date('j') == 5): ?>预售价<?php else: ?>优品价<?php endif; ?>
	<?php if($item["activity"] == 1 or $item["is_combo"] == 1): ?><del><span id="yhprice" style="font-size:10px; margin-top:-5px;">¥<?php echo ($item["price"]); ?></span></del>
	<?php else: ?>
		<span id="yhprice">¥<?php echo ($item["price"]); ?></span><?php endif; ?>
	<?php if($item["activity"] == 1 or $item["is_combo"] == 1): ?><span id="actprice" style="font-size:16px; margin-top:-5px;">¥<?php echo ($activityPrice); ?></span><?php endif; ?>
	</div>
    <!--<div class="am-u-sm-3 pro-huangbj">优品价<span id="yhprice">¥<?php echo ($item["price"]); ?></span><?php if($vo["priceyuan"] != '0'): ?><s style="color:#0183D7;">¥<?php echo ($item["priceyuan"]); ?></s><?php endif; ?></div>-->
  <div class="am-u-sm-7 projiazi"><p style="overflow : hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;">【团洋范自营】<?php echo ($item["title"]); ?></p></div>
  <div class="am-u-sm-2 pro-share"><a href="javascript:;" onClick="share();"><img src="../Style/images/img20.png"><span>分享</span></a></div>
</div>
<div class="am-g projiabj1">
<div class="am-u-sm-6 changdi">
产地：
<?php if($item["countryId"] == 0): echo ($item["adress"]); ?>
<?php else: ?>
<?php echo ($countryname["name"]); endif; ?></div>
<div class="am-u-sm-6 yishou">已售<?php echo ($item["buy_num"]); ?>笔</div>
</div>
<!--勋章-->
<?php if($login_days["login_days"] >= 7 And $login_days["v1"] == 1): ?><div id="xunzhang" style="margin-bottom: 5px;">
	<div class="am-g">
  		<div class="am-u-sm-3">
  			<img src="../Style/index-images/rq.png" alt="人气商家" class="am-img-responsive"/><span class="liang">人气商家</span>
  			<!--<img src="../Style/index-images/rq-hui.png" alt="人气商家" class="am-img-responsive"/><span class="hui">人气商家</span>-->
  		</div>
  		<div class="am-u-sm-3">
  			<!--<img src="../Style/index-images/hg.png" alt="皇冠商家" class="am-img-responsive"/><span class="liang">皇冠商家</span>-->
  			<img src="../Style/index-images/hg-hui.png" alt="皇冠商家" class="am-img-responsive"/><span class="hui">皇冠商家</span>
  		</div>
  		<div class="am-u-sm-3">
  			<!--<img src="../Style/index-images/jp.png" alt="金牌服务" class="am-img-responsive"/><span class="liang">金牌服务</span>-->
  			<img src="../Style/index-images/jp-hui.png" alt="金牌服务" class="am-img-responsive"/><span class="hui">金牌服务</span>
  		</div>
  		<div class="am-u-sm-3">
  			<!--<img src="../Style/index-images/wp.png" alt="王牌掌柜" class="am-img-responsive"/><span class="liang">王牌掌柜</span>-->
  			<img src="../Style/index-images/wp-hui.png" alt="王牌掌柜" class="am-img-responsive"/><span class="hui">王牌掌柜</span>
  		</div>
	</div>
</div><?php endif; ?>
<!--产品信息通知-->
<!--
<div style="background-color: white; padding: 5px 3px 3px 5px; color: red; margin-bottom: 5px; margin-top: 5px;font-size:13px;">
	<p>
		<i class="am-icon-volume-up"></i>&nbsp;&nbsp; 由于海关对部分化妆品税率调整，部分化妆品类的订单可能会延时发货，给您造成困扰，敬请谅解！
	</p>
</div>
-->
<?php if(!empty($size)): ?><!-- itemcate -->
<div class="am-g proshudamai">
<div class="am-u-sm-3 proshumainleft">选择规格：</div>
<div class="am-u-sm-9 proshumainlei">
<?php if(is_array($size)): $i = 0; $__LIST__ = $size;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:;" class=""><?php echo ($vo); ?><input type="hidden" name="id" value="<?php echo ($i-1); ?>"></a>
<input type="hidden" name="yhprice<?php echo ($i-1); ?>" value="¥<?php echo ($price[$i-1]); ?>"><!-- $price=explode('|',$item['yhprice']); -->
<input type="hidden" name="goods_stock<?php echo ($i-1); ?>" value="<?php echo ($goods_stock[$i-1]); ?>">
<input type="hidden" name="cost<?php echo ($i-1); ?>" value="<?php echo ($cost[$i-1]); ?>">
<input type="hidden" name="price<?php echo ($i-1); ?>" value="<?php echo ($price[$i-1]); ?>">
<input type="hidden" name="aprice<?php echo ($i-1); ?>" value="<?php echo ($aprice[$i-1]); ?>">
<input type="hidden" name="actprice<?php echo ($i-1); ?>" value="¥<?php echo ($aprice[$i-1]); ?>">
<input type="hidden" name="size_imgs<?php echo ($i-1); ?>" value="<?php echo ($size_imgs[$i-1]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>
<!-- hidden area -->
<input type="hidden" name="size" value="">
<!-- 单品适配 -->
<input type="hidden" name="yhprice" value="">
<input type="hidden" name="actprice" value="">
<input type="hidden" name="goods_stock" value="">
<input type="hidden" name="cost" value="">
<input type="hidden" name="price" id="price" value=""/>
<input type="hidden" name="aprice" id="aprice" value=""/>
<?php else: ?>
<input type="hidden" value="<?php echo ($item["price"]); ?>" name="price" id="price" />
<input type="hidden" value="<?php echo ($item["aprice"]); ?>" name="aprice" id="aprice" />
<input type="hidden" name="cost1" value="<?php echo ($cost); ?>" /><!-- 无分类下的成本价格 --><?php endif; ?>
<div class="am-g proshumain" style="padding-left:5px;">
<div class="am-u-sm-3 proshumainleft" style="text-align:left;margin-top:3px;">购买数量：</div>
<div class="am-u-sm-3">
<input type="text" id="quantity"  value="1" orig="1" changed="1" class="spinnerExample"onafterpaste="this.value=this.value.replace(/\D/g,'')" onKeyUp="this.value=this.value.replace(/\D/g,'')" />
</div>

<div class="am-u-sm-3 proshengyushu" style="text-align: left; margin-top: 3px;">
  <span style="color:#999;margin-left:0px;">剩余<span id="goods_stock">
    <?php if(!empty($size)): echo ($goods_stock[0]); else: ?>
      <?php if($item["goods_stock"] < 0): else: echo ($item["goods_stock"]); endif; endif; ?>
  </span>件</span>
</div>
<div class="am-u-sm-3" style="color: #555;">
	<button data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 300, height: 225}" style="width: 70px; height: 23px;padding: 0px; background-color: rgb(240,93,0); color: white; border: none; border-radius: 3px; margin-top: 2px;">有爱提醒&nbsp;<i class="am-icon-bell-o"></i></button>	
</div>
<!--<?php if($item["is_bargain"] == 1): ?><div class="am-u-sm-3">
	<img src="../Style/index-images/activity/kan-btn.png" onclick="window.location.href='<?php echo U('bargain/index',array('id'=>$_GET['id'],'shares'=>$info['id']));?>'" alt="砍价" class="am-img-responsive" style="height: 24px;padding-right: 3px; margin-top: 2px;"/>
</div><?php endif; ?>-->
<a style="float:right;" id="goods_stock_msg"></a>

</div>

<div id="pro-sp">
	<div class="am-g">
		<?php if($item["itemtype"] == 1): ?><div class="am-u-sm-3"><img src="../Style/index-images/wanshui.png" alt="完税商品" /><span>&nbsp;完税商品</span></div>
			<?php else: ?>
			<div class="am-u-sm-3"><img src="../Style/index-images/baoshui.png" alt="保税商品" /><span>&nbsp;保税商品</span></div><?php endif; ?>
		<div class="am-u-sm-3"><img src="../Style/index-images/zhengpin.png" alt="正品保障" /><span>&nbsp;正品保障</span></div>
		<div class="am-u-sm-3"><img src="../Style/index-images/baoyou.png" alt="满99包邮" /><span>&nbsp;满99包邮</span></div>
		<div class="am-u-sm-3"><img src="../Style/index-images/fahuo.png" alt="闪电发货" /><span>&nbsp;闪电发货</span></div>
	</div>
</div>

<div data-am-widget="tabs"  class="am-tabs am-tabs-d2 pronei">
<ul class="am-tabs-nav am-cf proneitimain">
<li class="am-active"><a href="javascript:;">产品详情</a></li>
<li class=""><a href="javascript:;">产品参数</a></li>
<li class=""><a href="javascript:;">产品评论<span style="color:#c54056;"><?php echo ($count); ?></span></a></li>
</ul>
<div class="am-tabs-bd">
<!-------------产品详情--------------> 
<div class="proneirong">
<?php if(!empty($item["info"])): echo ($item["info"]); ?>
<?php else: ?>
<div style="text-align:center; height:60px;line-height:60px;color:#ccc;">暂无产品详情！</div><?php endif; ?>
</div>
<!-------------产品详情-end-------------> 
 
 
<!-------------产品参数开始--------------->   
<div class="proneimain" style="display:none;">
<?php if(!empty($item["cs"])): echo ($item["cs"]); ?>
<?php else: ?>
<div style="text-align:center; height:60px;line-height:60px;color:#ccc;">暂无产品参数！</div><?php endif; ?>
</div>
<!-------------产品参数结束--------------->  

<!-------------评价开始--------------->
<div class="propinglunmain proneimain" style="display:none;">
<ul class="am-comments-list am-comments-list-flip">
<?php if(!empty($cmt_list)): if(is_array($cmt_list)): $i = 0; $__LIST__ = $cmt_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="am-comment propinglunbj">
   <article class="am-comment"> <!-- 评论容器 -->
  <a href="javascript:;" class="">
	<?php if($vo["is_ficuser"] == 1): ?><img  class="am-comment-avatar pinglun" style="width:40px;height:40px;border-radius:40px;margin-right:8px;" src="http://yooopay.com/<?php echo ($vo["hyimg"]); ?>">
		<?php else: ?>
		 <img  class="am-comment-avatar pinglun" style="width:40px;height:40px;border-radius:40px;margin-right:8px;" src="<?php echo ($vo["cover"]); ?>"><?php endif; ?>
   <!-- 评论者头像 -->
  </a>
  <div class="am-comment-main"> <!-- 评论内容容器 -->
    <header class="am-comment-hd">
      <!--<h3 class="am-comment-title">评论标题</h3>-->
      <div class="am-comment-meta"> <!-- 评论元数据 -->
        <a href="javascript:;" class="am-comment-author am-comment-authorzi" style="color:rgb(85,85,85)"><?php echo ($vo["uname"]); ?></a> <!-- 评论者 -->
        评论于 <time datetime=""><?php echo (date('Y-m-d',$vo["add_time"])); ?></time>
      </div>
    </header>

    <div style="color:rgb(85,85,85);margin-top:5px; padding:10px 10px 10px 15px;"><?php echo ($vo["info"]); ?></div> <!-- 评论内容 -->
	<?php if(($vo["picurl1"] != '') OR ($vo["picurl2"] != '') OR ($vo["picurl3"] != '')): ?><div style="padding:8px;">
	<?php if($vo["picurl1"] != ''): ?><a class="example-image-link" href="<?php echo ($vo["picurl1"]); ?>" data-lightbox="example-set" data-title="">
	<img src="<?php echo ($vo["picurl1"]); ?>" class="example-image" style="width:55px;height:55px;margin-left:7px;"/>
	</a><?php endif; ?>
	<?php if($vo["picurl2"] != ''): ?><a class="example-image-link" href="<?php echo ($vo["picurl2"]); ?>" data-lightbox="example-set" data-title="">
	<img src="<?php echo ($vo["picurl2"]); ?>" class="example-image" style="width:55px;height:55px;margin-left:10px;" />
	</a><?php endif; ?>
	<?php if($vo["picurl3"] != ''): ?><a class="example-image-link" href="<?php echo ($vo["picurl3"]); ?>" data-lightbox="example-set" data-title="">
	<img src="<?php echo ($vo["picurl3"]); ?>" class="example-image" style="width:55px;height:55px;margin-left:10px;"/>
	</a><?php endif; ?>
	</div><?php endif; ?>
  </div>
  </article>
  </li><?php endforeach; endif; else: echo "" ;endif; ?>
<?php else: ?>
<div style="text-align:center; height:60px;line-height:60px;color:#ccc;">暂无评论！</div><?php endif; ?>
</ul>
</div>
<!-------------评价结束--------------->  
</div>
</div>


<div class="am-g">
<div class="am-u-sm-3 propagetuixian"></div>
<div class="am-u-sm-6 propagetuiti"><span style="color:#666;">买了该宝贝的人还买了</span></div>
<div class="am-u-sm-3 propagetuixian"></div>
</div>

<ul class="am-avg-sm-2 am-thumbnails indexpromain">
<?php if(is_array($itemsbuy)): $i = 0; $__LIST__ = $itemsbuy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="am-thumbnail">
   <?php if($vo["itemtype"] == 0): ?><img src="../Style/images/baosui.png" style="position:absolute;width:30px;" /><?php endif; ?>
   <a href="<?php echo U('Item/index',array('id'=>$vo['id'],'shares'=>$info['id']));?>">
   <img real_src="data/upload/item/<?php echo ($vo["img"]); ?>" src="../Style/images/loading.gif" ><P style="height:70px;"><?php echo (msubstr($vo["title"],0,24,'UTF-8',true)); ?><br>
<span style="font-family:'微软雅黑'; font-size:14px; color:#d3222c;">￥<?php echo ($vo["price"]); ?></span></P></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<!--底线-->
<p id="guess-like">
	<span class="span-1" style="border-top: solid 1px rgb(210,210,210);"></span>
		我是有底线的
	<span class="span-2" style="border-top: solid 1px rgb(210,210,210);"></span>
</p>
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default" >
      <ul class="am-navbar-nav am-cf am-avg-sm-3 carbottombj" style=" background:#FFF; border-top:1px #dad9d9 solid;">
          <li  class="carbottomli propaedh">
			<p onclick="location.href='index.php?shares=<?php echo ($info["id"]); ?>'"><img src="../Style/index-images/home.png" alt="主页" style="width: 20px; height: 20px; margin-top: 0px;" />
			<br/>首页</p>
			<p onClick="shoucangFn()"><img src="../Style/index-images/shoucang1.png" alt="收藏" style="width: 20px; height: 20px; margin-top: 0px;" />
			<br>收藏</p>
			<p><a href="<?php echo U('Shopcart/index',array('item_id'=>$item['id']));?>"><span class="am-badge am-badge-danger am-round" id="cart_count"><?php if(($cart_count) != "0"): echo ($cart_count); else: ?>0<?php endif; ?></span>
<img src="../Style/images/img19.png"></a></p>
          </li>
		  
		 <?php if($item["goods_stock"] <= 0 AND $item["size"] == ''): ?><li style="background:#999999;color:#FFFFFF;" id="no_stock">
					<a href="javascript:;">已售罄</a>
				</li>
			  <?php else: ?>
			  <li style="background:#999999;color:#FFFFFF;display:none;" id="no_stock">
				<a href="javascript:;">已售罄</a>
			  </li>
			  <?php if($item["is_fictitious"] == 1): ?><li class="carbottomli3" style="background:#666;" id="yes_cart">
						<a href="javascript:;" class="m-tip" onClick="alert('此商品为虚拟商品，为和其他商品区分，此商品不支持加入购物车，您可以选择立即购买！')" style="font-size:14px;">加入购物车</a>
				  </li>
					<?php else: ?>
					 <li class="carbottomli3" style="background:#ffb400;" id="yes_cart">
						<a href="javascript:;" class="m-tip" onClick="buys();" style="font-size:14px;">加入购物车</a>
				  </li><?php endif; ?>
			  <li class="carbottomli2" id="yes_pay">
				<a href="javascript:;" class="" onClick="buys(1);" style="font-size:14px;">立即购买</a>
			  </li><?php endif; ?>

      </ul>
  </div>
  <input type = "hidden" id="cart_price" value="<?php echo ($cart_price); ?>">
  <input type = "hidden" id="activity" value="<?php echo ($item["activity"]); ?>">
  <!--联系客服-->
	<div style="width: 40px; height: 40px; position: fixed; right: 0px; top: 70%; z-index: 999; opacity: 0.6;">
		<a href='https://static.meiqia.com/dist/standalone.html?eid=23554&clientid=<?php echo ($server_u["id"]); ?>&metadata={"name":"<?php echo $server_u['username']; ?>","tel":"<?php echo $server_u['phone_mob']; ?>","email":"<?php echo $server_u['email']; ?>"}'><img src="../Style/index-images/kefu2.png" alt="联系客服" style="width: 40px; height: 40px;"/></a>
	</div>
	<?php if($item["is_bargain"] == 1): ?><div>
		<img src="../Style/index-images/activity/kan-fang.png" onclick="window.location.href='<?php echo U('bargain/index',array('id'=>$_GET['id'],'shares'=>$info['id']));?>'" alt="砍价" style="width: 75px; height: 75px; position: fixed;  right: 50px; bottom: 49px;z-index: 1000;" />
	</div><?php endif; ?>
	
	<!--提醒购买弹出框-->
	<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
	  	<div class="am-modal-dialog" style="background: none;">
	    	<div class="am-modal-bd" style="position: relative;left: 0px; margin-top: -40px;">
	      		<img src="../Style/index-images/activity/tixing-b.png" alt="提醒景" class="am-img-responsive" />
	      		<p class="tixing-title">购物提醒</p>
	      		<p style="position: absolute; left: 28px; top: 68px; font-size: 14px;">选择提醒时间：</p>
	      		<div class="tixing-choose">
	      			<select id="sel">
	      				<option value="0">请选择</option>
	      				<option value="3">3天后提醒</option>
	      				<option value="6">6天后提醒</option>
	      				<option value="9">9天后提醒</option>
	      				<option value="15">15天后提醒</option>
	      			</select>
	      			<i class="am-icon-chevron-down"></i>
	      		</div>
	      		<p class="tixing-wen">小范提示：您可以选择上面的日期，系统会在您指定的时间给您发送微信提醒。</p>
	      		<button class="tixing-close" data-am-modal-close>取&nbsp;消</button>
	      		<button class="tixing-true" data-am-modal-close>确&nbsp;定</button>
	    	</div>
	  	</div>
	</div>
	<div class="showinfo hatch"></div>
	<script type="text/javascript">
		$(function(){
			$(".tixing-true").on("click",function(){
				var options = $("#sel option:selected").val();
				if(options == 0){
					layer.open({
						title: '提示',
						content: '请选择提醒日期',
						btn: ['我知道了'],
						yes: function(index){
							layer.close(index);
						}
					});
				}else{
					$.post('<?php echo U('Item/remind');?>',{'id':<?php echo $_GET['id']; ?>,'day':options},function(res){
						var data = eval("("+res+")");
						if(data.status == 1){
							layer.open({
								title: '提示',
								content: '已加入购物提醒，将在'+options+'天后通过微信提醒您，感谢您对团洋范的支持',
								btn: ['我知道了'],
								yes: function(index){
									layer.close(index);
								}
							});
						}else if(data.status == 0){
							layer.open({
								title: '提示',
								content: '您已经添加过此商品的提醒啦',
								btn: ['我知道了'],
								yes: function(index){
									layer.close(index);
								}
							});
						}
					});
				}
				return false; 
			})
		})
	</script>
<script type="text/javascript">
$('.spinnerExample').spinner({});
</script>
<script type="text/javascript" src="../Style/js/lightbox-plus-jquery.min.js"></script>
<script src="../Style/js/Y_lazyload.js" type="text/javascript"></script><!--图片懒加载-->
<script type="text/javascript">
$(function(){
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
            time_out : 500
        });
    });
	
	
</script>
</body>
</html>