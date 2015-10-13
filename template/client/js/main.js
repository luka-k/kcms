


$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 2
        },
        330: {
            items: 3
        },
        768: {
            items: 3
        },
        1000: {
            items: 6
        }
    }
})


$('.owl-carousel1').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1
        },
        1000: {
            items: 2
        }
    }
})

$('.owl-carousel2').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 2
        },
        768: {
            items: 3
        },
        1000: {
            items: 4
        }
    }
})

function showResponse(responseText, statusText, xhr, $form)
{
  document.location.hash="#success";
}

jQuery(document).ready(function() {

    var touch = jQuery('#touch-menu');
    var menu = jQuery('.menu');

    jQuery(touch).click(function(e) {
        e.preventDefault();
        menu.slideToggle();
    });
    jQuery(window).resize(function() {
        var w = jQuery(window).width();
        if (w > 760 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    });

    //$('[name="phone"]').mask("+7 (999) 999-9999"); 

    var options = {
      url: "ajax/contact.php",
      timeout: 3000,
      datatype: 'json',
      success: showResponse     
    };
    
  /*  $.extend($.validator.messages, {
        required: "",
        email: "",
    });*/
    
    $('form').each(function() { 
        $(this).find('a').click(function() {$(this).parent().submit(); return false;});
        $(this).submit(function(){
        //  submitHandler: function(form) {
						var _name = '';
						var _phone = '';
            $(this).find('input').each(function(i,e){
              if ($(this).attr('name')=='name')
                _name = $(this).val();
              if ($(this).attr('name')=='phone')
                _phone = $(this).val();
            });
            $.post("ajax/contact.php", {name: _name, phone: _phone}, showResponse);
            $(this).parent().html('Спасибо за Вашу заявку! <br><br>Менеджер свяжется с Вами в течение  дня.');
            return false;
          //}
        });
    });
    
    
});


$(document).ready(function() {


    //new spoiler 2013
    $(".spoiler .block").show();
    $(".close .block").hide();
    $(".spoiler h2").click(function() {
        $(this).toggleClass("bgcolor").next().slideToggle("medium");
    });
    //end new spoiler 2013				
});
