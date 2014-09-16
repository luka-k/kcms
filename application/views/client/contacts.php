<?require_once('include/head.php')?>   
<body>
	<?require_once('include/header.php')?> 
    <section>
        <div class="contacts clearfix">
            <div class="wrap">
				<div class="content">

						<div class="title">Контакты</div>
						<div class="clearfix" style="margin-bottom:60px;">
							<div class="cont-col email">mail@ремонт-гаража.рф</div>
							<div class="cont-col phone"><span class="ph-style">+7 (921)</span> 123-45-67</div>
							<div class="cont-col address">г. Город Улица</div>
						</div>
						<form action="" id="form_1" method="post" class="js-form">
							<div  class="clearfix">
								<div class="left-col">
									<input type="text" name="name" placeholder="Имя" data-necessarily="true" /><br/>
									<input type="text" name="phone" class="mask" placeholder="Телефон" data-necessarily="true" data-id="phone"/><br/>
									<input type="text" name="email" placeholder="email" data-necessarily="true" /><br/>
								</div>
					
								<div class="right-col">
									<textarea name="comment" id="comment" placeholder="Комментарий" data-necessarily="true"></textarea>
								</div>
							</div>
							<a href="" onclick="$('#form_1').submit();return false;" class="btn" style="float:right">Отправить</a>
						</form>					
				</div>
            </div>
        </div>
    </section>
	
	<section>
		<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=GEcEVpUYdK-73SMYZj5fNB6FnKtXmmFo&width=100%&height=450"></script>
	</section>
<?require_once('include/index-script.php')?>
<?require_once('include/footer.php')?>   