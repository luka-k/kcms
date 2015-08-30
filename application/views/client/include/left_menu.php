
<ul class="leftmenu">
	<?foreach($tree[0]->childs as $level_1):?>
		<li class="level_1"><a href="<?=base_url()?><?=$tree[0]->url?>/<?=$level_1->url?>"><?=$level_1->menu_name?></a>
			<?if(!empty($level_1->childs)):?>
				<ul>
					<?foreach($level_1->childs as $level_2):?>
						<li class="level_2"><a href="<?=base_url()?><?=$tree[0]->url?>/<?=$level_1->url?>/<?=$level_2->url?>"><?=$level_2->menu_name?></li></a>
					<?endforeach;?>
				</ul>
			<?endif;?>
		</li>
	<?endforeach;?>
</ul>