<div  class="col_12">
	<div for="lbl_<?=$editors_counter?>" class="col_3"><?=$edit[0]?></div>
	<div class="col_9">
		<table>
			<input type="hidden" name="<?=$edit_name?>" value=""/>
			<?foreach ($selects[$edit_name] as $select): ?>
					<tr>
						<td class="tb_1"><input type="checkbox" name="<?=$edit_name?>[]" <?foreach($content->parents as $parent):?> <?if($parent->group_parent_id == $select->id):?>checked<?endif;?> <?endforeach;?> value="<?=$select->id?>"/></td>
						<td class="tb_11"><label for="lbl_<?=$editors_counter?>"><?=$select->name?></label></td>
					</tr>
			<?endforeach;?>	
		</table>
	</div>
</div>