$(document).ready(function() {

    $('.iosSlider').iosSlider({
        desktopClickDrag: false,
        snapToChildren: false,
        navSlideSelector: '.sliderContainer .slideSelectors .item',
        onSlideComplete: slideComplete,
        onSliderLoaded: sliderLoaded,
        onSlideChange: slideChange,
        scrollbar: false,
        autoSlide: true,
        autoSlideTimer: 10000,
    infiniteSlider: false
    });

    });

    function slideChange(args) {
            
    $('.sliderContainer .slideSelectors .item').removeClass('selected');
    $('.sliderContainer .slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

    }

    function slideComplete(args) {

    if(!args.slideChanged) return false;

    $(args.sliderObject).find('.title, .description, .slider_button, .slider_img').attr('style', '');

    $(args.currentSlideObject).find('.title').animate({
        right: '100px',
        opacity: '1'
    }, 400, 'easeOutQuint');

    $(args.currentSlideObject).find('.description').delay(200).animate({
        right: '70px',
        opacity: '1'
    }, 400, 'easeOutQuint');

        $(args.currentSlideObject).find('.slider_button').delay(200).animate({
        right: '70px',
        opacity: '1'
    }, 400, 'easeOutQuint');
    $(args.currentSlideObject).find('.slider_img').delay(200).animate({
        right: '70px',
        opacity: '1'
    }, 400, 'easeOutQuint');
    }

    function sliderLoaded(args) {
        
    $(args.sliderObject).find('.title, .description, .slider_button, .slider_img').attr('style', '');

    $(args.currentSlideObject).find('.title').animate({
        right: '100px',
        opacity: '1'
    }, 400, 'easeOutQuint');

    $(args.currentSlideObject).find('.description').delay(200).animate({
        right: '70px',
        opacity: '1'
    }, 400, 'easeOutQuint');

        $(args.currentSlideObject).find('.slider_button').delay(200).animate({
        right: '70px',
        opacity: '1'
    }, 400, 'easeOutQuint');
        $(args.currentSlideObject).find('.slider_img').delay(200).animate({
        right: '70px',
        opacity: '1'
    }, 400, 'easeOutQuint');

    slideChange(args);

    }

	
	
$('.owl-carousel').owlCarousel({ 
    loop:true,
    margin:10,
    nav:true,
    responsive:{
      
        1000:{
            items:2
        }
    }
    })

$('.owl-carousel1').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
      
        1000:{
            items:5
        }
    }
    })

	$('.owl-carousel2').owlCarousel({ 
    loop:true,
    margin:10,
    nav:true,
    responsive:{
      
        1000:{
            items:3
        }
    }
    })