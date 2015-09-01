<h6>Категории</h6>
<ul class="tree">
	<li><a href="<?=base_url()?>admin/content/items/<?=$type?>/all">Все категории</a></li>
	<li><a href="<?=base_url()?>admin/content/items/<?=$type?>/0">Родительские категории</a></li>
	<?foreach ($tree as $branch_1): ?>
		<li <?if(!empty($branch_1->childs)):?> class="down" <?endif;?>>
			<a href = "<?=base_url()?><?if(!empty($branch_1->childs)):?>admin/content/items/<?=$type?>/<?=$branch_1->id?><?else:?>admin/content/item/edit/<?=$type?>/<?=$branch_1->id?><?endif;?>">
				<?=$branch_1->name?>
			</a>
			<?if(!empty($branch_1->childs)):?>
				<a href="<?=base_url()?>admin/content/item/edit/<?=$type?>/<?=$branch_1->id?>">
					<i class="icon-pencil"></i>
				</a>
			
				<ul class="<?=$branch_1->class?>">
					<?foreach ($branch_1->childs as $branch_2): ?>
						<li <?if(!empty($branch_2->childs)):?> class="down" <?endif;?>>
							<a href = "<?=base_url()?><?if(!empty($branch_2->childs)):?>admin/content/items/<?=$type?>/<?=$branch_2->id?><?else:?>admin/content/item/edit/<?=$type?>/<?=$branch_2->id?><?endif;?>">
								<?=$branch_2->name?>
							</a>
							<?if(!empty($branch_2->childs)):?>
								<a href="<?=base_url()?>admin/content/item/edit/<?=$type?>/<?=$branch_2->id?>">
									<i class="icon-pencil"></i>
								</a>
								<ul class="<?=$branch_2->class?>">
									<?foreach ($branch_2->childs as $branch_3): ?>
										<li><a href = "<?=base_url()?>admin/content/item/edit/<?=$type?>/<?=$branch_3->id?>"><?=$branch_3->name?></a></li>
									<?endforeach ?>	
								</ul>
							<?endif;?>
						</li>
					<?endforeach ?>	
				</ul>
			<?endif;?>
		</li>
	<?endforeach;?>
</ul>


