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
								<? if ($category->description):?>
									<li class="" style="padding-left: 21px;">
									<div style="width: 585px;margin-bottom: 30px;">
									<?= $category->description ?>
									</div>
									</li> <!-- /.projects__item projects-item -->
								<? endif?>
								<?for($i = 0; $i < count($content); $i+=3): $c = $content[$i];?>
									<li class="projects__item projects-item" style="height: 148px;">
										<?if(!empty($c->catalog_small_url)):?>
											<a rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=category&amp;category_id=<?=$category_id?>&amp;first_img=<?=$i+1?>&amp;title=<?=$title?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open">
												<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image"  style="width: 161px;"/>
											</a>
											<? if ($i+1 < count($content)): $c = $content[$i+1];?>
												<a rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=category&amp;category_id=<?=$category_id?>&amp;first_img=<?=$i+2?>&amp;title=<?=$title?>" id="im_<?= $c->id?>"  data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open" style="margin-left: 68px;">
													<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image" style="width: 161px;" />
												</a>
												<? if ($i+2 < count($content)): $c = $content[$i+2];?>
													<a rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=category&amp;category_id=<?=$category_id?>&amp;first_img=<?=$i+3?>&amp;title=<?=$title?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open" style="margin-left: 68px;">
														<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image" style="width: 161px;"/>
													</a>
												<? endif?>
											<? endif?>
										<?endif;?>
									</li> <!-- /.projects__item projects-item -->
								<?endfor;?>
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