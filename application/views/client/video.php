<!DOCTYPE html>
<!--[if lte IE 9]>      
	<html class="no-js lte-ie9">
<![endif]-->
<!--[if gt IE 8]><!--> 
	<html class="no-js">
<!--<![endif]-->

<? require 'include/head.php' ?>

<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->
	
	<? require 'include/header.php'?>
	<? require 'include/top-menu.php'?>
	
	<div class="main-videos" id="main-videos">
		<div class="main-videos__wrap wrap">
			<div class="main-videos__list">
				<?foreach($video as $video_item):?>
					<div class="main-videos__item"><iframe width="470" height="264" src="//www.youtube.com/embed/<?=$video_item->link?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></div> <!-- /.main-videos__item -->
				<?endforeach;?>
			</div> <!-- /.main-videos__list -->
		</div> <!-- /.main-videos__wrap wrap -->
	</div> <!-- /.main-videos -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	
    </body>
</html>