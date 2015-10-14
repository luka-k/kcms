<script>
	$(function() {
		$('.sortable').sortable({
			cursor:'move',
			cursorAt:{left:5},
			axis: 'y',
			update: function (event, ui) {
				var data = $(this).sortable('serialize');
				$.ajax({
					data: data,
					type: 'POST',
					url: '/admin/admin_ajax/sortable/'
				});
			}
		});
	});
	
	$(function() {
		$('.sortable-images').sortable({
			cursor:'move',
			cursorAt:{left:5},
			update: function (event, ui) {
				var data = $(this).sortable('serialize');
				$.ajax({
					data: data,
					type: 'POST',
					url: '/admin/admin_ajax/sortable/'
				});
			}
		});
	});
	
	function delete_item(base_url, type, item_id, item_name){
		var href;
		href = base_url+"admin/content/delete_item/"+type+"/"+item_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
	
	function delete_user(base_url, item_id, item_name){
		var href;
		href = base_url+"admin/users_module/delete_user/"+item_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
		
	function slider(id){
		$("#"+id).slideToggle().toggleClass('noactive');
	}
	
	function advanced(type, item_id, check)
	{
		var data = {},
		value;
		
		if(check == true){
			value = 1;
		}else{
			value = 0;
		}
		
		data.type = type;
		data.id = item_id;
		data.value = value;
		var json_str = JSON.stringify(data);
		$.post("/admin/content/advanced/", json_str);
	}
	
	$(function(){
		$( ".datepicker" ).datepicker({
			dateFormat:"yy-mm-dd",
			setDate: $(".datepicker").attr('date')
		});

	});
	
	jQuery(document).ready(function($){
		var ckeditor = CKEDITOR.replace('editor_1');
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor});
		
		var ckeditor_2 = CKEDITOR.replace('editor_2');
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor_2});
		
		var ckeditor_3 = CKEDITOR.replace('editor_3');
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor_3});
		
		var ckeditor_4 = CKEDITOR.replace('editor_4');
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor_4});
		
		var ckeditor_5 = CKEDITOR.replace('editor_5');
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor_5});
	});

</script>