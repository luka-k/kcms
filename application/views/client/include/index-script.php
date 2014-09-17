<script>
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
  
  
  data['time'] = $("#time").val();
  data['comment'] = $("#comment").val();

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
          $.fancybox('<div class="res"><div class="popup-top"></div><div class="popup-body"><p style="color: #634f6a;font-family: Georgia;font-size: 24px; text-align:center;  padding-top:30px;">Спасибо, что выбрали нас!</p><p style="color: #634f6a;font-family: Georgia;font-size: 24px; text-align:center;">В течение дня <br>мы с вами свяжемся <br>для подтверждения!</p></div></div>', {
               autoSize: false,
               autoHeight: false,
               autoWidth: false,
               autoResize: false,
               width: 400,
               height: 220
           });
           $('input[type="text"]').val('');
           setTimeout(function () {
               $.fancybox.close();
           }, 6000);
         
       } else {
           $.fancybox('<div class="resultat err popup-top"><h3>Ошибка!</h3><p>Произошла ошибка, попробуйте еще раз.</p></div>', {
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
   });
   return isError;
}

function sub_form(){
	var form = $(this),
	errorClass = 'frame-input_error';
				
	if (validation($("#formpopup-2"), errorClass)) return false;
	$("#formpopup-2").submit();
}
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
	function htmSlider(num){
		var slideWrap = jQuery('.slide-wrap-'+num);
		var nextLink = jQuery('.next-slide-'+num);
		var prevLink = jQuery('.prev-slide-'+num);
		var playLink = jQuery('.auto');
		var is_animate = false;
		var slideWidth = jQuery('.slide-item-'+num).outerWidth();
		var scrollSlider = slideWrap.position().left - slideWidth;
		
		nextLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap.animate({left: scrollSlider}, 300, function(){
					slideWrap
					.find('.slide-item-'+num+':first')
					.appendTo(slideWrap)
					.parent()
					.css({'left': 0});
				});
			}
		});
 
		prevLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap
				.css({'left': scrollSlider})
				.find('.slide-item-'+num+':last')
				.prependTo(slideWrap)
				.parent()
				.animate({left: 0}, 300);
			}
		});
	}
 
	htmSlider(1);
	htmSlider(2);
	htmSlider(3);
});
</script>
