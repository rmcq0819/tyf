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
                    <form action="<?php echo U('user_tj/excelout');?>" method="post"><input type="submit" class="btn" style="float:right;" value="导出数据"> </form>
                     <form name="searchform" method="get" >
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="user_tj" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                    &nbsp;关键字 :
                    <input name="keyword" type="text" class="input-text" size="25" value="<?php echo ($keyword); ?>" />
                    时间 :
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
                <th width="40" align="center"><span data-tdtype="order_by" data-field="img">头像</span></th>
                <th width="80" align="left"><span data-tdtype="order_by" data-field="username">用户名</span></th>
                <th width="80" align="left"><span data-tdtype="order_by" data-field="uid">会员组</span></th>
                <th width="100"align="left"><span data-tdtype="order_by" data-field="wechatid">手机号码</span></th>
                <th width="100" align="left"><span data-tdtype="order_by" data-field="email">邮箱</span></th>
                <th width="30"><span data-tdtype="order_by" data-field="sex">性别</span></th>
                <!-- <th width="60" align="right"><span data-tdtype="order_by" data-field="shares">分享</span></th>
                <th width="60" align="right"><span data-tdtype="order_by" data-field="albums">专辑</span></th>-->
                <th width="60"><span data-tdtype="order_by" data-field="order_count">订单数量</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="order_sumPrice">订单总金额</span></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center">
				<?php if($val["hyimg"] != ''): ?><img src="<?php echo ($val["hyimg"]); ?>" style="width:100px;height:100px;" /><?php else: ?><img src="<?php echo ($val["cover"]); ?>" style="width:100px;height:100px;" /><?php endif; ?>
				</td>
                <td align="left"><?php if($val['username']): echo ($val['username']); else: echo ($val['wechatid']); endif; ?></td>
				 <td align="left"><?php if($val['uid'] == 2): ?>掌柜<?php else: ?>店长<?php endif; ?></td>
                <td align="left"><?php if($val['phone_mob']): echo ($val['phone_mob']); else: ?>无<?php endif; ?></td>
                <td align="left"><?php if($val['email']): echo ($val["email"]); else: ?>无<?php endif; ?></td>
                <td align="center">
                  <?php if($val['gender'] == '1'): ?>男<?php endif; ?>
                  <?php if($val['gender'] == '0'): ?>女<?php endif; ?>
                </td>
                <td align="center"><?php echo ($val['order_count']); ?></td>
               <td align="center"><?php echo ($val['order_sumPrice']); ?></td>
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