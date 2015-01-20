<script>
	$(function() {
		$('.sortable').sortable({cursor:'move'});
		$('.sortable').sortable({cursorAt:{left:5}})
		$('.sortable').sortable({
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

	function change_sort(type, item_id, sort){
		data = new Object();
		data.type = type;
		data.item_id = item_id;
		data.sort = sort;
		var json_str = JSON.stringify(data);
		$.post ("/admin/admin_ajax/change_sort/", json_str, update_items, "json");
	}
	
	function update_items(res){

	}
	
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
	
	
	function add_ch(){
		var form = $('#form1'),
		inputs = form.find('.add_ch'),
		data = {},
		info = {};
								
		inputs.each(function () {
			var element = $(this);
			info[element.attr('name')] = element.val();
		});							
		data = info;
		var json_str = JSON.stringify(data);
		$.post("/admin/admin_ajax/edit_characteristic/", json_str, add_ch_answer, "json");
	}
	
	function add_ch_answer(res){
		if(res.after){
			var item = res.info;
			$(".ch_item").last().after("<tr id='ch-"+item.id+"' class='ch_item'><td>"+item.name+"</td><td><input type='text' class='edit val-'"+item.id+" value='"+item.value+"' onchange=''></td><td><a href='#' class='del' onclick=''>удалить</a></td></tr>");
			var onchange_link = "update_ch('"+item.id+"'); return false;";
			var del_link = "delete_ch('"+res.base_url+"', '"+item.id+"', '"+item.name+"'); return false;"
			$('input.edit').attr('onchange', onchange_link);
			$('a.del').attr('onclick', del_link);
		}
	}
	
	function update_ch(id, value){
		var data = {};
		data.id = id;
		data.value = $(".val-"+id).val();
		var json_str = JSON.stringify(data);
		$.post("/admin/admin_ajax/edit_characteristic/", json_str, add_ch_answer, "json");
	}
	
	function delete_ch(base_url, item_id, item_name){
		var href;
		href = base_url+"admin/content/delete_characteristic/"+item_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
	
	function delete_ch_answer(res){
		if(res.message == "ok"){
			$.fancybox.close("#delete-"+res.item_id);
			$('#ch-'+res.item_id).remove();
		}
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
		$.post("/admin/admin_ajax/advanced/", json_str);
	}
	
	$(function(){
		$( ".datepicker" ).datepicker();
		$( ".datepicker" ).datepicker( "option", $.datepicker.regional["ru"]);
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd");
		$( ".datepicker" ).datepicker( "setDate", $(".datepicker").attr('date') );
	});
	
	jQuery(document).ready(function($){	
		var ckeditor = CKEDITOR.replace('editor');
		AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor});
			
		var ckeditor_2 = CKEDITOR.replace('editor_2');			AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor_2});
	});

</script>