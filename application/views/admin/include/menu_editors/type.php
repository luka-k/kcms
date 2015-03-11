<div class="col_12">
	<div class="col_3"><label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label></div>
	<div class="col_9">
		<select class="<?=$name?> col_8 menu_items" name="<?=$name?>" onchange="menu_type(this.options[this.selectedIndex].value)">
		<option label="" value="">Выберите тип</option>
		<?foreach($types as $title => $type):?>
			<option value="<?=$type?>" <?php if ($item_content->$name == $type):?>selected<?php endif; ?>>
				<?=$title?>
			</option>
		<?endforeach;?>
		</select>
	</div>
</div>