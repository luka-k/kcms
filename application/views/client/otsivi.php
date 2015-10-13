<!DOCTYPE html>

<html class="no-js">

<? require 'include/head.php'; ?>

<body>

	<? require 'include/header.php'; ?>
	<? require 'include/modal.php'; ?>


    <div class="testimonial_page">
        <div class="container">
            <h2>Отзывы</h2>

			<div class="owl-carousel1">
               <? foreach($testimonials as $t): ?>
					<div class="item">
						<div class="testimonial_block">
							<div class="testimonial_image">
								<img src="<?= $t->img->testimonials_url?>">
								<p><?= $t->name?></p>
								<!--	<a href="https://vk.com/id135470543">https://vk.com/id135470543</a>-->
							</div>
							
							<div class="testimonial_text">
								<p class="testimonial_name"><?= $t->title?></p>
								<p class="testimonial_body"><?= $t->description?></p>
								
								<?if(isset($t->file)):?>
									<a href="<?= $t->file->full_url?>" target="_blank">Посмотреть отчет</a>
								<?endif;?>
							</div>
						</div>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</div>

	<? require 'include/footer.php'; ?>
	
</body>

</html>