<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>我的分享会员层级结构图</title>
		<link rel="stylesheet" type="text/css" href="../Style/shop.css" />
		<script charset="utf-8" src="../Style/js/jquery.js" type="text/javascript"></script>
		<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
		<script charset="utf-8" src="../Style/js/touchslider.dev.js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/dialog.js" id="dialog_js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.ui.js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/jquery.validate.js"></script>
		<script charset="utf-8" type="text/javascript" src="../Style/js/mlselection.js"></script>
		<style>
			.topnav {
				position: fixed;
				width: 100%;
				height: 49px;
				z-index: 9999;
				background: #C54056;
				text-align: center;
				color: #fff;
				font-size: 16px;
				line-height: 49px;
				top: 0;
			}
			
			.topnav .back {
				position: absolute;
				left: 8px;
				top: 6px;
			}
			.fengxiaotibj{ width:90%; padding:3% 5% 3% 5%;}
			#fengxiao{ width:100%; height:30px; line-height:25px; border:1px #ff4a14 solid; border-radius:3px;}
			#fengxiao ul{ width:100%;}
			#fengxiao ul li.zi1{ width:33%; height:30px; line-height:30px; border-right: solid 1px rgb(240,93,0);float:left; text-align:center; background:url(../images/xian.jpg) repeat-y right top;}
			#fengxiao ul li.zi1.hover{ width:33%; height:30px; line-height:30px; float:left; text-align:center; background:#ff4a14;}
			#fengxiao ul li:last-child{ border-right:none;}
			#fengxiao ul li.zi2{ width:33%; height:30px; line-height:30px; float:left; text-align:center;}
			#fengxiao ul li.zi2.hover{ width:33.4%; height:30px; line-height:30px; float:left; text-align:center; background:#ff4a14;}
			#fengxiao ul li a{ color:#ff4a14;}
			#fengxiao ul li.hover a{ color:#fff;}
			
		</style>
	</head>

	<body>
		<script type="text/javascript">
			$(document).ready(function() {
				var $tab_li = $('.fengxiaoti ul li');
				$tab_li.click(function() {
					$(this).addClass('zi2 hover').siblings().removeClass('zi2 hover').addClass('zi1');
					var index = $tab_li.index(this);
					$('div.fenxiaorenobj >div').eq(index).show().siblings().hide();
				});
			});
		</script>
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
			我的分销商
		</div>
		<div class="fengxiaotibj" style="margin-top:52px;">
			<div class="fengxiaoti" id="fengxiao">
				<ul>
					<li <?php if(empty($n)): ?>class="zi2 hover"
						<?php else: ?>class="zi1"<?php endif; ?> >
						<a href="javascript:void(0)">掌&nbsp;柜(
							<?php if(($count1) == "0"): ?>0
								<?php else: echo ($count1); endif; ?>)</a>
					</li>
					<li <?php if(($n) == "1"): ?>class="zi2 hover"
						<?php else: ?>class="zi1"<?php endif; ?> >
						<a href="javascript:void(0)">店&nbsp;长(
							<?php if(($count2) == "0"): ?>0
								<?php else: echo ($count2); endif; ?>)</a>
					</li>
					<li <?php if(($n) == "2"): ?>class="zi2 hover"
						<?php else: ?>class="zi1"<?php endif; ?> >
						<a href="javascript:void(0)">经纪人(
							<?php if(($count3) == "0"): ?>0
								<?php else: echo ($count3); endif; ?>)</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="fenxiaorenobj">
			<div class="fenxiaoren" <?php if(!empty($n)): ?>style="display:none"<?php endif; ?>>
				<?php if(is_array($lv1)): $i = 0; $__LIST__ = $lv1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl <?php if($i%2 != 0): ?>class="hover"<?php endif; ?> >
						<dt><img <?php if(empty($vo["cover"])): ?>src="<?php echo avatar($vo['id'], 32);?>"<?php else: ?>src="<?php echo ($vo["cover"]); ?>"<?php endif; ?> width="120" height="120" /></dt>
						<dd>会员ID：<span style="color:#35749c;"><?php echo ($vo["id"]); ?></span><br /> 昵称：
							<span style="color:#35749c;"><?php echo ($vo["username"]); ?></span><br /> 注册时间：
							<span style="color:#35749c;"><?php echo (date('Y-m-d H:i:s',$vo["reg_time"])); ?></span></dd>
					</dl><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>

			<div class="fenxiaoren" <?php if(($n) != "1"): ?>style="display:none"<?php endif; ?>>
				<?php if(is_array($lv2)): $i = 0; $__LIST__ = $lv2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl <?php if($i%2 != 0): ?>class="hover"<?php endif; ?> >
						<dt><img <?php if(empty($vo["cover"])): ?>src="<?php echo avatar($vo['id'], 32);?>"<?php else: ?>src="<?php echo ($vo["cover"]); ?>"<?php endif; ?> width="120" height="120" /></dt>
						<dd>会员ID：<span style="color:#35749c;"><?php echo ($vo["id"]); ?></span><br /> 昵称：
							<span style="color:#35749c;"><?php echo ($vo["username"]); ?></span><br /> 注册时间：
							<span style="color:#35749c;"><?php echo (date('Y-m-d H:i:s',$vo["reg_time"])); ?></span></dd>
					</dl><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>
			
			<div class="fenxiaoren" <?php if(($n) != "1"): ?>style="display:none"<?php endif; ?>>
				<?php if(is_array($lv3)): $i = 0; $__LIST__ = $lv3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl <?php if($i%2 != 0): ?>class="hover"<?php endif; ?> >
						<dt><img <?php if(empty($vo["cover"])): ?>src="<?php echo avatar($vo['id'], 32);?>"<?php else: ?>src="<?php echo ($vo["cover"]); ?>"<?php endif; ?> width="120" height="120" /></dt>
						<dd>会员ID：<span style="color:#35749c;"><?php echo ($vo["id"]); ?></span><br /> 昵称：
							<span style="color:#35749c;"><?php echo ($vo["username"]); ?></span><br /> 注册时间：
							<span style="color:#35749c;"><?php echo (date('Y-m-d H:i:s',$vo["reg_time"])); ?></span></dd>
					</dl><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>
		</div>
	</body>

</html>