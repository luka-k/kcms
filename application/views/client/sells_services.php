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
	<? require 'include/breadcrumbs.php'?>
	
	<div class="page page-dealers">
		<div class="page__wrap wrap">
			<? require 'include/nav/sub_nav.php'?>
			
			<h1 class="page__title">Продажи и сервис</h1>
			<?if($action == "list"):?>	
				<div class="page__content">
					<?foreach($sells_services as $s_s):?>
						<h3><?=$s_s->name?></h3>
						<div><?=$s_s->description?>
					<?endforeach;?>
				</div> <!-- /.page__content -->
			<?endif;?>
			
			<div id="map" class="page-services__map">
			
			</div> <!-- /.page-dealers__map -->
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	<? require 'include/dealers_script.php'?>

    </body>
</html>