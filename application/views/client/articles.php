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
	
	<div class="page page-about">
		<div class="page__wrap wrap">

			<h1 class="page__title"><?=$content->name?></h1>
			<div class="page__content">
				<?=$content->description?>
			</div> <!-- /.page__content -->

		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	
	<?if($sub_template == "news" || $sub_template == "single-news"):?><script src="<?=base_url()?>template/client/js/datepicker.js"></script><?endif;?>
	</body>
</html>

        
        