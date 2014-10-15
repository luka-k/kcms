<div  class="col_12">
	<label for="select_<?=$name?>" class="col_3"><?=$edit[0]?></label>
	<select id="select_<?=$name?>"  name="<?=$name?>" class="col_8">
	
		<?php foreach ($selects[$name] as $item): ?>
			<option value="<?=$item->id?>" <?php if ($content->$name == $item->id):?>selected<?php endif; ?><?php if ($content->id == $item->id):?>disabled<?php endif; ?>>
				<?=$item->name?>
			</option>
		<?php endforeach ?>										
	</select>
</div>