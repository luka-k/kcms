<!DOCTYPE html>
<!--[if lte IE 9]>      
	<html class="no-js lte-ie9">
<![endif]-->
<!--[if gt IE 8]><!--> 
	<html class="no-js">
<!--<![endif]-->

<? require 'include/head.php' ?>

<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->

	<? require 'include/header.php'?>
	<? require 'include/top-menu.php'?>
	
	<div class="page page-product" id="product">
		<div class="page__wrap wrap">
			<div class="page-product__top">
				<div class="page-product__images product-images">
					<div class="product-images__big-image-box">
						<a href="<?=$content->img[0]->url?>" class="product-images__href fancyimage" data-fancybox-group="big">
							<img    src="<?=$content->img[0]->url?>" 
                                    width="470" 
                                    height="470" 
                                    alt="image" 
                                    class="product-images__big-image"/>
						</a>
						
						<a href="<?=$content->img[1]->url?>" class="product-images__href fancyimage" data-fancybox-group="big">
							<img    src="<?=$content->img[1]->url?>" 
                                    width="470" 
                                    height="470" 
                                    alt="image" 
                                    class="product-images__big-image"/>
						</a>
					</div> <!-- /.product-images__big-image-box -->
					
					<div class="product-images__thumbs">
						<ul class="product-images-thumbs">
							<?foreach($content->img as $images):?>
								<li class="product-images-thumbs__item">
									<a  href="<?=$images->url?>"
										data-full-image="<?=$images->url?>"
										class="product-images-thumbs__href">
											<img src="<?=$images->url?>" alt="image" class="product-images-thumbs__image" />
									</a>
								</li> <!-- /.product-images-thumbs__item -->
							<?endforeach;?>
						</ul> <!-- /.product-images-thumbs -->
					</div> <!-- /.product-images__thumbs -->
				</div> <!-- /.product__images .product-images -->
			
				<div class="page-product__main-info product-main-info">
					<h1 class="product-main-info__title">Диск колесный</h1>
					<div class="product-main-info__desc"><?=$content->name?></div> <!-- /.product-main-info__desc -->
						<ul class="product-main-info__characteristics">
							<li class="product-main-info__characteristic">
								<strong>Артикул</strong> <?=$content->article?>
							</li> <!-- /.product-main-info__characteristic -->
							
							<li class="product-main-info__characteristic">
								<strong>Гарантия</strong> <?=$content->warrant?> года
							</li> <!-- /.product-main-info__characteristic -->
						</ul> <!-- /.product-main-info__characteristics -->
						
						<div class="product-main-info__text">
							<?=$content->description?>
						</div> <!-- /.product-main-info__text -->
						
						<div class="product-main-info__price">
							<div class="product-price">
								<?if(isset($content->sale_price)):?>
									<!-- Цена со скидкой -->
									<div class="product-price__old">
										Старая цена: <span><?=$content->price?>р.</span>
									</div> <!-- /.product-price__old -->
									
									<div class="product-price__new">
										Новая цена: <span><?=$content->sale_price?>р.</span>
									</div> <!-- /.product-price__new -->
								<?else:?>
									<div class="product-price__normal">
										Цена: <span><?=$content->price?> р.</span>
									</div> --> <!-- /.product-price__normal -->
                                <?endif;?>
							</div> <!-- /.catalog-item-price -->
						</div> <!-- /.product-main-info__price -->
						
						<div class="product-main-info__buttons skew">
							<div class="product-main-info__button">
								<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
							</div> <!-- /.product-main-info__button -->
							
							<div class="product-main-info__button">
								<button class="button button--normal button--grey fancybox" data-fancybox-href="#callback">Быстрый заказ</button>
							</div> <!-- /.product-main-info__button -->
							
						</div> <!-- /.product-main-info__buttons -->
						
						<div class="product-main-info__match skew">
							<button class="button button--normal button--s button--grey">Добавить к сравнению</button>
						</div> <!-- /.product-main-info__match -->
				</div> <!-- /.product__main-info -->
			</div> <!-- /.product__top -->
			
			<div class="page-product__extra-info product-extra-info">
				<div class="product-extra-info__tabs-box">
					<div class="product-extra-info__tabs skew">
						
						<div class="product-extra-info__tab-box">
							<a href="#tab1" class="product-extra-info__tab active">Описание</a>
						</div> <!-- /.product-extra-info__tab-box -->
						
						<div class="product-extra-info__tab-box">
							<a href="#tab2" class="product-extra-info__tab">Видео</a>
						</div> <!-- /.product-extra-info__tab-box -->
						
						<div class="product-extra-info__tab-box">
							<a href="#tab3" class="product-extra-info__tab">Технические характеристики</a>
						</div> <!-- /.product-extra-info__tab-box-->
						
						<div class="product-extra-info__tab-box">
							<a href="#tab4" class="product-extra-info__tab">Расходные материалы</a>
						</div> <!-- /.product-extra-info__tab-box -->
					</div> <!-- /.product-extra-info__tabs -->
				</div> <!-- /.product-extra-info__tabs-box -->
				
				<div class="product-extra-info__blocks">
					<div class="product-extra-info__block" id="tab1">
						<div class="product-extra-info__text">
							<?=$content->description?>
						</div> <!-- /.product-extra-info__text -->
					</div> <!-- /.product-extra-info__block -->
					
					<div class="product-extra-info__block" id="tab2">
						<div class="product-extra-info__video">
							<iframe width="470" height="264" src="//www.youtube.com/embed/3bt1BjUm9mw?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
						</div> <!-- /.product-extra-info__text -->
					</div> <!-- /.product-extra-info__block -->
					
					<div class="product-extra-info__block" id="tab3">
						<div class="product-extra-info__table">
							<table class="info-table">
								<tbody>
									<tr>	
										<td>Параметр</td>
										<td>Информация</td>
									</tr>
									<tr>	
										<td>Параметр</td>
										<td>Информация</td>
									</tr>
									<tr>	
										<td>Параметр</td>
										<td>Информация</td>
									</tr>
									<tr>	
										<td>Параметр</td>
										<td>Информация</td>
									</tr>
									<tr>	
										<td>Параметр</td>
										<td>Информация</td>
									</tr>
									<tr>	
										<td>Параметр</td>
										<td>Информация</td>
									</tr>
								</tbody>
							</table> <!-- /.info-table -->
						</div> <!-- /.product-extra-info__table -->
					</div> <!-- /.product-extra-info__block -->
					
					<div class="product-extra-info__block" id="tab4">
						<div class="product-extra-info__text">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, consequuntur quos inventore quisquam quae sed labore doloremque eum et atque provident voluptatibus dolore in quas cupiditate accusantium dolor, laboriosam, ea?</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, consequuntur quos inventore quisquam quae sed labore doloremque eum et atque provident voluptatibus dolore in quas cupiditate accusantium dolor, laboriosam, ea?</p>
						</div> <!-- /.product-extra-info__text -->
					</div> <!-- /.product-extra-info__block -->
				</div> <!-- /.product-extra-info__blocks -->
			</div> <!-- /.product__extra-info .product-extra-info -->
			
			<div class="product__catalog catalog">
				<h2 class="catalog__subtitle">рекомендуемые товары</h2>
				
				<div class="catalog__list catalog__list--border-bottom">
					<div class="catalog__item">
						<div class="catalog-item">
							<div class="catalog-item__image-box">
								<a href="product.html"><img src="images/catalog/1/1-225x170.jpg" alt="item" width="225" height="170" class="catalog-item__image" /></a>
							</div> <!-- /.catalog-item__image-box -->
							
							<a href="product.html" class="catalog-item__name">Диск колесный</a>
							
							<div class="catalog-item__desc">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>
							</div> <!-- /.catalog-item__desc -->
							
							<div class="catalog-item__bottom skew">
								<div class="catalog-item__price">10 000р.</div> <!-- /.catalog-item__price -->
								
								<div class="catalog-item__button">
									<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
								</div> <!-- /.catalog-item__button -->
							</div> <!-- /.catalog-item__bottom -->
						</div> <!-- /.catalog-item -->
					</div> <!-- /.catalog__item -->

					<div class="catalog__item">
						<div class="catalog-item">
							<div class="catalog-item__image-box">
								<a href="product.html"><img src="images/catalog/1/1-225x170.jpg" alt="item" width="225" height="170" class="catalog-item__image" /></a>
							</div> <!-- /.catalog-item__image-box -->
							
							<a href="product.html" class="catalog-item__name">Диск колесный</a>
							
							<div class="catalog-item__desc">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>
							</div> <!-- /.catalog-item__desc -->
							
							<div class="catalog-item__bottom skew">
								<div class="catalog-item__price">10 000р.</div> <!-- /.catalog-item__price -->
								
								<div class="catalog-item__button">
									<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
								</div> <!-- /.catalog-item__button -->
							</div> <!-- /.catalog-item__bottom -->
						</div> <!-- /.catalog-item -->
					</div> <!-- /.catalog__item -->                        
            
					<div class="catalog__item">
						<div class="catalog-item">
							<div class="catalog-item__image-box">
								<a href="product.html"><img src="images/catalog/1/1-225x170.jpg" alt="item" width="225" height="170" class="catalog-item__image" /></a>
							</div> <!-- /.catalog-item__image-box -->
							
							<a href="product.html" class="catalog-item__name">Диск колесный</a>
							
							<div class="catalog-item__desc">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>
							</div> <!-- /.catalog-item__desc -->
							
							<div class="catalog-item__bottom skew">
								<div class="catalog-item__price">10 000р.</div> <!-- /.catalog-item__price -->
								
								<div class="catalog-item__button">
									<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
								</div> <!-- /.catalog-item__button -->
							</div> <!-- /.catalog-item__bottom -->
						</div> <!-- /.catalog-item -->
					</div> <!-- /.catalog__item -->                       
					
					<div class="catalog__item">
						<div class="catalog-item">
							<div class="catalog-item__image-box">
								<a href="product.html"><img src="images/catalog/1/1-225x170.jpg" alt="item" width="225" height="170" class="catalog-item__image" /></a>
							</div> <!-- /.catalog-item__image-box -->
							
							<a href="product.html" class="catalog-item__name">Диск колесный</a>
							
							<div class="catalog-item__desc">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>
							</div> <!-- /.catalog-item__desc -->
							
							<div class="catalog-item__bottom skew">
								<div class="catalog-item__price">10 000р.</div> <!-- /.catalog-item__price -->
								
								<div class="catalog-item__button">
									<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
								</div> <!-- /.catalog-item__button -->
							</div> <!-- /.catalog-item__bottom -->
						</div> <!-- /.catalog-item -->
					</div> <!-- /.catalog__item -->
				</div> <!-- /.catalog__list -->
				
				<h2 class="catalog__subtitle">Новинки</h2>
				
				<div class="catalog__list">
				
					<?foreach($new_products as $new_item):?>	
						<div class="catalog__item">
							<div class="catalog-item">
								<div class="catalog-item__image-box">
									<a href="<?=$new_item->full_url?>"><img src="<?=$new_item->img->url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
								</div> <!-- /.catalog-item__image-box -->
								
								<a href="<?=$new_item->full_url?>" class="catalog-item__name"><?=$new_item->name?></a>
								
								<div class="catalog-item__desc">
									<p><?=$new_item->description?></p>
								</div> <!-- /.catalog-item__desc -->
								
								<div class="catalog-item__bottom skew">
									<div class="catalog-item__price"><?=$new_item->price?></div> <!-- /.catalog-item__price -->
									
									<div class="catalog-item__button">
										<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
									</div> <!-- /.catalog-item__button -->
								</div> <!-- /.catalog-item__bottom -->
							</div> <!-- /.catalog-item -->
						</div> <!-- /.catalog__item -->
					<?endforeach;?>
				</div> <!-- /.catalog__list -->
			</div> <!-- /.product__catalog .catalog -->
		</div> <!-- /.product__wrap wrap -->
	</div> <!-- /.product -->

	<div class="text-about" id="text-about">
		<div class="text-about__wrap wrap">
			<h2 class="text-about__title block-title">Продукция от компании &laquo;redBTR&raquo;</h2>
			<div class="text-about__text">
				<?=$settings->description?>
			</div> <!-- /.text-about__text -->
		</div> <!-- /.text-about__wrap wrap -->
	</div> <!-- /.text-about -->
		
	<footer class="footer" id="footer">
        
            <div class="footer__wrap wrap">
                
                <div class="footer__subscribe">
                    
                    <div class="subscribe skew">
                        
                        <div class="subscribe__title">
                            Для наших подписчиков - скидки,
                            новинки и полезные советы!
                        </div> <!-- /.subscribe__title -->

                        <div class="subscribe__form">

                            <div class="subscribe-form">

                                <form action="#" class="form" method="post">
                                  
                                    <div class="subscribe-form__line">
                                        
                                        <input type="text" class="form__input subscribe-form__input required email" name="email" placeholder="" />
                                
                                    </div> <!-- /.subscribe__line -->
                                    
                                    <div class="subscribe-form__button">
                                        
                                        <button class="button button--normal">Подписаться</button>
                                
                                    </div> <!-- /.subscribe__button -->
                                
                                </form> <!-- /.form -->

                            </div> <!-- /.subscribe-form -->
                            
                        </div> <!-- /.subscribe__form -->

                    </div> <!-- /.subscribe -->

                </div> <!-- /.footer__subscribe -->

                <div class="footer__nav">
                    
                    <div class="footer-nav">
                        
                        <ul class="footer-nav__list">
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href footer-nav__title skew">Поддержка клиентов</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Авторизованные<br /> cервисные центры</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Запасные части</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Запасные части лебедок</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Комплекующие шноркелей</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Документация по продуктам</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Гарантийные обязательства. <br />Правила эксплуатации</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Сертификаты</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Регистрация и вход</a>
                                
                                <ul class="footer-nav-level-2">
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Регистрация продуктов</a>
                                    </li> <!-- /.footer-nav-level-2__item -->
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Регистрация пользователя</a>
                                    </li> <!-- /.footer-nav-level-2__item -->
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Вход в Личный кабинет</a>
                                    </li> <!-- /.footer-nav-level-2__item -->

                                </ul> <!-- /.footer-nav-level-2 -->

                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Свяжитесь с нами</a>
                            </li> <!-- /.footer-nav__item -->

                        </ul> <!-- /.footer-nav__list -->
                        
                        <ul class="footer-nav__list">
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href footer-nav__title skew">Где купить</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Продажа и сервис</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Юридическим лицам / <br /> предпринимателям</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Как стать дилером</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Контакты</a>
                            </li> <!-- /.footer-nav__item -->

                        </ul> <!-- /.footer-nav__list -->
                        
                        <ul class="footer-nav__list">
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href footer-nav__title skew">О нас</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Новости</a>
                                
                                <ul class="footer-nav-level-2">
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Выставки</a>
                                    </li> <!-- /.footer-nav-level-2__item -->
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Внедорожные мероприятия</a>
                                    </li> <!-- /.footer-nav-level-2__item -->

                                </ul> <!-- /.footer-nav-level-2 -->
                            
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">История компании</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Производства</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Политика качества</a>
                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Ча.Во / FAQ</a>
                                
                                <ul class="footer-nav-level-2">
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Анатомия продуктов / тесты</a>
                                    </li> <!-- /.footer-nav-level-2__item -->
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Статьи</a>
                                    </li> <!-- /.footer-nav-level-2__item -->

                                </ul> <!-- /.footer-nav-level-2 -->

                            </li> <!-- /.footer-nav__item -->
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href">Работа с магазином</a>
                                
                                <ul class="footer-nav-level-2">
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Информация</a>
                                    </li> <!-- /.footer-nav-level-2__item -->
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Оформление заказа</a>
                                    </li> <!-- /.footer-nav-level-2__item -->
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Информация о доставке</a>
                                    </li> <!-- /.footer-nav-level-2__item -->
                                    
                                    <li class="footer-nav-level-2__item">
                                        <a href="#" class="footer-nav-level-2__href">Дисконтная система</a>
                                    </li> <!-- /.footer-nav-level-2__item -->

                                </ul> <!-- /.footer-nav-level-2 -->

                            </li> <!-- /.footer-nav__item -->

                        </ul> <!-- /.footer-nav__list -->
                        
                        <ul class="footer-nav__list">
                            
                            <li class="footer-nav__item">                                
                                <a href="#" class="footer-nav__href footer-nav__title skew">Контакты</a>
                            </li> <!-- /.footer-nav__item -->

                        </ul> <!-- /.footer-nav__list -->

                    </div> <!-- /.footer-nav -->

                </div> <!-- /.footer__nav -->   

                <div class="footer__contacts">
                    
                    <div class="contacts-info">
                        
                        <div class="contacts-info__item">
                            
                            <div class="contacts-info__copy">
                                redBTR &copy; 2014
                            </div> <!-- /.contacts-info__copy -->

                            <a href="mailto:info@redBTR.ru" class="contacts-info__email">info@redBTR.ru</a>

                        </div> <!-- /.contacts-info__item -->
                        
                        <div class="contacts-info__item">
                            
                            <div class="contacts-info-phone contacts-info-phone--footer">

                                <div class="contacts-info-phone__city">
                                    Санкт-петербург
                                </div> <!-- /.contacts-info-phone__city -->

                                <div class="contacts-info-phone__number">
                                    +7 (812) <span>999 99 99</span>
                                </div> <!-- /.contacts-info-phone__number -->
                                
                            </div> <!-- /.contacts-info-phone -->

                        </div> <!-- /.contacts-info__item -->
                        
                        <div class="contacts-info__item">
                            
                            <div class="contacts-info-phone contacts-info-phone--footer">

                                <div class="contacts-info-phone__city">
                                    Япония
                                </div> <!-- /.contacts-info-phone__city -->

                                <div class="contacts-info-phone__number">
                                    +7 (812) <span>999 99 99</span>
                                </div> <!-- /.contacts-info-phone__number -->
                                
                            </div> <!-- /.contacts-info-phone -->

                        </div> <!-- /.contacts-info__item -->
                        
                        <div class="contacts-info__item">
                            
                            <div class="contacts-info-phone contacts-info-phone--footer">

                                <div class="contacts-info-phone__city">
                                    Китай
                                </div> <!-- /.contacts-info-phone__city -->

                                <div class="contacts-info-phone__number">
                                    +7 (812) <span>999 99 99</span>
                                </div> <!-- /.contacts-info-phone__number -->
                                
                            </div> <!-- /.contacts-info-phone -->

                        </div> <!-- /.contacts-info__item -->

                    </div> <!-- /.contacts-info -->

                </div> <!-- /.footer__contacts -->     
        
            </div> <!-- /.footer__wrap wrap -->
        
        </footer> <!-- /.header -->



        <div class="modal modal--to-cart" id="to-cart">

            <div class="modal__title block-title">
                Товар "<span>Диск колесный</span>" 
                <br /> добавлен в корзину
            </div> <!-- /.modal__title block-title -->

            <div class="modal__text">
                <p>
                    
                </p>
            </div> <!-- /.modal__text -->

            <div class="modal__cart modal-cart">
                
                <form action="cart.html" class="form" method="get"> <!-- method="get" only for demo -->
                  
                    <div class="form__line modal-cart__line skew">
                        
                        <label class="form__label modal-cart__label">Кол-во в корзине: </label>

                        <input type="text" class="form__input modal-cart__input required" name="amount" placeholder="" value="1" />
                
                    </div> <!-- /.form__line -->
                    
                    <div class="form__button modal-cart__button skew">
                        
                        <button type="button" class="button button--normal button--auto-width js-close-fancybox">Вернуться к покупкам</button>
                        
                        <button type="submit" class="button button--normal button--grey button--auto-width">В корзину &rarr;</button>
                
                    </div> <!-- /.form__button -->
                
                </form> <!-- /.form -->

            </div> <!-- /.modal__cart -->

        </div> <!-- /.modal -->



        <div class="modal" id="callback">

            <div class="modal__title block-title">
                Оставьте ваш номер телефона
            </div> <!-- /.modal__title block-title -->

            <div class="modal__text">
                <p>
                    
                </p>
            </div> <!-- /.modal__text -->

            <div class="modal__form">
                
                <form action="#" class="form" method="post">

                    <div class="form__line skew">
                        
                        <input type="text" class="form__input required" name="name" placeholder="Имя" />
                
                    </div> <!-- /.form__line -->

                    <div class="form__line skew">
                        
                        <input type="tel" class="form__input required" name="phone" placeholder="Телефон" />
                
                    </div> <!-- /.form__line -->
                    
                    <div class="form__button skew">
                        
                        <button class="button button--normal button--auto-width">Заказать звонок</button>
                
                    </div> <!-- /.form__button -->
                
                </form> <!-- /.form -->

            </div> <!-- /.modal__form -->

        </div> <!-- /.modal -->


        <div class="modal" id="success">
            
            <div class="modal__title block-title">
                Спасибо за оставленную заявку!
            </div> <!-- /.modal__title block-title -->

            <div class="modal__text">
                <p>
                    Наш менеджер свяжется <br />
                    с вами в ближайшее время.
                </p>
            </div> <!-- /.modal__text -->

        </div> <!-- /.modal -->        



        <!-- Scripts -->
        
        <!-- polifils for IE -->
        <!--[if lte IE 9]>
        <script src="js/vendor/placeholders.js"></script>
        <script src="js/vendor/selectivizr-min.js"></script>
        <![endif]-->
        
        <!-- Старая версия потому что с новыми не работает карта -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

        <!-- Скрипт popup -->
        <script src="<?=base_url()?>template/client/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script> 

        <!-- Обработка и валидация форм -->
        <script src="<?=base_url()?>template/client/js/vendor/jquery.form.min.js"></script>
        <script src="<?=base_url()?>template/client/js/vendor/jquery.validate.min.js"></script>

        <!-- Slider -->
        <script src="<?=base_url()?>template/client/js/bxslider/jquery.bxslider.min.js"></script>

        <!-- UI -->
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

        <script type="text/javascript" src="http://ajaxs.ru/demo/jq/jqvmap/jqvmap/js/jquery.vmap.js"></script>
        <script type="text/javascript" src="http://ajaxs.ru/demo/jq/jqvmap/jqvmap/js/maps/jquery.vmap.russia.js"></script>  

        
        <!-- main script -->
        <script src="<?=base_url()?>template/client/js/main.js"></script>

    </body>
</html>