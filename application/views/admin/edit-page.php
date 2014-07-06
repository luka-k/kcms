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
					</ul>
					
					<?php $count = 1?>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>
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
										<input type="<?=$edit['1']?>" name="<?=$name?>" value="<?=$page->$name?>"/>
									<?php else:?>
									<div  class="col_12">
										<div class="col_2"><label for="lbl_<?=$coun?>"><?=$edit['0']?></label></div>
										<?php if ($edit['1'] == 'text'):?>
											<input type="text" id="lbl_<?=$coun?>" class="col_9" name="<?=$name?>" value="<?=$page->$name?>"/><br/>
										<?php elseif ($edit['1'] == 'checkbox'):?>
											<div class="col_9" ><input type="checkbox" id="lbl_<?=$coun?>" name="<?=$name?>" <?php if ($page->$name== 1):?> checked <?php endif; ?>/></div>
										<?php elseif ($edit['1'] == 'select'):?>
											<div class="col_9">
												<select id="lbl_<?=$coun?>" class="col_12"  name="<?=$name?>">
													<option value="0">Без категории</option>
													<?php foreach ($cat as $cat_item): ?>
														<option value="<?=$cat_item->id?>" <?php if ($cat_item->id == $page->$name):?>selected="selected"<?php endif; ?>><?=$cat_item->title?></option>
													<?php endforeach ?>										
												</select>									
											</div>
										<?php elseif ($edit['1'] == 'tiny'):?>
											<div  class="col_9">
												<textarea  name="<?=$name?>" class="textarea col_12" rows="20" cols="50" placeholder="<?=$edit['0']?>"><?=$page->$name?></textarea>
											</div>
										<?php endif;?>
									</div>
									<?php endif;?>
								<?php endforeach?>
						</div>
						<?$count++?>
					<?endforeach?>
					</form>
					
						<!--<ul class="tabs left">
							<li><a href="#tabr1">Основное</a></li>
						</ul>

						<div id="tabr1" class="tab-content">
							<?=$error;?>
							<?php echo validation_errors(); ?>
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>
								<div  class="col_12">
									<button type="submit">Сохранить</button>
								</div>
								
								<input type="hidden" name="id" value="<?=$page->id?>"/>	
								<input type="hidden" name="" value="<?=$page->autor?>"/>	
								<input type="hidden" name="" value="<?=$page->publish_date?>"/>
								
								<div  class="col_12">
									<label for="text_1" class="col_2">Название</label>
									<input type="text" id="text_1" class="col_9" name="title" value="<?=$page->title?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="select1" class="col_2">Категория</label>
									<select id="select1"  name="cat_id" class="col_9">
										<option value="0">Без категории</option>
										<?php foreach ($cat as $cat_item): ?>
											<option value="<?=$cat_item->id?>" <?php if ($cat_item->id == $page->cat_id):?>selected="selected"<?php endif; ?>><?=$cat_item->title?></option>
										<?php endforeach ?>										
									</select>
								</div>
																	
								<div  class="col_12">
									<div  class="col_2">
										<label for="textarea1">Настройки отображения</label>
									</div>
									<div  class="col_10">
										<input type="checkbox" name ="status" id="check_1" value="1" <?php if ($page->status== 1):?> checked <?php endif; ?>/>
										<label for="check_1" class="inline col_2">Активна</label><br/>
									</div>								
								</div>
								
								<div  class="col_12">
									<label for="text_2" class="col_2">Meta-title страницы</label>
									<input type="text" id="text_2" class="col_9" name="meta_title" value="<?=$page->meta_title?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="text_3" class="col_2">Ключевые слова страницы</label>
									<input type="text" id="text_3" class="col_9" name="keywords" value="<?=$page->keywords?>"/><br/>
								</div>
								
								<div  class="col_12">
									<label for="text_4" class="col_2">Описание страницы</label>
									<input type="text" id="text_4" class="col_9" name="description" value="<?=$page->description?>"/><br/>
								</div>								
								
								<div class="col_12">
									<div  class="col_2">
										<label for="textarea1">Содержимое</label>
									</div>
									<div  class="col_10">
										<textarea  id="textarea1" class="col_11" name="full_text" rows="20" cols="50" placeholder="Содержимое"><?=$page->full_text?></textarea>
									</div>
								</div>
								<button type="submit">Сохранить</button>
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