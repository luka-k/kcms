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
				<a href="#login" class="header-login__href header-login__enter">Вход</a>
				<a href="#register" class="header-login__href header-login__register">Регистрация</a>
			</div> <!-- /.header-login -->
		</div> <!-- /.header__login -->
		
		<div class="header__cart">
			<a href="cart.html" class="header-cart">
				<span class="header-cart__amount">
					<?if(empty($cart_items)):?>
						Корзина пуста
					<?else:?>
						<span>2</span> товара <br />
						на сумму <span>15000 р.</span>
					<?endif;?>
				</span> <!-- /.header-cart__cost -->
			</a> <!-- /.header-cart -->
		</div> <!-- /.header__cart -->
		
		<div class="header__callback">
			<a href="#callback" class="button button--normal button--s skew">Обратный звонок</a>
		</div> <!-- /.header__callback -->
	</div> <!-- /.header__wrap wrap -->
</header> <!-- /.header -->