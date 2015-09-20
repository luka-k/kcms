<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="right_col" class="col_12 back">
						<?$tab_counter = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
								<?$tab_counter++?>
							<?endforeach?>
							<?if(in_array("parent", $content->user_groups)):?>
								<li><a href="#tab_<?=$tab_counter?>">Дети</a></li>
							<?endif;?>
						</ul>
					
						<?$tab_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="user_form" action="<?=base_url()?>admin/users_module/edit/save/<?=$content->id?>/"/>
							<?foreach ($editors as $key => $edits):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<?=$error?>
									<?=validation_errors()?>
									<div  class="col_12">
										<a href="<?=base_url()?>admin/users_module/" class="btn small">Назад</a>
										<a href="#" class="btn small" onclick="submit_form('user_form'); return false;">Сохранить</a>
										<a href="#" class="btn small" onclick="document.forms['user_form'].setAttribute('action', '<?=base_url()?>admin/users_module/edit/save/false/exit/'); submit_form('user_form'); return false;">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
									</div>
													
									<!--editors-->
									<?$editors_counter = 1?>
									<?foreach($edits as $edit_name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?endforeach?>
									
									<div  class="col_12">
										<a href="<?=base_url()?>admin/users_module/" class="btn small">Назад</a>
										<a href="#" class="btn small" onclick="submit_form('user_form'); return false;">Сохранить</a>
										<a href="#" class="btn small" onclick="document.forms['user_form'].setAttribute('action', '<?=base_url()?>admin/users_module/edit/save/false/exit/'); submit_form('user_form'); return false;">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
									</div>
								</div>
								
								<!--delete popup-->
								<div id="delete" style="display:none;">
									<div class="pop-up">
										<div>
											Вы точно уверены что хотите удалить - <strong><?=$content->name?></strong>?
										</div><br/>
										<a href="<?=base_url()?>admin/users_module/delete_user/<?=$content->id?>" class="button small">Удалить?</a>
										<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
									</div>
								</div>
								<?$tab_counter++?>
							<?endforeach?>
							<?if(in_array("parent", $content->user_groups)):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<ul class="clearfix" style="list-style:none;">
									<?foreach($content->children as $child):?>
										<li class="col_12">
											<div class="col_1">
												<a href="<?=base_url()?>admin/content/item/edit/child_users/<?=$child->id?>">
													<img src="<?=base_url()?>view_image?id=<?=$child->id?>" alt="<?=$child->full_name?>" style="width:100%;"/>
												</a>
											</div>
											<div class="col_11">
												<a href="<?=base_url()?>admin/content/item/edit/child_users/<?=$child->id?>">
													<?=$child->full_name?>
												</a>
											</div>
										</li>
									<?endforeach;?>
									</ul>
								</div>
							<?endif;?>
						</form>							
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_script.php' ?>
		<? require 'include/footer.php' ?>
	</body>
</html>