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
    
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                     <form action="<?php echo U('xiaoshou_list/excelout');?>" method="post"><input type="submit" class="btn" style="float:right;" value="导出数据"> </form>
                    <form name="searchform" method="get" >
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="xiaoshou_list" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                    &nbsp;关键字 :
                    <input name="keyword" type="text" class="input-text" size="25" value="<?php echo ($keyword); ?>" />
                    下单时间 :
                    <input type="text" name="time[time_start]" id="J_time_start" class="date" size="12" value="<?php echo ($search["time_start"]); ?>">
                    -
                    <input type="text" name="time[time_end]" id="J_time_end" class="date" size="12" value="<?php echo ($search["time_end"]); ?>">
                    <input type="submit" name="search" class="btn" value="搜索" />
                    </form> 

                </div>
                </td>
            </tr>
        </tbody>

    </table>
      

    <div class="J_tablelist table_list" data-acturi="<?php echo U('user/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="40"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="150" align="left"><span data-tdtype="order_by" data-field="title">商品名称</span></th>
                <th width="100"align="left"><span data-tdtype="order_by" data-field="orderId">订单号</span></th>
                <th width="50" align="left"><span data-tdtype="order_by" data-field="quantity">数量</span></th>
                <th width="30"><span data-tdtype="order_by" data-field="price">售价</span></th>
                <!-- <th width="60" align="right"><span data-tdtype="order_by" data-field="shares">分享</span></th>
                <th width="60" align="right"><span data-tdtype="order_by" data-field="albums">专辑</span></th>-->
                <th width="60"><span data-tdtype="order_by" data-field="order_count">总价</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="support_time">付款时间</span></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="left"><?php echo ($val["title"]); ?></td>
                <td align="left"><?php echo ($val['orderId']); ?></td>
                <td align="left"><?php echo ($val["quantity"]); ?></td>
                <td align="center">
                    <?php echo ($val["price"]); ?>
                </td>
                <td align="center"><?php echo ($val['quantity']*$val['price']); ?></td>
               <td align="center"><?php echo (date("Y-m-d H:i:s",$val['add_time'])); ?></td>
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
<script type="text/javascript">
    Calendar.setup({
        inputField: "J_time_start",
        ifFormat: "%Y-%m-%d",
        showsTime: false,
        timeFormat: "24"
    });
    Calendar.setup({
        inputField: "J_time_end",
        ifFormat: "%Y-%m-%d",
        showsTime: false,
        timeFormat: "24"
    });
</script>