<ul class="menu vertical">
	<?foreach($left_menu->items as $item):?>
		<li>
			<a href="<?=$item->full_url?>"><?=$item->name?></a>
			<?if(!empty($item->childs)):?>
				<ul>
					<?foreach($item->childs as $level_2):?>
						<li><a href="<?=$level_2->full_url?>"><?=$level_2->name?></a></li>
					<?endforeach;?>
				</ul>	
			<?endif;?>
		</li>
	<?endforeach;?>
</ul>