<ul class="breadcrumbs">
	<? foreach ($breadcrumbs as $link):?>
		<li><a href="<?=$link["url"]?>"> <?=$link["name"]?> </a></li>
	<? endforeach?>
</ul>