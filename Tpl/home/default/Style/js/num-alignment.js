(function($){ 
	var functions = {
		init:function(input, step, max, min, digit ,itemId ,size, seid){
			var width = input.width()-3;
			var height = input.width()/4;
			var _this = this;
		 	width += 3;
		 	
		 	input.attr("readonly", "readonly");
		 	//设置不分样式
			input.css("border", "none");
			input.css("width", width-height*2-2);
			input.css("height", height);
			input.css("padding", "0px");
			input.css("margin", "0px");
			input.css("text-align", "center");
			input.css("vertical-align", "middle");
			input.css("line-height", height + "px");
			
			
			//添加左右加减号
			input.wrap("<div style = 'overflow:hidden;width:" + width + "px;height:" + height + "px;border: 1px solid #CCC;'></div>");
			input.before("<div id = '" + input.attr('id') + "l'  onselectstart = 'return false;' style = '-moz-user-select:none;cursor:pointer;text-align:center;width:" + height + "px;height:" + height + "px;line-height:" + height + "px;border-right: 1px solid #CCC;float:left;border-bottom-left-radius: 5px;border-top-left-radius: 5px;'>-</div>");
			input.after("<div id = '" + input.attr('id') + "r'  onselectstart = 'return false;' style = '-moz-user-select:none;cursor:pointer;text-align:center;width:" + height + "px;height:" + height + "px;line-height:" + height + "px;border-left: 1px solid #CCC;float:right;border-bottom-right-radius: 5px;border-top-right-radius: 5px;'> + </div>");
			//左右调用执行
			$("#" + input.attr('id') + "l").click(function(){
				_this.execute(input, step, max, min, digit ,itemId ,size, seid, true);
			});
			$("#" + input.attr('id') + "r").click(function(){
				_this.execute(input, step, max, min, digit ,itemId ,size, seid, false);
			});
		},
		execute:function(input, step, max, min, digit ,itemId ,size, seid, _do){
			var val = parseFloat(this.format(input.val(), digit));
		
			var ori = val;
			if(_do) val -= step;
			if(!_do) val += step;
			if(val<min){
				val  =  min;
			}else if(val>max){
				val  =  max;
			}
			input.val(this.format(val, digit));
			
			change_quantity_c(itemId,seid,val,size,input);
		},
		format:function(val, digit){
			if(isNaN(val)){ 
				val = 1;
			}
			if(val==0){ 
				val = 1;
			}
			
			return parseFloat(val).toFixed(digit);	
		}
	};
	
	
    $(function(){
    	//使用控件必须有以下属性或者引用alignment类
		var inputs = $("input[user_data], input[data_digit], input[data_step], input[data_min], input[data_max], input[data_itemId], input[data_size], input[data_seid] ,input.alignment");
		inputs.each(function(){
			//预设值数据选择
			var data = {
			            default_data : 	{"step" : 0.1, "min" : 1, "max" : 2000, "digit" : 1}, 
			          
						}
			
			var user_data = eval("data." + $(this).attr("user_data"));
			if(user_data == null){
				user_data = data.default_data;
			}
			
			var digit = $(this).attr("data_digit");
			if(digit != null&&!isNaN(parseFloat(digit))){
				digit  =  parseFloat(digit).toFixed(0);
				user_data.digit = parseFloat(digit);
			}
			
			var step = $(this).attr("data_step");
			if(step != null &&!isNaN(parseFloat(step))){
				user_data.step = parseFloat(step);
			}
			var min = $(this).attr("data_min");
			if(min != null &&!isNaN(parseFloat(min))){
				user_data.min = parseFloat(min);
			}
			
			var max = $(this).attr("data_max");
			if(max != null &&!isNaN(parseFloat(max))){
				user_data.max = parseFloat(max);
			}
			
			var itemId = $(this).attr("data_itemId");
			if(itemId != null){
				user_data.itemId = itemId;
			}
			
			var size = $(this).attr("data_size");
			if(size != null){
				user_data.size = size;
			}
			
			var seid = $(this).attr("data_seid");
			if(seid != null){
				user_data.seid = seid;
			}
			//自动装载
	        functions.init($(this), user_data.step, user_data.max, user_data.min, user_data.digit , user_data.itemId , user_data.size , user_data.seid);
	        
	        var data_edit = $(this).attr("data_edit");
	        if(data_edit){
	        	$(this).attr("readonly",null);
	        }
		});
	})  
})(jQuery);
function change_quantity_c(itemId,seid,val,size,input){
	
    var subtotal_span = $('#item' + seid + '_subtotal');
    var amount_span = $('#cart_amount');
    //暂存为局部变量，否则如果用户输入过快有可能造成前后值不一致的问题
    var _v = val;
  
   $.post("index.php?m=Shopcart&a=change_quantity",{itemId:itemId,seid:seid,quantity:_v,size:size},function(data){
 
    	if(data.msg){
    		alert(data.msg);
    		input.val(data.stock);
    		
    	}
    	 subtotal_span.html(price_format((data.item.price*data.item.num).toFixed(2)));




        /************************
        *   总价的显示否改为由选中否控制
        *   @author  May
        *   date    2016-07-26      
        ************************/
        //amount_span.html(price_format(data.sumPrice)); 
        ids = $("input:checkbox[name='id']:checked").map(function(index,elem) {
            return $(elem).val();
        }).get().join(',');
        idArr = ids.split(",");
        len = idArr.length;
        if(idArr == ''){
            len = idArr.length-1;
        }
        var price = 0;
        var i=0;
       	var count = 0;
        for(;i<len;i++){
			price += parseFloat($("#price_"+idArr[i]).text())*$("#input_item_"+idArr[i]).val();
			$itemId = $("#item_"+idArr[i]).val();
			if($itemId == 5421){
				count = count + parseInt($("#input_item_"+idArr[i]).val());
			}
		}
		if(count >= 3){
				price -= 60;
		}
		if(price<99&&price>0){
				if(count>=3){
					document.getElementById("cart_amount").innerHTML = "￥"+price;
					$("#coudan").fadeOut();
				}else{
					document.getElementById("cart_amount").innerHTML = "￥"+price+"+￥10（运费）";
					$("#coudan").fadeIn();
				}
			}
		else if(price>=99){    
			
			document.getElementById("cart_amount").innerHTML = "￥"+price;
			$("#coudan").fadeOut();
		}
		else if(price==0){
			document.getElementById("cart_amount").innerHTML = "￥"+price;
			$("#coudan").fadeIn();
		}
    },'json');
}
