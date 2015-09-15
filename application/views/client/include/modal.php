<!---Добавление в корзину--->
<div class="modal modal--to-cart" id="to-cart">
	<div class="modal__title block-title">
		Товар "<span id="popup_product_name"></span>"
		<br /> добавлен в корзину
	</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__cart modal-cart">

			<div class="form__line modal-cart__line">	
				<label class="form__label modal-cart__label">Кол-во в корзине: </label>
				<input type="text" id="popup_qty" class="form__input modal-cart__input required qty" name="amount" onchange="update_cart(document.getElementById('popup_item_id').value, this.value); return false;" placeholder="" value="" />
				<input type="hidden" id="popup_item_id" value=""/>
			</div> <!-- /.form__line -->
			
			<div class="form__button modal-cart__button">
				<button type="button" class="button button--normal button--auto-width js-close-fancybox">Вернуться к покупкам</button>
				<button type="button" class="button button--normal button--grey button--auto-width" onclick="document.location.replace('/cart/');">В корзину &rarr;</button>
			</div> <!-- /.form__button -->

	</div> <!-- /.modal__cart -->
</div> <!-- /.modal -->

<div class="modal" id="callback">
	<div class="modal__title block-title">Оставьте ваш номер телефона</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__form">
		<form action="#" id="callback_form" method="post">
			<div class="form__line">
				<input type="text" id="callback_name" class="form__input validate" name="name" placeholder="Имя" />
			</div> <!-- /.form__line -->
			
			<div class="form__line">
				<input type="tel" id="call" class="form__input validate" name="phone" placeholder="Телефон" />
			</div> <!-- /.form__line -->
			
			<div class="form__button">
				<button class="button button--normal button--auto-width" onclick="callback_submit('callback_form'); return false;">Заказать звонок</button>
			</div> <!-- /.form__button -->
		</form> <!-- /.form -->
	</div> <!-- /.modal__form -->
</div> <!-- /.modal -->

<div class="modal" id="callback_answer" style="display:none;">
	<div class="modal__title block-title">Спасибо за оставленную заявку!</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p>Наш менеджер свяжется <br />с вами в ближайшее время.</p>
	</div> <!-- /.modal__text -->
</div> <!-- /.modal --> 