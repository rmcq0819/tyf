<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<link href="__STATIC__/css/admin/css.css" rel="stylesheet"/>

<title>团洋范 - 管理中心</title>
<style>
body {
    background: -moz-radial-gradient(#a2d1c1, #014b67); 
    background: radial-gradient(#a2d1c1, #014b67);
/*  background: -moz-radial-gradient(red, yellow, #1E90FF); background: -moz-radial-gradient(red 5%, yellow 25%, #1E90FF 50%);*/
}
.login h1 img{ vertical-align:bottom;}
</style>
</head>

<body>
<div id="large-header" class="large-header">
                    <canvas id="demo-canvas"></canvas>
                </div>
<div class="login" style="top:65%;left:50%;margin:-340px auto auto -201px; position:absolute; z-index:9999">
    <h1></h1>
   <span style="color:#31598a;display:block;font-size:14px;margin-bottom:10px;text-align:center;"></span>
        <form action="<?php echo U('index/login');?>" method="post" id="reg-form">
        <div class="login-center">

                <ul>
                        <li><span class="icon-user"></span> 用户名:<input name="username" type="text" class="input-text1" value="" />
                        </li>
                        <li> <span class="icon-lock" style="margin-left:3px;"></span>密码:<input name="password" type="password" class="input-text1"  />
                        </li>
                        <li>
                            <span class="icon-spell-check"></span>
                            验证码:
                            <input class="input-text1" type="text" style="width:160px;padding:0px 8px;" name="verify_code"/>
                            <img id="verify" class="verify_img" style="cursor:pointer; position: absolute;margin-top: 15px; margin-left:5px;" title="<?php echo (L("refresh_verify_code")); ?>" src="<?php echo U('index/verify_code', array('t'=>time()));?>">
                        </li>
                </ul>
        </div>
        <input type="submit" value="登录" name="do" class="login-button" style="cursor:pointer;"/>
     </form>
</div>
<script type="text/javascript" src="__STATIC__/js/demo-2.js"></script>
<script language="javascript" type="text/javascript" src="__STATIC__/js/jquery/jquery.js"></script>

<script>
$(function(){
    if(self != top){
        top.location = self.location;
    }
    
    $(".verify_img").click(function(){
        var timenow = new Date().getTime();
        $(this).attr("src","<?php echo U('index/verify_code');?>&"+timenow)
    });
    $("body").height($(document).height());
});
</script>


<iframe name="upload" style="display:none"></iframe>
</body>
</html>