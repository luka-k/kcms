<div  class="col_12">
	<input type="hidden" name="<?=$edit_name?>" value="0"/>
	<div class="col_3"><label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label></div>
	<div class="col_9"><input type="checkbox" id="lbl_<?=$editors_counter?>" name="<?=$edit_name?>" <?php if ($content->$edit_name == 1):?> checked <?php endif; ?> value="1"/></div>
</div>