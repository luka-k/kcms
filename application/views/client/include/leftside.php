<aside class="left_side">
				<div class="shop-catalog-nav-button">
					<a href="<?base_url()?>catalog" class="catalog-button">Каталог</a>
				</div> 
				
				<?require_once 'left-menu.php'?>
				
				<div class="shop-catlog-filters">
					<div class="catlog-filters-title">Поиск по параметрам</div>
					
					<form action="<?=base_url()?>catalog" id="filter_form" method="get">
						<input type="hidden" name="filter" value="true"/>
						<?foreach($filters as $type => $filter):?>
							<?if($filter->values):?>
								<div class="catalog-filter-item">
									<div class="filter-name"><?=$filter->name?></div>
									<?$counter = 1?>
									<?foreach($filter->values as $v):?>
										<div class="filter-ch">
											<input type="checkbox" 
												id="<?=$type?>-<?=$counter?>" 
												name="<?=$type?>[]" 
												value="<?=$v?>"
												onchange="$('#filter_form').submit()"
												<?if(isset($filters_values[$type]) && in_array($v, $filters_values[$type])):?>checked<?endif;?> />
											<label for="<?=$type?>-<?=$counter?>"><?=$v?></label>
										</div>
										<?$counter++?>
									<?endforeach;?>
								</div>
							<?endif;?>
						<?endforeach;?>
					
						<div class="catalog-filter-item">
							<div class="filter-name">Цена</div>
							<input type="text" class="filter-range" name="" value="<?=$min_price?>" onchange='$("#filter_form").submit()'/> - <input type="text" class="filter-range" name="" value="<?=$max_price?>" onchange='$("#filter_form").submit()'/> руб.
						</div>
					</form>
				</div>
				
				<div class="shop-catalog-news">
					<div class="title">Новости</div>
					<?foreach($last_news as $ln):?>
						<div class="news-item">
							<div class="date"><?=$ln->date?></div>
							<a href="#">
								<div class="text"><?=$ln->short_description?></div>
							</a>
						</div>
					<?endforeach;?>
					<div class="news-link"><a href="">все новости &rarr;</a></div>
				</div>
				<div class="shop-catalog-events">
					<div class="title">События</div>
					<div id="this_mounth" class="datepicker" category=""></div>
					<div class="event-link"><a href="">все события &rarr;</a></div>
				</div>
			</aside>