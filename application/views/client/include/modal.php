<div class="modal modal--to-cart" id="to-cart">
	<div class="modal__title block-title">
		Товар "<span>Диск колесный</span>"
		<br /> добавлен в корзину
	</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__cart modal-cart">
		<form action="<?=base_url()?>catalog/cart" class="form" method="post"> <!-- method="get" only for demo -->
			<div class="form__line modal-cart__line skew">	
				<label class="form__label modal-cart__label">Кол-во в корзине: </label>
				<input type="text" class="form__input modal-cart__input required" name="amount" placeholder="" value="1" />
			</div> <!-- /.form__line -->
			
			<div class="form__button modal-cart__button skew">
				<button type="button" class="button button--normal button--auto-width js-close-fancybox">Вернуться к покупкам</button>
				<button type="submit" class="button button--normal button--grey button--auto-width">В корзину &rarr;</button>
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
		<form action="#" class="form" method="post">
			<div class="form__line skew">
				<input type="text" class="form__input required" name="name" placeholder="Имя" />
			</div> <!-- /.form__line -->
			
			<div class="form__line skew">
				<input type="tel" class="form__input required" name="phone" placeholder="Телефон" />
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