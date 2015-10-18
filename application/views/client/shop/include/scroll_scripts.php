<script>
	(function($){
		$("#product-scroll").height($( window ).height() - 78);
		$("#map-scroll").height($( window ).height() - 90);
		$(".menuright").height($( window ).height() - 100);
		$(".leftmenu").height($( window ).height() - 100);
		$(".logo-column").height($(window).height() - 100);
		$(".cart-info").height($(window).height() - 65);
		
		$(".secondcolumn").height($( window ).height() - 100);
		$("#shadow").height($( window ).height() - 304);
		$("#full-shadow").height($( window ).height() - 93);
		$("#wrapper").height($( window ).height() - 65);
		$("#scroll-right").height($(window).height() - 93);
		$("#good_page_scroll").height($( window ).height() - 80);
		
		$(document).ready(function(){
			//var product_width = ;
			//var logo_width = $('#manufacturers_column').width();
			var max_width = $('#product-scroll').width() + $('#manufacturers_column').width() - 2;
			
			$('.secondcolumn').css("max-width", max_width + 'px');
	
			$('.ajax_from').val(10);
			$('#sorting_order').val('ranging');
			$('#sorting_direction').val('desc');
			<? if (!isset($no_ajax)):?>
				$("#product-scroll").scroll(function() {
			
					if ($(this).scrollTop() < 60){
						$('header').css('margin-top', -$(this).scrollTop() + 'px');
								
						$("#product-scroll").height($( window ).height() - 93  + $(this).scrollTop());
						$("#map-scroll").height($( window ).height() - 95  + $(this).scrollTop());
						$(".menuright").height($( window ).height() - 115  + $(this).scrollTop());
						$(".leftmenu").height($( window ).height() - 123 + $(this).scrollTop());
						$(".logo-column").height($(window).height() - 100 + $(this).scrollTop());
						$(".cart-info").height($(window).height() - 65 + $(this).scrollTop());
		
						$(".secondcolumn").height($( window ).height() - 105  + $(this).scrollTop());
						$("#shadow").height($( window ).height() - 304 + $(this).scrollTop());
						$("#full-shadow").height($( window ).height() - 98  + $(this).scrollTop());
						$("#wrapper").height($( window ).height() - 65  + $(this).scrollTop());
						$("#scroll-right").height($(window).height() - 105  + $(this).scrollTop());
						$("#good_page_scroll").height($( window ).height() - 85  + $(this).scrollTop());
						
						$("#manufacturers_column").css("display", "block");
						
						$('#on_top').css('display', 'none');
						$('.leftmenu').mCustomScrollbar("scrollTo", 0);
					
					} 
					else if($(this).scrollTop() > ($( window ).height() * 4) - 60){
						//$('.leftmenu').height($( window ).height() - 110);
						
						<?if(!isset($main_page)):?>
							$('.on_top_1').css('display', 'block');
							var top = $('.leftmenu').height();
							$('.leftmenu').mCustomScrollbar("scrollTo", top);
						<?else:?>
							$('.on_top_2').css('display', 'block');
							$('.on_top_2').css('top', $("#shadow").height() - 75);
						<?endif;?>
					}
					else {
						$('header').css('margin-top', -60 + 'px');
						
						$("#product-scroll").height($( window ).height() - 93 + 60);
						$("#map-scroll").height($( window ).height() - 95 + 60);
						$(".menuright").height($( window ).height() - 115 + 60);
						$(".leftmenu").height($( window ).height() - 123 + 60);
						$(".logo-column").height($(window).height() - 100 + 60);
						$(".cart-info").height($(window).height() - 65 + 60);
		
						$(".secondcolumn").height($( window ).height() - 105 + 60);
						$("#shadow").height($( window ).height() - 304 + 60);
						$("#full-shadow").height($( window ).height() - 98 + 60);
						$("#wrapper").height($( window ).height() - 65 + 60);
						$("#scroll-right").height($(window).height() - 105 + 60);
						$("#good_page_scroll").height($( window ).height() - 85 + 60);
						
						$("#manufacturers_column").css("display", "none");
					}

					var div_sh = $(this)[0].scrollHeight;
					var div_h = $(this).height();
					<?if(!isset($no_ajax)):?>
						if($(this).scrollTop() >= div_sh - div_h){
							$.post('<?=base_url()?>shop/catalog/ajax_more/', $('#filter-form').serialize(), answer, 'json');
						}
					<?endif;?>
				});
			<?endif?>
		});
	})(jQuery);
	
	function scroll_on_top(){
		$('#on_top').css('display', 'none');
		$('.leftmenu').mCustomScrollbar("scrollTo", 0);
		$('#product-scroll').animate({scrollTop: "top"});
	}
	
	$(".logo-column").mCustomScrollbar({
		axis:"y", 
		advanced:{ autoExpandHorizontalScroll:true } //auto-expand content to accommodate floated elements
	});
	
	$("#scroll-right").mCustomScrollbar({
		axis:"y", //set both axis scrollbars
		advanced:{autoExpandHorizontalScroll:true}, //auto-expand content to accommodate floated elements
	});
</script>
<?if(isset($no_shadow)):?>
	<script>
		$(".leftmenu").mCustomScrollbar({
			axis:"y", //set both axis scrollbars
			advanced:{ autoExpandHorizontalScroll:true } //auto-expand content to accommodate floated elements
		});
	</script>
<?endif;?>