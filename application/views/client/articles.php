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
	
	<div class="page page-<?if($sub_template == "news" || $sub_template == "single-news"):?>news<?else:?>about<?endif;?>">
		<div class="page__wrap wrap">
			<?if(isset($level_2)):?>
				<? require 'include/nav/sub_nav.php'?>
			<?endif;?>
			
	
			<?if($sub_template == "single-news"):?>
				<h1 class="page__title">Новости</h1>
				
				<div class="page-news__categories inline-categories">
					<ul class="inline-categories__list skew">
						<?foreach($level_3->items as $item):?>
							<li class="inline-categories__item">
								<a href="<?=$item->full_url?>" class="inline-categories__href <?if($level_3->active == $item->url):?>active<?endif;?>"><?=$item->name?></a>
							</li> <!-- /.inline-categories__item -->
                        <?endforeach;?>
					</ul> <!-- /.inline-categories__inner -->
				</div> <!-- /.page-news__categories -->
				
				<div class="page__content">
					<div class="page-news__calendar">
						<!--<img src="images/calendar.png" alt="calendar" />-->
						<div id="this_mounth" class="datepicker"></div>
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
				
				<div class="page-news__categories inline-categories">
					<ul class="inline-categories__list skew">
						<?foreach($level_3->items as $item):?>
							<li class="inline-categories__item">
								<a href="<?=$item->full_url?>" class="inline-categories__href <?if($level_3->active == $item->url):?>active<?endif;?>"><?=$item->name?></a>
							</li> <!-- /.inline-categories__item -->
                        <?endforeach;?>
					</ul> <!-- /.inline-categories__inner -->
				</div> <!-- /.page-news__categories -->
				
				<div class="page__content">
					<div class="page-news__calendar">
						<!--<img src="images/calendar.png" alt="calendar" />-->
						<div id="this_mounth" class="datepicker"></div>
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
			<?else:?>
				<h1 class="page__title"><?=$content->name?></h1>
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

        
        