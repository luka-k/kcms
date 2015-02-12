<? require 'include/head.php' ?>

	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<?require 'include/breadcrumbs.php'?> 
				<div class="col_12">
					Сортировать: 
					<a href="<?=$url?>&order=name&direction=asc">по возрастанию имени</a>&nbsp;
					<a href="<?=$url?>&order=name&direction=desc">по убыванию имени</a>&nbsp;
					<a href="<?=$url?>&order=sort&direction=asc">по возрастанию sort</a>&nbsp;
					<a href="<?=$url?>&order=sort&direction=desc">по убыванию sort</a>&nbsp;				
				</div>
				<?foreach($products as $product):?>
						<div class="cat-item col_4">
							<h6><a href="<?=$product->full_url?>"><?=$product->name?></a></h6>
							<?if($product->img <> NULL):?>
								<div>
									<a href="<?=$product->full_url?>">
										<img src="<?=$product->img->catalog_small_url?>" />
									</a>
								</div>
							<?endif;?>
							<div><?=$product->description?></div>
							<div class="left">
								<div>Цена:<?=$product->price?></div>
								<?if(isset($page->sale_price)):?>
									<div>Цена со скидкой:<?=$page->sale_price?></div>
								<?endif;?>
							</div>
							<div class="right">
								<a href="#" class="button small red" onclick="add_to_cart(<?=$product->id?>); return false">В корзину</a>
								<a href="#" class="button small green" onclick="add_to_wishlist('<?=$product->id?>'); return false">В вишлист</a>
							</div>
						</div>	
				<?endforeach;?>
			</div>
			<div id="main_content" class="col_4">
				<div class="col_12">
					<h5>Каталог продукции</h5>
					<? require 'include/tree.php' ?>
				</div>
				<div class="col_12">
					<?require 'include/filters.php'?> 
				</div>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>
