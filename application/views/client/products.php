<? require 'include/head.php' ?>
	<div id="body">
		<div id="wrapper" class="clearfix">
			<? require 'include/header.php' ?>
			<? require 'include/top-menu.php' ?>
			
			<div id="main-3" class="grid clearfix">
			<div id="left-col" class="col_3">
				<div class="left-col">
					<div class="name-cat">
						<?= $main_category->name ?>
					</div>
					
					<nav>
						<ul>
							<? foreach($tree as $s):?>
								<li>
									<a href="<?= $s->full_url ?>"><?= $s->name ?></a>
									<? if ($this->uri->segment(3) == $s->url) : ?>
										<ul class="active">
											<? $screens = $s->childs;
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
		