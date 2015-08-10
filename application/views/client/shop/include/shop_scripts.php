<script>
	$(document).ready(function(){
		var product_width = $('#product-scroll').width();
		$('.secondcolumn').css("max-width", (product_width - 2) + 'px');
	
		$('.ajax_from').val(10);
		$('#sorting_order').val('name');
		$('#sorting_direction').val('asc');
		<? if (!isset($no_ajax)):?>
			$("#product-scroll").scroll(function() {
	
				var div_sh = $(this)[0].scrollHeight;
				var div_h = $(this).height();

				if($(this).scrollTop() >= div_sh - div_h){
					$('#search_input').blur();
					
					if($("#product-scroll").hasClass("search_scroll")){
						$.post('<?=base_url()?>shop/catalog/search_more/', $('#filter-form').serialize(), answer, 'json');
					}else{
						$.post('<?=base_url()?>shop/catalog/ajax_more/', $('#filter-form').serialize(), answer, 'json');
					}
				}
			});
		<?endif?>
		
		
		$("#scroll-right").mCustomScrollbar({
			axis:"y", //set both axis scrollbars
			advanced:{autoExpandHorizontalScroll:true}, //auto-expand content to accommodate floated elements
		});
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
				$('#by_'+param).toggleClass('up');
				/*$('#by_'+param).toggleClass('down');*/
			}else{
				$('#sorting_direction').val('asc');
				$('#by_'+param).toggleClass('down');
				/*$('#by_'+param).toggleClass('down');*/
			}
		}else{
			$('#sorting_order').val(param);
			$('#sorting_direction').val('asc');
			$('#by_'+param).toggleClass('down');
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