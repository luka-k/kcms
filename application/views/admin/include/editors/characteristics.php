<div class="col_12">
	<div class="col_12"><?=$edit['0']?></div>
	<div class="col_12">
		<div class="col_5">
			<div class="col_5">Характеристика:</div>
			<select name="type" id="ch_select" class="add_ch col_7">
				<option label="" value="">Выберите</option>
				<?foreach($ch_select as $item):?>
					<option value="<?=$item->url?>"><?=$item->name?></option>
				<?endforeach?>
			</select>
		</div>
		<div class="col_6">
			<div class="col_3">Значение:</div>
			<input type="text" id="ch_input" name="value" class="add_ch col_9" onkeypress="autocomp();" value=""/>
		</div>
		<div class="col_1">
			<div class="col_12">
				<input type="hidden" name="object_type" class="add_ch" value="<?=$type?>">
				<input type="hidden" name="object_id" class="add_ch" value="<?=$content->id?>">
				<a href="#" class="button small" onclick="add_ch(); return false;">Добавить</a>
				<!--сделать универсальный скрипт для блокировки кнопки по ка не выбран селект-->
			</div>
		</div>
	</div>
	
	<div class="col_12">
		<table>
			<?foreach($content->characteristics as $characteristic):?>
				<tr id="ch-<?=$characteristic->id?>" class="ch_item">
					<td class="tb_2">
						<?=$characteristic->name?>
					</td>
					<td class="tb_8">
						<input type="text" class="val-<?=$characteristic->id?> col_12" value="<?=$characteristic->value?>" onchange="update_ch('<?=$characteristic->id?>')"/>
					</td>
					<td class="tb_2">
						<a href="#" onclick="delete_ch('<?=base_url()?>', '<?=$characteristic->id?>', '<?=$characteristic->name?>'); return false;">Удалить</a>
					</td>
				</tr>
			<?endforeach;?>
			<tr class="last_ch" >
				<td colspan="3"></td>
			</tr>
			<!--delete popup-->
			<div id="delete_item" style="display:none;">
				<div class="pop-up">
					<div>
						Вы точно уверены что хотите удалалить - <strong id="item_name"></strong>?
					</div><br/>
					<a href="" class="delete_button button small">Удалить?</a>
					<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
				</div>
			</div>
		</table>
	</div>
</div>

