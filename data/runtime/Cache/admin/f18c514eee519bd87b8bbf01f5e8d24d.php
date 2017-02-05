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
<script src="__STATIC__/layer/layer.js"></script>
<!--订单列表-->
<div class="subnav">
	
	  <div class="content_menu ib_a blue line_x">
		 <?php if($confirm_count <= 0): ?><a class="on" style="background:#666;">
				<em style="background:#666;">自动确认收货&nbsp(<?php echo ($confirm_count); ?>)</em>
			</a>
			<?php else: ?>
			 <a class="on" id="order_up">
				<em>自动确认收货&nbsp(<?php echo ($confirm_count); ?>)</em>
			</a><?php endif; ?>
	  </div>
	
</div>
<div class="pad_lr_10" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div style="margin-top:-10px;">
                <div class="explain_col" style="height:60px;line-height:32px;">
                  <form name="searchform" method="get" >
                    <div style="float:left;width:80%;height:100%">  
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="item_order" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                     订单编号 :
                    <input name="orderId" type="text" class="input-text" size="25" value="<?php echo ($search["orderId"]); ?>" />
                   &nbsp;&nbsp; 店铺名称 :
                    <input name="merchant" type="text" class="input-text" size="25" value="<?php echo ($search["merchant"]); ?>" />
					&nbsp;&nbsp; 收货人姓名 :
                    <input name="goods_person" type="text" class="input-text" size="25" value="<?php echo ($search["goods_person"]); ?>" />
                    &nbsp;&nbsp; 订单状态 :
                    <select name="status">
                    <option value="">--所有--</option>
                   <?php foreach($order_status as $key=>$item){ ?>
                   <option <?php if($search['status']==$key) echo "selected=''"; ?> value="<?php echo $key; ?>"><?php echo $item; ?></option>
                    <?php } ?>
                    
                    </select>

                    
                    &nbsp;&nbsp;是否提醒发货 :                  
					<select name="is_urgent" >
                        <option >--所有--</option>
                        <option <?php if($search["is_urgent"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["is_urgent"] == 3): ?>selected=''<?php endif; ?> value="3">否</option>
                    </select>
					</br>
                    订单价格区间 :
                    <input type="text" name="price_min" class="input-text" size="5" value="<?php echo ($search["price_min"]); ?>" />
                    -
                    <input type="text" name="price_max" class="input-text" size="5" value="<?php echo ($search["price_max"]); ?>" />
					
					&nbsp;&nbsp; 选择免税仓 :
                    <select name="itembase">
						<option value="0">--所有--</option>   
						<?php if(is_array($item_base)): $i = 0; $__LIST__ = $item_base;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item_base): $mod = ($i % 2 );++$i; if($item_base["id"] == $_GET['itembase']): ?><option value="<?php echo ($item_base["id"]); ?>" selected><?php echo ($item_base["basename"]); ?></option>
									<?php else: ?>
									<option value="<?php echo ($item_base["id"]); ?>"><?php echo ($item_base["basename"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
                    </select>
					<?php if($sm != ''): ?><input type="hidden" name="sm" value="<?php echo ($sm); ?>" /><?php endif; ?>
                    下单时间 :
                    <input type="text" name="time_start" id="J_time_start" class="date" size="12" value="<?php echo ($search["time_start"]); ?>">
                    -
                    <input type="text" name="time_end" id="J_time_end" class="date" size="12" value="<?php echo ($search["time_end"]); ?>">
                    付款时间 :
                    <input type="text" name="start_support_time" id="J_time_start_support" class="date" size="12" value="<?php echo ($search["start_support_time"]); ?>">
                    -
                    <input type="text" name="end_support_time" id="J_time_end_support" class="date" size="12" value="<?php echo ($search["end_support_time"]); ?>">
                   
					&nbsp;&nbsp;快递类型 :
					<input type="checkbox" name="freetype" value="10">顺丰速递&nbsp;&nbsp; 未发完货 :
					<input type="checkbox" name="is_finish" value="1">
                    &nbsp;&nbsp;<input type="submit" name="search" class="btn" value="搜索" />
                  </div>
				  
				 
                  </form>

                  <form action="<?php echo U('item_order/excelout');?>" method="post">
                      <div style="float:left;width:20%;height:100%"><input type="submit" class="btn" style="float:right;margin-top:15px;" value="导出数据"> </div>
                  </form>
                </div>
                </td>
            </tr>
        </tbody>
      
         
    </table>
    
  
    <div class="J_tablelist table_list" data-acturi="<?php echo U('item/ajax_edit');?>">
	<form name="myForm" method="post" action="./index.php?g=admin&m=item_order&a=batchprint">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="100"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="100"><span data-tdtype="order_by" data-field="orderId">订单编号&状态</span></th>
                <th width="70"><span data-tdtype="order_by" data-field="order_sumPrice">订单金额</span></th>
                <th width="60">收货人&电话&快递类型</span></th>
				
				<th width="100"><span>所属分享店铺</span></th>
                <th width="40"><span data-tdtype="order_by" data-field="add_time">下单&付款时间 </span></th>
                <th width="70">催货状态</span></th>
				<th width="80"><?php echo L('operations_manage');?></th>
				
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if($val["id"] != ''): ?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center"><a href="<?php echo u('item_order/edit', array('id'=>$val['id'], 'menuid'=>$menuid));?>"> <?php if($val["op"] == 1): ?><span style="color:red;font-weight:bold;">(待处理)</span><?php endif; echo ($val["orderId"]); ?></a><br> 
               <?php if($val["sellerRemark"] != ''): ?><a title="【客服备注】<?php echo ($val["sellerRemark"]); ?>">
                <img src="__STATIC__/images/remark.gif" >
               </a><?php endif; ?>
					<?php switch($val["status"]): case "1": ?>待付款<?php break;?>
                         <?php case "2": ?>待发货<?php break;?>
                         <?php case "3": ?>待收货<?php break;?>
                         <?php case "4": if(($val["c_status"]) == "0"): ?>待评论<?php else: ?>已完成<?php endif; break;?>
                         <?php case "6": ?>退货中<?php break;?>
						 <?php case "7": ?>退款失败<?php break;?>
						 <?php case "11": ?>退款中<?php break;?>
                         <?php case "9": ?>待收货&nbsp;(清关中)<?php break;?>
						 <?php case "10": ?>异常订单<?php break;?>
						 <?php case "8": ?>退款成功<?php break;?>
                        <?php default: ?><font color="red">关闭</font><?php endswitch;?>
					   <?php if($val["is_finish"] != 0): ?><span style="color:indianred;font-weight:bold;">[还有未发完的货物]</span><?php endif; ?>
					   <?php if($val["app"] == 1): ?><span style="color:blue;font-weight:bold;">(通过App下单)</span><?php endif; ?>
					   
                 </td>
               <td align="center"><b style="color:red">¥<?php echo ($val["sigsumprice"]); ?></b></td>
                <td align="center"><?php echo ($val["address_name"]); ?>(<?php echo ($val["userName"]); ?>)<br><?php echo ($val["mobile"]); ?><br>
				<?php if($val["freetype"] == 10): ?><b style="color:red">买家要求发顺丰速运</b><?php else: ?>商家指定<?php endif; ?>
				</td>
				
               
				<td align="center"><font color="red"><?php echo ($val["merchant"]); ?></font></td>
                <td align="center"><?php echo (date('Y-m-d H:i:s',$val["add_time"])); ?><br><?php if(!empty($val["support_time"])): echo (date('Y-m-d H:i:s',$val["support_time"])); else: ?>待付款
				
				<?php if($val["is_pay"] == 1): ?><span style="color:#ff0000;">已提醒</span>
				<?php else: ?>
					<a href="javascript:;" onclick="is_pay(<?php echo ($val["id"]); ?>,'<?php echo ($val["userName"]); ?>')" style="color:#3A6DA4;">提醒付款</a><?php endif; endif; ?></td>
                <td align="center"><?php if($val["is_urgent"] == 1): ?><span style="color:red">已催促发货</span><?php endif; ?></td>
				<td align="center"><a href="<?php echo u('item_order/edit', array('id'=>$val['id'], 'menuid'=>$menuid));?>">查看</a>| <a href="javascript:void(0);" class="J_confirmurl" data-uri="<?php echo u('item_order/delete_order', array('id'=>$val['id']));?>" data-acttype="ajax" data-msg="<?php echo sprintf(L('confirm_delete_one'),$val['orderId']);?>"><?php echo L('delete');?></a> 
			    <!--| <a href="<?php echo u('item_order/print_kdd', array('order_id'=>$val['id']));?>" title="快递单打印" target="_blank"><img src="__STATIC__/images/admin/wuliu.png" width="18" /></a>-->
				</td>
				
            </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    </div>
		<script>
			//是否恢复
				function is_pay(id,username){
					layer.confirm('您确定要给【'+username+'】发送未付款提醒吗？', {
						  title: '发送未付款提醒',
						  shade: 0,
						  btn: ['确定','取消'],
						  yes: function(index){
							layer.close(index);
							window.location.href = "<?php echo U('item_order/is_pay',array('id'=>'" + id + "'));?>";
						  }
					});
				}
		
		</script>
    <div class="btn_wrap_fixed">
      <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item_order/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
       <!-- 批量打印S -->
		<input type="submit" class="btn" onclick="this.form.target = '_blank'" value="批量打印订单"/>
		<!-- 批量打印E -->
		</form>
		<div id="pages"><?php echo ($page); ?></div>
    </div>
</div>
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
<link rel="stylesheet" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script src="__STATIC__/js/calendar/calendar.js"></script>
<script>
Calendar.setup({
	inputField : "J_time_start",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_end",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_start_support",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_end_support",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
$('#order_up').click(function(){
   var url ="<?php echo U('item_order/update_order');?>";
   var rand = "<?php echo ($rand); ?>";
   $.post(url,{rand:rand},function(data){
      alert(data.msg);
   },'json')
})
$('.J_preview').preview(); //查看大图
$('.J_cate_select').cate_select({top_option:lang.all}); //分类联动
$('.J_tooltip[title]').tooltip({offset:[10, 2], effect:'slide'}).dynamic({bottom:{direction:'down', bounce:true}});
</script>
</body>
</html>