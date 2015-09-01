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
	<div class="page page-contacts">
		<div class="page__wrap wrap">
			<h1 class="page__title">Карта сайта</h1>
			
			<ul>
				<?foreach($content as $c):?>
					<li><a href="<?=$c->full_url?>"><?=$c->name?></a></li>
				<?endforeach;?>
			</ul>
		</div>
	</div>

	<? require 'include/footer.php' ?>
	<? require 'include/modal.php'?>

    </body>
</html>