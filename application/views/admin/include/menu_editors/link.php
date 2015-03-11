<div class="col_12 clearfix">
	<label class="col_3"><?=$edit[0]?></label>
	<select id="field-articles" class="<?=$name?> select_url" name="<?=$name?>" class="col_9" <?if($item_content <> "articles"):?>disabled<?endif;?>>
		<option label="" value="">Выберите содержимое</option>
		<?foreach ($selects[$name] as $select):?>
			<option <?if(!empty($select->childs)):?>class="option-1-ch"<?else:?>class="option-1"<?endif;?> value="<?=$select->url?>" <?php if ($item_content->$name == $select->url):?>selected<?php endif; ?><?php if ($item_content->url == $select->url):?>disabled<?php endif; ?>>
				<?=$select->name?>
			</option>
				<?if(!empty($select->childs)):?>
					<?foreach ($select->childs as $select_2): ?>
						<option <?if(!empty($select_2->childs)):?>class="option-2-ch"<?else:?>class="option-2"<?endif;?> value="<?=$select_2->url?>" <?php if ($item_content->$name == $select_2->url):?>selected<?php endif; ?><?php if ($item_content->url == $select_2->url):?>disabled<?php endif; ?>>
							<?=$select_2->name?>
						</option>
						
						<?if(!empty($select_2->childs)):?>
							<?foreach ($select_2->childs as $select_3): ?>
								<option <?php if(!empty($select_3->childs)):?>class="option-3-ch"<?else:?>class="option-3"<?endif;?> value="<?=$select_3->url?>" <?php if ($item_content->$name == $select_3->url):?>selected<?php endif; ?><?php if ($item_content->url == $select_3->url):?>disabled<?php endif; ?>>
									<?=$select_3->name?>
								</option>
							<?endforeach?>
						<?endif;?>
					<?endforeach?>
				<?endif;?>
		<?endforeach;?>
	</select>
	
	<input id="field-link" class="menu_items <?=$name?> select_url" name="<?=$name?>" class="col_9" <?if($item_content <> "link"):?>disabled<?endif;?>/>
</div>