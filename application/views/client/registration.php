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
		<div class="page__wrap wrap">
			<h1 class="page__title"><?if($reg):?>Регистрация<?else:?>Войти<?endif;?></h1>

			<div class="cart-order__form">
				<div class="<?if($reg):?>hidden<?endif;?>" style="margin-bottom:20px;">
					<form action="<?=base_url()?>cabinet" id="enter_form" method="post">
						<div class="form__line skew">
							<input type="text" class="form__input required" name="email" placeholder="E-mail" />
						</div> <!-- /.form__line -->
							
						<div class="form__line skew">
							<input type="password" class="form__input required" name="password" placeholder="Пароль" />
						</div> <!-- /.form__line -->
							
						<div class="form__button skew">
							<button type="submit" class="button button--normal button--auto-width" onclick="document.forms['enter_form'].submit(); return false;">Войти</button>
						</div> <!-- /.form__button -->
					</form>
				</div>
							
				<a href="#extra" class="cart-order__extra-link <?if($reg):?>hidden<?endif;?>">Регистрация</a>
							
				<div class="cart-order__extra <?if($reg == FALSE):?>hidden<?endif;?>" id="extra">
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
							<button type="submit" class="button button--normal button--auto-width"  onclick="document.forms['registr_form'].submit(); return false;">Регистрация</button>
						</div> <!-- /.form__button -->
						
					</form>
				</div> <!-- /.cart-order__extra -->				
			</div> <!-- /.cart-order__form -->
			
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	</body>
</html>