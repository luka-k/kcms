<?if(empty($content->images)):?>
	<div class="col_12 clearfix">
		<div class="col_2">Добавить фотографии</div>
		<div class="col_4"><input type="file" id="<?=$edit_name?>[]" name="<?=$edit_name?>" /></div>
		<input type="hidden" name="upload_image" value="upload_image"/>
	</div>
<?else:?>
	<div class="col_12">
		<input type="hidden" name="view_image" value="view_image"/>
	
		<div class="col_4">
			<a href="<?=$content->images[0]->full_url?>" class="lightbox"><img src="<?=$content->images[0]->catalog_mid_url?>" width="100%"/></a>
			<div class="col_12 right">
				<a href="#" onclick="delete_image('<?=base_url()?>', '<?=$content->images[0]->object_type?>', '<?=$content->images[0]->id?>', '<?=$tab_counter?>'); return false;">Удалить</button></a>
			</div>
			<input type="text" class="col_12" name="" value="<?=$content->images[0]->name?>"/> <!--место под название фотографии-->
		</div>
	</div>
<?endif;?>