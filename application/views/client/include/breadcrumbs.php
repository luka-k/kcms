<div class="breadcrumb">
	<? foreach ($breadcrumbs as $b): ?>
		<a href="<?= $b['url']?>"><?= $b['name'] ?></a> > 
	<? endforeach ?>
</div>