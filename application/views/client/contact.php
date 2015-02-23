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
							<h1 class="page__title">
								<?if(isset($content->name)):?>
									<?=$content->name?>
								<?else:?>
									<?=$content->article->name?>
								<?endif;?>
							</h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						
						<?if(isset($callback)):?>
							<div class="contactBox">
								<h6>Вы можете задать интересующие Вас вопросы заполнив форму связи:</h6>
								<span>Все поля обязательны для заполнения.</span>
								
								<form action="#" id="sbmt" method="post">
									<label>Ваше имя:</label><br />
									<input id="name" name="name" type="text" /><br />
									<label>Ваш e-mail:</label><br />
									<input id="email" name="email" type="text" /><br />
									<label>Ваше сообщение</label><br />
									<textarea id="question" name="question"></textarea><input class="formButton" onclick="submit_form()" type="button" value="Отправить" /> <input class="formButton" type="reset" value="Отмена" />&nbsp;
								</form>
							</div>	
							
						<?else:?>
							<div class="page__text page__scroll">
								<div class="page__scroll-in">
									<?=$content->article->description?>
									<h6>Карта проезда</h6>
									<!--Дабы не усложнять модель и контроллер считаем что последней загружена карта-->
									<a href="<?=$content->article->img[count($content->article->img)-1]->catalog_big_url?>" class="lightbox"><img src="<?=$content->article->img[count($content->article->img)-1]->catalog_small_url?>" alt=""/>
								</div> <!-- /.page__scroll-in -->
							</div> <!-- /.page__text page__scroll -->
						<?endif;?>
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