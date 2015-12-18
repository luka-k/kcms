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
				
				<div class="all-categories content">
					<div class="container">
						<div class="row">
							<? require 'include/breadcrumbs.php' ?>
							<div class="divider">
								<img class="img-responsive" src="<?= IMG_PATH?>all-categories/shadow_all_categories_01.png" alt="">
							</div>
						</div><!-- /.row -->
					</div><!-- /.container -->

					<div class="categories-menu-outer wow fadeInUp">
						<div class="container">
							<?/* require "include/categories_menu.php"*/;?>
						</div><!-- /.container -->
					</div><!-- /.categories-menu-outer -->
					
					<div class="container">
						<section class="books-categories wow fadeInUp outer-top-vs">
							<div class="module" id="tab-books">
								<div class="module-heading home-page-module-heading">
									<h2 class="module-title home-page-module-title"><span>Books</span></h2>
								</div><!-- /.module-heading -->
								<div class="module-body">
									<div class="row books full-width">
										<div class="clearfix text-center">
											<div class="text-center"> 
												<ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active"><a href="#new-releases" role="tab" data-toggle="tab">New Releases</a></li>
													<li role="presentation"><a href="#bestsellers" role="tab" data-toggle="tab">Bestsellers</a></li>
													<li role="presentation"><a href="#recommended" role="tab" data-toggle="tab">Recommended</a></li>
												</ul>
											</div>

											<div class="tab-content m-t-20">
												<div role="tabpanel" class="tab-pane active" id="new-releases">
													<?foreach($category->products as $product):?>
														<div class="col-md-3 col-sm-4">
															<div class="book">
																<a href="<?$book->full_url?>">
																	<div class="book-cover">
																		<img width="140" height="212" src="assets/images/blank.gif" data-echo="<?= $books->images->catalog_small_url?>" alt="">
																	</div>
																</a>
																<div class="book-details clearfix">
																	<div class="book-description">
																		<h3 class="book-title"><a href="<?$book->full_url?>"><?$book->name?></a></h3>
																		<p class="book-subtitle">by <a href="single-book.html"><?$book->autor?></a></p>
																	</div>
																	<div class="actions">
																		<span class="book-price price"><?= $book->price?></span>
																		<div class="cart-action"> 
																			<a class="add-to-cart" title="Add to Cart" href="#">В корзину</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<?endforeach;?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="divider">
								<img class="img-responsive" src="assets/images/all-categories/shadow_all_categories_02.png" alt="">
							</div>
						</section>
					</div><!-- /.container -->
					
					<!-- ============================================== FROM BLOG ============================================== -->
					<?/*require "include/blog.php";*/?>
					<!-- ============================================== FROM BLOG : END ============================================== -->
				</div><!-- /.all-categories content -->            
				
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