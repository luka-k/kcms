<script>
	$('.open').click(function() {
		$(this).next().slideToggle().toggleClass('show');
		$(this).toggleClass('close');
	});
			
	$('.close').click(function() {
		$(this).next().slideToggle().toggleClass('hide');
		$(this).toggleClass('open');
	});
	
	function menu(item){
		$('#filt-'+item).toggleClass('filtr-act');
		$('#attr-'+item).slideToggle().toggleClass('active');
		
		if ($('#attr-'+item).hasClass('active')){
			$('#shop-item').removeClass('content-shop-1');
			$('#shop-item').addClass('content-shop');
		}else{
			$('#shop-item').removeClass('content-shop');
			$('#shop-item').addClass('content-shop-1');		
		}
		
		for (var i = 1; i < 5; i++) {
			if(i != item){
				$('#filt-'+i).removeClass('filtr-act');
				$('#attr-'+i).removeClass('active');
				$('#attr-'+i).hide();
			}
	    }
		
	}
	
	function update_items(){
		
	}	
	
	function sub_category(category_id){
		var form = $('.filter-form'),
		categories_inputs = form.find('input.categories_checked'),
		parent_inputs = form.find('input.parent_checked'),
		parent_checked = {};
		
		categories_inputs.each(function () {
			var element = $(this);
			
			if (element.attr('type') == 'checkbox' && element.attr('parent') == category_id) {
				if($(".category-"+category_id).prop("checked")){
					element.prop("checked", true);
				}else{
					element.prop("checked", false);
				}
			}	
			
			if (element.attr('type') == 'checkbox' && $(this).prop("checked")) {
				if (element.attr('name') == 'cetegories_checked'){
					categories_num = element.attr('num');
					categories_checked[categories_num] = element.val();
				}
			}else{
				$(".category-"+element.attr('parent')).prop("checked", false);
				delete parent_checked[element.attr('parent')];
			}
		});
	}
</script>