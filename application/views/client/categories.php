<!DOCTYPE html>
<html lang="en">
	<? require 'include/head.php' ?>
	<body>
		<div id="wrapper" >
			<div id="page-content-wrapper" class="st-pusher">
				<div class="st-pusher-after"></div>
				<!-- ============================================== HEADER ============================================== -->
	
				<? require 'include/header.php' ?>

				<!-- ============================================== HEADER : END ============================================== -->           
				
				<div class="content wow fadeInUp">
					<div class="container">
						<div class="row">
							<? require 'include/breadcrumbs.php' ?>
							<div class="divider">
								<img class="img-responsive" src="<?= IMG_PATH?>all-categories/shadow.png" alt="">
							</div><!-- /.divider -->
						</div><!-- /.row -->

						<div class="row m-t-20 books-with-sidebar">
							<div class="col-md-9 col-md-push-3">
		
								<!-- ========================================== SECTION – HERO : END========================================= -->

								<?//require "include/category_slider.php"?>
					
									
								<div class="module margin-top-10 wow fadeInUp" id="books-by-month">
									<div class="module-heading home-page-module-heading">
										<h2 class="module-title home-page-module-title">
											<span><?if(isset($category->name)):?><?=$category->name?><?else:?>Каталог<?endif;?></span>
										</h2>
										<!--<p class="see-all-link"><a href="#">See All</a> &rarr;</p>-->
									</div><!-- /.module-heading -->
									<div class="module-body">
										<input type="hidden" id="viemore" name="viewmore" class="viewmore_input" value="" />
										<input type="hidden" name="cateroryId" class="viewmore_input_category" value="<?if(isset($category->id)):?><?=$category->id?><?elseif(isset($filters_values)):?>filter<?else:?>root<?endif;?>" />
										<div id="books_content" class="row books">
											<div class="clearfix text-center">
												<?foreach($category->products as $item):?>
													<div class="col-md-3 col-sm-4">
														<div class="book">
															<div class="book-cover">
																<a href="<?= $item->full_url?>">
																	<img width="140" height="212" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $item->img->catalog_mid_url?>" alt="" />
																	<?if($item->is_sale):?><div class="tag"><span>sale</span></div><?endif;?>
																</a>
															</div>
															<div class="book-details clearfix">
																<div class="book-description">
																	<h3 class="book-title"><a href="<?= $item->full_url?>"><?= $item->name?></a></h3>
																	<p class="book-subtitle">автор<a href=""<?= $item->full_url?>"><?= $item->autor?></a></p>
																</div>
																<div class="actions">
																	<span class="book-price price"><?= $item->price?> руб.</span>
																	<div class="cart-action"> 
																		<a class="add-to-cart" title="Add to Cart" href="#" onclick="addToCart('<?= $item->id?>', 1); return false;">В корзину</a>
																	</div>
																</div>
															</div>
														</div>
													</div><!-- /.col -->
												<?endforeach;?>
											</div><!-- /.text-center -->
										</div><!-- /.row -->
									</div><!-- /.module-body -->
								</div><!-- /.module -->
								
								<div class="view-more-holder col-md-12 center-block text-center inner-top-xs">
									<a role="button" class="btn btn-primary btn-uppercase" href="#" onclick="viewmore(); return false;">показать еще</a>
								</div>
							</div><!-- /.col -->

							<div class="col-md-3 col-md-pull-9">
								<?require "include/sidebar.php";?>
							</div>
						</div><!-- /.row -->
					</div><!-- /.container -->

					<!-- ============================================== TESTIMONIAL ============================================== -->
					
					<!-- ============================================== TESTIMONIAL : END ============================================== -->
	
					<!-- ============================================== FROM BLOG ============================================== -->
					
					<!-- ============================================== FROM BLOG : END ============================================== -->
				</div><!-- /.content -->           

				<!-- ============================================== FOOTER ============================================== -->
				<?require "include/footer.php";?>
				<!-- ============================================== FOOTER : END ============================================== -->        
			</div><!-- /.st-pusher -->
			<!-- ============================================== TOGGLE RIGHT CONTENT ============================================== -->
			<?require "include/toggle_cart.php";?>
			<!-- ============================================== TOGGLE RIGHT CONTENT : END ============================================== -->
			
			<?require "include/modal.php";?>
		</div><!-- /#wrapper -->

		<?require "include/scripts.php";?>
	</body>
</html>