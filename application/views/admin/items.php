<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h6>Разделы</h6>
						<div id="left-menu">
							<?if($type == "products"):?>
								<? require 'include/products_tree.php' ?>
							<?else:?>
								<? require 'include/tree.php' ?>
							<?endif;?>
						</div>
					</div>
					<div id="right_col" class="col_8 back">
						<div class="col_12">						
							<h6 class="col_8 left">Редактировать</h6> 
							<div class="col_4 right">
								<a href="<?=base_url()?>admin/item/<?=$type?>" class="button small lightbox">Создать</a>
							</div>			
						</div>
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">Номер</th>
									<th class="tb_3">Фотография</th>
									<th class="tb_6">Имя</th>
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
								<?$count = 1?>
								<?php foreach ($content as $item): ?>
									<tr>
										<td class="tb_1"><?=$count?></td>
										<td class="tb_3">
											<?if($item->img <> NULL):?>
												<a href="<?=base_url()?>admin/item/<?=$type?>/<?=$item->id?>"><img src="<?=base_url()?>download/images/catalog_small<?=$item->img->url?>" /></a>
											<?endif;?>
										</td>									
										<td class="tb_6"><a href="<?=base_url()?>admin/item/<?=$type?>/<?=$item->id?>"><?=$item->title?></a></td>
										<td class="tb_2"><a href="<?=base_url()?>admin/delete_item/<?=$type?>/<?=$item->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
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