<?require_once 'include/head.php'?>

<div id="parent" class="clearfix">
	<?require_once 'include/header.php'?>
	
	<div id="wrapper">
		<?require_once 'include/left_col.php'?>
		
		<div id="main-content">
			<div class="title">Orders Overview</div>
			
			<!--<div class="oo-text">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>-->
			<?if($new_orders_info):?>
				<div class="cur-ord clearfix">
					<div class="title-3">Current Orders</div>
					<div class="curent-ord clearfix">
				
						<table cellspacing="0">
							<tr class="tbl-ttl">
								<td class="td-1">Order number</td><td class="td-2">Payment date</td><td class="td-3">Cost.</td><td class="td-4">Status</td><td class="td-5">Tracking number</td>
							</tr>
						
							<?foreach($new_orders_info as $item):?>
								<tr class="tbl-item">
									<td class="td-1"><?=$item->order_id?></td>
									<td class="td-2"><?=$item->payment_date?></td>
									<td class="td-3">
										<span class="cost"><?=$item->total?></span>&euro; <span class="cost-detail"><a href="#" onclick="slide('<?=$item->order_id?>'); return false">(details)</a></span>
									</td>
									<td class="td-5"><span class="ord-stat"><?=$item->status?></span></td>
									<td class="td-4"><span class="tr-numb"><?=$item->tracking_number?></span></td>
								</tr>
								<tr id="detail-<?=$item->order_id?>" class="noactive">
									<td class="td-1"></td>
									<td colspan="4">
										<table style="text-align:left; margin-bottom:0px;">
											<thead>
												<th width="70%">Name</th>
												<th width="15%">Per Unit</th>
												<th width="15%">Qty</th>
											</thead>
											<tbody>
												<?foreach($item->order_products as $product):?>
													<tr>
														<td><?=$product->product_name?></td>
														<td><?=$product->product_price?></td>
														<td><?=$product->order_qty?></td>
													</tr>
												<?endforeach;?>
											<tbody>
										</table>
									</td>
								</tr>
							<?endforeach;?>
						</table>
					</div>
				</div>
			<?endif;?>
			<?if($history_orders_info):?>
				<div class="ord-history clearfix">
					<div class="title-3">Order History</div>
					<div class="ord-hist clearfix">
						<table cellspacing="0">
							<tr class="tbl-ttl">
								<td class="td-1">Order number</td><td class="td-2">Payment date</td><td class="td-3">Cost.</td>
							</tr>
							<?foreach($history_orders_info as $item):?>
								<tr class="tbl-item">
									<td class="td-1"><?=$item->order_id?></td>
									<td class="td-2"><?=$item->payment_date?></td>
									<td class="td-3"><span class="cost"><?=$item->total?></span>&euro; <span class="cost-detail"><a href="#" onclick="slide('<?=$item->order_id?>'); return false">(details)</a></span></td>
								</tr>
								<tr id="detail-<?=$item->order_id?>" class="noactive">
									<td class="td-1"></td>
									<td colspan="4">
										<table style="text-align:left; margin-bottom:0px;">
											<thead>
												<th width="70%">Name</th>
												<th width="15%">Per Unit</th>
												<th width="15%">Qty</th>
											</thead>
											<tbody>
												<?foreach($item->order_products as $product):?>
													<tr>
														<td><?=$product->product_name?></td>
														<td><?=$product->product_price?></td>
														<td><?=$product->order_qty?></td>
													</tr>
												<?endforeach;?>
											<tbody>
										</table>
									</td>
								</tr>
							<?endforeach;?>
						</table>
					</div>
				</div>
			<?endif;?>
		</div>
		<?require_once 'include/right_col.php'?>
	</div>
	<?require_once 'include/footer.php'?>
</div>	
</body>
</html>