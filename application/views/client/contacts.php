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
					<div class="contacts-info__copy">redBTR &copy; 2015</div> <!-- /.contacts-info__copy -->
					<a href="mailto:<?=$settings->admin_email?>" class="contacts-info__email"><?=$settings->admin_email?></a>
				</div> <!-- /.contacts-info__item -->
				
				<? $filials = $this->filials->get_list(FALSE);
				foreach ($filials as $f):?>
				<div class="contacts-info__item">
					<div class="contacts-info-phone">
						<div class="contacts-info-phone__city"><?= $f->name?></div> <!-- /.contacts-info-phone__city -->
						<div class="contacts-info-phone__number"><?= $f->phone?></div> <!-- /.contacts-info-phone__number -->
					</div> <!-- /.contacts-info-phone -->
				</div> <!-- /.contacts-info__item -->
				<? endforeach ?>
			</div> <!-- /.contacts-info -->
		</div> <!-- /.page-contacts__contacts --> 
		
		<h3>СВЯЖИТЕСЬ С НАМИ</h3>
		
		<div class="page__form">
			<form action="#" class="form" where="validate_ajax" method="post">
				<input type="hidden" name="contacts" value="true"/>
				<div class="page-form">
					<div class="page-form__block">
						<div class="form__line page-form__line skew">
							<input type="text" class="form__input required" name="name" placeholder="Имя" />
						</div> <!-- /.form__line -->
						
						<div class="form__line page-form__line skew">
							<input type="email" class="form__input required email" name="email" placeholder="E-mail" />
						</div> <!-- /.form__line -->
						
						<div class="form__line page-form__line skew">
							<input type="tel" class="form__input required" name="phone" placeholder="Телефон" />
						</div> <!-- /.form__line -->
					</div> <!-- /.page-form__block -->
					
					<div class="page-form__block">
						<div class="form__line page-form__line skew">
							<textarea name="message" class="form__textarea page-form__textarea required" placeholder="Комментарий"></textarea>
						</div> <!-- /.form__line -->
					</div> <!-- /.page-form__block -->
					
					<div class="form__button page-form__button skew">
						<button class="button button--normal button--auto-width">Отправить</button>
					</div> <!-- /.form__button -->
				</div> <!-- /.page-form -->
			</form> <!-- /.form -->
		</div> <!-- /.page__form -->

		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>

    </body>
</html>

        
        