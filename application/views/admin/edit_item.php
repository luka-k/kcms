<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<div id="left-menu">
							<?if($type == "products"):?>
								<? require 'include/products_tree.php' ?>
							<?elseif($type == "categories"):?>
								<? require 'include/categories_tree.php' ?>
							<?elseif($type == "parts"):?>
								<? require 'include/parts_tree.php' ?>
							<?else:?>
								<? require 'include/part_pages_tree.php' ?>
							<?endif;?>
						</div>
					</div>
					<div id="right_col" class="col_8 back">
						<?$tab_counter = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
								<?$tab_counter++?>
							<?endforeach?>
							<?if($type <> "parts"):?><li><a href="#tab_<?=$tab_counter?>">Фотографии</a></li><?endif;?>
						</ul>
					
						<?php $tab_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/edit_item/<?=$type?>"/>
							<?php foreach ($editors as $key => $edits):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<?=$error;?>
									<?php echo validation_errors(); ?>
									<div  class="col_12">
										<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
									</div>
									<!--popup on delete-->
									<div id="delete" style="display:none;">
										<div class="pop-up">
											<div>
												Вы точно уверены что хотите удалалить - <strong><?=$content->title?></strong>?
											</div><br/>
											<a href="<?=base_url()?>admin/delete_page/<?=$type?>/<?=$content->id?>" class="button small">Удалить?</a>
											<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
										</div>
									</div>
														
									<!--editors-->
									<?php $editors_counter = 1?>
									<?php foreach($edits as $name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?php endforeach?>
							
									<div  class="col_12">
										<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
									</div>						
								</div>
								<?$tab_counter++?>
							<?endforeach?>
							<?if($type <> "parts"):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">	
									<div  class="col_12">
										<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
									</div>
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
												<?$counter = 1?>
												<?foreach($content->img as $img_item):?>
													<tr>
														<td class="tb_1"><?=$counter?></td>
														<td class="tb_5"><img src="<?=base_url()?>download/images/catalog_small<?=$img_item->url?>"/></td>
														<td class="tb_2"><input type="radio" name="cover_id" <?if($img_item->is_cover == 1):?>checked<?endif;?> value = "<?=$img_item->id?>"/></td>
														<td class="tb_2"><a href="<?=base_url()?>admin/delete_img/products/<?=$img_item->id?>">Удалить</a></td>
													</tr>
													<?$counter++?>
												<?endforeach?>
											</table>
										</div>
									<?endif;?>
									<div  class="col_12">
										<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
									</div>
								</div>
							<?endif;?>
						</form>							
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>