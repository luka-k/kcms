<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<?if($type <> "users_groups" && $type <> "slider"):?>
						<div id="left_col" class="col_4 back">
							<div id="left-menu">
									<?require "include/{$type}_tree.php"?>
							</div>
						</div>
					<?endif;?>
					<div id="right_col" class="<?if($type == "users_groups" || $type == "slider"):?>col_12<?else:?>col_8<?endif;?> back">
						<div class="col_12">						
							<h6 class="col_8 left">Редактировать</h6> 
							<div class="col_4 right">
								<a href="<?=base_url()?>admin/content/item/<?=$type?><?if(!empty($parent_id)):?>?parent_id=<?=$parent_id?><?endif;?>" class="button small">Создать</a>
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
							<tbody <?if(isset($sortable)||$type == "slider"):?> id="sortable"<?endif?>>
								<?$count = 1?>
								<?php foreach ($content as $item): ?>
									<tr id="<?=$type?>-<?=$item->id?>">
										<td class="tb_1"><?=$count?></td>
										
										<?if(isset($images)):?>
											<td class="tb_3">
												<?if($item->img <> NULL):?>
													<a href="<?=base_url()?>admin/content/item/<?=$type?>/<?=$item->id?>"><img src="<?=$item->img->url?>" width="80px"/></a>
												<?endif;?>
											</td>
											<td class="tb_7"><a href="<?=base_url()?>admin/content/item/<?=$type?>/<?=$item->id?>"><?=$item->$name?></a></td>
										<?else:?>
											<td class="tb_9"><a href="<?=base_url()?>admin/content/item/<?=$type?>/<?=$item->id?>"><?=$item->$name?></a></td>
										<?endif;?>	
										<td class="tb_1"><a href="#" onclick="delete_item('<?=base_url()?>', '<?=$type?>', '<?=$item->id?>', '<?=$item->$name?>'); return false;"><i class="icon-minus-sign icon-2x"></i></a></td>
									</tr>
									<?$count++?>
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