<ul class="breadcrumbs">
	<? foreach ($breadcrumbs as $name => $link):?>
		<li><a href="<?=$link?>"> <?=$name?> </a></li>
	<? endforeach?>
</ul>