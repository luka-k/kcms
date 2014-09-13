<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div class="col_12">
						<h5>Заказы</h5>
						<?if(isset($orders_info)):?>
						<table>
							<thead>
								<th width="7%">Id</th>
								<th width="10%">Статус</th>
								<th width="30%">Товары</th>
								<th width="10%">Способ оплаты</th>
								<th width="10%">Способ доставки</th>
								<th width="5%">Дата</th>
								<th width="15%">Контанты</th>
							</thead>
							<tbody>
								<?foreach ($orders_info as $order_item):?>
									<tr>
										<td><?=$order_item->order_id?></td>
										<td>
											<select id="order_status"  name="order_status" class="col_12">
												<?php foreach ($selects['order_status'] as $key => $title): ?>
													<option value="<?=$key?>" <?if($key == $order_item->order_status):?>selected="selected"<?endif;?> >
														<?=$title?>
													</option>
												<?php endforeach ?>										
											</select>									
										</td>
										<td>
											<table>
												<thead>
													<th width="70%">Наименование</th>
													<th width="15%">Цена</th>
													<th width="15%">Количество</th>
												</thead>
												<tbody>
													<?foreach($order_item->order_products as $product):?>
														<tr>
															<td><?=$product->product_name?></td>
															<td><?=$product->product_price?></td>
															<td><?=$product->order_qty?></td>
														</tr>
													<?endforeach;?>
												<tbody>
											</table>
										</td>
										<td>
											<select id="method_pay"  name="method_pay" class="col_12">
												<?php foreach ($selects['method_pay'] as $key => $title): ?>
													<option value="<?=$key?>" <?if($key == $order_item->method_pay):?>selected="selected"<?endif;?> >
														<?=$title?>
													</option>
												<?php endforeach ?>										
											</select>										
										</td>
										<td>
											<select id="method_delivery"  name="method_delivery" class="col_12">
												<?php foreach ($selects['method_delivery'] as $key => $title): ?>
													<option value="<?=$key?>" <?if($key == $order_item->method_delivery):?>selected="selected"<?endif;?> >
														<?=$title?>
													</option>
												<?php endforeach ?>										
											</select>											
										</td>
										<td><?=$order_item->order_date?></td>
										<td>
											<div class="contacts">
												<div>Имя - <?=$order_item->name?></div>
												<div>Телефон - <?=$order_item->phone?></div>
												<div>e-mail - <?=$order_item->email?></div>
												<div>Адресс - <?=$order_item->address?></div>
											</div>
										</td>

									</tr>
								<?endforeach;?>
							</tbody>
						</table>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>
		<? require 'include/footer_scripth.php' ?>
		<? require 'footer.php' ?>
	</body>
</html>