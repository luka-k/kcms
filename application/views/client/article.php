<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
<html xmlns=”http://www.w3.org/1999/xhtml”>
<? require 'include/head.php' ?>
<script type="text/javascript">$('.menu li:last').addClass('last');</script>
	<body>
		<div id="parrent">
			
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
			
			<div id="main">
				
				<!--sidebar-->
				<? require "include/sidebar.php"?>
				
				<div id="right_cont">
					<div id="content" class="rounded" <?= (true || $_SERVER['REQUEST_URI'] != '/ielts/pokupka-klyucha/' ? '' : 'style="width: 960px;"')?>>
					
						<div id="title_cont" class="rounded" <?= (true || $_SERVER['REQUEST_URI'] != '/ielts/pokupka-klyucha/' ? '' : 'style="width: 960px;"')?>>
							<?if(empty($content->article)):?>
								<?if(($type == "cambridge")||($type == "ielts")):?>
									<h1>Регистрируйтесь он-лайн</h1>
								<?elseif($type == "pearson"):?>
									<h1>Всё об экзаменах Pearson и LCCI в видеопрезентациях</h1>
								<?elseif($type == "study"):?>
									<h1>Курсы подготовки.</h1>
								<?elseif($type == "book-store"):?>
									<h1>Магазин иностранной литературы «Книжный Дом», Bookhouse </h1>
								<?endif;?>
							<?else:?>
								<h1><?=$content->article->name?></h1>
							<?endif;?>
						</div>
						
						<div class="cont">
							<?if(!empty($content->news)):?>
								<div id="advancedrecentposts-9" class="widget_advancedrecentposts widget">
									<h3 class="widget-title">  </h3>
									<ul class="advanced-recent-posts">
										<?foreach($content->news as $news_item):?>
											<li>
												<a href="<?=$news_item->url?>" title="<?=$news_item->name?>" >
													<img width="50" height="50" class="recent-posts-thumb" src="<?=$news_item->img->url?>" class="attachment-50x50 wp-post-image" alt="fff" /><?=$news_item->name?>
												</a>
												<div class="magic"> 
													<?=$news_item->description?>
												</div>
											</li>
										<?endforeach;?>
									</ul>
								</div>	
							<?elseif(!empty($content->accordeon)):?>
								<div id="st-accordion" class="st-accordion">
									<ul>
										<?foreach($content->accordeon as $bajan):?>
											<li>
												<a href="#"><?=$bajan->name?><span class="st-arrow">&nbsp;</span></a>
												<div class="st-content"><?=$bajan->description?></div>  
											</li>
										<?endforeach;?>
									
									</ul>
								</div>
							<?elseif(!empty($content->article)):?>
								<?=$content->article->description?>
							<?else:?>
								<?=$content->description?>
							<?endif;?>
						</div>
					</div>
				</div>
			</div>
			
		</div>	
			
		
<? require 'include/footer.php' ?>