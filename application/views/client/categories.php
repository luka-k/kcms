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
							<div class="middle2">
								<div class="container2">
									<div id="shop-item" class="content-shop-1">
										<div class="good-page" style="height: 500px; width: 100%; overflow-y: scroll;overflow-x:hidden;" id="good_page_scroll">
											<div class="gp-content">
												<?if(!empty($content)):?>
													<?foreach($content as $item):?>
														<div class="item-content clearfix">
															<div id="gal-1" class="item-gallery">
																<div id="box-1" class="box">
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
																<div class="item-buy">Купить</div><a href="<?=$item->full_url?>" class="item-more">Подробнее</a>
															</div>
														</div>
													<?endforeach;?>
												<?endif;?>
											</div>
										</div>
									</div><!-- .content-->
								</div><!-- .container-->
								
								<div class="left-sidebar-attr clearfix" >
									<div class="logo-column scroll-content1" style="height: 400px; oveflow: auto;">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form-1" action="<?=base_url()?>shop/" >
										
										<div id="attr-1" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<ul>
													<?$counter = 1?>
													<?foreach($left_menu as $item_1):?>
														<li class="accd">
															<div class="attr-titl open"><?=$item_1->name?></div>
															<? if(!empty($item_1->childs)):?>
																<ul class="show">
																	<?foreach ($item_1->childs as $item_2):?>
																		<li>
																			<input type="checkbox" name="cetegories_checked[<?=$counter?>]" value="<?=$item_2->id?>" id="c_1_1" onclick="document.forms['form-1'].submit()" 
																				<?if(!empty($categories_checked)):?>
																					<?foreach($categories_checked as $key => $ch):?>
																						<?if($key == $counter):?>checked<?endif;?>
																					<?endforeach;?>
																				<?endif;?>>
																				<a href="<?=base_url()?>shop/<?=$item_1->url?>/<?=$item_2->url?>"><?=$item_2->name?></a>
																		</li>
																		<?$counter++?>
																	<?endforeach;?>
																</ul>
															<? endif;?>
														</li>
											
													<?endforeach;?>
												</ul>
											</div>
										</div>
										
										<div id="attr-2" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<ul>
													<li class="accd">
														<div class="attr-titl open">Производители</div>
														<ul class="show">
															<?foreach($manufacturer as $firma):?>
																<li>
																	<input type="checkbox" name="manufacturer_checked[]" value="<?=$firma->id?>" id="c_1_1" onclick="document.forms['formpopup-2'].submit()" 
																		<?if(!empty($manufacturer_checked)):?>
																			<?foreach($manufacturer_checked as $ch):?>
																				<?if($ch == $firma->id):?>checked<?endif;?>
																			<?endforeach;?>
																		<?endif;?>>
																		<a href="#"><?=$firma->name?></a>
																</li>
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
						<div class="scroll-contentd" id="leftscroll" style="height: 410px;">
							<div id="filter" class="clearfix scroll-content"  style="height: 400px;overflow-y: hidden;">
								<div class="clearfix">
									<div class="filter-titl">Группа товаров:</div><div class="help">i</div>
									
									<div id="filt-1" class="filtr-noact" onclick="return false">Смесители для ванной</div>
								</div>
								
								<div class="clearfix" style="margin-top:40px">
									<div class="filter-titl">Производитель:</div><div class="help">i</div>
									
									<div id="filt-2" class="filtr-noact" onclick="return false">Kludi</div>
									
									<div class="filter-titl">Колекция/Серия:</div><div class="help">i</div>
									<div id="filt-2" class="filtr-noact" onclick="return false">balance</div>
									<input class="input" type="text" name="" />
									<div class="filter-titl">Артикул/Модель:</div><div class="help">i</div>
									<input class="input" type="text" name="" />
								</div>
								<div class="clearfix" style="margin-top:40px">
									<div class="filter-titl">Название товара:</div><div class="help">i</div>
									<div id="filt-2" class="filtr-noact" onclick="return false">Kludi Balance 2532255<div class="count">2</div></div>
									<div class="filter-titl">Описание товара:</div><div class="help">i</div>
									<div id="filt-2" class="filtr-noact" onclick="return false">Сместиель для раковины</div>
								</div>
								<div class="clearfix" style="margin-top:40px">
									<div class="help">i</div>
									<div id="filt-3" class="filtr-noact" onclick="return false">Характеристики:</div>
								</div>
							</div>
						</div><!-- .left-sidebar -->
					</div>
				</div><!-- .middle-->
			</div><!--/main-->
			
			<div class="footer"></div><!--/footer-->
			
		</div><!--/wrap-->
		
		<? require 'include/footer_script.php'?>
	</body>
</html>