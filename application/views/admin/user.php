﻿<!DOCTYPE html>
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
						</ul>
					
						<?$tab_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="user_form" action="<?=base_url()?>admin/users_module/edit/<?=$user_id?>/save/"/>
							<?foreach ($editors as $key => $edits):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<?=$error?>
									<?=validation_errors()?>
									
									<div  class="col_12">
										<a href="<?=base_url()?>admin/users_module/" class="btn small">Назад</a>
										<a href="#" class="btn small" onclick="document.forms['user_form'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['user_form'].setAttribute('action', '<?=base_url()?>admin/users_module/edit/<?=$user_id?>/save/exit'); document.forms['user_form'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
										<?if((!empty($content->id))):?>
											<a href="<?=base_url()?>registration/reset_password.html?email=<?=$content->email?>&secret=<?=$content->secret?>" class="btn small">Сменить пароль</a>
										<?endif;?>
									</div>
									

														
									<!--editors-->
									<?$editors_counter = 1?>
									<?foreach($edits as $name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?endforeach?>
									
									<div  class="col_12">
										<a href="<?=base_url()?>admin/users_module/" class="btn small">Назад</a>
										<a href="#" class="btn small" onclick="document.forms['user_form'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['user_form'].setAttribute('action', '<?=base_url()?>admin/user/edit/<?=$user_id?>/save/exit'); document.forms['user_form'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
										<?if((!empty($content->id))):?>
											<a href="<?=base_url()?>registration/reset_password.html?email=<?=$content->email?>&secret=<?=$content->secret?>" class="btn small">Сменить пароль</a>
										<?endif;?>
									</div>			
								</div>
								
								<!--delete popup-->
								<div id="delete" style="display:none;">
									<div class="pop-up">
										<div>
											Вы точно уверены что хотите удалить - <strong><?=$content->name?></strong>?
										</div><br/>
										<a href="<?=base_url()?>admin/content/delete_item/users/<?=$content->id?>" class="button small">Удалить?</a>
										<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
									</div>
								</div>
								<?$tab_counter++?>
							<?endforeach?>
						</form>							
					</div>
				</div>
			</div>
		</div>
		<? require "include/ch_script.php" ?>
		<? require 'include/footer_script.php' ?>
		<? require 'include/footer.php' ?>
	</body>
</html>