<div class="catalog__item">
	<div class="catalog-item">
		<div class="catalog-item__image-box">
			<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_mid_url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
		</div>
										
		<a href="<?=$item->full_url?>" class="catalog-item__name"><?=$item->name?></a>
										
		<div class="catalog-item__desc">
			<p><?=$item->short_description?></p>
		</div>
										
		<div class="catalog-item__bottom">
			<div class="catalog-item__price"><?=$item->price?> р.</div>
											
			<div class="catalog-item__button">
				<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="cart_popup('<?=$item->id?>', '<?=$item->name?>', 1); return false;">Купить</button>
			</div>
		</div>
	</div>
</div>