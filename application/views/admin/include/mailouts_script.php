<script>
	$( document ).ready(function() {
		if(document.getElementById('template')){
			var value = document.getElementById('template').value;
		
			if(value != '0'){
				document.getElementById('template_button').disabled=false;
				$('#template_button').removeClass("disabled");
			}
		}
	});
	
	function enabled_item(value){						
		if(value == '0'){
			document.getElementById('template_button').disabled=true;
			$('#template_button').addClass("disabled");
		}else{
			document.getElementById('template_button').disabled=false;
			$('#template_button').removeClass("disabled");
		}
	}
	
	function all_sub(action){
		var form = $('#subscribe_form'),
		inputs = form.find('input.subscribe_input');
		
		var counter_1 = 0;
		var counter_2 = 0;
		inputs.each(function () {
			var element = $(this);
			if(action == "main"){
				
				if($("#all_subscribe").prop("checked")){
					element.prop("checked", true);
				}else{
					element.prop("checked", false);
				}
	
				
			}else if(action == "child"){
				counter_1++;
				if(element.prop("checked") == false){
					$("#all_subscribe").prop("checked", false);
				}else{
					counter_2++;
				}
				
				if(counter_1 == counter_2){
					$("#all_subscribe").prop("checked", true);
				}
			}
		});
	}
	
	$(document).ready(function() {
		$("#subscribe_form").submit(function(){
			var form = $(this),
			subscribes_groups = {},
			data = {},
			users = {};
			
			//Валидация формы
			if (subscribe_validation(form, 'error')) return false;
				
			//Получаем выдделенные группы подписчиков	
			var subscribe_inputs = form.find('.subscribe_input');
			var counter = 0;
			subscribe_inputs.each(function(){
				var el = $(this);
				if(el.prop("checked")){
					subscribes_groups[counter] = el.val();
				}
				counter++;
			}); 
					
			data.groups_ids = subscribes_groups;
			var json_str = JSON.stringify(data);
			
			//По группам подписчиков получаем список пользователей			
			$.post( "/admin/mailouts_module/get_emails/", json_str, function(res){
				var data = {},
				post= {};
		
				//Получаем список пользователей
				var users = JSON.parse(res);
						
				$.fancybox.open("#mailout");
		
				//Получаем информацию из формы
				var subscribe_info = form.find('.subscribe_info');
				var counter = 0;
				subscribe_info.each(function(){
					var el = $(this);
					post[el.attr("name")] = el.val();
					counter++;
				});
		
				//Получаем текст письма из фрейма js-редактора
				var d = window.frames[0].document;
				post['message'] = escape(d.body.innerHTML);
		
				data.post = post;
		
				var mails_counter = users.length;
				window.no_success = 0;
				window.success = 0;
				
				$('.all').text(mails_counter);
		
				//Начинаем отправку писем
				for(var i=0; i < mails_counter; i++) {
					data.user = users[i];
					var json_str = JSON.stringify(data);
					$.post( "/admin/mailouts_module/send_mail/", json_str, send_callback);
				}
		
				//ФОрмируем информацию для лога в базу
				data = {};
				data.users_groups = subscribes_groups;
				data.template_id = $("#template_id").val();
		
				///////////////////////////////////////////////////////////////////
				// И вот собствекнно косяк                                       //
				// функция send_callback спокойно работае с success и no_succes  //
				// но в нее ее значения переменнвх не меняются.                  //
				// гуглил этот вопрос я достаточно много.                        //
				// писать в куки?                                                //
				// писать лог в файл? а потом из него брать.                     //
				// как то замутно.                                               //
				///////////////////////////////////////////////////////////////////
				data.success = success;
				data.no_success = no_success;
				var json_str = JSON.stringify(data);
				$.post( "/admin/mailouts_module/add_mailout_info/", json_str, function() {
					setTimeout(function(){
						document.location.assign('/admin/mailouts_module/');
					}, 4000);
				});
			});
				
			return false;
		});
	});
	

	
	function send_callback(answer) {
		if(answer == "true"){
			success++;
			
		}else{
			no_success++;
		}
				
		$('.success').text(success);
		$('.no_success').text(no_success);
	}
	
	function subscribe_validation (element, errorClass) {
		var input = element.find('.validate'),
		isError = false;

		input.on('focus', function () {
			var el = $(this);
			if (el.hasClass(errorClass)) el.removeClass(errorClass);
		});
		
		$('#subscribes').css("border", "none");
		
		var counter = 0;
		input.each(function () {
			var el = $(this);
			if (el.val() == "") {
				el.addClass(errorClass);
				isError = true;
			}
			
			if (el.attr('type') == 'checkbox' && el.prop("checked")){
				counter++;
			}	
		});
		
		if(counter == 0){
			$('#subscribes').css("border", "1px solid red");
			isError = true;
		}
		
		return isError;
	}
</script>