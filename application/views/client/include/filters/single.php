﻿<div class="col_12">
	<div class="col_12">
		<b><?=$item->name?></b>
	</div>
	<div class="col_12">
		<?foreach($item->values as $value):?>
			<div class="col_6"> <?=$value?>&nbsp;<input name="<?=$key?>" type="radio" <?if(isset($filters_values[$key]) && $value == $filters_values[$key]):?>checked<?endif;?> value="<?=$value?>"/></div>
		<?endforeach;?>
	</div>
</div>