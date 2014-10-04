<aside id="right">
	<div id="cart">
		<div class="title">
			CART
		</div>
		<div id="cart_items" class="clearfix">
			<?if($cart == NULL):?>
				<span class="noproduct">No products</span>
			<?else:?>
				<?foreach($cart as $item_id => $item):?>
					<div class="cart_item <?=$item_id?>" >
						<div class="cart_item_name">
							<?if($item['qty']>1):?><span class="qty-<?=$item_id?>"><?=$item['qty']?></span>x<?endif;?>
							<span class="title-<?=$item_id?>"><?=$item['title']?></span>
						</div> 
						<span class="cart_price"><a href="#" onclick="delete_item('<?=$item_id?>')"><img src="<?php echo base_url()?>template/client/images/item_clear.png"></a><?=$item['price']?> &euro;</span>
					</div>				
				<?endforeach;?>
					<span class="alt"></span>
			<?endif;?>
		</div>
		
		<div id="cart_total">
			<?if($cart <> NULL):?><div class="total_item">Shipping <span class="cart_price"><span class="shipping"></span> &euro;</span></div><?endif;?>
			<div class="total_item">Total <span class="cart_price"><span class='total'>0</span> &euro;</span></div>
		</div>
		<div id="check">
			<a href="<?=base_url()?>pages/cart"><img src="<?=base_url()?>template/client/images/check.png"/></a>
		</div>
	</div>
		  
	<div id="share" style="clear:both; height:90px;">
		<div class="title">
			SHARE
		</div>
		<div id="shr" style="margin-top:20px;">
			<a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fmywayminiatures.com%2F" target="blanc"><img src="<?=base_url()?>/template/client/images/facebook.png" style="float:left; margin-left:15px;"alt=""/></a>
			<a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fmywayminiatures.com%2F" target="blanc"><img src="<?=base_url()?>/template/client/images/vk.png" style="float:left; margin-left:15px;"alt=""/></a>
			<a href="https://plus.google.com/share?url=http%3A%2F%2Fmywayminiatures.com%2F" target="blanc"><img src="<?=base_url()?>/template/client/images/google.png" style="float:left; margin-left:15px;"alt=""/></a>
			<a href="http://twitter.com/share?url=http%3A%2F%2Fmywayminiatures.com%2F" target="blanc"><img src="<?=base_url()?>/template/client/images/tw.png" style="float:left; margin-left:15px;"alt=""/></a>
		</div>
	</div>
	
	<div id="view">
		<div class="title">
			VIEWED
		</div>
		<section style="margin-top:17px;">
			<a href=""><img src="<?=base_url()?>download/images/catalog_small/<?=$viewed->img->url?>" alt=""/></a>
			<div class="price"><?=$viewed->price?> &euro;</div>
			<div class="fig_name"><?=$viewed->title?></div><br/><br/>
			<div class="add_to">
				add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;" onclick="add_to_cart('<?=$item->id?>', 1); return false">cart</a><a href="">wish list</a>
			</div>
		</section>
	</div>
	</aside>