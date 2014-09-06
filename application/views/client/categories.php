<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<?require 'include/breadcrumbs.php'?> 
				<?foreach($content as $category):?>
					<div class="cat-item col_4">
						<h6><a href="<?=base_url($category->full_url)?>"><?=$category->title?></a></h6>
						<?if($category->img <> NULL):?>
							<div>
								<a href="<?=base_url($category->full_url)?>">
									<img src="<?=base_url()?>download/images/catalog_mid<?=$category->img->url?>" />
								</a>
							</div>
						<?endif;?>
						<div><?=$category->description?></div>
					</div>
				<?endforeach;?>
			</div>
			<div class="col_4">
				<div class="cart">
					<h5>Корзина</h5>
					В корзине <?=$total_qty?> товаров.<br/>
					На сумму <?=$total_price?><br/>
					<a href="<?=base_url()?>/pages/cart">Оформить заказ</a>
				</div>
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>