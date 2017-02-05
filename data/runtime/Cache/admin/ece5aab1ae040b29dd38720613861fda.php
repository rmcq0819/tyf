<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
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
<div class="subnav">
    <h1 class="title_2 line_x">分成配置</h1>
</div>

<div class="pad_lr_10">
<form id="info_form" action="<?php echo U('Fencheng/index');?>" method="post">
	<table width="100%" class="table_form">
        <tr>
            <td>
				开启分成机制 :
                <label class="mr10"><input type="radio" class="J_change_status" <?php if(($status) == "0"): ?>checked="checked"<?php endif; ?> value="0" name="status">开启</label>
                <label><input type="radio" class="J_change_status" <?php if(($status) == "1"): ?>checked="checked"<?php endif; ?> value="1" name="status">关闭</label>
				<span style="margin-left:15px"><input type="submit" class="btn btn_submit" value="确认"/></span>
			</td>
        </tr> 
	</table>
	</form>
</div>
<!--分成设置-->
<form id="info_form" action="<?php echo U('Fencheng/index');?>" method="post">
 <div class="content_list pad_10">
	<table width="100%" cellpadding="2" cellspacing="1" class="table_form" id="item_attr">
		<tbody class="add_item_attr">
			<tr>
				<td style="color:red;font-size:14px">购物分销设置</td>
			</tr>


			<tr>
				<td style="color:#0066ff;font-size:14px">掌柜及上级分销设置</td>
			</tr>
			<tr>
				<?php if(is_array($zhanggui)): $i = 0; $__LIST__ = $zhanggui;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td> 
					<span><?php echo ($list[$i+1]); ?></span>分成率:<input type="text" name="zhanggui[<?php echo ($i); ?>]" class="input-text" value="<?php echo ($vo); ?>" size="20">
				</td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tr>


			<tr>
				<td style="color:#0066ff;font-size:14px">店长及上级分销设置</td>
			</tr>
			<tr>
				<?php if(is_array($dianzhang)): $i = 0; $__LIST__ = $dianzhang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
						<span><?php echo ($list[$i]); ?></span>分成率:<input type="text" name="dianzhang[<?php echo ($i); ?>]" class="input-text" value="<?php echo ($vo); ?>" size="20">
					</td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tr>


			<tr>
				<td style="color:#0066ff;font-size:14px">经纪人及上级掌柜分销设置</td>
			</tr>
			<tr>
				<?php if(is_array($jingjiren1)): $i = 0; $__LIST__ = $jingjiren1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
						<span><?php if($list[$i-1] != '店长'): echo ($list[$i-1]); else: ?>掌柜<?php endif; ?></span>分成率:<input type="text" name="jingjiren1[<?php echo ($i); ?>]" class="input-text" value="<?php echo ($vo); ?>" size="20">
					</td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tr>


			<tr>
				<td style="color:#0066ff;font-size:14px">经纪人及上级店长分销设置</td>
			</tr>
			<tr>
				<?php if(is_array($jingjiren2)): $i = 0; $__LIST__ = $jingjiren2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
						<span><?php echo ($list[$i-1]); ?></span>分成率:<input type="text" name="jingjiren2[<?php echo ($i); ?>]" class="input-text" value="<?php echo ($vo); ?>" size="20">
					</td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tr>





			<tr>
				<td style="color:red;font-size:14px">推荐分销设置</td>
			</tr>
			<tr>	
			<?php if(is_array($lv1)): $i = 0; $__LIST__ = $lv1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><td> 
						<span><?php echo ($list1[$i-1]); ?></span>推荐奖:<input type="text" name="fencheng1[<?php echo ($i); ?>]" class="input-text" value="<?php echo ($vo1); ?>" size="20">
					</td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tr>
		</tbody>
	</table>
	
	<div style="width:100%;margin-left:2%;">
		<input type="submit" value="保存" id="dosubmit" name="dosubmit" class="btn btn_submit" />
	</div>
</div>
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

<script>
var i='<?php echo ($i); ?>';
function add_file()
{
    $("#next_upload_file tr").clone().insertAfter("#next_upload_file tr:last");
}
function del_file_box(obj)
{
	$(obj).parent().parent().remove();
}
function add_attr()
{	
	i++;
	var html;
	html='<table id="hidden_attr">';
	html+='<tbody class="add_item_attr">';
	html+='<tr>';
	html+='<td>'+i+'級分成率<input type="text" name="fencheng['+i+']" class="input-text" size="30">';
	html+='<a href="javascript:void(0);" class="blue" onclick="del_attr(this);">';
	html+='<img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" />';
	html+='</a></td>';
	html+='</tr>';
	html+='</tbody>';
    html+='</table>';
    $(html).clone().insertAfter($("#item_attr .add_item_attr:last"));
}
function del_attr(obj)
{
	i--;
	$(obj).parent().parent().remove();
}

</script>

</body>
</html>