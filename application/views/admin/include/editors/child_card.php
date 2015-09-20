<input type="hidden" name="card_id" value="<?if(isset($content->card->id)):?><?=$content->card->id?><?endif;?>">
<div class="col_12">
	<div class="col_2">
		<label for="card_1">Номер карты</label>
	</div>
	<div class="col_10">
		<input type="text" 
			   id="card_1" 
			   class="col_12 validation" 
			   data-id="require"
			   name="card_number" 
			   value="<?if(isset($content->card->card_number)):?><?=$content->card->card_number?><?endif;?>"/>
	</div>
</div>
<div class="col_12">
	<div class="col_2">
		<label for="card_2">Дневной лимит</label>
	</div>
	<div class="col_10">
		<input type="text" 
			   id="card_2" 
			   class="col_12" 
			   name="card_day_limit" 
			   value="<?if(isset($content->card->card_day_limit)):?><?=$content->card->card_day_limit?><?endif;?>"/>
	</div>
</div>
<div class="col_12">
	<div class="col_2">
		<label for="card_3">Кредитный лимит</label>
	</div>
	<div class="col_10">
		<input type="text" 
			   id="card_3" 
			   class="col_12" 
			   name="card_credit_limit" 
			   value="<?if(isset($content->card->card_credit_limit)):?><?=$content->card->card_credit_limit?><?endif;?>"/>
	</div>
</div>
<div class="col_12">
	<div class="col_2">
		<label for="card_4">Баланс</label>
	</div>
	<div class="col_10">
		<input type="text" 
			   id="card_4" 
			   class="col_12" 
			   name="card_balance" 
			   value="<?if(isset($content->card->card_balance)):?><?=$content->card->card_balance?><?endif;?>"/>
	</div>
</div>