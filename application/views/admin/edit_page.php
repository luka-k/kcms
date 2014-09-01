<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="right_col" class="col_12 back">
					<?$count = 1?>
					<ul class="tabs left">
						<?foreach ($editors as $key => $edit):?>
							<li><a href="#tabr<?=$count?>"><?=$key?></a></li>
							<?$count++?>
						<?endforeach?>
					</ul>
					
					<?php $count = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/edit_page/<?=$content->part_url?>"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tabr<?=$count?>" class="clearfix tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<div  class="col_12">
								<a href="<?=base_url()?>admin/pages/<?=$content->part_url?>/" class="btn small">Назад</a>
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
								<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_page/<?=$content->part_url?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
								<a href="#delete" class="btn small lightbox">Удалить</a>
							</div>
							<div id="delete" style="display:none;">
								<div class="pop-up">
									<div>
										Вы точно уверены что хотите удалалить страницу <strong><?=$content->title?></strong>?
									</div><br/>
									<a href="<?=base_url()?>admin/delete_page/<?=$content->part_url?>/<?=$content->id?>" class="button small">Удалить?</a>
									<a href="#" class="button small" onclick="">Нет</a>
									</div>
							</div>
							
								
							<?php $coun = 1?>
							<input type="hidden" name="part_url" value="<?=$content->part_url?>">	
							<?php foreach($edits as $name => $edit):?>
								<?require "include/editors/{$edit[1]}.php"?>
							<?php endforeach?>

							<?if(($content->part_url == "partners")or($content->part_url == "calculator")):?>
								<div class="col_12">
									<div class="col_3">Добавить фотографии</div>
									<div class="col_4"><input type="file" id="pic[]" name="pic" /></div>
								</div>
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
											<?$count = 1?>
											<?foreach($content->img as $img_item):?>
												<tr>
													<td class="tb_1"><?=$count?></td>
													<td class="tb_5"><img src="<?=base_url()?>download/images/catalog_small<?=$img_item->url?>"/></td>
													<td class="tb_2"><input type="radio" name="cover_id" <?if($img_item->is_cover == 1):?>checked<?endif;?> value = "<?=$img_item->id?>"/></td>
													<td class="tb_2"><a href="#delete_img_<?=$img_item->id?>" class="lightbox">Удалить</a></td>
												</tr>
												<div id="delete_img_<?=$img_item->id?>" style="display:none;">
													<div class="pop-up">
														<div>
															Вы точно уверены что хотите удалалить изображение?
															<div style="width:100%; text-align:center; margin:5px 0">
																<img src="<?=base_url()?>download/images/catalog_small<?=$img_item->url?>"/>
															</div>
														</div><br/>
														<a href="<?=base_url()?>admin/delete_img/<?=$content->part_url?>/<?=$img_item->id?>" class="button small">Удалить?</a>
														<a href="#" class="button small" onclick="">Нет</a>
													</div>
												</div>
												<?$count++?>
											<?endforeach?>
										</table>
									</div>
								<?endif;?>
							<?elseif(($content->part_url == "works")):?>
								
									<div class="col_12">
										<div class="col_12">Добавить фотографии</div>
										<div class="col_3">Было</div>
										<div class="col_9"><input type="file" id="pic" name="pic[was]" /></div>
										<div class="col_3">В работе</div>
										<div class="col_9"><input type="file" id="pic" name="pic[in_work]" /></div>
										<div class="col_3">Стало</div>
										<div class="col_9"><input type="file" id="pic" name="pic[result]" /></div>
									</div>					
								<?if(isset($content->img)):?>
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
											<?$count = 1?>											
											<?foreach($content->img as $img_item):?>
												<tr>
													<td class="tb_1"><?=$count?></td>
													<td class="tb_5"><img src="<?=base_url()?>download/images/catalog_small<?=$img_item->url?>"/></td>
													<td class="tb_2"><input type="radio" name="cover_id" <?if($img_item->is_cover == 1):?>checked<?endif;?> value = "<?=$img_item->id?>"/></td>
													<td class="tb_2"><a href="#delete_img_<?=$img_item->id?>" class="lightbox">Удалить</a></td>
												</tr>
												<div id="delete_img_<?=$img_item->id?>" style="display:none;">
													<div class="pop-up">
														<div>
															Вы точно уверены что хотите удалалить изображение?
															<div style="width:100%; text-align:center; margin:5px 0">
																<img src="<?=base_url()?>download/images/catalog_small<?=$img_item->url?>"/>
															</div>
														</div><br/>
														<a href="<?=base_url()?>admin/delete_img/<?=$content->part_url?>/<?=$img_item->id?>" class="button small">Удалить?</a>
														<a href="#" class="button small" onclick="">Нет</a>
													</div>
												</div>
												<?$count++?>
											<?endforeach?>
										</table>
									</div>									
								<?endif;?>
							<?endif;?>
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
								<a href="<?=base_url()?>admin/delete_page/<?=$content->part_url?>/<?=$content->id?>" class="btn small">Удалить</a>
							</div>	
						</div>
						<?$count++?>
					<?endforeach?>
					</form>
					
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>