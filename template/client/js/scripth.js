(function($){
			$(window).load(function(){
				$(".scroll-content").height($( window ).height() - 125);
				$(".scroll-contentd").height($( window ).height() - 125);
				$("#leftscroll").height($( "#leftscroll" ).height() + 0);
				$("#good_page_scroll").height($( window ).height() - 115);
				$(".scroll-content").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
				$(".horscroll-content").mCustomScrollbar({
					horizontalScroll:true,
					scrollButtons:{
						enable:true
					}
				});
			});
		})(jQuery);
		
	function validation (element, errorClass) {
   var input = element.find('input[type="text"]'),
       spaces = new RegExp(/^(\s|\u00A0)+|(\s|\u00A0)+$/g),
       isNecessatily,
       isError = false;
   input.on('focus', function () {
       var el = $(this);
     
       if (el.hasClass(errorClass)) el.removeClass(errorClass);
   });
        input.each(function () {
            var el = $(this);
            if (el.attr('data-necessarily') == 'true' && el.val().replace(spaces, '') == '') {
                el.addClass(errorClass);
                isError = true;
            }
			if (el.attr('data-id') == 'name' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'email' && el.val().match('@') == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'phone' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'address' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
        });
   return isError;
}
	
	
	function sub_form(){
		var errorClass = 'frame-input_error';

			if (validation($("#order"), errorClass)) return false;
			$("#order").submit();
		}