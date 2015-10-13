<!DOCTYPE html>

<html class="no-js">

<? require 'include/head.php'; ?>

<body>

	<? require 'include/header.php'; ?>
	<? require 'include/modal.php'; ?>
	
	<div class="services_page">
		<div class="container">
			<h2>Услуги и цены</h2>

			<? foreach($services as $s):?>
				<div class="popular_service page">
					<div class="popular_service_image"><img src="<?= $s->img->articles_url?>"> <a href="<?= $s->full_url?>" class="button_red">Подробнее</a></div>
					<div class="popular_service_text">
						<h3><?= $s->name?></h3>
						<?= $s->description?>
					</div>
				</div>
			<? endforeach;?>
		</div>
	</div>

	<? require 'include/footer.php'; ?>
</body>

</html>