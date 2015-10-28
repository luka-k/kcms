<script>
	$('.accordeon-head').click(function() {
		$(this).next().slideToggle().toggleClass('noactive');
		if ($(this).find('span.list'))
		{
			if ($(this).find('span.list').html() == '+')
				$(this).find('span.list').html('-');
			else
				$(this).find('span.list').html('+');
		}
	});
		
	$('.acc-h').click(function() {
		$('.acc-b').slideToggle().toggleClass('noactive');
		if ($(this).find('span.list'))
		{
			if ($(this).find('span.list').html() == '+')
				$(this).find('span.list').html('-');
			else
				$(this).find('span.list').html('+');
		}
	});
		
	$(function(){
		$(".cloud-zoom-gallery").on("click", function(){
			var viewedImgKey = $('.cloud-zoom').attr('data-imgkey');
			var imgKey = $(this).attr('data-imgkey');
			
			$('.thumbimg_'+imgKey).css('display', 'none');
			$('.thumbimg_'+viewedImgKey).css('display', 'block');
			$('.cloud-zoom').attr('data-imgkey', imgKey);
		});
	});
</script>