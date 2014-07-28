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
						<h6><a href="<?=base_url()?>catalog/<?=$category->url?>"><?=$category->title?></a></h6>
						<div><?=$category->cat_desc?></div>
					</div>
				<?endforeach;?>
			</div>
			<div class="col_4">
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>