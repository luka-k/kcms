<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<?require_once 'shop/include/head.php'?>		
	<body>
			<? require 'include/header.php'?>
		
			<div id="wrapper">
				<div class="section maxw">
					<div class="mainwrap">
						<main class="news">
							<article>
								<div id="scroll-content" style="height: 700px; overflow-y: auto;">
									
									<? require 'include/breadcrumbs.php' ?>
									<div style="clear: both;"></div>
									
									<div class="news">
										<?if($sub_template == "single-news"):?>
											<div class="news-item">
												<div class="item_date"><?=$content->article->date?></div>
													
												<h3 class="item_title"><?=$content->article->name?></h3>
													
												<div class="item_text"><?=$content->article->description?></div>
											</div>
										<?else:?>
											<div class="news-header">
												<?if(!empty($selected_manufacturer)):?>
													<div class="m_logo"><img src="<?=$selected_manufacturer->img->catalog_small_url?>"></div>
													<div class="m_title">Новости <?=$selected_manufacturer->name?></div>
												<?endif;?>
											</div>
											<div style="clear: both;"></div>
											<div class="news-content">
												<?foreach($content->articles as $item):?>
													<div class="news-item">
														<div class="item_date"><?=$item->date?></div>
														
														<h3 class="item_title"><a href="<?=$item->full_url?>"><?=$item->name?></a></h3>
														
														<div class="item_text"><?=$item->description?></div>
													</div>
												<?endforeach;?>
											</div>
										<?endif;?>
									</div>
								</div>
							</article>
						</main>
					</div>
					
					<aside id="s_left">
						<h1><?=$title?></h1>
	<div id="scroll-left" class="leftmenu">
		<div class="aside_news_header">
			<?if(!empty($selected_manufacturer)):?>Новости <?=$selected_manufacturer->name?><?endif;?>
		</div>
		<?foreach($content->articles as $item):?>
			<div class="aside-news-item">
				<div class="item_date"><?=$item->date?></div>							
				<h3 class="item_title"><a href="<?=$item->full_url?>"><?=$item->name?></a></h3>
			</div>
		<?endforeach;?>
	</div>
</aside>
					
					<aside id="s_right" class="news">
						<div id="manufacturers_col" class="manufacturers">
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="news-form" action="<?=base_url()?>articles/novosti">
								<select name="manufacturer_id" class="dropdown" onchange="document.forms['news-form'].setAttribute('action', '<?=base_url()?>articles/novosti?m_id='+this.options[this.selectedIndex].value); submit('news-form'); return false;">
									<option value="">Выберите по бренду</option>
									<?foreach($manufacturers_with_news as $m):?>
										<option value="<?=$m->id?>"><?=$m->name?></option>
									<?endforeach;?>
								</select>
							</form>
							<ul style="height: auto;">
								<?foreach($manufacturers_with_news as $m):?>
									<li>
										<a href="<?=base_url()?>articles/novosti?m_id=<?=$m->id?>"><img <?= $content->manufacturer_id == $m->id || $this->input->get('m_id') == $m->id ? 'class="active"': ''?> src="<?=$m->img->manufacturer_url?>"/></a>
									</li>
								<?endforeach;?>
							</ul>
						</div>
					</aside>
				</div>
			</div>		
		<?require 'shop/include/footer.php';?>
	</body>
</html>