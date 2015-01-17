<? require 'include/head.php' ?>
<script>
	jQuery(document).ready(function($){
		element = document.getElementById('left-col');
		var height = element.offsetHeight;
		document.getElementById('content').style.height = height;
	});
</script>
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
							
							
						</aside>
					</div>
					<div id="content" class="col_9" >
						<? require 'include/breadcrumbs.php' ?>
					<div class="col_12">
						<?if(isset($content->article)):?>
							<h3 class="title col_12"><?= $content->article->name ?></h3>
							<div class="col_12"><?= $content->article->description ?></div>
							
							<!--Оп оп говно код)))-->
							<?if($type == "novosti" || $type == "articles"):?>
							<div class="col_12">
								<h3 class="title col_12">Другие <?if($type == "novosti"):?>новости<?else:?>статьи<?endif;?></h3>
								<div class="col_12">
								<?$counter = 1?>
								<?$line = ceil((count($content->articles)-1)/2)?>
								<?foreach($content->articles as $article):?>
									<?if($article->name <> $content->article->name):?>
									<?if($counter == 1):?><ul class="col_6"><?endif;?>
										<li>
											<a href="<?=$article->full_url?>"><?=$article->name?></a>
											<div><?=$article->description_short?></div>
										</li>
										<?if($counter == $line):?></ul><?$counter = 0?><?endif;?>
										<?$counter++?>
									<?endif?>
									
								<?endforeach;?>
								</div>
							</div>	
							<?endif;?>
						<?else:?>
							<h3 class="title col_12"><?= $content->name ?></h3>
							<ul>
								<?foreach($content->articles as $article):?>
									<li><a href="<?=$article->full_url?>"><?=$article->name?></a></li>
								<?endforeach;?>
							</ul>
						<?endif;?>
					</div>
						
					</div>
				</div>


<? require 'include/footer.php' ?>