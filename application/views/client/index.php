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

    <?require 'include/prefooter.php'?>

    <?require 'include/footer.php'?>

</body>
</html>