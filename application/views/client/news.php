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
						
						<section class="page__content">
							<header class="page__header">
								<h1 class="page__title"><?=$content->name?></h1> <!-- /.page__title -->
							</header> <!-- /.page__header -->
							
							<div class="inside-navigation">
								<ul id="newscarousel" class="jcarousel-skin-tango" style = "width: 580px;">
									<?foreach($content->articles as $a):?>
										<li>
											<span class="acidYellow"><?=$a->date?></span>
											<a href="<?=$a->full_url?>"><?=$a->name?></a>
											<?=$a->description?>
										</li>
									<?endforeach;?>
								</ul>
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