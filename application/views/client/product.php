<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>
	<? require 'include/product_script.php'?>
	<body>
		<form method="get" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>catalog/" >
		<? require 'include/header.php'?>
			
			
                <div id="wrapper">
                        <div class="section maxw">

                                        <div class="mainwrap">
                                            <main>
                                                <article>
													<? require 'include/breadcrumbs.php' ?>
													<div style="clear: both;"></div>
													
													
							<div class="middle2">
								<div class="container2">
									<div id="shop-item" class="<?if($left_active):?>content-shop<?else:?>content-shop-1<?endif;?>">
										<div class="good-page" style="width: 100%; " id="good_page_scroll">
											<div class="gp-content">
												<?if(!empty($content)):?>
													<div class="item-content clearfix">
														<div id="gal-1" class="item-gallery">
																<div id="box-1" class="box">
																
																	<?if(!empty($content->img)):?>
																		<img src="<?=base_url()?>download/images/catalog_mid/<?=$content->img[0]->url?>" class="picture"/>
																	<?endif;?>
																</div>	
																<div id="bg-1" class="bg" class="clearfix">
																	<div style="display: table; margin:0 auto">
																		<?foreach($content->img as $image):?>
																			<!--<img src="<?=base_url()?>download/images/catalog_mid/<?=$image->url?>" />-->
																		<?endforeach?>
																	</div>
																</div>
																
															</div>
															<div class="item clearfix">
																<div class="item-name"><?=$content->name?></div>
																<div class="item-d"><?=$content->description?></div>
																<div class="item-color"><?=$content->color?></div>
																<div class="left-col">Цена розничная:</div><div class="item-price"><?=$content->price?> евро.</div>
																<?if(!empty($content->discount)):?>
																	<div class="left-col">Цена покупки:</div><div class="item-total "><?=$content->sale_price?> евро. <span class="item-sale-1">Скидка: <span class="item-sale-2"><?=$content->discount?>%</span></span></div>
																<?endif;?>	
																<div>
																	<?= $content->width ? 'Ширина: '.$content->width.'<br>' : ''?>
																	<?= $content->height ? 'Высота: '.$content->height.'<br>' : ''?>
																	<?= $content->depth ? 'Глубина: '.$content->height.'<br>' : ''?>
																	<?= $content->material ? 'Материал: '.$content->material.'<br>' : ''?>
																	<?= $content->finishing ? 'Отделка: '.$content->finishing.'<br>' : ''?>
																	<?= $content->turn ? 'Разворот: '.$content->turn.'<br>' : ''?>
																</div>
																<div class="item-place left-col">Наличие:</div><div class="right-col"><?=$content->location?></div>
																<div class="item-buy" onclick="add_to_cart('<?=$content->id?>', 1); return false">Купить</div>
															</div>
														</div>
												<?endif;?>
											</div>
										</div>
									</div><!-- .content-->
								</div><!-- .container-->
								
							</div>
							
							
                                                </article>
                                            </main>
                                        </div>       
										
						<? require 'include/left-col.php'?>
                                                        
                                <aside id="s_right">
                                    <h1>Новости</h1>
									<div class="menuright">
                                    <h2>Экспорт новостей</h2>
									<p>Вы можете поставить на свой сайт 
заголовки и аннотации сюжетов Яндекс.
Новостей, а также просматривать их с 
помощью любых программ и сервисов, 
совместимых с форматом RSS. Для 
удобства владельцев сайтов и домашних 
страничек созданы новостные информеры, 
установка которых не требует 
специальных знаний.
</p>
<h2>Экспорт в формате RSS</h2>
<p>RSS  — международный формат, 
специально созданный для трансляции 
данных с одного сайта на другой.
Используя приведенные ниже экспортные 
файлы в формате RSS, вы можете 
разместить на своей странице заголовки 
и аннотации сюжетов Яндекс.Новостей. 
Кроме того, посредством RSS можно 
читать новости специальными 
программами — агрегаторами новостей — 
и таким образом оперативно узнавать об 
обновлениях нужных сайтов. Подробнее 
об RSS в каталоге Яндекса (общие 
сведения, спецификация, ссылки на 
ресурсы по теме)
</p>
</div>
                                </aside>
                          </div>
                 </div>
				 <? if (!$_GET): ?>
				 <div id="shadow"></div>
				 <? endif ?>
			
			</form>
	</body>
</html>