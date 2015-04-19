<?if($filter->values):?>
	<div class="col_12" style="text-align:left; border-bottom:1px solid #fff">
		<div class="col_12">
			<b><?=$filter->name?></b>
		</div>
		<div class="col_12">
			<?$counter = 0?>
			<?foreach($filter->values as $value):?>
				<div class="col_12"> <input id="<?=$type?>-<?$counter?>" name="<?=$type?>[]" type="checkbox" <?if(isset($filters_values[$type]) && in_array($value, $filters_values[$type])):?>checked<?endif;?> value="<?=$value?>"/>
				<label for="<?=$type?>-<?$counter?>"><?=$value?></label></div>
				<?$counter++?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>