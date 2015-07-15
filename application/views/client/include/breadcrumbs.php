<div class="breadcrumbs">
	<ul class="breadcrumbs__list">
		<? foreach ($breadcrumbs as $link):?>
			<li class="breadcrumbs__item <?if($link['last']):?>last<?endif;?>"><a href="<?=$link["url"]?>"> <?=$link["name"]?> </a></li>
		<? endforeach?>
	</ul> <!-- /.breadcrumbs -->
</div> <!-- /.breadcrumbs -->