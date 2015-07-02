<div id="scroll-left" class="leftmenu">
	<?$item_counter = 1?>
	<?foreach($left_menu as $item):?>
		<div class="div">
			<a href="<?=base_url()?>catalog/<?=$item->url?>" id="<?=$item_counter?>" class="ddlist main-item clearfix <?if($left_active_item == $item->url):?>down-item<?else:?>up-item<?endif;?>" onclick="">
				<span class="menu-pic"><img src="<?=$item->img->full_url?>" alt=""></span>
				<span class="menu-text"><?=$item->name?></span>
			</a> 
			
			<?if(!empty($item->childs)):?>
				<ul class="sub-menu <?if($left_active_item == $item->url):?>active<?endif;?>">
					<?foreach($item->childs as $sub_item):?>
						<li><a href="<?=base_url()?>catalog/<?=$item->url?>/<?=$sub_item->url?>" class="<?if($submenu_active_item == $sub_item->url):?>active<?endif;?>"><?=$sub_item->name?></a></li>
					<?endforeach;?>
				</ul>
			<?endif;?>
		</div>
		<?$item_counter++?>
	<?endforeach;?>
</div>				