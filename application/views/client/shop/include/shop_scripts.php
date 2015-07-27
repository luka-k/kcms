<script>
	$(document).ready(function(){
		$('#ajax_from').val(10);
		<? if (!isset($no_ajax)):?>
			$("#product-scroll").scroll(function() {
				var div_sh = $(this)[0].scrollHeight;
				var div_h = $(this).height();

				if($(this).scrollTop() >= div_sh - div_h){
					$.post('<?=base_url()?>shop/catalog/ajax_more/', $('#filter-form').serialize(), answer, 'json');
				}/*убрать shop*/
			});
		<?endif?>
		$("#scroll-right").mCustomScrollbar({
			axis:"y", //set both axis scrollbars
			advanced:{autoExpandHorizontalScroll:true}, //auto-expand content to accommodate floated elements
		});
	});
		
	function answer(res){
		$("#product-scroll").append(res.content);
		$('#ajax_from').val(res.ajax_from);
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