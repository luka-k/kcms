<tr id="ch-<?=$characteristic->id?>" class="ch_item">
	<td class="tb_2">
		<?=$characteristic->name?>
	</td>
	<td class="tb_8">
		<input type="text" class="val-<?=$characteristic->id?> col_12" value="<?=$characteristic->value?>" onchange="update_ch('<?=$characteristic->id?>')"/>
	</td>
	<td class="tb_2">
		<a href="#" onclick="delete_characteristic_popup('<?=$characteristic->id?>', '<?=$characteristic->name?>', '<?=$characteristic->value?>'); return false;">Удалить</a>
	</td>
</tr>