<? require 'include/head.php' ?>

	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<?require 'include/breadcrumbs.php'?> 
				<?foreach($content as $page):?>
						<div class="cat-item col_4">
							<h6><a href="<?=$page->full_url?>"><?=$page->title?></a></h6>
							<?if($page->img <> NULL):?>
								<div>
									<a href="<?=$page->full_url?>">
										<img src="<?=$page->img->url?>" />
									</a>
								</div>
							<?endif;?>
							<div><?=$page->description?></div>
							<div class="left">
								<?=$page->price?>
							</div>
							<div class="right">
								<a href="#" class="button small red" onclick="add_to_cart(<?=$page->id?>)">В корзину</a>
							</div>
						</div>	
				<?endforeach;?>
			</div>
			<div class="col_4">
				<div class="cart">
					<h5>Корзина</h5>
					В корзине <span id="total_qty"><?=$total_qty?></span> товаров.<br/>
					На сумму <span id="total_price"><?=$total_price?></span><br/>
					<a href="<?=base_url()?>/pages/cart">Оформить заказ</a>
				</div>
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>
