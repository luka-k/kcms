$('a.lightbox').fancybox({
	overlayOpacity: 0.2,
	overlayColor: '#000'
});	

function openFancy(){
	var viewedImgKey = $('.cloud-zoom').attr('data-imgkey');
	
	$.fancybox.open($('a.lightbox'), {index : viewedImgKey});  
};

/*******************************************************************
* Валидация формы
*******************************************************************/
function validation (element, errorClass) {
	var input = element.find('input[type="text"]'),
	spaces = new RegExp(/^(\s|\u00A0)+|(\s|\u00A0)+$/g),
	isNecessatily,
	isError = false;
			
	input.on('focus', function () {
		var el = $(this);
		if (el.hasClass(errorClass)) el.removeClass(errorClass);
	});
			
	input.each(function () {
		var el = $(this);
		if (el.attr('data-necessarily') == 'true' && el.val().replace(spaces, '') == '') {
			el.addClass(errorClass);
			isError = true;
		}
				
		if (el.attr('data-id') == 'name' && el.val() == "") {
			el.addClass(errorClass);
			isError = true;
		}
				
		if (el.attr('data-id') == 'email' && el.val().match('@') == null) {
			el.addClass(errorClass);
			isError = true;
		}
				
		if (el.attr('data-id') == 'phone' && el.val() == null) {
			el.addClass(errorClass);
			isError = true;
		}
				
		if (el.attr('data-id') == 'address' && el.val() == null) {
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

function callback_submit(form_id){
	if (validation($("#"+form_id), "error")) return false;
			
	$.fancybox.close();
			
	var form = $('#'+form_id),
	inputs = form.find('input'),
	data = {};
			
	inputs.each(function () {
		var element = $(this);
		data[element.attr('name')] = element.val();
	});
			
	var json_str = JSON.stringify(data);
	$.post( "/ajax/callback/", json_str, function() {
		$.fancybox.open("#callback_answer");
				
		setTimeout(function(){
			$.fancybox.close();
		}, 3000);
	}, 'json');	
}

(function($){
	$(window).load(function(){
		$(".scroll-content").height($( window ).height() - 125);
		$(".scroll-contentd").height($( window ).height() - 125);
		$("#leftscroll").height($( "#leftscroll" ).height() + 0);
		$("#good_page_scroll").height($( window ).height() - 115);
		$(".scroll-content").mCustomScrollbar({
			scrollButtons:{
				enable:true
			}
		});
		$(".horscroll-content").mCustomScrollbar({
			horizontalScroll:true,
			scrollButtons:{
				enable:true
			}
		});
	});
})(jQuery);