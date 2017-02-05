<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<style>
		.sub_info{
			width:100px;
			height:30px;
			line-height:30px;
			text-align:center;
			cursor:pointer;
		}
		textarea{
			font-size:14px;
			color:#555;
			padding:5px;
			line-height:30px;
		}
		h3{color:#555;}
	</style>
</head>

<body style="background:#efefef;">
<h3>订单编号：<?php echo ($order_info["orderId"]); ?></h3>
<h3>订单总价：<?php echo ($order_info["order_sumPrice"]); ?></h3>
<h3>手机号码：<?php echo ($order_info["mobile"]); ?></h3>
<h3>收货地址：<?php echo ($order_info["address"]); ?></h3>
<form action="__URL__/send_infocontent" method="post">
<textarea style="width:700px;height:200px;" name="info_content">
尊敬的客户<?php echo ($order_info["address_name"]); ?>您好！您购买的宝贝我们将尽快为你发出，订单编号为：<?php echo ($order_info["orderId"]); ?> 。
</textarea> </br>
<input type="hidden" name="mobile" value="<?php echo ($order_info["mobile"]); ?>">
<input type="submit" value="发送短信" class="sub_info">
</form>
</body>
</html>