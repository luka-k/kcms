<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<?if($left_column <> "off"):?>
						<div id="left_col" class="col_3 back">
							<div id="left-menu">
								<?require "include/{$left_column['item_tree']}.php"?>
							</div>
						</div>
					<?endif;?>
					<div id="right_col" class="<?if($left_column == "off"):?>col_12<?else:?>col_9<?endif;?> back">
						<?$tab_counter = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<?if(!isset($no_tabs) || !in_array($key, $no_tabs)):?>
									<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
									<?$tab_counter++?>
								<?endif;?>
							<?endforeach?>
						</ul>
					
						<?$tab_counter = 1?>
						<?$editors_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/content/item/save/<?=$type?>"/>
							<?foreach ($editors as $key => $edits):?>
								<?if(!isset($no_tabs) || !in_array($key, $no_tabs)):?>
									<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
										<?=$error;?>
										<?=validation_errors(); ?>

										<? require 'include/buttons.php' ?>
														
										<!--editors-->
										<?foreach($edits as $edit_name => $edit):?>
											<?require "include/editors/{$edit[1]}.php"?>
											<?$editors_counter++?>
										<?endforeach?>
									
										<? require 'include/buttons.php' ?>				
									</div>
										
									<?$tab_counter++?>
								<?endif;?>
							<?endforeach?>
						</form>							
					</div>
				</div>
			</div>
		</div>
		
		<? require 'include/delete_popup.php'?>
		<? require "include/ch_script.php" ?>
		<? require 'include/recommend_script.php'?>
		<? require 'include/footer_script.php' ?>
		<? require 'include/footer.php' ?>
	</body>
</html>