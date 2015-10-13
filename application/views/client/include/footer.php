<footer>
	<div class="container">
		<div class="banking">
			<span>ИНН <?= $settings['inn']->string_value?> </span> <span> ОГРН <?= $settings['ogrn']->string_value?></span>
		</div>
		
		<div class="social">
			<a href="https://instagram.com/expressocenka/" target="_blank"><img src="<?= IMGS_PATH?>soc1.png"></a>
			<a href="https://vk.com/express_ocenka" target="_blank"><img src="<?= IMGS_PATH?>soc4.png"></a>
		</div>
		
		<div class="email">
			<a href="mailto:mail@ocenkaexp.ru"><?= $settings['email']->string_value?></a>
		</div>
		
		<div class="logo">
			<a href="/"><img src="<?= IMGS_PATH?>logo_footer.png"><br>Экспресс-Оценка</a>
		</div>
		
		<div class="logo_responsive">
			<a href="/"><img src="<?= IMGS_PATH?>logo2.png"></a>
		</div>
		
		<div class="menu footer">
			<ul class="nav clearfix animated">
				<li><a href="/">Главная</a></li>
				<li><a href="<?= base_url()?>about">О компании</a></li>
				<li><a href="/otsivi.html">Портфолио и отзывы</a></li>
				<li><a href="/uslugi.html">Услуги и цены</a></li>
				<!-- <li><a href="/faq.html">FAQ</a></li>-->
				<li><a href="/contact.html">Контакты</a></li>
			</ul>
		</div>
		
		<div class="callme">
			<div class="phone"><a href="tel:<?= $settings['phone']->string_value?>"><?= $settings['phone']->span_value?></a></div>
			<div class="recall"><a data-reveal-id="myModal" href="#" class="button">Заказать звонок</a></div>
		</div>
	</div>
</footer>

<? require 'scripts.php' ?>