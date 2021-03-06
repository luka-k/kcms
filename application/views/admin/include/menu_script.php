<script>
	function item_info(id){
		var data = {};
		data.id = id;
		var json_str = JSON.stringify(data);
		$.post("/admin/menu_module/menu_item/", json_str, item_info_answer, "json");
	}
																
	function item_info_answer(res){
		$('#validation_error').text("");
		$.fancybox.open("#menu_item_popup");

		var form = $('.edit_item');
		if(res.item != ""){
			for (var key in res.item) {
				var val = res.item[key];
				element = form.find('.'+key);
				if(element.attr('type') != 'radio'){
					element.val(val);
				}
				if(key == "item_type"){
					var type = res.item[key];
				}
			}
			$('.item-title').text("Редактировать ");
			menu_type(type);
		}else{
			$('.item-title').text("Добавить ");
			clear_form();		
		}
	}
								
	function edit_item(){
		var form = $('.edit_item'),
		inputs = form.find('.menu_items'),
		data = {},
		info = {},
		type;
								
		inputs.each(function () {
			var element = $(this);
			info[element.attr('name')] = element.val();
			if(element.attr('name') == "item_type"){
				
				type = element.val();
			}
		});	
		info[form.find('#field-'+type).attr('name')] = form.find('#field-'+type).val();
		
		data.info = info;
		var json_str = JSON.stringify(data);
		$.post("/admin/admin_ajax/edit_item/", json_str, update_menu, "json");
	}
								
	function update_menu(res){
		//console.log(res);
		if(res.error == false){
			clear_form();
			var item = res.item;
			if(res.after){
				var after = res.after;
			
				$("#menus_items-"+after.id).after("<li id='menus_items-'"+item.id+">"+item.name+" <a href='#' class='edit' onclick=''><i class='icon-pencil icon-large'></i></a><a href='#' class='del' onclick=''><i class='icon-minus-sign icon-large'></i></a></li>");	
				var edit_link = "item_info('"+item.id+"'); return false;";
				var del_link = "delete_menu_item('"+res.base_url+"', '"+item.id+"', '"+item.name+"'); return false;"
				$('a.edit').attr('onclick', edit_link);
				$('a.del').attr('onclick', del_link);
			}else{
				$('.item-name-'+item.id).text(item.name);
			}
			$.fancybox.close("#item_info");
		}else{
			$('#validation_error').text(res.error);
		}
	}
	
	function delete_menu_item(base_url, item_id, item_name){
		var href;
		href = base_url+"admin/menu_module/delete_item/"+item_id;
		$('#item_name').text(item_name);
		$('.delete_button').attr('href', href);
		$.fancybox.open("#delete_item");
	}
	
	function clear_form(){
		var form = $('.edit_item'),
		inputs = form.find('.menu_items');
			
		inputs.each(function (){ 
			var element = $(this);
			var val = null;
			if(element.attr('name') != "menu_id" && element.attr('type') != 'radio'){
				element.val(val);
			}
		});	
	}
	
	function menu_type(type)
	{
		$('.select_url').css("display", "none");
		
		var form = $('.edit_item'),
		inputs = form.find('.select_url');
		inputs.each(function (){ 
			var element = $(this);
			element.disabled=true;
		});
		$('#field-'+type).css("display", "inline");
		document.getElementById('field-'+type).disabled=false;
	}
</script>