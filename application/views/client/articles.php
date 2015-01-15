<? require 'include/head.php' ?>
	<div id="body">
		<div id="wrapper" class="clearfix">
			<? require 'include/header.php' ?>
			<? require 'include/top-menu.php' ?>
			
				<div id="main-3" class="grid clearfix">
					<div id="left-col" class="col_3">
						<div class="left-col">
							<div class="name-cat">
								Каталог
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
												if ($screens[$i]->description)
													$screens[$i]->name = $screens[$i]->description;
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
						<h3 class="title col_12"><?= $content->name ?></h3>
						

					<div class="col_12">
						ыуацуацуацуацуацусыауцаывукыпукпукпукпкпукп
							<p><?= $content->description ?></p>
					</div>
						
					</div>
				</div>


<? require 'include/footer.php' ?>