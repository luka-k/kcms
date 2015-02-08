<!DOCTYPE html>
<!--[if lte IE 9]>      <html class="no-js lte-ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->

<? require 'include/head.php' ?>

<body>
<!--[if lt IE 8]>
	<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
<![endif]-->

	<div class="main-box">
		<div class="main-box__cell">
			<div class="main-box__content">
				
				<? require 'include/header.php'?>
				
				<div class="page">
					
					<? require 'include/breadcrumbs.php' ?>
					
					<section class="page__content">
					
						<header class="page__header">
							<h1 class="page__title"><?=$title?></h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						
						<div id="bigGallery">
							<div id = "page0" style = 'display: block;'>
								<?foreach($content as $c):?>
									<div class="maxi">
										<a href="<?=$c->full_url?>" id="single_image0" class="group grouped_elements ttip0" name = "Квартира на Кирочной<span style = 'position:absolute; top:5px; right:60px;'>Перейти к просмотру: <a class ='greenLight' href='http://brightberry.ru/index.php?route=product/product&path=38_86&product_id=145'>Квартира на Кирочной</a></span>" title = "Квартира на Кирочной" rel="group1" title="">
											<img src="<?=$c->catalog_small_url?>" alt="img" class="maximg"  />
										</a>
									</div>
								<?endforeach;?>
							</div>
						</div>
						
						<?if(isset($description)):?>
							<div class="page__text"><?=$description?></div> <!-- /.page__text -->
						<?endif;?>
					</section> <!-- /.page__content -->
					
					<aside class="page__sidebar">
						<? require 'include/left-menu.php' ?>
					</aside> <!-- /.page__sidebar -->
				</div> <!-- /.page -->
		        
				<? require 'include/footer.php' ?>
			</div> <!-- /.main-box__content -->
		</div> <!-- /.main-box -->
	</div> <!-- /.main-box -->

	<? require 'include/modal.php' ?>
	<? require 'include/script.php' ?>

</body>
</html>