<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>bрайтbилd - интернет магазин</title>
	<!--<base href="http://brightbuild.ru/shop/">
	<meta content="http://brightbuild.ru/image/bb_house.jpg" property="og:image">-->
		
	<link rel="stylesheet" href="<?=base_url()?>template/client/css/style.css" type="text/css">
	<link href="<?=base_url()?>template/client/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
	<script type="text/javascript">var current_id = 0;</script> 
	
	<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" />
	<!-- Add jQuery library -->
		
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/accordion.js?v05"></script>
	
	<script type="text/javascript" src="<?=base_url()?>template/client/js/cart.js"></script>
		
	<script src="<?=base_url()?>template/client/js/jquery/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="<?=base_url()?>template/client/js/jquery/plugins/jquery.mCustomScrollbar.min.js"></script>
		
	<script>
		
		(function($){
			$(window).load(function(){
				$(".scroll-content").height($( window ).height() - 125);
				$(".scroll-contentd").height($( window ).height() - 125);
				$("#leftscroll").height($( "#leftscroll" ).height() + 0);
				$("#good_page_scroll").height($( window ).height() - 95);
				$(".scroll-content").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
				$(".horscroll-content").mCustomScrollbar({
					horizontalScroll:true,
					scrollButtons:{
						enable:true
					}
				});
			});
		})(jQuery);
	</script>
		
	<script>
		$(document).ready(function(){
			$('#gal-1 img').addClass('slide'); 
			$('.slide').click(function(){ 
				$('.picture').remove(); 
				$('<img class="picture" />').appendTo('#box-1').attr('src',$(this).attr('src'));
			});
	
			$('#gal-2 img').addClass('slide-2'); 
			$('.slide-2').click(function(){ 
				$('.picture-2').remove(); 
				$('<img class="picture-2" />').appendTo('#box-2').attr('src',$(this).attr('src'));
			});
		});
	
	</script>
	
</head>