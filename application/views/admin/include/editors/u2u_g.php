<div  class="col_12">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>"><?=$edit[0]?></label></div>
	<div class="col_10">
		<table>
			<input type="hidden" name="<?=$edit_name?>" value=""/>
			<?foreach ($selects[$edit_name] as $select): ?>
					<tr>
						<td class="tb_1"><input type="checkbox" name="<?=$edit_name?>[]" <?if(in_array($select->id, $content->users2users_groups)):?>checked<?endif;?> value="<?=$select->id?>"/></td>
						<td class="tb_11"><label for="lbl_<?=$editors_counter?>"><?=$select->name?></label></td>
					</tr>
			<?endforeach;?>	
		</table>
	</div>
</div>