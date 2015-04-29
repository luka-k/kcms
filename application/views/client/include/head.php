<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>bрайтbилd - интернет магазин</title>
	
	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" />
		<!-- Add jQuery library -->
			
		 
		 
		<link rel="stylesheet" href="/template/client/css/style-new.css" type="text/css">
		<link rel="stylesheet" href="/template/client/css/jquery-ui.css">
		
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery/ui/jquery-ui.js"></script>
	
	
	<link href="<?=base_url()?>template/client/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
	<script type="text/javascript">var current_id = 0;</script> 
	
	<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" />
	<!-- Add jQuery library -->
		
	<script src="<?=base_url()?>template/client/js/jquery/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="<?=base_url()?>template/client/js/jquery/plugins/jquery.mCustomScrollbar.min.js"></script>
	<script src="<?=base_url()?>template/client/js/cart.js"></script>
		
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
				
				$( "#width-range" ).slider({
					range: true,
					min: <?= $width_min?>,
					max: <?= $width_max?>,
					values: [ <?= $width_from?>, <?= $width_to?> ],
					slide: function( event, ui ) {
						$( "#width-low" ).val( "от " + ui.values[ 0 ] + " мм" );
						$( "#width-hi" ).val( "до " + ui.values[ 1 ] + " мм" );
					}
				});
				$( "#width-low" ).val( "от " + $( "#width-range" ).slider( "values", 0 )  + " мм" );
				$( "#width-hi" ).val( "до " + $( "#width-range" ).slider( "values", 1 )  + " мм" );
				
				$( "#height-range" ).slider({
					range: true,
					min: <?= $height_min?>,
					max: <?= $height_max?>,
					values: [ <?= $height_from?>, <?= $height_to?> ],
					slide: function( event, ui ) {
						$( "#height-low" ).val( "от " + ui.values[ 0 ] + " мм" );
						$( "#height-hi" ).val( "до " + ui.values[ 1 ] + " мм" );
					}
				});
				$( "#height-low" ).val( "от " + $( "#height-range" ).slider( "values", 0 )  + " мм" );
				$( "#height-hi" ).val( "до " + $( "#height-range" ).slider( "values", 1 )  + " мм" );
				
				$( "#weight-range" ).slider({
					range: true,
					min: <?= $depth_min?>,
					max: <?= $depth_max?>,
					values: [ <?= $depth_from?>, <?= $depth_to?> ],
					slide: function( event, ui ) {
						$( "#weight-low" ).val( "от " + ui.values[ 0 ] + " мм" );
						$( "#weight-hi" ).val( "до " + ui.values[ 1 ] + " мм" );
					}
				});
				$( "#weight-low" ).val( "от " + $( "#weight-range" ).slider( "values", 0 )  + " мм" );
				$( "#weight-hi" ).val( "до " + $( "#weight-range" ).slider( "values", 1 )  + " мм" );
				
				$( "#price-range" ).slider({
					range: true,
					min: <?= $price_min?>,
					max: <?= $price_max?>,
					values: [ <?= $price_from?>, <?= $price_to?> ],
					slide: function( event, ui ) {
						$( "#price-low" ).val( "от " + ui.values[ 0 ] + " т.р." );
						$( "#price-hi" ).val( "до " + ui.values[ 1 ] + " т.р." );
					}
				});
				$( "#price-low" ).val( "от " + $( "#price-range" ).slider( "values", 0 )  + " т.р." );
				$( "#price-hi" ).val( "до " + $( "#price-range" ).slider( "values", 1 )  + " т.р." );
				
				$('.lm-item').click(function() {
					if ($(this).hasClass('active'))
					{
						$('.lm-item').removeClass('active');
						$('.lm-item').stop().animate({width:'249px'},'slow');
						$('.secondcolumn').fadeOut('slow');
						$('#searchpopupbtn').fadeOut('slow');
					} else {
						$('.lm-item').stop().animate({width:'249px'},'slow');
						$('.lm-item').removeClass('active');
						$(this).addClass('active');
						$(this).stop().animate({width:'268px'},'slow');
						$('.secondcolumn').fadeOut('slow');
						$('#'+$(this).attr('prop')).fadeIn('slow');
						$('#searchpopupbtn').fadeOut('slow'); 
					}
				});
				
				$('.secondcolumn a.level1_link').click(function() {
					$(this).parent().find('ul').toggle('slow');
					if ($(this).find('span'))
					{
						if ($(this).find('span').html() == '+')
							$(this).find('span').html('-');
						else
							$(this).find('span').html('+');
					}
					return false;
				});
				
				$('.secondcolumn input').click(function() {
					//$('#shadow').fadeOut('slow'); 
					$('#total_count').html('...');
					$('#searchpopupbtn').css('left', ($(this).parent().width() + 328) + 'px');
					$('#searchpopupbtn').fadeIn('slow');
					
					
					
					$.post('/catalog/count', $('#filter-form').serialize(), function(data) {$('#total_count').html(data);}, 'html');
					
					
					$('#searchpopupbtn').css('top', ($(this).offset().top - 6) + 'px');
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
		
		function checked_tree(parent_id, type, action){
			var form = $('.filter-form'),
			inputs = form.find('input.'+type+'-branch-'+parent_id);

			var counter_1 = 0;
			var counter_2 = 0;
			inputs.each(function () {
				var element = $(this);
				if(action == "fork"){
				
					if($("#"+type+"-fork-"+parent_id).prop("checked")){
						element.prop("checked", true);
					}else{
						element.prop("checked", false);
					}
	
				
			}else if(action == "child"){
				counter_1++;
				if(element.prop("checked") == false){
					$("#"+type+"-fork-"+parent_id).prop("checked", false);
				}else{
					counter_2++;
				}
				
				if(counter_1 == counter_2){
					$("#"+type+"-fork-"+parent_id).prop("checked", true);
				}
			}
		});
	}
	
	</script>	
</head>