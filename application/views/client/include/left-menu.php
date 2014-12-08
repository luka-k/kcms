<div class="menu-left">
	<ul id="menu-left" class="menu">
		<?$counter = count($left_menu)?>
		<?foreach($left_menu as $item):?>
			<?$counter--?>
			<?if($item->url <> "novosti-lt-pro"):?>
				<li class="menu-item menu-item-type-taxonomy menu-item-object-category <?if($sub_type == $item->url):?>current-menu-item<?endif;?> <?if($counter == 0):?>last<?endif;?>"><a href="<?=$item->full_url?>"><?=$item->name?></a></li>
			<?endif;?>
		<?endforeach;?>
	</ul>
</div>