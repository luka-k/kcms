<div id="menu" class="col_12">
	<ul class="menu">
		<?foreach($menu as $item):?>
			<li class="currenttt" ><a href="<?=$item->full_url?>"><?=$item->name?></a>
			<?php if(!empty($item->childs)):?>
				<ul>
					<?foreach($item->childs as $sub_item):?>	
						<li class="currenttt"><a href="<?=$sub_item->full_url?>"><?=$sub_item->name?></a></li>
					<?endforeach;?>
				</ul>
			<?php endif;?>				
			</li>
		<?endforeach;?>
		<li class="right"><a href="<?=base_url()?>admin/registration/logout"><i class="icon-remove"></i>Выйти</a></li>
		<li class="right"><a href="<?=base_url()?>admin/users_module/edit/<?=$user['id']?>/edit"><i class="icon-user"></i><?=$user['name']?></a></li>
		<li class="right"><a href="<?=base_url()?>" target = "_blanc"><i class="icon-signout"></i>На сайт</a></li>
	</ul>
</div>	