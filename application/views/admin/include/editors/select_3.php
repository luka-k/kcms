<div  class="col_12">
	<label for="select_<?=$name?>" class="col_3"><?=$edit[0]?></label>
	<select id="select_<?=$name?>"  name="<?=$name?>" class="col_8">
		<?php foreach ($selects[$name] as $select): ?>
					<option value="<?=$select->id?>" <?php if ($content->$name == $select->id):?>selected<?php endif; ?>>
						<?=$select->name?>
					</option>
		<?php endforeach ?>										
	</select>
</div>