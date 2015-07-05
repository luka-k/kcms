<div  class="col_12">
	<select id="<?=$name?>"  name="<?=$name?>" class="col_8">
		<?php foreach ($select as $key => $title): ?>
			<option value="<?=$key?>" <?if($key == "0"):?>disable<?endif;?> >
				<?=$title?>
			</option>
		<?php endforeach ?>										
	</select>
</div>