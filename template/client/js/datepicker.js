/*=========================================================================
 * Календарь
 *========================================================================= */

$(function() {
	$.post("/ajax/selected_days/", function(res) {
	
		events = JSON.parse(res);

		$( ".datepicker" ).datepicker({
			beforeShowDay: function(date) {
				var result = [false, '', null];
				
				var matching = $.grep(events, function(event) {
					var day = new Date(event);
					
					return day.valueOf() === date.valueOf();
				});
				
				if (matching.length) {
					result = [true, 'highlight', null];
				}
				return result;
			},
			numberOfMonths:[3, 1],
			onSelect:function(dateText){
				document.location.replace('/articles/novosti?date='+dateText);
			}
		});
	
	});
	
	
	$( ".datepicker" ).datepicker( "option", $.datepicker.regional["ru"]);
});