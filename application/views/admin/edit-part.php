<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h5>Разделы</h5>
						<div id="left-menu">
							<? require 'include/parts-tree.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_8 back">
					<?$count = 1?>
					<ul class="tabs left">
						<?foreach ($editors as $key => $edit):?>
							<li><a href="#tabr<?=$count?>"><?=$key?></a></li>
							<?$count++?>
						<?endforeach?>
					</ul>
					
					<?php $count = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_part"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tabr<?=$count?>" class="clearfix tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
								<div  class="col_12"><button type="submit">Сохранить</button></div>
								
								<?php $coun = 1?>
								
								<?php foreach($edits as $name => $edit):?>
									<?require "include/editors/{$edit[1]}.php"?>
								<?php endforeach?>
							<div  class="col_12"><button type="submit">Сохранить</button></div>
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