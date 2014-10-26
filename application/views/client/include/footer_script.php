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
	
	function update_items_1(){
		window.location.replace("/shop?filter=true");
	}	

	function filter(category_id){
		var form = $('.filter-form'),
		form_2 = $('.filter-form-2'),
		categories_inputs = form.find('input.categories_checked'),
		manufacturer_inputs = form.find('input.manufacturer_checked'),
		parent_inputs = form.find('input.parent_checked'),
		attributes_inputs = form_2.find('input.attributes'),
		parent_checked = {},
		categories_checked = {},
		manufacturer_checked = {},
		attributes = {},
		attributes_range = {},
		item = {},
		data = {};
		
		var num = 0;
		attributes_inputs.each(function () {
			var element = $(this);
			if (element.attr('range') == 'true'){
				item[num] = element.val();
				alert(element.attr('name'));
				attributes_range[element.attr('name')] = item;
			}
			
			if (element.attr('range') == 'false'){
				attributes[element.attr('name')] = element.val();
			}
			num++;
			if(num == 2){
				num = 0;
			}
		});
		
		parent_inputs.each(function () {
			var element = $(this);
			if (element.attr('type') == 'checkbox' && $(this).prop("checked")) {
				parent_checked[element.val()] = element.val();
			}
		});	
		
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
		
		manufacturer_inputs.each(function () {
			var element = $(this);
			
			if (element.attr('type') == 'checkbox' && $(this).prop("checked")) {
				if (element.attr('name') == 'manufacturer_checked'){
					manufacturer_num = element.attr('num');
					manufacturer_checked[manufacturer_num] = element.val();
				}			
			}
		});
		
		data.parent_checked = parent_checked;
		data.categories_checked = categories_checked;
		data.manufacturer_checked = manufacturer_checked;
		data.attributes_range = attributes_range;
		data.attributes = attributes;
		var json_str = JSON.stringify(data);
		$.post ("/ajax/filter/", json_str, update_items_1, "json");
	}
</script>