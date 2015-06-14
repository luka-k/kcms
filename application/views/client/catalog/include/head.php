<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
	<title><?=$settings->site_title?></title>
		
	<link rel="Shortcut Icon" type="image/x-icon" href="favicon.ico" />
		
	<!------------------------Styles---------------------------->
	<link rel="stylesheet" href="<?=base_url()?>template/client/catalog/css/normalize.css"/>
	<link rel="stylesheet" href="<?=base_url()?>template/client/catalog/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/catalog/css/easydropdown.css"/> <!--Крассивые select-->
		
	<!---------------------------JS----------------------------->
	<script src="<?=base_url()?>template/client/catalog/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/catalog/js/jquery.easydropdown.js"></script><!--Крассивые select-->

	<!---------------Скроллбар---------------->
	<link rel="stylesheet" href="<?=base_url()?>template/client/catalog/css/jquery.mCustomScrollbar.css"/>
	<script src="<?=base_url()?>template/client/catalog/js/jquery.mCustomScrollbar.js"></script>
	<script>
		(function($){
			$(window).load(function(){
				$("#scroll-left").height($(window).height() - 105);
				$("#slider-scroll").height($(window).height() - 100);
				
				$("#scroll-content").height($(window).height() - 95);
				$("#scroll-right").height($(window).height() - 102);
					
				$("#slider-scroll").mCustomScrollbar({
					axis:"y", //set both axis scrollbars
					advanced:{autoExpandHorizontalScroll:true}, //auto-expand content to accommodate floated elements
				});
					
				$(".catalog-row").mCustomScrollbar({
					axis:"x"
				});

				$(".img-row").mCustomScrollbar({
					axis:"x"
				});
					
			});
		})(jQuery);
			
		$(function(){
			var $selects = $('.catalog_select');
					
			$selects.easyDropDown({
				wrapperClass: 'metro',
				onChange: function(selected){
				// do something
				}
			});
		});
	</script>
		
	<script>
		$(function(){
			var img_boxes = $(".main-content").find(".img_box");
			
			var box_counter = 0;
			img_boxes.each(function () {
				var images = $(this).find(".cat_img-"+box_counter);
				img_width = $(images[0]).width();
				$(this).width(images.length * (img_width + 10));
				box_counter++;
			});
		});
		
		
	</script>
	
	<script>
		$(window).load(function(){
		$('.up-item').click(function() {
			var down_items = $(".leftmenu").find(".down-item");
			var menu_item = this;
			down_items.each(function () {
				$(this).next().toggleClass('active');
				$(this).toggleClass('down-item');
				$(this).toggleClass('up-item');
			});
			$(this).next().toggleClass('active');
			$(this).toggleClass('up-item');
			$(this).toggleClass('down-item');
		});

		$('.down-item').click(function() {
			$(this).next().toggleClass('active');
			$(this).toggleClass('down-item');
			$(this).toggleClass('up-item');
		});
		});
	</script>
		
</head>