<div class="breadcrumbs "> 
	<div class="container"> 
		<?foreach($breadcrumbs as $link):?>
			<?if($link['last']):?>
				<span><?= $link['name']?></span>
			<?else:?>
				<a href="<?=$link["url"]?>"><?=$link["name"]?></a> <img src="<?= base_url()?>template/client/images/breadcumb.png"> 
			<?endif;?>
		<?endforeach;?>
	</div>
</div>