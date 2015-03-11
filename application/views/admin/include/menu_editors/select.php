<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_3">Подменю</label>
	<select id="lbl_<?=$editors_counter?>" class="menu_items <?=$name?>" name="<?=$name?>" class="col_8">
		<option <?if ($item_content->$name == 0):?>selected<?php endif;?> value="0">Родительский пункт</option>
		<?foreach ($selects[$name] as $select):?>
			<option <?if(!empty($select->childs)):?>class="option-1-ch"<?else:?>class="option-1"<?endif;?> value="<?=$select->id?>" <?php if ($item_content->$name == $select->id):?>selected<?php endif; ?><?php if ($item_content->id == $select->id):?>disabled<?php endif; ?>>
				<?=$select->name?>
			</option>
				<?if(!empty($select->childs)):?>
					<?foreach ($select->childs as $select_2): ?>
						<option <?if(!empty($select_2->childs)):?>class="option-2-ch"<?else:?>class="option-2"<?endif;?> value="<?=$select_2->id?>" <?php if ($item_content->$name == $select_2->id):?>selected<?php endif; ?><?php if ($item_content->id == $select_2->id):?>disabled<?php endif; ?>>
							<?=$select_2->name?>
						</option>
						
						<?if(!empty($select_2->childs)):?>
							<?foreach ($select_2->childs as $select_3): ?>
								<option <?php if(!empty($select_3->childs)):?>class="option-3-ch"<?else:?>class="option-3"<?endif;?> value="<?=$select_3->id?>" <?php if ($item_content->$name == $select_3->id):?>selected<?php endif; ?><?php if ($item_content->id == $select_3->id):?>disabled<?php endif; ?>>
									<?=$select_3->name?>
								</option>
							<?endforeach?>
						<?endif;?>
					<?endforeach?>
				<?endif;?>
		<?php endforeach ?>										
	</select>
</div>