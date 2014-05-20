<script type="text/javascript" src="<?=base_url()?>template/admin/js/tinymce/tinymce.min.js"></script>
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
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_cat"/>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<input type="hidden" name="id" value="<?=$cat_info['id']?>"/>
							
								<div  class="col_12">
									<label for="text1" class="col_2">Название</label>
									<input type="text" id="text1" class="col_9" name="title" value="<?=$cat_info['title']?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="select1" class="col_2">Категория</label>
									<select id="select1"  name="root" class="col_9">
										<option value="0">Без категории</option>
										<?php foreach ($cat as $cat_item): ?>
											<option value="<?=$cat_item['id']?>" <?php if ($cat_item['id'] == $cat_info['root']):?>selected<?php endif; ?><?php if ($cat_item['id'] == $cat_info['id']):?>disabled<?php endif; ?>>
												<?=$cat_item['title']?>
											</option>
										<?php endforeach ?>										
									</select>
								</div>
								
								<div class="col_12">
									<div  class="col_2">
										<label for="textarea1">Описание</label>
									</div>
									<div  class="col_10">
										<textarea  id="textarea1" class="col_11" name="cat_desc" rows="20" cols="50" placeholder="Содержимое"><?=$cat_info['cat_desc']?></textarea>
									</div>
								</div>
								<button type="submit">Сохранить</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>