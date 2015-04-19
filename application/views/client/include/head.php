<head>
	<title><?=$title?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="<?=$meta_keywords?>" />
	<meta name="description" content="<?=$meta_description?>" />
		
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>template/fancybox/source/jquery.fancybox.css" media="all" /> <!--fancybox css-->
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/js/jquery-ui/jquery-ui.css" media="all" /> <!--fancybox css-->
	<link rel="stylesheet" href="<?=base_url()?>template/client/css/normalize.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>template/client/css/style.css" media="all" />  <!--custom css-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>template/client/css/grid.css" media="all" />
		
	<script type="text/javascript" src="<?=base_url()?>template/js/jquery.min.js"></script> <!--jquery js-->
	<script type="text/javascript" src="<?=base_url()?>template/fancybox/source/jquery.fancybox.js"></script>  <!--fancybox js-->
	<script type="text/javascript" src="<?=base_url()?>template/js/jquery-ui/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>template/client/js/cart.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>template/client/js/script.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/wishlist.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/datepicker.js"></script>
	<script src="<?=base_url()?>template/client/js/main.js"></script>
	
	<!-- Slider -->
	<script src="<?=base_url()?>template/client/js/bxslider/jquery.bxslider.min.js"></script>
	
	<!-- Обработка и валидация форм -->
	<script src="<?=base_url()?>template/client/js/vendor/jquery.form.min.js"></script>
	<script src="<?=base_url()?>template/client/js/vendor/jquery.validate.min.js"></script>
	
		<script type="text/javascript">
			jQuery(document).ready(function(){
			function htmSlider(num){
				var slideWrap = jQuery('.slide-wrap-'+num);
				var nextLink = jQuery('.next-slide-'+num);
				var prevLink = jQuery('.prev-slide-'+num);
				var playLink = jQuery('.auto');
				var is_animate = false;
				var slideWidth = jQuery('.slide-item-'+num).outerWidth();
				var scrollSlider = slideWrap.position().left - slideWidth;
		
				nextLink.click(function(){
					if(!slideWrap.is(':animated')) {
						slideWrap.animate({left: scrollSlider}, 300, function(){
							slideWrap
							.find('.slide-item-'+num+':first')
							.appendTo(slideWrap)
							.parent()
							.css({'left': 0});
						});
					}
				});
 
				prevLink.click(function(){
					if(!slideWrap.is(':animated')) {
						slideWrap
						.css({'left': scrollSlider})
						.find('.slide-item-'+num+':last')
						.prependTo(slideWrap)
						.parent()
						.animate({left: 0}, 300);
					}
				});
			}
 
			htmSlider(1);
			htmSlider(2);
		});
	</script>
</head>