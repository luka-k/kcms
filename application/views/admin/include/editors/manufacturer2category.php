<div  class="col_12">
	<div class="col_2"><?=$edit['0']?></div>
	<div class="col_10" style="height:250px; overflow-y:scroll;">
		<div class="col_12">
			<?foreach($selects['category_parent_id'] as $category):?>
				<div>
					<input type="checkbox" 
						   id="<?=$edit_name?>-fork-<?=$category->id?>"
						   class="<?=$edit_name?>-<?=$category->id?>"						   
						   name="<?=$edit_name?>[]"
						   value="<?=$category->id?>"`
						   onclick="checked_tree('<?=$category->id?>', '<?=$edit_name?>', 'fork');"
						   <?if(in_array($category->id, $content->$edit_name)):?> checked <? endif; ?>"
					/>
					<label for="c_<?=$category->id?>"><?=$category->name?></label>
					<?if(!empty($category->childs)):?>
						<div style="margin:5px 0; padding-left:17px;">
							<?$ch_counter=1?>
							<?foreach($category->childs as $sub_category):?>
								<div>
									<input type="checkbox" 
										   id="lbl_<?=$ch_counter?>" 
										   class="<?=$edit_name?>-branch-<?=$category->id?>"
										   name="<?=$edit_name?>[]" 
										   value="<?=$sub_category->id?>"
										   onclick="checked_tree('<?=$category->id?>', '<?=$edit_name?>', 'child');"
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

