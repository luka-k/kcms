<aside class="leftbar">
	<div class="filters">
		<h3>Поиск по параметрам</h3>
		
		<form action="<?=base_url()?>catalog" class="form" method="get">
			<input type="hidden" name="filter" value="true"/>
							
				<div class="catalog-filter__top">
					<?foreach($filters as $type=> $filter):?>
						<?require "filters/{$filter->editor}.php"?>
					<?endforeach;?>	
				</div> <!-- /.catalog-filter__top -->
							
				<div class="catalog-filter__range">
					<div class="catalog-range">
						<div class="catalog-range__scale">
							Цена: <br/>
							<div class="catalog-range">
								<input type="text" name="min_price" value="<?=$min_value?>"> - <input type="text" name="max_price" value="<?=$max_value?>"> руб.
							</div> <!-- /.catalog-range__to -->
						</div> <!-- /.catalog-slider__scale -->

					</div> <!-- /.catalog-range -->
				</div> <!-- /.catalog-filter__range -->
						
							
				<div class="form__button page-form__button">
					<button class="button button--normal button--auto-width">Подобрать</button>
				</div> <!-- /.form__button -->
		</form> <!-- /.form -->
	</div>
	
	<div class="news_bar">
		<h3 class="news-t">Новости</h3>
		<div class="left_news">
			<?foreach($last_news as $news_item):?>
				<div class="news_item">
					<div class="news-date"><?=$news_item->date?></div>
					<div class="news-title"><a href="<?=$news_item->full_url?>"><?=$news_item->name?></a></div>
				</div>
			<?endforeach;?>
		</div>
		<a href="<?base_url()?>articles/novosti" class="news_link">все новости -></a>
		
		<h3>События</h3>
		<div class="page-news__calendar">
			
			<div id="this_mounth" class="datepicker"></div>
		</div> <!-- /.page-news__calendar -->
	</div>
</aside>