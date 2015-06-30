<div  class="col_12">
	<div class="col_2"><?=$edit['0']?></div>
	<div class="col_10" style="height:250px; overflow-y:scroll;">
		<div class="col_12">
			<?foreach($manufacturer2service as $d):?>
				<div>
					<input type="checkbox" 
						   id="<?=$edit_name?>-fork-<?=$d->id?>"
						   class="<?=$edit_name?>-<?=$d->id?>"						   
						   name="<?=$edit_name?>[]"
						   value="<?=$d->id?>"`
						   onclick="checked_tree('<?=$d->id?>', '<?=$edit_name?>', 'fork');"
						   <?if(in_array($d->id, $content->$edit_name)):?> checked <? endif; ?>"
					/>
					<label for="c_<?=$d->id?>"><?=$d->name?></label>
					<?if(!empty($d->childs)):?>
						<div style="margin:5px 0; padding-left:17px;">
							<?$ch_counter=1?>
							<?foreach($d->childs as $sub_d):?>
								<div>
									<input type="checkbox" 
										   id="lbl_<?=$ch_counter?>" 
										   class="<?=$edit_name?>-branch-<?=$d->id?>"
										   name="<?=$edit_name?>[]" 
										   value="<?=$sub_d->id?>"
										   onclick="checked_tree('<?=$d->id?>', '<?=$edit_name?>', 'child');"
										   <?if(in_array($sub_d->id, $content->$edit_name)):?> checked <? endif; ?> 
									/>
									<label for="lbl_<?=$ch_counter?>"><?=$sub_d->name?></label>
								</div>
								<?$ch_counter++?>
							<?endforeach;?>
						</div>
					<?endif;?>
				</div>
			<?endforeach;?>
		</div>
	</div>
</div>