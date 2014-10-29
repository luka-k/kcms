<div  class="col_12">
	<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
	<a href="#delete" class="btn small lightbox">Удалить</a>
	<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
	<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
	<?if(($type == "users")and(!empty($content->id))):?>
		<a href="<?=base_url()?>registration/reset_password.html?email=<?=$content->email?>&secret=<?=$content->secret?>" class="btn small">Сменить пароль</a>
	<?endif;?>
</div>