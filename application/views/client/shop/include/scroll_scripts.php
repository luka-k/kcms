<script>
	(function($){
		$("#product-scroll").height($( window ).height() - 78);
		$("#map-scroll").height($( window ).height() - 94);
		$(".menuright").height($( window ).height() - 100);
		$(".leftmenu").height($( window ).height() - 100);
		$(".logo-column").height($(window).height() - 100);
		
		$(".secondcolumn").height($( window ).height() - 100);
		$("#shadow").height($( window ).height() - 220);
		$("#full-shadow").height($( window ).height() - 93);
		$("#wrapper").height($( window ).height() - 65);
		$("#scroll-right").height($(window).height() - 93);
		$("#good_page_scroll").height($( window ).height() - 80);
		
		$(window).load(function(){
			
		});
	})(jQuery);
	
	$(".logo-column").mCustomScrollbar({
		axis:"y", 
		advanced:{ autoExpandHorizontalScroll:true } //auto-expand content to accommodate floated elements
	});
</script>
<?if(isset($filters_checked) && count($filters_checked) > 3 || isset($no_shadow)):?>
	<script>
		$(".leftmenu").mCustomScrollbar({
			axis:"y", //set both axis scrollbars
			advanced:{ autoExpandHorizontalScroll:true } //auto-expand content to accommodate floated elements
		});
	</script>
<?endif;?>