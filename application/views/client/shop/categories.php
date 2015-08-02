<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	

	<body>
	
		<? require FCPATH.'application/views/client/include/header.php'?>
		
		<div id="wrapper" >
			<div class="section maxw">
				<div class="mainwrap">
					<main>
						<article>
							<div id="product-scroll" class="<?if(isset($search)):?>search_scroll<?endif;?>" style="height: 700px; overflow-y: scroll;">
								<div class="p_brdcr"><? require FCPATH.'application/views/client/include/breadcrumbs.php' ?></div>
								<div class="sortings">
									Сортировка: 
									<span class="active" onclick="$(this).toggleClass('active');">по наименованию</span>
									<span onclick="$(this).toggleClass('active');">по цене</span>
								</div>
								<div style="clear: both;"></div>
								
								<?if ($childs_categories): 
									$childs_categories = $this->categories->prepare_list($childs_categories);
								?>
									<div class="category" style="margin: 5px 0;">
									<?foreach ($childs_categories as $child): ?>
										<div class="point" style="float: left;line-height: 14px;"><a href="<?= $child->full_url?>"><?= $child->name?></a></div>
									<?endforeach?>
									</div><div style="clear: both;"></div>
								<?endif?>
												
								<?if(!empty($category->products)):?>
									<?foreach($category->products as $item):?>
										<div class="product">
											<div class="product-price">
											<?if (!$item->price && !$item->sale_price):?>
												<p>Цена: <span class="no-price">по запросу</span></p>
											
											<?else:?>
											<?if ($item->price):?>
												<p>Цена розничная: <?=$item->price?> р.<!-- <span class="discount">-<?=$item->discount?>%</span>--></p>
											<? endif?>
												<p>Цена на сайте: <span class="top-price"><?=$item->sale_price?></span> р.</p>
											<?endif?>
												<p>Наличие: <span class="blue-label"><?=$item->qty ? 'на складе СПб' : 'по запросу'?></span></p>
												<p><a href="" onclick="add_to_cart('<?=$item->id?>', 1); return false;"><img src="/template/client/images/cartbtn.png" /></a></p>
											</div>
											<div class="product-image">
												<?if(isset($item->img)):?>
													<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_small_url?>" width="150" /></a>
												<?else:?>
													<a href="<?=$item->full_url?>"><img src="/download/images/catalog_small/n/o/no-photo-available.png" width="150" /></a>
												<?endif;?>
											</div>
											<div class="product-name">
											<!-- <small style="color: blue;">
												<?=$item->name?></small><br> -->
												<a href="<?=$item->full_url?>"><strong>
												<?=$item->manufacturer_name?>

												<?= $item->collection_name ?>
												
												<?=$item->sku?></strong>
	
												<?= $item->sizes_string?></a></br>
												
												
												<?foreach($item->color as $color):?>
													<?=$color->value?><?endforeach;
													if ($item->color && $item->material) echo '/';
													foreach($item->material as $material):?><?=$material->value?>
												<?endforeach;?>
												
												<?foreach($item->finishing as $finishing):?>
													<?=$finishing->value?><?endforeach;?><? if ($item->turn) echo ', ';?>
												<?foreach($item->turn as $turn):?>
													<?=$turn->value?>
												<?endforeach;?>
												</br>

												<strong><?=$item->shortname->value?> </strong>
												
												<?foreach($item->shortdesc as $shortdesc):?>
													<?=$shortdesc->value?>
												<?endforeach;?><br>
												
												<? if ($item->sale):?>
													<strong><span style="color: red;">Распродажа!</span></strong>
												<?endif?>
												
												<? if ($item->description):?>
													(<?= $item->description ?>)
												<?endif?>
												
												<? if ($item->discontinued):?>
													<? $date = explode(' ', $item->discontinued); $date = $date[0];?>
													Снято с производства <?= $date?>
												<?endif?>
												
											</div>
										</div>
									<?endforeach;?>
								<?endif;?>
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
		
		<? if (count($filters_checked) < 4): ?>
			<div id="shadow"></div>
		<? endif ?>
		
	</body>
	
	<?require_once 'include/shop_scripts.php'?>
	<?require_once 'include/scroll_scripts.php'?>
	<?require_once 'include/range_scripts.php'?>
	<?require_once 'include/left_menu_scripts.php'?>
	<?require "include/footer.php"?>
</html>