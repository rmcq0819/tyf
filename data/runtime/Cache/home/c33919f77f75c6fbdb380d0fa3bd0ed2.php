<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "
http://www.w3.org/TR/html4/frameset.dtd">
<html class="no-js">
	<head>
	<title><?php echo ($info["merchant"]); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
  	<link rel="stylesheet" href="../Style/assets/css/amazeui.min.css">
 	<link rel="stylesheet" href="../Style/assets/css/app.css">
 	<!--<link rel="stylesheet" href="../Style/slick/slick-theme.css" media="screen" />
 	<link rel="stylesheet" href="../Style/slick/slick.css" media="screen" />-->
	<script src="../Style/assets/js/jquery.min.js" type="text/javascript"></script>
	<!-- <script>
	$(document).ready(function(){
		//限制字符个数
		$(".title").each(function(){
			var maxwidth=27;
			if($(this).text().length>maxwidth){
				 $(this).text($(this).text().substring(0,maxwidth));
				 $(this).html($(this).html()+'...');
			}
		});
	});
	</script> -->
	<style>
		* {
			border: none;
			outline: none;
			font-family: "微软雅黑";
		}
		a{
			color:black;
		}
		body{
			background-color: rgb(243,243,243);
		}
		/*头部S*/
		#bg{
			width: 100%; height: 49px; background-color: rgb(240,93,0); position: fixed; top: 0px; left: 0px;
		}
		#tab{
			width: 100%; height: 49px; top: 0px; background-color: rgb(240,93,0);
		}
		#tab li:first-child,#tab li:last-child{
			position: relative; left: 0px; top: 0px;
		}
		#first{
			position: absolute; right: 0px; top: 8px;
		}
		#second{
			position: absolute; left: 0px; top: 8px;
		}
		#tab li a{
			width: 65%;height: 30px; line-height: 30px; border: solid 1px white;
		}
		.am-tabs-default .am-tabs-nav>.am-active a{
			background-color: white;color: rgb(240,93,0);
		}
		/*头部E*/

		/*全部分类和全球好货输入框*/
		#all-sort .search,#word .search{
			width: 100%; height: 40px; background-color: white; text-align: center; line-height: 46px; border-bottom: solid 1px rgb(224,224,224);
		}
		#all-sort input,#word input{
			width: 60%; height: 25px ; background: url(../Style/index-images/maihz_04.png); background-repeat: no-repeat ;font-size: 14px;border: solid 1px rgb(201,201,200);color: #555; font-size: 13px; border-bottom-left-radius: 5px; border-top-left-radius: 5px;border-top-right-radius: 0px;border-bottom-right-radius: 0px; position: relative; background-color: rgb(243,243,243); outline: none; padding-left: 25px; margin-bottom: 7px;
		}
		.search_btn{
			width: 80px; height: 25px; background-color: rgb(243,243,243); color: rgb(240,93,0); font-size: 14px; border: solid 1px rgb(201,201,200); border-bottom-right-radius: 5px; border-top-right-radius: 5px; margin-left: -5px; margin-bottom: 7px;
		}
		/*搜搜E*/
		#all-sort #sort{
			width: 100%; height: 70px; background-color: white; font-size: 13px; padding-bottom: 10px;text-align: center;
		}
		.current{
			color: rgb(240,93,0);padding-bottom: 5px;border-bottom: solid 1px rgb(240,93,0);
		}
		#sort input{
			display: none;
		}
		
		/*分类*/
		#classify ul,#classify2 ul{
			width: 100%; padding: 0px; list-style: none; font-size: 13px; text-align: center;
		}
		#classify ul li,#classify2 ul li{
			width: 100%; height: 55px;color: white; background-color: rgb(241,112,31);  border-bottom:solid 1px rgb(210,209,209) ;
		}
		input[type="radio"]{
			display: none;
		}
		#classify ul li.currents,#classify2 ul li.currents{
			background-color: rgb(243,243,243); color: rgb(240,93,0); border-left: solid 2px rgb(240,93,0);
		} 	
		#classify ul li img,#classify2 ul li img{
			width: 25px; height: 25px; margin-top: 7px;
		}
		

		/*热门推荐*/
		#hot-intro{
			padding: 5px 5px 5px 10px;
		}
		#hot-img2{
			background-color: white; margin-top: -15px;
		}
		.am-thumbnails>li{
			padding: 0px .5rem 0rem .5rem;
		}
		/*#hot-img2 .slide img{
			width: 100%; height: 110px; padding: 0px 2px 0px 2px;
		}
		#hot-img2 .nice-price{
			font-size: 13px;padding: 0px 2px 0px 2px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
		}
		#hot-img2 .price{
			color: rgb(240,93,0);
		}
		#hot-img2 p:last-child{
			color: rgb(240,93,0);margin-top: -15px;font-size: 13px; text-align: center;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
		}*/
		/*专区品类S*/
		#spec{
			padding: 5px 5px 5px 10px; margin-top: -15px;
		}
		#spec img{
			width: 15px;
			height: 15px;
		}
		#product{
			width: 100%; background-color: white; margin-top: 5px; font-size: 13px; text-align: center;
		}
		#product img{
			width: 95%; height: 90px; margin: 0 auto;
		}
		/*专区品类E*/

		/*全球好货*/
		#nation img{
			padding: 0px;
			margin: 0px;
		}
		.am-thumbnail{
			border: none;
		}
		.display-none{
			display:none;
		}
		#guess-like {
			height: 50px;
			line-height: 50px;
			font-size: 13px;
			text-align: center;
			position: relative;
			color: #555;
			clear:both;
			}
			#guess-like .span-1,#guess-like .span-2 {
			border-top: 1px dashed rgb(190,190,190);
			width: 35%;
			position: absolute;
			top: 25px;
			}
			#guess-like .span-1{
			left: 0px;
			}
			#guess-like .span-2{
			right: 0px;
		}
		
	</style>
	<script type="text/javascript" src="../Style/layer/layer.js" charset="utf-8"></script>
	</head>

	<body>
	
		<input type="hidden" name="shares_id" id="shares_id" value="<?php echo ($info["id"]); ?>" />
		 	            
		<div id="first-tabs" class="display-none">
			<div data-am-widget="tabs" class="am-tabs am-tabs-default" data-am-tabs-noswipe="1" style="margin-top: 0px;padding: 0px;">
				<ul id="tab" class="am-tabs-nav am-cf">
		          	<li class="am-active" id="first_page"><a id="first" href="[data-tab-panel-0]">有范生活</a></li>
		          	<li class="" id="second_page"><a id="second" href="[data-tab-panel-1]">全球好货</a></li>
		      	</ul>

			    <div class="am-tabs-bd" style="border-bottom:none;">
			    	<!--全部分类内容-->
			        <div id="all-sort" data-tab-panel-0 class="am-tab-panel am-active" style="padding: 0px; margin-top: 49px;">
			            <div class="search">
					        <input type="text" name="keyword" placeholder="在千万海外商品中搜索..." />
			            	<button class="search_btn" id="search_btn">搜&nbsp;索</button>
			            </div>
			            

			            <div style="width: 74%; margin-left: 26%;">
				            <!--分类图片-->
				            <div>
								<img src="data/upload/item_cate/<?php echo ($itembanner); ?>" alt="分类" class="am-img-responsive" style="width:100%; height:130px; padding-right:3px; padding-top:1px;"/>
							</div>
							<!--热销分类-->
							<div id="hot-intro" style="position: relative; left: 0px; margin-top: 5px;">
								<img src="../Style/index-images/jin.jpg" alt="热销分类" style="width: 15px; height: 15px;"/>
									<span style="font-size: 14px;">热销分类</span>
									<!-- <span style="position: absolute; top: 18px; width:75%; border-top:solid 1px rgb(212,212,212);"></span> -->
							</div>
							
							<div id="hot-img">
								<div class="am-slider am-slider-default am-slider-carousel" data-am-flexslider="{itemWidth: 120, itemMargin: 5, slideshow: false,touch: false}">
		  							<ul class="am-slides" style="font-size: 13px;">
		    							<li></li>
		  							</ul>
								</div>
							</div>
	
							<div id="hot-img2">
								<ul class="am-avg-sm-3 am-thumbnails">
								<?php if(is_array($sub_itemcate)): $i = 0; $__LIST__ = $sub_itemcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li onClick="window.location.href='<?php echo U('Item/itemlist',array('pid' => $pid,'cate_id'=> $vol['id'],'shares'=>$info['id']));?>'">
										<img class="am-thumbnail" src="data/upload/item_cate/<?php echo ($vol["img"]); ?>"/>
  										<p style="font-size: 13px; text-align: center; padding: 0px; color: rgb(81,81,81);"><?php echo ($vol["name"]); ?></p>
  									</li><?php endforeach; endif; else: echo "" ;endif; ?>	
								</ul>
							</div>
	
							<!--热门推荐-->
							<div id="spec" style="position: relative; left: 0px; margin-top: 5px;">
								<img src="../Style/index-images/huo.jpg" alt="热门推荐"/>
								<span style="font-size: 14px;">热门推荐</span>
								<!-- <span style="position: absolute; top: 18px; width: 75%; border-top:solid 1px rgb(212,212,212);"></span> -->
							</div>
							<div id="product">
								<ul class="am-avg-sm-2 am-thumbnails" style="padding-top: 5px;">
								<?php if(is_array($recoms)): $i = 0; $__LIST__ = $recoms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li onClick="location.href='<?php echo U('Item/index', array('id'=>$vol['id'],'shares'=>$info['id'],'page'=>'page'));?>'">
								  	<img class="am-thumbnail" src="data/upload/item/<?php echo get_thumb($vol['img'], '_b');?>"/><p style="padding: 0px; margin: 0px;">
									<span style="color: rgb(137,137,137);">优品价：</span><span style="color: rgb(240,93,0); font-size: 13px;">￥<?php echo ($vol["price"]); ?></span></p>
									<p style="color: rgb(240,93,0); font-size: 13px;">已售<?php echo ($vol["buy_num"]); ?>笔</p>
								  </li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div>
						</div>
			        </div>
			        <div style="width: 25%; height: 50px; position: fixed; left:0; top:60px; font-size: 14px; color: rgb(240,93,0); ">
			            <p style="text-align: center;">全部分类</p>
			        </div>
			        <!--左侧固定-->
			        <div id="classify" style="width: 25%; height: 100%; position:fixed; left: 0px; top: 90px;  overflow: auto; z-index: 999; -webkit-overflow-scrolling: touch; padding: 0px; padding-bottom: 125px;">
				        	<ul>
								<li class="size_radioToggle <?php if($pid == 29): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 29,'shares'=>$info['id']));?>'" style="border-top:solid 1px rgb(210,209,209);">
				        			<img src="../Style/index-images/shipin-<?php if($pid == 29): ?>2<?php else: ?>1<?php endif; ?>.png" alt="进口食品" />
				        			<p>进口食品</p>
				        		</li>
								<li class="size_radioToggle <?php if($pid == 66): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 66,'shares'=>$info['id']));?>'">
				        			<img src="../Style/index-images/mingjiu-<?php if($pid == 66): ?>2<?php else: ?>1<?php endif; ?>.png" alt="海外名酒" />
				        			<p>海外名酒</p>
				        		</li>
								<li class="size_radioToggle <?php if($pid == 23): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 23,'shares'=>$info['id']));?>'">
				        			<img src="../Style/index-images/muying-<?php if($pid == 23): ?>2<?php else: ?>1<?php endif; ?>.png" alt="母婴用品" />
				        			<p>母婴用品</p>
				        		</li>
				        	
				        		<li class="size_radioToggle <?php if($pid == 28): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 28,'shares'=>$info['id']));?>'">
				        			<img src="../Style/index-images/xihu-<?php if($pid == 28): ?>2<?php else: ?>1<?php endif; ?>.png" alt="洗护日化" />
				        			<p>洗护日化<p>
				        		</li>
				        		<li class="size_radioToggle <?php if($pid == 53): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 53,'shares'=>$info['id']));?>'">
				        			<img src="../Style/index-images/meizhuang-<?php if($pid == 53): ?>2<?php else: ?>1<?php endif; ?>.png" alt="美妆香水"/>
				        			<p>美妆香水</p>
				        		</li>
				        		<li class="size_radioToggle <?php if($pid == 30): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 30,'shares'=>$info['id']));?>'">
				        			<img src="../Style/index-images/yingyang-<?php if($pid == 30): ?>2<?php else: ?>1<?php endif; ?>.png" alt="营养保健" />
				        			<p>营养保健</p>
				        		</li>
				        		<li class="size_radioToggle <?php if($pid == 51): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 51));?>'">
				        			<img src="../Style/index-images/jiaju-<?php if($pid == 51): ?>2<?php else: ?>1<?php endif; ?>.png" alt="家居用品" />
				        			<p>家居用品</p>
				        		</li>
								<li class="size_radioToggle <?php if($pid == 64): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 64,'shares'=>$info['id']));?>'">
				        			<img src="../Style/index-images/xiexue-<?php if($pid == 64): ?>2<?php else: ?>1<?php endif; ?>.png" alt="鞋靴箱包" />
				        			<p>鞋靴箱包</p>
				        		</li>
								
				        	</ul>
        			</div>
        			<script>
		            	$(function(){
		            		$("#second").on("click",function(){
		            			$("#classify").hide();
		            		});
		            		$("#first").on("click",function(){
		            			$("#classify").show();
		            		});
		            	});
			        </script>
			        <!--全球好货-->
			        <div id="word" data-tab-panel-1 class="am-tab-panel" style="background-color: rgb(243,243,243); z-index: 10000;">
			            <div class="search" style="margin-top: 49px;">
					        <input type="text"  name="keyword1" placeholder="在千万海外商品中搜索..." />
			            	<button class="search_btn" id="search_btn1">搜&nbsp;索</button>
			            </div>
			            <div id="nation">
			            	<ul class="am-avg-sm-2 am-thumbnails" style="padding: 10px;">
							<?php if(is_array($countrys)): $i = 0; $__LIST__ = $countrys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li style="padding: 1px;" onClick="window.location.href='<?php echo U('Item/itemlist',array('countryId'=> $vol['Id'],'shares'=>$info['id']));?>'"><img class="am-thumbnail" src="data/upload/bg_img/<?php echo ($vol["bg_img"]); ?>" /></li>
	  							<!--<li style="padding: 1px;" onClick="window.location.href='<?php echo U('Item/itemlist',array('countryId'=> $vol['Id']));?>'"><img class="am-thumbnail" src="../Style/index-images/cplist_09.jpg" /></li>--><?php endforeach; endif; else: echo "" ;endif; ?>
							<li style="padding: 1px;" onClick="window.location.href='<?php echo U('Item/itemlist',array('condition' => 'more'));?>'"><img class="am-thumbnail" src="data/upload/bg_img/more.jpg" /></li>
							</ul>
			            </div>
			        </div>
			    </div>
	  		</div>
		</div>

		<div id="second-tabs" class="display-none">
		<div data-am-widget="tabs" class="am-tabs am-tabs-default" data-am-tabs-noswipe="1" style="margin-top: 0px;padding: 0px;">
			<ul id="tab" class="am-tabs-nav am-cf">
	          	<li class="" id="first_page2"><a id="first" href="[data-tab-panel-0]">有范生活</a></li>
	          	<li class="am-active" id="second_page2"><a id="second" href="[data-tab-panel-1]">全球好货</a></li>
	      	</ul>
	      	
		    <div class="am-tabs-bd" style="border-bottom:none;">
		    	<!--全部分类内容-->
		        <div id="all-sort" data-tab-panel-0 class="am-tab-panel" style="padding: 0px; margin-top: 49px;">
		            <div class="search">
				        <input type="text" name="keyword3" placeholder="在千万海外商品中搜索..." />
		            	<button class="search_btn" id="search_btn3">搜&nbsp;索</button>
		            </div>
		             
        			    <div style="width: 74%; margin-left: 26%;">
				            <!--分类图片-->
				            <div>
								<img src="data/upload/item_cate/<?php echo ($itembanner); ?>" alt="分类" class="am-img-responsive" style="width:100%; height:130px;"/>
							</div>
							<!--专区品类-->
							<div id="hot-intro" style="position: relative; left: 0px; margin-top: 5px;">
								<img src="../Style/index-images/jin.jpg" alt="专区品类" style="width: 15px; height: 15px;"/>
									<span style="font-size: 14px;"><?php echo ($sub_name["sub_name"]); ?></span>
									<!-- <span style="position: absolute; top: 18px; width:75%; border-top:solid 1px rgb(212,212,212);"></span> -->
							</div>
							
							<div id="hot-img">
								<div class="am-slider am-slider-default am-slider-carousel" data-am-flexslider="{itemWidth: 120, itemMargin: 5, slideshow: false,touch: false}">
		  							<ul class="am-slides" style="font-size: 13px;">
		    							<li></li>
		  							</ul>
								</div>
							</div>
	
							<div id="hot-img2">
								<ul class="am-avg-sm-3 am-thumbnails">
								<?php if(is_array($sub_itemcate)): $i = 0; $__LIST__ = $sub_itemcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li onClick="window.location.href='<?php echo U('Item/itemlist',array('pid' => $pid,'cate_id'=> $vol['id']));?>'">
										<img class="am-thumbnail" src="data/upload/item_cate/<?php echo ($vol["img"]); ?>"/>
  										<p style="font-size: 13px; text-align: center; padding: 0px; color: rgb(81,81,81);"><?php echo ($vol["name"]); ?></p>
  									</li><?php endforeach; endif; else: echo "" ;endif; ?>	
								</ul>
							</div>
	
							<!--热门推荐-->
							<div id="spec" style="position: relative; left: 0px; margin-top: 5px;">
								<img src="../Style/index-images/huo.jpg" alt="热门推荐"/>
								<span style="font-size: 14px;">热门推荐</span>
								<!-- <span style="position: absolute; top: 18px; width: 75%; border-top:solid 1px rgb(212,212,212);"></span> -->
							</div>
							<div id="product">
								<ul class="am-avg-sm-2 am-thumbnails" style="padding-top: 5px;">
								<?php if(is_array($recoms)): $i = 0; $__LIST__ = $recoms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li onClick="location.href='<?php echo U('Item/index', array('id'=>$vol['id'],'shares'=>$info['id'],'page'=>'page'));?>'">
								  	<img class="am-thumbnail" src="data/upload/item/<?php echo get_thumb($vol['img'], '_b');?>"/><p style="padding: 0px; margin: 0px;">
									<span style="color: rgb(137,137,137);">优品价：</span><span style="color: rgb(240,93,0); font-size: 13px;">￥<?php echo ($vol["price"]); ?></span></p>
									<p style="color: rgb(240,93,0); font-size: 13px;">已售<?php echo ($vol["buy_num"]); ?>笔</p>
								  </li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div>
						</div>
		        </div>
		        <div style="width: 25%; height: 20px; position: fixed; left:0; top:60px; font-size: 14px; color: rgb(240,93,0);">
			        <p style="text-align:center;">全部分类</p>
			    </div>
	            <!--左侧固定-->
		        <div id="classify2" style="width: 25%; height: 100%; position:fixed; left: 0px; top: 90px;  overflow: auto; z-index: 999; -webkit-overflow-scrolling: touch; padding: 0px; padding-bottom: 125px;">
			        	<ul>
							<li class="size_radioToggle <?php if($pid == 29): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 29,'shares'=>$info['id']));?>'" style="border-top:solid 1px rgb(210,209,209);">
								<img src="../Style/index-images/shipin-<?php if($pid == 29): ?>2<?php else: ?>1<?php endif; ?>.png" alt="进口食品" />
								<p>进口食品</p>
							</li>
							<li class="size_radioToggle <?php if($pid == 66): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 66,'shares'=>$info['id']));?>'">
								<img src="../Style/index-images/mingjiu-<?php if($pid == 66): ?>2<?php else: ?>1<?php endif; ?>.png" alt="海外名酒" />
								<p>海外名酒</p>
							</li>
							<li class="size_radioToggle <?php if($pid == 23): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 23,'shares'=>$info['id']));?>'">
								<img src="../Style/index-images/muying-<?php if($pid == 23): ?>2<?php else: ?>1<?php endif; ?>.png" alt="母婴用品" />
								<p>母婴用品</p>
							</li>
							
							<li class="size_radioToggle <?php if($pid == 28): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 28,'shares'=>$info['id']));?>'">
								<img src="../Style/index-images/xihu-<?php if($pid == 28): ?>2<?php else: ?>1<?php endif; ?>.png" alt="洗护日化" />
								<p>洗护日化<p>
							</li>
							<li class="size_radioToggle <?php if($pid == 53): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 53,'shares'=>$info['id']));?>'">
								<img src="../Style/index-images/meizhuang-<?php if($pid == 53): ?>2<?php else: ?>1<?php endif; ?>.png" alt="美妆香水"/>
								<p>美妆香水</p>
							</li>
							
							<li class="size_radioToggle <?php if($pid == 30): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 30,'shares'=>$info['id']));?>'">
								<img src="../Style/index-images/yingyang-<?php if($pid == 30): ?>2<?php else: ?>1<?php endif; ?>.png" alt="营养保健" />
								<p>营养保健</p>
							</li>
							<li class="size_radioToggle <?php if($pid == 51): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 51,'shares'=>$info['id']));?>'">
								<img src="../Style/index-images/jiaju-<?php if($pid == 51): ?>2<?php else: ?>1<?php endif; ?>.png" alt="家居用品" />
								<p>家居用品</p>
							</li>
							<li class="size_radioToggle <?php if($pid == 64): ?>currents<?php endif; ?>" onClick="location.href='<?php echo U('Item/itemcate', array('pid' => 64,'shares'=>$info['id']));?>'">
								<img src="../Style/index-images/xiexue-<?php if($pid == 64): ?>2<?php else: ?>1<?php endif; ?>.png" alt="鞋靴箱包" />
								<p>鞋靴箱包</p>
							</li>
			        	</ul>
    			</div>
    			
        			
		       <!--全球好货-->
		        <div id="word" data-tab-panel-1 class="am-tab-panel am-active" style="background-color: rgb(243,243,243); z-index: 10000;">
		            <div class="search" style="margin-top: 49px;">
				        <input type="text"  name="keyword4" placeholder="在千万海外商品中搜索..." />
		            	<button class="search_btn" id="search_btn4">搜&nbsp;索</button>
		            </div>
		            <div id="nation">
		            	<ul class="am-avg-sm-2 am-thumbnails" style="padding: 10px; border-bottom: none;">
						<?php if(is_array($countrys)): $i = 0; $__LIST__ = $countrys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li style="padding: 1px;" onClick="window.location.href='<?php echo U('Item/itemlist',array('countryId'=> $vol['Id'],'shares'=>$info['id']));?>'"><img class="am-thumbnail" src="data/upload/bg_img/<?php echo ($vol["bg_img"]); ?>" /></li>
	  							<!--<li style="padding: 1px;" onClick="window.location.href='<?php echo U('Item/itemlist',array('countryId'=> $vol['Id']));?>'"><img class="am-thumbnail" src="../Style/index-images/cplist_09.jpg" /></li>--><?php endforeach; endif; else: echo "" ;endif; ?>
						<li style="padding: 1px;" onClick="window.location.href='<?php echo U('Item/itemlist',array('condition' => 'more'));?>'"><img class="am-thumbnail" src="data/upload/bg_img/more.jpg"/></li>
						</ul>
		            </div>
		        </div>
		    </div>
  		</div>
		</div>
		<input type="hidden" name="page" id="page" value="<?php echo ($_SESSION['page']); ?>" />
		<div data-am-widget="navbar" class="am-navbar am-cf am-navbar" id="" style="background-color:white; box-shadow:20px 20px 40px black;">
<ul class="am-navbar-nav am-cf am-avg-sm-5">
	  <li >
		<a href="<?php echo U('Index/index',array('shares'=>$info['id']));?>" class="">
			<img src="../Style/index-images/home.gif">
			<span class="am-navbar-label" style="color:rgb(137,137,137);">首页</span>
		</a>
	  </li>
	  <li>
		<a href="<?php echo U('Item/itemcate',array('shares'=>$info['id']));?>" class="">
			<img src="../Style/index-images/sort.gif" > 
			<span class="am-navbar-label" style="color:rgb(137,137,137);">分类</span>
		</a>
	  </li>
	  <li class="bottomhome">
		<a href='https://static.meiqia.com/dist/standalone.html?eid=23554&clientid=<?php echo ($server_u["id"]); ?>&metadata={"name":"<?php echo $server_u['username']; ?>","tel":"<?php echo $server_u['phone_mob']; ?>","email":"<?php echo $server_u['email']; ?>"}'>
			<img src="../Style/index-images/erweima.png">
			<span class="am-navbar-label" style="color:rgb(137,137,137);">客服</span>
		</a>
	  </li>
	  <li>
		<a href="<?php echo U('Shopcart/index',array('shares'=>$info['id']));?>">
		 <img src="../Style/index-images/shop-car.gif" > 
			<span class="am-navbar-label" style="color:rgb(137,137,137);">购物车</span>
		</a>
	  </li>
	  <li >
		<a href="<?php echo U('User/index',array('shares'=>$info['id']));?>" class="">
		 <img src="../Style/index-images/mine.gif" > 
			<span class="am-navbar-label" style="color:rgb(137,137,137);">我的</span>
		</a>
	  </li>
  </ul>
</div>
		<script src="../Style/assets/js/amazeui.min.js"></script>
		<script type="text/javascript">
		
			var shares_id = $('input[name=shares_id]');
			/*$(function(){
				$('#classify li').click(function(){
					var thisToggle = $(this).is('.size_radioToggle') ? $(this) : $(this).prev();
					var checkBox = thisToggle.prev();
					checkBox.trigger('click');
					$('.size_radioToggle').removeClass('currents');
					thisToggle.addClass('currents');
					return false;
				});
			});*/
			$(function(){
				$('#search_btn').click(function(){
					var keyword = $('input[name=keyword]');
					if(keyword.val() == '') {
						layer.open({
							title: '提示',
							content: '您还是输点什么再点我吧',
							btn: ['我知道了'],
							yes: function(index){
								layer.close(index);
							}
						});

						return false;
					} else {
						window.location.href = "<?php echo U('Item/itemlist',array('keyword'=>'" + keyword.val() + "','shares'=>'"+shares_id.val()+"'));?>";
					}
				});
			});
			$(function(){
				$('#search_btn1').click(function(){
					var keyword1 = $('input[name=keyword1]');
					if(keyword1.val() == '') {
						layer.open({
							title: '提示',
							content: '您还是输点什么再点我吧',
							btn: ['我知道了'],
							yes: function(index){
								layer.close(index);
							}
						});

						return false;
					} else {
						window.location.href = "<?php echo U('Item/itemlist',array('keyword1'=>'" + keyword1.val() + "','shares'=>'"+shares_id.val()+"'));?>";
					}
				});
			});
			$(function(){
				$('#search_btn3').click(function(){
					var keyword3 = $('input[name=keyword3]');
					if(keyword3.val() == '') {
						layer.open({
							title: '提示',
							content: '您还是输点什么再点我吧',
							btn: ['我知道了'],
							yes: function(index){
								layer.close(index);
							}
						});

						return false;
					} else {
						window.location.href = "<?php echo U('Item/itemlist',array('keyword'=>'" + keyword3.val() + "','shares'=>'"+shares_id.val()+"'));?>";
					}
				});
			});
			$(function(){
				$('#search_btn4').click(function(){
					var keyword4 = $('input[name=keyword4]');
					if(keyword4.val() == '') {
						layer.open({
							title: '提示',
							content: '您还是输点什么再点我吧',
							btn: ['我知道了'],
							yes: function(index){
								layer.close(index);
							}
						});

						return false;
					} else {
						window.location.href = "<?php echo U('Item/itemlist',array('keyword1'=>'" + keyword4.val() + "','shares'=>'"+shares_id.val()+"'));?>";
					}
				});
			});

			$(document).ready(function() {
				var page=$('input[name=page]').val();
				if(page=='second'){
					$('#second-tabs').removeClass('display-none');
					$("#classify2").hide();
					$("#first_page2").click(function(){
						$("#classify2").show();
					});
					$("#second_page2").click(function(){
						$("#classify2").hide();
					});
					return false;
				}
				if(page=='first'){
					$('#first-tabs').removeClass('display-none');
					return false;
				}
			});
		</script>
		<!--<script src="../Style/slick/slick.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).on('ready', function() {
				$(".regular").slick({
					dots: false,
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 3
				});
			});
		</script>-->

	</body>

</html>