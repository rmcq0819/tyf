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
<!--会员列表-->
<div class="pad_10" >
       
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <form name="searchform" method="get" >
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="Fenchenglist" />
                    <input type="hidden" name="a" value="search" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                     订单编号 :
                    <input name="orderId" type="text" class="input-text" size="25" value="<?php echo ($data["orderId"]); ?>" />
                   &nbsp;&nbsp; 会员名 :
                    <input name="userName" type="text" class="input-text" size="25" value="<?php echo ($data["userName"]); ?>" />
                    <?php if($sm != ''): ?><input type="hidden" name="sm" value="<?php echo ($sm); ?>" /><?php endif; ?>
                    更新时间 :
                    <input type="text" name="time_start" id="J_time_start" class="date" size="12" value="<?php echo ($data["time_start"]); ?>">
                    -
                    <input type="text" name="time_end" id="J_time_end" class="date" size="12" value="<?php echo ($data["time_end"]); ?>">

                    <input type="submit" name="search" class="btn" value="搜索" />
                    </form>
                    <form action="<?php echo U('Fenchenglist/excelout');?>" method="post"><input type="submit" class="btn" style="float:right;top:-27px;" value="导出数据"> </form>
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    

    <div class="J_tablelist table_list" data-acturi="<?php echo U('user/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
               <!--  <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th> -->
                <th width="40"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="80" align="center"><span data-tdtype="order_by" data-field="fenchenglv">提成率</span></th>
                <th width="80" align="center"><span data-tdtype="order_by" data-field="order">订单号</span></th>
                <th width="80" align="center"><span data-tdtype="order_by" data-field="username">分成金额</span></th>
                <th width="100"align="center"><span data-tdtype="order_by" data-field="wechatid">订单金额</span></th>
                <th width="100" align="center"><span data-tdtype="order_by" data-field="email">分成所属</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="reg_time">下单所属</span></th>
                <th width="100"><span data-tdtype="order_by" data-field="last_time">更新时间</span></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
              <!--   <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td> -->
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center"><span data-field="royalty" data-id="<?php echo ($val["royalty"]); ?>"><?php echo ($val["royalty"]); ?></span></td>
                <td align="center"><span data-tdtype="royalty" data-field="order" data-id="<?php echo ($val["orderId"]); ?>" ><?php echo ($val["orderId"]); ?></span></td>
                <td align="center"><span data-tdtype="royalty" data-field="fencheng" data-id="<?php echo ($val["fencheng"]); ?>" ><?php echo ($val["fencheng"]); ?></span></td>
                <td align="center"><span data-tdtype="royalty" data-field="price" data-id="<?php echo ($val["price"]); ?>" ><?php echo ($val["price"]); ?></span></td>
                <td align="center"><span data-tdtype="royalty" data-field="shares" data-id="<?php echo ($val["shares"]); ?>">
					<?php $shares=M('user')->where(array('id'=>$val['uid']))->field('username')->find(); echo $shares['username']; ?>
				</span></td>
                <td align="center">
				 <?php if($val['is_hand'] == 1): ?><span data-tdtype="royalty" data-field="username" data-id="<?php echo ($val["username"]); ?>"><?php echo ($val["user_id"]); ?></span>
					<?php else: ?>
						<span data-tdtype="royalty" data-field="username" data-id="<?php echo ($val["username"]); ?>">
							<?php $username=M('user')->where(array('id'=>$val['user_id']))->field('username')->find(); echo $username['username']; ?>
						</span><?php endif; ?>

				</td>
                <td align="center"><?php echo (date("Y-m-d H:i",$val["add_time"])); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    <div class="btn_wrap_fixed">
       <!--  <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('Fenchenglist/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" /> -->
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
</script>