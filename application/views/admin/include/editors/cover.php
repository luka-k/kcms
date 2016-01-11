<div  class="col_12">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>"><?=$edit[0]?></label></div>
	<div class="col_10">
		<select id="lbl_<?=$editors_counter?>" class="col_12"  name="<?=$edit_name?>">
			<?php foreach ($selects[$edit_name] as $value => $title): ?>
				<option value="<?=$value?>" <?if ($content->$edit_name == $value):?>selected<?endif;?>>
					<?=$title?>
				</option>
			<?endforeach;?>										
		</select>
	</div>
</div>