<div class="product">
	<div class="product-price">
		<?if (!$item->price && !$item->sale_price):?>
			<p>Цена: <span class="no-price">по запросу</span></p>
		<?else:?>
			<?if ($item->price):?>
				<p>Цена розничная: <span class="cross-price"><?=$item->price?> р.</span> <span class="discount">-<?=$item->discount?>%</span></p>
			<? endif?>
			<p>Цена на сайте: <span class="top-price"><?=$item->sale_price?></span> р.</p>
		<?endif?>
		<p>Наличие: <span class="blue-label"><?=$item->qty ? 'на складе СПб' : 'по запросу'?></span></p>
		<p><a href="" onclick="add_to_cart('<?=$item->id?>', 1); return false;"><img src="/template/client/images/cartbtn.png" /></a></p>
	</div>
	<div class="product-image">
		<?if(isset($item->img)):?>
			<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_small_url?>" width="150" /></a>
		<?else:?>
			<a href="<?=$item->full_url?>"><img src="/download/images/catalog_small/n/o/no-photo-available.png" width="150" /></a>
		<?endif;?>
	</div>
	<div class="product-name">
		<a href="<?=$item->full_url?>">
			<strong>
				<?=$item->manufacturer_name?>
												
				<?= $item->collection_name ?>
												
				<?if(isset($item->sub_collections)):?>
					<?=$item->sub_collections?>
				<?endif;?>
												
				<?if(!empty($item->serie_name)):?>
					(<?=$item->serie_name?><?if(!isset($item->sub_series)):?>)<?endif;?>
				<?endif;?>
				<?if(isset($item->sub_series)):?>
					; <?=$item->sub_series?>)
				<?endif;?>
												
				<?=$item->sku?>
			</strong>
	
			<?= $item->sizes_string?>
		</a></br>
	
		<?foreach($item->color as $color):?>
			<?=$color->value?><?endforeach;
		if ($item->color && $item->material) echo '/';
		foreach($item->material as $material):?><?=$material->value?>
		<?endforeach;?>
												
		<?foreach($item->finishing as $finishing):?>
			<?=$finishing->value?><?endforeach;?><? if ($item->turn) echo ', ';?>
		<?foreach($item->turn as $turn):?>
			<?=$turn->value?>
		<?endforeach;?></br>

		<strong><?=$item->shortname->value?> </strong>
												
		<?foreach($item->shortdesc as $shortdesc):?>
			<?=$shortdesc->value?>
		<?endforeach;?>
		
		<? if ($item->discontinued):?>
			<? $date = explode(' ', $item->discontinued); $date = $date[0];?>
			<span style="display:inline-block">(Снято с производства <?= $date?>)</span>
		<?endif?>

		<div class="sale_desc">
			<? if ($item->sale):?>
				<strong><span style="color: red;">Распродажа!</span></strong>
			<?endif?>
		
			<? if ($item->description):?>
				(<?= $item->description ?>)
			<?endif?>
		</div>			
	</div>
</div>