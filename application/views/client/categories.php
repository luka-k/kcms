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
	
	<div class="page page-catalog" id="page-catalog">
		<div class="page-wrap wrap">
		
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
			
			<div class="page-catalog__nav">
				<? require 'include/left-sidebar.php'?>
			</div> <!-- /.page-catalog__nav -->
			
			<div class="page-catalog__content">
				
				<div class="page-catalog__products"> 
						
						<div class="slider">
							<img src="<?base_url()?>template/client/images/slider.png" width="817px"/>
						</div>

						<div class="catalog">
							<h2 class="catalog__subtitle">Актуальные книги</h2>
							<div class="catalog-slider">
								<div name="prev" class="navy prev-slide-1">&nbsp;</div>
								<div name="next" class="navy next-slide-1">&nbsp;</div>
					
								<div class="slide-list">
									<div class="slide-wrap-1">
										<?foreach($category->products as $item):?>
											<div class="slide-item-1">
												<div class="catalog-item">
													<div class="catalog-item-top">
														<a href="<?=$item->full_url?>" class="catalog-item__autor"><?=$item->autor?></a>
														<a href="<?=$item->full_url?>" class="catalog-item__name"><?=$item->name?></a>
													</div>
													<div class="catalog-item__image-box">
														<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_mid_url?>" alt="item" class="catalog-item__image" /></a>
													</div> <!-- /.catalog-item__image-box -->
													<div class="catalog-item__price"><?=$item->price?> р.</div>
												</div>
											</div>
										<?endforeach;?>	
									</div>
								</div>
							</div>	
							
							<h2 class="catalog__subtitle">Выгодное предложение</h2>
							<div class="catalog-slider">
								<div name="prev" class="navy prev-slide-2">&nbsp;</div>
								<div name="next" class="navy next-slide-2">&nbsp;</div>
					
								<div class="slide-list">
									<div class="slide-wrap-2">
										<?foreach($category->products as $item):?>
											<div class="slide-item-2">
												<div class="catalog-item">
													<div class="catalog-item-top">
														<a href="<?=$item->full_url?>" class="catalog-item__autor"><?=$item->autor?></a>
														<a href="<?=$item->full_url?>" class="catalog-item__name"><?=$item->name?></a>
													</div>
													<div class="catalog-item__image-box">
														<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_mid_url?>" alt="item" class="catalog-item__image" /></a>
													</div> <!-- /.catalog-item__image-box -->
													<div class="catalog-item__price"><?=$item->price?> р.</div>
												</div>
											</div>
										<?endforeach;?>	
									</div>
								</div>
							</div>	
						
							<!--<div class="catalog__load load-link">
								<a href="#load" class="load-link__href">Еще товары</a>
							</div> <!-- /.catalog__load -->
						</div> <!-- /.catalog -->

				</div> <!-- /.page-catalog__products -->
			</div> <!-- /.page-catalog__content -->
	</div> <!-- /.page-catalog__wrap wrap -->
</div> <!-- /.page-catalog -->
        
	<? require 'include/footer.php'?>
    <? require 'include/modal.php'?>  
    </body>
</html>

