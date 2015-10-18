<div class="col_12">
	<div class="col_2">Добавить фотографии</div>
	<div class="col_4"><input type="file" multiple="multiple" id="<?=$edit_name?>" name="<?=$edit_name?>[]" accept="image"/></div>
	<input type="hidden" name="upload_image" value="upload_image"/>
</div>

<?if($content->images <> NULL):?>
	<div class="col_12">
		<input type="hidden" name="view_image" value="view_image"/>
		
		<?$counter = 1?>
		<div class="col_12">
			<?foreach($content->images as $image):?>
				<div class="col_2">
					<a href="<?=$image->full_url?>" class="lightbox"><img src="<?=$image->admin_url?>" width="100%"/></a>
					<div class="col_6">
						<?if($image->is_cover == 0):?>
							<a href="<?=base_url()?>admin/content/set_cover/<?=$image->object_type?>/<?=$image->object_id?>/<?=$image->id?>/<?=$tab_counter?>">Обложка</button></a>
						<?endif;?>
					</div>
					<div class="col_6 right"><a href="#" onclick="delete_image('<?=base_url()?>', '<?=$image->object_type?>', '<?=$image->id?>', '<?=$tab_counter?>'); return false;">Удалить</button></a></div>
					<input type="text" class="col_12" name="" value="<?=$image->name?>" onchange="rename_image('<?=$image->id?>', this.value)"/> <!--место под название фотографии-->
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>

<script>

</script>