<?require_once('include/head.php')?>    
<body>
	<?require_once('include/header.php')?> 
    <section>
        <div class="consults clearfix">
            <div class="wrap">
				<div class="content">
					<div class="title">Консультации</div>
					<div class="clearfix" style="margin-bottom:60px; ">
						<div class="left_col">
							<img src="<?=base_url()?>template/client/images/consult.png" alt="" />
						</div>
						<div class="right_col">
							<p>Наши клиенты всегда могут связаться с менеджерами «Ремонт-Гаража», чтобы получить необходимые консультации по будущему заказу. Цены, услуги, материалы – поможем информацией и делом.</p>
						</div>
					</div>
					<div class="content">
						<form action="" id="form_1" method="post" class="js-form">
							<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
							<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
							<a href="#" class="btn-2" onClick="$('#form_1').submit(); return false;">Получить консультацию</a>
						</form>
					</div>			
				</div>
            </div>
        </div>
    </section>
<?require_once('include/index-script.php')?>
<?require_once('include/footer.php')?>