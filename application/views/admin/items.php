﻿<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<?if($type <> "users" && $type <> "slider" && $type <> "video" && $type <> "filials" && $type <> "dealers"):?>
						<div id="left_col" class="col_4 back">
							<div id="left-menu">
								<?require "include/{$type}_tree.php"?>
							</div>
						</div>
					<?endif;?>
					<div id="right_col" class="<?if($type == "users" || $type == "slider" || $type == "video" || $type == "filials" || $type == "dealers"):?>col_12<?else:?>col_8<?endif;?> back">
						<div class="col_12">						
							<h6 class="col_8 left">Редактировать</h6> 
							<div class="col_4 right">
								<a href="<?=base_url()?>admin/content/item/edit/<?=$type?><?if(!empty($parent_id)):?>?parent_id=<?=$parent_id?><?endif;?>" class="button small">Создать</a>
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
									<th class="tb_1">&nbsp;</th>
								</tr>
							</thead>
							<tbody <?if(isset($sortable) || $type == "slider"):?> class="sortable"<?endif?>>
								<?$counter = 1?>
								<?php foreach ($content as $item): ?>
									<tr id="<?=$type?>-<?=$item->id?>">
										<td class="tb_1"><?=$counter?></td>
										
										<?if(isset($images)):?>
											<td class="tb_3">
												<?if($item->img <> NULL):?>
													<a href="<?=base_url()?>admin/content/item/edit/<?=$type?>/<?=$item->id?>"><img src="<?=$item->img->catalog_small_url?>" /></a>
												<?endif;?>
											</td>
											<td class="tb_7"><a href="<?=base_url()?>admin/content/item/edit/<?=$type?>/<?=$item->id?>"><?=$item->$name?></a></td>
										<?else:?>
											<td class="tb_7"><a href="<?=base_url()?>admin/content/item/edit/<?=$type?>/<?=$item->id?>"><?=$item->$name?></a></td>
										<?endif;?>	
										<td class="tb_3">
											<div class="col_12"><a href="#" onclick="delete_item('<?=base_url()?>', '<?=$type?>', '<?=$item->id?>', '<?=$item->name?>'); return false;">удалить</a></div>
											<?if($type == "products"):?>
												<div class="col_2"><input type="checkbox" id="new_<?=$counter?>" onchange="advanced('new', '<?=$item->id?>', this.checked);" <?if($item->is_new == 1):?>checked<?endif;?>/></div>
												<div class="col_10"><label for="new_<?=$counter?>">новинка</label></div>
												<div class="col_2"><input type="checkbox" id="special_<?=$counter?>" onchange="advanced('special', '<?=$item->id?>',  this.checked);" <?if($item->is_good_buy == 1):?>checked<?endif;?>/></div>
												<div class="col_10"><label for="special_<?=$counter?>">выгодное предложение</label></div>
											<?endif;?>
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