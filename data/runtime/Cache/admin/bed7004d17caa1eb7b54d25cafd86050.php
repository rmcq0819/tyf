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
        <div class="explain_col" >
            <form name="searchform" method="get" > 
                <input type="hidden" name="g" value="admin" />
                <input type="hidden" name="m" value="User_apply" />
                <input type="hidden" name="a" value="index" />
                <input type="hidden" name="id" value="<?php echo ($id); ?>" />
                &nbsp;&nbsp;关键字 :
                <input name="keyword" type="text" class="input-text" size="25" value="<?php echo ($search["keyword"]); ?>" />
                支付时间 :
                <input type="text" name="time_start" id="J_time_start" class="date" size="12" value="<?php echo ($_REQUEST['time_start']); ?>">
                -
                <input type="text" name="time_end" id="J_time_end" class="date" size="12" value="<?php echo ($_REQUEST['time_end']); ?>">

                申请时间 :
                <input type="text" name="add_time_start" id="time_start" class="date" size="12" value="<?php echo ($_REQUEST['add_time_start']); ?>">
                -
                <input type="text" name="add_time_end" id="time_end" class="date" size="12" value="<?php echo ($_REQUEST['add_time_end']); ?>">

                申请类型 :
                 <select name="part">
                    <option value="2">请选择</option>
                    <option value="1">店长</option>
                    <option value="3">经纪人</option>
                 </select>

                <input type="submit" name="search" class="btn" value="搜索" />
            </form>
            <?php if($id == '2'): ?><form action="<?php echo U('User_apply/excelout');?>" method="post">
              <input type="hidden" name="time_start"  value="<?php echo ($_REQUEST['time_start']); ?>" />
              <input type="hidden" name="time_end"  value="<?php echo ($_REQUEST['time_end']); ?>" />
              <input type="submit" class="btn" style="float:right;top:-27px;" value="导出数据" /> 
            </form><?php endif; ?>
        </div>
        </td>
      </tr>
    </tbody>
  </table>
   
    <div class="J_tablelist table_list" data-acturi="<?php echo U('User_apply/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
             <th width="30"><span tdtype="order_by" fieldname="id">ID</span></th>
             <th width="50" align="center"><span data-tdtype="order_by" data-field="username">用户名</span></th>
             <th align="center"><span data-tdtype="order_by" data-field="wxname">微信号</span></th>
             <th align="center"><span data-tdtype="order_by" data-field="part">申请类型</span></th>
            <!--  <th width="100" align="center"><span data-tdtype="order_by" data-field="merchant">店面名称</span></th> -->
             <th align="center"><span data-tdtype="order_by" data-field="phone_mob">联系方式</span></th>
            <!--  <th width="100"><span data-tdtype="order_by" data-field="mail">电子邮箱</span></th> -->
             <th width="130"><span data-tdtype="order_by" data-field="address">联系地址</span></th>
             <th width="100" align="center"><span>团队上级</span></th>
             <th width="100" align="center"><span>直接推荐人</span></th>
			 <th width="150" align="center"><span data-tdtype="order_by" data-field="support_time">支付时间</span></th>
			 <th width="150" align="center">申请时间</th>
             <th width="130" align="center" style="display:none;"><span data-tdtype="order_by" data-field="up_do_time">上级审核时间</span></th>
             <th width="100" align="center"><span data-tdtype="order_by" data-field="up_status">上级审核状态</span></th>
             <th width="100"> <?php if($val["up_status"] == 1 and $val["hq_status"] == 0): echo L('operations_manage'); else: ?>总部审核状态<?php endif; ?></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center"><?php echo ($val["username"]); ?></td>
                <td align="center"><?php echo ($val["wxname"]); ?></td>
                <td align="center"><?php if($val["part"] == 1): ?>店长<?php elseif($val["part"] == 3): ?><b style="color:blue;">经纪人</b><?php else: ?>店长<?php endif; ?></td>
                 <!-- <td align="center"><?php echo ($val["merchant"]); ?></td> -->
                <td align="center"><?php echo ($val["phone_mob"]); ?></td>
              <!-- 	<td align="center"><?php echo ($val["email"]); ?></td> -->
              	<td align="center"><?php echo ($val["address"]); ?></td>
                <td align="center"><?php echo ($val["shares_name"]); ?></td>
                <td align="center">
					<?php
 if($val['recom'] == 0){ $where['id'] = $val['shares']; }else{ $where['id'] = $val['recom']; } echo M('user')->where($where)->getField('username'); ?>
				</td>
				  <td align="center">
					<?php if($val["part"] != 3): if(empty($val["support_time"])): ?><span data-tdtype="edit" data-field="support_time" data-id="<?php echo ($val["id"]); ?>" class="tdedit" style="color:red;">暂未支付会员费</span><?php else: echo (date("Y-m-d H:i:s",$val["support_time"])); endif; ?>
						<?php else: ?>
						无<?php endif; ?>
				  </td>
                <td align="center"><?php echo (date("Y-m-d H:i:s",$val["add_time"])); ?></td>
              	<td align="center" style="display:none;"><?php if(empty($val["up_do_time"])): ?><b style="color:#3A6DA4">默认通过，不显示时间</b><?php else: echo (date("Y-m-d H:i:s",$val["up_do_time"])); endif; ?></td>
                <td align="center"><!-- <img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="up_status" data-value="<?php echo ($val["id"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["up_status"] == 1): ?>enabled<?php else: ?>disabled<?php endif; ?>.gif" /> -->
                <?php switch($val["up_status"]): case "1": ?>审核通过<?php break;?>
                  <?php case "2": ?>审核不通过<?php break;?>
                  <?php default: ?>未处理<?php endswitch;?>  
                </td>
                <td align="center">
                  <?php if($val["up_status"] == 1 and $val["hq_status"] == 0): ?><!--<a href="<?php echo U('User_apply/hq_pass');?>&id=<?php echo ($val['id']); ?>&act=1">审核通过</a>-->
					<?php if($val["support_time"] == 0): ?><span style="cursor:pointer;" onclick="to_apply(<?php echo ($val['id']); ?>)">审核通过</span>
						<?php else: ?>
						<a href="<?php echo U('User_apply/hq_pass');?>&id=<?php echo ($val['id']); ?>&act=1" style="color:#3A6DA4;font-weight:bold;">审核通过</a><?php endif; ?>
                    |
                    <a href="<?php echo U('User_apply/hq_pass');?>&id=<?php echo ($val['id']); ?>&act=2">不通过</a>
                  <?php else: ?>
                    <?php switch($val["hq_status"]): case "2": ?><a href="<?php echo U('User_apply/delete',array('id'=>$val['id']));?>" style="color:red">删除</a><?php break;?>
                      <?php case "1": ?>审核通过<?php break;?>
                      <?php default: ?><a href="<?php echo U('User_apply/delete',array('id'=>$val['id']));?>" style="color:red">删除</a><?php endswitch; endif; ?>
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
    inputField : "time_start",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});
Calendar.setup({
    inputField : "time_end",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});

function to_apply(id){
	if(confirm('该用户还未支付会员费，您确定要审核通过吗？')){
		window.location.href="<?php echo U('User_apply/hq_pass');?>&id="+id+"&act=1";
	}else{
		return false;
	}
}
</script>