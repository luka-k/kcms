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
	
	<? require 'include/top-menu.php'?>
	<? require 'include/header.php'?>
	<? require 'include/slider.php'?>
        
	<div class="main-catalog" id="main-catalog">
		<div class="main-catalog__wrap wrap">
			
			<div class="main-catalog-nav" id="main-catalog-nav">
				<div class="main-catalog-nav__wrap wrap">
					
					<div class="main-catalog-nav-button">
						<a href="<?base_url()?>catalog" class="catalog-button">&nbsp;</a>
					</div> 
			
					<div class="main-catalog-nav-search">
						<form action="<?=base_url()?>search" id="searchform" class="form" method="get">
							<input type="text" id="search_input" class="form__input menu-search__input search" name="name" placeholder="Поиск по сайту" <?if(isset($search)):?>value="<?=$search?>"<?endif;?> onkeypress="autocomp()"/>
						</form>
					</div> <!-- /.main-catalog-nav__columns -->
				</div> <!-- /.main-catalog-nav__wrap wrap -->
			</div> <!-- /.main-catalog-nav -->
	
			<div class="catalog">				
				<div class="catalog__list catalog__list--border-bottom clearfix">
					<h2 class="catalog__subtitle">Выгодное предложение</h2>
					<div class="catalog-slider">
						<div name="prev" class="navy prev-slide-1">&nbsp;</div>
						<div name="next" class="navy next-slide-1">&nbsp;</div>
					
						<div class="slide-list">
							<div class="slide-wrap-1">
								<?foreach($special as $special_item):?>
									<div class="slide-item-1">
										<div class="catalog-item">
											<div class="catalog-item-top">
												<a href="<?=$special_item->full_url?>" class="catalog-item__autor"><?=$special_item->autor?></a>
												<a href="<?=$special_item->full_url?>" class="catalog-item__name"><?=$special_item->name?></a>
											</div>
											<div class="catalog-item__image-box">
												<a href="<?=$special_item->full_url?>"><img src="<?=$special_item->img->catalog_mid_url?>" alt="item" class="catalog-item__image" /></a>
											</div> <!-- /.catalog-item__image-box -->
											<div class="catalog-item__price"><?=$special_item->price?> р.</div>
										</div>
									</div>
								<?endforeach;?>	
							</div>
						</div>
					</div>
				</div> <!-- /.catalog__list -->
				
				
				
				<div class="catalog__list clearfix">
					<h2 class="catalog__subtitle">Актуальные книги</h2>
				
					<div class="catalog-slider">
						<div name="prev" class="navy prev-slide-2">&nbsp;</div>
						<div name="next" class="navy next-slide-2">&nbsp;</div>
					
						<div class="slide-list">
							<div class="slide-wrap-2">
								<?foreach($new_products as $new_item):?>
									<div class="slide-item-2">
										<div class="catalog-item">
											<div class="catalog-item-top">
												<a href="<?=$new_item->full_url?>" class="catalog-item__autor"><?=$new_item->autor?></a>
												<a href="<?=$new_item->full_url?>" class="catalog-item__name"><?=$new_item->name?></a>
											</div>
											<div class="catalog-item__image-box">
												<a href="<?=$new_item->full_url?>"><img src="<?=$new_item->img->catalog_mid_url?>" alt="item" class="catalog-item__image" /></a>
											</div> <!-- /.catalog-item__image-box -->
											<div class="catalog-item__price"><?=$new_item->price?> р.</div>
										</div>
									</div>
								<?endforeach;?>	
							</div>
						</div>
					</div>
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
							<?=$news_item->short_description?>
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