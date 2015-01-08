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
	console.log(data.item_id);
	var json_str = JSON.stringify(data);
	$.post ("/ajax/add_to_cart/", json_str, update_items, "json");
}
	
function update_cart(item_id, qty, local){
	data = new Object();
	data.item_id = item_id;
	data.qty = qty;
	var json_str = JSON.stringify(data);
	if(local == "cart"){
		$.post ("/ajax/update_cart/", json_str, go_to_cart, "json");
	}else{
		$.post ("/ajax/update_cart/", json_str, update_items, "json");
	}
}

function go_to_cart(res){
	document.location.href = "/cart/";
}
	
function delete_item(item_id){
	$("#"+item_id).detach();
	data = new Object();
	data.item_id = item_id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/delete_item/", json_str, delete_answer, "json");
}

function fancy_to_cart(item_id, name){
	$('.fancy_product_name').text(name);
	add_to_cart(item_id, 1);
	$.fancybox.open("#to-cart");
}

function from_fancy_to_cart(){
	var name_input = document.getElementById('input_qty');
	var qty = name_input.value;
	var item_id_input = document.getElementById('input_item_id');
	var item_id = item_id_input.value;
	update_cart(item_id, qty, 'cart');
}

function update_items(res){		
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
