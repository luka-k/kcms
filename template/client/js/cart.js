function add_to_cart(item_id, qty){
	data = new Object();	
	data.item_id = item_id;
	data.qty = qty;
	console.log(item_id);
	console.log(qty);
	var json_str = JSON.stringify(data);
	$.post ("/ajax/add_to_cart/", json_str, update_items, "json");
}

function fancy_to_cart(item_id, name, action, qty){
	$('.fancy_product_name').text(name);
	
	if(qty == false){
		qty = 1; 
	}
	console.log(item_id);
	console.log(qty);
	if(action === "buy"){
		add_to_cart(item_id, qty);
		$('#input_item_id').attr("value", item_id);
		$.fancybox.open("#to-cart");
	}else{
		$('#order_item_id').attr("value", item_id);
		$.fancybox.open("#to-order");
	}
}
	
function update_cart(item_id, qty){
	data = new Object();
	console.log(item_id);
	console.log(qty);
	data.item_id = item_id;
	data.qty = qty;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/update_cart/", json_str, update_items, "json");
}

function change_qty(action, item_id){
	if(item_id != false){
		var target = document.getElementById('qty-'+item_id);
	}else{
		var target = document.getElementById('product_qty');
	}
				
	curValue = target.value;
				
	if (action === '+'){
		target.value = ++curValue;
	}else{
		if (curValue > 1) target.value = --curValue;
	}
				
	if(item_id != false){
		update_cart(item_id, curValue);
	}
}
	
function delete_item(item_id){
	$("#"+item_id).detach();
	data = new Object();
	data.item_id = item_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/delete_item/", json_str, delete_answer, "json");
}

function update_items(res){		
	console.log(res);

	$('.total_qty').text(res['total_qty']);
	$('.total_price').text(res['total_price']);
	$('.product_word').text(res['product_word']);
	$('#'+res['item_id']).text(res['item_total']);
	
	$('#input_qty').attr("value", res['item_qty']);	
	$('#input_item_id').attr("value", res['item_id']);
}

function delete_answer(res){
	
	$('.total_qty').text(res['total_qty']);
	$('.total_price').text(res['total_price']);
	$('.product_word').text(res['product_word']);
	$('#'+res['item_id']).text(res['item_total']);
	if(res['total_qty'] == "0"){
		$("table").remove('.cart-table');
		$("div").remove('.page-cart__order');
		$('#cart').text("Корзина пуста");
	}
	$("tr").remove('#cart-'+res['item_id']);
}


