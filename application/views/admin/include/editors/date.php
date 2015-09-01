<div  class="col_12">
	<div class="col_2">
		<label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label>
	</div>
	<div class="col_10">
		<input type="text" 
			   id="lbl_<?=$editors_counter?>" 
			   class="col_12 datepicker <?if(isset($edit[3])&&!empty($edit[3])):?>validation<?endif;?>" 
			   <?if(isset($edit[3])&&!empty($edit[3])):?> data-id="<?=$edit[3]?>"<?endif;?>
			   date="<?=$content->$edit_name?>"
			   name="<?=$edit_name?>"  
			   value="<?=$content->$edit_name?>"/>
	</div>
</div>
