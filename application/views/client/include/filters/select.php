<div class="form__line catalog-filter__line">
	<span class="form__select-arrow">
		<span class="form__select-box">
			<select class="form__select" name="<?=$key?>">
				<option label="" value=""><?=$item->name?></option>
				<?foreach($item->values as $value):?>
					<option value="<?=$value?>" <?if($filters_checked[$key] == $value):?>selected<?endif;?>><?=$value?></option>
				<?endforeach;?>
			</select>
		</span>
	</span>
</div> <!-- /.form__line -->