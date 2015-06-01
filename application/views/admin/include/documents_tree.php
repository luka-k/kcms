<h6>Документы</h6>
<ul class="tree">
	<li><a href="<?=base_url()?>admin/content/items/<?=$type?>/all">Все документы</a></li>
	<?foreach ($tree as $branch_1): ?>
		<li>
			<a href = "<?=base_url()?>admin/content/item/edit/<?=$type?>/<?=$branch_1->id?>">
				<?=$branch_1->name?>
			</a>
		</li>
	<?endforeach;?>
</ul>