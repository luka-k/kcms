<!DOCTYPE html> 
<html>

<? require 'include/head.php' ?>

<body>
	
	<? require 'include/top-menu.php'?>
	<? require 'include/header.php'?>
	<? require 'include/catalog-nav.php'?>
	
	<div class="page page-contacts">
		<div class="page__wrap wrap">
		
		<? require 'include/breadcrumbs.php'?>
		
		<h2 class="catalog__subtitle">Партнеры</h2>
		
		<?$partners_counter = 0?>
		<?foreach($partners as $partner):?>
			<div class="partner-item <?if($partners_counter == 5):?>last <?$partners_counter = 0?><?endif;?>">
				<a href="http://<?=$partner->link?>">
					<img src="<?=$partner->img->catalog_mid_url?>" alt="<?=$partner->name?>" />
					<div class="partner-name"><?=$partner->name?></div>
				</a>
			</div>
			<?$partners_counter++?>
		<?endforeach;?>

		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->

	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>

    </body>
</html>

        
        