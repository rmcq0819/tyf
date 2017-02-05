<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>地址管理</title>
		<!--<link rel="stylesheet" type="text/css" href="../Style/shop.css" />-->
		<!--<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
		<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
		<script charset="utf-8" src="../Style/js/touchslider.dev.js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/mlselection.js"></script>-->
		<style>
			*{
				outline: none;
				font-family: "微软雅黑";
			}
			/*头部*/
			.topnav{
				width: 100%;
				height: 50px;		
				line-height: 50px;
				color: white;
				font-size: 18px;
				text-align: center;
				background-color: rgb(240,93,0);
			}
			.topnav img{
				position:absolute; 
				left:5px; 
				top:14px;
			}
			/*头部E*/
			
			/*地址S*/
			#add ul li{
				padding: 8px;
			}
			#add .user-name,#add .user-number,#add .carId,#add .addr{
				font-size:15px; 
				color: black;
			}
			#add .addr{
				color: rgb(171,171,171);
			}

			#add .del {
				width: 55px;
				height: 25px;
				float: right;
				margin-top: 5px;
				background: none;
				color:rgb(240,93,0);
				border: solid 1px rgb(240,93,0);
				font-size:12px;
				border-radius:5px;
				margin-left:10px;
			}
			#add .set_default {
				min-width: 65px;
				height: 25px;
				float: right;
				margin-top: 5px;
				background:none;
				color:#106093;
				border:solid 1px #106093;
				font-size:12px;
				border-radius:5px;
				margin-left:10px;
			}
			/*地址E*/
			
			/*添加地址S*/
			#add_address{
				width: 94%;
				height: 50px;
				margin: 0 auto;
				background-color: white;
			}
			#add_address p{
				text-align: center;
				font-size: 16px;
				color: rgb(238,93,0);
				line-height: 50px;
			}
			/*添加地址E*/
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




		<!--<div class="mydizhi">
        <?php if(is_array($address_list)): $i = 0; $__LIST__ = $address_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Order/jiesuan',array('addr_id'=>$vo['id']));?>">
            <dl <?php if(($id) == $vo['id']): ?>class="hover"<?php endif; ?>>
                <dt><span><?php echo ($vo["mobile"]); ?></span><?php echo ($vo["consignee"]); ?><br />
                <?php echo ($vo["sheng"]); ?>&nbsp;<?php echo ($vo["shi"]); ?>&nbsp;<?php echo ($vo["qu"]); ?>&nbsp;<?php echo ($vo["address"]); ?></dt>
                <dd><?php if(($default) == $vo['id']): ?><span class="icon-check2"  style="font-size:12px;color:#fff;"></span><?php endif; ?></dd>
                <div class="clear"></div>
				<p class="address_action">
                    <span ><a href="<?php echo U('User/edit_address',array('id'=>$vo['id']));?>"><i class="edit_icon"></i>编辑</a></span>
                    <span><a href="<?php echo U('User/address',array('id'=>$vo['id'],'type'=>'del'));?>" class="delete float_none"><i class="delete_icon"></i>删除</a></span>
                </p>
                
            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
<div class="clear" style="height:33px;"></div>
<div class="mydizhion">
<div class="mydizhion1"><a href="<?php echo U('User/addaddress');?>">添加新地址</a></div>
</div>-->

		<!--头部-->
		<div class="topnav">
			<a href="<?php echo U('User/index');?>" >
				<img src="../Style/images/fanhui1.png" width="25"/>
			</a>
			地址管理
		</div>
		<?php if(!empty($address_list)): ?><!--地址列表-->
		<div data-am-widget="list_news" class="am-list-news am-list-news-default">
			<?php if(is_array($address_list)): $i = 0; $__LIST__ = $address_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div id="add" class="am-list-news-bd">
				<ul class="am-list">
		
					<li>
						<span class="user-name"><?php echo ($vo["consignee"]); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="user-number"><?php echo substr_replace($vo['mobile'],'****',3,4); ?></span>
					</li>
					<li>
						<p class="carId"><?php echo ($vo["cardId"]); ?></p>
						<p class="addr"><?php echo ($vo["towns"]); echo ($vo["address"]); ?></p>
					</li>
					<li>
						<div class="am-g">
  							<div class="am-u-sm-4">
							<?php if($vo["is_default"] == 1): ?><img src="../Style/index-images/add.jpg" alt="地址" width="25px" height="25px;" style="line-height: 48px;"/>
  								<span style="color: black; font-size: 15px; line-height: 32px;"/>&nbsp;默认地址</span><?php endif; ?>
  							</div>
  							<div class="am-u-sm-8">
  								
  									<button class="del" type="button" onclick="del('<?php echo ($vo["id"]); ?>');">删&nbsp;除</button>
							<?php if($vo["is_default"] != 1): ?><a href="javascript:;" onclick="set_default('<?php echo ($vo["id"]); ?>')">
									<button class="set_default" type="button">设为默认</button>
								</a><?php endif; ?>
  							</div>
						</div>
					</li>
				</ul>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<?php else: ?>
				<br />
		<br />
				<div style="text-align: center;">
			<img src="../Style/index-images/kongdizhi.png" alt="空地址" style="width: 140px; height: 140px;" />
		</div>
		<div style="text-align: center; font-size: 14px; color: black;">
			<p>无地址</p>
		</div>
	</br><?php endif; ?>
		<!--添加地址-->
		<div id="add_address">
			<a href="<?php echo U('User/addaddress');?>"><p>添加一个新地址</p></a>
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
//删除收货地址
function del(id){
	layer.open({
			title: '提示',
			content: '您确定要删除该条收货地址吗？',
			btn: ['确认', '取消'],
			yes: function(index){
				window.location.href= "<?php echo U('User/address');?>&type=del&id="+id;
				layer.open({content: '删除成功', time: 1});
				layer.close(index);
			}
	});
	
}
//设置默认收货地址
function set_default(id){
	layer.open({
			title: '提示',
			content: '您确定要将该条收货地址设为默认吗？',
			btn: ['确认', '取消'],
			yes: function(index){
				window.location.href= "<?php echo U('User/edit_address');?>&id="+id;
				layer.open({content: '设置默认地址成功', time: 1});
				
				layer.close(index);
			}
	});
	
}
</script>