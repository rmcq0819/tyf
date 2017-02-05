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
<div class="pad_lr_10" style="margin-top:10px;">
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
            <td>
            <div class="explain_col">
            	<div class="content_menu ib_a blue line_x">
					<?php if($rcount == 0): ?><a class="on" id="order_up" style="background:#666;">
							<em  style="background:#666;">暂无符合条件的条目</em>
						</a>
						<?php else: ?>
						<a class="on" id="order_up">
							<em onclick="window.location.href='<?php echo U('remind/remind_exc');?>'">批量发起提醒 ( <?php echo ($rcount); ?> )</em>
						</a><?php endif; ?>
				  </div>
        	</div>
            </td>
            </tr>
        </tbody>
    </table>
    </form>

    <div class="J_tablelist table_list" data-acturi="<?php echo U('flag/ajax_edit');?>">
	<form name="myForm" method="post" action="./index.php?g=admin&m=remind&a=del_all" >
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="10%"><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="10%">id</th>
                <th width="10%">用户名称</th>
				<th width="15%">商品名称</th>
				<th width="10%">添加时间</th>
				<th width="10%">提醒时间</th>
                <th width="10%">是否提醒</th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center"><?php echo ($val["username"]); ?></td>
				<td align="center"><?php echo ($val["title"]); ?></td>
				<td align="center"><?php echo (date("Y-m-d H:i:s",$val["add_time"])); ?></td>
                <td align="center"><?php echo (date("Y-m-d H:i:s",$val["remind_time"])); ?></td>
                <td align="center"><?php if($val["is_remind"] == 1): ?><span style="color:blue;font-weight:bold;">是</span><?php else: ?><span style="color:red;font-weight:bold;">否</span><?php endif; ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>

    <div class="btn_wrap_fixed">
        <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn" onclick="document.myForm.submit();"  value="<?php echo L('delete');?>" />
        <div id="pages"><?php echo ($page); ?></div>
    </div>

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
$('.J_preview').preview(); //查看大图
</script>
</body>
</html>