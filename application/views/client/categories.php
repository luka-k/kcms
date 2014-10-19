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
									<div id="shop-item" class="content-shop-1">
										<div class="good-page" style="height: 500px; width: 100%; overflow-y: scroll;overflow-x:hidden;" id="good_page_scroll">
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
										
										<div id="attr-4" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<div style="margin-bottom:5px;">Корзина:</div>
												<div class="cart">
													<?if($cart):?>
															<?foreach($cart as $item_id => $item):?>
																<div class="<?=$item_id?>  clearfix">
																	<div style="width:10%; float:left;"><?=$item['qty']?></div>
																	<div style="width:85%; float:left;"><?=$item['name']?></div>
																	<div style="width:5%; float:left; text-align:right;"><a href="#" onclick="delete_item('<?=$item_id?>')" class="delete">X</a></div>
																</div>
															<?endforeach;?>
													<?else:?>
														Ваша корзина пуста.
													<?endif;?>
												</div>
											</div>
										</div>
										
										<? require 'include/left-menu.php'?>
										
										<div id="attr-2" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<ul>
													<li class="accd">
														<div class="attr-titl open">Производители</div>
														<ul class="show">
															<?$counter_2 = 1?>
															<?foreach($manufacturer as $firma):?>
																<li>
																	<input type="checkbox" class="manufacturer_checked" name="manufacturer_checked[]" num="<?=$counter_2?>" value="<?=$firma->id?>" id="c_1_1" onclick="filter()" 
																		<?if(!empty($manufacturer_checked)):?>
																			<?foreach($manufacturer_checked as $ch):?>
																				<?if($ch == $firma->id):?>checked<?endif;?>
																			<?endforeach;?>
																		<?endif;?>>
																		<a href="#"><?=$firma->name?></a>
																</li>
																<?$counter_2++?>
															<?endforeach;?>
														</ul>
													</li>
												</ul>
											</div>
										</div>
										
										<div id="attr-3" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<div style="margin-bottom:5px;">Характеристики:</div>
												<div class="filter">	
													<div class="filtr-razmer-1">Размеры(мм):</div>
													<div class="filtr-razmer-2">от:</div>	
													<div class="filtr-razmer-2">до:</div>
													<div class="filtr-razmer-1">ширина:</div>
													<input class="filtr-razmer-3" type="text" name="" />
													<input class="filtr-razmer-3" type="text" name="" />
													<div class="filtr-razmer-1">высота(h):</div>	
													<input class="filtr-razmer-3" type="text" name="" />
													<input class="filtr-razmer-3" type="text" name="" />
													<div class="filtr-razmer-1">глубина:</div>
													<input class="filtr-razmer-3" type="text" name="" />
													<input class="filtr-razmer-3" type="text" name="" />
													<div class="filter-titl">Цвет:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
													<div class="filter-titl">Материал:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
													<div class="filter-titl">Отделка:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
													<div class="filter-titl">Разворот:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
												</div>
											</div>
										</div>

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