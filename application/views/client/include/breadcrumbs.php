<div id="breadcrumbs" class="clearfix">
	<? foreach ($breadcrumbs as $link):?>
		<?if($link['last'] == FALSE):?>
			<a href="<?=$link["url"]?>"><?=$link["name"]?></a> >
		<?else:?>
			<?=$link["name"]?>
		<?endif;?>
	<? endforeach?>
</div>