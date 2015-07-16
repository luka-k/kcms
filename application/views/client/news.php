<!DOCTYPE html>

<?require 'include/head.php'?>

<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->
	
	<?require 'include/top-menu.php'?>

	
	<? require 'include/header.php'?>
        
	<div class="main-catalog" id="main-catalog">
		<div class="main-catalog__wrap wrap">
			
			<?require_once 'include/leftside.php'?>			
				
			<div class="catalog">				
				<div class="shop-catalog-nav-search">
					<form action="<?=base_url()?>search" id="searchform" class="form" method="get">
						<input type="text" id="search_input" class="form__input shop-search__input search" name="name" placeholder="Поиск по сайту"/>
					</form>
					<a href="" class="shop-search__button">&nbsp;</a>
				</div> <!-- /.main-catalog-nav__columns -->
				
				<? require 'include/shop_slider.php'?>

				<?require_once 'include/breadcrumbs.php'?>
				
				<div class="catalog_books clearfix">
					<?if($sub_template == 'list'):?>
						
					<?foreach($content->articles as $item):?>
						<div class="news-item">
							<div class="news-item__date"><?=$item->date?></div> <!-- /.news-item__date -->
							
							<h2 class="catalog__subtitle">
								<a href="<?=$item->full_url?>"><?=$item->name?></a>
							</h2>

							<div class="news-item__text">
								<?=$item->description?>
							</div> <!-- /.news-item__text -->
						</div> <!-- /.news-item -->
					<?endforeach;?>	

					<?elseif($sub_template == 'single'):?>
						<div class="news-item">
							<h2 class="catalog__subtitle"><?=$content->article->name?></h2>

							<div class="news-item__text">
								<?=$content->article->description?>
							</div> <!-- /.news-item__text -->
						</div> <!-- /.news-item -->
					<?endif;?>
				</div>
			</div> <!-- /.catalog -->
		</div> <!-- /.main-catalog__wrap wrap -->
	</div> <!-- /.main-catalog -->

	<?require 'include/footer.php'?>
	
	<?require 'include/modal.php'?>

    </body>
	<script>
		$( ".datepicker" ).datepicker();
	</script>
</html>