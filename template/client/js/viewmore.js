function viewmore(){
	var viewmore = $('.viewmore_input').val();
	var categoryId = $('.viewmore_input_category').val();
	var data = new Object();
	console.log(categoryId);
	data.viewmore = viewmore;
	data.category_id = categoryId;
	
	var json_str = JSON.stringify(data);
	$.post('/catalog/viewmore/', json_str, function(res){
		$("#books_content").append(res.content);
		$('.viewmore_input').val(res.viewmore);
	}, 'json');
}