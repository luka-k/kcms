<script>
	function autocomp(){
		var data = {};
		var element = document.getElementById('ch_select');
		type = element.value;
		data.type = type;
		var json_str = JSON.stringify(data);
		$.post ("/ajax/autocomplete/characteristics", json_str, autocomp_answer, "json");
	}
		
	function autocomp_answer(res){
		var availableTags = res.available_tags;
			
		$("#ch_input").autocomplete({
			source: availableTags
		});
	}
</script>