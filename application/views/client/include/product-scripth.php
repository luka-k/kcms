<script>
	$(document).ready(function(){
		$('#gal-1 img').addClass('slide'); 
		$('.slide').click(function(){ 
			$('.picture').remove(); 
			$('<img class="picture" />').appendTo('#box-1').attr('src',$(this).attr('src'));
		});
	
		$('#gal-2 img').addClass('slide-2'); 
		$('.slide-2').click(function(){ 
			$('.picture-2').remove(); 
			$('<img class="picture-2" />').appendTo('#box-2').attr('src',$(this).attr('src'));
		});
	});
	
	</script>