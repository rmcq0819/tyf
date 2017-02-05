<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>客户总数</title>
<link rel="stylesheet" type="text/css" href="../Style/shop.css" />
<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
<script charset="utf-8" src="../Style/js/touchslider.dev.js"></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js" ></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js" ></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/mlselection.js" ></script>
<style>
.topnav{ position:fixed;width:100%;height:49px;z-index:9999; background:#C54056; text-align:center; color:#fff; font-size:16px; line-height:49px; top:0;}
.topnav .back{ position:absolute; left:8px;top:6px;}
</style>
</head>
<body>
<meta name="viewport" content="width=device-width;minimum-scale=1.0; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<script src="../Style/js/shop.js" type="text/javascript"></script>
<link href="../Style/css2/css.css" rel="stylesheet" type="text/css" />
<!-- <link href="../Style/css.css" rel="stylesheet" type="text/css" /> -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<link href="./Tpl/home/default/public/style.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
<!-- <link href="../Style/style.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript">
wx.config({
    debug: false,
    appId: 'wx6a9244fbd61b964f',
    timestamp: '<?php echo ($jsapi['timestamp']); ?>',
    nonceStr: '<?php echo ($jsapi['timestamp']); ?>',
    signature: '<?php echo ($jsapi['signature']); ?>',
    jsApiList: [
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
    ]
  });
  
  wx.ready(function () {
     wx.onMenuShareTimeline({
        title: "<?php echo ($fx_ad['url']); ?>", // 分享标题
        link: '<?php echo ($jsapi['url']); ?>', // 分享链接
        imgUrl: "http://"+window.location.host+"/data/upload/advert/<?php echo ($fx_ad['content']); ?>", // 分享图标
    });
    wx.onMenuShareAppMessage({
        title: "<?php echo ($fx_ad['url']); ?>", // 分享标题
        desc: "<?php echo ($jsapi['url']); ?>", // 分享描述
        link: '<?php echo ($jsapi['url']); ?>', // 分享链接
		imgUrl: "http://"+window.location.host+"/data/upload/advert/<?php echo ($fx_ad['content']); ?>", // 分享图标
        type: 'link', 
        dataUrl: '',
    });
  });
</script>
<!-- <style type="text/css">
	.topnav{ position:fixed;width:100%;height:49px;z-index:9999; background:#C54056; text-align:center; color:#fff; font-size:16px; line-height:49px; top:0;}
	.topnav .back{ position:absolute; left:8px;top:6px;}
</style> -->

<div class="topnav">
	 <a href="javascript:;" onClick="window.history.back(-1);" class="back"><img src="../Style/images/fanhui1.png" width="25" /></a>
	 客户总数
</div>
<div class="clear" style="height:45px"></div>
<div class="fenxiaorenobj">
<div class="fenxiaoren" <?php if(!empty($n)): ?>style="display:none"<?php endif; ?>>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl <?php if($i%2 != 0): ?>class="hover"<?php endif; ?> >
<dt><img src="<?php echo ($vo["cover"]); ?>" width="120" height="120" /></dt>
<dd>
昵称：<span style="color:#35749c;"><?php echo ($vo["username"]); ?></span><br />
联系方式：<span style="color:#35749c;"><?php echo ($vo["phone_mob"]); ?></span><br />
下单数：<span style="color:#35749c;"><?php echo ($vo["order_num"]); ?></span>
<span style="float:right;margin-right:25px">
订单总金额：<span style="color:#35749c;"><?php echo ($vo["order_sum"]); ?></span>
</span>
</dd>
</dl><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="clear"></div>
</div>

<!-- <div class="fenxiaoren" <?php if(($n) != "1"): ?>style="display:none"<?php endif; ?>>
<?php if(is_array($lv2)): $i = 0; $__LIST__ = $lv2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl <?php if($i%2 != 0): ?>class="hover"<?php endif; ?> >
<dt><img <?php if(empty($vo["cover"])): ?>src="<?php echo avatar($vo['id'], 32);?>"<?php else: ?>src="<?php echo ($vo["cover"]); ?>"<?php endif; ?> width="120" height="120" /></dt>
<dd>会员ID：<span style="color:#35749c;"><?php echo ($vo["id"]); ?></span><br />
昵称：<span style="color:#35749c;"><?php echo ($vo["username"]); ?></span><br />
关注时间：<span style="color:#35749c;"><?php echo (date('Y-m-d',$vo["reg_time"])); ?></span></dd>
</dl><?php endforeach; endif; else: echo "" ;endif; ?>

<div class="clear"></div>
</div> -->
<div class="fenxiaoren" <?php if(($n) != "2"): ?>style="display:none"<?php endif; ?> >
<?php if(is_array($lv3)): $i = 0; $__LIST__ = $lv3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl <?php if($i%2 != 0): ?>class="hover"<?php endif; ?> >
<dt><img <?php if(empty($vo["cover"])): ?>src="<?php echo avatar($vo['id'], 32);?>"<?php else: ?>src="<?php echo ($vo["cover"]); ?>"<?php endif; ?> width="120" height="120" /></dt>
<dd>会员ID：<span style="color:#35749c;"><?php echo ($vo["id"]); ?></span><br />
昵称：<span style="color:#35749c;"><?php echo ($vo["username"]); ?></span><br />
关注时间：<span style="color:#35749c;"><?php echo (date('Y-m-d',$vo["reg_time"])); ?></span></dd>
</dl><?php endforeach; endif; else: echo "" ;endif; ?>

<div class="clear"></div>
</div>

</div>
</body>
</html>