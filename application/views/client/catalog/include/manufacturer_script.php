<script>
	$(function(){
		var first = $(".floating").offset().top;
		var line = $(".catalog").offset().top;
		var item_width = $('.all-items').width();//$(".floating").width()+ 18;
				
		$("#scroll-content").scroll(function() {
			var top = $("#scroll-content").scrollTop();

			if(top >= first - line)
			{
				$('.floating').addClass('fixed');
				$(".floating").css({top: line, width: item_width});
				$('.manufacturer_description').css('margin-bottom', '40px');
			}
			else 
			{
				$('.floating').removeClass('fixed');
				$('.manufacturer_description').css('margin-bottom', '10px');
			}
			item_width = $('.all-items').width();//$(".floating").width()+ 18;
			$(".floating").css({width: item_width});
		});
		if ($('.floating').width() > 600)
		{
			$('.navigation-mini a').css('padding-right', (3 + ($('.floating').width() - 600) / 12) + 'px');
			$('.navigation-mini a').css('padding-left', (0 + ($('.floating').width() - 600) / 12) + 'px');
		}
	});
</script>