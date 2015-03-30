<div  class="col_12">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>" class="col_2"><?=$edit[0]?></label></div>
	<div class="col_10">
		<select id="lbl_<?=$editors_counter?>"  
				name="<?=$edit_name?>" 
				class="col_12">
			<option>Выберите тип</option>
			<?php foreach ($selects[$edit_name] as $value => $name): ?>
				<option value="<?=$value?>" <?if($value == $content->$edit_name):?>selected<?endif;?>>
					<?=$name?>
				</option>
			<?php endforeach ?>										
		</select>
	</div>
</div>