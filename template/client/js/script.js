$(document).ready(function() {
$('body').on('submit', '.js-form', function (e) {
  
  var form = $(this),
  inputs = form.find('input'),
  el = {},
  data = {},
  errorClass = 'frame-input_error',
  i;
  
// гугл в помощь что за функция
  e.preventDefault();
// следующий кусок кода отвечает за валидацию и заполнение массива данных data
  inputs.each(function () {
    var element = $(this);
    if (element.attr('type') !== 'submit' || element.attr('type') !== 'button') {
      el[element.attr('data-id')] = element;
      data[element.attr('data-id')] = element.val();
    }
  });
  
  data['subject'] = form.find('#subject').val();
  data['message'] = form.find('#message').val();

  for (i in el) {
    if (el[i].hasClass(errorClass)) el[i].removeClass(errorClass);
  }
  if (validation(form, errorClass)) return false;

  // а дальше аякс-вызов и всплывающее окошко
  $.ajax({
    url:'/ajax/',
    type: 'POST',
    cache: false,
    data: data,
    complete: function (xhr, response) {
      if ('success') {
          $.fancybox('<div class="res"><div class="popup"><p style="color: #634f6a;font-family: Georgia;font-size: 24px; text-align:center;">Message sent.</p></div></div>', {
               autoSize: false,
               autoHeight: false,
               autoWidth: false,
               autoResize: false,
               width: 400,
               height: 110
           });
           $('input[type="text"]').val('');
           setTimeout(function () {
               $.fancybox.close();
           }, 6000);
         
       } else {
           $.fancybox('<div class="resultat err popup"><h3>Error!</h3><p>Error, please repeat.</p></div>', {
               autoSize: false,
               autoHeight: false,
               autoWidth: false,
               autoResize: false,
               width: 400,
               height: 1100
           });
       }
   }
});
return false;
});

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
});

$(function () {
	var elWrap = $('#slider'),
		el =  elWrap.find('a'),
		indexImg = 1,
		indexMax = el.length,
		phase = 3000;
	
	function change () {
		//el.fadeOut(500);
		var d  = el.filter(':nth-child('+indexImg+')');
		d.fadeIn(500);
		if (indexImg > 1)
			el.filter(':nth-child('+(indexImg-1)+')').fadeOut(50);
		else
			el.filter(':nth-child('+(indexMax)+')').fadeOut(50);
	}
		
	function autoChange () {	
		indexImg++;
		if(indexImg > indexMax) {
			indexImg = 1;
		}			
		change ();
	}	
	$('#slider a').hide();
	$('#slider a').first().show();
	var interval = setInterval(autoChange, phase);

	elWrap.mouseover(function() {
		clearInterval(interval);
	});
	elWrap.mouseout(function() {
		interval = setInterval(autoChange, phase);
	});
	
	elWrap.append('<span class="next"></span><span class="prev"></span>');
	var	btnNext = $('span.next'),
		btnPrev = $('span.prev');
		
	btnNext.click(function() {
		indexImg++;
		if(indexImg > indexMax) {
			indexImg = 1;
		}
		change ();
	});
	btnPrev.click(function() {
		indexImg--;
		if(indexImg < 1) {
			indexImg = indexMax;
		}
		change ();
	});	
});
