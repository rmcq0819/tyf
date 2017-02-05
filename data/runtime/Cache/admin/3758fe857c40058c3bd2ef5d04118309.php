<?php if (!defined('THINK_PATH')) exit();?><!--<!doctype html>
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
</div><?php endif; ?>-->

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
</head>
<body>

 <table width="100%"  class="table_form" cellspacing="0">
    <form id="info_form" action="<?php echo u('setting/edit');?>" method="post" enctype="multipart/form-data">
     <tr>
            <th width="150">1.</th>
            <td>先填写微信AppId和微信AppSecret（这个2个值需要到微信公众平台获取）</td>
        </tr>
         <tr>
            <th width="150">2.</th>
            <td>按钮数最多只能创建3个，子按钮数最多创建5个，否则创建失败!</td>
        </tr>
         <tr>
            <th width="150">3.</th>
            <td>关键词需于《关键词自动回复》里的关键词对应,KEY值用字母或数字组成</td>
        </tr>
         <tr>
            <th width="150">微信AppId：</th>
            <td><input type="text" name="setting[appid]" class="input-text" size="50" value="<?php echo C('pin_appid');?>"></td>
        </tr>
        <tr>
            <th>微信AppSecret：</th>
            <td><input type="text" name="setting[appsecret]" class="input-text" size="50" value="<?php echo C('pin_appsecret');?>"></td>
        </tr>
     <tr>
        	<th></th>
        	<td><input type="submit" class="btn btn_submit" value="<?php echo L('submit');?>"/></td>
    	</tr>
    	</form>
    </table>

<div id="J_ajax_loading" class="ajax_loading"><?php echo L('ajax_loading');?></div>
<?php if(($sub_menu != '') OR ($big_menu != '')): ?><div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<?php if(!empty($big_menu)): ?><a class="add fb J_showdialog" href="javascript:void(0);" data-uri="<?php echo ($big_menu["iframe"]); ?>" data-title="<?php echo ($big_menu["title"]); ?>" data-id="<?php echo ($big_menu["id"]); ?>" data-width="<?php echo ($big_menu["width"]); ?>" data-height="<?php echo ($big_menu["height"]); ?>"><em><?php echo ($big_menu["title"]); ?></em></a>　<?php endif; ?>
        <?php if(!empty($sub_menu)): if(is_array($sub_menu)): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key; if($key != 1): ?><span>|</span><?php endif; ?>
        <a href="<?php echo U($val['module_name'].'/'.$val['action_name'],array('menuid'=>$menuid)); echo ($val["data"]); ?>" class="<?php echo ($val["class"]); ?>"><em><?php echo L($val['name']);?></em></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
</div><?php endif; ?>



<!--栏目列表-->
<div class="pad_lr_10">
    <div class="J_tablelist table_list" data-acturi="<?php echo U('custom_menu/ajax_edit');?>">
    <table width="100%" cellspacing="0" id="J_cate_tree">
        <thead>
            <tr>
                <th width="30"><input type="checkbox" name="checkall" class="J_checkall"></th>
                <th width="30"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th>菜单名称</th>
                <th>链接</th>
                <th>关键词</th>
             <!--   <th width="80"><?php echo L('item_cate_type');?></th>-->
              	<th width="60"><span data-tdtype="order_by" data-field="ordid"><?php echo L('sort_order');?></span></th>
               
				<th width="60"><span data-tdtype="order_by" data-field="status"><?php echo L('status');?></span></th>
                <th width="180"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
    	<tbody>
        <?php echo ($list); ?>
    	</tbody>
    	<tr>
    	<td colspan="8"><a  onclick="creat()" ><input type="button" class="btn btn_submit" value="生成菜单"/></a></td>
    	</tr>
    </table>
    <script>
    function creat()
    {
    	if(confirm('是否创建自定义菜单'))
    	{
    		location.href="/index.php?g=admin&m=custom_menu&a=creat_custom_menu";
    	}
    }
    </script>
    </div>
    <div class="btn_wrap_fixed">
        <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn btn_submit" data-tdtype="batch_action" data-acttype="ajax_form" data-id="move" data-uri="<?php echo U('custom_menu/move');?>" data-name="id" data-title="<?php echo L('item_cate_move');?>" value="<?php echo L('move');?>" /> 
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('custom_menu/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
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
<script src="__STATIC__/js/jquery/plugins/jquery.treetable.js"></script>
<script>
$(function(){
    //initialState:'expanded'
    $("#J_cate_tree").treeTable({indent:20,treeColumn:2});
    $(".J_preview").preview();
});        
</script> 
</body>
</html>