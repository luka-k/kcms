﻿<script type="text/javascript" src="<?=base_url()?>template/admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		selector: "textarea"
	});
</script>
			
				<div class="col_12">
					<div id="left_col" class="col_3 back">
						<h5>Категории</h5>
						<div id="left-menu">
							<?=$this->menu_model->menu(0)?>
						</div>
					</div>
					
					<div  class="col_9 back">
						<ul class="tabs left">
							<li><a href="#tabr1">Основное</a></li>
						</ul>

						<div id="tabr1" class="tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_link"/>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<input type="hidden" name="id" value="<?=$link['id']?>"/>	
								<input type="hidden" name="menu_id" value="<?=$link['menu_id']?>"/>	
								
								<div  class="col_12">
									<label for="text_1" class="col_2">Заголовок</label>
									<input type="text" id="text_1" class="col_9" name="title" value="<?=$link['title']?>"/><br/>
								</div>
								
								<div class="col_12">
									<div>Тип ссылки</div>
									<div class="col_6">
										<div>
											<input type="radio" name="type" id="radio1" <?php if ($link['item_type'] == 1):?> checked="checked" <?php endif; ?> value="1"/>
											<label for="radio1" class="inline">Страница</label>
										</div>
										<div>
											<label for="select1" class="col_12">Выберите страницу</label>
											<?=$link['url']?>
											<select id="select1" size="6" name="page_id" class="col_12">
												<?php foreach ($pages as $page): ?>
													<option value="<?=$page['id']?>" <?php if ($link['url'] = $page['url']):?> selected <?php endif; ?>><?=$page['title']?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									
									<div class="col_6">
										<input type="radio" name="type" id="radio2" <?php if ($link['item_type'] == 2):?> checked="checked" <?php endif; ?> value="2"/>
										<label for="radio2" class="inline">Категория</label>
											<label for="select2" class="col_12">Выберите категорию</label>
											<select id="select2" size="6" name="cat_id" class="col_12">
												<?php foreach ($cat as $cat_item): ?>
													<option value="<?=$cat_item['id']?>" <?php if ($link['url'] = $cat_item['url']):?> selected <?php endif; ?>><?=$cat_item['title']?></option>
												<?php endforeach ?>
											</select>
									</div>
								</div>
																	
								<div  class="col_12">
									<div  class="col_2">
										<label for="textarea1">Настройки отображения</label>
									</div>
									<div  class="col_10">
										<input type="checkbox" name ="hidden" id="check_1" value="1" <?php if ($link['hidden' ] == 1):?> checked <?php endif; ?>/>
										<label for="check_1" class="inline col_2">Скрыт</label><br/>
									</div>								
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