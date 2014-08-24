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
        <div class="consults clearfix">
            <div class="wrap">
				<div class="content">
					<div class="title">Консультации</div>
					<div class="clearfix" style="margin-bottom:40px; ">
						<div class="left_col">
							<img src="<?=base_url()?>template/client/images/consult.png" alt="" />
						</div>
						<div class="right_col">
							<p>Наши клиенты всегда могут связаться с менеджерами «Ремонт-Гаража», чтобы получить необходимые консультации по будущему заказу. Цены, услуги, материалы – поможем информацией и делом.</p>
						</div>
					</div>
					<form action="#contacts" method="post" class="js-form" id="contactform">
						<div class="content">
							<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
							<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
							<a href="#callrequest" class="btn-2 js-callback callback-phone fancybox">Получить консультацию</a>
						</div>

					</form>					
				</div>
            </div>
        </div>
    </section>
<?require_once('include/footer.php')?>