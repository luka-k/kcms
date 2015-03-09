<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<?require 'include/breadcrumbs.php'?> 
				
				<?if(isset($category->sub_categories) && (!empty($category->sub_categories))):?>
					<div class="col_12 clearfix">
						<h5>Подкатегории</h5>
						<?foreach($category->sub_categories as $s_c):?>
							<div class="cat-item col_2 center">
								<?if($s_c->img <> NULL):?>
									<div>
										<a href="<?=$s_c->full_url?>"><img src="<?=$s_c->img->catalog_small_url?>" alt=""/></a>
									</div>
								<?endif;?>
								<h6><a href="<?=$s_c->full_url?>"><?=$s_c->name?></a></h6>
							</div>
						<?endforeach;?>
					</div>
				<?endif;?>
				
				<div class="col_12 xlearfix">
					<h5>Товары</h5>
					<div class="col_12">
						Сортировать: 
						<a href="<?=$url?>&order=name&direction=asc">по имени &#9650;</a>&nbsp;
						<a href="<?=$url?>&order=name&direction=desc">по имени &#9660;</a>&nbsp;
						<a href="<?=$url?>&order=price&direction=asc">по цене &#9650;</a>&nbsp;
						<a href="<?=$url?>&order=price&direction=desc">по цене &#9660;</a>&nbsp;				
					</div>
			
					<?foreach($category->products as $p):?>
						<div class="product_item col_3">
							<h6><a href="<?=$p->full_url?>"><?=$p->name?></a></h6>
							<?if($p->img <> NULL):?>
								<div>
									<a href="<?=$p->full_url?>">
										<img src="<?=$p->img->catalog_small_url?>" />
									</a>
								</div>
							<?endif;?>
							<div><?=$p->description?></div>
							<div class="left">
								<div>Цена:<?=$p->price?></div>
								<?if(isset($p->sale_price)):?>
									<div>Цена со скидкой:<?=$p->sale_price?></div>
								<?endif;?>
							</div>
							<div class="right">
								<a href="#" class="button small red" onclick="add_to_cart(<?=$p->id?>); return false">В корзину</a>
								<a href="#" class="button small green" onclick="add_to_wishlist('<?=$p->id?>'); return false">В вишлист</a>
							</div>
						</div>	
					<?endforeach;?>
				</div>
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