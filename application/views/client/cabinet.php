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
						
					
					
					<div class="container">
						<!-- ============================================== BANNERS ============================================== -->
						
						
						<!-- ============================================== BANNERS : END ============================================== -->
						
						
						<!-- ============================================== BEST SELLER ============================================== -->
						<section class="best-seller wow fadeInUp">
								<div id="best-seller" class="module">
							
									<div class="module-body">
										<div class="row books full-width">
											<div class="clearfix" style="width:48%; margin-left:2%; float:left;">
												<h2 class="module-title home-page-module-title">Персональные данные</h2>
												<form method="post" class="form" action="<?=base_url()?>cabinet/update_info/personal" style="width:95%;"/>
													<input type="hidden" name="id"  value="<?=$user->id?>"/>
													
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<input type="text" class="form-control bookshop-form-control validate" name="name" placeholder="Имя" value="<?if($user->name):?><?=$user->name?><?endif;?>"/>
													</div><!-- /.form-group -->
													
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<input type="text" class="form-control bookshop-form-control validate" name="email" placeholder="E-mail" value="<?if($user->email):?><?=$user->email?><?endif;?>" />
													</div> <!-- /.form__line -->
							
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<input type="text" class="form-control bookshop-form-control" name="phone" placeholder="Телефон" value="<?if($user->phone):?><?=$user->phone?><?endif;?>" />
													</div> <!-- /.form__line -->
				
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<input type="text" class="form-control bookshop-form-control" name="address" placeholder="Адрес" value="<?if($user->address):?><?=$user->address?><?endif;?>" />
													</div> <!-- /.form__line -->
				
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<button type="submit" class="btn btn-primary btn-uppercase">Изменить данные</button>
													</div> <!-- /.form__button -->
												</form>
											</div>
			
											
											<div class="clearfix" style="width:49%; float:left;">
												<h2 class="module-title home-page-module-title">Изменить пароль</h2>
												<form method="post" class="form" action="<?=base_url()?>cabinet/update_info/pass" style="width:95%;"/>
													<input type="hidden" name="id"  value="<?=$user->id?>"/>
				
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<input type="password" class="form-control bookshop-form-control validate" name="password" autocomplete="off" placeholder="Пароль" value=""/>
													</div> <!-- /.form__line -->
				
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<input type="password" class="form-control bookshop-form-control validate" name="conf_password" autocomplete="off" placeholder="Повторите" value="" />
													</div> <!-- /.form__line -->
				
													<div class="form-group clearfix" style="margin-bottom:15px;">
														<button type="submit" class="btn btn-primary btn-uppercase">Изменить пароль</button>
													</div> <!-- /.form__button -->
												</form>
											</div>
											
											<div class="clearfix" style="width:100%; float:left;">
											<h2 class="module-title home-page-module-title">Ваши заказы</h2>
											<?if(!empty($orders)):?>
												<div>
													<table>
														<tbody>
															<tr>
																<th></th>
																<th>Товары</th>
																<th>Дата</th>
																<th>Статус</th>
															</tr>
															<?$counter = 1?>
															<?foreach($orders as $item_id => $item):?>
																<tr>
																	<td><?=$counter?></td>
																	<td>
																		<table>
																			<tbody>
																				<?foreach($item->order_products as $p):?>
																					<tr style="font-size:14px;">
																						<th><?=$p->product_name?></th>
																						<th><?=$p->product_price?> р.</th>
																						<th><?=$p->order_qty?> шт.</th>
																					</tr>
																				<?endforeach;?>
																			</tbody>
																		</table>
																	</td>
																	<td><div class="cart-table__price"><?=$item->date?></div> <!-- /.cart-table__price --></td>
																	<td style="text-align:center"><?=$item->status?></td>
																</tr>
															<?endforeach;?>
														</tbody>
													</table> <!-- /.cart-table -->
												</div> <!-- /.page-cart__products -->
											<?else:?>
												Вы еще не сделали заказов.
											<?endif;?>	
											</div>
										</div>
									</div>
								</div>
						</section>
						<!-- ============================================== BEST SELLER : END ============================================== -->		
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
															<img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="<?= $np->images->catalog_small_url?>" width="182" height="273" > <!--book-covers/06.jpg-->
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
						<img class="img-responsive" src="assets/images/blank.gif" data-echo="assets/images/product1.jpg" alt="">
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
						<img class="img-responsive" src="assets/images/blank.gif" data-echo="assets/images/product2.jpg" alt="">
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
						<img class="img-responsive" src="assets/images/blank.gif" data-echo="assets/images/product3.jpg" alt="">
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
			
			<?require "include/modal.php";?>
		</div><!-- /#wrapper -->

		<?require "include/scripts.php";?>
		
	</body>
</html>