<script>
	$('.accordeon-head').click(function() {
		$(this).next().slideToggle().toggleClass('noactive');
		if ($(this).find('span.list'))
		{
			if ($(this).find('span.list').html() == '+')
				$(this).find('span.list').html('-');
			else
				$(this).find('span.list').html('+');
		}
	});
		
	$('.acc-h').click(function() {
		$('.acc-b').slideToggle().toggleClass('noactive');
		if ($(this).find('span.list'))
		{
			if ($(this).find('span.list').html() == '+')
				$(this).find('span.list').html('-');
			else
				$(this).find('span.list').html('+');
		}
	});
</script>