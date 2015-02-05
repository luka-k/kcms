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
				
					<section class="page__content">
					
						<header class="page__header">
							<h1 class="page__title">Галерея (the best)</h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
							
						<div class="the-best">
							<div class="the-best__slider the-best-slider">
							
								<ul class="the-best-slider__list">
									<?foreach($gallery as $img):?>
										<li class="the-best-slider__item">
											<a href="gallery-door.html?2" class="the-best-slider__href modal-gallery-open" data-fancybox-type="iframe">
												<img src="<?=$img->catalog_big_url?>" alt="project" class="the-best-slider__image" />
											</a>
										</li> <!-- /.the-best-slider__item-->
									<?endforeach;?>									
								</ul> <!-- /.the-best-slider__list -->
							</div> <!-- /.the-best__slider the-best-slider -->
							
							<div class="the-best__thumbs thumbs-slider">
								<ul class="thumbs-slider__list">
									<?$counter = 1?>
									<?foreach($gallery as $img):?>
					        			<li class="thumbs-slider__item">
											<a href="#slide<?=$counter?>" class="thumbs-slider__href the-best__thumb">
												<img src="<?=$img->catalog_small_url?>" alt="thumb" class="thumbs-slider__image hover-image" />
					        				</a>
										</li> <!-- /.thumbs-slider__item -->
										<?$counter++?>
									<?endforeach;?>
								</ul> <!-- /.thumbs-slider__list -->

				        	</div> <!-- /.the-best__thumbs -->
						</div> <!-- /.the-best -->
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