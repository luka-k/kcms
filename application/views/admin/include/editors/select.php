<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_3"><?=$edit[0]?></label>
	<select id="lbl_<?=$editors_counter?>"  name="<?=$name?>" class="col_8">
		<option value="0">Без категории</option>
		<?php foreach ($selects[$name] as $select): ?>
			<option <?php if(!empty($select->childs)):?>class="option-1-ch"<?else:?>class="option-1"<?endif;?> value="<?=$select->id?>">
				<?=$select->name?>
			</option>
				<?php if(!empty($select->childs)):?>
					<?php foreach ($select->childs as $select_2): ?>
						<option <?php if(!empty($select_2->childs)):?>class="option-2-ch"<?else:?>class="option-2"<?endif;?> value="<?=$select_2->id?>">
							<?=$select_2->name?>
						</option>
					<?endforeach?>
				<?endif;?>
		<?php endforeach ?>										
	</select>
</div>