<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>会员中心 - 添加身份证信息</title>
		<style>
			* {
				border: none;outline: none;font-family: "微软雅黑";
			}
			/*头部*/
			.topnav {
				width: 100%;height: 50px;line-height: 50px;color: white;font-size: 18px;text-align: center;position: fixed;top: 0;background-color: rgb(240, 93, 0);
			}
			.topnav img{
				position: absolute; left:5px; top: 14px;
			}
			/*收货人S、身份证S*/
			#user{
				width: 95%;height: 40px;margin: 0 auto;margin-top: 65px;
			}
			#user,#phone,#province,#county{
				background-color: white;
			}
			#id-card,#phone,#province,#city,#county,#address{
				width: 95%;height: 40px;margin: 0 auto;margin-top: 5px;background:#fff;
			}
			#user span,#id-card span,#phone span,#province span,#city span,#county span,#address span{
				color: #555;font-size:15px;line-height: 40px;padding-left: 3px;
			}
			#user input,#id-card input,#phone input, #address input{
				width: 70%;color: #555;font-size: 13px;margin-top: -6px;
			}
			#id-card input,#address input{
				background-color: rgb(236,234,234);
			}
			/*身份证S*/
			
			/*保存身份证*/
			#save{
				width: 100%; height: 50px;margin:0 auto;color: rgb(240,93,0); background-color: white; text-align: center; line-height: 50px; font-size: 15px;
			}
			#upload-pic:first-child{
				border-right: 1px solid #dcdcdc;
			}
			#upload-pic{
  			  position: relative;  width:50%; height:100px; float:left; top:10px;
	        }
	        #upload-pic img{
	        	height:98px; margin:0 auto;
	        }
	        #upload-pic input
	        {
	            opacity:0;filter:alpha(opacity=0); height: 100%;width: 100%;position: absolute;top: 0;left: 0; z-index: 9;
	           
	        }
			#id-card button{position: absolute;right:14px;top: 54px;background-color: #fff;width: 20px;height:20px;color: #e15f11;border-radius: 50%;padding: 0;border-color: #e15f11;}
			.am-modal-bd p{text-align:left;}
			 /*验证消息弹出框*/
			.showinfo-t{
	        	position: fixed;left: 50%;bottom: 180px;z-index: 99999;border-radius: 5px;background: #000;opacity: 0.9;filter: alpha(opacity=90);
	        	padding: 0 5px;height: 38px;box-shadow: 0px 0px 10px #000;color: #FFFFFF;text-align: center;line-height: 38px;font-size: 14px;display: none;
	        }
		</style>
		<link rel="stylesheet" type="text/css" href="../Style/css/animate.min.css"/>		
	</head>

	<body onLoad="setup()">
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
			<a href="<?php echo U('User/id_manage');?>" class="back">
				<img src="../Style/images/fanhui1.png" width="25"  />
			</a>
			添加身份证信息
		</div>
		
		<form method="post" action="<?php echo U('User/do_addid');?>" id="id_form" name="id_form" enctype="multipart/form-data">
		<input type="hidden" name="ids" value="<?php echo ($_GET['ids']); ?>" />
		<input type="hidden" name="addr_id" value="<?php echo ($_GET['addr_id']); ?>" />
		<!--收货人-->
		<div id="user">
			<span>&nbsp;姓名：</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="consignee" placeholder="请输入收货人身份证一致的姓名" style="width:65%;padding-top: 6px;" />
		</div>
		<!--身份证-->
		<div id="id-card">
			<span>&nbsp;身份证：</span>&nbsp;<input type="text" name="cardId" id="" value="" placeholder="请输入收货人的身份证号码" style="width:65%;background:#fff; padding-right:25px;" />
			<button type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width:300, height:400}">?</button>
			<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
			  <div class="am-modal-dialog" style="overflow-y:scroll">
				<div class="am-modal-hd" style="position:fixed;width:100%;z-index:999;background: #e15f11;height:50px;color:#fff;">跨境电商全购物须知
				  <a href="javascript: void(0)" style="color: white; opacity:0.9" class="am-close am-close-spin" data-am-modal-close ><i class="am-icon-close"></i></a>
				</div>
				<div class="am-modal-bd" style="margin-top:60px;">     
					<p>尊敬的饭团：</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请务必认真阅读以下条款，了解本文所告知内容后再进行下单购买。 如因未能了解下属条款而产生的一切购物纠纷，均由您个人承担。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1、进口免税商品不退换机制：由于跨境电商制度原因，下单支付成功6小时后无法申请无理由退款，如若出现下错单或者需加单情况，
						请在支付成功后的6小时内申请退款重拍。跨境进口产品一旦发货，非质量问题概不退换。
						团洋范全球购承诺，商品如若在15个工作日内未收到货（不包括偏远地区）以及产品质量问题，自付款日开始30天内均可提供退款退货服务。其他情况，均不退换。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、物流：平台下单之后，需要48小时交由海关审核，海关审核通过之后，监管仓库扫描出库，快递公司开始国内配送。如果周六日及节假日延迟，我们会协助买家催促海关进行最快审核，
						由于是境外直邮进关，正常您收到货时间是7--10个工作日，工作日不包括海关休息的周三周六周日以及法定节假日。</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、多包裹配送：为保证原产地直发，所以是海外多地仓库同时发货，部分客户会陆续收到来自世界各地的多个包裹。略有繁琐，敬请耐心等待。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4、务必填写真实身份信息：由于跨境电商全程均在海关监管下运作，须保证订单、支付单、物流单三单合一。
					所以您在本商城下单结算时请务必填写正确的身份证信息和真实姓名，否则将不能清关及发货。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5、抽检：海关将会对所有清关商品进行开包抽查，以保证商品的真实性及安全性。所以会有部分产品外包装有被打开的痕迹，如果是遮光瓶或者不透明瓶子，海关将有可能开盖检查。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6、无中国发票：您在本商城购买的商品均为境外商品，所以不能提供中国发票。</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7、为什么能免税：海关保税仓清关非常严格，，为了能够顺利收到货物，请买家下单时请勿购买超于2000元，
						一旦高于2000元将按照国家标准征收邮税。《海关总署公告2010年第43号》规定第一条，个人邮寄进境物品，海关依法征收进口税，
						但应征进口税税额在人民币50元（含50元以下的，税额=售价*数量*税率）。母婴、保健品行邮税率是10%，购买500元以下商品免税。
						其他类型邮税参考《入境旅客行李物品和个人邮递物品进口税税则归类表》以及《入境旅客行李物品和个人邮递物品完税价格表》	</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8、使用风险个人承担：您购买的境外商品适用的品质、健康、标识等项目的使用标准均符合原产国使用标准，但是可能与我国标准有所不同，
						所以在使用过程中由此可能产生的危害或损失以及其他风险，将由您个人承担。</p>
				</div>
			  </div>
			</div>
		</div>
		
		<!--保存身份证-->
		<div id="save" style="margin-top: 10px;">
			<a id="check"><p><span style="color:#f05d00;">保存身份证信息</p></span></a>
		</div>
		</form>
		<div class="showinfo-t animated shake"></div>
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
		
		<!--<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
		<script charset="utf-8" src="../Style/js/touchslider.dev.js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>-->
		<!--<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js" ></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.js" ></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js" ></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/mlselection.js" ></script>
		<script type="text/javascript" language="javascript" src='../Style/js/dizhi2.js'></script>
		<script type="text/javascript" language="javascript" src='../Style/js/diqu2.js'></script>-->
		<script type="text/javascript">
			$(function(){
				$("#check").click(function(){
					var consignee = $("input[name='consignee']").val();
					var address = $("input[name='address']").val();
					var sheng = $("select[name='sheng']").val();
					var phone_mob = $("input[name='phone_mob']").val();
					var cardId = $("input[name='cardId']").val();
					var shi = $("select[name='shi']").val();
					var qu = $("select[name='qu']").val();
					var frontage = $("input[name='frontage']").val();
					var opposite = $("input[name='opposite']").val();
					
					if(consignee==''){
						var content = $('.showinfo-t').html('请填写收货人姓名');
						var w = content.width()/2;
						$(".showinfo-t").css("margin-left",-w);
						$(".showinfo-t").show().delay(3000).fadeOut();
						return false; 
					 }
					 
					 if(cardId==''){
						var content = $('.showinfo-t').html('请填写收货人身份证号码');
						var w = content.width()/2;
						$(".showinfo-t").css("margin-left",-w);
						$(".showinfo-t").show().delay(3000).fadeOut();
						return false; 
					}
					
					 //使用正则验证身份证是否有效
					var reg = /^[1-9]{1}[0-9]{14}$|^[1-9]{1}[0-9]{16}([0-9]|[xX])$/;
					if(!reg.test(cardId)){
						var content = $('.showinfo-t').html('身份证号码无效');
						var w = content.width()/2;
						$(".showinfo-t").css("margin-left",-w);
						$(".showinfo-t").show().delay(3000).fadeOut();
						return false;
					}
						
					 $("#id_form").submit(); 
				}); 
					 
			});
		</script>
		
	</body>

</html>