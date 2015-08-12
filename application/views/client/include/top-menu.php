<div id="menu" class="rounded" style="margin-bottom: 25px;">
	<ul>
		<?$counter = 0?>
		<?foreach ($top_menu as $item):?>
			<li class="main-menu-item  menu-item-even menu-item-depth-0 menu-item menu-item-type-taxonomy menu-item-object-category <?if($counter == 0):?>left<?elseif($counter == 4):?>right<?endif;?> <?if(isset($type)):?><?if($type == $item->url):?>current-menu-item<?endif;?><?endif;?>"><a href="<?=$item->full_url?>"><?=$item->menu_name?></a>
				<?if(isset($item->childs)):?>
					<ul class="sub-menu menu-odd  menu-depth-1">
						<?foreach($item->childs as $sub_item):?>
							<li id="nav-menu-item" class="sub-menu-item  menu-item-odd menu-item-depth-1 menu-item menu-item-type-taxonomy menu-item-object-category <?if(isset($sub_type)):?><?if($sub_type == $sub_item->url):?>current-menu-item<?endif;?><?endif;?>">
								<a href="<?=$sub_item->full_url?>" class="menu-link sub-menu-link"><?=$sub_item->menu_name?></a>
							</li>
						<?endforeach;?>
					</ul>
				<?endif;?>
			</li>
			<?$counter++?>
		<?endforeach;?>
	</ul>
	
	<div id="lang">
		<a href="<?=RUS_BASE_URL?>/<?=$url?>"><img src="<?=base_url()?>template/client/img/rus.png" alt=""/></a>
		<a href="<?=ENG_BASE_URL?>/<?=$url?>"><img src="<?=base_url()?>template/client/img/eng.png" alt=""/></a>
		<!--Константы ENG_BASE_URL и US_BASE_URL находятся в config/constants.php-->
	</div>
	
	<div id="cont">
		<a href="<?=base_url()?>contacts/feedback"><img id="cont_img" src="<?=base_url()?>template/client/img/cont.png" alt=""/><?if(LANG == 'eng'):?>Contacts<?else:?>Контакты<?endif;?></a>
	</div>
</div>

