<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<?if($type <> "users"):?>
						<div id="left_col" class="col_4 back">
							<div id="left-menu">
								<?if($type == "products"):?>
									<? require 'include/products_tree.php' ?>
								<?elseif($type == "categories"):?>
									<? require 'include/categories_tree.php' ?>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
					<div id="right_col" class="<?if($type == "users"):?>col_12<?else:?>col_8<?endif;?> back">
						<div class="col_12">						
							<h6 class="col_8 left">Редактировать</h6> 
							<div class="col_4 right">
								<a href="<?=base_url()?>admin/item/<?=$type?>" class="button small">Создать</a>
							</div>			
						</div>
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
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
							<tbody <?if(isset($sortable)):?> id="sortable"<?endif?>>
								<?$count = 1?>
								<?php foreach ($content as $item): ?>
									<tr id="<?=$type?>-<?=$item->id?>">
										<td class="tb_1"><?=$count?></td>
										
										<?if(isset($images)):?>
											<td class="tb_3">
												<?if($item->img <> NULL):?>
													<a href="<?=base_url()?>admin/item/<?=$type?>/<?=$item->id?>"><img src="<?=$item->img->url?>" /></a>
												<?endif;?>
											</td>
											<td class="tb_7"><a href="<?=base_url()?>admin/item/<?=$type?>/<?=$item->id?>"><?=$item->name?></a></td>
										<?else:?>
											<td class="tb_9"><a href="<?=base_url()?>admin/item/<?=$type?>/<?=$item->id?>"><?=$item->name?></a></td>
										<?endif;?>	
										<td class="tb_1"><a href="#delete-<?=$item->id?>" class="lightbox"><i class="icon-minus-sign icon-2x"></i></a></td>
										<!--popup on delete-->
										<div id="delete-<?=$item->id?>" style="display:none;">
											<div class="pop-up">
												<div>
													Вы точно уверены что хотите удалалить - <strong><?=$item->title?></strong>?
												</div><br/>
												<a href="<?=base_url()?>admin/delete_item/<?=$type?>/<?=$item->id?>" class="button small">Удалить?</a>
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
		<? require 'include/footer_scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>