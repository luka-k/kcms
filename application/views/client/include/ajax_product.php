<div class="product">
	<div class="product-price">
		<p>Цена розничная: <del><?=$item->price?> р.</del> <span class="discount">-<?=$item->discount?>%</span></p>
		<p>Цена на сайте: <span class="top-price"><?=$item->sale_price?></span> р.</p>
		<p>Наличие: <span class="blue-label"><?=$item->location?></span></p>
		<p><a href="" onclick="add_to_cart('<?=$item->id?>', 1); return false;"><img src="/template/client/images-new/cartbtn.png" /></a></p>
	</div>
	<div class="product-image">
		<?if(isset($item->img)):?>
			<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_small_url?>" width="138" /></a>
		<?endif;?>
	</div>
	<div class="product-name">
		<a href="<?=$item->full_url?>"><?=$item->name?></a>
	</div>
	<div class="product-sku">
		<?=$item->sku?>
	</div>
</div>