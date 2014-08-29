<?require_once('include/head.php')?>    
<body>
	<?require_once('include/header.php')?> 
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
							<a href="#callrequest" class="btn-2 fancybox">Получить консультацию</a>
						</div>

					</form>					
				</div>
            </div>
        </div>
    </section>
<?require_once('include/footer.php')?>