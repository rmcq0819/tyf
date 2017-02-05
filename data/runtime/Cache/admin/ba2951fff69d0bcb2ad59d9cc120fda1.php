<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link href="__STATIC__/css/admin/style.css" rel="stylesheet"/>
	<title><?php echo L('website_manage');?></title>
	<script>
	var URL = '__URL__';
	var SELF = '__SELF__';
	var ROOT_PATH = '__ROOT__';
	var APP	 =	 '__APP__';
	//语言项目
	var lang = new Object();
	<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
	</script>
	<script charset="utf-8" src="__STATIC__/js/jquery.js" type="text/javascript"></script>
</head>

<body>
<div id="J_ajax_loading" class="ajax_loading"><?php echo L('ajax_loading');?></div>
<?php if(($sub_menu != '') OR ($big_menu != '')): ?><div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<?php if(!empty($big_menu)): ?><a class="add fb J_showdialog" href="javascript:void(0);" data-uri="<?php echo ($big_menu["iframe"]); ?>" data-title="<?php echo ($big_menu["title"]); ?>" data-id="<?php echo ($big_menu["id"]); ?>" data-width="<?php echo ($big_menu["width"]); ?>" data-height="<?php echo ($big_menu["height"]); ?>"><em><?php echo ($big_menu["title"]); ?></em></a><?php endif; ?>
        <?php if(!empty($sub_menu)): if(is_array($sub_menu)): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key; if($key != 1): ?><span>|</span><?php endif; ?>
			<a href="<?php echo U($val['module_name'].'/'.$val['action_name'],array('menuid'=>$menuid)); echo ($val["data"]); ?>" class="<?php echo ($val["class"]); ?>"><em><?php echo ($val['name']); ?></em></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
</div><?php endif; ?>
<script charset="utf-8" src="__STATIC__/js/jquery.js" type="text/javascript"></script>
<script src="__STATIC__/layer/layer.js"></script>
<style>
.tdtitle {font-family: "宋体";
    height: 32px;
    line-height: 32px;
    padding-right: 5px;
    text-align: right;
    vertical-align: top;}

.tblist thead tr th, .tblist tbody tr.tblist_th td {
    border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
	border-top: 1px solid #DDDDDD;
    height: 30px;
    overflow: hidden;
    padding: 0 8px;
    text-align: center;
    white-space: nowrap;
}
.tblist tbody tr, .tbmodify .tblist tbody tr {
    background: none repeat scroll 0 0 #FFFFFF;
}
.tblist {
    border-left: 1px solid #DDDDDD;
    width: 100%;
}	
.tblist tbody tr, .tbmodify .tblist tbody tr {
    background: none repeat scroll 0 0 #FFFFFF;
}
.tblist tbody tr td, .tbmodify .tblist tbody tr td {
    border-bottom: 1px solid #DDDDDD;
    border-left: 0 solid #DDDDDD;
    border-right: 1px solid #DDDDDD;
    line-height: 18px;
    text-align: center;
}
.tblist tbody tr td {
    padding: 2px 4px;
}
.tbdetail {
    width: 100%;
}
.tbdetail td {
    background-color: #FFFFFF;
    height: 32px;
    line-height: 33px;
    padding: 3px 0 3px 5px;
    /*text-align: left; */
}
td.thtitle{ font-weight:bold; padding-left:15px;height: 32px;line-height: 33px;padding: 3px 0 3px 5px; text-align:right; background:#f1f0f0}
.tbdetail .ltd {
    padding-left: 5px;
  text-align: left;
}
.tbdetail .rtd {
    padding-right: 5px;
   text-align: right;	
}
.divtab{background: #eaf0f7 none repeat scroll 0 0;line-height: 20px;height:41px;}
.divtab a{ display:block; padding:0 15px; float:left; height:41px; line-height:41px;}
.divtab a.on{ background:#fff;border: 1px solid #dae2e9; border-bottom:1px solid #fff;}
</style>
<script charset="utf-8" src="__STATIC__/js/jquery.js" type="text/javascript"></script>
<!--编辑商品-->
<form id="info_form" action="<?php echo u('item_order/edit');?>" method="post" enctype="multipart/form-data">
<div class="pad_lr_10">
	<div class="col_tab">
		
		<div class="J_panes">
        <div class="content_list pad_10">
        <div class="explain_col" style=" margin-bottom:10px;">
                    当前订单状态：<?php switch($info["status"]): case "1": ?><!-- 待付款-->
                待付款
                <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>2));?>">	<input type="button" value="设为已付款" id="Button1" name="dosubmit" class="btn btn_submit" ></a><?php break;?>  
                <?php case "2": ?><!-- 待发货-->
				<?php if($itemcont != 0): ?>已付款，待发货
					<a data-height="130" data-width="650"
					data-id="add" data-title="发货管理" data-uri="<?php echo U('item_order/fahuo',array('id'=>$info['id']));?>" href="javascript:void(0);" class="add fb J_showdialog"> 	<input type="button" value="发货" id="Button2" name="dosubmit" class="btn btn_submit" ></a>
					<?php else: ?>
					已全部发货<?php endif; break;?>  
                <?php case "3": ?><!-- 待收货 -->
                已发货，待收货
                  <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>4));?>" style="display: block;"><input type="button" value="设为已收货" id="Button3" name="dosubmit" class="btn btn_submit" ></a><?php break;?>  
				  <?php case "4": ?>待评论<?php break;?>
                  <?php case "6": ?>已发货，已申请退货
                  <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>7,'jifen'=>$itemtk['refund']));?>">
				  <input type="button" value="核实后不予退款" id="Button4" name="dosubmit" class="btn btn_submit" >
				  </a>
				   <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>8,'jifen'=>$itemtk['refund']));?>">
				  <input type="button" value="核实后给予退款" id="Button5" name="dosubmit" class="btn btn_submit" >
				  </a><?php break;?> 
				<?php case "7": ?>退款失败<?php break;?>				
				<?php case "8": ?>退款成功<?php break;?>				
				<?php case "9": ?>清关中<?php break;?>				
				<?php case "11": ?>退款中<?php break;?>				
                <?php default: endswitch;?>
						<span>修改订单状态为：</span>
	                        <select id="sle" style="font-size:13px;">
	                            <option value="0" name="s">请选择</option>
	                            <option value="1" name="s">待付款</option>
	                            <option value="2" name="s">待发货</option>
	                            <option value="9" name="s">清关中</option>
	                            <option value="3" name="s">待收货</option>
	                            <option value="4" name="s">已完成</option>
	                            <option value="6" name="s">退货中</option>
	                            <option value="7" name="s">退款失败</option>
	                            <option value="8" name="s">退款成功</option>
	                            <option value="10" name="s">异常</option>
	                            <option value="11" name="s">退款中</option>
	                        </select>
                        <input type="button" id="sure" value="确定" class="btn">
                </div>
        <div  class="divtab">
		<!--<a href="javascript:;" class="on"><font color="#990000;">保/完税分单</font></a>-->
        <a href="javascript:;" class="on">基本信息</a><a href="javascript:;">物流跟踪</a>
        <a href="./index.php?g=admin&m=item_order&a=print_kdd&order_id=<?php echo $_GET['id'];?>" target="_blank">打印快递单</a>
		<a href="./index.php?g=admin&m=item_order&a=print_order&order_id=<?php echo $_GET['id'];?>" target="_blank">打印订单</a>
		<a href="./index.php?g=admin&m=item_order&a=send_info&order_id=<?php echo $_GET['id'];?>" target="_blank">发送短信</a>
		<?php if($info["status"] == 2): ?><a href="./index.php?g=admin&m=item_order&a=send_point&order_id=<?php echo $_GET['id'];?>" target="_blank">充值范票</a><?php endif; ?>
		</div>
		<!-- 分单处理S -->
		<!--<style type="text/css">
		.orderlist{ width:100%;height:auto;}
		.orderlist .ordertable{border:1px solid #ccc;margin-bottom:15px;}
		.orderlist .ordertable tr,.ordertable td {border:1px solid #ccc;padding:5px;}
		</style>
		<div class="main" style=" min-height:300px; padding:20px;border: 1px solid #dae2e9;">
			<div class="orderlist">
			<?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><table class="ordertable">
					<tr>
					<td colspan="6">
					<?php if($vo["itemtype"] == 0): ?><font color="#990000">保税分单[<?php echo ($vo["orderId"]); ?><b>BS</b>]</font>
					<?php else: ?>
					<font color="#006600">完税分单[<?php echo ($vo["orderId"]); ?><b>WS</b>]</font><?php endif; ?>
					<a href="javascript:;" style="font-weight:bold;float:right;">所属订单[<?php echo ($vo["orderId"]); ?>]</a>
					</td>
					</tr>
					<?php if(is_array($vo["goodsifno"])): $i = 0; $__LIST__ = $vo["goodsifno"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><tr>
					<td><img src="./data/upload/item/<?php echo ($vo1["img"]); ?>" width="40" /></td>
					<td><?php echo ($vo1["title"]); ?></td>
					<td>属性：<?php if($vo1["size"] == ''): ?>无<?php else: echo ($vo1["size"]); endif; ?></td>
					<td>类型：<?php if($vo["itemtype"] == 0): ?>保税商品<?php else: ?>完税商品<?php endif; ?></td>
					<td>数量：x<?php echo ($vo1["quantity"]); ?></td>
					<td>价格：￥<?php echo ($vo1["price"]); ?></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<tr><td colspan="6" align="right">总单共计：<?php echo ($vo["goods_sumPrice"]); ?>，本分单共计：<b><?php echo ($vo["0"]); ?></b>元.</td></tr>
				</table><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<a href="./index.php?g=admin&m=item_order&a=print_curr&order_id=<?php echo $_GET['id'];?>" target="_blank" style="background:#0099FF; padding:5px;color:#FFFFFF;">预览打印</a>
		</div>-->
		<!-- 分单处理E -->
		
		<div style="border: 1px solid #dae2e9; class="main">
			
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdetail">
                    <tbody>
                        <tr>
                            <td width="10%" class="tdtitle" >订单编号：</td>
                            <td width="22%"><?php echo ($info["orderId"]); ?></td>
                          
                            <td width="10%" class="tdtitle">订单状态：</td>
                            <td width="22%" style="color: #f34;font-weight: 700;">   
                         <?php switch($info["status"]): case "1": ?>待付款<?php break;?>
                         <?php case "2": ?>待发货<?php break;?>
                         <?php case "3": ?>待收货<?php break;?>
                         <?php case "4": if(($info["c_status"]) == "0"): ?>待评论<?php else: ?>已完成<?php endif; break;?>
						 <?php case "6": ?>退货中<?php break;?>
						 <?php case "7": ?>退款失败<?php break;?>
						 <?php case "8": ?>退款成功<?php break;?>
						 <?php case "9": ?>清关中<?php break;?>
						 <?php case "10": ?>异常<?php break;?>
						 <?php case "11": ?>退款中<?php break;?>
                        <?php default: ?><font color="red">关闭</font><?php endswitch;?>
                        </td>
                         <td width="10%" class="tdtitle">订单类型：</td>
                            <td width="22%" style="color: #f34;font-weight: 700;"><?php if($info["itemtype"] == '0'): ?>保税订单<?php else: ?>完税订单<?php endif; ?></td>
                        </tr>
                        <tr>
                            <td class="tdtitle">下单时间：</td>
                            <td><?php echo (date('Y/m/d H:i:s',$info["add_time"])); ?></td>
                            <td class="tdtitle">付款时间：</td>
                            <td><?php if($info["support_time"] == ''): ?>-<?php else: echo (date('Y/m/d H:i:s',$info["support_time"])); endif; ?></td>
                            <td class="tdtitle">商品总额：</td>
                            <td class="red"><span id="labProductTotal">¥<?php echo ($info["goods_sumPrice"]); ?></span></td>
                        </tr>
                        <tr>
                            <td class="tdtitle">订单总额：</td>
                            <td class="red"><span id="labOrderTotal">¥<?php echo ($info["order_sumPrice"]); ?></span></td>
                        </tr>
						
						 <tr>
                            <td class="tdtitle">催货状态：</td>
                            <td><?php if($info["is_urgent"] == 1): ?><span style="color:red">已催促发货</span><?php else: ?>无<?php endif; ?></td>
                        </tr>


						<tr>
                            <td class="tdtitle">是否使用范票抵扣：</td>
                            <td style="padding:5px 0 5px 10px;" colspan="5">
								 <?php if($info["cash_price"] == 0): ?>未使用范票抵扣
									<?php else: ?>
										<span style="color:#ff0000;">使用<?php echo ($info["cash_price"]); ?>张范票抵扣<?php echo $info['cash_price']/100; ?>元</span><?php endif; ?>
							</td>
                        </tr>
						
						<tr>
                            <td class="tdtitle">是否使用优惠卷兑换：</td>
                            <td style="padding:5px 0 5px 10px;" colspan="5">
								 <?php if($info["coupon_price"] == 0): ?>未使用优惠卷兑换
									<?php else: ?>
										<span style="color:#ff0000;">使用优惠卷兑换了<?php echo ($info["coupon_price"]); ?>元现金</span><?php endif; ?>
							</td>
                        </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                function Modify()
                {
                	$('#labSellerRemark').hide();
                	$('#btnModifySellerRemark').hide();
                	$('#sellerRemark_modify').show();
                }
                  function Cancel()
                {
                	$('#labSellerRemark').show();
                	$('#btnModifySellerRemark').show();
                	$('#sellerRemark_modify').hide();
                }
                
                 $('#sure').on("click",function(){
                    var url ="<?php echo U('item_order/status_edit');?>";
                    var oid = "<?php echo ($info["orderId"]); ?>";
                    $.post(url,{price: $('#sle').val(),orderid:oid},function(data){
                        alert(data);
                        window.location.reload();
                    });

                });
              
                </script>
				<?php if(!empty($itemtk)): if(is_array($itemtk)): $i = 0; $__LIST__ = $itemtk;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tkvol): $mod = ($i % 2 );++$i;?><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdetail">
					
                    <tbody>
                    <tr>
							<td align="left" class="thtitle">申请退款信息&nbsp;&nbsp;<?php if($tkvol["ck"] == 1): ?>【需退货】<?php else: ?>【无需退货】<?php endif; ?></td>
							<td colspan="7" align="left" class="thtitle">&nbsp;</td>
						</tr>
						<tr>
							<td width="10%" class="tdtitle">退款金额:</td>
							<td width="20%" style="color: red;"><?php echo ($tkvol["refund"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<span id="detailTitle" style="color:#555;"><?php if($tkvol["detailTitle"] != ''): ?>(<?php echo ($tkvol["detailTitle"]); ?>)<?php endif; ?></span></td><span>
							<td width="10%" class="tdtitle">收款账号:</td>
							<td width="10%" style="color: red;"><?php echo ($tkvol["zhanghao"]); ?></td>
							<td width="10%" class="tdtitle">账号名称:</td>
							<td width="10%" style="color: red;"><?php echo ($tkvol["huming"]); ?></td>
							<td width="10%" class="tdtitle">开户银行:</td>
							<td width="10%" style="color: red;"><?php echo ($tkvol["bank"]); ?></td>
						</tr>
                        <tr>
                            <td width="10%" class="tdtitle">退款原因：</td>
                            <td width="20%">
                           <?php echo ($tkvol["yuanyin"]); ?>
                           </td>
                             <td width="10%" class="tdtitle">退货快递公司:</td>
                            <td width="10%"><?php echo ($tkvol["express"]); ?></td>
							<td width="10%" class="tdtitle">退货运单号:</td>
                            <td width="10%" style="color: red;"><?php echo ($tkvol["waybill"]); ?></td>
                        </tr>
						  <tr>
                            <td class="tdtitle">审核不通过原因：</td>
                            <td style="padding:5px 0 5px 10px;" colspan="5">
                                <span  id="laboverrule"><?php echo ($info["overrule"]); ?></span>
                                 <form method="POST" >
                                <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
                                    <input type="hidden" name="g" value="admin" />
                                    <input type="hidden" name="m" value="item_order" />
                                   <input type="hidden" name="a" value="updateOverrule" />
                                   <span style="display:none;" id="overrule_modify">
	                                    <textarea style="width:600px;height:45px;margin-bottom:3px;resize: none;"  id="txtoverrule" name="txtoverrule"><?php echo ($info["overrule"]); ?></textarea>
                                    <br>
                                    <input type="submit" class="button" id="btnoverrule" value="保存" name="btnoverrule">
                                    <input type="button" value="取消" class="button" onclick="Canceloverrule()">
                                </span>
                                <input type="button" value="修改" class="button"  onclick="Modifyoverrule()" id="btnModifyoverrule" name="btnModifyoverrule">
                                </form>
                            </td>
                        </tr>
						        <script>
								function Modifyoverrule()
								{
									$('#laboverrule').hide();
									$('#btnModifyoverrule').hide();
									$('#overrule_modify').show();
								}
								  function Canceloverrule()
								{
									$('#laboverrule').show();
									$('#btnModifyoverrule').show();
									$('#overrule_modify').hide();
								}
							  
								</script>
						  <tr>
						
                <td class="tdtitle" style="line-height:127px;">退款成功的说明：</td>
                            <td style="padding:5px 0 5px 10px;" colspan="5">
                                <span  id="labvouchers"><?php echo ($info["vouchers"]); ?></span>
                                 <form method="POST" >
                                   <input type="button" value="修改" class="button" style="margin-top:0"  onclick="Modifyvouchers()" id="btnModifyvouchers" name="btnModifyvouchers">
                                    <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
                                    <input type="hidden" name="g" value="admin" />
                                    <input type="hidden" name="m" value="item_order" />
                                   <input type="hidden" name="a" value="updateVouchers" />
                                   <span style="display:none;" id="vouchers_modify">
	                                    <textarea style="width:600px;height:75px;margin-bottom:3px;resize: none;"  id="txtvouchers" name="txtvouchers"><?php echo ($info["vouchers"]); ?></textarea>
                                    <br>
                                    <input type="submit" class="button" id="btnvouchers" value="保存" name="btnvouchers">
                                    <input type="button" value="取消" class="button" onclick="Cancelvouchers()">
                                </span>
                               
                                </form>
                            </td>
							  
							 <td style="padding:5px 0 5px 10px;" colspan="5">
                <?php if(($info['pingzheng'] == '')): ?>您还未上传凭证,无法查看
                 <?php else: ?>
                <a href="data/upload/item/<?php echo ($info['pingzheng']); ?>">查看凭证</a><?php endif; ?>
								<form id="fencheng_form" action="<?php echo u('item_order/fencheng_img');?>" method="post" enctype="multipart/form-data" style="margin-top: 10px;">
									<span>上传凭证 :</span>
									<input type="hidden" name="id" value="<?php echo ($info['id']); ?>"/>
									<input type="file" name="img"/>
									<input type="submit" value="提交" id="dosubmit" name="dosubmit" class="btn btn_submit"/>
								</form>
								 
							</td>
                        </tr>
						<tr>
						<td>
							
							  <?php if($tkvol["status"] == 1): if($tkvol["detailId"] != ''): ?><td style="text-align:center;" colspan="5">
								  <a href="<?php echo U('item_order/change_odstatus',array('detailId'=>$tkvol['detailId'],'tkId'=>$tkvol['id'],'status'=>7));?>">
									   <input type="button" value="核实后不予退款" name="dosubmit" class="btn btn_submit" >
								  </a>
								  <a href="<?php echo U('item_order/change_odstatus',array('detailId'=>$tkvol['detailId'],'tkId'=>$tkvol['id'],'status'=>8));?>">
								       <input type="button" value="核实后给予退款"  name="dosubmit" class="btn btn_submit" >
								  </a>
								</td>
							  <?php else: ?>
							  <td>
								  <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'tkId'=>$tkvol['id'],'status'=>7));?>">
								       <input type="button" value="核实后不予退款" id="Button4" name="dosubmit" class="btn btn_submit" >
								  </a>
								  <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'tkId'=>$tkvol['id'],'status'=>8));?>">
								       <input type="button" value="核实后给予退款" id="Button5" name="dosubmit" class="btn btn_submit" >
								  </a>
								  
								 </td><?php endif; endif; ?>
				          </td>
						  </tr>
						
						        <script>
								function Modifyvouchers()
								{
									$('#labvouchers').hide();
									$('#btnModifyvouchers').hide();
									$('#vouchers_modify').show();
								}
								  function Cancelvouchers()
								{
									$('#labvouchers').show();
									$('#btnModifyvouchers').show();
									$('#vouchers_modify').hide();
								}
							  
								</script>
								
                    </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
                </table><?php endif; ?>
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdetail"  style="<?php if($info['status'] < '4' || $info['c_status'] == '0'): ?>display:none;<?php endif; ?>">
                    <tbody>
                    <tr>
                            <td class="thtitle">评论详情</td>
                            <td colspan="7" class="thtitle">&nbsp;</td>
                      </tr>
                        <tr>
                            <td width="10%" class="tdtitle">评论：</td>
                            <td width="21%">
                           <?php echo ($itemcomment["info"]); ?>
                           </td>
                           
                           <td width="11%" class="tdtitle">评论组图:</td>
                            <?php if(!empty($itemcomment['picurl1'])): ?><td width="11%"><a href="<?php echo ($itemcomment["picurl1"]); ?>"><img src="<?php echo ($itemcomment["picurl1"]); ?>" style="width: 33%;"/></a></td><?php endif; ?>
							             <?php if(!empty($itemcomment['picurl2'])): ?><td width="11%"><a href="<?php echo ($itemcomment["picurl2"]); ?>"><img src="<?php echo ($itemcomment["picurl2"]); ?>" style="width: 33%;"/></a></td><?php endif; ?>
                           <?php if(!empty($itemcomment['picurl2'])): ?><td width="11%"><a href="<?php echo ($itemcomment["picurl3"]); ?>"><img src="<?php echo ($itemcomment["picurl3"]); ?>" style="width: 33%;"/></a></td><?php endif; ?> 
                             <td width="11%" class="tdtitle">评论时间:</td>
                            <td width="14%"><?php echo (date('Y-m-d H:i:s',$itemcomment["add_time"])); ?></td>
                        </tr>
                    </tbody>
                </table>
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdetail">
                    <tbody>
                    <tr>
                      <td class="thtitle">支付信息</td>
                      <td colspan="5" class="thtitle">&nbsp;</td>
                      </tr>
                        <tr>
                            <td width="10%" class="tdtitle">支付方式：</td>
                            <td width="22%">
                             <?php switch($info["supportmetho"]): case "1": ?>支付宝支付<?php break;?>
                         <?php case "2": ?>货到付款<?php break;?>
                         <?php case "3": ?>微信支付<?php break;?>
                        <?php default: ?>-<?php endswitch;?>
                           </td>
                           <td width="10%" class="tdtitle">是否货到付款:</td>
                            <td width="22%"> <?php switch($info["supportmetho"]): case "1": ?>否<?php break;?>
                         <?php case "2": ?>是<?php break;?>
                         <?php case "3": ?>否<?php break;?>
                        <?php default: ?>-<?php endswitch;?></td>
                             <td width="10%" class="tdtitle"></td>
                            <td width="22%" class="red"><span id="labPaymentFee"></span></td> 
                        </tr>
                 </tbody>
</table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdetail">
                    <tbody>
                    <tr>
                            <td class="thtitle">配送信息</td>
                            <td colspan="5" class="thtitle">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="10%" class="tdtitle">客户要求：</td>
                            <td width="22%">  <?php switch($info["freetype"]): case "1": ?>平邮<?php break;?>
                         <?php case "2": ?>快递<?php break;?>  
                         <?php case "3": ?>ems<?php break;?>  
                          <?php case "0": ?>卖家包邮<?php break; endswitch;?></td>
                            <td width="10%" class="tdtitle">运送费用：</td>
                            <td width="22%" class="red"><span id="labDeliveryFee">
                            <?php switch($info["yunfei"]): case "0": ?>¥0.00<?php break;?>  
                          <?php default: echo ($info["yunfei"]); endswitch;?></span></td>
                            <td width="10%" class="tdtitle"></td>
                            <td width="22%" class="red">
                          
                                
                            </td>
                        </tr>
                          <tr>
                            <td width="10%" class="tdtitle">配送快递：</td>
                            <td width="22%"> 
                            <?php if($info["userfree"] == '0'): ?>无需快递<?php elseif($info["userfree"] != '' and $info["userfree"] != '0' ): ?>
							 <input value="<?php echo ($info["userfree"]); ?>" style="width:300px;" id="userfree" data-id="<?php echo ($info["id"]); ?>"  /><?php else: ?>-<?php endif; ?>
							 <?php if($info["freetype"] == 10): ?><b style="color:#ff0000">顺丰速运</b><?php endif; ?>
                            </td>
                            <td width="10%" class="tdtitle">快递单号：</td>
                            <td width="22%">
                                <?php if($status == 3 or $status == 4): ?><input value="<?php echo ($info["freecode"]); ?>" style="width:300px;" id="kuaidi" data-id="<?php echo ($info["id"]); ?>"  /><span style="color:red;">（如有多个快递，填写多个快递单号，以英文的 , 隔开）</span>
                                <?php else: ?>
                                    <?php if($info["freecode"] == ''): ?>-<?php else: ?> <?php echo ($info["freecode"]); endif; endif; ?>
                            </td>
                        </tr>
                        <?php if($status == 3): ?><tr>
                            <td width="10%" class="tdtitle">包裹信息：</td>
                            <td width="90%" colspan="5">
                                <textarea cols="40" rows="5" id="kuaidi_desc" data-id="<?php echo ($info["id"]); ?>" ><?php echo ($info["kuaidi_desc"]); ?></textarea><span style="color:red;">（填写物流包裹标题与数量，多个包裹中间用|隔开，包裹内商品数量用#隔开，格式如：进口水果、进口食品#2|进口蛇果、进口奶粉、红酒#3）</span>
                            </td>
                        </tr><?php endif; ?>
                            
                          </tr>
                        <tr id="trDeliverySend">
	                         <td class="tdtitle">出库时间：</td>
	                           <td colspan="5">
                                <span style="display:block;width:180px;float:left;" id="labDeliveryTime"><?php if($info["fahuo_time"] == ''): ?>-<?php else: ?> <?php echo (date('Y/m/d H:i:s',$info["fahuo_time"])); endif; ?></span>
                            </td>
                        </tr>
                        <tr id="trDeliveryAddress">
	                       <td class="tdtitle">发货地址：</td>
	                         <td style="padding:5px 0;" colspan="5">
	                         <?php if($info["fahuoaddress"] == ''): ?>-<?php else: ?>
	                         <?php echo ($fahuoaddress["contacts"]); ?>（<?php echo ($fahuoaddress["mobile"]); ?>）<?php echo ($fahuoaddress["Province"]); ?> <?php echo ($fahuoaddress["City"]); ?> <?php echo ($fahuoaddress["Area"]); ?> <?php echo ($fahuoaddress["address"]); ?>（邮编：<?php if($fahuoaddress["postcode"] == ''): ?>-<?php else: echo ($fahuoaddress["postcode"]); endif; ?>）<?php endif; ?>
                                
                           </td>
                           
                        </tr>
                        
                    </tbody>
                </table>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdetail">
                    <tbody>
                    <tr>
                            <td class="thtitle">收货人信息</td>
                            <td colspan="5" class="thtitle">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="tdtitle" width="10%">收货人账号：</td>
                            <td>
                                <?php echo ($info["userName"]); ?>
                            </td>
							 <!--<td class="tdtitle" width="10%">车型:</td>
                            <td>
                                <?php echo ($info["chexing"]); ?>
                            </td>-->
                        </tr>
                        <tr>
                            <td width="10%" class="tdtitle">收 货 人：</td>
                            <td width="22%">
                                <span attr="address_display" id="labConsignee"><?php echo ($info["address_name"]); ?></span>
                                <span style="display:none;" attr="address_modify">
                                    <input type="text" class="txt150" id="txtConsignee" maxlength="50" value="address_name" name="txtConsignee">
                                </span>
                            </td>
                            <td width="10%" class="tdtitle">联系手机：</td>
                            <td width="22%">
                                <span attr="address_display" id="labMobile"><?php echo ($info["mobile"]); ?></span>
                                <span style="display:none;" attr="address_modify">
                                    <input type="text" class="txt150" id="txtMobile" maxlength="50" value="<?php echo ($info["mobile"]); ?>" name="txtMobile">
                                </span>
                            </td>
                            <td width="10%" class="tdtitle"></td>
                            <td width="22%">
                                <span attr="address_display" id="labPhone"></span>
                                <span style="display:none;" attr="address_modify">
                                    <input type="text" class="txt150" id="txtPhone" maxlength="50" name="txtPhone">
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="tdtitle">收货地址：</td>
                            <td colspan="5">
                                <span attr="address_display">
                                   <?php echo ($info["address"]); ?>
                                </span>
                               
                                
                            </td>
                        </tr>
						<?php if($info["itemtype"] == 0): ?><tr>
							<td class="tdtitle">身份证姓名：</td>	
							<td><?php echo ($info["idcname"]); ?></td>
							<td class="tdtitle">身份证号码：</td>
							<td><?php echo ($info["idcnum"]); ?></td>
						</tr>
						<tr style="border:1px solid #666666;display:none;">
							<td class="tdtitle" >身份证正照：</td>
							<?php if(!empty($addr)): ?><td><img src="data/upload/<?php echo ($addr["frontage"]); ?>" alt="暂无" width="300" /></td>
							<?php else: ?>
							<td><img src="./data/upload/idcard/<?php echo ($info["idczimg"]); ?>" alt="暂无" width="300" /></td><?php endif; ?>
							
							<td class="tdtitle">身份证反照：</td>
							<?php if(!empty($addr)): ?><td style="border:1px solid #666666;"><img src="data/upload/<?php echo ($addr["opposite"]); ?>" alt="暂无" width="300" /></td>
							<?php else: ?>
							<td ><img src="./data/upload/idcard/<?php echo ($info["idcfimg"]); ?>" alt="暂无" width="300" /></td><?php endif; ?>
						</tr>
                           <!-- 基本信息修改到此处-->
                            <tr>
                                <td class="tdtitle">客户要求：</td>
                                <td style="padding:5px 0 5px 10px;" colspan="5"><?php echo ($info["note"]); ?></td>
                            </tr>
                            <tr>
                                <td class="tdtitle">客服备注：</td>
                                <td style="padding:5px 0 5px 10px;" colspan="5">
                                    <span  id="labSellerRemark"><?php echo ($info["sellerRemark"]); ?></span>
                                    <form method="POST" >
                                        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
                                        <input type="hidden" name="g" value="admin" />
                                        <input type="hidden" name="m" value="item_order" />
                                        <input type="hidden" name="a" value="updateRemark" />
                                        <span style="display:none;" id="sellerRemark_modify">
	                                    <textarea style="width:600px;height:45px;margin-bottom:3px;resize: none;"  id="txtSellerRemark" name="txtSellerRemark"><?php echo ($info["sellerRemark"]); ?></textarea>
                                    <br>
                                    <input type="submit" class="button" id="btnSellerRemark" value="保存" name="btnSellerRemark">
                                    <input type="button" value="取消" class="button" onclick="Cancel()">
                                </span>
                                        <input type="button" value="修改" class="button"  onclick="Modify()" id="btnModifySellerRemark" name="btnModifySellerRemark">
                                    </form>
                                </td>
                            </tr><?php endif; ?>
                    </tbody>
                </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tblist">
                    <thead>
                        <tr>
                            <th width="70" height="50">商品图片</th>
                            <th>商品名称</th>							
							<th>商品属性</th>
							<th>所属免税仓</th>
							<th>发货仓库</th>
							<th>快递名称</th>
							<th>物流单号</th>
                            <th width="60">单价</th>
                            <th width="60">数量</th>
                            <th width="60">小计</th>
                            <th width="60">物流信息</th>
                            <th width="60">宝贝状态</th>
                            <th width="60">填写物流信息</th>
                            <th width="60">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php if(is_array($order_detail)): $i = 0; $__LIST__ = $order_detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="">
                            <td><img width="68" alt="nopic" src="<?php echo attach(get_thumb($vo['img'], '_b'), 'item');?>"></td>
                            <td height="50" class="ltd">
                                <?php echo ($vo["title"]); ?> 
                            </td>
							 <td class="ltd">
                                <?php echo ($vo["color"]); ?>|<?php echo ($vo["size"]); ?>
                            </td>
							<td class="rtd">
							<?php if($vo["baseid"] == 0): ?>暂无免税仓记录
								<?php else: ?>
									<?php echo ($vo["basename"]); endif; ?>
							</td>
							<td class="rtd">
							<select name="item_base_<?php echo ($vo["id"]); ?>" id="item_base_<?php echo ($vo["id"]); ?>" style="width:100px;height:23px;" onblur="change_base(<?php echo ($vo["id"]); ?>);">
								<option value="0">--请选择--</option>
								<?php if(is_array($item_base)): $i = 0; $__LIST__ = $item_base;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($vo['item_base'] == $v['basename']){ echo "<option value='".$v['basename']."' selected='selected'>".$v['basename']."</option>"; }else{ echo "<option value='".$v['basename']."'>".$v['basename']."</option>"; } endforeach; endif; else: echo "" ;endif; ?>	
							</select>
							<script>
								function change_base(id){
									var basename = $("#item_base_"+id).selected().val();
									var url="<?php echo U('item_order/edit_base');?>";
									$.post(url,{basename:basename,id:id},function(data){
										if(data == 1){
											<!-- alert("发货仓库修改成功！"); -->
										}
									});
								}
							</script>
							</td>
							<td class="rtd">
								<?php if($vo["userfree"] != '0'): echo ($vo["userfree"]); ?>
									<?php else: ?>
									无<?php endif; ?>
							</td>
							<td class="rtd">
							<?php if($vo["freecode"] != 0): echo ($vo["freecode"]); ?>
									<?php else: ?>
									无<?php endif; ?>
							</td>
                            <td class="red rtd">¥<?php echo ($vo["price"]); ?></td>
                            <td><?php echo ($vo["quantity"]); ?></td>
                            <td class="red rtd">¥<?php echo $vo['price']*$vo['quantity']; ?></td>
							<td>
								<?php if($vo["status"] == 3): ?><span onclick="free_info('<?php echo U('item_order/free_info',array('id'=>$vo['id']));?>','<?php echo $vo['title']; ?> - 物流信息查看')" style="color:#318dd0;">查看详情</span>
									<?php else: ?>
									无<?php endif; ?>
							</td>
							
							<td>
								<?php switch($vo["status"]): case "0": ?>未发货<?php break;?>
									<?php case "1": ?>待付款<?php break;?>
									<?php case "2": ?>待发货<?php break;?>
									<?php case "3": ?><span style="color:red;">待收货</span><?php break;?>
									<?php case "4": ?><span style="color:blue;">已完成</span><?php break;?>
									<?php case "6": ?>退货中<?php break;?>
									<?php case "7": ?>退款失败<?php break;?>
									<?php case "8": ?>退款成功<?php break;?>
									<?php case "9": ?>待收货（清关中）<?php break;?>
									<?php case "10": ?>异常<?php break;?>
									<?php case "11": ?>退货成功<?php break; endswitch;?>
							</td>
							<td>
								<a href="./index.php?g=admin&m=item_order&a=add_freeinfo&order_id=<?php echo ($vo["id"]); ?>" target="_blank" style="color:blue;">去填写</a>
							</td>
							<td>
								<span onclick="itemedit('<?php echo U('item_order/itemedit',array('id'=>$vo['id']));?>','修改商品状态')" style="color:blue;">修改状态</span>
							</td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>   
                    </tbody>
                </table>      
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbdetail">
                    <tbody>
                        <tr>
                            <td class="rtd">商品总额：<span class="red" id="labProdAllTotal">¥<?php echo ($vo["sigsumprice"]); ?></span>  </td>
                        </tr>
                        
                    </tbody>
                </table> 
                </div>
          
         <div class="main" style=" min-height:300px; padding:20px;border: 1px solid #dae2e9; ">
		 <style type="text/css">
		.sta{ width:80%; height:auto; border:1px solid #999999; margin:15px auto; text-align:left;}
		.sta ul{ list-style:none; margin:0; padding:0;}
		.sta ul li{ margin-left:16%;}
		p{ margin-left:60%;padding:8px 0}
		.title{height:28px; text-align:center; background:#EAF0F7; display:block; margin:0 auto; line-height:25px; color:#000000;}
		a:hover{ text-decoration:none;}
		
		.up{ width:2px; height:10px; background:#009900; margin-left:8px;}
		.box{ width:15px; height:15px; background:#CCCCCC;border:1px solid #006600; border-radius:9px;}
		.box1{ width:9px; height:9px; background:#006600;border-radius:10px; margin:3px;}
		
		</style>
		<?php if(($status == 3) OR ($status == 4)): ?><div class="sta">
		<span class="title">快递单号：<?php echo ($freecode); ?>，物流动态</span>
		<ul>
		 <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k; if(is_array($val)): $i = 0; $__LIST__ = $val;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>[<?php echo ($vo["time"]); ?>]&nbsp;&nbsp;&nbsp;<?php echo ($vo["content"]); ?></li>
   					
					<!-- Add line -->
					<li><div>
					<div class="up"></div>
					<div class="box"><div class="box1"></div></div>
					<div class="up"></div>
					</div></li>
					<!-- Add line --><?php endforeach; endif; else: echo "" ;endif; ?>
            <li style="color:#003300">【物流<?php echo ($counts-$k+1); ?>】</li><?php endforeach; endif; else: echo "" ;endif; ?>
		 	<li style="color:#003300">卖家已发货</li>
		</ul>
		<p>信息来源：<font color="#3366FF"><?php echo ($wl); ?></font>,运单号：<font color="#006600"><?php echo ($freecode); ?></font></p>
		</div>	
		<?php else: ?>
		<h2>尚未有物流动态~~~</h2><?php endif; ?>			 
		 </div>  
		        
		</div>
      
		
        </div>
      <!--  <a data-height="130" data-width="400" data-id="add" data-title="添加收货地址" data-uri="/index.php?g=admin&amp;m=address&amp;a=add" href="javascript:void(0);" class="add fb J_showdialog"><em>添加收货地址</em></a>-->
      
		<div class="mt10" style="text-align:center; margin-bottom:20px;">
		  <?php switch($info["status"]): case "1": ?><!-- 待付款-->
                <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>2));?>">	<input type="button" value="设为已付款" id="dosubmit" name="dosubmit" class="btn btn_submit" ></a><?php break;?>  
                <?php case "2": ?><!-- 待发货-->
					<?php if($itemcont != 0): ?><a data-height="130" data-width="650" data-id="add" data-title="发货管理" data-uri="<?php echo U('item_order/fahuo',array('id'=>$info['id']));?>" href="javascript:void(0);" class="add fb J_showdialog"><input type="button" value="发货" id="dosubmit" name="dosubmit" class="btn btn_submit" ></a>
							<?php else: ?>
							<input type="button" value="已全部发货" class="btn btn_submit" style="background:#666;"><?php endif; break;?>  
                <?php case "3": ?><!-- 待收货 -->
					<?php if($itemcont != 0): ?><a data-height="130" data-width="650" data-id="add" data-title="发货管理" data-uri="<?php echo U('item_order/fahuo',array('id'=>$info['id']));?>" href="javascript:void(0);" class="add fb J_showdialog"><input type="button" value="发货" id="dosubmit" name="dosubmit" class="btn btn_submit" ></a>
					<?php else: ?>
					   <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>4));?>" ><input type="button" value="设为已收货" id="dosubmit" name="dosubmit" class="btn btn_submit" ></a><?php endif; break;?>  
                  <?php case "6": ?><!-- 申请退款 -->
                  <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>7,'jifen'=>$itemtk['refund']));?>">
				  <input type="button" value="核实后不予退款" id="dosubmit" name="dosubmit" class="btn btn_submit" >
				  </a>
				   <a href="<?php echo U('item_order/status',array('orderId'=>$info['orderId'],'status'=>8,'jifen'=>$itemtk['refund']));?>">
				  <input type="button" value="核实后给予退款" id="dosubmit" name="dosubmit" class="btn btn_submit" >
				  </a><?php break;?>  
                <?php default: endswitch;?>
		
		
		<a href="<?php echo U('item_order/index');?>">  <input type="button"  value=" 返回列表 " class="btn btn_cannel"></a></div>
	</div>
</div>
<input type="hidden" name="menuid"  value="<?php echo ($menuid); ?>"/>
<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
</form>
<script src="__STATIC__/js/jquery/jquery.js"></script>
<script src="__STATIC__/js/jquery/plugins/jquery.tools.min.js"></script>
<script src="__STATIC__/js/jquery/plugins/formvalidator.js"></script>
<script src="__STATIC__/js/pinphp.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>

<?php if(isset($list_table)): ?><script src="__STATIC__/js/jquery/plugins/listTable.js"></script>
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?>


</body>
</html>
<script src="__STATIC__/js/jquery/plugins/colorpicker.js"></script>
<script src="__STATIC__/js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
$(function(){
	$(".divtab a").click(function(){
		$(this).addClass("on").siblings("a").removeClass("on");
		$(".main").eq($(".divtab a").index(this)).show().siblings(".main").hide();
	})

})

//更改配送快递

    $("#userfree").blur(function(){
        var pre_userfree = '<?php echo ($info["userfree"]); ?>';//原来的配送快递 
        var orderid = $(this).attr("data-id");
        var _value = $(this).val();
        
        if(pre_userfree !='' && pre_userfree != _value){
            $.ajax({
                type: "POST",
                url: "<?php echo U('item_order/change_userfree');?>",
                data: {orderid:orderid,userfree:_value},
                dataType:"json",
                success: function(datas){
                    if(datas){
                        location.reload();
                    }
                }
            });
        }

    });



//更改快递单号
    $("#kuaidi").blur(function(){
        var pre_freecode = '<?php echo ($info["freecode"]); ?>';//原来快递单号 
        var orderid = $(this).attr("data-id");
        var _value = $(this).val();
        
        if(pre_freecode !='' && pre_freecode != _value){
            $.ajax({
                type: "POST",
                url: "<?php echo U('item_order/change_express');?>",
                data: {orderid:orderid,freecode:_value},
                dataType:"json",
                success: function(datas){
                    if(datas){
                        location.reload();
                    }
                }
            });
        }

    });
	
//更改物流包裹信息 
    $("#kuaidi_desc").blur(function(){
        var pre_desc = '<?php echo ($info["kuaidi_desc"]); ?>';//原来的包裹信息 
        var orderid = $(this).attr("data-id");
        var _value = $(this).val();
       // alert(_value);
        if(pre_desc !='' && pre_desc != _value){
            $.ajax({
                type: "POST",
                url: "<?php echo U('item_order/change_kuaidi_desc');?>",
                data: {orderid:orderid,kuaidi_desc:_value},
                dataType:"json",
                success: function(datas){
                    if(datas){
                        location.reload();
                    }
                }
            });
        }

    });
	
	function free_info(url,name){
			layer.open({
			type:2,
			title:name,
			shadeClose:true,
			shade:0.8,
			area:['900px','80%'],
			content:url
		});
	}
	
	function itemedit(url,name){
			layer.open({
			type:2,
			title:name,
			shadeClose:true,
			shade:0.8,
			area:['700px','30%'],
			content:url,
			cancel: function(index){
				location.reload();
			}
		});
	}
</script>
<script>
	$(document).ready(function(){ 
		//限制字符个数 
		$("#detailTitle").each(function(){ 
			var maxwidth=30; 
			if($(this).text().length>maxwidth){
				 $(this).text($(this).text().substring(0,maxwidth)); 
				 $(this).html($(this).html()+'...'); 
			} 
		}); 
	});
</script>