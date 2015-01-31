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
		var form = $('#new_subscribe'),
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
</script>