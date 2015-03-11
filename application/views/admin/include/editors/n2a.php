<div  class="col_12">
	<div for="lbl_<?=$editors_counter?>" class="col_3"><?=$edit[0]?></div>
	<div class="col_9">
		<table>
			<input type="hidden" name="<?=$name?>" value=""/>
			<?foreach ($selects[$name] as $select): ?>
					<tr>
						<td class="tb_1"><input type="checkbox" name="<?=$name?>[]" <?foreach($content->parents as $parent):?> <?if($parent->article_parent_id == $select->id):?>checked<?endif;?> <?endforeach;?> value="<?=$select->id?>"/></td>
						<td class="tb_11"><label for="lbl_<?=$editors_counter?>"><?=$select->menu_name?></label></td>
					</tr>
			<?endforeach;?>	
		</table>
	</div>
</div>