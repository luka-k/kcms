<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	
	<body>
		<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>catalog/" >
		<? require 'include/header.php'?>
		
		<div id="wrapper">
			<div class="section maxw">
				<div class="mainwrap">
					<main>
						<article>
							<div style="height: 700px; overflow-y: scroll;">
								<? require 'include/breadcrumbs.php' ?>
									<div class="sortings">
														Сортировка: 
														<span class="active" onclick="$(this).toggleClass('active');">по наименованию</span>
														<span onclick="$(this).toggleClass('active');">по цене</span>
													</div>
													<div style="clear: both;"></div>
												
													<?if(!empty($category->products)):?>
														<?$counter = 1?>
														<?foreach($category->products as $item):?>
															<div class="product">
																<div class="product-price">
																	<p>Цена розничная: <del><?=$item->price?> р.</del> <span class="discount">-<?=$item->discount?>%</span></p>
																	<p>Цена на сайте: <span class="top-price"><?=$item->sale_price?></span> р.</p>
																	<p>Наличие: <span class="blue-label"><?=$item->location?></span></p>
																	<p><a href="" onclick="add_to_cart('<?=$item->id?>', 1); return false;"><img src="/template/client/images-new/cartbtn.png" /></a></p>
																</div>
																<div class="product-image">
																<?if(isset($item->img)):?><!---Костыль ввиду отсутствия картинок--->
																<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_small_url?>" width="138" /></a>
																<?endif;?>
																</div>
																<div class="product-name">
																<a href="<?=$item->full_url?>"><?=$item->name?></a>
																</div>
																<div class="product-sku">
																<?=$item->sku?>
																</div>
															</div>
															<?$counter++?>
														<?endforeach;?>
														
													<?endif;?>
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
				 <? if (empty($filters_checked)): ?>
				 <div id="shadow"></div>
				 <? endif ?>
			
			</form>
	</body>
	
</html>