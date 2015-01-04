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
	
	<div class="page page-dealers">
		<div class="page__wrap wrap">
			<? require 'include/nav/sub_nav.php'?>
			
			<h1 class="page__title">Как стать дилером</h1>
			
			<div class="page__content"><!-- тут может быть текст --></div> <!-- /.page__content -->
			
			<div class="page__form">
				<form action="#" class="form" where="validate_ajax" method="post">
					<input type="hidden" name="dealer" value="true"/>
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
							<button class="button button--normal button--auto-width">Отправить заявку</button>
						</div> <!-- /.form__button -->
					</div> <!-- /.page-form -->
				</form> <!-- /.form -->
			</div> <!-- /.page__form -->
			
			<div class="page-dealers__map">
			
			</div> <!-- /.page-dealers__map -->
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>

    </body>
</html>

        
        