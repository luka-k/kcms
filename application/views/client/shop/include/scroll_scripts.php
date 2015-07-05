<script>
	(function($){
		$("#product-scroll").height($( window ).height() - 70);
		$(".menuright").height($( window ).height() - 105);
		$(".leftmenu").height($( window ).height() - 105);
		
		$(".secondcolumn").height($( window ).height() - 105);
		$("#shadow").height($( window ).height() - 195);
		$("#full-shadow").height($( window ).height() - 105);
		$("#wrapper").height($( window ).height() - 95);
		
		$("#good_page_scroll").height($( window ).height() - 115);
	})(jQuery);
</script>
<?if(count($filters_checked) > 3):?>
	<script>
		$(".leftmenu").mCustomScrollbar({
			axis:"y", //set both axis scrollbars
			advanced:{ autoExpandHorizontalScroll:true } //auto-expand content to accommodate floated elements
		});
	</script>
<?endif;?>