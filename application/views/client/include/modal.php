<div class="modal modal--to-cart" id="to-cart">
	<div class="modal__title block-title">
		Товар "<span class="fancy_product_name"></span>"
		<br /> добавлен в корзину
	</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__cart modal-cart">

			<div class="form__line modal-cart__line">	
				<label class="form__label modal-cart__label">Кол-во в корзине: </label>
				<input type="text" id="input_qty" class="form__input modal-cart__input required qty" name="amount" onchange="update_cart(document.getElementById('input_item_id').value, this.value); return false;" placeholder="" value="" />
				<input type="hidden" id="input_item_id" value=""/>
			</div> <!-- /.form__line -->
			
			<div class="form__button modal-cart__button">
				<button type="button" class="button button--normal button--auto-width js-close-fancybox">Вернуться к покупкам</button>
				<button type="button" class="button button--normal button--grey button--auto-width" onclick="document.location.replace('/cart/');">В корзину &rarr;</button>
			</div> <!-- /.form__button -->

	</div> <!-- /.modal__cart -->
</div> <!-- /.modal -->

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