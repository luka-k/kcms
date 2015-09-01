/*************************************************************
*
* Валидация 
*
*************************************************************/

	function validation(element, errorClass){
		var input = element.find('.validation'),
		isError = false;
		
		input.on('focus', function () {
			var el = $(this);
			if (el.hasClass(errorClass)){
				el.attr('placeholder', '');
				el.removeClass(errorClass);
			}
		});
		
		input.each(function () {
			var el = $(this);
			
			var factors = el.attr('data-id');
			
			factors = factors.split('|');
			
			factors.forEach(function(item){ 
				if (item == 'require' && el.val() == "") {
					el.attr('placeholder', 'Не обходимо ввести значение');
					el.addClass(errorClass);
					isError = true;
				}
				
				if(item == 'email' && el.val().match('[\.\-_A-Za-z0-9]+?@[\.\-A-Za-z0-9]+?[\ .A-Za-z0-9]{2,}') == null) {
					el.attr('placeholder', 'Не обходимо ввести коректнный email');
					el.addClass(errorClass);
					isError = true;
				}
				
				if(item.match('matches')){
					factor = item.substring(8, item.length-1);
					matched = element.find('input[name="'+factor+'"]');
					if(matched.val() != el.val()){
						el.attr('placeholder', 'Значение полей должно совпадать');
						matched.attr('placeholder', 'Значение полей должно совпадать');
						el.addClass(errorClass);
						matched.addClass(errorClass);
						isError = true;
					}
				}
			});
		});
		
		return isError;
	}

/************************************************************
*
* Отправление формы прощедщей валидацию.
*
************************************************************/

function submit_form(form_id){
	var errorClass = 'error';

	if (validation($("#"+form_id), errorClass)) return false;

	$("#"+form_id).submit();
}


/************************************************************
*
* 
*
************************************************************/

function delete_image(base_url, type, item_id, tab){
	var href;
	href = base_url+"admin/content/delete_image/"+type+"/"+item_id+"/"+tab;
	$('#item_name').text("изображение");
	$('.delete_button').attr('href', href);
	$.fancybox.open("#delete_item");
}

function rename_image(id, name){
	data = new Object();
	data.id = id;
	data.name = name;
	
	var json_str = JSON.stringify(data);
	$.post ("/admin/content/rename_image/", json_str, "json");
}