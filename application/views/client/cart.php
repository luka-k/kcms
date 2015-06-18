<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	
	<body>
			<? require 'include/header.php'?>
		
			<div id="wrapper">
				<div class="section maxw">
					<div class="mainwrap">
						<main class="cart">
							<article>
								<div style="height: 700px; overflow-y: scroll;">
									
									<? require 'include/breadcrumbs.php' ?>
									<div style="clear: both;"></div>
									<div class="cart">
										<?if(!empty($action)):?>
											Ваш заказ успешно оформлен.
										<?else:?>
											<?if(!empty($cart_items)):?>
												<div class="cart_products">
													<table class="cart-table">
														<thead>
															<tr>
																<th class="col_1">№</th>
																<th class="col_2">Наименование</th>
																<th class="col_3">Цена</th>
																<th class="col_4">Количество</th>
																<th class="col_5">Сумма</th>
																<th class="col_6">Удалить</th>
															</tr>
														</thead>
														<tbody>
															<?$cart_counter = 1?>
															<?foreach($cart_items as $item_id => $item):?>
																<tr id="cart-<?=$item_id?>">
																	<td class="counter col_1"><?=$cart_counter?></td>
																	<td class="col_2"><a href="<?=$item->full_url?>" class="cart-table_name"><?=$item->name?></a></td>
																	<td class="col_3">
																		<div class="cart-table__price"><?=$item->price?> р.</div>
																	</td>
																	<td class="col_4">
																		<input type="text" id="qty-<?=$item_id?>" class="" onchange="update_cart('<?=$item_id?>', this.value); return false;" value="<?=$item->qty?>" />
																	</td>
																	<td class="col_5">
																		<div class="cart-table__price"><span id="<?=$item_id?>-qty"><?=$item->item_total?></span> р.</div> <!-- /.cart-table__price -->
																	</td>
																	<td class="col_6">
																		<a href="#" class="cart-delete" onclick="delete_item('<?=$item_id?>')">x</a>
																	</td>
																</tr>
															<?endforeach;?>
															<?$cart_counter++?>
															<tr>
																<td></td>
																<td></td>
																<td></td>
																<td class="total"><span class="total_qty"><?=$total_qty?></td>
																<td class="total"><span class="total_price"><?=$total_price?></span> р.</td>
																<td></td>
															</tr>
														</tbody>
													</table>
												</div>
												
												<div class="page-cart__order">
													<div class="cart-order">
					
													<form action="<?=base_url()?>shop/order/edit_order" id="order_form" class="form" method="post">
													
														<input type="hidden" name="id"  value="<?if(isset($user->id)):?><?=$user->id?><?endif;?>"/>
														<input type="hidden" name="email"  value="<?if(isset($user->email)):?><?=$user->email?><?endif;?>"/>
														
														<div class="cart-order__form">
															<h2 class="cart-order_title">Быстрый заказ</h2>
															<div class="cart-collumn-1">
																
																<div class="form__line">
																	<input type="text" class="form__input required" name="name" data-id="name" data-necessarily="true" placeholder="Имя" value="<?if(isset($user->name)):?><?=$user->name?><?endif;?>"/>
																</div>
							
																<div class="form__line">
																	<input type="text" class="form__input required" name="phone" data-id="phone" data-necessarily="true" placeholder="Телефон" value="<?if(isset($user->phone)):?><?=$user->phone?><?endif;?>" />
																</div>
															
																<div class="form__line">
																	<input type="text" class="form__input" name="email" data-id="email" data-necessarily="true" placeholder="E-mail" value="<?if(isset($user->email)):?><?=$user->email?><?endif;?>" />
																</div>
				
																<div class="form__line">
																	<input type="text" class="form__input" name="address" data-id="address" data-necessarily="true" placeholder="Улица" value="<?if(isset($user->address)):?><?=$user->address?><?endif;?>" />
																</div>
															</div>
															
															<div class="cart-collumn-1">
																<select name="payment_id" class="dropdown">
																	<?foreach($selects['payment_id'] as $key => $select):?>
																		<option value="<?=$key?>"><?=$select?></option>
																	<?endforeach;?>
																</select>
																
																<select name="delivery_id" class="dropdown">
																	<?foreach($selects['delivery_id'] as $key => $select):?>
																		<option value="<?=$key?>"><?=$select?></option>
																	<?endforeach;?>
																</select>
															</div>
							
															<div class="cart-collumn-2">
																<div class="form__button cart-order__button">
																	<button type="submit" class="order-button" onclick="sub_form(); return false;">Оформить заказ</button>
																</div> 
															</div>
														</div> <!-- /.cart-order__form -->
													</form> <!-- /.form -->
												</div> <!-- /.cart-order -->
											</div> <!-- /.page-cart__order -->
										<?else:?>
											Корзина пуста
										<?endif;?>
									<?endif;?>
									</div>
								</div>
								<div style="clear: both;"></div>
							</article>
						</main>
					</div>
					
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>shop/catalog/" >
					<? require 'include/left-col.php'?>
				</form>
				</div>
			</div>
		
			<? if (empty($filters_checked)): ?><div id="shadow"></div><? endif ?>
		
	</body>
</html>