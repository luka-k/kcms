(function($){
	$(window).load(function(){
		$("#scroll-left").height($(window).height() - 128);
		$(".logo-column").height($(window).height() - 107);
		
		$("#scroll-content").height($(window).height() - 97);
		$("#scroll-right").height($(window).height() - 108);
				
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
			if ($(this).scrollTop() < 60){
				$('header').css('margin-top', -$(this).scrollTop() + 'px');
				$("#scroll-left").height($(window).height() - 128+$(this).scrollTop());
				$(".logo-column").height($(window).height() - 105+$(this).scrollTop());
				
				$("#scroll-content").height($(window).height() - 97+$(this).scrollTop());
				$("#scroll-right").height($(window).height() - 108+$(this).scrollTop());
				$('.navigation-mini').css('top', 91-$(this).scrollTop());
			} else {
				$('header').css('margin-top', -60 + 'px');
				$("#scroll-left").height($(window).height() - 128+60);
				$(".logo-column").height($(window).height() - 105+60);
						
				$("#scroll-content").height($(window).height() - 97+60);
				$("#scroll-right").height($(window).height() - 108+60);
						
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