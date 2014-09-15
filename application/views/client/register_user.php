<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<div class="col_12">
					<h5>Регистрация</h5>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>registration/edit_new_user/<?=$content->id?>"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="" class="clearfix">
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
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
							</div>						
						</div>
					<?endforeach?>
					</form>
				</div>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>