<div  class="col_12 clearfix">
	<div class="col_2">
		<label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label>
	</div>
	<div class="col_10">
		<input type="text" 
			class="menu_items <?=$name?> col_12 <?if(isset($edit[3])&&!empty($edit[3])):?>validation<?endif;?>" 
			<?if(isset($edit[3])&&!empty($edit[3])):?> data-id="<?=$edit[3]?>"<?endif;?>
			id="lbl_<?=$editors_counter?>" 
			name="<?=$name?>" 
			value="<?=$item_content->$name?>"/>
	</div>
</div>