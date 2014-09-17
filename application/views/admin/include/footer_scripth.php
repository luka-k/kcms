<script>
	$('ul .down-1').mouseover(function() {
		$(this).next().removeClass('noactive');
		$(this).next().addClass('active');
	});
</script>