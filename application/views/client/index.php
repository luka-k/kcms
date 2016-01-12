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
				
				<div class="home-page">
					<div class="content">
						
					<? require "include/slider.php";?>
					
					<div class="container">
						<!-- ============================================== BANNERS ============================================== -->
						
						<? require "include/banners.php";?>	
						
						<!-- ============================================== BANNERS : END ============================================== -->
						
						<!-- ============================================== NEW ============================================== -->
						<?if(!empty($new)):?>
							<section class="best-seller wow fadeInUp">
								<div id="best-seller" class="module">
									<div class="module-heading home-page-module-heading">
										<h2 class="module-title home-page-module-title"><span>НОВИНКИ</span></h2>
									</div><!-- /.module-heading -->
								
									<div class="module-body">
										<div class="row books full-width">
											<input type="hidden" name="viewmore" class="viewmore_input" value="" />
											<div id="books_content" class="clearfix text-center">
												<? foreach($new as $np):?>
													<div class="col-md-3 col-sm-6">
														<div class="book">
															<a href="<?= $np->full_url?>">
																<div class="<?if($np->cover == 'book'):?>book-cover<?elseif($np->cover == 'album'):?>album-cover<?else:?>cd-cover<?endif;?>" style="cursor: pointer;" onclick="document.location='<?= $np->full_url?>'">
																	<a href="<?= $np->full_url?>">
																		<?if($np->cover == 'book'):?>
																			<img width="140" height="212" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $np->img->catalog_mid_url?>">
																		<?elseif($np->cover == 'album'):?>
																			<img width="160" height="106" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $np->img->catalog_mid_album_url?>">
																		<?else:?>
																			<img width="140" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $np->img->catalog_mid_cd_url?>">
																		<?endif;?>
																	</a> <!--assets/images/book-covers/01.jpg-->
																	<?if($np->is_sale):?>
																		<div class="tag"><span>sale</span></div>
																	<?endif;?>
																</div>
															</a>
															<div class="book-details clearfix">
																<div class="book-description">
																	<h3 class="book-title"><a href="<?= $np->full_url?>"><?= $np->name?></a></h3>
																	<p class="book-subtitle"> автор<a href="<?= $np->full_url?>"> <?= $np->autor?></a></p>
																</div>
																<div class="text-center">
																	<div class="actions">
																		<span class="book-price price"><?= $np->price?> р.</span>               
																		<div class="cart-action"> 
																			<a class="add-to-cart" title="В корзину" href="#" onclick="addToCart('<?= $np->id?>', 1); return false;">Add to Cart</a>       
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<? endforeach;?>
												
												
											</div>
										</div>
									</div>
								</div>
							</section>
						<?endif;?>
						<!-- ============================================== NEW : END ============================================== -->
						
						<!-- ============================================== SPECIAL ============================================== -->
						<?if(!empty($special)):?>
							<section class="best-seller wow fadeInUp">
								<div id="best-seller" class="module">
									<div class="module-heading home-page-module-heading">
										<h2 class="module-title home-page-module-title"><span>СПЕЦИАЛЬНЫЕ ПРЕДЛОЖЕНИЯ</span></h2>
									</div><!-- /.module-heading -->
								
									<div class="module-body">
										<div class="row books full-width">
											<input type="hidden" name="viewmore" class="viewmore_input" value="" />
											<div id="books_content" class="clearfix text-center">
												<? foreach($special as $sp):?>
													<div class="col-md-3 col-sm-6">
														<div class="book">
															<a href="<?= $sp->full_url?>">
																<div class="<?if($sp->cover == 'book'):?>book-cover<?elseif($sp->cover == 'album'):?>album-cover<?else:?>cd-cover<?endif;?>" style="cursor: pointer;" onclick="document.location='<?= $sp->full_url?>'">
																	<a href="<?= $sp->full_url?>">
																		<?if($sp->cover == 'book'):?>
																			<img width="140" height="212" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $sp->img->catalog_mid_url?>">
																		<?elseif($sp->cover == 'album'):?>
																			<img width="160" height="106" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $sp->img->catalog_mid_album_url?>">
																		<?else:?>
																			<img width="140" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $sp->img->catalog_mid_cd_url?>">
																		<?endif;?>
																	</a> <!--assets/images/book-covers/01.jpg-->
																	<?if($sp->is_sale):?>
																		<div class="tag"><span>sale</span></div>
																	<?endif;?>
																</div>
															</a>
														
														<div class="book-details clearfix">
															<div class="book-description">
																<h3 class="book-title"><a href="<?= $sp->full_url?>"><?= $sp->name?></a></h3>
																<p class="book-subtitle"> автор<a href="<?= $sp->full_url?>"> <?= $sp->autor?></a></p>
															</div>
															<div class="text-center">
																<div class="actions">
																	<span class="book-price price"><?= $sp->price?> р.</span>               
																	<div class="cart-action"> 
																		<a class="add-to-cart" title="В корзину" href="#" onclick="addToCart('<?= $sp->id?>', 1); return false;">Add to Cart</a>       
																	</div>
																</div>
															</div>
														</div>
														</div>
													</div>

												<? endforeach;?>
												
												
											</div>
										</div>
									</div>
								</div>
							</section>
						<?endif;?>
						<!-- ============================================== SPECIAL : END ============================================== -->
							
					</div><!-- /.container -->
					
					<!-- ============================================== TESTIMONIAL ============================================== -->

					<!-- ============================================== TESTIMONIAL : END ============================================== -->

					<?if(!empty($new_products)):?>
						<section class="latest-product wow fadeInUp">
							<div id="latest-product" class="module container inner-top-xs">
								<div class="module-heading home-page-module-heading inner-bottom-vs">
									<h2 class="module-title home-page-module-title"><span>Новинки</span></h2>
								</div>
								<div class="module-body">
									<!-- ============================================== LATEST PRODUCT ============================================== -->

									<div class="book-shelf inner-bottom glass-shelf">
										<div class="row">
											<div class="col-md-10 col-sm-10 center-block clearfix">
												<?foreach($new_products as $np):?>
													<div class="col-md-3 col-sm-4">						                
														<div class="book-cover bk-cover product-book-cover">
															<a href="<?= $p->full_url?>"><img class="img-responsive" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $np->images->catalog_mid_url?>" width="182" height="273" ></a> <!--book-covers/06.jpg-->
															<div class="fade"></div>
														</div> <!-- /.book-cover --> 														
													</div><!-- /.col -->
												<?endforeach;?>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-10 center-block marketing-block">
											<h2 class="text-center">
												<span>We Empower WordPress Developers With Design-Driven</span>
												<span>Themes And A Classy Experience Their Clients</span>
												<span> Will Just Love</span>
											</h2>
											
											<div class="divider inner-xs">
												<img class="img-responsive" src="<?= IMG_PATH?>shadow5656.png" alt="">
											</div><!-- /.divider -->
											
											<div class="row wow fadeInUp features-block">
												<?foreach($new_products as $np):?>
													<div class="col-xs-12 col-sm-6 feature-block">
														<div class="media inner-bottom-xs">
															<div class="media-body">
																<h4 class="media-heading"><?= $np->name?></h4>
																<p><?= $np->short_description?></p> 
																<a href="<?= $np->full_url?>" class="find-more">Больше  &rarr;</a>
															</div>
															<div class="media-right media-middle icon-media">
																<div class="icon-block">
																	<span class="fa-stack fa-lg">
																		<i class="fa fa-circle fa-stack-2x"></i>
																		<i class="fa fa-eye fa-stack-1x fa-inverse text-center"></i>
																	</span>
																</div><!-- /.icon-block --> <!--fa-mobile fa-lightbulb-o  fa-sliders-->
															</div><!-- /.media-right -->
														</div><!-- /.media -->
														<hr/> <!--class="visible-xs"---->
													</div><!-- /.feature-block -->
												<?endforeach;?>
											</div><!-- /.features-block -->
										</div>
									</div>

									<!-- ============================================== LATEST PRODUCT : END ============================================== -->
									<!-- ============================================== IMAGE BLOCK ============================================== -->
<div class="image-block wow fadeInUp inner-top-sm">
	<div class='row'>
		<div class="col-md-4 col-sm-6">
			<div class="banners">
				<div class="banner green-banner">
					<div class='image'>
						<img class="img-responsive" src="<?= IMG_PATH?>blank.gif" data-echo="assets/images/product1.jpg" alt="">
					</div><!-- /.image -->
					<div class='caption'>
						<h2 class='title'>sale</h2>
						<hr>
						<p>The sale don't stop up to 75% off!</p>
					</div><!-- /.caption -->
				</div><!-- /.banner -->
			</div><!-- /.banners -->
		</div><!-- /.col -->

		<div class="col-md-4 col-sm-6 hidden-xs">
			<div class="banners">
				<div class="banner black-banner">
					<div class='image'>
						<img class="img-responsive" src="<?= IMG_PATH?>blank.gif" data-echo="assets/images/product2.jpg" alt="">
					</div><!-- /.image -->
					<div class='caption'>
						<h2 class='title'>Games</h2>
						<hr>
						<p>The sale don't stop up to 75% off!</p>
					</div><!-- /.caption -->
				</div><!-- /.banner -->
			</div><!-- /.banners -->
		</div><!-- /.col -->

		<div class="col-md-4 hidden-xs hidden-sm">
			<div class="banners">
				<div class="banner orange-banner">
					<div class='image'>
						<img class="img-responsive" src="<?= IMG_PATH?>blank.gif" data-echo="assets/images/product3.jpg" alt="">
					</div><!-- /.image -->
					<div class='caption'>
						<h2 class='title'>lookbook</h2>
						<hr>
						<p>Take a look at the upcoming trends</p>
					</div><!-- /.caption -->
				</div><!-- /.banner -->
			</div><!-- /.banners -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.image-block -->
<!-- ============================================== IMAGE BLOCK : END ============================================== -->				</div>
			</div>
	    </section>
		<?endif;?>
		
						<!-- ============================================== FROM BLOG ============================================== -->
		
						<!-- ============================================== FROM BLOG : END ============================================== -->	
					</div><!-- /.content -->
				</div><!-- /.home-page -->           

				<!-- ============================================== FOOTER ============================================== -->
				<?require "include/footer.php";?>
				<!-- ============================================== FOOTER : END ============================================== -->        
			</div><!-- /.st-pusher -->
            <!-- ============================================== TOGGLE RIGHT CONTENT ============================================== -->
			<?require "include/toggle_cart.php";?>
			<!-- ============================================== TOGGLE RIGHT CONTENT : END ============================================== -->
		
		</div><!-- /#wrapper -->

		<?require "include/scripts.php";?>
		
	</body>
</html>