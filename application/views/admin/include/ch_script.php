<script>
	function add_characteristic(){
		var data = {};
		var inputs = $('#form1').find('.add_ch');
		var error = 0;
		
		inputs.each(function () {
			if($(this).val() == ''){
				$(this).addClass('error');
				error++;
			}
			data[$(this).attr('name')] = $(this).val();
		});	
		
		if(error != 0) return false;

		var json_str = JSON.stringify(data);
		$.post("/admin/content/edit_characteristic/", json_str, function(data){
			$(".last_ch").before(data);
		}, "json");
	}
	
	function update_ch(id, value){
		var data = {};
		data.id = id;
		data.value = $(".val-"+id).val();
		var json_str = JSON.stringify(data);
		$.post("/admin/content/edit_characteristic/", json_str, "json");
	}
	
	function delete_characteristic_popup(item_id, item_name, item_value){
		$('#item_name').text(item_name+' - '+item_value);
		$('#delete_ch_id').val(item_id);
		$.fancybox.open("#delete_characteristic");
	}
	
	function delete_characteristic(){
		var data = {ch_id: $('#delete_ch_id').val()};
		var json_str = JSON.stringify(data);
		$.post("/admin/content/delete_characteristic/", json_str, function(data){
			$("#ch-"+data.ch_id).remove();
			$.fancybox.close();
		}, "json");
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