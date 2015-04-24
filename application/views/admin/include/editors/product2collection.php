<div class="category_select col_12 clearfix">
	<div for="lbl_<?=$editors_counter?>" class="col_2"><?=$edit[0]?></div>
	<div class="col_10">
		<?$ch_counter = 0?>
		<?foreach ($selects[$edit_name] as $select): ?>
			<?if($select->childs):?>
			<div class="col_12 clearfix">
				<div class="col_1">
					<input id="cch-2_<?=$ch_counter?>" 
					    class="category_select cch-<?=$select->id?>"
					    type="checkbox" 
					    name="<?=$edit_name?>[]" 
					    value="<?=$select->id?>" 
						<?foreach($content->collections_id as $collection_id):?> <?if($collection_id == $select->id):?>checked<?endif;?> <?endforeach;?>/>
				</div>
				<div class="col_11"><label for="cch-2_<?=$ch_counter?>"><b><?=$select->name?></b></label></div>
				<?$ch_counter++?>
				<?if($select->childs):?>
					<div class="col_12 clearfix">
						<?foreach ($select->childs as $level): ?>
							<div class="col_4 clearfix">
									<div class="col_1">
										<input id="cch-2_<?=$ch_counter?>" 
											   class="category_select cch-<?=$level->id?>"
											   type="checkbox" 
											   name="<?=$edit_name?>[]" 
											   value="<?=$level->id?>" 
											   <?foreach($content->collections_id as $collection_id):?> <?if($collection_id == $level->id):?>checked<?endif;?> <?endforeach;?> "/>
									</div>
									<div class="col_11"><label for="cch-2_<?=$ch_counter?>"><?=$level->name?></label></div>
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