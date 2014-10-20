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
				
	$('#filt-1').click();
	
	function filter() {

		var form = $('.filter-form'),
		inputs = form.find('input'),
		categories_checked = {},
		manufacturer_checked = {},
		data = {},
		categories_num,
		manufacturer_num;

		inputs.each(function () {
			var element = $(this);
			if (element.attr('type') == 'checkbox' && $(this).prop("checked")) {
				if (element.attr('class') == 'cetegories_checked'){
					categories_num = element.attr('num');
					categories_checked[categories_num] = element.val();
				}
				if (element.attr('class') == 'manufacturer_checked'){
					manufacturer_num = element.attr('num');
					manufacturer_checked[manufacturer_num] = element.val();
				}
			}
		});	
		data.categories_checked = categories_checked;
		data.manufacturer_checked = manufacturer_checked;
		var json_str = JSON.stringify(data);
		$.post ("/ajax/filter/", json_str, update_items_1, "json");
	}
	
	function update_items_1(){
		window.location.replace("/shop?filter=true");
	}	
</script>