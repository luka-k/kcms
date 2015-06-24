<script>
	function select_office(id){
		var office_items = $(".contacts").find(".contact_item");
		office_items.each(function(){
			if(id == 'false'){
				$(this).css("display", "block");
			}else{
				if($(this).attr("id") == "contact-"+id){
					$(this).css("display", "block");
				}else{
					$(this).css("display", "none");
				}
			}
		});
	}
</script>