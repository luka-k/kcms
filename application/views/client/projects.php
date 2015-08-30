<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>Проекты</title>
		<?include 'include/head.php'?>
	</head>
	<body>
		<!-- header -->
		<? require 'include/header.php'; ?>
		
		<main>
			
			<div class="top-pro">
				<div class="wrapper">
					<h4>Наши проекты и отзывы</h4>
				</div>
			</div>

			<div class="review">
				<div class="wrapper">
					<div class="row">
						<div class="column clearfix">							
							<ul id="slider" class="bxslider clearfix">
								<?foreach($projects as $p):?>
									<li>
										<div class="column">
											<h4 class="h4-review">Проект: <strong><?=$p->name?></strong></h4>
											<div class="comment">
												<span>О проекте:</span><?=$p->description?>
											</div>
							
											<div class="clearfix" style="margin:0 auto; position:relative; width:85%;">
												<div class="sum"><?=$p->short_description?></div>
														
												<div class="wish_button">
													<a href="#win1">Хочу такой же проект</a>
												</div>
											</div>
											
											<div class="notebook">
												<div class="inside-notebook">
													<img src="<?=$p->img->projects_url?>" height="350" width="558" alt="">
												</div>
											</div>
											<div class="comments clearfix" style="display:none">
												<div class="com">
													<div class="com-img">
														<img src="img/photo.png" height="156" width="156" alt="">
													</div>
													<h5>Антон Воронов</h5>
													<span>заказчик</span>
													<p class="italic-p">Признаться, я не сразу поверил в успех Healthy Eyes – слишком большая конкуренция и заявленная цена на товар была выше среднего по российскому рынку. Но ребята из Рибы убедили меня в успехе дела, и я не прогадал! Сегодня проект уже окупился и вышел на первую прибыль. Планирую превратить его в интернет магазин.</p>
													<p><strong>Общие впечатления:</strong> Работой доволен, были косяки, но все быстро исправлялось.</p>
													<p><strong>Что не понравилось в работе:</strong> Не уложились в заявленные сроки – обещали все сделать за месяц, а делали полтора, потом еще две недели вносили правки и делали рекламную компанию.</p>
													<p><strong>Что понравилось:</strong> Честная команда, работают чисто и выполняют все договоренности. Внимательно относятся к критике.</p>
													<p><strong>Рекомендации потенциальным клиентам:</strong> Не ждите золотых гор и волшебных таблеток, вам тоже придется поработать, но оно того стоит!</p>
												</div>
											</div>
										</div>
									</li>
								<?endforeach;?>
							</ul>
							<div id="second_controll" class="clearfix">
								<a href="#" id="slider-next" >&nbsp;</a>	<a href="#" id="slider-prev" >&nbsp;</a>
							</div>
						</div>
						<div class="column">
							<div class="proj-soc">
								<p>Наша группа вконтакте </p>
								<a href="http://vk.com/ribaweb"><img src="<?=base_url()?>template/client/img/vk.png" height="34" width="34" alt=""></a>
								<a href="#book-form" class="down">Скачать бесплатную книгу</a>
								<a href="http://china.ribaweb.ru/" class="point">Оценка товара в Китае</a>
								<span class="news">Подписаться на наши новости</span>
								<form action="" method="post">
									<input type="text" name="name" class="require" placeholder="Ваше имя">
									<input type="text" name="mail" class="require" placeholder="Email">
									<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Подписаться" />
									<button>Подписаться</button>
								</form>
							</div>
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