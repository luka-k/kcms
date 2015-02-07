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
						
						<div class="inside-navigation">
							<ul class="inside-navigation__list">
								<?foreach($content as $c):?>
									
									 <li class="inside-navigation__item">
										<a href="<?=$c->full_url?>" class="inside-navigation__href">
											<?if(!empty($c->img)):?>
												<img src="<?=$c->img[0]->categories_url?>" alt="img" class="inside-navigation__image" 
													data-hover-image="<?if(isset($c->img[1])):?><?=$c->img[1]->categories_url?><?else:?><?=$c->img[0]->categories_url?><?endif;?>"/>
											<?endif;?>
											<?=$c->name?>
										</a> <!-- /.inside-navigation__href -->
									</li> <!-- /.inside-navigation__item -->
								<?endforeach;?>
							</ul> <!-- /.inside-navigation__list -->
						</div> <!-- /.inside-navigation -->
						
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