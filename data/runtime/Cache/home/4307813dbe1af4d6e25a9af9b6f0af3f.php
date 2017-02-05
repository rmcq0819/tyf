<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>代理申请</title>
<link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=2305969672085d309ab08da370ffe010"></script>
<script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
<script type="text/javascript" src="../Style/js/jquery-1.7.1.min.js"></script>
<meta charset="utf-8" />
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>" />
<meta name="description" content="<?php echo ($page_seo["description"]); ?>" />
<meta content="telephone=no" name="format-detection" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../Style/shop.css">
<link type="text/css" rel="stylesheet" href="../Style/ke_css.css">
<link href="../Style/css/css.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="../Style/js/ecmall.js" type="text/javascript"></script>
<script type="text/javascript" src="../Style/js/index.js"></script>
<script src="../Style/js/touchslider.dev.js"></script>
</head>
<style>
	body{width:100%;background: url(../Style/images/bg.png) no-repeat;background-size: cover;}
	
/*注册*/
/*.zc_top{max-width: 640px;min-width: 320px;margin: 0 auto;background: #000;overflow: hidden;font-size: 1.2em;color: #fff;}
.zc_top a {float: left;width: 21px;height: 35px;background: url(../Style/images/jt.png) no-repeat left;padding: 10px 0px;margin-left: 10px;}
.zc_top span{color: #fff;font-size: 1.2em;height: 55px;line-height: 40px;margin-left: 25%;}*/
.logo_10{width: 122px;height:122px;margin: 0px auto; padding-top:18%;}
.logo_10 img{width: 122px;height: 122px;}
.input_10{width: 100%;overflow: hidden;margin-top: 5%;}
.input_10 input{width: 75%;color: rgb(90,90,90);font-size: 1.2em;background: rgb(219,224,227) no-repeat;border: none;height:35px;line-height:30px;outline-style: none;margin-left: 12%;margin-bottom:5%; border-radius:8px; }
.input_10 input:first-child{background: rgb(219,224,227) url(../Style/images/portrait.png) no-repeat 5%;float: left;background-size: 8%;text-indent: 55px;}
.input_10 input:nth-child(2){background: rgb(219,224,227) url(../Style/images/phone.png) no-repeat 6%;float: left;background-size: 6%;text-indent: 55px;}
.input_10 input:nth-child(3){background: rgb(219,224,227) url(../Style/images/address.png) no-repeat 5%;float: left;background-size: 8%;text-indent: 55px;}
.input_10 input:nth-child(4){background: rgb(219,224,227) url(../Style/images/weixin.png) no-repeat 5%;float: left;background-size: 8%;text-indent: 55px;}
.input_10 input:nth-child(5){background: rgb(219,224,227) url(../Style/images/identity.png) no-repeat 5%;float: left;background-size: 8%;text-indent: 55px;}
.shenq{width:160px; height:40px; margin:0 auto; margin-top:13%;}
.shenq a{width:160px; height:40px;text-align:center;line-height:40px;color:rgb(252,237,231); display:block;font-size:16px; background-color:rgb(235,94,2); border:none; border-radius:30px; margin:0 auto; box-shadow:5px 5px 10px rgb(101,91,94);}
/*.shenq a{color: rgb(252,237,231);font-size: 1.2em;background: #df5d10;border-radius: 30px; padding: 80px;margin-left: 35%;}
*/
#username{
	width: 75%; height: 35px ;text-align: center; border-radius: 8px; position: relative; left: 0px; padding-left: 12%; margin-bottom: 16px;
}
#fenlei{
	width: 75%; height: 35px ;text-align: center; border-radius: 8px; position: relative; left: 0px; padding-left: 12%;
}
#fenlei select,#username select{
	width: 100%; height: 100%; text-align: center; line-height: 100%; border-radius: 8px; padding-left: 10px;background-color: rgb(219,224,227); -webkit-appearance:none;appearance:none; color: rgb(85,85,85); outline: none;
}
#username img,#fenlei img{
	width: 15px;position: absolute; right: 10px; top: 11px;
}

.footer_10{width: 50%; height:50px; border-top: 1px solid #898988;color: #ccc;letter-spacing: 5px;margin:0 auto;text-align: center;margin-top: 20%;}
/*消息提示*/
.tips_msg{
	width:100%;height:auto; padding:10px;;background:#000;opacity:0.7;-moz-opacity:0.7;filter:alpha(opacity=70);display:block;margin-top:4px;color:#FFFFFF; position:fixed;z-index:9999;font-size:16px;
}
.showinfo{border-radius:5px;background:#000;opacity:0.6;-moz-opacity:0.6;filter:alpha(opacity=60);width:120px;height:38px;box-shadow:0px 0px 10px #000;margin:-60px auto;color:#FFFFFF; text-align:center; line-height:38px;font-size:14px;display:none;}
</style>
<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
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

<div class="tips_msg">您的邀请人是：<?php echo ($share_data["username"]); ?></div>
<script type="text/javascript" src="../Style/js/amazeui.min.js"></script>
<script type="text/javascript">
    var map, geolocation;
	//调用浏览器定位服务
    map = new AMap.Map('container', {
        resizeEnable: true
    });
    map.plugin('AMap.Geolocation', function() {
        geolocation = new AMap.Geolocation({
            enableHighAccuracy: true,
            timeout: 10000,          
            buttonOffset: new AMap.Pixel(10, 20),
            zoomToAccuracy: true,
            buttonPosition:'RB'
        });
        map.addControl(geolocation);
        geolocation.getCurrentPosition();
        AMap.event.addListener(geolocation, 'complete', onComplete);//返回定位信息
        AMap.event.addListener(geolocation, 'error', onError);      //返回定位出错信息
    });
    //解析定位结果
    function onComplete(data) {
		var posinum = ''+data.position.getLat()+','+data.position.getLng()+'';
			$.post('<?php echo U('Recom/posid');?>',{'posid':posinum},function(datas){
				var res = eval("("+datas+")");
				$('.get_address').val(res.address);
			});
    }
    //解析定位错误信息
    function onError(data) {
        document.getElementById('tip').innerHTML = '定位失败';
    }
</script>
<body style="width:100%;background: url(../Style/images/subbg.jpg);">
	<div class="logo_10">
		<img src="../Style/images/logotyf.png" alt="logo图标">
	</div>
<form  id="form" name="dl">
	<div class="input_10">
		<input type="text" id="doc-ipt-3-1" name="username" value="<?php echo ($defuname); ?>" placeholder="姓名">
		<input type="text" id="doc-ipt-pwd-21" name="phone_mob" placeholder="联系电话">
		<input type="text" id="doc-ipt-pwd-21" name="address" class="get_address" placeholder="联系地址">
		<input type="text" id="doc-ipt-pwd-21" name="wxname" placeholder="微信号">	
	</div>
	<?php if($higher[0][id] != ''): ?><div id="username">		
				<select name="shangji" id="shangji" style="font-size:13px;color:#666;">
					<option value="0" name="shangji" id="doc-ipt-pwd-21">--请选择上级--</option>
					<?php if(is_array($higher)): foreach($higher as $kk=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" name="shangji" id="doc-ipt-pwd-21"><?php echo ($vo["username"]); ?></option><?php endforeach; endif; ?>
				</select>
			<img src="../Style/images/ar-down.png" alt="下拉框"/>
		</div>
		<div id="fenlei">
			<select id="juese" name="juese" style="font-size:13px;color:#666;">
				<option value="0"  id="doc-ipt-pwd-21">--请选择申请类型--</option>
				<option value="2"  id="doc-ipt-pwd-21">经纪人</option>
				<option value="1"  id="doc-ipt-pwd-21">店长</option>
			</select>
			<img src="../Style/images/ar-down.png" alt="下拉框"/>
		</div>
		<?php else: ?>
		<input type="hidden" name="juese" value="1" />
		<input type="hidden" name="shangji" value="<?php echo ($info["id"]); ?>" /><?php endif; ?>
	<div class="shenq">
		<a id="submit" href="javascript:void(0);">立即申请</a>
	</div>
</form>
<div class="footer_10">
	进口优选商城
</div>
<div class="showinfo"></div>
</body>
</html>
<script src="../Style/js/jquery.touchSwipe.min.js"></script>
<script type="text/javascript">
 $("#submit").click(function(){
    var res = true;
    $("#form").find("input[type='text']").each(function(){
      if ($(this).val() == '') {
          var name = $(this).attr("placeholder");
		  layer.open({
					title: '提示',
					content: name+'不能为空',
					btn: ['我知道了'],
					
				});
          res = flase;
      }
    })
    var tel  = $("input[name='phone_mob']").val();
    var mail = $("input[name='email']").val();
    if(!!tel.match(/^((\d{11})|^((\d{7,8})|(\d{4}|d{3})-(\d{7,8})|(\d{4}|d{3})-(\d{7,8})-(\d{4}|d{3}|\d{2}|d{1})|(\d{7,8})-(\d{4}|d{3}|\d{2}|d{1}))$)$/) == false){
		layer.open({
				title: '提示',
				content: '请输入正确的手机号码',
				btn: ['我知道了'],
				
			});
        res = flase;
    }
    var shangji = $("#shangji").val();
    if(shangji == 0){
    	layer.open({
					title: '提示',
					content: '请选择上级',
					btn: ['我知道了'],
					
				});
          res = flase;
    }
    var juese = $("#juese").val();
    if(juese == 0){
    	layer.open({
					title: '提示',
					content: '请选择申请类型',
					btn: ['我知道了'],
					
				});
          res = flase;
    }
    var username = $("input[name='username']").val();
    var phone_mob = $("input[name='phone_mob']").val();
    var address = $("input[name='address']").val();
    var wxname = $("input[name='wxname']").val();
    if(res) {
      var url ="<?php echo U('Recom/index');?>";
      $.post(url,{userinfo: $("form").serialize(),username:username,phone_mob:phone_mob,address:address,wxname:wxname},function(data){
        //console.log(data);
      	alert(data.title+'\t\t\n'+data.msg);
          if (data.code == 1) {
            window.location.href=data.url;
          };
      },'json');
    }; 
 })
    $(document).ready(
        function() {
            var nowpage = 0;
            //给最大的盒子增加事件监听
            $(".container").swipe(
                {
                    swipe:function(event, direction, distance, duration, fingerCount) {
                         if(direction == "up"){
                            if (nowpage != 1) {
                              nowpage = nowpage + 1;
                            };
                         }else if(direction == "down"){

                            nowpage = nowpage - 1;
                         }

                         if(nowpage > 2){
                            nowpage = 0;
                         }

                         if(nowpage < 0){
                            nowpage = 0;
                         }
                        $(".container").animate({"top":nowpage * -100 + "%"},400); 
                        $(".page").eq(nowpage).addClass("cur").siblings().removeClass("cur");
                    }
                }
            );
        }
    );
</script>