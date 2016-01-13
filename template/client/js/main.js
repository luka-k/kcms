
  var gallerySlider = false;
  
  ;(function(){

  "use strict";

  var app = {};

  
  app.init = function(){

    this.fancyBoxes();
    this.validate();
    this.sliders();
    this.insideNavigationHovers();
    this.scrollContent();
    this.scrollMenu();

    this.modalCallback();
    this.modalGallery();

    this.inputHighlight();

	$('._animate').toggle('slow');
	
  };

  app.fancyOptions = {
    padding: 20,
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

    });

  };


    /*
      смещение сладйера при скролле над слайдером
    */
    app.sliderWheel = function( $container, sliderId){
      
      /*
      Определяем куда крутиться колесико мыши
      */
      var _wheel = function(options){

        var wheelDelta = 0;
        var step = 300;
        var e = options.event;

        if (!e) {
            e = window.event;
        }

        if (e.originalEvent.wheelDelta) {
          wheelDelta = e.originalEvent.wheelDelta/120;
        } else if (e.originalEvent.detail) {       
          wheelDelta = -e.originalEvent.detail/3;
        }

        if (wheelDelta < 0) {
          options.up();
        } else if (wheelDelta > 0) {      
          options.down();
        }
        
        if (e.preventDefault) {
            e.preventDefault();
        }

      };

      $container.on('mousewheel DOMMouseScroll', function(event){

        _wheel({
          event: event,
          up: function(){ 
            sliderId.goToNextSlide(); 
          },
          down: function(){ 
            sliderId.goToPrevSlide();
          }
        })

      });      
    }

  app.sliders = function(){


    /*
      projects
    */

    var _this = this;
    var $projectsList = $('.projects__list');
    var $projects = $projectsList.children('li');
	var $pp = $('.projects');
	
    if ($projectsList.height() >= 560){
      var projectsSlider = $projectsList.bxSlider({
                              pager: false,
                              mode: 'vertical',
							  minSlides: 4,
                              maxSlides: 4,
                              moveSlides: 1,
							  infiniteLoop: false,
                              adaptiveHeight: true
                            });
		$('.projects').css('overflow-y', 'visible');
    
    _this.sliderWheel($projectsList, projectsSlider);
    
  }

    /*
      the-best
    */

    var $theBestList = $('.the-best-slider__list');

	 if (document.location.href == 'http://brightberry.ru/' || document.location.href.indexOf('http://brightberry.ru/#') != -1)
	  {
    var theBestListSlider = $theBestList.bxSlider({
                              pager: false,
							  speed: 150
                            });
	  } else {
    var theBestListSlider = $theBestList.bxSlider({
                              minSlides: 7,
                              maxSlides: 7,
							  infiniteLoop: false,
                              pager: false,
							  speed: 150
                            });
		  
	  }
    _this.sliderWheel($theBestList, theBestListSlider);

    $(document).on('click', '.the-best__thumb', function(){

      var slideId = parseInt( $(this).attr('href').replace('#slide', '') );

      theBestListSlider.goToSlide( --slideId );

      return false;
    });


    /*
      thumbs
    */

    var $thumbsList = $('.thumbs-slider__list');
    var $thumbs = $thumbsList.children('li');
    
    if ($thumbs.length > 4){

	  if (document.location.href == 'http://brightberry.ru/' || document.location.href.indexOf('http://brightberry.ru/#') != -1)
	  {
      var thumbsSlider = $thumbsList.bxSlider({
                          pager: false,
                          minSlides: 4,
                          maxSlides: 4,
                          moveSlides: 1,
						  infiniteLoop: true,
						  adaptiveHeight: false,
                          slideWidth: 130,
						  speed: 150
                        });
	} else if (document.location.href.indexOf('/catalog/') != -1) {
      var thumbsSlider = $thumbsList.bxSlider({
                          pager: false,
                          minSlides: 6,
                          maxSlides: 6,
                          moveSlides: 1,
						  infiniteLoop: false,
						  adaptiveHeight: false,
                          slideWidth: 130,
						  speed: 150
                        });
	} else {
      var thumbsSlider = $thumbsList.bxSlider({
                          pager: false,
                          minSlides: 4,
                          maxSlides: 4,
                          moveSlides: 1,
						  infiniteLoop: false,
						  adaptiveHeight: false,
                          slideWidth: 130,
						  speed: 150
                        });
	}

      _this.sliderWheel($thumbsList, thumbsSlider);

    }

  };

  app.modalCallback = function(){
    
    var $modal = $('.modal');

    $(document).on('click', '[href="#callback"]', function(){
      var targetId = $(this).attr('href');
      var $target = $( targetId );
      var $content = $target.find('.modal__content');     

      $target.fadeIn();

      var width = $content.width();
      var height = $content.height();

      $content.css({
        marginLeft: -width/2 - 300,
        marginTop: -height/2
      });

      return false;
    });

    $modal.on('click', function(e){

      if(e.target == e.currentTarget){
        $modal.fadeOut();
      }      

    });

    $('.modal__close').on('click', function(){
      $(this).parents('.modal').fadeOut();
      return false;
    });

  };


  /*
    Всплывающая галерея
  */

app.modalGallery = function(){
    var _this = this;
    var $galleryOpeners = $('.modal-gallery-open');
    var $modalGallery = $('#modal-gallery');
    var $modalGalleryContent = $modalGallery.find('.modal__content');
    var $modalGalleryFrame = $modalGallery.find('#modal-gallery-frame');
	
    var modalHeight = 0;
    var modalWidth = 0;

    var _setModalSizes = function(){
		var windowHeight = $(window).height();
		var windowWidth = $(window).width();
		
		var galleryImagesHeight = 0;
		var modalCloseWidth = 0;
		var modalCloseHeight = 0;
	
		if(windowHeight > windowWidth) {  
			modalHeight = $('.main-box__content').height();
			modalWidth = windowWidth;
			$('.gallery-menu__list').css('bottom', '23px');
			$('.gallery-menu__list').css('left', '-252px');
			$('.gallery-menu__list').css('width', '280px');
		} else {  
			modalHeight = windowHeight * .97;
			modalWidth = modalHeight * 1.33;
		}	

		//alert(windowHeight);
		
		galleryImagesHeight = modalHeight - 160;
		
		$('.gallery-thumbs-slider').css('display', 'block');
		//galleryImagesHeight = modalHeight * 0.75;
		
		//var thumbsHeight = modalHeight * 0.20;
		if(windowHeight < 541){
			if($('#img_caption').css('display') == "block"){
				galleryImagesHeight = modalHeight - 85;
			}else{
				galleryImagesHeight = modalHeight - 80;
			}
			
			$('.gallery__name').css('margin-left', '20px');
			$('.gallery-thumbs-slider').css('display', 'none');
		}
				
		$modalGallery.css('height', windowHeight);
		
		$modalGalleryContent.css({
			height: modalHeight,
			width: modalWidth,
			marginLeft: -modalWidth/2,
			marginTop: -modalHeight/2
		});
		
		$modalGallery.find('.gallery-slider__item').css({
			height: galleryImagesHeight,
			lineHeight: galleryImagesHeight + 'px',
		});
		
		/*$('.gallery-thumbs-slider').css({
			height: thumbsHeight
		});*/
		
		$('.gallery-slider__image').css({
			height: '100%'
		});
    };

    var _initMenu = function(){
      
      var $galleryMenu = $modalGalleryFrame.find('.gallery-menu');
      var $galleryMenuOpener = $modalGalleryFrame.find('.gallery-menu__title');
      var $galleryMenuCloser = $('.gallery__slider');
      var $galleryMenuCloser2 = $('.gallery__thumbs');

      $galleryMenuOpener.on('mouseover', function(){
        var $galleryMenuList = $('.gallery-menu__item');
		if ($galleryMenuList.length <= 1) return true;
        $galleryMenu.addClass('active');
        return false;
      });
      $galleryMenuCloser.on('mouseover', function(){
        var $galleryMenuList = $('.gallery-menu__item');
		if ($galleryMenuList.length == 1) return true;
        $galleryMenu.removeClass('active');
        return false;
      });
      $galleryMenuCloser2.on('mouseover', function(){
        var $galleryMenuList = $('.gallery-menu__item');
		if ($galleryMenuList.length == 1) return true;
        $galleryMenu.removeClass('active');
        return false;
      });

    }

    var _initGallery = function(){

      /*
        gallery
      */

      var $galleryList = $modalGalleryFrame.find('.gallery-slider__list');
      var $galleryThumbsLinks = $modalGalleryFrame.find('.gallery__thumb');
	 
	  if (document.location.href == 'http://brightberry.ru/' || document.location.href.indexOf('http://brightberry.ru/#') != -1)
	  {
		  gallerySlider = $galleryList.bxSlider({
									pager: false,
									speed: 150,
									startSlide: (parseInt($('#active_id').html()) -1 ),
									onSlideNext: function() {$('#th_'+(gallerySlider.getCurrentSlide()+1)).mousedown();},
									onSlidePrev: function() {$('#th_'+(gallerySlider.getCurrentSlide()+1)).mousedown();},
									onSliderLoad: function() {}
								  });
	  } else {
		  gallerySlider = $galleryList.bxSlider({
									pager: false,
									speed: 150,
									infiniteLoop: false,
									hideControlOnEnd: true,
									startSlide: (parseInt($('#active_id').html()) -1 ),
									onSlideNext: function() {$('#th_'+(gallerySlider.getCurrentSlide()+1)).mousedown();},
									onSlidePrev: function() {$('#th_'+(gallerySlider.getCurrentSlide()+1)).mousedown();},
									onSliderLoad: function() {}
								  });
	  }

      _this.sliderWheel($galleryList, gallerySlider);

	  
        var slideId = parseInt($('#active_id').html()) ;
		var titlelinkname = $('#th_'+slideId).attr('titlelinkname');
		console.log(titlelinkname);
		$('#title_link').html(titlelinkname);
		if (!titlelinkname)
			$('#title_link').hide();
		else
			$('#title_link').show();
		var titlelink = $('#th_'+slideId).attr('titlelink');
		$('#title_link').attr('href', titlelink);
		var links = $('#th_'+slideId).attr('links');
		
		updateMenuList(links);
		
		var captionname = $('#th_'+slideId).attr('captionlink');
		
		$('#img_caption').html(captionname);
		
		
     /* $galleryThumbsLinks.on('mousedown', function(){
		console.log('ok');
		
        var slideId = parseInt( $(this).attr('href').replace('#slide', '') );
		console.log(slideId);
        gallerySlider.goToSlide( slideId - 1 ); 
        return false;
      });*/
//	  alert(parseInt($('#active_id').html()) - 1);
    
	
	//$('.gallery__name').html($('#th_'+parseInt($('#active_id').html()-1)).attr('alt'));
      /*
        gallery-thumbs
      */

      var $galleryThumbsList = $modalGalleryFrame.find('.gallery-thumbs-slider__list');
      var $galleryThumbs = $galleryThumbsList.children('li');
      
	  var slideWidth = 59;
	  var slideMargin = 0;
	  
	  var isCatalog = $('.is_catalog').val();
	  if(isCatalog == '0') {
		slideWidth = 71;
		slideMargin = 86;
	  }
	  
      var thumbsNumber = Math.floor( ( modalWidth - 86 ) / slideWidth ) - 1; 
	  
      if ($galleryThumbs.length >= thumbsNumber){
	  
        var galleryThumbsSlider = $galleryThumbsList.bxSlider({
                            pager: false,
                            controls: false,
                            minSlides: thumbsNumber,
                            maxSlides: thumbsNumber,
                            moveSlides: 1,
                            slideWidth: slideWidth,
							slideMargin: slideMargin
                          });

        _this.sliderWheel($galleryThumbsList, galleryThumbsSlider);

      }

    };
    
    $galleryOpeners.on('click', function(){

      $modalGalleryFrame.html( '' );
      
      var target = $(this).attr('href');

      $.get( target , function(data){

        if (!data) return;

        $modalGalleryFrame.html( data );

        _setModalSizes();
        
        $modalGallery.fadeIn();

        _initGallery();

        _initMenu();
		

		if (document.getElementById('yandexMap'))
		{
			$('#yandexMap').css('width' , modalWidth - 60);
			$('#yandexMap').css('height' , (modalWidth - 60) / 1.3 - 60);
			ymaps.ready(init);
		}


      });

      return false;
      
    });

    $(window).on('resize', function(){
      _setModalSizes();
    });

  };

  app.inputHighlight = function(){
    var $inputs = $('.form__input, .form__textarea');

    $inputs.on('focus', function(){
      $(this).parent('.form__input-border').addClass('focused');
    });

    $inputs.on('blur', function(){
      $(this).parent('.form__input-border').removeClass('focused');
    });

  };

  app.insideNavigationHovers = function(){

    var $objectsHrefs = $('.inside-navigation__href');

    var changeSrc = function($href){
      var $image = $href.find('img');
      var imageSrc = $image.prop('src');
      var hoverImageSrc = $image.data('hover-image');

      if (!hoverImageSrc) return;

      $image.prop('src', hoverImageSrc);
      $image.data('hover-image', imageSrc);
    }

    $objectsHrefs.on('mouseenter', function(){
      changeSrc( $(this) );
    });

    $objectsHrefs.on('mouseleave', function(){
      changeSrc( $(this) );
    });

  };

  app.scrollContent = function(){
    var $pageScroll = $('.page__scroll');
    var pageScrollHeight = $pageScroll.height();
    var $pageScrollIn = $pageScroll.find('.page__scroll-in');
    var pageScrollInHeight = $pageScrollIn.height();

    var scrollMe = function( direction ){
      var currentScrollTop = $pageScrollIn.scrollTop();
      var newScrollTop = currentScrollTop + (direction == 'down' ? 120 : -120 );
      
      $pageScrollIn.animate({
          scrollTop: newScrollTop
        }, '500' 
      );

    };

    if (pageScrollInHeight <= pageScrollHeight ) return;

    $pageScrollIn.css({
      height: ( pageScrollHeight + 20 ) + 'px',
      overflow: 'scroll'
    });

    $pageScroll.prepend('<a href="#up" class="page__scroll-up"></a>')
                .append('<a href="#down" class="page__scroll-down"></a>');
    
    $pageScroll.find('.page__scroll-up').on('click', function(){
      scrollMe('up');
      return false;
    });    

    $pageScroll.find('.page__scroll-down').on('click', function(){
      scrollMe('down');
      return false;
    });
  };
  app.scrollMenu = function(){
    var $menuScroll = $('.menu__scroll');
    var menuScrollHeight = $menuScroll.height();
	
    var scrollMyMenu = function( direction ){
      var currentScrollTop = $menuScroll.scrollTop();
      var newScrollTop = currentScrollTop + (direction == 'down' ? 120 : -120 );
      $('.menu__scroll').stop().animate({
          scrollTop: newScrollTop
        }, '500' 
      );

    };
    //if (menuScrollHeight <= 500 ) return;

      $menuScroll.on('mousewheel DOMMouseScroll', function(e){
		  var wheelDelta;
			if (e.originalEvent.wheelDelta) {
			  wheelDelta = e.originalEvent.wheelDelta/120;
			} else if (e.originalEvent.detail) {       
			  wheelDelta = -e.originalEvent.detail/3;
			}
			if (wheelDelta < 0) {  
		  scrollMyMenu('down');
			} else if (wheelDelta > 0) {
		  scrollMyMenu('up');
			}
	  });
  };

  app.alaxOptions = {
    url: "/ajax/callback/",
    timeout: 3000,
    datatype: 'json',
    success: function showResponse(responseText, statusText, xhr, $form)  { 
      var target = $form.data('popup') || 'success';
     // $.fancybox( $('#' + target), app.fancyOptions );
		$('#callback').hide();
		$('#success').show();
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
    $('.form').each(function() {
      $(this).validate({
        //errorPlacement: function(error, element) {},
        highlight: function(element, errorClass) {
          $(element).parent('.form__input-border').addClass('error');
        },
        unhighlight: function(element, errorClass) {
          $(element).parent('.form__input-border').removeClass('error');
        },
        submitHandler: function(form) {
          _this.submitForm(form);
        }
      });
    });
  };

  $(document).ready(function() {

    app.init();

  });
  
}());