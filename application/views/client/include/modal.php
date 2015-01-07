<script>

</script>

<div class="modal modal--to-cart" id="to-cart">
	<div class="modal__title block-title">
		Товар "<span class="fancy_product_name"></span>"
		<br /> добавлен в корзину
	</div> <!-- /.modal__title block-title -->
	
	<div class="modal__text">
		<p></p>
	</div> <!-- /.modal__text -->
	
	<div class="modal__cart modal-cart" >
		<form action="#" class="form to_cart" id="to_cart" method="post"> <!-- method="get" only for demo -->
			<div class="form__line modal-cart__line">	
				<label class="form__label modal-cart__label">Кол-во в корзине: </label>
				<input type="text" id="input_qty" class="form__input modal-cart__input square required qty" name="amount" placeholder="" value="" />
				<input type="hidden" id="input_item_id" value=""/>
			</div> <!-- /.form__line -->
			
			<div class="form__button modal-cart__button">
				<button type="button" class="button js-close-fancybox red-btn square" onclick="$.fancybox.close();">Вернуться к покупкам</button>
				<button type="button" class="button green-btn square" onclick="from_fancy_to_cart();return false;">В корзину &rarr;</button>
			</div> <!-- /.form__button -->
		</form> <!-- /.form -->
	</div> <!-- /.modal__cart -->
</div> <!-- /.modal -->