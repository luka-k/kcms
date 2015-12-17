<div class="categories-breadcrumb">
	<ul class="breadcrumb">
		<? foreach ($breadcrumbs as $link):?>
			<li class="<?if($link['last']):?>active<?endif;?>"><a href="<?=$link["url"]?>"><?=$link["name"]?></a></li>
		<? endforeach?>
	</ul>
</div>