<div class="col_12">
	<div class="col_3"><label for="lbl_<?=$editors_counter?>"><?=$edit['0']?></label></div>
	<div class="col_9">
		<?$lbl_counter = 1?>
		<?foreach($types as $title => $type):?>
			<label for="lbl_<?=$lbl_counter?>"><?=$title?></label>
			<input type="radio" id="<?=$lbl_counter?>" class="menu_items <?=$name?>" name="<?=$name?>" value="<?=$type?>"/>
			<?$lbl_counter++?>
		<?endforeach;?>
	</div>
</div>