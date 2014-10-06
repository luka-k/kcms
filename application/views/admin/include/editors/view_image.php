<input type="hidden" name="view_image" value="view_image"/>
<?if($content->img <> NULL):?>
	<div class="col_12">
		<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
			<thead>
				<tr>
					<th class="tb_1">№</th>
					<th class="tb_9">Изображение</th>
					<th>Обложка</th>
					<th class="tb_2">Действие</th>
				</tr>
			</thead>
			<tbody>
				<?$counter = 1?>
				<?foreach($content->img as $img_item):?>
					<tr>
						<td class="tb_1"><?=$counter?></td>
						<td class="tb_5"><img src="<?=base_url()?>download/images/catalog_small<?=$img_item->url?>"/></td>
						<td class="tb_2"><input type="radio" name="cover_id" <?if($img_item->is_cover == 1):?>checked<?endif;?> value = "<?=$img_item->id?>"/></td>
						<td class="tb_2"><a href="<?=base_url()?>admin/delete_img/<?=$type?>/<?=$img_item->id?>">Удалить</a></td>
					</tr>
					<?$counter++?>
				<?endforeach?>
			</tbody>
		</table>
	</div>
<?endif;?>