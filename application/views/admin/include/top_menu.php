<div id="menu" class="col_12">
	<ul class="menu">
		<?foreach($menu as $item):?>
			<li <?if ($item[2] == 1):?> class="current"<?endif;?>><a href="<?=$item[1]?>"><?=$item[0]?></a>
			<?php if(!empty($item[3])):?>
				<ul>
					<?foreach($item[3] as $sub_item):?>	
						<li <?if ($sub_item[2] == 1):?> class="current"<?endif;?>><a href="<?=$sub_item[1]?>"><?=$sub_item[0]?></a></li>
					<?endforeach;?>
				</ul>
			<?php endif;?>				
			</li>
		<?endforeach;?>
		<li class="right"><a href="<?=base_url()?>admin/registration/logout"><i class="icon-remove"></i>Выйти</a></li>
		<li class="right"><a href="<?=base_url()?>admin/item/users/<?=$user_id?>"><i class="icon-user"></i><?=$user_name?></a></li>
		<li class="right"><a href="<?=base_url()?>" target = "_blanc"><i class="icon-signout"></i>На сайт</a></li>
	</ul>
</div>	