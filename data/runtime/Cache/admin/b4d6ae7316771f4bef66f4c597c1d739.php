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
<!--添加商品-->
<div class="subnav">
    <h1 class="title_2 line_x">添加商品</h1>
</div>
<form id="info_form" action="<?php echo u('item/add');?>" method="post" enctype="multipart/form-data">
<div class="pad_lr_10">
	<div class="col_tab">
		<ul class="J_tabs tab_but cu_li">
			<li class="current">基本信息</li>
			<li>展示图片</li>
			<!--<li>SEO设置</li>
			<li>附加属性</li>-->
		</ul>
		<div class="J_panes">
        <div class="content_list pad_10">
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
			<tr>
				<th width="120">所属分类 :</th>
                <td><select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('item_cate/ajax_getchilds', array('type'=>0));?>" data-selected=""></select><input type="hidden" name="cate_id" id="J_cate_id" value="" /></td>
			</tr>
			
			<tr>
				<th width="120">所属免税仓 :</th>
                <td>
				<select name="item_base" style="width:100px;height:23px;">
					<option value="0">--请选择--</option>
					<?php if(is_array($item_base)): $i = 0; $__LIST__ = $item_base;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item_base): $mod = ($i % 2 );++$i;?><option value="<?php echo ($item_base["id"]); ?>"><?php echo ($item_base["basename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<span style="color:#959595;">(商品所属免税仓，务必选上)</span>
				</td>
			</tr>
			
			
            <tr>
				<th>商品名称 :</th>
				<td><input type="text" name="title" id="J_title" class="input-text" size="60"></td>
			</tr>

		  <tr style="display:none;">
			<th>净含量 :</th>
				<td><input type="text" name="color" id="J_color" class="input-text" size="30"><font color="#FD5873">（不需要可不填, 格式：多个用竖杆“|”隔开，如：100毫升|150毫升|200毫升）</font></td>
			</tr>
			<tr style="display:none;">
				<th>净含量对应价格 :</th>
				<td><input type="text" name="size" id="J_size" class="input-text" size="30"><font color="#FD5873">（不需要可不填, 格式：多个用竖杆“|”隔开，如：100|200|300）</font></td>
			</tr>
			<tr style="display:none;">
				<th>净含量对应库存 :</th>
				<td><input type="text" name="kucun" class="input-text" size="30"><font color="#FD5873">（不需要可不填, 格式：多个用竖杆“|”隔开，如：100|200|300）</font></td>
			</tr>
            <tr>
				<th>商品图片 :</th>
				<td><input type="file" name="img" /></td>
 			</tr>
			<tr>
				<th>商品类型 :</th>
				<td>
					<input type="radio" name="itemtype" value="1" checked="checked" />已完税
					&nbsp;&nbsp;&nbsp;
					<input type="radio" name="itemtype" value="0"/>保税
					&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="itemtype_direct" value="1"/>直邮
				</td>
			</tr>	
			<tr>
		      <th>是否人气:</th>
		      <td>
			  <input type="checkbox" name="zhuangui">人气新品</td>
		    </tr>
			<tr style="height:41px;">
		      <th>是否专题推荐:</th>
		      <td><input type="checkbox" name="zhuanti" value="0">专题推荐&nbsp;&nbsp;&nbsp;&nbsp;
		      <span id="reason" style="display:none;">推荐理由：<input type="text" class="input-text" name="reason" size="50" value=""></span>
			  <span style="color:#959595;">(这里勾选专题推荐时，请填写推荐理由)</span></td> 
		    </tr>
			<script>
				$(function(){
					$('input[name=zhuanti]').change(function(){
						if($(this).val()==0){
							$('#reason').css('display','');
							$('input[name=zhuanti]').val('1');
						}else{
							$('#reason').css('display','none');
							$('input[name=zhuanti]').val('0');
						}
					});
				});
			</script>
			<tr>
				<th>推荐封面 :</th>
				<td><input type="file" name="pic" /></td>
			</tr>	
			 <tr style="display: none;">
				<th>原价 :</th>
				<td><input id='J_priceyuan' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')" type="text" name="priceyuan" class="input-text" size="10" value="0"> 元</td>
			</tr>
			 <tr  style="display: none;">
				<th>活动促销时间 :</th>
				<td><input type="text" name="zuzhuang" class="input-text" size="10"> 天</td>
			</tr>
			<tr>

				<th style="font-weight:bold;">销售价 :</th>
				<td><input id='J_price' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="price" size="10" class="input-text" value="<?php echo ($info["price"]); ?>"> 元</td>
			</tr>
			<tr style="display:none;">
				<th>商品原价 :</th>
				<td><input onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="priceyuan" size="10" class="input-text" value="">元
				<span  style="color:#959595">&nbsp;（提示：属于展示价格，不参与购物流程，可为空！）</span>
				</td>
			</tr>
			
			<tr>
				<th>温馨提示 :</th>
				<td>
					<b style="color:red;font-size:15px;">请注意，成本价格不能高于销售价格！</b></br>
					<b style="color:red;font-size:15px;">若商品无规格属性，商品规格和规格图片可为空！</b>
				</td>
			</tr>
			</table>
			<style>
				.size_table{
					width:100%;
				}
				.size_table td{
					border-right:1px #eee solid;
					border-bottom:1px #eee solid;
					text-align:center;
				}	
				
			</style>
			<script>
				function add_size()
				{
					$("#hidden_size_attr .add_size").clone().insertAfter($("#size_attr .add_size:last"));
				}
				function del_size(obj)
				{
					$(obj).parent().parent().remove();
				}
				function copy(obj){
					var input = $(obj).parent().parent().find('input');
					var copyStr = input.eq(0).val()+'-'+ input.eq(1).val()+'-'+ input.eq(2).val()+'-'
					+input.eq(3).val()+'-'+input.eq(4).val()+'-'+input.eq(5).val()+'-'+input.eq(6).val();
					//alert(copyStr);
					window.clipboardData.setData("Text",copyStr);
				}
				function paste(obj){
					var pasteStr = window.clipboardData.getData("Text");
					var pasteArr = pasteStr.split("-");
					var input = $(obj).parent().parent().find('input');
					for(i=0;i<pasteArr.length;i++){
						input.eq(i).val(pasteArr[i]);
					}
				}
				/*function checkPrice(obj){
					var input = $(obj).parent().parent().find('input');
					var cost = input.eq(2).val();
					var price = $("input[name=price]").val();
					if(cost!=''&&price!=''){
						if(cost>price){
							input.eq(2).css('color','red');
						}else{
							input.eq(2).css('color','black');
						}
					}
				}*/
				function checkYhprice(obj){
					var input = $(obj).parent().parent().find('input');
					var cost = input.eq(2).val();
					var yhprice = input.eq(3).val();
					if(cost!=''&&yhprice!=''){
						if(parseFloat(cost)>parseFloat(yhprice)){
							input.eq(2).css('color','red');
						}else{
							input.eq(2).css('color','black');
						}
					}
				}
				function checkaprice(obj){
					var input = $(obj).parent().parent().find('input');
					var cost = input.eq(2).val();
					var aprice = input.eq(4).val();
					if(cost!=''&&aprice!=''){
						if(parseFloat(cost)>parseFloat(aprice)){
							input.eq(2).css('color','red');
						}else{
							input.eq(2).css('color','black');
						}
					}
				}
			</script>
			<table id="size_attr" class="size_table">
				<tr style="color:rgb(119,119,119);font-weight:bold;height:35px;">
					<td width="9%">规格</td>
					<td>SKU编码</td>
					<td>进货价</td>
					<td>成本价</td>
					<td>分类优惠价</td>
					<td>活动价</td>
					<td>商品总库存</br><input type="checkbox" name="is_stockjointly" value="1"><span style="color:red">共库存</span></td>
					<td>单件商品所占库存</td>
					<td>商品规格</td>
					<td>规格图片</td>
					<td style="border-right:0px;">操作</td>
					
				</tr>
				<tbody class="add_size">
				<tr style="height:35px;">
					<td>
						<a href="javascript:void(0);" class="blue" onclick="add_size();"><img src="__STATIC__/css/admin/bgimg/tv-expandable.gif" /></a>
					</td>
					<td><input type="text" name="adress[]" class="input-text" size="20" value=""/></td>
					<td><input type="text" name="price_jinhuo[]" size="10" class="input-text" value=""/> 元</td>
					<td><input type="text" name="cost[]" size="10"  onblur="checkYhprice(this);" class="input-text" value=""/> 元</td>
					<td><input type="text" name="yhprice[]" size="10" onblur="checkYhprice(this);" class="input-text" value=""/> 元</td>
					<td><input type="text" name="aprice[]" size="10" onblur="checkaprice(this);" class="input-text" value=""/> 元</td>
					<td><input type="text" name="goods_stock[]" class="input-text" size="10" value=""/></td>
					<td><input type="text" name="stock[]" class="input-text" size="10" value="1"/></td>
					<td><input type="text" name="size[]" class="input-text" value="" size="20"/></td>
					<td><input type="file" name="size_imgs[]"/></td>
					<td style="border-right:0px;"><input type="button" onclick="copy(this);" value="复制" /><input type="button" onclick="paste(this);" value="粘贴" /></td>
				</tr>
				</tbody>
			</table>
			
			
			<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
			
			
			
			<tr>
				<th>小二分成率 :</th>
				<td><input id='J_fengcheng' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="fencheng" size="10" class="input-text" value="0.40">
				<span  style="color:#959595">&nbsp;(提示：默认分成率为:0.40，可根据需要修改)</span>
				</td>
			</tr>	
			
			<tr>
				<th width="120">所属国家 :</th>
                <td>
				<select name="country" style="width:100px;height:23px;">
					<option value="0">--请选择--</option>
						<?php if(is_array($country_name)): $i = 0; $__LIST__ = $country_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$country): $mod = ($i % 2 );++$i;?><option value="<?php echo ($country["Id"]); ?>"><?php echo ($country["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<span style="color:#959595;">(这里显示商品的国家，务必选上)</span>
				</td>
			</tr>
			<tr>
				<th width="120">所属品牌 :</th>
                <td>
				<select name="brandId" style="width:100px;height:23px;">
					<option value="0">--请选择--</option>
					<?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				</td>
			</tr>
			
			<tr>
		      <th>是否单品活动:</th>
		      <td>
			  <input type="checkbox" name="activity" value="1">活动 
			  <span style="color:#959595;">(请注意区商品为单品还是套餐，可参加相应活动)</span>
			  </td>
		    </tr>
			<tr>
		      <th>抢购数量:</th>
			 <td><input id='J_salequantity' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="sale_quantity" size="10" class="input-text"> </td>
			</tr>
			<tr>
		      <th>是否套餐:</th>
		      <td>
			  <input type="checkbox" name="is_combo" value="1">套餐</td>
		    </tr>
			 <tr>
		      <th>是否在首页展示:</th>
		      <td>
			  <input type="checkbox" name="home" value="1">显示到首页</td>
		    </tr>
			
			<tr>
				  <th>是否参与砍价活动:</th>
				  <td>
				  <input type="checkbox" name="is_bargain" value="1">参与砍价
				  &nbsp&nbsp <span>(勾选此选项后，该商品将自动出现砍价专场页面)</span>
				  </td>
			</tr>
			
			<tr>
				<th>砍价最低价格 :</th>
				<td><input id='J_bargain_price' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="bargain_price" size="10" class="input-text" value="">
				<span  style="color:#959595">&nbsp;(提示：最低可以砍多少？只有参加砍价活动的商品需要填写)</span>
				</td>
			</tr>
			
			<tr>
				<th>封面图片 :</th>
				<td><input type="file" name="cover" /> <span style="color:#959595">(如不需要在首页推荐显示，请留空)</span></td>
 			</tr>
            <tr style="display:none;">
		      <th>是否限购:</th>
		      <td><input type="checkbox" name="is_xiangou" value="1" >&nbsp;限购&nbsp; <input id='xiangou_num' onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9]/g,'')" type="text" name="xiangou_num" class="input-text" size="10" value="0">&nbsp;限购数量</td>
		    </tr>
		     <tr style="display:none;">
		      <th>运费:</th>
		      <td>
		      <select id='free' name="free">
		      <option value="1">卖家承担运费</option>
		      <option  value="2">买家承担运费</option>
		      </select>
		      </td>
		    </tr>
		    
		    
		    <tr id="address_form" style="display:none;">
		    <th></th>
		    <td> 
		      平邮:<input onkeyup="value=value.replace(/[^\d\.]/g,'')" type="text" name="pingyou" />
		      快递:<input onkeyup="value=value.replace(/[^\d\.]/g,'')" type="text" name="kuaidi" />
		      EMS:<input onkeyup="value=value.replace(/[^\d\.]/g,'')" type="text" name="ems" /></td>
		    </tr>
			<tr>
				<th>产品详情 :</th>
				<td><textarea name="info" id="info" style="width:80%;height:400px;visibility:hidden;resize:none;"></textarea></td>
			</tr>
			<tr>
				<th>产品参数 :</th>
				<td><textarea name="cs" id="cs" style="width:80%;height:400px;visibility:hidden;resize:none;"><?php echo ($info["cs"]); ?></textarea></td>
			</tr>
		</table>
		</div>
        <div class="content_list pad_10 hidden">
            <table width="100%" cellpadding="2" cellspacing="1" class="table_form" id="first_upload_file">
                <tbody class="uplode_file">
                <tr>
                    <th width="100"><a href="javascript:void(0);" class="blue" onclick="add_file();"><img src="__STATIC__/css/admin/bgimg/tv-expandable.gif" /></a> 上传文件 :</th>
                    <td><input type="file" name="imgs[]"></td>
                </tr>
                </tbody>
            </table>
        </div>
		<!--<div class="content_list pad_10 hidden">
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
			<tr>
				<th width="120"><?php echo L('seo_title');?> :</th>
 				<td><input type="text" name="seo_title" id="seo_title" class="input-text" size="60"></td>
			</tr>
			<tr>
				<th><?php echo L('seo_keys');?> :</th>
				<td><input type="text" name="seo_keys" id="seo_keys" class="input-text" size="60"></td>
			</tr>
			<tr>
				<th><?php echo L('seo_desc');?> :</th>
				<td><textarea name="seo_desc" id="seo_desc" cols="80" rows="8"></textarea></td>
			</tr>
		</table>
		</div>-->
        <div class="content_list pad_10 hidden">
		<table width="100%" cellpadding="2" cellspacing="1" style="text-align:left" class="table_form" id="item_attr">
			<tbody class="add_item_attr">
            <tr>
                <th width="220">
                <a href="javascript:void(0);" class="blue" onclick="add_attr();"><img src="__STATIC__/css/admin/bgimg/tv-expandable.gif" /></a> 属性名 :<input type="text" name="attr[name][]" class="input-text" size="20">
                </th>
                <td> 属性值 :<input type="text" name="attr[value][]" class="input-text" size="30"><font color="#FD5873">（ 属性格式：多个用竖杆“|”隔开，如：蓝色|红色|白色）</font></td>
            </tr>
            </tbody>
		</table>
		</div>
		
		<table id="hidden_attr" style="display:none;">
		<tbody class="add_item_attr">
		<tr>
			<th width="200">
			<a href="javascript:void(0);" class="blue" onclick="del_attr(this);"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a>属性名 :<input type="text" name="attr[name][]" class="input-text" size="20">
			</th>
			<td>属性值 :<input type="text" name="attr[value][]" class="input-text" size="30"></td>
		</tr>
		</tbody>
		</table>
		
        </div>
		<div class="mt10" style="margin-bottom:40px;"><input type="submit" value="<?php echo L('submit');?>" class="btn btn_submit"></div>
	</div>
</div>
<input type="hidden" name="menuid"  value="<?php echo ($menuid); ?>"/>
</form>
<table id="hidden_size_attr" style="display:none;">
	<tbody class="add_size">
	  <tr style="height:35px;">
		<td>
			<a href="javascript:void(0);" class="blue" onclick="del_size(this);"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a>
		</td>
		<td><input type="text" name="adress[]" class="input-text" size="20" value=""/></td>
		<td><input type="text" name="price_jinhuo[]" size="10" class="input-text" value=""/> 元</td>
		<td><input type="text" name="cost[]" size="10" onblur="checkYhprice(this);" class="input-text" value=""/> 元</td>
		<td><input type="text" name="yhprice[]" size="10" onblur="checkYhprice(this);" class="input-text" value=""/> 元</td>
		<td><input type="text" name="aprice[]" size="10" onblur="checkaprice(this);" class="input-text" value=""/> 元</td>
		<td><input type="text" name="goods_stock[]" class="input-text" size="10" value=""/></td>
		<td><input type="text" name="stock[]" class="input-text" size="10" value="1"/></td>
		<td><input type="text" name="size[]" class="input-text" value="" size="20"/></td>
		<td><input type="file" name="size_imgs[]"/></td>
		<td style="border-right:0px;"><input type="button" onclick="copy(this);" value="复制" /><input type="button" onclick="paste(this);" value="粘贴" /></td>

	  </tr>
	</tbody>
</table>
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
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#J_title").formValidator({onshow:'请填写商品名称',onfocus:'请填写商品名称'}).inputValidator({min:1,onerror:'请填写商品名称'});
	$("#J_price").formValidator({onshow:'请填写商品价格',onfocus:'请填写商品价格'}).inputValidator({min:1,onerror:'请填写商品价格'});
	$("#J_priceyuan").formValidator({onshow:'请填写商品原价',onfocus:'请填写商品原价'}).inputValidator({min:1,onerror:'请填写商品原价'}).defaultPassed();//默认验证通过
	$("#J_user_price").formValidator({onshow:'请填写会员价格，-1代表默认价格'});
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
<table id="next_upload_file" style="display:none;">
<tbody class="uplode_file">
   <tr>
      <th width="100"><a href="javascript:void(0);" onclick="del_file_box(this);" class="blue"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a>上传文件 :</th>
      <td><input type="file" name="imgs[]"></td>
   </tr>
</tbody>
</table>

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
	KindEditor.create('#cs', {
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