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
					
					<section class="page__content">
					
						<header class="page__header">
							<h1 class="page__title"><?=$title?></h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						
						<div class="projects">
							<ul class="projects__list">
								
								<?foreach($content as $c):?>
									<li class="projects__item projects-item">
										<a href="<?=$c->full_url?>" class="projects-item__image-box">
				        					<img src="<?=$c->img->full_url?>" id="project1" alt="project" class="projects-item__image hover-image" />
				        				</a>
										
										<div class="projects-item__content">
											<h3 class="projects-item__title">
												<a href="<?=$c->full_url?>" class="projects-item__href"><?=$c->name?></a>
											</h3> <!-- /.projects-item__title -->
											
											<div class="projects-item__text">
												<?=$c->short_description?>
											</div> <!-- /.projects-item__text -->
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