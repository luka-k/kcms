$(function () {
	var elWrap = $('#slider'),
		el =  elWrap.find('a'),
		indexImg = 1,
		indexMax = el.length,
		phase = 3000;
	
	function change () {
		//el.fadeOut(500);
		var d  = el.filter(':nth-child('+indexImg+')');
		d.fadeIn(500);
		if (indexImg > 1)
			el.filter(':nth-child('+(indexImg-1)+')').fadeOut(50);
		else
			el.filter(':nth-child('+(indexMax)+')').fadeOut(50);
	}
		
	function autoChange () {	
		indexImg++;
		if(indexImg > indexMax) {
			indexImg = 1;
		}			
		change ();
	}	
	$('#slider a').hide();
	$('#slider a').first().show();
	var interval = setInterval(autoChange, phase);

	elWrap.mouseover(function() {
		clearInterval(interval);
	});
	elWrap.mouseout(function() {
		interval = setInterval(autoChange, phase);
	});
	
	elWrap.append('<span class="next"></span><span class="prev"></span>');
	var	btnNext = $('span.next'),
		btnPrev = $('span.prev');
		
	btnNext.click(function() {
		indexImg++;
		if(indexImg > indexMax) {
			indexImg = 1;
		}
		change ();
	});
	btnPrev.click(function() {
		indexImg--;
		if(indexImg < 1) {
			indexImg = indexMax;
		}
		change ();
	});	
});
