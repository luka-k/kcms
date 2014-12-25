<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<?require 'include/top_menu.php'?>
				<div  class="col_12 clearfix">

					<div id="right_col" class="col_12 back">
						<div class="col_12">						
							<h6 class="col_8 left">Редактировать</h6> 
							<div class="col_4 right">
								<a href="<?=base_url()?>admin/menu_module/menu/" class="button small">Создать</a>
							</div>			
						</div>
						<table  id="sort" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">Номер</th>

									<?if(isset($images)):?>
										<th class="tb_3">Фотография</th>
										<th class="tb_7">Имя</th>
									<?else:?>
										<th class="tb_9">Имя</th>
									<?endif;?>
									<th class="tb_1">Действие</th>
								</tr>
							</thead>
							<tbody>
								<?$count = 1?>
								<?php foreach ($content as $item): ?>
									<tr>
										<td class="tb_1"><?=$count?></td>
										
										<?if(isset($images)):?>
											<td class="tb_3">
												<?if($item->img <> NULL):?>
													<a href="<?=base_url()?>admin/menu_module/menu/<?=$item->id?>"><img src="<?=$item->img->url?>" /></a>
												<?endif;?>
											</td>
											<td class="tb_7"><a href="<?=base_url()?>admin/menu_module/menu/<?=$item->id?>"><?=$item->$name?></a></td>
										<?else:?>
											<td class="tb_9"><a href="<?=base_url()?>admin/menu_module/menu/<?=$item->id?>"><?=$item->$name?></a></td>
										<?endif;?>	
										<td class="tb_1"><a href="#delete-<?=$item->id?>" class="lightbox"><i class="icon-minus-sign icon-2x"></i></a></td>
										<!--popup on delete-->
										<div id="delete-<?=$item->id?>" style="display:none;">
											<div class="pop-up">
												<div>
													Вы точно уверены что хотите удалалить - <strong><?=$item->$name?></strong>?
												</div><br/>
												<a href="<?=base_url()?>admin/menu_module/delete_menu/<?=$item->id?>" class="button small">Удалить?</a>
												<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
											</div>
										</div>
									</tr>
									<?$count++?>
								<?php endforeach ?>
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