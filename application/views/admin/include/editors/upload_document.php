<div class="col_12 clearfix">
	<div class="col_2">
		<?if(empty($content->url)):?>Загрузить<?else:?>Обновить<?endif;?> файл
	</div>
	<div class="col_4"><input type="file" id="<?=$edit_name?>" name="<?=$edit_name?>" /></div>
	<input type="hidden" name="upload_document" value="upload_document"/>
</div>