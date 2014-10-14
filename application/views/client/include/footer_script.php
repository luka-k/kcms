<script>
	$('.open').click(function() {
		$(this).next().slideToggle().toggleClass('show');
		$(this).toggleClass('close');
	});
			
	$('.close').click(function() {
		$(this).next().slideToggle().toggleClass('hide');
		$(this).toggleClass('open');
	});
			
	$('#filt-1').click(function() {
		$(this).toggleClass('filtr-act');
		$('#attr-1').slideToggle().toggleClass('active');
		
		if ($('#attr-1').hasClass('active')){
			$('#shop-item').removeClass('content-shop-1');
			$('#shop-item').addClass('content-shop');
		}else{
			$('#shop-item').removeClass('content-shop');
			$('#shop-item').addClass('content-shop-1');		
		}
				
		if ($(this).hasClass('filtr-act')){
			$('#attr-2').removeClass('active');
			$('#attr-2').hide();
			$('#filt-2').removeClass('filtr-act');
			$('#attr-3').removeClass('active');
			$('#attr-3').hide();
			$('#filt-3').removeClass('filtr-act');
			$('#attr-4').removeClass('active');
			$('#attr-4').hide();
			$('#filt-4').removeClass('filtr-act');
		}
		

	});
			
	$('#filt-2').click(function() {
		$(this).toggleClass('filtr-act');
		$('#attr-2').slideToggle().toggleClass('active');

		if ($(this).hasClass('filtr-act')){
			$('#attr-1').removeClass('active');
			$('#attr-1').hide();
			$('#filt-1').removeClass('filtr-act');
			$('#attr-3').removeClass('active');
			$('#attr-3').hide();
			$('#filt-3').removeClass('filtr-act');
			$('#attr-4').removeClass('active');
			$('#attr-4').hide();
			$('#filt-4').removeClass('filtr-act');
		}	
		if ($('#attr-2').hasClass('active')){
			$('#shop-item').removeClass('content-shop-1');
			$('#shop-item').addClass('content-shop');
		}else{
			$('#shop-item').removeClass('content-shop');
			$('#shop-item').addClass('content-shop-1');		
		}
	});
			
	$('#filt-3').click(function() {
		$(this).toggleClass('filtr-act');
		$('#attr-3').slideToggle().toggleClass('active');
		
		if ($('#attr-3').hasClass('active')){
			$('#shop-item').removeClass('content-shop-1');
			$('#shop-item').addClass('content-shop');
		}else{
			$('#shop-item').removeClass('content-shop');
			$('#shop-item').addClass('content-shop-1');		
		}
				
		if ($(this).hasClass('filtr-act')){
			$('#attr-1').removeClass('active');
			$('#attr-1').hide();
			$('#filt-1').removeClass('filtr-act');
			$('#attr-2').removeClass('active');
			$('#attr-2').hide();
			$('#filt-2').removeClass('filtr-act');
			$('#attr-4').removeClass('active');
			$('#attr-4').hide();
			$('#filt-4').removeClass('filtr-act');
		}

	});
	
	$('#filt-4').click(function() {
		$(this).toggleClass('filtr-act');
		$('#attr-4').slideToggle().toggleClass('active');
		
		if ($('#attr-4').hasClass('active')){
			$('#shop-item').removeClass('content-shop-1');
			$('#shop-item').addClass('content-shop');
		}else{
			$('#shop-item').removeClass('content-shop');
			$('#shop-item').addClass('content-shop-1');		
		}
				
		if ($(this).hasClass('filtr-act')){
			$('#attr-1').removeClass('active');
			$('#attr-1').hide();
			$('#filt-1').removeClass('filtr-act');
			$('#attr-2').removeClass('active');
			$('#attr-2').hide();
			$('#filt-2').removeClass('filtr-act');
			$('#attr-3').removeClass('active');
			$('#attr-3').hide();
			$('#filt-3').removeClass('filtr-act');
		}

	});
				
	$('#filt-1').click();
</script>