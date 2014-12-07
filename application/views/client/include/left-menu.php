<div class="menu-left">
<ul id="menu-left" class="menu">
	<?foreach($left_menu as $item):?>
		<li class="menu-item menu-item-type-taxonomy menu-item-object-category <?if($sub_type == $item->url):?>current-menu-item<?endif;?>"><a href="<?=$item->full_url?>"><?=$item->name?></a></li>
	<?endforeach;?>
</ul>
</div>