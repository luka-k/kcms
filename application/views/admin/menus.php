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
						<h5 class="col_4">Редактировать меню</h5> <div class="col_8 right"><a class="button " href="<?=base_url()?>admin/menu/">Создать меню</a></div>
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th>id</th>
									<th>Имя</th>
									<th>Статус</th>
									<th>Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
							
								<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>
								
									<?php foreach ($menus as $menu): ?>
									<tr>
										<td><?=$menu->id?></td>
										<td><a href="<?=base_url()?>admin/menu/<?=$menu->id?>"><?=$menu->title?></a></td>
										<td><input type="checkbox" id="check_<?=$menu->id?>" name="status_<?=$menu->id?>" value="1" <?php if ($menu->status== 1):?> checked <?php endif;?>/></td>
										<td><a href="<?=base_url()?>admin/delete_menu.html?id=<?=$menu->id?>&fast_edit=true&status="><i class="icon-save icon-2x"></i></a> <a href="<?=base_url()?>admin/delete_menu.html?id=<?=$menu->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
									</tr>
									<?php endforeach ?>
								</form>
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