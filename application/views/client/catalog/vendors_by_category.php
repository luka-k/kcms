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
					<main id="by_category">
						<article>
							<?require FCPATH.'application/views/client/include/breadcrumbs.php'?>
							<div id="" class="main-content clearfix">
		
								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									
									<h1 class="manufacturer-title">
										Каталог продавцов - <?=$page_title?>
									</h1>
									<div id="manufacturers" class="manufacturers">
										<?$manufacturer_counter = 1?>
										<?foreach($vendors as $v):?>
										<div class="manufacturer-item">
											<div class="manufacturer-logo">
												<a href="<?=base_url()?>vendor/<?=$v->url?>"><img src="<?=$v->img->manufacturer_url?>" alt="<?=$v->name?>"/></a>
											</div>
											<div class="manufacturer-categories-list list-row" colqty="3">
												<ul class="list_box l-b-<?=$manufacturer_counter?>">
													<div class="manu_col">
														<?$cat_counter = 1?>
														<?foreach($v->categories as $category):?>
															<?if($level == 1):?>
																<li class="cat_list-<?=$manufacturer_counter?> <?if($category->url == $active_category):?>active<?endif;?>">
																	<?=$category->name?>
																</li>
																<?$cat_counter++?>
																<?if($cat_counter == 5):?></div><div class="manu_col"><?$cat_counter = 1?><?endif;?>
															<?else:?>
																<?if(isset($category->childs)):?>
																	<?foreach($category->childs as $sub):?>
																		<li class="cat_list-<?=$manufacturer_counter?> <?if($sub->url == $active_category):?>active<?endif;?>">
																			<?=$sub->name?>
																		</li>
																		<?$cat_counter++?>
																		<?if($cat_counter == 5):?></div><div class="manu_col"><?$cat_counter = 1?><?endif;?>
																	<?endforeach;?>
																<?endif;?>
															<?endif;?>
														<?endforeach;?>
													</div>
												</ul>
											</div>
										</div>
										<?$manufacturer_counter++?>
										<?endforeach;?>
									</div>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1><?=$above_menu_title?></h1>
					<?require "include/vendors_left_menu.php"?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require FCPATH.'application/views/client/include/news_collumn.php'?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		<?require "include/footer.php"?>
	</body>
</html>