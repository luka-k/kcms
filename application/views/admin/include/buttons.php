<div  class="col_12">
	<?if($type == "documents"):?>
		<a href="<?=base_url().'/admin/content/item/edit/manufacturers/'.$content->manufacturer_id.'#tab_5'?>" class="btn small">Назад</a>
	<? else: ?>
		<a href="<?=base_url()?>admin/content/items/<?=$type?>/<?=$parent_id?>" class="btn small">Назад</a>
	<? endif?>
	<a href="#" class="btn small" onclick="submit_form('form1'); return false;">Сохранить</a>
	<?if($type <> "settings"):?>
		<a href="#" class="btn small" onclick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/content/item/save/<?=$type?>/false/exit'); submit_form('form1'); return false;">Сохранить и выйти</a>
		<a href="#" class="btn small" onclick="delete_item('<?=base_url()?>', '<?=$type?>', '<?=$content->id?>', '<?=$content->$name?>')">Удалить</a>
	<?endif;?>
</div>