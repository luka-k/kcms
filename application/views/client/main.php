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
				<ul class="inline-categories__list skew">
					<li class="inline-categories__item">
						<a href="catalog.html" class="inline-categories__href active">По применяемости</a>
					</li> <!-- /.inline-categories__item -->
					<li class="inline-categories__item">
						<a href="<?=base_url()?>catalog/" class="inline-categories__href">Каталог</a>
					</li> <!-- /.inline-categories__item -->
				</ul> <!-- /.inline-categories__inner -->
			</div> <!-- /.main-catalog-nav__titles -->
			
			<div class="main-catalog-nav__columns">
				<ul class="main-catalog-nav__list">
					<li class="main-catalog-nav__item">
						<a href="catalog.html" class="main-catalog-nav__href">AVT <span>("Quatro Crazy")</span></a>
					</li> <!-- /.main-catalog-nav__item -->
					
					<li class="main-catalog-nav__item">
						<a href="catalog.html" class="main-catalog-nav__href">Водный транспорт <span>("Mission Naval")</span></a>
					</li> <!-- /.main-catalog-nav__item -->
					
					<li class="main-catalog-nav__item">
						<a href="catalog.html" class="main-catalog-nav__href">Туризм <span>("Country side")</span></a>
					</li> <!-- /.main-catalog-nav__item -->
				</ul> <!-- /.main-catalog-nav__list -->
				
				<ul class="main-catalog-nav__list">
					<li class="main-catalog-nav__item">
						<a href="catalog.html" class="main-catalog-nav__href">Тяжелое бездорожье и внедорожный спорт <span>("Mission Impossible")</span></a>
					</li> <!-- /.main-catalog-nav__item -->
					
					<li class="main-catalog-nav__item">
						<a href="catalog.html" class="main-catalog-nav__href">Промышленность <span>("Mission SOS")</span></a>
					</li> <!-- /.main-catalog-nav__item -->
				</ul> <!-- /.main-catalog-nav__list -->
			</div> <!-- /.main-catalog-nav__columns -->
		</div> <!-- /.main-catalog-nav__wrap wrap -->
	</div> <!-- /.main-catalog-nav -->
        
	<div class="main-catalog" id="main-catalog">
		<div class="main-catalog__wrap wrap">
			<div class="catalog">
				<h2 class="catalog__subtitle">Выгодное предложение</h2>
				
				<div class="catalog__list catalog__list--border-bottom">
					<?foreach($good_buy as $good_item):?>	
						<div class="catalog__item">
							<div class="catalog-item">
								<div class="catalog-item__image-box">
									<a href="<?=$good_item->full_url?>"><img src="<?=$good_item->img->url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
								</div> <!-- /.catalog-item__image-box -->
								
								<a href="<?=$good_item->full_url?>" class="catalog-item__name"><?=$good_item->name?></a>
								
								<div class="catalog-item__desc">
									<p><?=$good_item->description?></p>
								</div> <!-- /.catalog-item__desc -->
								
								<div class="catalog-item__bottom skew">
									<div class="catalog-item__price"><?=$good_item->price?></div> <!-- /.catalog-item__price -->
									
									<div class="catalog-item__button">
										<button class="button button--normal fancybox" data-fancybox-href="#to-cart">Купить</button>
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
			</div> <!-- /.catalog -->
		</div> <!-- /.main-catalog__wrap wrap -->
	</div> <!-- /.main-catalog -->

	<div class="text-about text-about--main" id="text-about">
		<div class="text-about__wrap wrap">
			<h2 class="text-about__title block-title">Продукция от компании &laquo;redBTR&raquo;</h2>
			<div class="text-about__text">
				<?=$settings->description?>
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
						<a href="#" class="last-news__name"><?=$news_item->name?></a>
						
						<div class="last-news__desc">
							<p><?=$news_item->description?></p>
						</div> <!-- /.last-news__desc -->
					</li> <!-- /.last-news__item -->
				<?endforeach;?>
			</ul> <!-- /.last-news__list -->
		</div> <!-- /.last-news__wrap wrap -->
	</div> <!-- /.last-news -->
	
	<div class="main-videos" id="main-videos">
		<div class="main-videos__wrap wrap">
			<div class="main-videos__list">
				<?foreach($video as $video_item):?>
					<div class="main-videos__item"><?=$video_item->link?></div> <!-- /.main-videos__item -->
				<?endforeach;?>
			</div> <!-- /.main-videos__list -->
		</div> <!-- /.main-videos__wrap wrap -->
	</div> <!-- /.main-videos -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	
    </body>
</html>