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
<script src="__STATIC__/js/jquery.zclip.min.js"></script>
<style type="text/css">
.input_txt{border:1px solid #ccc;width:50%;text-align:center;font-weight:bold}
</style>
<script>
$(function(){
	$("input[name='buy_num']").blur(function(){
		var itemid = $(this).next("input").val();
		var buy_num = $(this).val();
		url = "./index.php?g=admin&m=item&a=buy_num";
		$.ajax({
			type:"get",
			url:url,
			data:"itemid="+itemid+"&buy_num="+buy_num,
			success:function(msg){
				if(msg!=1){
					return;
				}
			}
		});
	});
});
</script>


<!--商品列表-->
<div class="pad_lr_10" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col" style="height:110px;line-height: 30px;">
                        <form name="searchform" method="get" id="searchform"> 
                        <div style="float:left;width:100%;height:100%"> 
                        <input type="hidden" name="g" value="admin" />
                        <input type="hidden" name="m" value="item" />
                        <input type="hidden" name="a" value="index" />
                        <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
    					<?php if($sm != ''): ?><input type="hidden" name="sm" value="<?php echo ($sm); ?>" /><?php endif; ?>
                        发布时间 :
                        <input type="text" name="time_start" id="J_time_start" class="date" size="12" value="<?php echo ($search["time_start"]); ?>">
                        -
                        <input type="text" name="time_end" id="J_time_end" class="date" size="12" value="<?php echo ($search["time_end"]); ?>">

    					&nbsp;&nbsp;分类 :
                        <select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('item_cate/ajax_getchilds', array('type'=>0));?>" data-selected="<?php echo ($search["selected_ids"]); ?>"></select>
                        <input type="hidden" name="cate_id" id="J_cate_id" value="<?php echo ($search["cate_id"]); ?>" />
                      	&nbsp;&nbsp;是否上架 :  
                      	<select name="status" >
                      	<option value="">--所有--</option>
                      	<option <?php if($search["status"] == 1): ?>selected=''<?php endif; ?> value="1">上架</option>
                      	<option <?php if($search["status"] == 0): ?>selected=''<?php endif; ?> value="0">下架</option>
                      	</select>
                        &nbsp;&nbsp;商品类型 :  
                      	<select name="itemtype" >
                      	<option value="">--所有--</option>
                      	<option <?php if($search["itemtype"] == 1): ?>selected=''<?php endif; ?> value="1">完税</option>
                      	<option <?php if($search["itemtype"] == 0): ?>selected=''<?php endif; ?> value="0">保税</option>
                      	</select>
                        &nbsp;&nbsp;首页展示 :  
                        <select name="home" >
                        <option value="">--所有--</option>
                        <option <?php if($search["home"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["home"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
                        </select>
						 &nbsp;&nbsp;新品推荐 :  
                        <select name="zhuangui" >
                        <option value="">--所有--</option>
                        <option <?php if($search["zhuangui"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["zhuangui"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
                        </select>
						 &nbsp;&nbsp;专题推荐 :  
                        <select name="zhuanti" >
                        <option value="">--所有--</option>
                        <option <?php if($search["zhuanti"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["zhuanti"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
                        </select>
						&nbsp;&nbsp;品牌 :  
                        <select name="brandId" >
                        <option value="">--所有--</option>
						<?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option <?php if($search["brandId"] == $vol['id']): ?>selected=''<?php endif; ?> value="<?php echo ($vol['id']); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
						<!--  &nbsp;&nbsp;单品活动 :  
                        <select name="activity" >
                        <option value="">--所有--</option>
                        <option <?php if($search["activity"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["activity"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
                        </select>
						 &nbsp;&nbsp;是否套餐 :  
                        <select name="is_combo" >
                        <option value="">--所有--</option>
                        <option <?php if($search["is_combo"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["is_combo"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
                        </select> --></br>
						是否回收 :  
                        <select name="is_delete" >
                        <option value="">--所有--</option>
                        <option <?php if($search["is_delete"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["is_delete"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
                        </select>
						
						是否参与砍价 :  
                        <select name="is_bargain" >
                        <option value="">--所有--</option>
                        <option <?php if($search["is_bargain"] == 1): ?>selected=''<?php endif; ?> value="1">是</option>
                        <option <?php if($search["is_bargain"] == 0): ?>selected=''<?php endif; ?> value="0">否</option>
                        </select>
                      <!--   <div class="bk8"></div> -->

                        价格区间 :
                        <input type="text" name="price_min" class="input-text" size="5" value="<?php echo ($search["price_min"]); ?>" />
                        -
                        <input type="text" name="price_max" class="input-text" size="5" value="<?php echo ($search["price_max"]); ?>" />
						
						
    					
                        &nbsp;&nbsp;关键字 :
                        <input name="keyword" type="text" class="input-text" size="25" value="<?php echo ($search["keyword"]); ?>" />
						SKU编码: <input name="sku_nember" type="text" class="input-text" size="25" value="<?php echo ($search["sku_nember"]); ?>" />
                        
						&nbsp;&nbsp; 选择免税仓 :
						<select name="itembase">
							<option value="">--所有--</option>   
							<?php if(is_array($item_base)): $i = 0; $__LIST__ = $item_base;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item_base): $mod = ($i % 2 );++$i; if($item_base["id"] == $_GET['itembase']): ?><option value="<?php echo ($item_base["id"]); ?>" selected><?php echo ($item_base["basename"]); ?></option>
										<?php else: ?>
										<option value="<?php echo ($item_base["id"]); ?>"><?php echo ($item_base["basename"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
						</select>
						
						
						
						<input type="submit" name="search" class="btn" value="搜索" />
    				</div>
                    </form>
                    <form action="<?php echo U('item/excelout');?>" method="post">
                        <div style="float:left;width:100%;height:100%"><input type="submit" class="btn" style="float:right;margin-top:0px;" value="导出数据"></div> 
                    </form> 
						<img src="<?php echo attach(get_thumb('example.png', ''), 'item');?>" width="32" onclick="window.open('http://yooopay.com/data/upload/item/example.png')">
						<span style="color:#555;">选择导入的Excel文件后缀应为‘.xls’,文件内容应与示例一致，示例图点击可放大查看</span>
					<form action="<?php echo U('item/ReadExcel');?>" method="post" enctype="multipart/form-data" style="float:right;">
					
						<input type="file" name="exin" style="width:160px;">
						<input type="submit" class="btn" value="导入数据">
					</form>
					<div style="clear:both;"></div>
                </div>
                </td>
            </tr>
        </tbody>
    </table>
  
    <?php if($sm == 'image'): ?><div class="J_tablelist item_imglist clearfix">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><div class="item fl">
            <label>
            <input type="checkbox" class="J_checkitem check" value="<?php echo ($val["id"]); ?>" />
            <div class="img clearfix"><img src="<?php echo attach(get_thumb($val['img'], '_m'), 'item');?>"></div>
            </label>
            <span class="line_x"><?php echo ($val["title"]); ?></span>
            <ul>
                <li><a class="J_tooltip btn_blue" title="<?php echo ($cate_list[$val['cate_id']]); ?>"><?php echo L('cate');?></a></li>
                <li><a class="J_tooltip btn_blue" title="<?php echo (($val["uname"])?($val["uname"]):L('item_no_author')); ?>"><?php echo L('author');?></a></li>
            </ul>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php else: ?>
    <div class="J_tablelist table_list" data-acturi="<?php echo U('item/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="3%"><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="3%"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="1%">&nbsp;</th>
                <th width="20%" align="left"><span data-tdtype="order_by" data-field="title">商品名称</span></th>
                <th width="10%" align="left"><span>SKU编码</span></th>
                <th width="5%"><span data-tdtype="order_by" data-field="buy_num">卖出数量</span></br><span onclick="location.href='<?php echo U('item/add_buynum');?>'" style="color:#189;">调整<span style="font-size:15px">↑</span></span></th>
                <th width="5%"><span data-tdtype="order_by" data-field="cate_id">分类</span></th>
				
                <th width="10%"><span data-tdtype="order_by" data-field="price">价格(元)</span></th>
				
                <th width="5%"><span data-tdtype="order_by" data-field="ordid"><?php echo L('sort_order');?></span></th>
                <th width="3%"><span data-tdtype="order_by" data-field="status">是否上架</span></th>
                <th width="10%"><span data-tdtype="order_by" data-field="status">库存数</span></th>
                <th width="10%"><span data-tdtype="order_by" data-field="add_time">发布时间</span></th>
				<th width="5%"><span data-tdtype="order_by" data-field="paynum">快捷操作</span></th>
                <th width="10%"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center">
                    <?php if(!empty($val['img'])): ?><div class="img_border"><img src="<?php echo attach(get_thumb($val['img'], '_s'), 'item');?>" width="32" width="32" class="J_preview" data-bimg="<?php echo attach($val['img'], 'item');?>"></div><?php endif; ?>
                </td>
                <td align="left">
					<span data-tdtype="edit" data-field="title" data-id="<?php echo ($val["id"]); ?>" class="tdedit" style="color:<?php echo ($val["colors"]); ?>;"><?php echo ($val["title"]); ?></span>
				</td>
				<td align="left">
					<span data-tdtype="edit" data-field="adress" data-id="<?php echo ($val["id"]); ?>" class="tdedit" style="word-break:normal; display:block; white-space:pre-wrap;word-wrap : break-word ;overflow: hidden ;width:80px;color:<?php echo ($val["colors"]); ?>;"><?php echo ($val["adress"]); ?></span>
				</td>
			   <td align="center"><b><input type="text" class="input_txt" name="buy_num" value="<?php echo ($val["buy_num"]); ?>" /><input type="hidden" name="id" value="<?php echo ($val["id"]); ?>" /></b></td>
			   <td align="center"><b><?php echo ($cate_list[$val['cate_id']]); ?></b></td>
               
                
                <td align="center" class="red"><?php echo ($val["price"]); ?></td> 
				
                <td align="center"><span data-tdtype="edit" data-field="ordid" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php echo ($val["ordid"]); ?></span></td>
                <td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="status" data-value="<?php echo ($val["status"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["status"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
                <td align="center"><?php if($val["goods_stock"] < 0): ?><b style="color:red">0</b><?php else: ?><span style="word-break:normal; display:block; white-space:pre-wrap;word-wrap : break-word ;overflow: hidden ;width:70px;"><?php echo ($val["goods_stock"]); ?></span><?php endif; if($val["is_stockjointly"] == 1): ?><span style="color:red">共库存</span><?php endif; ?></td>
                <td align="center"><?php echo (date('Y-m-d H:i:s',$val["add_time"])); ?></td>
				 <td align="center">
				 <?php  $newimg = substr($val['img'],0,strrpos($val['img'],'.')).'_b.jpg'; $url = 'http://yooopay.com/data/upload/item/'.$newimg.''; ?>
					<a href="javascript:;" onclick="copy_url('<?php echo $url; ?>')">图片</a> | <a href="index.php?g=admin&m=item_comment&a=add&id=<?php echo ($val["id"]); ?>" target="_blank">评论</a>
				 
				 </td>
                <td align="center"><a href="<?php echo u('item/edit', array('id'=>$val['id'], 'menuid'=>$menuid));?>" target="_blank"><?php echo L('edit');?></a> | 
				
				<?php if($val["is_delete"] == 1): ?><a href="javascript:void(0);" onclick="is_resume(this,<?php echo ($val["id"]); ?>,'<?php echo ($val["title"]); ?>')">恢复</a>
					<?php else: ?>
						<a href="javascript:void(0);" onclick="is_delete(this,<?php echo ($val["id"]); ?>,'<?php echo ($val["title"]); ?>')">回收</a><?php endif; ?>
				
				</td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    </div><?php endif; ?>
    <div class="btn_wrap_fixed">
        <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
     <!--    <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" /> -->
		<input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item/onShelves');?>" data-name="id" data-msg="确定一键上架？" value="一键上架" />
		<input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item/downShelves');?>" data-name="id" data-msg="确定一键下架？" value="一键下架" />
		<input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item/recycle');?>" data-name="id" data-msg="确定一键回收？" value="一键回收" />
		<input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item/resume');?>" data-name="id" data-msg="确定一键恢复？" value="一键恢复" />
	
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
$('.J_preview').preview(); //查看大图
$('.J_cate_select').cate_select({top_option:lang.all}); //分类联动
$('.J_tooltip[title]').tooltip({offset:[10, 2], effect:'slide'}).dynamic({bottom:{direction:'down', bounce:true}});


//是否回收
function is_delete(obj,id,title){
	layer.confirm('您确定要将【'+title+'】放进回收站吗？', {
		  title: '回收提示',
		  shade: 0,
		  btn: ['确定','取消'],
		  yes: function(index){
			layer.close(index);
			
			var url="<?php echo U('item/is_delete',array('id'=>'" + id + "'));?>";
			$.post(url,{id:id},function(data){
				alert(data);
			});
				
			$(obj).parent().parent().remove();
		  }
	});
}

//是否恢复
function is_resume(obj,id,title){
	layer.confirm('您确定要将【'+title+'】移出回收站吗？', {
		  title: '移出提示',
		  shade: 0,
		  btn: ['确定','取消'],
		  yes: function(index){
			layer.close(index);
			
			var url="<?php echo U('item/is_resume',array('id'=>'" + id + "'));?>";
			$.post(url,{id:id},function(data){
				alert(data);
			});
				
			$(obj).parent().parent().remove();
		  }
	});
}

function copy_url(url){
		layer.open({
		  type: 1,
		  area: ['600px', '120px'],
		  shadeClose: true, //点击遮罩关闭
		  shade:0,
		  content: '\<\div style="padding:20px;font-size:16px;">'+url+'\<\/div>'
		});
}
</script>
</body>
</html>