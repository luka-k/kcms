function validation (element, errorClass) {
	var input = element.find('.validate'),
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

function validate_form(form_id){
	var errorClass = 'error';

	if (validation($("#"+form_id), errorClass)) return false;

	$("#"+form_id).submit();
}

function subscribe(){
	var data = {};
	if (validation($("#subscribe_form"), 'error')) return false;
	console.log($("#subscribe_input").val());
	data.email = $("#subscribe_input").val();
	var json_str = JSON.stringify(data);
	
	$.post ("/ajax/subscribe/", json_str, function showAnswer(res) { 
						
		$.fancybox('<div class="result" style="text-align:center; margin-top:40px;"><p>'+res.answer+'</p></div>', {
			autoSize: false,
			autoHeight: false,
			autoWidth: false,
			autoResize: false,
			width: 400,
			height: 100
		});
		
		setTimeout(function () {
			$.fancybox.close();
		}, 3000);
	}   , "json");
}
