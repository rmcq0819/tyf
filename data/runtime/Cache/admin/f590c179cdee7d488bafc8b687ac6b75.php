<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
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
<!--会员列表-->

<div class="pad_10" >
	<form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="user" />
                    <input type="hidden" name="a" value="lists" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                    &nbsp;关键字 :
                    <input name="keyword" type="text" class="input-text" size="25" value="<?php echo ($keyword); ?>" />
                    <input type="submit" name="search" class="btn" value="搜索" />
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
    <div class="J_tablelist table_list" data-acturi="<?php echo U('user_category/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="50"><span tdtype="order_by" fieldname="id">ID</span></th>
				<th width="100" align="center">会员名称</span></th>
                <th width="100" align="center"><span data-tdtype="order_by" data-field="name">开户银行</span></th>
                <th width="100" align="center"><span data-tdtype="order_by" data-field="discount">持卡人名</span></th>
                <th width="100" align="center"><span data-tdtype="order_by" data-field="score">银行卡号</span></th>
				<th width="100" align="center">联系方式</span></th>
                <th width="130"><span data-tdtype="order_by" data-field="add_time">申请时间</span></th>
				<th width="100" align="center"><span data-tdtype="order_by" data-field="ordid">提现金额</span></th>
                <th width="100"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><?php echo ($val["id"]); ?></td>
				<td align="center"><a href="<?php echo U('user/index',array('keyword'=>$val['username']));?>"><?php echo ($val["username"]); ?></a></td>
                <td align="center"><?php echo ($val["bank"]); ?></td>
                <td align="center"><?php echo ($val["huming"]); ?></td>
                <td align="center"><?php echo ($val["zhanghao"]); ?></td>
				<td align="center"><?php echo ($val["phone_mob"]); ?></td>
				<td align="center"><?php echo (date("Y-m-d",$val["add_time"])); ?></td>
				<td align="center"><?php echo ($val["fencheng"]); ?></td>
                <td align="center">
					<a href="<?php echo u('user/index', array('id'=>$val['uid']));?>">查看</a>&nbsp;|&nbsp;
					<?php if($val["state"] == 2): ?><a href="<?php echo u('user/quer', array('id'=>$val['id'], 'menuid'=>$menuid));?>">确认</a><?php endif; ?>
					&nbsp;|&nbsp;
					<a href="javascript:void(0);" class="J_confirmurl" data-uri="<?php echo u('Fenchenglist/delete', array('id'=>$val['id']));?> data-acttype="ajax" data-msg="<?php echo sprintf(L('confirm_delete_one'),这条申请记录);?>"><?php echo L('delete');?></a>
				</td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    <div class="btn_wrap_fixed">
        <div id="pages"><?php echo ($page); ?></div>
    </div>
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
</body>
</html>
<link rel="stylesheet" type="text/css" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script type="text/javascript" src="__STATIC__/js/calendar/calendar.js"></script>