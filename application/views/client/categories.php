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

								<?require "include/category_slider.php"?>
					
									
								<div class="module margin-top-10 wow fadeInUp" id="books-by-month">
									<div class="module-heading home-page-module-heading">
										<h2 class="module-title home-page-module-title">
											<span><?if(isset($category->name)):?><?=$category->name?><?else:?>Каталог<?endif;?></span>
										</h2>
										<!--<p class="see-all-link"><a href="#">See All</a> &rarr;</p>-->
									</div><!-- /.module-heading -->
									<div class="module-body">
										<div class="row books">
											<div class="clearfix text-center">
												<?foreach($category->products as $item):?>
													<div class="col-md-3 col-sm-4">
														<div class="book">
															<div class="book-cover">
																<a href="<?= $item->full_url?>">
																	<img width="140" height="212" src="assets/images/blank.gif" data-echo="<?= $item->images->catalog_small_url?>" alt="" />
																	<?if($item->is_sale):?><div class="tag"><span>sale</span></div><?endif;?>
																</a>
															</div>
															<div class="book-details clearfix">
																<div class="book-description">
																	<h3 class="book-title"><a href="#"><?= $item->name?></a></h3>
																	<p class="book-subtitle">by <a href="#"><?= $item->autor?></a></p>
																</div>
																<div class="actions">
																	<span class="book-price price"><?= $item->price?> руб.</span>
																	<div class="cart-action"> 
																		<a class="add-to-cart" title="Add to Cart" href="single-book.html">В корзину</a>
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