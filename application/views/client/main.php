<? require 'include/head.php' ?>

		<div id="body">
			<div id="wrapper" class="clearfix">

				<? require 'include/header.php' ?>
				<? require 'include/top-menu.php' ?>
				
				<div id="category" class="grid clearfix">
					<div class="cat-item col_4" id="category1">
						<a href="/catalog/cummins-isf-2-8" class="plashka"><img src="img/category-1.png" alt=""/></a>
						<div class="item-name"><a href="/catalog/cummins-isf-2-8">Cummins ISF2.8</a></div>
					</div>
					<div class="cat-item col_4" id="category2">
						<a href="/catalog/cummins-isf-3-8" class="plashka"><img src="img/category-2.png" alt=""/></a>
						<div class="item-name"><a href="/catalog/cummins-isf-3-8" >Cummins ISF3.8</a></div>
					</div>
					<div class="cat-item col_4" id="category3">
						<a href="" onclick="return swap2isbe()" class="plashka"><img src="img/category-3.png" alt=""/></a>
						<div class="item-name"><a href="" onclick="return swap2isbe()" >Cummins ISBe</a></div>
					</div>
				</div>
				<script type="text/javascript">
				function swap2isbe()
				{
					$('#category3').hide();
					$('#category1').html('\
						<a href="/catalog/cummins-isbe-4-5" class="plashka"><img src="img/category-1.png" alt=""/></a>\
						<div class="item-name"><a href="/catalog/cummins-isbe-4-5">Cummins ISBe 4.5</a></div>');
					$('#category2').html('\
						<a href="/catalog/cummins-isbe-6-7" class="plashka"><img src="img/category-2.png" alt=""/></a>\
						<div class="item-name"><a href="/catalog/cummins-isbe-6-7">Cummins ISBe 6.7</a></div>');
					return false;
				}
				</script>
				<div id="main" class="grid clearfix">
					<div class="special clearfix">
						<div class="col_12 text-1">СПЕЦИАЛЬНЫЕ ТОВАРЫ</div>
						<? foreach ($products_special as $s) : ?>
						<div class="special-item col_3">
							<div class="special-pl">&nbsp;</div>
							<a href="<?= $s->full_url ?>" class="plashka"><img src="<?= $s->img->catalog_mid_url ?>" alt=""/></a>
							<div class="item-footer">
								<div class="special-name"><?= $s->name ?></div>
								<div class="price col_6"><?= $s->price ?> руб.</div><div class="btn col_6"><a href="#to-cart" class="red-btn square fancybox" onclick="fancy_to_cart('<?=$s->id?>', '<?=$s->name?>', 'buy'); return false;">купить</a></div>
							</div>
						</div>
						<? endforeach ?>
					</div>
					<div class="mid-main clearfix">
						<div class="banner col_3">
							<div class="text-1">СПЕЦПРЕДЛОЖЕНИЯ</div>
							<h6>"Клуб Газелистов России" <a href="http://www.gazelleclub.ru" target="_blank">www.gazelleclub.ru</a></h6>
							<p>Скидка 7% от цены заявленной на сайте всем участникам Клуба Газелистов России.</p>
							<img src="img/banner.png" alt/>
						</div>
						<div class="news col_3">
							<div class="text-1">НОВОСТИ</div><br>
							<? foreach ($news as $el) : ?>
							<div class="news-item">
								<div class="news-title"><span class="news-date"><?= $el->date?></span> <a href="<?= $el->full_url?>"><?= $el->name?></a></div>
							</div>
							<? endforeach ?>
						</div>
						<div class="blog col_6">
							<div class="text-1">СТАТЬИ</div>
							<? foreach ($articles as $el) : ?>
							<div class="blog-item">
								<div class="blog-date"><?= $el->date?></div>
								<div class="blog-title"><a href="<?= $el->full_url?>"><?= $el->name?></a></div>
								<div class="blog-text">
									<?= $el->description_short?>
								</div>
							</div>
							<? endforeach ?>
						</div>
					</div>
				</div>
				<div id="main-2" class="grid clearfix">
					<div class="video col_3">
						<div class="text-1">Видео</div>
						<?if(isset($videos)):?>
							<? foreach ($videos as $v) : ?>
							<div class="video-item">
								<iframe width="100%" src="http://www.youtube.com/embed/<?= $v->video ?>" frameborder="0" allowfullscreen></iframe>
								<span class="title"><?= $v->name ?></span> <span class="time"></span>
							</div>
							<? endforeach ?>
						<?endif;?>
					</div>
					<div class="info col_9">
						<div class="text-1"><?= $content->name ?></div>
							<?= $content->description ?>
					</div>
				</div>
<? require 'include/modal.php' ?>				
<? require 'include/footer.php' ?>