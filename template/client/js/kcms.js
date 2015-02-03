function autocomp(){
	var data = {};
	data.r = " ";
	var json_str = JSON.stringify(data);
	$.post("/ajax/autocomplete/", json_str, autocomp_answer, 'json');
}
		
function autocomp_answer(res){
	var availableTags = res.available_tags;
		
	$("#search_input").autocomplete({
		source: availableTags,
		select: function( event, ui ) {
			$('.search').val(ui.item.value);
			$('#searchform').submit();
		}
	});
}		