<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12">
			<div id="main_content" class="col_8">
				<? require 'include/breadcrumbs.php'?> 
				<? foreach ($content as $news):?>
					<div class="news-item col_12">
						<h6><?=$news->title?></h6>
						<div class="text">
							<?=$news->prev_text?>
						</div>
						<div class="more">
							<a href="<?=base_url()?>news/<?=$news->url?>">Подробнее...</a>
						</div>
					</div>
				<? endforeach?>
			</div>
			<div class="col_4">
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>