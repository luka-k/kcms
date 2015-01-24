<div class="clearfix">
<ul class="top-menu clearfix">
	<?foreach($top_menu as $item):?>
		<li <?if ($item[2] == 1):?> class="current"<?endif;?>><a href="<?=$item[1]?>"><?=$item[0]?></a>
			<?php if(!empty($item[3])):?>
				<ul>
					<?foreach($item[3] as $sub_item):?>	
						<li><a href="<?=$sub_item[1]?>"><?=$sub_item[0]?></a></li>
					<?endforeach;?>
				</ul>
			<?php endif;?>
		</li>
	<?endforeach;?>
		<li>
			<div class="top-cart clearfix">
				<a href="<?=base_url()?>pages/cart">
				<div style="float:left"><img src="<?=base_url()?>template/client/images/cart_2.png"/><span class="total_qty"><?=$total_qty?></span> <?=$product_word?></div>
				<div style="float:left">&nbsp;на сумму: <span class="total_price"><?=$total_price?></span> евро.</div>
				</a>
			</div>
		</li>
</ul>


</div>