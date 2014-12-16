﻿<div class="col_12">
	<div class="col_3">Добавить фотографии</div>
	<div class="col_4"><input type="file" id="pic[]" name="<?=$name?>" /></div>
	<input type="hidden" name="upload_image" value="upload_image"/>
</div>

<?if($content->img <> NULL):?>
	<div class="col_12">
		<input type="hidden" name="view_image" value="view_image"/>
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
						<td class="tb_5"><img src="<?=$img_item->url?>"/></td>
						<td class="tb_2"><input type="radio" name="cover_id" <?if($img_item->is_cover == 1):?>checked<?endif;?> value = "<?=$img_item->id?>"/></td>
						<td class="tb_2"><a href="#delete-<?=$img_item->id?>" class="lightbox">Удалить</a></td>
						<!--popup on delete-->
							<div id="delete-<?=$img_item->id?>" style="display:none;">
								<div class="pop-up">
									<div>
										Вы точно уверены что хотите удалить изображение?
									</div><br/>
									<a href="<?=base_url()?>admin/content/delete_img/<?=$type?>/<?=$img_item->id?>" class="button small">Удалить?</a>
									<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
								</div>
							</div>
					</tr>
					<?$counter++?>
				<?endforeach?>
			</tbody>
		</table>
	</div>
<?endif;?>