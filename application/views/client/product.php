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
					
					<? require 'include/breadcrumbs.php'?>
					
					<section class="page__content project">
					
						<header class="page__header">
							<h1 class="page__title"><?=$content->name?></h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						
						<div class="page__text page__scroll project__text">
							<div class="page__scroll-in">
								<!---<img src="uploads/projects/houses/pushkin/1-305x203.jpg" alt="img" style="float: left; margin: 0 20px 0 0;" />-->
								<?if(!empty($content->img)):?><img src="<?=$content->img[0]->catalog_big_url?>" alt="img" style="float: left; width:305px; margin: 0 20px 0 0;" /><?endif;?>
								<?=$content->description?>
							</div> <!-- /.page__scroll-in -->
						</div> <!-- /.page__text project__text -->
						
						<div class="project__images thumbs-slider">
							<ul class="thumbs-slider__list">
								<?foreach($content->img as $image):?>
				        			
				        			<li class="thumbs-slider__item">
				        				
				        				<a href="<?=base_url()?>popup_gallery/view?action=product&product_id=<?=$content->id?>&first_img=<?=$image->id?>" class="thumbs-slider__href modal-gallery-open" data-fancybox-type="iframe">
				        					<img src="<?=$image->catalog_small_url?>" alt="thumb" class="thumbs-slider__image hover-image" />
				        				</a>

				        			</li> <!-- /.thumbs-slider__item -->
								<?endforeach;?>
							</ul> <!-- /.thumbs-slider__list -->
						</div> <!-- /.project-images -->
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