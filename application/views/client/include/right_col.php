<aside id="right">
	<div id="cart">
		<div class="title">
			CART
		</div>
		<div id="cart_items" class="clearfix">
			<?if($cart == NULL):?>
				No products
			<?else:?>
				<?foreach($cart as $item_id => $item):?>
					<div id="<?=$item_id?>" class="cart_item" >
						<div class="cart_item_name">
							<?if($item['qty']>1):?><span class="qty-<?=$item_id?>"><?=$item['qty']?></span>x<?endif;?>
							<?=$item['title']?></div> 
						<span class="cart_price"><a href="#" onclick="delete_item('<?=$item_id?>')"><img src="<?php echo base_url()?>template/client/images/item_clear.png"></a><?=$item['price']?> &euro;</span>
					</div>				
				<?endforeach;?>
			<?endif;?>
		</div>
		
		<div id="cart_total">
			<?if($cart <> NULL):?><div class="total_item">Shipping <span class="cart_price">5 &euro;</span></div><?endif;?>
			<div class="total_item">Total <span class="cart_price"><span class='total_price'><?=$total_price?></span> &euro;</span></div>
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
			<a href=""><img src="images/facebook.png" style="float:left; margin-left:15px;"alt=""/></a>
			<a href=""><img src="images/vk.png" style="float:left; margin-left:15px;"alt=""/></a>
			<a href=""><img src="images/google.png" style="float:left; margin-left:15px;"alt=""/></a>
			<a href=""><img src="images/tw.png" style="float:left; margin-left:15px;"alt=""/></a>
		</div>
	</div>
	
	<div id="view">
		<div class="title">
			VIEWED
		</div>
		<section style="margin-top:17px;">
			<a href=""><img src="<?php echo base_url()?>template/client/images/ronin/ronin1.jpg" alt=""/></a>
			<div class="price">9 &euro;</div>
			<div class="fig_name">NAME</div><br/><br/>
			<div class="add_to">
				add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
			</div>
		</section>
	</div>
	</aside>