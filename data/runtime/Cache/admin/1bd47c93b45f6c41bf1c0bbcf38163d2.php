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
   <script>
		     $(function(){
		    
        	 $('#free').change(function(){
        	  if($(this).val()==2)
        	  {
        	  	$('#address_form').show();
        	  }else
        	  {
        	  		$('#address_form').hide();
        	  }
        	 });
        	 set_address();
        })
        
          function set_address()
          {
          	 var addr_id =$("#free").find("option:selected").val();
          	
           if(addr_id == 2)
            {
               
                $('#address_form').show();
            }
            else
            {
                $('#address_form').hide();
     
            }
          }
		 </script>
<!--添加产国-->
<form id="info_form" action="<?php echo U('item_comment/add');?>" method="post" enctype="multipart/form-data">
<div class="pad_lr_10">
	<div class="col_tab">
		<ul class="J_tabs tab_but cu_li">
			<li class="current">添加评论</li>
		</ul>
		<div class="J_panes">
        <div class="content_list pad_10">
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
		
			<tr>
				<th>选择商品 :</th>
				<td>
					<select name="item" style="font-size:14px;height:30px;" id="items">
						<?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if($val["id"] == $_GET['id']): ?><option value="<?php echo ($val["id"]); ?>" style="font-size:14px;" selected><?php echo ($val["title"]); ?> ----- 评论数(<?php echo ($val["counts"]); ?>)</option>
									<?php else: ?>
									<option value="<?php echo ($val["id"]); ?>" style="font-size:14px;"><?php echo ($val["title"]); ?> ----- 评论数(<?php echo ($val["counts"]); ?>)</option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>商品图片 :</th>
				<td>
					<img src="" id="imgs" style="width:100px;height:100px;" alt="请在上方选择商品"/>
				</td>
			</tr>
			
			<tr>
				<th>评论用户 :</th>
				<td>
					<select name="user" style="font-size:14px;height:30px;" id="users">
						<?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>" style="font-size:14px;"><?php echo ($vol["username"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>用户头像 :</th>
				<td>
					<img src="" id="user_imgs" style="width:100px;height:100px;" alt="请在上方选择评论用户"/>
				</td>
			</tr>
			
            <tr>
				<th>评论内容 :</th>
				<td><textarea name="content" style="width:600px;height:160px;font-size:14px;line-height:30px;">物流速度快，商品质量好</textarea></td>
			</tr>
			
			<tr>
				<th>评论时间 :</th>
				<td>
					<input name="comment_time" type="text" id="J_time_start" class="date" >
				</td>
			</tr>
			
			<tr>
				<th>评论图片 :</th>
				<td><input type="file" name="comment_img" /> <span style="color:#959595">评论图片，如不需要则不上传</span></td>
 			</tr>
		</table>
		</div>
        </div>
		<div class="mt10" style="margin-bottom:40px;"><input type="submit" value="添加评论" class="btn btn_submit"></div>
	</div>
</div>
<link rel="stylesheet" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script src="__STATIC__/js/calendar/calendar.js"></script>
<script>
	$(document).ready(function(){ 
		$('#items').change(function(){ 
			var id=$(this).children('option:selected').val();
			$.post('<?php echo U('item_comment/add');?>',{'id':id},function(data){
				$("#imgs").attr("src",'http://yooopay.com/data/upload/item/'+data); 
			});
			
		}) 
		
		$('#users').change(function(){ 
			var userid=$(this).children('option:selected').val();
			$.post('<?php echo U('item_comment/add');?>',{'userid':userid},function(data){
				$("#user_imgs").attr("src",data); 
			});
			
		}) 
	}) 
Calendar.setup({
	inputField : "J_time_start",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
</script>
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
</body>
</html>