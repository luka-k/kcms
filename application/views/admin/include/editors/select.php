<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_3">Категория</label>
	<select id="lbl_<?=$editors_counter?>"  name="<?=$name?>" class="col_8">
		<?php foreach ($selects[$name] as $select): ?>
			<option <?php if(!empty($select->childs)):?>class="option-1-ch"<?else:?>class="option-1"<?endif;?> value="<?=$select->id?>" <?php if ($content->$name == $select->id):?>selected<?php endif; ?><?php if ($content->id == $select->id):?>disabled<?php endif; ?>>
				<?=$select->title?>
			</option>
				<?php if(!empty($select->childs)):?>
					<?php foreach ($select->childs as $select_2): ?>
						<option <?php if(!empty($select_2->childs)):?>class="option-2-ch"<?else:?>class="option-2"<?endif;?> value="<?=$select_2->id?>" <?php if ($content->$name == $select_2->id):?>selected<?php endif; ?><?php if ($content->id == $select_2->id):?>disabled<?php endif; ?>>
							<?=$select_2->title?>
						</option>
						
						<?php if(!empty($select_2->childs)):?>
							<?php foreach ($select_2->childs as $select_3): ?>
								<option <?php if(!empty($select_3->childs)):?>class="option-3-ch"<?else:?>class="option-3"<?endif;?> value="<?=$select_3->id?>" <?php if ($content->$name == $select_3->id):?>selected<?php endif; ?><?php if ($content->id == $select_3->id):?>disabled<?php endif; ?>>
									<?=$select_3->title?>
								</option>
							<?endforeach?>
						<?endif;?>
					<?endforeach?>
				<?endif;?>
		<?php endforeach ?>										
	</select>
</div>