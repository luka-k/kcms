<div>
	<ul>
		<?foreach($news_tree as $news_item):?>
			<li><a href="<?=base_url()?>admin/content/items/news/<?=$news_item->id?>"><?=$news_item->menu_name?></a></li>
		<?endforeach;?>
	</ul>
</div>