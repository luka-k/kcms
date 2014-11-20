<div class="col_12">
	<div class="col_12">Изменить размеры изображений на сайте</div>
		<div class="col_4 clearfix">
			<div class="col_12">Большие Изображения</div>
			<label for="w_1" class="col_3">ширина</label><input id="w_1" name="sizes[catalog_big-w]" class="col_6" type="text" name=""/> px</br>
			<label for="h_1" class="col_3">высота</label><input id="h_1" name="sizes[catalog_big-h]" class="col_6" type="text" name=""/> px</br>
		</div>
		<div class="col_4 clearfix">
			<div class="col_12">Средние изображения</div>
			<label for="w_1" class="col_3">ширина</label><input id="w_2" name="sizes[catalog_mid-w]" class="col_6" type="text" name=""/> px</br>
			<label for="h_1" class="col_3">высота</label><input id="h_2" name="sizes[catalog_mid-h]" class="col_6" type="text" name=""/> px</br>
		</div>
		<div class="col_4 clearfix">
			<div class="col_12">Маленькие изображения</div>
			<label for="w_1" class="col_3">ширина</label><input id="w_3" name="sizes[catalog_small-w]" class="col_6" type="text" name=""/> px</br>
			<label for="h_1" class="col_3">высота</label><input id="h_3" name="sizes[catalog_small-h]" class="col_6" type="text" name=""/> px</br>
		</div>
		
		<div class="col_12"><a href="#" class="button small" onclick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/admin_images/rethumb'); document.forms['form1'].submit()">Изменить</a></div>
</div>