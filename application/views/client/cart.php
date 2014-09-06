+<? require 'include/head.php' ?>

<script>
	function updateCart(itemId){
		pars = new Object();
		pars.item_id = itemId;
		pars.qty = $('#qty_'+itemId).val();
		var json_str = JSON.stringify(pars);
		$.post ("/ajax/update_cart/", json_str, function(res) {
			
			$('#total_qty').text(res['total_qty']);
			$('#total_price').text(res['total_cart']);
			$('#item_total_'+itemId).text(res['item_total']);
		}, "json");
	}
</script>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_12 clearfix"> 
				<h5>Корзина</h5>
				<?if($cart<>NULL):?>
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
							<!--<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="#"/>-->
							<?foreach($cart as $item_id => $item):?>
								<tr>
									<td><?=$counter?></td>
									<td><?=$item['title']?></td>
									<td><?=$item['price']?></td>
									<td><input type="text" name="qty_<?=$item_id?>" id="qty_<?=$item_id?>" value="<?=$item['qty']?>" onchange="updateCart('<?=$item_id?>');"/></td>
									<td><span id="item_total_<?=$item_id?>"><?=$item['item_total']?></span></td>
									<td><a href="<?=base_url()?>/cart/delete_item/<?=$item_id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
								<tr>
							<?$counter++?>
							<?endforeach;?>
							<!--</form>--->
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
					
				<?else:?>
					Ваша корзина пуста.
				<?endif;?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>