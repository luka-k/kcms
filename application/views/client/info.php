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
			<h1><?= $content->name?></h1>
			<?= $content->description?>
			
			<div class="print"><a href="#">Распечатать страницу</a></div>
		</div>
	</div>
	
	<?require 'include/prefooter.php'?>

    <?require 'include/footer.php'?>

</body>
</html>