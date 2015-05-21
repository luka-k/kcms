<header class="header" id="header">
	<div class="header__wrap wrap">
		<div class="header__logo">
			<a href="/" class="logo">RedBTR</a>
		</div> <!-- /.header__logo -->
		
		<div class="header__phone">
			<div class="header-phone">
				<div class="header-phone__number">8(123)4567-89-00</div> <!-- /.header-phone__number -->
				<div class="header-phone__time">9:00 - 18:00</div> <!-- /.header-phone__time -->
				
				<div class="header-phone__callback">
					<a href="#callback" class="header-phone__callback-link lightbox">Обратный звонок</a>
				</div> <!-- /.header-phone__callback -->
			</div> <!-- /.header-phone -->
		</div> <!-- /.header__phone -->
		
		<div class="header__login">
			<div class="header-login">
				<?if(empty($user)):?>
					<a href="<?=base_url()?>account/registration?activity=enter" class="header-login__href header-login__enter">Вход</a>
					<a href="<?=base_url()?>account/registration?activity=reg" class="header-login__href header-login__register">Регистрация</a>
				<?else:?>
					Добро пожаловать, <br/><a href="<?=base_url()?>cabinet" class="header-login__register"><?=$user->name?></a>
					<a href="<?=base_url()?>account/do_exit" class="header-login__register" style="float:right;">выход</a>
				<?endif;?>
			</div> <!-- /.header-login -->
		</div> <!-- /.header__login -->
		
		<div class="header__cart">
			<a href="<?=base_url()?>cart/" class="header-cart">
				<span class="header-cart__amount">
					<span id="cart-empty" style="<?if(empty($cart_items)):?>display:inline;<?else:?>display:none;<?endif;?>">
						Корзина пуста
					</span>
					<span  id="cart-full" style="<?if(!empty($cart_items)):?>display:inline;<?else:?>display:none;<?endif;?>">
						<span class="red total_qty"><?=$total_qty?></span> <span class="product_word"><?=$product_word?></span> <br />
						на сумму <span class="red"><span class="total_price"><?=$total_price?></span> р.</span>
					</span>
				</span> <!-- /.header-cart__cost -->
			</a> <!-- /.header-cart -->
		</div> <!-- /.header__cart -->
		
		<div class="header__callback">
			<a href="#callback" class="button button--normal button--s skew">Обратный звонок</a>
		</div> <!-- /.header__callback -->
	</div> <!-- /.header__wrap wrap -->
</header> <!-- /.header -->