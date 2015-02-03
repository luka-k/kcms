<nav class="header__menu">
	<ul class="menu">
		<?foreach($top_menu as $item):?>
			<li class="menu__item">
				<a href="<?=$item->full_url?>" class="menu__href"><?=$item->name?></a>
			</li>
		<?endforeach;?>
	</ul> <!-- /.menu -->
</nav> <!-- /.header__menu -->