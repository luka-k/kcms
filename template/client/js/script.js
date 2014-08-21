$(document).ready(function() {
        
    var h_h = 0;
    var h_m = 0;
    $(function(){
        $(window).scroll(function(){
            var top = $(this).scrollTop();
            var elem = $('.nav');
        if (top+h_m < h_h) {
            elem.css('top', (h_h-top));
        } 
        else {
            elem.css('top', h_m);
        }
        });
    });

    var boxen = [];
                    
        $("a[class^=fancybox]").each(function() {
            if ($.inArray($(this).attr('class'),boxen)) boxen.push($(this).attr('class'));
        });
                
        $(boxen).each(function(i,val) { $('a[class='+val+']').attr('rel',val).fancybox({
            fitToView       : false,
            padding     : '0'
    }); });
            
    function hasPlaceholderSupport() {
    var input = document.createElement('input');
    return ('placeholder' in input);
}
    var isCallback =  false,
        isOrder = false,
        ert = {};
    $('.js-form').eq(1).find('input').each(function () {
        var el = $(this);
        ert[el.attr('name')] = {
            el: el,
            val: el.val()
        }
    });
	
    $('.fancybox').fancybox();
	
    $('.js-btn').on('click', function (e) {
        e.preventDefault();
        $.fancybox($('#overlay_form').html());
        $(".mask").mask("+7 (999) 999-9999");
        if (!hasPlaceholderSupport()) {
        $('[placeholder]').focus(function() {
          var input = $(this);
          if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
          }
        }).blur(function() {
          var input = $(this);
          if (input.val() == '' || input.val() == input.attr('placeholder')) {
            input.addClass('placeholder');
            input.val(input.attr('placeholder'));
          }
        }).blur();
}
        if ($(this).hasClass('js-callback')) { isCallback = true; }
    });
	
    $('body').on('submit', '.js-form', function (e) {
            var form = $(this),
                inputs = form.find('input'),
                el = {},
                data = {},
                errorClass = 'frame-input_error',
                i;
            e.preventDefault();
            inputs.each(function () {
                var element = $(this);
                if (element.attr('type') !== 'submit' || element.attr('type') !== 'button') {
                    el[element.attr('data-id')] = element;
                    data[element.attr('data-id')] = element.val();
                }
            });
			data['comment'] = $('#comment').val();
            for (i in el) {
                if (el[i].hasClass(errorClass)) el[i].removeClass(errorClass);
            }
            if (validation(form, errorClass)) return false;
            data.callback = isCallback;
            data.order = isOrder;
            $.ajax({
                url: '/mail.php',
                type: 'POST',
                cache: false,
                data: data,
                complete: function (xhr, response) {
                    isCallback = isOrder = false;
                    if ('success') {
                        $.fancybox('<div class="result"><h3>СПАСИБО ЗА ЗАЯВКУ!</h3><p>Наши менеджеры свяжутся с вами в ближайшее время.</p></div>', {
                            autoSize: false,
                            autoHeight: false,
                            autoWidth: false,
                            autoResize: false,
                            width: 400,
                            height: 200
                        });
                        $('input[type="text"]').val('');
                        setTimeout(function () {
                            $.fancybox.close();
                        }, 3000);
                        
                    } else {
                        $.fancybox('<div class="result err"><h3>Упс!</h3><p>Произошла ошибка, попробуйте еще раз.</p></div>', {
                            autoSize: false,
                            autoHeight: false,
                            autoWidth: false,
                            autoResize: false,
                            width: 400,
                            height: 200
                        });
                    }
                }
            });
            return false;
        });
		
    $('body').on('submit', '.js-form2', function (e) {
            var form = $(this),
                inputs = form.find('input'),
                el = {},
                data = {},
                errorClass = 'frame-input_error',
                i;
            e.preventDefault();
            inputs.each(function () {
                var element = $(this);
                if (element.attr('type') !== 'submit' || element.attr('type') !== 'button') {
                    el[element.attr('data-id')] = element;
                    data[element.attr('data-id')] = element.val();
                }
            });
			data['comment'] = 'Заказ звонка';
            for (i in el) {
                if (el[i].hasClass(errorClass)) el[i].removeClass(errorClass);
            }
            if (validation(form, errorClass)) return false;
            data.callback = isCallback;
            data.order = isOrder;
            $.ajax({
                url: '/mail.php',
                type: 'POST',
                cache: false,
                data: data,
                complete: function (xhr, response) {
                    isCallback = isOrder = false;
                    if ('success') {
                        $.fancybox('<div class="result"><h3>СПАСИБО ЗА ЗАЯВКУ!</h3><p>Наши менеджеры свяжутся с вами в ближайшее время.</p></div>', {
                            autoSize: false,
                            autoHeight: false,
                            autoWidth: false,
                            autoResize: false,
                            width: 400,
                            height: 200
                        });
                        $('input[type="text"]').val('');
                        setTimeout(function () {
                            $.fancybox.close();
                        }, 3000);
                        
                    } else {
                        $.fancybox('<div class="result err"><h3>Упс!</h3><p>Произошла ошибка, попробуйте еще раз.</p></div>', {
                            autoSize: false,
                            autoHeight: false,
                            autoWidth: false,
                            autoResize: false,
                            width: 400,
                            height: 200
                        });
                    }
                }
            });
            return false;
        });
		
    function validation (element, errorClass) {
        var input = element.find('input[type="text"], textarea'),
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
            if (el.attr('data-id') == 'email' && el.val().match('@') == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'name' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'email' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'comment' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
        });
        return isError;
    }

    
    $(function($){

        if (!hasPlaceholderSupport()) {
            $('[placeholder]').focus(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
					input.val(' ');
					input.removeClass('placeholder');
					}
			}).blur(function() {
				var input = $(this);
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				}
			}).blur();
		}
		});

    $('.scroll-animate').each(function () {
        var block = $(this);
        $(window).scroll(function () {
            var top = block.offset().top;
            var bottom = block.height() + top;
            top = top - $(window).height();
            var scroll_top = $(this).scrollTop();
            if ((scroll_top > top) && (scroll_top < bottom)) {
                if (!block.hasClass('animate')) {
                    block.addClass('animate');
                    block.trigger('animateIn');
                }
            } else {
                block.removeClass('animate');
                block.trigger('animateOut');
            }
        });

    });

    $('.digit .dig .digs').each(function () {
        $(this).attr('data-number', parseInt($(this).text()));
    });

    $('.digit .content').on('animateIn', function () {
        $(this).find('.digs').each(function () {
            var count = parseInt($(this).attr('data-number'));
            var block = $(this);
            var timeout = null;
            var step = 1;
            timeout = setInterval(function () {
                if (step == 25) {
                    block.text(count.toString());
                    clearInterval(timeout);
                } else {
                    block.text((Math.floor(count * step / 25)).toString());
                    step++;
                }
            }, 60);
        });
    });

    $('.digit .wrap').on('animateIn', function () {
        var inter = 0;
        $(this).find('.dig').each(function () {
            var block = $(this);
            setTimeout(function () {
                block.css('opacity', 1);
                block.css('transform', 'scale(1.0, 1.0)');
            }, inter * 100);
            inter++;
        });
    }).on('animateOut', function () {
        $(this).find('.dig').each(function () {
            $(this).css('opacity', 0.01);
            $(this).css('transform', 'scale(0.5, 0.5)');
        });
    });
	
		/*---------------------------------
		Tabs
	-----------------------------------*/
	// tab setup
	$('.tab-content').addClass('clearfix').not(':first').hide();
	$('ul.tabs').each(function(){
		var current = $(this).find('li.current');
		if(current.length < 1) { $(this).find('li:first').addClass('current'); }
		current = $(this).find('li.current a').attr('href');
		$(current).show();
	});

	// tab click
	$(document).on('click', 'ul.tabs a[href^="#"]', function(e){
		e.preventDefault();
		var tabs = $(this).parents('ul.tabs').find('li');
		var tab_next = $(this).attr('href');
		var tab_current = tabs.filter('.current').find('a').attr('href');
		$(tab_current).hide();
		tabs.removeClass('current');
		$(this).parent().addClass('current');
		$(tab_next).show();
		history.pushState( null, null, window.location.search + $(this).attr('href') );
		return false;
	});

 	// tab hashtag identification and auto-focus
    	var wantedTag = window.location.hash;
    	if (wantedTag != "")
    	{
			// This code can and does fail, hard, killing the entire app.
			// Esp. when used with the jQuery.Address project.
			try {
				var allTabs = $("ul.tabs a[href^=" + wantedTag + "]").parents('ul.tabs').find('li');
				var defaultTab = allTabs.filter('.current').find('a').attr('href');
				$(defaultTab).hide();
				allTabs.removeClass('current');
				$("ul.tabs a[href^=" + wantedTag + "]").parent().addClass('current');
				$("#" + wantedTag.replace('#','')).show();
			} catch(e) {
				// I have no idea what to do here, so I'm leaving this for the maintainer.
			}
    	}
	




});