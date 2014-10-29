<h6>Категории</h6>
<ul class="tree">
	<li><a href="<?=base_url()?>/admin/items/<?=$type?>">Все категории</a></li>
	<?php foreach ($tree as $branch_1): ?>
		<li <?if(!empty($branch_1->childs)):?> class="down" <?endif;?>><a href = "<?base_url()?>/admin/items/<?=$type?>/<?=$branch_1->id?>"><?=$branch_1->name?></a>
			<?php if(!empty($branch_1->childs)):?>
				<ul class="<?=$branch_1->class?>">
					<?php foreach ($branch_1->childs as $branch_2): ?>
						<li <?if(!empty($branch_2->childs)):?> class="down" <?endif;?>><a href = "<?base_url()?>/admin/items/<?=$type?>/<?=$branch_2->id?>"><?=$branch_2->name?></a>
							<?php if(!empty($branch_2->childs)):?>
								<ul class="<?=$branch_2->class?>">
									<?php foreach ($branch_2->childs as $branch_3): ?>
										<li><a href = "<?base_url()?>/admin/items/<?=$type?>/<?=$branch_3->id?>"><?=$branch_3->name?></a></li>
									<?php endforeach ?>	
								</ul>
							<?php endif;?>
						</li>
					<?php endforeach ?>	
				</ul>
			<?php endif;?>
		</li>
	<?php endforeach;?>
</ul>


