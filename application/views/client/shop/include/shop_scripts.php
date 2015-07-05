<script>
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
		
	function sub_form(){
		var errorClass = 'frame-input_error';
		if (validation($("#order_form"), errorClass)) return false;
		$("#order_form").submit();
	}
		
	function autocomp(type){
		var form = $('.filter-form'),
		categories_inputs = form.find('input.categories_checked'),
		categories_checked = {},
		data = {};
		var num = 0;
		categories_inputs.each(function () {
			var element = $(this);
			
			if (element.attr('type') == 'checkbox' && element.prop("checked")) {
				categories_checked[num] = element.val();
				num++;
			}
		});

		data.type = type;
		data.url = window.location.pathname;
			
		data.categories_checked = categories_checked;
		var json_str = JSON.stringify(data);
		$.post ("/ajax/autocomplete/", json_str, autocomp_answer, "json");
	}
		
	function autocomp_answer(res){
		var availableTags = res.available_tags;
			
		$("#"+res.type).autocomplete({
			source: availableTags
		});
	}
	
	$('.fancybox').fancybox();
	
	$('.js-close-fancybox').on('click', function(){
		$.fancybox.close();
		return false;
	});
</script>