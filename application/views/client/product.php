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
						<!-- <div class="enter"><a href="">Вход</a> | <a href="">Регистрация</a></div> -->
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
							<li><a href="/articles/info/about/">Информация</a></li>
							<li><a href="/">Каталог</a></li>
							<li><a href="/articles/info/delivery/">Оплата и доставка</a></li>
							<li><a href="/articles/info/contacts/">Контакты</a></li>
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
								<?= $main_category->name ?>
							</div>
							<nav>
								<ul>
									<? foreach ($tree as $s) : $s = $this->categories->prepare($s);?>
									<li>
										<a href="<?= $s->full_url ?>"><?= $s->name ?></a>
										<? if ($this->uri->segment(3) == $s->url) : ?>
										<ul class="active">
											<? $screens = $this->categories->get_prepared_list($s->childs);
											$names = array();
											foreach ($screens as $i => $scr)
											{
												if ($screens[$i]->caption)
													$screens[$i]->name = $screens[$i]->caption;
												$names[] = $screens[$i]->name;
											}
											array_multisort($names, $screens);
											foreach ($screens as $scr) : ?>
											<li><a <?= $scr->url == $this->uri->segment(4) ? 'class="active"' : '' ?> href="<?= $scr->full_url?>"><?= $scr->name ?></a></li>
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
							<!--
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
							-->
						</aside>
					</div>
					<div id="content" class="col_9">
						<div class="breadcrumb">
							<? foreach ($breadcrumbs as $b): ?>
								<a href="<?= $b['url']?>"><?= $b['name'] ?></a> > 
							<? endforeach ?>
						</div>
						<h3 class="title col_12"><?= $product->name ?></h3>
						
						<div class="col_12">
							<div id="gallery" class="clearfix col_5">
								<div id="box">
									<a href='<?= $product->img->url ?>' id='zoom1' class = 'cloud-zoom' title="" rel="">  <img src="<?= $product->img->url ?>" class="picture" /></a>
								</div>
								<? if (count($product->imgs) > 1) : ?>
								<div class="slider">
									<div name="prev" class="navy prev-slide"></div>
									<div name="next" class="navy next-slide"></div>
									<div class="slide-list">
										<div class="slide-wrap">
											<? foreach ($product->imgs as $img): ?>
											<div class="slide-item" class="col_4">
												<div >
													<a href='<?= $img->url?>' class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '<?= $img->url?>' "><img class="zoom-tiny-image" id="thumb_hidden" src="<?= $img->url?>" alt="" /></a>
												</div>
											</div>
											<? endforeach ?>
										</div>
									</div>
								</div>
								<? endif?>
							</div>
					
							<div class="product-info clearfix col_7">
								<div class="product-info-top clearfix">
										<div style="float:left; margin-right:20px;">Артикул <span><?= $product->sku ?></span></div>
								</div>
								<div style="background:#d6d6d6; padding:20px; margin-bottom:10px;">
									<div class="product-info-middle clearfix">
										<div class="left">
											<? if ($product->price) : ?>
											Цена: <span class="price"><?= $product->price ?> руб.</span>
											<? else : ?>
											Под заказ
											<? endif ?>
										</div>							
									</div>
									<div class="set clearfix">
										<div class="col_3">Количество</div>
										<div class="col_9">
											<span class="btn plusminus">-</span>
											<input type="text" class="inpt square" size=1 value="1">
											<span class="btn plusminus">+</span>
											<button class="square red-btn" onclick=" $(this).addClass('green-btn');$(this).removeClass('red-btn');$(this).html('Добавлено');add_to_cart('<?= $product->name ?>', '<?= $product->price ?>', '<?= $product->id ?>', 1); return false;">В корзину</button>
										</div>
									</div>
								</div>
								<div class="description">
									<h6>Описание</h6>
									<?= $product->description_short ?>
								</div>
							</div>

						</div>
						
					</div>

					<? if ($product->recommended1 || $product->recommended2 || $product->recommended3) : ?>
					<div id="content-2" class="col_9">
						<div class="new clearfix">
							<div class="col_12 text-1">Рекомендуемые товары</div>
								<? $recommended = array($product->recommended1, $product->recommended2, $product->recommended3);
								foreach ($recommended as $r) : if ($r) : ?>
								<? $p = $this->products->Prepare ($this->products->get_item($r)); ?>
								<div class="new-item col_4">
									<a href="/product/<?= $p->url ?>" class="plashka"><img src="<?= $p->image_main->url?>" alt=""/></a>
									<div class="item-footer">
										<div class="new-name"><?= $p->name?></div>
										<div class="price col_6"><?= $p->price ?> руб.</div><div class="btn col_6"><button class="red-btn square" onclick="$(this).addClass('green-btn');$(this).removeClass('red-btn');$(this).html('Добавлено'); add_to_cart('<?= $r->name ?>', '<?= $r->price ?>', '<?= $r->id ?>', 1); return false;">купить</button></div>
									</div>
								</div>
								<?endif; endforeach; ?>
						</div>
					</div>
					<? endif ?>
					
					<div id="content-3" class="col_9">

					<div class="col_12">
						<div class="text-1"><?= $product->name ?></div>
							<p><?= $product->description ?></p>
					</div>
					</div>
				</div>


<? require 'include/footer.php' ?>