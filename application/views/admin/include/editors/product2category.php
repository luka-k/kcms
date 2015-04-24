<div class="category_select col_12 clearfix">
	<div for="lbl_<?=$editors_counter?>" class="col_2"><?=$edit[0]?></div>
	<div class="col_10">
		<?$ch_counter = 0?>
		<?foreach ($selects[$edit_name] as $select): ?>
			<?if($select->childs):?>
			<div class="col_12 clearfix">
				<div class="col_12"><b><?=$select->name?></b></div>
				<?if($select->childs):?>
					<div class="col_12 clearfix">
						<?foreach ($select->childs as $level): ?>
							<div class="col_4 clearfix">
									<div class="col_1">
										<input id="cch_<?=$ch_counter?>" 
											   class="category_select cch-<?=$level->id?>"
											   type="checkbox" 
											   name="<?=$edit_name?>[]" 
											   value="<?=$level->id?>" 
											   <?foreach($content->parent_id as $parent_id):?> <?if($parent_id == $level->id):?>checked<?endif;?> <?endforeach;?> 
											   onclick="select_equal(<?=$level->id?>, <?=$ch_counter?>)"/>
									</div>
									<div class="col_11"><label for="lbl_<?=$ch_counter?>"><?=$level->name?></label></div>
							</div>
							<?$ch_counter++?>
						<?endforeach;?>
					</div>
				<?endif;?>
			</div>
			<?endif;?>
		<?endforeach ?>
	</div>
</div>