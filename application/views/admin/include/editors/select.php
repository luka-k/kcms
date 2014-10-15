<div  class="col_12">
	<div for="lbl_<?=$editors_counter?>" class="col_3"><?=$edit[0]?></div>
	<div class="col_9">
		<table>
			<tr style="display:none;">
				<td class="tb_1"><input type="checkbox" name="<?=$name?>[]" <?foreach($content->parent_id as $parent_id):?> <?if($parent_id == 0):?>checked<?endif;?> <?endforeach;?> value="0"/></td>
				<td class="tb_11"><label for="lbl_<?=$editors_counter?>">Без категории</label></td>
			</tr>
			<?php foreach ($selects[$name] as $select): ?>
				<?if($select->id <> $content->id):?>
					<tr>
						<td class="tb_1"><input type="checkbox" name="<?=$name?>[]" <?foreach($content->parent_id as $parent_id):?> <?if($parent_id == $select->id):?>checked<?endif;?> <?endforeach;?> value="<?=$select->id?>"/></td>
						<td class="tb_11"><label for="lbl_<?=$editors_counter?>"><?=$select->name?></label></td>
					</tr>
				<?endif;?>
			<?php endforeach ?>	
		</table>
	</div>
</div>