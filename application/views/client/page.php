<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12">
			<div id="main_content" class="col_8">
				<? require 'include/breadcrumbs.php'?> 
				<div class="col_12">
					<h6><?=$content->title?></h6>
					<div><?=$content->description?></div>
					<?if($content->img <> NULL):?>
						<div>
							<?foreach($content->img as $img_item):?>
								<img src="<?=base_url()?>download/images/catalog_mid<?=$img_item->url?>" />
							<?endforeach?>
						</div>
					<?endif;?>					
				</div>
			</div>
			<div class="col_4">
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>