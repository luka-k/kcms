<div  class="col_12">
	<a href="<?=base_url()?>admin/content/items/<?=$type?>/<?if(isset($content->parent_id)):?><?=$content->parent_id?><?endif;?>" class="btn small">Назад</a>
	<a href="#" class="btn small" onclick="document.forms['form1'].submit()">Сохранить</a>
	<?if($type <> "settings" && $type <> "slider"):?>
		<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/content/item/save/<?=$type?>/false/exit'); document.forms['form1'].submit()">Сохранить и выйти</a>
		<a href="#" class="btn small" onclick="delete_item('<?=base_url()?>', '<?=$type?>', '<?=$content->id?>', '<?=$content->$name?>'); return false;">Удалить</a>
	<?endif;?>
		
	<?if(($type == "users")and(!empty($content->id))):?>
		<a href="<?=base_url()?>registration/reset_password.html?email=<?=$content->email?>&secret=<?=$content->secret?>" class="btn small">Сменить пароль</a>
	<?endif;?>
</div>