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
							<? require 'tree.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_9 back">
						<ul class="tabs left">
							<li><a href="#tabr1">Основное</a></li>
							<?php if ($links<>NULL):?><li><a href="#tabr2">Ссылки</a></li><?php endif; ?>
						</ul>

						<div id="tabr1" class="tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_menu"/>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<input type="hidden" name="id" value="<?=$menu->id?>"/>	
								
								<div  class="col_12">
									<label for="text_1" class="col_2">Имя меню</label>
									<input type="text" id="text_1" class="col_9" name="name" value="<?=$menu->name?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="text_2" class="col_2">Название</label>
									<input type="text" id="text_2" class="col_9" name="title" value="<?=$menu->title?>"/><br/>
								</div>
																	
								<div  class="col_12">
									<div  class="col_2">
										<label for="textarea1">Настройки отображения</label>
									</div>
									<div  class="col_10">
										<input type="checkbox" name ="status" id="check_1" value="1" <?php if ($menu->status == 1):?> checked <?php endif; ?>/>
										<label for="check_1" class="inline col_2">Активен</label><br/>
									</div>								
								</div>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
							</form>
						</div>
						<?php if ($links<>NULL):?>
						<div id="tabr2" class="tab-content">
							<div id="right_col" class="col_12 back">
								<h5 class="col_4">Редактировать ссылки</h5> <div class="col_8 right"><a class="button " href="<?=base_url()?>admin/link/<?=$menu->id?>/0">Создать пункт</a></div>
								<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
									<thead>
										<tr>
											<th>id</th>
											<th>Имя</th>
											<th>Не активен</th>
											<th>Действие</th>
										</tr>
									</thead>
									<tbody id="sortable">
							
										<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>
								
											<?php foreach ($links as $link): ?>
											<tr>
												<td><?=$link->id?></td>
												<td><a href="<?=base_url()?>admin/link/<?=$menu->id?>/<?=$link->id?>"><?=$link->title?></a></td>
												<td><input type="checkbox" id="check_<?=$link->id?>" name="status_<?=$link->id?>" value="1" <?php if ($link->hidden== 1):?> checked <?php endif;?>/></td>
												<td><a href="<?=base_url()?>admin/edit_link.html/<?=$menu->id?>/<?=$link->id?>&fast_edit=true&status="><i class="icon-save icon-2x"></i></a> <a href="<?=base_url()?>admin/delete_link/<?=$menu->id?>/<?=$link->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
											</tr>
											<?php endforeach ?>
										</form>
									</tbody>
								</table>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer-scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>