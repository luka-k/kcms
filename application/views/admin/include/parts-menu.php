<ul>
	<?foreach ($parts as $part): ?>
		<li><a href="<?=base_url()?>admin/part/<?=$part->id?>"><?=$part->title?></a></li>
	<?endforeach ?>
</ul>