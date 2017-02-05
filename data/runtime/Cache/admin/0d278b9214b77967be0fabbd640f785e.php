<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title></title>
	<script type="text/javascript" language="javascript" src='../Style/js/jquery-1.4.4.min.js'></script>
	<script language="javascript" src="../Style/js/jquery.jqprint-0.3.js"></script>
	<script language="javascript">
		function  a(){
			$("#ddd").jqprint();
		}
	</script>
</head>

<body>

<!-- 订单模板S -->
<div id="ddd">
<style type="text/css">
table{ border-collapse:collapse; background:#EAF0F7;}
table tr td{ padding:5px;}
</style>

	<table border="1" align="center" width="100%">
		<tr>
			<td>商品图片</td><td>商品名称</td><td>商品属性</td><td>单价</td><td>数量</td><td>小计</td>
		</tr>
		 <?php if(is_array($order_detail)): $i = 0; $__LIST__ = $order_detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td><img width="100" height="80" alt="nopic" src="<?php echo attach(get_thumb($vo['img'], '_b'), 'item');?>"></td>
			<td> <?php echo ($vo["title"]); ?></td>
			<td> <?php echo ($vo["color"]); ?>--<?php echo ($vo["size"]); ?></td>
			<td>¥<?php echo ($vo["price"]); ?></td>
			<td><?php echo ($vo["quantity"]); ?></td>
			<td><font color=red>¥<?php echo $vo['price']*$vo['quantity']; ?></font></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr>
			<td colspan="6" style=" text-align:right">商品总额：￥<?php echo ($item_info["goods_sumPrice"]); ?></td>
		</tr>
		<tr>
			<td colspan="6">
	<table border="1" width="100%">
		<tr>
			<td>购物客户ID：<?php echo ($item_info["userName"]); ?></td>
			<td>下单时间：<?php echo (date('Y/m/d H:i:s',$item_info["add_time"])); ?></td>
			<td colspan="2">支付方式：
			<?php switch($item_info["supportmetho"]): case "1": ?>支付宝支付<?php break;?>
                         <?php case "2": ?>货到付款<?php break;?>
                         <?php case "3": ?>微信支付<?php break;?>
                        <?php default: ?>--<?php endswitch;?>
			 
			&nbsp;&nbsp;订单编号：<?php echo ($item_info["orderId"]); ?></td>
		</tr>
		<tr>
			<td>付款时间：<?php if($item_info["support_time"] == ''): ?>--<?php else: echo (date('Y/m/d H:i:s',$item_info["support_time"])); endif; ?></td>
			<td>配送方式：
                 <?php if($item_info["userfree"] == '0'): ?>无需快递<?php elseif($item_info["userfree"] != '' and $item_info["userfree"] != '0' ): echo ($info["userfree"]); else: ?>--[买家自行配送方式]<?php endif; ?>
			</td>
			<td colspan="2">客户备注：<?php echo ($item_info["note"]); ?></td>
		</tr>
		<tr>
			<td>收货人：<?php echo ($item_info["address_name"]); ?></td><td>联系手机：<?php echo ($item_info["mobile"]); ?></td>
			<td colspan="2">收货地址：<?php echo ($item_info["address"]); ?> </td>
		</tr>
		<tr>
			<td>发货人：<?php echo ($userinfo["contacts"]); ?><br/>单位名称：<?php echo ($userinfo["name"]); ?></td>
			<td>打印时间：<?php echo date('Y/m/d H:i:s',time());?></td>
			<td colspan="2">操作人：<?php echo $_SESSION['admin']['username'];?></td>
		</tr>
	  </table>
		</td>
		</tr>		   
</table>
</div>
<!-- 订单模板E -->
<input type="button" onClick=" a()" value="打印!" style=" background:#318DD0; margin-top:20px; padding:5px 12px; color:#FFFFFF" />
</body>
</html>