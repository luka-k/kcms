<script>
	(function($){
		$( "#width-range" ).slider({
			range: true,
			min: <?= $width_min?>,
			max: <?= $width_max?>,
			values: [ <?= $width_from?>, <?= $width_to?> ],
			start: function( event, ui ) {
				$("#width-low").attr("name", "width_from");
				$("#width-hi").attr("name", "width_to");
			},
			slide: function( event, ui ) {
				$( "#width-low" ).val( "от " + ui.values[ 0 ] + " мм" );
				$( "#width-hi" ).val( "до " + ui.values[ 1 ] + " мм" );
			},
			stop: function( event, ui ) {
				show_popup();
				$('#last_type_filter').val('width');
				$('#searchpopupbtn').css('top', ($(this).offset().top - 78) + 'px');
				$('#searchpopupbtn').css('left', ($(this).offset().left + 237) + 'px');
			}
		});
		
		$( "#width-low" ).val( "от " + $( "#width-range" ).slider( "values", 0 )  + " мм" );
		$( "#width-hi" ).val( "до " + $( "#width-range" ).slider( "values", 1 )  + " мм" );
		
		$( "#height-range" ).slider({
			range: true,
			min: <?= $height_min?>,
			max: <?= $height_max?>,
			values: [ <?= $height_from?>, <?= $height_to?> ],
			start: function( event, ui ) {
				$("#height-low").attr("name", "height_from");
				$("#height-hi").attr("name", "height_to");
			},
			slide: function( event, ui ) {
				$( "#height-low" ).val( "от " + ui.values[ 0 ] + " мм" );
				$( "#height-hi" ).val( "до " + ui.values[ 1 ] + " мм" );
						
			},
			stop: function( event, ui ) {
				show_popup();
				$('#last_type_filter').val('height');
				$('#searchpopupbtn').css('top', ($(this).offset().top - 78) + 'px');
				$('#searchpopupbtn').css('left', ($(this).offset().left + 237) + 'px');
			}
		});
		
		$( "#height-low" ).val( "от " + $( "#height-range" ).slider( "values", 0 )  + " мм" );
		$( "#height-hi" ).val( "до " + $( "#height-range" ).slider( "values", 1 )  + " мм" );
				
		$( "#weight-range" ).slider({
			range: true,
			min: <?= $depth_min?>,
			max: <?= $depth_max?>,
			values: [ <?= $depth_from?>, <?= $depth_to?> ],
			start: function( event, ui ) {
				$("#weight-low").attr("name", "depth_from");
				$("#weight-hi").attr("name", "depth_to");
			},
			slide: function( event, ui ) {
				$( "#weight-low" ).val( "от " + ui.values[ 0 ] + " мм" );
				$( "#weight-hi" ).val( "до " + ui.values[ 1 ] + " мм" );
			},
			stop: function( event, ui ) {
				show_popup();
				$('#last_type_filter').val('weight');
				$('#searchpopupbtn').css('top', ($(this).offset().top - 78) + 'px');
				$('#searchpopupbtn').css('left', ($(this).offset().left + 237) + 'px');
			}
		});
		
		$( "#weight-low" ).val( "от " + $( "#weight-range" ).slider( "values", 0 )  + " мм" );
		$( "#weight-hi" ).val( "до " + $( "#weight-range" ).slider( "values", 1 )  + " мм" );
				
		$( "#price-range" ).slider({
			range: true,
			min: <?= $price_min?>,
			max: <?= $price_max?>,
			values: [ <?= $price_from?>, <?= $price_to?> ],
			start: function( event, ui ) {
				$("#price-low").attr("name", "price_from");
				$("#price-hi").attr("name", "price_to");
			},
			slide: function( event, ui ) {
				$( "#price-low" ).val( "от " + ui.values[ 0 ] + " р." );
				$( "#price-hi" ).val( "до " + ui.values[ 1 ] + " р." );
			},
			stop: function( event, ui ) {
				show_popup();
				$('#last_type_filter').val('price');
				$('#searchpopupbtn').css('top', ($(this).offset().top - 78) + 'px');
				$('#searchpopupbtn').css('left', ($(this).offset().left + 237) + 'px');
			}			
		});
		
		$( "#price-low" ).val( "от " + $( "#price-range" ).slider( "values", 0 )  + " р." );
		$( "#price-hi" ).val( "до " + $( "#price-range" ).slider( "values", 1 )  + " р." );
	})(jQuery);
</script>