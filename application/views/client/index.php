<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title><?=$title?></title>
		<?include 'include/head.php'?>
		<meta content="http://ribaweb.ru/img/ribavk.jpg" property="og:image">
		<meta content="RIBA - это сообщество профессионалов, главная цель которых - помочь Вам в решении бизнес-задач как для существующих интернет-проектов, так и для планируемых." property="og:description">
	</head>
	<body>
		<!-- header -->
		<? require 'include/header.php'; ?>
		
		<main>
			
			<div class="background-top">
				<div class="wrapper">
					<div class="promo-text">
						<div class="promo-block">
							<div class="promo-div">
								<div class="block-orange-top">
									<p>Компания <span>RIBA</span> – это первое в России IT бизнес-агентство! Мы собрали у себя профессионалов в сфере бизнеса и создания сайтов. Наша главная цель – помочь своим клиентам развить предпринимательскую деятельность в интернет среде. Мы не просто создаем сайты, мы строим бизнес.</p>
								</div>
							</div>
							<div class="div-h2">Мы <span>создаем</span> интернет-бизнес</div>
							<div class="promo-div">
								<div class="block-orange-bottom">
									<p></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div id="profit"></div>
			<div class="whom">
				<div class="wrapper">
					<div class="whom-tex">
						<h4>Кому могут быть полезны наши услуги</h4>
					</div>
					<div class="whom-wrap clearfix">
						<div class="whom-block">
							<div class="whom-text">
								<div class="whom-vert">
									<h4>Начинающие предприниматели </h4>
									<p>которые только хотят начать свой бизнес в интернете</p>
								</div>
							</div>
						</div>
						<div class="whom-block">
							<div class="whom-text">
								<div class="whom-vert">
									<h4>Владельцы интернет-проектов</h4>
									<p>которые хотят повысить эффективность своего существующего бизнеса или создать еще один</p>
								</div>
							</div>
						</div>
						<div class="whom-block">
							<div class="whom-text">
								<div class="whom-vert">
									<h4>Профи интернет-бизнеса</h4>
									<p>которые хотят выйти на проекты более крупного масштаба</p>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
			<div id="offer"></div>
			<div class="prupose">
			
				<div class="background-diagonal"></div>

				<div class="wrapper">
					<h4>Что мы предлагаем?</h4>

					<div class="prupose-wrap clearfix">

						<div class="prupose-box" onclick="document.location='business-for.php'">
							<div class="prupose-img"></div>
							<h4>Интернет-бизнес <br> под ключ</h4>
							<p>Создание полноценного прибыльного интернет-бизнеса с Китаем за 2 месяца</p>
							<a href="business-for.php" class="next-link">Читать подробнее</a>
						</div>

						<div class="prupose-box" onclick="document.location='joint-business.php'">
							<div class="prupose-img"></div>
							<h4>Совместный <br> бизнес</h4>
							<p>Создание совместного бизнеса с уникальным товаром для Российского рынка</p>
							<a href="joint-business.php" class="next-link">Читать подробнее</a>
						</div>

						<div class="prupose-box" onclick="document.location='services.php'">
							<div class="prupose-img"></div>
							<h4>Технические проекты <br> любого уровня сложности</h4>
							<p>Создание сайтов, внедрение и интеграция 1С, разработка интернет-стартапов «под заказ»</p>
							<a href="services.php" class="next-link">Читать подробнее</a>
						</div>
						
					</div>
					
					<div id="free"></div>
					<div class="free">
						<h4>Что вы можете получить бесплатно?</h4>

						<div class="four">
							
							<div class="consultation cos-left">
								<h5 class="line">Бесплатная консультация</h5>
								<p>Мы проводим бесплатные консультации по ЛЮБЫМ ВАШИМ вопросам, связанным с интернет-бизнесом (1-2 вопроса которые мы разберем по скайпу)</p>
								<a href="#win1">Записаться на консультацию</a>
							</div>

							<div class="consultation cos-right">
								<h5 class="line">Поиск и оценка товара в Китае</h5>
								<p>Мы найдем вам надежного поставщика в Китае и предложим оптимальную цену на ЛЮБОЙ выбранный вами товар</p>
								<a href="http://china.ribaweb.ru/">Узнать подробнее</a>
							</div>

							<div class="consultation cos-left">
								<h5>Бесплатная книга</h5>
								<span class="line">«Вся суть интернет-бизнеса за 40 минут»</span>
								<p>Коротко и ёмко. Без воды и лишних слов. Внедрив всё то, что написано в книге вы увеличите свою прибыль. Гарантируем.</p>
								<form action="" method="post" id="loadbook">
									<input type="text" name="name" placeholder="Ваше имя">
									<input type="text" name="mail" placeholder="Email">
									<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Получить книгу" />
									<button>Получить книгу</button>
								</form>
							</div>

							<div class="consultation cos-right">
								<h5 class="line">Рассылка актуальной информации</h5>
								<p>Рассылка актуальной и полезной информации по интернет-бизнесу и бизнесу с Китаем</p>
								<form action="" method="post">
									<input type="text" name="name" class="required" placeholder="Ваше имя">
									<input type="text" name="mail" class="required" placeholder="Email">
									<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Подписаться на рассылку" />
									<button>Подписаться</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="difference"></div>
			<div class="defferance-wrap">
				<div class="wrapper">
				
					<div class="defferance-h5">Что отличает нас от других?</div>

					<div class="defferance-block">

						<div class="defferance-box">
							<div class="defferance-img">
								<img src="<?=base_url()?>template/client/img/differance-img1.png" height="118" width="112" alt="">
							</div>
							<p>Мы IT бизнес-агентство</p>
							<div class="defferance-text">Наша работа это не только создание сайтов, мы умеем строить бизнес так же хорошо, как умеем делать сайты</div>
						</div>

						<div class="defferance-box">
							<div class="defferance-img">
								<img src="<?=base_url()?>template/client/img/differance-img2.png" height="128" width="126" alt="">
							</div>
							<p>У нас есть собственные проекты</p>
							<div class="defferance-text">У нас есть собственные проекты, которые успешно развиваются и масштабируются на Российском рынке. А есть ли они у других? Проверьте... =)</div>
						</div>

						<div class="defferance-box">
							<div class="defferance-img">
								<img src="<?=base_url()?>template/client/img/differance-img3.png" height="103" width="96" alt="">
							</div>
							<p>Мы сначала думаем,<br> а потом делаем. Всегда.</p>
						</div>

						<div class="defferance-box">
							<div class="defferance-img">
								<img src="<?=base_url()?>template/client/img/differance-img4.png" height="102" width="121" alt="">
							</div>
							<p>Мы не рассказываем всем, что мы идеальны</p>
							<div class="defferance-text">У нас тоже есть ошибки, которые мы совершили на пути к своей цели.  Именно они нас научили тому, как делать интернет-бизнес правильно</div>
						</div>

						<div class="defferance-box">
							<div class="defferance-img">
								<img src="<?=base_url()?>template/client/img/differance-img5.png" height="74" width="119" alt="">
							</div>
							<p>Мы не занимаемся конвейерным производством</p>
							<div class="defferance-text">Каждый проект для нас - как живой человек, со своим характером, к которому мы находим индивидуальный подход</div>
						</div>

					</div>
				</div>
				
			</div>
			
			<div id="trust"></div>
			<div class="wrapper">
				<div class="confidence">
					<h4>Нам доверяют</h4>
					<div class="confidence-block clearfix">
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img1.png" height="103" width="157" alt="">
						</div>
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img2.png" height="103" width="178" alt="">
						</div>
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img3.png" height="103" width="178" alt="">
						</div>
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img4.png" height="103" width="178" alt="">
						</div>
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img5.png" height="103" width="158" alt="">
						</div>
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img6.png" height="103" width="178" alt="">
						</div>
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img7.png" height="103" width="178" alt="">
						</div>
						<div class="confidence-img">
							<img src="<?=base_url()?>template/client/img/confidence-img8.png" height="103" width="178" alt="">
						</div>
					</div>
				</div>
			</div>

		</main>
		
		<!-- footer -->
		<? require 'include/footer.php'; ?>

		<!-- scripts -->
		<? require 'include/scripts.php'; ?>

		<!-- pop-up -->
	    <? require 'include/popup.php'; ?>

	</body>
</html>