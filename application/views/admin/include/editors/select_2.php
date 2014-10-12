<div  class="col_12">
	<label for="select_<?=$name?>" class="col_3"><?=$edit[0]?></label>
	<select id="select_<?=$name?>"  name="<?=$name?>" class="col_8">
	
		<?php foreach ($selects[$name] as $select_1): ?>
			<?php if(!empty($select_1->childs)):?>
				<?php foreach ($select_1->childs as $select_2): ?>
					<option value="<?=$select_2->id?>" <?php if ($content->$name == $select_2->id):?>selected<?php endif; ?><?php if ($content->id == $select_2->id):?>disabled<?php endif; ?>>
						<?=$select_2->name?>
					</option>
				<?php endforeach ?>	
			<?php endif;?>
		<?php endforeach ?>										
	</select>
</div>