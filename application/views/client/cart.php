<?require_once 'include/head.php'?>
	
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
			<div id="breadcrumbs"><a href="">Home</a> > Order and Delivery</div>
			<div id="wrapper">
				<?require_once 'include/left_col.php'?>
				
				<div id="main-content">
					<div class="title">Check Out</div>
					<div id="content">
						<div style="text-align:center;"><span class="chec">Summary</span> > Login/Register(optional) > Address > Payment</div>
						
						<div id="checkout">
							<table cellspacing="0">
								<tr class="tbl-ttl">
									<td class="td-1">&nbsp;</td><td class="td-2">Name</td><td class="td-3">Art.</td><td class="td-4">Per Unit</td><td class="td-5">Qty</td><td class="td-6">Total</td>
								</tr>
								<?foreach($cart as $item_id => $item):?>
									<tr id="<?=$item_id?>" class="tbl-item">
										<td class="td-1"><a href=""><img src="images/ronin/ronin1.jpg" alt=""/></a></td>
										<td class="td-2"><?=$item['title']?></td>
										<td class="td-3"><span class="">SR01</span></td>
										<td class="td-4"><span class="unit-pr"><?=$item['price']?></span>&euro;</td>
										<td class="td-5"><input type="text" name="qty_<?=$item_id?>" id="qty_<?=$item_id?>" value="<?=$item['qty']?>" onchange="update_cart('<?=$item_id?>', this.value);"/></td>
										<td class="td-6">
											<div class="td-6">
												<span id="item_total_<?=$item_id?>"><?=$item['item_total']?></span>&euro;
												<span class="close" onclick="delete_item('<?=$item_id?>');">&nbsp;</span>
											</div>	
										</td>
									</tr>
								<?endforeach;?>
							</table>
						</div>
						<div id="overall" class="clearfix">
							<div class="total-left">
								<table>
									<tr>
										<td class="tt">In Total:</td>
										<td><span class="total_price"><?=$total_price?></span>&euro;</td>
									</tr>
									<tr>
										<td>Shipping:</td>
										<td><span class="shipping-price">6</span>&euro;</td>
									</tr>
								</table>
							</div>
			  <div class="total-right">
			    <div class="o-w-s">
                   Summary:
				</div>
				<div class="o-w-s-2">
				  <span id="total_price"><?=$total_price?></span>&euro;
				</div>
			  </div>
			</div>
			  <div class="proceed">
			    <input id="proceed_link" type="submit" name="" style="display:none">
				<span class="freak_link" onclick=proceed_link.click()>PROCEED</span>
			  </div>
		  </div>
		</div>
		<?require_once 'include/right_col.php'?>

	  </div>
		<?require_once 'include/footer.php'?>
    </div>	

<script>
$('ul .up').click(function() {
$(this).next().slideToggle().toggleClass('noactive');
$(this).toggleClass('up');
$(this).toggleClass('down');
});

$('ul .down').click(function() {
$(this).next().slideToggle().toggleClass('noactive');
$(this).toggleClass('down');
$(this).toggleClass('up');
});
</script>

  </body>
</html>