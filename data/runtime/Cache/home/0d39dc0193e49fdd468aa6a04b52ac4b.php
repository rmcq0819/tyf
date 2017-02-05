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




	<!-- 格式化价格JS，改变数量更新价格JS -->
	<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
	<!--<script type="text/javascript" src="../Style/js/cart.js" charset="utf-8"></script>-->
	<style>
		*{
			font-family: "微软雅黑"; outline: none;
		}
		.jj{
			border: 1px solid #ababab;border-radius: 50px;width:130px;text-align:center;margin-top:6px;
		}
		.jj a{
			border:none;color: black;
		}
		.jj input{
			margin:0px 12px;width:52px;height:22px;border:1px solid #ccc;text-align:center;border-top: none;border-bottom: none;color: black;
		}
		.topnav {
			z-index: 999;position: fixed;width: 100%;height: 49px;background: rgb(240, 93, 0);text-align: center;color: #fff;font-size: 18px;line-height: 49px;top: 0;
		}		
		.topnav .back {
			position: absolute;left: 8px;top: 6px;margin-top: -8px;
		}
		.topnav img {
			position: absolute;top: 14px;left: 5px;
		}
		.topnav .clear-all{     
			position:absolute; top:0; right:6px; font-size:15px; line-height:49px;
		}
		/*购物车没有产品的时候*/
		#col-img{
			text-align: center;
		}
		#col-content{
			text-align: center; font-size: 15px; color:black;
		}
		#btn a{
			color: white;font-size:14px;border-radius: 6px;background-color:rgb(240,93,0);padding: 5px 13px;
		}
		#btn{
			margin-top:60px;
		}
		/*猜你喜欢*/
		#guess-like{
			color:#555; font-size: 15px; text-align: center;
		}
		#guess-like span{
			color: rgb(190,190,190);
		}
		#like-1{
			padding-top: 8px;
		}
		#like-1 ul li{
			background-color: white;padding: 6px;
		}
		#like-1 .title{       /*产品标题*/
			font-size: 14px; color: black;line-height: 17px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;
		}
		#like-1 .price{           /*产品价格*/
			/*text-align: center;*/
			line-height: 30px;
		}
		.am-avg-sm-2 > li{
			margin: 1%;
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
	</style>
</head>

<body>
	<div class="topnav">
			<?php if($item_id > 0): ?><a href="<?php echo U('Item/index',array('id'=>$item_id,'shares'=>$info['id']));?>" class="back">
					<img src="../Style/images/fanhui1.png" width="25" />
				</a>
			<?php else: ?>
				<a href="javascript:history.back(-1);" class="back">
					<img src="../Style/images/fanhui1.png" width="25" />
				</a><?php endif; ?>
			购物车(<?php echo ($cart_count); ?>)
			<span class="clear-all"><span style="color:white;"  onclick="remove_cart_items(<?php echo ($uid); ?>)">清空</span></span>
	</div>
	<!-- 购物车有产品的情况下 -->
	<?php if(!empty($item)): ?><form>
		<div style="margin-top: 50px; margin-bottom:59px;">
		<!-- 产品列表 -->
		<!--凑单-->
		<?php if($cart_price < 99): ?><div id="coudan" style="width:100%; height: 30px; background-color: rgb(250,250,250); line-height: 30px;">
				<p style="text-align: right; padding-right: 10px;font-size:13px;color:#555;">提示：您还差<?php echo ($cart_price_count); ?>元可免运费，<span style="color: rgb(240,93,0);" onclick="window.location.href='<?php echo U('Shopcart/join_item',array('price'=>10));?>'">去凑单>></span></p>
			</div><?php endif; ?>
	<?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div id="contents">
			<ul class="am-list" style="margin-bottom:0;">
				<li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
					<div class="am-u-sm-1 am-list-thumb" style=" padding-top:34px;text-align:center;">
						<?php if($vo["kucun"] > 0): ?><span class="am-icon-check-circle currselect actives_<?php echo ($vo["mainid"]); ?>" style="font-size:22px; color:#ccc;"></span>
							<input name="id" type="checkbox" value="<?php echo ($i-1); ?>" style="position:absolute;left:-20px;"/><?php endif; ?>
					</div>
					<div class="am-u-sm-4 am-list-thumb"><a href="<?php echo U('Item/index',array('id'=>$vo['id'],'shares'=>$info['id']));?>"><img src="data/upload/item/<?php echo ($vo["img"]); ?>" style="width:100px;"/> </a></div>
					<div class=" am-u-sm-5 am-list-main">
						<input type="hidden" id="item_<?php echo ($i-1); ?>" value="<?php echo ($vo['id']); ?>">
						<span style="font-size:13px;"><?php echo ($vo["name"]); ?></span>
						<p style="color:#898989;">优品价:<a  style="color:#e15f11;font-size:14px;">￥<span id="price_<?php echo ($i-1); ?>"><?php echo ($vo["price"]); ?><span></a></p>
						<?php if($vo["size"] != ''): ?><p style="color:#898989;">商品规格：<span style="color:#e15f11;font-size:14px;"><?php echo ($vo["size"]); ?></span></p><?php endif; ?>
						<p style="color:#898989;">类型:<?php if($vo["itemtype"] == 1): ?>完税商品<?php else: ?>保税商品<?php endif; ?></p>
						<!--购物车数量加减-->
						<?php if($vo["kucun"] > 0): ?><div class="am-u-sm-12">
									<p style="margin-top: 5px;"><input id="input_item_<?php echo ($vo["seid"]); ?>"  onblur="change_quantity(<?php echo ($vo["mainid"]); ?>,<?php echo ($vo["seid"]); ?>,this,'<?php echo ($vo["size"]); ?>');" type="number" style="width:115px;" class="alignment" value="<?php echo ($vo["num"]); ?>" data_step="1" data_digit="0" data_edit="true" data_size="<?php echo ($vo["size"]); ?>" data_itemId="<?php echo ($vo["mainid"]); ?>" data_seid="<?php echo ($vo["seid"]); ?>"/></p>
								</div>
							<?php else: ?>
								<span style="color:#e15f11;font-size:13px;">该商品库存不足，小范建议您去商城换购其他商品！</span>
								<input style="display:none" id="input_item_<?php echo ($vo["seid"]); ?>"  onblur="change_quantity(<?php echo ($vo["mainid"]); ?>,<?php echo ($vo["seid"]); ?>,this,'<?php echo ($vo["size"]); ?>');" type="number" style="width:115px;" class="alignment" value="<?php echo ($vo["num"]); ?>" data_step="1" data_digit="0" data_edit="true" data_size="<?php echo ($vo["size"]); ?>" data_itemId="<?php echo ($vo["mainid"]); ?>" data_seid="<?php echo ($vo["seid"]); ?>"/><?php endif; ?>

					</div>		
						<?php if($item_id == ''): ?><div class=" am-u-sm-2 dustbin"><img  onclick="deleteFn(<?php echo ($vo["mainid"]); ?>,<?php echo ($vo["id"]); ?>);" src="./Tpl/home/default/Style/index-images/shopcar_07.png"/></div>
							<?php else: ?>
							<div class=" am-u-sm-2 dustbin"><img  onclick="deleteFn(<?php echo ($vo["mainid"]); ?>,<?php echo ($item_id); ?>);" src="./Tpl/home/default/Style/index-images/shopcar_07.png"/></div><?php endif; ?>
				</li>
			</ul>	
	
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	
	<script>
	function change_quantity(rec_id,seid,input,size){
		var subtotal_span = $('#item' + seid + '_subtotal');
		var amount_span = $('#cart_amount');
		//暂存为局部变量，否则如果用户输入过快有可能造成前后值不一致的问题
		var _v = input.value;
		//alert($(input).attr('changed')); 
	  
		if(isNaN(input.value)||input.value<1) 
		{
			//alert('请输入大于0的数字');
			$(input).attr('changed','1');
			$(input).val($(input).attr('changed'));
			return false;
		}
	 
	   $.post("index.php?m=Shopcart&a=change_quantity",{itemId:rec_id,seid:seid,quantity:_v,size:size},function(data){
	 
			if(data.msg){
				alert(data.msg);
				$(input).attr('changed',data.stock);
				$(input).val($(input).attr('changed'));
				
			}
			 subtotal_span.html(price_format((data.item.price*data.item.num).toFixed(2)));




			/************************
			*   总价的显示否改为由选中否控制
			*   @author  May
			*   date    2016-07-26      
			************************/
			//amount_span.html(price_format(data.sumPrice)); 
			ids = $("input:checkbox[name='id']:checked").map(function(index,elem) {
				return $(elem).val();
			}).get().join(',');
			idArr = ids.split(",");
			len = idArr.length;
			if(idArr == ''){
				len = idArr.length-1;
			}
			var price = 0;
			var i=0;
			var count = 0;
			for(;i<len;i++){
				price += parseFloat($("#price_"+idArr[i]).text())*$("#input_item_"+idArr[i]).val();
				$itemId = $("#item_"+idArr[i]).val();
				if($itemId == 5421){
					count = count + parseInt($("#input_item_"+idArr[i]).val());
				}
			}
			if(count >= 3){
				price -= 60;
			}
			var store = <?php echo ($store["is_store"]); ?>;
			if(price<99&&price>0&&store!=1){
				if(count >= 3){
					document.getElementById("cart_amount").innerHTML = "￥"+price;
					$("#coudan").fadeOut();
				}else{
					document.getElementById("cart_amount").innerHTML = "￥"+price+"+￥10（运费）";
					$("#coudan").fadeIn();
				}
			}
			else if(price>=99){    
				document.getElementById("cart_amount").innerHTML = "￥"+price;
				$("#coudan").fadeOut();
			}
			else if(price==0){
				document.getElementById("cart_amount").innerHTML = "￥"+price;
				$("#coudan").fadeIn();
			}




			 $(input).attr('changed',_v);
			
			
		},'json');
	}
	//用户点击收藏之后执行的方法
	function shoucangFn(id) {
		//商品的id号
		var id = id;
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
				$("am-btn am-btn-primary am-btn-xs").css('color','#FABE01');
				$('.cartmsg').html(data.success);
				$('.cartmsg').slideDown(500);
				setTimeout(slideUp_fn, 6000);	
			}
		});
	}
	
	//用户点击删除之后执行的方法
	function deleteFn(deleteFnid,item_id){
		//选中删除的商品内容,deleteFnid -> 用户点击选中的产品id
		layer.open({
					title: '提示',
					content: '确定要从购物车中删除该商品吗？',
					btn: ['确认', '取消'],
					yes: function(index){
						$(".actives_"+deleteFnid).next("input[name='id']").attr("checked","checked");
						$('.actives_'+deleteFnid).css("color","#e15f11");
						//执行删除操作
						var url  = "<?php echo U('Shopcart/remove_cart_item');?>";
						$.getJSON(url,{'id':deleteFnid,'item_id':item_id},function(data){
						if (data.status){
							window.location.href='<?php echo U('Shopcart/index');?>';
							layer.open({content: '商品已成功被删除', time: 1});
							location.reload();
						};
						});
						layer.close(index);
					}
		});
	}
	
	//清空购物车
	function remove_cart_items(id,item_id){
		layer.open({
				title: '提示',
				content: '您确定要清空购物车中的商品吗？',
				btn: ['确认', '取消'],
				yes: function(index){
					window.location.href= "<?php echo U('Shopcart/remove_cart_items');?>&userid="+id+"&item_id="+item_id;
					layer.open({content: '购物车已清空', time: 1});
					layer.close(index);
				}
		});
	}
	
	</script>
	
		<!-- 运费模板S -->
	<!-- 	<?php if($yunfei != ''): ?><div style="width:100%;height:auto;font-size:14px;">
				<i class="am-icon-ambulance" style="color:#C54157;font-size:14px;"></i>&nbsp;订单金额不满99元，需加运费<b style="color:#C54157"><?php echo ($yunfei); ?></b>元.
			</div>
			
			<div style="width:100%;height:auto;font-size:14px;margin-top:10px;margin-left:10px;">
				<span>您还可以选择去<b><a href="<?php echo U('Item/itemlist',array('itemtype'=>0));?>" style="color:#C54157;font-size:14px;">凑单></a></b></span>
			</div><?php endif; ?> -->
	</div>
	</form>	
		<!-- 结算模板E -->	
		<div class="am-list balance" style="height:55px;line-height:55px;">
			  <ul class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left carbottombj" style="height:55px;">
				  <li  class="am-u-sm-3 am-list-thumb carbottomli" style="line-height:53px;">
					  <span class="am-icon-check-circle" id="allselect" style="font-size:22px; color:#ccc;"></span>
					  <input id="checkAll" type="checkbox" name="allsel" style="position:absolute;left:-20px;" value="0" />
					  <span class="am-navbar-label" style="font-size:14px;">全选</span>
				  </li>
				  <li  class="am-u-sm-6 am-list-thumb carbottomli1" style="height:55px;">
					<span style="font-size:14px;">合计：<b id="cart_amount" style="color:#e15f11;">￥0</b></span>
					<!-- <span class="am-navbar-label"><?php if($yunfei != ''): ?>+运费<b style="color:#C54157">¥<?php echo ($yunfei); ?></b><?php else: ?>不含运费<?php endif; ?></span> -->
				  </li>
				  <li class="am-u-sm-3 am-list-thumb carbottomli2" style="height:55px;">
					<a onClick = "submit();" style="line-height:55px;">结算</a>
				  </li>
			  </ul>
		 </div>
		 
		 <!-- 购物车没有产品的情况下 -->
		<?php else: ?>
			<!-- <div class="noshop">
				<img src="../Style/index-images/car_blank03.png" width="35%" />
				<br/><br/>
				<a href="<?php echo U('Index/index',array('shares'=>session('shopid')));?>" style="font-size:16px;display: inline-block;border-radius: 6px;background-color:#e15f11">去逛逛~</a>
			</div> -->
				
				<div style="width: 100%; height: 45px;background-color: white; margin-top: 49px;">
					<p style="color: rgb(191,191,191); line-height: 45px; font-size: 13px; text-align: center;">
						<img src="../Style/index-images/cart-no.png" alt="" style="width: 22px; margin-top: -3px;"/>
						&nbsp;&nbsp;&nbsp;购物车是空的，您可以&nbsp;&nbsp;
						<a style="height: 20px; border: solid 1px rgb(132,134,137); border-radius: 3px; color: rgb(104,104,104); padding: 2px 6px 2px 6px;" href="<?php echo U('Index/index',array('shares'=>session('shopid')));?>">去逛逛</a></p>
				</div>
			
				<!--<div id="btn" style="text-align: center;">
					<a href="<?php echo U('Index/index',array('shares'=>session('shopid')));?>">去逛逛~</a>
				</div>-->
				
				<!--猜你喜欢-->
				<p id="guess-like">
	        		<span class="span-1"></span>
	        			为您推荐&nbsp;<i class="am-icon-heart" style="color: rgb(240,93,0);"></i>
	        		<span class="span-2"></span>
	    		</p>
				<!--猜你喜欢-->
				<!--<p id="guess-like">
					<span>-----------------</span>猜您喜欢&nbsp;<i class="am-icon-heart"></i><span>------------------</span>
				</p>-->
				<div id="like-1">
					<ul class="am-avg-sm-2 am-thumbnails">
						<?php if(is_array($itemsbuy)): $i = 0; $__LIST__ = $itemsbuy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Item/index',array('id'=>$vo['id'],'shares'=>$info['id']));?>">
		  					<img class="am-thumbnail" real_src="http://yooopay.com/data/upload/item/<?php echo ($vo["img"]); ?>" />
		  					<!--<img class="am-thumbnail" src="../Style/index-images/cplist_03.jpg" />-->
		  					<p class="title"><?php echo ($vo["title"]); ?></p>
		  					<p class="price"><span style="color: black;">优品价：</span><span style="color: rgb(240,93,0); font-size: 15px;">￥<?php echo ($vo["price"]); ?></span></p></a>
							<p class="price"><b><?php echo ($vo["buy_num"]); ?></b>人已购买</p>
		  				</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				 <p id="guess-like">
					<span class="span-1" style="border-top: solid 1px rgb(210,210,210);"></span>
						我是有底线的
					<span class="span-2" style="border-top: solid 1px rgb(210,210,210);"></span>
				</p><?php endif; ?> 
	
		<!-- msg -->
	<div class="overlay">
		<div class="box">
			<div class="box_title">亲！确定要将选中的商品移除吗？</div>
				<div class="box_btn">
					<a href="javascript:;" class="cancel">取消</a>
					<a href="javascript:;" class="isok">确定</a>
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
	<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	<script src="../Style/js/num-alignment.js" type="text/javascript" charset="utf-8"></script>
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
		function submit(){
			ids = $("input:checkbox[name='id']:checked").map(function(index,elem) {
				return $(elem).val();
			}).get().join(',');
			idArr = ids.split(",");
			len = idArr.length;
			if(idArr == ''){
				len = idArr.length-1;
			}
			if(len<1){
				layer.open({
					title: '提示',
					content: '您还没有选择商品，无法进行结算',
					btn: ['我知道了'],
					yes: function(index){
						//location.reload();
						layer.close(index);
					}
				});
				return;
			}
			window.location.href = "<?php echo U('Order/jiesuan');?>&ids="+ids;
		
		}
		$(function() {
		//checkbox按钮全选
		$(".clear-all").fadeOut();
		$("#allselect").click(function(){
			$(".clear-all").fadeIn();
			var allselVal = $(this).next("input[name='allsel']").val();			
			if (allselVal==0){
			  $(this).css("color","#e15f11");
			  $(".am-list li input:checkbox").attr("checked",true);
			  $(".am-list li span.currselect").css("color","#e15f11");
			  $("#del").html("删除");
			  
			  //转换状态
			  $(this).next("input[name='allsel']").val("1");			  
			}else{
				$(".clear-all").fadeOut();
			  $(this).css("color","#ccc");
			  $(".am-list li input:checkbox").removeAttr("checked");
			  $(".am-list li span.currselect").css("color","#ccc");
			  
			  //转换状态
			  $(this).next("input[name='allsel']").val("0");
			  
			}
			
			ids = $("input:checkbox[name='id']:checked").map(function(index,elem) {
				return $(elem).val();
			}).get().join(',');
			idArr = ids.split(",");
			len = idArr.length;
			if(idArr == ''){
				len = idArr.length-1;
			}
			var store = <?php echo ($store["is_store"]); ?>;
			var price = 0;
			var i=0;
			var i=0;
			for(;i<len;i++){
				price += parseFloat($("#price_"+idArr[i]).text())*$("#input_item_"+idArr[i]).val();
				$itemId = $("#item_"+idArr[i]).val();
				if($itemId == 5421){
					count = count + parseInt($("#input_item_"+idArr[i]).val());
				}
				
			}
			
			if(count >= 3){
				price -= 60;
			}
			if(price<99&&price>0&&store!=1){
				if(count>=3){
					document.getElementById("cart_amount").innerHTML = "￥"+price;
					$("#coudan").fadeOut();
				}else{
					document.getElementById("cart_amount").innerHTML = "￥"+price+"+￥10（运费）";
					$("#coudan").fadeIn();
				}
			}
			else if(price>=99){    
				document.getElementById("cart_amount").innerHTML = "￥"+price;
				$("#coudan").fadeOut();
			}
			else if(price==0){
				document.getElementById("cart_amount").innerHTML = "￥"+price;
				$("#coudan").fadeIn();
			}
		  });
		//单选
		$(".currselect").click(function(){
			if(!$(this).next("input[name='id']").attr("checked")){
				$(this).next("input[name='id']").attr("checked","checked");
		
				$(this).css("color","#e15f11");
				$("#del").html("删除");
				
			}else{
				$(this).next("input[name='id']").removeAttr("checked");
				$(this).css("color","#ccc");
		
			}
			ids = $("input:checkbox[name='id']:checked").map(function(index,elem) {
				return $(elem).val();
			}).get().join(',');
			idArr = ids.split(",");
			len = idArr.length;
			if(idArr == ''){
				len = idArr.length-1;
			}
			
			var price = 0;
			var i=0;
			var count = 0;
			for(;i<len;i++){
				price += parseFloat($("#price_"+idArr[i]).text())*$("#input_item_"+idArr[i]).val();
				$itemId = $("#item_"+idArr[i]).val();
				if($itemId == 5421){
					count = count + parseInt($("#input_item_"+idArr[i]).val());
				}
			}
			if(count >= 3){
				price -= 60;
			}
			var store = <?php echo ($store["is_store"]); ?>;
			if(price<99&&price>0&&store!=1){
				if(count>=3){
					document.getElementById("cart_amount").innerHTML = "￥"+price;
					$("#coudan").fadeOut();
				}else{
					document.getElementById("cart_amount").innerHTML = "￥"+price+"+￥10（运费）";
					$("#coudan").fadeIn();
				}
			}
			else if(price>=99){    
				document.getElementById("cart_amount").innerHTML = "￥"+price;
				$("#coudan").fadeOut();
			}
			else if(price==0){
				document.getElementById("cart_amount").innerHTML = "￥"+price;
				$("#coudan").fadeIn();
			}
		});
		
		
		
		//删除商品
		$("#del").click(function(){
		var res=$("form").serialize();
		if(res==''){
			//alert('请选择商品');
			$(this).html("请选择商品！");
			return;
		}
		
		//弹出确认框
		$(".overlay").fadeIn();
		});
		
		//是否删除
		$(".cancel").click(function(){
			$(".overlay").fadeOut();
		});
		$(".isok").click(function(){
			var res=$("form").serialize();
			var url  = "<?php echo U('Shopcart/remove_cart_item');?>";
			$.getJSON(url,{'res':res},function(data){
			if (data.status){
				alert('删除商品成功!');
				window.location.href='<?php echo U('Shopcart/index');?>';
			};
		
			});
			
		});
		
		});
	</script>
</body>
</html>