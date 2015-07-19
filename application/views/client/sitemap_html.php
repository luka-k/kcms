<!DOCTYPE html>
<html>
<? require 'include/head.php' ?>
<body>
	<? require 'include/top-menu.php'?>
	<? require 'include/header.php'?>
	<? require 'include/catalog-nav.php' ?>
	
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