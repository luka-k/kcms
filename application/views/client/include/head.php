<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>bрайтbилd - интернет магазин</title>
	<!--<base href="http://brightbuild.ru/shop/">
	<meta content="http://brightbuild.ru/image/bb_house.jpg" property="og:image">-->
		
	<link rel="stylesheet" href="<?=base_url()?>template/client/css/style.css" type="text/css">
	<link href="<?=base_url()?>template/client/js/jquery/ui/jquery-ui.min.css" rel="stylesheet" />
	
	<link href="<?=base_url()?>template/client/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
	<script type="text/javascript">var current_id = 0;</script> 
	
	<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" />
	<!-- Add jQuery library -->
		
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery/ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/accordion.js?v05"></script>
	
	<script type="text/javascript" src="<?=base_url()?>template/client/js/cart.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/script.js"></script>
		
	<script src="<?=base_url()?>template/client/js/jquery/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="<?=base_url()?>template/client/js/jquery/plugins/jquery.mCustomScrollbar.min.js"></script>
		
	<script>
		
		(function($){
			$(window).load(function(){
				$(".scroll-content").height($( window ).height() - 105);
				$(".scroll-contentd").height($( window ).height() - 105);
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
				
				if (el.attr('data-id') == 'name' && el.val() == null) {
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
			if (validation($("#order"), errorClass)) return false;
			$("#order").submit();
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
	
	</script>	
</head>