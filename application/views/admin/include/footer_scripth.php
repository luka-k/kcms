<script>
	function change_sort(type, item_id, sort){
		data = new Object();
		data.type = type;
		data.item_id = item_id;
		data.sort = sort;
		var json_str = JSON.stringify(data);
		$.post ("/ajax/change_sort/", json_str, update_items, "json");
	}
	
	function update_items(res){

	}

	$('ul .down a').mouseover(function() {
		$(this).next('ul').removeClass('noactive');
		$(this).next('ul').addClass('active');
	});
	
	tinymce.init({
		selector: "textarea",
		language : 'ru',
		plugins:[
			"advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste",
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
</script>