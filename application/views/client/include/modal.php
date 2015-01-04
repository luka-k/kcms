<div class="modal modal--to-cart" id="to-cart">
	<div class="modal__title block-title">
		Товар "<span class="fancy_product_name"></span>"
		<br /> добавлен в корзину
	</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__cart modal-cart">
		<form action="#" class="form to_cart" method="post"> <!-- method="get" only for demo -->
			<div class="form__line modal-cart__line skew">	
				<label class="form__label modal-cart__label">Кол-во в корзине: </label>
				<input type="text" id="input_qty" class="form__input modal-cart__input required qty" name="amount" placeholder="" value="" />
				<input type="hidden" id="input_item_id" value=""/>
			</div> <!-- /.form__line -->
			
			<div class="form__button modal-cart__button skew">
				<button type="button" class="button button--normal button--auto-width js-close-fancybox">Вернуться к покупкам</button>
				<button type="button" class="button button--normal button--grey button--auto-width" onclick="from_fancy_to_cart(); return false;">В корзину &rarr;</button>
			</div> <!-- /.form__button -->
		</form> <!-- /.form -->
	</div> <!-- /.modal__cart -->
</div> <!-- /.modal -->

<div class="modal" id="callback">
	<div class="modal__title block-title">Оставьте ваш номер телефона</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__form">
		<form action="#" class="form" where="validate_ajax" id="callback_form" method="post">
			<div class="form__line skew">
				<input type="text" id="callback_name" class="form__input required" name="name" placeholder="Имя" />
			</div> <!-- /.form__line -->
			
			<div class="form__line skew">
				<input type="tel" id="call" class="form__input required" name="phone" placeholder="Телефон" />
			</div> <!-- /.form__line -->
			
			<div class="form__button skew">
				<button class="button button--normal button--auto-width">Заказать звонок</button>
			</div> <!-- /.form__button -->
		</form> <!-- /.form -->
	</div> <!-- /.modal__form -->
</div> <!-- /.modal -->

<div class="modal" id="success">
	<div class="modal__title block-title">Спасибо за оставленную заявку!</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p>Наш менеджер свяжется <br />с вами в ближайшее время.</p>
	</div> <!-- /.modal__text -->
</div> <!-- /.modal --> 