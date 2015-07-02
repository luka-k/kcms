<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
	<title><?=$title?></title>
	
	<meta name="description" content="<?=$meta_description?>" />
	<meta name="keywords" content="<?=$meta_keywords?>" />
	
	<link rel="Shortcut Icon" type="image/x-icon" href="<?=base_url()?>template/client/catalog/images/favicon.ico" />
		
	<!------------------------Styles---------------------------->
	<link rel="stylesheet" href="<?=base_url()?>template/client/catalog/css/normalize.css"/>
	<link rel="stylesheet" href="<?=base_url()?>template/client/catalog/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/catalog/css/easydropdown.css"/> <!--Крассивые select-->
	<!-- Стили popup -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/catalog/js/fancybox/jquery.fancybox.css?v=2.1.5" />
		
	<!---------------------------JS----------------------------->
	<script src="<?=base_url()?>template/client/catalog/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/catalog/js/jquery.easydropdown.js"></script><!--Крассивые select-->
	<!-- Скрипт popup -->
	<script src="<?=base_url()?>template/client/catalog/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
	

	<!---------------Скроллбар---------------->
	<link rel="stylesheet" href="<?=base_url()?>template/client/catalog/css/jquery.mCustomScrollbar.css"/>
	<script src="<?=base_url()?>template/client/catalog/js/jquery.mCustomScrollbar.js"></script>
	<script>
		(function($){
			$(window).load(function(){
				$("#scroll-left").height($(window).height() - 105);
				$(".logo-column").height($(window).height() - 103);
				
				$("#scroll-content").height($(window).height() - 95);
				$("#scroll-right").height($(window).height() - 102);
				
				$("#scroll-left").mCustomScrollbar({
					axis:"y", //set both axis scrollbars
					advanced:{autoExpandHorizontalScroll:true}, //auto-expand content to accommodate floated elements
				});
					
				if ($('.logotype.active').offset())
				{
					$(".logo-column").mCustomScrollbar({
						axis:"y", //set both axis scrollbars
						setTop: ($('.logotype.active').offset().top-115)+"px",
						advanced:{ autoExpandHorizontalScroll:true } //auto-expand content to accommodate floated elements
					});
				}

			
				$(".catalog-row").mCustomScrollbar({
					axis:"x"
				});

				$(".img-row").mCustomScrollbar({
					axis:"x"
				});
				
				$(".list-row").mCustomScrollbar({
					axis:"x"
				});
					
			});
		})(jQuery);
			
		$(function(){
			var $selects = $('.catalog_select');
					
			$selects.easyDropDown({
				wrapperClass: 'metro'
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
		
		$(function(){
			var list_boxes = $("#manufacturers").find(".list_box");
				
			var box_counter = 1;
			
			list_width = $(".manufacturer-categories-list").width();
			
			col_qty = $(".manufacturer-categories-list").attr("colqty")
			
			var column_width = (list_width - (20 * col_qty))/col_qty; //костыли костылики
			
			$('.manu_col').width(column_width);
			
			list_boxes.each(function () {
				var columns = $(this).find(".cat_list-"+box_counter);

				var qty_of_colums = Math.ceil(columns.length/4);
				
				$(".l-b-"+box_counter).width(qty_of_colums * (column_width + 25));
				box_counter++;
			});
		});
	</script>
	
	<script>
		$(window).load(function(){
			/*$(".ddlist").click(function(){
				var down_item = $(".leftmenu").find(".down-item");
				
				$(down_item).next().toggleClass('active');
				$(down_item).toggleClass('up-item');
				$(down_item).toggleClass('down-item');
				
				if($(down_item).attr("id") == $(this).attr("id")) return false;

				$(this).next().toggleClass('active');
				$(this).toggleClass('up-item');
				$(this).toggleClass('down-item');
			});*/
			
			$('.fancybox').fancybox({
				padding: 0,
				scrolling: 'no',
				autoCenter : false,
				fitToView: true,
				helpers: {
					overlay: {
						locked: false // if true (default), the content will be locked into overlay
					}
				}
			});
	});
	
	function manufacturer_submit(controller, url)
	{
		$('#manufacturer-form').attr('action', '<?=base_url()?>'+controller+'/' + url);
		$('#manufacturer-form').submit();
	}
	
	function manufacturer_submit_by_category(url, manufacturer)
	{
		$('#manufacturer-form').attr('action', '<?=base_url()?>catalog/'+url+'/' + manufacturer);
		$('#manufacturer-form').submit();
	}

	</script>
		
</head>