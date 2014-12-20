<ul class="catalog-nav">
	<?foreach($left_menu as $level_1):?>
		<li class="catalog-nav__item active <?if($level_1->url == $url):?>active<?endif;?>">
			<a href="<?=$level_1->full_url?>" class="catalog-nav__href"><?=$level_1->name?> <sup><?=$level_1->count_sub_products?></sup></a>
			<?if(isset($level_1->childs)):?>
				<ul class="catalog-nav-level-2">
					<?foreach($level_1->childs as $level_2):?>
						<li class="catalog-nav-level-2__item">
							<a href="<?=$level_2->full_url?>" class="catalog-nav-level-2__href"><?=$level_2->name?> <sup><?=$level_2->count_sub_products?></sup></a>
						</li>
					<?endforeach;?>
				</ul>
			<?endif;?>
		</li>
	<?endforeach;?>
</ul> <!-- /.catalog-nav -->