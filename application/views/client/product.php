<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12">
			<div id="main_content" class="col_8">
				<? require 'include/breadcrumbs.php'?> 
				<div class="col_12">
					<h6><?=$product->name?></h6>
					<div>Цена:<?=$product->price?></div>
					<?if(isset($product->sale_price)):?>
						<div>Цена со скидкой:<?=$product->sale_price?></div>
					<?endif;?>
					<div><?=$product->description?></div>
					<?if($product->img <> NULL):?>
						<div>
							<?foreach($product->img as $img_item):?>
								<img src="<?=$img_item->catalog_small_url?>" />
							<?endforeach?>
						</div>
					<?endif;?>					
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