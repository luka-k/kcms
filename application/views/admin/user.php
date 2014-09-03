<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_3 back">
						<h5>Страницы разделов</h5>
						<div id="left-menu">
							<? require 'include/part_pages_tree.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_9 back">
					<?$tab_counter = 1?>
					<ul class="tabs left">
						<?foreach ($editors as $key => $edit):?>
							<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
							<?$tab_counter++?>
						<?endforeach?>
					</ul>
					
					<?php $tab_counter = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>registration/edit_user/<?=$content->id?>"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
							<?=$error;?>
							<?=validation_errors(); ?>
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
								<a href="<?=base_url()?>registration/users/" class="btn small">Назад</a>
								<a href="<?=base_url()?>registration/delete_user/<?=$content->id?>" class="btn small">Удалить</a>
								<a href="<?=base_url()?>registration/reset_password.html?email=<?=$content->email?>&secret=<?=$content->secret?>" class="btn small">Сменить пароль</a>
							</div>
								
							<?php $editors_counter = 1?>
							<?php foreach($edits as $name => $edit):?>
								<?require "include/editors/{$edit[1]}.php"?>
								<?php $editors_counter++?>
							<?php endforeach?>
							
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
								<a href="<?=base_url()?>registration/users/" class="btn small">Назад</a>
								<a href="<?=base_url()?>registration/delete_user/<?=$content->id?>" class="btn small">Удалить</a>
								<a href="<?=base_url()?>registration/reset_password.html?email=<?=$content->email?>&secret=<?=$content->secret?>" class="btn small">Сменить пароль</a>
							</div>					
						</div>
						<?$tab_counter++?>
					<?endforeach?>
					</form>
					
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>