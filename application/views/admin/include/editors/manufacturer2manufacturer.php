<div  class="col_12">
	<input type="hidden" name="<?=$edit_name?>[]" value=""/>
	<div class="col_2"><?=$edit['0']?></div>
	<div class="col_10" style="height:250px; overflow-y:scroll;">
		<div class="col_12">
			<?$ch_counter = 1?>
			<?foreach($manufacturer2manufacturer as $d):?>
				<div>
					<input type="checkbox" id="lbl_<?=$ch_counter?>" name="<?=$edit_name?>[]" <?if (in_array($d->id, $content->$edit_name)):?> checked <? endif; ?> value="<?=$d->id?>"/>
					<label for="lbl_<?=$ch_counter?>"><?=$d->name?></label>
				</div>
				<?$ch_counter++?>
			<?endforeach;?>
		</div>
	</div>
</div>