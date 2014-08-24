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
        <div class="contacts clearfix">
            <div class="wrap">
				<div class="content">
					<form action="#contacts" method="post" class="js-form" id="contactform">
						<div class="title">Контакты</div>
						<div class="clearfix" style="margin-bottom:20px;">
							<div class="cont-col email">info@ribaweb.ru</div>
							<div class="cont-col phone">(812) 425 12 45</div>
							<div class="cont-col address">г. Город Улица</div>
						</div>

						<div  class="clearfix">
							<div class="left-col">
								<input type="text" name="name" placeholder="Имя" data-necessarily="true" /><br/>
								<input type="text" name="phone" class="mask" placeholder="Телефон" data-necessarily="true" data-id="phone"/><br/>
								<input type="text" name="email" placeholder="email" data-necessarily="true" /><br/>
							</div>
					
							<div class="right-col">
								<textarea name="comment" name="comment" placeholder="Комментарий" data-necessarily="true"></textarea>
							</div>
						</div>
						<a href="" onclick="" class="btn" style="float:right">Отправить</a>
					</form>					
				</div>
            </div>
        </div>
    </section>
	
	<section>
		<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=GEcEVpUYdK-73SMYZj5fNB6FnKtXmmFo&width=100%&height=450"></script>
	</section>

<?require_once('include/footer.php')?>   