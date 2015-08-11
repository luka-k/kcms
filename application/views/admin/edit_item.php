<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<?if($type <> "users" && $type <> "settings" && $type <> "slider"):?>
						<div id="left_col" class="col_3 back">
							<div id="left-menu">
								<?require "include/{$type}_tree.php"?>
							</div>
						</div>
					<?endif;?>
					<div id="right_col" class="<?if($type == "users" || $type == "settings" || $type == "slider"):?>col_12<?else:?>col_9<?endif;?> back">
						<?$tab_counter = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
								<?$tab_counter++?>
							<?endforeach?>
						</ul>
					
						<?$tab_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/content/edit_item/<?=$type?>"/>
							<?foreach ($editors as $key => $edits):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<?=$error;?>
									<?=validation_errors(); ?>
									
									<? require 'include/buttons.php' ?>
									
									<!--delete popup-->
									<div id="delete" style="display:none;">
										<div class="pop-up">
											<div>
												Вы точно уверены что хотите удалить - <strong><?=$content->name?></strong>?
											</div><br/>
											<a href="<?=base_url()?>admin/content/delete_item/<?=$type?>/<?=$content->id?>" class="button small">Удалить?</a>
											<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
										</div>
									</div>
														
									<!--editors-->
									<?$editors_counter = 1?>
									<?$tiny_counter = 1?>
									<?foreach($edits as $name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?endforeach?>
									
									<? require 'include/buttons.php' ?>				
								</div>
								<?$tab_counter++?>
							<?endforeach?>
						</form>							
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_script.php' ?>
		<? require 'include/footer.php' ?>
	</body>
</html>