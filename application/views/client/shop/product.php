<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? $no_ajax = true; require 'include/head.php' ?>	
	<body>
	<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>shop/catalog/" >
		<? require FCPATH.'application/views/client/include/header.php'?>
		
		<div id="wrapper" class="shop_wrapper">
			<div class="section maxw">
				<div class="mainwrap">
					<main>
						<article>
							<div id="product-scroll" style="height: 700px; overflow-y: auto;">
								<div class="p_brdcr"><? require FCPATH.'application/views/client/include/breadcrumbs.php' ?></div>
								<div style="clear: both;"></div>

								<div class="product-info">
									<div id="gallery">
										<?if(!empty($product->images)):?>
											<div id="box">
												<a href='<?= $product->images[0]->catalog_big_url ?>' id='zoom1' class = 'cloud-zoom' title="" rel="">  <img src="<?= $product->images[0]->catalog_big_url ?>" class="picture" /></a>
												<a href='<?= $product->images[0]->catalog_big_url ?>' id="fancy_opener" style="display: none;" class = 'fancybox' rel='gallery' title="" rel="">  <img src="<?= $product->images[0]->catalog_big_url ?>" class="picture" /></a>
											</div>
									
											<?if(count($product->images)>1):?>
												<div class="thumbs">
													<div class="thumbs-list">
														<?$counter = 1?>
														<?foreach ($product->images as $img):?>
															<div class="thumb <?if($counter == 3):?>left<?endif;?>">
																<a href='<?= $img->catalog_big_url?>' class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '<?= $img->catalog_big_url?>'">
																	<img class="zoom-tiny-image" id="thumb_hidden" src="<?= $img->catalog_small_url?>" alt="" />
																</a>
																<a href='<?= $img->catalog_big_url?>' class="fancybox" <?if($counter > 1):?>rel="gallery"<?endif?> style="display: none;">
																	<img  src="<?= $img->catalog_small_url?>" alt="" />
																</a>
															</div>
														<?$counter++?>
														<?endforeach;?>
													</div>
												</div>
											<?endif;?>
										<?endif;?>
									</div>
									
									<div class="product_content">
										<div class="item-description">
		
											<strong>
												<?=$product->manufacturer_name?>
												
												<?=$product->collection_name ?>
												
												<?if(isset($product->sub_collections)):?>
													<?=$product->sub_collections?>
												<?endif;?>
			
												<?if(!empty($product->serie_name)):?>
													(<?=$product->serie_name?><?if(!isset($product->sub_series)):?>)<?else:?>; <?endif;?>
												<?endif;?>
												<?if(isset($product->sub_series)):?>
													; <?=$product->sub_series?>)
												<?endif;?>
												
												<?=$product->sku?>
											</strong>
	
											<?= $product->sizes_string?>
											</br>
												
												
												<?foreach($product->color as $color):?>
													<?=$color->value?><?endforeach;
													if ($product->color && $product->material) echo '/';
													foreach($product->material as $material):?><?=$material->value?>
												<?endforeach;?><? if (($product->color || $product->material) && !$product->finishing && $product->turn) echo ', ';?>
												
												<?foreach($product->finishing as $finishing):?>
													<?=$finishing->value?><?endforeach;?><? if ($product->finishing && $product->turn) echo ', ';?>
												<?foreach($product->turn as $turn):?>
													<?=$turn->value?>
												<?endforeach;?>
												<br />

												<strong><?=$product->shortname->value?> </strong>
												
												<?foreach($product->shortdesc as $shortdesc):?>
													<?=$shortdesc->value?>
												<?endforeach;?>
											
												<? if ($product->discontinued):?>
													<? $date = explode(' ', $product->discontinued); $date = $date[0];?>
													<span style="display:inline-block">(Снято с производства <?= $date?>)</span>
												<?endif?>
												
												<div class="sale_desc">
													<? if ($product->sale):?>
														<strong><span style="color: red;">Распродажа!</span></strong>
													<?endif?>
													
													<? if ($product->description):?>
														(<?= $product->description ?>)
													<?endif?>	
												</div>
										</div>
										<div class="item-buy-info">
											<div class="product-price">
											<?if (!$product->price && !$product->sale_price):?>
												<p>Цена: <span class="no-price">по запросу</span></p>
											
											<?else:?>
											<?if ($product->price):?>
												<p>Цена розничная: <span class="cross-price"><?=$product->price?> р.</span> <span class="discount">-<?=$product->discount?>%</span></p>
											<? endif?>
												<p>Цена на сайте: <span class="top-price"><?=$product->sale_price?></span> р.</p>
											<?endif?>
												<p>Наличие: <span class="blue-label"><?=$product->qty ? 'на складе СПб' : 'по запросу'?></span></p>
												<p><a href="" onclick="add_to_cart('<?=$product->id?>', 1); return false;"><img src="/template/client/images/cartbtn.png" /></a></p>
											</div>
										</div>
										
										
									</div>
									
								</div>
								<div style="clear: both;"></div>
								
								<div class="accordeon">
									<div class="accordeon-head-1">
										<span class="acc-h"><span class="list">-</span> Стоимость товара с выбранными комплектующими/запчастями</span>
										<a href="#" class="precart_to_cart" onclick="precart_to_cart('<?=$product->id?>'); return false;">Все в корзину</a>
										<span class="pre_cart_price"><?=$product->sale_price?> р.</span>
									</div>
									<div id="pre_cart" class="accordeon-body acc-b">
										
									</div>
									
									<? if ($product->components_products): ?>
									<div class="accordeon-head"><span class="list">-</span> Комплектующие товары</div>
									<div id="comp" class="accordeon-body">
										<?$counter = 1?>
										<?foreach($product->components_products as $components):?>
											<div id="comp-<?=$components->id?>" class="accordeon-item comp-<?=$counter?> clearfix">
												<div class="check_col"><input type="checkbox" class="ch-comp-<?=$components->id?>" onchange="precart('<?=$components->id?>', 'comp', '<?=$product->sale_price?>', '<?=$counter?>'); return false;"/></div>
												<div class="img_col">
													<?if(isset($components->img)):?>
														<a href="<?=$components->full_url?>"><img src="<?=$components->img->catalog_small_url?>" width="138" /></a>
													<?endif;?>
												</div>
												<div class="description_col">
												<div class="item-name"><strong>
												<?=$components->manufacturer_name?>

												<?= $components->collection_name ?>
												
												<?=$components->sku?></strong></div>
													<div class="item-color">
														
												<?= $components->sizes_string?>
												
												
												<?foreach($components->color as $color):?>
													<?=$color->value?><?endforeach;
													if ($components->color && $components->material) echo '/';
													foreach($components->material as $material):?><?=$material->value?>
												<?endforeach;?>
												
												<?foreach($components->finishing as $finishing):?>
													<?=$finishing->value?><?endforeach;?><? if ($components->turn) echo ', ';?>
												<?foreach($components->turn as $turn):?>
													<?=$turn->value?>
												<?endforeach;?>
													</div>
													
													<div class="item-shortname"><strong><?=$components->shortname->value?> </strong>
												
												<?foreach($components->shortdesc as $shortdesc):?>
													<?=$shortdesc->value?>
												<?endforeach;?></div>
												
													<div class="item-shortdesc">
														
												<? if ($components->sale):?>
												<strong><span style="color: red;">Распродажа!</span></strong>
												<?endif?>
													</div>
												</div>
												<div class="price_col price-comp-<?=$components->id?>">
													<?if (!$components->price && !$components->sale_price):?>
														<div>Цена: <span class="no-price">по запросу</span></div>
													
													<?else:?>
													<?if ($components->price):?>
														<div>Цена розничная: <span class="cross-price"><?=$components->price?> р.</span> <span class="discount">-<?=$components->discount?>%</span></div>
													<? endif?>
														<div>Цена на сайте: <span class="top-price"><?=$components->sale_price?></span> р.</div>
													<?endif?>
														<div>Наличие: <span class="blue-label"><?=$components->qty ? 'на складе СПб' : 'по запросу'?></span></div>
														<div><a href="" onclick="add_to_cart('<?=$components->id?>', 1); return false;"><img src="/template/client/images/cartbtn.png" /></a></div>
												</div>
											</div>
											<?$counter++?>
										<?endforeach;?>
									</div>
									<?endif?>
									<?if ($product->accessories_products): ?>
									<div class="accordeon-head"><span class="list">-</span> Запасные части</div>
									<div id="acc" class="accordeon-body">
										<?$counter = 1?>
										<?foreach($product->accessories_products as $accessories):?>
											<div id="acc-<?=$accessories->id?>" class="accordeon-item acc-<?=$counter?> clearfix">
												<div class="check_col"><input type="checkbox" class="ch-acc-<?=$accessories->id?>" onchange="precart('<?=$accessories->id?>', 'acc', '<?=$product->sale_price?>', '<?=$counter?>'); return false;"/></div>
												<div class="img_col">
													<?if(isset($accessories->img)):?>
														<a href="<?=$accessories->full_url?>"><img src="<?=$accessories->img->catalog_small_url?>" width="138" /></a>
													<?endif;?>
												</div>
												<div class="description_col">
												<div class="item-name"><strong>
												<?=$accessories->manufacturer_name?>

												<?= $accessories->collection_name ?>
												
												<?=$accessories->sku?></strong></div>
													<div class="item-color">
														
												<?= $accessories->sizes_string?>
												
												
												<?foreach($accessories->color as $color):?>
													<?=$color->value?><?endforeach;
													if ($accessories->color && $accessories->material) echo '/';
													foreach($accessories->material as $material):?><?=$material->value?>
												<?endforeach;?>
												
												<?foreach($accessories->finishing as $finishing):?>
													<?=$finishing->value?><?endforeach;?><? if ($accessories->turn) echo ', ';?>
												<?foreach($accessories->turn as $turn):?>
													<?=$turn->value?>
												<?endforeach;?>
													</div>
													
													<div class="item-shortname"><strong><?=$accessories->shortname->value?> </strong>
												
												<?foreach($accessories->shortdesc as $shortdesc):?>
													<?=$shortdesc->value?>
												<?endforeach;?></div>
													<div class="item-shortdesc">
														
												<? if ($accessories->sale):?>
												<strong><span style="color: red;">Распродажа!</span></strong>
												<?endif?>
													</div>
												</div>
												<div class="price_col price-acc-<?=$accessories->id?> clearfix">
													<?if (!$accessories->price && !$accessories->sale_price):?>
														<div>Цена: <span class="no-price">по запросу</span></div>
													
													<?else:?>
													<?if ($accessories->price):?>
														<div>Цена розничная: <span class="cross-price"><?=$accessories->price?> р.</span> <span class="discount">-<?=$accessories->discount?>%</span></div>
													<? endif?>
														<div>Цена на сайте: <span class="top-price"><?=$accessories->sale_price?></span> р.</div>
													<?endif?>
														<div>Наличие: <span class="blue-label"><?=$accessories->qty ? 'на складе СПб' : 'по запросу'?></span></div>
														<div><a href="" onclick="add_to_cart('<?=$accessories->id?>', 1); return false;"><img src="/template/client/images/cartbtn.png" /></a></div>
												</div>
											</div>
											<?$counter++?>
										<?endforeach;?>
									</div>
									<?endif?>
									<?if ($product->recommended_products): ?>
									<div class="accordeon-head"><span class="list">-</span> Аналогичный товар</div>
									<div class="accordeon-body">
										<?foreach($product->recommended_products as $recommended):?>
											<div class="accordeon-item clearfix">
												<div class="check_col">&nbsp;</div>
												<div class="img_col">
													<?if(isset($recommended->img)):?>
														<a href="<?=$recommended->full_url?>"><img src="<?=$recommended->img->catalog_small_url?>" width="138" /></a>
													<?endif;?>
												</div>
												<div class="description_col">
												<div class="item-name"><strong>
												<?=$recommended->manufacturer_name?>

												<?= $recommended->collection_name ?>
												
												<?=$recommended->sku?></strong></div>
													<div class="item-color">
														
												<?= $recommended->sizes_string?>
												
												
												<?foreach($recommended->color as $color):?>
													<?=$color->value?><?endforeach;
													if ($recommended->color && $recommended->material) echo '/';
													foreach($recommended->material as $material):?><?=$material->value?>
												<?endforeach;?>
												
												<?foreach($recommended->finishing as $finishing):?>
													<?=$finishing->value?><?endforeach;?><? if ($recommended->turn) echo ', ';?>
												<?foreach($recommended->turn as $turn):?>
													<?=$turn->value?>
												<?endforeach;?>
													</div>
													
													<div class="item-shortname"><strong><?=$recommended->shortname->value?> </strong>
												
												<?foreach($recommended->shortdesc as $shortdesc):?>
													<?=$shortdesc->value?>
												<?endforeach;?></div>
													<div class="item-shortdesc">
														
												<? if ($recommended->sale):?>
												<strong><span style="color: red;">Распродажа!</span></strong>
												<?endif?>
													</div>
												</div>
												<div class="price_col">
													<?if (!$recommended->price && !$recommended->sale_price):?>
														<div>Цена: <span class="no-price">по запросу</span></div>
													
													<?else:?>
													<?if ($recommended->price):?>
														<div>Цена розничная: <span class="cross-price"><?=$recommended->price?> р.</span> <span class="discount">-<?=$recommended->discount?>%</span></div>
													<? endif?>
														<div>Цена на сайте: <span class="top-price"><?=$recommended->sale_price?></span> р.</div>
													<?endif?>
														<div>Наличие: <span class="blue-label"><?=$recommended->qty ? 'на складе СПб' : 'по запросу'?></span></div>
														<div><a href="" onclick="add_to_cart('<?=$recommended->id?>', 1); return false;"><img src="/template/client/images/cartbtn.png" /></a></div>
												</div>
												
											</div>
											
										<?endforeach;?>
									</div>
									<?endif?>
								</div>
								

							</div>
						</article>
					</main>
				</div>
				
				<? require 'include/left-col.php'?>
				
				<aside id="s_right">
					<?require FCPATH.'application/views/client/include/news_collumn.php'?>
				</aside>
			</div>
		</div>
		
		<div id="full-shadow">
			<a href="<?=base_url()?><?if(!empty($back_link)):?><?=$back_link?><?elseif(!empty($last_cache_id)):?>catalog/filter/<?=$last_cache_id?><?endif;?>" class="shadow-btn">Обратно к списку товаров</a>
		</div>
		
	</form>
	</body>

	<?require_once 'include/product_scripts.php'?>
	<?require_once 'include/shop_scripts.php'?>
	<?require_once 'include/scroll_scripts.php'?>
	<?require_once 'include/range_scripts.php'?>
	<?require_once 'include/left_menu_scripts.php'?>
		<?require "include/footer.php"?>
		<script>$('.fancybox').fancybox();</script>
</html>