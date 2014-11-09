<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">

					<div id="left_col" class="<?if($content->id):?>col_7<?else:?>col_12<?endif;?> back">
						
						<?$tab_counter = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<li><a href="#tab_<?=$tab_counter?>"><?=$key?></a></li>
								<?$tab_counter++?>
							<?endforeach?>
						</ul>
					
						<?php $tab_counter = 1?>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="menu_edit" action="<?=base_url()?>menu_module/edit_menu/"/>
							<?php foreach ($editors as $key => $edits):?>
								<div id="tab_<?=$tab_counter?>" class="clearfix tab-content">
									<div class="col_12">
										<a href="<?=base_url()?>menu_module/menus/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['menu_edit'].submit()">Сохранить</a>
										<?if($content->id):?>
											<a href="#" class="btn small" onClick="document.forms['menu_edit'].setAttribute('action', '<?=base_url()?>menu_module/edit_menu/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<?endif;?>
									</div>
									<?=$error;?>
									<?=validation_errors(); ?>

									<!--popup on delete-->
									<div id="delete" style="display:none;">
										<div class="pop-up">
											<div>
												Вы точно уверены что хотите удалалить - <strong><?=$content->name?></strong>?
											</div><br/>
											<a href="<?=base_url()?>admin/delete_item/<?=$content->id?>" class="button small">Удалить?</a>
											<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
										</div>
									</div>
														
									<!--editors-->
									<?php $editors_counter = 1?>
									<?php foreach($edits as $name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?php endforeach?>
									<div class="col_12">
										<a href="<?=base_url()?>menu_module/menus/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['menu_edit'].submit()">Сохранить</a>
										<?if($content->id):?>
											<a href="#" class="btn small" onClick="document.forms['menu_edit'].setAttribute('action', '<?=base_url()?>menu_module/edit_menu/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<?endif;?>
									</div>
								</div>
								<?$tab_counter++?>
							<?endforeach?>
						</form>							
					</div>
					
					<?if($content->id):?>
						<div id="right_col" class="col_5 back">
							<div class="col_12">						
								<h6 class="col_8 left">Пункты меню</h6> 
								<div class="col_4 right">
									<a href="<?=base_url()?>menu_module/menu/" class="button small">Создать</a>
								</div>			
							</div>
						</div>
					<?endif;?>
				</div>
			</div>
		</div>
		<? require 'include/footer_scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>