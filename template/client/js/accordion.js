$(document).ready(function(){
	$('ul.accordion a.opener').click(function(){
		if (!($(this).parent().hasClass('active')))
		{
			$('.active ul').slideToggle();
			$('.active').removeClass('active');
			category_select($(this).attr('name'), $(this).attr('id'));
			$(this).parent().find("ul:first").slideToggle();
			$(this).parent().toggleClass('active');
			$('.selected').removeClass('selected');
			$(this).parent().addClass('selected');
		} else if (($(this).parent().hasClass('selected')) && current_id != 0) {
			$('.active ul').slideToggle();
			category_select('---NONE---', 0);
			$(this).parent().toggleClass('active');
			$(this).parent().removeClass('selected');
		} else {
			category_select($(this).attr('name'), $(this).attr('id'));
			$('.selected').removeClass('selected');
			$(this).parent().addClass('selected');
		}
		return false;
	});
});