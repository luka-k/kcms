<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<div id="left-menu">
							<?if($type == "products"):?>
								<? require 'include/products_tree.php' ?>
							<?elseif($type == "categories"):?>
								<? require 'include/categories_tree.php' ?>
							<?endif;?>
						</div>
					</div>
					<div id="right_col" class="col_8 back">
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
									<div  class="col_12">
										<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
									</div>
									<!--popup on delete-->
									<div id="delete" style="display:none;">
										<div class="pop-up">
											<div>
												Вы точно уверены что хотите удалалить - <strong><?=$content->title?></strong>?
											</div><br/>
											<a href="<?=base_url()?>admin/delete_page/<?=$type?>/<?=$content->id?>" class="button small">Удалить?</a>
											<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
										</div>
									</div>
														
									<!--editors-->
									<?php $editors_counter = 1?>
									<?php foreach($edits as $name => $edit):?>
										<?require "include/editors/{$edit[1]}.php"?>
										<?$editors_counter++?>
									<?php endforeach?>
							
									<div  class="col_12">
										<a href="<?=base_url()?>admin/items/<?=$type?>/" class="btn small">Назад</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
										<a href="#" class="btn small" onClick="document.forms['form1'].setAttribute('action', '<?=base_url()?>admin/edit_item/<?=$type?>/1'); document.forms['form1'].submit()">Сохранить и выйти</a>
										<a href="#delete" class="btn small lightbox">Удалить</a>
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