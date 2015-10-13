<!DOCTYPE html>

<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <title>Экспресс-Оценка</title>
    <link href="<?= TMP_PATH?>css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script src="http://code.jquery.com/jquery-1.6.min.js" type="text/javascript"></script>
    <script src="http://ribaweb.ru/template/client/js/jquery/jquery-ui.min.js"></script>
    <script src="http://ribaweb.ru/template/client/js/jquery/jquery.maskedinput.min.js"></script>
    <script src="http://ribaweb.ru/template/client/js/jquery/jquery.form.min.js"></script>
    <script src="http://ribaweb.ru/template/client/js/jquery/jquery.validate.min.js"></script>

    <script src="<?= TMP_PATH?>js/jquery.reveal.js" type="text/javascript"></script>
    <script src="<?= TMP_PATH?>js/owl.jquery.min.js" type="text/javascript"></script>
    <script src="<?= TMP_PATH?>js/owl.carousel.min.js" type="text/javascript"></script>

    <link href="<?= TMP_PATH?>css/reveal.css" rel="stylesheet">
    <link href="<?= TMP_PATH?>css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="<?= TMP_PATH?>css/responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= TMP_PATH?>css/lightbox.css">
    <script src="<?= TMP_PATH?>js/jquery.inputmask.js" type="text/javascript"></script>

</head>

<body>
	<? require 'include/header.php'; ?>
	
	<? require 'include/modal.php'; ?>
	
	<? require 'include/slider.php'; ?>
	
	<div class="services">
		<div class="container">
			
			<div class="service">
				<div class="service_name"><a href="/dtp.html"><?= $settings['main_autoexpertiza']->string_value?></a></div>
				<div class="service_img"><a href="/dtp.html"><img src="<?= IMGS_PATH?>serv1.png"></a></div>
				<div class="service_text"><?= $settings['main_autoexpertiza']->text_value?></div>
				<a data-reveal-id="myModal1" href="#" class="service_button desktop"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
				<a  href="tel:+74957403780" class="service_button mobile"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
            </div>
			
			<div class="service">
				<div class="service_name"><a href="/nedviz.html"><?= $settings['main_nedvigimost']->string_value?></a></div>
				<div class="service_img"><a href="/nedviz.html"><img src="<?= IMGS_PATH?>serv2.png"></a></div>
				<div class="service_text"><?= $settings['main_nedvigimost']->text_value?></div>
				<a data-reveal-id="myModal1" href="#" class="service_button desktop"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
				<a  href="tel:+74957403780" class="service_button mobile"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
			</div>
			
			<div class="service">
				<div class="service_name"><a href="/zaliv.html"><?= $settings['main_zaliv']->string_value?></a></div>
				<div class="service_img"><a href="/zaliv.html"><img src="<?= IMGS_PATH?>serv3.png"></a></div>
				<div class="service_text"><?= $settings['main_zaliv']->text_value?></div>
				<a data-reveal-id="myModal1" href="#" class="service_button desktop"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
				<a  href="tel:+74957403780" class="service_button mobile"><img src="<?= IMGS_PATH?>visov.png"><span>Вызов оценщика</span></a>
			</div>

        </div>
    </div>
	
	<div class="advantages">
		<div class="container">
			<h1>Преимущества работы с нами</h1>
			
			<div class="advantage">
				<div class="advantage_img"><img src="<?= IMGS_PATH?>adven1.png"></div>
				<div class="advantage_name"><?= $settings['main_ocenka']->string_value?></div>
				<div class="advantage_text"><?= $settings['main_ocenka']->text_value?></div>
			</div>
			
			<div class="advantage">
				<div class="advantage_img"><img src="<?= IMGS_PATH?>adven2.png"></div>
				<div class="advantage_name"><?= $settings['main_finance']->string_value?></div>
				<div class="advantage_text"><?= $settings['main_finance']->text_value?></div>
			</div>
			
			<div class="advantage">
				<div class="advantage_img"><img src="<?= IMGS_PATH?>adven3.png"></div>
				<div class="advantage_name"><?= $settings['main_zatrat']->string_value?></div>
				<div class="advantage_text"><?= $settings['main_zatrat']->text_value?></div>
			</div>
		</div>
	</div>
	
	<div class="about_us">
		<div class="container">
			
			<div class="about">
				<h2>О компании</h2>
				<p class="about_img"><img src="<?= IMGS_PATH?>company.jpg"><span><?= $settings['main_about']->string_value?></span></p>
				<p class="about_text">
					<?= $settings['main_about']->text_value?>
					<a class="about_button" data-reveal-id="myModal2" href="#">Заказать у нас оценку</a>
				</p>
			</div>
			
			<div class="about">
				<h2>Факты о нас</h2>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_money']->string_value?><!--135<span>млн.</span>--></p>
						<p class="facts_text"><?= $settings['facts_money']->text_value?></p>
					</div>
				</div>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_expertiz']->string_value?></p>
						<p class="facts_text"><?= $settings['facts_expertiz']->text_value?></p>
					</div>
				</div>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_procent']->string_value?></p>
						<p class="facts_text"><?= $settings['facts_procent']->text_value?></p>						
					</div>
				</div>
				
				<div class="facts">
					<div class="facts_body">
						<p class="facts_stats"><?= $settings['facts_time']->string_value?></p>
						<p class="facts_text"><?= $settings['facts_time']->text_value?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="documents">
		<div class="container">
			<h2>Разрешительные документы</h2>
			
			<div class="owl-carousel2">
				<?foreach($documents as $doc):?>
					<div class="item">
						<div class="document">
							<a class="example-image-link" href="<?= $doc->img->full_url?>" data-lightbox="example-set">
								<img class="example-image" src="<?= $doc->img->documents_url?>" alt="<?= $doc->name?>" />
							</a>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
	
	<div class="popular_services">
		<div class="container">
			<h1>Популярные услуги</h1>
			
			<div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular1.png"></div>
                <div class="popular_service_text">
                    <h3>Оценка недвижимости</h3>
                    <p>Оценка стоимости недвижимости это ответственная и важная работа для определения рыночной стоимости любого объекта в вашей или не в вашей собственности. Мы можем определить любой тип стоимости недвижимости. Наши сотрудники отлично знают рынок и все юридические нюансы оценки недвижимого имущества.</p>
                    <a href="/nedviz.html">Читать подробнее</a>
                </div>
            </div>

            <div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular2.png"></div>
                <div class="popular_service_text">
                    <h3>Оценка транспортных средств</h3>
                    <p>Оценка автомобиля после ДТП, это важная и ответственная работа, которая выполняется профессионалами и включает в себя несколько процедур. Наши специалисты определят точную стоимость ущерба на основе количества поврежденных элементов и утери товарной стоимости автомобиля. Вам будет что предъявить суду или страховой компании.</p>
                    <a href="/dtp.html">Читать подробнее</a>
                </div>
            </div>

            <div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular3.png"></div>
                <div class="popular_service_text">
                    <h3>Оценка земельных участков</h3>
                    <p>Мы проводим процедуру оценки земельных участков любого назначения – от земель сельскохозяйственного назначения и земель населенных пунктов до особо охраняемых территорий и объектов и земель запаса. В оценке земельного участка мы руководствуемся большим опытом и законами Российской Федерации.</p>
                    <a href="/zemla.html">Читать подробнее</a>
                </div>
            </div>


            <div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular4.png"></div>
                <div class="popular_service_text">
                    <h3>Оценка оборудования</h3>
                    <p>Оценка машин и оборудования поможет вам рассчитать и определить актуальную рыночную стоимость любого движимого имущества – приборов, автомобилей, станков, силовых агрегатов, оргтехники, бытовых предметов, мебели и других объектов. Наши специалисты-оценщики определят реальную рыночную стоимость.</p>
                    <a href="/mashiny.html">Читать подробнее</a>
                </div>
            </div>


            <div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular5.png"></div>
                <div class="popular_service_text">
                    <h3>Оценка прав требования</h3>
                    <p>Необходимость оценки прав требования может возникнуть в разных ситуациях: в результате отношений между кредитором и должником, при осуществлении сделок по купле-продаже долгов предприятий, при банкротстве предприятия и при многих других случаях в которых фигурируют спорные финансовые ситуации. </p>
                    <a href="/trebovanie.html">Читать подробнее</a>
                </div>
            </div>


            <div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular6.png"></div>
                <div class="popular_service_text">
                    <h3>Строительная экспертиза</h3>
                    <p>Компания Экспресс-Оценка проводит строительную экспертизу любой сложности. Мы гарантируем качественный результат нашей работы, ведь экспертизу проводят профессиональные эксперты-оценщики. Кроме того, мы гарантируем полную конфиденциальность всех проводимых работ. Строительная экспертиза поможет вам сохранить деньги и нервы.</p>
                    <a href="/expertiza.html">Читать подробнее</a>
                </div>
            </div>


            <div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular7.png"></div>
                <div class="popular_service_text">
                    <h3>Оспаривание кадастровой  стоимости недвижимости</h3>
                    <p>Оспаривание кадастровой стоимости недвижимости сегодня очень актуальная процедура. Кадастровые палаты нередко завышают реальную стоимость земли, ведь нередко оценивается большой район, а не отдельный участок. Наша компания рассчитает рыночную или кадастровую стоимость недвижимости.</p>
                    <a href="/cadastr.html">Читать подробнее</a>
                </div>
            </div>


            <div class="popular_service">
                <div class="popular_service_image"><img src="/images/popular8.png"></div>
                <div class="popular_service_text">
                    <h3>Оценка ущерба после заливов/пожаров</h3>
                    <p>Оценка ущерба после залива или пожара поможет рассчитать реальную стоимость затрат для страховой компании или виновника происшествия. Такая оценка помогает урегулировать ситуацию без суда. Но если дело дойдет до судебного разбирательства, наша оценка станет самым весомым аргументом. Мы решим вопрос цивилизованно и в вашу пользу! </p>
                    <a href="/zaliv.html">Читать подробнее</a>
                </div>
            </div>

        </div>
    </div>



    <div class="testimonial">
        <div class="container">
            <h1>Отзывы</h1>
            <div class="owl-carousel1">
                <div class="item">
                    <div class="testimonial_block">
                        <div class="testimonial_image">
                             <img src="/images/ots1.png">
							<p>Кирилл Гвоздик</p>
						<!--	<a href="https://vk.com/id135470543">https://vk.com/id135470543</a>-->
						
                        </div>
                        <div class="testimonial_text">
                            <p class="testimonial_name">Независимая техническая экспертиза транспортного средства МАН-БМЦ-57,6 - TGS40/400 6X4 . Решался вопрос о выплате страхового возмещения по договору КАСКО.                             </p>

                            <p class="testimonial_body">Кирилл провел оценку очень быстро, буквально за 1 день, как и обещал. Отчет в суде приняли, сумму выплатили полностью. Рекомендую.</p>
               
                            <a href="/media/avtoexp_man_kasko.pdf" target="_blank">Посмотреть отчет</a>

                        </div>
                    </div>

                </div>
                <div class="item">
                    <div class="testimonial_block">
                        <div class="testimonial_image">
                                <img src="/images/ots2.jpg">
							<p>Соня Кутепова</p>
						<!--	<a href="http://vk.com/id324780920">http://vk.com/id324780920</a>-->
							

                        </div>
                        <div class="testimonial_text">
                            <p class="testimonial_name">Экспертиза по определению марки бетона, использованного при заливке ленточного фундамента отдельно стоящего дома, находящегося по адресу: Саратовская обл., Хвалынский р-н, п. Алексеевка.
                            </p>
                            <p class="testimonial_body">Это были вторые оценщики, к которым я обращалась. Первые долго думали, потом отказались. "Экспресс-Оценка" сделали оценку без лишних вопросов и заморочек. Хорошие специалисты.</p>
                            <a href="/media/stroit_fundament_alekseevka.pdf" target="_blank">Посмотреть отчет</a>

                        </div>
                    </div>

                </div>
                <div class="item">

                    <div class="testimonial_block">
                        <div class="testimonial_image">
                                <img src="/images/ots3.jpg">
							<p>Настя Курочкина</p>
						<!--	<a href="http://vk.com/id324780711 ">http://vk.com/id324780711 </a>-->
						
                        </div>
                        <div class="testimonial_text">
                            <p class="testimonial_name">Независимая техническая экспертиза транспортного средства RENAULT Laguna III 2.0 16V. Решался вопрос о выплате страхового возмещения, по договору обязательного страхования гражданской ответственности (ОСАГО).</p>
                            <p class="testimonial_body">После аварии страховая насчитала просто смешную сумму. Обратилась к вам в компанию, посчитали почти ровно в 3 раза больше, и при этом суд я выиграла! Спасибо вам большое!</p>
                           
                            <a href="/media/avtoexp_laguna_osago.pdf" target="_blank">Посмотреть отчет</a>

                        </div>
                    </div>

                </div>
				
				       <div class="item">

                    <div class="testimonial_block">
                        <div class="testimonial_image">
                                 <img src="/images/ots5.jpg">
							<p>Светлана Сорокина</p>
						<!--	<a href="http://vk.com/id324780370">http://vk.com/id324780370</a>-->
							
                        </div>
                        <div class="testimonial_text">
                            <p class="testimonial_name">Экспертиза по оценке рыночной стоимости ущерба объекта, расположенного по адресу: Саратовская область, г.Саратов, ул. Благодарова 5, кв.
                           
                            </p>
                                  <p class="testimonial_body">Хулиганы разбили окно. Делала оценку в этой компании для возмещения ущерба через суд. Полученных денег хватило на ремонт окна и еще микроволновку. Жду следующих хулиганов =)</p>
                         
                            <a href="/media/usherb_okno_saratov.pdf" target="_blank">Посмотреть отчет</a>

                        </div>
                    </div>

                </div>
                            
				     <div class="item">

                    <div class="testimonial_block">
                        <div class="testimonial_image">
                            <img src="/images/ots6.jpg">
							<p>Арина Мочалова</p>
							<!--<a href="http://vk.com/id324780362">http://vk.com/id324780362</a>-->
						
                        </div>
                        <div class="testimonial_text">
                            <p class="testimonial_name">Экспертиза по определению рыночной стоимости работ и материалов, необходимых для устранения ущерба, причиненного помещению и имуществу, расположенного по адресу: Саратовская обл., г. Саратов.
                            </p>
                                  <p class="testimonial_body">В августе мне залили меховое ателье. Думала, что конец бизнесу, ни с кого никаких денег получить не смогу, но с помощью Кирилла и его команды удалось компенсировать почти всю сумму ущерба. Конечно, поволновалась я изрядно, но результат того стоит!</p>
                        
                            <a href="/media/zaliv_atelye.pdf" target="_blank">Посмотреть отчет</a>

                        </div>
                    </div>

                </div>
				
					     <div class="item">

                    <div class="testimonial_block">
                        <div class="testimonial_image">
                           <img src="/images/ots4.jpg">
							<p>Фаина Шепел</p>
						<!--	<a href="http://vk.com/id324780580 ">http://vk.com/id324780580 </a>-->
							
                        </div>
                        <div class="testimonial_text">
                            <p class="testimonial_name">Экспертиза по оценке рыночной стоимости жилого помещения (квартиры), расположенного по адресу: Саратовская область, Вольский район, г. Вольск.                                                       
                            </p>
                                  <p class="testimonial_body">Делала оценку квартиры для того, чтобы взять большой кредит на авто. Ребята посчитали все оперативно и подготовили большую пачку документов для банка. Банк их принял, кредит дали.</p>
                   
                            <a href="/media/ocenka_kvartira_volsk.pdf" target="_blank">Посмотреть отчет</a>

                        </div>
                    </div>

                </div>


            </div><a class="testimonial_button" href="/otsivi.html">Посмотреть все отзывы</a>
        </div>
    </div>

<!--
    <div class="partners">
        <div class="container">
            <h1>Наши партнеры</h1>

            <div class="owl-carousel">
                <div class="item"><img src="/images/p1.png"></div>

                <div class="item"><img src="/images/p2.png"></div>

                <div class="item"><img src="/images/p3.png"></div>

                <div class="item"><img src="/images/p4.png"></div>

                <div class="item"><img src="/images/p5.png"></div>

                <div class="item"><img src="/images/p6.png"></div>

                <div class="item"><img src="/images/p1.png"></div>

                <div class="item"><img src="/images/p2.png"></div>

                <div class="item"><img src="/images/p3.png"></div>

                <div class="item"><img src="/images/p4.png"></div>

                <div class="item"><img src="/images/p5.png"></div>
            </div>
        </div>

    </div>

-->

	<footer>
		<div class="container">
			<div class="banking">
				<span>ИНН <?= $settings['inn']->string_value?> </span> <span> ОГРН <?= $settings['ogrn']->string_value?></span>
			</div>
            <div class="social">
                <a href="https://instagram.com/expressocenka/" target="_blank"><img src="<?= IMGS_PATH?>soc1.png"></a>
                <a href="https://vk.com/express_ocenka" target="_blank"><img src="<?= IMGS_PATH?>soc4.png"></a>
            </div>
            <div class="email">
                <a href="mailto:mail@ocenkaexp.ru"><?= $settings['email']->string_value?></a>
            </div>

            <div class="logo">
                <a href="/"><img src="<?= IMGS_PATH?>logo_footer.png"><br>Экспресс-Оценка</a>
            </div>
            <div class="logo_responsive">
                <a href="/"><img src="<?= IMGS_PATH?>logo2.png"></a>
            </div>

            <div class="menu footer">
                <ul class="nav clearfix animated">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/about.html">О компании</a></li>
                    <li><a href="/otsivi.html">Портфолио и отзывы</a></li>
                    <li><a href="/uslugi.html">Услуги и цены</a></li>
                       <!-- <li><a href="/faq.html">FAQ</a></li>-->
                    <li><a href="/contact.html">Контакты</a></li>
                </ul>
            </div>
            <div class="callme">
                <div class="phone"><a href="tel:<?= $settings['phone']->string_value?>"><?= $settings['phone']->span_value?></a></div>
                <div class="recall"><a data-reveal-id="myModal" href="#" class="button">Заказать звонок</a></div>
            </div>

        </div>
    </footer>




    <script src="<?= TEMP_PATH?>js/lightbox-plus-jquery.min.js" type="text/javascript"></script>
    <script>
        $.noConflict();
    </script>

    <script src="/js/main.js" type="text/javascript"></script>
     <script>
            $(document).ready(function() {
     
				$(".mask").inputmask("+7(999)999-99-99");
		

            });
        </script>

</body>

</html>