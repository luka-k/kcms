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
										Каталог подрядчиков - <?=$page_title?>
									</h1>
									<div id="manufacturers" class="manufacturers">
										<?$contractors_counter = 1?>
										<?foreach($contractors as $contractor):?>
										<div class="manufacturer-item">
											<div class="manufacturer-logo">
												<a href="<?=base_url()?>podrjadchiki/<?=$a_link?><?=$contractor->url?>"><img src="<?=$contractor->img->manufacturer_url?>" alt="<?=$contractor->name?>"/></a>
											</div>
											<div class="manufacturer-categories-list list-row" colqty="2">
												<ul class="list_box l-b-<?=$contractors_counter?>">
													<div class="manu_col">
														<?$cat_counter = 1?>
														<?foreach($contractor->services as $service):?>
															<li class="cat_list-<?=$contractors_counter?>">
																<a nohref><?=$service->name?></a>
															</li>
															<?$cat_counter++?>
															<?if($cat_counter == 5):?></div><div class="manu_col"><?$cat_counter = 1?><?endif;?>
														<?endforeach;?>
													</div>
												</ul>
											</div>
										</div>
										<?$contractors_counter++?>
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
					<?require "include/contractors_left_menu.php"?>
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