<!DOCTYPE html>
<html>
	<?require_once 'include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require FCPATH.'application/views/client/include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="main_page" class="sitemap">
						<article>
							
							<div id="" class="main-content clearfix">

								<div id="map-scroll" class="catalog" style="overflow-y:scroll;">
									<h1 style="padding-left: 10px;padding-top:2px;margin-top: 0px;">Карта сайта</h1>
									<div>
										<?foreach($content as $type => $map):?>
											<div style="margin-bottom:10px;">
												<h2 style="margin-bottom:5px;"><?=$type?></h2>
												<ul>
												<?foreach($map as $item_1):?>
												
													<li>
													<a href="<?=$item_1->full_url?>" class="level1_link">
														<div class="ttl"><?=$item_1->name?></div>
													</a>
													<?if(!empty($item_1->childs)):?>
														<ul>
															<?foreach($item_1->childs as $item_2):?>
																<li>
																	<a href="<?=$item_2->full_url?>">
																		<?=$item_2->name?>
																	</a>
																</li>
															<?endforeach;?>
														</ul>
													<?endif;?>
													</li>
												<?endforeach;?>
												</ul>
											</div>
										<?endforeach;?>
									</div>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<? require 'include/left-col.php'?>
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require FCPATH.'application/views/client/include/news_collumn.php'?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		
		<? if (count($filters_checked) < 4): ?>
			<div id="shadow"></div>
		<? endif ?>
		
		<?require_once 'include/shop_scripts.php'?>
		<?require_once 'include/scroll_scripts.php'?>
		<?require_once 'include/range_scripts.php'?>
		<?require_once 'include/left_menu_scripts.php'?>
		<?require "include/footer.php"?>
	</body>
</html>