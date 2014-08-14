<ul>
	<li><a href="<?base_url()?>/admin/pages/">Все страницы</a></li>
	<!--<li><a href="<?base_url()?>/admin/pages/0">Без категории</a></li>-->
<?php foreach ($tree as $branch): ?>
	<li><a href = "<?base_url()?>/admin/pages/<?=$branch->id?>"><?=$branch->title?></a></li>
	<?php if(!empty($branch->childs)):?>
		<ul>
			<?php foreach ($branch->childs as $bran): ?>
				<li><a href = "<?base_url()?>/admin/pages/<?=$bran->id?>"><?=$bran->title?></a></li>
			<?php endforeach ?>	
		</ul>
	<?php endif;?>
<?php endforeach;?>
</ul>
