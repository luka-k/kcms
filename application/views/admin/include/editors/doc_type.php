<div  class="col_12">
	<input type="hidden" name="<?=$edit_name?>[]" value=""/>
	<div class="col_2"><?=$edit['0']?></div>
	<div class="col_10">
		<div class="col_12">
			<?$ch_counter = 1?>
			<?foreach($doc_types as $num => $d_t):?>
				<div>
					<input type="checkbox" id="lbl_<?=$ch_counter?>" name="<?=$edit_name?>[]" <?if (in_array($num, $content->$edit_name)):?> checked <? endif; ?> value="<?=$num?>"/>
					<label for="lbl_<?=$ch_counter?>"><?=$d_t?></label>
				</div>
				<?$ch_counter++?>
			<?endforeach;?>
		</div>
	</div>
</div>