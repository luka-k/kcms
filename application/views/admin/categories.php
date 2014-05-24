<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_3 back">
						<h5>Категории</h5>
						<div id="left-menu">
							<?=$this->menu_model->menu(0)?>
						</div>
					</div>
					<div id="right_col" class="col_9 back">
						<h5 class="col_4">Редактировать категории</h5> <div class="col_8 right"><a class="button " href="<?=base_url()?>admin/category/">Создать новую</a></div>
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th>Номер</th>
									<th>Имя</th>
									<th>Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
								<?php foreach ($cat as $cat_item): ?>
								<tr>
									<td><?=$cat_item->id?></td>
									<td><a href="<?=base_url()?>admin/category/<?=$cat_item->id?>"><?=$cat_item->title?></a></td>
									<td><a href="#"><i class="icon-save icon-2x"></i></a> <a href="<?=base_url()?>admin/delete_cat/<?=$cat_item->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
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