<div id="menu" class="clearfix">
	<?$counter = 1?>
	<ul class="menu grid flex">
		<?foreach($menu as $item):?>
			<li class="<?if ($item[2] == 1):?> current<?endif;?> <?if ($counter == 1):?>l-item<?endif;?>"><a href="<?=$item[1]?>"><?=$item[0]?></a>
			<?php if(!empty($item[3])):?>
				<ul>
					<?foreach($item[3] as $sub_item):?>	
						<li <?if ($sub_item[2] == 1):?> class="current"<?endif;?>><a href="<?=$sub_item[1]?>"><?=$sub_item[0]?></a></li>
					<?endforeach;?>
				</ul>
			<?php endif;?>				
			</li>
			<?$counter++?>
		<?endforeach;?>
		<li class="right r-item"><a href="<?=base_url()?>" target = "_blanc"><i class="icon-signout"></i>На сайт</a></li>
		<li class="right"><a href="<?=base_url()?>admin/users_module/edit/<?=$user['id']?>/edit"><i class="icon-user"></i><?=$user['name']?></a></li>
		<li class="right"><a href="<?=base_url()?>admin/registration/logout"><i class="icon-remove"></i>Выйти</a></li>
	</ul>
</div>	