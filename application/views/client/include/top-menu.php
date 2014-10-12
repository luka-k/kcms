<ul class="top-menu clearfix">
	<?foreach($top_menu as $item):?>
		<li <?if ($item[2] == 1):?> class="current"<?endif;?>><a href="<?=$item[1]?>"><?=$item[0]?></a>
			<?php if(!empty($item[3])):?>
				<ul>
					<?foreach($item[3] as $sub_item):?>	
						<li><a href="<?=$sub_item[1]?>"><?=$sub_item[0]?></a></li>
					<?endforeach;?>
				</ul>
			<?php endif;?>
		</li>
	<?endforeach;?>
</ul>
