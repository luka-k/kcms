<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>Контакты</title>
		<?include 'include/head.php'?>
	</head>
	<body>
		<!-- header -->
		<? require 'include/header.php'; ?>
		
		<main>
			
			<div class="top-pro">
				<div class="wrapper">
					<h4>Контакты</h4>
				</div>
			</div>

			<div class="review">
				<div class="wrapper">
					<div class="row">

						<div class=" clearfix column-about">
							<div class="contacts1">Адрес в России: <strong>Санкт-Петербург, 5-я советская, д. 45</strong></div>
							<div class="contacts1">Телефон: <strong>+7 (812) 416-56-78</strong></div>
							<div class="contacts1">Адрес в Китае: <strong>г.Гуанчжоу: 106，Bai’an Business Center, 128th Huangcun Road, Tianhe District Guangzhou,China</strong></div>
							<div class="contacts2">
								<p>E-mail по всем вопросам: <a href="#">info@ribaweb.ru</a></p>
								<p><span>По вопросам рекламы и сотрудничества:</span></p>
								<p>Антон Матюшин <a href="mailto:a.matiushin@ribaweb.ru">a.matiushin@ribaweb.ru</a></p>
								<p>Роман Лантух <a href="mailto:r.lantuh@ribaweb.ru">r.lantuh@ribaweb.ru</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1998.9736262863291!2d30.3750334!3d59.9325798!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x469631bdd4080baf%3A0x72739f4ef9a8a762!2zNS3RjyDQodC-0LLQtdGC0YHQutCw0Y8g0YPQuy4sIDQ1LCDQodCw0L3QutGCLdCf0LXRgtC10YDQsdGD0YDQsywgMTkxMDI0!5e0!3m2!1sru!2sru!4v1436372589441" width="600" height="450" frameborder="0" style="border:0" class="map-contact" allowfullscreen></iframe>

			<div class="contacts-form">
				<div class="wrapper">
					<h4>Оставить заявку или задать вопрос</h4>
					<form action="" class="clearfix" method="post">
						<input type="text" class="required" name="name" placeholder="Ваше имя">
						<input type="text" class="required" name="phone" placeholder="Телефон">
						<input type="text" class="required" name="mail" placeholder="E-mail">
		<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Задать вопрос" />
						<textarea name="message" class="required" cols="30" rows="10" placeholder="Ваш комментарий"></textarea>
						<button>Отправить</button>
					</form>
				</div>
			</div>
		</main>
		
		<!-- footer -->
		<div class="contacts">
			<? require 'include/footer.php'; ?>
		</div>

		<!-- scripts -->
		<? require 'include/scripts.php'; ?>

		<!-- pop-up -->
	    <? require 'include/popup.php'; ?>
	    
	</body>
</html>