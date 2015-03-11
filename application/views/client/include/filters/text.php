<div class="col_12">
	<div class="col_12">
		<b><?=$item->name?></b>
	</div>
	<div class="col_12">
		<input name="<?=$key?>" value="<?if(isset($filters_values[$key])):?><?=$filters_values[$key]?><?endif;?>"/>
	</div>
</div>