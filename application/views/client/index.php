<?require_once('include/head.php')?>    
<body>
	<?require_once('include/header-index.php')?>    
	<section>
		<div class="info">
			<div class="wrap">
				<div class="content ">
					<div class="clearfix">
						<div class="fil-10 clearfix">
							<div class="proc">240</div>
							<div class="text">ГАРАЖЕЙ</div>
							<div class="text-2">ОТРЕМОНТИРОВАНО</div>
						</div>
						<div class="fil-50 clearfix">
							<div class="proc">2</div>
							<div class="text">ДНЯ</div>
							<div class="text-2">СРЕДНИЙ СРОК РЕМОНТА</div>
						</div>
						<div class="fil-100 clearfix">
							<div class="proc">15</div>
							<div class="text">ТЫСЯЧ РУБЛЕЙ</div>
							<div class="text-2">СРЕДНЯЯ СТОИМОСТЬ</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section>
        <div class="result">
            <div class="wrap">
                <div class="content">
					<div class="title" style="padding-bottom: 20px;">Как мы достигли таких результатов?</div>
					<div class="clearfix">
						<div class="result-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/result-1.png" alt=""/></div>
							<div class="title">Материалы в наличии</div>
							<div class="text">У нас в наличии – собственный склад со всеми материалами. Вам не потребуется ждать поступления материала в магазин, отгрузки и поставки. Все, что необходимо для проведения качественных ремонтных работ, уже готово к использованию.</div>
						</div>
						<div class="result-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/result-2.png" alt=""/></div>
							<div class="title">Надежные партнеры</div>
							<div class="text">Мы наладили партнерские отношения с производителями используемых материалов и оборудования, благодаря этому получаем большую скидку на весь ассортимент. Это, в свою очередь, позволяет нам снизить стоимость на оказываемые услуги.</div>
						</div>
						<div class="result-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/result-3.png" alt=""/></div>
							<div class="title">Скорость работы</div>
							<div class="text">Для вас работают полностью укомплектованные бригады специалистов – что позволяет гарантировать высокую скорость работы. Стаж каждого сотрудника составляет более десяти лет работы в сфере ремонта гаражей. Их опыт позволяет оказывать услуга на самом высоком уровне.</div>
						</div>
					</div>
					<div style="font-size:22px;">
						С нами вы можете быть спокойны за качество. Кроме того, вы получаете фирменную гарантию сроком на один год на любой заказ.
					</div>
				</div>
			</div>
		</div>	
	</section>
	
	<section>
        <div class="itog">
            <div class="wrap">
                <div class="content">
					<div class="title-2" style="padding-bottom: 20px;">3 основных аргумента в пользу ремонта</div>
					<div class="clearfix">
						<div class="itog-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/itog-1.png" alt=""/></div>
							<div class="title">Отсутствие сыростии</div>
							<div class="text">Протекающая крыша – а отсюда излишняя сырость и влажность – встречаются часто. Мы выполняем оперативный ремонт кровли с гарантией.</div>
						</div>
						<div class="itog-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/itog-2.png" alt=""/></div>
							<div class="title">Машина в тепле</div>
							<div class="text">Мы сможем обеспечить высокую температуру внутри гаража</div>
						</div>
						<div class="itog-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/itog-3.png" alt=""/></div>
							<div class="title">Хранение вещей</div>
							<div class="text">Соответствующие условия хранения – сухое, теплое место – здесь можно даже жить!</div>
						</div>
					</div>
					<div style="font-size:22px; color:#333">
						Итог – теплый гараж, в котором можно не только держать автомобиль, но и с удобством хранить вещи и даже отдыхать вместе с друзьями.
					</div>
				</div>
			</div>
		</div>	
	</section>
	
	<section>
        <div class="consult">
            <div class="wrap">
                <div class="content">
					<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
					<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
					<a href="#" class="btn-2">Бесплатная консультация</a>
				</div>
			</div>
		</div>	
	</section>	
	
    <section>
        <div class="otzovi clearfix">
            <div class="wrap">
				<div class="title">Отзывы наших клиентов</div>
				<div class="slider">
					<div name="prev" class="navy prev-slide">предыдущий отзыв</div>
					<div name="next" class="navy next-slide">следующий отзыв</div>
					<div class="slide-list">
						<div class="slide-wrap">
							<?$count = 1?>
							<?foreach($works as $review):?>
								<div class="slide-item clearfix">
									<div class="txt-wrap">
										<div class="text">
											<?=$review->text?>  
										</div>
										<img src="<?=base_url()?>template/client/images/otziv.png" <?if($count == 1):?>class="img-left"<?else:?>class="img-right"<?endif;?> alt=""/>
									</div>
									<div class="name" style="float:<?if($count == 1):?>left<?else:?>right<?$count = 0?><?endif;?>;">
										<?=$review->name?>, <span style="color:#999">страница</span> <a href="<?=$review->vk_link?>" class="vk_link">&nbsp;</a>
									</div>
								</div>
								<?$count++?>
							<?endforeach;?>									
						</div>
					</div>
				</div>		
            </div>
        </div>
    </section>

    <section>
        <div class="raboti clearfix">
            <div class="wrap">
				<div class="title">Наши работы</div>
				<div class="slider">
					<div name="prev" class="navy prev-slide-2">предыдущий проект</div>
					<div name="next" class="navy next-slide-2">следующий проект</div>
					<div class="slide-list">
						<div class="slide-wrap-2">
							<?foreach($works as $work):?>
								<div class="slide-item">
									<div class="proekt clearfix">
										<div class="title-3"><?=$work->title?></div>
										<?if(isset($work->img)):?>
											<div class="raboti-item">
												<div class="title">БЫЛО</div>
												<?if(isset($work->img['was'])):?>
													<a href="<?=base_url()?>download/images/catalog_big/<?=$work->img['was']->url?>" class="lightbox">
														<img src="<?=base_url()?>download/images/catalog_mid/<?=$work->img['was']->url?>" alt=""/>
													</a>
												<?endif;?>
											</div>
											<div class="raboti-item">
												<div class="title">В РАБОТЕ</div>
												<?if(isset($work->img['in_work'])):?>
													<a href="<?=base_url()?>download/images/catalog_big/<?=$work->img['in_work']->url?>" class="lightbox">
														<img src="<?=base_url()?>download/images/catalog_mid/<?=$work->img['in_work']->url?>" alt=""/>
													</a>
												<?endif;?>
											</div>
											<div class="raboti-item">
												<div class="title">СТАЛО</div>
												<?if(isset($work->img['result'])):?>
													<a href="<?=base_url()?>download/images/catalog_big/<?=$work->img['result']->url?>" class="lightbox">
														<img src="<?=base_url()?>download/images/catalog_mid/<?=$work->img['result']->url?>" alt=""/>
													</a>
												<?endif;?>
											</div>
										<?endif;?>
										<div class="proekt-bottom">
											<div class="time">Срок: <span style="font-size:48px; font-weight:normal;"><?=$work->time?></span> месяца</div>
											<div class="price">Бюджет "под ключ": <span style="font-size:48px; font-weight:normal;"><?=$work->price?></span> рублей.</div>
										</div>
									</div>
								</div>
							<?endforeach;?>	
						</div>
					</div>
				</div>		
			</div>
        </div>
    </section>
	
	<section>
        <div class="consult">
            <div class="wrap">
                <div class="content">
					<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
					<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
					<a href="#" class="btn-2">Хочу так же</a>
				</div>
			</div>
		</div>	
	</section>	

    <section>
        <div class="partneri clearfix">
            <div class="wrap">
				<div class="title-4">Наши партнеры</div>
						<div class="slider">
							<div name="prev" class="navy prev-slide-3">&nbsp;</div>
							<div name="next" class="navy next-slide-3">&nbsp;</div>
							<div class="slide-list">
								<div class="slide-wrap-3 clearfix">		
									<?foreach ($partners as $partner):?>
										<div class="slide-item">
											<a href="<?=$partner->link?>" target="_blank"><img src="<?=base_url()?>download/images/catalog_small/<?=$partner->img->url?>" alt="<?=$partner->title?>"/></a>
										</div>		 
									<?endforeach;?>
								</div>
							</div>
						</div>		
            </div>
        </div>
    </section>
<?require_once('include/footer.php')?>