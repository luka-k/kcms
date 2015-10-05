<!DOCTYPE html>

<html class="no-js">

<?require 'include/head.php'?>

<body>

    <?require 'include/header.php'?>

    <?require 'include/modal.php'?>

    <?require 'include/top-menu.php'?>
	
	<?require 'include/under_menu.php'?>
	
	<?require 'include/breadcrumbs.php'?>
	
	<div class="container">
		<div class="content">
			<div class="left_block">
				<h1><?= $content->name?></h1>
				<img src="<?= $content->img->publication_big_url?>" width='500px'>
				<?$content->parent = $this->articles->prepare($content->parent);?>
				<p class="date"><?= $content->date?> <span>/</span> <a href="<?= $content->parent->full_url?>"><?= $content->parent->name?></a></p>
				<span class="comments"></span>
			</div>  
			
			<div class="right_block">
				<pre>Тут я пока не понял что в тегах h3 как в базе хранится должно</pre>
				<?= $content->description?>
				<!--<h3>Рыбным текстом называется текст, служащий для временного наполнения макета в публикациях или производстве веб-сайтов, пока финальный текст еще не создан</h3>
				<p>Рыбный текст также известен как текст-заполнитель или же текст-наполнитель. Иногда текст-«рыба» также используется композиторами при написании музыки. Они напевают его перед тем, как сочинены соответствующие слова. Уже в 16-том веке рыбные тексты имели широкое распространение у печатников.</p>
				<p>Рыбные тексты также применяются для демонстрации различных видов шрифта и в разработке макетов. Как правило их содержание бессмысленно. По причине своей функции текста-заполнителя для макетов нечитабельность рыбных текстов имеет особое значение, так как человеческое восприятие имеет особенность, распознавать определенные образцы и повторения. </p><p>В случае произвольного набора букв и длины слов ничто не отвлекает от оценки воздействия и читаемости различных шрифтов, а также от распределения текста на странице (макет или площадь набора). Поэтому большинство рыбных текстов состоят из более или менее произвольного набора слов и слогов. </p><p>Таким образом образцы повторения не отвлекают от общей картины, а шрифты имеют лучшую базу сравнения. Преимущественно конечно, если рыбный текст кажется в некоторой степени реалистичным, не искажая тем самым воздействие.</p>-->
				<div class="articles_socials">
                    <a class="articles_social" href="#"><img src="<?= IMGS_PATH?>vk2.png"></a> 
					<a class="articles_social" href="#"><img src="<?= IMGS_PATH?>od2.png"></a> 
					<a class="articles_social" href="#"><img src="<?= IMGS_PATH?>fb2.png"></a> 
					<a class="articles_social" href="#"><img src="<?= IMGS_PATH?>tw2.png"></a>
                </div>
			</div>
		</div>
	</div> 
	
	<div class="articles_more">
		<div class="container">
			<h1>Читайте также</h1>
			<div class="all_articles">
				<a href="#">Перейти ко всем публикациям</a>
			</div>
				
			<div class="subscribe_articles"><a href="#">Подписаться </a></div>
				
			<div class="owl-carousel2">
				<?foreach($publications as $pub):?>
					<div class="item">
						<div class="articles">
							<div class="articles_image">
								<img src="<?= $pub->img->publication_big_url?>">
							</div>
							<p class="info"><?= $pub->date?> <span>/</span> <?= $pub->parent_name?></p>
							<a href="<?= $pub->full_url?>"><?= $pub->name?></a>
							<span><?= $pub->short_description?></span>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>

	<?$no_public = TRUE?>
	<?require 'include/prefooter.php'?>

    <?require 'include/footer.php'?>

</body>
</html>