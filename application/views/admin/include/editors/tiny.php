<div  class="col_12">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label></div>
	<div class="col_10"><textarea id="editor_<?=$tiny_counter?>" name="<?=$edit_name?>" class="textarea col_12" rows="20" cols="50" placeholder="<?=$edit['0']?>"><?=$content->$edit_name?></textarea></div>
</div>
<?$tiny_counter++?>
