<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div class="col_12">
						<h5>Заказы</h5>
						<?if(isset($orders_info)):?>
						<div class="col_12 clerfix">
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/admin_orders/index/by_order_code"/>
								Найти по номеру заказа <input type="text" name="order_code" onchange="document.forms['form1'].submit()"/>&nbsp;
								Показать со статусом: 
								<a href="<?=base_url()?>admin/admin_orders/">Все</a>&nbsp;
								<?foreach($selects['status_id'] as $key => $item):?>
									<a href="<?=base_url()?>admin/admin_orders/index/<?=$key?>"><?=$item?></a>&nbsp;
								<?endforeach;?>
							</form>
						</div>
						</br>
						<table>
							<thead>
								<th width="10%">Id</th>
								<th width="10%">Статус</th>
								<th width="30%">Товары</th>
								<th width="10%">Способ оплаты</th>
								<th width="10%">Способ доставки</th>
								<th width="5%">Дата</th>
								<th width="25%">Контанты</th>
							</thead>
							<tbody>
								<?$counter = 1?>
								<?foreach ($orders_info as $order_item):?>
									<tr <?if(($counter%2) == 0):?>class = "grey"<?endif;?>>
										<td><?=$order_item->order_code?></td>
										<td>
											<select id="status_id"  name="status_id" class="col_12" onchange="change_field('<?=$order_item->id?>', this.options[this.selectedIndex].value, this.id)">
												<?php foreach ($selects['status_id'] as $key => $title): ?>
													<option value="<?=$key?>" <?if($key == $order_item->status_id):?>selected="selected"<?endif;?> >
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
											<select id="payment_id"  name="payment_id" class="col_12" onchange="change_field('<?=$order_item->id?>', this.options[this.selectedIndex].value, this.id)">
												<?php foreach ($selects['payment_id'] as $key => $title): ?>
													<option value="<?=$key?>" <?if($key == $order_item->payment_id):?>selected="selected"<?endif;?> >
														<?=$title?>
													</option>
												<?php endforeach ?>										
											</select>										
										</td>
										<td>
											<select id="delivery_id"  name="delivery_id" class="col_12" onchange="change_field('<?=$order_item->id?>', this.options[this.selectedIndex].value, this.id)">
												<?php foreach ($selects['delivery_id'] as $key => $title): ?>
													<option value="<?=$key?>" <?if($key == $order_item->delivery_id):?>selected="selected"<?endif;?> >
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
								<?$counter++?>
								<?endforeach;?>
							</tbody>
						</table>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>
		<?require 'include/footer_script.php'?>
		<?require 'include/orders_script.php'?>
		<?require 'include/footer.php'?>
	</body>
</html>