<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_3 back">
						<h5>Страницы разделов</h5>
						<div id="left-menu">
							<? require 'include/part-pages.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_9 back">
					<?$count = 1?>
					<ul class="tabs left">
						<?foreach ($editors as $key => $edit):?>
							<li><a href="#tabr<?=$count?>"><?=$key?></a></li>
							<?$count++?>
						<?endforeach?>
					</ul>
					
					<?php $count = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/edit_user/<?=$content->id?>"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tabr<?=$count?>" class="clearfix tab-content">
							<?=$error;?>
							<?=validation_errors(); ?>
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
							</div>
								
							<?php $coun = 1?>
							<?php foreach($edits as $name => $edit):?>
								<?require "include/editors/{$edit[1]}.php"?>
								<?php $coun++?>
							<?php endforeach?>
							
							<div  class="col_12">
								<div class="col_3"><label for="lbl_<?=$coun?>">Повторите пароль</label></div>
								<div class="col_9"><input type="password" id="lbl_" class="col_12" name="conf_password" placeholder="Повторите пароль"/></div>
							</div>
							
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
							</div>						
						</div>
						<?$count++?>
					<?endforeach?>
					</form>
					
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer-scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>