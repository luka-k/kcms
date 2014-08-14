<script>
	$('ul .up').click(function() {
		$(this).next().slideToggle().toggleClass('noactive');
		$(this).toggleClass('up');
		$(this).toggleClass('down');
	});

	$('ul .down').click(function() {
		$(this).next().slideToggle().toggleClass('noactive');
		$(this).toggleClass('down');
		$(this).toggleClass('up');
	});
</script>