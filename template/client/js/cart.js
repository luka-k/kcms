function add_to_cart(page_id){
	data = new Object();
	data.page_id = page_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/add_to_cart/", json_str, function(res) {
		$('#total_qty').text(res['total_qty']);
		$('#total_price').text(res['total_price']);
	}, "json");
}
	
function update_cart(item_id){
	data = new Object();
	data.item_id = item_id;
	data.qty = $('#qty_'+item_id).val();
	var json_str = JSON.stringify(data);
	$.post ("/ajax/update_cart/", json_str, function(res) {
		$('#total_qty').text(res['total_qty']);
		$('#total_price').text(res['total_price']);
		$('#item_total_'+item_id).text(res['item_total']);
	}, "json");
}
	
function delete_item(item_id){
	$("#tr_"+item_id).detach();
	data = new Object();
	data.item_id = item_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/delete_item/", json_str, function(res) {
		$('#total_qty').text(res['total_qty']);
		$('#total_price').text(res['total_price']);
	}, "json");
}
