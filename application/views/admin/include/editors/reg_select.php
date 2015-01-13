<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_2">Регион</label>
	<select id="lbl_<?=$editors_counter?>"  name="<?=$name?>" class="col_9">
		<option <?php if ($content->$name == 0):?>selected<?php endif; ?> value="0">Не обходимо выбрать</option>
		<?php foreach ($selects[$name] as $value =>$select): ?>
			<option class="option-1" value="<?=$value?>" <?php if ($content->$name == $value):?>selected<?php endif; ?>>
				<?=$select?>
			</option>
		<?php endforeach ?>										
	</select>
</div>