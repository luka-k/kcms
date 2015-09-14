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
				<? require "include/breadcrumbs.php"?>
				<? require "include/sidebar.php"?>
				
				<div id="right_cont">
					<div id="content" class="rounded" <?= (true || $_SERVER['REQUEST_URI'] != '/ielts/pokupka-klyucha/' ? '' : 'style="width: 960px;"')?>>
						<div id="title_cont" class="rounded" <?= (true || $_SERVER['REQUEST_URI'] != '/ielts/pokupka-klyucha/' ? '' : 'style="width: 960px;"')?>>
							<?if(isset($content->news_item)):?>
								<h1><?=$content->news_item->name?></h1>
							<?elseif(empty($content->article)):?>
								<?=$content->name?>
							<?else:?>
								<h1><?=$content->article->name?></h1>
							<?endif;?>
						</div>
						
						<div class="cont">
							<?if(!empty($content->news_item)):?>
								<div class="desc">
									<?=$content->news_item->description?>
									<?=$content->news_item->full_description?>
								</div>
							<?elseif(!empty($content->news)):?>
								<div id="advancedrecentposts-9" class="widget_advancedrecentposts widget">
									<h3 class="widget-title">  </h3>
									<ul class="advanced-recent-posts">
										<?foreach($content->news as $news_item):?>
											<li class="news-item">
												<a href="<?=$news_item->full_url?>" title="<?=$news_item->name?>" >
													<img width="50" height="50" class="recent-posts-thumb" src="<?=$news_item->img->url?>" class="attachment-50x50 wp-post-image" alt="fff" /><?=$news_item->name?>
												</a>
												<div class="magic news-text"> 
													<?=$news_item->short_description?>
												</div>
											</li>
										<?endforeach;?>
									</ul>
								</div>	
							<?elseif(!empty($content->accordeon)):?>
								<div class="under_accordion">
									<?=$content->article->description?>
								</div>
								<div id="st-accordion" class="st-accordion">
									<ul>
										<?foreach($content->accordeon as $bajan):?>
											<li>
												<a href="#"><?=$bajan->name?><span class="st-arrow">&nbsp;</span></a>
												<div class="st-content"><?=$bajan->description?>
													<?if(!empty($bajan->full_description)):?>
														<a href="<?=$bajan->full_url?>"><?if(LANG == 'eng'):?>more...<?else:?>далее...<?endif;?></a>
													<?endif;?>												
												</div>  
												<div></div>
											</li>
										<?endforeach;?>
									
									</ul>
								</div>
							<?elseif(!empty($content->article)):?>
								<div class="desc">
							
									<?=$content->article->description?>
									<?=$content->article->full_description?>
								</div>
							<?else:?>
								<div class="desc">
									<?=$content->description?>
								</div>
							<?endif;?>
						</div>
					</div>
				</div>
			</div>
			
		</div>	
			
		
<? require 'include/footer.php' ?>