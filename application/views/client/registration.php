<!DOCTYPE html>
<!--[if lte IE 9]>      
	<html class="no-js lte-ie9">
<![endif]-->
<!--[if gt IE 8]><!--> 
	<html class="no-js">
<!--<![endif]-->

<? require 'include/head.php' ?>
    
<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->

	<? require 'include/header.php'?>
	<? require 'include/top-menu.php'?>

	<div class="page page-about">
		<div class="page-cart__order">
			<h1 class="page__title">
				<?if($activity == "enter"):?>
					Войти
				<?elseif($activity == "reg"):?>
					Регистрация
				<?elseif($activity == "restore" || $activity == "new"):?>
					Востановление пароля
				<?endif;?>
			</h1>

			<div class="cart-order__form">
				<div class="<?if($activity <> "enter"):?>hidden<?endif;?>" style="margin-bottom:20px;">
					<form action="<?=base_url()?>account/do_enter" id="enter_form" method="post">
						<div class="form__line skew">
							<input type="text" class="form__input required" name="email" placeholder="E-mail" autocomplete="off"/>
						</div> <!-- /.form__line -->
							
						<div class="form__line skew">
							<input type="password" class="form__input required" name="password" placeholder="Пароль" autocomplete="off"/>
						</div> <!-- /.form__line -->
							
						<div class="form__button skew">
							<button type="submit" class="button button--normal button--auto-width" >Войти</button>
							<a href="<?=base_url()?>account/restore_password/" style="float:right;">Забыли пароль?</a>
						</div> <!-- /.form__button -->
					</form>
				</div>
							
				<a href="#extra" class="cart-order__extra-link <?if($activity <> "enter"):?>hidden<?endif;?>">Регистрация</a>
							
				<div class="cart-order__extra <?if($activity <> "reg"):?>hidden<?endif;?>" id="extra">
					<form action="<?=base_url()?>/account/new_user" id="registr_form" method="post">
						<div class="form__line skew">
							<input type="text" class="form__input required" name="name" placeholder="Имя" value="<?=set_value('name')?>"/>
						</div> <!-- /.form__line -->
						
						<div class="form__line skew">
							<input type="text" class="form__input required" name="email" placeholder="E-mail" value="<?=set_value('email')?>"/>
						</div> <!-- /.form__line -->
						
						<div class="form__line skew">
							<input type="password" class="form__input required" name="password" placeholder="Пароль" />
						</div> <!-- /.form__line -->
						<div class="form__line skew">
							<input type="password" class="form__input required" name="conf_password" placeholder="Повторите пароль" />
						</div> <!-- /.form__line -->
						
						<div class="form__button skew">
							<button type="submit" class="button button--normal button--auto-width" >Регистрация</button>
						</div> <!-- /.form__button -->
						
					</form>
				</div> <!-- /.cart-order__extra -->		

				<div class="cart-order__extra <?if($activity <> "restore"):?>hidden<?endif;?>">
					<form action="<?=base_url()?>/account/restore_password_mail" id="reset_form" method="post">
						
						<div class="form__line skew">
							<input type="text" class="form__input required" name="email" placeholder="Введите e-mail" />
						</div>
					
						<div class="form__button skew">
							<button type="submit" class="button button--normal button--auto-width" >Востановить</button>
						</div> <!-- /.form__button -->
					</form>
				</div>
				
				<div class="cart-order__extra <?if($activity <> "new"):?>hidden<?endif;?>">
					<form action="<?=base_url()?>account/change_password" id="new_pass_form" method="post">
						<input type="hidden" name="user_email" value="<?if(isset($email)):?><?=$email?><?endif;?>"/>
						<input type="hidden" name="secret" value="<?if(isset($secret)):?><?=$secret?><?endif;?>"/>
						<div class="form__line skew">
							<input type="password" class="form__input required" name="password" placeholder="Пароль" />
						</div> <!-- /.form__line -->
						<div class="form__line skew">
							<input type="password" class="form__input required" name="conf_password" placeholder="Повторите пароль" />
						</div> <!-- /.form__line -->
					
						<div class="form__button skew">
							<button type="submit" class="button button--normal button--auto-width" >Установить</button>
						</div> <!-- /.form__button -->
					</form>
				</div>
			</div> <!-- /.cart-order__form -->
			
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	</body>
</html>