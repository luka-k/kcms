<script>
	$(function(){
		var first = $(".floating").offset().top;
		var line = $(".catalog").offset().top;
		var item_width = $(".floating").width();
				
		$("#scroll-content").scroll(function() {
			var top = $("#scroll-content").scrollTop();

			if(top >= first - line)
			{
				$('.floating').addClass('fixed');
				$(".floating").css({top: line, width: item_width});
			}
			else $('.floating').removeClass('fixed');
		});
	});
</script>