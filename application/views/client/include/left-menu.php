<ul class="menu vertical">
	<?foreach($left_menu as $item):?>
		<li><a href="<?=$item->full_url?>"><?=$item->name?></a></li>
	<?endforeach;?>
</ul>