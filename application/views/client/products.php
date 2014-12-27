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
	
	<div class="page page-catalog" id="page-catalog">
		<div class="page-wrap wrap">
			<div class="page-catalog__nav">
				<? require 'include/left-menu.php'?>
			</div> <!-- /.page-catalog__nav -->
			
			<div class="page-catalog__content">
				<div class="page-catalog__filter">
					<div class="catalog-filter">
						<form action="#" class="form" method="post">
							<div class="catalog-filter__top">
								<div class="form__line catalog-filter__line">
									<span class="form__select-arrow">
										<span class="form__select-box">
											<select class="form__select" name="by_name">
												<option value="">По авто</option>
												<option value="">Авто1</option>
												<option value="">Авто2</option>
											</select>
										</span>
									</span>
								</div> <!-- /.form__line -->
								
								<div class="form__line catalog-filter__line">
									<span class="form__select-arrow">
										<span class="form__select-box">
											<select class="form__select" name="by_name">
												<option value="">По применению</option>
												<option value="">Применение 1</option>
												<option value="">Применение 2</option>
											</select>
										</span>
									</span>
								</div> <!-- /.form__line -->
							</div> <!-- /.catalog-filter__top -->
							
							<div class="catalog-filter__range">
								<div class="catalog-range">
									<div class="catalog-range__scale">
										<div class="catalog-range__from">
											Цена: от <span data-range-from>1000</span>
										</div> <!-- /.catalog-range__from -->
										
										<div class="catalog-range__to">
											до <span data-range-to>10000</span>
										</div> <!-- /.catalog-range__to -->
									</div> <!-- /.catalog-slider__scale -->
									
									<div class="catalog-range__slider" data-range-slider="true" data-range-min="1000" data-range-max="10000"></div> <!-- /.catalog-range__slider -->
								</div> <!-- /.catalog-range -->
							</div> <!-- /.catalog-filter__range -->
							
							<div class="form__line catalog-filter__checkbox">
								<div class="form__checkbox checkbox">
									<label class="checkbox__label">
										<input type="checkbox" name="whatever" class="checkbox__input" value="" />
										<span class="checkbox__text">В наличии</span>
									</label>
								</div> <!-- /.radio -->
							</div> <!-- /.form__line -->
						</form> <!-- /.form -->
					</div> <!-- /.catalog-filter -->
				</div> <!-- /.page-catalog__filter -->
				
				<div class="page-catalog__products"> 
					<?if(!isset($content)):?>
						<h2 class="catalog__subtitle">Выгодное предложение</h2>
				
						<div class="catalog__list catalog__list--border-bottom">
							<?foreach($good_buy as $good_item):?>	
								<div class="catalog__item">
									<div class="catalog-item">
										<div class="catalog-item__image-box">
											<a href="<?=$good_item->full_url?>"><img src="<?=$good_item->img->catalog_mid_url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
										</div> <!-- /.catalog-item__image-box -->
								
										<a href="<?=$good_item->full_url?>" class="catalog-item__name"><?=$good_item->name?></a>
								
										<div class="catalog-item__desc">
											<p><?=$good_item->description?></p>
										</div> <!-- /.catalog-item__desc -->
								
										<div class="catalog-item__bottom skew">
											<div class="catalog-item__price"><?=$good_item->price?></div> <!-- /.catalog-item__price -->
									
											<div class="catalog-item__button">
												<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$good_item->id?>', '<?=$good_item->name?>'); return false;">Купить</button>
											</div> <!-- /.catalog-item__button -->
										</div> <!-- /.catalog-item__bottom -->
									</div> <!-- /.catalog-item -->
								</div> <!-- /.catalog__item -->
							<?endforeach;?>
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
											<p><?=$new_item->description?></p>
										</div> <!-- /.catalog-item__desc -->
								
										<div class="catalog-item__bottom skew">
											<div class="catalog-item__price"><?=$new_item->price?></div> <!-- /.catalog-item__price -->
									
											<div class="catalog-item__button">
												<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$new_item->id?>', '<?=$new_item->name?>'); return false;">Купить</button>
											</div> <!-- /.catalog-item__button -->
										</div> <!-- /.catalog-item__bottom -->
									</div> <!-- /.catalog-item -->
								</div> <!-- /.catalog__item -->
							<?endforeach;?>
						</div> <!-- /.catalog__list -->
					<?else:?>
						<div class="catalog">
							<div class="catalog__sort catalog-sort">
								<a href="#price" class="catalog-sort__href active">По цене</a>
								<a href="#price" class="catalog-sort__href">По наименованию</a>
							</div> <!-- /.catalog__sort catalog-sort-->
						
							<h1 class="catalog__subtitle"><?=$content->name?></h1>
						
							<div class="catalog__list">
								<?foreach($content->products as $item):?>
									<div class="catalog__item">
										<div class="catalog-item">
											<div class="catalog-item__image-box">
												<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_mid_url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
											</div> <!-- /.catalog-item__image-box -->
										
											<a href="<?=$item->full_url?>" class="catalog-item__name"><?=$item->name?></a>
										
											<div class="catalog-item__desc">
												<p><?=$item->description?></p>
											</div> <!-- /.catalog-item__desc -->
										
											<div class="catalog-item__bottom skew">
												<div class="catalog-item__price"><?=$item->price?></div> <!-- /.catalog-item__price -->
											
												<div class="catalog-item__button">
													<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$item->id?>', '<?=$item->name?>'); return false;">Купить</button>
												</div> <!-- /.catalog-item__button -->
											</div> <!-- /.catalog-item__bottom -->
										</div> <!-- /.catalog-item -->
									</div> <!-- /.catalog__item -->
								<?endforeach;?>
							</div> <!-- /.catalog__list -->
						
							<div class="catalog__load load-link">
								<a href="#load" class="load-link__href">Еще товары</a>
							</div> <!-- /.catalog__load -->
						</div> <!-- /.catalog -->
					<?endif;?>
				</div> <!-- /.page-catalog__products -->
			</div> <!-- /.page-catalog__content -->
	</div> <!-- /.page-catalog__wrap wrap -->
</div> <!-- /.page-catalog -->
        
	<div class="text-about" id="text-about">
		<div class="text-about__wrap wrap">
			<h2 class="text-about__title block-title">Продукция от компании &laquo;redBTR&raquo;</h2>
			<div class="text-about__text">
				<?if(isset($content)):?>
					<?=$content->description?>
				<?else:?>
					<?=$settings->description?>
				<?endif;?>
			</div> <!-- /.text-about__text -->
		</div> <!-- /.text-about__wrap wrap -->
	</div> <!-- /.text-about -->
	
	<? require 'include/footer.php'?>
    <? require 'include/modal.php'?>        
	<? require 'include/scripts.php'?>
    </body>
</html>

