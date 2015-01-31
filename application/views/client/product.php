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
	<? require 'include/breadcrumbs.php'?>
	<div class="page page-product" id="product">
		<div class="page__wrap wrap">
			<div class="page-product__top">
				<div class="page-product__images product-images">
					<div class="product-images__big-image-box">
						<a href="<?=$content->img[0]->full_url?>" class="product-images__href fancyimage" data-fancybox-group="big">
							<img    src="<?=$content->img[0]->catalog_big_url?>" 
                                    width="470" 
                                    height="470" 
                                    alt="image" 
                                    class="product-images__big-image"/>
						</a>
						<?if(isset($content->img[1])):?>
						<a href="<?=$content->img[1]->full_url?>" class="product-images__href fancyimage" data-fancybox-group="big">
							<img    src="<?=$content->img[1]->catalog_big_url?>" 
                                    width="470" 
                                    height="470" 
                                    alt="image" 
                                    class="product-images__big-image"/>
						</a>
						<?endif;?>
					</div> <!-- /.product-images__big-image-box -->
					
					<div class="product-images__thumbs">
						<ul class="product-images-thumbs">
							<?foreach($content->img as $images):?>
								<li class="product-images-thumbs__item">
									<a  href="<?=$images->catalog_big_url?>"
										data-full-image="<?=$images->full_url?>"
										class="product-images-thumbs__href">
											<img src="<?=$images->catalog_small_url?>" alt="image" class="product-images-thumbs__image" />
									</a>
								</li> <!-- /.product-images-thumbs__item -->
							<?endforeach;?>
						</ul> <!-- /.product-images-thumbs -->
					</div> <!-- /.product-images__thumbs -->
				</div> <!-- /.product__images .product-images -->
			
				<div class="page-product__main-info product-main-info">
					<h1 class="product-main-info__title"><?=$content->name?></h1>
					<div class="product-main-info__desc"><?=$content->name?></div> <!-- /.product-main-info__desc -->
						<ul class="product-main-info__characteristics">
							<li class="product-main-info__characteristic">
								<strong>Артикул</strong> <?=$content->article?>
							</li> <!-- /.product-main-info__characteristic -->
							
							<li class="product-main-info__characteristic">
								<strong>Гарантия</strong> <?=$content->warrant?>
							</li> <!-- /.product-main-info__characteristic -->
						</ul> <!-- /.product-main-info__characteristics -->
						
						<div class="product-main-info__text">
							<?=$content->short_description?>
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
									</div> <!-- /.product-price__normal -->
                                <?endif;?>
							</div> <!-- /.catalog-item-price -->
						</div> <!-- /.product-main-info__price -->
						
						<div class="product-main-info__buttons skew">
							<div class="product-main-info__button">
								<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$content->id?>', '<?=$content->name?>', 1); return false;">Купить</button>
							</div> <!-- /.product-main-info__button -->
							
							<div class="product-main-info__button">
								<button class="button button--normal button--grey fancybox" data-fancybox-href="#callback">Быстрый заказ</button>
							</div> <!-- /.product-main-info__button -->
							
						</div> <!-- /.product-main-info__buttons -->
						
						<!--<div class="product-main-info__match skew">
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
						
						<!--<div class="product-extra-info__tab-box">
							<a href="#tab3" class="product-extra-info__tab">Технические характеристики</a>
						</div> <!-- /.product-extra-info__tab-box-->
						
						<!--<div class="product-extra-info__tab-box">
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
							<?if(!empty($content->video)):?>
								<iframe width="470" height="264" src="//www.youtube.com/embed/<?=$content->video?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							<?endif;?>
						</div> <!-- /.product-extra-info__text -->
					</div> <!-- /.product-extra-info__block -->
					
					<!--<div class="product-extra-info__block" id="tab3">
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
						<!--</div> <!-- /.product-extra-info__table -->
					<!--</div> <!-- /.product-extra-info__block -->
					
					<!--<div class="product-extra-info__block" id="tab4">
						<div class="product-extra-info__text">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, consequuntur quos inventore quisquam quae sed labore doloremque eum et atque provident voluptatibus dolore in quas cupiditate accusantium dolor, laboriosam, ea?</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae, consequuntur quos inventore quisquam quae sed labore doloremque eum et atque provident voluptatibus dolore in quas cupiditate accusantium dolor, laboriosam, ea?</p>
						</div> <!-- /.product-extra-info__text -->
					<!--</div> <!-- /.product-extra-info__block -->
				</div> <!-- /.product-extra-info__blocks -->
			</div> <!-- /.product__extra-info .product-extra-info -->
			
			<div class="product__catalog catalog">
				<!--<h2 class="catalog__subtitle">рекомендуемые товары</h2>
				
				<div class="catalog__list catalog__list--border-bottom">
					<div class="catalog__item">
						<div class="catalog-item">
							<div class="catalog-item__image-box">
								<a href="product.html"><img src="images/catalog/1/1-225x170.jpg" alt="item" width="225" height="170" class="catalog-item__image" /></a>
							</div> <!-- /.catalog-item__image-box -->
							
							<!--<a href="product.html" class="catalog-item__name">Диск колесный</a>
							
							<div class="catalog-item__desc">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fuga, aut laborum quas expedita</p>
							</div> <!-- /.catalog-item__desc -->
							
							<!--<div class="catalog-item__bottom skew">
								<div class="catalog-item__price">10 000р.</div> <!-- /.catalog-item__price -->
								
								<!--<div class="catalog-item__button">
									<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
								</div> <!-- /.catalog-item__button -->
							<!--</div> <!-- /.catalog-item__bottom -->
						<!--</div> <!-- /.catalog-item -->
					<!--</div> <!-- /.catalog__item -->

				<!--</div> <!-- /.catalog__list -->
				
				<h2 class="catalog__subtitle">Новинки</h2>
				
				<div class="catalog__list">
					<?foreach($new_products as $new_item):?>	
						<div class="catalog__item">
							<div class="catalog-item">
								<div class="catalog-item__image-box">
									<a href="<?=$new_item->full_url?>"><img src="<?=$new_item->img->catalog_mid_url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
								</div> <!-- /.catalog-item__image-box -->
								
								<a href="<?=$new_item->full_url?>" class="catalog-item__name"><?=$new_item->name?></a>
								
								<div class="catalog-item__desc">
									<p><?=$new_item->short_description?></p>
								</div> <!-- /.catalog-item__desc -->
								
								<div class="catalog-item__bottom skew">
									<div class="catalog-item__price"><?=$new_item->price?> р.</div> <!-- /.catalog-item__price -->
									
									<div class="catalog-item__button">
										<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$new_item->id?>', '<?=$new_item->name?>'); return false;">Купить</button>
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
			<h2 class="text-about__title block-title"></h2>
			<div class="text-about__text">
				<?=$content->description?>
			</div> <!-- /.text-about__text -->
		</div> <!-- /.text-about__wrap wrap -->
	</div> <!-- /.text-about -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?> 
	<? require 'include/scripts.php'?>

    </body>
</html>