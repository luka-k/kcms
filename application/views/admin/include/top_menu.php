<div id="menu" class="clearfix">
	<?$counter = 1?>
	<ul class="menu grid flex">
		<?foreach($menu as $item):?>
			<?if(in_array("manager", $user_groups) && $item->is_manager == 0 || !in_array("manager", $user_groups)):?>
			<li class="<?if($url == $item->url):?>current<?endif;?> <?if ($counter == 1):?>l-item<?endif;?>"><a href="<?=$item->full_url?>" <?if($item->full_url == "#"):?>onclick="return false;"<?endif;?>><?=$item->name?></a>
			<?php if(!empty($item->childs)):?>
				<ul>
					<?foreach($item->childs as $sub_item):?>	
						<?if(in_array("manager", $user_groups) && $sub_item->is_manager == 0 || !in_array("manager", $user_groups)):?><li class="<?if($url == $sub_item->url):?>current<?endif;?>"><a href="<?=$sub_item->full_url?>"><?=$sub_item->name?></a></li><?endif;?>
					<?endforeach;?>
				</ul>
			<?php endif;?>				
			</li>
			<?endif;?>
			<?$counter++?>
		<?endforeach;?>
		<li class="right r-item"><a href="<?=base_url()?>" target = "_blanc"><i class="icon-signout"></i>На сайт</a></li>
		<? if (!$this->users_groups->is_seo()): ?>
		<li class="right"><a href="<?=base_url()?>admin/users_module/edit/<?=$user['id']?>/edit"><i class="icon-user"></i><?=$user['name']?></a></li>
		<?endif?>
		<li class="right"><a href="<?=base_url()?>admin/registration/logout"><i class="icon-remove"></i>Выйти</a></li>
		
		<? if (!$this->users_groups->is_seo()): ?>
			<?if(in_array("admin", $user_groups)):?>
				<li class="right"><a href="<?=base_url()?>admin/cache/refresh"><i class="icon-pencil"></i>Кеш</a>
					<ul>
						<li><a href="<?=base_url()?>admin/cache/clear">Очистить</a></li>
						<li><a href="<?=base_url()?>admin/cache/refresh_categories">Категории</a></li>
						<li><a href="<?=base_url()?>admin/cache/refresh_manufacturer_by_categories">Категории/Производители</a></li>
						<li><a href="<?=base_url()?>admin/cache/refresh_manufacturers">Производители</a></li>
					</ul>
				</li>
			<?endif;?>
		<?endif?>
	</ul>
</div>	