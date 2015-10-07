<footer class="footer" id="footer">
	<div class="footer__wrap wrap">
		<div class="footer__subscribe">
			<div class="subscribe">
				<div class="subscribe__title">
					Для наших подписчиков - скидки, новинки и полезные советы!
				</div> <!-- /.subscribe__title -->
				
				<div class="subscribe__form">
					<div class="subscribe-form">
						<form action="#" class="form" where="validate_ajax" id="subscribe_form" method="post">
							<div class="subscribe-form__line">
								<input type="text" class="form__input subscribe-form__input required email" name="email" placeholder="" />
							</div> <!-- /.subscribe__line -->
							
							<div class="subscribe-form__button">
								<button class="button button--normal" onclick="">Подписаться</button>
							</div> <!-- /.subscribe__button -->
						</form> <!-- /.form -->
					</div> <!-- /.subscribe-form -->
				</div> <!-- /.subscribe__form -->
			</div> <!-- /.subscribe -->
		</div> <!-- /.footer__subscribe -->
		
		<? require 'footer-nav.php'?>
		
		<div class="footer__contacts">
			<div class="contacts-info">
				<div class="contacts-info__item">
					<div class="contacts-info__copy"><?=$settings->site_title?> &copy; 2015</div> <!-- /.contacts-info__copy -->
					<a href="mailto:<?=$settings->admin_email?>" class="contacts-info__email"><?=$settings->admin_email?></a>
				</div> <!-- /.contacts-info__item -->

			</div> <!-- /.contacts-info -->
		</div> <!-- /.footer__contacts -->
	</div> <!-- /.footer__wrap wrap -->
</footer> <!-- /.header -->