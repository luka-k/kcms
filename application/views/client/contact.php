<!DOCTYPE html>
<!--[if lte IE 9]>      
	<html class="no-js lte-ie9">
<![endif]-->

<!--[if gt IE 9]><!--> 
	<html> 
<!--<![endif]-->

<? require 'include/head.php' ?>

<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->
	
	<div class="main-box">
		<div class="main-box__cell">
			<div class="main-box__content">
	
				<? require 'include/header.php'?>
				
				<div class="page">

					<? require 'include/breadcrumbs.php'?>
					
					<section class="page__content" style="padding-left: 40px;width: 664px;">
						
						<header class="page__header">
							<h1 class="page__title">
								<?if(isset($content->name)):?>
									<?=$content->name?>
								<?else:?>
									<?=$content->article->name?>
								<?endif;?>
							</h1> <!-- /.page__title -->
						</header> <!-- /.page__header -->
						
						<?if(isset($callback)):?>
							<div class="contactBox">
								<h6>Вы можете задать интересующие Вас вопросы заполнив форму связи:</h6>
								<span>Все поля обязательны для заполнения.</span>
								
								<form action="#" id="sbmt" method="post">
									<label>Ваше имя:</label><br />
									<input id="name" name="name" type="text" /><br />
									<label>Ваш e-mail:</label><br />
									<input id="email" name="email" type="text" /><br />
									<label>Ваш телефон:</label><br />
									<input id="phone" name="phone" type="text" /><br />
									<label>Ваше сообщение</label><br />
									<textarea id="question" name="question"></textarea><input class="formButton" onclick="submit_form()" type="button" value="Отправить" /> <input class="formButton" type="reset" value="Отмена" />&nbsp;
								</form>
							</div>	
							
						<?else:?>
						<div class="page__text-nobulls page__scroll">
							<div class="page__scroll-in">
							<div style="padding-left: 20px;">
								<? if ($content->article->object_id): 
								
									$object = $this->products->prepare($this->products->get_item($content->article->object_id));
								?>
								<a href="<?= str_replace('articles', 'works', $object->full_url)?>"><img src="/template/client/images/i/phobjbtn.png" style="float: right; margin-right: 36px;" /></a>
								<? endif ?>
									<?=$content->article->description?>
									<?if(!empty($content->map)):?>
<? 
// TODO: строчка фиксит баг пустой картинки
foreach ($content->article->img  as $i => $im): if (!$im) unset($content->article->img[$i]); endforeach; ?>
										<h6>Карта проезда</h6>
										<div style="width: 600px;">
										<div style="border: 1px solid gray;width: 280px; height: 200px;margin-right: 10px; float: left;">
										<a style="padding: 0px;" rel="nofollow"  href="<?=base_url()?>popup_gallery/view?action=map&start=real&amp;first_img=1&amp;contact_id=<?= $content->id?>" data-fancybox-type="iframe" class="modal-gallery-open"><img src="<?=$content->article->img[count($content->article->img)-1]->map_url?>" alt=""/></a>
										</div>
										<div style="border: 1px solid gray;width: 280px; height: 200px;margin-right: 10px; float: left;">
										<a style="padding: 0px;" rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=map&amp;first_img=2&amp;contact_id=<?= $content->id?>" data-fancybox-type="iframe" class="modal-gallery-open"><img src="<?= html_entity_decode($content->map2) ?>" alt=""/></a>
										<script>
var myMap;
function init () {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").
    myMap = new ymaps.Map('yandexMap', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center: [<?=$content->article->map_center?>], // Москва
        controls: ['zoomControl',  'typeSelector',  'fullscreenControl'],
        zoom: 16
    });

    // Открываем балун на карте (без привязки к геообъекту).
    myMap.balloon.open([<?=$content->article->map_center?>], "<img src='http://brightberry.ru/template/client/images/i/bblogo.jpg' />", {
        // Опция: не показываем кнопку закрытия.
        closeButton: false
    });
    /*document.getElementById('destroyButton').onclick = function () {
        // Для уничтожения используется метод destroy.
        myMap.destroy();
    };*/

}</script>
										</div>
										</div>
										<div style="clear: both;"></div>
									<?endif;?> 
								
								<? if ($content->article->object_id): 
								
									$object_info = array(
										'object_type' => 'products',
										'object_id' => $content->article->object_id
									);
									$object_images = $this->images->get_images($object_info);
								?>
								
								<br><br>
								</div> <!-- /.page__scroll-in -->
								
						<div class="projects" style="height: auto;">
							<ul class="projects__list-noscroll" style="margin-top: 15px;margin-left: 0;padding-left: 20px;list-style: none;width: 600px;">
								<?for($i = 0; $i < count($object_images); $i+=3): $c = $object_images[$i];?>
									<li class="projects__item projects-item" style="margin-left: 0; padding-left: 0;height: 148px;">
										<?if(!empty($c->catalog_small_url)):?>
											<a rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=product&amp;nolinks=1&amp;product_id=<?=$object->id?>&amp;first_img=<?=$i?>&amp;title=<?=$object->name?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open">
												<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image"  style="width:161px" />
											</a>
											<? if ($i+1 < count($object_images)): $c = $object_images[$i+1];?>
											<a rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=product&amp;nolinks=1&amp;product_id=<?=$object->id?>&amp;first_img=<?=$i+1?>&amp;title=<?=$object->name?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open" style="margin-left: 60px;">
													<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image"  style="width:161px" />
												</a>
												<? if ($i+2 < count($object_images)): $c = $object_images[$i+2];?>
											<a rel="nofollow" href="<?=base_url()?>popup_gallery/view?action=product&amp;nolinks=1&amp;product_id=<?=$object->id?>&amp;first_img=<?=$i+2?>&amp;title=<?=$object->name?>"  id="im_<?= $c->id?>" data-fancybox-type="iframe" class="projects-item__image-box modal-gallery-open" style="margin-left: 60px;">
														<img src="<?=$c->catalog_small_url?>" id="project1" alt="project" class="projects-item__image hover-image" style="width:161px" />
													</a>
												<? endif?>
											<? endif?>
										<?endif;?>
									</li> <!-- /.projects__item projects-item -->
								<?endfor;?>
							</ul> <!-- /.projects__list -->
						</div> <!-- /.projects -->
								<? endif ?>
								</div> <!-- /.page__scroll-in -->
							</div> <!-- /.page__text page__scroll -->
						<?endif;?>
					</section> <!-- /.page__content -->
					
					<aside class="page__sidebar">
						<? require 'include/left-menu.php' ?>
			        </aside> <!-- /.page__sidebar -->
				</div> <!-- /.page -->
				
				<? require 'include/footer.php' ?>
					
			</div> <!-- /.main-box__content -->
		</div> <!-- /.main-box -->
	</div> <!-- /.main-box -->

	<? require 'include/modal.php' ?>
	<? require 'include/script.php' ?>		        

</body>
</html>