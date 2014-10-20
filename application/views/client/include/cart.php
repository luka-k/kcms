<div id="attr-4" class="clearfix <?if($left_active == "filt-4"):?>active<?else:?>noactive<?endif;?>">
	<div id="attribut" class="clearfix">
		<div style="margin-bottom:5px;">Корзина:</div>
		<div class="cart">
			<?if($cart):?>
				<?foreach($cart as $item_id => $item):?>						
					<div class="<?=$item_id?>  clearfix">
						<div style="width:10%; float:left;"><?=$item['qty']?></div>
						<div style="width:85%; float:left;"><?=$item['name']?></div>
						<div style="width:5%; float:left; text-align:right;"><a href="#" onclick="delete_item('<?=$item_id?>')" class="delete">X</a></div>
					</div>
				<?endforeach;?>
				<div>
					<a href="<?=base_url()?>pages/cart">Оформить заказ</a>
				</div>
			<?else:?>	
				Ваша корзина пуста.
			<?endif;?>
		</div>
	</div>
</div>