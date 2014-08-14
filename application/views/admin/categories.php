<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h5>Каталог</h5>
						<div id="left-menu">
							<? require 'include/categories_tree.php' ?>
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
								<?php foreach ($categories as $category): ?>
								<tr>
									<td class="tb_1"><?=$category->id?></td>
									<td class="tb_3">
										<?if($category->img <> NULL):?>
											<a href="<?=base_url()?>admin/cat_page/<?=$category->id?>"><img src="<?=base_url()?>download/images/catalog_small<?=$category->img->url?>" /></a>
										<?endif;?>
									</td>
									<td class="tb_6"><a href="<?=base_url()?>admin/category/<?=$category->id?>"><?=$category->title?></a></td>
									<td class="tb_2"><a href="<?=base_url()?>admin/delete_category/<?=$category->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>