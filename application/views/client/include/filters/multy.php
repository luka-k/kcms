<div class="col_12">
	<div class="col_12">
		<b><?=$item->name?></b>
	</div>
	<div class="col_12">
		<input type="hidden" name=<?=$key?> value=""/>
		<?foreach($item->values as $value):?>
			<div class="col_6"> <?=$value?>&nbsp;<input name="<?=$key?>[]" type="checkbox" value="<?=$value?>"/></div>
		<?endforeach;?>
	</div>
</div>