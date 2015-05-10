﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	
	<body>
		
		<? require 'include/header.php'?>
		
		<div id="wrapper">
			<div class="section maxw">
				<div class="mainwrap">
					<main>
						<article>
							<div style="height: 700px; overflow-y: auto;">
								<div class="p_brdcr"><? require 'include/breadcrumbs.php' ?></div>
								<div style="clear: both;"></div>

								<div class="product-info">
									<div id="gallery">
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
									</div>
									
									<div class="product_content">
										<div class="item-description">
											<div class="item-name"><?=$product->name?></div>
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
									<div style="clear: both;"></div>
								</div>
								<div style="clear: both;"></div>
							</div>
						</article>
					</main>
				</div>
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>catalog/" >
					<? require 'include/left-col.php'?>
				</form>
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
	</body>
	
</html>