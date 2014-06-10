<ul>
	<li><a href="<?base_url()?>/admin/pages/0">Без категории</a></li>
<?php foreach ($tree as $branch): ?>
	<li><a href = "<?base_url()?>/admin/pages/<?=$branch->id?>"><?=$branch->title?></li>
	<?php if(isset($branch->childs)):?>
	<ul>
		<?php foreach ($branch->childs as $bran): ?>
			<li><a href = "<?base_url()?>/admin/pages/<?=$bran->id?>"><?=$bran->title?></li>
		<?php endforeach ?>	
	</ul>
	<?php endif;?>
<?php endforeach;?>
</ul>
<!--<?$tree = $this->categories->get_sub_tree(0, "root")?>
<ul>
	<li><a href="<?base_url()?>/admin/pages/0">Без категории</a></li>
<?php foreach ($tree as $branch): ?>
	<li><a href = "<?base_url()?>/admin/pages/<?=$branch->id?>"><?=$branch->title?></li>
	<ul>
	<?$tree = $this->categories->get_sub_tree($branch->id, "root")?>
	<?php foreach ($tree as $branch): ?>
		<li><a href = "<?base_url()?>/admin/pages/<?=$branch->id?>"><?=$branch->title?></li>
	<?php endforeach ?>
	</ul>
<?php endforeach ?>
</ul>-->
