/*=========================================================================
 * Календарь
 *========================================================================= */

$(function() {
	var data = new Object();
	
	parent = $( ".datepicker" ).attr("category");
	
	data.parent = parent;
	var json_str = JSON.stringify(data);
	
	$.post( "/ajax/selected_days/", json_str, function(res) {
	
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
				document.location.replace('/articles/o-nas/novosti?date='+dateText);
			}
		});
	
	});
	
	
	$( ".datepicker" ).datepicker( "option", $.datepicker.regional["ru"]);
});