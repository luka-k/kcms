<div  class="col_12">
	<a href="<?=base_url()?>admin/content/items/<?=$type?>/<?=$parent_id?>" class="btn small">Назад</a>
	<a href="#" class="btn small" onclick="submit_form('form1'); return false;">Сохранить</a>
	<?if($type <> "settings"):?>
		<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/content/item/save/<?=$type?>/false/exit'); submit_form('form1'); return false;">Сохранить и выйти</a>
		<a href="#" class="btn small" onclick="delete_item('<?=base_url()?>', '<?=$type?>', '<?=$content->id?>', '<?=$content->name?>')">Удалить</a>
	<?endif;?>
</div>