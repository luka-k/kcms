<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_2"><?=$edit['0']?></label>
	<select id="lbl_<?=$editors_counter?>"  name="<?=$name?>" class="col_9">
		<option>Не обходимо выбрать</option>
		<?php foreach ($selects[$name] as $select): ?>
			<option value="<?=$select->id?>" <?php if ($content->$name == $select->id):?>selected<?php endif; ?>>
				<?=$select->name?>
			</option>
		<?php endforeach ?>										
	</select>
</div>