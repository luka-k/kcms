<ul class="menu vertical">
	<?foreach($left_menu->items as $item):?>
		<li><a href="<?=$item->full_url?>"><?=$item->name?></a></li>
	<?endforeach;?>
</ul>