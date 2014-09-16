<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_12 clearfix">
				<div class="col_12">
					<h5>Личный кабинет</h5>
					
					<?if($cart <> NULL):?>
						<div class="col_8">
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
									<?foreach($cart as $item_id => $item):?>
										<tr id="<?=$item_id?>">
											<td><?=$counter?></td>
											<td><?=$item['title']?></td>
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
						</div>
						<div class="col_4">
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="order" action="<?=base_url()?>order/edit_order/"/>
								<div class="cart">
									<h5>Оформить заказ</h5>
									<input type="hidden" name="id" value="<?=$user->id?>"/>
									<input type="hidden" name="name" value="<?=$user->name?>"/>
									<input type="hidden" name="phone" value="<?=$user->phone?>"/>
									<input type="hidden" name="email" value="<?=$user->email?>"/>
									<input type="hidden" name="address" value="<?=$user->address?>"/>
									<?foreach($selects as $name => $select):?>
										<?require "include/editors/select.php"?>
									<?endforeach;?></br>
									<a href="#" class="button small" onClick="document.forms['order'].submit()">Оформить</a>
						</div>
					</form>							
						</div>
					<?endif;?>
					
					<?if(isset($orders)):?>
						<h5>Заказы</h5>
						<table>
							<thead>
								<th width="7%">Id</th>
								<th width="10%">Статус</th>
								<th width="30%">Товары</th>
								<th width="5%">Дата</th>
							</thead>
							<tbody>
							<?foreach ($orders as $order):?>
								<tr>
									<td><?=$order->order_id?></td>
									<td><?=$order->status?></td>
									<td>
										<table>
											<thead>
												<th width="70%">Наименование</th>
												<th width="15%">Цена</th>
												<th width="15%">Количество</th>
											</thead>
											<tbody>
												<?foreach($order->order_products as $product):?>
													<tr>
														<td><?=$product->product_name?></td>
														<td><?=$product->product_price?></td>
														<td><?=$product->order_qty?></td>
													</tr>
												<?endforeach;?>
											<tbody>
										</table>
									</td>
									<td><?=$order->date?></td>
								</tr>
							<?endforeach;?>
							</tbody>
						</table>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>