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

function submit_form(form_id){
	var errorClass = 'error';

	if (validation($("#"+form_id), errorClass)) return false;

	$("#"+form_id).submit();
}