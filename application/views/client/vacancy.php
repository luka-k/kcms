<?require_once('include/head.php')?>    
<body>
	<?require_once('include/header.php')?> 
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
								<a href="#vacancy-popup" class="btn fancybox">Отправить резюме</a>
							</div>
						</div>
						<?if(isset($callback)):?>
							<div style=" width:100%; text-align:center; font-size:26px; color:#00c0e9">
								<?=$callback?>
							</div>
						<?endif?>
				</div>
            </div>
        </div>
    </section>
<?require_once('include/index-script.php')?> 
<?require_once('include/footer.php')?>   