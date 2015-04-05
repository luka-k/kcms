	<div id="callback" style="display:none;">
		<div class="pop-up">
			<h5 class="col_12 center">Заказать обратный звонок</h5>
			<form action="#" class="form" id="callback_form" method="post">
			<div class="col_12 center">
				<input type="text" id="callback_name" class="col_12 validate" name="name" placeholder="Имя" />
			</div> <!-- /.form__line -->
			
			<div class="col_12 center">
				<input type="tel" id="call" class="col_12 validate" name="phone" placeholder="Телефон" />
			</div> <!-- /.form__line -->
			
			<div class="col_12 center">
				<button class="button small" onclick="callback_submit('callback_form'); return false;">Заказать звонок</button>
			</div> <!-- /.form__button -->
		</form> <!-- /.form -->
		</div>
	</div>
	
	<div id="callback_answer" style="display:none;">
		<div class="pop-up">
			Спасибо за Ваш, менеджер свяжется с Вами!
		</div>
	</div>