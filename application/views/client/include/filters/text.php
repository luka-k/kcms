<div class="col_4">
	<div class="col_12"><?=$filter->name?></div>
	<div class="col_12">
		<input name="<?=$type?>" value="<?if(isset($filters_values[$type])):?><?=$filters_values[$type]?><?endif;?>"/>
	</div>
</div>