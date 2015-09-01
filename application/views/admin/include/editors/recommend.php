<div class="col_12">
	<div class="col_12"><?=$edit['0']?></div>
	<div class="col_12">
		<div class="col_10">
			<div class="col_3">Введите название товара:</div>
			<input type="text" id="recommended_input" name="value" class="add_recommended col_9" onkeypress="autocomp_recommended();" value=""/>
		</div>
		<div class="col_2">
			<div class="col_12">
				<input type="hidden" name="object_type" class="add_recommended" value="<?=$type?>">
				<input type="hidden" name="object_id" class="add_recommended" value="<?=$content->id?>">
				<a href="#" class="button small" onclick="add_recommended('<?=$content->id?>'); return false;">Добавить</a>
			</div>
		</div>
	</div>
	
	<div class="col_12">
		<table>
			<?foreach($content->recommended as $r):?>
				<tr id="recommended-<?=$r->id?>" class="recommended_item">
					<td class="tb_10">
						<a href="<?=base_url()?>admin/content/item/edit/products/<?=$r->id?>" class="r_link"><?=$r->name?></a>
					</td>
					<td class="tb_2">
						<a href="#" onclick="delete_recommended('<?=base_url()?>', '<?=$r->id?>', '<?=$r->name?>', '<?=$content->id?>'); return false;">Удалить</a>
					</td>
				</tr>
			<?endforeach;?>
			<tr class="last_recommended" >
				<td colspan="3"></td>
			</tr>
			<!--delete popup-->
			<div id="delete_item" style="display:none;">
				<div class="pop-up">
					<div>
						Вы точно уверены что хотите удалить - <strong id="item_name"></strong>?
					</div><br/>
					<a href="" class="delete_button button small">Удалить?</a>
					<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
				</div>
			</div>
		</table>
	</div>
</div>

