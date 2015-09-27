<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div id="left_col" class="col_3 back" style="padding-top:15px;">
					<div id="datepicker"></div>
				</div>
				<div  class="col_9 clearfix" style="margin-top:-5px">
					<div class="col_12">
						<h5 style="margin-top:0;">Заказы</h5>
						<?if(isset($orders_info)):?>
						
						<table>
							<thead>
								<th width="5%">Дата</th>
								<th width="55%">Состав заказа</th>
								<th width="40%">Информация</th>
							</thead>
							<tbody>
								<?$counter = 1?>
								<?foreach ($orders_info as $order_item):?>
									<tr <?if(($counter%2) == 0):?>class = "grey"<?endif;?>>
										<td><?=$order_item->order_date?></td>

										<td>
											<?if(empty($order_item->order_products)):?>
												<table>
													<thead>
														<th width="80%">Операция</th>
														<th width="20%">Сумма</th>
													</thead>
													<tbody>
														<tr>
															<td><?=$order_item->operation?></td>
															<td><?=$order_item->summ?></td>
														</tr>
													<tbody>
												</table>
											<?else:?>
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
											<?endif;?>
										</td>

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
		<script>
			$(function() {
				$("#datepicker" ).datepicker({
					onSelect:function(dateText){
						document.location.replace('/admin/admin_orders?date='+dateText);
					}
				});
			});
		</script>
		<?require 'include/footer_script.php'?>
		<?require 'include/orders_script.php'?>
		<?require 'include/footer.php'?>
	</body>
</html>