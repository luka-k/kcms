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

<div id="callback" class="modal">
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
				<button class="button button--normal button--auto-width callback_submit" onclick="callback(); return false;">Заказать звонок</button>
			</div> <!-- /.form__button -->
		</form> <!-- /.form -->
	</div> <!-- /.modal__form -->
</div> <!-- /.modal -->

<div class="modal" id="callback_answer" style="display:none;">
	<div id="popup_title" class="modal__title block-title"></div> <!-- /.modal__title block-title -->
	
	<div id="popup_message" class="modal__text"></div> <!-- /.modal__text -->
</div> <!-- /.modal --> 

<div class="modal" id="fast_order" style="display:none;">
	<div class="modal__title block-title">Быстрый заказ</div> <!-- /.modal__title block-title -->
	
	<form action="#" class="form" id="fast_order_form" method="post">
	<div class="fast_order_product-info">
		<div class="fast_order_image">
			<img id="fast_order_img" src="" alt="" />
		</div>
		<div class="fast_order_product_name"></div><br />
		Количество: <input type="text" id="popup_qty" class="form__input modal-cart__input required qty" name="qty" placeholder="" value="1" />							
	</div>
	<div class="fast_order_form">
	
		<div class="cart-order__form">
			
			<input type="hidden" class="product_id" name="product_id" value="" />
			
			<div class="form__line">
				<input type="text" class="form__input required" name="name" placeholder="Имя" value="<?if(isset($user->name)):?><?=$user->name?><?endif;?>"/>
			</div> <!-- /.form__line -->
							
			<div class="form__line">
				<input type="tel" class="form__input required" name="phone" placeholder="Телефон" value="<?if(isset($user->phone)):?><?=$user->phone?><?endif;?>" />
			</div> <!-- /.form__line -->
							
			<a href="#extra" class="cart-order__extra-link" onclick="$('.cart-order__extra').slideToggle();">Необязательные поля</a>
							
			<div class="cart-order__extra hidden" id="extra">
				<div class="form__line">
					<input type="text" class="form__input" name="email" placeholder="E-mail" value="<?if(isset($user->email)):?><?=$user->email?><?endif;?>" />
				</div> <!-- /.form__line -->
				
				<div class="form__line">
					<input type="text" class="form__input" name="address" placeholder="Улица" value="<?if(isset($user->address)):?><?=$user->address?><?endif;?>" />
				</div> <!-- /.form__line -->
			</div> <!-- /.cart-order__extra -->
						
			<div class="form__button cart-order__button">
				<button type="submit" class="button button--normal button--auto-width" onclick="fastOrdersubmit(); return false;">Оформить</button>
			</div> <!-- /.form__button -->
		</div> <!-- /.cart-order__form -->
	</div>
	</form> <!-- /.form -->
</div> <!-- /.modal --> 

<div class="modal" id="fast_order_answer" style="display:none;">
	<div id="popup_title" class="modal__title block-title">Спасибо за заказ</div> <!-- /.modal__title block-title -->
	
	<div id="popup_message" class="modal__text">Ваш заказ принят.<br /> Менеджер свяжется с Вами.</div> <!-- /.modal__text -->
</div> <!-- /.modal --> 

