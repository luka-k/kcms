<!DOCTYPE html> 
<html>

<? require 'include/head.php' ?>

<body>
	
	<? require 'include/top-menu.php'?>
	<? require 'include/header.php'?>
	<? require 'include/catalog-nav.php'?>
	
	<div class="page page-contacts">
		<div class="page__wrap wrap">
		
		<? require 'include/breadcrumbs.php'?>
		
		<h2 class="catalog__subtitle">Контакты</h2>
		
		<div class="page__content"><!-- тут может быть текст --></div> <!-- /.page__content -->
		
		<div class="page-contacts__info">
			<div class="contacts-info">
			
				<div class="contacts-info__item _1">
					<div class="contacts-info__copy">&copy; 2015 Книжный дом</div> <!-- /.contacts-info__copy -->
				</div> <!-- /.contacts-info__item -->
			
				<div class="contacts-info__item _2">
					<div class="footer-mail"><?=$settings->email?></div>
				</div>
			
				<div class="contacts-info__item _3">
					<div class="footer-address"><?=$settings->address?></div>
				</div>
				
				<div class="contacts-info__item _4">
					<div class="footer-phone"><?=$settings->phones[0]?></br><?=$settings->phones[1]?></div>
				</div>
				
			</div> <!-- /.contacts-info -->
		</div> <!-- /.page-contacts__contacts --> 
		
		<h2 class="catalog__subtitle">Свяжитесь с нами</h2>
		
		<div class="page__form">
			<form action="#" class="form" id="callback" method="post">
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
						<button class="button" onclick="callback_submit('callback'); return false;">Отправить</button>
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

        
        