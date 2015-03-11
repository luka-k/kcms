<div class="col_12">
	<div class="col_12"><h6>Изменить размеры изображений на сайте</h6></div>
	<div class="col_6">
		<div class="col_12"><input type="file" id="import_images" multiple name="import_images" /></div>
		<a href="#" class="button small" onclick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/images_module/rethumb/import'); document.forms['form1'].submit()">Импорт</a>
	</div>
	<div>
		<a href="<?=base_url()?>admin/images_module/rethumb/resize" class="button small">Изменить</a>
	</div>
</div>