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
						
						<section class="page__content" style="padding-left: 73px;">
							<header class="page__header">
								<h1 class="page__title"><?=$content->name?></h1><!-- /.page__title -->
							</header> <!-- /.page__header -->
							
							<div class="page__scroll">
								<div class="page__scroll-in">
							<div class="inside-navigation" style="padding-top: 0px;width: 580px;margin-left: 0px;">
								<ul id="newscarousel" class="jcarousel-skin-tango" style="margin-top: 0px;margin-left: 0;padding-left: 0px;list-style: none;width: 580px;">
									<?foreach($content->articles as $i => $a):?>
										<li>
											<?// var_dump($a);?>
											<p><a style="font-size: 14px;padding-bottom: 5px;" href="<?=$a->full_url?>"><?=$a->name?></a></p>
											<div class="icons">
												<?if(isset($a->has_video)):?>
													<span class="video_icon">&nbsp;</span>
												<?endif;?>
												<?if(isset($a->has_img)):?>
													<span class="photo_icon">&nbsp;</span>
												<?endif;?>
											</div>
											<!---<span class="video_icon">&nbsp;</span>-->
											
											<p class="acidYellow" style="margin-top: 5px;line-height: 5px;"><?=$a->date?><br>
											<?=$a->description?></p>
											<? if ( $i < count ($content->articles) - 1) : ?>
											<div style="width: 579px; height: 1px; margin-top: 15px; margin-bottom: 15px; background: url(/template/client/images/i/news-line.png)"></div>
											<? endif ?>
										</li>
									<?endforeach;?>
								</ul>
							</div> <!-- /.our-works -->
							</div> <!-- /.our-works -->
							</div> <!-- /.our-works -->
							
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