<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
<title>代理后台中心</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo ($info["merchant"]); ?></title>
<link href="../Style/css/amazeui.css" rel="stylesheet" type="text/css" />
<link href="../Style/css/css.css" rel="stylesheet" type="text/css" />
<link href="../Style/css/jquery.spinner.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../Style/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../Style/js/TouchSlide.1.1.js"></script>
<script type="text/javascript" src="../Style/js/amazeui.min.js"></script>
<script type="text/javascript" src="../Style/js/jquery.spinner.js"></script>
<script type="text/javascript" src="../Style/js/scrollTop.js"></script>
<script type="text/javascript" src="../Style/js/indexshop.js"></script>
<script type="text/javascript" src="../Style/js/jquery.fly.min.js"></script>
<script src="../Style/js/fastclick.js" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript">
	$(function() { 
		FastClick.attach(document.body);
	}); 
</script>
<style type="text/css">
#rtt {width:30px; height:30px; background:url(../Style/images/rrt.png); background-size:cover; position:fixed; right:8px; bottom:70px; border-radius: 5px; z-index:999; display:none;}
.proneirong img{width:100%;}
.overlay{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}
.overlay .box{position:fixed;z-index:9999;color:#333;width:320px;height:100px;text-align:center;overflow:hidden;top:0;right:0;bottom:0;left:0;margin:auto;border-radius:5px;background:#FFF;display:block;z-index:9999;}
.overlay .box_title{font-size:14px;font-family:微软雅黑;margin-top:22px;padding:5px;border-bottom:1px solid #ccc;}
.overlay .box_btn{margin-top:15px;}
.overlay .box_btn a{margin:0px 40px;color:#0E90D2;font-size:14px;}
.jj a{border:1px solid #ccc; width:25px; height:25px; padding:2px;}

.noshop{width:100%;margin-top:40%; text-align:center;}
.noshop a{padding:5px 35px; background:#C54056;color:#fff;}

.sreach{position:fixed; left:0; top:0;width:100%;height:100%;z-index:9999;background:#DDD;display:none;}
.am-icon-chevron-left{color:#fff;font-size:16px;}
.am-icon-search{color:#fff;font-size:20px;margin-left:8px;}
#itemlist{float:left;width:99%;height:100%; padding:8px;}
#itemlist li{ padding:5px; background:#FFF;margin-bottom:8px;}
.prorenqi a.onselect{color:#FF3300;}
.load{position:fixed;z-index:999;color:#fff;width:320px;height:150px;text-align:center;overflow:hidden;top:0;right:0;bottom:0;left:0;margin:auto;display:none;}
.load img{border-radius:32px;}
.load span{color:#999999;display:block;}
.nolist{width:90%;height:50px;margin:30px auto;font-size:14px;border:1px solid #ddd; text-align:center;line-height:50px;}
.top-title { background:#C54056;height:49px;line-height:49px;color:#FFF;font-size:14px;text-align:center;position: fixed;left:0;top:0;width:100%;transition: top .5s;z-index:9999;}
.top-title2 { background:#C54055;color:#FFF;line-height:32px;padding:5px;text-align:center;position: fixed;left:0;top:0;width:100%;transition: top .5s;z-index:9999;display:none;}
.hiddened{top: -90px;}
.showed{top:0;z-index: 9999;}
.onetop,.twotop,.threetop{width:30px;height:30px;display:block;border-radius:30px;padding:5px;line-height:18px;border:1px solid #333;}
.onetop img,.twotop img,.threetop img{width:20px;heihgt:20px;}
.twotop,.threetop{float:right;}
.onetop1,.twotop1,.threetop1{width:30px;height:30px;display:block;border-radius:30px;padding:5px;line-height:18px;border:1px solid #FFF;}
.onetop1 img,.twotop1 img,.threetop1 img{width:20px;heihgt:20px;}
.twotop1,.threetop1{float:right;}
.cartmsg{width:100%;height:auto; padding:10px 7px;;background:#000;opacity:0.7;-moz-opacity:0.7;filter:alpha(opacity=70);display:none;margin-top:4px;color:#FFFFFF; position:fixed;z-index:9999;font-size:16px;}
#mcover {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: none;
    z-index: 20000;
}
#mcover img {
    position: fixed;
    right: 18px;
    top: 5px;
    width: 260px!important;
    height: 180px!important;
    z-index: 20001;
}

.overlay2{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}
.overlay3{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}
.overlay4{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}

.overlay5{
	background:transparent url(../Style/images/overlay.png) repeat top left;
	position:fixed;
	top:0px;
	bottom:0px;
	left:0px;
	right:0px;
	z-index:9999;
	display:none;
}

.addr_index{background:#FFF;width:100%;height:auto;padding-bottom:12px;}
.addr_indexti{ border-bottom:1px solid #DCDCDC; font-size:14px; text-align:center; line-height:32px;}
#addr_index_close{ float:right; margin-right:8px;}
.addr_index ul li{ padding:5px; border-bottom:1px solid #ccc;}
.showinfo{position:fixed; left:35%;bottom:180px;z-index:99999;border-radius:5px;background:#000;opacity:0.9;-moz-opacity:0.9;filter:alpha(opacity=90); padding:0 5px;width:auto;height:38px;box-shadow:0px 0px 10px #000;margin:-60px auto;color:#FFFFFF; text-align:center; line-height:38px;font-size:14px;display:none;}
.login{ color:#009900; text-align:center; display:none;}
.login2{ color:#009900; text-align:center; display:none;}
</style>




</head>
<style type="text/css">
  #mainer{ text-align:left;}
  * {
  box-sizing: border-box;
  }
  *::before, *::after {
      box-sizing: border-box;
  }
  *::before, *::after {
      box-sizing: border-box;
  }
  h3, .h3 {
      font-size: 24px;
  }
  .m-t-xs {
      margin-top: 5px;
  }
  .block {
      display: block;
  }
  .scrollable{ margin:10px;}
  .panel.panel-default {
      border-color: #e8e8e8;
  }
  .bg-light.lter, .bg-light .lter {
      background-color: #fefefe;
  }
  .m-t {
      margin-top: 15px;
  }
  .panel {
      border-radius: 2px;
  }
  .panel-default {
      border-color: #ddd;
  }
  .panel {
      background-color: #fff;
      border: 1px solid transparent;
      border-radius: 4px;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
      margin-bottom: 20px;
      display: block;
      height:90px;
  }
  .b-light {
      border-color: #e4e4e4;
  }
  .b-r {
      border-right: 1px solid #cfcfcf;
  }
  .padder-v {
      padding-bottom: 15px;
      padding-top: 15px;
  }
  .col-md-3 {
      width: 20%;
  }
  .col-md-1, .col-md-2,.col-sm-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,.col-xs-6,.col-sm-10 {
      float: left;
      min-height: 1px;
      padding-left: 15px;
      padding-right: 15px;
      position: relative;
  }
  .m-r-sm {
      margin-right: 10px;
  }
  .fa-stack {
      display: inline-block;
      height: 2em;
      line-height: 2em;
      position: relative;
      vertical-align: middle;
      width: 2em;
  }
  .pull-left {
      float: left;
  }
  .fa-2x {
      font-size: 2em;
  }
  .pull-left {
      float: left !important;
  }
  .text-uc {
      text-transform: uppercase;
  }
  .text-muted {
      color: #979797;
  }
  .text-muted {
      color: #999;
  }
  small {
      font-size: 12px;
  }
  .padder .fa {
      margin-right: 5px;
  }
  .text-primary {
      color: #65bd77;
  }
  .text-info {
      color: #4cc0c1;
  }
  .text-success {
      color: #8ec165;
  }
  .text-warning {
      color: #ffc333;
  }
  .text-danger {
      color: #fb6b5b;
  }
  .text-light {
      color: #f1f1f1;
  }
  .text-white {
      color: #fff;
  }
  .text-dark {
      color: #2e3e4e;
  }
  .text-blue {
      color: #368ee0;
  }
  .text-muted {
      color: #979797;
  }
  .text-center {
      text-align: center;
  }
  h4, .h4 {
      font-size: 18px;
  }
  .fa-stack-2x {
      font-size: 2em;
  }
  .fa-stack-1x, .fa-stack-2x {
      left: 0;
      position: absolute;
      text-align: center;
      width: 100%;
  }
  .fa {
      display: inline-block;
      font-style: normal;
      font-weight: normal;
      line-height: 1;
  }
  .fa-stack-1x {
      line-height: inherit;
  }
  .panel.panel-default > .panel-heading, .panel.panel-default > .panel-footer {
      border-color: #e8e8e8;
  }
  .panel-default > .panel-heading {
      background-color: #f5f5f5;
      border-color: #ddd;
      color: #333;
  }
  .font-bold {
      font-weight: 700;
  }
  .panel-heading {
      border-radius: 2px 2px 0 0;
  }
  .panel-heading {
      border-bottom: 1px solid transparent;
      border-top-left-radius: 3px;
      border-top-right-radius: 3px;
      padding: 10px 15px;
  }
  .panel-body::after, .modal-footer::before, .modal-footer::after, .row::after {
      content: " ";
      display: table;
  }
  .panel-body {
      padding: 15px;
  }
  .no-padder {
      padding: 0 !important;
  }
  .bg-white {
      background-color: #fff;
      color: #717171;
  }
  .panel-footer {
      border-radius: 0 0 2px 2px;
  }
  .panel-footer {
      background-color: #f5f5f5;
      border-bottom-left-radius: 3px;
      border-bottom-right-radius: 3px;
      border-top: 1px solid #ddd;
      padding: 10px 15px;
  }
  .row {
      margin-left: -15px;
      margin-right: -15px;
  }
  .col-md-8 {
      width: 66.6667%;
  }
  .col-md-4 {
      width: 33.3333%;
  }
  .no-gutter [class*="col"] {
      padding: 0;
  }
  .b-light {
      border-color: #e4e4e4;
  }
  .b-r {
      border-right: 1px solid #cfcfcf;
  }
  .col-xs-3 {
      width: 25%;
  }
  .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
      float: left;
  }
  .row.no-gutter {
      margin-left: 0;
      margin-right: 0;
  }
  .m-b {
      margin-bottom: 15px;
  }

  .line {
      background-color: transparent;
      border-top: 1px solid #e8e8e8;
      border-width: 1px 0 0;
      font-size: 0;
      height: 2px;
      margin: 10px 0;
      overflow: hidden;
  }
  .pull-in {
      margin-left: -15px;
      margin-right: -15px;
  }
  .col-xs-6 {
      width: 50%;
  }
  .col-md-12 {
      width: 100%;
  }
  .m-t-xs {
      margin-top: 5px;
  }
  .col-sm-10 {
      width: 83.3333%;
  }
  .money::before {
      content: "¥";
      margin-right: 1px;
  }
  .m-n {
      margin: 0 !important;
  }
  .form-group {
      margin-bottom: 15px;
  }
  .col-sm-2 {
      width: 16.6667%;
  }
  .text-right {
      text-align: right;
  }
  .list-group {
      border-radius: 2px;
  }
  .list-group {
      margin-bottom: 20px;
      padding-left: 0;
  }
  .panel .list-group-item {
      border-color: #f0f0f0;
  }
  .list-group-item:first-child {
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
  }
  .list-group-item {
      border-color: #e8e8e8;
      padding-right: 15px;
  }
  .list-group-item {
      background-color: #fff;
      border: 1px solid #ddd;
      display: block;
      margin-bottom: -1px;
      padding: 10px 15px;
      position: relative;
  }
  .divall{width:100%;}
.table{width:100%;height:65px;}
.table tr td{ text-align:center;font-size:14px;color:#fff;background:#b72c43;}
.sel{background:#a21930;}
</style>
<link href="../Style/css/pancl01.css" type="text/css" rel="stylesheet" />
<link href="../Style/css/pancl02.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../Style/js/all.js"></script>
<script type="text/javascript" src="../Style/js/colorbox.js"></script>
<link href="../Style/js/colorbox/colorbox.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../Style/js/echarts/echarts.js"></script>
<body>
<div class="dailirembertop" <?php if($dengji == 2): ?>style="background:#FF891B;"<?php elseif($dengji == 3): ?>style="background:#b72c43;"<?php endif; ?>>
<?php if($visitor["hyimg"] != ''): ?><img src="<?php echo ($visitor["hyimg"]); ?>" width="120" height="120" /><?php else: ?><img src="<?php echo ($weiheader["cover"]); ?>" width="120" height="120" /><?php endif; ?>
  <span>
  <?php if($visitor['nickname'] != NULL): echo ($visitor["nickname"]); ?>
    <?php elseif($visitor['username'] != NULL): echo ($visitor["username"]); ?>
    <?php else: echo ($visitor["wechatid"]); endif; ?>
  (<?php echo ($role); ?>)</span>

  <span>上级：
	<?php if($stName != ''): echo ($stName); else: echo ($shares); endif; ?>
&nbsp;&nbsp&nbsp;
  团队：<?php echo ($shares); ?>团队</span>
</div>


<!--<div class="am-g">
<div class="am-u-sm-4 dailichangshu" <?php if($dengji == 2): ?>style="background:#FF895B;width:33%"<?php elseif($dengji == 3): ?>style="background:#89BE74;width:33%"<?php endif; ?>><?php echo ($mk_zong); ?><span>店长总数</span></div>
<div class="am-u-sm-4 dailichangshu hover" <?php if($dengji == 2): ?>style="background:#FF892B;width:33%"<?php elseif($dengji == 3): ?>style="background:#89BE44;width:33%"<?php endif; ?>><?php echo ($dk); ?><span>直推掌柜</span></div>
<div class="am-u-sm-4 dailichangshu" <?php if($dengji == 2): ?>style="background:#FF895B;width:34%;margin:0;"<?php elseif($dengji == 3): ?>style="background:#89BE74;width:34%;margin:0;"<?php endif; ?>><?php echo ($mk_xz); ?><span>直推店长</span></div>
</div>-->

<div class="divall">
<table class="table">
<tr>
<td <?php if($dengji == 2): ?>style="background:#FF895B;width:25%;"<?php elseif($dengji == 3): ?>style="background:#b72c43;width:25%"<?php endif; ?>><?php echo ($mk_zong); ?><br/>店长总数</td>
<td class="sel" <?php if($dengji == 2): ?>style="background:#FF892B;width:25%;"<?php elseif($dengji == 3): ?>style="background:#a21930;width:25%"<?php else: ?>style="background:#a21930;"<?php endif; ?>><?php echo ($dk); ?><br/>直推掌柜</td>
<td <?php if($dengji == 2): ?>style="background:#FF895B;width:25%;margin:0;"<?php elseif($dengji == 3): ?>style="background:#b72c43;width:25%;margin:0;"<?php endif; ?>><?php echo ($mk_xz); ?><br/>直推店长</td>
<td <?php if($dengji == 2): ?>style="background:#FF895B;width:25%;margin:0;"<?php elseif($dengji == 5): ?>style="background:#b72c43;width:25%;margin:0;"<?php endif; ?>><?php echo ($mk_jr); ?><br/>经纪人</td>
</tr>
</table>
</div>

<?php if(($lv_up) == "1"): ?><div class="fanweinshu" style="border-top:none;">
    <span style="float:right;background:#c54157;color:#fff;border-radius:3px;height:80%;line-height:27px;vertical-align:center;padding:4px;margin:5px;" onclick="lv_up();">提交申请</span>亲爱的<?php echo ($visitor["username"]); ?>,您当前符合升级条件.
  </div><?php endif; ?>
<?php if(($up_sq) > "0"): ?><div class="am-alert am-alert-success" data-am-alert style="margin-top:0">
  <p>亲爱的<?php echo ($visitor["username"]); ?>,您当前有未处理的下级代理升级申请.
	 <span style="background:#FF891B;color:#fff;border-radius:3px;height:80%;vertical-align:center;padding:4px;">
		<a href="<?php echo U('User/lvup',array('up'=>1));?>">点击查看</a>
	 </span>
  </p>
</div><?php endif; ?>
<?php if(($down_mg) > "0"): ?><div class="am-alert am-alert-warning" data-am-alert style="margin-top:0">
	<button type="button" class="am-close">&times;</button>
    温馨提示:亲爱的<?php echo ($visitor["username"]); ?>,上个月您未达到团队目标,受到了降级处理.不要灰心,这个月您会做的更好.
  </div><?php endif; ?>
<div class="quxian" style="position:relative;">
  <!-- <span style="right:8px;top:5px;position:absolute;z-index:1px;">总收入:<span style="color:red"><?php echo ($yongjin); ?></span></span> -->
  <div class="panel-body"  style="height:220px;width:100%">
      <div id="visit_charts" style="height:220px;width:100%" data-path="/vshop/Ajax/Get/GetGetOrderCountBookingAndOverAndReturn">
          <div class="load">数据加载中...</div>
      </div>
  </div>
  <?php echo ($echarts); ?>
</div>


<div class="fanweinshu">今日访问量：<?php echo ($liulan); ?></div>
<ul class="am-avg-sm-4 am-thumbnails dailidh">
<li><a href="<?php echo U('User/merusername');?>"><img src="../Style/images/img28.png"><span>店铺设置</span></a></li>
<li><a href="<?php echo U('User/order_list',array('shopid'=>1,'time'=>'one'));?>"><img src="../Style/images/img29.png"><span>店铺订单</span></a></li>
<li><a href="<?php echo U('User/fencheng');?>"><img src="../Style/images/img30.png"><span>我的分销商</span></a></li>
<li><a href="<?php echo U('User/dl_order');?>"><img src="../Style/images/img31.png"><span>代理订单</span></a></li>
<li><a href="<?php echo U('Item/onitemlist');?>"><img src="../Style/images/img32.png"><span>在售商品</span></a></li>
<li><a href="<?php echo U('User/shouquan');?>"><img src="../Style/images/img33.png"><span>授权证书</span></a></li>
<li><a href="<?php echo U('User/qrcode');?>"><img src="../Style/images/img34.png"><span>店铺二维码</span></a></li>
<li><a href="<?php echo U('User/khzs');?>"><img src="../Style/images/img35.png"><span>成交客户</span></a></li>
<!--<li><a href="<?php echo U('Article/listcate');?>"><img src="../Style/images/pic91.png"><span>素材中心</span></a></li>-->
<li><a href="<?php echo U('User/sales_list');?>"><img src="../Style/images/pic92.png"><span>店铺销售额</span></a></li>
<li><a href="<?php echo U('User/flow_history');?>"><img src="../Style/images/pic93.png"><span>访问统计</span></a></li>
</ul>
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default "
      id="">
      <ul class="am-navbar-nav am-cf am-avg-sm-4" <?php if($dengji == 2): ?>style="background:#FF891B;"<?php elseif($dengji == 3): ?>style="background:#c54157;"<?php endif; ?>>
          <li>
            <a href="<?php echo U('Index/index',array('shares'=>$visitor['id']));?>" class="">
            <span class="am-icon-home" style="font-size:28px;margin-top:-5px;"></span>
                <span class="am-navbar-label" style="margin-top:8px;">首页</span>
            </a>
          </li>
          <li>
            <a href="<?php echo U('User/fenchenglist',array('time'=>'one'));?>" class="">
           <img src="../Style/images/img36.png" >
                <span class="am-navbar-label">消息</span>
            </a>
          </li>
          <li>
            <a href="<?php echo U('Index/index',array('shares'=>$uid));?>" class="">
              <img src="../Style/images/img37.png" >
              <span class="am-navbar-label">店铺</span>
            </a>
          </li>
          <li >
            <a href="<?php echo U('User/yongjin');?>" class="">
              <img src="../Style/images/img38.png" >
              <span class="am-navbar-label">奖金</span> 
            </a>
          </li>
  </ul>
</div>
</body>
</html>
<script type="text/javascript">
  function lv_up(){
      if (confirm("确认升级吗?")) {
        var url = "<?php echo U('User/lv_up');?>";
		var num = "<?php echo ($num); ?>";
		var zt  = "<?php echo ($zt); ?>";
        $.post(url,{num:num,zt:zt},function(data){
            if (data.status == 1) {
              alert(data.msg);
            }else{
              alert(data.msg);
            }
        },"json");
      };
  }
</script>