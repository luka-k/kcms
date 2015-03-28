<div class="col_12">
	<?foreach($edit[3] as $title => $image_type):?>
		<?if(empty($content->images[$image_type])):?>
			<div class="col_6">
				<div class="col_12 clearfix">
					<div class="col_4"><?=$title?></div>
					<div class="col_8"><input type="file" id="<?=$edit_name?>" name="<?=$edit_name?>[<?=$image_type?>]" /></div>
				</div>
			</div>
		<?else:?>
			<div class="col_6">
				<h6><?=$title?></h6>
				<input type="hidden" name="view_image" value="view_image"/>

				<div class="col_4">
					<a href="<?=$content->images[$image_type][0]->full_url?>" class="lightbox"><img src="<?=$content->images[$image_type][0]->catalog_mid_url?>" width="100%"/></a>
					<div class="col_12 right">
						<a href="#" onclick="delete_image('<?=base_url()?>', '<?=$content->images[$image_type][0]->object_type?>', '<?=$content->images[$image_type][0]->id?>', '<?=$tab_counter?>'); return false;">Удалить</button></a>
					</div>
					<input type="text" class="col_12" name="" value="<?=$content->images[$image_type][0]->name?>"/> <!--место под название фотографии-->
				</div>
			</div>
		<?endif;?>
	<?endforeach;?>
</div>