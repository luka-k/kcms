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
	$.post("/ajax/update_cart/", json_str, update_items, "json");
	stop;
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
	$('.total_qty').text(res['total_qty']);
	$('.total_price').text(res['total_price']);
	$('.product_word').text(res['product_word']);
	$('#'+res['item_id']+"-qty").text(res['item_total']);
	
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

/************************************
* pre-cart
************************************/

function precart(id, type, price){
	var data  = new Object();
	data.id = id;
	data.type = type;
	data.price = price;
	var json_str = JSON.stringify(data);
	if($(".ch-"+type+"-"+id).prop("checked") == true)
	{
		$.post("/cart/add_to_precart/", json_str, precart_answer, "json");
	}
	else
	{
		$.post("/cart/delete_from_precart/", json_str, precart_answer, "json");
	}
}

function precart_answer(res){
	if(res.action == "add"){
		$('.price-'+res.type+'-'+res.id).html('');
		$('.price-'+res.type+'-'+res.id).html('<div class="s_price">'+res.item_price+' р.</div><div class="s_qty"><a href="#" class="minus_pc-'+res.item_id+'">-</a><span class="'+res.item_id+'-qty">'+res.item_qty+'</span><a href="#" class="plus_pc-'+res.item_id+'">+</a></div><dic class="'+res.item_id+'-total s_total">'+res.item_total+' р.</div>');
	
		var click_minus = "update_precart('"+res.item_id+"', 'minus'); return false;";
		var click_plus = "update_precart('"+res.item_id+"', 'plus'); return false;";
		$('.minus_pc-'+res.item_id).attr('onclick', click_minus);
		$('.plus_pc-'+res.item_id).attr('onclick', click_plus);
	
		$("#pre_cart").append( $('#'+res.type+'-'+res.id) );
	}
	
	if(res.action == "delete")
	{
		$('.price-'+res.type+'-'+res.id).html('');
		$('.price-'+res.type+'-'+res.id).html('<div>Цена розничная: <del>'+res.price+' р.</del><span class="discount">-'+res.discount+' %</span></div><div>Цена на сайте: <span class="top-price">'+res.sale_price+'</span> р.</div><div>Наличие: <span class="blue-label">'+res.location+'</span></div>');
		$("#"+res.type).append($('#'+res.type+'-'+res.id));
	}

	$(".pre_cart_price").text(res.total_price+" р.");
}

function update_precart(item_id, action)
{
	var data  = new Object();
	data.item_id = item_id;
	data.action = action;
	var json_str = JSON.stringify(data);
	$.post("/cart/update_precart/", json_str, update_answer, "json");
}

function update_answer(res){
	$("."+res.item_id+"-qty").text(res.item_qty);
	$("."+res.item_id+"-total").text(res.item_total+" р.");
	$(".pre_cart_price").text(res.total_price+" р.");
}

function precart_to_cart(product_id){
	var data  = new Object();
	data.product_id = product_id;
	var json_str = JSON.stringify(data);
	$.post("/cart/precart_to_cart/", json_str, update_items, "json");
}
