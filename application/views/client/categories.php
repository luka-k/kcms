<!DOCTYPE html>
<html>
<?require 'include/head.php'?>

<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->
	
	<?require 'include/top-menu.php'?>

	
	<? require 'include/header.php'?>
        
	<div class="main-catalog" id="main-catalog">
		<div class="main-catalog__wrap wrap">
			
			<?require_once 'include/leftside.php'?>			
				
			<div class="catalog">				
				<div class="shop-catalog-nav-search">
					<form action="<?=base_url()?>search" id="searchform" class="form" method="get">
						<input type="text" id="search_input" class="form__input shop-search__input search" name="name" placeholder="Поиск по сайту"/>
					</form>
					<a href="" class="shop-search__button">&nbsp;</a>
				</div> <!-- /.main-catalog-nav__columns -->

				<?if($category == 'root'):?>
					<? require 'include/shop_slider.php'?>
					
					<?if(!empty($new_products)):?>
						<div class="catalog__list clearfix">
							<h2 class="catalog__subtitle">Актуальные книги</h2>
							<div class="catalog-slider">
								<div name="prev" class="navy prev-slide-1">&nbsp;</div>
								<div name="next" class="navy next-slide-1">&nbsp;</div>
					
								<div class="slide-list">
									<div class="slide-wrap-1">
										<?foreach($new_products as $np):?>
											<div class="slide-item-1">
												<div class="catalog-item">
													<div class="catalog-item-top">
														<a href="<?=$np->full_url?>" class="catalog-item__autor"><?=$np->autor?></a>
														<a href="<?=$np->full_url?>" class="catalog-item__name"><?=$np->name?></a>
													</div>
													<div class="catalog-item__image-box">
														<a href="<?=$np->full_url?>">
															<img src="<?=$np->img->catalog_small_url?>" class="catalog-item__image" alt="<?=$np->name?>" />
														</a>
													</div> <!-- /.catalog-item__image-box -->
													<div class="catalog-item__price"><?=$np->price?> р.</div>
												</div>
											</div>
										<?endforeach;?>
									</div>
								</div>
							</div>
						</div> <!-- /.catalog__list -->
					<?endif;?>
				
					<?if(!empty($special_products)):?>
						<div class="catalog__list clearfix">
							<h2 class="catalog__subtitle">Выгодное предложение</h2>
				
							<div class="catalog-slider">
								<div name="prev" class="navy prev-slide-2">&nbsp;</div>
								<div name="next" class="navy next-slide-2">&nbsp;</div>
					
								<div class="slide-list">
									<div class="slide-wrap-2">
										<?foreach($special_products as $sp):?>
											<div class="slide-item-2">
												<div class="catalog-item">
													<div class="catalog-item-top">
														<a href="<?=$sp->full_url?>" class="catalog-item__autor"><?=$sp->autor?></a>
														<a href="<?=$sp->full_url?>" class="catalog-item__name"><?=$sp->name?></a>
													</div>
													<div class="catalog-item__image-box">
														<a href="<?=$sp->full_url?>">
															<img src="<?=$sp->img->catalog_small_url?>" class="catalog-item__image" alt="<?=$sp->name?>"/>
														</a>
													</div> <!-- /.catalog-item__image-box -->
													<div class="catalog-item__price"><?=$sp->price?> р.</div>
												</div>
											</div>
										<?endforeach;?>
							
									</div>
								</div>
							</div>
						</div> <!-- /.catalog__list -->
					<?endif;?>
				<?else:?>
					<div class="catalog_books clearfix">
						<?require_once 'include/breadcrumbs.php'?>
						<?if(isset($category->name)):?>
							<h2 class="catalog__subtitle"><?=$category->name?></h2>
						<?endif;?>
						
						<div class="books_list">
							<?$product_counter = 1?>
							<?foreach($products as $p):?>
								<div class="books-item <?if($product_counter == 5):?>last <?$product_counter = 0?><?endif;?>">
									<div class="books-item-top">
										<a href="<?=$p->full_url?>" class="books-item__autor"><?=$p->autor?></a>
										<a href="<?=$p->full_url?>" class="books-item__name"><?=$p->name?></a>
									</div>
									<div class="books-item__image-box">
										<a href="<?=$p->full_url?>"><img src="<?=$p->img->catalog_small_url?>" class="books-item__image" alt="<?=$p->name?>"/></a>
									</div> <!-- /.catalog-item__image-box -->
									<div class="books-item__price"><?=$p->price?> р.</div>
								</div>
								<?$product_counter++?>
							<?endforeach;?>
						</div>
					</div>
				<?endif;?>
			</div> <!-- /.catalog -->
		</div> <!-- /.main-catalog__wrap wrap -->
	</div> <!-- /.main-catalog -->

	<?require 'include/footer.php'?>
	
	<?require 'include/modal.php'?>

    </body>
	<script type="text/javascript">
			jQuery(document).ready(function(){
			function htmSlider(num){
				var slideWrap = jQuery('.slide-wrap-'+num);
				var nextLink = jQuery('.next-slide-'+num);
				var prevLink = jQuery('.prev-slide-'+num);
				var playLink = jQuery('.auto');
				var is_animate = false;
				var slideWidth = jQuery('.slide-item-'+num).outerWidth();
				var scrollSlider = slideWrap.position().left - slideWidth;
		
				nextLink.click(function(){
					if(!slideWrap.is(':animated')) {
						slideWrap.animate({left: scrollSlider}, 300, function(){
							slideWrap
							.find('.slide-item-'+num+':first')
							.appendTo(slideWrap)
							.parent()
							.css({'left': 0});
						});
					}
				});
 
				prevLink.click(function(){
					if(!slideWrap.is(':animated')) {
						slideWrap
						.css({'left': scrollSlider})
						.find('.slide-item-'+num+':last')
						.prependTo(slideWrap)
						.parent()
						.animate({left: 0}, 300);
					}
				});
			}
 
			htmSlider(1);
			htmSlider(2);
		});
	</script>
</html>