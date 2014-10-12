<h6>Страницы по категориям</h6>
<ul class="tree">
	<li><a href="<?=base_url()?>/admin/items/<?=$type?>">Все страницы</a></li>
	<?php foreach ($tree as $branch_1): ?>
		<li <?if(!empty($branch_1->childs)):?> class="down" <?endif;?>><a href = "<?=base_url()?>/admin/items/<?=$type?>/<?=$branch_1->id?>"><?=$branch_1->name?></a>
			<?php if(!empty($branch_1->childs)):?>
				<ul>
					<?php foreach ($branch_1->childs as $branch_2): ?>
						<li><a href = "<?=base_url()?>/admin/items/<?=$type?>/<?=$branch_2->id?>"><?=$branch_2->name?></a>
						</li>
					<?php endforeach ?>	
				</ul>
			<?php endif;?>
		</li>
	<?php endforeach;?>
</ul>
