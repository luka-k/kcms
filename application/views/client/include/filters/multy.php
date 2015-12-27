<?if($filter->values):?>
	<div class="">
		<h4 class="sidebar-module-title"><?=$filter->name?></h4>
		<div class="col_12">
			<?$counter = 0?>
			<?foreach($filter->values as $value):?>
				<div class=""> 
					<input id="<?=$type?>-<?$counter?>" name="<?=$type?>[]" type="checkbox" <?if(isset($filters_values[$type]) && in_array($value, $filters_values[$type])):?>checked<?endif;?> value="<?=$value?>" onclick="$('#filter-form').submit();"/>
				<label for="<?=$type?>-<?$counter?>"><?=$value?></label>
				</div>
				<?$counter++?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>