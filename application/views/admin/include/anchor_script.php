<script>
	function autocomp_anchor(type){
		var json_str = JSON.stringify(type);
		$.post("/admin/admin_ajax/anchor_autocomplete/", json_str, autocomp_answer, 'json');
	}
		
	function autocomp_answer(res){
		var availableTags = res.available_tags;

		$("#"+res.type+"_input").autocomplete({
			source: availableTags,
			select: function( event, ui ) {
				$('#'+res.type+'_input').val(ui.item.value);
			}
		});
	}		
	
	function add_anchor(product1_id, type){
		var data = {},
		name;
								
		name = $("#"+type+"_input").val();				
		data.name = name;
		data.product1_id = product1_id;
		data.type = type;
		var json_str = JSON.stringify(data);
		$.post("/admin/admin_ajax/add_anchor/", json_str, add_callback, "json");
	}
	
	function add_callback(answer){
		if(answer != "error"){
			var item = answer.product_2;
			var type = answer.type;
			$(".last_"+type).before("<tr id='"+type+"-"+item.id+"' class='recomended_item'><td><a href=''>"+item.name+"</a></td><td><a href='#' class='del' onclick=''>Удалить</a></td></tr>");
			
			var del_link = "delete_anchor('"+answer.base_url+"', '"+item.id+"', '"+item.name+"'); return false;"
			$('a.del').attr('onclick', del_link);
			
			var r_link = answer.base_url+"admin/content/item/edit/products/"+item.id;
			$('a.r_link').attr('href', r_link);
		}	
	}
	
	function delete_anchor(base_url, item_id, item_name, content_id, type){
		var href;
		href = base_url+"admin/content/delete_anchor/"+type+"/"+item_id+"/"+content_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
	
	
</script>