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
			<div class="left_content">
				<?if(!empty($content->articles)):?>
					<img src="<?= $content->img->products_url?>">
				<?else:?>
					<?if(isset($content->parent->img->products_url)):?>
					<?$content->parent = $this->articles->prepare($content->parent);?>
					<img src="<?= $content->parent->img->products_url?>">
					<?endif;?>
				<?endif;?>
				<ul class="left_menu">
					<?foreach($left_menu as $l_m):?>
						<li><a href="<?= $l_m->full_url?>" class="<?if($l_m->url == $left_menu_select):?>active<?endif;?>"><?= $l_m->menu_name?></a></li>
					<?endforeach;?>
				</ul>
				
				<div class="online_left">
					<img src="<?= IMGS_PATH?>icononline.png">
					<p>Он-лайн консультация</p>
					
					<span>Воспользуйтесь грамотной консультацией наших специалистов. Мы поможем найти подходящее решение ваших задач.</span>
					
					<div class="left_button">
						<a href="#" data-reveal-id="myModal2">Обратиться к поддержке</a>
					</div>
				</div>
			</div>
			
			<div class="top_content withleft">
				<div class="category">
					<?foreach($categories as $p_c):?>
						<a href="<?= $p_c->full_url?>" class="<?if($p_c->url == $category_select):?>active<?endif;?>"><?=$p_c->menu_name?></a>
					<?endforeach;?>
				</div>
					
				<?if(!empty($content->articles)):?>
					<h2><?= $content->articles[0]->name?></h2>
					<?= $content->articles[0]->description?>
				<?else:?>
					<h2><?= $content->name?></h2>
					<?= $content->description?>
				<?endif;?>	

				<div class="button_online"><a data-reveal-id="myModal1" href="#">Оформить онлайн заявку</a></div>
			</div>
		</div>
	</div>
	
	<?require 'include/prefooter.php'?>

    <?require 'include/footer.php'?>

</body>
</html>