<div class="col_12 clearfix">
	<div class="col_2">
		Загрузить файл
	</div>
	<div class="col_4"><input type="file" id="<?=$edit_name?>" name="<?=$edit_name?>" /></div>
	<input type="hidden" name="upload_file" value="upload_file"/>
	
	<?if(!empty($content->files)):?>
		<div class="col_12">
			<?$file_counter = 1?>
			<div class="col_1">№</div>
			<div class="col_9">Имя</div>
			<div class="col_2">&nbsp;</div>
			<?foreach($content->files as $file):?>
				<div class="col_1"><?=$file_counter?></div>
				<div class="col_9"><a href="<?=$file->full_url?>"><?=$file->url?></a></div>
				<div class="col_2"><a href="<?=base_url()?>admin/content/delete_file/<?=$type?>/<?=$file->id?>/<?=$tab_counter?>">удалить</a></div>
				<?$file_counter++?>
			<?endforeach;?>
		</div>
	<?endif;?>
</div>