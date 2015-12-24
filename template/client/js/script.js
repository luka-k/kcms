(function($){
	$(".callback_link").click(function(){
		var formInputs = $("#callback_form").find('input');
	
		formInputs.each(function () {
			$(this).val('');
			if ($(this).hasClass("error")) $(this).removeClass("error");
		});
	
		$.fancybox.open("#callback");
	});
		
	$(".autocomplete").keypress(function(){
		$.post("/ajax/autocomplete/", function(data){
			var availableTags = data.available_tags;
		
			$("#search_input").autocomplete({
				source: availableTags,
				select: function( event, ui ) {
					$('.search').val(ui.item.value);
					$('#searchform').submit();
				}
			});
		}, 'json');
	});	
	
	$('.cart-order__extra-link').click(function(){
		$('.cart-order__extra').slideToggle();
		return false;
	});
})(jQuery);


// Слайдеры на главной и в товарах
(function($){
	$('.promo__slider').bxSlider({
		controls: false,
		auto: true
	});
	
	var thumbsCount = $('.product-images-thumbs__item').length;

	if (thumbsCount > 4){
		$('.product-images-thumbs').bxSlider({
			pager: false,
			mode: 'vertical',
			minSlides: 4,
			maxSlides: 4,
			moveSlides: 1,
			adaptiveHeight: false
		});
	}
})(jQuery);

// Изображения товара
(function($){
	var $images = $('.product-images'),
        $bigImages = $images.find('.product-images__href'),
        $thumbHrefs = $images.find('.product-images-thumbs__href');    
		
    //hide big images except first
    $bigImages.not( $bigImages.eq(0) ).addClass('hidden');

    $thumbHrefs.on('click', function(){
		var image = $(this).attr('href'),
		fullImage = $(this).data('full-image');
		
		$bigImages.removeClass('hidden').not($images.find('[href="' +fullImage + '"]')).addClass('hidden');
		
		return false;
    });
})(jQuery);

(function($){
	var $rangeSlider = $('[data-range-slider]'),
		$rangeFrom = $('[data-range-from]'),
		$rangeTo = $('[data-range-to]'),
		min = $rangeSlider.data('range-min'),
		max = $rangeSlider.data('range-max'),
		min_value = $rangeSlider.data('min-value'),
		max_value = $rangeSlider.data('max-value'),
		step = parseInt( (max - min) / 10 );
		
	$rangeSlider.slider({
		min: min,
		max: max,
		step: step,
		range: true,
		values: [ min_value, max_value ],
		stop: function( event, ui ) {
			$rangeFrom.html(ui.values[0]);
			$rangeTo.html(ui.values[1]);

			$('#price_from').val(ui.values[0]);
			$('#price_to').val(ui.values[1]);
		}
	}); 
})(jQuery);


(function($){
	$('.fancyimage').fancybox({
		maxWidth: 900
	});
})(jQuery);	


function callback(){
	if (validation($("#callback_form"), "error")) return false;
			
	$.fancybox.close();

	var inputs = $("#callback_form").find('input'),
	data = {};
			
	inputs.each(function () {
		data[$(this).attr('name')] = $(this).val();
	});
			
	var json_str = JSON.stringify(data);
	$.post( "/ajax/callback/", json_str, function(data) {
	
		$('#popup_title').html(data.title);
		$('#popup_message').html(data.message);
		$.fancybox.open("#callback_answer");
				
		setTimeout(function(){$.fancybox.close();}, 4000);
	}, 'json');	
}

function validation (form, errorClass) {
	var input = form.find('.validate'),
	isError = false;

	input.on('focus', function () {
		if ($(this).hasClass(errorClass)) $(this).removeClass(errorClass);
	});
		
	input.each(function () {
		if ($(this).val() == "") {
            $(this).addClass(errorClass);
            isError = true;
        }
    });
		
   return isError;
}

function submitForm(form_id){
	var errorClass = 'error';

	if (validation($("#"+form_id), errorClass)) return false;

	$("#"+form_id).submit();
}

function fastOrder(id, name, img){
	$('#fast_order_img').prop('src', img)
	$('.fast_order_product_name').html(name);
	$('.product_id').val(id);
	$.fancybox.open("#fast_order");
}

function fastOrdersubmit(){
	//var data = $('#fast_order_form').serialize();
	var data = {};
	var inputs = $('#fast_order_form').find('input');
	
	inputs.each(function () {
		data[$(this).attr('name')] = $(this).val();
	});

	var json_str = JSON.stringify(data);
	
	$.post ("/order/fast_order/", json_str, function(data){
		$.fancybox.open("#fast_order_answer");
		setTimeout(function(){$.fancybox.close();}, 4000);
	}, "json");
}