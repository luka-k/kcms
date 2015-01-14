function validation (element, errorClass) {
	var input = element.find('.validate'),
	isError = false;

	input.on('focus', function () {
		var el = $(this);
		if (el.hasClass(errorClass)) el.removeClass(errorClass);
	});
		
	input.each(function () {
		var el = $(this);
		console.log(el.val());
		if (el.val() == "") {
            el.addClass(errorClass);
            isError = true;
        }
    });

   return isError;
}

function validate_form(form_id){
	var errorClass = 'error';

	if (validation($("#"+form_id), errorClass)) return false;
	
	$("#"+form_id).submit();
}


