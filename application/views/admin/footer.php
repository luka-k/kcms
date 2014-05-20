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
		<footer>
			<div class="grid flex">
			
				<div class="col_12">
					KCMS-lite
				</div>
			
			</div>
		</footer>
	</body>
</html>