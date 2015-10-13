<!DOCTYPE html>

<html class="no-js">

<? require 'include/head.php'; ?>

<body>
	<? require 'include/header.php'; ?>
	<? require 'include/modal.php'; ?>
	<? require 'include/slider.php'; ?>
	
	<div class="services">
		<div class="container">
			
			<div class="service">
				<div class="service_name"><a href="/dtp.html"><?= $settings['main_autoexpertiza']->string_value?></a></div>
				<div class="service_img"><a href="/dtp.html"><img src="<?= IMGS_PATH?>serv1.png"></a></div>
				<div class="service_text"><?= $settings['main_autoexpertiza']->text_value?></div>
				<a data-reveal-id="myModal1" href="#" class="service_button desktop"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
				<a  href="tel:+74957403780" class="service_button mobile"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
            </div>
			
			<div class="service">
				<div class="service_name"><a href="/nedviz.html"><?= $settings['main_nedvigimost']->string_value?></a></div>
				<div class="service_img"><a href="/nedviz.html"><img src="<?= IMGS_PATH?>serv2.png"></a></div>
				<div class="service_text"><?= $settings['main_nedvigimost']->text_value?></div>
				<a data-reveal-id="myModal1" href="#" class="service_button desktop"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
				<a  href="tel:+74957403780" class="service_button mobile"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
			</div>
			
			<div class="service">
				<div class="service_name"><a href="/zaliv.html"><?= $settings['main_zaliv']->string_value?></a></div>
				<div class="service_img"><a href="/zaliv.html"><img src="<?= IMGS_PATH?>serv3.png"></a></div>
				<div class="service_text"><?= $settings['main_zaliv']->text_value?></div>
				<a data-reveal-id="myModal1" href="#" class="service_button desktop"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
				<a  href="tel:+74957403780" class="service_button mobile"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
			</div>

        </div>
    </div>
	
	<div class="advantages">
		<div class="container">
			<h1>Преимущества работы с нами</h1>
			
			<div class="advantage">
				<div class="advantage_img"><img src="<?= IMGS_PATH?>adven1.png"></div>
				<div class="advantage_name"><?= $settings['main_ocenka']->string_value?></div>
				<div class="advantage_text"><?= $settings['main_ocenka']->text_value?></div>
			</div>
			
			<div class="advantage">
				<div class="advantage_img"><img src="<?= IMGS_PATH?>adven2.png"></div>
				<div class="advantage_name"><?= $settings['main_finance']->string_value?></div>
				<div class="advantage_text"><?= $settings['main_finance']->text_value?></div>
			</div>
			
			<div class="advantage">
				<div class="advantage_img"><img src="<?= IMGS_PATH?>adven3.png"></div>
				<div class="advantage_name"><?= $settings['main_zatrat']->string_value?></div>
				<div class="advantage_text"><?= $settings['main_zatrat']->text_value?></div>
			</div>
		</div>
	</div>
	
	<div class="about_us">
		<div class="container">
			
			<div class="about">
				<h2>О компании</h2>
				<p class="about_img"><img src="<?= IMGS_PATH?>company.jpg"><span><?= $settings['main_about']->string_value?></span></p>
				<p class="about_text">
					<?= $settings['main_about']->text_value?>
					<a class="about_button" data-reveal-id="myModal2" href="#">Заказать у нас оценку</a>
				</p>
			</div>
			
			<div class="about">
				<h2>Факты о нас</h2>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_money']->string_value?><!--135<span>млн.</span>--></p>
						<p class="facts_text"><?= $settings['facts_money']->text_value?></p>
					</div>
				</div>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_expertiz']->string_value?></p>
						<p class="facts_text"><?= $settings['facts_expertiz']->text_value?></p>
					</div>
				</div>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_procent']->string_value?></p>
						<p class="facts_text"><?= $settings['facts_procent']->text_value?></p>						
					</div>
				</div>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_time']->string_value?></p>
						<p class="facts_text"><?= $settings['facts_time']->text_value?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="documents">
		<div class="container">
			<h2>Разрешительные документы</h2>
			
			<div class="owl-carousel2">
				<?foreach($documents as $doc):?>
					<div class="item">
						<div class="document">
							<a class="example-image-link" href="<?= $doc->img->full_url?>" data-lightbox="example-set">
								<img class="example-image" src="<?= $doc->img->documents_url?>" alt="<?= $doc->name?>" />
							</a>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
	
	<div class="popular_services">
		<div class="container">
			<h1>Популярные услуги</h1>
			
			<? foreach($services as $s): ?>
				<div class="popular_service">
					<div class="popular_service_image"><img src="<?= $s->img->articles_url?>"></div>
					<div class="popular_service_text">
						<h3><?= $s->name?></h3>
						<?= $s->description?>
						<a href="<?= $s->full_url?>">Читать подробнее</a>
					</div>
				</div>
			<? endforeach; ?>
		</div>
	</div>
	
	<div class="testimonial">
        <div class="container">
            <h1>Отзывы</h1>
            <div class="owl-carousel1">
				
				<? foreach($testimonials as $t): ?>
					<div class="item">
						<div class="testimonial_block">
							<div class="testimonial_image">
								<img src="<?= $t->img->testimonials_url?>">
								<p><?= $t->name?></p>
								<!--	<a href="https://vk.com/id135470543">https://vk.com/id135470543</a>-->
							</div>
							
							<div class="testimonial_text">
								<p class="testimonial_name"><?= $t->title?></p>
								<p class="testimonial_body"><?= $t->description?></p>
								
								<a href="<?= $t->file->full_url?>" target="_blank">Посмотреть отчет</a>
							</div>
						</div>
					</div>
				<? endforeach; ?>
			</div>
			<a class="testimonial_button" href="/otsivi.html">Посмотреть все отзывы</a>
		</div>
	</div>

<!--
    <div class="partners">
        <div class="container">
            <h1>Наши партнеры</h1>

            <div class="owl-carousel">
                <div class="item"><img src="/images/p1.png"></div>

                <div class="item"><img src="/images/p2.png"></div>

                <div class="item"><img src="/images/p3.png"></div>

                <div class="item"><img src="/images/p4.png"></div>

                <div class="item"><img src="/images/p5.png"></div>

                <div class="item"><img src="/images/p6.png"></div>

                <div class="item"><img src="/images/p1.png"></div>

                <div class="item"><img src="/images/p2.png"></div>

                <div class="item"><img src="/images/p3.png"></div>

                <div class="item"><img src="/images/p4.png"></div>

                <div class="item"><img src="/images/p5.png"></div>
            </div>
        </div>

    </div>

-->

	<? require 'include/footer.php'; ?>
</body>

</html>