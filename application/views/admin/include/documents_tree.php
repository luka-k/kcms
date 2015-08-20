<h6>Документы по производителям</h6>
<ul class="tree">
	<?foreach ($tree as $branch_1): ?>
		<li>
			<a href = "<?=base_url()?>admin/content/items/<?=$type?>/<?=$branch_1->id?>">
				<?=$branch_1->name?>
			</a>
		</li>
	<?endforeach;?>
</ul>