<ul>
<?php foreach ($tree as $branch): ?>
	<li><a href = "<?base_url()?>catalog/<?=$branch->url?>"><?=$branch->title?></a></li>
	<?php if(!empty($branch->childs)):?>
		<ul>
			<?php foreach ($branch->childs as $bran): ?>
				<li><a href = "<?base_url()?>catalog/<?=$branch->url?>/<?=$bran->url?>"><?=$bran->title?></a></li>
					<?php if(!empty($branch->childs)):?>
						<ul>
							<?php foreach ($bran->childs as $br): ?>
								<li><a href = "<?base_url()?>catalog/<?=$branch->url?>/<?=$bran->url?>/<?=$br->url?>"><?=$br->title?></a></li>
							<?php endforeach ?>	
						</ul>
					<?php endif;?>
			<?php endforeach ?>	
		</ul>
	<?php endif;?>
<?php endforeach;?>
</ul>
