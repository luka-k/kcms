<div class="col_12">
	<div class="col_12"><?=$edit['0']?></div>
	<div class="clearfix">
		<select name="type" id="ch_select" class="add_ch col_4" onfocus="$(this).removeClass('error')">
			<option label="" value="">Характеристика:</option>
			<?foreach($ch_select as $item):?>
				<option value="<?=$item->url?>"><?=$item->name?></option>
			<?endforeach?>
		</select>
		
		<input type="text" 
			   id="ch_input" 
			   name="value" 
			   class="add_ch col_6 small" 
			   onkeypress="autocomp();" 
			   onfocus="$(this).removeClass('error')"
			   value="" placeholder="Значение" 
			   style="margin-top:5px; height:28px; font-size:12px;"
		/>
		
		<input type="hidden" name="object_type" class="add_ch" value="<?=$type?>">
		<input type="hidden" name="object_id" class="add_ch" value="<?=$content->id?>">
		<a href="#" class="button small" onclick="add_characteristic(); return false;" style="margin-top:5px; height:28px; padding-top:6px;">Добавить</a>
	</div>
	
	<div class="col_12">
		<table>
			<?foreach($content->characteristics as $characteristic):?>
				<?require 'characteristic_item.php'?>
			<?endforeach;?>
			<tr class="last_ch" >
				<td colspan="3"></td>
			</tr>
			<!--delete popup-->
			<div id="delete_characteristic" style="display:none;">
				<div class="pop-up">
					<div>
						Вы точно уверены что хотите удалить - <strong id="item_name"></strong>?
					</div><br/>
					<input type="hidden" id="delete_ch_id" name="ch_id" value=""/>
					<input type="hidden" id="ch_object_id" name="item_id" value=""/>
					<a href="#" class="delete_button button small" onclick="delete_characteristic(); return false;">Удалить?</a>
					<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
				</div>
			</div>
		</table>
	</div>
</div>

