<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>会员中心 - 我的消息</title>
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


<div class="dingdangyue">
<ul>
<li <?php if(($time) == "one"): ?>class="hover"<?php endif; ?> ><a href="<?php echo U('User/fenchenglist',array('time'=>one));?>">最近一个月</a></li>
<li <?php if(($time) == "two"): ?>class="hover"<?php endif; ?> ><a href="<?php echo U('User/fenchenglist',array('time'=>two));?>">最近三个月</a></li>
<li <?php if(($time) == "third"): ?>class="hover"<?php endif; ?> ><a href="<?php echo U('User/fenchenglist',array('time'=>third));?>">三个月以前</a></li>
</ul>
</div>



<div class="dingdangbj" style="width:94%;">
<div class="mingxi">
<?php if(is_array($item_jifenArr)): $i = 0; $__LIST__ = $item_jifenArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
<?php if(($vo["state"]) == "1"): ?><dt>分成<br />
订单<?php echo ($vo["orderId"]); ?><br>总价￥<?php echo ($vo["price"]); ?><br />
</dt>
<dd><br><span style="color:#999;"><?php echo (date('Y-m-d',$vo["add_time"])); ?></span><br />
<span style="color:#ff4e00; font-size:16px;">+￥<?php echo ($vo["fencheng"]); ?></span></dd>
<div class="clear"></div><?php endif; ?>
<?php if(($vo["state"]) == "0"): ?><dt>提现<br />
￥<?php echo ($vo["fencheng"]); ?></dt>
<dd><br><span style="color:#999;"><?php echo ($vo["add_time"]); ?></span><br />
<span style="color:#ff4e00; font-size:16px;">-<?php echo ($vo["fencheng"]); ?></span></dd>
<div class="clear"></div><?php endif; ?>
<?php if(($vo["state"]) == "2"): ?><dt>申请提现<br />
￥<?php echo ($vo["fencheng"]); ?></dt>
<dd><br><span style="color:#999;"><?php echo (date('Y-m-d',$vo["add_time"])); ?></span><br />
<span style="color:#ff4e00; font-size:16px;">-<?php echo ($vo["fencheng"]); ?></span></dd>
<div class="clear"></div><?php endif; ?>
</dl><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="clear"></div>
</div>
</body>
</html>