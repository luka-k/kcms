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
						
						<table>
							<thead>
								<th width="10%">Id</th>

								<th width="30%">Состав заказа</th>
								<th width="5%">Дата</th>
								<th width="25%">Контанты</th>
							</thead>
							<tbody>
								<?$counter = 1?>
								<?foreach ($orders_info as $order_item):?>
									<tr <?if(($counter%2) == 0):?>class = "grey"<?endif;?>>
										<td><?=$order_item->id?></td>

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
															<td><?=$product->name?></td>
															<td><?=$product->price?></td>
															<td><?//=$product->qty?><?=$order_item->qty[$product->id]?></td>
														</tr>
													<?endforeach;?>
												<tbody>
											</table>
										</td>

										<td><?=$order_item->order_date?></td>
										<td>
											<div class="contacts">
												<div>Номер карты - <?=$order_item->card_number?></div>
												<div>Имя - <?=$order_item->child->full_name?></div>
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