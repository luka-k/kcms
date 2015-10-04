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
			<div class="products_block">
				<h1 class="products">Все продукты</h1>
				<p class="products">Программное обеспечение для автоматизации, сохранности данных и решения ваших бизнес задач</p>
			</div>
			
			<div class="products">
				<div class="product odines">
					<div class="product_tex ">
						<a href="<?= $product_categories[0]->full_url?>">1C продукты</a>
					</div>
				</div>
				<p>Все программные продукты «1С:Предприятие». Опытные специалисты помогут выбрать наиболее эффективное решение.</p>
			</div>
			
			<div class="products">
				<div class="product business">
					<div class="product_tex">
						<a href="<?= $product_categories[1]->full_url?>">Программы для бизнеса</a>
					</div>
				</div>
				<p>Широкий спектр различного программного обеспечения для решения ваших бизнес-задач.</p>
			</div>
			
			<div class="products">
				<div class="product save">
					<div class="product_tex">
						<a href="<?= $product_categories[2]->full_url?>">Защита данных</a>
					</div>
				</div>
				<p>Какой бы величины ни была ваша компьютерная система, ей необходима качественная защита.</p>
			</div>
			
			<div class="products">
				<div class="product torg">
					<div class="product_tex">
						<a href="<?= $product_categories[3]->full_url?>">Торговое оборудование</a>
					</div>
				</div>
				<p>Широкий спектр различного программного обеспечения для решения ваших бизнес-задач.</p>
			</div>
		</div>
	</div>

	<?require 'include/prefooter.php'?>

    <?require 'include/footer.php'?>

</body>
</html>