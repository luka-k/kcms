<?if($content->image_blob == 'image_blob'):?>
	<div class="col_12 clearfix">
		<div class="col_2">Добавить фотографии</div>
		<div class="col_4"><input type="file" id="<?=$edit_name?>[]" name="<?=$edit_name?>" /></div>
		<input type="hidden" name="image_blob" value="image_blob"/>
	</div>
<?else:?>
	<div class="col_12">
		<input type="hidden" name="view_image" value="view_image"/>
		<div class="col_2">Фотография</div>
		<div class="col_10" style="width:150px; height:150px; border-radius:50%; overflow:hidden;">
			<img src="<?=base_url()?>view_image?id=<?=$content->id?>" alt=""/>
		</div>
	</div>
<?endif;?>