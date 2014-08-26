<?require_once('include/head.php')?>   
<body>
	<?require_once('include/header.php')?> 
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