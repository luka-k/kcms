<div  class="col_12">
	<div class="col_2"><?=$edit['0']?></div>
	<div id="categories_by_manufacturer" class="col_10">
		<div class="col_12">
			<?foreach($document2category as $category):?>
				<div>

					<?if(!empty($category->childs)):?>
						<div style="margin:5px 0; padding-left:17px;">
							<?$ch_counter=1?>
							<?foreach($category->childs as $sub_category):?>
								<div>
									<input type="checkbox" 
										   id="lbl_<?=$ch_counter?>" 
										   class="c-branch-<?=$category->id?>"
										   name="<?=$edit_name?>[]" 
										   value="<?=$sub_category->id?>"
										   onclick="checked_tree('<?=$category->id?>', 'c', 'child');"
										   <?if(in_array($sub_category->id, $content->$edit_name)):?> checked <? endif; ?> 
									/>
									<label for="lbl_<?=$ch_counter?>"><?=$sub_category->name?></label>
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

