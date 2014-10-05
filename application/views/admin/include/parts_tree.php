<ul>
	<?php foreach ($tree as $branch): ?>
		<li><a href = "<?base_url()?>/admin/item/<?=$branch->url?>"><?=$branch->title?></a>
			<?php if(!empty($branch->childs)):?>
				<ul>
					<?php foreach ($branch->childs as $bran): ?>
						<li><a href = "<?base_url()?>/admin/item/<?=$bran->url?>"><?=$bran->title?></a></li>
					<?php endforeach ?>	
				</ul>
			<?php endif;?>
		</li>
	<?php endforeach;?>
</ul>
