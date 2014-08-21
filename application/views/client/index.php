<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.3">
		
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
        
        <title>Ремонт гаража</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="<?=$meta_keywords?>" />
		<meta name="description" content="<?=$meta_description?>" />
        
        <link href="<?=base_url()?>template/client/fancybox/jquery.fancybox.css?v=2.1.5" rel="stylesheet" media="screen, projection">
        <link href="<?=base_url()?>template/client/css/reset.css" rel="stylesheet" media="screen, projection">
        <link href="<?=base_url()?>template/client/css/style.css" rel="stylesheet" media="screen, projection">
        <link href="<?=base_url()?>template/client/css/font-style.css" rel="stylesheet" media="screen, projection">
         
        <script src="<?=base_url()?>template/client/js/jquery-1.10.2.min.js"></script>
        <script src="<?=base_url()?>template/client/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script src="<?=base_url()?>template/client/js/jquery.mousewheel-3.0.6.pack.js"></script>  
        <script src="<?=base_url()?>template/client/js/jquery.maskedinput.min.js"></script>
        <script src="<?=base_url()?>template/client/js/jquery.easing.1.3.js"></script>
		
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
		
        <script src="<?=base_url()?>template/client/js/script.js"></script>
        
        <!--[if lte IE 6 ]><script type="text/javascript">window.location.href="ie6_close/index_ru.html";</script><![endif]-->
        
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <!--[if lt IE 9]>
            <style type="text/css">
                input[type="text"] {
                    line-height: 40px;
                    padding-top: 2px;
                }
            </style>
        <![endif]-->
		
		<script type="text/javascript">
			$(document).ready(function() {
				$('.fancybox').fancybox();
				
			$(".mask").mask("+7 (999) 999-9999");	
				
			});
		</script>
    
    </head>
    
<body>

    <!-- HEADER & LOGO -->
    <header style="height: 770px;">
        <div class="header-top">
            <div class="wrap">
                <div class="content">
                    <div class="logo">
                        <a href="/"><img src="<?=base_url()?>template/client/images/logo.png" alt="" /></a>
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
                <ul class="navi clearfix">
                    <li class="first"><a href="#">О компании</a></li>
                    <li><a href="#">Услуги и цены</a></li>
					<li><a href="#">Наши работы</a></li>
                    <li><a href="#">Консультации</a></li>
                    <li><a href="#">Вакансии</a></li>
                    <li class="last"><a href="#">Контакты</a></li>
                </ul>
            </div>
        </div>
		
		<div class="banner">
			<div class="wrap">
				<div class="content">
					<div class="calc">
						<div class="calc-pict">
						</div>
						<div style="width:150px; margin:0 auto 10px auto;">
							КАЛЬКУЛЯТОР РЕМОНТА
						</div>
						<a href="#">Рассчитать &rarr;</a>
					</div>
				</div>
			</div>
		</div>
				
        <div class="header-bottom">
            <div class="wrap">
                <div class="content clearfix">
					<div class="left_col">
						<p>Компания «Ремонт Гаража» оказывает услуги по ремонту гаражей в Санкт-Петербурге для всех, кто хочет получить на совесть выполненную работу в кратчайшие сроки и по самым выгодным ценам.</p>
						<p class="small">Так же, как квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж является вторым домом, где можно посвятить время ремонту и тюнингу. Очевидно, что от качества проведенных ремонтных работ в гараже зависят те условия, в которых автомобиль будет содержаться – и именно поэтому </p>
					</div>
					<div class="right_col">
						<img src="<?=base_url()?>template/client/images/garant.png" alt="" />
					</div>
                </div>
            </div>
        </div>
    </header>
	
	<section>
		<div class="info">
			<div class="wrap">
				<div class="content ">
					<div class="clearfix">
						<div class="fil-10 clearfix">
							<div class="proc">240</div>
							<div class="text">ГАРАЖЕЙ</div>
							<div class="text-2">ОТРЕМОНТИРОВАНО</div>
						</div>
						<div class="fil-50 clearfix">
							<div class="proc">2</div>
							<div class="text">ДНЯ</div>
							<div class="text-2">СРЕДНИЙ СРОК РЕМОНТА</div>
						</div>
						<div class="fil-100 clearfix">
							<div class="proc">15</div>
							<div class="text">ТЫСЯЧ РУБЛЕЙ</div>
							<div class="text-2">СРЕДНЯЯ СТОИМОСТЬ</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section>
        <div class="result">
            <div class="wrap">
                <div class="content">
					<div class="title" style="padding-bottom: 20px;">Как мы достигли таких результатов?</div>
					<div class="clearfix">
						<div class="result-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/result-1.png" alt=""/></div>
							<div class="title">Материалы в наличии</div>
							<div class="text">У нас в наличии – собственный склад со всеми материалами. Вам не потребуется ждать поступления материала в магазин, отгрузки и поставки. Все, что необходимо для проведения качественных ремонтных работ, уже готово к использованию.</div>
						</div>
						<div class="result-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/result-2.png" alt=""/></div>
							<div class="title">Надежные партнеры</div>
							<div class="text">Мы наладили партнерские отношения с производителями используемых материалов и оборудования, благодаря этому получаем большую скидку на весь ассортимент. Это, в свою очередь, позволяет нам снизить стоимость на оказываемые услуги.</div>
						</div>
						<div class="result-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/result-3.png" alt=""/></div>
							<div class="title">Скорость работы</div>
							<div class="text">Для вас работают полностью укомплектованные бригады специалистов – что позволяет гарантировать высокую скорость работы. Стаж каждого сотрудника составляет более десяти лет работы в сфере ремонта гаражей. Их опыт позволяет оказывать услуга на самом высоком уровне.</div>
						</div>
					</div>
					<div style="font-size:22px;">
						С нами вы можете быть спокойны за качество. Кроме того, вы получаете фирменную гарантию сроком на один год на любой заказ.
					</div>
				</div>
			</div>
		</div>	
	</section>
	
	<section>
        <div class="itog">
            <div class="wrap">
                <div class="content">
					<div class="title-2" style="padding-bottom: 20px;">3 основных аргумента в пользу ремонта</div>
					<div class="clearfix">
						<div class="itog-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/itog-1.png" alt=""/></div>
							<div class="title">Отсутствие сыростии</div>
							<div class="text">Протекающая крыша – а отсюда излишняя сырость и влажность – встречаются часто. Мы выполняем оперативный ремонт кровли с гарантией.</div>
						</div>
						<div class="itog-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/itog-2.png" alt=""/></div>
							<div class="title">Машина в тепле</div>
							<div class="text">Мы сможем обеспечить высокую температуру внутри гаража</div>
						</div>
						<div class="itog-item">
							<div class="image"><img src="<?=base_url()?>template/client/images/itog-3.png" alt=""/></div>
							<div class="title">Хранение вещей</div>
							<div class="text">Соответствующие условия хранения – сухое, теплое место – здесь можно даже жить!</div>
						</div>
					</div>
					<div style="font-size:22px; color:#333">
						Итог – теплый гараж, в котором можно не только держать автомобиль, но и с удобством хранить вещи и даже отдыхать вместе с друзьями.
					</div>
				</div>
			</div>
		</div>	
	</section>
	
	<section>
        <div class="consult">
            <div class="wrap">
                <div class="content">
					<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
					<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
					<a href="#callrequest" class="btn-2 js-callback callback-phone fancybox">Бесплатная консультация</a>
				</div>
			</div>
		</div>	
	</section>	
	
    <section>
        <div class="otzovi clearfix">
            <div class="wrap">
				<div class="title">Отзывы наших клиентов</div>
				<div class="slider">
					<div name="prev" class="navy prev-slide">предыдущий проект</div>
					<div name="next" class="navy next-slide">следующий проект </div>
					<div class="slide-list">
						<div class="slide-wrap">
							<?$count = 1?>
							<?foreach($reviews as $review):?>
								<div class="slide-item clearfix">
									<div class="txt-wrap">
										<div class="text">
											<?=$review->text?>  
										</div>
										<img src="<?=base_url()?>template/client/images/otziv.png" <?if($count == 1):?>class="img-left"<?else:?>class="img-right"<?endif;?> alt=""/>
									</div>
									<div class="name" style="float:<?if($count == 1):?>left<?else:?>right<?$count = 0?><?endif;?>;">
										<?=$review->title?>, <span style="color:#999">страница</span> <a href="<?=$review->vk_link?>" class="vk_link">&nbsp;</a>
									</div>
								</div>
								<?$count++?>
							<?endforeach;?>
							<!--<div class="slide-item clearfix">
								<div class="txt-wrap">
									<div class="text">
										Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!  
									</div>
									<img src="<?=base_url()?>template/client/images/otziv.png" class="img-left" alt=""/>
								</div>
								<div class="name" style="float:left;">
									Адександр, <span style="color:#999">страница</span> <a href="" class="vk_link">&nbsp;</a>
								</div>
							</div>		 
							<div class="slide-item clearfix">
								<div class="txt-wrap">
									<div class="text">
										Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!  
									</div>
									<img src="<?=base_url()?>template/client/images/otziv.png" class="img-right" alt=""/>
								</div>
								<div class="name" style="float:right;">
									Владимир, <span style="color:#999">страница</span> <a href="" class="vk_link">&nbsp;</a>
								</div>
							</div>	
							<div class="slide-item clearfix">
								<div class="txt-wrap">
									<div class="text">
										Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!  
									</div>
									<img src="<?=base_url()?>template/client/images/otziv.png" class="img-left" alt=""/>
								</div>
								<div class="name" style="float:left;">
									Адександр, <span style="color:#999">страница</span> <a href="" class="vk_link">&nbsp;</a>
								</div>
							</div>		 
							<div class="slide-item clearfix">
								<div class="txt-wrap">
									<div class="text">
										Мой старенький ржавый гараж давно требовал ремонта, машина зимой замерзала, приходилось долго прогревать. Двери всевремя примерзали, было не открыть в мороз. А осенью - лужа посреди гаража. Обратился к специалистам по ремонту гаражей, и теперь у меня в гараже ремонт круче, чем дома!  
									</div>
									<img src="<?=base_url()?>template/client/images/otziv.png" class="img-right" alt=""/>
								</div>
								<div class="name" style="float:right;">
									Владимир, <span style="color:#999">страница</span> <a href="" class="vk_link">&nbsp;</a>
								</div>
							</div>-->										
						</div>
					</div>
				</div>		
            </div>
        </div>
    </section>

    <section>
        <div class="raboti clearfix">
            <div class="wrap">
				<div class="title">Наши работы</div>
				<div class="slider">
					<div name="prev" class="navy prev-slide-2">предыдущий проект</div>
					<div name="next" class="navy next-slide-2">следующий проект</div>
					<div class="slide-list">
						<div class="slide-wrap-2">
							<?foreach($works as $work):?>
								<div class="slide-item">
									<div class="proekt clearfix">
										<div class="title-3"><?=$work->title?></div>
										<div class="raboti-item">
											<div class="title">БЫЛО</div>
											<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
										</div>
										<div class="raboti-item">
											<div class="title">В РАБОТЕ</div>
											<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
										</div>
										<div class="raboti-item">
											<div class="title">СТАЛО</div>
											<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
										</div>
										<div class="proekt-bottom">
											<div class="time">Срок: <span style="font-size:48px; font-weight:normal;"><?=$work->time?></span> месяца</div>
											<div class="price">Бюджет "под ключ": <span style="font-size:48px; font-weight:normal;"><?=$work->price?></span> рублей.</div>
										</div>
									</div>
								</div>
							<?endforeach;?>
												
							<!--<div class="slide-item">
								<div class="proekt clearfix">
									<div class="title-3">Гараж на ул. Кораблестроителей  во дворе д. 25</div>
									<div class="raboti-item">
										<div class="title">БЫЛО</div>
										<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
									</div>
									<div class="raboti-item">
										<div class="title">В РАБОТЕ</div>
										<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
									</div>
									<div class="raboti-item">
										<div class="title">СТАЛО</div>
										<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
									</div>
									<div class="proekt-bottom">
										<div class="time">Срок: <span style="font-size:48px; font-weight:normal;">1,5</span> месяца</div>
										<div class="price">Бюджет "под ключ": <span style="font-size:48px; font-weight:normal;">20 000</span> рублей.</div>
									</div>
								</div>
							</div>		 
							<div class="slide-item">
								<div class="proekt clearfix">
									<div class="title-3">Гараж на ул. Кораблестроителей  во дворе д. 25</div>
									<div class="raboti-item">
										<div class="title">БЫЛО</div>
										<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
									</div>
									<div class="raboti-item">
										<div class="title">В РАБОТЕ</div>
										<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
									</div>
									<div class="raboti-item">
										<div class="title">СТАЛО</div>
										<img src="<?=base_url()?>template/client/images/raboti-1.png" alt=""/>
									</div>
									<div class="proekt-bottom">
										<div class="time">Срок: <span style="font-size:48px; font-weight:normal;">1,5</span> месяца</div>
										<div class="price">Бюджет "под ключ": <span style="font-size:48px; font-weight:normal;">150 000</span> рублей.</div>
									</div>
								</div>
							</div>-->		
						</div>
					</div>
				</div>		
			</div>
        </div>
    </section>
	
	<section>
        <div class="consult">
            <div class="wrap">
                <div class="content">
					<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
					<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
					<a href="#callrequest" class="btn-2 js-callback callback-phone fancybox">Хочу так же</a>
				</div>
			</div>
		</div>	
	</section>	

    <section>
        <div class="partneri clearfix">
            <div class="wrap">
				<div class="title-4">Наши партнеры</div>
						<div class="slider">
							<div name="prev" class="navy prev-slide-3">&nbsp;</div>
							<div name="next" class="navy next-slide-3">&nbsp;</div>
							<div class="slide-list">
								<div class="slide-wrap-3 clearfix">		
									<?foreach ($partners as $partner):?>
										<div class="slide-item">
											<a href="<?=$partner->link?>"><img src="<?=base_url()?>template/client/images/partneri.png" alt="<?=$partner->title?>"/></a>
										</div>		 
									<?endforeach;?>
									<!--<div class="slide-item">
										<a href=""><img src="<?=base_url()?>template/client/images/partneri.png" alt=""/></a>
									</div>		
									<div class="slide-item">
										<a href=""><img src="<?=base_url()?>template/client/images/partneri.png" alt=""/></a>
									</div>		 
									<div class="slide-item">
										<a href=""><img src="<?=base_url()?>template/client/images/partneri.png" alt=""/></a>
									</div>	
									<div class="slide-item">
										<a href=""><img src="<?=base_url()?>template/client/images/partneri.png" alt=""/></a>
									</div>		 
									<div class="slide-item">
										<a href=""><img src="<?=base_url()?>template/client/images/partneri.png" alt=""/></a>
									</div>	
									<div class="slide-item">
										<a href=""><img src="<?=base_url()?>template/client/images/partneri.png" alt=""/></a>
									</div>		 
									<div class="slide-item">
										<a href=""><img src="<?=base_url()?>template/client/images/partneri.png" alt=""/></a>
									</div>-->	
								</div>
							</div>
						</div>		
            </div>
        </div>
    </section>

    <section>
        <div class="contact clearfix" >
            <div class="wrap">
                <div class="content">
					<form action="#contacts" method="post" class="js-form" id="contactform">
						<div class="content">
							<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/>
							<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/>
							<a href="#callrequest" class="btn-2 js-callback callback-phone fancybox">Получить консультацию</a>
						</div>

					</form>
					<div class="copyr">
						&copy; 2014<br/>
						<span style="color:#999">ремонт-гаража.рф</span>
					</div>
					<div class="riba">
						Made in <a href="http://www.ribaweb.ru" target="_blanc">RIBA</a>
					</div>
                </div>
            </div>
        </div>
    </section>
	
    <div id="callrequest" class="popup">
      
        <div id="overlay_form" class="clearfix">
			<div class="title">Заказать звонок</div>
            <form action="" id="formpopup" method="post" class="js-form">
				<div style="margin-bottom:20px;">
					<input type="text" name="name" data-id="name" placeholder="Имя" data-necessarily="true"/><br/>
					<input type="text" name="phone" data-id="phone" class="mask" placeholder="Телефон" data-necessarily="true"/><br/>
					<select>
						<option>9:00 - 12:00</option>
						<option>9:00 - 12:00</option>
						<option>9:00 - 12:00</option>
						<option>9:00 - 12:00</option>
					</select>
				</div>
				<a href="" onclick="$('#formpopup').submit();return false;" class="btn-3">Отправить</a>
            </form>
			
        </div>
        
    </div>
	
	<script>
	$(window).scroll(function() {
			if($(window).scrollTop() > ($('html').offset().top-50)){
				$('.nav ul li').removeClass('active');
				$('.nav ul li').eq(0).addClass('active');
			}
			
			if($(window).scrollTop() > ($('.rasp-bottom').offset().top-50)){
				$('.nav ul li').removeClass('active');
				$('.nav ul li').eq(1).addClass('active');
			}
			
			if($(window).scrollTop() > ($('.rasp-2').offset().top-50)){
				$('.nav ul li').removeClass('active');
				$('.nav ul li').eq(2).addClass('active');
			}
			
			if($(window).scrollTop() > ($('.garant').offset().top-50)){
				$('.nav ul li').removeClass('active');
				$('.nav ul li').eq(3).addClass('active');
			}
			
			if($(window).scrollTop() > ($('.how').offset().top-50)){
				$('.nav ul li').removeClass('active');
				$('.nav ul li').eq(4).addClass('active');
			}
			
			if($(window).scrollTop() > ($('.contact').offset().top-50)){
				$('.nav ul li').removeClass('active');
				$('.nav ul li').eq(5).addClass('active');
			}
			
			if($(window).scrollTop() > ($('.work').offset().top-50)){
				$('.nav ul li').removeClass('active');
				$('.nav ul li').eq(6).addClass('active');
			}
	});
	</script>
	
	<script type="text/javascript">
			$(function() {
				$('#price').change(function () {
					var val = $(this).val();
					$('#slider_time').slider("values",0,val);
				});	
		
				$('#price2').change( function() {
					var val2 = $(this).val();
					$('#slider_time').slider("values",1,val2);
				});
	
				$( "#slider_time" ).slider({
					range: true,
					//orientation: "vertical",
					min: 10,
					step:1,
					max: 20,
					values: [ 14, 17 ],
					slide: function( event, ui ) {
						//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
						$('#price').val(ui.values[0]);
						$('#price2').val(ui.values[1]);
					}
				});
				$('#price').val($('#slider_time').slider("values",0));
				$('#price2').val($('#slider_time').slider("values",1));
			});
	</script>
	
	<script type="text/javascript">
jQuery(document).ready(function(){
	function htmSlider(){
		var slideWrap = jQuery('.slide-wrap');
		var nextLink = jQuery('.next-slide');
		var prevLink = jQuery('.prev-slide');
		var playLink = jQuery('.auto');
		var is_animate = false;
		var slideWidth = jQuery('.slide-item').outerWidth();
		var scrollSlider = slideWrap.position().left - slideWidth;
		
		nextLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap.animate({left: scrollSlider}, 150, function(){
					slideWrap
					.find('.slide-item:first')
					.appendTo(slideWrap)
					.parent()
					.css({'left': 0});
				});
			}
		});
 
		prevLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap
				.css({'left': scrollSlider})
				.find('.slide-item:last')
				.prependTo(slideWrap)
				.parent()
				.animate({left: 0}, 150);
			}
		});
	}
 
	htmSlider();
});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
	function htmSlider(){
		var slideWrap = jQuery('.slide-wrap-2');
		var nextLink = jQuery('.next-slide-2');
		var prevLink = jQuery('.prev-slide-2');
		var playLink = jQuery('.auto');
		var is_animate = false;
		var slideWidth = jQuery('.slide-item').outerWidth();
		var scrollSlider = slideWrap.position().left - slideWidth;
		
		nextLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap.animate({left: scrollSlider}, 150, function(){
					slideWrap
					.find('.slide-item:first')
					.appendTo(slideWrap)
					.parent()
					.css({'left': 0});
				});
			}
		});
 
		prevLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap
				.css({'left': scrollSlider})
				.find('.slide-item:last')
				.prependTo(slideWrap)
				.parent()
				.animate({left: 0}, 150);
			}
		});
	}
 
	htmSlider();
});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
	function htmSlider(){
		var slideWrap = jQuery('.slide-wrap-3');
		var nextLink = jQuery('.next-slide-3');
		var prevLink = jQuery('.prev-slide-3');
		var playLink = jQuery('.auto');
		var is_animate = false;
		var slideWidth = jQuery('.slide-item').outerWidth();
		var scrollSlider = slideWrap.position().left - slideWidth;
		
		nextLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap.animate({left: scrollSlider}, 150, function(){
					slideWrap
					.find('.slide-item:first')
					.appendTo(slideWrap)
					.parent()
					.css({'left': 0});
				});
			}
		});
 
		prevLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap
				.css({'left': scrollSlider})
				.find('.slide-item:last')
				.prependTo(slideWrap)
				.parent()
				.animate({left: 0}, 150);
			}
		});
	}
 
	htmSlider();
});
</script>

</body>
</html>
