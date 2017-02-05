<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>会员中心 - 我的提成记录</title>
<link rel="stylesheet" type="text/css" href="../Style/shop.css" />
<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
<script charset="utf-8" src="../Style/js/touchslider.dev.js"></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js" ></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js" ></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/mlselection.js" ></script>
</head>
<body>
<div id="content" style="background:#fff;min-height: 500px;">
  <div style="background: #e7f3f3;float: left;width:100%;padding-top: 15px;padding-bottom: 10px;">
  <p style="width:100%;height: 45px;">
  <span style="padding: 10px;display: block;float: left;border: 1px dashed #a8aea3;margin-left: 5%;">将获得提成金额:<?php echo ($item_jifennum1-$item_jifennum4); ?>元人民币</span>
  <span style="padding: 10px;display: block;float: left;border: 1px dashed #a8aea3;margin-left: 5%;">可提现提成金额:<?php echo ($item_jifennum-$item_jifennum2); ?>元人民币</span>
  <span style="padding: 10px;display: block;float: left;border: 1px dashed #a8aea3;margin-left: 5%;">正申请提现金额:<?php echo ($item_jifennum3); ?>元人民币</span>
  <span style="padding: 10px;display: block;float: left;border: 1px dashed #a8aea3;margin-left: 5%;">已经提现金额:<?php echo ($item_jifennum2); ?>元人民币</span>
  </p>
  </div>
  <div class="clear"></div>
          	 <?php if(!empty($item_jifenArr)): if(is_array($item_jifenArr)): $i = 0; $__LIST__ = $item_jifenArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li style="list-style-type:none;border-top: 1px solid #e2e6e3;border-bottom: 1px solid #e2e6e3;margin-top: 8px;width: 95%;padding-left:5%;float: left">
			  <div style="width: 65%;float: left;">
			  <h1 style="color: #495143;font-size: 12px;font-weight: 100;line-height: 18px;">
			  <span style="font-size: 12px;color:#939998;float: right;"><?php echo (date('Y-m-d H:i:s',$item["add_time"])); ?></span>
			  <?php if(($item['state'] == 1)): echo ($usersArr[$i-1]['username']); ?>
				的<?php echo ($item["orderId"]); ?>订单总价
			  <?php elseif(($item['state'] == 0)): ?>
			  
			  <p><?php echo $_GET['username'];?> 提现了<span style="color: red;font-weight: 700;"><?php echo ($item["fencheng"]); ?></span>元人民币</p>
			  
			  <p>
			  收款账号:<span style="font-weight: 700;margin-right: 10px;"><?php echo ($item["zhanghao"]); ?></span>
			  账号名称:<span style="font-weight: 700;margin-right: 10px;"><?php echo ($item["huming"]); ?></span>
			  开户银行:<span style="font-weight: 700;"><?php echo ($item["kaihuhang"]); ?></span>
			  </p>
			  <?php elseif(($item['state'] == 3)): ?>
			  <?php echo ($usersArr[$i-1]['username']); ?>
				的<?php echo ($item["orderId"]); ?>退款订单总价
			  <?php else: ?>
			  <p><?php echo $_GET['username'];?> 申请提现<span style="color: red;font-weight: 700;"><?php echo ($item["fencheng"]); ?></span>元人民币</p>
			  
			   <p>
			  收款账号:<span style="font-weight: 700;margin-right: 10px;"><?php echo ($item["zhanghao"]); ?></span>
			  账号名称:<span style="font-weight: 700;margin-right: 10px;"><?php echo ($item["huming"]); ?></span>
			  开户银行:<span style="font-weight: 700;"><?php echo ($item["kaihuhang"]); ?></span>
			  </p><?php endif; ?>
			  <span style="font-weight: 700;">
			  <?php if(($item['state'] == 1)): ?>¥<?php echo ($item["price"]); ?>元
			  <?php elseif(($item['state'] == 3)): ?>
			  ¥<?php echo ($item["price"]); ?>元
			  <?php else: endif; ?></span></h1>
			  </div>
			  <div style="width: 35%;float: right;text-align: center;">
			  <span style="font-size: 16px;margin-top: 5px;display: block;">
			   <?php if($item['state'] == 1): ?>【分成】
			  <?php elseif(($item['state'] == 3)): ?>
			  【因退货】
			  <?php else: ?>
				【提现】<?php endif; ?>
			  <?php if($item['state'] == 1): ?>+
			  <?php else: ?>
				-<?php endif; echo ($item["fencheng"]); ?>
			  </span>
			 <?php if($item['state'] == 2): ?><form id="fencheng_form" action="<?php echo u('user/fencheng_img');?>" method="post" enctype="multipart/form-data" style="margin-top: 10px;">
				<span>上传凭证 :</span>
				<input type="hidden" name="id" value="<?php echo ($item['id']); ?>"/>
				<input type="file" name="img" style="width: 180px;"/>
				<input type="submit" value="提交" id="dosubmit" name="dosubmit" class="btn btn_submit" style="margin:0 0 10px 10px;">
			</form>
			 <?php elseif(($item['state'] == 0)): ?>
			 <a href="data/upload/item/<?php echo ($item['pingzheng']); ?>">查看凭证</a><?php endif; ?>
			  </div>
			  </li><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
           <div class="order_form member_no_records" style="text-align:center;">
                <span>此用户还没有推荐分成记录!</span>
            </div><?php endif; ?> 
</div>
<div class="clear" style="height:40px;"></div>
</body>
</html>