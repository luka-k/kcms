<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
	<title><?=$seo_meta_title ? $seo_meta_title : $title?></title>
	
	<meta name="description" content="<?=$meta_description?>" />
	<meta name="keywords" content="<?=$meta_keywords?>" />
	
	<link rel="Shortcut Icon" type="image/x-icon" href="<?=base_url()?>template/client/catalog/images/favicon.ico" />
	<meta content="<?=base_url()?>template/client/catalog/images/bb_house.jpg" property="og:image" />
		
	<!------------------------Styles---------------------------->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/normalize.css"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/selects_catalog.css"/>

	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/js/fancybox/jquery.fancybox.css?v=2.1.5"/>
	
	<link rel="stylesheet" href="<?=base_url()?>template/client/css/jquery.mCustomScrollbar.css"/>
 		
	<!---------------------------JS----------------------------->
	<script type="text/javascript" src="<?=base_url()?>template/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.easydropdown.js"></script>

	<script type="text/javascript" src="<?=base_url()?>template/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.mCustomScrollbar.js"></script>
	
	<script>
		(function($){
			$(window).load(function(){
				$("#scroll-left").height($(window).height() - 115);
				$(".logo-column").height($(window).height() - 107);
				
				$("#scroll-content").height($(window).height() - 97);
				$("#scroll-right").height($(window).height() - 110);
				
				$("#scroll-left").mCustomScrollbar({
					axis:"y", //set both axis scrollbars
					advanced:{autoExpandHorizontalScroll:true}, //auto-expand content to accommodate floated elements
				});
					
				$("#scroll-right").mCustomScrollbar({
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
				
				$('#scroll-content').scroll(function() {
					
					if ($(this).scrollTop() < 60)
					{
						$('header').css('margin-top', -$(this).scrollTop() + 'px');
						$("#scroll-left").height($(window).height() - 115+$(this).scrollTop());
						$(".logo-column").height($(window).height() - 105+$(this).scrollTop());
						
						$("#scroll-content").height($(window).height() - 97+$(this).scrollTop());
						$("#scroll-right").height($(window).height() - 110+$(this).scrollTop());
						$('.navigation-mini').css('top', 91-$(this).scrollTop());
					} else {
						$('header').css('margin-top', -60 + 'px');
						$("#scroll-left").height($(window).height() - 115+60);
						$(".logo-column").height($(window).height() - 105+60);
						
						$("#scroll-content").height($(window).height() - 97+60);
						$("#scroll-right").height($(window).height() - 110+60);
						
						$('.navigation-mini').css('top', 96-66);
					}
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
			
			if (column_width> 160) column_width = 160;
			$('.manu_col').width(column_width);
			
			list_boxes.each(function () {
				var columns = $(this).find(".cat_list-"+box_counter);

				var qty_of_colums = Math.ceil(columns.length/4);
				
				//$(".l-b-"+box_counter).width(qty_of_colums * (column_width + 25));
				box_counter++;
			});
		});
	</script>
	
	<script>
		$(window).load(function(){
			$('.fancybox').fancybox({
				  afterLoad : function() {
				   this.title = '' + (this.index + 1) + ' / ' + this.group.length + (this.title ? ' - ' + this.title : '');
				  },
				padding: 0,
				scrolling: 'no',
				autoCenter : true,
				fitToView: true,
				mouseWheel : true,
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