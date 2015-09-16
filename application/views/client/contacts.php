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
	<? require 'include/breadcrumbs.php'?>
	
	<div class="page page-contacts">
		<div class="page__wrap wrap">
		
		<h1 class="page__title">Контакты</h1>
		
		<div class="page__content"><!-- тут может быть текст --></div> <!-- /.page__content -->
		
		<div class="page-contacts__info">
			<div class="contacts-info">
			
				<div class="contacts-info__item">
					<div class="contacts-info__copy">greenWEELS &copy; 2015</div> <!-- /.contacts-info__copy -->
					<a href="mailto:<?=$settings->admin_email?>" class="contacts-info__email"><?=$settings->admin_email?></a>
				</div> <!-- /.contacts-info__item -->
				
				<div class="contacts-info__item">
					<div class="contacts-info-phone">
						<div class="contacts-info-phone__city">Санкт-Петербург</div> <!-- /.contacts-info-phone__city -->
						<div class="contacts-info-phone__number">8(123)4567-89-00</div> <!-- /.contacts-info-phone__number -->
					</div> <!-- /.contacts-info-phone -->
				</div> <!-- /.contacts-info__item -->
				
				<div class="contacts-info__item">
					<div class="contacts-info-phone">
						<div class="contacts-info-phone__city">Москва</div> <!-- /.contacts-info-phone__city -->
						<div class="contacts-info-phone__number">8(123)4567-89-00</div> <!-- /.contacts-info-phone__number -->
					</div> <!-- /.contacts-info-phone -->
				</div> <!-- /.contacts-info__item -->
			</div> <!-- /.contacts-info -->
		</div> <!-- /.page-contacts__contacts --> 
		
		<h3>СВЯЖИТЕСЬ С НАМИ</h3>
		
		<div class="page__form">
			<form action="#" id="contact_form" class="form" where="validate_ajax" method="post">
				<input type="hidden" name="contacts" value="true"/>
				<div class="page-form">
					<div class="page-form__block">
						<div class="form__line page-form__line">
							<input type="text" class="form__input required" name="name" placeholder="Имя" />
						</div> <!-- /.form__line -->
						
						<div class="form__line page-form__line">
							<input type="email" class="form__input required email" name="email" placeholder="E-mail" />
						</div> <!-- /.form__line -->
						
						<div class="form__line page-form__line">
							<input type="tel" class="form__input required" name="phone" placeholder="Телефон" />
						</div> <!-- /.form__line -->
					</div> <!-- /.page-form__block -->
					
					<div class="page-form__block">
						<div class="form__line page-form__line">
							<textarea name="message" class="form__textarea page-form__textarea required" placeholder="Комментарий"></textarea>
						</div> <!-- /.form__line -->
					</div> <!-- /.page-form__block -->
					
					<div class="form__button page-form__button">
						<button class="button button--normal button--auto-width" onclick="submit_form('contact_form');">Отправить</button>
					</div> <!-- /.form__button -->
				</div> <!-- /.page-form -->
			</form> <!-- /.form -->
		</div> <!-- /.page__form -->

		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
    </body>
</html>

        
        