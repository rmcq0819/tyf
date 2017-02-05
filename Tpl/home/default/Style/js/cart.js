function drop_cart_item(rec_id){
	
    var tr = $('#cart_item_' + rec_id);
    var amount_span = $('#cart_amount');
    var cart_goods_kinds = $('#cart_goods_kinds');
   
    $.post("index.php?m=Shopcart&a=remove_cart_item",{itemId:rec_id},function(data){
    	if(data.status==1)
    	{
    		window.location.reload(); 
    	}
    },'json');
    
    /*
    $.getJSON('index.php?app=cart&act=drop&rec_id=' + rec_id, function(result){
        if(result.done){
            //删除成功
            if(result.retval.cart.quantity == 0){
                window.location.reload();    //刷新
            }
            else{
                tr.remove();        //移除
                amount_span.html(price_format(result.retval.amount));  //刷新总费用
                cart_goods_kinds.html(result.retval.cart.kinds);       //刷新商品种类
            }
        }
    });
    */
}
function move_favorite(store_id, rec_id, goods_id){
    var tr = $('#cart_item_' + rec_id);
    $.getJSON('index.php?app=my_favorite&act=add&type=goods&item_id=' + goods_id, function(result){
        //没有做收藏后的处理，比如从购物车移除
        if(result.done){
            //drop_cart_item(store_id, rec_id);
            alert(result.msg);
        }
        else{
            alert(result.msg);
        }

    });
}

function decrease_quantity(rec_id){
    var item = $('#input_item_' + rec_id);
    var orig = Number(item.val());
    if(orig > 1){
        item.val(orig - 1);
        item.attr('changed',orig);
        item.keyup();
    }
}
function add_quantity(rec_id){
    var item = $('#input_item_' + rec_id);
    var orig = Number(item.val());
    item.attr('changed',orig);
    item.val(orig + 1);
    item.keyup();
}