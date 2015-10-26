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
					
					<section class="page__content" style="padding-left: 68px;">
					
						<header class="page__header">
							<h1 class="page__title"><?=$title?></h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						
						<div class="projects">
							<ul class="projects__list">
								
								<?foreach($content as $c):?>
									<li class="projects__item projects-item" onmouseover="$('#mp_objects_<?= $c->id?>').addClass('active')" onmouseout="$('#mp_objects_<?= $c->id?>').removeClass('active')">
										<?if(!empty($c->img)):?>
											<a href="<?=$c->full_url?>" class="projects-item__image-box">
												<img src="<?=$c->img->catalog_small_url?>" id="project<?= $c->id?>" alt="<?if(!empty($c->img->alt)):?><?= $c->img->alt?><?else:?><?= $c->name?><?endif;?>" class="projects-item__image hover-image" />
											</a>
										<?endif;?>
										
										<div class="projects-item__content">
											<h3 class="projects-item__title">
												<a href="<?=$c->full_url?>" class="projects-item__href"><?=$c->name?></a>
											</h3> <!-- /.projects-item__title -->
											
											<?if(isset($c->short_description)):?>
												<div class="projects-item__text">
													<?=$c->short_description?>
												</div> <!-- /.projects-item__text -->
											<?endif;?>
										</div> <!-- /.projects-item__content -->
									</li> <!-- /.projects__item projects-item -->
								<?endforeach;?>
							</ul> <!-- /.projects__list -->
						</div> <!-- /.projects -->
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