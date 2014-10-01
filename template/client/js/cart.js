function add_to_cart(item_id){
	data = new Object();
	data.item_id = item_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/add_to_cart/", json_str, update_items_1, "json");
}
	
function update_cart(item_id, qty){
	data = new Object();
	data.item_id = item_id;
	data.qty = qty;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/update_cart/", json_str, update_items_1, "json");
}

function delete_item(item_id){
	$("."+item_id).detach();
	data = new Object();
	data.item_id = item_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/delete_item/", json_str, update_items_1, "json");
}
	
function update_items_1(res){
	window.location.reload();
}

function update_items(res){		
	$('.total_qty').text(res['total_qty']);
	$('.total_price').text(res['total_price']);
	$('.shipping').text(res['shipping']);
	$('.total').text(res['total']);
	$('#total_'+res['cart_item_id']).text(res['item_total']);
	$('.qty-'+res['cart_item_id']).text(res['item_qty']);
}

jQuery(document).ready(function($){
	data = new Object();
	var json_str = JSON.stringify(data);
	$.post ("/ajax/cart/", json_str, update_items, "json");	
});
