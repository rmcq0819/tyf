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
<style type="text/css">
.coupon-a{ background:#EAEEF4; padding:5px 15px; border:1px solid #999999}
</style>
<div class="pad_lr_10" >
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="coupon_templet" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                    &nbsp;关键字 :
                    <input name="keyword" type="text" class="input-text" size="35" value="<?php echo ($search); ?>" placeholder="支持按优惠券名称、描述、优惠价、使用条件查找"/>
                    <input type="submit" name="search" class="btn" value="搜索" />
					
					<input onclick="location.href='./index.php?g=admin&m=coupon_templet&a=add'" class="btn" size="6" value="新增优惠券">
					<!-- <input onclick="location.href='./index.php?g=admin&m=coupon_templet&a=send_coupon'" class="btn" size="6" value="发放优惠券"> -->
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
<script type="text/javascript">

</script>
    <div class="J_tablelist table_list" data-acturi="<?php echo U('coupon_templet/ajax_edit');?>">
	<form name="myForm" method="post" action="./index.php?g=admin&m=coupon_templet&a=dels" >
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>
					<input type="checkbox" name="checkall" class="J_checkall">
				</th>
				<th width="5%"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="10%"><span data-field="title">优惠券名称</span></th>
				<th width="5%"><span data-tdtype="order_by" data-field="kind">类型</span></th>
				<th width="10%">兑换条件</th>
				<th width="5%"><span data-tdtype="order_by" data-field="num">优惠券数量</span></th>
				<th width="10%"><span data-tdtype="order_by" data-field="count">持券用户</span></th>
				<th width="5%"><span data-tdtype="order_by" data-field="disPrice">券面金额<span></th>
				<th width="10%">满多少金额可使用</th>
				<th width="15%"><span data-tdtype="order_by" data-field="start_time">可领取开始日期</span></th>
				<th width="10%"><span data-tdtype="order_by" data-field="end_time">可领取结束日期</span></th>
				<th width="5%"><span data-tdtype="order_by" data-field="status">是否启用</span></th>
				<th width="10%">操作</th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
					<td align="center"><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo ($val["id"]); ?>"></td>
					<td align="center"><?php echo ($val["id"]); if($val["is_recom"] > 0): ?>（首页）<?php endif; ?></td>
					<td align="center"><span data-tdtype="edit" data-field="title" data-id="<?php echo ($val["id"]); ?>" class="tdedit" style="color:<?php echo ($val["colors"]); ?>;"><?php echo ($val["title"]); ?><span></td>
					<td align="center">
						<?php if($val["kind"] == 1): ?>通用券<?php endif; ?>
						<?php if($val["kind"] == 2): ?>品类券<?php endif; ?>
						<?php if($val["kind"] == 3): ?>兑换券<?php endif; ?>
						<?php if($val["kind"] == 4): ?>新人券<?php endif; ?>
						</td>
					<td align="center"><?php if($val["exchangeCond"] > 0): echo ($val["exchangeCond"]); ?>范票<?php endif; ?></td>
					<td align="center"><span data-tdtype="edit" data-field="num" data-id="<?php echo ($val["id"]); ?>" class="tdedit" style="color:<?php echo ($val["colors"]); ?>;"><?php echo ($val["num"]); ?></span></td>
					<td align="center"><a href="./index.php?g=admin&m=coupon_templet&a=user&id=<?php echo ($val["id"]); ?>">查看</a>（<?php echo ($val["count"]); ?>）</td>
					<td align="center"><?php echo ($val["disPrice"]); ?></td>
					<td align="center"><img src="__STATIC__/images/admin/jb.png" width="14"/>
					<?php echo ($val["condition"]); ?>
					</td>
					<td align="center"><?php if($val["start_time"] == 0): else: echo (date("Y-m-d",$val["start_time"])); endif; ?></td>
					<td align="center"><?php if($val["end_time"] == 0): else: echo (date("Y-m-d",$val["end_time"])); endif; ?></td>
					 <td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="status" data-value="<?php echo ($val["status"]); ?>" src="__STATIC__/images/admin/toggle_<?php if($val["status"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
					<td align="center"><a href="./index.php?g=admin&m=coupon_templet&a=edit&id=<?php echo ($val["id"]); ?>">编辑</a>&nbsp;|&nbsp;
									   <a href="./index.php?g=admin&m=coupon_templet&a=del&id=<?php echo ($val["id"]); ?>" onClick="return confirm('你确定要将该记录删除吗？');">删除</a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    <div class="btn_wrap_fixed" style="bottom: 5px;">
      <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <a href="javascript:;" onclick="document.myForm.submit();" class="coupon-a"><?php echo L('delete');?></a>
        <div id="pages"><?php echo ($page); ?></div>
    </div>
	
	</form>

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