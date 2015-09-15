// Вывод всплывающего окна добавления в корзину
//
function cart_popup(item_id, name, qty){	
	$('#popup_product_name').text(name);
	$.fancybox.open("#to-cart");
	
	add_to_cart(item_id, qty);
}

function add_to_cart(product_id, qty){
	var data = {product_id: product_id,	qty: qty};
	var json_str = JSON.stringify(data);
	
	$.post ("/cart/add_to_cart/", json_str, function(data){
		switch_minicart(data);
		update_minicart(data);
		
		$('#popup_qty').attr("value", data.item_qty);
		$('#popup_item_id').attr("value", data.item_id);
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
	var data = {item_id: item_id, qty: qty};
	var json_str = JSON.stringify(data);
	
	$.post ("/cart/update_cart/", json_str, function(data){
		update_minicart(data);
		update_item(data);
	}, "json");
}

function delete_cart_item(item_id){
	var data = {item_id: item_id};
	var json_str = JSON.stringify(data);
	
	$.post ("/cart/delete_item/", json_str,  function(data){
		update_minicart(data);
		delete_item(data);
		switch_minicart(data);
	}, "json");
}

function switch_minicart(data){
	if(data.total_qty > 1) return false;
	var display = {full: 'none', empty: 'inline'};
	if(data.total_qty == 1) display = {full: 'inline', empty: 'none'};
	
	$('#cart-full').css("display", display.full);
	$('#cart-empty').css("display", display.empty);
}

function update_minicart(data){
	$('.total_qty').text(data['total_qty']);
	$('.total_price').text(data['total_price']);
	$('.product_word').text(data['product_word']);
}

function update_item(data){
	$('#item_total-'+data['item_id']).text(data['item_total']);
	$('#qty-'+data['item_id']).val(data['item_qty']);
}

function delete_item(data){
	if(data['total_qty'] == "0"){
		$("table").remove('.cart-table');
		$("div").remove('.page-cart__order');
		$('.page-cart__products').text("Корзина пуста");
	}else{
		$("#cart-"+data['item_id']).detach();
	}
}