<script>
	function autocomp_recommended(){
		var data = {};
		data.r = " ";
		var json_str = JSON.stringify(data);
		$.post("/ajax/autocomplete/", json_str, autocomp_answer, 'json');
	}
		
	function autocomp_answer(res){
		var availableTags = res.available_tags;
	
		$("#recommended_input").autocomplete({
			source: availableTags,
			select: function( event, ui ) {
				$('#recommended_input').val(ui.item.value);
			}
		});
	}		
	
	function add_recommended(product1_id){
		var data = {},
		name;
								
		name = $("#recommended_input").val();				
		data.name = name;
		data.product1_id = product1_id;
		var json_str = JSON.stringify(data);
		$.post("/admin/admin_ajax/add_recommend/", json_str, add_recommended_callback, "json");
	}
	
	function add_recommended_callback(answer){
		if(answer != "error"){
			var item = answer.product_2;
			
			$(".last_recommended").before("<tr id='recommended-"+item.id+"' class='recommended_item'><td><a href=''>"+item.name+"</a></td><td><a href='#' class='del' onclick=''>удалить</a></td></tr>");
			
			var del_link = "delete_recommended('"+answer.base_url+"', '"+item.id+"', '"+item.name+"'); return false;"
			$('a.del').attr('onclick', del_link);
			
			var r_link = answer.base_url+"admin/content/item/edit/products/"+item.id;
			$('a.r_link').attr('href', r_link);
			
			$("#recommended_input").val("");
		}	
	}
	
	function delete_recommended(base_url, item_id, item_name, content_id){
		var href;
		href = base_url+"admin/content/delete_recommended/"+item_id+"/"+content_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
	
	
</script>