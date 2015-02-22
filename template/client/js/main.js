;(function(){

  "use strict";

  var app = {};

  app.init = function(){

    //this.fancyBoxes();
    this.validate();
    this.sliders();
    this.insideNavigationHovers();
    this.scrollContent();

    this.modalCallback();
    this.modalGallery();

    this.inputHighlight();

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

    
    if ($projects.length > 4){
      
      var projectsSlider = $projectsList.bxSlider({
                              pager: false,
                              mode: 'vertical',
                              minSlides: 4,
                              maxSlides: 4,
                              moveSlides: 1,
                              adaptiveHeight: false
                            });
    
    _this.sliderWheel($projectsList, projectsSlider);
    
    }

    /*
      the-best
    */

    var $theBestList = $('.the-best-slider__list');

    var theBestListSlider = $theBestList.bxSlider({
                              pager: false
                            });

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
    
    if ($thumbs.length > 5){

      var thumbsSlider = $thumbsList.bxSlider({
                          pager: false,
                          minSlides: 5,
                          maxSlides: 5,
                          moveSlides: 1,
                          slideWidth: 130
                        });

      _this.sliderWheel($thumbsList, thumbsSlider);

    }

  };

  app.modalCallback = function(){
    
    var $modal = $('.modal');

    $(document).on('click', '[href="#callback"]', function(){
      var targetId = $(this).attr('href');
      var $target = $( targetId );
      var $content = $target.find('.modal__content');
      
      $modal.css('height', $(document).height());

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
    var modalHight = 0;
    var modalWidth = 0;

    var _setHeight = function(){
      var documentHeight = $(document).height();
      var documentWidth = $(document).width();

      modalHight = documentHeight * .9;
      modalWidth = documentWidth - 300;
      var galleryImagesHeight = modalHight - 130;

      $modalGallery.css('height', documentHeight );

      $modalGalleryContent.css({
        height: modalHight,
        width: modalWidth,
        marginLeft: -modalWidth/2,
        marginTop: -modalHight/2
      })

      $modalGallery.find('.gallery-slider__item').css({
        height: galleryImagesHeight,
        lineHeight: galleryImagesHeight + 'px'
      });
    };

    var _initMenu = function(){
      
      var $galleryMenu = $modalGalleryFrame.find('.gallery-menu');
      var $galleryMenuOpener = $modalGalleryFrame.find('.gallery-menu__title');

      $galleryMenuOpener.on('click', function(){
        $galleryMenu.toggleClass('active');
        return false;
      })

    }

    var _initGallery = function(){

      /*
        gallery
      */

      var $galleryList = $modalGalleryFrame.find('.gallery-slider__list');
      var $galleryThumbsLinks = $modalGalleryFrame.find('.gallery__thumb');

      var gallerySlider = $galleryList.bxSlider({
                                pager: false
                              });

      _this.sliderWheel($galleryList, gallerySlider);

      $galleryThumbsLinks.on('click', function(){
		
        var slideId = parseInt( $(this).attr('href').replace('#slide', '') );

        gallerySlider.goToSlide( --slideId );

        return false;
      });

      /*
        gallery-thumbs
      */

      var $galleryThumbsList = $modalGalleryFrame.find('.gallery-thumbs-slider__list');
      var $galleryThumbs = $galleryThumbsList.children('li');
      
      var thumbsNumber = Math.floor( ( modalWidth - 80 ) / 60 );

      if ($galleryThumbs.length > thumbsNumber){

        var galleryThumbsSlider = $galleryThumbsList.bxSlider({
                            pager: false,
                            controls: false,
                            minSlides: thumbsNumber,
                            maxSlides: thumbsNumber,
                            moveSlides: 1,
                            slideWidth: 59
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

        _setHeight();
        
        $modalGallery.fadeIn();

        _initGallery();

        _initMenu();

      });

      return false;
      
    });

    $(window).on('resize', function(){
      _setHeight();
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

  app.alaxOptions = {
    url: "ajax/contact.php",
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