<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
		</div>
	</div>
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
	<? require 'footer.php' ?>
	</body>
</html>
