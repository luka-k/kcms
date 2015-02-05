<div class="page__breadcrumbs breadcrumbs">
	<ul class="breadcrumbs__list">
		<? foreach ($breadcrumbs as $link):?>
			<li class="breadcrumbs__item">
				<?if($link["last"]):?>
					<span class="breadcrumbs__end"><?=$link["name"]?></span>
				<?else:?>
					<a href="<?=$link["url"]?>" class="breadcrumbs__href"><?=$link["name"]?></a>
				<?endif;?>
			 </li> <!-- /.breadcrumbs__item -->
		<? endforeach?>
	</ul> <!-- /.breadcrumbs__list -->
</div> <!-- /.page__breadcrumbs breadcrumbs-->