<div class="col_12">
	<?foreach($category_by_manufacturer as $category):?>
		<div>
			<input type="checkbox" 
				   id="c-fork-<?=$category->id?>"
				   class="c-<?=$category->id?>"						   
				   name="category_id[]"
				   value="<?=$category->id?>"`
				   onclick="checked_tree('<?=$category->id?>', 'c', 'fork');"
			/>
			<label for="c_<?=$category->id?>"><?=$category->name?></label>
			<?if(!empty($category->childs)):?>
				<div style="margin:5px 0; padding-left:17px;">
					<?$ch_counter=1?>
					<?foreach($category->childs as $sub_category):?>
						<div>
							<input type="checkbox" 
								   id="lbl_<?=$ch_counter?>" 
								   class="c-branch-<?=$category->id?>"
								   name="category_id[]" 
								   value="<?=$sub_category->id?>"
								   onclick="checked_tree('<?=$category->id?>', 'c', 'child');"
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