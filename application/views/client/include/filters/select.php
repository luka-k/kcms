<div class="form__line catalog-filter__line">
	<span class="form__select-arrow">
		<span class="form__select-box">
			<input type="hidden" name="filter" value="<?=$filter->url?>"/>
			<select class="form__select" name="filter_value">
				<option label="" value=""><?=$filter->name?></option>
				<?foreach($filter->items as $item):?>
					<option value="<?=$item->value?>" <?if($filters_checked[$filter->url] == $item->value):?>selected<?endif;?>><?=$item->value?></option>
				<?endforeach;?>
			</select>
		</span>
	</span>
</div> <!-- /.form__line -->