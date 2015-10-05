<!DOCTYPE html>

<html class="no-js">

<?require 'include/head.php'?>

<body>
	<?require 'include/header.php'?>

    <?require 'include/modal.php'?>

    <?require 'include/top-menu.php'?>
	
	<?require 'include/under_menu.php'?>
	
	<?require 'include/breadcrumbs.php'?>
	
	<div class="container">
		<div class="content">
			<div class="products_block">
				<h1 class="products">Публикации</h1>
				<div class="articles_category">
					<?foreach($categories as $c):?><a href="<?= $c->full_url?>" class="<?if($c->url == $category_select):?>active<?endif;?>"><?=$c->menu_name?></a><?endforeach;?>
				</div>
			</div> 
			
			<?foreach($content->articles as $art):?>
				<div class="articles"> 
					<div class="articles_image">
						<img src="<?= $art->img->publication_big_url?>">
					</div>
					<p class="info"><?= $art->date?> <span>/</span> <?= $art->parent_name?></p>
					<a href="<?= $art->full_url?>"><?= $art->name?></a>
					<span><?= $art->short_description?></span>
				</div>
			<?endforeach;?>
			
			<div class="articles_bottom">
				<div class="pagination">
					<?= $pagination?>
					<!--<a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">...</a>-->
				</div>
				<div class="subscribe"><a href="#">Подписаться</a></div>
				<div class="rss_articles"><a href="#"><img src="<?= IMGS_PATH?>rss.png"></a></div>
			</div>
		</div>
	</div>

	<?require 'include/prefooter.php'?>

    <?require 'include/footer.php'?>

</body>
</html>