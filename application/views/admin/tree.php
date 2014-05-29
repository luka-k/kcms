<?$tree = $this->categories->get_sub_tree(0)?>
<ul>
<?php foreach ($tree as $branch): ?>
	<li><a href = "<?base_url()?>/admin/pages/<?=$branch->id?>"><?=$branch->title?></li>
	<ul>
	<?$tree = $this->categories->get_sub_tree($branch->id)?>
	<?php foreach ($tree as $branch): ?>
		<li><a href = "<?base_url()?>/admin/pages/<?=$branch->id?>"><?=$branch->title?></li>
	<?php endforeach ?>
	</ul>
<?php endforeach ?>
</ul>
