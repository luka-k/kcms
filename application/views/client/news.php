<!DOCTYPE html>
<html>
	<?require_once 'catalog/include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require FCPATH.'application/views/client/include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="news">
						<article>
							<? require 'include/breadcrumbs.php' ?>
							<div id="" class="main-content clearfix">

								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									
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
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1><?=$title?></h1>
					<?require_once 'include/news-left-col.php'?>
				</aside>
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require FCPATH.'application/views/client/include/news_collumn.php'?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		<?require "shop/include/footer.php"?>
	</body>
</html>