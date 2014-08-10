<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h5>Каталог</h5>
						<div id="left-menu">
							<? require 'include/categories-tree.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_8 back">
						<h5 class="col_8">Редактировать каталог</h5> <div class="col_4 right"><a class="button small" href="<?=base_url()?>admin/category/">Создать новый</a></div>
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">id</th>
									<th class="tb_3">Фотография</th>
									<th class="tb_6">Имя</th>
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
								<?php foreach ($cat as $cat_item): ?>
								<tr>
									<td class="tb_1"><?=$cat_item->id?></td>
									<td class="tb_3">
										<?if($cat_item->img <> NULL):?>
											<a href="<?=base_url()?>admin/cat_page/<?=$cat_item->id?>"><img src="<?=base_url()?>download/images/catalog_small<?=$cat_item->img->url?>" /></a>
										<?endif;?>
									</td>
									<td class="tb_6"><a href="<?=base_url()?>admin/category/<?=$cat_item->id?>"><?=$cat_item->title?></a></td>
									<td class="tb_2"><!--<a href="#"><i class="icon-save icon-2x"></i></a>--> <a href="<?=base_url()?>admin/delete_cat/<?=$cat_item->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer-scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>