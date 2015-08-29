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
						<?if(isset($orders)):?>
							<table>
								<thead>
									<th width="5%">Id</th>
									<th width="15%">Продукт</th>
									<th width="15%">Имя</th>
									<th width="15%">Телефон</th>
									<th width="15%">E-mail</th>
									<th width="5%">Дата</th>
									<th width="30%">Сообщение</th>
								</thead>
								<tbody>
									<?$counter = 1?>
									<?foreach ($orders as $item):?>
										<tr <?if(($counter%2) == 0):?>class = "grey"<?endif;?>>
											<td><?=$item->id?></td>
											<td><?=$item->product_name?></td>
											<td><?=$item->name?></td>
											<td><?=$item->phone?></td>
											<td><?=$item->mail?></td>
											<td><?=$item->date?></td>
											<td><?=$item->message?></td>
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
		<?require 'include/footer.php'?>
	</body>
</html>