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
					
					<section class="page__content" style="padding-left: 21px;">
					
						<header class="page__header">
							<h1 class="page__title"><?=$title?></h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						
						<div class="projects" style="height: 466px;">
							<ul class="projects__list">
								
								<?for($i = 0; $i < count($content); $i+=1): $c = $content[$i];?>
									<li class="projects__item projects-item" style="clear: both;">
										<?if(!empty($c->img->catalog_small_url)):?>
											<div style='text-align: right;float: right;margin-right: 0px;'>
											<a href="<?=$c->full_url?>" class="projects-item__image-box" style="width: 590px;margin-right: 0px">
												<img src="<?=$c->img->catalog_big_url?>" height="456" alt="project" class="projects-item__image no-hover-image" style='margin-bottom: 10px;' />
											</a>
											</div>
										<?endif;?>
									</li> <!-- /.projects__item projects-item -->
								<?endfor;?>
								
							</ul> <!-- /.projects__list -->
						</div> <!-- /.projects -->
						<? $_counter = 0;
							foreach($content as $product): $product = $this->products->prepare_product($product); foreach ($product->img as $i => $p): if ($i == 0) continue;?>
									<?$_counter++?>
								<?endforeach;?>
								<?endforeach;?>
							
						<div class="<?= ($_counter > 5 ? 'thumbs-slider-3' : ($_counter == 5 ? 'thumbs-no-slider-5' : 'thumbs-no-slider')) ?>" style="">  
							<ul class="thumbs-slider__list" style="text-align: left;height: 130px;overflow-y: hidden;">
								<?$counter = 1?>
								<?foreach($content as $product): $product = $this->products->prepare_product($product); foreach ($product->img as $i => $p): if ($i == 0) continue;?>
									<li class="thumbs-slider__item" style="<?= $_counter <= 4 ? 'width: 76px;height: 130px;margin-right: 18px;margin-left:6px;' : 'margin-right: 2px;'?>">
										<a rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=product&amp;type=catalog&amp;product_id=<?=$product->id?>&amp;first_img=<?=$i-1?>&amp;title=<?=$product->name?>"  id="im_<?= $p->id?>" data-fancybox-type="iframe" class="thumbs-slider__href the-best__thumb modal-gallery-open" style="width:62px;padding-top: 15px;">
											<img src="<?=$p->catalog_small_v_url?>" alt="thumb" class="thumbs-slider__image hover-image-v" />
										</a>
									</li> <!-- /.thumbs-slider__item -->
									<?$counter++?>
								<?endforeach;?>
								<?endforeach;?>
							</ul> <!-- /.thumbs-slider__list -->

						</div> <!-- /.the-best__thumbs -->
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