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
<script type="text/javascript">
function drop_confirm(str,url) {
	if(confirm(str)) {
		window.location.href = url;
	}
}
</script>
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
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                    &nbsp;关键字：
                    <input name="keyword" type="text" class="input-text" size="25" value="<?php echo ($search["keyword"]); ?>" placeholder="输入用户名/真实姓名/店铺名称" />
					&nbsp;&nbsp;手机号码：
					<input name="phone_mob" type="text" class="input-text" size="25" value="<?php echo ($search["phone_mob"]); ?>" placeholder="输入手机号码" />
					&nbsp;&nbsp;用户类型：
					 <select name="level" >
                        <option value="">--所有--</option>
						<option <?php if($search["level"] == 2): ?>selected=''<?php endif; ?> value="2">掌柜</option>
                        <option <?php if($search["level"] == 3): ?>selected=''<?php endif; ?> value="3">店长</option>
                        <option <?php if($search["level"] == 5): ?>selected=''<?php endif; ?> value="5">经纪人</option>
                        <option <?php if($search["level"] == 4): ?>selected=''<?php endif; ?> value="4">消费者</option>
                      </select>
					
                    <input type="submit" name="search" class="btn" value="搜索" />
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>

    <div class="J_tablelist table_list" data-acturi="<?php echo U('user/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="40"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="40" align="center"><span data-tdtype="order_by" data-field="img">头像</span></th>
                <th width="80" align="center"><span data-tdtype="order_by" data-field="usercid">会员组</span></th>
                <th width="100" align="left"><span data-tdtype="order_by" data-field="username">用户名</span></th>
                <!-- <th width="100"align="left"><span data-tdtype="order_by" data-field="wechatid">微信id</span></th> -->
                <th width="100" align="left"><span data-tdtype="order_by" data-field="points">范票</span></th>
                <th width="30"><span data-tdtype="order_by" data-field="sex">性别</span></th>
                <!-- <th width="60" align="right"><span data-tdtype="order_by" data-field="shares">分享</span></th>
                <th width="60" align="right"><span data-tdtype="order_by" data-field="albums">专辑</span></th>-->
				 <th width="40" align="center" style="display:none;"><span data-tdtype="order_by" data-field="score">收藏</span></th>
                <!-- <th width="40" align="center"><span data-tdtype="order_by" data-field="score">积分</span></th> -->
<!-- 				  <th width="60" align="center"><span data-tdtype="order_by" data-field="score">优惠券</span></th> -->
				 <!--  <th width="60" align="center"><span data-tdtype="order_by" data-field="cangku">仓库</span></th> -->
				 <th width="40" align="center"><span data-tdtype="order_by" data-field="score">提成</span></th>
                 <th width="100" align="center"><span data-tdtype="order_by">查看下线</span></th>
                 <th width="100" align="center"><span data-tdtype="order_by">范票明细</span></th>
                <th width="100"><span data-tdtype="order_by" data-field="reg_time">注册时间</span></th>
                <th width="100"><span data-tdtype="order_by" data-field="last_time">最后登录</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="last_ip">最后IP</span></th>
              <!--  <th width="30"><span data-tdtype="order_by" data-field="daren">达人</span></th>-->
                <th width="30"><span data-tdtype="order_by" data-field="status"><?php echo L('status');?></span></th>
				<th width="30"><span>升级</span></th>
                <th width="80"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center"><?php if($val["hyimg"] != ''): ?><img src="<?php echo ($val["hyimg"]); ?>" style="width:100px;height:100px;" /><?php else: ?><img src="<?php echo ($val["cover"]); ?>" style="width:100px;height:100px;" /><?php endif; ?></td>
                <td align="center"><a href="<?php echo U('user/cateindex',array('uid'=>$val['uid']));?>"><span data-field="cname" data-id="<?php echo ($val["id"]); ?>"><?php echo ($val["cname"]); ?></span></a></td>
                <td align="left"><span data-tdtype="edit" data-field="username" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php if($val['username']): echo ($val['username']); else: echo ($val['wechatid']); endif; ?></span></td>
                <!-- <td align="left"><span data-tdtype="edit" data-field="wechatid" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php if($val['wechatid']): echo ($val['wechatid']); else: ?>无<?php endif; ?></span></td> -->
                <td align="left"><span><?php echo ($val["points"]); ?></span>
					<?php if($val["is_freeze"] == 1): ?><span style="color:#ff0000;">(已被冻结)</span><?php endif; ?>
				</td>
                <td align="center">
                  <?php if($val['gender'] == '1'): ?>男<?php endif; ?>
                  <?php if($val['gender'] == '0'): ?>女<?php endif; ?>
                </td>
                <!--<td align="right"><?php echo ($val["shares"]); ?></td>
                <td align="right"><?php echo ($val["albums"]); ?></td>-->
				<td align="center" style="display:none;"><a href="<?php echo U('user/shoucang',array('id'=>$val['id']));?>">查看</a></td>
                <!-- <td align="center"><a href="<?php echo U('user/jifen',array('id'=>$val['id']));?>">查看</a></td> -->
				<!-- <td align="center"><a href="<?php echo U('user_cangku/show',array('id'=>$val['id']));?>">查看</a></td> -->
				<td align="center"><a href="<?php echo U('user/fencheng',array('id'=>$val['id'],'username'=>$val['username']));?>">查看</a></td>
                <td align="center"><a href="<?php echo U('user/fenxiao_list',array('id'=>$val['id'],'username'=>$val['username']));?>">查看</a></td>
                <td align="center"><a href="<?php echo U('user/pointlist',array('id'=>$val['id']));?>">查看</a></td>
                <td align="center"><?php echo (date("Y-m-d H:i",$val["reg_time"])); ?></td>
                <td align="center"><?php echo (date("Y-m-d H:i",$val["last_time"])); ?></td>
                <td align="center"><?php echo ($val["last_ip"]); ?></td>
              <!--  <td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="daren" data-value="<?php echo ($val["daren"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["daren"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>-->
                <td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="status" data-value="<?php echo ($val["status"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["status"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
                <td align="center">
					<?php switch($val["uid"]): case "1": ?><span style="color:blue;">无需升级</span><?php break;?>
						<?php case "2": ?><span style="color:blue;">无需升级</span><?php break;?>
						<?php default: ?>	
						<a href="javascript:drop_confirm('您确定要提升会员名为：(<?php echo ($val['username']); ?>) 的等级至掌柜吗？', '<?php echo u('user/zg_update', array('id'=>$val['id']));?>');" style="color:#3A6DA4;">升至掌柜</a><?php endswitch;?>
				</td>
				<td align="center">
                <a href="javascript:;" class="J_showdialog" data-uri="<?php echo u('user/edit', array('id'=>$val['id'], 'menuid'=>$menuid));?>" data-title="编辑-<?php echo ($val["username"]); ?>" data-id="edit" data-width="520" data-height="330">编辑</a> | <a href="javascript:void(0);" class="J_confirmurl" data-uri="<?php echo u('user/delete', array('id'=>$val['id']));?>" data-acttype="ajax" data-msg="<?php echo sprintf(L('confirm_delete_one'),$val['username']);?>"><?php echo L('delete');?></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    <div class="btn_wrap_fixed">
        <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('user/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
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