/*************************************************************
*
* Валидация 
*
*************************************************************/

function validation (element, errorClass) {
	var input = element.find('.require'),
	isError = false;

	input.on('focus', function () {
		var el = $(this);
		if (el.hasClass(errorClass)) el.removeClass(errorClass);
	});
		
	input.each(function () {
		var el = $(this);
		if (el.val() == "") {
            el.addClass(errorClass);
            isError = true;
        }
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