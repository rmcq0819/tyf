<?php if (!defined('THINK_PATH')) exit();?><!--添加禁止IP-->


<div class="dialog_content">
	<form id="info_form" name="info_form" action="<?php echo u('item_order/fahuo');?>" method="post">
	<input type="hidden" value="<?php echo ($info["orderId"]); ?>" name="orderId"  />
	<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
		<tr>
			<th width="100"><span class="red">*</span>快递方式：</th>
			<td><select name="delivery" id="delivery">
			    <option value="">--请选择--</option>
			     <?php if(is_array($deliveryList)): $i = 0; $__LIST__ = $deliveryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			     <option value="0">--无需物流--</option>
			</select></td>
		</tr>
	     <tr id="deliverycode" name='deliverycode' style="display:none;" >
			<th width="100">快递编号：</th>
			<td><input type="text" name="deliverycode" id="deliverycode" class="input-text"></td>
		</tr>
		<tr>
			<th width="100"><span class="red">*</span>选择商品：</th>
			<td>
			<select name="itemlist">
			    <option value="">--请选择--</option>
			     <?php if(is_array($itemlist)): $i = 0; $__LIST__ = $itemlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			     <option value="0">--全部发货--</option>
			</select></td>
		</tr>
		<tr>
			<th width="100">发货地址：</th>
			<td>
			<?php if(is_array($addressList)): $i = 0; $__LIST__ = $addressList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input <?php if($vo["isno"] == 1): ?>checked=""<?php endif; ?>  type="radio" name="address" id="address" value="<?php echo ($vo["id"]); ?>" class="input-text"><?php echo ($vo["contacts"]); ?>（<?php echo ($vo["mobile"]); ?>）<?php echo ($vo["Province"]); echo ($vo["City"]); echo ($vo["Area"]); echo ($vo["address"]); ?>（邮编：<?php if($vo["postcode"] == ''): ?>-<?php else: echo ($vo["postcode"]); endif; ?>） <br><?php endforeach; endif; else: echo "" ;endif; ?>
			</td>
		</tr>
		
	 
		
		
	</table>
	</form>
</div>
<script>
var check_name_url = "<?php echo U('address/ajax_check_name');?>";
$(function(){
	
	 $('#delivery').change(function(){
	 
        	  if($(this).val()!=''&&$(this).val()!=0)
        	  {
        	  	$('#deliverycode').show();
        	  }else
        	  {
        	  		$('#deliverycode').hide();
        	  }
        });
	
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	/*$("#name").formValidator({onshow:lang.please_input+'名称',onfocus:lang.please_input+'名称'}).inputValidator({min:1,onerror:lang.please_input+'名称'}).ajaxValidator({
	    type : "get",
		url : check_name_url,
		datatype : "json",
		async:'false',
		success : function(result){	
            if(result.status == 0){
                return false;
			}else{
                return true;
			}
		},
		onerror : '名称已存在',
		onwait : lang.connecting_please_wait
	});
	*/
	
	$("#delivery").formValidator({onshow:'请选择快递方式',onfocus:'请选择快递方式'}).inputValidator({min:1,onerror:'请选择快递方式'});
	$('#info_form').ajaxForm({success:complate,dataType:'json'});
	function complate(result){
		if(result.status == 1){
			$.dialog.get(result.dialog).close();
			$.pinphp.tip({content:result.msg});
			window.location.reload();
		} else {
			$.pinphp.tip({content:result.msg, icon:'alert'});
		}
	}
});
</script>