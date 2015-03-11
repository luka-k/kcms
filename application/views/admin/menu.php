<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<?require 'include/top_menu.php'?>
				<div  class="col_12 clearfix">

					<div id="left_col" class="<?if($content->id):?>col_6<?else:?>col_12<?endif;?> back">
						
						<?$tab_counter = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
								<?$tab_counter++?>
							<?endforeach?>
						</ul>
					
						<?php $tab_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="menu_edit" action="<?=base_url()?>admin/menu_module/menu/save/"/>
							<?php foreach ($editors as $key => $edits):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<div class="col_12">
										<a href="<?=base_url()?>admin/menu_module/menus/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['menu_edit'].submit()">Сохранить</a>
									</div>
									<?=$error;?>

									<!--popup on delete-->
									<div id="delete" style="display:none;">
										<div class="pop-up">
											<div>
												Вы точно уверены что хотите удалалить - <strong><?=$content->name?></strong>?
											</div><br/>
											<a href="<?=base_url()?>admin/menu_module/delete_menu/<?=$content->id?>" class="button small">Удалить?</a>
											<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
										</div>
									</div>
														
									<!--editors-->
									<?php $editors_counter = 1?>
									<?php foreach($edits as $name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?php endforeach?>
									<div class="col_12">
										<a href="<?=base_url()?>admin/menu_module/menus/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['menu_edit'].submit()">Сохранить</a>
									</div>
								</div>
								<?$tab_counter++?>
							<?endforeach?>
						</form>							
					</div>
					
					<?if($content->id):?>
						<div id="right_col" class="col_6 back">
							<div class="col_12">						
								<h6 class="col_8 left" onclick="ok()">Пункты меню</h6> 
								<div class="col_4 right">
									<a href="#" onclick="item_info(''); return false;" class="button small">Создать</a>
								</div>
							</div>
							<div style="color:red"><?=$items_error?></div>
							<div id="menu_items">
								<?if(isset($menu_items)):?>
									<ul class="menu-items sortable">
										<?foreach($menu_items as $item):?>
											<li id="menus_items-<?=$item->id?>" <?if(!empty($item->childs)):?> class="down" <?endif;?>><span class="item-name-<?=$item->id?>"><?=$item->name?></span>
												<a href="#" onclick="item_info('<?=$item->id?>'); return false;"><i class="icon-pencil icon-large"></i></a>
												<a href="#" onclick="delete_menu_item('<?=base_url()?>', '<?=$item->id?>', '<?=$item->name?>'); return false;"><i class="icon-minus-sign icon-large"></i></a>
												<?if(!empty($item->childs)):?>
													<ul class="sortable">
														<?foreach($item->childs as $item_2):?>
															<li id="menus_items-<?=$item_2->id?>" <?if(!empty($item_2->childs)):?> class="down" <?endif;?> ><span class="item-name-<?=$item_2->id?>"><?=$item_2->name?></span>
																<a href="#" onclick="item_info('<?=$item_2->id?>'); return false;"><i class="icon-pencil icon-large"></i></a>
																<a href="#" onclick="delete_menu_item('<?=base_url()?>', '<?=$item_2->id?>', '<?=$item_2->name?>'); return false;"><i class="icon-minus-sign icon-large"></i></a>
																<?if(!empty($item_2->childs)):?>
																	<ul class="sortable">
																		<?foreach($item_2->childs as $item_3):?>
																			<li id="menus_items-<?=$item_3->id?>"><span class="item-name-<?=$item_3->id?>"><?=$item_3->name?></span>
																				<a href="#" onclick="item_info('<?=$item_3->id?>'); return false;"><i class="icon-pencil icon-large"></i></a>
																				<a href="#" onclick="delete_menu_item('<?=base_url()?>', '<?=$item_3->id?>', '<?=$item_3->name?>'); return false;"><i class="icon-minus-sign icon-large"></i></a>
																			</li>
																		<?endforeach;?>
																	</ul>
																<?endif;?>
															</li>
														<?endforeach;?>
													</ul>
												<?endif;?>
											</li>
										<?endforeach;?>
									</ul>
								<?endif;?>
							</div>
							
							<div id="item_info" style="display:none;">
								<div class="pop-up">
									<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="edit_item" class="edit_item" action="<?=base_url()?>admin/menu_module/menu/save_item/<?=$content->id?>">
										<a href="#" class="btn small" onclick="document.forms['edit_item'].submit()">Сохранить</a>
										<div style="margin-top:5px; color:red;">
											<span id="validation_error"></span>
										</div>
										<?foreach($items_editors as $item_editors):?>
											<?$editors_counter = 1?>
											<?foreach($item_editors as $name => $edit):?>
												<?require "include/menu_editors/{$edit[1]}.php"?>
												<?$editors_counter++?>
											<?endforeach;?>
										<?endforeach;?>
									</form>
								</div>
							</div>
							
							<?require 'include/delete_popup.php'?>
							
						</div>
					<?endif;?>
				</div>
			</div>
		</div>
		<?require 'include/menu_script.php'?>
		<?require 'include/footer_script.php'?>
		<?require 'include/footer.php'?>
	</body>
</html>