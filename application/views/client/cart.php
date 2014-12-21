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
			<h1 class="page__title">Корзина</h1> <!-- /.page__title -->
			
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
							<tr>
								<td>
									<img src="<?=$item->img->url?>" alt="image" width="100" class="cart-table__image" />
								</td>
								<td>
									<a href="<?=$item->full_url?>" class="cart-table__name"><?=$item->name?></a>
								</td>
								<td>
									<div class="cart-table__price"><?=$item->price?></div> <!-- /.cart-table__price -->
								</td>
								<td>
									<form action="#" class="form cart-amount skew" method="post">
										<button type="button"  class="button button--normal cart-amount__button" item_id="<?=$item_id?>">-</button>
										<input type="text" id="qty-<?=$item_id?>" class="form__input cart-amount__input" value="1" disabled/>
										<button type="button" class="button button--normal cart-amount__button" item_id="<?=$item_id?>">+</button>
									</form> <!-- /.cart-amount -->
								</td>
								<td>
									<div class="cart-table__price"><span id="<?=$item_id?>"><?=$item->item_total?></span> р.</div> <!-- /.cart-table__price -->
								</td>
								<td>
									<button type="button" class="button button--normal skew" onclick="delete_item('<?=$item_id?>')">Удалить</button>
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
					
					<form action="#" class="form" method="post">
						<div class="cart-order__form">
							<div class="form__line skew">
								<input type="text" class="form__input required" name="name" placeholder="Имя" />
							</div> <!-- /.form__line -->
							
							<div class="form__line skew">
								<input type="tel" class="form__input required" name="phone" placeholder="Телефон" />
							</div> <!-- /.form__line -->
							
							<a href="#extra" class="cart-order__extra-link">Дополнительно (необязательные поля)</a>
							
							<div class="cart-order__extra hidden" id="extra">
								<div class="form__line skew">
									<textarea name="message" class="form__textarea" placeholder="Адрес доставки"></textarea>
								</div> <!-- /.form__line -->
							</div> <!-- /.cart-order__extra -->
							
							<div class="form__button cart-order__button skew">
								<button class="button button--normal button--auto-width">Оформить заказ</button>
							</div> <!-- /.form__button -->
						</div> <!-- /.cart-order__form -->
					</form> <!-- /.form -->
				</div> <!-- /.cart-order -->
			</div> <!-- /.page-cart__order -->
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	</body>
</html>