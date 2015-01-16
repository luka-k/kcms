<div class="modal modal--to-cart" id="to-cart">
	<div class="modal__title block-title">
		Товар "<span class="fancy_product_name"></span>"
		<br /> добавлен в корзину
	</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__cart modal-cart" >
	<!--	<form action="#" class="form to_cart" id="to_cart" method="post"> <!-- method="get" only for demo -->
			<div class="form__line modal-cart__line">	
				<label class="form__label modal-cart__label">Кол-во в корзине: </label>
				<input type="hidden" id="input_item_id" value=""/>
				<input type="text" id="input_qty" class="form__input modal-cart__input square required qty" onchange="update_cart(document.getElementById('input_item_id').value, this.value); return false;" name="amount" placeholder="" value="" />
			</div> <!-- /.form__line -->
		<!--</form> <!-- /.form -->
		
		<div class="form__button modal-cart__button">
			<button type="button" class="button js-close-fancybox red-btn square" onclick="$.fancybox.close();">Вернуться к покупкам</button>
			<button type="button" class="button green-btn square" onclick="document.location.replace('/cart/');">В корзину &rarr;</button>
		</div> <!-- /.form__button -->
		
	</div> <!-- /.modal__cart -->
</div> <!-- /.modal -->


<div class="modal modal--to-cart" id="to-order">
	<div class="modal__title block-title">
		Заказ товара - "<span class="fancy_product_name"></span>"
	</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__cart modal-cart" >
		<form action="/order/edit_order?action=order" class="fast_order" id="to-order" method="post"> <!-- method="get" only for demo -->
			<input type="hidden" id="order_item_id" name="item_id"/>
			<div id="order-modal" class="col_12">
				<label for="text1">Имя</label><br/>	
				<input id="text1" type="text" name="name" class="validate square"/><br/>	
				<label for="text2">Эл. почта</label><br/>	
				<input id="text2" type="text" name="email" class="validate square"/><br/>	
				<label for="text1">Телефон</label><br/>	
				<input id="text1" type="text" name="phone" class="validate square"/><br/>
				<label for="textarea1">Коментарии</label><br/>	
				<textarea id="textarea1" placeholder="При необходимости оставьте коментарий" name="message" class="square"/></textarea>								
			</div>
			<div class="form__button modal-cart__button">
				<button type="button" class="button green-btn square" onclick="validate_form('to-order');">Заказать &rarr;</button>
			</div> <!-- /.form__button -->
		</form> <!-- /.form -->

	</div> <!-- /.modal__cart -->
</div> <!-- /.modal -->