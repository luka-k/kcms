<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
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
					
					<?php $tab_counter = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form" action="<?=base_url()?>admin/edit_settings"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form'].submit()">Сохранить</a>
							</div>
								
							<?php $editors_counter = 1?>
								
							<?php foreach($edits as $name => $edit):?>
								<?require "include/editors/{$edit[1]}.php"?>
								<?$editors_counter++?>
							<?php endforeach?>
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form'].submit()">Сохранить</a>
							</div>
						</div>
						<?$tab_counter++?>
					<?endforeach?>
					</form>
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_script.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>