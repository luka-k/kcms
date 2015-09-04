<? function isTopMenuActive($item)
{
	$result = false;
	if ($_SERVER['REQUEST_URI'] == '/')
	{
		if ($item->full_url == '/')
		{
			$result = true;
		}
	}
	else if ($item->full_url != '/' && strstr($_SERVER['REQUEST_URI'], str_replace('http://brightberry.ru', '', $item->full_url)))
		{
			$result = true;
		}
	return $result;
}
?>
<nav class="header__menu">
	<ul class="menu">
		<?foreach($top_menu as $item):?>
			<li class="menu__item">
				<a href="<?=$item->full_url?>" class="menu__href <? if (isTopMenuActive($item)) : ?>active<? endif ?>" ><?=$item->name?></a>
			</li>
		<?endforeach;?>
	</ul> <!-- /.menu -->
</nav> <!-- /.header__menu -->