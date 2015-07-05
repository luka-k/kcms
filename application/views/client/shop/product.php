<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	
	<body>
	<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>shop/catalog/" >
		<? require 'include/header.php'?>
		
		<div id="wrapper">
			<div class="section maxw">
				<div class="mainwrap">
					<main>
						<article>
							<div id="product-scroll" style="height: 700px; overflow-y: auto;">
								<div class="p_brdcr"><? require 'include/breadcrumbs.php' ?></div>
								<div style="clear: both;"></div>

								<div class="product-info">
									<div id="gallery">
										<?if(!empty($product->images)):?>
											<div id="box">
												<a href='<?= $product->images[0]->full_url ?>' id='zoom1' class = 'cloud-zoom' title="" rel="">  <img src="<?= $product->images[0]->catalog_big_url ?>" class="picture" /></a>
											</div>
									
											<?if(count($product->images)>1):?>
												<div class="thumbs">
													<div class="thumbs-list">
														<?$counter = 1?>
														<?foreach ($product->images as $img):?>
															<div class="thumb <?if($counter == 3):?>left<?endif;?>">
																<a href='<?= $img->catalog_big_url?>' class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '<?= $img->catalog_big_url?>' ">
																	<img class="zoom-tiny-image" id="thumb_hidden" src="<?= $img->catalog_small_url?>" alt="" />
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
											<div class="item-name"><?=$product->name?></div>
											<div class="item-manufacturername"><?=$product->manufacturer_name?></div><!--Производитель-->
											<div class="item-colllections">
												<?$counter = 1?>
												<?foreach($product->collection_name as $name):?>
													<?=$name?><?if($counter <> count($product->collection_name)):?>,<?endif;?> 
													<?$counter++?>
												<?endforeach;?>
											</div><!--Колекции-->
											<div class="item-color">
												<?$counter = 1?>
												<?foreach($product->color as $color):?>
													<?=$color->value?><?if($counter <> count($product->color)):?>,<?endif;?> 
													<?$counter++?>
												<?endforeach;?>
											</div>
											<div class="item-shortname"><?=$product->shortname->value?></div>
											<div class="item-shortdesc">
												<?$counter = 1?>
												<?foreach($product->shortdesc as $shortdesc):?>
													<?=$shortdesc->value?><?if($counter <> count($product->shortdesc)):?>,<?endif;?> 
													<?$counter++?>
												<?endforeach;?>
											</div>
											<div class="item-finishing">
												<?$counter = 1?>
												<?foreach($product->finishing as $finishing):?>
													<?=$finishing->value?><?if($counter <> count($product->finishing)):?>,<?endif;?> 
													<?$counter++?>
												<?endforeach;?>
											</div>
											<div class="item-turn">
												<?$counter = 1?>
												<?foreach($product->turn as $turn):?>
													<?=$turn->value?><?if($counter <> count($product->turn)):?>,<?endif;?> 
													<?$counter++?>
												<?endforeach;?>
											</div>
										</div>
										<div class="item-buy-info">
											<div class="product-price">
												<p>Цена розничная: <del><?=$product->price?> р.</del> <span class="discount">-<?=$product->discount?>%</span></p>
												<p>Цена на сайте: <span class="top-price"><?=$product->sale_price?></span> р.</p>
												<p>Наличие: <span class="blue-label"><?=$product->location?></span></p>
												<p><a href="" onclick="add_to_cart('<?=$product->id?>', 1); return false;"><img src="/template/client/images-new/cartbtn.png" /></a></p>
											</div>
										</div>
										
										
									</div>
									
								</div>
								<div style="clear: both;"></div>
								
								<div class="accordeon">
									<div class="accordeon-head-1">
										<span class="acc-h"><span class="list">-</span> Стоимость товара с выбранными комплектующими/запчастями</span>
										<a href="#" class="precart_to_cart" onclick="precart_to_cart('<?=$product->id?>'); return false;">Все в корзину</a>
										<span class="pre_cart_price"><?=$product->price?> р.</span>
									</div>
									<div id="pre_cart" class="accordeon-body acc-b">
										
									</div>
									<div class="accordeon-head"><span class="list">-</span> Комплектующие товары</div>
									<div id="comp" class="accordeon-body">
										<?foreach($product->components_products as $components):?>
											<div id="comp-<?=$components->id?>" class="accordeon-item clearfix">
												<div class="check_col"><input type="checkbox" class="ch-comp-<?=$components->id?>" onchange="precart('<?=$components->id?>', 'comp', '<?=$product->price?>'); return false;"/></div>
												<div class="img_col">
													<?if(isset($components->img)):?>
														<a href="<?=$components->full_url?>"><img src="<?=$components->img->catalog_small_url?>" width="138" /></a>
													<?endif;?>
												</div>
												<div class="description_col">
													<div class="item-name"><?=$components->name?></div>
													<div class="item-color">
														<?$counter = 1?>
														<?foreach($components->color as $color):?>
															<?=$color->value?><?if($counter <> count($components->color)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-shortname"><?=$components->shortname->value?></div>
													<div class="item-shortdesc">
														<?$counter = 1?>
														<?foreach($components->shortdesc as $shortdesc):?>
															<?=$shortdesc->value?><?if($counter <> count($components->shortdesc)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-finishing">
														<?$counter = 1?>
														<?foreach($components->finishing as $finishing):?>
															<?=$finishing->value?><?if($counter <> count($components->finishing)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-turn">
														<?$counter = 1?>
														<?foreach($components->turn as $turn):?>
															<?=$turn->value?><?if($counter <> count($components->turn)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
												</div>
												<div class="price_col price-comp-<?=$components->id?>">
														<div>Цена розничная: <del><?=$components->price?> р.</del> <span class="discount">-<?=$components->discount?>%</span></div>
														<div>Цена на сайте: <span class="top-price"><?=$components->sale_price?></span> р.</div>
														<div>Наличие: <span class="blue-label"><?=$components->location?></span></div>
												</div>
											</div>
										<?endforeach;?>
									</div>
									<div class="accordeon-head"><span class="list">-</span> Запасные части</div>
									<div id="acc" class="accordeon-body">
										<?foreach($product->accessories_products as $accessories):?>
											<div id="acc-<?=$accessories->id?>" class="accordeon-item clearfix">
												<div class="check_col"><input type="checkbox" class="ch-acc-<?=$accessories->id?>" onchange="precart('<?=$accessories->id?>', 'acc', '<?=$product->price?>'); return false;"/></div>
												<div class="img_col">
													<?if(isset($accessories->img)):?>
														<a href="<?=$accessories->full_url?>"><img src="<?=$accessories->img->catalog_small_url?>" width="138" /></a>
													<?endif;?>
												</div>
												<div class="description_col">
													<div class="item-name"><?=$accessories->name?></div>
													<div class="item-color">
														<?$counter = 1?>
														<?foreach($accessories->color as $color):?>
															<?=$color->value?><?if($counter <> count($accessories->color)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-shortname"><?=$accessories->shortname->value?></div>
													<div class="item-shortdesc">
														<?$counter = 1?>
														<?foreach($accessories->shortdesc as $shortdesc):?>
															<?=$shortdesc->value?><?if($counter <> count($accessories->shortdesc)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-finishing">
														<?$counter = 1?>
														<?foreach($accessories->finishing as $finishing):?>
															<?=$finishing->value?><?if($counter <> count($accessories->finishing)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-turn">
														<?$counter = 1?>
														<?foreach($accessories->turn as $turn):?>
															<?=$turn->value?><?if($counter <> count($accessories->turn)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
												</div>
												<div class="price_col price-acc-<?=$accessories->id?> clearfix">
													<div>Цена розничная: <del><?=$accessories->price?> р.</del> <span class="discount">-<?=$accessories->discount?>%</span></div>
													<div>Цена на сайте: <span class="top-price"><?=$accessories->sale_price?></span> р.</div>
													<div>Наличие: <span class="blue-label"><?=$accessories->location?></span></div>
												</div>
											</div>
										<?endforeach;?>
									</div>
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
													<div class="item-name"><?=$recommended->name?></div>
													<div class="item-color">
														<?$counter = 1?>
														<?foreach($recommended->color as $color):?>
															<?=$color->value?><?if($counter <> count($recommended->color)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-shortname"><?=$recommended->shortname->value?></div>
													<div class="item-shortdesc">
														<?$counter = 1?>
														<?foreach($recommended->shortdesc as $shortdesc):?>
															<?=$shortdesc->value?><?if($counter <> count($recommended->shortdesc)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-finishing">
														<?$counter = 1?>
														<?foreach($recommended->finishing as $finishing):?>
															<?=$finishing->value?><?if($counter <> count($recommended->finishing)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
													<div class="item-turn">
														<?$counter = 1?>
														<?foreach($recommended->turn as $turn):?>
															<?=$turn->value?><?if($counter <> count($recommended->turn)):?>,<?endif;?> 
															<?$counter++?>
														<?endforeach;?>
													</div>
												</div>
												<div class="price_col">
													<div>Цена розничная: <del><?=$recommended->price?> р.</del> <span class="discount">-<?=$recommended->discount?>%</span></div>
													<div>Цена на сайте: <span class="top-price"><?=$recommended->sale_price?></span> р.</div>
													<div>Наличие: <span class="blue-label"><?=$recommended->location?></span></div>
												</div>
												
											</div>
											
										<?endforeach;?>
									</div>
								</div>
								

							</div>
						</article>
					</main>
				</div>
				
				<? require 'include/left-col.php'?>
				
				<aside id="s_right">
					<h1>Новости</h1>
					<div class="menuright">
						<?foreach($last_news as $item):?>
							<div class="news_item">
								<h2><?=$item->name?></h2>
								<div class="item_text"><?=$item->description?></div>
							</div>
						<?endforeach;?>
					</div>
				</aside>
			</div>
		</div>
		
		<div id="full-shadow">
			<a href="<?if(!empty($last_cache_id)):?><?=base_url()?>catalog/filter/<?=$last_cache_id?><?endif;?>" class="shadow-btn" <?if(empty($last_cache_id)):?>onclick="history.back();"<?endif;?>>Обратно к списку товаров</a>
		</div>
		
	</form>
	</body>

	<?require_once 'include/product_scripts.php'?>
	<?require_once 'include/shop_scripts.php'?>
	<?require_once 'include/scroll_scripts.php'?>
	<?require_once 'include/range_scripts.php'?>
	<?require_once 'include/left_menu_scripts.php'?>
</html>