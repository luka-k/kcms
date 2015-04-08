<div class="col_4">
	<div class="col_12"><?=$filter->name?></div>
	<div class="col_12">
		<input name="<?=$type?>[]" style="width:47%" placeholder="" value="<?if(isset($filters_values[$type])):?><?=$filters_values[$type][0]?><?endif;?>"/>&nbsp;-&nbsp;<input name="<?=$type?>[]" style="width:47%" placeholder="" value="<?if(isset($filters_values[$type])):?><?=$filters_values[$type][1]?><?endif;?>"/>
	</div>
</div>