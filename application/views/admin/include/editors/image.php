<div class="col_12 clearfix">
	<div class="col_2">Добавить/обновить фотографию</div>
	<div class="col_4"><input type="file" id="<?=$edit_name?>[]" name="<?=$edit_name?>" /></div>
	<input type="hidden" name="image_blob" value="image_blob"/>
</div>

<div class="col_12">
	<input type="hidden" name="view_image" value="view_image"/>
	<div class="col_2">Фотография</div>
	<div class="col_10" style="width:150px; overflow:hidden;">
		<img src="<?=base_url()?>view_image?id=<?=$content->id?>" alt=""/>
	</div>
</div>
