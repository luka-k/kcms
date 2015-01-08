<footer class="footer" id="footer">
	<div class="footer__wrap wrap">
		<div class="footer__subscribe">
			<div class="subscribe skew">
				<div class="subscribe__title">
					Для наших подписчиков - скидки, новинки и полезные советы!
				</div> <!-- /.subscribe__title -->
				
				<div class="subscribe__form">
					<div class="subscribe-form">
						<form action="#" class="form" method="post">
							<div class="subscribe-form__line">
								<input type="text" class="form__input subscribe-form__input required email" name="email" placeholder="" />
							</div> <!-- /.subscribe__line -->
							
							<div class="subscribe-form__button">
								<button class="button button--normal">Подписаться</button>
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
					<div class="contacts-info__copy">redBTR &copy; 2015</div> <!-- /.contacts-info__copy -->
					<a href="mailto:<?=$settings->admin_email?>" class="contacts-info__email"><?=$settings->admin_email?></a>
				</div> <!-- /.contacts-info__item -->
				
				<? $filials = $this->filials->get_list(FALSE);
				foreach ($filials as $f):?>
				
				<div class="contacts-info__item">
					<div class="contacts-info-phone contacts-info-phone--footer">
						<div class="contacts-info-phone__city"><?= $f->name?></div> <!-- /.contacts-info-phone__city -->
						
						<div class="contacts-info-phone__number"><?= $f->phone?></div> <!-- /.contacts-info-phone__number -->
					</div> <!-- /.contacts-info-phone -->
				</div> <!-- /.contacts-info__item -->
				<? endforeach ?>
			</div> <!-- /.contacts-info -->
		</div> <!-- /.footer__contacts -->
	</div> <!-- /.footer__wrap wrap -->
</footer> <!-- /.header -->