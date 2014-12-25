<header class="header" id="header">
	<div class="header__wrap wrap">
		<div class="header__logo">
			<a href="/" class="logo">RedBTR</a>
		</div> <!-- /.header__logo -->
		
		<div class="header__phone">
			<div class="header-phone">
				<div class="header-phone__number">+7 (812) <span>999 99 99</span></div> <!-- /.header-phone__number -->
				<div class="header-phone__time">время работы: пн-пт 8:00-18:00</div> <!-- /.header-phone__time -->
				
				<div class="header-phone__callback">
					<a href="#callback" class="header-phone__callback-link fancybox">Обратный звонок</a>
				</div> <!-- /.header-phone__callback -->
			</div> <!-- /.header-phone -->
		</div> <!-- /.header__phone -->
		
		<div class="header__login">
			<div class="header-login">
				<a href="<?=base_url()?>account/registration?activity=enter" class="header-login__href header-login__enter">Вход</a>
				<a href="<?=base_url()?>account/registration?activity=reg" class="header-login__href header-login__register">Регистрация</a>
			</div> <!-- /.header-login -->
		</div> <!-- /.header__login -->
		
		<div class="header__cart">
			<a href="<?=base_url()?>cart/" class="header-cart">
				<span class="header-cart__amount">
					<span id="cart-empty" style="<?if(empty($cart_items)):?>display:inline;<?else:?>display:none;<?endif;?>">
						Корзина пуста
					</span>
					<span  id="cart-full" style="<?if(!empty($cart_items)):?>display:inline;<?else:?>display:none;<?endif;?>">
						<span id="total_qty" class="red"><?=$total_qty?></span> <span class="product_word"><?=$product_word?></span> <br />
						на сумму <span class="red"><span id="total_price"><?=$total_price?></span> р.</span>
					</span>
				</span> <!-- /.header-cart__cost -->
			</a> <!-- /.header-cart -->
		</div> <!-- /.header__cart -->
		
		<div class="header__callback">
			<a href="#callback" class="button button--normal button--s skew">Обратный звонок</a>
		</div> <!-- /.header__callback -->
	</div> <!-- /.header__wrap wrap -->
</header> <!-- /.header -->