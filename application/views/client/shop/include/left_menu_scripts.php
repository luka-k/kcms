<script>
	(function($){
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
			show_popup();
				
			$('#searchpopupbtn').css('top', ($(this).offset().top - 70) + 'px');
			$('#searchpopupbtn').css('left', ($(this).offset().left + 205) + 'px');
		});
	})(jQuery);
	
	function show_popup(){
		$('#total_count').html('...');
		$('#searchpopupbtn').css('left', ($(this).parent().width() + 328) + 'px');
		$('#searchpopupbtn').fadeIn('slow');
		$.post('<?=base_url()?>catalog/count/', $('#filter-form').serialize(), function(data) {$('#total_count').html(data);}, 'html');
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