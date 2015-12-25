

$('#reg-btn').on('click', function(){
	$.post('/account/new_user_ajax', $('#registration_form').serialize(), function(answer){
		if(answer == 'ok'){
			$('#modal-registration-big').addClass("fade");
			$('#modal-registration-big').addClass("hidden-xs");
			$('#modal-registration-big').attr('aria-hidden', true);
			$('#modal-registration-big').removeClass("in");
			$('#modal-registration-big').css('display', 'none');
			setTimeout(function () {
				window.location = "/cabinet";
            }, 1000);
		}else{
			if(answer['error']) $('.error_text').html(answer['error']);
		}
	}, 'json');
});

$('#login-btn').on('click', function(){
	$.post('/account/login_ajax', $('#login_form').serialize(), function(answer){
		if(answer == 'ok'){
			$('#modal-login-big').addClass("fade");
			$('#modal-login-big').addClass("hidden-xs");
			$('#modal-login-big').attr('aria-hidden', true);
			$('#modal-login-big').removeClass("in");
			$('#modal-login-big').css('display', 'none');
			setTimeout(function () {
				window.location = "/cabinet";
            }, 500);
		}else{
			if(answer['error']) $('.error_text').html(answer['error']);
		}
	}, 'json');
});

$('.form-input').on('focus', function(){
	$('.error_text').html('');
});