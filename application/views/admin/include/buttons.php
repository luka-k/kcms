<div  class="col_12">
	<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
	<a href="#" class="btn small" onclick="document.forms['form1'].submit()">Сохранить</a>
	<?if($type <> "settings"):?>
		<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/content/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
		<a href="#delete" class="btn small lightbox">Удалить</a>
	<?endif;?>
		
	<?if(($type == "users")and(!empty($content->id))):?>
		<a href="<?=base_url()?>registration/reset_password.html?email=<?=$content->email?>&secret=<?=$content->secret?>" class="btn small">Сменить пароль</a>
	<?endif;?>
</div>