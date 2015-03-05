<?if(empty($content->img)):?>
	<div class="col_12 clearfix">
		<div class="col_2">Добавить фотографии</div>
		<div class="col_4"><input type="file" id="<?=$edit_name?>[]" name="<?=$edit_name?>" /></div>
		<input type="hidden" name="upload_image" value="upload_image"/>
	</div>
<?else:?>
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
						<td class="tb_5"><img src="<?=$img_item->catalog_small_url?>"/></td>
						<td class="tb_2"><input type="radio" name="cover_id" <?if($img_item->is_cover == 1):?>checked<?endif;?> value = "<?=$img_item->id?>"/></td>
						<td class="tb_2"><a href="#delete-img" class="lightbox">Удалить</a></td>
						<!--popup on delete-->
							<div id="delete-img" style="display:none;">
								<div class="pop-up">
									<div>
										Вы точно уверены что хотите удалить изображение?
									</div><br/>
									<?if($type == "dynamic_menus"):?>
										<a href="<?=base_url()?>menu_module/delete_img/<?=$img_item->id?>" class="button small">Удалить?</a>
									<?else:?>
										<a href="<?=base_url()?>admin/content/delete_img/<?=$type?>/<?=$img_item->id?>" class="button small">Удалить?</a>
									<?endif;?>
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