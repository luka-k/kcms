<div  class="col_12">
	<div for="lbl_<?=$editors_counter?>" class="col_2"><?=$edit[0]?></div>
	<input type="hidden" name="<?=$edit_name?>" value="parent">
	<div class="col_10">
		<table>
			<?php foreach ($selects[$edit_name] as $select): ?>
				<?if($select->id <> $content->id):?>
					<tr>
						<td class="tb_1"><input type="checkbox" name="<?=$edit_name?>[]" <?if(in_array($select->id, $content->category2category)):?>checked<?endif;?> value="<?=$select->id?>"/></td>
						<td class="tb_11"><label for="lbl_<?=$editors_counter?>"><?=$select->name?></label></td>
					</tr>
				<?endif;?>
			<?php endforeach ?>	
		</table>
	</div>
</div>