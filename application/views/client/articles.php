<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>Проекты</title>
		<?include 'include/head.php'?>
	</head>
	<body>
		<!-- header -->
		<? require 'include/header.php'; ?>
		
		<main>
			
			<div class="top-pro">
				<div class="wrapper">
					<h4>Наши проекты и отзывы</h4>
				</div>
			</div>

			<div class="blog">
				<div class="wrapper">
					<div class="row clearfix">
						<div class="blog_left">
							<div>Проекты</div>
							<?include 'include/left_menu.php'?>
						</div>
						
						<div class="blog_content">
							<?if($sub_template == 'list'):?>
								<ul class="article-list">
									<?foreach($content->articles as $item):?>
										<li><a href="<?=base_url()?><?=$tree[0]->url?>/<?=$content->url?>/<?=$item->url?>"><?=$item->name?></a></li>
									<?endforeach;?>
								</ul>
								
							<?elseif($sub_template == 'single'):?>
								
								<h2 class="page_title"><?=$content->name?></h2>
								<?=$content->description?>
								
							<?endif;?>
						</div>
						
						<div class="column">
							<div class="proj-soc">
								<span class="news">Хочу так же</span>
								<form action="" method="post">
									<input type="text" name="name" class="require" placeholder="Ваше имя">
									<input type="text" name="phone" class="required" placeholder="Телефон" />
									<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Оставить заявку" />
									<button>Отправить</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</main>
		
		<!-- footer -->
		<? require 'include/footer.php'; ?>

		<!-- scripts -->
		<? require 'include/scripts.php'; ?>

		<!-- pop-up -->
	    <? require 'include/popup.php'; ?>

	</body>
</html>