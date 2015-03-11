<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_3"><?=$edit[0]?></label>
	<select id="lbl_<?=$editors_counter?>"  name="<?=$edit_name?>" class="col_8">
		<option>Выберите тип</option>
		<?php foreach ($selects[$edit_name] as $value => $name): ?>
			<option value="<?=$value?>" <?if($value == $content->$edit_name):?>selected<?endif;?>>
				<?=$name?>
			</option>
		<?php endforeach ?>										
	</select>
</div>