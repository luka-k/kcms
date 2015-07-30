<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	

	<body>
		<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>catalog/" >
		<input type="hidden" id="ajax_from" name="from" value="0"/>
		<? require FCPATH.'application/views/client/include/header.php'?>
		
		<div id="wrapper" >
			<div class="section maxw">
				<div class="mainwrap">
					<main>
						<article>
							<div id="product-scroll" style="height: 700px; overflow-y: scroll; margin-top:28px;">
								<div style="clear: both;"></div>
								
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
								<div id="slider-scroll" class="slider" >
									<div class="logo-column">
										<div class="some10">
											<?foreach($manufacturer as $m): $m = $this->manufacturers->prepare($m);?>
												<div class="pic-block">
													<a href="<?=base_url()?>catalog/<?=$m->url?>">
														<img src="<?=$m->img->manufacturer_url?>" height="78" width="164" alt="<?=$m->name?>" class="logotype" />
													</a>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
															
								<div id="index_categories">
									<?$counter = 1?>
									<?$line = ceil(count($left_menu)/2)?>
									<ul class="left_col">
										<?foreach($left_menu as $item_1):?>
											<li>
												<a href="<?=base_url()?>catalog/<?=$item_1->url?>" class="level1_link">
													<? if ( $item_1->img): ?>
														<div class="item-icon"><img src="/download/images/<?= $item_1->img->url?>"></div>
													<?endif?>
													<div class="ttl"><?=$item_1->name?></div>
												</a>
												<span class="marker up">+</span>
												<?if(!empty($item_1->childs)):?>
													<ul class="noactive">
														<?foreach($item_1->childs as $item_2):?>
															<li>
																<a href="<?=base_url()?>catalog/<?=$item_1->url?>/<?$item_2->url?>">
																	<?=$item_2->name?>
																</a>
															</li>
														<?endforeach;?>
													</ul>
												<?endif;?>
											</li>
											<?if($counter == $line):?></ul><ul class="right_col"><?$counter = 0?><?endif;?>
											<?$counter++?>
										<?endforeach;?>
									</ul>
								</div>
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
		</form>
	</body>
	
	<script>
	$('.marker').click(function() {
		$(this).next('ul').toggle('slow');
		if ($(this).html() == '+')
			$(this).html('-');
		else
			$(this).html('+');
	});
	</script>
	
	<?require_once 'include/shop_scripts.php'?>
	<?require_once 'include/scroll_scripts.php'?>
	<?require_once 'include/range_scripts.php'?>
	<?require_once 'include/left_menu_scripts.php'?>
	<?require "include/footer.php"?>
</html>