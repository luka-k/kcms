<?require_once('include/head.php')?>    
<body>

    <!-- HEADER & LOGO -->
    <header>
        <div class="header-top">
            <div class="wrap">
                <div class="content">
                    <div class="logo">
                        <a href="<?=base_url()?>main"><img src="<?=base_url()?>template/client/images/logo.png" alt="" /></a>
                    </div>
                    <div class="phone">
                        <span class="ph"><span class="ph-style">+7(921)</span>123 45 67</span>
                    </div>
					<div class="search">
						<input type="text" name="search" />
					</div>
                    <div class="order-phone">
                        <a href="#callrequest" class="btn js-callback callback-phone fancybox">Заказать звонок</a>
                    </div>
                </div>
            </div>
        </div>
	
        <div class="nav-bg"></div>
        <div class="nav">
            <div class="wrap-2">
                <?require_once('include/top-menu.php')?>
            </div>
        </div>
	</header>
	
    <section>
        <div class="works clearfix">
            <div class="wrap">
				<div class="title">Наши работы</div>
						<div class="slider">
							<div name="prev" class="navy prev-slide">предыдущий проект</div>
							<div name="next" class="navy next-slide">следующий проект</div>
							<div class="slide-list">
								<div class="slide-wrap">	

									<?foreach($content as $work):?>
									<div class="slide-item">
										<div class="proekt clearfix">
											<div class="title-3"><?=$work->title?></div>
											<?foreach($work->img as $key => $img):?>
												<div class="works-item">
													<div class="title"><?if($key == "was"):?>БЫЛО<?elseif($key == "in_work"):?>В РАБОТЕ<?else:?>СТАЛО<?endif;?></div>
													<img src="<?=base_url()?>download/images/catalog_mid/<?=$img?>" alt=""/>
												</div>
											<?endforeach;?>
											<!--<div class="works-item">
												<div class="title">В РАБОТЕ</div>
												<img src="<?=base_url()?>download/images/<?=$work->img['in_work']?>" alt=""/>
											</div>
											<div class="works-item">
												<div class="title">СТАЛО</div>
												<img src="<?=base_url()?>download/images/<?=$work->img['result']?>" alt=""/>
											</div>-->
											
											<div class="works-bottom clearfix">
												<div class="time">Срок: <span style="font-size:48px; font-weight:normal;"><?=$work->time?></span> месяца</div>
												<div class="price">Бюджет "под ключ": <span style="font-size:48px; font-weight:normal;"><?=$work->price?></span> рублей.</div>
											</div>
											
											<p>Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам. Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам.</p>
											<p>Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам. Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам. Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам.</p>
											
										<div class="txt-wrap">
											<div class="text">
												<?=$work->text?>  
											</div>
											<img src="<?=base_url()?>template/client/images/otziv.png" class="img-left" alt=""/>
										</div>
										<div class="name" style="float:left;">
											<?=$work->name?>, <span style="color:#999">страница</span> <a href="<?=$work->vk_link?>" class="vk_link">&nbsp;</a>
										</div>											
										</div>
									</div>	
									<?endforeach;?>

									
									<!--<div class="slide-item">
										<div class="proekt clearfix">
											<div class="title-3">Гараж на ул. Кораблестроителей  во дворе д. 25</div>
											<div class="works-item">
												<div class="title">БЫЛО</div>
												<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
											</div>
											<div class="works-item">
												<div class="title">В РАБОТЕ</div>
												<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
											</div>
											<div class="works-item">
												<div class="title">СТАЛО</div>
												<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
											</div>
											<div class="works-bottom">
												<div class="time">Срок: <span style="font-size:48px; font-weight:normal;">1,5</span> месяца</div>
												<div class="price">Бюджет "под ключ": <span style="font-size:48px; font-weight:normal;">150 000</span> рублей.</div>
											</div>
										</div>
									</div>	-->	
								</div>
							</div>
						</div>		

            </div>
        </div>
    </section>

<?require_once('include/footer.php')?>
</body>
</html>
