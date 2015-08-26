<script>
	(function($){	
		$('.lm-item').click(function() {
			if ($(this).hasClass('active'))
			{
				$('.lm-item').removeClass('active');
				$('.lm-item').stop().animate({width:'258px'},'slow');
				$('.secondcolumn').fadeOut('slow');
				$('#searchpopupbtn').fadeOut('slow');
			} else {
				$('.lm-item').stop().animate({width:'258px'},'slow');
				$('.lm-item').removeClass('active');
				$(this).addClass('active');
				$(this).stop().animate({width:'272px'},'slow');
				$('.secondcolumn').fadeOut('slow');
				$('#'+$(this).attr('prop')).fadeIn('slow');
				$('#searchpopupbtn').fadeOut('slow'); 
			}
		});
		
		$(document).click(function(event) {
			if ($(event.target).closest(".secondcolumn").length) return;
			if ($(event.target).closest(".lm-item").length) return;
			$('.secondcolumn').fadeOut('slow');
			$('.lm-item').removeClass('active');
			$('.lm-item').stop().animate({width:'258px'},'slow');
			event.stopPropagation();
		});
				
		$('.secondcolumn .level1_click').click(function() {
			$(this).parent().find('ul').toggle('slow');

			if ($(this).html() == '+')
				$(this).html('-');
			else
				$(this).html('+');
		});
		
		$('.submit-btn.ch').click(function() {
			var type = $(this).attr('data-type');
			
			if($('.input_'+type).val() == 1)
			{
				$('.input_'+type).val('2');
				$(this).removeClass('active');
			}
			else
			{
				$('.input_'+type).val('1');
				$(this).addClass('active');
			}
			
			$('#filter-form').submit();
		});
				
		$('.secondcolumn input').click(function() {
			var width = $(this).parent().width();
			
			show_popup(width);;
			$('#searchpopupbtn').css('top', ($(this).offset().top - 70) + 'px');
		});
		
		$('#search_input').change(function() {
			$('#filter-form').submit();
		});
	})(jQuery);
	
	
	
	function show_popup(width){
		$('#total_count').html('...');
		$('#searchpopupbtn').css('left', (width + 320) + 'px');
		$('#searchpopupbtn').fadeIn('slow');
		$.post('/shop/catalog/count/', $('#filter-form').serialize(), function(data) {$('#total_count').html(data);}, 'html');
	}
		
		
	function clear_filter(type){
		$('.'+type+'-filter').prop("checked", false);
		$('#filter-form').submit();
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