<!DOCTYPE html>
<!--[if lte IE 9]>      
	<html class="no-js lte-ie9">
<![endif]-->

<!--[if gt IE 9]><!--> 
	<html> 
<!--<![endif]-->

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
						
						<section class="page__content" style="padding-left: 50px;">
							<header class="page__header">
								<h1 class="page__title"><?=$content->name?></h1> <!-- /.page__title -->
							</header> <!-- /.page__header -->
							
							<div class="page__scroll">
								<div class="page__scroll-in">
									<div class="inside-navigation" style="padding-top: 0px;width: 625px;margin-left: 7px;">
										<ul class="inside-navigation__list">
											<?foreach($content->articles as $a):?>
												
												<li class="inside-navigation__item" onmouseover="$('#m_objects_<?= $a->id?>').addClass('active')" onmouseout="$('#m_objects_<?= $a->id?>').removeClass('active')" style="margin-right: 50px;">
													<a href="<?=$a->full_url?>" class="inside-navigation__href">
														<?if(isset($a->img[0])):?><img src="/download/images<?=$a->img[0]->url?>" 
														data-hover-image="/download/images<?if(isset($a->img[1])):?><?=$a->img[1]->url?><?else:?><?=$a->img[0]->url?><?endif;?>" id="objects_<?= $a->id?>"
														alt="img" class="inside-navigation__image"/><?endif;?>
														<?=$a->name?>
													</a> <!-- /.inside-navigation__href -->
												</li> <!-- /.inside-navigation__item -->
											
											<?endforeach;?>
										</ul> <!-- /.our-works__list inside-navigation -->
									</div> <!-- /.our-works -->
								</div>
							</div>
							
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