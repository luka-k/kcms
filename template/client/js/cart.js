function add_to_cart(item_id){
	data = new Object();
	if(document.getElementById('product_qty'))
	{
		var qty = document.getElementById('product_qty').value;
		data.qty = qty;
	}else{
		data.qty = 1;
	}
	
	data.item_id = item_id;
	
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
	
function delete_item(item_id){
	$("#"+item_id).detach();
	data = new Object();
	data.item_id = item_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/delete_item/", json_str, update_items, "json");
}

function update_items(res){		
	$('.total_qty').text(res['total_qty']);
	$('.total_price').text(res['total_price']);
	$('.product_word').text(res['product_word']);
	//$('#'+item_id).text(res['item_total']);
}
