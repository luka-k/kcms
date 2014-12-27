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
	
	<div class="page page-catalog" id="page-catalog">
		<div class="page-wrap wrap">
			<div class="page-catalog__nav">
				<? require 'include/left-menu.php'?>
			</div> <!-- /.page-catalog__nav -->
			
			<div class="page-catalog__content">
		
				<div class="page-catalog__products"> 
					<div class="catalog">
						<div class="catalog__sort catalog-sort">
							<a href="#price" class="catalog-sort__href active">По цене</a>
							<a href="#price" class="catalog-sort__href">По наименованию</a>
						</div> <!-- /.catalog__sort catalog-sort-->
						
						<h1 class="catalog__subtitle">Поиск</h1>
						
						<div class="catalog__list">
							<?foreach($content as $item):?>
								<div class="catalog__item">
									<div class="catalog-item">
										<div class="catalog-item__image-box">
											<a href="<?=$item->full_url?>"><img src="<?=$item->img->catalog_mid_url?>" alt="item" width="225" height="170" class="catalog-item__image" /></a>
										</div> <!-- /.catalog-item__image-box -->
									
										<a href="<?=$item->full_url?>" class="catalog-item__name"><?=$item->name?></a>
										
										<div class="catalog-item__desc">
											<p><?=$item->description?></p>
										</div> <!-- /.catalog-item__desc -->
										
										<div class="catalog-item__bottom skew">
											<div class="catalog-item__price"><?=$item->price?></div> <!-- /.catalog-item__price -->
											
											<div class="catalog-item__button">
												<button class="button button--normal fancybox" data-fancybox-href="#to-cart" onclick="fancy_to_cart('<?=$item->id?>', '<?=$item->name?>'); return false;">Купить</button>
											</div> <!-- /.catalog-item__button -->
										</div> <!-- /.catalog-item__bottom -->
									</div> <!-- /.catalog-item -->
								</div> <!-- /.catalog__item -->
							<?endforeach;?>
						</div> <!-- /.catalog__list -->
						
						<div class="catalog__load load-link">
							<a href="#load" class="load-link__href">Еще товары</a>
						</div> <!-- /.catalog__load -->
					</div> <!-- /.catalog -->
				</div> <!-- /.page-catalog__products -->
			</div> <!-- /.page-catalog__content -->
		</div> <!-- /.page-catalog__wrap wrap -->
</div> <!-- /.page-catalog -->
        
	<div class="text-about" id="text-about">
		<div class="text-about__wrap wrap">
			<h2 class="text-about__title block-title">Продукция от компании &laquo;redBTR&raquo;</h2>
			<div class="text-about__text">
				<?=$settings->description?>
			</div> <!-- /.text-about__text -->
		</div> <!-- /.text-about__wrap wrap -->
	</div> <!-- /.text-about -->
	
	<? require 'include/footer.php'?>
    <? require 'include/modal.php'?>        
	<? require 'include/scripts.php'?>
    </body>
</html>

