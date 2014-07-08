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
						
						<?$count = 1?>
						<ul class="tabs left">
							<?foreach ($editors as $key => $edit):?>
								<li><a href="#tabr<?=$count?>"><?=$key?></a></li>
								<?$count++?>
							<?endforeach?>
								<li><a href="#tabr<?=$count?>">Тип ссылки</a></li>
						</ul>
						
					<?php $count = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_link"/>
					<?php foreach ($editors as $key => $edits):?>
						<div id="tabr<?=$count?>" class="clearfix tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<?php $coun = 1?>
								
								<?php foreach($edits as $name => $edit):?>
									<?php if ($edit['1'] == 'hidden'):?>
										<input type="<?=$edit['1']?>" name="<?=$name?>" value="<?=$link->$name?>"/>
									<?php else:?>
									<div  class="col_12">
										<div class="col_2"><label for="lbl_<?=$coun?>"><?=$edit['0']?></label></div>
										<?php if ($edit['1'] == 'text'):?>
											<input type="text" id="lbl_<?=$coun?>" class="col_9" name="<?=$name?>" value="<?=$link->$name?>"/><br/>
										<?php elseif ($edit['1'] == 'checkbox'):?>
											<div class="col_9" ><input type="checkbox" id="lbl_<?=$coun?>" name="<?=$name?>" <?php if ($link->$name== 1):?> checked <?php endif; ?>/></div>
										<?php elseif ($edit['1'] == 'select'):?>
											<div class="col_9">
												<select id="lbl_<?=$coun?>" class="col_12"  name="<?=$name?>">
													<option value="0">Корневой</option>
													<?php foreach ($links as $link_item): ?>
														<option value="<?=$link_item->id?>" <?php if ($link_item->id == $link->$name):?>selected="selected"<?php endif; ?>><?=$link_item->title?></option>
													<?php endforeach ?>										
												</select>									
											</div>
										<?php endif;?>
									</div>
									<?php endif;?>
								<?php endforeach?>
						</div>
						<?$count++?>
					<?endforeach?>
						<div id="tabr<?=$count?>" class="clearfix tab-content">
								<div class="col_12">
									<div  class="col_12">
										<button type="submit">Сохранить</button>
									</div>								
									<div>Тип ссылки</div>
									<div class="col_6">
										<div>
											<input type="radio" name="type" id="radio1" <?php if ($link->item_type == 1):?> checked="checked" <?php endif; ?> value="1"/>
											<label for="radio1" class="inline">Страница</label>
										</div>
										<div>
											<label for="select1" class="col_12">Выберите страницу</label>
											<select id="select1" size="6" name="page_id" class="col_12">
												<?php foreach ($pages as $page): ?>
													<option value="<?=$page->id?>" <?php if ($link->url = $page->url):?> selected <?php endif; ?>><?=$page->title?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									
									<div class="col_6">
										<input type="radio" name="type" id="radio2" <?php if ($link->item_type == 2):?> checked="checked" <?php endif; ?> value="2"/>
										<label for="radio2" class="inline">Категория</label>
											<label for="select2" class="col_12">Выберите категорию</label>
											<select id="select2" size="6" name="cat_id" class="col_12">
												<?php foreach ($cat as $cat_item): ?>
													<option value="<?=$cat_item->id?>" <?php if ($link->url = $cat_item->url):?> selected <?php endif; ?>><?=$cat_item->title?></option>
												<?php endforeach ?>
											</select>
									</div>
								</div>							
						</div>
					</form>
					
						<!--<ul class="tabs left">
							<li><a href="#tabr1">Основное</a></li>
						</ul>

						<div id="tabr1" class="tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_link"/>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<input type="hidden" name="id" value="<?=$link->id?>"/>	
								<input type="hidden" name="menu_id" value="<?=$link->menu_id?>"/>	
								
								<div  class="col_12">
									<label for="text_1" class="col_2">Заголовок</label>
									<input type="text" id="text_1" class="col_9" name="title" value="<?=$link->title?>"/><br/>
								</div>
								
								<div class="col_12">
									<div>Тип ссылки</div>
									<div class="col_6">
										<div>
											<input type="radio" name="type" id="radio1" <?php if ($link->item_type == 1):?> checked="checked" <?php endif; ?> value="1"/>
											<label for="radio1" class="inline">Страница</label>
										</div>
										<div>
											<label for="select1" class="col_12">Выберите страницу</label>
											<select id="select1" size="6" name="page_id" class="col_12">
												<?php foreach ($pages as $page): ?>
													<option value="<?=$page->id?>" <?php if ($link->url = $page->url):?> selected <?php endif; ?>><?=$page->title?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									
									<div class="col_6">
										<input type="radio" name="type" id="radio2" <?php if ($link->item_type == 2):?> checked="checked" <?php endif; ?> value="2"/>
										<label for="radio2" class="inline">Категория</label>
											<label for="select2" class="col_12">Выберите категорию</label>
											<select id="select2" size="6" name="cat_id" class="col_12">
												<?php foreach ($cat as $cat_item): ?>
													<option value="<?=$cat_item->id?>" <?php if ($link->url = $cat_item->url):?> selected <?php endif; ?>><?=$cat_item->title?></option>
												<?php endforeach ?>
											</select>
									</div>
								</div>
																	
								<div  class="col_12">
									<div  class="col_2">
										<label for="textarea1">Настройки отображения</label>
									</div>
									<div  class="col_10">
										<input type="checkbox" name ="hidden" id="check_1" value="1" <?php if ($link->hidden == 1):?> checked <?php endif; ?>/>
										<label for="check_1" class="inline col_2">Скрыт</label><br/>
									</div>								
								</div>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
							</form>
						</div>-->
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer-scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>