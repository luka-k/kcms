
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
			data['phone'] = $('#phone').val();
			data['message'] = $('#question').val();
			
            $.ajax({
                url: '/ajax/callback/',
                type: 'POST',
                cache: false,
                data: data,
                complete: function (xhr, response) {
                    isCallback = isOrder = false;
                    if ('success') {
						 $('#success').show();
                        
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
		$(document).ready(function() {
			if (document.getElementById('im_'+window.location.hash.substr(1)))
			{
				$('#im_'+window.location.hash.substr(1)).click();
			}
			if (document.getElementById('im_main_'+window.location.hash.substr(1)))
			{
				$('#im_main_'+window.location.hash.substr(1)).click();
			}
		});