<script>
	$(document).ready(function(){
		
	});
		
	function answer(res){
		$("#products_div").append(res.content);
		$('.ajax_from').val(res.ajax_from);
	}	
	
	function sorting(param){
		$('.ajax_from').val(0);
		var selected_order = $('#sorting_order').val();
		$('#by_name').removeClass();
		$('#by_price').removeClass();
		if(param == selected_order){
			var selected_direction = $('#sorting_direction').val();
			if(selected_direction == 'asc'){
				$('#sorting_direction').val('desc');
				$('#by_'+param).toggleClass('down');
			}else{
				$('#sorting_direction').val('asc');
				$('#by_'+param).toggleClass('up');
			}
		}else{
			$('#sorting_order').val(param);
			$('#sorting_direction').val('asc');
			$('#by_'+param).toggleClass('up');
		}
		
		$.post('<?=base_url()?>shop/catalog/ajax_more/', $('#filter-form').serialize(), sort_answer, 'json');
	}
	
	function sort_answer(answer){
		$("#products_div").empty();
		$("#products_div").append(answer.content);
		$('.ajax_from').val(10);
	}
</script>

<?if(isset($filters_checked["width_from"])):?>
	<script>
		$( document ).ready(function() {
			$("#width-low").attr("name", "width_from");
			$("#width-hi").attr("name", "width_to");
		});	
	</script>
<?endif;?>
	
<?if(isset($filters_checked["height_from"])):?>
	<script>
		$( document ).ready(function() {
			$("#height-low").attr("name", "height_from");
			$("#height-hi").attr("name", "height_to");
		});	
	</script>
<?endif;?>
	
<?if(isset($filters_checked["depth_from"])):?>
	<script>
		$( document ).ready(function() {
			$("#depth-low").attr("name", "depth_from");
			$("#depth-hi").attr("name", "depth_to");
		});	
	</script>
<?endif;?>
	
<?if(isset($filters_checked["price_from"])):?>
	<script>
		$( document ).ready(function() {
			$("#price-low").attr("name", "price_from");
			$("#price-hi").attr("name", "price_to");
		});	
	</script>
<?endif;?>