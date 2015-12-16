<!DOCTYPE html>
<!--[if lte IE 9]>      <html class="no-js lte-ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->

<? require 'include/head.php' ?>

<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">��� ������� �������! ����������,  <a rel="nofollow" href="http://browsehappy.com/">�������� ��� �������</a> ����� ������������ ��� ����������� �����.</p>
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
						<div class="projects <?if($is_catalog):?>catalog__content<?endif;?>">
							<ul class="projects__list">
								<? if (trim($content->description)): ?>
									<li style="padding-left: 21px;">
										<div  style="width: 585px; margin-bottom: 35px;">
											<?=$content->article->description?> 
								
											<?$object_images = array();?>
											<?if(isset($content->has_img)):?>
												<?$object_images = $content->img?>
											<?endif;?>
										</div>
									</li>
								<? endif?>
								<?
								$delta = 0;
								$firstimg_delta = $is_catalog ? 0 : 1;
								
								for($i = $hide_1st_image ? 1 : 0; $i-$delta < count($content->img); $i+=( $is_catalog ? 4 : 3)): $c = $content->img[$i-$delta];?>
									<li class="projects__item projects-item" style="height: <?= $is_catalog ? '194':'135'?>px;">
										<?if(!empty($c->catalog_small_url)):
												if ($c->caption) $c->catalog_small_url=$c->video_url;?>
											
												<a rel="nofollow" 
													href="<?=base_url()?>popup_gallery/view?action=news&amp;nolinks=1&amp;product_id=<?=$c->object_id?>&amp;object_type=<?=$c->object_type?>&amp;first_img=<?=$i?>&amp;title=<?=$content->article->name?>"  
													id="im_<?= $c->id?>" 
													data-fancybox-type="iframe" 
													title="<?if(!empty($c->title)):?><?= $c->title?><?else:?><?= $content->name?><?endif;?>"
													class="projects-item__image-box modal-gallery-open">
													
													<img src="<?=$c->catalog_small_url?>" id="project1" alt="<?if(!empty($c->alt)):?><?= $c->alt?><?else:?><?= $content->name?><?endif;?>" class="projects-item__image hover-image" style="width: 161px;" />
												</a>
											
												<? if ($i+1 < count($object_images)): $c = $object_images[$i+1]; 
													if ($c->caption) $c->catalog_small_url=$c->video_url;?>
												
													<a rel="nofollow" 
														href="<?=base_url()?>popup_gallery/view?action=news&amp;nolinks=1&amp;product_id=<?=$c->object_id?>&amp;object_type=<?=$c->object_type?>&amp;first_img=<?=$i+1?>&amp;title=<?=$content->article->name?>"  
														id="im_<?= $c->id?>" 
														data-fancybox-type="iframe" 
														class="projects-item__image-box modal-gallery-open" 
														title="<?if(!empty($c->title)):?><?= $c->title?><?else:?><?= $content->name?><?endif;?>"
														style="margin-left: 68px;">
														
														<img src="<?=$c->catalog_small_url?>" id="project1" alt="<?if(!empty($c->alt)):?><?= $c->alt?><?else:?><?= $content->name?><?endif;?>" class="projects-item__image hover-image" style="width: 161px;" />
													</a>
												
													<? if ($i+2 < count($object_images)): $c = $object_images[$i+2]; 
														if ($c->caption) $c->catalog_small_url=$c->video_url;?>
													
														<a rel="nofollow" 
															href="<?=base_url()?>popup_gallery/view?action=news&amp;nolinks=1&amp;product_id=<?=$c->object_id?>&amp;object_type=<?=$c->object_type?>&amp;first_img=<?=$i+2?>&amp;title=<?=$content->article->name?>" 
															id="im_<?= $c->id?>" 
															data-fancybox-type="iframe" 
															class="projects-item__image-box last modal-gallery-open" 
															title="<?if(!empty($c->title)):?><?= $c->title?><?else:?><?= $content->name?><?endif;?>"
															style="margin-left: 68px;">
															
															<img src="<?=$c->catalog_small_url?>" id="project1" alt="<?if(!empty($c->alt)):?><?= $c->alt?><?else:?><?= $content->name?><?endif;?>" class="projects-item__image hover-image" style="width: 161px;" />
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