<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h6>Страницы по категориям</h6>
						<div id="left-menu">
							<? require 'include/cat-pages.php' ?>
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
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/edit_cat_page"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tabr<?=$count?>" class="clearfix tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
								<a href="<?=base_url()?>admin/delete_cat_page/<?=$content->id?>" class="btn small">Удалить</a>
							</div>
								
							<?php $coun = 1?>
			
							<?php foreach($edits as $name => $edit):?>
								<?require "include/editors/{$edit[1]}.php"?>
							<?php endforeach?>
							
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Сохранить</a>
								<a href="<?=base_url()?>admin/delete_cat_page/<?=$content->id?>" class="btn small">Удалить</a>
							</div>						
						</div>
						<?$count++?>
					<?endforeach?>
					</form>							
						
						<!--<div id="tabr1" class="tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							
								
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<input type="hidden" name="id" value="<?=$cat_info->id?>"/>
							
								<div  class="col_12">
									<label for="text1" class="col_2">Название</label>
									<input type="text" id="text1" class="col_9" name="title" value="<?=$cat_info->title?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="select1" class="col_2">Категория</label>
									<select id="select1"  name="root" class="col_9">
										<option value="0">Без категории</option>
										<?php foreach ($cat as $cat_item): ?>
											<option value="<?=$cat_item->id?>" <?php if ($cat_item->id == $cat_info->root):?>selected<?php endif; ?><?php if ($cat_item->id == $cat_info->id):?>disabled<?php endif; ?>>
												<?=$cat_item->title?>
											</option>
										<?php endforeach ?>										
									</select>
								</div>
								
								<div class="col_12">
									<div  class="col_2">
										<label for="textarea1">Описание</label>
									</div>
									<div  class="col_10">
										<textarea  id="textarea1" class="col_11" name="cat_desc" rows="20" cols="50" placeholder="Содержимое"><?=$cat_info->cat_desc?></textarea>
									</div>
								</div>
								<button type="submit">Сохранить</button>
-->							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<script>
			$('ul .up').click(function() {
				$(this).next().slideToggle().toggleClass('noactive');
				$(this).toggleClass('up');
				$(this).toggleClass('down');
			});

			$('ul .down').click(function() {
				$(this).next().slideToggle().toggleClass('noactive');
				$(this).toggleClass('down');
				$(this).toggleClass('up');
			});
		</script>
		<? require 'footer.php' ?>
	</body>
</html>