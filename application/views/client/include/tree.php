<ul class="tree">
<?php foreach ($tree as $branch_1): ?>
	<li><a href = "<?=base_url()?>catalog/<?=$branch_1->url?>"><?=$branch_1->title?></a></li>
	<?php if(!empty($branch_1->childs)):?>
		<ul>
			<?php foreach ($branch_1->childs as $branch_2): ?>
				<li><a href = "<?=base_url()?>catalog/<?=$branch_2->url?>"><?=$branch_2->title?></a></li>
					<?php if(!empty($branch_2->childs)):?>
						<ul>
							<?php foreach ($branch_2->childs as $branch_3): ?>
								<li><a href = "<?=base_url()?>catalog/<?=$branch_3->url?>"><?=$branch_3->title?></a></li>
							<?php endforeach ?>	
						</ul>
					<?php endif;?>
			<?php endforeach ?>	
		</ul>
	<?php endif;?>
<?php endforeach;?>
</ul>
