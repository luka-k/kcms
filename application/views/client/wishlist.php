<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div>
			<div class="left col_3">
				<? require 'include/left-menu.php'?>
			</div>
			<div id="main_content" class="col_9">
				<?if($wishlist):?>
					<div class="col_2">&nbsp;</div>
					<div class="col_3">Наименование</div>
					<div class="col_2">Артикул</div>
					<div class="col_2">Цена</div>
					<div class="col_1">Количество</div>
					<div class="col_2">&nbsp;</div>
					
					<?foreach($wishlist as $item):?>
						<div class="wishlist clearfix">
							<div class="col_2"><img src="<?=$item->img->url?>" alt=""/></div>
							<div class="col_3"><?=$item->name?></div>
							<div class="col_2"><?=$item->article?></div>
							<div class="col_2"><?=$item->price?><br/><span style="color:red"><?=$item->sale_price?></span></div>
							<div class="col_1"><input type="text" size="1" name="qty" id="qty-<?=$item->id?>" placeholder = "1"/></div>
							<div class="col_2">
								<div><a href="#" onclick="add_to_cart('<?=$item->id?>', $('#qty-<?=$item->id?>').val()); return false">в корзину</a></div>
								<div><a href="#" onclick="delete_from_wishlist('<?=$item->id?>')">удалить</a></div>
							</div>
						</div>	
					<?endforeach;?>
				<?else:?>
					<div class="col_12">
						Ваш вишлист пуст.
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>