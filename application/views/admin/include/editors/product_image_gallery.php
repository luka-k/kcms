<div class="col_12">
	<div class="col_3">Добавить фотографии</div>
	<div class="col_4"><input type="file" id="<?=$edit_name?>" multiple name="<?=$edit_name?>[]" /></div>
	<input type="hidden" name="upload_image" value="upload_image"/> или <input type="text" placeholder="код на youtube" name="upload_youtube" />
</div>
<?if($content->img <> NULL):?>
	<div class="col_12">
		<input type="hidden" name="view_image" value="view_image"/>
		<table  id="sort" class="nosortable" cellspacing="2" cellpadding="2" >
			<thead>
				<tr>
					<th class="tb_1">№</th>
					<th class="tb_3">Изображение</th>
					<th class="tb_4">Привязка к категории</th>
					<th class="tb_2">Обложка</th>
					<th class="tb_2">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?$counter = 1?>
				<?foreach($content->img as $img_item):?>
					<tr>
						<td class="tb_1"><?=$counter?></td>
						<td class="tb_3">
							<img src="<?=$img_item->catalog_small_url?>"/><br><? $_url = explode('/', $img_item->catalog_small_url); echo $_url[count($_url)-1];?><br><?= floor(filesize('download/images'.$img_item->url) / 1000); ?> Кб<br>
					название: <input type="text" class="col_12" name="" value="<?=$img_item->name?>" onchange="rename_image('<?=$img_item->id?>', this.value)"/><br>
					подпись: <input type="text" class="col_12" name="" value="<?=$img_item->caption?>" onchange="recaption_image('<?=$img_item->id?>', this.value)"/>
							<input type="hidden" name="img_ids[]" value="<?=$img_item->id?>"/>
						</td>
						<td class="tb_4">
							 <a href="" onclick="$('.showHideCategories<?=$counter?>').toggle(); return false;">вкл/выкл</a><br><br>
							<div class="showHideCategories<?=$counter?>" style="display: none;">
							<?$counter_category = 1?>
							<?foreach($producttree[1]->childs as $t):?>
								<?if($t->url <> "obekty"):?>
									<input type="checkbox" id="lbl-<?=$counter_category?>" name="img2cat[<?=$img_item->id?>-<?=$counter_category?>]" <?if(isset($img_item->img_categories)):?><?if(in_array($t->id, $img_item->img_categories)):?>checked<?endif;?><?endif;?> value="<?=$t->id?>"/> 
									<label for="lbl-<?=$counter_category?>"><?=$t->name?></label></br>
									<?if($t->childs):?>
										<?foreach($t->childs as $t_2):?>
											<input type="checkbox" id="lbl-<?=$counter_category?>" name="img2cat[<?=$img_item->id?>-<?=$counter_category?>]" <?if(isset($img_item->img_categories)):?><?if(in_array($t_2->id, $img_item->img_categories)):?>checked<?endif;?><?endif;?> value="<?=$t_2->id?>"/> 
											<label for="lbl-<?=$counter_category?>">&bull; <?=$t_2->name?></label></br>
											<?$counter_category++?>
										<?endforeach;?>
									<?endif;?>
									<?$counter_category++?>
								<?endif;?>
							<?endforeach;?>
							</div>
						</td>
						<td class="tb_2"><input type="radio" name="cover_id" <?if($img_item->is_cover == 1):?>checked<?endif;?> value = "<?=$img_item->id?>"/></td>
						<td class="tb_2">
							<input type="checkbox" name="img_del[<?=$img_item->id?>]" /> <a href="#delete-<?=$img_item->id?>" class="lightbox">Удалить</a><br/><br/>
							<input type="checkbox" id="lbl-<?=$counter?>" name="is_main[<?=$img_item->id?>]" <?if($img_item->is_main == 1):?>checked<?endif;?> value = "1"/> 
							<label for="lbl-<?=$counter?>">В галерее</label>
						</td>
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