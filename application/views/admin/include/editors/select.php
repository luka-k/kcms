<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_3"><?=$edit[0]?></label>
	<select id="lbl_<?=$editors_counter?>"  name="<?=$edit_name?>" class="col_8">
		<option <?if ($content->$edit_name == 0):?>selected<?endif;?> value="0">Без категории</option>
		<?php foreach ($selects[$edit_name] as $select): ?>
			<option <?if(!empty($select->childs)):?>class="option-1-ch"<?else:?>class="option-1"<?endif;?> value="<?=$select->id?>" <?if ($content->$edit_name == $select->id):?>selected<?endif;?><?if(isset($select->disabled)):?>disabled<?endif;?>>
				<?=$select->name?>
			</option>
				<?if(!empty($select->childs)):?>
					<?foreach($select->childs as $select_2): ?>
						<option <?if(!empty($select_2->childs)):?>class="option-2-ch"<?else:?>class="option-2"<?endif;?> value="<?=$select_2->id?>" <?if($content->$edit_name == $select_2->id):?>selected<?endif;?><?if(isset($select_2->disabled)):?>disabled<?endif;?>>
							<?=$select_2->name?>
						</option>
						<?if(!empty($select_2->childs)):?>
							<?foreach($select_2->childs as $select_3): ?>
								<option <?if(!empty($select_3->childs)):?>class="option-3-ch"<?else:?>class="option-3"<?endif;?> value="<?=$select_3->id?>" <?if($content->$edit_name == $select_3->id):?>selected<?endif;?><?if(isset($select_3->disabled)):?>disabled<?endif;?>>
									<?=$select_3->name?>
								</option>
							<?endforeach;?>
						<?endif;?>
					<?endforeach;?>
				<?endif;?>
		<?endforeach;?>										
	</select>
</div>