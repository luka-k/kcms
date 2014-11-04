function add_to_wishlist(id){
	data = new Object();
	data.id = id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/add_to_wishlist/", json_str, update_items, "json");
}

function delete_from_wishlist(id){
	data = new Object();
	data.id = id;
	var json_str = JSON.stringify(data);
	$.post ("/ajax/delete_from_wishlist/", json_str, update_items_1, "json");
}