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
<script charset="utf-8" src="__STATIC__/js/jquery.js" type="text/javascript"></script>
<!--支付方式-->

<div class="subnav">
    <h1 class="title_2 line_x">微信支付信息</h1>
</div>
<form id="wxinfo_form" action="<?php echo u('wxpay/index');?>" method="post" enctype="multipart/form-data">
<div class="pad_lr_10">
	<div class="col_tab">
		
		<div class="J_panes">
        <div class="content_list pad_10">
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
			<input type="hidden" name="id" value="<?php echo ($wxinfo["id"]); ?>" >
           <tr>
				<th>身份标识(appId):</th>
				<td><input type="text" name="appid" id="J_appid" class="input-text" size="60" value="<?php echo ($payconfig["appid"]); ?>"></td>
			</tr>
			 <tr>
				<th>身份密钥(appSecret):</th>
				<td><input type="text" name="appsecret" id="J_secret" class="input-text" size="60" value="<?php echo ($payconfig["appsecret"]); ?>"></td>
			</tr>
			 <tr>
				<th>通信密钥(paySignKey):</th>
				<td><input type="text" name="signkey" id="J_signkey" class="input-text" size="60" value="<?php echo ($payconfig["signkey"]); ?>"></td>
			</tr>
            <tr>
				<th>商户身份(partnerId):</th>
				<td><input type="text" name="partnerid" id="J_partnerid" class="input-text" size="60" value="<?php echo ($payconfig["partnerid"]); ?>"></td>
			</tr>
            <tr>
				<th>商户密钥(partnerKey):</th>
				<td><input type="text" name="partnerkey" id="J_partnerkey" class="input-text" size="60" value="<?php echo ($payconfig["partnerkey"]); ?>"></td>
			</tr>
			 <tr>
				<th>是否开启:</th>
				<td>
                <input type="radio" name="status" class="input-radio" value="1"<?php if($wxinfo["status"] == 1): ?>checked="checked"<?php endif; ?>  />开启
                <input type="radio" name="status" class="input-radio" value="0"<?php if($wxinfo["status"] == 0): ?>checked="checked"<?php endif; ?> />关闭
            </td>
			</tr>

		</table>
		</div>
        
        </div>
		<div class="mt10"><input type="submit" value="<?php echo L('submit');?>" class="btn btn_submit"></div>
	</div>
</div>
<input type="hidden" name="menuid"  value="<?php echo ($menuid); ?>"/>
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
<script type="text/javascript">
$('.J_cate_select').cate_select('请选择');
$(function() { 		   
	$('ul.J_tabs').tabs('div.J_panes > div');
	//自动获取标签
	$('#J_gettags').live('click', function() {
		var title = $.trim($('#J_title').val());
		if(title == ''){
			$.pinphp.tip({content:lang.article_title_isempty, icon:'alert'});
			return false;
		}
		$.getJSON('<?php echo U("item/ajax_gettags");?>', {title:title}, function(result){
			if(result.status == 1){
				$('#J_tags').val(result.data);
			}else{
				$.pinphp.tip({content:result.msg});
			}
		});
	});
	$.formValidator.initConfig({formid:"wxinfo_form",autotip:true});
	$("#J_appid").formValidator({onshow:'公众号身份标识',onfocus:'公众号身份标识 '}).inputValidator({min:1,onerror:'公众号身份标识'});
	$("#J_secret").formValidator({onshow:'公众号的权限获取密钥',onfocus:'公众号的权限获取密钥'}).inputValidator({min:1,onerror:'公众号的权限获取密钥'});
	$("#J_signkey").formValidator({onshow:'公众号支付的密钥Key',onfocus:'公众号支付的密钥Key'}).inputValidator({min:1,onerror:'公众号支付的密钥Key'});
	$("#J_partnerid").formValidator({onshow:'财付通商户身份标识id',onfocus:'财付通商户身份标识id'}).inputValidator({min:1,onerror:'财付通商户身份标识id'});
	$("#J_partnerkey").formValidator({onshow:'财付通商户权限密钥',onfocus:'财付通商户权限密钥'}).inputValidator({min:1,onerror:'财付通商户权限密钥'});
});

function add_file()
{
    $("#next_upload_file .uplode_file").clone().insertAfter($("#first_upload_file .uplode_file:last"));
}
function del_file_box(obj)
{
	$(obj).parent().parent().remove();
}
function add_attr()
{
    $("#hidden_attr .add_item_attr").clone().insertAfter($("#item_attr .add_item_attr:last"));
}
function del_attr(obj)
{
	$(obj).parent().parent().remove();
}
</script>

</body>
</html>
<script src="__STATIC__/js/jquery/plugins/colorpicker.js"></script>
<script src="__STATIC__/js/kindeditor/kindeditor.js"></script>
<script>

$(function() {
	KindEditor.create('#info', {
		uploadJson : '<?php echo U("attachment/editer_upload");?>',
		fileManagerJson : '<?php echo U("attachment/editer_manager");?>',
		allowFileManager : true
	});
	$('ul.J_tabs').tabs('div.J_panes > div');

	//颜色选择器
	$('.J_color_picker').colorpicker();

	//自动获取标签
	$('#J_gettags').live('click', function() {
		var title = $.trim($('#J_title').val());
		if(title == ''){
			$.pinphp.tip({content:lang.article_title_isempty, icon:'alert'});
			return false;
		}
		$.getJSON('<?php echo U("article/ajax_gettags");?>', {title:title}, function(result){
			if(result.status == 1){
				$('#J_tags').val(result.data);
			}else{
				$.pinphp.tip({content:result.msg});
			}
		});
	});
	
});
</script>