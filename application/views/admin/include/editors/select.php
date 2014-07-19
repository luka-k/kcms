<div  class="col_12">
	<label for="select_<?=$name?>" class="col_3">Категория</label>
	<select id="select_<?=$name?>"  name="<?=$name?>" class="col_8">
		<option value="0">Без категории</option>
		<?php foreach ($selects[$name] as $select): ?>
			<option value="<?=$select->id?>" <?php if ($content->$name == $select->id):?>selected<?php endif; ?><?php if ($content->id == $select->id):?>disabled<?php endif; ?>>
				<?=$select->title?>
			</option>
		<?php endforeach ?>										
	</select>
</div>