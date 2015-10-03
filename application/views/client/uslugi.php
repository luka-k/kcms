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
			<div class="top_content">
				<h1><?= $content->name?></h1>
				
				<?= $content->description?>
				
				<div class="print"><a href="#">Распечатать страницу</a></div>
			</div>
			
			<div class="right_content">
				<img src="<?= IMGS_PATH?>usligi.jpg">
				<a href="#" data-reveal-id="myModal1" class="online_right">Оформить он-лайн заявку</a>
				
				<div class="slogan_right">
					Главное, и, пожалуй, самое отличающее нас от подавляющего большинства конкурентов качество — любовь к своему делу. Результат нашей работы, это прежде всего — довольные клиенты.
				</div>
				
				<div class="call_right">Связаться с нами</div>
				<p class="title_right">Линия для консультацей, отдел продаж</p>
				<p class="phone_right">(812) 329-33-22</p>
				<span><a href="mailto:consult@ultra-soft.spb.ru">consult@ultra-soft.spb.ru</a></span>, 
				<span><a href="sales:consult@ultra-soft.spb.ru">sales@ultra-soft.spb.ru</a></span>
				<p class="title_right">Многоканальная линия поддержки пользователей</p>
				<p class="phone_right">(812) 329-33-23</p>
				<span><a href="mailto:support@ultra-soft.spb.ru">support@ultra-soft.spb.ru</a></span>
				<p class="adres_right">192022, г.Санкт-Петербург, Каменоостровский проспект, дом №37, офис №531</p>
				<p class="map_right"><a href="#">Проказать адрес и карту проезда</a></p>
			</div>
		</div>
	</div>


	<?require 'include/prefooter.php'?>

    <?require 'include/footer.php'?>

</body>
</html>