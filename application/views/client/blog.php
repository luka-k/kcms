<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12">
			<div id="main_content" class="col_8">
				<? require 'include/breadcrumbs.php'?> 
				<? foreach ($content as $blog):?>
					<div class="blog-item col_12">
						<h6><?=$blog->title?></h6>
						<div class="date"><?=$blog->date?></div>
						<div class="text">
							<?=$blog->prev_text?>
						</div>
						<div class="more">
							<a href="<?=base_url()?>blog/<?=$blog->url?>">Подробнее...</a>
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
