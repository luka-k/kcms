<h6>Категории</h6>
<ul class="tree">
	<li><a href="<?=base_url()?>admin/content/items/<?=$type?>/all">Все категории</a></li>
	<?foreach ($tree as $branch_1): ?>
		<li <?if(!empty($branch_1->childs)):?> class="down" <?endif;?>>
			<a href = "<?=base_url()?>admin/content/items/<?=$type?>/<?=$branch_1->id?>">
				<?=$branch_1->name?>
			</a>
		</li>
	<?endforeach;?>
</ul>


