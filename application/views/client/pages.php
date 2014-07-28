<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12">
			<div id="main_content" class="col_8">
				<?require 'include/breadcrumbs.php'?> 
				<?foreach($content as $page):?>
					<div class="cat-item col_4">
					<h6><a href="<?=base_url()?>product/<?=$page->url?>"><?=$page->title?></a></h6>
					<div><?=$page->full_text?></div>
					</div>
				<?endforeach;?>
				<div class="col_12">
					<?=$pagination?>
				</div>
			</div>
			<div class="col_4">
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>
