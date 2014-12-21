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
			<? require 'include/nav/sub_nav.php'?>
			
			<h1 class="page__title"><?=$content->name?></h1>
			
			<?if($sub_template == "news"):?>
				<div class="page-news__categories inline-categories">
					<ul class="inline-categories__list skew">
						<?foreach($level_3 as $item):?>
							<li class="inline-categories__item">
								<a href="<?=$item->full_url?>" class="inline-categories__href"><?=$item->name?></a>
							</li> <!-- /.inline-categories__item -->
                        <?endforeach;?>
					</ul> <!-- /.inline-categories__inner -->
				</div> <!-- /.page-news__categories -->
				
				<div class="page__content">
					<div class="page-news__calendar">
						<img src="images/calendar.png" alt="calendar" />
					</div> <!-- /.page-news__calendar -->
					
					<div class="page-news__content">
						<?foreach($content->articles as $item):?>
							<div class="news-item">
								<div class="news-item__date"><?=$item->date?></div> <!-- /.news-item__date -->

								<h3 class="news-item__title">
									<a href="news-single.html"><?=$item->name?></a>
								</h3> <!-- /.news-item__title -->

								<div class="news-item__text"><?=$item->description?></div> <!-- /.news-item__text -->
							</div> <!-- /.news-item -->
						<?endforeach;?>

                        <div class="news__load load-link">
							<a href="#load" class="load-link__href">Еще новости</a>
						</div> <!-- /.news__load -->
					</div> <!-- /.page-news__content -->



		        </div> <!-- /.page__content -->
			<?else:?>
				<div class="page__content">
					<?=$content->description?>
				</div> <!-- /.page__content -->
			<?endif;?>
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	</body>
</html>

        
        