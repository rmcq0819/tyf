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




		<script charset="utf-8" src="../Style/js/jiesuan.js" type="text/javascript"></script>
		<script type="text/javascript" src="../Style/js/jiesuancart.js" charset="utf-8"></script>
		<script type="text/javascript" language="javascript" src='../Style/js/dizhi2.js'></script>
		<script type="text/javascript" language="javascript" src='../Style/js/diqu2.js'></script>
		<style type="text/css">
			.zm {
				width: 100%;height: 90px;margin-top: 5px;
			}
			
			* {
				font-family: "微软雅黑";
			}
			
			.topnav {
				z-index: 999;position: fixed;width: 100%;height: 49px;background: rgb(240, 93, 0);text-align: center;color: #fff;font-size: 16px;line-height: 49px;top: 0;
			}
			
			.topnav .back {
				position: absolute;left: 8px;top: 6px;margin-top: -8px;
			}
			
			.topnav img {
				position: absolute;top: 14px;left: 5px;
			}
			
			.shuoming {
				padding-left: 10px;height: 40px;line-height: 40px;display: block;
			}
			
			.demo {
				width: 100%;
			}
			
			.btn {
				position: relative;overflow: hidden;left: 15px;margin-right: 4px;display: inline-block;*display: inline;padding: 4px 10px 4px;font-size: 14px;line-height: 18px;*line-height: 20px;
				
				color: #fff;text-align: center;vertical-align: middle;cursor: pointer;background-color: #5bb75b;border-color: #e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color: #b3b3b3;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;
			}
			
			.btn input {
				position: absolute;top: 0;right: 0;margin: 0;border: solid transparent;opacity: 0;filter: alpha(opacity=0);cursor: pointer;
			}
			
			.progress {
				position: relative;margin-left: 100px;margin-top: -24px;width: 200px;padding: 1px;border-radius: 3px;display: none
			}
			
			.progress1 {
				position: relative;margin-left: 100px;margin-top: -24px;width: 200px;padding: 1px;border-radius: 3px;display: none
			}
			
			.bar {
				background-color: green;display: block;width: 0%;height: 20px;border-radius: 3px;
			}
			
			.bar1 {
				background-color: green;display: block;width: 0%;height: 20px;border-radius: 3px;
			}
			
			.percent {
				position: absolute;height: 20px;display: inline-block;top: 3px;left: 2%;color: #fff
			}
			
			.percent1 {
				position: absolute;height: 20px;display: inline-block;top: 3px;left: 2%;color: #fff
			}
			
			.files {
				height: 22px;line-height: 22px;margin: 10px 0
			}
			
			.files1 {
				height: 22px;line-height: 22px;margin: 10px 0
			}
			
			.delimg {
				margin-left: 20px;color: #090;cursor: pointer
			}
			
			.delimg1 {
				margin-left: 20px;color: #090;cursor: pointer
			}
			
			#showimg {
				width: 90px;height: 55px;position: absolute;right: 10px;top: 15px;
			}
			
			#showimg1 {
				width: 90px;height: 55px;position: absolute;right: 10px;top: 130px;
			}
			
			.dingdangdian {
				border-bottom: none;
			}
			
			.dingdangdian ul li {
				margin-top: 0px;
			}
			
			.dingdangdian ul li:last-child {
				margin-bottom: 13px;
			}
			/*底部提交订单*/
			
			#footer {
				width: 100%;height: 55px;position: fixed;bottom: 49px;line-height: 55px;background-color: white;
			}
			
			#yunfei {
				font-size: 13px;margin-left: 5px;
			}
			
			#yunfei-price {
				color: rgb(240, 93, 0);font-size: 14px;
			}
			
			#submit {
				background-color: rgb(240, 93, 0);color: white;text-align: center;font-size: 14px;
			}
			
			#check {
				color: white;text-align: center;font-size: 14px;display: block;
			}
			#len li{
				border-bottom: solid 1px rgb(220,220,220);
			}
			#len li:first-child{
				border-bottom: solid 1px rgb(220,220,220);
			}
			.am-radio input[type="radio"]{
				margin-left: 0px;
			}
			label *{
    			pointer-events: none;
			}
		</style>
		<script type="text/javascript" src="../Style/js/jquery.form.js"></script>
	</head>

	<body>
		<div class="topnav">
			<a onClick="window.location.href='<?php echo U('Shopcart/index');?>'" class="back">
				<img src="../Style/images/fanhui1.png" width="25" />
			</a>
			确认订单
		</div>

		<form method="POST" action="<?php echo U('Order/pay');?>&spr=<?php echo $_GET['spr']; ?>" id="order_form" name="order_form" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo ($is_fictitious["id"]); ?>" name="pointitem" />
			<input type="hidden" name="cart_count" value="<?php echo ($cart_count); ?>" />
			<div class="dingdangbj" style="margin-top:55px;">
				<div class="am-g am-g dingdang" style="padding: 10px 0 20px 3%;">
					<div class="am-u-sm-1"><img src="../Style/index-images/adds.jpg" alt="地址" style="width: 23px; height: 28px; margin-top: 26px; margin-left: -5px;" /></div>
					<div class="am-u-sm-9 dingdandizhimiddle">
						<!-- address -->
						<?php if(!empty($address_list)): if(is_array($address_list)): $i = 0; $__LIST__ = array_slice($address_list,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
									<input name="sheng2" type="hidden" value=" <?php echo ($vo["sheng"]); ?>" />
									<input name="shi2" type="hidden" value="<?php echo ($vo["shi"]); ?>" />
									<input name="qu2" type="hidden" value=" <?php echo ($vo["qu"]); ?>" />
									<input name="consignee2" type="hidden" value=" <?php echo ($vo["consignee"]); ?>" />
									<input name="address2" type="hidden" value="<?php echo ($vo["address"]); ?>" />
									<input name="phone_mob" type="hidden" value="<?php echo ($vo["mobile"]); ?>" />
									<input name="idcname" type="hidden" value="<?php echo ($c_ard["c_name"]); ?>" />
									<input name="idcnum" type="hidden" value="<?php echo ($c_ard["c_id"]); ?>" />
									<dd>
										<h5><?php echo ($vo["consignee"]); ?> <span style="float:right"><?php echo substr_replace($vo['mobile'],'****',3,4); ?>&nbsp;&nbsp;
										<span style="background-color:rgb(242,48,48);color:white; padding:0px 7px 0px 7px;<?php if($vo["is_default"] == 0): ?>opacity:0<?php endif; ?>">默认</span>
										</h5>
										<p style="color:#ababab;font-size:14px;"><?php echo ($vo["sheng"]); echo ($vo["shi"]); echo ($vo["qu"]); echo ($vo["address"]); ?></p>
									</dd>
								</dl><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php else: ?> 请填写收货人地址信息
							<input name="phone_mob" type="hidden" value="<?php echo ($vo["mobile"]); ?>" /><?php endif; ?>
					</div>
					<div class="am-u-sm-2 dingdandizhiright" style="width:10%;">
						<a href="javascript:;"><img src="../Style/index-images/jt03.png" style="margin-top:14px;"></a>
					</div>
				</div>
			</div>

			<!--<div class="am-u-sm-12 dianming" >产品信息</div>-->

			<!-- 订单页面产品列表 -->
			<div class="dingdangdian" style="margin-top: 5px;">
				<ul>
					<?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="am-g am-g-fixed">
								<div class="am-u-sm-12">
									<div class="am-list-news-bd">
										<ul class="am-list" style="margin-bottom:0;">
											<?php if(is_array($vo["goods"])): $i = 0; $__LIST__ = $vo["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-bottom-left">
													<a href="<?php echo U('Item/index',array('id'=>$vo2['id'],'shares'=>$info['id']));?>">
														<div class="am-u-sm-3 am-list-thumb dianproimg">
															<img src="data/upload/item/<?php echo ($vo2["img"]); ?>">
														</div>

														<div class=" am-u-sm-7 am-list-main" style="margin-left:7%;">
															<table class="am-table am-table-bordered am-table-striped am-table-compact dianprotablezi">
																<tbody>
																	<tr>
																		<td style="font-size: 14px;"><?php echo ($vo2["name"]); ?></td>
																		<!-- <td><span style="color:#e26000; font-family:'微软雅黑'; font-size:14px;">¥<?php echo ($vo2["price"]); ?></span></td> -->
																	</tr>
																	<tr>
																		<td colspan="2" style="color:#ababab;">
																			优品价：<span style="color:#e26000; font-family:'微软雅黑'; font-size:14px;">¥<?php echo ($vo2["price"]); ?></span><br/>
																			<?php if($vo2["size"] != ''): ?>商品规格：<span style="color:#e26000; font-family:'微软雅黑'; font-size:12px;"><?php echo ($vo2["size"]); ?></span><br/><?php endif; ?>
																			商品类型：
																			<?php if($vo2["itemtype"] == 1): ?>完税商品
																				<?php else: ?>保税商品<?php endif; ?> <br/> 购买数量：x<?php echo ($vo2["num"]); ?>
																			<br/>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
														<!-- <a href="<?php echo U('Item/index',array('id'=>$vo2['id'],'shares'=>$info['id']));?>"> -->
														<div class="am-u-sm-2 dingdandizhiright" style="width:10%; line-height:119px;">
															<img src="../Style/index-images/jt03.png">
														</div>
														<!-- </a> -->
													</a>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>

								</div>
							</div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>

			</div>

			<!--底部提交订单-->
			<div id="footer">
				<div class="am-g">
					<div class="am-u-sm-8">
						<span>
  				<span id="yunfei">运费:</span>
						<span id="yunfei-price">
						<?php if($is_fictitious["is_fictitious"] == 1 OR $store["is_store"] == 1 OR $count >= 3): ?>￥0
							<?php else: ?>
							￥<?php if($yunfei > 0): echo ($yunfei); else: ?>0<?php endif; endif; ?>
						</span>
						</span>
						<span style="float: right; margin-right: 5px;">
  				<span style="font-size: 13px;">合计:</span>
						<span style="color: rgb(240,93,0); font-size: 14px;">
						<?php if($is_fictitious["is_fictitious"] == 1 OR $store["is_store"] == 1 OR $count >= 3): ?>￥<?php echo ($sunprice-60); ?>
							<?php else: ?>
							￥<?php echo ($sunprice +$yunfei); endif; ?>
						
						
						</span>
						</span>
					</div>
					<div id="submit" class="am-u-sm-4">
						<a href="javascript:;" id="tijiaomsg" style="display:none; color: white;"><img src="../Style/images/loading.gif" style="border-radius:25px;" width="25" />&nbsp;&nbsp;正在提交</a>
						<a href="javascript:;" id="check" style="font-size: 15px;">提交订单</a>
					</div>
				</div>
			</div>


			<div class="dingdanghongzi" style="display:none;">跨境专区订单付款不能取消，上传的身份证请务必与收货人姓名保持一致，且不能无理由退换货！</div>


			<input type="hidden" name="isitemtype" value="<?php echo ($itemtype); ?>" />
			<!-- 判断是否存在保税产品 -->
			</div>

			<!-- ========================弹窗模块S======================== -->
			<div class="showinfo"></div>
			<!-- 身份证上传S -->
			<div class="overlay5"></div>
			<div class="am-g am-g-fixed addressmain3" style="position:fixed; left:0; bottom:0;z-index:9999;display:none; width: 100%; padding-bottom:0px;">
				<div class="am-u-sm-12 addressti">
					<div class="addressclose">
						<a href="javascript:;" id="idc_close"><img src="../Style/images/pic17.png"></a>
					</div>
					<span style="font-size: 15px;">选择身份证&nbsp;&nbsp;<button type="button" data-am-modal="{target: '#my-alert1'}" style="color: white; background-color: rgb(240,93,0); border: solid 1px rgb(240,93,0); border-radius: 100px; margin-top: -4px;"><i class="am-icon-question"></i></button></span>
				</div>
				<div id="user-id" class="am-u-sm-12">
					<ul id="len" style="overflow-y:scroll;-webkit-overflow-scrolling: touch;">
						<?php if(is_array($cards)): $i = 0; $__LIST__ = $cards;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$card): $mod = ($i % 2 );++$i;?><li>
								<div class="am-u-sm-12">
									<label class="am-radio needsclick" style="margin-left:15px; margin-bottom: 5px; margin-top: 15px ;font-size: 12px;">
										<input type="radio" data-am-ucheck class="card_info needsclick" name="card_info" value="<?php echo ($card["Id"]); ?>"/>
										<p class="needsclick" style="float: left; margin-top: -9px; padding-left: 7px;">姓名：<?php echo ($card["c_name"]); ?></p>
										<div style="clear: both;"></div>
										<p class="needsclick" style="padding-left: 7px;">身份证：
											<?php echo strlen($card['c_id'])==15?substr_replace($card['c_id'],"****",8,4):(strlen($card['c_id'])==18?substr_replace($card['c_id'],"****",10,4):"身份证位数不正常！"); ?>
										</p>
									</label>
									<input type="hidden" name="cid" value="<?php echo ($card["Id"]); ?>" />
								</div>
							</li>
							<div style="clear: both;"></div><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>

					<p style="height: 45px; padding-bottom: 20px; border-top: solid 1px rgb(220,220,220);" id="add_addr">
						<a href="<?php echo U('User/addid',array('ids'=>$_GET['ids'],'addr_id'=>$_GET['addr_id']));?>" style="float:right; height:45px; line-height:45px;">
							<i class="am-icon-plus" style="font-size:18px; color:#e15f11;"></i> &nbsp;&nbsp;新增身份证
							<img src="../Style/images/pic11.png" width="20"></a>
					</p>
				</div>

			</div>
			<!--根据用户身份证数量来显示高度-->
			<script type="text/javascript">
				$(function(){
					var len = $("#len li").size();
					if(len==2){
						$("#len").css("height","90px");
					}
					if(len==3){
						$("#len").css("height","135px");
					}
					if(len==4){
						$("#len").css("height","180px");
					}
					if(len>=5){
						$("#len").css("height","200px");
					}
				});
			</script>

			<script type="text/javascript">
				$(function() {
					var bar = $('.bar');
					var percent = $('.percent');
					var showimg = $('#showimg');
					var progress = $(".progress");
					var files = $(".files");
					var btn = $(".btn span");
					$("#fileupload").wrap("<form id='myupload' action='uploadCD.php' method='post' enctype='multipart/form-data'></form>");
					$("#fileupload").change(function() {
						$("#myupload").ajaxSubmit({
							dataType: 'json',
							beforeSend: function() {
								showimg.empty();
								progress.show();
								var percentVal = '0%';
								bar.width(percentVal);
								percent.html(percentVal);
								btn.html("上传中...");
							},
							uploadProgress: function(event, position, total, percentComplete) {
								var percentVal = percentComplete + '%';
								bar.width(percentVal);
								percent.html(percentVal);
							},
							success: function(data) {
								files.html("<b>" + data.name + "(" + data.size + "k)</b> <span class='delimg' rel='" + data.pic + "'>删除</span>");
								var img = "files/" + data.pic;
								showimg.html("<img src='" + img + "' width='90' height='55'>");
								$("input[name='zimg']").val(data.pic);
								btn.html("添加附件");
							},
							error: function(xhr) {
								btn.html("上传失败");
								bar.width('0')
								files.html(xhr.responseText);
							}
						});
					});

					$(".delimg").live('click', function() {
						var pic = $(this).attr("rel");
						$.post("uploadCD.php?act=delimg", {
							imagename: pic
						}, function(msg) {
							if(msg == 1) {
								files.html("删除成功.");
								$("input[name='zimg']").val("");
								showimg.empty();
								progress.hide();
							} else {
								alert(msg);
							}
						});
					});
				});
			</script>
			<script type="text/javascript">
				$(function() {
					var bar = $('.bar1');
					var percent = $('.percent1');
					var showimg = $('#showimg1');
					var progress = $(".progress1");
					var files = $(".files1");
					var btn = $(".btn1 span");
					$("#fileupload1").wrap("<form id='myupload1' action='uploadCD1.php' method='post' enctype='multipart/form-data'></form>");
					$("#fileupload1").change(function() {
						$("#myupload1").ajaxSubmit({
							dataType: 'json',
							beforeSend: function() {
								showimg.empty();
								progress.show();
								var percentVal = '0%';
								bar.width(percentVal);
								percent.html(percentVal);
								btn.html("上传中...");
							},
							uploadProgress: function(event, position, total, percentComplete) {
								var percentVal = percentComplete + '%';
								bar.width(percentVal);
								percent.html(percentVal);
							},
							success: function(data) {
								files.html("<b>" + data.name + "(" + data.size + "k)</b> <span class='delimg1' rel='" + data.pic + "'>删除</span>");
								var img = "files/" + data.pic;
								showimg.html("<img src='" + img + "' width='90' height='55'>");
								$("input[name='fimg']").val(data.pic);
								btn.html("添加附件");
							},
							error: function(xhr) {
								btn.html("上传失败");
								bar.width('0')
								files.html(xhr.responseText);
							}
						});
					});

					$(".delimg1").live('click', function() {
						var pic = $(this).attr("rel");
						$.post("uploadCD1.php?act=delimg", {
							imagename: pic
						}, function(msg) {
							if(msg == 1) {
								files.html("删除成功.");
								$("input[name='fimg']").val("");
								showimg.empty();
								progress.hide();
							} else {
								alert(msg);
							}
						});
					});
				});
			</script>

			<input type="hidden" name="flag" value="<?php echo ($flag); ?>" />
			<!-- 是否完成了身份证信息 -->
			</div>
			<!-- 身份证上传E -->

			<!-- 消息框S -->
			<div class="overlay">
				<div class="box">
					<div class="box_title"></div>
					<div class="box_btn">
						<a href="javascript:;" class="isok">确 定</a>
					</div>
				</div>
			</div>
			<!-- 消息框E -->

			<!-- 地址管理S -->
			<div class="overlay3"></div>
			<div class="addr_index" style="position:fixed; left:0; bottom:0;z-index:9999;display:none; ">
				<div class="">
					<div class="addr_indexti">
						<span style="font-size: 15px;">选择地址</span>
						<a href="javascript:;" id="addr_index_close"><img src="../Style/images/pic17.png" width="20"></a>
					</div>

					<ul>
						<?php if(!empty($address_list2)): if(is_array($address_list2)): $i = 0; $__LIST__ = $address_list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li>
									<div class="am-g">
										<div class="am-u-sm-1" style="line-height: 44px; margin-top: 5px;">
											<span class="am-icon-check-circle" <?php if($vo2["id"] == $addr_id): ?>style="font-size:22px;color:#e15f11;"<?php else: ?>style="font-size:22px;color:#ccc;"<?php endif; ?>></span>
										</div>
										<div class="am-u-sm-10">
											<span>姓名：<?php echo ($vo2["consignee"]); ?>，手机号：<?php echo substr_replace($vo2['mobile'],'****',3,4); ?><br/>
			<span ><?php echo ($vo2["sheng"]); echo ($vo2["shi"]); echo ($vo2["qu"]); echo ($vo2["address"]); ?></span>
										</div>
										<div class="am-u-sm-1">
											<input type="hidden" name="addruid" value="<?php echo ($vo2["uid"]); ?>" />
											<a href="javascript:;" style="float:right;margin-right:5px;margin-top:15px;" class="editaddress"><i class="am-icon-pencil" style="font-size:18px; color:#0066FF;"></i></a>
											<input type="hidden" name="addrid" value="<?php echo ($vo2["id"]); ?>" />
											<input type="hidden" name="ids" value="<?php echo ($_GET['ids']); ?>" />
										</div>
									</div>
								</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
					</ul>

					<p style="padding:10px;" id="add_addr">
						<a href="<?php echo U('User/addaddress',array('ids'=>$_GET['ids'],'is_redirect'=>1));?>" style="float:right;">
							<i class="am-icon-plus" style="font-size:18px; color:#e15f11;"></i> &nbsp;&nbsp;新增地址
							<img src="../Style/images/pic11.png" width="20"></a>
					</p>

				</div>
			</div>
			<!-- 地址管理E -->

			<!-- 编辑地址S -->
			<div class="overlay4"></div>
			<div class="am-g am-g-fixed addressmain2" style="position:fixed;left:0; bottom:0;z-index:9999;display:none;">
				<div class="am-u-sm-12 addressti">
					<div class="addressclose">
						<a href="javascript:;" id="addr_close3"><img src="../Style/images/pic17.png"></a>
					</div>
					编辑收货址址</div>
				<input type="hidden" name="id3" />
				<input type="hidden" name="uid3" />
				<div class="am-u-sm-12">
					<div class="am-g addressinputmain">
						<div class="am-u-sm-3">收货人：</div>
						<div class="am-u-sm-9 addressinput"><input type="text" name="consignee3"></div>
					</div>
				</div>
				<div class="am-u-sm-12">
					<div class="am-g addressinputmain">
						<div class="am-u-sm-3">联系电话：</div>
						<div class="am-u-sm-9 addressinput"><input type="text" name="mobile3"></div>
					</div>
				</div>
				<div class="am-u-sm-12">
					<div class="am-g addressinputmain">
						<div class="am-u-sm-3">选择地区：</div>
						<div class="am-u-sm-9 addressinput">
							<select name="sheng3" id="s11" style="border:1px solid #ddd;width:80px"></select>
							<select name="shi3" id="s12" style="border:1px solid #ddd;width:80px;"></select>
							<select name="qu3" id="s13" style="border:1px solid #ddd;width:80px;"></select>

						</div>
					</div>
				</div>
				<div class="am-u-sm-12">
					<div class="am-g addressinputmain">
						<div class="am-u-sm-3">详细地址：</div>
						<div class="am-u-sm-9 addressinput"><input type="text" name="addr3" style="width:95%;"></div>
					</div>
				</div>

				<div class="am-u-sm-12">
					<div class="am-g addressinputmain">
						<div class="am-u-sm-3">是否默认：</div>
						<div class="">
							<img id="default_btn1" src="../Style/images/csscheckbox_3_06.png" style="width:17px;height:17px;display:none;">
							<!--选中按钮-->
							<img id="default_btn2" src="../Style/images/csscheckbox_3_03.png" style="width:17px;height:17px;display:none;">
							<!--不选中按钮-->
							<input type="hidden" name="is_default">
						</div>
					</div>
				</div>

				<div class="am-u-sm-12 addresson">
					<div class="login2"><img src="../Style/images/loading.gif" width="25" />&nbsp;&nbsp;正在保存...</div>
					<button type="button" id="save_addr3" class="am-btn am-btn-default am-radius addresson1">保存修改</button>
				</div>
				<div class="am-u-sm-12 addresson"><button type="button" id="delete_addr" class="am-btn am-btn-default am-radius addresson2">删除收货地址</button></div>
			</div>
			<!-- 编辑地址E -->

			<!-- ========================弹窗模块E======================== -->
		</form>
		
		<!--选择身份证信息弹出框的理由-->
		<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert1" style="z-index: 10000;">
			<div class="am-modal-dialog">
			    <div class="am-modal-hd" style="color: white; background-color: rgb(240,93,0); padding: 11px 10px 11px 10px;">跨境电商全购物须知</div>
			    <div class="am-modal-bd" style="height: 220px; overflow: auto; font-size: 12px; -webkit-overflow-scrolling: touch; ">
		        	<p style="text-align: left;">尊敬的饭团:</p>
		        	<p style="text-align: left; margin: 0px; padding:0px;">
		        		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1、进口免税商品不退换机制：由于跨境电商制度原因，下单支付成功6小时后无法申请无理由退款，如若出现下错单或者需加单情况，
						请在支付成功后的6小时内申请退款重拍。跨境进口产品一旦发货，非质量问题概不退换。
						团洋范全球购承诺，商品如若在15个工作日内未收到货（不包括偏远地区）以及产品质量问题，自付款日开始30天内均可提供退款退货服务。其他情况，均不退换
		        	</p>
		        	<p style="text-align: left; margin: 0px; padding:0px;">
		        		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、物流：平台下单之后，需要48小时交由海关审核，海关审核通过之后，监管仓库扫描出库，快递公司开始国内配送。如果周六日及节假日延迟，我们会协助买家催促海关进行最快审核，
						由于是境外直邮进关，正常您收到货时间是7--10个工作日，工作日不包括海关休息的周三周六周日以及法定节假日。
		        	</p>
					<p style="text-align: left; margin: 0px; padding:0px;">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、多包裹配送：为保证原产地直发，所以是海外多地仓库同时发货，部分客户会陆续收到来自世界各地的多个包裹。略有繁琐，敬请耐心等待。
					</p>
					<p style="text-align: left; margin: 0px; padding:0px;">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4、务必填写真实身份信息：由于跨境电商全程均在海关监管下运作，须保证订单、支付单、物流单三单合一。
					所以您在本商城下单结算时请务必填写正确的身份证信息和真实姓名，否则将不能清关及发货。
					</p>
					<p style="text-align: left; margin: 0px; padding:0px;">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5、抽检：海关将会对所有清关商品进行开包抽查，以保证商品的真实性及安全性。所以会有部分产品外包装有被打开的痕迹，如果是遮光瓶或者不透明瓶子，海关将有可能开盖检查。
					</p>
					<p style="text-align: left; margin: 0px; padding:0px;">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6、无中国发票：您在本商城购买的商品均为境外商品，所以不能提供中国发票。
					</p>
					<p style="text-align: left; margin: 0px; padding:0px;">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7、为什么能免税：海关保税仓清关非常严格，为了能够顺利收到货物，请买家下单时请勿购买超于2000元，
						一旦高于2000元将按照国家标准征收邮税。《海关总署公告2010年第43号》规定第一条，个人邮寄进境物品，海关依法征收进口税，
						但应征进口税税额在人民币50元（含50元以下的，税额=售价*数量*税率）。母婴、保健品行邮税率是10%，购买500元以下商品免税。
						其他类型邮税参考《入境旅客行李物品和个人邮递物品进口税税则归类表》以及《入境旅客行李物品和个人邮递物品完税价格表》。
					</p>
					<p style="text-align: left; margin: 0px; padding:0px;">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8、使用风险个人承担：您购买的境外商品适用的品质、健康、标识等项目的使用标准均符合原产国使用标准，但是可能与我国标准有所不同，
						所以在使用过程中由此可能产生的危害或损失以及其他风险，将由您个人承担。
					</p>
			    </div>
			    <div class="am-modal-footer">
			        <span class="am-modal-btn" style="color:rgb(240,93,0)">我知道了</span>
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
	</body>

</html>
<script>
	$(function() {
		//验证是否满足提交订单条件
		$("#check").click(function() {
			//2016-04-25 by shuguang 添加 start
			var province_name = $("input[name='sheng2']").val(); //省
			var city_name = $("input[name='shi2']").val(); //城市 
			var area_name = $("input[name='qu2']").val(); //区域名称
			//2016-04-25 by shuguang 添加 end
			var phone = $("input[name='phone_mob']").val();
			var itemtype = $("input[name='isitemtype']").val(); //是0才满足要上传身份证的条件
			//2016-04-26 by shuguang 添加 start 
			if(province_name == '') {
				$(".box_title").html("收货地址缺少省份信息！");
				$(".overlay").show();
				return false;
			}
			if(city_name == '') {
				$(".box_title").html("收货地址缺少城市信息！");
				$(".overlay").show();
				return false;
			}
			if(area_name == '') {
				$(".box_title").html("收货地址缺少区域信息！");
				$(".overlay").show();
				return false;
			}
			//2016-04-25 by shuguang 添加 end

			if(phone == '') {
				$(".box_title").html("请填写收货地址！");
				$(".overlay").show();
				return false;
			}

			var flag = $("input[name='flag']").val();

			if(flag == "" && itemtype == 0) {
				$(".box_title").html("请完善上传身份证信息！");
				$(".overlay").show();
				$('.isok').attr('rel', 'idc');
				return false;
			}
			$(this).hide();
			$("#tijiaomsg").show();
			$("#order_form").submit();

		});

		//判断身份证是否合法
		ok1 = false;
		ok2 = false;
		ok3 = false;
		ok4 = false;
		$("#idcbtnOK").click(function() {

			var idcname = $("input[name='idcname']");
			var idcnum = $("input[name='idcnum']");
			//var p1 = $('#p1');
			//var p2 = $('#p2');

			var zimg = $("input[name='zimg']");
			var fimg = $("input[name='fimg']");

			reg = /^([\u4e00-\u9fa5]){2,7}$/;
			reg1 = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;

			//if(idcname.val()==""&&idcnum.val()==""&&zimg.val()==""&&fimg.val()==""){
			if(idcname.val() == "" && idcnum.val() == "") {
				$('.showinfo').html('请完善上传身份证信息').show().delay(3000).fadeOut();
				return;
			}
			if(reg.test(idcname.val())) {
				ok1 = true;
			} else {
				$('.showinfo').html('填写真实姓名.').show().delay(3000).fadeOut();
				return;
			}
			if(reg1.test(idcnum.val())) {
				ok2 = true;
			} else {
				$('.showinfo').html('填写身份证号码不合法.').show().delay(3000).fadeOut();
				return;
			}
			/*if(zimg.val()){
				ok3=true;
			}else{
				$('.showinfo').html('请上传身份证正面照.').show().delay(3000).fadeOut();return;
			}
			if(fimg.val()){
				ok4=true;
			}else{
				$('.showinfo').html('请上传身份证反面照.').show().delay(3000).fadeOut();return;
			}*/

			$("input[name='flag']").val("true");
			$(".overlay5").hide();
			$(".addressmain3").slideUp(800);

		});

		//选择收货地址
		$(".am-icon-check-circle").click(function() {
			$(this).css("color", "#C54056");
			addr_id = $(this).parents().find("input[name=addrid]").val();
			ids = $(this).parents().find("input[name=ids]").val();
			window.location.href = "./index.php?m=Order&a=jiesuan&addr_id="+addr_id+"&card_info=<?php echo ($_GET['card_info']); ?>";
		});
		
		//选择身份证信息
		$(".card_info").click(function() {
			$(this).css("color", "#C54056");
			card_info = $(this).parents().find("input[name=card_info]").val();
			$("input[name='flag']").val("true");
			window.location.href = "./index.php?m=Order&a=jiesuan&card_info=" + card_info + "&addr_id=<?php echo ($_GET['addr_id']); ?>";
		});

		//添加填写的收货地址到数据库
		$("#save_addr").click(function() {
			var consignee = $("input[name='consignee']").val();
			var phone_mob = $("input[name='mobile']").val();
			var s1 = $("#s1").val();
			var s2 = $("#s2").val();
			var s3 = $("#s3").val();
			var address = $("input[name='addr']").val();

			if(s2 == '中山市') {
				//alert(s2);
				if(consignee == "" || phone_mob == "" || s1 == "" || s2 == "" || address == "") {
					$('.showinfo').html('请填写完整的收货地址.').show().delay(3000).fadeOut();
					return;
				}
			} else {
				//alert(s3);
				if(consignee == "" || phone_mob == "" || s1 == "" || s2 == "" || address == "") {
					$('.showinfo').html('请填写完整的收货地址.').show().delay(3000).fadeOut();
					return;
				}

				/*
				if(consignee==""||phone_mob==""||s1==""||s2==""||s3=="市辖区"||s3==''||address==""){
					$('.showinfo').html('请填写完整的收货地址.').show().delay(3000).fadeOut();
					return;
				}
				*/
			}

			url = "<?php echo U('Order/addaddress');?>";
			$.ajax({
				type: "get",
				url: url,
				data: "consignee=" + consignee + "&phone_mob=" + phone_mob + "&s1=" + s1 + "&s2=" + s2 + "&s3=" + s3 + "&address=" + address,
				beforeSend: function() {
					$('#save_addr').hide();
					$('.login').show();
				},
				success: function(msg) {
					if(msg == 1) {
						//添加成功
						$('.showinfo').html('添加成功.').show().delay(3000).fadeOut();
						window.location.href = "./index.php?m=Order&a=jiesuan&spr=0";

					} else {
						//添加失败
						$('.showinfo').html('添加失败.').show().delay(3000).fadeOut();

					}

				},
				complete: function() {
					$('#save_addr').show();
					$('.login').hide();
				}
			});

		});

		//编辑地址
		$(".editaddress").click(function() {
			id = $(this).next("input").val();
			uid = $(this).prev("input").val();
			url = "<?php echo U('Order/addressinfo');?>";
			$.ajax({
				type: "get",
				url: url,
				data: "id=" + id + "&uid=" + uid,
				success: function(msg) {
					json = eval("(" + msg + ")");
					$("input[name='id3']").val(json.id);
					$("input[name='uid3']").val(json.uid);
					$("input[name='consignee3']").val(json.consignee);
					$("input[name='addr3']").val(json.address);
					$("input[name='mobile3']").val(json.mobile);
					//$("select[name='sheng3']").val(json.sheng);
					//$("select[name='shi3']").val(json.shi);
					//$("select[name='qu3']").val(json.qu);
					//2016-04-11 by shuguang 添加 start

					new PCAS("sheng3", "shi3", "qu3", json.sheng, json.shi, json.qu);

					$("input[name='is_default']").val(json.is_default);
					if(json.is_default == 0) {
						$("#default_btn2").show();
						$("#default_btn1").hide();
					}
					if(json.is_default == 1) {
						$("#default_btn2").hide();
						$("#default_btn1").show();
					}
					////2016-04-11 by shuguang 添加 end
				}

			});
			$(".overlay4").show();
			$(".addressmain2").slideDown(800);
			$(document.body).css("overflow", "hidden");
		});

		//保存编辑修改地址
		$("#save_addr3").click(function() {
			url = "<?php echo U('Order/editaddress');?>";
			var id3 = $("input[name='id3']").val();
			var uid3 = $("input[name='uid3']").val();
			var consignee = $("input[name='consignee3']").val();
			var phone_mob = $("input[name='mobile3']").val();
			var s1 = $("#s11").val();
			var s2 = $("#s12").val();
			var s3 = $("#s13").val();
			var address = $("input[name='addr3']").val();

			var is_default = $("input[name='is_default']").val(); //默认地址标志 2016-04-11 by shuguang

			$.ajax({
				type: "get",
				url: url,
				data: "consignee=" + consignee + "&phone_mob=" + phone_mob + "&s1=" + s1 + "&s2=" + s2 + "&s3=" + s3 + "&address=" + address + "&id=" + id3 + "&uid=" + uid3 + "&is_default=" + is_default,
				beforeSend: function() {
					$('#save_addr3').hide();
					$('.login2').show();
				},
				success: function(msg) {
					if(msg == 1) {
						//添加成功
						$('.showinfo').html('保存成功.').show().delay(3000).fadeOut();
						window.location.href = "./index.php?m=Order&a=jiesuan&spr=0";

					} else {
						//添加失败
						$('.showinfo').html('保存失败.').show().delay(3000).fadeOut();

					}

				},
				complete: function() {
					$('#save_addr3').show();
					$('.login2').hide();
				}
			});
		});

		//删除收货地址
		$("#delete_addr").click(function() {
			var id3 = $("input[name='id3']").val();
			url = "<?php echo U('Order/deladdress');?>";
			$.ajax({
				type: "get",
				url: url,
				data: "id=" + id3,
				beforeSend: function() {

				},
				success: function(msg) {
					if(msg == 1) {
						//添加成功
						$('.showinfo').html('删除成功.').show().delay(3000).fadeOut();
						window.location.href = "./index.php?m=Order&a=jiesuan&spr=0";

					} else {
						//添加失败
						$('.showinfo').html('删除失败.').show().delay(3000).fadeOut();

					}

				},
				complete: function() {

				}
			});

		});

		//关闭编辑页面
		$("#addr_close3").click(function() {
			$(".overlay4").hide();
			$(".addressmain2").slideUp(800);
			$(document.body).css("overflow", "auto");
		});

		//更改或者添加地址
		$(".dingdangbj").click(function() {
			$(".overlay3").show();
			$(".addr_index").slideDown(800);
			$(document.body).css("overflow", "hidden");
		});

		//弹出添加新地址
		$(".isok").click(function() {

			if($(this).attr('rel') == 'idc') {
				$(".overlay").hide();
				$(".overlay5").show();
				$(".addressmain3").slideDown(800);

			} else {
				$(".overlay").hide();
				$(".overlay3").show();
				$(".addr_index").slideDown(800);
				$(document.body).css("overflow", "hidden");
			}

		});

		//关闭身份证上传
		$("#idc_close").click(function() {
			$(".overlay5").hide();
			$(".addressmain3").slideUp(800);
		});

		$("#idc_close2").click(function() {
			$(".overlay5").hide();
			$(".addressmain3").slideUp(800);
		});

		//关闭地址列表页面
		$("#addr_index_close").click(function() {
			$(".overlay3").hide();
			$(".addr_index").slideUp(800);
			$(document.body).css("overflow", "auto");
		});

		//显示添加新地址页面
		$("#add_addr").click(function() {
			$(".overlay2").show();
			$(".addressmain").slideDown(800);
			$(document.body).css("overflow", "hidden");
		});

		//关闭添加新地址页面
		$("#addr_close").click(function() {
			$(".overlay2").hide();
			$(".overlay3").hide();
			$(".addressmain").slideUp(800);
			$(".addr_index").slideUp(800);
			$(document.body).css("overflow", "auto");
		});

		//放弃编辑
		$("#addr_close2").click(function() {
			$(".overlay2").hide();
			$(".addressmain").slideUp(800);
			$(document.body).css("overflow", "auto");
		});

		//设置为不默认地址 2016-04-11 by shuguang 
		$("#default_btn1").click(function() {
			$("input[name=is_default]").val(0);
			$(this).hide();
			$("#default_btn2").show();
		});
		//设置为默认地址 2016-04-11 by shuguang 
		$("#default_btn2").click(function() {
			$("input[name=is_default]").val(1);
			$(this).hide();
			$("#default_btn1").show();
		});

	});
</script>