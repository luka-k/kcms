function viewmore(){
	var viewmore = $('.viewmore_input').val();
	var categoryId = $('.viewmore_input_category').val();
	var data = new Object();

	data.viewmore = viewmore;
	data.category_id = categoryId;
	
	if(categoryId == 'filter') 
	{	
		data = $('#filter-form').serialize();
		var viewmore = $('#viemore').serialize();
		data = data + '&' + viewmore;
	}
	console.log(data);
	var json_str = JSON.stringify(data);
	$.post('/catalog/viewmore/', data, function(res){
		$("#books_content").append(res.content);
		$('.viewmore_input').val(res.viewmore);
	}, 'json');
}