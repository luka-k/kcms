<h6>Товары</h6>
<div>
	<form method="get" accept-charset="utf-8"  enctype="multipart/form-data" id="menu_id_form" action="<?=base_url()?>admin/content/items/products">
		<select name="menu_id" class="col_12" onchange="submit_form('menu_id_form'); return false;">
			<option disabled selected>Выберите меню</option>
			<?foreach($menu_select as $select):?>
				<option value="<?=$select->id?>" <?if($select->id == $menu_id):?>selected<?endif;?>><?=$select->name?></option>
			<?endforeach;?>
		</select>
	</form>
</div>
<ul class="tree">
	<li><a href="<?=base_url()?>admin/content/items/<?=$type?>/all">Все продукты</a></li>
	<?foreach ($tree as $branch_1): ?>
		<li><a class="" href = "<?=base_url()?>admin/content/items/<?=$type?>/<?=$branch_1->id?><?if($menu_id):?>?menu_id=<?=$menu_id?><?endif;?>"><?=$branch_1->name?></a></li>
	<?endforeach;?>
</ul>
