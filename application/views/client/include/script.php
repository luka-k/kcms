<!-- Scripts -->
        
<!-- polifils for IE -->
	<!--[if lte IE 9]>
		<script src="js/vendor/placeholders.js"></script>
		<script src="js/vendor/selectivizr-min.js"></script>
	<![endif]-->
	
	<script type="text/javascript">
		function validateme() {
			var result = true;
			if(document.getElementById("name").value == "") {
				result = false;
				$("#name").addClass("error");
			} else {
				$("#name").removeClass("error");
			  }
			  if(document.getElementById("email").value == "") {
			    result = false;
				$("#email").addClass("error");
			  } else {
				$("#email").removeClass("error");
			  }
			  if(document.getElementById("question").value == "") {
			    result = false;
				$("#question").addClass("error");
			  } else {
				$("#question").removeClass("error");
			  }
			  if (!result) alert("Все поля обязательны для заполнения.");
			  return result;
		}
		
		function submit_form()
		{
			if (!validateme()) return false;

			var data = {};

			data['name'] = $('#name').val();
			data['email'] = $('#email').val();
			data['message'] = $('#question').val();
			
            $.ajax({
                url: '/ajax/callback/',
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
							scrolling: 'no',
                            width: 400,
                            height: 160
                        });
                        setTimeout(function () {
                            $.fancybox.close();
                        }, 3000);
                        
                    } else {
                        $.fancybox('<div class="modal err"><h3>Упс!</h3><p>Произошла ошибка, попробуйте еще раз.</p></div>', {
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
		}
		
	</script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
	
	<!-- —крипт popup -->
	<script src="<?=base_url()?>template/client/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
	
	<!-- slider -->
	<script src="<?=base_url()?>template/client/js/bxslider/jquery.bxslider.min.js"></script>
	
	<!-- ќбработка и валидаци¤ форм -->
	<script src="<?=base_url()?>template/client/js/vendor/jquery.form.min.js"></script>
	<script src="<?=base_url()?>template/client/js/vendor/jquery.validate.min.js"></script
	
	<!-- main script -->
	<script src="<?=base_url()?>template/client/js/main.js"></script>
	
	<script type="text/javascript" src="<?=base_url()?>template/js/jquery-ui/jquery-ui.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/js/jquery-ui/ru.js"></script> <!--fancybox js-->
	<link href="<?=base_url()?>template/js/jquery-ui/jquery-ui.css" rel="stylesheet" />