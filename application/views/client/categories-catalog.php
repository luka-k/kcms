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
						
						<div class="projects" style="overflow-x: hidden;">
							<ul class="projects__list">
								
								<?for($i = 0; $i < count($content); $i+=3): $c = $content[$i];?>
									<li class="projects__item projects-item">
										<?if(!empty($c->img[0]->catalog_small_url)):?>
											<div style='text-align: center;float: left;width: 172px;height: 160px;'>
											<a onmouseover="$('#mp_objects_<?= $c->id?>').addClass('active')" onmouseout="$('#mp_objects_<?= $c->id?>').removeClass('active')" href="<?=$c->full_url?>" style="width: 169px;" class="projects-item__image-box">
												<img src="<?=$c->img[0]->catalog_small_url?>" id="project<?= $c->id?>" alt="project" class="projects-item__image hover-image2" style='margin-bottom: 10px;width: 165px;' />
														<?= $c->name?>
											</a>
											</div>
											<? if ($i+1 < count($content)): $c = $content[$i+1];?>
											<div style='text-align: center;float: left;width: 172px;height: 160px;'>
												<a onmouseover="$('#mp_objects_<?= $c->id?>').addClass('active')" onmouseout="$('#mp_objects_<?= $c->id?>').removeClass('active')"  href="<?=$c->full_url?>" class="projects-item__image-box" style="margin-left: 37px;width: 169px;">
													<img src="<?=$c->img[0]->catalog_small_url?>" id="project<?= $c->id?>" alt="project" class="projects-item__image hover-image2" style='margin-bottom: 10px;width: 165px;' />
													<?= $c->name?>
												</a>
											</div>
												<? if ($i+2 < count($content)): $c = $content[$i+2];?>
											<div style='text-align: center;float: left;width: 172px;height: 160px;'>
													<a onmouseover="$('#mp_objects_<?= $c->id?>').addClass('active')" onmouseout="$('#mp_objects_<?= $c->id?>').removeClass('active')" href="<?=$c->full_url?>" class="projects-item__image-box" style="margin-left: 74px;width: 169px;margin-right: 0px;">
														<img src="<?=$c->img[0]->catalog_small_url?>" id="project<?= $c->id?>" alt="project" class="projects-item__image hover-image2" style='margin-bottom: 10px;width: 165px;' />
														<?= $c->name?>
													</a>
											</div>
												<? endif?>
											<? endif?>
										<?endif;?>
									</li> <!-- /.projects__item projects-item -->
								<?endfor;?>
								
							</ul> <!-- /.projects__list -->
						</div> <!-- /.projects -->
						
						<? /*
						<div class="thumbs-slider-2" style="">
							<ul class="thumbs-slider__list" style="text-align: left;">
								<?$counter = 1?>
								<?foreach($products as $p):?>
									<li class="thumbs-slider__item" style="width: 126px;margin-right: 15px;">
										<a href="<?= $p->full_url?>" class="thumbs-slider__href the-best__thumb">
											<img src="<?=$p->img->catalog_small_url?>" alt="thumb" class="thumbs-slider__image hover-image" />
										</a>
									</li> <!-- /.thumbs-slider__item -->
									<?$counter++?>
								<?endforeach;?>
							</ul> <!-- /.thumbs-slider__list -->

						</div> <!-- /.the-best__thumbs -->
						*/ ?>
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