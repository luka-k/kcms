<!DOCTYPE html>

<html class="no-js">

<?require 'include/head.php'?>

<body>
    <?require 'include/header.php'?>
	
	<?require 'include/modal.php'?>
	
	<?require 'include/top-menu.php'?>
	
	<?require 'include/slider.php'?>

    <div class="services">
        <div class="container">
            <a data-reveal-id="myModal1" href="#">
            <div class="service">
                <div class="service_order">
                    <p>Заказать услугу</p><span>Оформите заявку на одну или
                    несколько услуг компании</span>
                </div>
            </div></a> 
			
			<a data-reveal-id="myModal2" href="#">
            <div class="service">
                <div class="service_support">
                    <p>Обратиться за поддержкой</p><span>Специалисты
                    технической поддержки рады ответить на все ваши
                    вопросы</span>
                </div>
            </div></a> 
			
			<a href="#">
            <div class="service">
                <div class="service_company">
                    <p>О компаниях и технологиях</p><span>Узнайте больше об
                    УльтраСофт и технологиях, применяемых в компании</span>
                </div>
            </div></a>
        </div>
    </div>
	
	<div class="container">
		<h1 class="products_home_title">Продукты и решения</h1>

        <p class="products_home_desc">Одно или несколько вступительных предложений, вратце раскрывающих
        достоинства, уникальные качества, преимущества предлагаемых компанией
        продуктов и решений. Информируя таким образом потенцыальных клиентов о
        том, почему выбирают УльраСофт.</p>
    </div>
	
	<div class="products_home">
		<div class="container">
			<div class="product_business">
				<div class="produkt_desc">
					<p>Руководству и собственникам бизнеса</p>
				</div>
				
				<div class="more">
					<img src="<?= base_url()?>template/client/images/produkthover.png">

                    <p>Руководству и собственникам бизнеса</p><span>Одно или
                    несколько вступительных предложений, вратце раскрывающих
                    достоинства,уникальные качества, преимущества предлагаемых
                    компанией продуктов и решений</span> <a href="#">Узнать
                    больше</a>
				</div>
			</div>
			
			<div class="product_accountant">
				<div class="produkt_desc">
					<p>Бухгалтерской службе</p>
                </div>

                <div class="more">
                    <img src="<?= base_url()?>template/client/images/produkthover.png">

                    <p>Бухгалтерской службе</p><span>Одно или несколько
                    вступительных предложений, вратце раскрывающих
                    достоинства,уникальные качества, преимущества предлагаемых
                    компанией продуктов и решений</span> <a href="#">Узнать
                    больше</a>
                </div>
            </div>

            <div class="product_it">
                <div class="produkt_desc">
                    <p>ИТ-отделу</p>
                </div>

                <div class="more">
                    <img src="<?= base_url()?>template/client/images/produkthover.png">

                    <p>ИТ-отделу</p><span>Одно или несколько вступительных
                    предложений, вратце раскрывающих достоинства,уникальные
                    качества, преимущества предлагаемых компанией продуктов и
                    решений</span> <a href="#">Узнать больше</a>
                </div>
            </div>

            <div class="product_sale">
                <div class="produkt_desc">
                    <p>Отделу продаж, сбыта и логистики</p>
                </div>

                <div class="more">
                    <img src="<?= base_url()?>template/client/images/produkthover.png">

                    <p>Отделу продаж, сбыта и логистики</p><span>Одно или
                    несколько вступительных предложений, вратце раскрывающих
                    достоинства,уникальные качества, преимущества предлагаемых
                    компанией продуктов и решений</span> <a href="#">Узнать
                    больше</a>
                </div>
            </div>
        </div>
    </div>

    <div class="prefooter">
        <div class="container">
            <div class="publishing">
                <h2>Публикации</h2>

                <div class="rss">
                    <a href="#"><img src="<?= base_url()?>template/client/images/rss.png"></a>
                </div>

                <div class="all_publishing">
                    <a href="#">Все материалы</a>
                </div>

                <div class="owl-carousel">
					<?foreach($publication as $pub):?>
						<div class="item">
							<div class="publication">
								<div class="publication_image"><img src="<?= $pub->img->publication_url?>"></div>

								<div class="publication_text">
									<p><a href="#"><p><?= $pub->short_description?></a></p>
									<span><?= $pub->date?></span>
								</div>
							</div>
						</div>
					<?endforeach;?>
                </div>
            </div>

            <div class="partners">
                <h2>С нами работают</h2>

                <div class="owl-carousel1">
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                </div>
            </div>
        </div>
    </div>

    <?require 'include/footer.php'?>

</body>
</html>