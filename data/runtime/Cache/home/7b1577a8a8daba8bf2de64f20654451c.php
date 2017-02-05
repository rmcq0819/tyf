<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($user_name); ?>的二维码图片</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link href="../Style/dialog.css" rel="stylesheet" type="text/css">
<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
.tips_msg{
	width:100%;
	height:auto;
	font-size:16px;
	text-align:center;
}
</style>
<!-- <link rel="stylesheet" type="text/css" href="../Style/jquery.css">
<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js" ></script> -->
<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js" ></script>
<!-- <script charset="utf-8" type="text/javascript" src="__STATIC__/weixin/js/zh-CN.js"></script> -->
</head>
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

<body>
	<div id="qrcode"><img src="<?php echo ($imgurls); ?>" width="100%",height="auto"></div>
	
	<div class="tips_msg">提示：您可以长按二维码保存至手机相册中 ：)</div>
</body>
</html>