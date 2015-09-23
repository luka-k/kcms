<div class="col_12 clearfix">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>"><?=$edit[0]?></label></div>
	<div class="col_10">
	<select id="field-articles" class="<?=$name?> select_url col_12" name="<?=$name?>" <?if($item_content <> "articles"):?>disabled<?endif;?>>
		<option label="" class="option-1" value="">Выберите содержимое</option>
		
		<?foreach ($selects['parent_id'] as $select):?>
			<option class="option-1 <?if(!empty($select->childs)):?>have_child<?endif;?>" value="<?=$select->url?>" <?php if ($item_content->$name == $select->url):?>selected<?php endif; ?><?php if ($item_content->url == $select->url):?>disabled<?php endif; ?>>
				<?=$select->name?>
			</option>
				<?if(!empty($select->childs)):?>
					<?foreach ($select->childs as $select_2): ?>
						<option class="option-2 <?if(!empty($select_2->childs)):?>have_child<?endif;?>" value="<?=$select_2->url?>" <?php if ($item_content->$name == $select_2->url):?>selected<?php endif; ?><?php if ($item_content->url == $select_2->url):?>disabled<?php endif; ?>>
							<?=$select_2->name?>
						</option>
						
						<?if(!empty($select_2->childs)):?>
							<?foreach ($select_2->childs as $select_3): ?>
								<option  class="option-3 <?if(!empty($select_3->childs)):?>have_child<?endif;?>" value="<?=$select_3->url?>" <?php if ($item_content->$name == $select_3->url):?>selected<?php endif; ?><?php if ($item_content->url == $select_3->url):?>disabled<?php endif; ?>>
									<?=$select_3->name?>
								</option>
							<?endforeach?>
						<?endif;?>
					<?endforeach?>
				<?endif;?>
		<?endforeach;?>
	</select>
	
	<input id="field-link" class="menu_items <?=$name?> select_url col_12" name="<?=$name?>" <?if($item_content <> "link"):?>disabled<?endif;?>/>
	</div>
</div>