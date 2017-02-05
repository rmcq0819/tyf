<?php if (!defined('THINK_PATH')) exit();?><style>

body{
	font-size:13px;
	color:#555;
	padding:10px;
}
p{
	font-size:14px;
}
table{
	border:0px;
}
td{
	border:1px solid #ececec;
}
tr{
	width:850px;
	height:35px;
	line-height:35px;
	text-align:center;
	
}
</style>

<form action="<?php echo U('item_order/itemedit');?>" method="post">

<p>商品名称：
	<?php echo ($order["title"]); ?>
</p>
<p>商品状态：
	<select name="status">
		<option value="0">--所有--</option>
		<option <?php if($order["status"] == 0): ?>selected=''<?php endif; ?> value="0">待发货</option>
		<option <?php if($order["status"] == 1): ?>selected=''<?php endif; ?> value="1">待付款</option>
		<option <?php if($order["status"] == 2): ?>selected=''<?php endif; ?> value="2">待发货</option>
		<option <?php if($order["status"] == 3): ?>selected=''<?php endif; ?> value="3">待收货</option>
		<option <?php if($order["status"] == 4): ?>selected=''<?php endif; ?> value="4">已完成</option>
		<option <?php if($order["status"] == 6): ?>selected=''<?php endif; ?> value="6">退货中</option>
		<option <?php if($order["status"] == 7): ?>selected=''<?php endif; ?> value="7">退款失败</option>
		<option <?php if($order["status"] == 11): ?>selected=''<?php endif; ?> value="11">退货成功</option>
		<option <?php if($order["status"] == 9): ?>selected=''<?php endif; ?> value="9">待收货(清关中)</option>
		<option <?php if($order["status"] == 10): ?>selected=''<?php endif; ?> value="10">异常</option>
		<option <?php if($order["status"] == 8): ?>selected=''<?php endif; ?> value="8">退款成功</option>
	</select>
</p>

<p>
物流公司：
<select name="delivery">
	<option value='无'>无</option>
	 <?php if(is_array($deliveryList)): $i = 0; $__LIST__ = $deliveryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['name'] == $order['userfree']){ echo "<option value='".$vo['name']."' selected='selected'>".$vo['name']."</option>"; }else{ echo "<option value='".$vo['name']."'>".$vo['name']."</option>"; } endforeach; endif; else: echo "" ;endif; ?>
</select>
</p>
<input type="hidden" name="id" value="<?php echo ($order["id"]); ?>">
<p>物流单号：<input type="text" name="freecode" value="<?php echo ($order["freecode"]); ?>"></p>

<p><input type="submit" value="修改" /></p>


</form>