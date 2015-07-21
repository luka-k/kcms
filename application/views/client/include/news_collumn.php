<h1>Новости</h1>
<div id="scroll-right" class="rightmenu">
	<?foreach($last_news as $item):?>
		<div class="news_item m_news-<?= $item->manufacturer_id?>">
			<h2><a href="<?=$item->full_url?>" style="color: #0000C8"><?=$item->name?></a></h2>
			<div class="item_text"><span class="news_date"><?=$item->date?></span> <?=$item->description?></div>
		</div>
	<?endforeach;?>
</div>