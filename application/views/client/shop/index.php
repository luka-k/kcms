<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	

	<body>
		<input type="hidden" id="ajax_from" name="from" value="0"/>
		<? require FCPATH.'application/views/client/include/header.php'?>
		
		<div id="wrapper" >
			<div class="section maxw">
				<div class="mainwrap">
					<main>
						<article>
							<div id="manufacturers_column">
								<div class="for-select">
									<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>" >
									<select name="" class="dropdown" onchange="document.location='/catalog/'+this.options[this.selectedIndex].value;">
										<option value="1" disabled="" selected="selected">выбор производителя</option>
										<?foreach($manufacturer as $m):?>
											<option value="<?=$m->url?>"><?=$m->name?></option>
										<?endforeach;?>
									</select>
									</form>
								</div>
								<div id="slider-scroll" class="slider index_page">
									<div class="logo-column">
										<div class="some10">
											<?foreach($manufacturer as $m): $m = $this->manufacturers->prepare($m);?>
												<div class="pic-block" style="margin-bottom: 8px;">
													<a href="<?=base_url()?>catalog/<?=$m->url?>">
														<?=$m->name?>
													</a>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
							</div>
							<div id="product-scroll" style="height: 700px; overflow-y: scroll; margin-top:28px;">
								<div style="clear: both;"></div>
								
								<div id="index_categories" class="clearfix">
									<?foreach($left_menu as $item_1):?>	
										<div class="index_categories_item">
											<a href="<?=base_url()?>catalog/<?=$item_1->url?>" class="level1_link">
												<? if ( $item_1->img): ?>
													<div class="item-icon"><img src="/download/images/<?= $item_1->img->url?>"></div>
												<?endif?>
												<div class="ttl"><?=$item_1->name?></div>
											</a>
											<span class="marker up">&nbsp;</span>
											<?if(!empty($item_1->childs)):?>
											<ul class="noactive">
												<?foreach($item_1->childs as $item_2):?>
													<li>
														<a href="<?=base_url()?>catalog/<?=$item_1->url?>/<?=$item_2->url?>">
															<?=$item_2->name?>
														</a>
													</li>
												<?endforeach;?>
											</ul>
										<?endif;?>
										</div>
									<?endforeach;?>
								</div>
								
								<?if(!empty($category->products)):?>
								<div id="products_div">
									<?foreach($category->products as $item):?>
										<div class="product">
											<div class="product-price">
											<?if (!$item->price && !$item->sale_price):?>
												<p>Цена: <span class="no-price">по запросу</span></p>
											
											<?else:?>
											<?if ($item->price):?>
												<p>Цена розничная: <span class="cross-price"><?=$item->price?> р.</span> <span class="discount">-<?=$item->discount?>%</span></p>
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
												
												<? if ($item->discontinued):?>
													<? $date = explode(' ', $item->discontinued); $date = $date[0];?>
													(Снято с производства <?= $date?>)
												<?endif?>
												
												<div class="sale_desc">
													<? if ($item->sale):?>
														<strong><span style="color: red;">111Распродажа!</span></strong>
													<?endif?>
												
													<? if ($item->description):?>
														(<?= $item->description ?>)
													<?endif?>
												</div>
											</div>
										</div>
									<?endforeach;?>
								</div>
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
	
	<script>
		$('.marker').click(function() {
			var $_this = $(this).parent().html();
			$('.marker.down').each(function() {
				if ($(this).parent().html() != $_this)
				{
					$(this).next('ul').hide();
					$(this).removeClass('down');
					$(this).addClass('up');
				}
			});
			$(this).next('ul').toggle('slow');
			if ($(this).hasClass("up")){
				$(this).removeClass('up');
				$(this).addClass('down');
			}else{
				$(this).removeClass('down');
				$(this).addClass('up');
			}
		});
	</script>
	
	<?require_once 'include/shop_scripts.php'?>
	<?require_once 'include/scroll_scripts.php'?>
	<?require_once 'include/range_scripts.php'?>
	<?require_once 'include/left_menu_scripts.php'?>
	<?require "include/footer.php"?>
</html>