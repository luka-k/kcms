<div id="menu" class="clearfix">
	<?$counter = 1?>
	<ul class="menu grid flex">
		<?foreach($menu as $item):?>
			<li class="<?if($url == $item->url):?>current<?endif;?> <?if ($counter == 1):?>l-item<?endif;?>"><a href="<?=$item->full_url?>" <?if($item->full_url == "#"):?>onclick="return false;"<?endif;?>><?=$item->name?></a>
			<?php if(!empty($item->childs)):?>
				<ul>
					<?foreach($item->childs as $sub_item):?>	
						<li class="<?if($url == $sub_item->url):?>current<?endif;?>"><a href="<?=$sub_item->full_url?>"><?=$sub_item->name?></a></li>
					<?endforeach;?>
				</ul>
			<?php endif;?>				
			</li>
			<?$counter++?>
		<?endforeach;?>
		<li class="right r-item"><a href="<?=base_url()?>" target = "_blanc"><i class="icon-signout"></i>На сайт</a></li>
		<li class="right"><a href="<?=base_url()?>admin/users_module/edit/<?=$user['id']?>/edit"><i class="icon-user"></i><?=$user['name']?></a></li>
		<li class="right"><a href="<?=base_url()?>admin/registration/logout"><i class="icon-remove"></i>Выйти</a></li>
		<?if(ENVIRONMENT == "development"):?>
			<li class="right"><a href="<?=base_url()?>admin/logs"><i class="icon-book"></i>Логи</a></li>
		<?endif;?>
	</ul>
</div>	