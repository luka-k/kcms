<? require 'include/head.php' ?>

	<div id="body">

		<div id="wrapper" class="clearfix">
			
				<header class="grid clearfix">
					<div class="logo col_4">
						<a href=""><img src="img/logo.png" alt=""/></a>
						<div class="slogan" >Запчасти cummins из первых рук</div>
					</div>
					<div class="header-info col_4">
						<div class="phone"><span class="phone-code">8(800)</span>700-56-47</div>
						<div class="work-time">звонок по России бесплатно</div>
					</div>
					<div class="cart col_4">
						<div class="enter"><a href="">Вход</a> | <a href="">Регистрация</a></div>
						<div class="clearfix">
							<div class="cart-btn">&nbsp;</div>
							<div class="cart-info"><span class="cart-qty">0</span> товаров на сумму <span class="cart-total">0</span> рублей</div>
						</div>
					</div>				
				</header>
				
				<div id="menu" class="grid clearfix">
					<nav>
						<ul>
							<li><a href="">Главная</a></li>
							<li><a href="/page/about/">Информация</a></li>
							<li><a href="/">Каталог</a></li>
							<li><a href="/page/delivery/">Оплата и доставка</a></li>
							<li><a href="/page/contacts/">Контакты</a></li>
						</ul>
					</nav>
					<form action="/search/" id="searchform" method="get">
						<input type="text" name="q" class="search square" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" placeholder="Поиск по номеру или именованию"/>
					</form>
				</div>
				<div id="main-3" class="grid clearfix">
					<div id="left-col" class="col_3">
						<div class="left-col">
							<div class="name-cat">
								<?= $engine ?>
							</div>
							<nav>
								<ul>
									<? foreach ($systems as $s) : ?>
									<li>
										<a href="/catalog/<?= $this->uri->segment(2) . '/' . $s->url ?>"><?= $s->name ?></a>
										<? if ($this->uri->segment(3) == $s->url) : ?>
										<ul class="active">
											<? foreach ($screens as $scr) : ?>
											<li><a href="/catalog/<?= $this->uri->segment(2) . '/' . $s->url . '/' . $scr->url?>"><?= $scr->description ?></a></li>
											<? endforeach ?>
										</ul>
										<? endif ?>
									</li>
									<? endforeach ?>
								</ul>
							</nav>
						</div>
						<aside>
							<div class="text-1" style="color: white;padding-top: 20px;">СПЕЦПРЕДЛОЖЕНИЯ</div>
							<h6>"Клуб Газелистов России" <a href="http://www.gazelleclub.ru" target="_blank">www.gazelleclub.ru</a></h6>
							<p>Скидка 7% от цены заявленной на сайте всем участникам Клуба Газелистов России.</p>
							<img src="img/banner.png" alt=""/>
							
							<div class="news clearfix">
								<div class="col_12">
									<div class="text-1">НОВОСТИ</div>
									<? foreach ($news as $el) : ?>
									<div class="news-item">
										<div class="news-date"><?= $el->date?></div>
										<div class="news-title"><a href="<?= $el->url?>"><?= $el->name?></a></div>
									</div>
									<? endforeach ?>
								</div>
							</div>
							
							<div class="blog clearfix">
								<div class="col_12">
									<div class="text-1">СТАТЬИ</div>
									<? foreach ($articles as $el) : ?>
									<div class="blog-item">
										<div class="blog-date"><?= $el->date?></div>
										<div class="blog-title"><a href="<?= $el->url?>"><?= $el->name?></a></div>
									</div>
									<? endforeach ?>
								</div>
							</div>
							
							<div class="video clearfix">
								<div class="col_12">
									<div class="text-1">Видео</div>
									<? foreach ($videos as $v) : ?>
									<div class="video-item">
										<iframe width="100%" src="http://www.youtube.com/embed/<?= $v->video ?>" frameborder="0" allowfullscreen></iframe>
										<span class="title"><?= $v->name ?></span> <span class="time"></span>
									</div>
									<? endforeach ?>
									
								</div>
							</div>
						</aside>
					</div>
					<div id="content" class="col_9">
						<div class="breadcrumb">
							<? foreach ($breadcrumbs as $b): ?>
								<a href="<?= $b['url']?>"><?= $b['name'] ?></a> > 
							<? endforeach ?>
						</div>
						<div class="cat">
							<div class="clearfix">
								<? $ii = 0; foreach ($subcategories as $s) : if (!$s->name) continue; $ii++;?>
								<? if ($this->uri->segment(4)) : ?>
								<div class="cat-item col_12 " style="height: 30px;" >
									
									<div class="item-name" style="color: white;"><?= $s->name ?></div>
								</div>
								<div class="cat-item_ col_12 " style="height: 600px; text-align: center;" >
									
									<img src="<?= $s->image ? str_replace('thumbs_middle/', '', $s->image->url) : ''?>" alt=""/></div>
									<div>
									<? else : ?>
								<div class="cat-item col_3 " >
									<a href="<?= $this->uri->uri_string . '/' . $s->url ?>" class="plashka"><img src="<?= $s->image ? $s->image->url : ''?>" alt=""/></a>
									<div class="item-name"><a style="font-size: 14px;" href="<?= $this->uri->uri_string . '/' . $s->url ?>"><?= $s->name ?></a></div>
									<?endif ?>
								</div>
								<?= $ii % 4 == 0 ? '<div style="clear: both;"></div>' : '' ?>
								<? endforeach ?>
							</div>
						</div>
						
						<? if (!$this->uri->segment(4) && $products_new ) : ?>
						<div class="new clearfix">
							<div class="col_12 text-1">НОВИНКИ</div>
								<? foreach ($products_new as $el) : ?>
								<div class="new-item col_4">
									<div class="new-pl">&nbsp;</div>
								<div style="height: 205px; overflow: hidden; vertical-align: middle;">
									<a href="/product/<?= $el->url ?>" class="plashka"><img src="<?= $el->image_main->url ?>" alt=""/></a>
								</div>
									<div class="item-footer">
										<div class="new-name"><?= $el->name ?></div>
										<div class="price col_6"><?= $el->price ?> руб.</div><div class="btn col_6"><button class="red-btn square">купить</button></div>
									</div>
								</div>
								<? endforeach ?>
						</div>
						<? endif ?>
					</div>
					
					<div id="content-2" class="col_9">
						<table cellspacing="0" cellpadding="0">
							<thead>
								<tr>
									<?= ($this->uri->segment(4) ? '<th>№ на рис.</th>': '') ?>
									<th>Артикул</th>
									<th>Наименование</th>
									<th>Наличие</th>
									<th>Цена</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<? foreach ($products as $p) : ?>
								<tr>
									<?= ($this->uri->segment(4) ? '<td>№ '.$p->number.'</td>': '') ?>
									<td><?= $p->sku ?></td>
									<td><a href="<?= $p->full_url ?>"><?= $p->name ?></a></td>
									<td>на&nbsp;складе</td>
									<td><?= $p->price ?>&nbsp;р.</td>
									<td><button class="red-btn square">купить</button></td>
								</tr>
								<? endforeach ?>
							</tbody>
						</table>
						<div class="page-nav col_12" style="display: none;">
							<a href="" class="active">1</a>
							<a href="">2</a>
							<a href="">3</a>
							<a href="">4</a>
						</div>
					<div class="col_12">
						<? $content = $this->articles->get_item_by(array('url' => $this->uri->segment($this->uri->total_segments()) )); ?>
						<div class="text-1"><?= $content->name ?></div>
							<?= $content->description ?>
					</div>
					</div>
				</div>

				
				<? require 'inc/design/footer.php' ?>
				<? require 'inc/design/footer_scripts.php' ?>

			</div>
		</div>
	</div>
	</body>
</html>
		