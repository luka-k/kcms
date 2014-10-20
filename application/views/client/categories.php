<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	
	<body>
		<div class="wrap">
			<? require 'include/header.php'?>
			
			<div class="main">
				<div class="middle">
					<div class="container">
						<div class="content">
							<? require 'include/breadcrumbs.php' ?>
							<div class="middle2">
								<div class="container2">
									<div id="shop-item" class="<?if($left_active):?>content-shop<?else:?>content-shop-1<?endif;?>">
										<div class="good-page" style="height: 100px; width: 100%; overflow-y: scroll;overflow-x:hidden;" id="good_page_scroll">
											<?=$pagination?>
											<div class="gp-content">
												<?if(!empty($content)):?>
													<?$counter = 1?>
													<?foreach($content as $item):?>
														<div class="item-content clearfix">
															<div id="gal-<?=$counter?>" class="item-gallery">
																<div id="box-<?=$counter?>" class="box">
																	<?if(!empty($item->img->url)):?>
																		<img src="<?=$item->img->url?>" class="picture"/>
																	<?endif;?>
																</div>
															</div>
															<div class="item clearfix">
																<div class="item-name"><?=$item->name?></div>
																<div class="item-d"><?=$item->name?></div>
																<div class="item-color"><?=$item->color?></div>
																<div class="left-col">Цена розничная:</div><div class="item-price"><?=$item->price?> руб.</div>
																<?if(!empty($item->discount)):?>
																	<div class="left-col">Цена покупки:</div><div class="item-total "><?=$item->sale_price?> р. <span class="item-sale-1">Скидка: <span class="item-sale-2"><?=$item->discount?>%</span></span></div>
																<?endif;?>	
																<div class="item-place left-col">Наличие:</div><div class="right-col"><?=$item->location?></div>
																<div class="item-buy" onclick="add_to_cart('<?=$item->id?>', 1); return false">Купить</div><a href="<?=$item->full_url?>" class="item-more">Подробнее</a>
															</div>
														</div>
														<?$counter++?>
													<?endforeach;?>
												<?endif;?>
											</div>
										</div>
									</div><!-- .content-->
								</div><!-- .container-->
								
								<div class="left-sidebar-attr clearfix" >
									<div class="logo-column scroll-content1" style="height: 400px; oveflow: auto;">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="" >
										
											<? require 'include/cart.php'?>
										
											<? require 'include/left-menu.php'?>
										
											<? require 'include/manufacturer.php'?>
										
											<? require 'include/filter.php'?>

										</form>
									</div>
								</div>
							</div>
						</div><!-- .content-->
					</div><!-- .container-->
					<div class="left-sidebar-filtr clearfix">
						<? require 'include/left-col.php'?>
					</div>
				</div><!-- .middle-->
			</div><!--/main-->
			
			<div class="footer"></div><!--/footer-->
			
		</div><!--/wrap-->
		
		<? require 'include/footer_script.php'?>
	</body>
</html>