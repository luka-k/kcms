<?require_once('include/head.php')?>    
<body>
	<?require_once('include/header.php')?> 
    <section>
        <div class="works clearfix">
            <div class="wrap">
				<div class="title" style="margin-bottom:-60px;">Наши работы</div>
						<div class="slider">
							<div name="prev" class="navy prev-slide">Предыдущая</div>
							<div name="next" class="navy next-slide">Следующая</div>
							<div class="slide-list">
								<div class="slide-wrap">	

									<?foreach($content as $work):?>
									<div class="slide-item">
										<div class="proekt clearfix">
											<div class="title-3"><?=$work->title?></div>
											<?if(isset($work->img)):?>
												<?foreach($work->img as $key => $img):?>
													<div class="works-item">
														<div class="title"><?if($key == "was"):?>БЫЛО<?elseif($key == "in_work"):?>В РАБОТЕ<?else:?>СТАЛО<?endif;?></div>
														<img src="<?=base_url()?>download/images/catalog_mid/<?=$img?>" alt=""/>
													</div>
												<?endforeach;?>
											<?endif;?>
	
											<div class="works-bottom clearfix">
												<div class="time">Срок: <span style="font-size:48px; font-weight:normal;"><?=$work->time?></span> месяца</div>
												<div class="price">Стоимость работы: <span style="font-size:48px; font-weight:normal;"><?=$work->price?></span> рублей.</div>
											</div>
											
											<p>Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам. Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам.</p>
											<p>Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам. Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам. Описание задачи, проблемы и решения. Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам.</p>
											
										<div class="txt-wrap">
											<div class="text">
												<?=$work->text?>  
											</div>
											<div class="text-bottom-left">
												&nbsp;
											</div>
										</div>
										<div class="name" style="float:left;">
											<?=$work->name?>, <span style="color:#999">страница</span> <a href="<?=$work->vk_link?>" class="vk_link">&nbsp;</a>
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

<?require_once('include/footer.php')?>
</body>
</html>
