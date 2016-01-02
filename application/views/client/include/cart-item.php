<li id="cart-<?= $item_id?>" class="media">
	<div class="clearfix book cart-book">
		<a href="<?= $item->full_url?>" class="media-left">
			<div class="<?if($item->has_cover):?>book-cover-cart<?endif;?>">
				<img width="90" height="136" alt="" src="<?=$item->img->catalog_small_url?>" data-echo="<?=$item->img->catalog_small_url?>">
			</div>
		</a>
		<div class="media-body book-details">
			<div class="book-description">
				<h3 class="book-title"><a href="<?= $item->full_url?>"><?=$item->name?></a></h3>
				<p class="book-subtitle">автор <a href="<?= $item->full_url?>"><?=$item->autor?></a></p>
				<p class="price m-t-20"><?= $item->price?> р.</p>
				<a href="#" class="button button--normal" onclick="deleteCartItem('<?= $item_id?>')">Удалить</a>
			</div>
		</div>
	</div>
</li>