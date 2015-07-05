<div id="breadcrumbs" class="breadcrumbs">
	<? foreach ($breadcrumbs as $link):?>
		<?if($link['last'] == FALSE):?>
			<a href="<?=$link["url"]?>"><?=$link["name"]?></a> /
		<?else:?>
			<span><?=$link["name"]?></span>
		<?endif;?>
	<? endforeach?>
</div>