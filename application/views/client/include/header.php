<header>
	<div class="container">
		<div class="row">
			<div class="logo">
				<a href="/"><img src="<?= IMGS_PATH?>logo.png"><br>Экспресс-Оценка</a>
			</div>
			
			<div class="slogan">
				<?= $settings['slogan']->string_value?>
			</div>
			
			<a id="touch-menu" class="mobile-menu" href="#">
				<img src="<?= IMGS_PATH?>mobile.png"/>
			</a>
			
			<div class="menu rmm">
				<? require 'top-menu.php'; ?>
			</div>
			
			<div class="callme">
				<div class="phone"><a href="tel:<?= $settings['phone']->string_value?>"><?= $settings['phone']->span_value?><!--+7 (495) <span>740-37-80</span>--></a></div>
				<div class="recall"><a data-reveal-id="myModal" href="#" class="button">Заказать звонок</a></div>
			</div>
			<div class="recall_mobile">
				<a data-reveal-id="myModal" href="#" class="button"><img src="<?= IMGS_PATH?>phone.png"></a>
			</div>
		</div>
	</div>
</header>
<hr>