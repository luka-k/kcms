<div id="cart-dropdown-wrapper">
	<nav id="menu1" class="cart-dropdown">
		<h2 class="shopping-cart-heading">Корзина</h2>
		<div class="cart-items">
			<div class="cart-items-list">			
				<ul class="items-list">
				<?if(!empty($cart_items)):?>
					<?foreach($cart_items as $item_id => $item):?>
						<li id="cart-<?= $item_id?>" class="media">
							<div class="clearfix book cart-book">
								<a href="<?= $item->full_url?>" class="media-left">
									<div class="book-cover-cart">
										<img width="90" height="136" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?=$item->img->catalog_small_url?>">
									</div>
								</a>
								<div class="media-body book-details">
									<div class="book-description">
										<h3 class="book-title"><a href="<?= $item->full_url?>"><?=$item->name?></a></h3>
										<p class="book-subtitle">автор <a href="<?= $item->full_url?>"><?=$item->autor?></a></p>
										<p class="price m-t-20"><?= $item->price?> р.</p>
									</div>
									<a href="#" class="button button--normal" onclick="deleteCartItem('<?=$item_id?>')">Удалить</a>
								</div>
								
							</div>
						</li>
					<?endforeach;?>	
				<?endif;?>
				</ul>
			</div>
			
			<div class="cart-item-footer" <? if(empty($cart_items)):?>style="display:none;"<?endif;?>>
				<h3 class='total text-center'>Итог:<span class="total_price"><?=$total_price?></span>р.</h3>
				
				<form action="<?=base_url()?>order/new_order" class="form" id="order_form" method="post">
					<input type="hidden" name="id"  value="<?if(isset($user->id)):?><?=$user->id?><?endif;?>"/>
						<div class="cart-order__form">
							<div class="form-group clearfix" style="margin-bottom:15px;">
								<label class="control-label col-sm-3 info-title" for="name">Имя</label>
								<div class="col-sm-9">
									<input id="name" class="form-control bookshop-form-control validate" type="text" name="name" value="<?if(isset($user->name)):?><?=$user->name?><?endif;?>">
								</div><!-- /.col -->
							</div><!-- /.form-group -->
							
							<div class="form-group clearfix" style="margin-bottom:15px;">
								<label class="control-label col-sm-3 info-title" for="email">Email</label>
								<div class="col-sm-9">
									<input id="email" class="form-control bookshop-form-control validate" type="text" placeholder="" name="email" value="<?if(isset($user->email)):?><?=$user->email?><?endif;?>">
								</div><!-- /.col -->
							</div><!-- /.form-group -->
							
							<div class="form-group clearfix" style="margin-bottom:15px;">
								<label class="control-label col-sm-3 info-title" for="phone">Телефон</label>
								<div class="col-sm-9">
									<input id="phone" class="form-control bookshop-form-control validate" type="text" placeholder="" name="phone" value="<?if(isset($user->phone)):?><?=$user->phone?><?endif;?>">
								</div><!-- /.col -->
							</div><!-- /.form-group -->
							
							<div class="form-group clearfix" style="margin-bottom:15px;">
								<label class="control-label col-sm-3 info-title" for="address">Адрес</label>
								<div class="col-sm-9">
									<input id="address" class="form-control bookshop-form-control validate" type="text" placeholder="" name="address" value="<?if(isset($user->address)):?><?=$user->address?><?endif;?>">
								</div><!-- /.col -->
							</div><!-- /.form-group -->
							
							<div class="proceed-to-checkout text-center">
								<button type="button" class="btn btn-primary btn-uppercase" onclick="submitForm('order_form'); return false;">ОФормить заказ</button>
							</div>
						</div> <!-- /.cart-order__form -->
					</form> <!-- /.form -->
				
				
			</div>
	
				<div id="cart_empty" style="text-align:center; padding:15px 0; <? if(!empty($cart_items)):?>display:none;<?endif;?>">
					Корзина пуста
				</div>
			
		</div>
	</nav>
</div>