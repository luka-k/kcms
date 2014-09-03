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
					<?$tabs_counter = 1?>
					<ul class="tabs left">
						<?foreach ($editors as $key => $edit):?>
							<li><a href="#tab_<?=$tabs_counter?>"><?=$key?></a></li>
							<?$tabs_counter++?>
						<?endforeach?>
					</ul>
					
					<?php $tabs_counter = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/edit_user/<?=$content->id?>"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tab_<?=$tabs_counter?>" class="clearfix tab-content">
							<?=$error;?>
							<?=validation_errors(); ?>
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
							</div>
								
							<?$editors_counter = 1?>
							<?php foreach($edits as $name => $edit):?>
								<?require "include/editors/{$edit[1]}.php"?>
								<?$editors_counter++?>
							<?php endforeach?>
							
							<div  class="col_12">
								<div class="col_3"><label for="lbl_<?=$editors_counter?>">Повторите пароль</label></div>
								<div class="col_9"><input type="password" id="lbl_<?=$editors_counter?>" class="col_12" name="conf_password" placeholder="Повторите пароль"/></div>
							</div>
							
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
							</div>						
						</div>
						<?$tabs_counter++?>
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