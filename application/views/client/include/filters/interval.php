<div class="col_12">
	<div class="col_12"><b><?=$item->name?></b></div>
	<div class="col_12">
		<input name="<?=$key?>[]" placeholder="" value="<?if(isset($filters_values[$key])):?><?=$filters_values[$key][0]?><?endif;?>"/> - <input name="<?=$key?>[]" placeholder="" value="<?if(isset($filters_values[$key])):?><?=$filters_values[$key][1]?><?endif;?>"/>
	</div>
</div>