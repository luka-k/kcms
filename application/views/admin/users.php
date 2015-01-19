<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_3 back">
						<div id="left-menu">
							<!--Место для фильтров по пользователям-->
						</div>
					</div>
					<div id="right_col" class="col_9 back">
						<div class="col_12">						
							<h6 class="col_8 left">Редактировать</h6> 
							<div class="col_4 right">
								<a href="<?=base_url()?>admin/users_module/edit/" class="button small">Создать</a>
							</div>			
						</div>
						<table  id="sort" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">&nbsp;</th>

									<?if(isset($images)):?>
										<th class="tb_3">Фотография</th>
										<th class="tb_7">Имя</th>
									<?else:?>
										<th class="tb_9">Имя</th>
									<?endif;?>
									<th class="tb_1">&nbsp;</th>
								</tr>
							</thead>
							<tbody class="sortable">
								<?$counter = 1?>
								<?php foreach ($content as $item): ?>
									<tr id="users-<?=$item->id?>">
										<td class="tb_1"><?=$counter?></td>
										
										<?if(isset($images)):?>
											<td class="tb_3">
												<?if($item->img <> NULL):?>
													<a href="<?=base_url()?>admin/users_module/edit/<?=$item->id?>/edit/"><img src="<?=$item->img->catalog_small_url?>" /></a>
												<?endif;?>
											</td>
											<td class="tb_7"><a href="<?=base_url()?>admin/users_module/edit/<?=$item->id?>/edit/"><?=$item->$name?></a></td>
										<?else:?>
											<td class="tb_7"><a href="<?=base_url()?>admin/users_module/edit/<?=$item->id?>/edit/"><?=$item->$name?></a></td>
										<?endif;?>	
										<td class="tb_3">
											<div class="col_12"><a href="#" onclick="delete_item('<?=base_url()?>', 'users', '<?=$item->id?>', '<?=$item->name?>'); return false;">удалить</a></div>
										</td>
									</tr>
									<?$counter++?>
								<?php endforeach ?>
								
								<?require 'include/delete_popup.php'?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?require 'include/footer_script.php'?>
		<?require 'include/footer.php'?>
	</body>
</html>