<div  class="col_12">
	<div class="col_2"><label for="lbl_<?=$editors_counter?>"><?=$edit[0]?></label></div>
	<div class="col_10">
		<select id="lbl_<?=$editors_counter?>" class="col_12"  name="<?=$edit_name?>">
			<option <?if ($content->$edit_name == 0):?>selected<?endif;?> value="0">Без категории</option>
			<?php foreach ($selects[$edit_name] as $select): ?>
				<option class="option-1 <?if(!empty($select->childs)):?>have_child<?endif;?>" value="<?=$select->id?>" <?if ($content->$edit_name == $select->id):?>selected<?endif;?><?if(isset($select->disabled)):?>disabled<?endif;?>>
					<?=$select->name?>
				</option>
					<?if(!empty($select->childs)):?>
						<?foreach($select->childs as $select_2): ?>
							<option class="option-2 <?if(!empty($select_2->childs)):?>have_child<?endif;?>" value="<?=$select_2->id?>" <?if($content->$edit_name == $select_2->id):?>selected<?endif;?><?if(isset($select_2->disabled)):?>disabled<?endif;?>>
								<?=$select_2->name?>
							</option>
							<?if(!empty($select_2->childs)):?>
								<?foreach($select_2->childs as $select_3): ?>
									<option class="option-3 <?if(!empty($select_3->childs)):?>have_child<?endif;?>" value="<?=$select_3->id?>" <?if($content->$edit_name == $select_3->id):?>selected<?endif;?><?if(isset($select_3->disabled)):?>disabled<?endif;?>>
										<?=$select_3->name?>
									</option>
								<?endforeach;?>
							<?endif;?>
						<?endforeach;?>
					<?endif;?>
			<?endforeach;?>										
		</select>
	</div>
</div>