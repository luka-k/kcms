/*******************************************************************
* Валидация формы
*******************************************************************/

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

function form_submit(form_id){
	var errorClass = 'error';

	if (validation($("#"+form_id), errorClass)) return false;

	$("#"+form_id).submit();
	return false;
}

$(function(){
	$(document).click(function(event) {
		if ($(event.target).closest("#parent-info").length) return;
		$("#parent-info").removeClass('active');
		$(".info-link").removeClass('active');
		event.stopPropagation();
	});
});


$(window).load(function(){
	$("#children_col").height($(window).height() - 16);
	
});

function set_status(type, child_id){
	data = new Object();
	
	data.type = type;
	data.child_id = child_id;
	data.status = $('#'+type+'_ch').prop('checked');
	
	var json_str = JSON.stringify(data);
	
	$.post ("/ajax/set_child_status/", json_str,  function(answer){
		if(answer.status){
			$('.'+answer.type+'_status').html('включено');
			$('.'+answer.type+'_status').addClass('green');
			$('.'+answer.type+'_status').removeClass('red');
			$('.'+answer.type+'_date').html(answer.date);
		}else{
			$('.'+answer.type+'_status').html('выключено');
			$('.'+answer.type+'_status').addClass('red');
			$('.'+answer.type+'_status').removeClass('green');
			$('.'+answer.type+'_date').html('');
		}
	}
	, "json");	
}

function set_limit(limit, card_number){
	data = new Object();
	
	data.limit = limit;
	data.card_number = card_number;
	
	var json_str = JSON.stringify(data);
	
	$.post ("/ajax/set_child_limit/", json_str, "json");
}

function set_product_status(product_id, child_id){
	data = new Object();
	
	data.product_id = product_id;
	data.child_id = child_id;
	
	data.status = $('#'+product_id+'_pr').prop('checked');
	
	var json_str = JSON.stringify(data);
	
	$.post ("/ajax/set_product_status/", json_str, "json");
}