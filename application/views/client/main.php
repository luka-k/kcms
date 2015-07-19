<!DOCTYPE html>
<html>

<?require 'include/head.php'?>

<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->
	
	<?require 'include/top-menu.php'?>
	<?require 'include/header.php'?>

	<div class="main-catalog-nav clearfix" id="main-catalog-nav">
		<div class="main-catalog-nav__wrap wrap">
							
			<div class="main-catalog-nav-search">
				<form action="<?=base_url()?>search" id="searchform" class="form" method="get">
					<input type="text" id="search_input" class="form__input menu-search__input search" name="name" placeholder="Поиск по сайту" value="<?if(isset($search)):?><?=$search?><?endif;?>" onkeypress="autocomp()"/>
				</form>
			</div> <!-- /.main-catalog-nav__columns -->
					
			<div class="main-catalog-nav-button">
				<a href="<?base_url()?>catalog" class="catalog-button">ИНтернет магазин</a>
			</div> 
		</div> <!-- /.main-catalog-nav__wrap wrap -->
	</div> <!-- /.main-catalog-nav -->
	
    
	<div class="main-news-nav" id="main-news-nav">
		<div class="main-news-nav__wrap wrap">
			<?require 'include/slider.php'?>
			
			<div class="newsblock">
				<ul class="tabs1 tabs">
					<li id="tab_1" class="tab-title"><a href="#tab1" class="first" onclick="return false;">Новости</a></li>
					<li id="tab_2" class="tab-title last"><a href="#tab2" class="second" onclick="return false;">События</a></li>
				</ul>
				
				<div class="tabcontents">
					<div id="tab1" class="tabswitcher tab_content">
						<?foreach($last_news as $news_item):?>
							<div class="tab-item">
								<div class="item_date"><?=$news_item->date?></div>
								<div class="item_text">
									<a href="<?=$news_item->full_url?>"><?=$news_item->short_description?></a>
								</div>
							</div>
						<?endforeach;?>
						<div class="tab-link">
							<a href="<?=base_url()?>articles/novosti">все новости &rarr;</a>
						</div>
					</div>
					<div id="tab2" class="tabswitcher tab_content">
						<?$event_counter = 1?>
						<?foreach($last_events as $event_item):?>
							<div class="tab-item <?if($event_counter == 2):?>deep-grey<?endif;?>">
								<div class="item_date"><?=$event_item->date?></div>
								<div class="item_text">
									<a href="<?=$event_item->full_url?>"><?=$event_item->short_description?></a>
								</div>
							</div>
							<?$event_counter++?>
						<?endforeach;?>
						<div class="tab-link">
							<a href="<?=base_url()?>articles/sobytiya">все события &rarr;</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="main-categories-nav clearfix" id="main-categories-nav">
		<div class="main-categories-nav__wrap wrap ">
			<div class="main-category-item blue">
				<a href="">
					<div class="category-icon">
						<img src="<?=base_url()?>template/client/images/main-category-1.png"/>
					</div>
					<div class="category-title">
						Иностранная</br> литература
					</div>
				</a>
			</div>
			<div class="main-category-item deep-blue">
				<a href="">
					<div class="category-icon">
						<img src="<?=base_url()?>template/client/images/main-category-2.png"/>
					</div>
					<div class="category-title">
						Издательство
					</div>
				</a>
			</div>
			<div class="main-category-item green">
				<a href="#">
					<div class="category-icon">
						<img src="<?=base_url()?>template/client/images/main-category-3.png"/>
					</div>
					<div class="category-title">
						Учебно-методическоий</br> центр
					</div>
				</a>
			</div>
			<div class="main-category-item red last">
				<a href="#">
					<div class="category-icon">
						<img src="<?=base_url()?>template/client/images/main-category-4.png"/>
					</div>
					<div class="category-title">
						Экзаменационный</br> центр
					</div>
				</a>
			</div>
		</div>
	</div>
	
	<div class="text-about text-about--main" id="text-about">
		<div class="text-about__wrap wrap">
			<h2 class="text-about__title">О компании</h2>
			<div class="text-about__text">
				<?=$settings->site_description?>
			</div> <!-- /.text-about__text -->
		</div> <!-- /.text-about__wrap wrap -->
	</div> <!-- /.text-about -->

	<?require 'include/footer.php'?>
		
	<?require 'include/modal.php'?>

    </body>
</html>