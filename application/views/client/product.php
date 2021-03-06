﻿<!DOCTYPE html>
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
						<?foreach($product->images as $images):?>
							<a href="<?=$images->full_url?>" class="product-images__href fancyimage" data-fancybox-group="big">
								<img    src="<?=$images->catalog_big_url?>" 
										width="470" 
										height="470" 
										alt="image" 
										class="product-images__big-image"/>
							</a>
						<?endforeach;?>
					</div> <!-- /.product-images__big-image-box -->
					
					<div class="product-images__thumbs">
						<ul class="product-images-thumbs">
							<?foreach($product->images as $images):?>
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
					<h1 class="product-main-info__title"><?=$product->name?></h1>
					<div class="product-main-info__desc"><?=$product->name?></div> <!-- /.product-main-info__desc -->
						<ul class="product-main-info__characteristics">
							<li class="product-main-info__characteristic">
								<strong>Артикул</strong> <?=$product->article?>
							</li> <!-- /.product-main-info__characteristic -->
						</ul> <!-- /.product-main-info__characteristics -->
						
						<div class="product-main-info__text">
							<?=$product->short_description?>
						</div> <!-- /.product-main-info__text -->
						
						<div class="product-main-info__price">
							<div class="product-price">
								<?if(isset($product->sale_price)):?>
									<!-- Цена со скидкой -->
									<div class="product-price__old">
										Старая цена: <span><?=$product->price?> р.</span>
									</div> <!-- /.product-price__old -->
									
									<div class="product-price__new">
										Новая цена: <span><?=$product->sale_price?> р.</span>
									</div> <!-- /.product-price__new -->
								<?else:?>
									<div class="product-price__normal">
										Цена: <span><?=$product->price?> р.</span>
									</div> <!-- /.product-price__normal -->
                                <?endif;?>
							</div> <!-- /.catalog-item-price -->
						</div> <!-- /.product-main-info__price -->
						
						<div class="product-main-info__buttons">
							<div class="product-main-info__button">
								<button class="button button--normal fancybox" onclick="cart_popup('<?=$product->id?>', '<?=$product->name?>', 1); return false;">Купить</button>
							</div> <!-- /.product-main-info__button -->
							
							<div class="product-main-info__button">
								<button class="button button--normal button--grey fancybox" onclick="fastOrder('<?=$product->id?>', '<?=$product->name?>', '<?= $product->images[0]->catalog_mid_url?>'); return false;">Быстрый заказ</button>
							</div> <!-- /.product-main-info__button -->
							
						</div> <!-- /.product-main-info__buttons -->
						
						<!--<div class="product-main-info__match skew">
							<button class="button button--normal button--s button--grey">Добавить к сравнению</button>
						</div> <!-- /.product-main-info__match -->
				</div> <!-- /.product__main-info -->
			</div> <!-- /.product__top -->
			
			<div class="page-product__extra-info product-extra-info">
				<div class="product-extra-info__tabs-box">
					<div class="product-extra-info__tabs">
						
						<div class="product-extra-info__tab-box">
							<a href="#tab1" class="product-extra-info__tab active">Описание</a>
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
							<?=$product->description?>
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
				<h2 class="catalog__subtitle">Рекомендуемые товары</h2>
				
				<div class="catalog__list catalog__list--border-bottom">
				
					<?foreach($product->recommended_products as $r_p):?>
						<div class="catalog__item">
							<div class="catalog-item">
								<div class="catalog-item__image-box">
									<a href="<?=$r_p->full_url?>"><img src="<?=$r_p->img->catalog_mid_url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
								</div> <!-- /.catalog-item__image-box -->
							
								<a href="<?=$r_p->full_url?>" class="catalog-item__name"><?=$r_p->name?></a>
							
								<div class="catalog-item__desc">
									<p><?=$r_p->description?></p>
								</div> <!-- /.catalog-item__desc -->
							
								<div class="catalog-item__bottom">
									<div class="catalog-item__price"><?=$r_p->price?>р.</div> <!-- /.catalog-item__price -->
								
									<div class="catalog-item__button">
										<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="cart_popup('<?=$r_p->id?>', '<?=$r_p->name?>', 1); return false;">Купить</button>
									</div> <!-- /.catalog-item__button -->
								</div> <!-- /.catalog-item__bottom -->
							</div> <!-- /.catalog-item -->
						</div> <!-- /.catalog__item -->
					<?endforeach?>
				</div> <!-- /.catalog__list -->
				
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
								
								<div class="catalog-item__bottom">
									<div class="catalog-item__price"><?=$new_item->price?> р.</div> <!-- /.catalog-item__price -->
									
									<div class="catalog-item__button">
										<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="cart_popup('<?=$new_item->id?>', '<?=$new_item->name?>', 1); return false;">Купить</button>
									</div> <!-- /.catalog-item__button -->
								</div> <!-- /.catalog-item__bottom -->
							</div> <!-- /.catalog-item -->
						</div> <!-- /.catalog__item -->
					<?endforeach;?>
				</div> <!-- /.catalog__list -->
			</div> <!-- /.product__catalog .catalog -->
		</div> <!-- /.product__wrap wrap -->
	</div> <!-- /.product -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>

    </body>
</html>