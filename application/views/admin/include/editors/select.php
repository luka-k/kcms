<div  class="col_12">
	<label for="lbl_<?=$editors_counter?>" class="col_3">Категория</label>
	<select id="lbl_<?=$editors_counter?>"  name="<?=$name?>" class="col_8">
		<?php foreach ($selects[$name] as $select): ?>
			<option value="<?=$select->id?>" <?php if ($content->$name == $select->id):?>selected<?php endif; ?><?php if ($content->id == $select->id):?>disabled<?php endif; ?>>
				<?php if(!empty($select->childs)):?>-><?else:?>--<?endif;?>
				<?=$select->title?>
			</option>
				<?php if(!empty($select->childs)):?>
					<?php foreach ($select->childs as $select_2): ?>
						<option class="icon-fighter-jet" value="<?=$select_2->id?>" <?php if ($content->$name == $select_2->id):?>selected<?php endif; ?><?php if ($content->id == $select_2->id):?>disabled<?php endif; ?>>
							<?php if(!empty($select_2->childs)):?>---><?else:?>----<?endif;?>
							<?=$select_2->title?>
						</option>
						
						<?php if(!empty($select_2->childs)):?>
							<?php foreach ($select_2->childs as $select_3): ?>
								<option value="<?=$select_3->id?>" <?php if ($content->$name == $select_3->id):?>selected<?php endif; ?><?php if ($content->id == $select_3->id):?>disabled<?php endif; ?>>
									------<i class="icon-circle-blank"><?=$select_3->title?>
								</option>
							<?endforeach?>
						<?endif;?>
					<?endforeach?>
				<?endif;?>
		<?php endforeach ?>										
	</select>
</div>