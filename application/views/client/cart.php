<!DOCTYPE html>
<!--[if lte IE 9]>      
	<html class="no-js lte-ie9">
<![endif]-->
<!--[if gt IE 8]><!--> 
	<html class="no-js">
<!--<![endif]-->

<? require 'include/head.php' ?>

<body>

<!--[if lt IE 8]>
	<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
<![endif]-->

	<? require 'include/header.php'?>
	<? require 'include/top-menu.php'?>
	<? require 'include/breadcrumbs.php'?>
	
	<div class="page page-cart">
		<div class="page__wrap wrap">
		<?if(!empty($action)):?>
			Ваш заказ успешно оформлен.
		<?else:?>
			<h1 class="page__title">Корзина</h1> <!-- /.page__title -->
			<?if(!empty($cart_items)):?>
			<div class="page-cart__products">
				<table class="cart-table">
					<tbody>
						<tr>
							<th></th>
							<th>Наименование</th>
							<th>Цена</th>
							<th>Количество</th>
							<th>Стоимость</th>
							<th></th>
						</tr>
						
						<?foreach($cart_items as $item_id => $item):?>
							<tr id="cart-<?=$item_id?>">
								<td>
									<img src="<?=$item->img->catalog_small_url?>" alt="image" width="100" class="cart-table__image" />
								</td>
								<td>
									<a href="<?=$item->full_url?>" class="cart-table__name"><?=$item->name?></a>
								</td>
								<td>
									<div class="cart-table__price"><?=$item->price?></div> <!-- /.cart-table__price -->
								</td>
								<td>
									<form action="#" class="form cart-amount" method="post">
										<button type="button"  class="button button--normal cart-amount__button" onclick="update_qty('<?=$item_id?>', document.getElementById('qty-<?=$item_id?>').value, 'minus')">-</button>
										<input type="text" id="qty-<?=$item_id?>" class="form__input cart-amount__input" value="<?=$item->qty?>" disabled/>
										<button type="button" class="button button--normal cart-amount__button" onclick="update_qty('<?=$item_id?>', document.getElementById('qty-<?=$item_id?>').value, 'plus')">+</button>
									</form> <!-- /.cart-amount -->
								</td>
								<td>
									<div class="cart-table__price"><span id="item_total-<?=$item_id?>"><?=$item->item_total?></span> р.</div> <!-- /.cart-table__price -->
								</td>
								<td>
									<button type="button" class="button button--normal" onclick="delete_cart_item('<?=$item_id?>')">Удалить</button>
								</td>
							</tr>
						<?endforeach;?>
							
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td colspan="2">
								<div class="cart-table__price">
									Итого <span><span class="total_price"><?=$total_price?></span>р.</span>
								</div> <!-- /.cart-table__price -->
							</td>
							<td></td>
						</tr>
					</tbody>
				</table> <!-- /.cart-table -->
			</div> <!-- /.page-cart__products -->
			
			<div class="page-cart__order">
				<div class="cart-order">
					<h2 class="cart-order__title">Оформление заказа</h2> <!-- /.cart-order__title -->
					
					<form action="<?=base_url()?>order/new_order" class="form" method="post">
						<div class="cart-order__form">
							<input type="hidden" name="id"  value="<?if(isset($user->id)):?><?=$user->id?><?endif;?>"/>
							<input type="hidden" name="email"  value="<?if(isset($user->email)):?><?=$user->email?><?endif;?>"/>
							<div class="form__line">
								<input type="text" class="form__input required" name="name" placeholder="Имя" value="<?if(isset($user->name)):?><?=$user->name?><?endif;?>"/>
							</div> <!-- /.form__line -->
							
							<div class="form__line">
								<input type="tel" class="form__input required" name="phone" placeholder="Телефон" value="<?if(isset($user->phone)):?><?=$user->phone?><?endif;?>" />
							</div> <!-- /.form__line -->
							
							<a href="#extra" class="cart-order__extra-link">Дополнительно (необязательные поля)</a>
							
							<div class="cart-order__extra hidden" id="extra">
								<div class="form__line">
									<input type="text" class="form__input" name="email" placeholder="E-mail" value="<?if(isset($user->email)):?><?=$user->email?><?endif;?>" />
								</div> <!-- /.form__line -->
				
								<div class="form__line">
									<input type="text" class="form__input" name="address" placeholder="Улица" value="<?if(isset($user->address)):?><?=$user->address?><?endif;?>" />
								</div> <!-- /.form__line -->
							</div> <!-- /.cart-order__extra -->
							
							<div class="form__button cart-order__button">
								<button type="submit" class="button button--normal button--auto-width">Оформить заказ</button>
							</div> <!-- /.form__button -->
						</div> <!-- /.cart-order__form -->
					</form> <!-- /.form -->
				</div> <!-- /.cart-order -->
			</div> <!-- /.page-cart__order -->
			<?else:?>
				Корзина пуста
			<?endif;?>
		<?endif;?>
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	</body>
</html>