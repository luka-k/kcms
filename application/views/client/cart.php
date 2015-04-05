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
										<button type="button"  class="button button--normal cart-amount__button" item_id="<?=$item_id?>">-</button>
										<input type="text" id="qty-<?=$item_id?>" class="form__input cart-amount__input" value="<?=$item->qty?>" disabled/>
										<button type="button" class="button button--normal cart-amount__button" item_id="<?=$item_id?>">+</button>
									</form> <!-- /.cart-amount -->
								</td>
								<td>
									<div class="cart-table__price"><span id="<?=$item_id?>"><?=$item->item_total?></span> р.</div> <!-- /.cart-table__price -->
								</td>
								<td>
									<button type="button" class="button button--normal" onclick="delete_item('<?=$item_id?>')">Удалить</button>
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
					
					<form action="<?=base_url()?>order/edit_order" class="form" method="post">
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
	<? require 'include/scripts.php'?>
	</body>
</html>







<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<div class="col_12">
					<h5>Корзина</h5>
					<?if($action == "order"):?>
						<?=$order_string?>
					<?else:?>
						<?if($cart_items <> NULL):?>
							<table>
								<thead>
									<th>№</th>
									<th>Наименование</th>
									<th>Цена</th>
									<th>Количество</th>
									<th>Сумма</th>
									<th>Удалить</th>
								</thead>
								<tbody>
									<?$counter = 1?>
									<?foreach($cart_items as $item_id => $item):?>
										<tr id="<?=$item_id?>">
											<td><?=$counter?></td>
											<td><?=$item['name']?></td>
											<td><?=$item['price']?></td>
											<td><input type="text" name="qty_<?=$item_id?>" id="qty_<?=$item_id?>" value="<?=$item['qty']?>" onchange="update_cart('<?=$item_id?>', this.value);"/></td>
											<td><span id="item_total_<?=$item_id?>"><?=$item['item_total']?></span></td>
											<td><a href="#" onclick="delete_item('<?=$item_id?>');"><i class="icon-minus-sign icon-2x"></i></a></td>
										<tr>
										<?$counter++?>
									<?endforeach;?>
								</tbody>
								<tfoot>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th><span id="total_qty"><?=$total_qty?></span></th>
									<th><span id="total_price"><?=$total_price?></span></th>
									<th>&nbsp;</th>
								</tfoot>
							</table>
						<?else:?>
							Ваша корзина пуста.
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div id="main_content" class="col_4">
				<?if($cart_items <> NULL):?>
					<div class="col_12">
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="order" action="<?=base_url()?>order/edit_order/"/>
							<div class="cart">
								<h5>Быстрый заказ</h5>
								Имя:<br/>
								<input type="text" name="name" class="col_12"/></br>
								Телефон:<br/>
								<input type="text" name="phone" class="col_12"/></br>
								E-mail:<br/>
								<input type="text" name="email" class="col_12"/></br>
								Адрес:<br/>
								<input type="text" name="address" class="col_12"/></br>
								<?foreach($selects as $name => $select):?>
									<?require "include/editors/select.php"?>
								<?endforeach;?></br>
								<a href="#" class="button small" onClick="document.forms['order'].submit()">Оформить</a>
							</div>
						</form>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>