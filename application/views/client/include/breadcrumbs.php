<div class="breadcrumbs">
	<div class="breadcrumbs__wrap wrap">
		<ul class="breadcrumbs__list">
			<? foreach ($breadcrumbs as $link):?>
				<li class="breadcrumbs__item"><a href="<?=$link["url"]?>"> <?=$link["name"]?> </a></li>
			<? endforeach?>
		</ul> <!-- /.breadcrumbs -->
	</div> <!-- /.breadcrumbs__wrap wrap -->
</div> <!-- /.breadcrumbs -->