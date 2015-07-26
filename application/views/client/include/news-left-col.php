<div id="scroll-left" class="leftmenu">
	<?if(!empty($selected_manufacturer)):?>
		<div class="aside_news_header">
			Новости <?=$selected_manufacturer->name?>
		</div>
	<?endif;?>
	<?foreach($content->articles as $item):?>
		<div class="aside-news-item">
			<div class="item_date"><?=$item->date?></div>							
			<h3 class="item_title"><a href="<?=$item->full_url?>"><?=$item->name?></a></h3>
		</div>
	<?endforeach;?>
</div>