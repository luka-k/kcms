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
        <div class="vacancy clearfix">
            <div class="wrap">
				<div class="content">
						<div class="title">Вакансии</div>
						<div class="clearfix">
							<div class="left-col">
								<img src="<?=base_url()?>template/client/images/vacancy.png" alt="" />
							</div>
							<div class="center-col">
								<p>Вы – специалист по ремонту гаражей? У вас внушительный стаж работ, и для вас нет ничего невозможного?</p>
								<p>Тогда вы – именно тот, кого мы ищем. Мы всегда рады новым мастерам, которые смогут выполнять ремонтные работы на пять с плюсом.</p>
								<p>Если вы желаете работать в компании «Ремонт Гаража» – просто напишите нам, и мы очень скоро рассмотрим вашу заявку.</p>
							</div>
							<div class="right-col">
								<a href="#vacancy-popup" class="btn js-callback callback-phone fancybox">Отправить резюме</a>
							</div>
						</div>
				</div>
            </div>
        </div>
    </section>

<?require_once('include/footer.php')?>   