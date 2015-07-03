<script>
	$(document).ready(function(){
		$(".manufacturer_id").on('change', function(){
			data = $(this).val()

			var json_str = JSON.stringify(data);
			$.post ("/admin/admin_ajax/categories_by_manufacturer/", json_str, function(answer){
				$("#categories_by_manufacturer").html("");
				$("#categories_by_manufacturer").append(answer);
			}, "json");
		});
	});
	
	function checked_tree(parent_id, type, action){
		var form = $('#form1'),
		inputs = form.find('input.'+type+'-branch-'+parent_id);

		var counter_1 = 0;
		var counter_2 = 0;
		inputs.each(function(){
			var element = $(this);
			if(action == "fork"){
				if($("#"+type+"-fork-"+parent_id).prop("checked")){
					element.prop("checked", true);
				}else{
					element.prop("checked", false);
				}
			}else if(action == "child"){
				counter_1++;
				if(element.prop("checked") == false){
					$("#"+type+"-fork-"+parent_id).prop("checked", false);
				}else{
					counter_2++;
				}
				
				if(counter_1 == counter_2){
					$("#"+type+"-fork-"+parent_id).prop("checked", true);
				}
			}
		});
	}
	
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
	
	function select_equal(value, select_id){
		if($('#cch_'+select_id).prop("checked")){
			$('.cch-'+value).prop("checked", true);
		}else{
			$('.cch-'+value).prop("checked", false);
		}	
	}
	
	$(function(){
		$( ".datepicker" ).datepicker({
			dateFormat:"yy-mm-dd",
			setDate: $(".datepicker").attr('date')
		});

	});
	
	jQuery(document).ready(function($){	
		var ckeditor = CKEDITOR.replace('editor');
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor});
			
		var ckeditor_2 = CKEDITOR.replace('editor_2');			
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor_2});
		
		var ckeditor_3 = CKEDITOR.replace('editor_3');			
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor_3});
	});

</script>