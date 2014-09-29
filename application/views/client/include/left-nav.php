<nav class="leftnav">
	<ul>
		<?php foreach ($tree as $branch_1): ?>
			<li><span <?if(!empty($branch_1->childs)):?> class="down" <?endif;?>><a href = "<?=base_url()?>catalog/<?=$branch_1->url?>"><?=$branch_1->title?></a></span></li>
			<?php if(!empty($branch_1->childs)):?>
				<ul class="<?=$branch_1->class?>">
					<?php foreach ($branch_1->childs as $branch_2): ?>
						<li><span <?if(!empty($branch_2->childs)):?> class="down" <?endif;?>><a href = "<?=base_url()?>catalog/<?=$branch_1->url?>/<?=$branch_2->url?>"><?=$branch_2->title?></a></span></li>
						<?php if(!empty($branch_2->childs)):?>
							<ul class="<?=$branch_2->class?>">
								<?php foreach ($branch_2->childs as $branch_3): ?>
									<li><a href = "<?=base_url()?>catalog/<?=$branch_1->url?>/<?=$branch_2->url?>/<?=$branch_3->url?>"><?=$branch_3->title?></a></li>
								<?php endforeach ?>	
							</ul>
						<?php endif;?>
					<?php endforeach ?>	
				</ul>
			<?php endif;?>
		<?php endforeach;?>
	</ul>
</nav>