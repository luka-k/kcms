<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>

	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_3 back">
						<h5>Категории</h5>
						<div id="left-menu">
							<? require 'tree.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_9 back">
						<ul class="tabs left">
							<li><a href="#tabr1">Основное</a></li>
						</ul>

						<div id="tabr1" class="tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_settings"/>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<input type="hidden" name="id" value="<?=$settings->id?>"/>
								
								<div  class="col_12">
									<label for="text_1" class="col_2">Название сайта</label>
									<input type="text" id="text_1" class="col_9" name="site_title" value="<?=$settings->site_title?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="text_2" class="col_2">Описание сайта</label>
									<input type="text" id="text_2" class="col_9" name="site_description" value="<?=$settings->site_description?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="text_3" class="col_2">Ключевые слова</label>
									<input type="text" id="text_3" class="col_9" name="site_keywords" value="<?=$settings->site_keywords?>"/><br/>
								</div>
								<div class="col_12">
								<div for="text_9" class="col_12">Тип главной страницы</div>
								<div style="position:relative; float:left; width:100%">
									<div class="col_3">
										<label for="radio_1" class="col_9">Категория</label>	
										<input type="radio" name="main_page_type" id="radio_1" class="col_3" <?php if ($settings->main_page_type == 1):?> checked="checked" <?php endif; ?> value="1"/>
									</div>
									<select id="select1"  name="main_page_cat" class="col_8">
										<option value="0">Без категории</option>
										<?php foreach ($cat as $cat_item): ?>
											<option value="<?=$cat_item->id?>" <?php if ($cat_item->id == $settings->main_page_cat):?>selected="selected"<?php endif; ?>><?=$cat_item->title?></option>
										<?php endforeach ?>										
									</select>	
								</div>
								<div style="position:relative; float:left; width:100%">
									<div class="col_3">
										<label for="radio_2" class="col_9">Страница</label>
										<input type="radio" name="main_page_type" id="radio_2" class="col_3" <?php if ($settings->main_page_type == 2):?> checked="checked" <?php endif; ?> value="2"/>
									</div>
									
									<input type="text" id="text_9" class="col_8" name="main_page_id" value="<?=$settings->main_page_id?>"/><br/>
								</div>
								</div>
																
								<div  class="col_12">
									<div  class="col_2">
										<label for="textarea1">Настройки отображения</label>
									</div>
									<div  class="col_10">
										<input type="checkbox" name ="site_offline" id="check_1" value="1" <?php if ($settings->site_offline== 1):?> checked <?php endif; ?>/>
										<label for="check_1" class="inline col_2">Сайт выключен</label><br/>
									</div>								
								</div>
								
								<div  class="col_12">
									<label for="text_9" class="col_2">Офф-лайн сообщение</label>
									<input type="text" id="text_9" class="col_9" name="offline_text" value="<?=$settings->offline_text?>"/><br/>
								</div>
								
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer-scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>