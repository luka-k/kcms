<div  class="col_12 clearfix">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>">Подменю</label></div>
	<div class="col_10">
		<select id="lbl_<?=$editors_counter?>" class="menu_items <?=$name?> col_12" name="<?=$name?>">
			<option <?if ($item_content->$name == 0):?>selected<?php endif;?> value="0">Родительский пункт</option>
			<?foreach ($selects[$name] as $select):?>
				<option class="option-1 <?if(!empty($select->childs)):?>have_child<?endif;?>" value="<?=$select->id?>" <?php if ($item_content->$name == $select->id):?>selected<?php endif; ?><?php if ($item_content->id == $select->id):?>disabled<?php endif; ?>>
					<?=$select->name?>
				</option>
					<?if(!empty($select->childs)):?>
						<?foreach ($select->childs as $select_2): ?>
							<option class="option-2 <?if(!empty($select_2->childs)):?>have_child<?endif;?>" value="<?=$select_2->id?>" <?php if ($item_content->$name == $select_2->id):?>selected<?php endif; ?><?php if ($item_content->id == $select_2->id):?>disabled<?php endif; ?>>
								<?=$select_2->name?>
							</option>
							<?if(!empty($select_2->childs)):?>
								<?foreach ($select_2->childs as $select_3): ?>
									<option class="option-3 <?if(!empty($select_3->childs)):?>have_child<?endif;?>" value="<?=$select_3->id?>" <?php if ($item_content->$name == $select_3->id):?>selected<?php endif; ?><?php if ($item_content->id == $select_3->id):?>disabled<?php endif; ?>>
										<?=$select_3->name?>
									</option>
								<?endforeach?>
							<?endif;?>
						<?endforeach?>
					<?endif;?>
			<?php endforeach ?>										
		</select>
	</div>
</div>