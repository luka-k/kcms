<script>
	function item_info(id){
		var data = {};
		data.id = id;
		var json_str = JSON.stringify(data);
		$.post("/admin_ajax/menu_item/", json_str, item_info_answer, "json");
	}
																
	function item_info_answer(res){
		$.fancybox.open("#item_info");
		//console.log(item);
		var form = $('.edit_item');
		if(res.item != ""){
			for (var key in res.item) {
				var val = res.item[key];
				element = form.find('.'+key);
				element.val(val);
			}
		}else{
			var form = $('.edit_item'),
			inputs = form.find('.menu_items');
			
			inputs.each(function (){ 
				var element = $(this);
				var val = null;
				if(element.attr('name') != "menu_id"){
					element.val(val);
				}
			});
		}
	}
								
	function edit_item(){
		var form = $('.edit_item'),
		inputs = form.find('.menu_items'),
		data = {},
		info = {};
								
		inputs.each(function () {
			var element = $(this);
			info[element.attr('name')] = element.val();
		});	
									
		data.info = info;
		var json_str = JSON.stringify(data);
		$.post("/admin_ajax/edit_item/", json_str, update_menu, "json");
	}
								
	function update_menu(res){
		console.log(res);
		if(res.error == false){
			var form = $('.edit_item'),
			inputs = form.find('.menu_items');
			
			inputs.each(function (){ 
				var element = $(this);
				var val = null;
				if(element.attr('name') != "menu_id"){
					element.val(val);
				}
			});
			
			if(res.after){
				var after = res.after;
				var item = res.item;
				$("#menus_items-"+after.id).after("<li id='menus_items-'"+item.id+">"+item.name+" <a href='#' class='various' onclick=''><i class='icon-pencil icon-large'></i></a><a href='#' class='lightbox'><i class='icon-minus-sign icon-large'></i></a></li>");	
				var link = "item_info('"+item.id+"'); return false;";
				$('a.various').attr('onclick', link);
			}
			$.fancybox.close("#item_info");
		}else{
			$('#validation_error').text(res.error);
		}
	}
	
	function delete_menu_item(base_url, item_id, item_name){
		var href;
		href = base_url+"menu_module/delete_item/"+item_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
</script>