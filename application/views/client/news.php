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
			<?if($sub_template == "single-news"):?>
				<h1 class="page__title">Новости</h1>

				<!--<div class="page-news__categories inline-categories">
					<ul class="inline-categories__list skew">

							<li class="inline-categories__item">
								<a href="" class="inline-categories__href active"></a>
							</li> <!-- /.inline-categories__item -->

					<!--</ul> <!-- /.inline-categories__inner -->
				<!--</div> <!-- /.page-news__categories -->
				
				<div class="page__content">
					<div class="page-news__calendar">
						<div id="this_mounth" class="datepicker" category=""></div>
					</div> <!-- /.page-news__calendar -->
					
					<div class="page-news__content">
						<div class="news-item">
							<div class="news-item__date"><?=$content->date?></div> <!-- /.news-item__date -->
							<h1 class="news-item__title"><?=$content->name?></h1> <!-- /.news-item__title -->
							
							<div class="news-item__text">
								<?=$content->description?>
							</div> <!-- /.news-item__text -->
						
						</div> <!-- /.news-item -->
					</div> <!-- /.page-news__content -->
					
					<div class="page-news__images gallery">
						<?if(isset($content->img)):?>
							<?foreach($content->img as $image):?>
								<a href="<?=$image->full_url?>" class="gallery__href fancybox" data-fancybox-group="news">
									<img src="<?=$image->full_url?>" width="225" height="225" alt="images" class="gallery__image" />
								</a>
							<?endforeach;?>
						<?endif;?>
					</div> <!-- /.page-news__images -->

		        </div> <!-- /.page__content -->
			<?elseif($sub_template == "news"):?>
				<h1 class="page__title">Новости</h1>
				
				<!--<div class="page-news__categories inline-categories">
					<ul class="inline-categories__list skew">

							<li class="inline-categories__item">
								<a href="" class="inline-categories__href active"></a>
							</li> <!-- /.inline-categories__item -->

					<!--</ul> <!-- /.inline-categories__inner -->
				<!--</div> <!-- /.page-news__categories -->
				
				<div class="page__content">
					<div class="page-news__calendar">
						<div id="this_mounth" class="datepicker" category=""></div>
					</div> <!-- /.page-news__calendar -->
					
					<div class="page-news__content">
						<?foreach($content->articles as $item):?>
							<div class="news-item">
								<div class="news-item__date"><?=$item->date?></div> <!-- /.news-item__date -->

								<h3 class="news-item__title">
									<a href="<?=$item->full_url?>"><?=$item->name?></a>
								</h3> <!-- /.news-item__title -->

								<div class="news-item__text">
									<?=$item->description?>
								</div> <!-- /.news-item__text -->
							</div> <!-- /.news-item -->
						<?endforeach;?>

                        <!--<div class="news__load load-link">
							<a href="#load" class="load-link__href">Еще новости</a>
						</div>--> <!-- /.news__load -->
					</div> <!-- /.page-news__content -->



		        </div> <!-- /.page__content -->
			<?endif;?>
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	
	<?if($sub_template == "news" || $sub_template == "single-news"):?><script src="<?=base_url()?>template/client/js/datepicker.js"></script><?endif;?>
	</body>
</html>

        
        