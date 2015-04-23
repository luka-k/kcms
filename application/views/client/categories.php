<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	
	<body>
		<form method="get" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>catalog/" >
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
												
													<?if(!empty($content)):?>
														<?$counter = 1?>
														<?foreach($content as $item):?>
															<div class="product">
																<div class="product-price">
																	<p>Цена розничная: <del><?=$item->price?> р.</del> <span class="discount">-<?=$item->discount?>%</span></p>
																	<p>Цена на сайте: <span class="top-price"><?=$item->sale_price?></span> р.</p>
																	<p>Наличие: <span class="blue-label"><?=$item->location?></span></p>
																	<p><a onclick="add_to_cart('<?=$item->id?>', 1); return false" href="<?=$item->full_url?>"><img src="/template/client/images-new/cartbtn.png" /></a></p>
																</div>
																<div class="product-image">
																<a href="<?=$item->full_url?>"><img src="<?=str_replace('catalog_mid', 'catalog_small', $item->img->url)?>" width="138" /></a>
																</div>
																<div class="product-name">
																<a href="<?=$item->full_url?>"><?=$item->name?></a>
																</div>
																<div class="product-sku">
																<?=$item->article?>
																</div>
															</div>
															<?$counter++?>
														<?endforeach;?>
														<?=$pagination?>
													<?endif;?>
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
				 <? if (!$_GET['filter']): ?>
				 <div id="shadow"></div>
				 <? endif ?>
			
			</form>
	</body>
</html>