<?if($content->$name <> NULL):?>
	<div class="col_12 clearfix">
		<div class="col_3"><?=$edit['0']?></div>
		<div class="col_2"><a href="<?=base_url()?><?=$content->$name->url?>">Скачать файл</a></div>
		<div class="col_2"><a href="<?=base_url()?>admin/delete_file/<?=$content->$name->name?>">Удалить</a></div>
	</div>
<?else:?>
	<div  class="col_12 clearfix">
		<div class="col_3"><label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label></div>
		<div class="col_9"><input type="file" name="<?=$name?>" accept="application/msword"></div>
	</div>
<?endif;?>