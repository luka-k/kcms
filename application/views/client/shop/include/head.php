<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$settings->site_title?></title>
	
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/client/css/style.css?v2" >

	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/js/fancybox/jquery.fancybox.css" media="all" /> <!--fancybox css-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>/template/client/css/selects.css"/> <!--Крассивые select-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/jquery.mCustomScrollbar.css"/>
		
	<script type="text/javascript" src="<?=base_url()?>template/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/js/jquery-ui/jquery-ui.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.easydropdown.js"></script><!--Крассивые select-->
	<script type="text/javascript" src="<?=base_url()?>template/client/js/cloud.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/js/fancybox/jquery.fancybox.js"></script>  <!--fancybox js-->
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.mCustomScrollbar.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/cart.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/script.js"></script>
	

	<script>
		$(document).ready(function(){
			$('#ajax_from').val(10);
		<? if (!isset($no_ajax)):?>
			$("#product-scroll").scroll(function() {
				var div_sh = $(this)[0].scrollHeight;
				var div_h = $(this).height();

				if($(this).scrollTop() >= div_sh - div_h){
					$.post('<?=base_url()?>shop/catalog/ajax_more/', $('#filter-form').serialize(), answer, 'json');
				}/*убрать shop*/
			});
		<?endif?>
				$("#scroll-right").mCustomScrollbar({
					axis:"y", //set both axis scrollbars
					advanced:{autoExpandHorizontalScroll:true}, //auto-expand content to accommodate floated elements
				});
		});
		
		function answer(res){
			$("#product-scroll").append(res.content);
			$('#ajax_from').val(res.ajax_from);
		}
		
		
	</script>

	<?if(isset($filters_checked["width_from"])):?>
		<script>
			$( document ).ready(function() {
				$("#width-low").attr("name", "width_from");
				$("#width-hi").attr("name", "width_to");
			});	
		</script>
	<?endif;?>
	
	<?if(isset($filters_checked["height_from"])):?>
		<script>
			$( document ).ready(function() {
				$("#height-low").attr("name", "height_from");
				$("#height-hi").attr("name", "height_to");
			});	
		</script>
	<?endif;?>
	
	<?if(isset($filters_checked["depth_from"])):?>
		<script>
			$( document ).ready(function() {
				$("#depth-low").attr("name", "depth_from");
				$("#depth-hi").attr("name", "depth_to");
			});	
		</script>
	<?endif;?>
	
	<?if(isset($filters_checked["price_from"])):?>
		<script>
			$( document ).ready(function() {
				$("#price-low").attr("name", "price_from");
				$("#price-hi").attr("name", "price_to");
			});	
		</script>
	<?endif;?>
</head>