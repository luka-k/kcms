<div id="scroll-left" class="leftmenu">
	<?$item_counter = 1?>
	<?foreach($left_menu as $i => $item):?>
		<div class="div">
			<a href="<?=base_url()?>podrjadchiki/<?=$item->url?>" id="<?=$item_counter?>" class="ddlist main-item <?if($left_active_item == $item->url):?>down-item<?else:?>up-item<?endif;?>" onclick="">
				<span class="menu-pic"><img src="<?=$item->img->full_url?>" alt=""></span>
				<span class="menu-text"><?= $i == 0 ? str_replace(' ', '<br>', $item->name) : $item->name?></span>
			</a> 
			
			<?if(!empty($item->childs)):?>
				<ul class="sub-menu <?if($left_active_item == $item->url):?>active<?endif;?>">
					<?foreach($item->childs as $sub_item):?>
						<li><a href="<?=base_url()?>podrjadchiki/<?=$item->url?>/<?=$sub_item->url?>" class="<?if($submenu_active_item == $sub_item->url):?>active<?endif;?>"><?=$sub_item->name?></a></li>
					<?endforeach;?>
				</ul>
			<?endif;?>
		</div>
		<?$item_counter++?>
	<?endforeach;?>
</div>				