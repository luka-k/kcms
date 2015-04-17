function add_to_cart(item_id, qty){
	data = new Object();
	data.item_id = item_id;
	data.qty = qty;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/add_to_cart/", json_str, update_items, "json");
}
	
function update_cart(item_id, qty){
	data = new Object();
	data.item_id = item_id;
	data.qty = qty;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/update_cart/", json_str, update_items, "json");
}

function fancy_to_cart(item_id, name, qty){	
	$('.fancy_product_name').text(name);
	add_to_cart(item_id, qty);
	$('#input_item_id').attr("value", item_id);
	$.fancybox.open("#to-cart");
}
	
function delete_item(item_id){
	$("#cart-"+item_id).detach();
	data = new Object();
	data.item_id = item_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/delete_item/", json_str, delete_answer, "json");
}

function update_items(res){	
	$('#input_qty').val(res['item_qty']);
	$('#total_qty').text(res['total_qty']);
	$('#total_price').text(res['total_price']);
	$('.total_price').text(res['total_price']);
	$('.product_word').text(res['product_word']);
	$('#'+res['item_id']).text(res['item_total']);
	
	$('#cart-empty').attr("style", "display:none");
	$('#cart-full').attr("style", "display:inline");
	
	$('#input_item_id').attr("value", res['item_id']);	
}

function delete_answer(res){
	if(res['total_qty'] == "0"){
		$("table").remove('.cart-table');
		$("div").remove('.page-cart__order');
		$('.page-cart__products').text("Корзина пуста");
	}
	$('#total_qty').text(res['total_qty']);
	$('#total_price').text(res['total_price']);
	$('.total_price').text(res['total_price']);
	$('.product_word').text(res['product_word']);
	$('#'+res['item_id']).text(res['item_total']);
	
	$("tr").remove('#cart-'+res['item_id']);
}