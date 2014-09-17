<h6>Категории</h6>
<ul class="tree">
	<?php foreach ($tree as $branch_1): ?>
		<li><a href = "<?base_url()?>/admin/item/<?=$type?>/<?=$branch_1->id?>" <?if(!empty($branch_1->childs)):?> class="down-1" <?endif;?>><?=$branch_1->title?></a>
			<?php if(!empty($branch_1->childs)):?>
				<ul class="<?=$branch_1->class?>">
					<?php foreach ($branch_1->childs as $branch_2): ?>
						<li><a href = "<?base_url()?>/admin/item/<?=$type?>/<?=$branch_2->id?>" <?if(!empty($branch_2->childs)):?> class="down-1" <?endif;?>><?=$branch_2->title?></a>
							<?php if(!empty($branch_2->childs)):?>
								<ul class="<?=$branch_2->class?>">
									<?php foreach ($branch_2->childs as $branch_3): ?>
										<li><a href = "<?base_url()?>/admin/item/<?=$type?>/<?=$branch_3->id?>"><?=$branch_3->title?></a></li>
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
