<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="__STATIC__/css/admin/style.css" rel="stylesheet" />
    <link href="__STATIC__/js/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
    <title>客户订单信息</title>
    <style type="text/css">

        .kdd
        {
            width: 95%;
            height: auto;
            margin: 15px;
        }
        .t
        {
            width: 100%;
            height: 30px;
            background: #CCCCCC;
            display: block;
            line-height: 27px;
            padding-left: 10px;
        }
        select
        {
            width: 150px;
            border: 1px solid #CCCCCC;
        }
        input
        {
            color: #3366FF;
            font-size: 12px;
            color:#1c94c4;
            width: 250px;
        }
        
        
        
        input.inputtext{ width:70px; color:#000; font-weight:normal;}
        /*收货人地址*/
        .kd_temp1 .show1{left: 498px;top: 249px; width:237px; height:51px;}
        /*联系人*/
        .kd_temp1 .show2{left: 490px; top: 188px; }
        /*联系号码*/
       .kd_temp1 .show3{left: 665px;top: 190px;}
        /*发货人地址*/
        .kd_temp1 .show4{left: 141px;top: 246px; width:221px;}
        /*发货人手机*/
        .kd_temp1 .show5{left: 288px;top: 189px;}
        /*发货人姓名*/
        .kd_temp1 .show6{left: 137px;top: 191px;}
        
        /*ems*/
        .kd_temp1{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/ems.png);}
        .kd_temp1 .show1{left: 545px;top: 268px; width:237px; height:51px;}
        .kd_temp1 .show2{left: 539px; top: 210px; }
        .kd_temp1 .show3{left: 708px;top: 210px;}
        .kd_temp1 .show4{left: 190px;top: 264px; width:221px;}
        .kd_temp1 .show5{left: 337px;top: 212px;}
        .kd_temp1 .show6{left: 186px;top: 212px;}
        
        /*中通速递*/
        .kd_temp2{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/zt.png);}
        .kd_temp2 .show1{left: 544px;top: 220px; width:237px; height:51px;}
        .kd_temp2 .show2{left: 544px; top: 186px; }
        .kd_temp2 .show3{left: 540px;top: 312px;}
        .kd_temp2 .show4{left: 196px;top: 218px; width:221px;}
        .kd_temp2 .show5{left: 187px;top: 309px;}
        .kd_temp2 .show6{left: 200px;top: 183px;}
        
        
        /*圆通速递*/
        .kd_temp3{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/yt.png);}
        .kd_temp3 .show1{left: 544px;top: 220px; width:237px; height:51px;}
        .kd_temp3 .show2{left: 544px; top: 186px; }
        .kd_temp3 .show3{left: 540px;top: 312px;}
        .kd_temp3 .show4{left: 196px;top: 218px; width:221px;}
        .kd_temp3 .show5{left: 187px;top: 309px;}
        .kd_temp3 .show6{left: 200px;top: 183px;}
        
        /*汇通快运*/
        .kd_temp4{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/ht0001.jpg)}
        .kd_temp4 .show1{left: 534px;top: 239px; width:237px; height:51px;}
        .kd_temp4 .show2{left: 544px; top: 202px; }
        .kd_temp4 .show3{left: 689px;top: 370px;}
        .kd_temp4 .show4{left: 182px;top: 239px; width:221px;}
        .kd_temp4 .show5{left: 321px;top: 369px;}
        .kd_temp4 .show6{left: 195px;top: 201px;}
        
        /*宅急送*/
        .kd_temp5{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/zjs0001.jpg)}
        .kd_temp5 .show1{left: 119px;top: 383px; width:237px; height:51px;}
        .kd_temp5 .show2{left: 147px; top: 352px; }
        .kd_temp5 .show3{left: 270px;top: 440px;}
        .kd_temp5 .show4{left: 140px;top: 249px; width:221px;}
        .kd_temp5 .show5{left: 270px;top: 305px;}
        .kd_temp5 .show6{left: 154px;top: 217px;}
        
        /*韵达快运*/
        .kd_temp6{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/yunda.png)}
        .kd_temp6 .show1{left: 521px;top: 208px; width:237px; height:51px;}
        .kd_temp6 .show2{left: 522px; top: 308px; }
        .kd_temp6 .show3{left: 700px;top: 177px;}
        .kd_temp6 .show4{left: 177px;top: 225px; width:221px;}
        .kd_temp6 .show5{left: 193px;top: 314px;}
        .kd_temp6 .show6{left: 173px;top: 182px;}
        
        /*德邦物流*/
        .kd_temp7{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/db0001.jpg)}
        .kd_temp7 .show1{left: 263px;top: 322px; width:253px; height:43px;}
        .kd_temp7 .show2{left: 258px; top: 279px; }
        .kd_temp7 .show3{left: 345px;top: 286px;}
        .kd_temp7 .show4{left: 263px;top: 230px; width:221px;}
        .kd_temp7 .show5{left: 258px;top: 203px;}
        .kd_temp7 .show6{left: 261px;top: 176px;}
        
        /*顺丰速递*/
        .kd_temp8{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/sf0001.jpg);}
        .kd_temp8 .show1{left: 145px;top: 413px; width:237px; height:51px;}
        .kd_temp8 .show2{left: 331px; top: 381px; }
       .kd_temp8 .show3{left: 210px;top: 473px;}
        .kd_temp8 .show4{left: 142px;top: 261px; width:221px;}
        .kd_temp8 .show5{left: 224px;top: 314px;}
        .kd_temp8 .show6{left: 335px;top: 231px;}
        
        
        /*申通快递*/
        .kd_temp10{width: 24cm;height: 13cm;border: 1px solid #990000;margin-top: 10px;margin-left: 30px;background: url(__STATIC__/images/admin/st0001.jpg)}
        .kd_temp10 .show1{left: 540px;top: 278px; width:237px; height:51px;}
        .kd_temp10 .show2{left: 553px; top: 210px; }
        .kd_temp10 .show3{left: 547px;top: 346px;}
        .kd_temp10 .show4{left: 210px;top: 263px; width:221px;}
        .kd_temp10 .show5{left: 227px;top: 346px;}
        .kd_temp10 .show6{left: 204px;top: 211px;}
        
        .temp{ float:left;}
        .temp span{ background:#fff; float:left; position:absolute; padding:5px; overflow:hidden; padding-right:16px;}
        .temp span.select{ border:1px dashed red}
        .temp span a{ position:absolute; right:0; top:5px; color:Red}
        .temp span a.ui-icon-trash{ display:none;}
        .temp span h2{ font-size:16px; font-family:"宋体"}
        .temp span p{ display:none;}
        .coor{width:10px;height:10px;overflow:hidden;cursor:se-resize;position:absolute;right:-10px;bottom:-10px;background-color:#09C;}       #trash{height:493px;margin-top: 10px;}       #trash span{ position:static;padding-right:16px; margin:10px; font-weight:normal}       #trash span a{ float: right;}       #trash p{ float:left; color:#000;}       #trash span h2{ float:left;}       .AddTextButton{ text-align:center; display:block; margin-top:10px;float: left; width:100%}       .ui-widget-header{ padding:10px;}       .g-bd1{margin:0 0 10px;}
       .g-sd1{float:left;margin-right:-957px;}
       .g-mn1{float:right;width:100%;}
       .g-mn1c{margin-left:970px;}
    </style>
    <script charset="utf-8" src="__STATIC__/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script charset="utf-8" src="__STATIC__/js/jquery-ui.min.js" type="text/javascript"></script>
    <script charset="utf-8" src="__STATIC__/js/jquery.json.js" type="text/javascript"></script>
     <script charset="utf-8" src="__STATIC__/js/jquery.printPage.js" type="text/javascript"></script>

    <!-- 打印 -->
     <script type="text/javascript">
         $(document).ready(function () {
             var kdtemp = '<?php echo ($temp["kstr"]); ?>';
             if (kdtemp != "") {
                 var dataset = $.parseJSON(kdtemp);
                 var rid = '<?php echo ($temp["kid"]); ?>';
                 var htmlstr = "";
                 for (var i = 0; i < dataset.Texts.length; i++) {
                     htmlstr += "<span id=\"show\" class=\"show" + (i + 1) + "\" style=\"left: " + dataset.Texts[i].Left + "px; top: " + dataset.Texts[i].Top + "px; height: " + dataset.Texts[i].Height + "px; width: " + dataset.Texts[i].Width + "px;\"><p>" + dataset.Texts[i].sText + "</p><h2>" + dataset.Texts[i].Text + "</h2><a href=\"javascript:;\" title=\"删除\" class=\"ui-icon ui-icon-closethick\">删除</a></span>";
                 }
                 $("#gallery").html(htmlstr);
                 $("#gallery").removeAttr("class").addClass("temp").addClass("kd_temp" + rid).addClass("g-sd1");
                 $("#kd").val(rid);
                 $(".btnPrint").show();
             }
             var $gallery = $("#gallery"),
                $trash = $("#trash");
             $("#gallery span").draggable({
                 cancel: "a.ui-icon", // 点击一个图标不会启动拖拽
                 containment: '#gallery',
                 cursor: "move"
             }).mousedown(function () {
                 $(this).addClass("select").siblings().removeClass("select");
             }).resizable();

             // 图像删除功能
             var recycle_icon = "<a href='javascript:;' title='添加' class='ui-icon ui-icon-plusthick'>添加</a>";
             function deleteImage($item) {
                 var h = parseInt($item.css("height"));
                 var w = parseInt($item.css("width"));
                 $item.fadeOut(function () {
                     var $list = $("ul", $trash).length ?
          $("ul", $trash) :
          $("<ul class='gallery ui-helper-reset'/>").appendTo($trash);
                     $item.find("a.ui-icon-closethick").remove();
                     $item.append(recycle_icon).appendTo($list).fadeIn(function () {
                         $item
            .css({ width: "auto" })
            .attr("w", w)
            .attr("h", h)
            .css({ height: "20px" })
            .css("position", "static")

                     });
                 });
             }

             // 图像还原功能
             var trash_icon = "<a href='javascript:;' title='删除' class='ui-icon ui-icon-closethick'>删除</a>";
             function recycleImage($item) {
                 $item.fadeOut(function () {

                     if ($item.find("input").length > 0) {
                         var text = $item.find("input").eq(0).val();
                         var text1 = $item.find("input").eq(1).val();
                         var inputstr = "<p>" + text + "：</p><h2>" + text1 + "</h2><a class=\"ui-icon ui-icon-trash\" title=\"删除\" href=\"#\">删除</a>";
                         $item.html(inputstr);
                     }
                     $item
          .find("a.ui-icon-plusthick")
            .remove()
          .end()
          .css("width", $item.attr("w"))
          .css("height", $item.attr("h"))
          .append(trash_icon)
          .appendTo($gallery)
          .fadeIn().css("position", "absolute");
                     $item.draggable({
                         cancel: "a.ui-icon", // 点击一个图标不会启动拖拽
                         containment: '#gallery',
                         cursor: "move"
                     }).mousedown(function () {
                         $(this).addClass("select").siblings().removeClass("select");
                     }).resizable();
                 });

             }
             // 通过事件代理解决图标行为
             $("span").live("click", function (event) {
                 var $item = $(this),
                $target = $(event.target);
                 if ($target.is("a.ui-icon-closethick")) {
                     deleteImage($item);
                 } else if ($target.is("a.ui-icon-trash")) {
                     $item.remove();
                 }
                 else if ($target.is("a.ui-icon-plusthick")) {
                     recycleImage($item);
                 }

                 return false;
             });
             var maxItem = $("#gallery span").length;
             $(".AddTextButton").click(function () {
                 maxItem++;
                 var inputstr = "<span class=\"show" + maxItem + " ui-resizable ui-draggable select\" style=\"display: block;\"><p><input type=\"text\" class=\"inputtext\" value=\"备注\">：</p><input type=\"text\" value=\"这里输入文字\"><a class=\"ui-icon ui-icon-trash\" title=\"删除\" href=\"#\">删除</a><a class=\"ui-icon ui-icon-plusthick\" title=\"添加\" href=\"#\">添加</a></span>";
                 $("#trash ul").append(inputstr);

             })
             $("#kd").change(function () {
                 var val = $(this).val();
                 $("#gallery").removeAttr("class").addClass("temp").addClass("kd_temp" + val).addClass("g-sd1");

             })
             $("#Button1").click(function () {
                 $("#addr1").val(SaveTemplateData());
                 $("form").submit();
             })
             $(".btnPrint").printPage();
         })
        function DocumentPage() {
            this.Texts = ([]);
        }
        function TextItem() {
            this.Text = "";
            this.sText = "";
            this.Left = 0;
            this.Top = 0;
            this.Width = 400;
            this.Height = 243;
        }
        function SaveTemplateData() {
            var page = new DocumentPage();
            $.each($("#gallery span"), function (p, pageitem) {
                var textObj = new TextItem();
                textObj.Text = $(pageitem).find("h2").text();
                textObj.sText = $(pageitem).find("p").text();
                textObj.Left = parseInt($(pageitem).css("left"));
                textObj.Top = parseInt($(pageitem).css("top"));
                textObj.Width = parseInt($(pageitem).css("width"));
                textObj.Height = parseInt($(pageitem).css("height"));
                page.Texts.push(textObj);
            });
            var data = $.toJSON(page);
            return data;
        }
     </script>
</head>
<body>
    <!-- 订单模板S -->
    <div class="kdd">
    <div>
        <span class="t">快递单打印 <a href="javascript:history.go(-1);" class="a">返回</a></span>
        <br />
<form name="form" method="post" action="./index.php?g=admin&m=item_order&a=print_kdd_update">
        快递单模板选择：
        <select name="kd" id="kd">
            <option value="0">--请选择模板--</option>
            <?php if(is_array($kd)): $i = 0; $__LIST__ = $kd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($kd["id"]); ?>"><?php echo ($kd["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select></div>
        <div class="temp kd_temp1 g-sd1" id="gallery">
            <span id="show" class="show1"><p>收货地址：</p><h2><?php echo ($com_info["address"]); ?></h2><a href="javascript:;" title="删除" class="ui-icon ui-icon-closethick">删除</a></span>
            <span  class="show2"><p>收货人：</p><h2><?php echo ($com_info["address_name"]); ?></h2><a href="javascript:;" title="删除" class="ui-icon ui-icon-closethick">删除</a></span>
            <span  class="show3"><p>收货人手机：</p><h2><?php echo ($com_info["mobile"]); ?></h2><a href="javascript:;" title="删除" class="ui-icon ui-icon-closethick">删除</a></span>
            
            <?php if(is_array($fh)): $i = 0; $__LIST__ = $fh;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fh): $mod = ($i % 2 );++$i;?><span class="show4"><p>发件人地址：</p><h2><?php echo ($fh["Province"]); echo ($fh["City"]); echo ($fh["Area"]); echo ($fh["address"]); echo ($fh["name"]); ?></h2><a href="link/to/trash/script/when/we/have/js/off" title="删除" class="ui-icon ui-icon-closethick">删除</a></span>
                <span  class="show5"><p>发件人手机：</p><h2><?php echo ($fh["mobile"]); ?></h2><a href="javascript:;" title="删除" class="ui-icon ui-icon-closethick">删除</a></span>
                 <span class="show6"><p>发件人：</p><h2><?php echo ($fh["contacts"]); ?></h2><a href="javascript:;" title="删除" class="ui-icon ui-icon-closethick">删除</a></span><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="g-mn1">
       <div id="trash" class="ui-widget-content ui-state-default ui-droppable g-mn1c">
        <h4 class="ui-widget-header">订单信息</h4>
        <ul class="gallery ui-helper-reset">
     
        </ul><a class="AddTextButton" href="javascript:;">添加一行文字</a></div>
        </div>
    </div>
    <!-- 订单模板E -->
<!--隐藏域-->
	<!-- 收货人-->
    <input type="hidden" name="addr1" id="addr1" value=""/>
	<input type="hidden" name="rid" value="<?php echo ($com_info["id"]); ?>"/>
	<input type="hidden" name="time" value="<?php echo time();?>"/>
	<div style=" text-align:center;width: 100%;float: left;margin-top: 30px;"><a id="Button1" class="btn btn_submit" type="button" href="javascript:;">保存</a> <a class="btn btn_submit btnPrint" href='./index.php?g=admin&m=item_order&a=print_kdd_print&order_id=<?php echo ($com_info["id"]); ?>' style=" display:none;">打印!</a></div>
	</form>
</body>
</html>