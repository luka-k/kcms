<h1>Новости</h1>
<div id="scroll-right" class="rightmenu">
	<?foreach($last_news as $item):?>
		<div class="news_item">
			<h2><?=$item->name?></h2>
			<div class="item_text"><span class="news_date"><?=$item->date?></span> <?=$item->description?></div>
		</div>
	<?endforeach;?>
</div>