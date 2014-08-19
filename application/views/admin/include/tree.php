<ul>
<?php foreach ($tree as $branch_1): ?>
	<li><a href = "<?base_url()?>/admin/item/<?=$type?>/<?=$branch_1->id?>"><?=$branch_1->title?></a></li>
	<?php if(!empty($branch_1->childs)):?>
		<ul>
			<?php foreach ($branch_1->childs as $branch_2): ?>
				<li><a href = "<?base_url()?>/admin/item/<?=$type?>/<?=$branch_2->id?>"><?=$branch_2->title?></a></li>
					<?php if(!empty($branch_2->childs)):?>
						<ul>
							<?php foreach ($branch_2->childs as $branch_3): ?>
								<li><a href = "<?base_url()?>/admin/item/<?=$type?>/<?=$branch_3->id?>"><?=$branch_3->title?></a></li>
							<?php endforeach ?>	
						</ul>
			<?php endif;?>
			<?php endforeach ?>	
		</ul>
	<?php endif;?>
<?php endforeach;?>
</ul>
