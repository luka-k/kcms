<script>
	$(function() {
		$('#sortable').sortable({cursor:'move'});
		$('#sortable').sortable({cursorAt:{left:5}})
		$('#sortable').sortable({
			axis: 'y',
			update: function (event, ui) {
				var data = $(this).sortable('serialize');
				$.ajax({
					data: data,
					type: 'POST',
					url: '/admin_ajax/sortable/'
				});
			}
		});
	});
	
	$(function() {
		$('#sortable-1').sortable({cursor:'move'});
		$('#sortable-1').sortable({cursorAt:{left:5}})
		$('#sortable-1').sortable({
			axis: 'y',
			update: function (event, ui) {
				var data = $(this).sortable('serialize');
				$.ajax({
					data: data,
					type: 'POST',
					url: '/admin_ajax/sortable/'
				});
			}
		});
	});

	function change_sort(type, item_id, sort){
		data = new Object();
		data.type = type;
		data.item_id = item_id;
		data.sort = sort;
		var json_str = JSON.stringify(data);
		$.post ("/admin_ajax/change_sort/", json_str, update_items, "json");
	}
	
	function update_items(res){

	}
	
	function delete_item(base_url, type, item_id, item_name){
		var href;
		href = base_url+"admin/delete_item/"+type+"/"+item_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
	
	function slider(id){
		$("#"+id).slideToggle().toggleClass('noactive');
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