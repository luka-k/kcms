<div  class="col_12">
	<input type="hidden" name="<?=$name?>" value="0"/>
	<div class="col_2"><label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label></div>
	<div class="col_10">
		<div class="col_12">
			<input type="checkbox" id="lbl_<?=$editors_counter?>" name="<?=$name?>" class="<?=$name?>" <?php if ($item_content->$name == 1):?> checked <?php endif; ?> value="1"/></div>
		</div>
</div>