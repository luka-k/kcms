<? foreach($products as $p):?>
	<div class="col-md-3 col-sm-6">
		<div class="book">
			<a href="<?= $p->full_url?>">
				<div class="<?if($item->has_cover):?>book-cover<?endif;?>">
					<img width="140" height="212" alt="" src="<?= $p->img->catalog_small_url?>" data-echo="<?= $p->img->catalog_mid_url?>"> <!--assets/images/book-covers/01.jpg-->
						<?if(false):?>
							<div class="tag"><span>sale</span></div>
						<?endif;?>
																</div>
															</a>
															<div class="book-details clearfix">
																<div class="book-description">
																	<h3 class="book-title"><a href="single-book.html"><?=  $p->name?></a></h3>
																	<p class="book-subtitle">автор <a href="single-book.html"> <?=  $p->autor?></a></p>
																</div>
																<div class="text-center">
																	<div class="actions">
																		<span class="book-price price"><?= $p->price?> р.</span>               
																		<div class="cart-action"> 
																			<a class="add-to-cart" title="Add to Cart" href="#" onclick="addToCart('<?= $p->id?>', 1); return false;">В корзину</a>       
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<? endforeach;?>