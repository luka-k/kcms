<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<?if(($type <> "users")and($type <> "settings")):?>
						<div id="left_col" class="col_4 back">
							<div id="left-menu">
								<?if($type == "products"):?>
									<? require 'include/products_tree.php' ?>
								<?elseif($type == "categories"):?>
									<? require 'include/categories_tree.php' ?>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
					<div id="right_col" class="<?if(($type == "users")or($type == "settings")):?>col_12<?else:?>col_8<?endif;?> back">
						<?$tab_counter = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
								<?$tab_counter++?>
							<?endforeach?>
						</ul>
					
						<?php $tab_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/edit_item/<?=$type?>"/>
							<?php foreach ($editors as $key => $edits):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<?=$error;?>
									<?php echo validation_errors(); ?>
									<? require 'include/buttons.php' ?>
									<!--popup on delete-->
									<div id="delete" style="display:none;">
										<div class="pop-up">
											<div>
												Вы точно уверены что хотите удалалить - <strong><?=$content->name?></strong>?
											</div><br/>
											<a href="<?=base_url()?>admin/delete_item/<?=$type?>/<?=$content->id?>" class="button small">Удалить?</a>
											<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
										</div>
									</div>
														
									<!--editors-->
									<?php $editors_counter = 1?>
									<?php foreach($edits as $name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?php endforeach?>
									<? require 'include/buttons.php' ?>				
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