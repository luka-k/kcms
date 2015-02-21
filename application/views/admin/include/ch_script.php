<script>
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
		var item = res.info;
		$(".last_ch").before("<tr id='ch-"+item.id+"' class='ch_item'><td>"+item.name+"</td><td><input type='text' class='col_12 edit val-'"+item.id+" value='"+item.value+"' onchange=''></td><td><a href='#' class='del' onclick=''>удалить</a></td></tr>");
		var onchange_link = "update_ch('"+item.id+"'); return false;";
		var del_link = "delete_ch('"+res.base_url+"', '"+item.id+"', '"+item.name+"'); return false;"
		$('input.edit').attr('onchange', onchange_link);
		$('a.del').attr('onclick', del_link);
	}
	
	function update_ch(id, value){
		var data = {};
		data.id = id;
		data.value = $(".val-"+id).val();
		var json_str = JSON.stringify(data);
		$.post("/admin/admin_ajax/edit_characteristic/", json_str, "json");
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
	
	function autocomp(){
		var data = {};
		var element = document.getElementById('ch_select');
		type = element.value;
		data.type = type;
		var json_str = JSON.stringify(data);
		$.post ("/admin/admin_ajax/autocomplete/", json_str, autocomp_answer, "json");
	}
		
	function autocomp_answer(res){
		var availableTags = res.available_tags;
			
		$("#ch_input").autocomplete({
			source: availableTags
		});
	}
</script>