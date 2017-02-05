<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link href="__STATIC__/css/admin/style.css" rel="stylesheet"/>
	<title><?php echo L('website_manage');?></title>
	<script>
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


<!--编辑商品-->
<form id="info_form" action="<?php echo u('item/edit');?>" method="post" enctype="multipart/form-data">
<div class="pad_lr_10">
	<div class="col_tab">
		<ul class="J_tabs tab_but cu_li">
			<li class="current">基本信息</li>
			<li>展示图片</li>
			<li>附加属性</li>
		</ul>
		<div class="J_panes">
        <div class="content_list pad_10">
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
		<?php if($info["edit_time"] != null): ?><tr>
				<th width="120">最后修改时间 :</th>
				<td><span><?php echo (date('Y-m-d H:i:s',$info["edit_time"])); ?></span></td>
			</tr><?php endif; ?>
			<tr>
				<th width="120">所属分类 :</th>
                <td><select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('item_cate/ajax_getchilds', array('type'=>0));?>" data-selected="<?php echo ($selected_ids); ?>"></select>
                <input type="hidden" name="cate_id" id="J_cate_id" value="<?php echo ($info["cate_id"]); ?>" /></td>
			</tr>
			<tr>
				<th width="120">所属免税仓 :</th>
                <td>
				<select name="item_base" style="width:100px;height:23px;">
					<?php if(is_array($item_base)): $i = 0; $__LIST__ = $item_base;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["id"] == $baseid): ?><option value="<?php echo ($vo["id"]); ?>" style="border-top:solid 1px red;" selected><?php echo ($vo["basename"]); ?></option>
							<?php else: ?>
							   <option value="<?php echo ($vo["id"]); ?>" style="border-top:solid 1px red;"><?php echo ($vo["basename"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
				</select>
				<span style="color:#959595;">(这里显示商品的免税仓，务必选上)</span>
				</td>
			</tr>
			
            <tr>
				<th>商品名称 :</th>
				<td><input  type="text" name="title" id="J_title" class="input-text" size="60" value="<?php echo ($info["title"]); ?>"></td>
			</tr>
			 <tr style="display:none;">
			<th>净含量 :</th>
				<td><input type="text" name="color" id="J_color" class="input-text" size="30" value="<?php echo ($info["color"]); ?>" ><font color="#FD5873">（不需要可不填, 格式：多个用竖杆“|”隔开，如：100毫升|150毫升|200毫升）</font></td>
			</tr>
			<tr style="display:none;">
				<th>净含量对应价格 :</th>
				<td><input type="text" name="size" id="J_size" class="input-text" size="30" value="<?php echo ($info["size"]); ?>"><font color="#FD5873">（不需要可不填, 格式：多个用竖杆“|”隔开，如：100|200|300）</font></td>
			</tr>

			<tr style="display:none;">
				<th>净含量对应库存 :</th>
				<td><input type="text" name="kucun" id="J_kucun" class="input-text" size="30" value="<?php echo ($info["kucun"]); ?>"><font color="#FD5873">（不需要可不填, 格式：多个用竖杆“|”隔开，如：100|200|300）</font></td>
			</tr>
			<tr style="display: none;">
                <th>商品简介 :</th>
                <td><textarea name="intro" cols="80" rows="2"><?php echo ($info["intro"]); ?></textarea></td>
            </tr>
            <tr>
				<th>商品图片 :</th>
				<td>
					<?php if(!empty($info['img'])): ?><img src="<?php echo attach(get_thumb($info['img'], '_m'), 'item');?>" width="100" height="100"/><br /><?php endif; ?>
					<input type="file" name="img" />
				</td>
 			</tr>
			<tr>
				<th>商品类型 :</th>
				<td>
					<input type="radio" name="itemtype" value="1" <?php if($info["itemtype"] == 1): ?>checked="checked"<?php endif; ?> />已完税
					&nbsp;&nbsp;&nbsp;
					<input type="radio" name="itemtype" value="0" <?php if($info["itemtype"] == 0): ?>checked="checked"<?php endif; ?> />保税
					&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="itemtype_direct"  value="1" <?php if($info["is_direct"] == 1): ?>checked="checked"<?php endif; ?>/>直邮
				</td>
			</tr>
			<tr>
		      <th>是否人气:</th>
		      <td>
			  <input type="checkbox" name="zhuangui" <?php if($info["zhuangui"] == 1): ?>checked=''<?php endif; ?> value="<?php echo ($info["zhuangui"]); ?>">人气新品</td>
		    </tr>
			<tr style="height:41px;">
		      <th>是否专题推荐:</th>
		      <td><input type="checkbox" name="zhuanti" <?php if($info["zhuanti"] == 1): ?>checked=''<?php endif; ?> value="<?php echo ($info["zhuanti"]); ?>">专题推荐&nbsp;&nbsp;&nbsp;&nbsp;
		      <span id="reason" <?php if($info["zhuanti"] != 1): ?>style="display:none;"<?php endif; ?>>推荐理由：<input type="text" class="input-text" name="reason" size="50" value="<?php echo ($info["reason"]); ?>"></span>
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
				<td>
					<?php if(!empty($info['pic'])): ?><img src="<?php echo attach(get_thumb($info['pic'], '_m'), 'item');?>" width="100" height="100"/><br /><?php endif; ?>
					<input type="file" name="pic" />
				</td>
 			</tr>
			<tr>
		      <th>是否售空:</th>
		      <td>
			  <input value="1" <?php if($info["is_stock"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="is_stock" >已售空
			  &nbsp&nbsp&nbsp<span>(勾选此选项后，系统将无视商品库存，不允许用户购买此商品)</span>
			  </td>
		    </tr>
			
			<tr>
		      <th>是否参与砍价活动:</th>
		      <td>
			  <input value="1" <?php if($info["is_bargain"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="is_bargain" >参与砍价
			  &nbsp&nbsp <span>(勾选此选项后，该商品将自动出现砍价专场页面)</span>
			  </td>
		    </tr>
			
			<tr>
		      <th>是否为虚拟商品:</th>
		      <td>
			  <input value="1" <?php if($info["is_fictitious"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="is_fictitious" >虚拟商品
			  &nbsp&nbsp <span>(虚拟商品将不需要支付运费)</span>
			  </td>
		    </tr>
			
			<tr>
				<th>砍价最低价格 :</th>
				<td><input id='J_bargain_price' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="bargain_price" size="10" class="input-text" value="<?php echo ($info["bargain_price"]); ?>">
				<span  style="color:#959595">&nbsp;(提示：最低可以砍多少？只有参加砍价活动的商品需要填写)</span>
				</td>
			</tr>
			
			
			
			
		   
			
		    </tr>
		    <tr style="display:none;">
		      <th>是否限购:</th>
		      <td><input type="checkbox"  value="1" <?php if($info["is_xiangou"] == 1): ?>checked<?php endif; ?> name="is_xiangou" >&nbsp;限购&nbsp; 
              <input id='xiangou_num' onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9]/g,'')" type="text" name="xiangou_num" class="input-text" size="10" value="<?php echo ($info["xiangou_num"]); ?>">&nbsp;限购数量</td>
		    </tr>
		     <tr style="display:none;">
		      <th>运费:</th>
		      <td>
		      <select id='free' name="free">
		      <option <?php if($info["free"] == 1): ?>selected="selected"<?php endif; ?> value="1">卖家承担运费</option>
		      <option  <?php if($info["free"] == 2): ?>selected="selected"<?php endif; ?>  value="2">买家承担运费</option>
		      </select>
		      </td>
		    </tr>
		    
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
          	 //var addr_id = $("#free:selected").val();
          
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
		    
		    <tr id="address_form" style="display:none;">
		    <th></th>
		    <td> 
		      平邮:<input value="<?php echo ($info["pingyou"]); ?>" onkeyup="value=value.replace(/[^\d\.]/g,'')" type="text" name="pingyou" />
		      快递:<input value="<?php echo ($info["kuaidi"]); ?>" onkeyup="value=value.replace(/[^\d\.]/g,'')" type="text" name="kuaidi" />
		      EMS:<input value="<?php echo ($info["ems"]); ?>" onkeyup="value=value.replace(/[^\d\.]/g,'')" type="text" name="ems" /></td>
		    </tr>
		    
			<!--<tr>
				<th>链接地址 :</th>
				<td><input type="text" name="url" class="input-text" size="50" value="<?php echo ($info["url"]); ?>"></td>
			</tr>
            <tr>
				<th>商品标签 :</th>
				<td>
                	<input type="text" name="tags" id="J_tags" class="input-text" size="50" value="<?php echo ($info["tags"]); ?>">
                    <input type="button" value="<?php echo L('auto_get');?>" id="J_gettags" name="tags_btn" class="btn">
                </td>
			</tr>-->
			<tr style="display:none">
				<th>原价:</th>
				<td><input id='J_priceyuan'   type="text" name="priceyuan" size="10" class="input-text" value="<?php echo ($info["priceyuan"]); ?>">元 </td>
			</tr>
			
			<tr style="display:none">
				<th>活动促销时间 :</th>
				<td><input type="text" name="zuzhuang" size="10" class="input-text" value="<?php echo ($info["zuzhuang"]); ?>"> 天</td>
			</tr>
			<tr>
				<th>小二分成率 :</th>
				<td><input id='J_fengcheng' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="fencheng" size="10" class="input-text" value="<?php echo ($info["fencheng"]); ?>"></td>
			</tr>	
            <tr>
				<th style="font-weight:bold;">销售价 :</th>
				<td><input id='J_price' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="price" size="10" class="input-text" value="<?php echo ($info["price"]); ?>"> 元</td>
			</tr>
			<tr style="display:none;">
				<th>商品原价 :</th>
				<td><input onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="priceyuan" size="10" class="input-text" value="<?php echo ($info["priceyuan"]); ?>">元
				<span  style="color:#959595">&nbsp;（提示：属于展示价格，不参与购物流程，可为空！）</span>
				</td>
			</tr>


			<tr style="display: none;">
				<th>会员价格 :</th>
				<td>
				<?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><span style="display:inline-block">
				<input type="hidden" name="user_price[cate_id][]" value="<?php echo ($cate["id"]); ?>">
				<?php echo ($cate["name"]); ?><input class='user_price_<?php echo ($cate["id"]); ?>' onkeyup="this.value=this.value.replace(/[^0-9.-]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.-]/g,'')" type="text" name="user_price[price][]" class="input-text" size="10" value="<?php echo ($cate["user_price"]); ?>"> &nbsp </span><?php endforeach; endif; else: echo "" ;endif; ?>
				<br/>
				<span style="color:#842;display:block; padding-top:3px;">请填写会员价格，-1代表默认价格 空和0代表免费</span>
				</td>
			</tr>
			<tr style="display: none;">
				<th>商品积分 :</th>
				<td><input id='J_score' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')" type="text" name="score" size="10" class="input-text" value="<?php echo ($info["score"]); ?>"> 分</td>
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
			function del_size(obj,img,id)
			{
				if(img != ''){
					var url="<?php echo U('item/delimg');?>";
					$.post(url,{id:id,img:img},function(data){
						alert(data);
					});
				}
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
				<td width="8%">
					规格
				</td>
				<td>SKU编码</td>
				<td>进货价</td>
				<td>成本价</td>
				<td>分类优惠价</td>
				<td>活动价</td>
				<td>商品总库存</br>
				    <input value="1" <?php if($info["is_stockjointly"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="is_stockjointly" ><span style="color:red">共库存</span>
				</td>
				<td>单件商品所占库存量</td>
				<td>商品规格</td>
				<td style="width:50px">规格图片</td>
				<td style="border-right:0px;">操作</td>
			</tr>
			<tbody class="add_size">
			<?php if(is_array($info['goods_stock'])): $k = 0; $__LIST__ = $info['goods_stock'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($k % 2 );++$k;?><tr style="height:35px;">
				<td>
					<?php if($k == 1): ?><a href="javascript:void(0);" class="blue" onclick="add_size();"><img src="__STATIC__/css/admin/bgimg/tv-expandable.gif" /></a>
					<?php else: ?>
						<a href="javascript:void(0);" class="blue" onclick="del_size(this,'<?php echo ($info['size_imgs'][$k-1]); ?>','<?php echo ($info["id"]); ?>');"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a><?php endif; ?>
					<?php echo ($k); ?>
				</td>
				<td><input type="text" name="adress[]" class="input-text" size="20" value="<?php echo ($info['adress'][$k-1]); ?>"></td>
				<td><input type="text" name="price_jinhuo[]" size="10" class="input-text" value="<?php echo ($info['price_jinhuo'][$k-1]); ?>"> 元</td>
				<td><input type="text" name="cost[]"size="10" class="input-text" onblur="checkYhprice(this);" value="<?php echo ($info['cost'][$k-1]); ?>"> 元</td>
				<td><input type="text" name="yhprice[]" size="10" onblur="checkYhprice(this);" class="input-text" value="<?php echo ($info['yhprice'][$k-1]); ?>" > 元</td>
				<td><input type="text" name="aprice[]" size="10" onblur="checkaprice(this);" class="input-text" value="<?php echo ($info['aprice'][$k-1]); ?>" > 元</td>
				<td><input type="text" name="goods_stock[]" class="input-text" size="10" value="<?php echo ($info['goods_stock'][$k-1]); ?>"></td>
				<td><input type="text" name="stock[]" class="input-text" size="10" value="<?php echo ($info['stock'][$k-1]); ?>"></td>
				<td><input type="text" name="size[]" class="input-text" value="<?php echo ($info['size'][$k-1]); ?>" size="20"></td>
				<td>
				<?php if(!empty($info['size_imgs'][$k-1])): ?><img src="<?php echo attach(get_thumb($info['size_imgs'][$k-1], '_m'), 'item_size');?>" onclick="window.location.href='<?php echo attach(get_thumb($info['size_imgs'][$k-1], '_b'), 'item_size');?>'" width="100" height="100" style="padding:8px;"/><?php endif; ?>
				<input type="file" name="size_imgs[]"/>
				</td>
				<td style="border-right:0px;"><input type="button" onclick="copy(this);" value="复制" /><input type="button" onclick="paste(this);" value="粘贴" /></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">		
			<tr>
				<th width="120">所属国家 :</th>
                <td>
				<select name="country" style="width:100px;height:23px;">
						<?php if(is_array($country_name)): $i = 0; $__LIST__ = $country_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['Id'] == $countryId): ?><option value="<?php echo ($vo["Id"]); ?>" style="border-top:solid 1px red;" selected><?php echo ($vo["name"]); ?></option>
							<?php else: ?>
							   <option value="<?php echo ($vo["Id"]); ?>" style="border-top:solid 1px red;"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>	
				</select>
				<span style="color:#959595;">(这里显示商品的国家，务必选上)</span>
				</td>
			</tr>
			<tr>
				<th width="120">所属品牌:</th>
                <td>
				<select name="brandId" style="width:100px;height:23px;">
				<?php if($info["brandId"] == 0): ?><option value="0">--请选择--</option>
					<?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
				    <option value="0">--请选择--</option>
					<?php if(is_array($brand)): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["id"] == $info['brandId']): ?><option value="<?php echo ($vo["id"]); ?>" style="border-top:solid 1px red;" selected><?php echo ($vo["name"]); ?></option>
							<?php else: ?>
							   <option value="<?php echo ($vo["id"]); ?>" style="border-top:solid 1px red;"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
				</select>
				</td>
			</tr>
			<tr>
		      <th>是否单品活动:</th>
		      <td>
			   <input value="1" <?php if($info["activity"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="activity" >活动
			   <span style="color:#959595;">(请注意区商品为单品还是套餐，可参加相应活动)</span>
			</td>
			
			<tr>
		      <th>抢购数量:</th>
			 <td><input id='J_salequantity' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="sale_quantity" size="10" class="input-text" value="<?php echo ($info["sale_quantity"]); ?>"> </td>
			</tr>
			
			<tr>
		      <th>已抢购数量:</th>
			 <td><input id='J_saled_quantity' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="saled_quantity" size="10" class="input-text" value="<?php echo ($info["saled_quantity"]); ?>"><span style="color:red;"> 给用户看的，技术部参与调整即可。</span></td>
			</tr>
			
			</tr>
			<tr>
		      <th>是否套餐:</th>
		      <td>
			   <input value="1" <?php if($info["is_combo"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="is_combo" >套餐
			</td>
			</tr>
			
			<tr>
		      <th>是否参与范票商城:</th>
		      <td>
			  <input value="1" <?php if($info["is_fping"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="is_fping" >参与兑换
			  &nbsp&nbsp <span>(勾选此选项后，该商品将自动出现在范票商城页面)</span>
			  </td>
		    </tr>
			
			<tr>
				<th>兑换所需范票数量 :</th>
				<td><input id='J_fping_num' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="fping_num" size="10" class="input-text" value="<?php echo ($info["fping_num"]); ?>">
				<span  style="color:#959595">&nbsp;(提示：如8000)</span>
				</td>
			</tr>
			
			<tr>
				<th>需要多少钱兑换 :</th>
				<td><input id='J_fping_price' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')"  type="text" name="fping_price" size="10" class="input-text" value="<?php echo ($info["fping_price"]); ?>">
				<span  style="color:#959595">&nbsp;(提示：如10)</span>
				</td>
			</tr>
			
			
			
			<tr>
		      <th>是否在首页展示:</th>
		      <td>
			   <input value="1" <?php if($info["home"] == 1): ?>checked=''<?php endif; ?> type="checkbox" name="home" >显示到首页
			</td>
			</tr>
			<tr>
				<th>封面图片 :</th>
				<td><input type="file" name="cover" /> <span style="color:#959595">(如不需要在首页推荐显示，请留空)</span></td>
 			</tr>
			<tr>
				<th>已有封面图片 :</th>
				<td>
					<?php if(!empty($info['cover'])): ?><img src="<?php echo attach(get_thumb($info['cover'], '_m'), 'item');?>" width="100" height="100"/><br /><br /><?php endif; ?>
				</td>
 			</tr>
			<!--<tr>
				<th width="120">商品来源 :</th>
                <td>
				<select name="orig_id" id="orig_id">
            	<?php if(is_array($orig_list)): $i = 0; $__LIST__ = $orig_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>" <?php if($info['orig_id'] == $val['id']): ?>selected="selected"<?php endif; ?>><?php echo ($val["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            	</select></td>
			</tr>
			<tr>
            	<th>发布人 :</th>
                <td><?php echo ($info["uname"]); ?></td>
            </tr>-->
			<tr>
				<th>产品详情 :</th>
				<td><textarea name="info" id="info" style="width:80%;height:400px;visibility:hidden;resize:none;"><?php echo ($info["info"]); ?></textarea></td>
			</tr>
			<tr>
				<th>产品参数 :</th>
				<td><textarea name="cs" id="cs" style="width:80%;height:400px;visibility:hidden;resize:none;"><?php echo ($info["cs"]); ?></textarea></td>
			</tr>
		</table>
		</div>
			<script>	
				function change_pic(inputid,imgid){
					
					var input=document.getElementById(inputid);
					for (var property in input.files[0]) { 
						console.log(property  +"= "+input.files[0][property]) ;
					} 
					var objUrl = getObjectURL(input.files[0]);
					console.log("objUrl = "+objUrl) ;
					if (objUrl) {
						$("#"+imgid).attr("src", objUrl) ;
					}
				}
				
				//建立一個可存取到該file的url
				function getObjectURL(file) {
					var url = null ; 
					if (window.createObjectURL!=undefined) { // basic
						url = window.createObjectURL(file) ;
					} else if (window.webkitURL!=undefined) { // webkit or chrome
						url = window.webkitURL.createObjectURL(file) ;
					}else if (window.URL!=undefined) { // mozilla(firefox)
						url = window.URL.createObjectURL(file) ;
					} 
					return url ;
					
				}
			</script>
        <div class="content_list pad_10 hidden">
        	<style>
				.addpic {}
				.addpic li { float:left; text-align:center; margin:0 0 10px 20px;}
				.addpic a { display:block;}
            </style>
            <ul class="addpic">
            <?php if(is_array($img_list)): $i = 0; $__LIST__ = $img_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="album_<?php echo ($val['id']); ?>">
            <a href="javascript:void(0)" onclick="del_album(<?php echo ($val['id']); ?>);"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a>
            <a><img src="<?php echo attach(get_thumb($val['url'], '_b'), 'item');?>" style="width:80px;height:60px; border:solid 1px #000; "/></a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="cb"></div>
            <table width="100%" cellpadding="2" cellspacing="1" class="table_form" id="first_upload_file">
                <tbody class="uplode_file">
                <tr>
                    <th width="100" align="left"><a href="javascript:void(0);" class="blue" onclick="add_file();"><img src="__STATIC__/css/admin/bgimg/tv-expandable.gif" /></a>上传文件 :</th>
                    <td><input type="file" name="imgs[]"></td>
                </tr>
                </tbody>
            </table>
        </div>
	<!--	<div class="content_list pad_10 hidden">
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
			<tr>
				<th width="120"><?php echo L('seo_title');?> :</th>
 				<td><input type="text" name="seo_title" class="input-text" size="60" value="<?php echo ($info["seo_title"]); ?>"></td>
			</tr>
			<tr>
				<th><?php echo L('seo_keys');?> :</th>
				<td><input type="text" name="seo_keys" class="input-text" size="60" value="<?php echo ($info["seo_keys"]); ?>"></td>
			</tr>
			<tr>
				<th><?php echo L('seo_desc');?> :</th>
				<td><textarea name="seo_desc" cols="80" rows="8"><?php echo ($info["seo_desc"]); ?></textarea></td>
			</tr>
		</table>
		</div>-->
        <div class="content_list pad_10 hidden">
		<table width="100%" cellpadding="2" cellspacing="1" style="text-align:left" class="table_form" id="item_attr">
			<tbody class="add_item_attr">
			<?php if(is_array($attr_list)): $i = 0; $__LIST__ = $attr_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td width="220">
                <a href="javascript:void(0);" class="blue" onclick="del_attr(<?php echo ($val["id"]); ?>,this);"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a>属性名 :<?php echo ($val["attr_name"]); ?>
                </td>
                <td width="">属性值 :<?php echo ($val["attr_value"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <tbody class="add_item_attr">
            <tr>
                <th width="220">
                <a href="javascript:void(0);" class="blue" onclick="add_attr();"><img src="__STATIC__/css/admin/bgimg/tv-expandable.gif" /></a>属性名 :<input type="text" name="attr[name][]" class="input-text" size="20">
                </th>
                <td>属性值 :<input type="text" name="attr[value][]" class="input-text" size="30"><font color="#FD5873">（ 属性格式：多个用竖杆“|”隔开，如：蓝色|红色|白色）</font></td>
            </tr>
            </tbody>
		</table>
		</div>
        </div>
		<div class="mt10"><input type="submit" value="<?php echo L('submit');?>" id="dosubmit" name="dosubmit" class="btn btn_submit" style="margin:0 0 10px 100px;"></div>
	</div>
</div>
<input type="hidden" name="menuid"  value="<?php echo ($menuid); ?>"/>
<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
</form>
<table id="hidden_size_attr" style="display:none;">
	<tbody class="add_size">
	  <tr style="height:35px;">
		<td><a href="javascript:void(0);" class="blue" onclick="del_size(this,'','<?php echo ($info["id"]); ?>');"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a></td>
		<td><input type="text" name="adress[]" class="input-text" size="20" value=""></td>
		<td><input type="text" name="price_jinhuo[]" size="10" class="input-text" value=""> 元</td>
		<td><input type="text" name="cost[]" size="10" onblur="checkYhprice(this);" class="input-text" value=""> 元</td>
		<td><input type="text" name="yhprice[]" size="10" onblur="checkYhprice(this);" class="input-text" value=""> 元</td>
		<td><input type="text" name="aprice[]" size="10" onblur="checkaprice(this);" class="input-text" value=""> 元</td>
		<td><input type="text" name="goods_stock[]" class="input-text" size="10" value=""></td>
		<td><input type="text" name="stock[]" class="input-text" size="10" value=""></td>
		<td><input type="text" name="size[]" class="input-text" value="" size="20"></td>
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
	$("#J_title").formValidator({onshow:'请填写商品名称',onfocus:'请填写商品名称'}).inputValidator({min:1,onerror:'请填写商品名称'}).defaultPassed();
	$("#J_price").formValidator({onshow:'请填写商品价格',onfocus:'请填写商品价格'}).inputValidator({min:1,onerror:'请填写商品价格'}).defaultPassed();
	$("#J_priceyuan").formValidator({onshow:'请填写商品原价',onfocus:'请填写商品原价'}).inputValidator({min:1,onerror:'请填写商品原价'}).defaultPassed();
	$("#J_user_price").formValidator({onshow:'请填写会员价格，-1代表默认价格'});
	
	
	
	
});
function get_child_cates(obj,to_id)
{
	var parent_id = $(obj).val();
	if( parent_id ){
		$.get('?m=item&a=get_child_cates&g=admin&parent_id='+parent_id,function(data){
				var obj = eval("("+data+")");
				$('#'+to_id).html( obj.content );
	    });
    }
}

function add_file()
{
    $("#next_upload_file .uplode_file").clone().insertAfter($("#first_upload_file .uplode_file:last"));
}
function del_file_box(obj)
{
	$(obj).parent().parent().remove();
}
function del_album(id)
{
	var url = "<?php echo U('item/delete_album');?>";
    $.get(url+"&album_id="+id, function(data){
		if(data==1){
		    $('.album_'+id).remove();
		};
    });
}
function add_attr()
{
    $("#hidden_attr .add_item_attr").clone().insertAfter($("#item_attr .add_item_attr:last"));
}
function del_attrs(obj)
{
	$(obj).parent().parent().remove();
}
function del_attr(id,obj)
{
	var url = "<?php echo U('item/delete_attr');?>";
    $.get(url+"&attr_id="+id, function(data){
		if(data==1){
		    $(obj).parent().parent().remove();
		};
    });
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
<table id="hidden_attr" style="display:none;">
<tbody class="add_item_attr">
<tr>
    <th width="200">
    <a href="javascript:void(0);" class="blue" onclick="del_attrs(this);"><img src="__STATIC__/css/admin/bgimg/tv-collapsable.gif" /></a>属性名 :<input type="text" name="attr[name][]" class="input-text" size="20">
    </th>
    <td>属性值 :<input type="text" name="attr[value][]" class="input-text" size="30"></td>
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