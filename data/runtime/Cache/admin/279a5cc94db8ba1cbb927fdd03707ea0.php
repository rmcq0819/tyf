<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商城后台</title>
<link href="__STATIC__/css/admin/pancl01.css" type="text/css" rel="stylesheet" />
<link href="__STATIC__/css/admin/pancl02.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script type="text/javascript" src="__STATIC__/js/all.js"></script>
<script type="text/javascript" src="__STATIC__/js/colorbox.js"></script>
<link href="__STATIC__/js/colorbox/colorbox.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="__STATIC__/js/echarts/echarts.js"></script>
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
    height:82px;
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
</style>
<script>
    $(document).ready(function () {
        $(".group1").colorbox({ rel: 'group1' });
    });
</script>
</head>

<body>
<div id="mainer">
<div class="scrollable padder">
            <section class="panel panel-default m-t">

                <div class="row m-l-none m-r-none bg-light lter">
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                        <span class="fa-stack fa-2x pull-left m-r-sm">
                            <i class="fa icon-brightness-1 fa-stack-2x text-info"></i>
                            <i class="fa icon-truck fa-stack-1x text-white"></i>
                        </span>
                        <a href="<?php echo U('item_order/index',array('status'=>2,'menuid'=>296));?>" class="clear">
                            <span class="h3 block m-t-xs"><strong><?php echo ($count["fahuo"]); ?></strong></span>
                            <small class="text-muted text-uc">待发货订单</small>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                        <span class="fa-stack fa-2x pull-left m-r-sm">
                            <i class="fa icon-brightness-1 fa-stack-2x text-warning"></i>
                            <i class="fa icon-hammer2 fa-stack-1x text-white"></i>
                            <span data-update="3000" data-target="#bugs" data-animate="2000" data-line-cap="butt" data-size="50" data-scale-color="false" data-track-color="#fff" data-line-width="4" data-percent="100" class="easypiechart pos-abt"></span>
                        </span>
                        <a href="<?php echo U('item_order/index',array('status'=>6,'menuid'=>296));?>" class="clear">
                            <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                            <small class="text-muted text-uc">待处理维权</small>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                        <span class="fa-stack fa-2x pull-left m-r-sm">
                            <i class="fa icon-brightness-1 fa-stack-2x text-blue"></i>
                            <i class="fa icon-bell fa-stack-1x text-white"></i>
                            <span data-update="3000" data-target="#bugs" data-animate="2000" data-line-cap="butt" data-size="50" data-scale-color="false" data-track-color="#fff" data-line-width="4" data-percent="100" class="easypiechart pos-abt"></span>
                        </span>
                        <a href="<?php echo U('item/index',array('goods_stock'=>10));?>" class="clear">
                            <span class="h3 block m-t-xs"><strong id="Strong1"><?php echo ($count["goods_stock"]); ?></strong></span>
                            <small class="text-muted text-uc">库存预警</small>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                        <span class="fa-stack fa-2x pull-left m-r-sm">
                            <i class="fa icon-brightness-1 fa-stack-2x text-danger"></i>
                            <i class="fa icon-paste  fa-stack-1x text-white"></i>
                            <span data-update="5000" data-target="#firers" data-animate="3000" data-line-cap="butt" data-size="50" data-scale-color="false" data-track-color="#f5f5f5" data-line-width="4" data-percent="100" class="easypiechart pos-abt"></span>
                        </span>
                        <a href="<?php echo U('item_order/index',array('time_start'=>$count['time_start'],'time_end'=>$count['time_end']));?>" class="clear">
                            <span class="h3 block m-t-xs"><strong id="firers"><?php echo ($count["Yesterday"]); ?></strong></span>
                            <small class="text-muted text-uc">昨日下单数</small>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                        <span class="fa-stack fa-2x pull-left m-r-sm">
                            <i class="fa icon-brightness-1 fa-stack-2x text-muted"></i>
                            <i class="fa icon-cny fa-stack-1x text-white"></i>
                        </span>
                        <a class="clear">
                            <span class="h3 block m-t-xs"><strong><?php if(empty($count["sumprice"])): ?>0<?php else: echo ($count["sumprice"]); endif; ?></strong></span>
                            <small class="text-muted text-uc">昨日成交金额</small>
                        </a>
                    </div>
                </div>
            </section>
            <div class="row">
            <div class="col-md-8" >
                    <div class="panel panel-default" style="height: 317px">
                        <header class="panel-heading font-bold">7天订单数据<small>（<?php echo ($count["day7datetime"]); ?>）</small></header>
                        <div class="panel-body"  style="height: 210px">
                            <div id="visit_charts" style="height: 210px" data-path="/vshop/Ajax/Get/GetGetOrderCountBookingAndOverAndReturn/0">
                                <div class="load">数据加载中...</div>
                            </div>
                        </div>
                        <footer class="panel-footer bg-white no-padder">
                            <div class="row text-center no-gutter">
                                
                                <div class="col-xs-3 b-r b-light">
                                    <span class="h4 font-bold m-t block"><?php echo ($count["day7order_count"]); ?></span>
                                    <small class="text-muted m-b block">下单数</small>
                                </div>
                                <div class="col-xs-3 b-r b-light">
                                    <span class="h4 font-bold m-t block"><?php echo ($count["day7order_4"]); ?></span>
                                    <small class="text-muted m-b block">成交数</small>
                                </div>
                                <div class="col-xs-3">
                                    <span class="h4 font-bold m-t block"><?php echo ($count["day7order_6"]); ?></span>
                                    <small class="text-muted m-b block">退单数</small>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default" style="height: 317px">
                        <header class="panel-heading font-bold">7天交易数据<small>（<?php echo ($count["day7datetime"]); ?>）</small></header>
                        <div class="bg-light dk wrapper">

                            <div class="text-center m-b-n m-t-sm">
                                <div class="js_turnover" id="js_turnover" style="height: 150px" data-path="/vshop/Ajax/Get/GetOrderTradePrice/0?type=1"><i class="fa fa-spinner fa-spin"></i></div>
                            </div>
                        </div>

                        <div class="panel-body" style="height: 210px">
                            <div>
                                <span class="text-muted">总金额</span>
                                <span class="h3 block money"><?php echo ($count["day7order_sumPrice"]); ?></span>
                            </div>
                            <div class="line pull-in"></div>
                            <div class="row m-t-sm">
                                <div class="col-xs-6">
                                    <small class="text-muted block">成交额</small>
                                    <span class="money"><?php echo ($count["day7order_Price4"]); ?></span>
                                </div>
                                <div class="col-xs-6">
                                    <small class="text-muted block">退款</small>
                                    <span class="money"><?php echo ($count["day7order_Price6"]); ?></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display:none;">
                <div class="col-md-12">
                    <div class="panel panel-default"  style=" height:190px;">
                        <header class="panel-heading font-bold" style=" height:40px;">
                            <div class="row">
                                <div class="col-sm-10 m-t-xs">微信配置</div>
                                <div class="col-sm-2 text-right">
                                    <div class="form-group m-n">
                                        <a href="/vshop/SystemSet/SystemMessageList" class="btn btn-default btn-sm ">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="panel-body">
                            <ul class="list-group">

                                <li class="list-group-item">微商城链接 ：http://<?php echo $_SERVER['SERVER_NAME']; ?>__ROOT__ 
                                </li>
                                <li class="list-group-item">微商接口配置URL ：http://<?php echo $_SERVER['SERVER_NAME']; ?>__APP__?m=Weixin&a=index
                                </li>
                                <li class="list-group-item"> 微商接口配置Token ：weixin
                                </li>   
                              
                            </ul>


                        </div>
                    </div>
                </div>
            </div>

        </div>




    <div class="mainbox" style=" display:block;">
       <div class="mleft">

        
            <div class="mbar">
           
               <div class="mtishi">
                   <p><strong>您可能需要立即处理:</strong></p>
               
                   <p><span>订单提醒:</span>
                       <a  href="<?php echo U('item_order/index',array('status'=>1,'menuid'=>296));?>">待付款订单 [<span class="count"><?php echo ($count["fukuan"]); ?></span>]</a>
                       <a href="<?php echo U('item_order/index',array('status'=>2,'menuid'=>296));?>">待发货订单 [<span class="count"><?php echo ($count["fahuo"]); ?></span>]</a>
                       <a href="<?php echo U('item_order/index',array('status'=>3,'menuid'=>296));?>">已发货订单 [<span class="count"><?php echo ($count["yfahuo"]); ?></span>]</a>
						<a href="<?php echo U('item_order/index',array('status'=>6,'menuid'=>296));?>">退款中订单 [<span class="count"><?php echo ($count["tuihuo"]); ?></span>]</a>
                   </p>
                   <p><span>商品提醒:</span> <a href="<?php echo U('item/index',array('status'=>0));?>">待上架商品 [<span class="count"><?php echo ($count["nobuycount"]); ?></span>]</a></p>
               </div>
           
               <p><span>商品管理:</span> <a href="<?php echo U('item/index',array('status'=>1,));?>">出售中商品 [<span class="count"><?php echo ($count["buycount"]); ?></span>]</a></p>
				<p><span>三天内新留言:</span> <a href="<?php echo U('index/words');?>">有 [<span class="count"><?php echo ($count["words"]); ?></span>]条</a></p>
				<p><span>提现申请提醒:</span><a href="<?php echo U('index/tixian');?>">有 [<span class="count"><?php echo ($count["tixians"]); ?></span>]条</a></p>\
			   </p>
            </div>            
       </div>
       <div class="mright"> </div>
    </div>
</div>
<?php echo ($count["echarts"]); ?>
</body>
</html>