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
					
					<section class="page__content " style="padding-left: 68px;">
					
						<header class="page__header">
							<h1 class="page__title"><?=$content->name?></h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						<div class="projects">
							<ul class="projects__list">
								<? if (trim($content->description)): ?>
									<li style="padding-left: 21px;">
										<div  style="width: 585px; margin-bottom: 35px;"><?=$content->description?></div>
									</li>
								<? endif?>
								<?
								$delta = 0;
								$firstimg_delta = $is_catalog ? 0 : 1;
								for($i = $hide_1st_image ? 1 : 0; $i-$delta < count($content->img); $i+=( $is_catalog ? 4 : 3)): $c = $content->img[$i-$delta];?>
									<li class="projects__item projects-item" style="height: <?= $is_catalog ? '194':'148'?>px;">
										<?if(!empty($c->catalog_small_url)):?>
											
										<?if (strstr($c->caption, 'youtube')) 
											$c->catalog_small_url=$c->video_url;
										elseif ($is_catalog)
											$c->catalog_small_url=$c->catalog_small_v_url;
										?>
										<span style="text-align: center;margin: 0 auto;" >
											<a rel="nofollow" style="<?= $is_catalog ? 'width:74px;margin-right: 70px;' : ''?>" href="<?=base_url()?>popup_gallery/view?action=product&amp;<?= $is_catalog ? 'type=catalog&amp;':''?>product_id=<?=$content->id?>&amp;first_img=<?=$i-$delta-1+$firstimg_delta?>&amp;title=<?=$content->name?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open">
												<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image" style="<?=$is_catalog?'':'width: 161px;'?>" /> <?=$is_catalog? $c->caption : '';?>
													</a></span>
											<? if (strstr($c->name, '@')) {$delta+=3; continue;}; if ($i-$delta+1 < count($content->img)): $c = $content->img[$i-$delta+1];?>
										<?if (strstr($c->caption, 'youtube')) 
											$c->catalog_small_url=$c->video_url;
										elseif ($is_catalog)
											$c->catalog_small_url=$c->catalog_small_v_url;
										?>
										<span style="text-align: center;margin: 0 auto;" >
											<a rel="nofollow" style="<?= $is_catalog ? 'width:74px;margin-right: 70px;' : 'margin-left: 68px;'?>" href="<?=base_url()?>popup_gallery/view?action=product&amp;<?= $is_catalog ? 'type=catalog&amp;':''?>product_id=<?=$content->id?>&amp;first_img=<?=$i-$delta+0+$firstimg_delta?>&amp;title=<?=$content->name?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open" >
													<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image" style="<?=$is_catalog?'':'width: 161px;'?>" /> <?=$is_catalog? $c->caption : '';?>
													</a></span>
												<? if (strstr($c->name, '@')) {$delta+=2; continue;}; if ($i-$delta+2 < count($content->img)): $c = $content->img[$i-$delta+2];?>
										<?if (strstr($c->caption, 'youtube')) 
											$c->catalog_small_url=$c->video_url;
										elseif ($is_catalog)
											$c->catalog_small_url=$c->catalog_small_v_url; 
										?>
										<span style="text-align: center;margin: 0 auto;" >
											<a rel="nofollow" style="<?= $is_catalog ? 'width:74px;margin-right: 70px;' : 'margin-left: 68px;'?>" href="<?=base_url()?>popup_gallery/view?action=product&amp;<?= $is_catalog ? 'type=catalog&amp;':''?>product_id=<?=$content->id?>&amp;first_img=<?=$i-$delta+1+$firstimg_delta?>&amp;title=<?=$content->name?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open">
											
														<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image" style="<?=$is_catalog?'':'width: 161px;'?>" /> <?=$is_catalog? $c->caption : '';?>
													</a></span>
												<? endif?>
											<? endif?>
											<? if ($is_catalog ): ?>
												<? if (strstr($c->name, '@')) {$delta+=1; continue;}; if ($i-$delta+3 < count($content->img)): $c = $content->img[$i-$delta+3];?>
													<?if (strstr($c->caption, 'youtube')) 
														$c->catalog_small_url=$c->video_url;
													elseif ($is_catalog)
														$c->catalog_small_url=$c->catalog_small_v_url;
													?>
													<span style="text-align: center;margin: 0 auto;" >
														<a rel="nofollow" style="<?= $is_catalog ? 'width:74px;margin-right: 60px;' : 'margin-left: 60px;'?>" href="<?=base_url()?>popup_gallery/view?action=product&amp;<?= $is_catalog ? 'type=catalog&amp;':''?>product_id=<?=$content->id?>&amp;first_img=<?=$i-$delta+2+$firstimg_delta?>&amp;title=<?=$content->name?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open">
																	<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image" style="" /> <?= $is_catalog? $c->caption : '';?>
																</a></span>
												<? endif?>
												<? endif;?>
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