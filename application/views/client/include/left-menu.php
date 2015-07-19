<ul class="catalog-nav">
	<?foreach($left_menu as $level_1):?>
		<li class="catalog-nav__item active <?if($left_active == $level_1->url):?>active<?endif;?>">
			<a href="<?=$level_1->full_url?>" class="catalog-nav__href"><?=$level_1->name?></a>
			<?if(isset($level_1->childs)):?>
				<ul class="catalog-nav-level-2">
					<?foreach($level_1->childs as $level_2):?>
						<li class="catalog-nav-level-2__item <?if($left_active == $level_2->url && $left_parent_active == $level_1->url):?>active<?endif;?>">
							<a href="<?=$level_2->full_url?>" class="catalog-nav-level-2__href"><?=$level_2->name?></a>
						</li>
					<?endforeach;?>
				</ul>
			<?endif;?>
		</li>
	<?endforeach;?>
</ul> <!-- /.catalog-nav -->