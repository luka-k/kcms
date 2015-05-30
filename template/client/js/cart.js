function fancy_to_cart(item_id, name, qty){	
	$('.fancy_product_name').text(name);
		
	$.fancybox.open("#to-cart");
	
	add_to_cart(item_id, qty);
}

function add_to_cart(product_id, qty){
	data = new Object();
	
	data.product_id = product_id;
	data.qty = qty;
	
	var json_str = JSON.stringify(data);
	
	$.post ("/ajax/add_to_cart/", json_str, function(answer){
		update_total(answer);
		$('#input_qty').attr("value", answer.item_qty);
		$('#input_item_id').attr("value", answer.item_id);
	}, "json");
}

function update_qty(item_id, qty, action){
	if(action == "plus"){
		qty++;
	}
	else{
		if(qty < 2) return false;
		qty--;
	}
	
	update_cart(item_id, qty);
}
	
function update_cart(item_id, qty){
	data = new Object();

	data.item_id = item_id;
	data.qty = qty;
	
	var json_str = JSON.stringify(data);
	
	$.post ("/ajax/update_cart/", json_str, function(answer){
		update_total(answer);
		update_item(answer);
	}, "json");
}

function delete_cart_item(item_id){
	data = new Object();
	
	data.item_id = item_id;
	
	var json_str = JSON.stringify(data);
	
	$.post ("/ajax/delete_item/", json_str,  function(answer){
		update_total(answer);
		delete_item(answer);
	}
	, "json");
}

function update_total(info){
	$('.total_qty').text(info['total_qty']);
	$('.total_price').text(info['total_price']);
	$('.product_word').text(info['product_word']);
}

function update_item(info){
	$('#item_total-'+info['item_id']).text(info['item_total']);
	$('#qty-'+info['item_id']).val(info['item_qty']);
}

function delete_item(info){
	if(info['total_qty'] == "0"){
		$("table").remove('.cart-table');
		$("div").remove('.page-cart__order');
		$('.page-cart__products').text("Корзина пуста");
	}else{
		$("#cart-"+info['item_id']).detach();
	}
}