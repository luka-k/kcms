<div  class="col_12">
	<a href="<?=base_url()?>admin/content/items/<?=$type?>/<?=$parent_id?>" class="btn small">Назад</a>
	<a href="#" class="btn small" onclick="document.forms['form1'].submit()">Сохранить</a>
	<?if($type <> "settings"):?>
		<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/content/item/save/<?=$type?>/false/exit'); document.forms['form1'].submit()">Сохранить и выйти</a>
		<a href="#delete" class="btn small lightbox">Удалить</a>
	<?endif;?>
</div>