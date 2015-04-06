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
	<? require 'include/slider.php'?>
	
	<div class="main-catalog-nav" id="main-catalog-nav">
		<div class="main-catalog-nav__wrap wrap">
			<div class="main-catalog-nav__titles inline-categories">
				<ul class="inline-categories__list">
					<li class="inline-categories__item">
						<a href="<?=base_url()?>catalog/" class="inline-categories__href active">По применяемости</a>
					</li> <!-- /.inline-categories__item -->
					<li class="inline-categories__item">
						<a href="<?=base_url()?>catalog/" class="inline-categories__href">Каталог</a>
					</li> <!-- /.inline-categories__item -->
				</ul> <!-- /.inline-categories__inner -->
			</div> <!-- /.main-catalog-nav__titles -->
			
			<!--<div class="main-catalog-nav__columns">
				<?$counter = 1?>
				<?$line = ceil(count($catalog_by_filter)/2)?>
				<?foreach($catalog_by_filter as $name => $link):?>
					<?if($counter == 1):?><ul class="main-catalog-nav__list"><?endif;?>
						<li class="main-catalog-nav__item">
							<a href="<?=$link?>" class="main-catalog-nav__href"><?=$name?></a>
						</li> <!-- /.main-catalog-nav__item -->
					<?if($counter == $line):?></ul><?$counter = 0?><?endif;?>
					<?$counter++?>
				<?endforeach;?>
			<!--</div> <!-- /.main-catalog-nav__columns -->
		</div> <!-- /.main-catalog-nav__wrap wrap -->
	</div> <!-- /.main-catalog-nav -->
        
	<div class="main-catalog" id="main-catalog">
		<div class="main-catalog__wrap wrap">
			<div class="catalog">
				<h2 class="catalog__subtitle">Выгодное предложение</h2>
				
				<div class="catalog__list catalog__list--border-bottom">
					<?foreach($special as $special_item):?>	
						<div class="catalog__item">
							<div class="catalog-item">
								<div class="catalog-item__image-box">
									<a href="<?=$special_item->full_url?>"><img src="<?=$special_item->img->catalog_mid_url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
								</div> <!-- /.catalog-item__image-box -->
								
								<a href="<?=$special_item->full_url?>" class="catalog-item__name"><?=$special_item->name?></a>
								
								<div class="catalog-item__desc">
									<?=$special_item->short_description?>
								</div> <!-- /.catalog-item__desc -->
								
								<div class="catalog-item__bottom">
									<div class="catalog-item__price"><?=$special_item->price?> р.</div> <!-- /.catalog-item__price -->
									
									<div class="catalog-item__button">
										<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$special_item->id?>', '<?=$special_item->name?>', 1); return false;">Купить</button>
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
									<?=$new_item->short_description?>
								</div> <!-- /.catalog-item__desc -->
								
								<div class="catalog-item__bottom">
									<div class="catalog-item__price"><?=$new_item->price?> р.</div> <!-- /.catalog-item__price -->
									
									<div class="catalog-item__button">
										<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$new_item->id?>', '<?=$new_item->name?>', 1); return false;">Купить</button>
									</div> <!-- /.catalog-item__button -->
								</div> <!-- /.catalog-item__bottom -->
							</div> <!-- /.catalog-item -->
						</div> <!-- /.catalog__item -->
					<?endforeach;?>
				</div> <!-- /.catalog__list -->
			</div> <!-- /.catalog -->
		</div> <!-- /.main-catalog__wrap wrap -->
	</div> <!-- /.main-catalog -->

	<div class="text-about text-about--main" id="text-about">
		<div class="text-about__wrap wrap">
			<h2 class="text-about__title block-title"><?=$settings->site_title?></h2>
			<div class="text-about__text">
				<?=$settings->site_description?>
			</div> <!-- /.text-about__text -->
		</div> <!-- /.text-about__wrap wrap -->
	</div> <!-- /.text-about -->
	
	<div class="last-news" id="last-news">
		<div class="last-news__wrap wrap">
			<h2 class="last-news__title">Новости</h2>
			
			<ul class="last-news__list">
				<?foreach($last_news as $news_item):?>
					<li class="last-news__item">
						<div class="last-news__date"><?=$news_item->date?></div> <!-- /.last-news__date -->
						<a href="<?=$news_item->full_url?>" class="last-news__name"><?=$news_item->name?></a>
						
						<div class="last-news__desc">
							<?=$news_item->description?>
						</div> <!-- /.last-news__desc -->
					</li> <!-- /.last-news__item -->
				<?endforeach;?>
			</ul> <!-- /.last-news__list -->
		</div> <!-- /.last-news__wrap wrap -->
	</div> <!-- /.last-news -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>

    </body>
</html>