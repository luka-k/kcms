<div class="col_12">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>"><?=$edit[0]?></label></div>
	<div class="col_10">
	
		<select id="lbl_<?=$editors_counter?>"  class="col_12" name="<?=$edit_name?>">
			<option value="0.1" <?if ($content->$edit_name == '0.1'):?>selected<?endif;?>>0.1</option>
			<option value="0.2" <?if ($content->$edit_name == '0.2'):?>selected<?endif;?>>0.2</option>
			<option value="0.3" <?if ($content->$edit_name == '0.3'):?>selected<?endif;?>>0.3</option>
			<option value="0.4" <?if ($content->$edit_name == '0.4'):?>selected<?endif;?>>0.4</option>
			<option value="0.5" <?if ($content->$edit_name == '0.5' || empty($content->$edit_name)):?>selected<?endif;?>>0.5</option>
			<option value="0.6" <?if ($content->$edit_name == '0.6'):?>selected<?endif;?>>0.6</option>
			<option value="0.7" <?if ($content->$edit_name == '0.7'):?>selected<?endif;?>>0.7</option>
			<option value="0.8" <?if ($content->$edit_name == '0.8'):?>selected<?endif;?>>0.8</option>
			<option value="0.9" <?if ($content->$edit_name == '0.9'):?>selected<?endif;?>>0.9</option>
			<option value="1.0" <?if ($content->$edit_name == '1.0'):?>selected<?endif;?>>1.0</option>
		</select>
	</div>
</div>