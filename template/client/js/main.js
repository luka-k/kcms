;(function(){

  "use strict";

  var app = {};

  app.init = function(){
    this.fancyBoxes(); // Модальные окна
    this.validate(); // валидация форм
    this.bxslider(); // слайдеры на главной и в товаре
    
    this.productImages(); // смена картинок в товаре
    this.productExtraTabs(); // табы в описании товара
    
    this.catalogRange(); // диапазон цен в каталоге
    this.catalogLoadMore(); // загрузка дополнительных товаров в каталоге и анимашка стрелок

    this.cartAmount(); // Изменение количества товаров в корзине
    this.cartOrderExtra(); // Показываем доп поля в оформлении заказа
    
    this.dealersMap(); // Карта РФ в дилерах

  };


/* ==========================================================================
 * Модальные окна
 * ========================================================================== */
  
  app.fancyOptions = {
    padding: 0,
    scrolling: 'no',
    autoCenter : false,
    fitToView: false,
    helpers: {
        overlay: {
            locked: false // if true (default), the content will be locked into overlay
        }
    }
  };
  app.fancyBoxes = function(){

    $('.fancybox').fancybox(this.fancyOptions);
    $('.fancyimage').fancybox({
      maxWidth: 900
    });
	
    $('.js-close-fancybox').on('click', function(){
      $.fancybox.close();
      return false;
    });

  };
  
/* ==========================================================================
 * Слайдеры
 * ========================================================================== */

  app.bxslider = function(){

    $('.promo__slider').bxSlider({
      controls: false,
      auto: true
    })

    var thumbsCount = $('.product-images-thumbs__item').length;

    if (thumbsCount > 4){
      $('.product-images-thumbs').bxSlider({
        pager: false,
        mode: 'vertical',
        minSlides: 4,
        maxSlides: 4,
        moveSlides: 1,
        adaptiveHeight: false
      });
    }

  };


/* ==========================================================================
 * Товар
 * ========================================================================== */


  //Смена изображений товара
  app.productImages = function(){
    var $images = $('.product-images'),
        $bigImages = $images.find('.product-images__href'),
        $thumbHrefs = $images.find('.product-images-thumbs__href');    

    
    //hide big images except first
    $bigImages.not( $bigImages.eq(0) )
              .addClass('hidden');

    $thumbHrefs.on('click', function(){
      var image = $(this).attr('href'),
          fullImage = $(this).data('full-image');

      $bigImages.removeClass('hidden')
                .not( $images.find('[href="' +fullImage + '"]') )
                .addClass('hidden');

      return false;
    });

  }


  //Переключение табов в описании товара
  app.productExtraTabs = function(){
    var $productExtraInfo = $('.product-extra-info'),
        $productExtraTabs = $productExtraInfo.find('.product-extra-info__tab'),
        $productExtraBloks = $productExtraInfo.find('.product-extra-info__block');

    $productExtraBloks.not( $productExtraBloks.eq(0) ).hide();

    $productExtraTabs.on('click', function(){
      
      var target = $(this).attr('href');

      $productExtraBloks.show()
                        .not( target )
                        .hide();      

      $productExtraTabs.removeClass('active');
      $(this).addClass('active');
      
      return false;
    });

  };

/* ==========================================================================
 * Каталог
 * ========================================================================== */

  //Слайдер цены 
  app.catalogRange = function(){

    var $rangeSlider = $('[data-range-slider]'),
        $rangeFrom = $('[data-range-from]'),
        $rangeTo = $('[data-range-to]'),
        min = $rangeSlider.data('range-min'),
        max = $rangeSlider.data('range-max'),
		min_value = $rangeSlider.data('min-value'),
        max_value = $rangeSlider.data('max-value'),
        step = parseInt( (max - min) / 10 );
	
	console.log(min_value);
    $rangeSlider.slider({
      min: min,
      max: max,
      step: step,
      range: true,
      values: [ min_value, max_value ],
      stop: function( event, ui ) {
		$rangeFrom.html( ui.values[ 0 ] );
        $rangeTo.html( ui.values[ 1 ] );
		var price_from = ui.values[ 0 ];
		var price_to = ui.values[ 1 ];
		$('#price_from').val(price_from);
		$('#price_to').val(price_to);
      }
    });  

  };

  //Загрузка товуаров по клику "Еще товары"
  app.catalogLoadMore = function(){
    
    $('.load-link__href').on('click', function(){
      var _this = this;
      $(_this).addClass('rotate');

      //Тут будет отбработка загрузки новых товаров
      //а пока просто таймаут
      setTimeout(function(){
        $(_this).removeClass('rotate');
      }, 4000);

      return false;
    });

  };


/* ==========================================================================
 * Корзина
 * ========================================================================== */

  //Изменение количества товаров в корзине
  app.cartAmount = function(){
    var $amountButtons = $('.cart-amount__button');

    $amountButtons.on('click', function(){

      var action = $(this).html().trim(),
          $target = $(this).parent().find('input'),
          curValue = $target.val();

      if (action === '+'){
      
        $target.val( ++curValue );
		
      
      }else{
        
        if (curValue < 2) curValue = 2;

        $target.val( --curValue );

      }
	  
	  var item_id = $(this).attr('item_id');
	  update_cart(item_id, document.getElementById('qty-'+item_id).value);
      return false;
    });
  };

  //Показываем дополнительные поля при оформлении заказа
  app.cartOrderExtra = function(){
    var $extra = $('.cart-order__extra');
    $('.cart-order__extra-link').on('click', function(){
      $extra.slideToggle();
      return false;
    })
  }


/* ==========================================================================
 * Карта РФ
 * ========================================================================== */

  app.dealersMap = function(){
  	
	$.post( "/ajax/dealers/", function(res) {

		var dealers = JSON.parse(res);
		var $dealersMap = $('.page-dealers__map');

		if ($dealersMap.length == 0) return;

		var data_obj = dealers;

		var colorRegion = '#cccccc', // Цвет всех регионов
			focusRegion = '#cccccc', // Цвет подсветки регионов при наведении на объекты из списка
			selectRegion = '#535353', // Цвет изначально подсвеченных регионов

			iso,
			highlighted_states = {};

		// Массив подсвечиваемых регионов, указанных в массиве data_obj
		for(iso in data_obj){
			highlighted_states[iso] = selectRegion;
		}

		$dealersMap.vectorMap({
			map: 'russia',
			backgroundColor: '#ffffff',
			borderColor: '#ffffff',
			borderWidth: 2,
			color: colorRegion,
			colors: highlighted_states,         
			hoverOpacity: 0.7,          
			enableZoom: true,
			showTooltip: true,          
        
			// Отображаем объекты если они есть
			onLabelShow: function(event, label, code){
				var list_obj,
					ob,
					name = '<strong>'+label.text()+'</strong><br>';          
            
				if(data_obj[code]){
					list_obj = '<ul>';
					for(ob in data_obj[code]){                  
						list_obj += '<li>'+data_obj[code][ob]+'</li>';
					}
					list_obj += '</ul>';
				}else{
					list_obj = '';
				}               
				label.html(name + list_obj);                
				list_obj = '';              
			},          
		}); 
	});
 
  };


/* ==========================================================================
 * Валидация и отправка форм
 * ========================================================================== */

  app.alaxOptions = {
    url: "/ajax/index",
    timeout: 3000,
    datatype: 'json',
    success: function showResponse(responseText, statusText, xhr, $form)  { 
      var target = $form.data('popup') || 'success';
      $.fancybox( $('#' + target), app.fancyOptions );
    }       
  };
  
  app.submitForm = function(form){
    $(form).ajaxSubmit( this.alaxOptions );
  }

  app.validateMessages = {
    required: "Это поле обязательно для заполнения.",
    email: "Введите корректный e-mail адрес.",
  };

  app.validate = function(){
    var _this = this;
    $.extend($.validator.messages, _this.validateMessages );
    $('form').each(function() {
	if($(this).attr('where') === "validate_ajax"){
      $(this).validate({
			errorPlacement: function(error, element) {},
			submitHandler: function(form) {
				_this.submitForm(form);
			}
      }); 
	  }else{
	   $(this).validate({
			errorPlacement: function(error, element) {}
		});
	  }
	  
    });
  };
  
  


/* ==========================================================================
 * Влючаемся при загрузке
 * ========================================================================== */

  $(document).ready(function() {

    app.init();

  });
  
}());

/*=========================================================================
 * Календарь
 *========================================================================= */


$(function() {
	$.post( "/ajax/selected_days/", function(res) {
	
		events = JSON.parse(res);
		
		$( ".datepicker" ).datepicker({
			beforeShowDay: function(date) {
				var result = [true, '', null];
				var matching = $.grep(events, function(event) {
					var day = new Date(event);
					return day.valueOf() === date.valueOf();
				});
				
				if (matching.length) {
					result = [true, 'highlight', null];
				}
				return result;
			},
			numberOfMonths:[3, 1],
			onSelect:function(dateText){
				document.location.replace('/articles/o-nas/novosti?date='+dateText);
			}
		});
	
	});
	
	$( ".datepicker" ).datepicker( "option", $.datepicker.regional["ru"]);
});
	