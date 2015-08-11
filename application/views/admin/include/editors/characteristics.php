<div class="col_12">
	<div class="col_12"><?=$edit['0']?></div>
	<div class="col_12">
		<div class="col_5">
			Характеристика:
			<select name="type" class="add_ch">
				<option label="" value="">Выберите</option>
				<?foreach($ch_select as $key => $item):?>
					<option value="<?=$key?>"><?=$item?></option>
				<?endforeach?>
			</select>
		</div>
		<div class="col_5">
			Значение:
			<input type="text" name="value" class="add_ch" value=""/>
		</div>
		<div class="col_2">
			<input type="hidden" name="object_type" class="add_ch" value="<?=$type?>">
			<input type="hidden" name="object_id" class="add_ch" value="<?=$content->id?>">
			<a href="#" class="button small" onclick="add_ch(); return false;">Добавить</a>
		</div>
	</div>
	
	<div class="col_12">
		<table>
			<?foreach($content->characteristics as $characteristic):?>
				<tr id="ch-<?=$characteristic->id?>" class="ch_item">
					<td>
						<?=$characteristic->name?>
					</td>
					<td>
						<input type="text" class="val-<?=$characteristic->id?>" value="<?=$characteristic->value?>" onchange="update_ch('<?=$characteristic->id?>')"/>
					</td>
					<td>
						<a href="#" onclick="delete_ch('<?=base_url()?>', '<?=$characteristic->id?>', '<?=$characteristic->name?>'); return false;">Удалить</a>
					</td>
				</tr>
			<?endforeach;?>
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